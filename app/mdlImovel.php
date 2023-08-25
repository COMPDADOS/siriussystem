<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlImovel extends Model
{
    
    protected $table = 'IMB_IMOVEIS';
    public $timestamps = false;
    public $primaryKey = 'IMB_IMV_ID';

    public function imobiliaria()
    {
        return $this->hasOne('App\mdlImobiliaria', 'IMB_IMB_ID', 'IMB_IMB_ID2');
    }

    public function cliente($value='')
    {
        return $this->hasOne('App\mdlCliente', 'IMB_CLT_ID', 'IMB_CLT_ID');
    }    

}
