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
            font-size: 12px;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            /* Font Serif lebih formal */
            font-size: 12px;
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
            text-transform: uppercase;
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
            text-transform: uppercase;
            font-size: 12px;
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

    {{-- Document Title --}}
    <div class="document-title">
        <h3>Rekapitulasi Peserta KKN Fakultas dan Program Studi Semester {{ strtoupper($namaPeriode) }}</h3>
        {{-- <p>Periode: <strong>{{ $kelompok->jadwalKkn->nama_periode ?? '-' }}</strong></p> --}}
        {{-- <p>PERIODE: <strong></strong></p> --}}
    </div>

    {{-- Summary Table --}}
    <div style="margin-bottom: 20px; margin-top: 50px;">
        <table class="group-details" style="width: 100%;">
            <tr>
                <td style="padding-right: 10px;">Teknik: <strong>{{ $countTeknik }}</strong></td>
                <td style="padding-right: 10px;">Pertanian: <strong>{{ $countPertanian }}</strong></td>
                <td style="padding-right: 10px;">Perikanan: <strong>{{ $countPerikanan }}</strong></td>
                <td style="padding-right: 10px;">Kedokteran: <strong>{{ $countKedokteran }}</strong></td>
            </tr>
            <tr>
                <td style="padding-right: 10px;">Hukum: <strong>{{ $countHukum }}</strong></td>
                <td style="padding-right: 10px;">Kesehatan Masyarakat:
                    <strong>{{ $countKesmas }}</strong>
                </td>
                <td style="padding-right: 10px;">Keguruan dan Ilmu Pendidikan:
                    <strong>{{ $countFkip }}</strong>
                </td>
                <td style="padding-right: 10px;">Ekonomi: <strong>{{ $countEkonomi }}</strong></td>
                <td style="padding-left: 15px; font-weight: bold;">JUMLAH TOTAL {{ $selectedJenisKkn }} :
                    <strong>{{ $pendaftarans->count() }}</strong>
                </td>
            </tr>
        </table>
    </div>

    {{-- Main Table --}}
    <table class="main-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Fakultas / Prodi</th>
                <th width="30">L/P</th>
                <th>No. HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftarans as $pendaftaran)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $pendaftaran->mahasiswa->nim }}</td>
                    <td>{{ $pendaftaran->mahasiswa->nama }}</td>
                    <td>
                        <div>{{ $pendaftaran->mahasiswa->fakultas }}</div>
                        <div>{{ $pendaftaran->mahasiswa->prodi }}</div>
                    </td>
                    <td class="text-center">{{ $pendaftaran->mahasiswa->jenis_kelamin }}</td>
                    <td class="text-center">{{ $pendaftaran->mahasiswa->no_hp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i') }} WIB
    </div>

</body>

</html>