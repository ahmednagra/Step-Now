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
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->text('description'); 
            $table->string('icon');
            $table->unsignedInteger('order_no')->default(0);
            $table->string('banner_image')->nullable();
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->enum('isfeature', ['featured', 'unfeatured'])->default('featured');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('font_awesome_icon')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
