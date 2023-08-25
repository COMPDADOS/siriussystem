<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendenteUnidade extends Model
{
    protected $table = 'IMB_ATENDENTEUNIDADE';
    protected $primaryKey  = "IMB_ATU_ID";
    public $timestamps = false;

}
