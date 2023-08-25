<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlDireitos extends Model
{
    //IMB_DIREITOACESSO
    protected $table = 'IMB_DIREITOACESSO';
    protected $primaryKey  = "IMB_DIRACE_ID";
    public $timestamps = false;
}

