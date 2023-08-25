<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlRetornoBancario extends Model
{
    protected $table = 'TMP_RETORNOBANCARIO';
    protected $primaryKey  = "idtable";
    public $timestamps = false;
}
