<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlApDoc extends Model
{
    public $table = 'FIN_APDOC';
    public $primaryKey = "FIN_APD_ID";
    public $timestamps = false;
}
