<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCondominio;
use DB;
use Auth;
class ctrCondominio extends Controller
{
    public function carga( $empresa )
    {
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();
        
        return $condominio->toJson();

    }


    public function index()
    {
        return view( '/condominio/condominioindex');
    }

    public function destroy( $id )
    {
        $con = mdlCondominio::find( $id );
        if( $con->IMB_CND_DTHINATIVO == '')
            $con->IMB_CND_DTHINATIVO = date( 'Y/m/d');
        else
            $con->IMB_CND_DTHINATIVO = null;
        $con->save();
        return response()->json( 'ok', 200);

    }

    public function buscar( $id )
    {
        $con = mdlCondominio::find( $id );
        return $con;
    }

    public function salvar( Request $request )
    {
        
        if( $request->input('IMB_CND_ID') == '' )
            $con = new mdlCondominio;
        else
            $con =  mdlCondominio::find( $request->input('IMB_CND_ID') );

        $con->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $con->IMB_CND_NOME = $request->input('IMB_CND_NOME');
        if( $request->IMB_ADMCON_ID <> '' )
            $con->IMB_ADMCON_ID = $request->input('IMB_ADMCON_ID');
        
        $con->IMB_CND_VALCON = $request->IMB_CND_VALCON;
        $con->IMB_CND_ENDERECO = $request->IMB_CND_ENDERECO;
        $con->IMB_CND_ENDERECONUMERO = $request->IMB_CND_ENDERECONUMERO;
        $con->IMB_CND_ENDERECOCOMPLEMENTO = $request->IMB_CND_ENDERECOCOMPLEMENTO;
        $con->IMB_CND_CEP = $request->IMB_CND_CEP;
        $con->CEP_BAI_NOME = $request->CEP_BAI_NOME;
        $con->IMB_CND_ZELADORNOME = $request->IMB_CND_ZELADORNOME;
        $con->IMB_CND_ZELADORCELULAR = $request->IMB_CND_ZELADORCELULAR;
        $con->IMB_CND_SINDICONOME = $request->IMB_CND_SINDICONOME;
        $con->IMB_CND_SINDICOCELULAR = $request->IMB_CND_SINDICOCELULAR;
        $con->IMB_CND_HORARIOVISITA = $request->IMB_CND_HORARIOVISITA;
        $con->IMB_CND_HORARIOSERVICOS = $request->IMB_CND_HORARIOSERVICOS;
        $con->IMB_CND_OBSERVACAO = $request->IMB_CND_OBSERVACAO;
        $con->CEP_UF_SIGLA = $request->CEP_UF_SIGLA;
        $con->CEP_CID_NOME = $request->CEP_CID_NOME;
        $con->IMB_CND_TIPO = $request->IMB_CND_TIPO;
        $con->save();
        return response()->json( 'ok', 200);

    }

    public function pesquisar( $texto, $empresa )
    {
        if( $texto == 'TODOS' or $texto == 'todos' )
        {
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();            
        }
        else
        {
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME','like', "%".$texto."%")
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->where('IMB_IMB_ID','=', $empresa)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();
        }
        
        return $condominio;
    }



}
