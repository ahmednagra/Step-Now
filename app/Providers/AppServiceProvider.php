<?php

namespace App\Providers;

use App\Models\CourseCategory;
use App\Models\PackageCategory;
use App\Models\ServiceCategory;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Support\Facades\Blade;
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
        // You can bind services or repositories here if needed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            View::share('setting', $setting);
        }

    }
}
