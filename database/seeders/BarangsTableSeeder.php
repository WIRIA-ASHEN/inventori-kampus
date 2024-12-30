<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('barangs')->insert([
            [
                'kode_barang' => 'Rkjas231R',
                'id_kategori' => 1, // Elektronik
                // 'id_ruangan' => 1, // Gudang
                'id_kondisi' => 1, // Baru
                'nama_barang' => 'Laptop',
                'merek' => 'Dell',
                'gambar_barang' => 'laptop.jpg',
                'jumlah_aset' => 10,
                'nilai_per_aset' => 15000000,
                'asal_perolehan' => 'Pembelian',
                'tahun_perolehan' => Carbon::create('2023', '01', '01'),
                'status_pinjaman' => 'bisa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'Rkjas232R',
                'id_kategori' => 2, // Furniture
                // 'id_ruangan' => 2, // Ruang Tamu
                'id_kondisi' => 2, // Bekas
                'nama_barang' => 'Sofa',
                'merek' => 'Ikea',
                'gambar_barang' => 'sofa.jpg',
                'jumlah_aset' => 5,
                'nilai_per_aset' => 5000000,
                'asal_perolehan' => 'Hibah',
                'tahun_perolehan' => Carbon::create('2020', '05', '20'),
                'status_pinjaman' => 'tidak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'Rkjas233R',
                'id_kategori' => 3, // Kendaraan
                // 'id_ruangan' => 3, // Ruang Kerja
                'id_kondisi' => 3, // Rusak
                'nama_barang' => 'Sepeda Motor',
                'merek'         => 'Yamaha',
                'gambar_barang' => 'sepeda_motor.jpg',
                'jumlah_aset' => 3,
                'nilai_per_aset' => 10000000,
                'asal_perolehan' => 'Pembelian',
                'tahun_perolehan' => Carbon::create('2018', '11', '15'),
                'status_pinjaman' => 'tidak',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
