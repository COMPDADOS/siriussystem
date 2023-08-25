<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlEquipe extends Model
{
    public $table = 'IMB_EQUIPE';
    public $primaryKey = "IMB_EQP_ID";
    public $timestamps = false;
}
