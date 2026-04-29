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
 * Public newsletter sign-up with German Double-Opt-In (DOI) — bilingual.
 *
 * DOI flow:
 *   1. Visitor posts /newsletter-store with email + consent checkbox.
 *   2. We persist the row with a random token, status=1, confirmed_at=null.
 *   3. We mail the visitor a link to /newsletter/confirm/{token}.
 *   4. Visiting that link sets confirmed_at to NOW. Only then is the row
 *      treated as a confirmed subscriber by anything that reads the table.
 *
 * Translation strategy is identical to FrontController: keys are English
 * strings; lang/de.json maps them to German. The validation rule keys
 * (e.g. 'email.required') stay in code; their messages translate.
 */
class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot — bots fill `website`. Drop silently with a fake-success
        // response so a bot's Sentry / log doesn't tip them off.
        if (filled($request->input('website'))) {
            return response()->json([
                'status'  => 'success',
                'message' => __('Please check your inbox to confirm your subscription.'),
            ]);
        }

        $validator = Validator::make($request->all(), [
            'email'   => 'required|email|max:255',
            'consent' => 'accepted',
        ], [
            'email.required'   => __('Please enter an email address.'),
            'email.email'      => __('Please enter a valid email address.'),
            'consent.accepted' => __('Please confirm your consent to the data processing.'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = strtolower(trim($request->input('email')));

        // If they're already confirmed, don't disclose that — return the
        // same generic "check your inbox" answer either way.
        $existing = Newsletter::withTrashed()->where('email', $email)->first();
        if ($existing && $existing->confirmed_at) {
            return response()->json([
                'status'  => 'success',
                'message' => __('Please check your inbox to confirm your subscription.'),
            ]);
        }

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

        try {
            Mail::to($email)->send(new NewsletterConfirmation($token));
        } catch (\Throwable $e) {
            // Log English. The user gets a generic message either way.
            Log::error('Newsletter DOI mail failed', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => __('Please check your inbox to confirm your subscription.'),
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
            $row->delete();
        }

        return view('front.pages.newsletter-unsubscribed');
    }
}
