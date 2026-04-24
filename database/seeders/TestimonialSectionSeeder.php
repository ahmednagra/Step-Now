<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('testimonial_sections')->updateOrInsert(
            ['id' => 1],
            [
                'title'       => 'Das sagen unsere Kunden',
                'subtitle'    => 'Kundenstimmen',
                'description' => 'Unsere Kunden schätzen unseren zuverlässigen Service, professionelle Fahrer und komfortable Fahrzeuge. Lesen Sie, was sie über ihre Fahrten mit uns sagen.',
                'created_at'  => '2026-04-24 12:19:38',
                'updated_at'  => '2026-04-24 12:19:38',
            ]
        );

        $details = [
            [
                'id'                      => 1,
                'testimonial_section_id'  => 1,
                'name'                    => 'Anna Müller',
                'image'                   => null,
                'designation'             => 'Geschäftsführerin',
                'feedback'                => 'Schnelle Abholung, freundliche Fahrer und komfortable Fahrzeuge – absolut empfehlenswert!',
                'rating'                  => 5,
                'created_at'              => '2026-04-24 12:19:38',
                'updated_at'              => '2026-04-24 12:19:38',
            ],
            [
                'id'                      => 2,
                'testimonial_section_id'  => 1,
                'name'                    => 'Maria Becker',
                'image'                   => null,
                'designation'             => 'Unternehmerin',
                'feedback'                => 'Top Service und hochwertige Fahrzeuge. Ich nutze sie immer wieder.',
                'rating'                  => 5,
                'created_at'              => '2026-04-24 12:19:38',
                'updated_at'              => '2026-04-24 12:19:38',
            ],
            [
                'id'                      => 3,
                'testimonial_section_id'  => 1,
                'name'                    => 'Lukas Schmidt',
                'image'                   => null,
                'designation'             => 'Freelancer',
                'feedback'                => 'Perfekter Flughafentransfer. Alles lief reibungslos und pünktlich.',
                'rating'                  => 4,
                'created_at'              => '2026-04-24 12:19:38',
                'updated_at'              => '2026-04-24 12:19:38',
            ],
        ];

        foreach ($details as $row) {
            DB::table('testimonial_details')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
