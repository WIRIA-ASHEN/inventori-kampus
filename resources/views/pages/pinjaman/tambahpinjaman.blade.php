@extends('layouts.app')

@section('title', 'Ruangan')

@section('header-title', 'Ruangan')

@section('content')

<div class="container">
    <h1>Tambah Peminjaman Barang</h1>
    <form action="{{ route('peminjaman-barang.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_penempatan" value="{{ $penempatanBarang->id }}">

        <div class="mb-3">
            <label for="id_user">Pilih user</label>
            <select name="id_user" id="id_user" class="form-control select2">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" max="{{ $penempatanBarang->jumlah_barang }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
        </div>
     
        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Simpan</button>
    </form>
</div>

@endsection