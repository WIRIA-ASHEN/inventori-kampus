<?php

namespace App\Models;

use App\Models\Keluhan;
use App\Models\Kondisi;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\PenempatanBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang', 'id_kategori', 'id_kondisi', 'nama_barang', 
        'merek', 'gambar_barang', 'jumlah_aset', 'nilai_per_aset', 
        'asal_perolehan', 'tahun_perolehan', 'status_pinjaman'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'id_kondisi');
    }

    public function penempatanBarang()
    {
        return $this->hasMany(PenempatanBarang::class, 'id_barang');
    }

    public function keluhan()
    {
        return $this->hasMany(Keluhan::class, 'id_barang');
    }

    public function peminjaman_barang()
    {
        return $this->hasMany(PeminjamanBarang::class, 'id_barang');
    }
}