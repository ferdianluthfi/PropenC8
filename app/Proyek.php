<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    public function kelengkapanLelangs()
    {
        return $this->hasMany('App\KelengkapanLelang');
    }

    public static function status()
    {
        return static::where('approvalStatus',0)->get();
    }
}
