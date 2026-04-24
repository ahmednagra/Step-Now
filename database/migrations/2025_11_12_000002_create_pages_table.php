<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_category_id')->constrained('page_categories');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_sub_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('hero_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published')->index();
            $table->enum('type', ['website', 'marketing', 'seo', 'whatsapp-Marketing'])->index();
            $table->string('route_name')->nullable()->index();
            $table->enum('page_link_for', ['header', 'footer', 'services', 'none']);
            $table->integer('order_no')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
