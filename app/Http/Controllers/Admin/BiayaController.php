<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Terminal;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function index()
    {
        $biayas = Biaya::with(['start_terminal', 'end_terminal'])->latest()->get();
        $startPoints = Terminal::where('tipe', 'Starting Point')->get();
        $endPoints = Terminal::where('tipe', 'Ending Point')->get();

        return view('admin.biaya.index', compact('biayas', 'startPoints', 'endPoints'));
    }

    // PASTIKAN BAGIAN INI ADA
    public function store(Request $request)
    {
        $request->validate([
            'start_terminal_id' => 'required',
            'end_terminal_id' => 'required',
            'nama_armada' => 'required',
            'estimasi_perjalanan' => 'required|integer',
            'harga_pp' => 'required|integer',
        ]);

        Biaya::create($request->all());

        return back()->with('success', 'Jalur Bus berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_terminal_id' => 'required',
            'end_terminal_id' => 'required',
            'nama_armada' => 'required',
            'estimasi_perjalanan' => 'required|integer',
            'harga_pp' => 'required|integer',
        ]);

        $biaya = Biaya::findOrFail($id);
        $biaya->update($request->all());

        return back()->with('success', 'Data armada berhasil diperbarui!');
    }

    public function applyPeriod(Request $request)
    {
        $request->validate([
            'biaya_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'harga_periode' => 'required|integer',
        ]);

        $biaya = Biaya::findOrFail($request->biaya_id);
        $biaya->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'harga_periode' => $request->harga_periode,
        ]);

        return back()->with('success', 'Harga periode berhasil diterapkan!');
    }

    public function destroy($id)
    {
        Biaya::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}