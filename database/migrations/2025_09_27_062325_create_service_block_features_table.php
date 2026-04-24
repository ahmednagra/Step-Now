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
        Schema::create('service_block_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_block_id')->constrained('service_blocks')->onDelete('cascade');
            $table->string('title');         
            $table->integer('order_no')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_block_features');
    }
};
