<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedung';
    protected $primaryKey = 'kode';
    public $timestamps = false;

    protected $fillable = [
        'kode', 'gedung', 'luas', 'kapasitas', 'hargasiang', 'hargamalam', 'hargahari'
    ];
}
