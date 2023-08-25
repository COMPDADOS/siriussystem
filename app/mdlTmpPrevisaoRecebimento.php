<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTmpPrevisaoRecebimento extends Model
{
    protected $table = 'TMP_PREVISAORECEBIMENTO';
    protected $primaryKey  = "IMB_CGR_ID";
    public $timestamps = false;

}
