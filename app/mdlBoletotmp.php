<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlBoletotmp extends Model
{
    protected $table = 'IMB_COBRANCAGERADA';
    protected $primaryKey  = "IMB_CGR_ID";
    public $timestamps = false;
} 
