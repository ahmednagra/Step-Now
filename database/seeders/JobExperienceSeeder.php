<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           {
        DB::table('job_experiences')->insert([
            ['title' => 'Intern', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Junior', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Mid Level', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Senior', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Lead', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
    }
}
