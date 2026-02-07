@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3"> Laporan Jumlah Peserta </h4>
                            <h6 class="text-white ps-3">Mahasiswa</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row w-100 g-3 align-items-center">
                            <div class="col-12 col-md">
                                <form action="{{ route('admin.laporan.jumlah.peserta') }}" method="GET"
                                    class="row g-2 mb-0">
                                    {{-- Cetak Rekapitulasi --}}
                                    <div class="col-12 col-md-3">
                                        <div class="input-group">
                                            <a href="{{ route('cetakJumlahLaporan', ['jadwal_kkn_id' => $selectedJadwalId, 'jenis_kkn' => $selectedJenisKkn]) }}">
                                                <span class="btn bg-gradient-dark mb-0 w-100 w-md-auto border-0 cursor-pointer btn-edit">
                                                    <i class="material-symbols-rounded text-sm me-1">print</i> Cetak Laporan                                             </span>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Filter Jadwal --}}
                                    <div class="col-12 col-md-3">
                                        <div class="input-group">
                                            <select name="jadwal_kkn_id" class="form-control px-2 border border-secondary"
                                                style="height: 40px; border-radius: 8px !important;"
                                                onchange="this.form.submit()">
                                                @foreach($listJadwal as $jadwal)
                                                    <option value="{{ $jadwal->id }}" {{ $selectedJadwalId == $jadwal->id ? 'selected' : '' }}>
                                                        {{ $jadwal->nama_periode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Filter Jenis --}}
                                    <div class="col-12 col-md-3">
                                        <div class="input-group">
                                            <select name="jenis_kkn" class="form-control px-2 border border-secondary"
                                                style="height: 40px; border-radius: 8px !important;"
                                                onchange="this.form.submit()">
                                                @forelse($listKkn as $jenis)
                                                    <option value="{{ $jenis['nama_jenis'] }}" 
                                                        {{ $selectedJenisKkn == $jenis['nama_jenis'] ? 'selected' : '' }}>
                                                        {{ $jenis['nama_jenis'] }}
                                                    </option>
                                                @empty
                                                    <option value="">Tidak ada jenis KKN</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md">
                                        <div class="input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}">
                                            <label class="form-label">Cari Mahasiswa... </label>
                                            {{-- Value diambil dari request('search') agar tidak hilang saat reload --}}
                                            <input type="text" class="form-control" id="searchInput" name="search"
                                                value="{{ request('search') }}" onfocus="focused(this)"
                                                onfocusout="defocused(this)">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 bg-gradient-dark m-3 border-radius-md">
                        <div class="row align-items-center">
                            {{-- Faculty List --}}
                            <div class="col-lg-9 col-md-8">
                                <h6 class="text-white text-xs text-uppercase opacity-7 mb-3">Rincian Mahasiswa Per Fakultas
                                </h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Teknik : <span
                                            class="font-weight-bolder">{{ $countTeknik }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Pertanian : <span
                                            class="font-weight-bolder">{{ $countPertanian }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Perikanan : <span
                                            class="font-weight-bolder">{{ $countPerikanan }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Kedokteran : <span
                                            class="font-weight-bolder">{{ $countKedokteran }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Hukum : <span
                                            class="font-weight-bolder">{{ $countHukum }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Kesehatan Masyarakat : <span
                                            class="font-weight-bolder">{{ $countKesmas }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Keguruan dan Ilmu Pendidikan :
                                        <span class="font-weight-bolder">{{ $countFkip }}</span></span>
                                    <span class="badge bg-gradient-primary p-2 mb-1">Fakultas Ekonomi : <span
                                            class="font-weight-bolder">{{ $countEkonomi }}</span></span>
                                </div>
                            </div>

                            {{-- Total Summary --}}
                            <div class="col-lg-3 col-md-4 mt-4 mt-md-0 border-start border-secondary">
                                <div class="text-center">
                                    <h6 class="text-white opacity-7 mb-0 text-sm">Total {{ $selectedJenisKkn }}</h6>
                                    <h2 class="text-white font-weight-bolder mb-0">{{ $countTotal }}</h2>
                                    <span class="badge badge-sm bg-success mt-2">Verified</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0 ">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NIM</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fakultas</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Prodi
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            L/P
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NO HP
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jenis KKN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @include('admin.laporan-jumlah.partials.laporan-jumlah-table')
                            </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-3 mb-4">
                                {{ $pendaftarans->appends(request()->query())->links('vendor.pagination.simple-dark') }}
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

    {{-- script search --}}
    <script>
        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                let search = $(this).val();

                let jadwalId = $('select[name="jadwal_kkn_id"]').val();
                let jenisKkn = $('select[name="jenis_kkn"]').val();

                $.ajax({
                    url: "{{ route('admin.laporan.jumlah.peserta') }}",
                    type: "GET",
                    data: {
                        search: search,
                        jadwal_kkn_id: jadwalId,     // Kirim ID Jadwal
                        jenis_kkn: jenisKkn
                    },
                    success: function (response) {
                        $('.table-body').html(response);
                    }
                });
            });
        });

        // sweetalert confirm
        $(document).on('submit', '.form-hapus-kelompok', function (e) {
            e.preventDefault(); // Stop form submit asli

            let form = this; // Simpan form yang sedang diklik

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin menghapus kelompok ini? Data tidak bisa kembali.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form secara manual setelah konfirmasi
                    form.submit();
                }
            });
        });
    </script>

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