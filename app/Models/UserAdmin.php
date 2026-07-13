<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'no', 'user', 'password'
    ];
}
