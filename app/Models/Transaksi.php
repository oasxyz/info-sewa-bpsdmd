<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 'no', 'pemesan', 'pemakai', 'alamat', 'telp', 'tanggal_pakai', 'waktu', 'gedung', 'biaya'
    ];
}
