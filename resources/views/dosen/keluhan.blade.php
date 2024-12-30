@extends('layouts.dosen')

@section('title', 'Keluhan')

@section('header-title', 'Keluhan')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Form Keluhan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('keluhan-dosen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Barang</label>
                        <select class="form-control @error('id_barang') is-invalid @enderror" id="id_barang"
                            name="id_barang" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($barang as $barangs)
                                <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error('id_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan" rows="4"
                            required></textarea>
                        @error('keluhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                            name="gambar" required>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="saran" class="form-label">Saran (Opsional)</label>
                        <textarea class="form-control @error('saran') is-invalid @enderror" id="saran" name="saran" rows="2"></textarea>
                        @error('saran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="return confirm('apakah anda yakin?')">Kirim Keluhan</button>
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
