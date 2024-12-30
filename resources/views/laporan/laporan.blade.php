@extends('layouts.app')

@section('title', 'Pinjaman')

@section('header-title', 'Pinjaman')

@section('content')

    <table class="table table-hover table-striped" id="data-table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Merek</th>
                <th scope="col">Kondisi</th>
                <th scope="col">Jumlah Aset</th>
                <th scope="col">Asal Perolehan</th>
                <th scope="col">Tahun Perolehan</th>
            </tr>
        </thead>
        <tbody class="mt-2">
            @php
                $count = 1;
            @endphp

            @foreach ($peminjamanbarangs as $penempatanBarang)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $penempatanBarang->barang->nama_barang }}</td>
                    <td>{{ $penempatanBarang->barang->kategori->nama_kategori }}</td>
                    <td>{{ $penempatanBarang->ruangan->nama_ruangan }}</td>
                    <td>{{ $penempatanBarang->barang->merek }}</td>
                    <td>{{ $penempatanBarang->barang->kondisi->kondisi_barang }}</td>
                    <td>{{ $originalAset[$penempatanBarang->barang->id] }}</td>
                    <td>{{ $penempatanBarang->barang->asal_perolehan }}</td>
                    <td>{{ $penempatanBarang->barang->tahun_perolehan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th>Barang</th>
                {{-- <th>Nama Peminjam</th> --}}
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Keterangan</th>
                <th>Tanggal Kembali</th>
                <th>Respon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="mt-2">

            @php
                $count = 1;
                function truncateText($text, $length = 20)
                {
                    return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
                }
            @endphp

            @foreach ($pinjamans as $peminjamanBarang)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $peminjamanBarang->barang->nama_barang }}</td>
                    {{-- <td>{{ $peminjamanBarang->user->name }}</td> --}}
                    <td>{{ $peminjamanBarang->jumlah }}</td>
                    <td>{{ $peminjamanBarang->tanggal_pinjam }}</td>
                    <td>{{ truncateText($peminjamanBarang->keterangan) }}</td>
                    <td>{{ $peminjamanBarang->tanggal_kembali }}</td>
                    <td>{{ truncateText($peminjamanBarang->respon) }}</td>
                    <td>{{ $peminjamanBarang->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
