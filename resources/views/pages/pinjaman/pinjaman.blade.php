<!-- resources/views/pages/home.blade.php -->
@extends('layouts.app')

@section('title', 'Pinjaman')

@section('header-title', 'Pinjaman')

@section('content')
    <style>
        .outline {
            background-color: transparent;
            color: red;
            border: 2px solid red;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .tambah {
            background-color: transparent;
            color: #ff5e00;
            border: 2px solid #ff5e00;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .inline {
            background-color: #ff5e00;
            color: white;
            border: 2px solid #ff5e00;
            padding: 5px 10px;
            font-size: 16px;
            /* cursor: pointer; */
            /* transition: background-color 0.3s, color 0.3s; */
        }

        .laporan {}
    </style>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="diterima-tab" data-toggle="tab" href="#diterima" role="tab"
                    aria-controls="diterima" aria-selected="true">Diterima</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ditolak-tab" data-toggle="tab" href="#ditolak" role="tab"
                    aria-controls="ditolak" aria-selected="false">Ditolak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="diproses-tab" data-toggle="tab" href="#diproses" role="tab"
                    aria-controls="diproses" aria-selected="false">Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab"
                    aria-controls="selesai" aria-selected="false">Selesai</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Diterima tab -->
            <div class="tab-pane fade show active" id="diterima" role="tabpanel" aria-labelledby="diterima-tab">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th>Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Keterangan</th>
                            <th>Tanggal Kembali</th>
                            <th>Respon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="mt-2">
                        @php
                            use Carbon\Carbon;
                            $count = 1;
                            function truncateText($text, $length = 20)
                            {
                                return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
                            }
                        @endphp
                        @foreach ($peminjamanBarangs->where('status', 'diterima') as $peminjamanBarang)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $peminjamanBarang->barang->nama_barang }}</td>
                                <td>{{ $peminjamanBarang->user->name }}</td>
                                <td>{{ $peminjamanBarang->jumlah }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_pinjam)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText1($peminjamanBarang->keterangan) }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_kembali)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText($peminjamanBarang->respon) }}</td>
                                <td>{{ $peminjamanBarang->status }}</td>
                                <td>
                                    <a href="{{ route('peminjaman-barang.edit', $peminjamanBarang->id) }}"
                                        class="btn inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                            <path fill-rule="evenodd"
                                                d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                        </svg>
                                        Edit
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Ditolak tab -->
            <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th>Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Keterangan</th>
                            <th>Tanggal Kembali</th>
                            <th>Respon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="mt-2">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($peminjamanBarangs->where('status', 'ditolak') as $peminjamanBarang)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $peminjamanBarang->barang->nama_barang }}</td>
                                <td>{{ $peminjamanBarang->user->name }}</td>
                                <td>{{ $peminjamanBarang->jumlah }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_pinjam)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText1($peminjamanBarang->keterangan) }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_kembali)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText($peminjamanBarang->respon) }}</td>
                                <td>{{ $peminjamanBarang->status }}</td>
                                <td>
                                    <a href="{{ route('peminjaman-barang.edit', $peminjamanBarang->id) }}"
                                        class="btn inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                            <path fill-rule="evenodd"
                                                d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                        </svg>
                                        Edit
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Diproses tab -->
            <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th>Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Keterangan</th>
                            <th>Tanggal Kembali</th>
                            <th>Respon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="mt-2">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($peminjamanBarangs->where('status', 'diproses') as $peminjamanBarang)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $peminjamanBarang->barang->nama_barang }}</td>
                                <td>{{ $peminjamanBarang->user->name }}</td>
                                <td>{{ $peminjamanBarang->jumlah }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_pinjam)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText1($peminjamanBarang->keterangan) }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_kembali)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText($peminjamanBarang->respon) }}</td>
                                <td>{{ $peminjamanBarang->status }}</td>
                                <td>
                                    <a href="{{ route('peminjaman-barang.edit', $peminjamanBarang->id) }}"
                                        class="btn inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                            <path fill-rule="evenodd"
                                                d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                        </svg>
                                        Edit
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Selesai tab -->
            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th>Barang</th>
                            <th>Nama Peminjam</th>
                            <th>Jumlah barang</th>
                            <th>Tanggal Pinjam</th>
                            <th>Keterangan</th>
                            <th>Tanggal Kembali</th>
                            <th>Respon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="mt-2">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($peminjamanBarangs->where('status', 'selesai') as $peminjamanBarang)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $peminjamanBarang->barang->nama_barang }}</td>
                                <td>{{ $peminjamanBarang->user->name }}</td>
                                <td>{{ $peminjamanBarang->jumlah }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_pinjam)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText1($peminjamanBarang->keterangan) }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_kembali)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ truncateText($peminjamanBarang->respon) }}</td>
                                <td>{{ $peminjamanBarang->status }}</td>
                                <td>
                                    <form action="{{ route('peminjaman-barang.destroy', $peminjamanBarang->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn outline"
                                            onclick="return confirm('kembalikan Barang?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button class="btn btn-danger laporan" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-box-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z" />
            <path fill-rule="evenodd"
                d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z" />
        </svg>
        Report
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Laporan Pinjaman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th>Barang</th>
                                    <th>Nama Peminjam</th>
                                    <th>Jumlah Barang</th>
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
                                    function truncateText1($text, $length = 20)
                                    {
                                        return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
                                    }
                                @endphp

                                @foreach ($reportPinjaman as $peminjamanBarang)
                                    <tr>
                                        <th scope="row">{{ $count++ }}</th>
                                        <td>{{ $peminjamanBarang->barang->nama_barang }}</td>
                                        <td>{{ $peminjamanBarang->user->name }}</td>
                                        <td>{{ $peminjamanBarang->jumlah }}</td>
                                        <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_pinjam)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ truncateText1($peminjamanBarang->keterangan) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($peminjamanBarang->tanggal_kembali)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ truncateText1($peminjamanBarang->respon) }}</td>
                                        <td>{{ $peminjamanBarang->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button class="btn btn-danger"><a href="/generate-pdf-pinjaman"
                                style="text-decoration: none; color: white;">improt pdf</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@endsection
