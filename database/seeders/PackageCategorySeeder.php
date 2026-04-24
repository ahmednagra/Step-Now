<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Package Categories — two parallel service categories per Gewerbeanmeldung
 * activity: "Personenbeförderung (Mietwagen) + Paketdienst".
 *
 * Displayed side-by-side on the /pricing page.
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
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
            [
                'id'          => 2,
                'name'        => 'Paketdienst',
                'slug'        => 'paketdienst',
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
