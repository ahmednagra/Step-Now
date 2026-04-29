<?php

namespace App\Providers;

use App\Models\Setting;
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
     * Two view-shared values:
     *   $setting   — the single Settings row (logo, phone, email, address …)
     *   $policies  — array of active policy rows keyed by title slug,
     *                used by the footer to render the legally required
     *                "Rechtliches" navigation block.
     *
     * Both are read once per request from the database so seeders remain
     * the single source of truth.
     */
    public function boot(): void
    {
        // Share settings
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            View::share('setting', $setting);
        }

        // Share active legal policies for the footer "Rechtliches" block.
        // Indexed by canonical title so views can do
        //   $policies['Impressum'] etc.  (title -> route map below)
        if (Schema::hasTable('policies')) {
            $policies = DB::table('policies')
                ->where('status', 'active')
                ->orderBy('order_no')
                ->get(['title', 'page_title'])
                ->keyBy('title');
            View::share('policies', $policies);
        }
    }
}
