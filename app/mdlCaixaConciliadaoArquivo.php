<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCaixaConciliadaoArquivo extends Model
{
    public $table = 'FIN_TABELACONCILIACAOARQUIVO';
    public $primaryKey = "FIN_CNC_ID";
    public $timestamps = false;
}
