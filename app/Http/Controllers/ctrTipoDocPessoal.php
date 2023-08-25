<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoDoctoPessoal;
use Log;
class ctrTipoDocPessoal extends Controller
{
    public function index()
    {
        return view('cliente.tiposdocumentospessoais');
    }

    public function carga()
    {
        $tipos = mdlTipoDoctoPessoal::all();

        return $tipos;

    }
    public function find( $id )
    {
        $tdp =  mdlTipoDoctoPessoal::find( $id);
        return $tdp;


    }

    public function inativar( $id )
    {

        $tdp =  mdlTipoDoctoPessoal::find( $id);
        $tdp->IMB_TPD_DTHINATIVO = date( 'Y/m/d');
        $tdp->save();

        return response()->json('ok',200);


    }

    public function salvar( Request $request )
    {
        $IMB_TDP_ID = $request->IMB_TDP_ID;
        $IMB_TPD_NOME = $request->IMB_TPD_NOME;
        $IMB_TPD_DESTINO = $request->IMB_TPD_DESTINO;

        if( $IMB_TDP_ID == '')
            $tdp = new mdlTipoDoctoPessoal;
        else
        $tdp =  mdlTipoDoctoPessoal::find( $IMB_TDP_ID );

        $tdp->IMB_TPD_NOME = $IMB_TPD_NOME;
        $tdp->IMB_TPD_DESTINO = $IMB_TPD_DESTINO;
        $tdp->save();

        return response()->json( $tdp ,200);

    }
}
