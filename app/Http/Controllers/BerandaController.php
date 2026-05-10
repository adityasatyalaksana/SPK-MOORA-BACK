<?php

namespace App\Http\Controllers;

use App\Models\Gunung; 
use App\Models\Kriteria;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Menampilkan Halaman Utama untuk Pendaki
     * Lokasi File: resources/views/pendaki/beranda/index.blade.php
     */
    public function index() 
    {
        return view('pendaki.beranda.index');
    }

    /**
     * Menampilkan Daftar Gunung dan Detail Jalurnya
     * Lokasi File: resources/views/pendaki/profile/index.blade.php
     */
    public function profile() 
    {
        // Mengambil semua data gunung beserta relasi jalurnya jika ada
        $gunung = Gunung::all(); 
        return view('pendaki.profile.index', compact('gunung'));
    }

    /**
     * Halaman Cari Rekomendasi (Inti dari Metode MOORA)
     * Lokasi File: resources/views/pendaki/rekomendasi/index.blade.php
     */
    public function rekomendasi(Request $request) 
    {
        // Mengambil kriteria untuk ditampilkan sebagai filter/bobot input jika diperlukan
        $kriteria = Kriteria::all();
        $hasil = null;

        // Logika ini akan dijalankan ketika pendaki menekan tombol "Cari/Hitung"
        if ($request->has('hitung')) {
            /** * TODO: Implementasi Algoritma MOORA
             * 1. Ambil Nilai Alternatif (Jalur Gunung)
             * 2. Normalisasi Matriks
             * 3. Optimasi Nilai (Benefit - Cost)
             * 4. Ranking
             */
            
            // Sementara kita set hasil sebagai collection kosong agar tidak error
            $hasil = collect(); 
        }

        return view('pendaki.rekomendasi.index', compact('kriteria', 'hasil'));
    }
}