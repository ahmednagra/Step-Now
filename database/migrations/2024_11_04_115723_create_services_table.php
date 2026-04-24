<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained('service_categories', 'id');
            $table->string('name'); // Change to JSON
            $table->string('slug');
            $table->string('order_no');
            $table->enum('status', ['publish', 'draft']);
            $table->enum('isfeature', ['featured', 'unfeatured'])->default('featured');
            $table->string('font_awesome_icon')->nullable();
            $table->string('service_title');  
            $table->string('service_subtitle'); 

            $table->string('banner_title'); // Change to JSON
            $table->string('banner_subtitle'); // Change to JSON
            $table->string('thumbnail');
            $table->string('icon')->nullable();
            $table->string('banner_image');
            $table->text('short_description'); // Change to JSON
            $table->text('description'); // Change to JSON
            $table->text('other_description')->nullable(); // Change to JSON
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};