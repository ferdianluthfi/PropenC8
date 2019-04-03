<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    public function berkasKontrak()
    {
        return $this->hasMany('App\Kontrak');
    }

}
