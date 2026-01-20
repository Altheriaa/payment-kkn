<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\JadwalKkn;


class JadwalKknController extends Controller
{
    public function index()
    {
        $jadwalkkn = JadwalKkn::orderBy('id_siakad', 'desc')->get();

        return view('admin.jadwal-kkn', compact('jadwalkkn'));
    }

    public function sync()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melakukan ini');
        }

        $siakadApiUrl = 'https://mini-siakad.cloud/api/jadwal-kkn';
        $secretKeySiakad = env('SYSTEM_API_KEY');

        try {
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => $secretKeySiakad,
                'Accept' => 'application/json'
            ])->timeout(10)->get($siakadApiUrl);

            if ($response->successful()) {
                $dataApi = $response->json()['data'];

                foreach ($dataApi as $item) {
                    // Ambil nested object tahun_akademik
                    $ta = $item['tahun_akademik'] ?? [];

                    JadwalKkn::updateOrCreate(
                        ['id_siakad' => $item['id']], // Kunci unik
                        [
                            'tahun_akademik_id' => $item['tahun_akademik_id'],

                            // Format Nama: "2025 1 - Ganjil"
                            'nama_periode' => ($ta['tahun'] ?? '') . ' - ' . ucfirst($ta['semester'] ?? ''),

                            'semester'     => $ta['semester'] ?? null,
                            'tahun_ajaran' => $ta['tahun'] ?? null,

                            // PENTING: Ini masa pendaftaran (Kapan boleh klik tombol daftar)
                            'tanggal_dibuka'  => $item['tanggal_dibuka'],
                            'tanggal_ditutup' => $item['tanggal_ditutup'],

                            'is_active' => $item['status_pendaftaran']
                        ]
                    );
                }
                return back()->with('success', 'Data Semester berhasil diperbarui!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal sinkronisasi jadwal KKN');
        }
    }
}
