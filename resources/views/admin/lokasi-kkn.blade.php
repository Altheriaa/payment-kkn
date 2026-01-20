<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>
@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3"> Lokasi KKN </h4>
                            <h6 class="text-white ps-3">Daftar Lokasi KKN</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div>
                                <button type="button" class="btn bg-gradient-dark mb-0 btn-add" data-bs-toggle="modal"
                                    data-bs-target="#modalLokasi">
                                    <i class="material-symbols-rounded text-sm me-1">add</i> Tambah Lokasi
                                </button>
                            </div>
                            <form action="{{ route('admin.lokasi-kkn') }}" method="GET" class="mb-0">
                                <div class="input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}"
                                    style="min-width: 250px;">
                                    <label class="form-label">Cari Lokasi...</label>
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
                                            Kabupaten/Kota</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kecamatan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Desa
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @include('admin.partials.lokasi-kkn-table')
                                </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-3 mb-4">
                                {{ $lokasiKkns->appends(request()->query())->links('vendor.pagination.simple-dark') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Global (Tambah & Edit) --}}
    <div class="modal fade" id="modalLokasi" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- ID Judul diubah jadi dinamis --}}
                    <h5 class="modal-title font-weight-normal" id="modalTitle">Tambah Lokasi KKN</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Form diberikan ID --}}
                <form id="formLokasi" action="{{ route('tambahLokasiKkn') }}" method="POST">
                    @csrf
                    {{-- Container untuk menampung method PUT saat edit --}}
                    <div id="methodInput"></div>

                    <div class="modal-body">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Kabupaten/Kota</label>
                            {{-- Input diberikan ID --}}
                            <input type="text" class="form-control" name="kabupaten_kota" id="kabupaten_kota">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Desa</label>
                            <input type="text" class="form-control" name="nama_desa" id="nama_desa">
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
                $('#modalTitle').text('Tambah Lokasi KKN');
                $('#formLokasi').attr('action', "{{ route('tambahLokasiKkn') }}");

                // Hapus Method PUT (Kembali ke POST murni)
                $('#methodInput').empty();

                // Kosongkan Form
                $('#kabupaten_kota').val('');
                $('#kecamatan').val('');
                $('#nama_desa').val('');

                // Reset Label Material Dashboard (Turun ke bawah)
                $('.input-group').removeClass('is-filled');
            });

            // script edit
            // Pakai 'on click' ke body supaya aman kalau tabelmu pakai pagination ajax
            $('body').on('click', '.btn-edit', function () {

                // Ambil data dari tombol yang diklik
                let kab = $(this).data('kabupaten');
                let kec = $(this).data('kecamatan');
                let desa = $(this).data('desa');
                let url = $(this).data('url');

                // Ganti Judul & URL Action Form
                $('#modalTitle').text('Edit Lokasi KKN');
                $('#formLokasi').attr('action', url);

                // Tambahkan Hidden Input Method PUT (Wajib buat Update di Laravel)
                $('#methodInput').html('<input type="hidden" name="_method" value="PUT">');

                // Isi Input dengan Data Lama
                $('#kabupaten_kota').val(kab);
                $('#kecamatan').val(kec);
                $('#nama_desa').val(desa);

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
                    url: "{{ route('admin.lokasi-kkn') }}",
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
        $(document).on('submit', '.form-hapus-lokasi', function (e) {
            e.preventDefault(); // Stop form submit asli

            let form = this; // Simpan form yang sedang diklik

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin menghapus lokasi ini? Data tidak bisa kembali.',
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