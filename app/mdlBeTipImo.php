<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlBeTipImo extends Model
{
    protected $table = 'BE_TIPOIMOVEL';
    protected $primaryKey  = "tic_codigo";
    public $timestamps = false;
}
