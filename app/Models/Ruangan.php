<?php

namespace App\Models;

use App\Models\PenempatanBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_ruangan'];

    public function penempatanBarang()
    {
        return $this->hasMany(PenempatanBarang::class, 'id_ruangan');
    }
}
