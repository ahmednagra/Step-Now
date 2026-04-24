<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faq_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_section_id')->constrained('faq_sections')->onDelete('cascade');
            $table->text('question');
            $table->text('answer');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_details');
    }
};
