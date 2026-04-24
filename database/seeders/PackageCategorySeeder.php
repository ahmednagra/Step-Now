<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Package Categories — two parallel service categories per Gewerbeanmeldung
 * activity: "Personenbeförderung (Mietwagen) + Paketdienst".
 *
 * Displayed side-by-side on the /pricing page.
 *
 * Schema matches migration 2025_05_03_095955_create_package_categories_table:
 *   id, name, slug (unique), title, sub_title, description, order_no,
 *   icon, image, status, deleted_at, timestamps.
 */
class PackageCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id'          => 1,
                'name'        => 'Personenbeförderung',
                'slug'        => 'personenbefoerderung',
                'title'       => 'Personenbeförderung (Mietwagen)',
                'sub_title'   => 'Zuverlässige Fahrten in der Region Esslingen & Stuttgart',
                'description' => 'Ob Flughafentransfer, Geschäftsfahrt oder Überlandfahrt – unsere erfahrenen Fahrer bringen Sie sicher, pünktlich und komfortabel ans Ziel. Transparente Festpreise, moderne Fahrzeuge, 24/7 buchbar.',
                'order_no'    => 1,
                'icon'        => null,
                'image'       => null,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
            [
                'id'          => 2,
                'name'        => 'Paketdienst',
                'slug'        => 'paketdienst',
                'title'       => 'Paketdienst & Kurierlieferung',
                'sub_title'   => 'Schnelle Zustellung in Stadt, Region und deutschlandweit',
                'description' => 'Direkter Transport ohne Umwege: Wir holen Ihre Sendungen ab und liefern sie noch am gleichen Tag oder innerhalb von 24 Stunden – ideal für Firmen, Privatkunden und Expressbedarf.',
                'order_no'    => 2,
                'icon'        => null,
                'image'       => null,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
        ];

        foreach ($categories as $row) {
            DB::table('package_categories')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
