<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendente extends Model
{
    protected $table = 'IMB_ATENDENTE';
    public $timestamps = false;
    public $primaryKey = 'IMB_ATD_ID';
}
