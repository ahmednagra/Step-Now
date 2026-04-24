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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->onDelete('cascade');  // Relating to a group
            $table->string('image')->nullable();      // file
            $table->string('title');                   // {"en": "jladflaj <span> ", "ar": "عنوان الميزة"}
            $table->string('subtitle')->nullable();    // {"en": "Feature Subtitle", "ar": "العنوان الفرعي للميزة"}
            $table->text('description')->nullable(); // {"en": "Description about the feature", "ar": "الوصف حول الميزة"}
            $table->integer('order_no')->default(0); // To sort features in a particular order
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
