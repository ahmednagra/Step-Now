<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['id' => 1, 'title' => 'Abc',   'order_no' => '1',  'image' => '17629704971587149945.png', 'status' => 'published', 'created_at' => '2025-11-12 18:01:37', 'updated_at' => '2025-11-12 18:01:37'],
            ['id' => 2, 'title' => 'abc',   'order_no' => '2',  'image' => '1762970511767384780.png',  'status' => 'published', 'created_at' => '2025-11-12 18:01:51', 'updated_at' => '2025-11-12 18:01:51'],
            ['id' => 3, 'title' => '1w2',   'order_no' => '3',  'image' => '17629705251537921560.png', 'status' => 'published', 'created_at' => '2025-11-12 18:02:05', 'updated_at' => '2025-11-12 18:02:05'],
            ['id' => 4, 'title' => 'adsa',  'order_no' => '5',  'image' => '1762970538849869591.png',  'status' => 'published', 'created_at' => '2025-11-12 18:02:18', 'updated_at' => '2025-11-12 18:02:18'],
            ['id' => 5, 'title' => '123',   'order_no' => '6',  'image' => '17629705521025756948.png', 'status' => 'published', 'created_at' => '2025-11-12 18:02:32', 'updated_at' => '2025-11-12 18:02:32'],
            ['id' => 6, 'title' => '13',    'order_no' => '7',  'image' => '1762970564757519922.png',  'status' => 'published', 'created_at' => '2025-11-12 18:02:44', 'updated_at' => '2025-11-12 18:02:44'],
            ['id' => 7, 'title' => '32',    'order_no' => '8',  'image' => '17629705751557729758.png', 'status' => 'published', 'created_at' => '2025-11-12 18:02:55', 'updated_at' => '2025-11-12 18:02:55'],
            ['id' => 8, 'title' => 'ddf',   'order_no' => '9',  'image' => '17629705861693708438.png', 'status' => 'published', 'created_at' => '2025-11-12 18:03:06', 'updated_at' => '2025-11-12 18:03:06'],
            ['id' => 9, 'title' => 'dfsdf', 'order_no' => '10', 'image' => '17629705972077620250.png', 'status' => 'published', 'created_at' => '2025-11-12 18:03:17', 'updated_at' => '2025-11-12 18:03:17'],
        ];

        foreach ($partners as $row) {
            DB::table('partners')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
