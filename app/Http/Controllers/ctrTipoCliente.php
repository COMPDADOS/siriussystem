<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoCliente;

class ctrTipoCliente extends Controller
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
        return view( 'tipocliente/tipoclienteindex' ) ;        //
        //
    }



    public function carga( $empresa )
    {
        if( $empresa == '0')
        {
            $tabela= mdlTipoCliente::all(); 
        }
        else
        {
            $tabela= mdlTipoCliente::where( 'IMB_IMB_ID','=', $empresa )->get();
        }
       
        return $tabela;
    }

    public function buscar( $id )
    {
        $tabela= mdlTipoCliente::find( $id);
        return $tabela;
        
    }
    public function store(Request $request)
    {
        $t = new mdlTipoCliente;
        $t->IMB_TIPCLI_DESCRICAO = $request->input('IMB_TIPCLI_DESCRICAO');
        $t->IMB_IMB_ID = $request->input('IMB_IMB_ID');
        $t->save();

        return response()->json( 'ok', 200);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tabela= mdlTipoCliente::find( $id );
        $tabela->IMB_TIPCLI_DESCRICAO = $request->input('IMB_TIPCLI_DESCRICAO');
        $tabela->save();
        return response()->json( 'ok', 200);
    }

    public function destroy($id)
    {
        $t= mdlTipoCliente::find( $id );
        if( $t->IMB_TIPCLI_DTHINATIVO <> ''  )
            $t->IMB_TIPCLI_DTHINATIVO = null;
        else
            $t->IMB_TIPCLI_DTHINATIVO = date('Y/m/d');
        $t->save();
        return response()->json( 'OK',200 );
    }
    
}    
    