<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class RiwayatPendaftaranController extends Controller
{
    public function riwayatTransaksi(Request $request)
    {
        $query = Payment::with('mahasiswa');

        // filter pencarian (nama/nim/order id)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%$search%")
                    ->orWhereHas('mahasiswa', function ($m) use ($search) {
                        $m->where('nama', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
            });
        }

        // Filter Status (success / pending / failed)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return view('admin.partials.transaksi-table', compact('payments'))->render();
        }

        return view('admin.riwayat-transaksi-admin', [
            'payments' => $payments
        ]);
    }
}
