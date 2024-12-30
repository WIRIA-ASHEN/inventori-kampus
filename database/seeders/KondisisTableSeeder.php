<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KondisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kondisis')->insert([
            ['kondisi_barang' => 'Baru'],
            ['kondisi_barang' => 'Bekas'],
            ['kondisi_barang' => 'Rusak'],
        ]);
    }
}
