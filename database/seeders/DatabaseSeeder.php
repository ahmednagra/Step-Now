<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * StepNow Rides & Movers — Master Seeder.
     *
     * Each child seeder is guarded with Schema::hasTable() so that if a
     * migration is missing (e.g. after you clone on a fresh machine and some
     * migration files haven't been added yet) the whole run does NOT crash.
     * Instead, the missing table is logged and skipped.
     *
     * All child seeders use updateOrInsert, so re-running this is idempotent.
     */
    public function run(): void
    {
        // seeder class  =>  primary table it writes to
        $plan = [
            // 1) Core — settings, auth
            SettingsTableSeeder::class        => 'settings',
            UserSeeder::class                 => 'users',

            // 2) Pages / taxonomy (parents first)
            PagesTableSeeder::class           => 'page_categories',
            StudyProgramSeeder::class         => 'study_programs',
            JCategorySeeder::class            => 'jcategories',

            // 3) Homepage content (StepNow Rides site)
            SliderSeeder::class               => 'sliders',
            InfoBlockSeeder::class            => 'info_blocks',
            WhyChooseUsSectionSeeder::class   => 'why_choose_us_sections',
            TestimonialSectionSeeder::class   => 'testimonial_sections',
            TestimonialSeeder::class          => 'testimonials',
            PartnerSeeder::class              => 'partners',

            // 4) Packages (pricing page)
            PackageCategorySeeder::class      => 'package_categories',
            PackageSeeder::class              => 'packages',

            // 5) FAQs
            FaqSeeder::class                  => 'faq_sections',

            // 6) Policies / legal pages
            PolicySeeder::class               => 'policies',

            // 7) Blogs & webinars
            BlogSeeder::class                 => 'bcategories',
            WebinarSeeder::class              => 'webinars',

            // 8) Leads
            EnquirySeeder::class              => 'enquiries',
            NewsletterSeeder::class           => 'newsletters',

            // 9) Jobs / careers
            JobApplicationSeeder::class       => 'job_applications',

            // 10) Legacy education-platform seeders — uncomment if still needed
            // CourseSeeder::class            => 'courses',
            // TeamSeeder::class              => 'teams',
            // CookiesSeeder::class           => 'cookies',
            // PrivacyPolicySeeder::class     => 'privacy_policies',
            // TermsAndConditionSeeder::class => 'terms_and_conditions',
            // SeoGlobalSeeder::class         => 'seo_globals',
        ];

        $skipped = [];

        foreach ($plan as $seederClass => $table) {
            if (! Schema::hasTable($table)) {
                $skipped[] = "{$seederClass}  (missing table: {$table})";
                continue;
            }

            if (! class_exists($seederClass)) {
                $skipped[] = "{$seederClass}  (class not found)";
                continue;
            }

            $this->call($seederClass);
        }

        if (! empty($skipped)) {
            $this->command->warn('');
            $this->command->warn('The following seeders were SKIPPED:');
            foreach ($skipped as $s) {
                $this->command->warn('  - ' . $s);
            }
            $this->command->warn('Run `php artisan migrate` after adding the missing migration files, then re-seed.');
        }
    }
}
