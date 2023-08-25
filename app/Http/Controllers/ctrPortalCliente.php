<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImobiliaria;
use App\mdlCliente;
use Log;
        
class ctrPortalCliente extends Controller
{

    public function login( $cgc )
    {
        $imb =mdlImobiliaria::where("IMB_IMB_CGC","=", $cgc )->first();
        if( $imb )
            return view( 'portalcliente.portalclientelogin', compact('imb') );

        return "NÃO ENCONTRA A EMPRESA";
    }

    public function validarLogin( Request $request )
    {
        $cpf = $request->cpf;
        $senha = $request->password;
        return $cpf;

        $clt= mdlCliente::where( 'IMB_CLT_CPF','=',$cpf )
        ->where( 'IMB_CLT_SENHAPORTAL','=', $senha )
        ->first();

        $cltlog= mdlCliente::where( 'IMB_CLT_CPF','=',$cpf )
        ->where( 'IMB_CLT_SENHAPORTAL','=', $senha )->toSql();

        Log::info( $cltlog );

        return response()->json( $clt,200);

        if( $clt  ) 
            return response()->json( 'ok', 200 );

        return response()->json( 'Usuario ou Senha Inválidos!', 404 );


    }
    
    public function validar( Request $request )
    {
        $cpf = $request->cpf;
        $senha = $request->password;

        $clt= mdlCliente::where( 'IMB_CLT_CPF','=',$cpf )
        ->where( 'IMB_CLT_SENHAPORTAL','=', $senha )
        ->first();

        $cltlog= mdlCliente::where( 'IMB_CLT_CPF','=',$cpf )
        ->where( 'IMB_CLT_SENHAPORTAL','=', $senha )->toSql();

        if( $clt  ) 
            return response()->json( 'ok', 200 );

        return response()->json( 'Usuario ou Senha Inválidos!', 404 );


    }
}
