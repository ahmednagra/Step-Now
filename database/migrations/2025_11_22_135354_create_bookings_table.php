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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('pickup');
            $table->string('destination')->nullable();
            $table->date('booking_date');
            $table->time('booking_time');
            $table->integer('no_of_people');
            $table->text('message')->nullable();
            $table->enum('status', [
                'pending',
                'inprocess',
                'confirmed',
                'canceled',
                'completed'
            ])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
