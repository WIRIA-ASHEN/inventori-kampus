<!DOCTYPE html>
<html>

<head>
    <title>Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 0px;
        }

        .header img {
            width: 100px;
        }

        .header table {
            border-collapse: collapse;
            margin-bottom: 0px;
        }

        .header-text {
            text-align: center;
            flex-grow: 1;
        }

        .header-text h3,
        .header-text h5,
        .header-text h6 {
            margin: 5px 0;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table th,
        .header-table td {
            text-align: left;
            border: none;
            vertical-align: top !important;
            padding: 5px;
        }

        .header-table th {
            background-color: #f2f2f2;
            font-size: 12px;
        }

        .table2 td {
            font-size: 14px !important;
        }

        .normal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .normal-table th,
        .normal-table td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
            vertical-align: top !important;
        }

        .normal-table th {
            font-size: 12px;
            background-color: #f2f2f2;
        }

        .normal-table td {
            font-size: 10px;
        }

        .rating .fa-star {
            font-size: 24px;
            cursor: pointer;
        }

        .rating .fa-star.checked {
            color: gold;
        }

        .tanggal-table td {
            border: none;
            padding: 0px !important;
        }

        .signature-table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 50px;
            margin-left: 55%;
        }

        .signature-table td {
            border: none;
            text-align: center;
            vertical-align: top !important;
        }

        .signature {
            font-size: 14px;
        }

        .signature .signature-name {
            margin-bottom: 60px;
        }

        .signature .signature-position {
            margin-bottom: 5px;
        }

        .signature .signature-position u {
            display: block;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 100px;">
                    <img src="{{ public_path('logo/logopnp.png') }}" alt="Logo" style="width: 100px;">
                </td>
                <td>
                    <div class="header-text">
                        <h2>Laporan Sistem Informasi Manajemen Peralatan Dan Perlengkapan</h2>
                        <h5>PSDKU TANAH DATAR</h5>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>

    <table class="header-table table2">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                {{-- <th scope="col">Ruangan</th> --}}
                <th scope="col">Merek</th>
                <th scope="col">Kondisi</th>
                <th scope="col">Jumlah Aset</th>
                <th scope="col">Asal Perolehan</th>
                <th scope="col">Tahun Perolehan</th>
            </tr>
        </thead>
        <tbody class="mt-2">
            @php
                use Carbon\Carbon;
                $count = 1;
            @endphp

            @foreach ($barangs as $barang)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama_kategori }}</td>
                    {{-- <td>{{ $barang->ruangan->nama_ruangan }}</td> --}}
                    <td>{{ $barang->merek }}</td>
                    <td>{{ $barang->kondisi->kondisi_barang }}</td>
                    <td>{{ $updatedAset[$barang->id] ?? $barang->jumlah_aset }}</td>
                    <td>{{ $barang->asal_perolehan }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->tahun_perolehan)->translatedFormat('d F Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </table>

    <table class="signature-table">
        <tr>
            <td></td>
            <td class="signature">
                <p class="signature-name">Tanah Datar, {{ date('d F Y') }}</p>
                <p class="signature-position">
                    <u>Cipto Prabowo, S.T., M.T</u>
                    NIP. 19740302 200812 1 001
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
