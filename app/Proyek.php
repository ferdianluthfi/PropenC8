<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    public function kelengkapanLelangs()
    {
        return $this->hasMany('App\KelengkapanLelang');
    }
}
