@extends('layouts.app')

@section('content')
  <div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4"
      style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
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
                      <div class="card h-100 shadow-sm border">
                          <div class="card-header pb-0 p-3 bg-transparent">
                              <div class="d-flex align-items-center">
                                  <i class="material-symbols-rounded text-primary me-2 text-lg">school</i>
                                  <h6 class="mb-0">Informasi Akademik & Pribadi</h6>
                              </div>
                          </div>
                          <div class="card-body p-3">
                              <div class="table-responsive">
                                  <table class="table align-items-center mb-0">
                                      <tbody>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7 w-30">
                                                  Nama Lengkap</td>
                                              <td class="py-2 border-0 text-dark text-sm font-weight-bold">
                                                  {{ $mahasiswa->nama }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  NIM</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->nim }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Fakultas</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->fakultas ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Program Studi</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->prodi ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Email</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->email }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  No. HP</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->no_hp ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  No. HP Darurat</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->no_hp_darurat ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Jenis Kelamin</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  @if ($mahasiswa->jenis_kelamin == 'L')
                                                    Laki-laki
                                                  @elseif($mahasiswa->jenis_kelamin == 'P')
                                                    Perempuan
                                                  @else
                                                    -
                                                  @endif
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Jumlah SKS</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->jumlah_sks ?? '-' }}
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-12 col-xl-6">
                      <div class="card h-100 shadow-sm border">
                          <div class="card-header pb-0 p-3 bg-transparent">
                              <div class="d-flex align-items-center">
                                  <i class="material-symbols-rounded text-primary me-2 text-lg">build</i>
                                  <h6 class="mb-0">Biodata & Perlengkapan KKN</h6>
                              </div>
                          </div>
                          <div class="card-body p-3">
                              <div class="table-responsive">
                                  <table class="table align-items-center mb-0">
                                      <tbody>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7 w-40">
                                                  Ukuran Jaket/Rompi</td>
                                              <td class="py-2 border-0 text-dark text-sm font-weight-bold">
                                                  {{ $mahasiswa->ukuran_jacket_rompi ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Kepemilikan Kendaraan</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->punya_kendaraan ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Tipe Kendaraan</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->tipe_kendaraan ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Kepemilikan Lisensi (SIM)</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->punya_lisensi ?? '-' }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="ps-0 py-2 border-0 text-secondary text-xs font-weight-bolder opacity-7">
                                                  Keahlian</td>
                                              <td class="py-2 border-0 text-dark text-sm">
                                                  {{ $mahasiswa->keahlian ?? '-' }}
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
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

