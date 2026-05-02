<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * StepNow Rides — locale resolver middleware (HARDENED v2).
 *
 * Runs on every web request. Sets app()->getLocale() before any
 * controller / view fires.
 *
 * Resolution order (first hit wins):
 *   1. ?lang=de or ?lang=en in the query string
 *      — also persisted to session so subsequent clicks keep the locale
 *      — the session->save() call is EXPLICIT so the cookie/DB write is
 *        flushed before the response is sent (otherwise on the database
 *        session driver, an immediately-following request can race and
 *        read the OLD locale).
 *
 *   2. session('locale') — persisted by step 1 or by LocaleController.
 *
 *   3. config('app.locale') — the app default (set to 'de' in config/app.php).
 *
 * Allowed values pulled from config('app.available_locales');
 * anything else falls through to the default (no exception thrown,
 * so a corrupt cookie cannot 500 the site).
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = config('app.available_locales', ['de', 'en']);
        $default = config('app.locale', 'de');

        // ---- 1) ?lang= wins -------------------------------------------------
        $queryLang = $request->query('lang');
        if ($queryLang && in_array($queryLang, $allowed, true)) {
            App::setLocale($queryLang);

            // Persist for subsequent requests
            if ($request->hasSession()) {
                if ($request->session()->get('locale') !== $queryLang) {
                    $request->session()->put('locale', $queryLang);
                    // EXPLICIT save — otherwise the database session driver
                    // can write the new value AFTER the response cache layer
                    // has already snapshotted the old locale. Cheap call.
                    $request->session()->save();
                }
            }
            return $next($request);
        }

        // ---- 2) Session -----------------------------------------------------
        if ($request->hasSession()) {
            $sessionLang = $request->session()->get('locale');
            if ($sessionLang && in_array($sessionLang, $allowed, true)) {
                App::setLocale($sessionLang);
                return $next($request);
            }
        }

        // ---- 3) Default -----------------------------------------------------
        App::setLocale($default);
        return $next($request);
    }
}
