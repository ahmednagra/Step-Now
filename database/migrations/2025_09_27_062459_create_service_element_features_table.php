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
        Schema::create('service_element_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_element_id')->constrained('service_elements')->onDelete('cascade');
            $table->string('title');       
            $table->text('description')->nullable();
            $table->integer('order_no')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_element_features');
    }
};
