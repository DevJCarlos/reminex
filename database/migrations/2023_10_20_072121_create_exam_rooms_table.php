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
        Schema::create('exam_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_period_ID')->nullable()->default(null); // Foreign key reference to ExamTime
            $table->unsignedBigInteger('exam_day_ID')->nullable()->default(null);
            $table->string('room_name')->nullable()->default(null);
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
        Schema::dropIfExists('exam_rooms');
    }
};
