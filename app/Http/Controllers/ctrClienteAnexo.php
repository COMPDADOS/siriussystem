<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlClienteAnexo;
        
class ctrClienteAnexo extends Controller
{
    public function carga( $id)
    {
        $anexos = mdlClienteAnexo::Select( 
            [ 
                'IMB_CLA_ID',
                'IMB_CLT_ID',
                'IMB_CLA_ARQUIVO',
                'IMB_CLA_DESCRICAO',
                'IMB_CLA_DTHATIVO',
                ]
        )
        ->where( 'IMB_CLT_ID', $id )
        ->get();
        return $anexos->toJson();
    }

}
