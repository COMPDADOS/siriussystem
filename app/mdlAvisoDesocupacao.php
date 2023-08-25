<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAvisoDesocupacao extends Model
{
    //IMB_CONTRATOAVISODESOC
    protected $table = 'IMB_CONTRATOAVISODESOC';
    protected $primaryKey  = "IMB_AVD_ID";
    public $timestamps = false;    
}
