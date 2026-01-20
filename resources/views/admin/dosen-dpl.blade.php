@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3"> Dosen Pembimbing Lapangan KKN </h4>
                            <h6 class="text-white ps-3">Daftar Dosen Pembimbing Lapangan KKN</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div>
                                <button type="button" class="btn bg-gradient-dark mb-0 btn-add" data-bs-toggle="modal"
                                    data-bs-target="#modalDosen">
                                    <i class="material-symbols-rounded text-sm me-1">add</i> Tambah DPL
                                </button>
                            </div>
                            <form action="{{ route('admin.dosen-dpl') }}" method="GET" class="mb-0">
                                <div class="input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}"
                                    style="min-width: 250px;">
                                    <label class="form-label">Cari DPL...</label>
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
                                            NUPTK</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama DPL</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Program Studi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bidang Keahlian
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No Handphone
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @include('admin.partials.dosen-dpl-table')
                                </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-3 mb-4">
                                {{ $dosendpls->appends(request()->query())->links('vendor.pagination.simple-dark') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Global (Tambah & Edit) --}}
    <div class="modal fade" id="modalDosen" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- ID Judul diubah jadi dinamis --}}
                    <h5 class="modal-title font-weight-normal" id="modalTitle">Tambah DPL</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Form diberikan ID --}}
                <form id="formDosen" action="{{ route('tambahDosen') }}" method="POST">
                    @csrf
                    {{-- Container untuk menampung method PUT saat edit --}}
                    <div id="methodInput"></div>

                    <div class="modal-body">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">NUPTK</label>
                            {{-- Input diberikan ID --}}
                            <input type="number" class="form-control" name="nuptk" id="nuptk" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Nama DPL</label>
                            <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Program Studi</label>
                            <input type="text" class="form-control" name="prodi" id="prodi" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Bidang Keahlian</label>
                            <input type="text" class="form-control" name="bidang_keahlian" id="bidang_keahlian" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">No Handphone</label>
                            <input type="number" class="form-control" name="no_hp" id="no_hp" required>
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
                $('#modalTitle').text('Tambah Dosen DPL');
                $('#formDosen').attr('action', "{{ route('tambahDosen') }}");

                // Hapus Method PUT (Kembali ke POST murni)
                $('#methodInput').empty();

                // Kosongkan Form
                $('#nuptk').val('');
                $('#nama_dosen').val('');


                // Reset Label Material Dashboard (Turun ke bawah)
                $('.input-group').removeClass('is-filled');
            });

            // script edit
            // Pakai 'on click' ke body supaya aman kalau tabelmu pakai pagination ajax
            $('body').on('click', '.btn-edit', function () {

                // Ambil data dari tombol yang diklik
                let nuptk = $(this).data('nuptk');
                let nama_dosen = $(this).data('nama_dosen');
                let prodi = $(this).data('prodi');
                let bidang_keahlian = $(this).data('bidang_keahlian');
                let no_hp = $(this).data('no_hp');
                let url = $(this).data('url');

                // Ganti Judul & URL Action Form
                $('#modalTitle').text('Edit Dosen DPL');
                $('#formDosen').attr('action', url);

                // Tambahkan Hidden Input Method PUT (Wajib buat Update di Laravel)
                $('#methodInput').html('<input type="hidden" name="_method" value="PUT">');

                // Isi Input dengan Data Lama
                $('#nuptk').val(nuptk);
                $('#nama_dosen').val(nama_dosen);
                $('#prodi').val(prodi);
                $('#bidang_keahlian').val(bidang_keahlian);
                $('#no_hp').val(no_hp);

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
                    url: "{{ route('admin.dosen-dpl') }}",
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
        $(document).on('submit', '.form-hapus-dosen', function (e) {
            e.preventDefault(); // Stop form submit asli

            let form = this; // Simpan form yang sedang diklik

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin menghapus Dosen ini? Data tidak bisa kembali.',
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