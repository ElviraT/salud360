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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('marital_id');
            $table->unsignedBigInteger('sexes_id');
            $table->string('ocupation')->nullable();
            $table->date('Date_of_birth');
            $table->string('dni')->unique();
            $table->string('phone');
            $table->string('address');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('marital_id')->references('id')->on('marital_statuses');
            $table->foreign('sexes_id')->references('id')->on('sexes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};