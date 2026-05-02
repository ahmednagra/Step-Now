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
    public function register(): void
    {
        // No bindings.
    }

    public function boot(): void
    {
        /* ----------------------------------------------------------------
         | Settings (logo, phones, socials)
         ---------------------------------------------------------------- */
        if (Schema::hasTable('settings')) {
            View::share('setting', Setting::first());
        }

        /* ----------------------------------------------------------------
         | Active legal policies (footer "Rechtliches" block)
         ---------------------------------------------------------------- */
        if (Schema::hasTable('policies')) {
            $policies = DB::table('policies')
                ->where('status', 'active')
                ->orderBy('order_no')
                ->get(['title', 'page_title'])
                ->keyBy('title');
            View::share('policies', $policies);
        }

        /* ----------------------------------------------------------------
         | Active site banners (soft-launch / safety notices)
         ---------------------------------------------------------------- */
        if (Schema::hasTable('site_banners')) {
            View::share('banners', SiteBanner::enabled()->get());
        } else {
            View::share('banners', collect());
        }

        $pending = ['bookings' => 0, 'enquiries' => 0];

        try {
            if (auth()->check()) {

                if (Schema::hasTable('bookings')) {
                    $pending['bookings'] = (int) DB::table('bookings')
                        ->whereNull('deleted_at')
                        ->where('status', 'pending')
                        ->count();
                }

                if (Schema::hasTable('enquiries')) {
                    $eQuery = DB::table('enquiries')->whereNull('deleted_at');

                    if (Schema::hasColumn('enquiries', 'is_read')) {
                        $eQuery->where(function ($q) {
                            $q->where('is_read', 0)->orWhereNull('is_read');
                        });
                    }
                    $pending['enquiries'] = (int) $eQuery->count();
                }
            }
        } catch (\Throwable $e) {
            // Silent — sidebar fallback ?? 0 will display 0 badges.
            // Don't let a missing column or driver hiccup 500 every page.
        }

        View::share('pending', $pending);
    }
}