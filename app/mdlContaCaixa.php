<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlContaCaixa extends Model
{
    protected $table = 'FIN_CONTACAIXA';
    public $timestamps = false;
    public $primaryKey = 'FIN_CCX_ID';
}
