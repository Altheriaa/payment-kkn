@foreach ($jadwalkkn as $index => $item)
    <tr class="align-middle">
        <td class="align-middle text-center">
            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
        </td>

        <td class="align-middle">
            <h6 class="mb-0 text-sm py-1">{{ $item->nama_periode }}</h6>
            <span class="text-xs text-secondary">ID Siakad: {{ $item->id_siakad }}</span>
        </td>

        <td class="align-middle">
            <p class="text-xs font-weight-bold mb-0">{{ $item->tahun_ajaran }} ({{ ucfirst($item->semester) }})</p>
        </td>

        <td class="align-middle text-center">
            <p class="text-xs font-weight-bold mb-0">
                {{ $item->tanggal_dibuka ? \Carbon\Carbon::parse($item->tanggal_dibuka)->format('d M Y') : '-' }}
                s/d
                {{ $item->tanggal_ditutup ? \Carbon\Carbon::parse($item->tanggal_ditutup)->format('d M Y') : '-' }}
            </p>
        </td>

        <td class="align-middle text-center text-sm">
            @if ($item->is_active)
                <span class="badge badge-sm bg-gradient-success">Sedang Dibuka</span>
            @else
                <span class="badge badge-sm bg-gradient-danger">Tutup</span>
            @endif
        </td>
    </tr>
@endforeach