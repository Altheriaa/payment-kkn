@if ($jadwalkkn)
    <tr class="align-middle">
        <td class="align-middle text-center">
            <h6 class="mb-0 text-sm">1</h6>
        </td>

        <td class="align-middle">
            <h6 class="mb-0 text-sm py-1">{{ $jadwalkkn->nama_periode }}</h6>
            <span class="text-xs text-secondary">ID Siakad: {{ $jadwalkkn->id_siakad }}</span>
        </td>

        <td class="align-middle">
            <p class="text-xs font-weight-bold mb-0">{{ $jadwalkkn->tahun_ajaran }} ({{ ucfirst($jadwalkkn->semester) }})
            </p>
        </td>

        <td class="align-middle text-center">
            <p class="text-xs font-weight-bold mb-0">
                {{ $jadwalkkn->tanggal_dibuka ? \Carbon\Carbon::parse($jadwalkkn->tanggal_dibuka)->format('d M Y') : '-' }}
                s/d
                {{ $jadwalkkn->tanggal_ditutup ? \Carbon\Carbon::parse($jadwalkkn->tanggal_ditutup)->format('d M Y') : '-' }}
            </p>
        </td>

        <td class="align-middle text-center text-sm">
            @if ($jadwalkkn->is_active)
                <span class="badge badge-sm bg-gradient-success">Sedang Dibuka</span>
            @else
                <span class="badge badge-sm bg-gradient-danger">Tutup</span>
            @endif
        </td>
    </tr>
@endif