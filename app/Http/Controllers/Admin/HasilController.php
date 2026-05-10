<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Jalur;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $jalurs = Jalur::all();
        $penilaians = Penilaian::with(['jalur', 'kriteria'])->get();

        if ($kriterias->isEmpty() || $penilaians->isEmpty()) {
            return view('admin.hasil.index', ['hasil' => [], 'matriks' => [], 'terbobot' => []]);
        }

        // 1. Matriks Keputusan & Pembagi
        $matriks = [];
        $pembagi = [];
        foreach ($kriterias as $k) {
            $sumKuadrat = 0;
            foreach ($jalurs as $j) {
                $nilai = $penilaians->where('jalur_id', $j->id)->where('kriteria_id', $k->id)->first()->nilai ?? 0;
                $matriks[$j->nama_jalur][$k->nama_kriteria] = $nilai;
                $sumKuadrat += pow($nilai, 2);
            }
            $pembagi[$k->id] = $sumKuadrat > 0 ? sqrt($sumKuadrat) : 1;
        }

        // 2. Normalisasi & Terbobot
        $terbobot = [];
        $hasil = [];
        foreach ($jalurs as $j) {
            $max = 0;
            $min = 0;
            foreach ($kriterias as $k) {
                $nilaiAsli = $matriks[$j->nama_jalur][$k->nama_kriteria] ?? 0;
                $norm = $nilaiAsli / $pembagi[$k->id];
                $nilaiBobot = $norm * ($k->bobot ?? 0);
                
                $terbobot[$j->nama_jalur][$k->nama_kriteria] = $nilaiBobot;

                if ($k->tipe == 'Benefit') {
                    $max += $nilaiBobot;
                } else {
                    $min += $nilaiBobot;
                }
            }

            $hasil[] = [
                'jalur' => $j->nama_jalur,
                'max' => $max,
                'min' => $min,
                'skor' => $max - $min
            ];
        }

        // Urutkan Ranking
        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);

        return view('admin.hasil.index', compact('kriterias', 'matriks', 'terbobot', 'hasil'));
    }
}