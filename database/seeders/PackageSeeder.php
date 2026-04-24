<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Packages — actual service offerings for StepNow Rides & Movers.
 *
 * Split across two categories:
 *  1) Personenbeförderung (Mietwagen) — category_id 1
 *  2) Paketdienst                     — category_id 2
 *
 * All prices in Euro (€) — previous seeder used '$' which is wrong for
 * a German-registered business. Prices shown are indicative starting
 * prices; the admin should review and adjust before go-live.
 *
 * Discounted amount model: if discount_percentage > 0, discounted_amount
 * is the post-discount price the customer sees. When no discount,
 * discount_percentage = null.
 */
class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // ---------------------------------------------------------
            //  CATEGORY 1: Personenbeförderung (Mietwagen)
            // ---------------------------------------------------------
            [
                'id'                  => 1,
                'package_category_id' => 1,
                'title'               => 'Stadtfahrt Esslingen / Deizisau',
                'destination'         => 'Deizisau ↔ Esslingen',
                'subtitle'            => 'Kurze Fahrten innerhalb des Landkreises',
                'icon'                => null,
                'amount'              => 25.00,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 1,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],
            [
                'id'                  => 2,
                'package_category_id' => 1,
                'title'               => 'Flughafentransfer Stuttgart',
                'destination'         => 'Deizisau / Plochingen → Flughafen Stuttgart (STR)',
                'subtitle'            => 'Pünktlich & mit Gepäckservice',
                'icon'                => null,
                'amount'              => 55.00,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 2,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],
            [
                'id'                  => 3,
                'package_category_id' => 1,
                'title'               => 'Langstreckenfahrt auf Anfrage',
                'destination'         => 'Deutschlandweit',
                'subtitle'            => 'Individuelle Fahrten, auch Überland',
                'icon'                => null,
                'amount'              => 0.00,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 3,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],
            [
                'id'                  => 4,
                'package_category_id' => 1,
                'title'               => 'Stundenbasis (Chauffeurdienst)',
                'destination'         => 'Region Esslingen / Stuttgart',
                'subtitle'            => 'Maximale Flexibilität – Fahrzeug + Fahrer pro Stunde',
                'icon'                => null,
                'amount'              => 45.00,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 4,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],

            // ---------------------------------------------------------
            //  CATEGORY 2: Paketdienst
            // ---------------------------------------------------------
            [
                'id'                  => 5,
                'package_category_id' => 2,
                'title'               => 'Stadtlieferung',
                'destination'         => 'Innerhalb Deizisau / Esslingen / Plochingen',
                'subtitle'            => 'Schnelle Paketzustellung am selben Tag',
                'icon'                => null,
                'amount'              => 9.90,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 1,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],
            [
                'id'                  => 6,
                'package_category_id' => 2,
                'title'               => 'Regionale Lieferung',
                'destination'         => 'Landkreis Esslingen & Raum Stuttgart',
                'subtitle'            => 'Zustellung innerhalb von 24 Stunden',
                'icon'                => null,
                'amount'              => 19.90,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 2,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],
            [
                'id'                  => 7,
                'package_category_id' => 2,
                'title'               => 'Express Deutschland',
                'destination'         => 'Deutschlandweit auf Anfrage',
                'subtitle'            => 'Direktfahrt – kein Umsortieren, keine Umwege',
                'icon'                => null,
                'amount'              => 0.00,
                'discount_percentage' => null,
                'discounted_amount'   => null,
                'currency_symbol'     => '€',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 3,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:00:00',
                'updated_at'          => now(),
            ],
        ];

        foreach ($packages as $row) {
            DB::table('packages')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
