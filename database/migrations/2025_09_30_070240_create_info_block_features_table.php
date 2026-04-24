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
        Schema::create('info_block_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_block_id')->constrained('info_blocks')->onDelete('cascade');
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('info_block_features');
    }
};
