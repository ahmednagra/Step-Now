<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('jcategory_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('position')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('vacancy')->nullable();
            $table->string('deadline')->nullable();
            $table->string('employment_status')->nullable();
            $table->text('job_location')->nullable();
            $table->text('salary')->nullable();
            $table->text('other_benefits')->nullable();
            $table->string('email')->nullable();
            $table->text('job_responsibility')->nullable();
            $table->text('education_requirement')->nullable();
            $table->text('job_context')->nullable();
            $table->text('experience_requirement')->nullable();
            $table->text('additional_requirement')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('serial_number')->default(0);
            $table->string('thumbnail_img')->nullable();
            $table->string('banner_img')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
