@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2">
        {{-- Header & Navigasi --}}
        <div class="row">
            <div class="col-12">
                <div class="mb-2 mt-2">
                    <a href="{{ route('mahasiswa.plotting') }}" class="btn btn-outline-dark">
                        <i class="material-symbols-rounded text-sm me-1 align-middle">arrow_back</i> Kembali
                    </a>
                </div>
                {{-- Info Kelompok --}}
                <div class="card">
                    <div class="card-header ps-3 bg-gradient-dark shadow-dark border-radius-lg">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-2">
                            <div class="text-start mb-2">
                                <p class="text-sm mb-0 text-capitalize text-white opacity-7">Nama Kelompok</p>
                                <h4 class="mb-0 text-white">{{ $kelompok->nama_kelompok }}</h4>
                                <span
                                    class="badge badge-sm bg-gradient-primary border-0 mt-2 text-white">{{ $kelompok->jadwalKkn->nama_periode ?? 'N/A' }}</span>
                                |
                                <span
                                    class="badge badge-sm bg-gradient-secondary border-0 mt-2 text-white">{{ $kelompok->jenis_kkn ?? 'N/A' }}</span>
                                |
                                <span class="font-weight-bold text-light"><i
                                        class="material-symbols-rounded text-success text-gradient me-1 align-middle">location_on</i>{{ $kelompok->lokasiKkn->nama_desa ?? 'N/A' }}</span>
                            </div>
                            <div class="text-start text-md-end rounded-3 bg-gradient-secondary px-3 py-2">
                                <p class="text-sm mb-0 text-capitalize text-white opacity-7 font-weight-bold">Dosen
                                    Pembimbing</p>
                                <h4 class="mb-0 text-white">
                                    <i
                                        class="material-symbols-rounded text-success text-gradient me-1 align-middle">account_circle</i>
                                    <span
                                        class="align-middle text-break">{{ $kelompok->dosenDpl->nama_dosen ?? 'N/A' }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Anggota Terdaftar <span id="counter-anggota"
                                    class="badge badge-sm bg-gradient-success border-0 ms-1 px-2 py-1">{{ count($anggota) }}
                                    / 10</span>
                            </h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="table-anggota">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Mahasiswa</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status Kendaraan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($anggota as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <div class="avatar avatar-sm me-3 bg-gradient-dark rounded-circle">
                                                            <span
                                                                class="text-white text-xs font-weight-bold">{{ substr($item->mahasiswa->nama, 0, 2) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->mahasiswa->nama }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->mahasiswa->nim }} •
                                                            {{ $item->mahasiswa->prodi }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if($item->mahasiswa->punya_kendaraan === 'Punya')
                                                    <span
                                                        class="badge badge-sm badge-success-soft text-success border border-success">
                                                        <i
                                                            class="material-symbols-rounded text-xs align-middle me-1">two_wheeler</i>
                                                        Ada
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm badge-danger-soft text-danger border border-danger">
                                                        <i
                                                            class="material-symbols-rounded text-xs align-middle me-1">no_photography</i>
                                                        Tidak Ada
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="empty-row">
                                            <td colspan="3" class="text-center text-secondary text-sm py-4">Belum ada
                                                anggota.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: List Kandidat --}}
            {{-- <div class="col-lg-5 col-md-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Tambah Anggota</h6>
                        <p class="text-sm mb-0 text-secondary">Cari mahasiswa yang belum memiliki kelompok.</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-4 input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}">
                            <label class="form-label">Cari Nama / NIM / Fakultas / Prodi...</label>
                            <input type="text" class="form-control" id="searchInput" name="search"
                                value="{{ request('search') }}" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div style="max-height: 400px; overflow-y: auto;" class="pe-2">
                            <ul class="table-body list-group" id="list-kandidat">
                                @include('admin.plotting.partials.kandidat-mahasiswa')
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        @include('layouts.footer')
    </div>

    {{-- Modal Detail & Add (Client Side Only) --}}
    <div class="modal fade" id="modalDetailMahasiswa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal">Detail Mahasiswa</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="temp_id">
                    <input type="hidden" id="temp_kendaraan">

                    <div class="text-center mb-4">
                        <div class="avatar avatar-xl bg-gradient-primary rounded-circle mb-2">
                            <span class="text-white text-lg font-weight-bold" id="detailInitials"></span>
                        </div>
                        <h5 class="mb-0" id="detailName"></h5>
                        <p class="text-sm text-secondary mb-0" id="detailNim"></p>
                        <span class="badge badge-sm bg-gradient-success mt-2" id="detailProdi"></span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Fakultas</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailFakultas"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Jenis Kelamin</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailJk"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">No. HP</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailHp"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Keahlian</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailKeahlian"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Ukuran Jacket/Rompi</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailUkuranJacketRompi"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Punya Kendaraan</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailPunyaKendaraan"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Tipe Kendaraan</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailTipeKendaraan"></p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Punya Lisensi</p>
                            <p class="text-sm font-weight-bold text-dark" id="detailPunyaLisensi"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    {{-- Type Button (Hanya trigger JS, bukan submit form modal) --}}
                    <button type="button" class="btn bg-gradient-primary" id="btn-confirm-add">Tambahkan ke
                        Kelompok</button>
                </div>
            </div>
        </div>
    </div>
@endsection