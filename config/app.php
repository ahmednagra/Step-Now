<?php

/*
 | Application config for StepNow Rides & Movers e.K.
 |
 | Customisations vs. stock Laravel 11:
 |   - locale defaults to 'de' (was 'en') — primary market is Germany
 |   - available_locales / supported_locales = ['de', 'en'] (was ['en', 'ar'])
 |   - faker_locale defaults to de_DE for seeders/factories
 |   - locale + fallback_locale are env-overridable so staging/test envs
 |     can flip the default without code changes
 |
 | Read by: App\Http\Middleware\SetLocale and App\Http\Controllers\LocaleController.
 */

return [

    // ----- Identity -------------------------------------------------------
    'name'  => env('APP_NAME', 'StepNow'),
    'env'   => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url'   => env('APP_URL', 'http://localhost'),

    // ----- Time -----------------------------------------------------------
    'timezone' => env('APP_TIMEZONE', 'UTC'),

    // German is the legally authoritative language for this site.
    // English is a courtesy translation. See lang/de.json + lang/en.json.
    'locale'             => env('APP_LOCALE', 'de'),
    'fallback_locale'    => env('APP_FALLBACK_LOCALE', 'de'),
    'available_locales'  => ['de', 'en'],
    'supported_locales'  => ['de', 'en'],
    'faker_locale'       => env('APP_FAKER_LOCALE', 'de_DE'),

    // ----- Encryption -----------------------------------------------------
    'cipher'        => 'AES-256-CBC',
    'key'           => env('APP_KEY'),
    'previous_keys' => [
        ...array_filter(explode(',', env('APP_PREVIOUS_KEYS', ''))),
    ],

    // ----- Maintenance mode ----------------------------------------------
    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store'  => env('APP_MAINTENANCE_STORE', 'database'),
    ],
];