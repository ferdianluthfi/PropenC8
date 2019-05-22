<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $fillable = 
    ['approvalStatus', 'title', 'filename', 'path', 'ext', 'proyek_id', 'flag_active','pengguna_id'];
}
