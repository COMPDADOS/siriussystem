<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlClienteNotificacoes extends Model
{
    protected $table = 'IMB_CLIENTENOTIFICACOES';
    public $timestamps = false;
    public $primaryKey = 'IMB_IMN_ID';
}
