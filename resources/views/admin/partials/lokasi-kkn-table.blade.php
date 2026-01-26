@foreach ($lokasiKkns as $lokasiKkn)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $lokasiKkn->kabupaten_kota }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $lokasiKkn->kecamatan }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $lokasiKkn->nama_desa }}</h6>
                </div>
            </div>
        </td>
        <td class="align-middle text-center text-sm">
            <button type="button" class="badge badge-sm bg-gradient-warning border-0 cursor-pointer btn-edit"
                data-bs-toggle="modal" data-bs-target="#modalLokasi" data-id="{{ $lokasiKkn->id }}"
                data-kabupaten="{{ $lokasiKkn->kabupaten_kota }}" data-kecamatan="{{ $lokasiKkn->kecamatan }}"
                data-desa="{{ $lokasiKkn->nama_desa }}" data-url="{{ route('updateLokasiKkn', $lokasiKkn->id) }}">
                <i class="material-symbols-rounded text-sm ">edit</i>
            </button>
            <form action="{{ route('hapusLokasiKkn', $lokasiKkn->id) }}" method="POST" style="display: inline-block;"
                class="form-hapus-lokasi">

                @csrf
                @method('DELETE')

                <button type="submit" class="badge badge-sm bg-gradient-danger border-0 cursor-pointer">
                    <i class="material-symbols-rounded text-sm ">delete</i>
                </button>
            </form>
        </td>
    </tr>
@endforeach