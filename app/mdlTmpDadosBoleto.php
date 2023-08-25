<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTmpDadosBoleto extends Model
{
    public $table = 'TMP_DADOSBOLETO';
    public $primaryKey = 'IMB_DBL_ID';
    public $timestamps = false;
}
