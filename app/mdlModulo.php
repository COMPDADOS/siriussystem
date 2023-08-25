<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlModulo extends Model
{
    protected $table = 'IMB_MODULO';
    protected $primaryKey  = "IMB_MDL_ID";
    public $timestamps = false;
}
