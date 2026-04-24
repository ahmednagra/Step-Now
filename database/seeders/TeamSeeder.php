<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'Zameer Hassan',
            'photo' => 'uploads/team/zameer.jpg',
            'designation' => 'Full Stack Developer',
            'order_no' => 1,
            'status' => 'active',
        ]);

        Team::create([
            'name' => 'Ahmed Raza',
            'photo' => 'uploads/team/ahmed.jpg',
            'designation' => 'UI/UX Designer',
            'order_no' => 2,
            'status' => 'inactive',
        ]);

    }

    }

