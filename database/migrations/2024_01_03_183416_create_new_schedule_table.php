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
        Schema::create('new_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('stud_name2');
            $table->string('period2');
            $table->string('request_type2');
            $table->string('subject2');
            $table->string('instructor2');
            $table->string('exam_day');
            $table->string('exam_time');
            $table->string('exam_time2');
            $table->string('room');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_schedule');
    }
};
