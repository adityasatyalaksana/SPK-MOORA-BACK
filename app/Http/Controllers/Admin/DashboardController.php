<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gunung;
use App\Models\Jalur;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_gunung'   => Gunung::count(),
            'total_jalur'    => Jalur::count(),
            'total_kriteria' => Kriteria::count(),
            'total_user'     => \App\Models\User::count(),
        ];

        // Ambil data untuk grafik perbandingan kriteria
        $kriterias = Kriteria::select('nama_kriteria', 'bobot')->get();
        $chartLabels = $kriterias->pluck('nama_kriteria');
        $chartWeights = $kriterias->pluck('bobot');

        return view('admin.dashboard.index', compact('data', 'chartLabels', 'chartWeights'));
    }
}