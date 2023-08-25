<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlAtendenteDireitoAcesso extends Model
{
    protected $table = 'IMB_ATENDENTEDIREITOACESSO';
    protected $primaryKey  = "IMB_DIRACE_ID";
    public $timestamps = false;
}
