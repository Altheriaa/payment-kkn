@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3">Riwayat Transaksi</h4>
                            <h6 class="text-white ps-3">Daftar semua transaksi pembayaran KKN Anda</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('admin.riwayat') }}" method="GET">
                            <div class="row g-2 align-items-center justify-content-end">

                                {{-- Dropdown Status --}}
                                <div class="col-12 col-md-5">
                                    <div class="input-group input-group-static">
                                        <select name="status" class="form-control px-2 border border-secondary"
                                            style="height: 39px; border-radius: 8px !important;">
                                            <option value="">Filter Berdasarkan...</option>
                                            <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>
                                                Berhasil</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                Menunggu</option>
                                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Tombol Filter & Reset (Di Mobile akan sejajar berdampingan) --}}
                                <div class="col-8 col-md-2">
                                    <button type="submit" class="btn btn-primary w-100 mb-0" style="height: 39px;">
                                        <i class="material-symbols-rounded text-sm me-1">filter_alt</i> Filter
                                    </button>
                                </div>
                                <div class="col-4 col-md-1">
                                    <a href="{{ route('admin.riwayat') }}"
                                        class="btn btn-outline-secondary w-100 mb-0 d-flex align-items-center justify-content-center"
                                        style="height: 39px;" data-bs-toggle="tooltip" title="Reset Filter">
                                        <i class="material-symbols-rounded text-sm">undo</i>
                                    </a>
                                </div>

                                {{-- Input Pencarian --}}
                                <div class="col-12 col-md-4">
                                    {{-- Tambahkan logic 'is-filled' agar label tidak menumpuk saat ada value --}}
                                    <div class="input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}">
                                        <label class="form-label">Cari Transaksi...</label>
                                        <input type="text" class="form-control" id="searchInput" name="search"
                                            value="{{ request('search') }}" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mahasiswa</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NIM</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Order ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis KKN</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @if($payments->isEmpty())
                                        <tr>
                                            <td colspan="12" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <h6 class="mb-0 text-sm mt-4">Belum ada transaksi</h6>
                                                    <p class="text-xs text-secondary">Anda belum melakukan transaksi pembayaran
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @include('admin.partials.transaksi-table')
                                    @endif
                                </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-4">
                                {{ $payments->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap -->
    {{--
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script> --}}

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{--
    <script>
        function bayarLagi(snapToken) {
            snap.pay(snapToken, {
                onSuccess: function (result) {
                    alert('Pembayaran berhasil!');
                    location.reload();
                },
                onPending: function (result) {
                },
                onError: function (result) {
                    alert('Pembayaran gagal!');
                },
                onClose: function () {
                    console.log('Popup ditutup');
                }
            });
        }
    </script> --}}

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

    {{-- Script Pencarian --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // 1. Script Search (Sudah ada punya kamu)
            $('#searchInput').on('keyup', function () {
                let search = $(this).val();
                let status = $('select[name="status"]').val();
                $.ajax({
                    url: "{{ route('admin.riwayat') }}",
                    type: "GET",
                    data: {
                        search: search,
                        status: status

                    },
                    success: function (response) {
                        $('.table-body').html(response);
                    }
                });
            });

            // 2. Script Hapus dengan Event Delegation (PERBAIKAN)
            // Kita pasang di 'document', memantau class '.form-hapus-transaksi'
            $(document).on('submit', '.form-hapus-transaksi', function (e) {
                e.preventDefault(); // Stop form submit asli

                let form = this; // Simpan form yang sedang diklik

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Yakin ingin menghapus transaksi ini? Data tidak bisa kembali.',
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
        });
    </script>
@endsection