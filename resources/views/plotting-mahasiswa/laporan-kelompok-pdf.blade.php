<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kelompok KKN</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            /* Font Serif lebih formal */
            font-size: 11px;
            padding: 30px;
        }

        /* Corporate Header */
        .corporate-header {
            width: 100%;
            border-bottom: 2px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .corporate-header table {
            width: 100%;
            border: none;
            margin-top: 0;
        }

        .corporate-header td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo-cell {
            width: 15%;
            text-align: left;
        }

        .logo-cell img {
            height: 80px;
            /* Ukuran Fixed agar tidak gepeng */
            width: auto;
        }

        .info-cell {
            width: 100%;
            text-align: left;
            /* Rata kiri sesuai request */
            padding-left: 20px;
            /* Jarak sedikit dari logo */
        }

        .info-cell h1 {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .info-cell h2 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .info-cell .address {
            font-size: 10px;
            font-style: italic;
        }

        /* Document Title */
        .document-title {
            text-align: center;
            margin: 20px 0;
        }

        .document-title h3 {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .document-title p {
            font-size: 11px;
        }

        /* Group Detail Table */
        .group-details {
            margin-bottom: 15px;
            font-size: 11px;
        }

        .group-details td {
            padding: 3px 0;
            border: none;
        }

        /* Main Table */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            padding: 6px;
        }

        /* Professional Theme: Navy Blue */
        .main-table th {
            background-color: #e3e3e3;
            /* Abu-abu muda untuk header formal */
            color: #000;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 9px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            text-align: right;
            font-style: italic;
            color: #555;
        }
    </style>
</head>

<body>

    {{-- Corporate Header using Table for Perfect Alignment --}}
    <div class="corporate-header">
        <table>
            <tr>
                <td class="logo-cell">
                    {{-- Pastikan path gambar absolut untuk DOMPDF --}}
                    <img src="{{ public_path('assets/img/unaya.png') }}" alt="Logo UA">
                </td>
                <td class="info-cell">
                    <h1>Universitas Abulyatama</h1>
                    <h2>Lembaga Penelitian dan Pengabdian Masyarakat (LPPM)</h2>
                    <div class="address">
                        Jl. Blang Bintang Lama Km. 8,5 Lampoh Keude, Aceh Besar<br>
                        Telp: (0651) 23699 | Email: lppm@abulyatama.ac.id | Website: unaya.ac.id
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Document Title --}}
    <div class="document-title">
        <h3>Laporan Penempatan Kelompok KKN</h3>
        <p>Periode: <strong>{{ $kelompok->jadwalKkn->nama_periode ?? '-' }}</strong></p>
    </div>

    {{-- Group Info --}}
    <table class="group-details">
        <tr>
            <td width="120"><strong>Nama Kelompok</strong></td>
            <td width="10">:</td>
            <td>{{ $kelompok->nama_kelompok ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Jenis KKN</strong></td>
            <td>:</td>
            <td>{{ $kelompok->jenis_kkn ?? '-' }}</td>
        </tr>
    </table>

    {{-- Main Table --}}
    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2" width="30">No</th>
                <th rowspan="2">Nama Mahasiswa</th>
                <th rowspan="2">NIM</th>
                <th rowspan="2">Fakultas / Prodi</th>
                <th rowspan="2">L/P</th>
                <th colspan="3" style="background-color: #f0f0f0;">Dosen Pembimbing</th>
                <th colspan="2" style="background-color: #f0f0f0;">Lokasi KKN</th>
            </tr>
            <tr>
                <th style="font-size: 9px;">Nama</th>
                <th style="font-size: 9px;">NUPTK</th>
                <th style="font-size: 9px;">HP</th>
                <th style="font-size: 9px;">Desa</th>
                <th style="font-size: 9px;">Kecamatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggota as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><b>{{ $item->mahasiswa->nama ?? '-' }}</b></td>
                    <td class="text-center">{{ $item->mahasiswa->nim ?? '-' }}</td>
                    <td>
                        {{ $item->mahasiswa->prodi ?? '-' }}<br>
                        <span style="font-size: 8px; color: #555;">{{ $item->mahasiswa->fakultas ?? '' }}</span>
                    </td>
                    <td class="text-center">
                        {{ $item->mahasiswa->jenis_kelamin == 'L' ? 'L' : 'P' }}
                    </td>

                    {{-- Rowspan Logic --}}
                    @if($index == 0)
                        <td rowspan="{{ count($anggota) }}" class="text-center"
                            style="vertical-align: middle; background-color: #fcfcfc;">
                            {{ $kelompok->dosenDpl->nama_dosen ?? '-' }}
                        </td>
                        <td rowspan="{{ count($anggota) }}" class="text-center"
                            style="vertical-align: middle; background-color: #fcfcfc;">
                            {{ $kelompok->dosenDpl->nuptk ?? '-' }}
                        </td>
                        <td rowspan="{{ count($anggota) }}" class="text-center"
                            style="vertical-align: middle; background-color: #fcfcfc;">
                            {{ $kelompok->dosenDpl->no_hp ?? '-' }}
                        </td>

                        <td rowspan="{{ count($anggota) }}" class="text-center"
                            style="vertical-align: middle; background-color: #fcfcfc;">
                            {{ $kelompok->lokasiKkn->nama_desa ?? '-' }}
                        </td>
                        <td rowspan="{{ count($anggota) }}" class="text-center"
                            style="vertical-align: middle; background-color: #fcfcfc;">
                            {{ $kelompok->lokasiKkn->kecamatan ?? '-' }}
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Belum ada anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i') }} WIB
    </div>

</body>

</html>