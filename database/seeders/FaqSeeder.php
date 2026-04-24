<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Section
        DB::table('faq_sections')->updateOrInsert(
            ['id' => 1],
            [
                'title'       => 'Alles, was Sie wissen müssen',
                'subtitle'    => 'Häufig gestellte Fragen',
                'description' => 'Hier beantworten wir die häufigsten Fragen unserer Kunden rund um Buchung, Fahrzeuge, Transfers und Service.',
                'created_at'  => '2026-04-24 12:22:11',
                'updated_at'  => '2026-04-24 12:22:11',
            ]
        );

        // Details
        $details = [
            [
                'id'              => 1,
                'faq_section_id'  => 1,
                'question'        => 'Wie kann ich ein Auto buchen?',
                'answer'          => 'Sie können direkt über unsere Website, telefonisch oder über unsere App buchen.',
                'created_at'      => '2026-04-24 12:22:11',
                'updated_at'      => '2026-04-24 12:22:11',
            ],
            [
                'id'              => 2,
                'faq_section_id'  => 1,
                'question'        => 'Welche Fahrzeuge stehen zur Verfügung?',
                'answer'          => 'Wir bieten Limousinen, SUVs, Vans und Elektrofahrzeuge für alle Bedürfnisse.',
                'created_at'      => '2026-04-24 12:22:11',
                'updated_at'      => '2026-04-24 12:22:11',
            ],
            [
                'id'              => 3,
                'faq_section_id'  => 1,
                'question'        => 'Gibt es einen 24/7-Service?',
                'answer'          => 'Ja, unser Kundendienst und Fahrer stehen rund um die Uhr zur Verfügung.',
                'created_at'      => '2026-04-24 12:22:11',
                'updated_at'      => '2026-04-24 12:22:11',
            ],
            [
                'id'              => 4,
                'faq_section_id'  => 1,
                'question'        => 'Bieten Sie Flughafentransfers an?',
                'answer'          => 'Ja, wir bieten sichere und pünktliche Transfers zu und von allen Flughäfen.',
                'created_at'      => '2026-04-24 12:22:11',
                'updated_at'      => '2026-04-24 12:22:11',
            ],
        ];

        foreach ($details as $row) {
            DB::table('faq_details')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
