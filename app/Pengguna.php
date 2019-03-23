<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $fillable = [
        'role', 'username', 'password', 'name', 'photo', 'email',
    ];
}
