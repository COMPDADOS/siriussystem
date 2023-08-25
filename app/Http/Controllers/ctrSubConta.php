<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlSubConta;
use Auth;
use DB;
use Log;

class ctrSubConta extends Controller
{

    public function index()
    {
        $grupo = mdlSubConta::where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy( 'FIN_SBC_DESCRICAO')
        ->get();

        return view( 'financeiro.subconta', compact('grupo'));

    }
    public function carga()
    {

        $sc = mdlSubConta::select( 
            [
                '*',
                DB::raw( '( SELECT FIN_SBC_DESCRICAO FROM FIN_SUBCONTA X
                WHERE X.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_IDCONSOL LIMIT 1) as FIN_SBC_DESCRICAOGRUPO ')
            ]
        )
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy( 'FIN_SBC_ID')
        ->get();

        return $sc;


    }


    public function find( $id )
    {
        $gc = mdlSubConta::find( $id );
        return $gc;
    }

    public function salvar( Request $request )
    {
        
        $ID = $request->ID;
        $FIN_SBC_ID = $request->FIN_SBC_ID;
        $FIN_SBC_IDCONSOL = $request->FIN_SBC_IDCONSOL;
        $FIN_SBC_DESCRICAO = $request->FIN_SBC_DESCRICAO;

        Log::info( "ID: ".$ID );
        if( $ID == '' )
            $gc = new mdlSubConta;
        else
            $gc = mdlSubConta::Find( $ID  );

        $gc->FIN_SBC_ID         = $FIN_SBC_ID;
        $gc->FIN_SBC_IDCONSOL   = $FIN_SBC_IDCONSOL;
        $gc->FIN_SBC_DESCRICAO  = $FIN_SBC_DESCRICAO;
        $gc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $gc->FIN_SBC_DTHATIVA = date('Y-m-d H:i:s');
        $gc->save();

        return response()->json( 'ok',200);

    }

    public function inativar( $id )
    {
        $gc = mdlSubConta::Find( $id  );

        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;

        if ( $gc->FIN_SBC_DTHINATIVA=='')
            $gc->FIN_SBC_DTHINATIVA = date('Y-m-d H:i:s');
        else
        $gc->FIN_SBC_DTHINATIVA = null;

        $gc->save();

        return response()->json( 'ok',200);

    }

    public function buscaIncremental( $texto )
    {
        $imb = Auth::user()->IMB_IMB_ID;
        $cfc = mdlSubConta::select( 
            [
                'FIN_SUBCONTA.ID',
                'FIN_SBC_ID',
                'FIN_SBC_DESCRICAO',
                DB::raw('(select X.FIN_SBC_DESCRICAO FROM FIN_SUBCONTA X
                        WHERE X.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_IDCONSOL
                        AND X.IMB_IMB_ID = '.$imb.' limit 1) GRUPO')
            ]
        )
        ->where( 'FIN_SBC_DESCRICAO','like', '%'.$texto.'%')
        ->where( 'FIN_SUBCONTA.IMB_IMB_ID', '=',Auth::user()->IMB_IMB_ID)
      //  ->orderBy('FIN_SBC_DESCRICAO');
        ->get();
        //dd( $cfc->toSql());
        return response()->json( $cfc, 200 );

    }



}
