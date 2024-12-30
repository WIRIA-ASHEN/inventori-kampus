<?php

use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/keluhan/store', [DashboardController::class, 'store'])->name('keluhan.store');

Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login-akun', [LoginController::class, 'login'])->name('loginAkun');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin,teknisi'])->group(function () {
    Route::get('/beranda', [AdminController::class, 'home'])->name('beranda');
    Route::get('/data-alat', [AdminController::class, 'dataAlat'])->name('dataalat.search');
    Route::get('/tambah-barang', [AdminController::class, 'tambah_barang'])->name('tambahBarang');
    Route::post('/barangs', [AdminController::class, 'store'])->name('barangs.store');
    Route::get('/edit-barang/{id}', [AdminController::class, 'edit_barang'])->name('barang.edit');
    Route::post('/update-barang/{id}', [AdminController::class, 'update_barang'])->name('update.barang');
    Route::post('/hapus-barang/{id}', [AdminController::class, 'delete_barang'])->name('delete.barang');

    Route::get('/tambah-kategori', [AdminController::class, 'tambah_kategori'])->name('tambah.kategori');
    Route::post('/storekategori', [AdminController::class, 'store_kategori'])->name('kategoris.store');
    Route::post('/hapus-kategori/{id}', [AdminController::class, 'delete_kategori'])->name('delete.kategori');
    Route::get('/tambah-ruangan', [AdminController::class, 'tambah_ruangan'])->name('tambah.ruangan');
    Route::post('/storeruangan', [AdminController::class, 'store_ruangan'])->name('ruangans.store');
    Route::post('/hapus-ruangan/{id}', [AdminController::class, 'delete_ruangan'])->name('delete.ruangan');
    // Route::get('/dataalat', [AdminController::class, 'dataAlat'])->name('dataalat.search');

    Route::get('/ruangan', [AdminController::class, 'ruangan'])->name('ruangan');
    Route::get('/tambah_penempatanBarang', [AdminController::class, 'tambah_penempatanBarang'])->name('tambah_penempatanBarang');
    Route::post('/penempatan-barang', [AdminController::class, 'penempatan_barang'])->name('penempatan-barang.store');
    Route::get('/penempatan-barang/{id}/edit', [AdminController::class, 'edit_penempatanBarang'])->name('penempatan-barang.edit');
    Route::put('/penempatan-barang/{id}', [AdminController::class, 'update_penempatanBarang'])->name('penempatan-barang.update');
    Route::delete('/penempatan-barang/{id}', [AdminController::class, 'delete_penempatanBarang'])->name('penempatan-barang.destroy');
    Route::get('/ruangan/export-pdf', [AdminController::class, 'exportpdf_ruangan'])->name('ruangan.export.pdf');

    Route::get('/pinjaman', [AdminController::class, 'pinjaman'])->name('pinjaman');
    Route::get('peminjaman-barang/create/{id_penempatan}', [AdminController::class, 'tambah_pinjaman'])->name('peminjaman-barang.create');
    Route::post('peminjaman-barang', [AdminController::class, 'store_pinjaman'])->name('peminjaman-barang.store');
    Route::get('peminjaman-barang/{id}/edit', [AdminController::class, 'edit_pinjaman'])->name('peminjaman-barang.edit');
    Route::put('peminjaman-barang/{id}', [AdminController::class, 'update_pinjaman'])->name('peminjaman-barang.update');
    Route::delete('peminjaman-barang/{id}', [AdminController::class, 'delete_pinjaman'])->name('peminjaman-barang.destroy');

    Route::post('/users', [AdminController::class, 'tambah_user'])->name('users.store');

    Route::get('/keluhanadmin', [AdminController::class, 'keluhanadmin'])->name('keluhan');
    Route::patch('/keluhan/{id}/done', [AdminController::class, 'done'])->name('keluhan.done');
    Route::delete('/keluhan/{id}', [AdminController::class, 'hapus_keluhan'])->name('keluhan.hapus');
    
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('/generate-pdf', [AdminController::class, 'generatePDF'])->name('generate.pdf');
    Route::get('/generate-pdf-pinjaman', [AdminController::class, 'report_pinjaman'])->name('generate.pdf-pinjaman');

    Route::post('/notifications/readall', [AdminController::class, 'readAll'])->name('notifications.readAll');
});


Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/pinjambarang-mahasiswa', [MahasiswaController::class, 'pinjaman_barang'])->name('pinjaman-mahasiswa');
    Route::get('/pinjambarang-tambahmahasiswa/{id_barang}', [MahasiswaController::class, 'tambah'])->name('pinjamantambah-mahasiswa');
    Route::post('/storemahasiswa-pinjaman', [MahasiswaController::class, 'store_pinjaman'])->name('store.pinjaman-mahasiswa');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('beranda-mahasiswa');
    Route::get('/keluhan', [MahasiswaController::class, 'keluhan'])->name('keluhan-mahasiswa');
    Route::post('/store', [MahasiswaController::class, 'store'])->name('store-mahasiswa');

    Route::post('/notifications/read-all', [MahasiswaController::class, 'readAll_mahasiswa'])->name('notifications.readAllMahasiswa');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('beranda-dosen');
    Route::get('/pinjambarang', [DosenController::class, 'pinjaman_barang'])->name('pinjaman-dosen');
    Route::get('/pinjambarang-tambah/{id_penempatan}', [DosenController::class, 'tambah'])->name('pinjamantambah-dosen');
    Route::post('/pinjambarang-store', [DosenController::class, 'store'])->name('pinjamantambah-dosen.store');

    Route::get('/keluhandosen', [DosenController::class, 'keluhan_dosen'])->name('keluhan-dosen');
    Route::post('/keluhandosen-store', [DosenController::class, 'keluhan_dosenstore'])->name('keluhan-dosen.store');

    Route::post('/notifications/read-all/dosen', [DosenController::class, 'readAll_Dosen'])->name('notifications.readAllDosen');
});


