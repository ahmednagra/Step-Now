<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IndustryJob;

class IndustryJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        // Example industries
        IndustryJob::create([
            'name'         => 'Information Technology',
            'icon'         => 'icons/it.png',
            'introduction' => 'Industry focusing on software, hardware, and IT services.',
            'order_no'     => 1,
        ]);

        IndustryJob::create([
            'name'         => 'Healthcare',
            'icon'         => 'icons/healthcare.png',
            'introduction' => 'Industry providing medical services and products.',
            'order_no'     => 2,
        ]);

        IndustryJob::create([
            'name'         => 'Finance',
            'icon'         => 'icons/finance.png',
            'introduction' => 'Industry that manages money, banking, and investments.',
            'order_no'     => 3,
        ]);

        IndustryJob::create([
            'name'         => 'Education',
            'icon'         => null, // icon optional
            'introduction' => 'Industry focusing on learning, training, and academic institutions.',
            'order_no'     => 4,
        ]);
    }
    
}
