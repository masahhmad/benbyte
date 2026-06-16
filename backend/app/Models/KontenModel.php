<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenModel extends Model
{
    protected $fillable = [
        'user_id',
        'kelas_id',
        'label',
        'konten',
    ];
}
