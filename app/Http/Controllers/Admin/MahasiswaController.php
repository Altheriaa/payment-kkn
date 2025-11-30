<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {

        $mahasiswas = Mahasiswa::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.mahasiswa', compact('mahasiswas'));
    }
}
