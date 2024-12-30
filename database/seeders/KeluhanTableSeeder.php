<?php

namespace Database\Seeders;

use App\Models\Keluhan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KeluhanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keluhan::create([
            'id_barang' => 1, // Assume there's a barang with id 1
            'id_user' => 2,
            'keluhan' => 'Barang rusak saat diterima',
            'saran' => 'ahdfbdkxbcksdb',
            'gambar' => 'gambar1.jpg',
            'status' => 'selesai',
        ]);

        Keluhan::create([
            'id_barang' => 2, // Assume there's a barang with id 2
            'id_user' => 1,
            'keluhan' => 'Barang tidak sesuai deskripsi',
            'saran' => 'afidjkbvjcfs',
            'gambar' => 'gambar2.jpg',
            'status' => 'diproses',
        ]);

        // Add more seeds as needed
    }
}
