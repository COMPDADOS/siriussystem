<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlControleChaves extends Model
{
   //
   protected $table = 'IMB_CONTROLECHAVE';
   protected $primaryKey  = "IMB_CCH_ID";
   public $timestamps = false;
}
