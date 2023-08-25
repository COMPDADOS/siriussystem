<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlTmpTaxaRecebida extends Model
{
    public $table = 'TMP_TAXASRECEBIDAS';
    public $primaryKey = 'IMB_TAXREC_ID';
    public $timestamps = false;
}
