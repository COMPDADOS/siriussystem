<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlEmpresa extends Model
{
    public $table = 'IMB_EMPRESA';
    public $primaryKey = 'IMB_EEP_ID';
    public $timestamps = false;
}
