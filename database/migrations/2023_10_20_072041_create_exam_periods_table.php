<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_periods', function (Blueprint $table) {
            $table->id();
            $table->string('period_name');
            $table->timestamps();
        });

        // Auto-fill the 'period_name' column
        DB::table('exam_periods')->insert([
            ['period_name' => 'Prelims'],
            ['period_name' => 'Midterms'],
            ['period_name' => 'Pre-Finals'],
            ['period_name' => 'Finals'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_periods');
    }
};
