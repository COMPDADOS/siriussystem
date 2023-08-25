<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlClienteAtendimento extends Model
{
    protected $table = 'IMB_CLIENTEATENDIMENTO';
    protected $primaryKey  = "IMB_CLA_ID";
    public $timestamps = false;
}
