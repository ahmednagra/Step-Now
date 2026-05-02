<?php

return [
    // HelperServiceProvider MUST run first so that lroute(), tr(), and
    // related helpers are available before any other provider, view, or
    // middleware tries to use them.
    App\Providers\HelperServiceProvider::class,

    App\Providers\AppServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
];
