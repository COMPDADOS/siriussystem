<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlDocumentoGerado extends Model
{
    public $table = 'IMB_DOCUMENTOSGERADOS';
    public $primaryKey = "IMB_DCG_ID";
    public $timestamps = false;
}
