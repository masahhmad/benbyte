<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $fillable = [
        'judul_artikel',
        'gambar',
        'artikel',
    ];
}
