<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendimento extends Model
{
    protected $table = 'VIS_ATENDIMENTO';
    public $timestamps = false;
    public $primaryKey = 'VIS_ATM_ID';
    
}
