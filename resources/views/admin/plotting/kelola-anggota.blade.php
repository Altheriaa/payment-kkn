@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ps-3 bg-gradient-dark shadow-dark border-radius-lg">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-2">
                            <div class="text-start mb-2">
                                <p class="text-sm mb-0 text-capitalize text-white opacity-7">Nama Kelompok</p>
                                <h4 class="mb-0 text-white">Kelompok Putih</h4>
                                <span class="badge badge-sm bg-gradient-secondary border-0 mt-2 text-white">Reguler</span> |
                                <span class="font-weight-bold text-light"><i
                                        class="material-symbols-rounded text-success text-gradient me-1 align-middle">location_on</i>Lhong
                                    Raya</span>
                            </div>
                            <div class="text-start text-md-end rounded-3 bg-gradient-secondary px-3 py-2">
                                <p class="text-sm mb-0 text-capitalize text-white opacity-7 font-weight-bold">Dosen
                                    Pembimbing</p>
                                <h4 class="mb-0 text-white">
                                    <i
                                        class="material-symbols-rounded text-success text-gradient me-1 align-middle">account_circle</i>
                                    <span class="align-middle text-break">Ryan Setiawan</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Jadwal KKN dan Alur KKN --}}
        <div class="row mt-4 mb-4">
            <div class="col-lg-7 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Anggota Terdaftar <span
                                    class="badge badge-sm bg-gradient-success border-0 ms-1 px-2 py-1">4 / 10</span></h6>
                            <button class="btn btn-link text-secondary mb-0 px-0">
                                <i class="material-symbols-rounded text-sm me-1">filter_list</i> Filter
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
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
                                    {{-- Item 1 --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <div class="avatar avatar-sm me-3 bg-gradient-dark rounded-circle">
                                                        <span class="text-white text-xs font-weight-bold">CR</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Cut Rahmawati</h6>
                                                    <p class="text-xs text-secondary mb-0">20210201001 • Teknik Informatika
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm badge-success-soft text-success border border-success">
                                                <i
                                                    class="material-symbols-rounded text-xs align-middle me-1">two_wheeler</i>
                                                Ada Kendaraan
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <i class="material-symbols-rounded text-lg text-danger">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- Item 2 --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <div class="avatar avatar-sm me-3 bg-gradient-info rounded-circle">
                                                        <span class="text-white text-xs font-weight-bold">JH</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Jurnalis J Hius</h6>
                                                    <p class="text-xs text-secondary mb-0">20210201045 • Manajemen</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm badge-secondary-soft text-secondary border border-secondary">
                                                <i class="material-symbols-rounded text-xs align-middle me-1">block</i>
                                                Tidak Ada
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <i class="material-symbols-rounded text-lg text-danger">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- Item 3 --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <div class="avatar avatar-sm me-3 bg-gradient-warning rounded-circle">
                                                        <span class="text-white text-xs font-weight-bold">AN</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Annisah</h6>
                                                    <p class="text-xs text-secondary mb-0">20210201112 • Akuntansi</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm badge-success-soft text-success border border-success">
                                                <i
                                                    class="material-symbols-rounded text-xs align-middle me-1">two_wheeler</i>
                                                Ada Kendaraan
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <i class="material-symbols-rounded text-lg text-danger">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- Item 4 --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <div class="avatar avatar-sm me-3 bg-gradient-primary rounded-circle">
                                                        <span class="text-white text-xs font-weight-bold">MH</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Mahyuddin</h6>
                                                    <p class="text-xs text-secondary mb-0">20210201088 • Hukum</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm badge-success-soft text-success border border-success">
                                                <i class="material-symbols-rounded text-xs align-middle me-1">drive_eta</i>
                                                Ada Kendaraan
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Hapus">
                                                <i class="material-symbols-rounded text-lg text-danger">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer p-3 d-flex justify-content-end">
                        <button class="btn bg-gradient-success mb-0">
                            <i class="material-symbols-rounded text-sm me-1">save</i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Column: Tambah Anggota --}}
            <div class="col-lg-5 col-md-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Tambah Anggota</h6>
                        <p class="text-sm mb-0 text-secondary">Cari mahasiswa yang belum memiliki kelompok.</p>
                    </div>
                    <div class="card-body p-3">
                        {{-- Search Input --}}
                        <div class="input-group input-group-outline mb-4">
                            <label class="form-label">Cari Nama atau NIM...</label>
                            <input type="text" class="form-control">
                        </div>

                        {{-- List --}}
                        <div style="max-height: 400px; overflow-y: auto;" class="pe-2">
                            <ul class="list-group">
                                {{-- Student 1 --}}
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">BS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Budi Santoso</h6>
                                            <span class="text-xs">20210201201</span>
                                            <span class="text-xs text-success font-weight-bold">EKONOMI PEMBANGUNAN</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Budi Santoso" data-nim="20210201201"
                                            data-prodi="EKONOMI PEMBANGUNAN">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                {{-- Student 2 --}}
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-secondary rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">SA</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Siti Aminah</h6>
                                            <span class="text-xs">20210201205</span>
                                            <span class="text-xs text-secondary">PENDIDIKAN BIOLOGI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Siti Aminah" data-nim="20210201205" data-prodi="PENDIDIKAN BIOLOGI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                {{-- Student 3 --}}
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-warning rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">RH</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Rahmat Hidayat</h6>
                                            <span class="text-xs">20210201222</span>
                                            <span class="text-xs text-secondary">TEKNIK SIPIL</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Rahmat Hidayat" data-nim="20210201222" data-prodi="TEKNIK SIPIL">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                {{-- Student 4 --}}
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>

                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                            <span class="text-white text-xs font-weight-bold">DS</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Dewi Sartika</h6>
                                            <span class="text-xs">20210201230</span>
                                            <span class="text-xs text-secondary">FARMASI</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 btn-detail-mahasiswa"
                                            data-name="Dewi Sartika" data-nim="20210201230" data-prodi="FARMASI">
                                            <i class="material-symbols-rounded text-lg">add</i>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Section Jadwal KKN dan Alur KKN --}}

        {{-- Footer --}}
        @include('layouts.footer')
        {{-- End footer --}}
    </div>

    {{-- Modal Detail Mahasiswa --}}
    <div class="modal fade" id="modalDetailMahasiswa" tabindex="-1" role="dialog" aria-labelledby="modalDetailTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="modalDetailTitle">Detail Mahasiswa</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="avatar avatar-xl bg-gradient-primary rounded-circle mb-2">
                            <span class="text-white text-lg font-weight-bold" id="detailInitials">DS</span>
                        </div>
                        <h5 class="mb-0" id="detailName">Dewi Sartika</h5>
                        <p class="text-sm text-secondary mb-0" id="detailNim">20210201230</p>
                        <span class="badge badge-sm bg-gradient-success mt-2" id="detailProdi">FARMASI</span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Jenis Kelamin</p>
                            <p class="text-sm font-weight-bold text-dark">Perempuan</p>
                        </div>
                        <div class="col-6">
                            <p class="text-xs font-weight-bold text-secondary mb-0">No. HP</p>
                            <p class="text-sm font-weight-bold text-dark">081234567890</p>
                        </div>
                        <div class="col-12 mt-2">
                            <p class="text-xs font-weight-bold text-secondary mb-0">Alamat</p>
                            <p class="text-sm font-weight-bold text-dark">Jl. Contoh No. 123, Banda Aceh</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn bg-gradient-primary">Tambahkan ke Kelompok</button>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.btn-detail-mahasiswa').click(function () {
                let name = $(this).data('name');
                let nim = $(this).data('nim');
                let prodi = $(this).data('prodi');

                // Get Initials
                let initials = name.match(/(\b\S)?/g).join("").match(/(^\S|\S$)?/g).join("").toUpperCase();

                $('#detailName').text(name);
                $('#detailNim').text(nim);
                $('#detailProdi').text(prodi);
                $('#detailInitials').text(initials);

                $('#modalDetailMahasiswa').modal('show');
            });
        });
    </script>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- error/success/warning handle sweet alert --}}
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                customClass: {
                    popup: 'glass-popup rounded-3xl shadow-blur p-6',
                    title: 'font-semibold',
                    icon: 'icon-custom bg-transparent'
                },
                timer: 2000
            });
        @elseif (session('warning'))
            Swal.fire({
                icon: 'warning',
                text: "{{ session('warning') }}",
                showConfirmButton: false,
                customClass: {
                    popup: 'glass-popup rounded-3xl shadow-blur p-6',
                    title: 'font-semibold',
                    icon: 'icon-custom bg-transparent'
                },
                timer: 2000
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                customClass: {
                    popup: 'glass-popup rounded-3xl shadow-blur p-6',
                    title: 'font-bold',
                    confirmButton: 'button-confirm px-6 py-2 rounded-xl text-white',
                }
            });
        @endif
    </script>
@endsection