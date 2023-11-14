<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCFC;
use App\mdlApTran;
use App\mdlCaTran;
use App\mdlGrupoCFC;
use Auth;

class ctrCfc extends Controller
{
    public function index()
    {

        $grupo = mdlGrupoCFC::where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy( 'FIN_GCF_DESCRICAO')
        ->get();

        return view('financeiro.cfc',compact('grupo'));
        
    }

    public function carga()
    {

        $cfc = mdlCFC::select( [
            'FIN_CFC_ID',
	        'FIN_CFC_DESCRICAO',
	        'FIN_CFC_DATAHORA',
	        'FIN_CFC.FIN_GCF_ID',
	        'FIN_CFC_TIPO',
	        'FIN_CFC_TIPORD',
	        'FIN_CFC.IMB_ATD_ID',
	        'FIN_CFC_DTHINATIVO',
	        'FIN_CFC.IMB_IMB_ID',
	        'FIN_CFC.ID',
            'FIN_GCF_DESCRICAO'

        ])
        ->where( 'FIN_CFC.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'FIN_GRUPOCFC','FIN_GRUPOCFC.FIN_GCF_ID','FIN_CFC.FIN_GCF_ID')
        ->whereNull( 'FIN_CFC_DTHINATIVO')
        ->orderBy( 'FIN_GCF_DESCRICAO')
        ->orderBy( 'FIN_CFC_ID' )
        ->get();

        return response()->json( $cfc ,200);
        
    }    

    public function cargaSemJson()
    {

        $cfc = mdlCFC::select( [
            'FIN_CFC_ID',
	        'FIN_CFC_DESCRICAO',
	        'FIN_CFC_DATAHORA',
	        'FIN_CFC.FIN_GCF_ID',
	        'FIN_CFC_TIPO',
	        'FIN_CFC_TIPORD',
	        'FIN_CFC.IMB_ATD_ID',
	        'FIN_CFC_DTHINATIVO',
	        'FIN_CFC.IMB_IMB_ID',
	        'FIN_CFC.ID',
            'FIN_GCF_DESCRICAO'

        ])
        ->where( 'FIN_CFC.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'FIN_GRUPOCFC','FIN_GRUPOCFC.FIN_GCF_ID','FIN_CFC.FIN_GCF_ID')
        ->whereNull( 'FIN_CFC_DTHINATIVO')
        ->orderBy( 'FIN_GCF_DESCRICAO')
        ->orderBy( 'FIN_CFC_ID' )
        ->get();

        return $cfc;
        
    }    

    public function salvar( Request $request )
    {
        $ID = $request->ID;
        $FIN_CFC_ID = $request->FIN_CFC_ID;
        $FIN_CFC_DESCRICAO = $request->FIN_CFC_DESCRICAO;
        $FIN_GFC_ID = $request->FIN_GFC_ID;
        $FIN_CFC_TIPORD = $request->FIN_CFC_TIPORD;

        if( $ID == '' )
            $gc = new mdlCFC;
        else
            $gc = mdlCFC::find( $ID );

        $gc->FIN_CFC_ID = $FIN_CFC_ID;
        $gc->FIN_CFC_DESCRICAO = $FIN_CFC_DESCRICAO;
        $gc->FIN_CFC_TIPORD  = $FIN_CFC_TIPORD;
        $gc->FIN_GCF_ID  = $FIN_GFC_ID;
        $gc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $gc->FIN_CFC_DATAHORA = date('Y-m-d H:i:s');
        
        $gc->save();

        return response()->json( 'ok',200);

    }


    public function inativar( $id )
    {
        //verificando se tem lancamento.
    
    
        $gc = mdlCFC::Find( $id  );

        $ver = mdlApTran::where( 'FIN_CFC_ID','=', $gc->FIN_CFC_ID)->first();
        if( $ver )
            return response()->json('Tem lançamento vinculado no contas a pagar!',404 );
       
        $ver = mdlCaTran::where( 'FIN_CFC_ID','=', $gc->FIN_CFC_ID )->first();
        //dd( $ver );

        if( $ver )
                return response()->json('Tem lançamento vinculado no caixa!',404 );

        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;

        if ( $gc->FIN_CFC_DTHINATIVO=='')
            $gc->FIN_CFC_DTHINATIVO = date('Y-m-d H:i:s');
        else
        $gc->FIN_CFC_DTHINATIVO = null;

        $gc->save();

        return response()->json( 'ok',200);

    }

    public function find( $id )
    {
        $gc = mdlCFC::find( $id );
        return $gc;
    }

    public function buscaIncremental( $texto )
    {
        $cfc = mdlCFC::where( 'FIN_CFC_DESCRICAO','like', '%'.$texto.'%')
        ->where( 'IMB_IMB_ID', '=',Auth::user()->IMB_IMB_ID)
        ->orderBy('FIN_CFC_DESCRICAO')
        ->get();
        return response()->json( $cfc, 200 );

    }

    
}
