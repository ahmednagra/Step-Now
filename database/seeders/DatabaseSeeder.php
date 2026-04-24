<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

/**
 * StepNow Rides & Movers e.K. — Master Seeder
 *
 * Source of truth: Gewerbe-Anmeldung (GewA 1) registered at
 * Bürgermeisteramt Deizisau on 28.10.2025, Handelsregister entry
 * HRA 742905 at Amtsgericht Stuttgart.
 *
 * All seeders are idempotent (updateOrInsert) and table-guarded via
 * Schema::hasTable(), so missing migrations log a warning instead of
 * crashing the run.
 *
 * Legacy education-platform seeders (StudyProgram, JCategory, Course,
 * Team, Webinar, Blog, JobApplication, CompanyJob, Cookies,
 * PrivacyPolicy, TermsAndCondition, SeoGlobal, Testimonial-legacy)
 * have been removed per business decision — this project is now
 * exclusively a Personenbeförderung (Mietwagen) + Paketdienst operation.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // seeder class  =>  primary table it writes to
        $plan = [
            // 1) Core — business settings, auth
            SettingsTableSeeder::class         => 'settings',
            UserSeeder::class                  => 'users',

            // 2) Homepage content
            SliderSeeder::class                => 'sliders',
            InfoBlockSeeder::class             => 'info_blocks',
            WhyChooseUsSectionSeeder::class    => 'why_choose_us_sections',
            TestimonialSectionSeeder::class    => 'testimonial_sections',

            // 3) Pricing — 2 categories (Rides + Parcel)
            PackageCategorySeeder::class       => 'package_categories',
            PackageSeeder::class               => 'packages',

            // 4) FAQ
            FaqSeeder::class                   => 'faq_sections',

            // 5) Legal pages (DSGVO / TMG compliance)
            PolicySeeder::class                => 'policies',
        ];

        $skipped = [];

        foreach ($plan as $seederClass => $table) {
            if (!Schema::hasTable($table)) {
                $skipped[] = $seederClass . ' (missing table: ' . $table . ')';
                continue;
            }
            $this->call($seederClass);
        }

        if (!empty($skipped)) {
            Log::warning('DatabaseSeeder skipped: ' . implode(', ', $skipped));
            $this->command->warn('Skipped: ' . implode(', ', $skipped));
        }
    }
}
