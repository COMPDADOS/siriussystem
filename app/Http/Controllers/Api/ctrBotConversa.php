<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCliente;
use App\ctrContrato;
use App\ctrCobrancaGeradaPerm;
use Log;

class ctrBotConversa extends Controller
{
    
    public function pegaClienteCpf( $cpf )
    {
    
        if( is_numeric( $cpf ) )
        {

            $cli = mdlCliente::where('IMB_CLT_CPF','=', $cpf )->first();
            if( $cli )
                return response()->json( $cli, 200);
            else
                return response()->json( "Não encontrei contrato com este número!", 404);

        }
        else
            return response()->json( "Informe um documento válido!", 404);

    }    

    public function procurarBoletoCpf( $cpf )
    {

        Log::info('entrei');

        
        $contrato = mdlCliente::where( 'IMB_CLIENTE.IMB_CLT_CPF','=', $cpf )
        ->LeftJoin( 'IMB_LOCATARIOCONTRATO', 'IMB_LOCATARIOCONTRATO.IMB_CLT_ID','IMB_CLIENTE.IMB_CLT_ID' )
        ->first();

        $idcontrato = $contrato->IMB_CTR_ID;

        Log::info( $idcontrato);

        if( $idcontrato == '' )
            return response()->json( 'Não encontrado contrato com este CPF', 400 );

        $ctr = mdlContrato::find( $idcontrato );
        if( $ctr == '' )
            return response()->json( 'Não encontrado contrato* com este CPF', 400 );

        return response()->json( $ctr->IMB_CTR_REFERENCIA, 200);

    }    

    
}



