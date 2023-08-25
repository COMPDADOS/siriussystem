<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTMPAtrasadoHeader extends Model
{
  
    protected $table = 'TMP_ATRASADOSHEADER';
    public $timestamps = false;
    public $primaryKey = 'TMP_ATH_ID';
}
