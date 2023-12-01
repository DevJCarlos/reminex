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
        Schema::create('irreg_student_subs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('irreg_students_id')->nullable()->default(null);
            $table->string('student_subject')->nullable()->default(null);
            $table->string('subject_instructor')->nullable()->default(null);
            $table->string('subject_section')->nullable()->default(null);
            $table->string('code')->nullable()->default(null);
            $table->timestamps();


            $table->foreign('irreg_students_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irreg_student_subs');
    }
};
