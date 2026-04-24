<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'id'                  => 1,
                'package_category_id' => 1,
                'title'               => 'Stundenbasis',
                'destination'         => 'Plochingen -> Berlin',
                'subtitle'            => 'Maximale Flexibilität für jede Gelegenheit',
                'icon'                => '17770501951329161807.png',
                'amount'              => 62.99,
                'discount_percentage' => 56.00,
                'discounted_amount'   => 45.00,
                'currency_symbol'     => '$',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 0,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:03:15',
                'updated_at'          => '2026-04-24 12:03:15',
            ],
            [
                'id'                  => 2,
                'package_category_id' => 1,
                'title'               => 'Flughafentransfer',
                'destination'         => 'Plochingen -> Stuttgart',
                'subtitle'            => 'Sicherer Transfer zu',
                'icon'                => '17770502501555281680.png',
                'amount'              => 50.00,
                'discount_percentage' => 7.00,
                'discounted_amount'   => 40.00,
                'currency_symbol'     => '$',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 0,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:04:10',
                'updated_at'          => '2026-04-24 12:04:10',
            ],
            [
                'id'                  => 3,
                'package_category_id' => 1,
                'title'               => 'Stadtfahrt',
                'destination'         => 'Deizissu -> Plochingen',
                'subtitle'            => 'Kurzstrecke: Bis 3 Kilometer oder zum Bahnhof Plochingen / Altbach',
                'icon'                => '17770503201001138542.png',
                'amount'              => 9.99,
                'discount_percentage' => 10.00,
                'discounted_amount'   => 7.00,
                'currency_symbol'     => '$',
                'status'              => 'active',
                'publish'             => 'published',
                'order_no'            => 0,
                'deleted_at'          => null,
                'created_at'          => '2026-04-24 12:05:20',
                'updated_at'          => '2026-04-24 12:05:20',
            ],
        ];

        foreach ($packages as $row) {
            DB::table('packages')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
