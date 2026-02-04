<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\JadwalKkn;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $siakadApiUrl = 'https://mini-siakad.cloud/api/jadwal-kkn';
        $secretKeySiakad = env('SYSTEM_API_KEY');

        // Jadwal Hasil Sinkron Lokal
        $jadwal_kkn = JadwalKkn::where('is_active', true)->first();

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

        return view('dashboard', [
            'jadwal_kkn' => $jadwal_kkn,
            'jenisKknList' => $jenisKknList,
        ]);
    }
}
