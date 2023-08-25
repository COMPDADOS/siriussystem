<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlHistoricoImovel extends Model
{
    public $table = 'IMB_IMOVEISHISTORICO';
    public $primaryKey = 'IMB_IMH_ID';
    public $timestamps = false;
}
