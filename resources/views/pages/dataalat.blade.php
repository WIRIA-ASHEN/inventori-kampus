<!-- resources/views/pages/about.blade.php -->
@extends('layouts.app')

@section('title', 'Data Barang')

@section('header-title', 'Data Barang')

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

        .outline:hover {
            background-color: red;
            color: white;
        }

        .tambah:hover {
            background-color: #ff5e00;
            color: white;
        }

        .pagination-controls {
            margin-top: 20px;
            text-align: center;
        }

        .pagination-controls button {
            background-color: #ff5e00;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 0 2px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination-controls button:hover {
            background-color: white;
        }

        .laporan {
            margin-left: 92%;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }

        @media (max-width: 768px) {

            .laporan {
                margin-left: 60%;
                margin-top: 5%;
            }

            .table {
                width: 100%;
                overflow-x: auto;
                /* Memungkinkan scroll horizontal jika perlu */
                display: block;
            }

            .table th,
            .table td {
                padding: 8px;
                /* Sesuaikan dengan kebutuhan Anda */
                white-space: nowrap;
                /* Menghindari teks terpotong */
            }

            .table thead {
                display: none;
                /* Sembunyikan header di tampilan mobile */
            }

            .table tbody {
                display: block;
                width: auto;
                /* position: relative; */
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                white-space: nowrap;
                /* Pastikan teks tidak terpotong */
            }

            .table tbody tr {
                display: inline-block;
                vertical-align: top;
            }

            .table tbody td {
                display: block;
                text-align: left;
                border-bottom: 1px solid #ddd;
                /* Garis pemisah untuk setiap baris */
            }

            .table tbody td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            .search {
                float: left;
            }

            .dropdown {
                position: static;
            }
        }
    </style>

    <div class=" mb-4 col-md-10" style="float: left;">
        <a href="/tambah-barang" class="btn tambah">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus"
                viewBox="0 0 16 16">
                <path
                    d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z" />
                <path
                    d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5" />
            </svg>
            Tambah Barang
        </a>
    </div>
    <div class="dropdown" style="float: left;">
        <button class="btn inline dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear"
                viewBox="0 0 16 16">
                <path
                    d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                <path
                    d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
            </svg>
            Pengaturan
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('tambah.kategori') }}">Tambah Kategori</a></li>
            <li><a class="dropdown-item" href="{{ route('tambah.ruangan') }}">Tambah Ruangan</a></li>
        </ul>
    </div>


    <div class="mb-2 mt-2 col-md-12 search">
        <form action="{{ route('dataalat.search') }}" method="GET">
            <input type="text" name="search" placeholder="Cari Barang..." class="form-control"
                style="display: inline-block; width: 200px;">
            <button type="submit" class="btn inline">Cari</button>
        </form>
    </div>

    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif

    <table class="table table-hover table-striped" id="data-table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                {{-- <th scope="col">Ruangan</th> --}}
                <th scope="col">Merek</th>
                <th scope="col">kondisi</th>
                {{-- <th scope="col">gambar barang</th> --}}
                <th scope="col">Jumlah Aset</th>
                <th scope="col">Asal Perolehan</th>
                <th scope="col">Tahun Perolehan</th>
                <th scope="col">Status Pinjaman</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody class="mt-2">

            @php
                use Carbon\Carbon;
                $count = 1;
            @endphp

            @foreach ($databarang as $barang)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama_kategori }}</td>
                    {{-- <td>{{ $barang->ruangan->nama_ruangan }}</td> --}}
                    <td>{{ $barang->merek }}</td>
                    <td>{{ $barang->kondisi->kondisi_barang }}</td>
                    <td>{{ $barang->jumlah_aset }}</td>
                    <td>{{ $barang->asal_perolehan }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->tahun_perolehan)->translatedFormat('d F Y') }}</td>
                    <td>{{ $barang->status_pinjaman }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn inline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('delete.barang', $barang->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn outline" onclick="return confirm('Are you sure?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-folder-x" viewBox="0 0 16 16">
                                    <path
                                        d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139q.323-.119.684-.12h5.396z" />
                                    <path
                                        d="M11.854 10.146a.5.5 0 0 0-.707.708L12.293 12l-1.146 1.146a.5.5 0 0 0 .707.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.707-.708L13 11.293z" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="pagination-controls" class="pagination-controls"></div>

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
                    <h1 class="modal-title fs-5" id="detailModalLabel">Laporan Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover table-striped" id="data-table">
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
                                    $count = 1;
                                    // use Carbon\Carbon;
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
                    </div>
                    <div>
                        <button class="btn btn-danger"><a href="/generate-pdf"
                                style="text-decoration: none; color: white;">Export pdf</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPageMobile = 2; // Menampilkan hanya 2 baris per halaman di mode mobile
            const rowsPerPageDesktop = 5; // Menampilkan 5 baris per halaman di mode desktop
            const isMobile = window.matchMedia("(max-width: 768px)").matches;
            const table = document.getElementById('data-table');
            const rows = table.querySelectorAll('tbody tr');
            const rowsCount = rows.length;
            const pageCount = Math.ceil(rowsCount / (isMobile ? rowsPerPageMobile : rowsPerPageDesktop));
            const paginationControls = document.getElementById('pagination-controls');

            function displayPage(page) {
                let start = (page - 1) * (isMobile ? rowsPerPageMobile : rowsPerPageDesktop);
                let end = start + (isMobile ? rowsPerPageMobile : rowsPerPageDesktop);

                rows.forEach((row, index) => {
                    if (index >= start && index < end) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function createPagination() {
                for (let i = 1; i <= pageCount; i++) {
                    let button = document.createElement('button');
                    button.innerText = i;
                    button.addEventListener('click', () => {
                        displayPage(i);
                    });
                    paginationControls.appendChild(button);
                }
            }

            displayPage(1);
            createPagination();
        });
    </script>

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
