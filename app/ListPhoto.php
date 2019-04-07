<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ListPhoto extends Model
{
    protected $fillable = [
    	'path',
    	'ext',
    	'proyek_id'
    ];
}