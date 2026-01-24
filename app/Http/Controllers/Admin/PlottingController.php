<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DosenDpl;
use Illuminate\Http\Request;
use App\Models\KelompokKkn;
use App\Models\JadwalKkn;
use App\Models\LokasiKkn;

class PlottingController extends Controller
{
    public function index(Request $request)
    {
        $query = KelompokKkn::query()->with(['jadwalKkn', 'dosenDpl', 'lokasiKkn'])->withCount('pendaftaranKkn');
        $jadwalKkns = JadwalKkn::where('is_active', true)->get();
        $dosenDpls = DosenDpl::select('nama_dosen', 'id')->get();
        $lokasiKkns = LokasiKkn::select('nama_desa', 'id')->get();

        if (request()->filled('search')) {
            $search = request()->search;

            // query start contition
            $query->where(function ($q) use ($search) {
                $q->whereHas('jadwalKkn', function ($q2) use ($search) {
                    $q2->where('nama_periode', 'like', "%$search%");
                })
                    ->orWhereHas('dosenDpl', function ($q3) use ($search) {
                        $q3->where('nama_dosen', 'like', "%$search%");
                    })
                    ->orWhereHas('lokasiKkn', function ($q4) use ($search) {
                        $q4->where('nama_desa', 'like', "%$search%");
                    })
                    ->orWhere('nama_kelompok', 'like', "%$search%")
                    ->orWhere('jenis_kkn', 'like', "%$search%");
            });
        }

        $kelompoks = $query->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return view('admin.plotting.partials.kelompok-table', compact('kelompoks'))->render();
        }

        return view('admin.plotting.index', compact('kelompoks', 'jadwalKkns', 'dosenDpls', 'lokasiKkns'));
    }

    public function storeKelompok(Request $request)
    {
        $jadwalAktif = JadwalKkn::where('is_active', true)->first();

        if (!$jadwalAktif) {
            return back()->withErrors(['error' => 'Tidak ada jadwal KKN yang aktif.']);
        }

        $data = $request->validate([
            'jadwal_kkn_id' => 'required|exists:jadwal_kkn,id',
            'dpl_id' => 'required|exists:dosen_dpl,id|unique:kelompok_kkn,dpl_id,except,id',
            'lokasi_kkn_id' => 'required|exists:lokasi_kkn,id|unique:kelompok_kkn,lokasi_kkn_id,except,id',
            'nama_kelompok' => 'string|required|max:50',
            'jenis_kkn' => 'required|string|in:Reguler,Non Reguler',
        ], [
            'lokasi_kkn_id.unique' => 'Desa tersebut sudah memiliki kelompok KKN.',
            'dpl_id.unique' => 'Dosen tersebut sudah memiliki kelompok KKN.',
        ]);

        $data['jadwal_kkn_id'] = $jadwalAktif->id;
        KelompokKkn::create($data);

        return redirect()->route('admin.plotting')->with('success', 'Kelompok KKN berhasil ditambahkan');
    }

    public function updateKelompok(Request $request, $id)
    {

        $kelompok = KelompokKkn::findOrFail($id);

        $data = $request->validate([
            'jadwal_kkn_id' => 'required|exists:jadwal_kkn,id',
            'dpl_id' => 'required|exists:dosen_dpl,id|unique:kelompok_kkn,dpl_id,' . $id,
            'lokasi_kkn_id' => 'required|exists:lokasi_kkn,id|unique:kelompok_kkn,lokasi_kkn_id,' . $id,
            'nama_kelompok' => 'string|required|max:50',
            'jenis_kkn' => 'required|string|in:Reguler,Non Reguler',
        ], [
            'lokasi_kkn_id.unique' => 'Desa tersebut sudah memiliki kelompok KKN.',
            'dpl_id.unique' => 'Dosen tersebut sudah memiliki kelompok KKN.',
        ]);

        $kelompok->update($data);

        return redirect()->route('admin.plotting')->with('success', 'Kelompok KKN berhasil diupdate');
    }

    public function deleteKelompok($id)
    {

        $kelompok = KelompokKkn::findOrFail($id);
        $kelompok->delete();

        return redirect()->route('admin.plotting')->with('success', 'Kelompok KKN berhasil dihapus');
    }
}
