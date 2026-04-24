<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoBlockSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('info_blocks')->updateOrInsert(
            ['id' => 1],
            [
                'title'        => 'StepNow Rides',
                'subtitle'     => 'Über uns',
                'description'  => '<p>Wir sind ein professioneller TAXI-Alternative dienstleister und bieten sichere, komfortable sowie zuverlässige Fahrten für Privat- und Geschäftskunden. Mit einem modernen Fuhrpark, erfahrenen Fahrern und einem konsequent kundenorientierten Service garantieren wir höchste Qualität und Pünktlichkeit. Ob Flughafentransfer, Stadtfahrten oder Langstrecken – wir sorgen für eine entspannte und effiziente Beförderung bis zu Ihrem Ziel.</p>',
                'description2' => null,
                'image1'       => 'assets/admin/uploads/info_blocks/17770508221292237314.webp',
                'image2'       => 'assets/admin/uploads/info_blocks/17629720391987407959.png',
                'image3'       => null,
                'text1'        => '8+|Years of Experience',
                'text2'        => null,
                'text3'        => null,
                'show_on'      => 'home',
                'created_at'   => '2025-11-12 07:48:39',
                'updated_at'   => '2026-04-24 12:13:42',
            ]
        );

        $features = [
            ['id' => 25, 'info_block_id' => 1, 'icon' => null, 'title' => 'Professionelle Fahrer', 'description' => '', 'created_at' => '2026-04-24 12:13:42', 'updated_at' => '2026-04-24 12:13:42'],
            ['id' => 26, 'info_block_id' => 1, 'icon' => null, 'title' => 'Komfortable Fahrzeuge', 'description' => '', 'created_at' => '2026-04-24 12:13:42', 'updated_at' => '2026-04-24 12:13:42'],
            ['id' => 27, 'info_block_id' => 1, 'icon' => null, 'title' => 'Schnelle Abholung',    'description' => '', 'created_at' => '2026-04-24 12:13:42', 'updated_at' => '2026-04-24 12:13:42'],
        ];

        foreach ($features as $row) {
            DB::table('info_block_features')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
