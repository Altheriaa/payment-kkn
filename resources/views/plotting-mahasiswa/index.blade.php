@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3"> Plotting </h4>
                            <h6 class="text-white ps-3">Plotting Mahasiswa</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div>
                                {{-- <button type="button" class="btn bg-gradient-dark mb-0 btn-add" data-bs-toggle="modal"
                                    data-bs-target="#modalKelompok">
                                    <i class="material-symbols-rounded text-sm me-1">add</i> Tambah Kelompok
                                </button> --}}
                                <button type="button" class="btn bg-gradient-dark mb-0 btn-add" data-bs-toggle="modal"
                                    data-bs-target="#modalKelompok">
                                    <i class="material-symbols-rounded text-sm me-1">print</i> Cetak Kelompok
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jadwal KKN / Periode</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Dosen Pembimbimg Lapangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Lokasi KKN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Kelompok
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jenis KKN
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kuota
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @if($kelompok)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $kelompok->jadwalKkn->nama_periode }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $kelompok->kelompokKkn->dosenDpl->nama_dosen }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $kelompok->kelompokKkn->lokasiKkn->nama_desa }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $kelompok->kelompokKkn->nama_kelompok }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $kelompok->kelompokKkn->jenis_kkn }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="align-middle text-center text-sm">
                                                    @php
                                                        $count = $pendaftaranKkn ?? 0;
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
                                                        <span class="me-2 text-xs font-weight-bold">{{ $count }} /
                                                            {{ $max }}</span>
                                                        <div>
                                                            <div class="progress" style="width: 100px; height: 6px;">
                                                                <div class="progress-bar bg-gradient-{{ $color }}"
                                                                    role="progressbar" aria-valuenow="{{ $percentage }}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: {{ $percentage }}%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('detailKelompok', $kelompok->kelompok_kkn_id) }}">
                                                    <span
                                                        class="badge badge-sm bg-gradient-warning border-0 cursor-pointer btn-edit">
                                                        <i class="material-symbols-rounded text-sm ">info</i>
                                                    </span>
                                                </a>
                                                <a href="{{ route('mahasiswa.cetakKelompok', $kelompok->id) }}">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success border-0 cursor-pointer btn-edit">
                                                        <i class="material-symbols-rounded text-sm ">print</i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <p class="text-sm text-secondary font-weight-bold mb-0 py-4">
                                                    Anda belum masuk ke kelompok KKN manapun.
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-3 mb-4">
                                {{-- {{ $kelompoks->appends(request()->query())->links('vendor.pagination.simple-dark') }}
                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- SweetAlert --}}
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