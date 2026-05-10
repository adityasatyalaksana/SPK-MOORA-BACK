<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    // Pastikan properti fillable sudah ada
    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'bobot', 'jenis'];

    /**
     * Relasi ke SubKriteria (Satu Kriteria memiliki banyak Sub-Kriteria)
     */
    public function subKriterias()
    {
        // Gunakan hasMany karena satu kriteria utama punya banyak pilihan nilai sub
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }
}