<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelengkapanLelang extends Model
{
    protected $fillable = [
    	'title',
    	'filename',
    	'path',
    	'ext',
    	'proyek_id'
    ];
}
