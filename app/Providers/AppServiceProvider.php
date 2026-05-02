<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\SiteBanner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // No bindings.
    }

    /**
     * Bootstrap any application services.
     *
     * View-shared values:
     *   $setting   — the single Settings row (logo, phone, email, address …)
     *   $policies  — array of active policy rows keyed by title slug,
     *                used by the footer to render the legally required
     *                "Rechtliches" navigation block.
     *   $banners   — collection of currently-enabled site banners (soft-launch,
     *                safety notices, etc.) — rendered above the header.
     *
     * All three are read once per request from the database so seeders remain
     * the single source of truth. The Schema::hasTable() guards mean the
     * site still boots before the migrations have been run for the first time.
     */
    public function boot(): void
    {
        // Share settings (logo, phones, socials)
        if (Schema::hasTable('settings')) {
            View::share('setting', Setting::first());
        }

        // Share active legal policies for the footer "Rechtliches" block.
        // Indexed by canonical title so views can do $policies->has('Impressum').
        if (Schema::hasTable('policies')) {
            $policies = DB::table('policies')
                ->where('status', 'active')
                ->orderBy('order_no')
                ->get(['title', 'page_title'])
                ->keyBy('title');
            View::share('policies', $policies);
        }

        // Share currently-enabled banners. Empty collection if the table
        // doesn't exist yet — the Blade partial guards against that.
        if (Schema::hasTable('site_banners')) {
            View::share('banners', SiteBanner::enabled()->get());
        } else {
            View::share('banners', collect());
        }
    }
}
