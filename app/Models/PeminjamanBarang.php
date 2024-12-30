<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanBarang extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id_barang',
        'id_user',
        'jumlah',
        'tanggal_pinjam',
        'keterangan',
        'tanggal_kembali',
        'respon',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
