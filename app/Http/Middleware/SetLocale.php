<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * StepNow Rides — locale resolver middleware (Wave 2B — equal-locale model).
 *
 * Wave 2B change of model:
 *   The site now treats DE and EN as EQUAL — there is no "default winner".
 *   First-time visitors are matched against their browser's Accept-Language
 *   header. The choice is then persisted in BOTH the session AND a long-
 *   lived `stepnow_locale` cookie (1 year), written by the front-end JS
 *   when the user clicks the toggle. The cookie is the durable layer; the
 *   session is the per-request fast path.
 *
 * Resolution order (first hit wins):
 *
 *   1. ?lang=de or ?lang=en in the query string
 *      — also persisted to session AND to cookie.
 *      — the session->save() call is EXPLICIT so the session driver flushes
 *        the new value before the response is finalized (otherwise on
 *        the database session driver, an immediately-following request
 *        can race and read the OLD locale).
 *
 *   2. session('locale')
 *      — set by step 1, by LocaleController, or by a previous request.
 *
 *   3. cookie('stepnow_locale')
 *      — written client-side by scripts.blade.php when the user clicks
 *        the toggle, OR by the server when ?lang= is used. Survives
 *        session expiry.
 *
 *   4. Accept-Language header — first preference matching de/en.
 *      e.g. "de-DE,de;q=0.9,en;q=0.8" → "de"
 *           "en-US,en;q=0.9"          → "en"
 *           "fr-FR,fr;q=0.9"          → falls through (no match)
 *
 *   5. config('app.locale') — final fallback.
 *
 * Design notes:
 *   - We do NOT redirect to ?lang= on first visit. The URL stays clean
 *     and Google indexes the user's preferred-language version. The cookie
 *     keeps subsequent visits in the same locale.
 *   - Anything that's not in $allowed silently falls through. A corrupt
 *     cookie / query value cannot 500 the site.
 */
class SetLocale
{
    /** Long-lived locale cookie (1 year). */
    private const COOKIE_NAME = 'stepnow_locale';
    private const COOKIE_TTL  = 60 * 60 * 24 * 365; // seconds

    public function handle(Request $request, Closure $next): Response
    {
        $allowed = config('app.available_locales', ['de', 'en']);
        $default = config('app.locale', 'de');

        // ---- 1) ?lang= wins ------------------------------------------------
        $queryLang = $request->query('lang');
        if ($queryLang && in_array($queryLang, $allowed, true)) {
            App::setLocale($queryLang);
            $this->persist($request, $queryLang);
            $response = $next($request);
            return $this->writeCookie($response, $queryLang);
        }

        // ---- 2) Session ----------------------------------------------------
        if ($request->hasSession()) {
            $sessionLang = $request->session()->get('locale');
            if ($sessionLang && in_array($sessionLang, $allowed, true)) {
                App::setLocale($sessionLang);
                return $next($request);
            }
        }

        // ---- 3) Cookie -----------------------------------------------------
        $cookieLang = $request->cookie(self::COOKIE_NAME);
        if ($cookieLang && in_array($cookieLang, $allowed, true)) {
            App::setLocale($cookieLang);
            // Promote cookie → session for fast-path on subsequent requests
            if ($request->hasSession()) {
                $request->session()->put('locale', $cookieLang);
                $request->session()->save();
            }
            return $next($request);
        }

        // ---- 4) Accept-Language header ------------------------------------
        $headerLang = $this->resolveAcceptLanguage($request, $allowed);
        if ($headerLang) {
            App::setLocale($headerLang);
            $this->persist($request, $headerLang);
            $response = $next($request);
            return $this->writeCookie($response, $headerLang);
        }

        // ---- 5) Default ----------------------------------------------------
        App::setLocale($default);
        return $next($request);
    }

    /**
     * Persist the chosen locale to the session (cookie is written separately
     * on the response so it goes back to the browser).
     */
    private function persist(Request $request, string $lang): void
    {
        if (!$request->hasSession()) return;
        if ($request->session()->get('locale') !== $lang) {
            $request->session()->put('locale', $lang);
            $request->session()->save();
        }
    }

    /**
     * Write the long-lived locale cookie onto the outgoing response.
     */
    private function writeCookie(Response $response, string $lang): Response
    {
        // Use the framework's cookie() helper so all flags (Path, SameSite,
        // Secure-when-HTTPS) align with config/session.php.
        $cookie = cookie(
            self::COOKIE_NAME,         // name
            $lang,                     // value
            self::COOKIE_TTL / 60,     // minutes
            '/',                       // path
            null,                      // domain (let Laravel decide)
            null,                      // secure (auto-detect from request)
            false,                     // httpOnly = false (JS reads/writes it)
            false,                     // raw
            'lax'                      // SameSite
        );

        // Only attach if we have a Symfony Response we can mutate
        if (method_exists($response, 'withCookie')) {
            return $response->withCookie($cookie);
        }
        return $response;
    }

    /**
     * Parse Accept-Language and return the first allowed match, or null.
     *
     * Examples:
     *   "de-DE,de;q=0.9,en;q=0.8"   → "de"
     *   "en-US,en;q=0.9,de;q=0.8"   → "en"
     *   "fr-FR,fr;q=0.9"            → null (no allowed match)
     */
    private function resolveAcceptLanguage(Request $request, array $allowed): ?string
    {
        $header = $request->header('Accept-Language');
        if (!$header) return null;

        // Symfony's request->getLanguages() returns ["de_DE", "de", "en"]
        // sorted by q-value. We strip region suffix and pick first match.
        try {
            foreach ($request->getLanguages() as $lang) {
                $primary = strtolower(substr((string) $lang, 0, 2));
                if (in_array($primary, $allowed, true)) {
                    return $primary;
                }
            }
        } catch (\Throwable $e) {
            // Malformed header — fall through to null
            return null;
        }

        return null;
    }
}
