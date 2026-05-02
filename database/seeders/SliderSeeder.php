<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $nl = chr(10);

        $titleDe = '[hl]TAXI-Alternative[/hl]' . $nl . '- StepNow Rides';
        $titleEn = '[hl]Taxi alternative[/hl]' . $nl . '- StepNow Rides';

        $subTitleDe = 'Mit StepNow sicher und pünktlich ans Ziel - Ihr Mobilitätspartner vor Ort';
        $subTitleEn = 'Reach your destination safely and on time with StepNow — your local mobility partner';

        $btnTitleDe = 'Buchungen folgen in Kürze';
        $btnTitleEn = 'Bookings opening shortly';

        $payload = [
            'title'        => $titleDe,
            'sub_title'    => $subTitleDe,
            'image'        => 'assets/admin/img/slider/17770495871521290459.webp',
            'button_title' => $btnTitleDe,
            'button_url'   => 'https://step-now.de/#bookingForm',
            'serial_no'    => 1,
            'status'       => 1,
            'created_at'   => '2026-04-24 11:53:07',
            'updated_at'   => now(),
        ];

        if (Schema::hasColumn('sliders', 'title_en')) {
            $payload['title_en'] = $titleEn;
        }
        if (Schema::hasColumn('sliders', 'sub_title_en')) {
            $payload['sub_title_en'] = $subTitleEn;
        }
        if (Schema::hasColumn('sliders', 'button_title_en')) {
            $payload['button_title_en'] = $btnTitleEn;
        }

        DB::table('sliders')->updateOrInsert(
            ['id' => 3],
            $payload
        );
    }
}