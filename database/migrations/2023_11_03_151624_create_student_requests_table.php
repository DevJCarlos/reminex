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
        Schema::create('student_requests', function (Blueprint $table) {
            $table->id();
            $table->string('stud_name');
            $table->string('department');
            $table->string('request_type');
            $table->string('subject');
            $table->string('instructor');
            $table->longtext('reason');
            $table->string('time_available');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('status');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_requests');
    }
};
