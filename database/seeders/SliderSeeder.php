<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sliders')->updateOrInsert(
            ['id' => 3],
            [
                'title'        => "<span class='in'>TAXI-Alternative</span><br> - StepNow Rides",
                'sub_title'    => 'Mit StepNow sicher und pünktlich ans Ziel - Ihr Mobilitätspartner vor Ort',
                'image'        => 'assets/admin/img/slider/17770495871521290459.webp',
                'button_title' => 'Buchungen folgen in Kurze',
                'button_url'   => 'https://step-now.de/#bookingForm',
                'serial_no'    => 1,
                'status'       => 1,
                'created_at'   => '2026-04-24 11:53:07',
                'updated_at'   => '2026-04-24 11:53:07',
            ]
        );
    }
}
