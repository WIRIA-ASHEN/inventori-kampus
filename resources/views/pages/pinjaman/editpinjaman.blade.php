@extends('layouts.app')

@section('title', 'Edit Peminjaman Barang')

@section('header-title', 'Edit Peminjaman Barang')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                {{-- <h3>Edit Peminjaman Barang</h3> --}}
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('peminjaman-barang.update', $pinjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id_barang" value="{{ $pinjaman->barang->id }}">

                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="id_barang" name="id_barang"
                            value="{{ $pinjaman->barang->nama_barang }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                            value="{{ $pinjaman->user->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pinjaman->jumlah }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam"
                            value="{{ $pinjaman->tanggal_pinjam }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" readonly rows="2">{{ $pinjaman->keterangan }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                            value="{{ $pinjaman->tanggal_kembali ?? '' }}" >
                    </div>

                    <div class="mb-3">
                        <label for="respon" class="form-label">Respon</label>
                        <textarea class="form-control" id="respon" name="respon" rows="2">{{ $pinjaman->respon ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="diproses" {{ $pinjaman->status == 'diproses' ? 'selected' : '' }}>diproses</option>
                            <option value="diterima" {{ $pinjaman->status == 'diterima' ? 'selected' : '' }}>diterima</option>
                            <option value="selesai" {{ $pinjaman->status == 'selesai' ? 'selected' : '' }}>selesai</option>
                            <option value="ditolak" {{ $pinjaman->status == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn" style="background-color:#ff5e00; color:white;" onclick="return confirm('Are you sure?')">Simpan</button>
                </form>
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
