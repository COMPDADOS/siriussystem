<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoImovel;

class ctrTipoImovel extends Controller
{

    public function __construct()
    
    {
        $this->middleware('auth');
    }

    public function index( )
    {

        return view( 'tipoimovel/tipoimovel' );
    }

    public function carga( )
    {
            $tabela= mdlTipoImovel::orderBy('IMB_TIM_DESCRICAO')->get(); 
       
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
        $tabela= mdlTipoImovel::find( $id);
        if( isset( $tabela )){
            
            return view( 'tipoimovel/tipoimoveleditar', compact( 'tabela') ) ;
        }
        return redirect('tipoimovel/tipoimovel');
      
    }

    public function store(Request $request)
    {
        $t = new mdlTipoImovel;
        $t->IMB_TIM_DESCRICAO = $request->input('IMB_TIM_DESCRICAO');
        $t->IMB_TIM_COMERCIAL = $request->input('IMB_TIM_COMERCIAL');
        $t->IMB_TIM_SUPTIPO = $request->input('IMB_TIM_SUPTIPO');
        $t->IMB_IMB_ID = $request->input('IMB_IMB_ID');
        //$t->IMB_TIM_PREFIXO = $request->input('IMB_TIM_PREFIXO');
        $t->save();

        return response()->json( 'ok', 200);

    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $tabela= mdlTipoImovel::find( $id );
        $tabela->IMB_TIM_DESCRICAO = $request->input('IMB_TIM_DESCRICAO');
        $tabela->IMB_TIM_COMERCIAL = $request->input('IMB_TIM_COMERCIAL');
        $tabela->IMB_TIM_SUPTIPO = $request->input('IMB_TIM_SUPTIPO');
//            $tabela->IMB_TIM_PREFIXO = $request->input('IMB_TIM_PREFIXO');
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
            $t= mdlTipoImovel::find( $id );
            if( $t->IMB_TIM_DTHINATIVO <> ''  )
                $t->IMB_TIM_DTHINATIVO = null;
            else
                $t->IMB_TIM_DTHINATIVO = date('Y/m/d');
            $t->save();
            return response()->json( 'OK',200 );
    }

    
    public function vereapagar($id)
    {

        
        $tabela= mdlTipoImovel::find( $id );
        return view( 'tipoimovel/tipoimovelvereapagar', compact('tabela') ) ;
        //
    }

    public function buscar( $id )
    {
        $tabela= mdlTipoImovel::find( $id);
        return $tabela;
      
    }





}
