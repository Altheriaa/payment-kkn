<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiKkn;
use App\Models\JadwalKkn;

class LandingPageController extends Controller
{
    public function index()
    {
        $lokasiKkns = LokasiKkn::orderBy('kabupaten_kota', 'asc')->get();
        $jadwalKkns = JadwalKkn::orderBy('created_at', 'desc')->get();

        return view('landing', compact('lokasiKkns', 'jadwalKkns'));
    }
}
