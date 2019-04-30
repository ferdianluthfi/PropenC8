<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipePekerjaan extends Model
{
    protected $fillable = ['name','workTotalValue','workCurrentValue','weightPercentage','proyek_id'];
}