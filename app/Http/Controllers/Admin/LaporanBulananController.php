<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanBulananController extends Controller
{
    public function index()
    {
        return view('admin.laporan-bulanan');
    }
}
