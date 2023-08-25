<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlIndiceReajuste;
use Auth;
class ctrIndiceReajuste extends Controller
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
    public function index( $empresa )
    {
        $empresa = Auth::user()->IMB_IMB_ID;
        return view( 'indicereajuste.indicereajuste', compact( 'empresa') );
    }

    public function carga( $empresa )
    {
        $tabela= mdlIndiceReajuste::where('IMB_IMB_ID','=', $empresa)->get();
        return $tabela;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'indicereajuste/indicereajustenew');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $padrao=$request->input('IMB_IRJ_PADRAO');
        $tabela = new mdlIndiceReajuste();
        $tabela->IMB_IRJ_NOME = $request->input('IMB_IRJ_NOME');
        $tabela->IMB_IRJ_PADRAO = 'N';
        if ( $padrao =="on"){
            $tabela->IMB_IRJ_PADRAO = 'S';
        };
        $tabela->IMB_IMB_ID = 1;
        $tabela->save();

        return redirect( 'indicereajuste/indicereajuste');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {

        
            $tabela= mdlIndiceReajuste::find( $id);
            
            if( isset( $tabela )){
                
                return view( 'indicereajuste/indicereajusteeditar', compact( 'tabela') ) ;
            }
            return redirect('indicereajuste/indicereajuste');
    
    }

    public function find($id)
    {

        $tabela= mdlIndiceReajuste::find( $id);
        return $tabela;
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salvar(Request $request)
    {

        $id = $request->IMB_IRJ_ID;
        if( $id == '' )
            $tabela = new mdlIndiceReajuste;
        else
            $tabela = mdlIndiceReajuste::find( $id );
    
        
        $tabela->IMB_IMB_ID = $request->input('IMB_IMB_ID');
        $tabela->IMB_IRJ_NOME = $request->input('IMB_IRJ_NOME');
        $tabela->IMB_IRJ_PADRAO = 'N';
        if ( $request->input('IMB_IRJ_PADRAO') =="on"){
            $tabela->IMB_IRJ_PADRAO = 'S';
        };
        $tabela->save();
        return response( $tabela->IMB_IRJ_ID ,200);         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forma= mdlIndiceReajuste::find( $id );
        $forma->delete();
        return redirect('indicereajuste/indicereajuste');

        //
    }

        
    public function vereapagar($id)
    {

        
        $tabela= mdlIndiceReajuste::find( $id );
        
        return view( 'indicereajuste/indicereajustevereapagar', compact('tabela') ) ;
        //
    }

}
    