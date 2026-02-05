@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="ms-3">
                <h3 class="mb-3 h4 font-weight-bolder">Dashboard Admin</h3>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Semester</p>
                                <h4 class="mb-0">{{ $jadwal_kkn->nama_periode ?? '' }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Jumlah Mahasiswa</p>
                                <h4 class="mb-0">{{ $mahasiswaCount }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">badge</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">KKN Aktif</p>
                                <h4 class="mb-0">{{ $totalAktif }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">school</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Jumlah Transaksi</p>
                                <h4 class="mb-0">{{ $transaksiCount }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">weekend</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Jadwal KKN dan Alur KKN --}}
        <div class="row mt-4 mb-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">

                    {{-- Jadwal KKN --}}
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Jadwal KKN</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tahun Akademik</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Dibuka</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Ditutup</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- Kolom Tahun Akademik (INI PERBAIKANNYA) --}}
                                        <td>
                                            <div class="d-flex px-2 py-1 ps-3">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $jadwal_kkn->nama_periode ?? '' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Kolom Tanggal Dibuka (Ini sudah benar) --}}
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold">
                                                {{ \Carbon\Carbon::parse($jadwal_kkn['tanggal_dibuka'])->format('d M Y') }}
                                            </span>
                                        </td>

                                        {{-- Kolom Tanggal Ditutup (Ini sudah benar) --}}
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold">
                                                {{ \Carbon\Carbon::parse($jadwal_kkn['tanggal_ditutup'])->format('d M Y') }}
                                            </span>
                                        </td>

                                        {{-- Kolom Status (Baru, karena datanya ada) --}}
                                        <td class="align-middle text-center text-sm">
                                            @if ($jadwal_kkn->is_active == true)
                                                <span class="badge badge-sm bg-gradient-success">Dibuka</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Ditutup</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Table Biaya KKN --}}
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Biaya KKN</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jenis KKN</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Biaya</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jenisKknList as $jenis)
                                        <tr>
                                            {{-- Kolom Prodi --}}
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $jenis['nama_jenis'] }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm text">
                                                    Rp {{ number_format($jenis['biaya']) }}
                                                </h6>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($jenis['is_active'])
                                                    <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-secondary">
                                                Tidak ada jenis KKN tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Alur KKN</h6>
                        <p class="text-sm">
                            {{-- Konten
                        <p> diubah untuk relevansi --}}
                            Tahapan dari pendaftaran hingga selesai.
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">

                            {{-- Tahap 1: Pengecekan Syarat --}}
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-symbols-rounded text-success text-gradient">fact_check</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pengecekan Syarat</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">SKS, Status, & Jadwal Aktif
                                    </p>
                                </div>
                            </div>

                            {{-- Tahap 2: Pendaftaran & Pilih Jenis --}}
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-symbols-rounded text-danger text-gradient">how_to_reg</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pendaftaran & Pilih Jenis KKN</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Memilih KKN yang tersedia
                                    </p>
                                </div>
                            </div>

                            {{-- Tahap 3: Pembayaran --}}
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-symbols-rounded text-info text-gradient">payments</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pembayaran Biaya KKN</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Konfirmasi via Midtrans</p>
                                </div>
                            </div>

                            {{-- Tahap 4: Penentuan Lokasi/Mentor --}}
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-symbols-rounded text-warning text-gradient">groups</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Penentuan Lokasi & DPL</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Plotting oleh Panitia</p>
                                </div>
                            </div>

                            {{-- Tahap 5: Pelaksanaan --}}
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-symbols-rounded text-primary text-gradient">event_note</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pelaksanaan KKN</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Pengisian logbook &
                                        bimbingan</p>
                                </div>
                            </div>

                            {{-- Tahap 6: Selesai --}}
                            <div class="timeline-block">
                                <span class="timeline-step">
                                    <i class="material-symbols-rounded text-dark text-gradient">task_alt</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Laporan & Penilaian</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">KKN Selesai</p>
                                </div>
                            </div>

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