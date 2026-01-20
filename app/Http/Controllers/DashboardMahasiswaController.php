<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $siakadApiUrl = 'https://mini-siakad.cloud/api/jadwal-kkn';
        $secretKeySiakad = env('SYSTEM_API_KEY');
        $jadwal_kkn = [];

        try {
            // UBAH BAGIAN INI: Tambahkan withHeaders()
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => $secretKeySiakad,
                'Accept' => 'application/json'
            ])->get($siakadApiUrl);
            // AKHIR PERUBAHAN

            if ($response->successful()) {
                $jadwal_kkn = $response->json()['data'] ?? [];
            }
        } catch (\Exception $e) {
        }

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
