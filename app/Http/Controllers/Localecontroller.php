<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Locale switcher.
 *
 * GET /locale/{lang}  →  set the user's preferred language and bounce back.
 *
 * Persistence model:
 *   - Choice is stored in the Laravel session (key 'locale').
 *   - The session cookie itself lives for SESSION_LIFETIME (default 120 min).
 *   - The SetLocale middleware reads session('locale') on every request and
 *     calls App::setLocale(...) before any controller runs.
 *
 * Why session and not URL prefix:
 *   - Zero refactor of existing routes / route() calls
 *   - Cleaner URLs for SEO of the German pages (primary market)
 *   - English is a courtesy language for occasional visitors
 *
 * Security notes:
 *   - The {lang} route parameter is constrained at the route level via
 *     where('lang', 'de|en') so any other value 404s before reaching here.
 *   - The redirect target is built from the explicit `return` query param,
 *     falling back to the Referer header, falling back to '/'. We sanity-
 *     check that the host matches our own host to prevent open-redirect
 *     attacks (e.g. /locale/en?return=https://evil.com/login).
 */
class LocaleController extends Controller
{
    public function switch(string $lang, Request $request)
    {
        $allowed = config('app.available_locales', ['de', 'en']);

        if (!in_array($lang, $allowed, true)) {
            abort(404);
        }

        // Persist
        $request->session()->put('locale', $lang);

        // Decide where to bounce the user back
        $target = $request->query('return') ?: $request->headers->get('referer');

        if (!$target || !$this->isSafeRedirect($target, $request)) {
            $target = url('/');
        }

        return redirect()->to($target);
    }

    /**
     * Refuse redirects to anywhere outside our own host. Without this
     * /locale/en?return=https://evil.com/... would be an open redirect.
     */
    private function isSafeRedirect(string $url, Request $request): bool
    {
        $parsed = parse_url($url);
        if (!$parsed || empty($parsed['host'])) {
            // Relative URL → safe
            return str_starts_with($url, '/');
        }
        return $parsed['host'] === $request->getHost();
    }
}
