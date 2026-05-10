<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_terminal');
            $table->string('lokasi');
            // PASTIKAN BARIS INI ADA
            $table->enum('tipe', ['Starting Point', 'Ending Point']); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terminals');
    }
};