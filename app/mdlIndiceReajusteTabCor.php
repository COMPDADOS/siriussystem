<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlIndiceReajusteTabCor extends Model
{
    public $table = 'IMB_TABELACORRECAO';
    public $primaryKey = 'IMB_TBC_ID';
    //public $primaryKey = "IMB_TIPCLI_ID";
    public $timestamps = false;
    
}
