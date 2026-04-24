<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageCategory;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $page_categories = [
            ['slug' => 'visa-immigration', 'title' => 'Visa & Immigration'],
            ['slug' => 'business-setup', 'title' => 'Business Setup'],
            ['slug' => 'manpower-supply', 'title' => 'Manpower Supply'],
            ['slug' => 'study-abroad', 'title' => 'Study Abroad'],
            ['slug' => 'real-estate', 'title' => 'Real Estate'],
            ['slug' => 'investment-advisory', 'title' => 'Investment Advisory'],
        ];

        foreach ($page_categories as $page_category) {
            PageCategory::updateOrCreate(
                ['slug' => $page_category['slug']],
                [
                    'title' => $page_category['title'],
                    'description' => null,
                    'hero_title' => null,
                    'hero_sub_title' => null,
                    'hero_description' => null,
                    'image' => null,
                    'icon' => null,
                    'hero_image' => null,
                    'meta_title' => null,
                    'meta_description' => null,
                    'meta_keywords' => null,
                ]
            );
        }

        $pages = [
            // VISA & IMMIGRATION
            ['slug' => 'employment-visa', 'title' => 'Employment Visa', 'page_category_id' => 1, 'route_name' => 'front.visa.employment'],
            ['slug' => 'family-dependent-visa', 'title' => 'Family Dependent Visa', 'page_category_id' => 1, 'route_name' => 'front.visa.family'],
            ['slug' => 'student-visa', 'title' => 'Student Visa', 'page_category_id' => 1, 'route_name' => 'front.visa.student'],
            ['slug' => 'tourist-visa', 'title' => 'Tourist Visa', 'page_category_id' => 1, 'route_name' => 'front.visa.tourist'],
            ['slug' => 'emirates-id', 'title' => 'Emirates ID', 'page_category_id' => 1, 'route_name' => 'front.visa.emirates-id'],
            ['slug' => 'medical-insurance', 'title' => 'Medical Insurance', 'page_category_id' => 1, 'route_name' => 'front.visa.medical-insurance'],

            // BUSINESS SETUP
            ['slug' => 'mainland-freezone', 'title' => 'Mainland Freezone', 'page_category_id' => 2, 'route_name' => 'front.business.mainland'],
            ['slug' => 'moa-drafting', 'title' => 'MOA Drafting', 'page_category_id' => 2, 'route_name' => 'front.business.moa'],
            ['slug' => 'pro-services', 'title' => 'PRO Services', 'page_category_id' => 2, 'route_name' => 'front.business.pro'],
            ['slug' => 'bank-account-assistance', 'title' => 'Bank Account Assistance', 'page_category_id' => 2, 'route_name' => 'front.business.bank'],
            ['slug' => 'compliance-advisory', 'title' => 'Compliance Advisory', 'page_category_id' => 2, 'route_name' => 'front.business.compliance'],

            // MANPOWER SUPPLY
            ['slug' => 'bike-riders', 'title' => 'Bike Riders', 'page_category_id' => 3, 'route_name' => 'front.manpower.bike-riders'],
            ['slug' => 'hospitality-staff', 'title' => 'Hospitality Staff', 'page_category_id' => 3, 'route_name' => 'front.manpower.hospitality'],
            ['slug' => 'security-staff', 'title' => 'Security Staff', 'page_category_id' => 3, 'route_name' => 'front.manpower.security'],
            ['slug' => 'logistics-staff', 'title' => 'Logistics Staff', 'page_category_id' => 3, 'route_name' => 'front.manpower.logistics'],
            ['slug' => 'construction-staff', 'title' => 'Construction Staff', 'page_category_id' => 3, 'route_name' => 'front.manpower.construction'],

            // STUDY ABROAD
            ['slug' => 'global-admissions', 'title' => 'Global Admissions', 'page_category_id' => 4, 'route_name' => 'front.study.admissions'],
            ['slug' => 'sop-lor-assistance', 'title' => 'SOP & LOR Assistance', 'page_category_id' => 4, 'route_name' => 'front.study.sop-lor'],
            ['slug' => 'visa-filing', 'title' => 'Visa Filing', 'page_category_id' => 4, 'route_name' => 'front.study.visa-filing'],
            ['slug' => 'pre-departure-support', 'title' => 'Pre-Departure Support', 'page_category_id' => 4, 'route_name' => 'front.study.pre-departure'],

            // REAL ESTATE
            ['slug' => 'buy', 'title' => 'Buy Property', 'page_category_id' => 5, 'route_name' => 'front.real-estate.buy'],
            ['slug' => 'sell', 'title' => 'Sell Property', 'page_category_id' => 5, 'route_name' => 'front.real-estate.sell'],
            ['slug' => 'rent', 'title' => 'Rent Property', 'page_category_id' => 5, 'route_name' => 'front.real-estate.rent'],
            ['slug' => 'off-plan-investments', 'title' => 'Off-Plan Investments', 'page_category_id' => 5, 'route_name' => 'front.real-estate.off-plan'],
            ['slug' => 'roi-advisory', 'title' => 'ROI Advisory', 'page_category_id' => 5, 'route_name' => 'front.real-estate.roi'],

            // INVESTMENT ADVISORY
            ['slug' => 'investment-plans', 'title' => 'Investment Plans', 'page_category_id' => 6, 'route_name' => 'front.investment.plans'],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'page_category_id' => $page['page_category_id'],
                    'title' => $page['title'],
                    'page_link_for' => 'header',
                    'type' => 'website',
                    'description' => null,
                    'hero_title' => null,
                    'hero_sub_title' => null,
                    'hero_description' => null,
                    'image' => null,
                    'icon' => null,
                    'hero_image' => null,
                    'route_name' => $page['route_name'],
                    'meta_title' => null,
                    'meta_description' => null,
                    'meta_keywords' => null,
                ]
            );
        }
    }
}
