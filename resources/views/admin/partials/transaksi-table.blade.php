@foreach($payments as $payment)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $payment->mahasiswa->nama }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $payment->mahasiswa->nim }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $payment->order_id }}</h6>
                </div>
            </div>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">{{ $payment->jenis_kkn }}</p>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
            </p>
        </td>
        <td>
            <p class="text-xs text-center font-weight-bold mb-0">
                @if($payment->status == 'success')
                    <span class="badge badge-sm bg-gradient-success">Berhasil</span>
                @elseif($payment->status == 'pending')
                    <span class="badge badge-sm bg-gradient-warning">Pending</span>
                @elseif($payment->status == 'failed')
                    <span class="badge badge-sm bg-gradient-danger">Gagal</span>
                @else
                    <span class="badge badge-sm bg-gradient-secondary">-</span>
                @endif
            </p>
        </td>
        <td class="align-middle text-center text-sm">
            {{ $payment->created_at->format('d M Y, H:i') }}
        </td>
        <td class="align-middle text-center text-sm">
            @if ($payment->status == 'pending' && $payment->snap_token)
                <a class="text-xs font-weight-bold" target="_blank" disabled>
                    <span class="badge badge-sm bg-gradient-danger">Menunggu Pembayaran</span>
                </a>
            @elseif($payment->status == 'failed')
                <form action="{{ route('admin.hapus.transaksi', $payment->id) }}" method="POST" style="display: inline-block;"
                    class="text-xs font-weight-bold form-hapus-transaksi">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="badge badge-sm bg-gradient-danger border-0 cursor-pointer">
                        <i class="material-symbols-rounded text-sm ">delete</i>
                    </button>
                </form>
            @elseif($payment->status == 'success')
                <a href="{{ route('admin.cetak', ['id' => $payment->id]) }}" class="text-xs font-weight-bold" target="_blank">
                    <span class="badge badge-sm bg-gradient-warning d-inline-flex align-items-center">
                        <i class="material-symbols-rounded text-sm me-1">print</i>Invoice
                    </span>
                </a>
                <a href="{{ route('admin.cetak.pendaftaran', ['id' => $payment->id]) }}" class="text-xs font-weight-bold"
                    target="_blank">
                    <span class="badge badge-sm bg-gradient-success d-inline-flex align-items-center">
                        <i class="material-symbols-rounded text-sm me-1">print</i>Formulir
                    </span>
                </a>
            @endif
        </td>
    </tr>
@endforeach