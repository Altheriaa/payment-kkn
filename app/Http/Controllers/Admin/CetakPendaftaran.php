<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;
use Illuminate\Http\Request;

class CetakPendaftaran extends Controller
{
    public function cetakPendaftaran($id)
    {
        $payment = Payment::with('mahasiswa')
            ->where('id', $id)
            ->where('status', 'success')
            ->firstOrFail();

        $mahasiswa = $payment->mahasiswa;

        // Optional: Cek jaga-jaga jika mahasiswanya sudah terhapus di database
        if (!$mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan.');
        }

        $data = [
            'payment' => $payment,
            'mahasiswa' => $mahasiswa
        ];

        $pdf = Pdf::loadView('formulir-pendaftaran-pdf', $data);

        return $pdf->stream('formulir-pendaftaran-' . $mahasiswa->nama . '.pdf');
    }
}
