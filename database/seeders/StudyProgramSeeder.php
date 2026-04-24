<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyProgramSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1,  'name' => 'Bachelor of Commerce (B.Com)',            'slug' => 'bachelor-of-commerce-bcom'],
            ['id' => 2,  'name' => 'Bachelor of Business Administration (BBA)','slug' => 'bachelor-of-business-administration-bba'],
            ['id' => 3,  'name' => 'Bachelor of Computer Applications (BCA)', 'slug' => 'bachelor-of-computer-applications-bca'],
            ['id' => 4,  'name' => 'Master of Commerce (M.Com)',              'slug' => 'master-of-commerce-mcom'],
            ['id' => 5,  'name' => 'Master of Business Administration (MBA)', 'slug' => 'master-of-business-administration-mba'],
            ['id' => 6,  'name' => 'Master of Computer Applications (MCA)',   'slug' => 'master-of-computer-applications-mca'],
            ['id' => 7,  'name' => 'Master of Arts (M.A)',                    'slug' => 'master-of-arts-ma'],
            ['id' => 8,  'name' => 'Short Term IT Courses',                   'slug' => 'short-term-it-courses'],
            ['id' => 9,  'name' => 'Digital Marketing Courses',               'slug' => 'digital-marketing-courses'],
            ['id' => 10, 'name' => 'Artificial Intelligence Courses',         'slug' => 'artificial-intelligence-courses'],
        ];

        foreach ($rows as $row) {
            DB::table('study_programs')->updateOrInsert(
                ['id' => $row['id']],
                [
                    'name'       => $row['name'],
                    'slug'       => $row['slug'],
                    'status'     => 'active',
                    'order_no'   => 0,
                    'icon'       => null,
                    'font_icon'  => null,
                    'created_at' => '2025-11-12 06:24:53',
                    'updated_at' => '2025-11-12 06:24:53',
                ]
            );
        }
    }
}
