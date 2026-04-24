<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('why_choose_us_section_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('why_choose_us_section_id')->constrained('why_choose_us_sections')->onDelete('cascade');
            $table->string('icon');
            $table->string('title');
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_us_details');
    }
};
