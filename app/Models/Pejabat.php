<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = 'pejabat';
    protected $primaryKey = 'posisi';
    public $timestamps = false;

    protected $fillable = [
        'posisi', 'nama', 'nip'
    ];
}
