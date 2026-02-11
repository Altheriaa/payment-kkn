@foreach ($mahasiswas as $mahasiswa)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $mahasiswa->nim }}</h6>
                </div>
            </div>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">{{ $mahasiswa->nama }}</p>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">{{ $mahasiswa->email }}</p>
        </td>
        <td class="align-middle text-center text-sm">
            @if ($mahasiswa->status_kkn == 'Sudah Daftar')
                <span class="badge badge-sm bg-gradient-success">Sudah Daftar</span>
            @else
                <span class="badge badge-sm bg-gradient-danger">Belum Daftar</span>
            @endif
        </td>
        <td class="align-middle text-center text-sm">
            <a href={{ route('mahasiswa.admin.detail', $mahasiswa->id) }}>
                <span class="badge badge-sm bg-gradient-success"><i
                        class="material-symbols-rounded text-sm ">person</i></span>
            </a>
        </td>
    </tr>
@endforeach