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
        Schema::create('exam_times', function (Blueprint $table) {
            $table->id();
            $table->string('exam_time');
            $table->unsignedBigInteger('exam_day_ID');
            $table->timestamps();

            $table->foreign('exam_day_ID')
            ->references('id')
            ->on('exam_days')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_times');
    }
};
