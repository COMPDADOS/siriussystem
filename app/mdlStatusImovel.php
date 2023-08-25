<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlStatusImovel extends Model
{
    public $table='VIS_STATUSIMOVEL';
    public $primaryKey='VIS_STA_ID';
    public $timestamps = false;
}
