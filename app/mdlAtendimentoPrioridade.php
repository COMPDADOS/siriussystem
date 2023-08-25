<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendimentoPrioridade extends Model
{
    protected $table = 'VIS_ATENDIMENTOPRIORIDADE';
    public $timestamps = false;
    public $primaryKey = 'VIS_PRI_ID';
}
