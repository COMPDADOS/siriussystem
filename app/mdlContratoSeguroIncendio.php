<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContratoSeguroIncendio extends Model
{
    protected $table = 'IMB_CONTRATOSEGUROINCENDIO';
    protected $primaryKey  = "IMB_SCT_ID";
    public $timestamps = false;
    
}
