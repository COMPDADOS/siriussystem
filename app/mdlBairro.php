<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlBairro extends Model
{
  
    protected $table = 'CEP_BAIRRO';
    public $timestamps = false;
    public $primaryKey = 'CEP_BAI_ID';
}

