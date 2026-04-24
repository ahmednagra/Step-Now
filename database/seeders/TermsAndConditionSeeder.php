<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TermsAndCondition; 

class TermsAndConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             TermsAndCondition::create(
        [
            'title' => 'Full Time',
    'description' => 'Terms and  Condition  ',

    ]);


    }
}
