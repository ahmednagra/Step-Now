<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Bilingual policies — adds optional English translation columns.
 *
 * Schema decision: parallel columns (description_en, page_title_en) instead
 * of a separate translations pivot table. Reasons:
 *   - Only 5 rows total, only 2 languages, no plans for more
 *   - Keeps reads single-row (no JOIN), keeps the seeder readable
 *   - German remains authoritative — `description` is the legal text;
 *     `description_en` is a courtesy translation that falls back to German
 *     when empty.
 *
 * The PolicyController picks the EN column when locale === 'en' AND the
 * column has content; otherwise it serves the German row. So leaving
 * description_en NULL on a row is a valid "this page is German-only" signal.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->string('page_title_en')->nullable()->after('page_title');
            $table->text('description_en')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn(['page_title_en', 'description_en']);
        });
    }
};
