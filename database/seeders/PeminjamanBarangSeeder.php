<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeminjamanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peminjaman = [
            [
                'id_barang' => 1, // Sesuaikan dengan ID yang ada
                'id_user' => 3,
                'jumlah' => 1,
                'tanggal_pinjam' => '2024-07-30',
                'keterangan' => 'loremalxbckajdbfakjdbfakdbfa ajsdba kjsbkaBS DKJAS BD',
                'tanggal_kembali' => null,
                'respon' => null,
                'status' => 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        
    }
}
