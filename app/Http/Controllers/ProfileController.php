<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Mengambil data gunung terbaru beserta relasi jalurnya
        $gunung = Gunung::with('jalurs')->latest()->get();
        return view('pendaki.profile.index', compact('gunung'));
    }
}