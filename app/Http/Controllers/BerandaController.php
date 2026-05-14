<?php

namespace App\Http\Controllers;

use App\Models\Gunung; 
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Menampilkan Halaman Utama untuk Pendaki
     */
    public function index() 
    {
        return view('pendaki.beranda.index');
    }

    /**
     * Menampilkan Daftar Gunung dan Detail Jalurnya
     */
    public function profile() 
    {
        // Mengambil semua data gunung beserta relasi jalurnya jika ada
        $gunung = Gunung::all(); 
        return view('pendaki.profile.index', compact('gunung'));
    }

    // Fungsi rekomendasi() DIHAPUS dari sini karena sudah pindah ke RekomendasiController
}