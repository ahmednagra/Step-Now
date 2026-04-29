<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds the Double-Opt-In (DOI) fields the BGH requires for German
 * newsletter sign-up under § 7 UWG. Without these, every newsletter
 * sent to an address that has not confirmed the subscription is
 * unsolicited commercial communication and a textbook Abmahn-trigger.
 *
 * Columns:
 *   confirmation_token — random 64-char token, sent in the DOI mail
 *   confirmed_at       — set to now() once the user clicks the DOI link
 *   ip_address         — IP at time of sign-up, kept for proof of consent
 *   user_agent         — UA string at time of sign-up, kept for proof
 *
 * Until confirmed_at IS NOT NULL, the row is a *pending* subscription
 * and MUST NOT receive any newsletter mail.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->string('confirmation_token', 64)->nullable()->after('email');
            $table->timestamp('confirmed_at')->nullable()->after('confirmation_token');
            $table->string('ip_address', 45)->nullable()->after('confirmed_at');
            $table->string('user_agent', 512)->nullable()->after('ip_address');
        });
    }

    public function down(): void
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->dropColumn(['confirmation_token', 'confirmed_at', 'ip_address', 'user_agent']);
        });
    }
};
