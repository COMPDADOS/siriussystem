<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCaTran extends Model
{
    protected $table = 'FIN_CATRAN';
    protected $primaryKey  = "FIN_CAT_ID";
    public $timestamps = false;

}
