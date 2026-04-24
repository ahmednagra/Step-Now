<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('hostName');
            $table->string('topic');
            $table->date('meeting_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('meetingLink');
            $table->string('banner');
            $table->text('detail')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('order_no')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};
