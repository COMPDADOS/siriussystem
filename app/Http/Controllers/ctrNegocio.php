<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlNegocio;
use Auth;

class ctrNegocio extends Controller
{

    public function __construct()
    
    {
        $this->middleware('auth');
    }

    public function index( )
    {

        return view( 'negocio.negocio' );
    }

    public function carga( )
    {
            $tabela= mdlNegocio::orderBy('IMB_NEG_DESCRICAO')->get(); 
       
        return $tabela;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'tipoimovel/tipoimovelnew');
       //
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request )
    {
        $id = $request->input('id');
        $tabela= mdlNegocio::find( $id);
        if( isset( $tabela )){
            
            return view( 'negocio.negocio', compact( 'tabela') ) ;
        }
        return redirect('tiponegocio');
      
    }

    public function store(Request $request)
    {
        $t = new mdlNegocio;
        $t->IMB_NEG_DESCRICAO = $request->input('IMB_NEG_DESCRICAO');
        $t->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $t->IMB_NEG_DTHATIVO = date( 'Y/m/d H:i');
        $t->save();

        return response()->json( 'ok', 200);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tabela= mdlNegocio::find( $id );
        $tabela->IMB_NEG_DESCRICAO = $request->input('IMB_NEG_DESCRICAO');
        $tabela->save();
        return response()->json( 'ok', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $im = mdlImovel::where( 'IMB_TIM_ID','=', $id )->get();
            $t= mdlNegocio::find( $id );
            if( $t->IMB_NEG_DTHINATIVO <> ''  )
                $t->IMB_NEG_DTHINATIVO = null;
            else
                $t->IMB_NEG_DTHINATIVO = date('Y/m/d');
            $t->save();
            return response()->json( 'OK',200 );
    }

    
    public function vereapagar($id)
    {

        
        $tabela= mdlNegocio::find( $id );
        return view( 'tipoimovel/tipoimovelvereapagar', compact('tabela') ) ;
        //
    }

    public function buscar( $id )
    {
        $tabela= mdlNegocio::find( $id);
        return $tabela;
      
    }





}
