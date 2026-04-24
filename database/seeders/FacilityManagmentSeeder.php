<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FacilityManagmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Hard Services',
            'Third Party Testing, Commissioning',
            'Soft Services',
            'Sustainability Management',
            'Home & Property Maintenance',
        ];

        foreach ($categories as $index => $title) {
            DB::table('service_categories')->insert([
                'title'             => $title,
                'slug'              => Str::slug($title),
                'thumbnail'         => 'default-thumbnail.jpg', // you can update later
                'description'       => $title . ' description here.',
                'icon'              => 'default-icon.png', // you can update later
                'order_no'          => $index + 1,
                'banner_image'      => null,
                'status'            => 'publish',
                'isfeature'         => 'featured',
                'meta_title'        => $title,
                'meta_description'  => $title . ' meta description here.',
                'font_awesome_icon' => 'fa-solid fa-cogs', // example
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        DB::beginTransaction();

        try {
            // 2) Services
            $services = [
                ['title' => 'HVAC systems'],
                ['title' => 'Electrical systems maintenance'],
                ['title' => 'Building management systems (BMS)'],
                ['title' => 'Computer-aided facilities management (CAFM)'],
                ['title' => 'Plumbing and drainage systems'],
                ['title' => 'Air conditioning systems'],
                ['title' => 'Building maintenance services'],
                ['title' => 'LV systems (CCTV, access control, barriers)'],
                ['title' => 'Interior fit-out and refurbishment'],
                ['title' => 'Remote monitoring systems'],
                ['title' => 'Asset management'],
                ['title' => 'Water tank cleaning and disinfection'],
                ['title' => 'Fire safety management'],
                ['title' => 'Health and safety systems'],
                ['title' => 'Auditing'],
                ['title' => 'Fire alarm and firefighting systems'],
                ['title' => 'Generator maintenance'],
                ['title' => 'Design and build service'],
            ];

            // 3) Insert each service
            foreach ($services as $index => $svc) {
                $title = $svc['title'];
                $serviceId = DB::table('services')->insertGetId([
                    'service_category_id' => 1,
                    'name'                => $title,
                    'slug'                => Str::slug($title),
                    'order_no'            => (string) ($index + 1),
                    'status'              => 'publish',
                    'isfeature'           => 'featured',
                    'font_awesome_icon'   => 'fa-solid fa-wrench',
                    'service_title'       => $title,
                    'service_subtitle'    => $title . ' services',
                    'banner_title'        => $title . ' banner',
                    'banner_subtitle'     => 'Professional ' . $title,
                    'thumbnail'           => 'default-thumbnail.jpg',
                    'icon'                => 'default-icon.png',
                    'banner_image'        => 'default-banner.jpg',
                    'short_description'   => $title . ' - short description.',
                    'description'         => $title . ' - detailed description and scope.',
                    'other_description'   => null,
                    'meta_title'          => $title,
                    'meta_keywords'       => str_replace(' ', ', ', $title),
                    'meta_description'    => $title . ' meta description.',
                    'meta_image'          => null,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            // ===============================
            // 3. Insert Services for Category ID = 2
            // ===============================
            $testingServices = [
                ['title' => 'Commissioning management'],
                ['title' => 'Pre-commissioning'],
                ['title' => 'Performance testing'],
                ['title' => 'Air measurement & balancing'],
                ['title' => 'Chilled water measurement & balancing'],
                ['title' => 'Temperature & humidity analysis'],
                ['title' => 'Sound level testing (Noise Criteria)'],
                ['title' => 'Operation & maintenance manuals'],
                ['title' => 'Building audit & energy management'],
                ['title' => 'Technical advising services'],
                ['title' => 'Air quality test'],
                ['title' => 'Duct leakage test'],
                ['title' => 'Smoke test for the rooms and HVAC ducts'],
                ['title' => 'Electrical live test'],
                ['title' => 'Electrical continuity test'],
                ['title' => 'Room pressure test'],
                ['title' => 'Fume hood air balancing'],
            ];

            foreach ($testingServices as $index => $svc) {
                $title = $svc['title'];
                $serviceId = DB::table('services')->insertGetId([
                    'service_category_id' => 2,
                    'name'                => $title,
                    'slug'                => Str::slug($title),
                    'order_no'            => (string) ($index + 19),
                    'status'              => 'publish',
                    'isfeature'           => 'featured',
                    'font_awesome_icon'   => 'fa-solid fa-screwdriver-wrench',
                    'service_title'       => $title,
                    'service_subtitle'    => $title . ' services',
                    'banner_title'        => $title . ' banner',
                    'banner_subtitle'     => 'Professional ' . $title,
                    'thumbnail'           => 'default-thumbnail.jpg',
                    'icon'                => 'default-icon.png',
                    'banner_image'        => 'default-banner.jpg',
                    'short_description'   => $title . ' - short description.',
                    'description'         => $title . ' - detailed description.',
                    'other_description'   => null,
                    'meta_title'          => $title,
                    'meta_keywords'       => str_replace(' ', ', ', $title),
                    'meta_description'    => $title . ' meta description.',
                    'meta_image'          => null,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            // ===============================
            // 4. Insert Services for Category ID = 3 (Soft Services)
            // ===============================
            $softServices = [
                ['title' => 'Security services'],
                ['title' => 'General administration'],
                ['title' => 'Staffing services'],
                ['title' => 'Pest control'],
                ['title' => '24/7 helpdesk'],
                ['title' => 'Integrated management systems'],
                ['title' => 'Swimming pool maintenance'],
                ['title' => 'Gardening and landscaping'],
                ['title' => 'Grease trap cleaning services'],
                ['title' => 'Duct cleaning services'],
                ['title' => 'Water tank cleaning services'],
                ['title' => 'Hygiene services'],
                ['title' => 'Cleaning services'],
            ];

            foreach ($softServices as $index => $svc) {
                $title = $svc['title'];
                $serviceId = DB::table('services')->insertGetId([
                    'service_category_id' => 3,
                    'name'                => $title,
                    'slug'                => Str::slug($title),
                    'order_no'            => (string) ($index + 36),
                    'status'              => 'publish',
                    'isfeature'           => 'featured',
                    'font_awesome_icon'   => 'fa-solid fa-broom',
                    'service_title'       => $title,
                    'service_subtitle'    => $title . ' services',
                    'banner_title'        => $title . ' banner',
                    'banner_subtitle'     => 'Professional ' . $title,
                    'thumbnail'           => 'default-thumbnail.jpg',
                    'icon'                => 'default-icon.png',
                    'banner_image'        => 'default-banner.jpg',
                    'short_description'   => $title . ' - short description.',
                    'description'         => $title . ' - detailed description.',
                    'other_description'   => null,
                    'meta_title'          => $title,
                    'meta_keywords'       => str_replace(' ', ', ', $title),
                    'meta_description'    => $title . ' meta description.',
                    'meta_image'          => null,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            // ===============================
            // 5. Insert Services for Category ID = 4 (Sustainability Management)
            // ===============================
            $sustainabilityServices = [
                ['title' => 'Total energy management and conservation'],
                ['title' => 'Full energy audits'],
                ['title' => 'Application of latest energy-saving techniques & technologies'],
                ['title' => 'Energy benchmarking with proprietary internet-based tools'],
                ['title' => 'Waste management'],
                ['title' => 'Hotel optimizer'],
                ['title' => 'FM consultancy'],
                ['title' => 'Lighting and water-saving solutions'],
                ['title' => 'Solar technology'],
                ['title' => 'Waste solutions'],
            ];

            foreach ($sustainabilityServices as $index => $svc) {
                $title = $svc['title'];
                $serviceId = DB::table('services')->insertGetId([
                    'service_category_id' => 4,
                    'name'                => $title,
                    'slug'                => Str::slug($title),
                    'order_no'            => (string) ($index + 49),
                    'status'              => 'publish',
                    'isfeature'           => 'featured',
                    'font_awesome_icon'   => 'fa-solid fa-leaf',
                    'service_title'       => $title,
                    'service_subtitle'    => $title . ' services',
                    'banner_title'        => $title . ' banner',
                    'banner_subtitle'     => 'Professional ' . $title,
                    'thumbnail'           => 'default-thumbnail.jpg',
                    'icon'                => 'default-icon.png',
                    'banner_image'        => 'default-banner.jpg',
                    'short_description'   => $title . ' - short description.',
                    'description'         => $title . ' - detailed description.',
                    'other_description'   => null,
                    'meta_title'          => $title,
                    'meta_keywords'       => str_replace(' ', ', ', $title),
                    'meta_description'    => $title . ' meta description.',
                    'meta_image'          => null,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            // ===============================
            // 6. Insert Services for Category ID = 5 (Home & Property Maintenance)
            // ===============================
            $homeMaintenanceServices = [
                ['title' => 'Villa and apartment annual maintenance contracts'],
                ['title' => 'Handyman services'],
                ['title' => 'Air conditioning services'],
                ['title' => 'Plumbing and electrical services'],
                ['title' => 'Villa & apartment cleaning'],
                ['title' => 'Gardening'],
                ['title' => 'Pest control'],
                ['title' => 'Swimming pool maintenance and cleaning'],
                ['title' => 'Smart home Wi-Fi and lifestyle products'],
                ['title' => 'Business and office services'],
                ['title' => 'Kitchen exhaust cleaning'],
                ['title' => 'Ecological unit cleaning'],
                ['title' => 'Mist/smoke filter cleaning'],
                ['title' => 'Laundry duct cleaning'],
                ['title' => 'Garbage chute cleaning'],
                ['title' => 'Drain-line jetting'],
                ['title' => 'Sewage tank cleaning'],
                ['title' => 'Grease trap cleaning'],
            ];

            foreach ($homeMaintenanceServices as $index => $svc) {
                $title = $svc['title'];
                $serviceId = DB::table('services')->insertGetId([
                    'service_category_id' => 5,
                    'name'                => $title,
                    'slug'                => Str::slug($title),
                    'order_no'            => (string) ($index + 59),
                    'status'              => 'publish',
                    'isfeature'           => 'featured',
                    'font_awesome_icon'   => 'fa-solid fa-house',
                    'service_title'       => $title,
                    'service_subtitle'    => $title . ' services',
                    'banner_title'        => $title . ' banner',
                    'banner_subtitle'     => 'Professional ' . $title,
                    'thumbnail'           => 'default-thumbnail.jpg',
                    'icon'                => 'default-icon.png',
                    'banner_image'        => 'default-banner.jpg',
                    'short_description'   => $title . ' - short description.',
                    'description'         => $title . ' - detailed description.',
                    'other_description'   => null,
                    'meta_title'          => $title,
                    'meta_keywords'       => str_replace(' ', ', ', $title),
                    'meta_description'    => $title . ' meta description.',
                    'meta_image'          => null,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}