@extends('layouts.app')

@section('title', 'Ruangan')

@section('header-title', 'Ruangan')

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
    </style>


    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif

    <div class=" mb-4 col-md-10" style="float: left;">
        <a href="/tambah_penempatanBarang" class="btn tambah">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus"
                viewBox="0 0 16 16">
                <path
                    d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z" />
                <path
                    d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5" />
            </svg>
            Tempatkan Barang
        </a>
    </div>

    <div class="mb-2 mt-2 col-md-12 search">
        <form action="{{ route('ruangan') }}" method="GET">
            <select name="search" class="form-control" style="display: inline-block; width: 200px;">
                <option>Filter Ruangan....</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn inline">Filter</button>
            <a href="{{ route('ruangan.export.pdf', ['search' => request('search')]) }}" class="btn btn-danger">Export PDF</a>
        </form>
    </div>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Ruangan</th>
                <th scope="col">jumlah Barang</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="mt-2">

            @php
                $count = 1;
            @endphp

            @foreach ($penempatanBarangs as $barang)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $barang->barang->kode_barang }}</td>
                    <td>{{ $barang->barang->nama_barang }}</td>
                    <td>{{ $barang->ruangan->nama_ruangan }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td>
                        <a href="{{ route('penempatan-barang.edit', $barang->id) }}" class="btn inline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('penempatan-barang.destroy', $barang->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
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
                        {{-- <a href="{{ route('peminjaman-barang.create', $barang->id) }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                            
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    {{-- <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            var ruanganId = document.getElementById('id_ruangan').value;
            if (!ruanganId) {
                event.preventDefault();
                alert('Pilih ruangan terlebih dahulu.');
            }
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>

@endsection
