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
        Schema::create('exam_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_period_ID');
            $table->string('day_num');
            $table->date('date');
            $table->timestamps();

            $table->foreign('exam_period_ID')
            ->references('id')
            ->on('exam_periods')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_days');
    }
};
