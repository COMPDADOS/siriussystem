<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlApTran extends Model
{
    public $table = 'FIN_APTRAN';
    public $primaryKey = "FIN_APT_ID";
    public $timestamps = false;
}
