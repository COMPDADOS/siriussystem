<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlPortais extends Model
{
    public $table       = 'VIS_PORTAIS';
    public $primaryKey  = 'IMB_POR_ID';
    public $timestamps  = false;
}
