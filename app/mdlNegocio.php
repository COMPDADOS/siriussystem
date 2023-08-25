<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlNegocio extends Model
{
    public $table = 'IMB_NEGOCIO';
    public $primaryKey = "IMB_NEG_ID";
    public $timestamps = false;
}
