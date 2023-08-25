<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCobrancaRealizada extends Model
{
  
    protected $table = 'IMB_COBRANCAREALIZADA';
    public $timestamps = false;
    public $primaryKey = 'IMB_CBR_ID';
}
