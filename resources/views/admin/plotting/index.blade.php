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
                                <button type="button" class="btn bg-gradient-dark mb-0 btn-add" data-bs-toggle="modal"
                                    data-bs-target="#modalKelompok">
                                    <i class="material-symbols-rounded text-sm me-1">add</i> Tambah Kelompok
                                </button>
                                <button type="button" class="btn bg-gradient-primary mb-0 btn-add" data-bs-toggle="modal"
                                    data-bs-target="#modalKelompok">
                                    <i class="material-symbols-rounded text-sm me-1">print</i> Cetak Kelompok Periode
                                </button>
                            </div>
                            <form action="{{ route('admin.plotting') }}" method="GET" class="mb-0">
                                <div class="input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}"
                                    style="min-width: 250px;">
                                    <label class="form-label">Cari Kelompok...</label>
                                    <input type="text" class="form-control" id="searchInput" name="search"
                                        value="{{ request('search') }}" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </form>
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
                                    @include('admin.plotting.partials.kelompok-table')
                                </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-3 mb-4">
                                {{ $kelompoks->appends(request()->query())->links('vendor.pagination.simple-dark') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Global (Tambah & Edit) --}}
    <div class="modal fade" id="modalKelompok" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- ID Judul diubah jadi dinamis --}}
                    <h5 class="modal-title font-weight-normal" id="modalTitle">Tambah Kelompok KKN</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Form diberikan ID --}}
                <form id="formKelompok" action="{{ route('tambahKelompok') }}" method="POST">
                    @csrf
                    {{-- Container untuk menampung method PUT saat edit --}}
                    <div id="methodInput"></div>

                    <div class="modal-body">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Jadwal KKN</label>
                            {{-- Input diberikan ID --}}
                            <select class="form-control" name="jadwal_kkn_id" id="jadwal_kkn_id" required>
                                <option value=""></option>
                                @foreach ($jadwalKkns as $jadwalKkn)
                                    <option value="{{ $jadwalKkn->id }}">{{ $jadwalKkn->nama_periode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Dosen Pembimbing Lapangan</label>
                            <select class="form-control" name="dpl_id" id="dpl_id" required>
                                <option value="">Pilih Dosen Pembimbing Lapangan</option>
                                @foreach ($dosenDpls as $dosenDpl)
                                    <option value="{{ $dosenDpl->id }}">{{ $dosenDpl->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Lokasi KKN</label>
                            <select class="form-control" name="lokasi_kkn_id" id="lokasi_kkn_id" required>
                                <option value="">Pilih Lokasi KKN</option>
                                @foreach ($lokasiKkns as $lokasiKkn)
                                    <option value="{{ $lokasiKkn->id }}">{{ $lokasiKkn->nama_desa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Nama Kelompok</label>
                            <input type="text" class="form-control" name="nama_kelompok" id="nama_kelompok" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Jenis KKN</label>
                            <select class="form-control" name="jenis_kkn" id="jenis_kkn" required>
                                <option value="">Pilih Jenis KKN</option>
                                <option value="KKN-UNAYA Regular">KKN-UNAYA Regular</option>
                                <option value="KKN-UNAYA Non-Regular">KKN-UNAYA Non-Regular</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- script edit/tambah --}}
    <script>
        $(document).ready(function () {

            // script tambah
            $('.btn-add').click(function () {
                // Ganti Judul & URL Action Form
                $('#modalTitle').text('Tambah Kelompok KKN');
                $('#formKelompok').attr('action', "{{ route('tambahKelompok') }}");

                // Hapus Method PUT (Kembali ke POST murni)
                $('#methodInput').empty();

                // Kosongkan Form
                $('#jadwal_kkn_id').val('');
                $('#dpl_id').val('');
                $('#lokasi_kkn_id').val('');
                $('#nama_kelompok').val('');
                $('#jenis_kkn').val('');

                // LOGIKA KUNCI UTAMA (RESET):
                // 1. Hidupkan kembali select box biar bisa dipilih
                $('#jenis_kkn').prop('disabled', false);
                // 2. Hapus input hidden sisa edit (kalau ada)
                $('#hidden_jenis_kkn').remove();

                // Reset Label Material Dashboard (Turun ke bawah)
                $('.input-group').removeClass('is-filled');
            });

            // script edit
            // Pakai 'on click' ke body supaya aman kalau tabelmu pakai pagination ajax
            $('body').on('click', '.btn-edit', function () {

                // Ambil data dari tombol yang diklik
                let jadwal_kkn_id = $(this).data('jadwal_kkn_id');
                let dpl_id = $(this).data('dpl_id');
                let lokasi_kkn_id = $(this).data('lokasi_kkn_id');
                let nama_kelompok = $(this).data('nama_kelompok');
                let jenis_kkn = $(this).data('jenis_kkn');
                let url = $(this).data('url');

                // Ganti Judul & URL Action Form
                $('#modalTitle').text('Edit Kelompok KKN');
                $('#formKelompok').attr('action', url);

                // Tambahkan Hidden Input Method PUT (Wajib buat Update di Laravel)
                $('#methodInput').html('<input type="hidden" name="_method" value="PUT">');

                // Isi Input dengan Data Lama
                $('#jadwal_kkn_id').val(jadwal_kkn_id);
                $('#dpl_id').val(dpl_id);
                $('#lokasi_kkn_id').val(lokasi_kkn_id);
                $('#nama_kelompok').val(nama_kelompok);
                $('#jenis_kkn').val(jenis_kkn);

                // Mematikan Select Box (User tidak bisa klik)
                $('#jenis_kkn').prop('disabled', true);

                // Buat Input Hidden Palsu
                // Karena elemen 'disabled' tidak dikirim ke controller
                // Jadi kita kirim value-nya lewat input hidden ini
                if ($('#hidden_jenis_kkn').length === 0) {
                    $('#formKelompok').append('<input type="hidden" name="jenis_kkn" id="hidden_jenis_kkn" value="' + jenis_kkn + '">');
                } else {
                    $('#hidden_jenis_kkn').val(jenis_kkn);
                }

                // Tambah class 'is-filled' supaya label naik ke atas (Gaya Material UI)
                $('.input-group').addClass('is-filled');
            });
        });
    </script>

    {{-- script search --}}
    <script>
        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                let search = $(this).val();
                $.ajax({
                    url: "{{ route('admin.plotting') }}",
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