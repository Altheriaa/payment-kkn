@foreach ($pendaftarans as $pendaftaran)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->mahasiswa->nim ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->mahasiswa->nama ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->mahasiswa->fakultas ?? 'N/A' }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->mahasiswa->prodi ?? 'N/A'}}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->mahasiswa->jenis_kelamin ?? 'N/A'}}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->mahasiswa->no_hp ?? 'N/A'}}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $pendaftaran->jenis_kkn ?? 'N/A'}}</h6>
                </div>
            </div>
        </td>
    </tr>
@endforeach