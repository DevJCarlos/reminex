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
        Schema::create('exam_proctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_section_ID')->nullable()->default(null); // Foreign key reference to ExamSection
            $table->string('proc_name')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('exam_section_ID')
            ->references('id')
            ->on('exam_sections')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_proctors');
    }
};
