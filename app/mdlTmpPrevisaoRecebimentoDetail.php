<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTmpPrevisaoRecebimentoDetail extends Model
{
    protected $table = 'TMP_PREVISAORECEBIMENTODETAIL';
    protected $primaryKey  = "IMB_CGI_ID";
    public $timestamps = false;

}
