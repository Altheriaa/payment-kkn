<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class RiwayatPendaftaranController extends Controller
{
    public function riwayatTransaksi()
    {
        $payments = Payment::with('mahasiswa')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.riwayat-transaksi-admin', [
            'payments' => $payments
        ]);
    }
}
