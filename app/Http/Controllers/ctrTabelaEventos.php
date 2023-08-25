<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlEvento;
use Auth;

class ctrTabelaEventos extends Controller
{
    
        public function __construct()
    
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'tabelaeventos.tabelaeventosindex' ) ;        
    }



    public function carga()
    {
        $tabela= mdlEvento::where('IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->orderBy('IMB_TBE_NOME','ASC')->get();
        return $tabela;
    }


    public function update(Request $request)
    {
    }

    public function destroy($id)
    {
    }


    public function find( $id )
    {
        $eve = mdlEvento::find( $id );
        return $eve;
    }

    public function buscaJson( $id )
    {
        $eve = mdlEvento::find( $id );
        return response()->json($eve,200);

    }

    public function store( Request $request )
    {
        $id = $request->IMB_TBE_ID;
        if( $id == '' ) 
            $eve = new mdlEvento;
        else
            $eve = mdlEvento::find( $id );

        $eve->IMB_IMB_ID        = Auth::user()->IMB_IMB_ID;
        $eve->IMB_TBE_ID        = $request->IMB_TBE_ID;
        $eve->IMB_TBE_NOME      = $request->IMB_TBE_NOME;
        $eve->FIN_CFC_ID        = $request->FIN_CFC_ID_TABEVENTOS;
        $eve->IMB_TBE_TAXAADM   = $request->IMB_TBE_TAXAADM;
        $eve->IMB_TBE_IRRF      = $request->IMB_TBE_IRRF;
        $eve->IMB_TBE_MULTA     = $request->IMB_TBE_MULTA;
        $eve->IMB_TBE_CORRECAO  = $request->IMB_TBE_CORRECAO;
        $eve->IMB_TBE_JUROS     = $request->IMB_TBE_JUROS;
        $eve->IMB_TBE_INCISS    = $request->IMB_TBE_INCISS;
        $eve->save();

        return response()->json('ok',200);

    }
    
}    
    