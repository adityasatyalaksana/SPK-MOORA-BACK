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
        Schema::create('biayas', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke Terminal (Start & End)
            $table->foreignId('start_terminal_id')->constrained('terminals')->onDelete('cascade');
            $table->foreignId('end_terminal_id')->constrained('terminals')->onDelete('cascade');
            
            $table->string('nama_armada'); 
            $table->integer('estimasi_perjalanan'); // Dalam satuan Jam
            $table->integer('harga_pp'); // Harga normal
            
            // Kolom untuk fitur harga periode (boleh kosong/nullable)
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('harga_periode')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biayas');
    }
};
