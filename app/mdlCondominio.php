<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCondominio extends Model
{
  
    protected $table = 'IMB_CONDOMINIO';
    public $timestamps = false;
    public $primaryKey = 'IMB_CND_ID';
}
