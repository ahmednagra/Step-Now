<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_jobs')->insert([
            [
                'name' => 'Tech Solutions Pvt Ltd',
                'logo' => 'logos/tech_solutions.png',
                'introduction' => 'We are a leading software company specializing in web and mobile applications.',
                'email' => 'hr@techsolutions.com',
                'website' => 'https://techsolutions.com',
                'phone' => '+92-300-1234567',
                'location' => 'Karachi, Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Global IT Services',
                'logo' => 'logos/global_it.png',
                'introduction' => 'An international IT service provider with expertise in cloud computing and AI.',
                'email' => 'careers@globalit.com',
                'website' => 'https://globalit.com',
                'phone' => '+92-321-9876543',
                'location' => 'Lahore, Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NextGen Startups',
                'logo' => null,
                'introduction' => 'We empower startups by providing technical consultancy and development services.',
                'email' => 'jobs@nextgen.com',
                'website' => null,
                'phone' => '+92-333-4567890',
                'location' => 'Islamabad, Pakistan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
