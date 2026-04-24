<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |----------------------------------------------------------------------
        | StepNow Rides & Movers — Master Seeder
        |----------------------------------------------------------------------
        | Order matters: parents first (categories, sections), children later
        | (packages, details, features). All seeders use updateOrInsert, so
        | re-running this is safe and idempotent.
        */

        // 1) Core — settings, auth, top-level
        $this->call(SettingsTableSeeder::class);
        $this->call(UserSeeder::class);

        // 2) Pages / taxonomy
        $this->call(PagesTableSeeder::class);           // page_categories + pages
        $this->call(StudyProgramSeeder::class);         // study_programs
        $this->call(JCategorySeeder::class);            // jcategories

        // 3) Homepage content (StepNow Rides site)
        $this->call(SliderSeeder::class);               // hero sliders
        $this->call(InfoBlockSeeder::class);            // "Über uns" block + features
        $this->call(WhyChooseUsSectionSeeder::class);   // why choose us + details
        $this->call(TestimonialSectionSeeder::class);   // German rides testimonials
        $this->call(TestimonialSeeder::class);          // legacy edu testimonials
        $this->call(PartnerSeeder::class);              // partner logos

        // 4) Packages (pricing page)
        $this->call(PackageCategorySeeder::class);
        $this->call(PackageSeeder::class);

        // 5) FAQs
        $this->call(FaqSeeder::class);                  // faq_sections + faq_details

        // 6) Policies / legal pages
        $this->call(PolicySeeder::class);               // privacy, T&C, cookie, GDPR, AML, legal, CSR
        // Optional legacy single-row seeders (kept for backwards compatibility):
        // $this->call(CookiesSeeder::class);
        // $this->call(PrivacyPolicySeeder::class);
        // $this->call(TermsAndConditionSeeder::class);
        // $this->call(SeoGlobalSeeder::class);

        // 7) Content (blogs, webinars)
        $this->call(BlogSeeder::class);                 // bcategories + blogs
        $this->call(WebinarSeeder::class);              // deduplicated webinar

        // 8) Leads captured through the site
        $this->call(EnquirySeeder::class);              // enquiries + enquiry_comments
        $this->call(NewsletterSeeder::class);

        // 9) Jobs / careers section
        $this->call(JobApplicationSeeder::class);

        // 10) Legacy education-platform data (comment out when finalising rides-only site)
        // $this->call(CourseSeeder::class);
        // $this->call(TeamSeeder::class);
        // $this->call(JobCountrySeeder::class);
        // $this->call(JobCitySeeder::class);
        // $this->call(JobTypeSeeder::class);
        // $this->call(JobExperienceSeeder::class);
        // $this->call(FacilityManagmentSeeder::class);
    }
}
