<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mahasiswa;
use App\Models\PendaftaranKkn;
use App\Models\KelompokKkn;
use Barryvdh\DomPDF\Facade\Pdf;

use function Pest\Laravel\session;

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

    public function cetakLaporanKelompok($id)
    {
        // 0. Cek Session Login
        $mahasiswaSession = Session::get('mahasiswa_data');
        if (!$mahasiswaSession) {
            return redirect()->route('login')->withErrors('Sesi habis, silakan login kembali.');
        }

        // 1. Cari data pendaftaran dulu
        $pendaftaran = PendaftaranKkn::findOrFail($id);

        // VALIDASI KEAMANAN: Pastikan data pendaftaran ini MILIK mahasiswa yang sedang login
        if ($pendaftaran->mahasiswa_id != $mahasiswaSession['id']) {
            return redirect()->route('mahasiswa.plotting')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        if (!$pendaftaran->kelompok_kkn_id) {
            return back()->with('error', 'Anda belum terdaftar di kelompok manapun.');
        }

        // 2. Ambil Data Kelompok berdasarkan kolom kelompok_kkn_id
        $kelompok = KelompokKkn::with(['dosenDpl', 'lokasiKkn', 'jadwalKkn'])
            ->findOrFail($pendaftaran->kelompok_kkn_id);

        // 3. Ambil semua anggota kelompok tersebut
        $anggota = PendaftaranKkn::with('mahasiswa')
            ->where('kelompok_kkn_id', $kelompok->id)
            ->get();

        $pdf = Pdf::loadView('plotting-mahasiswa.laporan-kelompok-pdf', [
            'kelompok' => $kelompok,
            'anggota' => $anggota,
        ]);

        // 6. Set Ukuran Kertas & Stream
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('Laporan-Plotting-' . $kelompok->nama_kelompok . '.pdf');
    }
}
