<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KemajuanProyek extends Model
{
    protected $fillable = ['description','reportDate','tipeKemajuan','value','pelaksanaan_id'];
}
