<nav class="navbar navbar-main navbar-expand-lg px-2 mx-3 mb-2 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                @php
                    $routeName = request()->route() ? request()->route()->getName() : null;
                    $titles = [
                        // Mahasiswa
                        'mahasiswa.dashboard' => 'Dashboard',
                        'mahasiswa.biodata.index' => 'Biodata',
                        'mahasiswa.pembayaran' => 'Pembayaran',
                        'mahasiswa.riwayat' => 'Riwayat Transaksi',
                        'mahasiswa.plotting' => 'Penempatan Kelompok',
                        'mahasiswa.profile' => 'Profile',
                        'detailKelompok' => 'Detail Kelompok',

                        // Admin
                        'admin.dashboard' => 'Dashboard',
                        'mahasiswa.admin' => 'Daftar Mahasiswa',
                        'mahasiswa.detail' => 'Detail Mahasiswa',
                        'admin.riwayat' => 'Riwayat Transaksi',
                        'admin.lokasi-kkn' => 'Lokasi KKN',
                        'admin.jadwal-kkn' => 'Jadwal KKN',
                        'admin.dosen-dpl' => 'Dosen Pembimbing Lapangan',
                        'admin.plotting' => 'Penempatan Mahasiswa',
                        'admin.plotting.kelola-anggota' => 'Kelola Anggota',
                        'kelolaAnggota' => 'Kelola Anggota', // Child page
                        'admin.laporan.jumlah.peserta' => 'Laporan Jumlah Peserta',
                    ];

                    $parents = [
                        'kelolaAnggota' => ['label' => 'Penempatan Mahasiswa', 'route' => 'admin.plotting'],
                        'mahasiswa.detail' => ['label' => 'Daftar Mahasiswa', 'route' => 'mahasiswa.admin'],
                        'detailKelompok' => ['label' => 'Penempatan Kelompok', 'route' => 'mahasiswa.plotting'],
                        'admin.cetak' => ['label' => 'Riwayat Transaksi', 'route' => 'admin.riwayat'],
                        'admin.cetak.pendaftaran' => ['label' => 'Riwayat Transaksi', 'route' => 'admin.riwayat'],
                    ];

                    $pageTitle = $titles[$routeName] ?? 'Page';

                    $parentInfo = $parents[$routeName] ?? null;

                    if ($pageTitle === 'Page' && $routeName) {
                        $pageTitle = ucwords(str_replace(['.', '-', '_'], ' ', $routeName));
                    }
                @endphp

                @if($parentInfo)
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="{{ route($parentInfo['route']) }}">
                            {{ $parentInfo['label'] }}
                        </a>
                    </li>
                @endif

                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $pageTitle }}</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3 d-flex align-items-center">
                </li>
                @if (Auth::user())
                    <li class="nav-item d-flex align-items-center">
                        <a href="" class="nav-link text-body font-weight-bold px-0">
                            <i class="material-symbols-rounded">account_circle</i>
                        </a>
                    </li>
                @else
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('mahasiswa.profile') }}" class="nav-link text-body font-weight-bold px-0">
                            <i class="material-symbols-rounded">account_circle</i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>