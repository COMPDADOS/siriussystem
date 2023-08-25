<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendimentoImoveis extends Model
{
    protected $table = 'VIS_ATENDIMENTOIMOVEIS';
    public $timestamps = false;
    public $primaryKey = 'VIS_ATI_ID';
    
}
