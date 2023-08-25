<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContratoHistoricoReajuste extends Model
{
    protected $table = 'IMB_CONTRATOHISTREA';
    protected $primaryKey  = "IMB_CHR_ID";
    public $timestamps = false;

}
