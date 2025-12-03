<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBulananController extends Controller
{
    public function laporanBulanan(Request $request)
    {
        // 1. Ambil Input Filter
        $bulanDipilih = $request->input('bulan', date('m'));
        $tahunDipilih = $request->input('tahun', date('Y'));

        // 2. Query Data (HAPUS 'with')
        $laporan = Payment::where('status', 'success')
            ->whereMonth('created_at', $bulanDipilih)
            ->whereYear('created_at', $tahunDipilih)
            ->selectRaw('jenis_kkn_id, count(*) as total_transaksi, sum(amount) as total_pendapatan')
            ->groupBy('jenis_kkn_id')
            ->get();

        // 3. Ambil Data Jenis KKN dari API Siakad (Buat Referensi Nama)
        $referensiJenisKkn = [];
        try {
            // Panggil API Siakad yang sama seperti saat mahasiswa daftar
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => env('SYSTEM_API_KEY'),
                'Accept' => 'application/json'
            ])->get('https://mini-siakad.cloud/api/kkn/jenis');

            if ($response->successful()) {
                // Kita ubah array jadi format [ID => NAMA] biar gampang dicocokkan
                $dataApi = $response->json()['data'] ?? [];
                foreach ($dataApi as $item) {
                    $referensiJenisKkn[$item['id']] = $item['nama_jenis'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data jenis KKN: ' . $e->getMessage());
        }

        // 4. Hitung Grand Total
        $grandTotal = $laporan->sum('total_pendapatan');

        // 5. List Bulan
        $listBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return view('admin.laporan-bulanan', compact(
            'laporan',
            'grandTotal',
            'bulanDipilih',
            'tahunDipilih',
            'listBulan',
            'referensiJenisKkn'
        ));
    }

    public function cetakLaporanBulanan($bulan, $tahun)
    {
        // 1. Query Data Transaksi (Sama persis dengan method index)
        $laporan = Payment::where('status', 'success')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->selectRaw('jenis_kkn_id, count(*) as total_transaksi, sum(amount) as total_pendapatan')
            ->groupBy('jenis_kkn_id')
            ->get();

        // 2. AMBIL DATA DARI API SIAKAD (PENTING: Agar nama jenis KKN muncul di PDF)
        // Kita harus fetch ulang karena PDF adalah request baru
        $referensiJenisKkn = [];
        try {
            $response = Http::withHeaders([
                'X-SYSTEM-KEY' => env('SYSTEM_API_KEY'),
                'Accept' => 'application/json'
            ])->get('https://mini-siakad.cloud/api/kkn/jenis');

            if ($response->successful()) {
                $dataApi = $response->json()['data'] ?? [];
                foreach ($dataApi as $item) {
                    // Mapping ID => Nama Jenis
                    $referensiJenisKkn[$item['id']] = $item['nama_jenis'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data jenis KKN di cetak PDF: ' . $e->getMessage());
        }

        // 3. Hitung Grand Total
        $grandTotal = $laporan->sum('total_pendapatan');

        // 4. Format Nama Bulan (Contoh: "11" jadi "November")
        Carbon::setLocale('id'); // Pastikan bahasa Indonesia
        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');

        // 5. Load View PDF
        // Pastikan nama file view sesuai dengan yang kamu buat
        $pdf = Pdf::loadView('admin.laporan-cetak-pdf', [
            'laporan' => $laporan,
            'grandTotal' => $grandTotal,
            'bulan' => $namaBulan,
            'tahun' => $tahun,
            'referensiJenisKkn' => $referensiJenisKkn
        ]);

        // 6. Set Ukuran Kertas & Stream
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan-Keuangan-' . $namaBulan . '-' . $tahun . '.pdf');
    }
}
