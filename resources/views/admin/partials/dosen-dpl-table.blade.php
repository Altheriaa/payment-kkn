@foreach ($dosendpls as $dosendpl)
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $dosendpl->nuptk }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $dosendpl->nama_dosen }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $dosendpl->prodi }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $dosendpl->bidang_keahlian }}</h6>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $dosendpl->no_hp }}</h6>
                </div>
            </div>
        </td>
        <td class="align-middle text-center text-sm">
            <button type="button" class="badge badge-sm bg-gradient-warning border-0 cursor-pointer btn-edit"
                data-bs-toggle="modal" data-bs-target="#modalDosen" data-id="{{ $dosendpl->id }}"
                data-nuptk="{{ $dosendpl->nuptk }}" data-nama_dosen="{{ $dosendpl->nama_dosen }}"
                data-prodi="{{ $dosendpl->prodi }}" data-bidang_keahlian="{{ $dosendpl->bidang_keahlian }}"
                data-no_hp="{{ $dosendpl->no_hp }}" data-url="{{ route('updateDosen', $dosendpl->id) }}">
                Edit
            </button>
            <form action="{{ route('hapusDosen', $dosendpl->id) }}" method="POST" style="display: inline-block;"
                class="form-hapus-dosen">

                @csrf
                @method('DELETE')

                <button type="submit" class="badge badge-sm bg-gradient-danger border-0 cursor-pointer">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
@endforeach