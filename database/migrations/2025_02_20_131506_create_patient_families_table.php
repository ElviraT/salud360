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
        Schema::create('patient_families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('sexes_id');
            $table->unsignedBigInteger('relationship_id');
            $table->string('name');
            $table->string('dni')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->date('Date_of_birth');

            $table->timestamps();

            $table->foreign('sexes_id')->references('id')->on('sexes');
            $table->foreign('relationship_id')->references('id')->on('relationships');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_families');
    }
};