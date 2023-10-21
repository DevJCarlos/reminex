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
        Schema::create('exam_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_time_ID'); // Foreign key reference to ExamTime
            $table->string('subject_name');
            $table->timestamps();

            $table->foreign('exam_time_id')
            ->references('id')
            ->on('exam_times')
            ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_subjects');
    }
};
