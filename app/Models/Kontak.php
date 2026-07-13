<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'no', 'nama', 'telepon', 'alamat'
    ];
}
