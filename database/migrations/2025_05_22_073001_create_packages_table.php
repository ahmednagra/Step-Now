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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_category_id')->references('id')->on('package_categories');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('icon')->nullable(); // store icon class or image path
            $table->decimal('amount', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->decimal('discounted_amount', 10, 2)->nullable();
            $table->string('currency_symbol')->default('€');
            $table->string('destination');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->enum('publish', ['draft', 'published'])->default('draft');
            $table->integer('order_no')->default(0);
            $table->softDeletes(); // for soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
