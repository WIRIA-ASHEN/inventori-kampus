<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kondisi extends Model
{
    use HasFactory;

    protected $fillable = ['kondisi_barang'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_kondisi');
    }
}


