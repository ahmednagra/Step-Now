<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobApplicationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('job_applications')->updateOrInsert(
            ['id' => 1],
            [
                'jcategory_id'          => 1,
                'title'                 => 'Senior Laravel Developer',
                'slug'                  => 'senior-laravel-developer',
                'position'              => 'Laravel Developer',
                'company_name'          => 'TechNova Solutions Ltd.',
                'vacancy'               => 3,
                'deadline'              => '11/14/2025',
                'employment_status'     => 'Full-Time',
                'job_location'          => 'Dhaka, Bangladesh',
                'salary'                => 'BDT 80,000 - 120,000 (Negotiable)',
                'other_benefits'        => '<p>Festival Bonus, Health Insurance, Flexible Working Hours</p>',
                'email'                 => null,
                'job_responsibility'    => '<p>• Develop and maintain web applications using Laravel framework. • Collaborate with front-end developers and project managers. • Write clean, secure, and testable code. • Optimize applications for maximum speed and scalability.</p>',
                'education_requirement' => '<p>• Bachelor’s degree in CSE or related field. • Strong understanding of PHP and OOP. • Knowledge of MVC architectural patterns.</p>',
                'job_context'           => '<p>You will work in an agile environment and collaborate closely with cross-functional teams to build high-quality software applications.</p>',
                'experience_requirement'=> '<p>• Minimum 3 years experience in Laravel. • Strong experience with REST APIs, MySQL, and Git. • Experience with Vue.js is a plus.</p>',
                'additional_requirement'=> '<p>• Strong problem-solving skills. • Ability to work under pressure. • Good communication skills.</p>',
                'meta_tags'             => '[{"value":"Laravel"},{"value":"PHP Developer"},{"value":"Software Jobs BD"}]',
                'meta_description'      => 'Apply now for the Senior Laravel Developer position at TechNova Solutions Ltd. Competitive salary with great work environment.',
                'status'                => 1,
                'serial_number'         => 1,
                'thumbnail_img'         => 'assets/admin/img/job_applications/176310067996019000_thumb.jpg',
                'banner_img'            => 'assets/admin/img/job_applications/176310067933420582_banner.jpg',
                'created_at'            => null,
                'updated_at'            => null,
            ]
        );
    }
}
