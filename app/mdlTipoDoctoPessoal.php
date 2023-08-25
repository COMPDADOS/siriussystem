<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTipoDoctoPessoal extends Model
{
    protected $table = 'IMB_TIPOSDOCUMENTOSPESSOAIS';
    protected $primaryKey  = "IMB_TDP_ID";
    public $timestamps = false;
}
