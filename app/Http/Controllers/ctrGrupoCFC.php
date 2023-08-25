<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlGrupoCFC;
use Auth;   
class ctrGrupoCFC extends Controller
{
    public function index()
    {
        return view( 'financeiro.gruposcfc');
    }

    public function carga()
    {
        $gc = mdlGrupoCFC::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->OrderBy( 'FIN_GCF_DESCRICAO')->get();

        return $gc;



    }

    public function find( $id )
    {
        $gc = mdlGrupoCFC::find( $id );
        return $gc;
    }

    public function salvar( Request $request )
    {
        $FIN_GCF_ID = $request->FIN_GCF_ID;
        $FIN_GCF_DESCRICAO = $request->FIN_GCF_DESCRICAO;

        if( $FIN_GCF_ID == '' )
            $gc = new mdlGrupoCFC;
        else
            $gc = mdlGrupoCFC::Find( $FIN_GCF_ID  );

        $gc->FIN_GCF_DESCRICAO = $FIN_GCF_DESCRICAO;
        $gc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $gc->FIN_GCF_DATAHORA = date('Y-m-d H:i:s');
        $gc->save();

        return response()->json( 'ok',200);

    }

    public function inativar( $id )
    {
        $gc = mdlGrupoCFC::Find( $id  );

        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;

        if ( $gc->IMB_GCF_DTHINATIVO=='')
            $gc->IMB_GCF_DTHINATIVO = date('Y-m-d H:i:s');
        else
        $gc->IMB_GCF_DTHINATIVO = null;

        $gc->save();

        return response()->json( 'ok',200);

    }


    




    //
}
