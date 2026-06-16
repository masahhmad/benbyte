<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreateKelas extends Model
{
    protected $fillable = [
        'user_id',
        'nama_kelas',
        'deskripsi',
        'kategori',
        'harga',
        'thumbnail'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }
}