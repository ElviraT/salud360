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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('doctor_id');
            $table->time('start_hour');
            $table->time('end_hour');
            $table->timestamps();

            $table->foreign('day_id')->references('id')->on('days');
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->unique(['day_id', 'start_hour', 'end_hour']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shedules');
    }
};