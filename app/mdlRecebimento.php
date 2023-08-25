<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlRecebimento extends Model
{
    public $table='TMP_RECEBIMENTO';
    public $primaryKey='IMB_REC_ID';
    public $timestamps = false;
}
