<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCliente;

class ctrBotConversa extends Controller
{
    
    public function pegaClienteCpf( $cpf )
    {
        $cli = mdlCliente::where('IMB_CLT_CPF','=', $cpf )->first();
        if( $cli == '' )
            return response()->json('Não encontrado', 404 );
        
        return response()->json( $cli, 200);
    }    
}



