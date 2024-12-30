<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenempatanBarang extends Model
{
    use HasFactory;

    protected $fillable = ['id_barang', 'id_ruangan', 'jumlah_barang'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
    
    public function peminjaman()
    {
        return $this->hasMany(PenempatanBarang::class, 'id_penempatan');
    }
}