<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlFormaPagamento extends Model
{
    protected $table = 'IMB_FORMAPAGAMENTO';
    protected $primaryKey  = "IMB_FORPAG_ID";
    public $timestamps = false;
}
