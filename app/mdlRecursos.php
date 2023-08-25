<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlRecursos extends Model
{
    protected $table = 'IMB_RECURSOS';
    protected $primaryKey  = "IMB_RSC_ID";
    public $timestamps = false;
}
