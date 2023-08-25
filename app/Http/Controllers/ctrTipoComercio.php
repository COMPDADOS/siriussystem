<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoComercio;

class ctrTipoComercio extends Controller
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
        return view( 'tipocomercio/tipocomercioindex' ) ;        //
        //
    }



    public function carga( $empresa )
    {
        if( $empresa == '0')
        {
            $tabela= mdlTipoComercio::all(); 
        }
        else
        {
            $tabela= mdlTipoComercio::where( 'IMB_IMB_ID','=', $empresa )->get();
        }
       
        return $tabela;
    }

    public function buscar( $id )
    {
        $tabela= mdlTipoComercio::find( $id);
        return $tabela;
        
    }
    public function store(Request $request)
    {
        $t = new mdlTipoComercio;
        $t->IMB_TPC_DESCRICAO = $request->input('IMB_TPC_DESCRICAO');
        $t->IMB_IMB_ID = $request->input('IMB_IMB_ID');
        $t->save();

        return response()->json( 'ok', 200);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tabela= mdlTipoComercio::find( $id );
        $tabela->IMB_TPC_DESCRICAO = $request->input('IMB_TPC_DESCRICAO');
        $tabela->save();
        return response()->json( 'ok', 200);
    }

    public function destroy($id)
    {
        $t= mdlTipoComercio::find( $id );
        if( $t->IMB_TPC_DTHINATIVO <> ''  )
            $t->IMB_TPC_DTHINATIVO = null;
        else
            $t->IMB_TPC_DTHINATIVO = date('Y/m/d');
        $t->save();
        return response()->json( 'OK',200 );
    }
    
}    
    