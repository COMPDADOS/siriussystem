<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlIndiceReajuste extends Model
{
    protected $table = 'IMB_INDICEREAJUSTE';
    protected $primaryKey  = "IMB_IRJ_ID";
    public $timestamps = false;
}
