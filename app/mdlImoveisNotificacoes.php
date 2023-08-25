<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlImoveisNotificacoes extends Model
{
    protected $table = 'IMB_IMOVEISNOTIFICACOES';
    public $timestamps = false;
    public $primaryKey = 'IMB_IMN_ID';
}
