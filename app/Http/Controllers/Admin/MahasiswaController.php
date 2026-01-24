<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nim', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($request->filled('status_kkn')) {
            $query->where('status_kkn', $request->status_kkn);
        }

        $mahasiswas = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        if ($request->ajax()) {
            return view('admin.partials.mahasiswa-table', compact('mahasiswas'))->render();
        }

        return view('admin.mahasiswa', [
            'mahasiswas' => $mahasiswas
        ]);
    }

    public function detail($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('admin.lihat-detail-mahasiswa', [
            'mahasiswa' => $mahasiswa
        ]);
    }
}
