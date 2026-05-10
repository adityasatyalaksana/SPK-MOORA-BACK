<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    use HasFactory;

    protected $fillable = [
        'gunung_id', 
        'nama_jalur', 
        'biaya_simaksi', 
        'estimasi_jam', 
        'tingkat_kesulitan'
    ];

    // Relasi ke Gunung
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'gunung_id');
    }

    // Relasi ke Biaya (Penting agar data Terminal & Harga muncul di Penilaian)
    public function biayas()
    {
        return $this->hasMany(Biaya::class, 'jalur_id');
    }
}