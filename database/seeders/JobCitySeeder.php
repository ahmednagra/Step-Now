<?php

namespace Database\Seeders;

use App\Models\JobCountry;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobCountry::create(['id' => 1, 'name' => 'Pakistan']);
        JobCountry::create(['id' => 2, 'name' => 'India']);
        JobCountry::create(['id' => 3, 'name' => 'USA']);
    }
    
}
