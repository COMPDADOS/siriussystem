<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlPropImovel extends Model
{
    public $table       = 'IMB_PROPRIETARIOIMOVEL';
    public $primaryKey  = 'IMB_PPI_ID';
    public $timestamps  = false;
}
