<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlImovelProposta extends Model
{
    public $table = 'IMB_IMOVELPROPOSTA';
    public $primaryKey = "IMB_PRI_ID";
    public $timestamps = false;
}
