<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terminal;
use App\Models\Jalur;

class RekomendasiController extends Controller
{
    public function index()
    {
        $terminals = Terminal::where('tipe', 'Starting Point')->get();
        return view('pendaki.rekomendasi.index', compact('terminals'));
    }

    public function proses(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'budget' => 'required|numeric',
            'jumlah_anggota' => 'required|numeric|min:1',
            'terminal_id' => 'required'
        ]);

        // 2. Ambil data terminal terpilih
        $terminal = Terminal::find($request->terminal_id);
        $nama_terminal = $terminal ? $terminal->nama_terminal : 'N/A';

        // 3. Ambil semua jalur beserta relasi gunung dan biayas
        // Pastikan model Jalur memiliki relasi 'gunung' dan 'biayas'
        $semuaJalur = Jalur::with(['gunung', 'biayas'])->get();
        
        $rekomendasi = [];

        // 4. Logika Filter & Sinkronisasi Data Dinamis
        foreach ($semuaJalur as $jalur) {
            // Cari biaya yang start_terminal_id-nya cocok dengan pilihan user
            $biayaBus = $jalur->biayas->where('start_terminal_id', $request->terminal_id)->first();

            if ($biayaBus) {
                // Tentukan harga transport (mengutamakan harga_periode jika ada)
                $hargaTransport = $biayaBus->harga_periode ?? $biayaBus->harga_pp;
                $hargaSimaksi = $jalur->biaya_simaksi;
        
                // Total untuk seluruh anggota kelompok
                $totalEstimasi = ($hargaTransport + $hargaSimaksi) * $request->jumlah_anggota;
        
                // Cek budget
                if ($totalEstimasi <= $request->budget) {
                    // --- PROSES SINKRONISASI DATA KE VIEW ---
                    
                    // Ambil End Point (Nama Terminal Tujuan) dari relasi di tabel biayas
                    // Asumsi: biayas memiliki end_terminal_id yang berelasi ke Terminal
                    $terminalTujuan = Terminal::find($biayaBus->end_terminal_id);
                    $jalur->nama_terminal_tujuan = $terminalTujuan->nama_terminal ?? '-';

                    // Sinkronisasi data biaya dan armada
                    $jalur->nama_armada = $biayaBus->nama_armada;
                    $jalur->harga_pp = $hargaTransport;
                    $jalur->estimasi_perjalanan = $biayaBus->estimasi_perjalanan; // Menghilangkan ikon kosong
                    
                    // Perhitungan Biaya
                    $jalur->biaya_per_orang = $hargaTransport + $hargaSimaksi;
                    $jalur->total_dana_kelompok = $totalEstimasi;

                    $rekomendasi[] = $jalur;
                }
            }
        }

        // 5. Kirim ke view dengan data yang sudah lengkap
        return view('pendaki.rekomendasi.pilihan', [
            'rekomendasi'   => $rekomendasi,
            'input'         => $request->all(),
            'nama_terminal' => $nama_terminal
        ]);
    }
}