<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluhan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id_barang',
        'id_user',
        'keluhan',
        'gambar',
        'saran',
        'status',
    ];

    // Define the relationship to the Barang model
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
