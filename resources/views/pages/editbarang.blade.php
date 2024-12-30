@extends('layouts.app')

@section('title', 'Edit Barang')

@section('header-title', 'Edit Barang')

@section('content')

    <style>
        @media (max-width: 768px) {
            .card {
                position: static;
            }

            .select2 {
                position: static;
            }
        }
    </style>

    <div class="row">
        <div class="col-md-7">
            <!-- Konten kotak pertama (lebar 7) -->
            <div class="card">
                <div class="card-body" style="max-height: 500px; overflow-y: auto; padding: 20px;">
                    <!-- Isi konten kotak pertama -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('update.barang', ['id' => $barang->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        

                        <div class="form-group mb-3">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control select2">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" @if ($kategori->id == $barang->id_kategori) selected @endif>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_ruangan">Ruangan</label>
                            <select name="id_ruangan" id="id_ruangan" class="form-control select2">
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}" @if ($ruangan->id == $barang->id_ruangan) selected @endif>
                                        {{ $ruangan->nama_ruangan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang" class="form-control"
                                value="{{ $barang->kode_barang }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kondisi">Kondisi</label>
                            <select name="id_kondisi" id="id_kondisi" class="form-control">
                                @foreach ($kondisis as $kondisi)
                                    <option value="{{ $kondisi->id }}" @if ($kondisi->id == $barang->id_kondisi) selected @endif>
                                        {{ $kondisi->kondisi_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                                value="{{ $barang->nama_barang }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="merek">Merek</label>
                            <input type="text" name="merek" id="merek" class="form-control"
                                value="{{ $barang->merek }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_aset">Jumlah Aset</label>
                            <input type="number" name="jumlah_aset" id="jumlah_aset" class="form-control"
                                value="{{ $barang->jumlah_aset }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="nilai_per_aset">Nilai Per Aset</label>
                            <input type="number" name="nilai_per_aset" id="nilai_per_aset" class="form-control"
                                value="{{ $barang->nilai_per_aset }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="asal_perolehan">Asal Perolehan</label>
                            <input type="text" name="asal_perolehan" id="asal_perolehan" class="form-control"
                                value="{{ $barang->asal_perolehan }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun_perolehan">Tahun Perolehan</label>
                            <input type="date" name="tahun_perolehan" id="tahun_perolehan" class="form-control"
                                value="{{ $barang->tahun_perolehan }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_pinjaman">Status Peminjaman</label>
                            <select name="status_pinjaman" id="status_pinjaman" class="form-control">
                                <option value="bisa" @if ($barang->status_pinjaman == 'boleh') selected @endif>Boleh</option>
                                <option value="tidak" @if ($barang->status_pinjaman == 'tidak') selected @endif>Tidak Boleh</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <!-- Konten kotak kedua (lebar 5) -->
                <div class="card">
                    <div class="card-body">
                        <!-- Isi konten kotak kedua -->
                        <label for="gambar_barang" class="mb-2">Gambar Barang</label>
                        <div class="form-group mb-3 text-center">
                            <img src="{{ asset('storage/' . str_replace('public/', '', $barang->gambar_barang)) }}"
                            alt="Gambar Barang" class="img-fluid mx-auto d-block"
                            style="max-height: 300px; object-fit: contain; margin-bottom: 10px; width:50%;">
                            <input type="file" name="gambar_barang" id="gambar_barang" class="form-control">
                        </div>
                        <button type="submit" class="btn mt-3" style="background-color:#ff5e00; color:white;" onclick="return confirm('Are you sure?')">Simpan
                            Perubahan</button>
                        </div>
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