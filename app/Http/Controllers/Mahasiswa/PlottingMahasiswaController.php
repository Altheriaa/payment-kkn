<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mahasiswa;
use App\Models\PendaftaranKkn;
use App\Models\KelompokKkn;

class PlottingMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswaSession = Session::get('mahasiswa_data');

        if (!$mahasiswaSession) {
            return redirect()->route('login')->withErrors('Sesi habis.');
        }

        // Ambil mahasiswa lokal
        $mahasiswa = Mahasiswa::find($mahasiswaSession['id']);

        $kelompok = PendaftaranKkn::with(['mahasiswa', 'kelompokKkn', 'jadwalKkn'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status_pendaftaran', 'valid')
            ->whereNotNull('kelompok_kkn_id')
            ->first();

        $pendaftaranKkn = 0;
        if ($kelompok) {
            $pendaftaranKkn = PendaftaranKkn::where('kelompok_kkn_id', $kelompok->kelompok_kkn_id)->count();
        }

        return view('plotting-mahasiswa.index', compact('kelompok', 'mahasiswa', 'pendaftaranKkn'));
    }

    public function detail($id)
    {
        $mahasiswaSession = Session::get('mahasiswa_data');

        if (!$mahasiswaSession) {
            return redirect()->route('login')->withErrors('Sesi habis.');
        }

        // Ambil mahasiswa lokal
        $mahasiswa = Mahasiswa::find($mahasiswaSession['id']);

        // VALIDASI KEAMANAN: Cek apakah mahasiswa ini anggota kelompok tersebut
        $isAnggota = PendaftaranKkn::where('mahasiswa_id', $mahasiswa->id)
            ->where('kelompok_kkn_id', $id)
            ->exists();

        if (!$isAnggota) {
            return redirect()->route('mahasiswa.plotting')->with('error', 'Anda tidak memiliki akses untuk melihat detail kelompok ini.');
        }

        $kelompok = KelompokKkn::with(['dosenDpl', 'lokasiKkn', 'jadwalKkn'])->findOrFail($id);

        $anggota = PendaftaranKkn::with('mahasiswa')
            ->where('kelompok_kkn_id', $id)
            ->get();

        $pendaftaranKkn = PendaftaranKkn::where('kelompok_kkn_id', $kelompok->id)->count();

        return view('plotting-mahasiswa.detail-kelompok', compact('kelompok', 'pendaftaranKkn', 'anggota'));
    }
}
