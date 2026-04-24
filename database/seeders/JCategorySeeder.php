<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jcategories')->updateOrInsert(
            ['id' => 1],
            [
                'name'          => 'Web Development',
                'slug'          => 'web-development',
                'status'        => 1,
                'serial_number' => 0,
                'created_at'    => '2025-11-14 06:08:44',
                'updated_at'    => '2025-11-14 06:08:44',
            ]
        );
    }
}
