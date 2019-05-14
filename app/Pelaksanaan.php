<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelaksanaan extends Model
{
    protected $fillable = ['approvalStatus','bulan','createdDate','proyek_id','flag'];
}