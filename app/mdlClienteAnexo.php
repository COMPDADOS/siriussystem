<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlClienteAnexo extends Model
{
    protected $table = 'IMB_CLIENTEANEXO';
    protected $primaryKey  = "IMB_CLA_ID";
    public $timestamps = false;
}
