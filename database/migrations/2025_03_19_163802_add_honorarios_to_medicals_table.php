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
        Schema::table('doctors', function (Blueprint $table) {
            $table->decimal('video', 10, 2)->nullable()->after('bio');
            $table->decimal('domicile', 10, 2)->nullable()->after('video');
            $table->decimal('emergency', 10, 2)->nullable()->after('domicile');
            $table->decimal('Face', 10, 2)->nullable()->after('emergency');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            //
        });
    }
};
