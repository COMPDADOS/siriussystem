<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCamposMesclagem extends Model
{
    protected $table = 'GER_CAMPOSMESCLAGEM';
    protected $primaryKey  = "GER_CMM_NOME";
    public $timestamps = false;
}
