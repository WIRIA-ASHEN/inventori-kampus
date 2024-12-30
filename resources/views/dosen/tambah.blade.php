@extends('layouts.dosen')

@section('title', 'Pinjam Barang')

@section('header-title', 'Pinjam Barang')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Form Pinjam Barang</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('pinjamantambah-dosen.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_barang" value="{{ $barangs->id }}">

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barangs->nama_barang }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
                    </div>


                    <div class="mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="return confirm('apakah anda yakin?')">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
