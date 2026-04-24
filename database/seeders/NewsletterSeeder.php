<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'email' => 'shahida@gmail.com', 'status' => 0, 'created_at' => '2025-11-14 07:25:40', 'updated_at' => '2025-11-14 07:25:40', 'deleted_at' => null],
            ['id' => 2, 'email' => 'a@a.com',          'status' => 0, 'created_at' => '2025-11-14 07:26:02', 'updated_at' => '2025-11-14 07:26:02', 'deleted_at' => null],
        ];

        foreach ($rows as $row) {
            DB::table('newsletters')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
