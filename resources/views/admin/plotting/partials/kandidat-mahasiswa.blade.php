@forelse($kandidat as $k)
    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg item-kandidat"
        id="kandidat-{{ $k->id }}">
        <div class="d-flex align-items-center">
            <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                <span class="text-white text-xs font-weight-bold">{{ substr($k->mahasiswa->nama, 0, 2) }}</span>
            </div>
            <div class="d-flex flex-column">
                <h6 class="mb-1 text-dark text-sm">{{ $k->mahasiswa->nama }}</h6>
                <span class="text-xs">{{ $k->mahasiswa->nim }}</span>
                <span class="text-xs text-success font-weight-bold">{{ $k->mahasiswa->prodi }}</span>
            </div>
        </div>
        <div class="d-flex align-items-center">
            {{-- Tombol Trigger Modal --}}
            <button class="btn  btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa" data-id="{{ $k->id }}"
                data-name="{{ $k->mahasiswa->nama }}" data-nim="{{ $k->mahasiswa->nim }}"
                data-fakultas="{{ $k->mahasiswa->fakultas }}" data-prodi="{{ $k->mahasiswa->prodi }}"
                data-jk="{{ $k->mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
                data-hp="{{ $k->mahasiswa->no_hp ?? '-' }}" data-kendaraan="{{ $k->mahasiswa->punya_kendaraan }}"
                data-tipe_kendaraan="{{ $k->mahasiswa->tipe_kendaraan }}"
                data-ukuran_jacket_rompi="{{ $k->mahasiswa->ukuran_jacket_rompi }}"
                data-punya_lisensi="{{ $k->mahasiswa->punya_lisensi }}" data-keahlian="{{ $k->mahasiswa->keahlian }}">
                <i class="material-symbols-rounded text-lg">add</i>
            </button>
        </div>
    </li>
@empty
    <li class="list-group-item border-0 text-center text-secondary text-sm">Tidak ada kandidat
        ditemukan.</li>
@endforelse