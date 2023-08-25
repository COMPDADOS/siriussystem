<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlStatusImovel;
use Auth;

class ctrStatusImovel extends Controller
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
        return view( 'statusimovel/statusimovelindex' ) ;        //
        //
    }



    public function carga( $empresa )
    {
        $tabela= mdlStatusImovel::orderBy('VIS_STA_NOME','ASC')->get();
        return $tabela;
    }

    public function buscar( $id )
    {
        $tabela= mdlStatusImovel::find( $id);
        return $tabela;
        
    }
    public function store(Request $request)
    {
        $id = $request->input('id');

        if( $id <> '' )
           $t= mdlStatusImovel::find( $id );
        else
           $t = new mdlStatusImovel;
        $t->VIS_STA_NOME = $request->input('VIS_STA_NOME');
        $t->VIS_STA_SITUACAO = $request->input('VIS_STA_SITUACAO');
        $t->VIS_STA_COMERCIALIZADO = $request->input('VIS_STA_COMERCIALIZADO');
        $t->IMB_IMB_ID =Auth::user()->IMB_IMB_ID;
        $t->IMB_ATD_ID =Auth::user()->IMB_ATD_ID;
        $t->save();

        return response()->json( 'ok', 200);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tabela= mdlStatusImovel::find( $id );
        $tabela->VIS_STA_NOME = $request->input('VIS_STA_NOME');
        $tabela->VIS_STA_SITUACAO = $request->input('VIS_STA_SITUCAO');
        $tabela->save();
        return response()->json( 'ok', 200);
    }

    public function destroy($id)
    {
        $t= mdlStatusImovel::find( $id );
        if( $t->VIS_STA_DTHINATIVO <> ''  )
            $t->VIS_STA_DTHINATIVO = null;
        else
            $t->VIS_STA_DTHINATIVO = date('Y/m/d');
        $t->save();
        return response()->json( 'OK',200 );
    }
    
}    
    