<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranKkn;
use App\Models\JadwalKkn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\KelompokKkn;

class LaporanJumlahPesertaKknController extends Controller
{
    public function index(Request $request)
    {
        $listJadwal = JadwalKkn::orderBy('id_siakad', 'desc')->get();

        $siakadApiUrl = 'https://mini-siakad.cloud/api/kkn/jenis';
        $secretKeySiakad = env('SYSTEM_API_KEY');

        // Default kosong, pakai collect() biar enak diolah
        $listKkn = collect([]);

        try {
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => $secretKeySiakad,
                'Accept' => 'application/json'
            ])->get($siakadApiUrl);

            if ($response->successful()) {
                $listKkn = collect($response->json()['data'] ?? []);
            }
        } catch (\Exception $e) {
        }

        $query = PendaftaranKkn::with('mahasiswa')
            ->where('status_pendaftaran', 'valid');

        $selectedJadwalId = null;

        // filter berdasar jadwal
        if ($request->filled('jadwal_kkn_id')) {
            $selectedJadwalId = $request->jadwal_kkn_id;
        } elseif ($listJadwal->isNotEmpty()) {
            $selectedJadwalId = $listJadwal->first()->id;
        }

        if ($selectedJadwalId) {
            $query->where('jadwal_kkn_id', $selectedJadwalId);
        }

        $selectedJenisKkn = null;

        // filter jenis kkn
        if ($request->filled('jenis_kkn')) {
            $selectedJenisKkn = $request->jenis_kkn;
        } elseif ($listKkn->isNotEmpty()) {
            $selectedJenisKkn = $listKkn->first()['nama_jenis'];
        }

        if ($selectedJenisKkn) {
            $query->where('jenis_kkn', $selectedJenisKkn);
        }

        // Searching
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%$search%");
                })->orWhereHas('mahasiswa', function ($q3) use ($search) {
                    $q3->where('nim', 'like', "%$search%");
                });
            });
        }

        $pendaftarans = $query->get();

        if ($request->ajax()) {
            return view('admin.laporan-jumlah.partials.laporan-jumlah-table', compact('pendaftarans'))->render();
        }

        $countTeknik = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Teknik'))->count();
        $countPertanian = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Pertanian'))->count();
        $countPerikanan = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Perikanan'))->count();
        $countKesmas = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Kesehatan Masyarakat'))->count();
        $countFkip = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Keguruan dan Ilmu Pendidikan'))->count();
        $countEkonomi = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Ekonomi'))->count();
        $countKedokteran = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Kedokteran'))->count();
        $countHukum = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Hukum'))->count();

        // Jumlah Per jenis KKN
        $countTotal = (clone $query)->count();

        return view('admin.laporan-jumlah.laporan-jumlah-peserta-kkn', compact(
            'pendaftarans',
            'listJadwal',
            'listKkn',
            'selectedJadwalId',
            'selectedJenisKkn',
            'countTeknik',
            'countPertanian',
            'countPerikanan',
            'countKesmas',
            'countFkip',
            'countEkonomi',
            'countKedokteran',
            'countHukum',
            'countTotal'
        ));
    }

    public function cetak(Request $request)
    {
        $listJadwal = JadwalKkn::orderBy('id_siakad', 'desc')->get();
        $query = PendaftaranKkn::with('mahasiswa')
            ->where('status_pendaftaran', 'valid');

        $siakadApiUrl = 'https://mini-siakad.cloud/api/kkn/jenis';
        $secretKeySiakad = env('SYSTEM_API_KEY');

        // Default kosong, pakai collect() biar enak diolah
        $listKkn = collect([]);

        try {
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => $secretKeySiakad,
                'Accept' => 'application/json'
            ])->get($siakadApiUrl);

            if ($response->successful()) {
                $listKkn = collect($response->json()['data'] ?? []);
            }
        } catch (\Exception $e) {
        }

        $selectedJadwalId = null;

        // filter berdasar jadwal
        if ($request->filled('jadwal_kkn_id')) {
            $selectedJadwalId = $request->jadwal_kkn_id;
        } elseif ($listJadwal->isNotEmpty()) {
            $selectedJadwalId = $listJadwal->first()->id;
        }

        if ($selectedJadwalId) {
            $query->where('jadwal_kkn_id', $selectedJadwalId);
        }

        $selectedJenisKkn = null;

        // filter jenis kkn
        if ($request->filled('jenis_kkn')) {
            $selectedJenisKkn = $request->jenis_kkn;
        } elseif ($listKkn->isNotEmpty()) {
            $selectedJenisKkn = $listKkn->first()['nama_jenis'];
        }

        if ($selectedJenisKkn) {
            $query->where('jenis_kkn', $selectedJenisKkn);
        }

        $pendaftarans = $query->get();

        $namaPeriode = $listJadwal->where('id', $selectedJadwalId)->first()->nama_periode ?? '-';

        $countTeknik = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Teknik'))->count();
        $countPertanian = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Pertanian'))->count();
        $countPerikanan = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Perikanan'))->count();
        $countKesmas = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Kesehatan Masyarakat'))->count();
        $countFkip = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Keguruan dan Ilmu Pendidikan'))->count();
        $countEkonomi = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Ekonomi'))->count();
        $countKedokteran = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Kedokteran'))->count();
        $countHukum = (clone $query)->whereHas('mahasiswa', fn($q) => $q->where('fakultas', 'Hukum'))->count();

        $pdf = Pdf::loadView('admin.laporan-jumlah.cetak-laporan-jumlah', [
            'pendaftarans' => $pendaftarans,
            'countTeknik' => $countTeknik,
            'countPertanian' => $countPertanian,
            'countPerikanan' => $countPerikanan,
            'countKesmas' => $countKesmas,
            'countFkip' => $countFkip,
            'countEkonomi' => $countEkonomi,
            'countKedokteran' => $countKedokteran,
            'countHukum' => $countHukum,
            'selectedJenisKkn' => $selectedJenisKkn,
            'namaPeriode' => $namaPeriode,
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('Laporan-Jumlah-Peserta-KKN.pdf');
    }
}
