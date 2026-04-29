<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Admin Newsletter Controller.
 *
 * The PUBLIC sign-up flow lives in App\Http\Controllers\Front\NewsletterController
 * and uses Double-Opt-In (DOI). When an *admin* adds an address from the
 * back-office, we treat it as already confirmed, BUT only if the admin
 * has documented the consent out-of-band (e.g. business card given at an
 * event, signed paper form). The admin UI must therefore make this clear.
 *
 * Compliance change vs. the previous version:
 *   - confirmed_at is set to now() so the row counts as ACTIVE
 *   - confirmation_token is still generated (so the user always has a
 *     working unsubscribe link)
 *   - status mapped to a 0/1 int as before
 */
class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::orderByDesc('id')->paginate(50);
        return view('admin.newsletter.index', compact('newsletters'));
    }

    public function add()
    {
        return view('admin.newsletter.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'  => 'required|email|unique:newsletters,email',
            'status' => 'required|in:0,1',
        ]);

        $newsletter = new Newsletter();
        $newsletter->email              = strtolower(trim($request->email));
        $newsletter->confirmation_token = Str::random(64);
        $newsletter->confirmed_at       = now(); // admin attests offline consent
        $newsletter->ip_address         = $request->ip();
        $newsletter->user_agent         = substr((string) $request->userAgent(), 0, 512);
        $newsletter->status             = (int) $request->status;
        $newsletter->save();

        $notification = [
            'message' => 'Newsletter-Eintrag hinzugefügt.',
            'alert'   => 'success',
        ];

        return redirect()->route('admin.newsletter.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletter.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email'  => 'required|email|unique:newsletters,email,' . $id,
            'status' => 'required|in:0,1',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->email  = strtolower(trim($request->email));
        $newsletter->status = (int) $request->status;
        $newsletter->save();

        $notification = [
            'message' => 'Newsletter-Eintrag aktualisiert.',
            'alert'   => 'success',
        ];

        return redirect()->route('admin.newsletter.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete(); // soft-delete — keeps the record for audit

        $notification = [
            'message' => 'Newsletter-Eintrag entfernt.',
            'alert'   => 'success',
        ];

        return back()->with('notification', $notification);
    }
}
