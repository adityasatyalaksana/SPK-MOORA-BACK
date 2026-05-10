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
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria'); // Contoh: C1, C2, C3
            $table->string('nama_kriteria'); // Contoh: Biaya, Estimasi Waktu
            $table->enum('tipe', ['Benefit', 'Cost']); // Benefit = makin besar makin bagus, Cost = makin kecil makin bagus
            $table->decimal('bobot', 5, 2); // Contoh: 0.25 atau 25.00
            $table->timestamps();
        });
    }   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
