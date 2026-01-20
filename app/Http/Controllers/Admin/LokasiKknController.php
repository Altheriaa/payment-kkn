<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LokasiKkn;

class LokasiKknController extends Controller
{
    public function index(Request $request)
    {

        $query = LokasiKkn::query();

        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('kabupaten_kota', 'like', "%$search%")
                    ->orWhere('kecamatan', 'like', "%$search%")
                    ->orWhere('nama_desa', 'like', "%$search%");
            });
        }

        $lokasiKkns = $query->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return view('admin.partials.lokasi-kkn-table', compact('lokasiKkns'))->render();
        }

        return view('admin.lokasi-kkn', [
            'lokasiKkns' => $lokasiKkns
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kabupaten_kota' => 'string|required|max:50',
            'kecamatan' => 'string|required|max:50',
            'nama_desa' => 'string|required|max:50|unique:lokasi_kkn,nama_desa',
        ], [
            'nama_desa.unique' => 'Desa sudah ada.'
        ]);

        LokasiKkn::create($data);

        return redirect()->route('admin.lokasi-kkn')->with('success', 'Lokasi KKN berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $lokasiKkn = LokasiKkn::findOrFail($id);

        $data = $request->validate([
            'kabupaten_kota' => 'string|required|max:50',
            'kecamatan' => 'string|required|max:50',
            'nama_desa' => 'string|required|max:50|unique:lokasi_kkn,nama_desa,' . $lokasiKkn->id,
        ]);

        $lokasiKkn->update($data);

        return redirect()->route('admin.lokasi-kkn')->with('success', 'Lokasi KKN berhasil diubah');
    }

    public function delete($id)
    {
        $lokasiKkn = LokasiKkn::findOrFail($id);
        $lokasiKkn->delete();
        return redirect()->route('admin.lokasi-kkn')->with('success', 'Lokasi KKN berhasil dihapus');
    }
}
