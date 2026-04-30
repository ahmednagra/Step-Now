<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds bilingual (English) columns to all content tables.
 *
 * Pattern follows the existing `policies` table convention:
 *   - German columns remain authoritative (legal requirement for DE business)
 *   - English columns are nullable; empty/null falls back to German
 *   - Single-row reads, no JOIN tables, no third-party packages
 *
 * Tables touched:
 *   sliders, info_blocks, info_block_features,
 *   why_choose_us_sections, why_choose_us_details,
 *   testimonial_sections, testimonial_details,
 *   faq_sections, faq_details,
 *   package_categories, packages, package_details
 */
return new class extends Migration
{
    public function up(): void
    {
        // ---------- sliders ----------
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('sub_title_en')->nullable()->after('sub_title');
            $table->string('button_title_en')->nullable()->after('button_title');
        });

        // ---------- info_blocks (about us) ----------
        Schema::table('info_blocks', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description2_en')->nullable()->after('description2');
            $table->string('text1_en')->nullable()->after('text1');
        });

        // ---------- info_block_features ----------
        if (Schema::hasTable('info_block_features')) {
            Schema::table('info_block_features', function (Blueprint $table) {
                $table->string('title_en')->nullable()->after('title');
                $table->text('description_en')->nullable()->after('description');
            });
        }

        // ---------- why_choose_us_sections ----------
        Schema::table('why_choose_us_sections', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
            $table->text('description_en')->nullable()->after('description');
        });

        // ---------- why_choose_us_details ----------
        if (Schema::hasTable('why_choose_us_details')) {
            Schema::table('why_choose_us_details', function (Blueprint $table) {
                $table->string('title_en')->nullable()->after('title');
                $table->text('description_en')->nullable()->after('description');
            });
        }

        // ---------- testimonial_sections ----------
        Schema::table('testimonial_sections', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
            $table->text('description_en')->nullable()->after('description');
        });

        // ---------- testimonial_details ----------
        Schema::table('testimonial_details', function (Blueprint $table) {
            $table->string('designation_en')->nullable()->after('designation');
            $table->text('feedback_en')->nullable()->after('feedback');
        });

        // ---------- faq_sections ----------
        Schema::table('faq_sections', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
            $table->text('description_en')->nullable()->after('description');
        });

        // ---------- faq_details ----------
        Schema::table('faq_details', function (Blueprint $table) {
            $table->string('question_en')->nullable()->after('question');
            $table->text('answer_en')->nullable()->after('answer');
        });

        // ---------- package_categories ----------
        Schema::table('package_categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('title_en')->nullable()->after('title');
            $table->string('sub_title_en')->nullable()->after('sub_title');
            $table->text('description_en')->nullable()->after('description');
        });

        // ---------- packages ----------
        Schema::table('packages', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('destination_en')->nullable()->after('destination');
            $table->string('subtitle_en')->nullable()->after('subtitle');
        });

        // ---------- package_details ----------
        if (Schema::hasTable('package_details')) {
            Schema::table('package_details', function (Blueprint $table) {
                $table->string('title_en')->nullable()->after('title');
            });
        }
    }

    public function down(): void
    {
        Schema::table('sliders', fn (Blueprint $t) => $t->dropColumn(['title_en', 'sub_title_en', 'button_title_en']));
        Schema::table('info_blocks', fn (Blueprint $t) => $t->dropColumn(['title_en', 'subtitle_en', 'description_en', 'description2_en', 'text1_en']));

        if (Schema::hasTable('info_block_features')) {
            Schema::table('info_block_features', fn (Blueprint $t) => $t->dropColumn(['title_en', 'description_en']));
        }

        Schema::table('why_choose_us_sections', fn (Blueprint $t) => $t->dropColumn(['title_en', 'subtitle_en', 'description_en']));

        if (Schema::hasTable('why_choose_us_details')) {
            Schema::table('why_choose_us_details', fn (Blueprint $t) => $t->dropColumn(['title_en', 'description_en']));
        }

        Schema::table('testimonial_sections', fn (Blueprint $t) => $t->dropColumn(['title_en', 'subtitle_en', 'description_en']));
        Schema::table('testimonial_details', fn (Blueprint $t) => $t->dropColumn(['designation_en', 'feedback_en']));
        Schema::table('faq_sections', fn (Blueprint $t) => $t->dropColumn(['title_en', 'subtitle_en', 'description_en']));
        Schema::table('faq_details', fn (Blueprint $t) => $t->dropColumn(['question_en', 'answer_en']));
        Schema::table('package_categories', fn (Blueprint $t) => $t->dropColumn(['name_en', 'title_en', 'sub_title_en', 'description_en']));
        Schema::table('packages', fn (Blueprint $t) => $t->dropColumn(['title_en', 'destination_en', 'subtitle_en']));

        if (Schema::hasTable('package_details')) {
            Schema::table('package_details', fn (Blueprint $t) => $t->dropColumn(['title_en']));
        }
    }
};
