<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlRedeBancaria extends Model
{
    public $table='GER_BANCOS';
    public $primaryKey='GER_BNC_ID';
    public $timestamps = false;
}
