<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jalur;
use App\Models\Gunung;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        $jalurs = Jalur::with('gunung')->latest()->get();
        $gunungs = Gunung::all();
        return view('admin.jalur.index', compact('jalurs', 'gunungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gunung_id' => 'required',
            'nama_jalur' => 'required|string|max:255',
            'biaya_simaksi' => 'required|integer',
            'estimasi_jam' => 'required|integer',
            'tingkat_kesulitan' => 'required',
        ]);

        Jalur::create($request->all());
        return back()->with('success', 'Jalur berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gunung_id' => 'required',
            'nama_jalur' => 'required|string|max:255',
            'biaya_simaksi' => 'required|integer',
            'estimasi_jam' => 'required|integer',
            'tingkat_kesulitan' => 'required',
        ]);

        $jalur = Jalur::findOrFail($id);
        $jalur->update($request->all());

        return back()->with('success', 'Jalur berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Jalur::findOrFail($id)->delete();
        return back()->with('success', 'Jalur berhasil dihapus!');
    }
}