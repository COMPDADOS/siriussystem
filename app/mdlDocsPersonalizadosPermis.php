<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlDocsPersonalizadosPermis extends Model
{
    protected $table = 'IMB_DOCTOSPERSONALIZADOSPERMIS';
    protected $primaryKey  = "IMB_DPP_ID";
    public $timestamps = false;    //
}
