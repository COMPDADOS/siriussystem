<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCliente extends Model
{
    protected $table = 'IMB_CLIENTE';
    protected $primaryKey  = "IMB_CLT_ID";
    public $timestamps = false;
}
