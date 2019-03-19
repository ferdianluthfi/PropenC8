<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelengkapanLelang extends Model
{
    public function proyek()
    {
        return $this->belongsTo('App\Proyek');
    }
}
