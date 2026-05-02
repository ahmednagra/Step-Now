<?php

/*
 |---------------------------------------------------------------------------
 |  StepNow Rides — Locale-aware URL helpers (HARDENED v2)
 |---------------------------------------------------------------------------
 |
 |  WHY THIS FILE EXISTS
 |  --------------------
 |  When a visitor is on the EN locale, every internal link must include
 |  ?lang=en in its href so that:
 |    1) Hovering shows the localised URL in the browser status bar
 |    2) Clicking the link doesn't drop the visitor back to German
 |       even if their session somehow doesn't fire on the next request
 |       (which can happen with response caching, cookie-stripping
 |       proxies like Cloudflare's free tier, or partial cache poisoning).
 |
 |  WHY IT WAS REWRITTEN
 |  --------------------
 |  Previous version used app()->getLocale() which can be 'de' for a
 |  fraction of the request lifecycle even after SetLocale middleware fired,
 |  if the request was served from a cached compiled view OR if
 |  spatie/laravel-responsecache returned a stale response. This new
 |  version derives the locale from THREE sources in priority order, the
 |  same way the SetLocale middleware does, so the helper agrees with the
 |  middleware byte-for-byte:
 |
 |     1) ?lang=de or ?lang=en in the current request's query string
 |     2) session('locale')
 |     3) app()->getLocale()
 |
 |  USAGE IN BLADE
 |  --------------
 |     <a href="{{ lroute('front.about') }}">{{ __('About Us') }}</a>
 |     <a href="{{ lurl('/some-path') }}">…</a>
 |     <a href="{{ locale_url_for('en') }}">EN</a>
 */

if (!function_exists('_sn_current_locale')) {
    /**
     * Authoritative lookup of the locale FOR LINK GENERATION.
     * Always reflects what the user ASKED for on this request,
     * even if app()->getLocale() somehow lags behind.
     */
    function _sn_current_locale(): string
    {
        $allowed = config('app.available_locales', ['de', 'en']);
        $default = config('app.locale', 'de');

        // 1. ?lang=… in the current request — authoritative for THIS request
        try {
            $req = request();
            if ($req) {
                $q = $req->query('lang');
                if ($q && in_array($q, $allowed, true)) {
                    return $q;
                }
                // 2. session('locale')
                if ($req->hasSession()) {
                    $s = $req->session()->get('locale');
                    if ($s && in_array($s, $allowed, true)) {
                        return $s;
                    }
                }
            }
        } catch (\Throwable $e) {
            // No request bound (artisan, queue worker) — fall through.
        }

        // 3. app()->getLocale() (set by middleware) → only if allowed
        try {
            $a = app()->getLocale();
            if ($a && in_array($a, $allowed, true)) {
                return $a;
            }
        } catch (\Throwable $e) { /* fall through */ }

        // 4. Default
        return $default;
    }
}

if (!function_exists('_sn_query_separator')) {
    function _sn_query_separator(string $url): string
    {
        return str_contains($url, '?') ? '&' : '?';
    }
}

if (!function_exists('lroute')) {
    /**
     * Locale-aware route().
     *
     * Default locale → clean URL (no ?lang= suffix), good for SEO.
     * Non-default    → ?lang=<locale> appended.
     */
    function lroute(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        $url     = route($name, $parameters, $absolute);
        $current = _sn_current_locale();
        $default = config('app.locale', 'de');

        if ($current === $default) {
            return $url;
        }
        return $url . _sn_query_separator($url) . 'lang=' . $current;
    }
}

if (!function_exists('lurl')) {
    /**
     * Locale-aware url() — same rules as lroute().
     */
    function lurl(string $path = '', mixed $parameters = [], ?bool $secure = null): string
    {
        $url     = url($path, $parameters, $secure);
        $current = _sn_current_locale();
        $default = config('app.locale', 'de');

        if ($current === $default) {
            return $url;
        }
        return $url . _sn_query_separator($url) . 'lang=' . $current;
    }
}

if (!function_exists('locale_url_for')) {
    /**
     * Build the URL of the CURRENT page in a SPECIFIC locale.
     * Used by the language switcher and by hreflang <link> tags.
     *
     *     locale_url_for('de')   →  current path with ?lang=de stripped (DE is default)
     *     locale_url_for('en')   →  current path with ?lang=en
     */
    function locale_url_for(string $lang): string
    {
        $req     = request();
        $path    = $req ? ($req->path() === '/' ? '/' : '/' . $req->path()) : '/';
        $query   = $req ? $req->query() : [];
        unset($query['lang']);

        $base    = url($path);
        $default = config('app.locale', 'de');

        if ($lang === $default) {
            return empty($query) ? $base : $base . '?' . http_build_query($query);
        }

        $query['lang'] = $lang;
        return $base . '?' . http_build_query($query);
    }
}
