<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContratoSeguroFianca extends Model
{
    protected $table        = 'IMB_CONTRATOSEGUROFIANCA';
    protected $primaryKey   = "IMB_SCC_ID";
    public $timestamps      = false;
}
