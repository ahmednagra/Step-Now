<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * "Warum StepNow Rides & Movers?"
 *
 * Replaces the old education content ("Flexible Learning", "Recognized
 * Degrees", etc.) with transport-relevant selling points tailored to
 * the Esslingen / Stuttgart service area.
 *
 * Ids 4, 5, 6 preserved from the legacy schema for idempotency —
 * updateOrInsert replaces rather than duplicates.
 */
class WhyChooseUsSectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('why_choose_us_sections')->updateOrInsert(
            ['id' => 2],
            [
                'title'       => 'Warum StepNow Rides & Movers?',
                'subtitle'    => 'Zuverlässig. Pünktlich. Regional verwurzelt.',
                'description' => 'Als Mietwagenunternehmen im Landkreis Esslingen verbinden wir regionale Ortskenntnis mit professionellem Service – ob Flughafentransfer, Geschäftsfahrt oder Paketlieferung.',
                'image'       => null,
                'show_on'     => 'home',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ]
        );

        $details = [
            [
                'id'                       => 4,
                'why_choose_us_section_id' => 2,
                'icon'                     => 'assets/admin/uploads/why_choose_us_details/17629680762042777113.png',
                'title'                    => 'Regionale Expertise',
                'description'              => 'Mit Sitz in Deizisau kennen wir die Region Esslingen, Stuttgart und das Neckartal bis ins Detail. Wir wählen stets die schnellste und stressfreieste Route für Sie.',
                'created_at'               => '2026-04-24 12:00:00',
                'updated_at'               => now(),
            ],
            [
                'id'                       => 5,
                'why_choose_us_section_id' => 2,
                'icon'                     => 'assets/admin/uploads/why_choose_us_details/1762968076936394970.png',
                'title'                    => 'Gepflegte Fahrzeugflotte',
                'description'              => 'Komfortable, regelmäßig gewartete Fahrzeuge – von der Limousine für Geschäftstermine bis zum Van für Gruppen- und Gepäckfahrten. Sauberkeit und Sicherheit garantiert.',
                'created_at'               => '2026-04-24 12:00:00',
                'updated_at'               => now(),
            ],
            [
                'id'                       => 6,
                'why_choose_us_section_id' => 2,
                'icon'                     => 'assets/admin/uploads/why_choose_us_details/1762968076798412466.png',
                'title'                    => 'Transparente Festpreise',
                'description'              => 'Keine Taxameter-Überraschungen: Sie erhalten Ihren Preis bereits bei der Buchung – inklusive aller Zuschläge. Fair kalkuliert, klar kommuniziert.',
                'created_at'               => '2026-04-24 12:00:00',
                'updated_at'               => now(),
            ],
        ];

        foreach ($details as $row) {
            DB::table('why_choose_us_section_details')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
