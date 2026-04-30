<?php

/**
 * StepNow Rides — locale-aware URL helpers.
 *
 * These helpers wrap Laravel's route() and url() so that when the current
 * locale is non-default (e.g. 'en'), the generated URL automatically includes
 * ?lang=en. The default locale ('de') gets clean URLs (no query param) for
 * SEO friendliness on the German market.
 *
 * Usage in Blade:
 *     <a href="{{ lroute('front.about') }}">{{ __('About Us') }}</a>
 *     <a href="{{ lurl('/some-path') }}">…</a>
 *
 * Why this exists:
 *     route() generates clean URLs, but those URLs lose the ?lang=en hint.
 *     If the user's session/cookie is intact the locale persists fine, but
 *     the URL preview (status bar on hover) shows the bare URL which can
 *     confuse users and harms SEO indexing of the EN variant. With lroute(),
 *     the URL preview always shows the localized URL.
 */

if (!function_exists('lroute')) {
    /**
     * Like route(), but appends ?lang=<locale> when locale is non-default.
     */
    function lroute(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        $url = route($name, $parameters, $absolute);

        $current = app()->getLocale();
        $default = config('app.locale', 'de');

        if ($current === $default) {
            return $url;
        }

        $separator = str_contains($url, '?') ? '&' : '?';
        return $url . $separator . 'lang=' . $current;
    }
}

if (!function_exists('lurl')) {
    /**
     * Like url(), but appends ?lang=<locale> when locale is non-default.
     */
    function lurl(string $path = '', mixed $parameters = [], ?bool $secure = null): string
    {
        $url = url($path, $parameters, $secure);

        $current = app()->getLocale();
        $default = config('app.locale', 'de');

        if ($current === $default) {
            return $url;
        }

        $separator = str_contains($url, '?') ? '&' : '?';
        return $url . $separator . 'lang=' . $current;
    }
}
