<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    protected $table = 'pemesan';
    protected $primaryKey = 'id_pemesan';
    public $timestamps = false;

    protected $fillable = [
        'no', 'pemesan', 'pemakai', 'email', 'alamat', 'telp', 'hp',
        'keperluan', 'tanggal_pakai', 'waktu', 'gedung', 'fasilitas',
        'instansi', 'temp', 'tanggal_pesan','status'
    ];
}
