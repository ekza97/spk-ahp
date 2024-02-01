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
        Schema::create('priority_vektor_alternatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->nullable()->constrained('alternatifs')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('kriteria_id')->nullable()->constrained('kriterias')->cascadeOnUpdate()->nullOnDelete();
            $table->double('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priority_vektor_alternatif');
    }
};
