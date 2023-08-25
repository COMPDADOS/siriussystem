<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTipoComercio extends Model
{
    public $table = 'IMB_TIPOCOMERCIO';
    public $primaryKey = "IMB_TPC_ID";
    public $timestamps = false;
}
