<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Mahasiswa;
use App\Models\Payment;
use App\Models\JadwalKkn;
use App\Models\PendaftaranKkn;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // count mahasiswa
        $mahasiswaCount = Mahasiswa::count();
        $transaksiCount = Payment::count();
        $pendaftarPeriode = PendaftaranKkn::where('status_pendaftaran', 'valid')->count();

        $jadwal_kkn = JadwalKkn::where('is_active', true)->first();
        $jadwal_kkn_dash = JadwalKkn::orderBy('id', 'desc')->first();

        // panggil Api endpoinst jenis kkn 
        $siakadApiUrl = 'https://mini-siakad.cloud/api/kkn/jenis';
        $secretKeySiakad = env('SYSTEM_API_KEY');
        $jenisKknList = [];

        try {
            // UBAH BAGIAN INI: Tambahkan withHeaders()
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => $secretKeySiakad,
                'Accept' => 'application/json'
            ])->get($siakadApiUrl);
            // AKHIR PERUBAHAN

            if ($response->successful()) {
                $jenisKknList = $response->json()['data'] ?? [];
            }
        } catch (\Exception $e) {
        }

        $totalAktif = collect($jenisKknList)->where('is_active', true)->count();

        return view('admin.dashboard', [
            'jadwal_kkn' => $jadwal_kkn,
            'jadwal_kkn_dash' => $jadwal_kkn_dash,
            'jenisKknList' => $jenisKknList,
            'mahasiswaCount' => $mahasiswaCount,
            'totalAktif' => $totalAktif,
            'transaksiCount' => $transaksiCount,
            'pendaftarPeriode' => $pendaftarPeriode,
        ]);
    }

    public function syncMahasiswa()
    {
        $siakadApiUrl = 'https://mini-siakad.cloud/api/sync-mahasiswa';

        // try {
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => env('SYSTEM_API_KEY'),
                'Accept' => 'application/json'
            ])->get($siakadApiUrl);

            if ($response->failed()) {
                throw new \Exception('API gagal');
            }

            $users = $response->json('users');

            // dd($users);

            foreach ($users as $user) {
                Mahasiswa::updateOrCreate(
                    ['id' => $user['id']],
                    [
                        'nim' => $user['nim'],
                        'nama' => $user['name'],
                        'email' => $user['email'],
                        'jumlah_sks' => data_get($user, 'mahasiswa.jumlah_sks', 0),
                        'fakultas' => data_get($user, 'mahasiswa.prodi.fakultas.nama_fakultas'),
                        'prodi' => data_get($user, 'mahasiswa.prodi.nama_prodi'),
                    ]
                );
            }

            return redirect()->route('admin.dashboard');

        // } catch (\Throwable $e) {
        //     return back()->withErrors([
        //         'error' => 'Gagal sinkron data mahasiswa.',
        //     ]);
        // }
    }

}
