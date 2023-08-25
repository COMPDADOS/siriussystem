<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContratoTaxDif extends Model
{
    protected $table = 'IMB_CONTRATOTAXADIFER';
    protected $primaryKey  = "IMB_TCD_ID";
    public $timestamps = false;
    
}
