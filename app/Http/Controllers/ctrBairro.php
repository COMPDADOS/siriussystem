<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\mdlBairro;

class ctrBairro extends Controller
{

    public function carga( $cidade)
    {
        $bairro = mdlBairro::whereNotNull( 'CEP_BAI_ID');

        if( $cidade <> '' and $cidade <> 'X' )
            $bairro = $bairro->where('CEP_CID_NOME','=', $cidade );

        $bairro = $bairro->orderBy( 'CEP_BAI_NOME' )->get();

        return $bairro;

    }

    public function salvar( Request $request )
    {
        $CEP_BAI_ID = $request->CEP_BAI_ID;
        $CEP_BAI_NOME = $request->CEP_BAI_NOME;
        $CEP_CID_NOME = $request->CEP_CID_NOME;
        $CEP_UF_SIGLA = $request->CEP_UF_SIGLA;

        if( $CEP_BAI_ID == '') 
            $bairro = new mdlBairro;    
        else
            $bairro = mdlBairro::find( $CEP_BAI_ID );
        
        $bairro->CEP_BAI_NOME = $CEP_BAI_NOME;
        $bairro->CEP_CID_NOME = $CEP_CID_NOME;
        $bairro->CEP_UF_SIGLA = $CEP_UF_SIGLA;
        $bairro->save();

        return response()->json( $bairro->CEP_BAI_ID,200);
        

    }
    

    public function verificar( Request $request )
    {
        $newifnotexists = $request->newifnotexists;
        $CEP_BAI_NOME = $request->CEP_BAI_NOME;
        $CEP_CID_NOME = $request->CEP_CID_NOME;
        $CEP_UF_SIGLA = $request->CEP_UF_SIGLA;

        $bairro = mdlBairro::where('CEP_BAI_NOME','=', $CEP_BAI_NOME )
        ->where('CEP_CID_NOME','=', $CEP_CID_NOME )
        ->first();

        if( $bairro == '' )
        {
            if( $newifnotexists == 'S' )
            {
                $bairro = new mdlBairro;    
                $bairro->CEP_BAI_NOME = strtoupper($CEP_BAI_NOME);
                $bairro->CEP_CID_NOME =  strtoupper($CEP_CID_NOME);
                $bairro->CEP_UF_SIGLA =  strtoupper($CEP_UF_SIGLA);
                $bairro->save();
           
            }
            else
                return response()->json('Não cadastrado',404);
        };

        return response()->json( $bairro->CEP_BAI_ID);

    }
    
    
}    
    