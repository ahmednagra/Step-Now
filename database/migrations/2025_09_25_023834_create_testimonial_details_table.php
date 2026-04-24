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
        Schema::create('testimonial_details', function (Blueprint $table) {
            $table->id();
                        $table->foreignId('testimonial_section_id')->constrained('testimonial_sections')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('designation')->nullable();
            $table->text('feedback');
            $table->tinyInteger('rating')->default(5); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial_details');
    }
};
