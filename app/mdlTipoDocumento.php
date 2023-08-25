<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTipoDocumento extends Model
{
    public $table = 'FIN_TIPODOCUMENTO';
    public $primaryKey = "FIN_TPD_ID";
    public $timestamps = false;
}
