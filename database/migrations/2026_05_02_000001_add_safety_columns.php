<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * 2026-05-02 — bilingual safety surgery
 *
 * Adds:
 *   1. site_banners table for the soft-launch / safety ribbon. Editable
 *      by admins so legal copy can be toggled without a code change.
 *   2. settings.phone_e164 + settings.whatsapp_e164 — canonical E.164
 *      phone numbers for tel: links so iOS dialler always works.
 *
 * Idempotent (uses Schema::hasTable / Schema::hasColumn guards), so it
 * is safe to re-run if a previous deployment partially completed.
 */
return new class extends Migration {

    public function up(): void
    {
        // --- 1. site_banners ------------------------------------------------
        if (!Schema::hasTable('site_banners')) {
            Schema::create('site_banners', function (Blueprint $t) {
                $t->id();
                $t->string('key_name', 64)->unique();
                $t->boolean('enabled')->default(false);
                $t->enum('severity', ['info', 'warning', 'success'])->default('info');
                $t->text('message_de');
                $t->text('message_en');
                $t->string('cta_label_de', 120)->nullable();
                $t->string('cta_label_en', 120)->nullable();
                $t->string('cta_url', 255)->nullable();
                $t->timestamps();
                $t->index('enabled', 'site_banners_enabled_idx');
            });

            DB::table('site_banners')->insert([
                'key_name'     => 'soft_launch',
                'enabled'      => 1,
                'severity'     => 'info',
                'message_de'   => 'Hinweis: Wir nehmen aktuell unverbindliche Anfragen entgegen. Die Bestätigung Ihrer Buchung erfolgt persönlich durch unser Team.',
                'message_en'   => 'Note: We are currently accepting non-binding requests. Your booking will be confirmed personally by our team.',
                'cta_label_de' => 'Anfrage senden',
                'cta_label_en' => 'Send request',
                'cta_url'      => '/contact-us',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        // --- 2. settings.phone_e164 + whatsapp_e164 ------------------------
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $t) {
                if (!Schema::hasColumn('settings', 'phone_e164')) {
                    $t->string('phone_e164', 20)->nullable()->after('phone_no_2');
                }
                if (!Schema::hasColumn('settings', 'whatsapp_e164')) {
                    $t->string('whatsapp_e164', 20)->nullable()->after('whatsapp_no');
                }
            });

            // Backfill the singleton row
            DB::table('settings')->where('id', 1)->update([
                'phone_e164'    => '+4915901228856',
                'whatsapp_e164' => '+4915901228856',
                'updated_at'    => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $t) {
                foreach (['phone_e164', 'whatsapp_e164'] as $col) {
                    if (Schema::hasColumn('settings', $col)) {
                        $t->dropColumn($col);
                    }
                }
            });
        }

        Schema::dropIfExists('site_banners');
    }
};
