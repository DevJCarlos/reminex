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
        Schema::create('exam_scheds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('period_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('room_id');
            $table->string('student_count');
            $table->string('proctor');
            $table->string('education_level');
            $table->timestamps();

            $table->foreign('period_id')
                ->references('id')
                ->on('periods');
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
            $table->foreign('section_id')
                ->references('id')
                ->on('sections');
            $table->foreign('room_id') 
                ->references('id')
                ->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_scheds');
    }
};
