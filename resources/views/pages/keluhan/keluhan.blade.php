<!-- resources/views/pages/home.blade.php -->
@extends('layouts.app')

@section('title', 'Keluhan')

@section('header-title', 'Keluhan')

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
    </style>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Saran</th>
                <th scope="col">Gambar</th>
                <th scope="col">status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="mt-2">

            @php
                $count = 1;
            @endphp

            @foreach ($keluhans as $keluhan)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $keluhan->barang->nama_barang }}</td>
                    <td>{{ $keluhan->keluhan }}</td>
                    <td>{{ $keluhan->saran }}</td>
                    <td><img src="{{ asset('storage/' . str_replace('public/', '', $keluhan->gambar)) }}" alt=""
                            style="width: 100px;"></td>
                    <td>{{ $keluhan->status }}</td>
                    <td>
                        <form action="{{ route('keluhan.done', $keluhan->id) }}" method="POST" style="float: left;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn inline" onclick="return confirm('Are you sure?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check2-square" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
                                    <path
                                        d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
                                </svg>
                            </button>
                        </form>
                        @if (auth()->user()->role !== 'teknisi')
                            <form action="{{ route('keluhan.hapus', $keluhan->id) }}" method="POST" class="d-inline"
                                style="float: left;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn outline" onclick="return confirm('Are you sure?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
                                        <path
                                            d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139q.323-.119.684-.12h5.396z" />
                                        <path
                                            d="M11.854 10.146a.5.5 0 0 0-.707.708L12.293 12l-1.146 1.146a.5.5 0 0 0 .707.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.707-.708L13 11.293z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
