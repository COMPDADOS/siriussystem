<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlClienteRepresentante extends Model
{
    
    protected $table = 'IMB_CLIENTEREPRESENTANTE';
    public $timestamps = false;
    public $primaryKey = 'IMB_CLR_ID';
}
