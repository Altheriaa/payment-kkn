<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class HapusTransaksiController extends Controller
{
    public function hapusTransaksi($id)
    {
        // 1. Cari data (pakai findOrFail lebih singkat daripada where->first)
        $payment = Payment::findOrFail($id);

        // 2. CEGAH MENGHAPUS TRANSAKSI SUKSES
        // Kecuali kamu memang lagi testing, sebaiknya blokir aksi ini.
        if ($payment->status == 'success') {
            return back()->with('warning', ' Transaksi yang sudah LUNAS tidak boleh dihapus demi keamanan data.');
        }

        // 3. Hapus (Bisa tambahkan logika hapus di Midtrans juga kalau mau pro)
        $payment->delete();

        return redirect()->route('admin.riwayat')->with('success', 'Transaksi berhasil dihapus.');
    }
}
