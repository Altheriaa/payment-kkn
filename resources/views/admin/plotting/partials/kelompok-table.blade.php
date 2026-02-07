@foreach ($kelompoks as $kelompok)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $kelompok->jadwalKkn->nama_periode ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $kelompok->dosenDpl->nama_dosen ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $kelompok->lokasiKkn->nama_desa ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $kelompok->nama_kelompok ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $kelompok->jenis_kkn ?? 'N/A'}}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="align-middle text-center text-sm">
                @php
                    $count = $kelompok->pendaftaran_kkn_count ?? 0;
                    $max = 10; // Default quota per group
                    $percentage = min(($count / $max) * 100, 100);

                    // Determine color based on occupancy
                    if ($percentage >= 100) {
                        $color = 'danger';
                    } elseif ($percentage >= 75) {
                        $color = 'warning';
                    } else {
                        $color = 'success';
                    }
                @endphp
                <div class="d-flex align-items-center justify-content-center">
                    <span class="me-2 text-xs font-weight-bold">{{ $count }} / {{ $max }}</span>
                    <div>
                        <div class="progress" style="width: 100px; height: 6px;">
                            <div class="progress-bar bg-gradient-{{ $color }}" role="progressbar"
                                aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{ $percentage }}%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="align-middle text-center text-sm">
            <a href="{{ route('admin.plotting.kelolaAnggota', $kelompok->id) }}">
                <span class="badge badge-sm bg-gradient-success border-0 cursor-pointer btn-edit">
                    <i class="material-symbols-rounded text-sm ">group</i>
                </span>
            </a>

            <button type="button" class="badge badge-sm bg-gradient-warning border-0 cursor-pointer btn-edit"
                data-bs-toggle="modal" data-bs-target="#modalKelompok" data-id="{{ $kelompok->id }}"
                data-jadwal_kkn_id="{{ $kelompok->jadwal_kkn_id }}" data-dpl_id="{{ $kelompok->dpl_id }}"
                data-lokasi_kkn_id="{{ $kelompok->lokasi_kkn_id }}" data-nama_kelompok="{{ $kelompok->nama_kelompok }}"
                data-jenis_kkn="{{ $kelompok->jenis_kkn }}" data-url="{{ route('updateKelompok', $kelompok->id) }}">
                <i class="material-symbols-rounded text-sm ">edit</i>
            </button>
            <form action="{{ route('hapusKelompok', $kelompok->id) }}" method="POST" style="display: inline-block;"
                class="form-hapus-kelompok">

                @csrf
                @method('DELETE')

                <button type="submit" class="badge badge-sm bg-gradient-danger border-0 cursor-pointer">
                    <i class="material-symbols-rounded text-sm ">delete</i>
                </button>
            </form>
            <a href="{{ route('cetakKelompok', $kelompok->id) }}">
                <span class="badge badge-sm bg-gradient-success border-0 cursor-pointer btn-edit">
                    <i class="material-symbols-rounded text-sm ">print</i>
                </span>
            </a>
        </td>
    </tr>
@endforeach