<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->updateOrInsert(
            ['id' => 1],
            [
                'logo'              => 'assets/admin/uploads/setting/logo/17770514871216789054.png',
                'home_beadcrum_img' => 'uploads/home_breadcrumb.jpg',
                'footer_logo'       => 'assets/admin/uploads/setting/footer_logo/17770514871789902461.webp',
                'fav_icon'          => 'assets/admin/uploads/setting/fav_icon/1777051487973307463.webp',
                'phone_no'          => '+49 71539292841',
                'phone_no_2'        => '+49 15511544731',
                'whatsapp_no'       => '+49 15511544731',
                'email'             => 'info@step-now.de',
                'address'           => 'Blumenstraße 8, 73779 Deizisau',
                'setting_profile'   => null,
                'fb_link'           => 'https://facebook.com/example',
                'insta_link'        => 'https://instagram.com/example',
                'yt_link'           => 'https://youtube.com/example',
                'tiktok_link'       => 'https://tiktok.com/@example',
                'linkedin_link'     => null,
                'telegram_link'     => null,
                'whatsapp_link'     => 'https://wa.me/+97150406786',
                'created_at'        => '2025-11-12 06:24:52',
                'updated_at'        => now(),
            ]
        );
    }
}
