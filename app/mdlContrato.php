<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContrato extends Model
{
    protected $table = 'IMB_CONTRATO';
    public $timestamps = false;
    public $primaryKey = 'IMB_CTR_ID';
}
