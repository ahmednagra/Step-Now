<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Reads the user's preferred locale and applies it for every web request.
 *
 * Resolution order (first hit wins):
 *   1. ?lang=de or ?lang=en in the query string
 *      (so a deep-link like /impressum?lang=en works without first
 *       hitting /locale/en — useful for the courtesy-translation
 *       "View German version" link inside English policy pages).
 *   2. session('locale') — persisted by LocaleController@switch.
 *   3. config('app.locale') — the app default (set to 'de' in .env).
 *
 * Allowed values are pulled from config('app.available_locales');
 * anything else falls through to the default (no exception thrown,
 * so a corrupt cookie can't 500 the site).
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = config('app.available_locales', ['de', 'en']);
        $default = config('app.locale', 'de');

        // 1) Query param wins — also persists to session so subsequent
        //    requests don't need ?lang=…
        $queryLang = $request->query('lang');
        if ($queryLang && in_array($queryLang, $allowed, true)) {
            $request->session()->put('locale', $queryLang);
            App::setLocale($queryLang);
            return $next($request);
        }

        // 2) Session
        $sessionLang = $request->session()->get('locale');
        if ($sessionLang && in_array($sessionLang, $allowed, true)) {
            App::setLocale($sessionLang);
            return $next($request);
        }

        // 3) Default
        App::setLocale($default);
        return $next($request);
    }
}
