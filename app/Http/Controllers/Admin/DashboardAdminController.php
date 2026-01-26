<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Mahasiswa;
use App\Models\Payment;
use App\Models\JadwalKkn;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // count mahasiswa
        $mahasiswaCount = Mahasiswa::count();
        $transaksiCount = Payment::count();

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

        $totalAktif = collect($jenisKknList)->where('is_active', true)->count();

        return view('admin.dashboard', [
            'jadwal_kkn' => $jadwal_kkn,
            'jenisKknList' => $jenisKknList,
            'mahasiswaCount' => $mahasiswaCount,
            'totalAktif' => $totalAktif,
            'transaksiCount' => $transaksiCount,
        ]);
    }
}
