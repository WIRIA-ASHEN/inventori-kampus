<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenempatanBarangTableSeeder extends Seeder
{
    public function run()
    {
        $penempatanBarangs = [
            [
                'id_barang' => 1,
                'id_ruangan' => 1,
                'jumlah_barang' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 2,
                'id_ruangan' => 2,
                'jumlah_barang' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 3,
                'id_ruangan' => 3,
                'jumlah_barang' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($penempatanBarangs as $penempatanBarang) {
            DB::table('penempatan_barangs')->insert($penempatanBarang);

            // Update jumlah_aset in barangs table
            DB::table('barangs')->where('id', $penempatanBarang['id_barang'])->decrement('jumlah_aset', $penempatanBarang['jumlah_barang']);
        }
    }
}
