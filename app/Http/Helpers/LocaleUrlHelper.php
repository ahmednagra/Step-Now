<?php

/*
 |---------------------------------------------------------------------------
 |  StepNow Rides — Locale-aware URL helpers (Wave 2B — equal-locale model)
 |---------------------------------------------------------------------------
 |
 |  WHAT CHANGED IN WAVE 2B
 |  -----------------------
 |  Wave 1 model: DE was "default", got clean URLs; EN got ?lang=en. Wave 2B
 |  treats both locales as EQUAL — no default winner. Implication for URL
 |  building:
 |
 |    Old: lroute('front.about') in EN locale → /about-us?lang=en
 |         lroute('front.about') in DE locale → /about-us
 |
 |    New: lroute('front.about') in EN locale → /about-us?lang=en
 |         lroute('front.about') in DE locale → /about-us?lang=de
 |
 |  Both locales now get an explicit ?lang= suffix when the visitor's
 |  active locale was NOT determined by Accept-Language. This guarantees:
 |    1) Hovering a link shows the locale in the URL
 |    2) Clicking through doesn't rely on session/cookie persistence —
 |       even a browser with cookies disabled stays in the chosen locale
 |    3) Google sees both URL variants, indexes both, ranks each in the
 |       appropriate market
 |
 |  EXCEPTION: the home URL `/` and external/non-locale-aware routes are
 |  left alone. They're served by Accept-Language detection on first visit.
 |
 |  USAGE IN BLADE (unchanged from Wave 1)
 |  --------------------------------------
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

        try {
            $req = request();
            if ($req) {
                // 1. ?lang=… in the current request — authoritative for THIS request
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
                // 3. cookie('stepnow_locale')
                $c = $req->cookie('stepnow_locale');
                if ($c && in_array($c, $allowed, true)) {
                    return $c;
                }
            }
        } catch (\Throwable $e) {
            // No request bound (artisan, queue worker) — fall through.
        }

        // 4. app()->getLocale() (set by middleware)
        try {
            $a = app()->getLocale();
            if ($a && in_array($a, $allowed, true)) {
                return $a;
            }
        } catch (\Throwable $e) { /* fall through */ }

        // 5. Default (config)
        return $default;
    }
}

if (!function_exists('_sn_query_separator')) {
    function _sn_query_separator(string $url): string
    {
        return str_contains($url, '?') ? '&' : '?';
    }
}

if (!function_exists('_sn_url_already_has_lang')) {
    /**
     * Check if a URL already has ?lang= or &lang= in its query string.
     * Prevents lroute()/lurl() from appending a duplicate.
     */
    function _sn_url_already_has_lang(string $url): bool
    {
        return (bool) preg_match('/[?&]lang=(de|en)(&|$)/i', $url);
    }
}

if (!function_exists('lroute')) {
    /**
     * Locale-aware route().
     *
     * Wave 2B: BOTH locales get ?lang= suffix (equal weight).
     */
    function lroute(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        $url     = route($name, $parameters, $absolute);
        $current = _sn_current_locale();
        $allowed = config('app.available_locales', ['de', 'en']);

        if (!in_array($current, $allowed, true)) {
            return $url;
        }
        if (_sn_url_already_has_lang($url)) {
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
        $allowed = config('app.available_locales', ['de', 'en']);

        if (!in_array($current, $allowed, true)) {
            return $url;
        }
        if (_sn_url_already_has_lang($url)) {
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
     * Wave 2B: BOTH locales get an explicit ?lang= suffix.
     *
     *     locale_url_for('de')   →  /current/path?lang=de
     *     locale_url_for('en')   →  /current/path?lang=en
     */
    function locale_url_for(string $lang): string
    {
        $req     = request();
        $path    = $req ? ($req->path() === '/' ? '/' : '/' . $req->path()) : '/';
        $query   = $req ? $req->query() : [];
        unset($query['lang']);

        $base = url($path);

        $query['lang'] = $lang;
        return $base . '?' . http_build_query($query);
    }
}

if (!function_exists('lang_path_for')) {
    /**
     * Returns the same URL as the current request, but in another locale,
     * preserving every other query parameter. Convenience for the toggle.
     *
     * Equivalent to locale_url_for() but kept for backwards-compat with
     * any view that might call lang_path_for() directly.
     */
    function lang_path_for(string $lang): string
    {
        return locale_url_for($lang);
    }
}
