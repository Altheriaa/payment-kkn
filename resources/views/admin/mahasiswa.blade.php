@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3"> Mahasiswa</h4>
                            <h6 class="text-white ps-3">Daftar mahasiswa</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('mahasiswa.admin') }}" method="GET">
                            <div class="row g-2 align-items-center justify-content-end">

                                {{-- Dropdown Status --}}
                                <div class="col-12 col-md-5">
                                    <div class="input-group input-group-static">
                                        <select name="status_kkn" class="form-control px-2 border border-secondary"
                                            style="height: 39px; border-radius: 8px !important;">
                                            <option value="">Filter Berdasarkan...</option>
                                            <option value="Sudah Daftar" {{ request('status_kkn') == 'Sudah Daftar' ? 'selected' : '' }}>
                                                Sudah Daftar</option>
                                            <option value="Belum Daftar" {{ request('status_kkn') == 'Belum Daftar' ? 'selected' : '' }}>
                                                Belum Daftar</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Tombol Filter & Reset (Di Mobile akan sejajar berdampingan) --}}
                                <div class="col-8 col-md-2">
                                    <button type="submit" class="btn bg-gradient-dark mb-0 w-100" style="height: 39px;">
                                        <i class="material-symbols-rounded text-sm me-1">filter_alt</i> Filter
                                    </button>
                                </div>
                                <div class="col-4 col-md-1">
                                    <a href="{{ route('mahasiswa.admin') }}"
                                        class="btn btn-outline-secondary w-100 mb-0 d-flex align-items-center justify-content-center"
                                        style="height: 39px;" data-bs-toggle="tooltip" title="Reset Filter">
                                        <i class="material-symbols-rounded text-sm">undo</i>
                                    </a>
                                </div>

                                {{-- Input Pencarian --}}
                                <div class="col-12 col-md-4">
                                    {{-- Tambahkan logic 'is-filled' agar label tidak menumpuk saat ada value --}}
                                    <div class="input-group input-group-outline {{ request('search') ? 'is-filled' : '' }}">
                                        <label class="form-label">Cari Mahasiswa...</label>
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
                                            NIM</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status KKN
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @include('admin.partials.mahasiswa-table')
                                </tbody>
                            </table>
                            {{-- Pagination Links --}}
                            <div class="d-flex justify-content-center mt-4 mb-4">
                                {{ $mahasiswas->appends(request()->query())->links('vendor.pagination.simple-dark') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script Pencarian --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#searchInput').on('keyup', function () {
                    let search = $(this).val();
                    let status = $('select[name="status_kkn"]').val();
                    $.ajax({
                        url: "{{ route('mahasiswa.admin') }}",
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
            });
        </script>
@endsection