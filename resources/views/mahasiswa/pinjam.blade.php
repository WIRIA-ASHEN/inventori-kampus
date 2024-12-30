@extends('layouts.mahasiswa')

@section('title', 'Pinjaman Mahasiswa')

@section('header-title', 'Pinjaman')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-hover table-striped" id="data-table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                {{-- <th scope="col">Ruangan</th> --}}
                <th scope="col">Merek</th>
                <th scope="col">kondisi</th>
                {{-- <th scope="col">gambar barang</th> --}}
                <th scope="col">Jumlah Aset</th>
                {{-- <th scope="col">Asal Perolehan</th> --}}
                {{-- <th scope="col">Tahun Perolehan</th> --}}
                <th scope="col">Status Pinjaman</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody class="mt-2">

            @php
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
                    <td>{{ $barang->jumlah_aset }}</td>
                    {{-- <td>{{ $barang->asal_perolehan }}</td> --}}
                    {{-- <td>{{ $barang->tahun_perolehan }}</td> --}}
                    <td>{{ $barang->status_pinjaman }}</td>
                    <td>
                        <a href="{{ route('pinjamantambah-mahasiswa', $barang->id) }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>

                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
