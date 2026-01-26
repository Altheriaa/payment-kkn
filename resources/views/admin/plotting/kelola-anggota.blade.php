@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2">
        {{-- Header & Navigasi --}}
        <div class="row">
            <div class="col-12">
                <div class="mb-2 mt-2">
                    <a href="{{ route('admin.plotting.kelola-anggota') }}" class="btn btn-outline-dark">
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

            {{-- KOLOM KIRI: Anggota Terdaftar (FORM UTAMA) --}}
            <div class="col-lg-7 col-md-12 mb-4">

                {{-- Pastikan route ini ada di web.php: Route::put('/plotting/{id}/sync', ...)->name('admin.plotting.sync')
                --}}
                <form action="{{ route('syncAnggota', $kelompok->id) }}" method="POST" id="formBatchUpdate">
                    @csrf
                    @method('PUT')

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
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($anggota as $item)
                                            <tr data-id="{{ $item->id }}">
                                                {{-- INPUT HIDDEN UTAMA (Ini yang dibaca Controller) --}}
                                                {{-- Name harus 'anggota_ids[]' sesuai request controller --}}
                                                <input type="hidden" name="anggota_ids[]" value="{{ $item->id }}">

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
                                                        <span
                                                            class="badge badge-sm badge-danger-soft text-danger border border-danger">
                                                            <i
                                                                class="material-symbols-rounded text-xs align-middle me-1">no_photography</i>
                                                            Tidak Ada
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{-- Tombol KICK (Hanya hapus baris via JS, tidak reload) --}}
                                                    <button type="button"
                                                        class="btn btn-link text-danger text-gradient p-0 mb-0 btn-kick">
                                                        <i class="material-symbols-rounded text-lg">delete</i>
                                                    </button>
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
                        <div class="card-footer p-3 d-flex justify-content-end">
                            {{-- Tombol Submit Form Utama --}}
                            <button type="submit" class="btn bg-gradient-success mb-0" id="btn-save">
                                <i class="material-symbols-rounded text-sm me-1">save</i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- KOLOM KANAN: List Kandidat --}}
            <div class="col-lg-5 col-md-12">
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
            </div>
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

    {{-- JAVASCRIPT LOGIC --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-detail-mahasiswa', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let nim = $(this).data('nim');
                let prodi = $(this).data('prodi');
                let jk = $(this).data('jk');
                let hp = $(this).data('hp');
                let kendaraan = $(this).data('kendaraan');
                let fakultas = $(this).data('fakultas');
                let keahlian = $(this).data('keahlian');
                let ukuranJacketRompi = $(this).data('ukuran_jacket_rompi');
                let tipeKendaraan = $(this).data('tipe_kendaraan');
                let punyaLisensi = $(this).data('punya_lisensi');

                // Inisial Nama
                let initials = name.match(/(\b\S)?/g).join("").match(/(^\S|\S$)?/g).join("").toUpperCase();

                // Isi Data ke Modal
                $('#detailName').text(name);
                $('#detailNim').text(nim);
                $('#detailProdi').text(prodi);
                $('#detailInitials').text(initials);
                $('#detailJk').text(jk);
                $('#detailFakultas').text(fakultas);
                $('#detailHp').text(hp);
                $('#detailKeahlian').text(keahlian);
                $('#detailPunyaKendaraan').text(kendaraan);
                $('#detailTipeKendaraan').text(tipeKendaraan);
                $('#detailPunyaLisensi').text(punyaLisensi);
                $('#detailUkuranJacketRompi').text(ukuranJacketRompi);

                // Simpan ID sementara
                $('#temp_id').val(id);
                $('#temp_kendaraan').val(kendaraan);

                $('#modalDetailMahasiswa').modal('show');
            });

            // Logic Tambah ke Tabel (CLIENT SIDE ONLY)
            $('#btn-confirm-add').click(function () {
                let id = $('#temp_id').val();
                let name = $('#detailName').text();
                let nim = $('#detailNim').text();
                let prodi = $('#detailProdi').text();
                let initials = $('#detailInitials').text();
                let kendaraan = $('#temp_kendaraan').val();

                // Cek duplikasi di tabel
                if ($(`tr[data-id="${id}"]`).length > 0) {
                    alert('Mahasiswa sudah ada di tabel!');
                    $('#modalDetailMahasiswa').modal('hide');
                    return;
                }

                // Buat Badge Kendaraan
                let badgeKendaraan = '';
                if (kendaraan === 'Punya') {
                    badgeKendaraan = `<span class="badge badge-sm badge-success-soft text-success border border-success"><i class="material-symbols-rounded text-xs align-middle me-1">two_wheeler</i> Ada</span>`;
                } else {
                    badgeKendaraan = `<span class="badge badge-sm badge-danger-soft text-danger border border-danger"><i class="material-symbols-rounded text-xs align-middle me-1">no_photography</i> Tidak Ada</span>`;
                }

                // BUAT HTML BARIS BARU
                // Perhatikan: name="anggota_ids[]" sesuai controller
                let newRow = `
                                            <tr data-id="${id}" class="bg-gray-100">
                                                <input type="hidden" name="anggota_ids[]" value="${id}">
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <div class="avatar avatar-sm me-3 bg-gradient-dark rounded-circle">
                                                                <span class="text-white text-xs font-weight-bold">${initials}</span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">${name}</h6>
                                                            <p class="text-xs text-secondary mb-0">${nim} • ${prodi}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">${badgeKendaraan}</td>
                                                <td class="align-middle text-center">
                                                    <button type="button" class="btn btn-link text-danger text-gradient p-0 mb-0 btn-kick">
                                                        <i class="material-symbols-rounded text-lg">delete</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        `;

                // Hapus row "Belum ada anggota" jika ada
                $('#empty-row').remove();

                // Tambah ke tabel kiri
                $('#table-anggota tbody').append(newRow);

                // Sembunyikan dari list kanan
                $(`#kandidat-${id}`).hide();

                // Update Counter & UI Feedback
                updateCounter();
                $('#modalDetailMahasiswa').modal('hide');
                $('#btn-save').addClass('animate-bounce');
            });

            // 3. Logic Kick dari Tabel (CLIENT SIDE ONLY)
            $(document).on('click', '.btn-kick', function () {
                let row = $(this).closest('tr');
                let id = row.data('id');

                // Hapus row dari tabel visual
                row.remove();

                // Munculkan kembali di list kanan (kalau ada di halaman ini)
                $(`#kandidat-${id}`).show();

                updateCounter();
                $('#btn-save').addClass('animate-bounce');
            });

            function updateCounter() {
                let count = $('#table-anggota tbody tr[data-id]').length;
                $('#counter-anggota').text(count);
            }
        });
    </script>

    {{-- CSS untuk animasi bounce --}}
    <style>
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }
    </style>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

    {{-- search jquery --}}
    <script>
        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                let search = $(this).val();
                $.ajax({
                    url: "{{ route('kelolaAnggota', $kelompok->id) }}",
                    type: "GET",
                    data: {
                        search: search,
                    },
                    success: function (response) {
                        $('.table-body').html(response);
                    }
                });
            });
        });
    </script>
@endsection