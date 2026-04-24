<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyChooseUsSectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('why_choose_us_sections')->updateOrInsert(
            ['id' => 2],
            [
                'title'       => 'Why Choose Us',
                'subtitle'    => 'flexible, recognized, and supportive.',
                'description' => null,
                'image'       => null,
                'show_on'     => 'home',
                'created_at'  => '2025-11-12 17:16:28',
                'updated_at'  => '2025-11-12 17:16:28',
            ]
        );

        $details = [
            [
                'id'                        => 4,
                'why_choose_us_section_id'  => 2,
                'icon'                      => 'assets/admin/uploads/why_choose_us_details/17629680762042777113.png',
                'title'                     => 'Flexible Learning',
                'description'               => 'Study anytime, anywhere — perfectly suited for working professionals balancing work and study.',
                'created_at'                => '2025-11-12 17:16:28',
                'updated_at'                => '2025-11-12 17:21:16',
            ],
            [
                'id'                        => 5,
                'why_choose_us_section_id'  => 2,
                'icon'                      => 'assets/admin/uploads/why_choose_us_details/1762968076936394970.png',
                'title'                     => 'Recognized Degrees',
                'description'               => 'All programs are offered through Indian government-approved and recognized universities for credibility.',
                'created_at'                => '2025-11-12 17:16:28',
                'updated_at'                => '2025-11-12 17:21:16',
            ],
            [
                'id'                        => 6,
                'why_choose_us_section_id'  => 2,
                'icon'                      => 'assets/admin/uploads/why_choose_us_details/1762968076798412466.png',
                'title'                     => 'Dedicated Support',
                'description'               => 'From enrollment to graduation, our team provides guidance and academic support every step of the way.',
                'created_at'                => '2025-11-12 17:16:28',
                'updated_at'                => '2025-11-12 17:21:16',
            ],
        ];

        foreach ($details as $row) {
            DB::table('why_choose_us_section_details')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
