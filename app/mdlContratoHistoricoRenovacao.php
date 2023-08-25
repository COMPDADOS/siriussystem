<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContratoHistoricoRenovacao extends Model
{
    protected $table = 'IMB_CONTRATOHISTREN';
    protected $primaryKey  = "IMB_CHR_ID";
    public $timestamps = false;

}
