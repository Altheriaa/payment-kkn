<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;
use Illuminate\Http\Request;

class CetakInvoice extends Controller
{
    public function cetakTransaksi($id)
    {

        $payment = Payment::with('mahasiswa')
            ->where('id', $id)
            ->where('status', 'success')
            ->firstOrFail();

        $data = [
            'payment' => $payment
        ];

        $pdf = Pdf::loadView('admin.bukti-pembayaran-pdf', $data);

        return $pdf->stream('bukti-pembayaran-' . $payment->order_id . '.pdf');
    }
}
