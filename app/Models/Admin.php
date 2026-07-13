<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'kode';
    public $timestamps = false;

    protected $fillable = [
       'kode', 'user', 'password'
    ];
}
