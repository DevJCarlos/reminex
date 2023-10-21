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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_name');
            $table->timestamps();
        });

        DB::table('exam_name')->insert([
            ['exam_name' => 'ROOM 201B'],
            ['exam_name' => 'ROOM 202B'],
            ['exam_name' => 'ROOM 203B'],
            ['exam_name' => 'ROOM 204B'],
            ['exam_name' => 'ROOM 205B'],
            ['exam_name' => 'ROOM 206B'],
            ['exam_name' => 'ROOM 207B'],
            ['exam_name' => 'ROOM 208B'],
            ['exam_name' => 'ROOM 209B'],
            ['exam_name' => 'ROOM 210B'],
            ['exam_name' => 'ROOM 211B'],
            ['exam_name' => 'ROOM 301B'],
            ['exam_name' => 'ROOM 302B'],
            ['exam_name' => 'ROOM 303B'],
            ['exam_name' => 'ROOM 304B'],
            ['exam_name' => 'ROOM 305B'],
            ['exam_name' => 'ROOM 306B'],
            ['exam_name' => 'ROOM 307B'],
            ['exam_name' => 'ROOM 308B'],
            ['exam_name' => 'ROOM 309B'],
            ['exam_name' => 'ROOM 310B'],
            ['exam_name' => 'ROOM 311B']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
