<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlEvento extends Model
{
    protected $table = 'IMB_TABELAEVENTOS';
    protected $primaryKey  = "IMB_TBE_ID";
    public $timestamps = false;
}
