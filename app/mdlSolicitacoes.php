<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlSolicitacoes extends Model
{
    public $table       = 'IMB_SOLICITACAO';
    public $primaryKey  = 'IMB_SOL_ID';
    public $timestamps  = false;
}
