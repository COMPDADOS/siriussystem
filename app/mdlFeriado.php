<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlFeriado extends Model
{
    protected $table = 'GER_FERIADO';
    protected $primaryKey  = "GER_FRD_ID";
    public $timestamps = false;
}
