<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCaucao extends Model
{
    protected $table = 'IMB_CONTRATOCAUCAO';
    protected $primaryKey  = "IMB_CAU_ID";
    public $timestamps = false;
}
