<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cookies; 

class CookiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     Cookies::create(
        [
            'title' => 'Full Time',
    'description' => 'Cookies accept or not accept',

    ]);

    }
}
