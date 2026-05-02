<?php

/*
 |---------------------------------------------------------------------------
 | spatie/laravel-responsecache configuration
 |---------------------------------------------------------------------------
 |
 | DISABLED by default for step-now.de. The package was caching the entire
 | rendered HTML response (including menu links) WITHOUT keying on the
 | active locale or the ?lang= query parameter. This caused the language-
 | switcher bug: a German-rendered page would be returned to a visitor who
 | requested ?lang=en, with all menu links missing the locale suffix.
 |
 | If you ever want to re-enable response caching, you must first add a
 | custom CacheProfile that includes app()->getLocale() and request->query('lang')
 | in the cache key. Out of the box, the bundled CacheAllSuccessfulGetRequests
 | profile does NOT do that.
 |
 | See: https://github.com/spatie/laravel-responsecache#defining-which-requests-should-be-cached
 */

return [

    // Hard-disabled by default. To re-enable in production, set
    // RESPONSE_CACHE_ENABLED=true in .env AND deploy a locale-aware
    // CacheProfile (see comment above).
    'enabled' => env('RESPONSE_CACHE_ENABLED', false),

    'cache_profile' => Spatie\ResponseCache\CacheProfiles\CacheAllSuccessfulGetRequests::class,

    'cache_bypass_header' => [
        'name'  => env('CACHE_BYPASS_HEADER_NAME', null),
        'value' => env('CACHE_BYPASS_HEADER_VALUE', null),
    ],

    'cache_lifetime_in_seconds' => (int) env('RESPONSE_CACHE_LIFETIME', 60 * 60 * 24 * 7),

    'add_cache_time_header'   => env('APP_DEBUG', false),
    'cache_time_header_name'  => env('RESPONSE_CACHE_HEADER_NAME', 'laravel-responsecache'),
    'add_cache_age_header'    => env('RESPONSE_CACHE_AGE_HEADER', false),
    'cache_age_header_name'   => env('RESPONSE_CACHE_AGE_HEADER_NAME', 'laravel-responsecache-age'),
    'cache_store'             => env('RESPONSE_CACHE_DRIVER', 'file'),

    'replacers' => [
        \Spatie\ResponseCache\Replacers\CsrfTokenReplacer::class,
    ],

    'cache_tag' => '',

    'hasher' => \Spatie\ResponseCache\Hasher\DefaultHasher::class,

    'serializer' => \Spatie\ResponseCache\Serializers\DefaultSerializer::class,
];
