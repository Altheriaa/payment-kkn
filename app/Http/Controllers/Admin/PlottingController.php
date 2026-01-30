<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DosenDpl;
use Illuminate\Http\Request;
use App\Models\KelompokKkn;
use App\Models\JadwalKkn;
use App\Models\LokasiKkn;
use App\Models\PendaftaranKkn;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;


class PlottingController extends Controller
{
    public function index(Request $request)
    {
        $listJadwal = JadwalKkn::orderBy('id_siakad', 'desc')->get();

        $query = KelompokKkn::query()->with(['jadwalKkn', 'dosenDpl', 'lokasiKkn'])
            ->withCount('pendaftaranKkn');

        // Filter Periode
        if ($request->filled('jadwal_kkn_id')) {
            $selectedJadwalId = $request->jadwal_kkn_id;
            $query->where('jadwal_kkn_id', $selectedJadwalId);
        } else {
            if ($listJadwal->isNotEmpty()) {
                $selectedJadwalId = $listJadwal->first()->id;
                $query->where('jadwal_kkn_id', $selectedJadwalId);
            } else {
                $selectedJadwalId = null;
            }
        }

        // Filter Pencarian
        if (request()->filled('search')) {
            $search = request()->search;

            // query start contition
            $query->where(function ($q) use ($search) {
                $q->WhereHas('dosenDpl', function ($q2) use ($search) {
                    $q2->where('nama_dosen', 'like', "%$search%");
                })
                    ->orWhereHas('lokasiKkn', function ($q3) use ($search) {
                        $q3->where('nama_desa', 'like', "%$search%");
                    })
                    ->orWhere('nama_kelompok', 'like', "%$search%")
                    ->orWhere('jenis_kkn', 'like', "%$search%");
            });
        }

        $kelompoks = $query->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return view('admin.plotting.partials.kelompok-table', compact('kelompoks'))->render();
        }

        $jadwalKkns = JadwalKkn::where('is_active', true)->get();
        $dosenDpls = DosenDpl::select('nama_dosen', 'id')->get();
        $lokasiKkns = LokasiKkn::select('nama_desa', 'id')->get();

    return view('admin.plotting.index', compact('kelompoks', 'jadwalKkns', 'dosenDpls', 'lokasiKkns', 'listJadwal', 'selectedJadwalId'));
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
            'jenis_kkn' => 'required|string|in:KKN-UNAYA Regular,KKN-UNAYA Non-Regular',
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

    public function kelolaAnggota(Request $request, $id)
    {

        $kelompok = KelompokKkn::with(['dosenDpl', 'lokasiKkn', 'jadwalKkn'])->findOrFail($id);

        $anggota = PendaftaranKkn::with('mahasiswa')
            ->where('kelompok_kkn_id', $id)
            ->get();

        $queryKandidat = PendaftaranKkn::with('mahasiswa')
            ->where('jadwal_kkn_id', $kelompok->jadwal_kkn_id)
            ->where('jenis_kkn', $kelompok->jenis_kkn)
            ->where('status_pendaftaran', 'valid')
            ->whereNull('kelompok_kkn_id');

        if (request()->filled('search')) {
            $search = request()->search;

            // query start contition
            $queryKandidat->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%$search%");
                })
                    ->orWhereHas('mahasiswa', function ($q3) use ($search) {
                        $q3->where('nim', 'like', "%$search%");
                    })
                    ->orWhereHas('mahasiswa', function ($q4) use ($search) {
                        $q4->where('email', 'like', "%$search%");
                    })
                    ->orWhereHas('mahasiswa', function ($q5) use ($search) {
                        $q5->where('fakultas', 'like', "%$search%");
                    })
                    ->orWhereHas('mahasiswa', function ($q6) use ($search) {
                        $q6->where('prodi', 'like', "%$search%");
                    });
            });
        }

        $kandidat = $queryKandidat->get();

        if ($request->ajax()) {
            return view('admin.plotting.partials.kandidat-mahasiswa', compact('kandidat'))->render();
        }

        return view('admin.plotting.kelola-anggota', [
            'kelompok' => $kelompok,
            'anggota' => $anggota,
            'kandidat' => $kandidat
        ]);
    }

    public function syncAnggota(Request $request, $id)
    {
        // Validasi: member_ids adalah array berisi ID PendaftaranKkn
        // 'nullable' artinya boleh kosong (jika semua anggota dihapus/kick)
        $request->validate([
            'anggota_ids' => 'nullable|array',
            'anggota_ids.*' => 'exists:pendaftaran_kkn,id'
        ]);

        PendaftaranKkn::where('kelompok_kkn_id', $id)
            ->update(['kelompok_kkn_id' => null]);

        if ($request->has('anggota_ids') && !empty($request->anggota_ids)) {
            PendaftaranKkn::whereIn('id', $request->anggota_ids)
                ->update(['kelompok_kkn_id' => $id]);
        }

        return back()->with('success', 'Perubahan anggota kelompok berhasil disimpan!');
    }

    // Cetak Laporan Penempatan Kelompok
    public function cetakLaporanKelompok($id)
    {

        $kelompok = KelompokKkn::with(['dosenDpl', 'lokasiKkn', 'jadwalKkn'])->findOrFail($id);

        $anggota = PendaftaranKkn::with('mahasiswa')
            ->where('kelompok_kkn_id', $id)
            ->get();

        $pdf = Pdf::loadView('admin.plotting.laporan-kelompok-pdf', [
            'kelompok' => $kelompok,
            'anggota' => $anggota,
        ]);

        // 6. Set Ukuran Kertas & Stream
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('Laporan-Plotting-' . $kelompok->nama_kelompok . '.pdf');
    }
}
