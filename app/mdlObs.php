<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlObs extends Model
{
    
    protected $table = 'IMB_OBSERVACAOGERAL';
    public $timestamps = false;
    public $primaryKey = 'IMB_OBS_ID';

}
