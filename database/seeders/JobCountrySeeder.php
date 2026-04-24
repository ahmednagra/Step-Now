<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobCountry;

class JobCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    JobCountry::firstOrCreate(['name' => 'Pakistan']);
    JobCountry::firstOrCreate(['name' => 'India']);
    JobCountry::firstOrCreate(['name' => 'USA']);
    }
}
