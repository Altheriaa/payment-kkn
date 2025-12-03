<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan KKN</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3 {
            margin: 0;
        }

        .header h2 {
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        /* Tanda Tangan */
        .signature-section {
            margin-top: 40px;
            width: 100%;
        }

        .signature-box {
            float: right;
            width: 200px;
            text-align: center;
        }

        .signature-name {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Pendapatan KKN</h2>
        <h3>Universitas Abulyatama</h3>
        <p>Periode : {{ $bulan }} {{ $tahun }}</p>
    </div>

    <hr>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Jenis KKN</th>
                <th width="20%">Jumlah Transaksi</th>
                <th width="30%">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        {{-- Lookup Nama Jenis KKN dari Array API --}}
                        {{ $referensiJenisKkn[$row->jenis_kkn_id] ?? 'Jenis KKN (ID: ' . $row->jenis_kkn_id . ')' }}
                    </td>
                    <td class="text-center">{{ $row->total_transaksi }} Peserta</td>
                    <td class="text-right">Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right bold">GRAND TOTAL</td>
                <td class="text-right bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Banda Aceh, {{ date('d F Y') }}</p>
            <p>Kepala Bagian Keuangan,</p>
            <div class="signature-name">
                ( ..................................... )
            </div>
            <p>NIP. ...........................</p>
        </div>
    </div>

</body>

</html>