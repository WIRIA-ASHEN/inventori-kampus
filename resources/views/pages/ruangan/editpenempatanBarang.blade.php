@extends('layouts.app')

@section('title', 'Edit Penempatan Barang')

@section('header-title', 'Edit Penempatan Barang')

@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Konten kotak pertama (lebar 7) -->
                <div class="card">
                    <div class="card-header">
                        {{-- <h3>Edit Penempatan Barang</h3> --}}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('penempatan-barang.update', $penempatanBarang->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="id_barang" class="form-label">Pilih Barang</label>
                                <select name="id_barang" id="id_barang"
                                    class="form-control select2 @error('id_barang') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}"
                                            {{ $barang->id == $penempatanBarang->id_barang ? 'selected' : '' }}>
                                            {{ $barang->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_ruangan" class="form-label">Ruangan</label>
                                <select name="id_ruangan" id="id_ruangan"
                                    class="form-control select2 @error('id_ruangan') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Ruangan</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}"
                                            {{ $ruangan->id == $penempatanBarang->id_ruangan ? 'selected' : '' }}>
                                            {{ $ruangan->nama_ruangan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_ruangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" name="jumlah_barang" id="jumlah_barang"
                                    class="form-control @error('jumlah_barang') is-invalid @enderror"
                                    value="{{ $penempatanBarang->jumlah_barang }}" required>
                                @error('jumlah_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn" style="background-color:#ff5e00; color:white;" onclick="return confirm('Are you sure?')">Ubah data</button>
                        </form>
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