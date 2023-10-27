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
        Schema::create('exam_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_subject_ID')->nullable()->default(null);
            $table->string('section_name')->nullable()->default(null);
            $table->string('class_num')->nullable()->default(null);
            $table->string('Instructor')->nullable()->default(null);
            $table->string('class_count')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('exam_subject_ID')
            ->references('id')
            ->on('exam_subjects')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sections');
    }
};
