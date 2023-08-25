<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoAtendente;

class ctrTipoAtendente extends Controller
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
        return view( 'tipoatendente/tipoatendenteindex' ) ;        //
        //
    }



    public function carga( $empresa )
    {
        if( $empresa == '0')
        {
            $tabela= mdlTipoAtendente::all(); 
        }
        else
        {
            $tabela= mdlTipoAtendente::where( 'IMB_IMB_ID','=', $empresa )->get();
        }
       
        return $tabela;
    }

    public function buscar( $id )
    {
        $tabela= mdlTipoAtendente::find( $id);
        return $tabela;
        
    }
    public function store(Request $request)
    {
        $t = new mdlTipoAtendente;
        $t->IMB_TIPATE_DESCRICAO = $request->input('IMB_TIPATE_DESCRICAO');
        $t->IMB_IMB_ID = $request->input('IMB_IMB_ID');
        $t->save();

        return response()->json( 'ok', 200);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tabela= mdlTipoAtendente::find( $id );
        $tabela->IMB_TIPATE_DESCRICAO = $request->input('IMB_TIPATE_DESCRICAO');
        $tabela->save();
        return response()->json( 'ok', 200);
    }

    public function destroy($id)
    {
        $t= mdlTipoAtendente::find( $id );
        if( $t->IMB_TIPATE_DTHINATIVO <> ''  )
            $t->IMB_TIPATE_DTHINATIVO = null;
        else
            $t->IMB_TIPATE_DTHINATIVO = date('Y/m/d');
        $t->save();
        return response()->json( 'OK',200 );
    }
    
}    
    