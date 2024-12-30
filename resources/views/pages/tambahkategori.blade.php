@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('header-title', 'Tambah Kategori')

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

        .outline:hover {
            background-color: red;
            color: white;
        }

        @media (max-width: 768px) {
            .card {
                position: static;
            }
        }
    </style>

    <div class="row">
        <div class="col-md-7">
            <!-- Konten kotak pertama (lebar 7) -->
            @if (session('delete'))
                <div class="alert alert-danger">
                    {{ session('delete') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body" style="max-height: 500px; overflow-y: auto; padding: 20px;">
                    <!-- Isi konten kotak pertama -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="">

                            @php
                                $count = 1;
                            @endphp

                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <th scope="row">{{ $count++ }}</th>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <form action="{{ route('delete.kategori', $kategori->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn outline"
                                                onclick="return confirm('Are you sure?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
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
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <!-- Konten kotak kedua (lebar 5) -->
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Isi konten kotak kedua -->
                    <form action="{{ route('kategoris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
                        </div>
                        <button type="submit" class="btn mt-3" style="background-color:#ff5e00; color:white;">Tambah
                            Kategori</button>
                    </form>

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
