<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaians';
    protected $fillable = ['jalur_id', 'biaya_id', 'kriteria_id', 'nilai'];

    public function jalur() { return $this->belongsTo(Jalur::class, 'jalur_id'); }
    public function biaya() { return $this->belongsTo(Biaya::class, 'biaya_id'); }
    public function kriteria() { return $this->belongsTo(Kriteria::class, 'kriteria_id'); }
}