<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlEnderecoCobranca extends Model
{
    protected $table = 'IMB_CONTRATOCOBRANCABANCARIA';
    public $timestamps = false;
    public $primaryKey = 'IMB_CTR_ID';

}
