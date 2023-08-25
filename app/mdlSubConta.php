<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlSubConta extends Model
{
    protected $table = 'FIN_SUBCONTA';
    protected $primaryKey  = "ID";
    public $timestamps = false;
}
