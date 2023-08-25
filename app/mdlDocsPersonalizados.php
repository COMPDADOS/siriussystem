<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlDocsPersonalizados extends Model
{
    protected $table = 'IMB_DOCTOSPERSONALIZADOS';
    protected $primaryKey  = "IMB_DPS_ID";
    public $timestamps = false;    //
}
