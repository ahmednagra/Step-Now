<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Settings — authoritative business data.
 *
 * Source of truth: Gewerbe-Anmeldung GewA 1 dated 28.10.2025, registered at
 * Bürgermeisteramt Deizisau on 05.11.2025.
 * Handelsregister: HRA 742905, Amtsgericht Stuttgart.
 *
 * Phone number on file with the Gewerbeamt: 0159 01228856
 * (= +49 159 01228856, German mobile, O2 network).
 *
 * IMPORTANT: the live website previously displayed +49 71539292841 which
 * does NOT match the Gewerbeanmeldung. § 5 DDG requires the contact data
 * in the Impressum to be accurate; therefore this seeder is the canonical
 * source and overwrites the existing row on every run.
 *
 * This seeder uses updateOrInsert(['id' => 1], ...) so re-running it in
 * production will reset the row to the values below. If you change the
 * phone number, address, or e-mail in the admin UI, also update this file
 * to keep them in sync.
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

                // Contact — matches Gewerbeanmeldung (28.10.2025) and Impressum
                'phone_no'          => '+49 159 01228856',
                'phone_no_2'        => null,
                'whatsapp_no'       => '+49 159 01228856',
                'email'             => 'info@step-now.de',
                'address'           => 'Blumenstraße 8, 73779 Deizisau',
                'setting_profile'   => null,

                // Social media — currently not in use; populated via admin UI
                // once accounts are created. The Datenschutzerklärung must be
                // extended (Plugin-Hinweise) before any social plugin goes live.
                'fb_link'           => null,
                'insta_link'        => null,
                'yt_link'           => null,
                'tiktok_link'       => null,
                'linkedin_link'     => null,
                'telegram_link'     => null,
                // wa.me link kept; the live frontend will gate it behind the
                // cookie banner so no IP leaks to Meta before consent.
                'whatsapp_link'     => 'https://wa.me/4915901228856',

                'created_at'        => '2025-11-12 06:24:52',
                'updated_at'        => now(),
            ]
        );
    }
}
