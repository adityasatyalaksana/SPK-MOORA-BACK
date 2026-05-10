<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gunung extends Model
{
    use HasFactory;

    protected $fillable = ['nama_gunung', 'lokasi', 'ketinggian', 'deskripsi', 'gambar'];

    protected $casts = [
        'gambar' => 'array',
    ];

    // TAMBAHKAN RELASI INI
    public function jalurs()
    {
        // Pastikan di tabel 'jalurs' terdapat kolom 'gunung_id'
        return $this->hasMany(Jalur::class, 'gunung_id');
    }
}