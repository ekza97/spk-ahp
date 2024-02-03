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
        Schema::create('perbandingan_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_one')->constrained('kriteria')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('kriteria_two')->constrained('kriteria')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('nilai');
            $table->tinyInteger('checked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_kriteria');
    }
};
