<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTipoImovel extends Model
{
    public $table = 'IMB_TIPOIMOVEL';
    public $primaryKey = "IMB_TIM_ID";
    public $timestamps = false;
}
