<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrivacyPolicy; 

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                PrivacyPolicy::create(
            [
                'title' => 'Privacy Policy ',
        'description' => 'Cookies accept or not accept',

        ]);


    }
}
