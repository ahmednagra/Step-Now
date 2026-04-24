<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('package_categories')->updateOrInsert(
            ['id' => 1],
            [
                'name'        => 'Ciaran Rowe',
                'slug'        => 'Qui-in-consequatur',
                'title'       => 'Unsere Preise',
                'sub_title'   => 'Ihr Mobilitätspartner vor Ort',
                'description' => '<p>Wir bieten faire und transparente Preise. Ob Kurzstrecke, Langstrecke oder Flughafentransfer – bei uns wissen Sie immer genau, was Sie bezahlen.</p>',
                'order_no'    => 0,
                'icon'        => null,
                'image'       => null,
                'status'      => 'active',
                'deleted_at'  => null,
                'created_at'  => '2026-04-24 11:55:43',
                'updated_at'  => '2026-04-24 11:55:43',
            ]
        );
    }
}
