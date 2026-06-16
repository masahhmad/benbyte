<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',  
        'kelas_id', 
        'status',
        'harga',
        'nama_kelas',
        'kategori',
        'thumbnail',
        'snap_token',
    ];
}