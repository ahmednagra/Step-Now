<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobType;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          {
        JobType::create(['title' => 'Full Time']);
        JobType::create(['title' => 'Part Time']);
        JobType::create(['title' => 'Contract']);
        JobType::create(['title' => 'Internship']);
        JobType::create(['title' => 'Remote']);
    }
    }
}
