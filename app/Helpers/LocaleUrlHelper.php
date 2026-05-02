<?php

/*
 |---------------------------------------------------------------------------
 | Locale-aware URL helpers
 |---------------------------------------------------------------------------
 | German is the default locale and gets clean URLs (no ?lang=de query).
 | English appends ?lang=en so the URL preview makes the variant explicit.
 |
 |     <a href="{{ lroute('front.about') }}">{{ __('About us') }}</a>
 |     <a href="{{ lurl('/some-path') }}">…</a>
 |
 | When called from a page that is already on the EN locale, lroute() will
 | preserve the ?lang=en suffix, so all in-page links stay in English.
 */

if (!function_exists('_locale_query_separator')) {
    function _locale_query_separator(string $url): string
    {
        return str_contains($url, '?') ? '&' : '?';
    }
}

if (!function_exists('lroute')) {
    function lroute(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        $url     = route($name, $parameters, $absolute);
        $current = app()->getLocale();
        $default = config('app.locale', 'de');

        if ($current === $default) {
            return $url;
        }
        return $url . _locale_query_separator($url) . 'lang=' . $current;
    }
}

if (!function_exists('lurl')) {
    function lurl(string $path = '', mixed $parameters = [], ?bool $secure = null): string
    {
        $url     = url($path, $parameters, $secure);
        $current = app()->getLocale();
        $default = config('app.locale', 'de');

        if ($current === $default) {
            return $url;
        }
        return $url . _locale_query_separator($url) . 'lang=' . $current;
    }
}

if (!function_exists('locale_url_for')) {
    /**
     * Build the URL of the CURRENT page in a SPECIFIC locale. Used by the
     * language switcher and by the hreflang <link> tags.
     *
     *     locale_url_for('de')   →  current path with ?lang=de stripped (default)
     *     locale_url_for('en')   →  current path with ?lang=en
     */
    function locale_url_for(string $lang): string
    {
        $path  = request()->path() === '/' ? '/' : '/' . request()->path();
        $query = request()->query();
        unset($query['lang']);

        $base = url($path);
        $default = config('app.locale', 'de');

        if ($lang === $default) {
            return empty($query) ? $base : $base . '?' . http_build_query($query);
        }
        $query['lang'] = $lang;
        return $base . '?' . http_build_query($query);
    }
}
