<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTabelaEvento extends Model
{
    public $table='IMB_TABELAEVENTOS';
    public $primaryKey='IMB_TBE_ID';
    public $timestamps = false;
}
