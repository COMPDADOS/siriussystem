<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContratoAnexos extends Model
{
    protected $table = 'IMB_CONTRATOANEXOS';
    public $timestamps = false;
    public $primaryKey = 'IMB_CTA_ID';
}
