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
        Schema::create('perbandingan_alternatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_one')->nullable()->constrained('alternatifs')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('alternatif_two')->nullable()->constrained('alternatifs')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('kriteria_id')->nullable()->constrained('kriterias')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_alternatif');
    }
};
