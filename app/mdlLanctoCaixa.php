<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlLanctoCaixa extends Model
{
    protected $table = 'FIN_LANCTOCAIXA';
    protected $primaryKey  = "FIN_LCX_ID";
    public $timestamps = false;

}
