<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTipoSolicitacao extends Model
{
    public $table       = 'IMB_TIPOSOLICITACAO';
    public $primaryKey  = 'IMB_TPS_ID';
    public $timestamps  = false;
}
