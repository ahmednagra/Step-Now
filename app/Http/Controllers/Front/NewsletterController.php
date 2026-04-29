<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterConfirmation;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Public newsletter sign-up with German Double-Opt-In (DOI).
 *
 * Why DOI is required (BGH 10.02.2011, I ZR 164/09; § 7 UWG):
 *   - Storing an e-mail address and sending a newsletter without a
 *     confirmation step is treated as unsolicited commercial
 *     communication (Spam) and is one of the most common Abmahn
 *     causes in Germany.
 *
 * Flow:
 *   1. POST /newsletter-store
 *        validate input + consent checkbox
 *        create row with confirmation_token + ip + ua
 *        send DOI mail with /newsletter/confirm/{token}
 *   2. GET /newsletter/confirm/{token}
 *        flip confirmed_at = now()
 *        from this point on the address is an active subscriber
 *   3. GET /newsletter/unsubscribe/{token}
 *        soft-delete the row
 *
 * The honeypot field `website` MUST stay empty for real users.
 */
class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot — bots fill this, humans don't see it.
        if (filled($request->input('website'))) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Bitte prüfen Sie Ihren Posteingang, um die Anmeldung zu bestätigen.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'email'   => 'required|email|max:255',
            'consent' => 'accepted',  // checkbox must be checked
        ], [
            'email.required'   => 'Bitte geben Sie eine E-Mail-Adresse an.',
            'email.email'      => 'Bitte geben Sie eine gültige E-Mail-Adresse an.',
            'consent.accepted' => 'Bitte bestätigen Sie die Einwilligung zur Datenverarbeitung.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = strtolower(trim($request->input('email')));

        // If the address is already a confirmed subscriber, do not leak that
        // fact (privacy by design) — answer with the same generic message
        // the user would see for a fresh sign-up.
        $existing = Newsletter::withTrashed()->where('email', $email)->first();
        if ($existing && $existing->confirmed_at) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Bitte prüfen Sie Ihren Posteingang, um die Anmeldung zu bestätigen.',
            ]);
        }

        // (Re)issue confirmation token. Use updateOrCreate so an unconfirmed
        // row from a previous attempt is reused rather than blocked by the
        // unique-email constraint.
        $token = Str::random(64);

        Newsletter::updateOrCreate(
            ['email' => $email],
            [
                'confirmation_token' => $token,
                'confirmed_at'       => null,
                'ip_address'         => $request->ip(),
                'user_agent'         => substr((string) $request->userAgent(), 0, 512),
                'status'             => 1,
                'deleted_at'         => null,
            ]
        );

        // Send DOI mail. Failures are logged but don't expose internal
        // errors to the user (they would only confirm the address exists
        // in the system).
        try {
            Mail::to($email)->send(new NewsletterConfirmation($token));
        } catch (\Throwable $e) {
            Log::error('Newsletter DOI mail failed', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Bitte prüfen Sie Ihren Posteingang, um die Anmeldung zu bestätigen.',
        ]);
    }

    public function confirm(string $token)
    {
        $row = Newsletter::where('confirmation_token', $token)->first();

        if (!$row) {
            abort(404);
        }

        if (!$row->confirmed_at) {
            $row->confirmed_at = now();
            $row->save();
        }

        return view('front.pages.newsletter-confirmed');
    }

    public function unsubscribe(string $token)
    {
        $row = Newsletter::where('confirmation_token', $token)->first();

        if ($row) {
            $row->delete(); // soft-delete (deleted_at)
        }

        return view('front.pages.newsletter-unsubscribed');
    }
}
