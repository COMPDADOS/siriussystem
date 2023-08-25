<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendimentoStatus extends Model
{
    protected $table = 'VIS_ATENDIMENTOSTATUS';
    public $timestamps = false;
    public $primaryKey = 'VIS_ATS_ID';
}