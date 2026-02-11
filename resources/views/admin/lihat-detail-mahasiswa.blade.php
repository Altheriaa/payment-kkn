@extends('layouts.app')

@section('content')
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('/assets/img/Biro Abulyatama.webp');">
            <span class="mask  bg-gradient-dark  opacity-6"></span>
        </div>
        <div class="card card-body mx-2 mx-md-2 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->nama) }}&background=random&color=fff"
                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $mahasiswa->nama }}
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            {{ $mahasiswa->nim }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <span
                            class="badge {{ $mahasiswa->status_kkn === 'Diterima' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                            {{ $mahasiswa->status_kkn }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                    <div class="card h-100 shadow-lg border-0">
                        <div class="card-header p-4 bg-gradient-dark shadow-dark">
                            <h6 class="mb-0 text-white">
                                <i class="fas fa-user-graduate me-2"></i>
                                Informasi Akademik & Pribadi
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-user text-dark me-2"></i>
                                        <small class="tex-muted text-uppercase fw-bold">Nama Lengkap</small>
                                    </div>
                                    <div class="ms-4 text-dark fw-bold">{{ $mahasiswa->nama }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0 bg-light">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-id-card text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">NIM</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->nim }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-building text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Fakultas</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->fakultas ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0 bg-light">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-graduation-cap text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Program Studi</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->prodi ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Email</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->email }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0 bg-light">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">No. HP</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->no_hp ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-phone-square text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">No. HP Darurat</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->no_hp_darurat ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0 bg-light">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-venus-mars text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Jenis Kelamin</small>
                                    </div>
                                    <div class="ms-4">
                                        @if ($mahasiswa->jenis_kelamin == 'L')
                                            <span class="badge bg-gradient-dark text-white">
                                                <i class="fas fa-mars me-1"></i>Laki-laki
                                            </span>
                                        @elseif($mahasiswa->jenis_kelamin == 'P')
                                            <span class="badge bg-gradient-dark text-white">
                                                <i class="fas fa-venus me-1"></i>Perempuan
                                            </span>
                                        @else
                                            <span class="text-dark">-</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-book text-primary me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Jumlah SKS</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->jumlah_sks ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card h-100 shadow-lg border-0">
                        <div class="card-header p-4 bg-gradient-dark shadow-dark">
                            <h6 class="mb-0 text-white">
                                <i class="fas fa-clipboard-list me-2"></i>
                                Biodata & Perlengkapan KKN
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-tshirt text-dark me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Ukuran Jaket/Rompi</small>
                                    </div>
                                    <div class="ms-4 text-dark fw-bold">{{ $mahasiswa->ukuran_jacket_rompi ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0 bg-light">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-motorcycle text-dark me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Kepemilikan Kendaraan</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->punya_kendaraan ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-car text-dark me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Tipe Kendaraan</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->tipe_kendaraan ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0 bg-light">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-id-card-alt text-dark me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Kepemilikan Lisensi (SIM)</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->punya_lisensi ?? '-' }}</div>
                                </div>

                                <div class="list-group-item px-4 py-3 border-0">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-star text-dark me-2"></i>
                                        <small class="text-muted text-uppercase fw-bold">Keahlian</small>
                                    </div>
                                    <div class="ms-4 text-dark">{{ $mahasiswa->keahlian ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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