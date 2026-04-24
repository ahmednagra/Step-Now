<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Settings — authoritative business data.
 *
 * Source: Gewerbe-Anmeldung GewA 1 dated 28.10.2025, registered at
 * Bürgermeisteramt Deizisau on 05.11.2025.
 * Handelsregister: HRA 742905, Amtsgericht Stuttgart.
 *
 * Phone number on file with the Gewerbeamt: 0159 01228856
 * (= +49 159 01228856, German mobile, O2 network).
 */
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

                // Contact — matches Gewerbeanmeldung + confirmed domain
                'phone_no'          => '+49 159 01228856',
                'phone_no_2'        => null,
                'whatsapp_no'       => '+49 159 01228856',
                'email'             => 'info@step-now.de',
                'address'           => 'Blumenstraße 8, 73779 Deizisau',
                'setting_profile'   => null,

                // Social media — all null per business decision
                // (replace with real URLs once accounts are created)
                'fb_link'           => null,
                'insta_link'        => null,
                'yt_link'           => null,
                'tiktok_link'       => null,
                'linkedin_link'     => null,
                'telegram_link'     => null,
                'whatsapp_link'     => 'https://wa.me/4915901228856',

                'created_at'        => '2025-11-12 06:24:52',
                'updated_at'        => now(),
            ]
        );
    }
}
