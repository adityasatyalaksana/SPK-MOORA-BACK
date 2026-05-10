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
        Schema::table('penilaians', function (Blueprint $table) {
            // Menambahkan kolom biaya_id setelah jalur_id agar bisa memilih bus secara manual
            $table->unsignedBigInteger('biaya_id')->nullable()->after('jalur_id');
            
            // Membuat relasi ke tabel biayas agar data armada sinkron
            $table->foreign('biaya_id')->references('id')->on('biayas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->dropForeign(['biaya_id']);
            $table->dropColumn('biaya_id');
        });
    }
};
