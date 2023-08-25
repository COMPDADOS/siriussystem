<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendimentoAgenda extends Model
{
    protected $table = 'VIS_ATENDIMENTOAGENDA';
    public $timestamps = false;
    public $primaryKey = 'VIS_ATA_ID';
}
