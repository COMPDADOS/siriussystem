<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlClientePerfil extends Model
{
    protected $table = 'IMB_CLIENTEPERFIL';
    protected $primaryKey  = "IMB_CLP_ID";
    public $timestamps = false;
}
