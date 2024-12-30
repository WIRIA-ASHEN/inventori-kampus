<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangans')->insert([
            ['nama_ruangan' => 'Gudang'],
            ['nama_ruangan' => 'Ruang Tamu'],
            ['nama_ruangan' => 'Ruang Kerja'],
        ]);
    }
}
