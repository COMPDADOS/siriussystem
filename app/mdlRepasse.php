<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlRepasse extends Model
{
    public $table='TMP_REPASSE';
    public $primaryKey='IMB_PAG_ID';
    public $timestamps = false;
}
