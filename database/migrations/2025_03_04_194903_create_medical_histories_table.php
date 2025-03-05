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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->constrained();
            $table->string('patient_type');
            $table->unsignedBigInteger('type_id'); // Clave foránea a la tabla de tipos de antecedentes
            $table->longText('description');
            $table->date('diagnosis_date')->nullable();
            $table->string('related_medications')->nullable(); // JSON o texto separado por comas
            $table->string('related_allergies')->nullable(); // JSON o texto separado por comas
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types_backgrounds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};