<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlRecursos;
use App\mdlAtendente;
use App\mdlAtendenteDireitoAcesso;
use DB;
use Auth;

class ctrAtendenteDireitos extends Controller
{
    
    public function __construct()
    {

        $this->middleware('auth');
    }
        

    public function carga( Request $request  )
    {


            $id         = $request->id;
            $modulo     = $request->modulo;
            $conteudo     = $request->conteudo;
            
   
            $direitos = mdlAtendenteDireitoAcesso::select(
                [
                    'IMB_ATENDENTEDIREITOACESSO.IMB_ATD_ID',
                    'IMB_RSC_NOME',
                    'IMB_ATENDENTEDIREITOACESSO.IMB_RSC_ID',
                    'IMB_RSC_LABEL',
                    'IMB_RSC_GRUPO',
                    'IMB_RSC_MODULO',
                    'IMB_DIRACE_INCLUSAO',
                    'IMB_DIRACE_ALTERACAO',
                    'IMB_DIRACE_EXCLUSAO',
                    'IMB_DIRACE_ACESSO',
                    'IMB_DIRACE_ID'
                ]
            )
            ->where( 'IMB_ATD_ID','=', $id );

            if( $modulo <> '' )
                $direitos = $direitos->where( 'IMB_RSC_MODULO','=', $modulo );

            if( $conteudo <> '' )
                $direitos = $direitos->whereRaw( "IMB_RSC_NOME LIKE '%$conteudo%'");

            $direitos = $direitos->leftJoin('IMB_RECURSOS', 'IMB_RECURSOS.IMB_RSC_ID', 'IMB_ATENDENTEDIREITOACESSO.IMB_RSC_ID')
            ->orderBy( 'IMB_RSC_MODULO')
            ->orderBy( 'IMB_RSC_GRUPO')
            ->orderBy( 'IMB_RSC_NOME')
            ->get();

        return $direitos;


    }

    public function permitir( $id, $item )
    {

        $direitos = mdlAtendenteDireitoAcesso::find( $id );

        if( $item == 1 ) 
        {
            $direitos->IMB_DIRACE_ACESSO =  'S';
        }

        if( $item == 2 ) 
        {
            $direitos->IMB_DIRACE_INCLUSAO =  'S';
        }

        if( $item == 3 ) 
        {
            $direitos->IMB_DIRACE_ALTERACAO =  'S';
        }

        if( $item == 4 ) 
        {
            $direitos->IMB_DIRACE_EXCLUSAO=  'S';
        }

        $direitos->save();

        return response()->json('OK', 200);

    }

    public function negar( $id, $item )
    {

        $direitos = mdlAtendenteDireitoAcesso::find( $id );

        if( $item == 1 ) 
        {
            $direitos->IMB_DIRACE_ACESSO =  'N';
        }
        if( $item == 2 ) 
        {
            $direitos->IMB_DIRACE_INCLUSAO =  'N';
        }

        if( $item == 3 ) 
        {
            $direitos->IMB_DIRACE_ALTERACAO =  'N';
        }

        if( $item == 4 ) 
        {
            $direitos->IMB_DIRACE_EXCLUSAO=  'N';
        }

        $direitos->save();

        return response()->json('OK', 200);
    }

    public function gerandoPermissoesBase( Request $request )
    {
        $idorigem = $request->idorigem;
        $iddestino = $request->iddestino;

        $origem = mdlAtendenteDireitoAcesso::where( 'IMB_ATD_ID','=',$idorigem )->get();
        $destino = mdlAtendenteDireitoAcesso::where( 'IMB_ATD_ID','=',$iddestino )->delete();

        foreach( $origem as $atd )
        {
            $des = new mdlAtendenteDireitoAcesso;
            $des->IMB_ATD_ID = $iddestino;
            $des->IMB_DIRACE_INCLUSAO = $atd->IMB_DIRACE_INCLUSAO;
            $des->IMB_DIRACE_ALTERACAO = $atd->IMB_DIRACE_ALTERACAO;
            $des->IMB_DIRACE_EXCLUSAO = $atd->IMB_DIRACE_EXCLUSAO;
            $des->IMB_DIRACE_ACESSO = $atd->IMB_DIRACE_ACESSO;
            $des->IMB_RSC_ID = $atd->IMB_RSC_ID;
            $des->save();
        
        }

        return response()->json( 'ok', 200 );

    }



}
