<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCalcularRecebimento extends Model
{
    protected $table = 'TBLRECEBER';
    protected $primaryKey  = "IMB_LCF_ID";
    public $timestamps = false;
}
