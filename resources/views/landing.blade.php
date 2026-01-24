<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <title>KKN Universitas Abulyatama</title>

  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet" />

  <style>
    html {
      scroll-behavior: smooth;
    }

    .hero-section {
      background: linear-gradient(195deg, #42424a 0%, #191919 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: linear-gradient(195deg, rgba(236, 64, 122, 0.3) 0%, rgba(123, 76, 255, 0.3) 100%);
      border-radius: 50%;
      top: -100px;
      right: -100px;
      filter: blur(100px);
    }

    .section-title {
      position: relative;
      display: inline-block;
      margin-bottom: 2rem;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: linear-gradient(195deg, #42424a 0%, #191919 100%);
      border-radius: 2px;
    }

    .card-lokasi {
      transition: all 0.3s ease;
      border: none;
      border-radius: 12px;
    }

    .card-lokasi:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .timeline-item {
      position: relative;
      padding-left: 40px;
      margin-bottom: 30px;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 15px;
      top: 30px;
      bottom: -30px;
      width: 2px;
      background: #dee2e6;
    }

    .timeline-item:last-child::before {
      display: none;
    }

    .timeline-number {
      position: absolute;
      left: 0;
      top: 0;
      width: 32px;
      height: 32px;
      background: linear-gradient(195deg, #42424a 0%, #191919 100%);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }

    .jadwal-card {
      background: linear-gradient(195deg, #42424a 0%, #191919 100%);
      color: white;
      border-radius: 16px;
      padding: 2rem;
    }

    .download-card {
      transition: all 0.3s ease;
    }

    .download-card:hover {
      transform: scale(1.02);
    }

    .footer-section {
      background: linear-gradient(195deg, #42424a 0%, #191919 100%);
    }

    .nav-link-custom {
      color: #344767 !important;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .nav-link-custom:hover {
      color: #ec407a !important;
    }

    .stat-card {
      background: white;
      border-radius: 16px;
      padding: 1.5rem;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      background: linear-gradient(195deg, #42424a 0%, #ec407a 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
</head>

<body class="landing-page bg-gray-200">
  <!-- Navbar -->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav
          class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-0">
            <a class="navbar-brand font-weight-bolder ms-sm-3" href="#home">
              <i class="material-symbols-rounded me-1">school</i>
              KKN UNAYA
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
              data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
              <ul class="navbar-nav navbar-nav-hover mx-auto">
                <li class="nav-item">
                  <a class="nav-link nav-link-custom" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-custom" href="#panduan">Panduan KKN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-custom" href="#lokasi">Lokasi KKN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-custom" href="#jadwal">Jadwal</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-custom" href="#download">Download</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav-link-custom" href="#kontak">Kontak</a>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="{{ route('login') }}" class="btn btn-sm bg-gradient-dark mb-0">
                    <i class="material-symbols-rounded me-1">login</i> Login
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <!-- Hero Section -->
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 text-white">
          <h6 class="text-uppercase opacity-8 mb-3">Kuliah Kerja Nyata</h6>
          <h1 class="display-4 fw-bold mb-4">
            Selamat Datang di Portal<br>
            <span style="color: #f0567a;">KKN Universitas Abulyatama</span>
          </h1>
          <p class="lead opacity-8 mb-5">
            Kuliah Kerja Nyata (KKN) adalah bentuk kegiatan pengabdian kepada masyarakat oleh mahasiswa dengan
            pendekatan lintas keilmuan dan sektoral pada waktu dan daerah tertentu.
          </p>
          <div class="d-flex gap-3">
            <a href="{{ route('login') }}" class="btn btn-white btn-lg">
              <i class="material-symbols-rounded me-2">how_to_reg</i> Daftar KKN
            </a>
            <a href="#panduan" class="btn btn-outline-white btn-lg">
              <i class="material-symbols-rounded me-2">info</i> Pelajari Lebih Lanjut
            </a>
          </div>
        </div>
        <div class="col-lg-5 mt-5 mt-lg-0">
          <div class="row g-3">
            <div class="col-6">
              <div class="stat-card">
                <div class="stat-number">{{ $lokasiKkns->count() }}</div>
                <div class="text-secondary">Lokasi KKN</div>
              </div>
            </div>
            <div class="col-6">
              <div class="stat-card">
                <div class="stat-number">{{ $jadwalKkns->count() }}</div>
                <div class="text-secondary">Periode KKN</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Panduan Section -->
  <section class="py-6" id="panduan">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Panduan Pendaftaran KKN</h2>
        <p class="text-secondary">Ikuti langkah-langkah berikut untuk mendaftar KKN</p>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="timeline-item">
            <div class="timeline-number">1</div>
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="mb-2">Cek Persyaratan</h5>
                <p class="text-secondary mb-0">
                  Pastikan Anda telah memenuhi minimal 100 SKS dan tidak memiliki tunggakan pembayaran.
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="timeline-number">2</div>
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="mb-2">Login ke Portal</h5>
                <p class="text-secondary mb-0">
                  Login menggunakan NIM dan password yang telah terdaftar di sistem akademik.
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="timeline-number">3</div>
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="mb-2">Lengkapi Biodata</h5>
                <p class="text-secondary mb-0">
                  Isi formulir biodata dengan lengkap termasuk nomor HP, ukuran jas, dan keahlian.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="timeline-item">
            <div class="timeline-number">4</div>
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="mb-2">Lakukan Pembayaran</h5>
                <p class="text-secondary mb-0">
                  Bayar biaya KKN melalui metode pembayaran yang tersedia (Transfer Bank, E-Wallet, dll).
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="timeline-number">5</div>
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="mb-2">Tunggu Penempatan</h5>
                <p class="text-secondary mb-0">
                  Setelah pembayaran terverifikasi, tunggu pengumuman lokasi penempatan KKN Anda.
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="timeline-number">6</div>
            <div class="card shadow-sm">
              <div class="card-body">
                <h5 class="mb-2">Cetak Bukti Pendaftaran</h5>
                <p class="text-secondary mb-0">
                  Download dan cetak bukti pendaftaran sebagai tanda keikutsertaan KKN.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Lokasi Section -->
  <section class="py-6 bg-white" id="lokasi">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Lokasi KKN</h2>
        <p class="text-secondary">Daftar lokasi KKN yang tersedia</p>
      </div>
      <div class="row g-4">
        @forelse($lokasiKkns->take(9) as $lokasi)
          <div class="col-md-6 col-lg-4">
            <div class="card card-lokasi shadow-sm h-100">
              <div class="card-body">
                <div class="d-flex align-items-start">
                  <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow"
                    style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                    <i class="material-symbols-rounded">location_on</i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-1">{{ $lokasi->nama_desa }}</h6>
                    <p class="text-sm text-secondary mb-0">
                      {{ $lokasi->kecamatan }}, {{ $lokasi->kabupaten_kota }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p class="text-secondary">Belum ada data lokasi KKN.</p>
          </div>
        @endforelse
      </div>
      @if($lokasiKkns->count() > 9)
        <div class="text-center mt-4">
          <a href="{{ route('login') }}" class="btn bg-gradient-dark">
            Lihat Semua Lokasi <i class="material-symbols-rounded ms-1">arrow_forward</i>
          </a>
        </div>
      @endif
    </div>
  </section>

  <!-- Jadwal Section -->
  <section class="py-6" id="jadwal">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Jadwal KKN</h2>
        <p class="text-secondary">Jadwal pelaksanaan KKN tahun ini</p>
      </div>
      <div class="row justify-content-center g-4">
        @forelse($jadwalKkns->take(3) as $jadwal)
          <div class="col-lg-4">
            <div class="jadwal-card h-100">
              <div class="d-flex align-items-center mb-3">
                <i class="material-symbols-rounded text-lg me-2">event</i>
                <h5 class="mb-0">{{ $jadwal->nama_periode ?? 'Periode KKN' }}</h5>
              </div>
              <div class="mb-3">
                <small class="opacity-8">Pendaftaran Dibuka</small>
                <p class="mb-0">{{ \Carbon\Carbon::parse($jadwal->tanggal_pendaftaran_dibuka)->format('d F Y') }}</p>
              </div>
              <div class="mb-3">
                <small class="opacity-8">Pendaftaran Ditutup</small>
                <p class="mb-0">{{ \Carbon\Carbon::parse($jadwal->tanggal_pendaftaran_ditutup)->format('d F Y') }}</p>
              </div>
              <div>
                <small class="opacity-8">Status</small>
                @php
                  $now = now();
                  $isOpen = $now >= $jadwal->tanggal_pendaftaran_dibuka && $now <= $jadwal->tanggal_pendaftaran_ditutup;
                @endphp
                <p class="mb-0">
                  @if($isOpen)
                    <span class="badge bg-success">Pendaftaran Dibuka</span>
                  @else
                    <span class="badge bg-secondary">Pendaftaran Ditutup</span>
                  @endif
                </p>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p class="text-secondary">Belum ada jadwal KKN.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Download Section -->
  <section class="py-6 bg-white" id="download">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Download</h2>
        <p class="text-secondary">Unduh dokumen dan formulir yang diperlukan</p>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4">
          <div class="card download-card shadow-sm h-100">
            <div class="card-body text-center py-4">
              <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow mx-auto mb-3"
                style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                <i class="material-symbols-rounded" style="font-size: 32px;">description</i>
              </div>
              <h5>Panduan KKN</h5>
              <p class="text-secondary text-sm">Buku panduan lengkap pelaksanaan KKN</p>
              <a href="#" class="btn btn-outline-dark btn-sm">
                <i class="material-symbols-rounded me-1">download</i> Download
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card download-card shadow-sm h-100">
            <div class="card-body text-center py-4">
              <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow mx-auto mb-3"
                style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                <i class="material-symbols-rounded" style="font-size: 32px;">edit_document</i>
              </div>
              <h5>Form Laporan</h5>
              <p class="text-secondary text-sm">Template laporan akhir KKN</p>
              <a href="#" class="btn btn-outline-dark btn-sm">
                <i class="material-symbols-rounded me-1">download</i> Download
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card download-card shadow-sm h-100">
            <div class="card-body text-center py-4">
              <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow mx-auto mb-3"
                style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                <i class="material-symbols-rounded" style="font-size: 32px;">folder_zip</i>
              </div>
              <h5>Template Kegiatan</h5>
              <p class="text-secondary text-sm">Template dokumentasi program kerja</p>
              <a href="#" class="btn btn-outline-dark btn-sm">
                <i class="material-symbols-rounded me-1">download</i> Download
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak Section -->
  <section class="py-6" id="kontak">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Kontak Kami</h2>
        <p class="text-secondary">Hubungi kami jika ada pertanyaan</p>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <div class="card-body text-center py-4">
              <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow mx-auto mb-3"
                style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                <i class="material-symbols-rounded" style="font-size: 32px;">location_on</i>
              </div>
              <h5>Alamat</h5>
              <p class="text-secondary text-sm mb-0">
                Jl. Blang Bintang Lama No.17<br>
                Lampoh Keude, Aceh Besar
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <div class="card-body text-center py-4">
              <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow mx-auto mb-3"
                style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                <i class="material-symbols-rounded" style="font-size: 32px;">call</i>
              </div>
              <h5>Telepon</h5>
              <p class="text-secondary text-sm mb-0">
                (0651) 7551966<br>
                Senin - Jumat: 08.00 - 16.00 WIB
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <div class="card-body text-center py-4">
              <div class="icon-shape bg-gradient-dark text-white rounded-circle shadow mx-auto mb-3"
                style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                <i class="material-symbols-rounded" style="font-size: 32px;">mail</i>
              </div>
              <h5>Email</h5>
              <p class="text-secondary text-sm mb-0">
                lppm@abulyatama.ac.id<br>
                kkn@abulyatama.ac.id
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h4 class="text-white mb-3">
            <i class="material-symbols-rounded me-2">school</i>KKN UNAYA
          </h4>
          <p class="text-white opacity-8 mb-0">
            Portal Kuliah Kerja Nyata<br>
            Universitas Abulyatama
          </p>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h6 class="text-white text-uppercase mb-3">Link Cepat</h6>
          <ul class="list-unstyled">
            <li><a href="#home" class="text-white opacity-8 text-decoration-none">Home</a></li>
            <li><a href="#panduan" class="text-white opacity-8 text-decoration-none">Panduan KKN</a></li>
            <li><a href="#lokasi" class="text-white opacity-8 text-decoration-none">Lokasi KKN</a></li>
            <li><a href="{{ route('login') }}" class="text-white opacity-8 text-decoration-none">Login</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h6 class="text-white text-uppercase mb-3">Sosial Media</h6>
          <a href="#" class="btn btn-icon-only btn-link text-white opacity-8">
            <i class="fab fa-facebook fa-lg"></i>
          </a>
          <a href="#" class="btn btn-icon-only btn-link text-white opacity-8">
            <i class="fab fa-instagram fa-lg"></i>
          </a>
          <a href="#" class="btn btn-icon-only btn-link text-white opacity-8">
            <i class="fab fa-youtube fa-lg"></i>
          </a>
        </div>
      </div>
      <hr class="bg-white opacity-2 my-4">
      <div class="row">
        <div class="col-12 text-center">
          <p class="text-white opacity-8 mb-0">
            &copy; {{ date('Y') }} KKN Universitas Abulyatama. All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Core JS Files -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/material-dashboard.min.js') }}"></script>
</body>

</html>