@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3">Laporan Bulanan</h4>
                            <h6 class="text-white ps-3">Laporan keuangan kkn bulanan</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('admin.laporan.bulanan') }}" method="GET">
                            <h6 class="mt-1 ps-1">Filter Periode </h6>
                            <div class="row g-2 align-items-center ">
                                {{-- Dropdown Bulan --}}
                                <div class="col-6 col-md-3">
                                    <div class="input-group input-group-static">
                                        <select name="bulan" class="form-control px-2 border border-secondary"
                                            style="height: 39px; border-radius: 8px !important;">
                                            @foreach($listBulan as $key => $val)
                                                <option value="{{ $key }}" {{ $bulanDipilih == $key ? 'selected' : '' }}>
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Dropdown Tahun --}}
                                <div class="col-6 col-md-3">
                                    <div class="input-group input-group-static">
                                        <select name="tahun" class="form-control px-2 border border-secondary"
                                            style="height: 39px; border-radius: 8px !important;">
                                            @for($i = date('Y'); $i >= date('Y') - 4; $i--)
                                                <option value="{{ $i }}" {{ $tahunDipilih == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                {{-- Tombol Filter --}}
                                <div class="col-6 col-md-2">
                                    <button type="submit" class="btn btn-primary w-100 mb-0" style="height: 39px;">
                                        <i class="material-symbols-rounded text-sm me-1">search</i> Filter
                                    </button>
                                </div>

                                {{-- Tombol Cetak PDF --}}
                                <div class="col-6 col-md-2">
                                    <a href="{{ route('admin.cetak.laporan', ['bulan' => $bulanDipilih, 'tahun' => $tahunDipilih]) }}"
                                        class="btn btn-outline-danger w-100 mb-0 d-flex align-items-center justify-content-center"
                                        style="height: 39px;" target="_blank">
                                        <i class="material-symbols-rounded text-sm me-1">picture_as_pdf</i> Cetak PDF
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th colspan="12" class="text-center pt-4 pb-3">
                                            Laporan Keuangan : <span class="text-primary font-weight-bold">
                                                {{ $listBulan[$bulanDipilih] }} {{ $tahunDipilih }}
                                            </span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis KKN</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah Transaksi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Pendapatan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @forelse($laporan as $row)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $referensiJenisKkn[$row->jenis_kkn_id] ?? 'ID: ' . $row->jenis_kkn_id }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->total_transaksi }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-success text-sm font-weight-bold">
                                                    Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0"></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                </p>
                                            </td>
                                            <td>
                                                <span class="text-success text-sm font-weight-bold">
                                                    <h5 class="text-primary font-weight-bolder mb-0">
                                                        Grand Total Transaksi
                                                    </h5>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-success text-sm font-weight-bold">
                                                    <h5 class="text-primary font-weight-bolder mb-0">
                                                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                                    </h5>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <span class="text-muted text-sm">Belum ada transaksi lunas pada bulan
                                                    ini.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection