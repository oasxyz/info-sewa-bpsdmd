<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemakai extends Model
{
   protected $table = 'pemakai';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'no', 'pemesan', 'pemakai', 'alamat', 'telp', 'hp',
        'keperluan', 'tanggal_pakai', 'waktu', 'gedung',
        'fasilitas', 'instansi', 'retribusi'
    ];
}
