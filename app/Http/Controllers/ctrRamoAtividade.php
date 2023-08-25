<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlRamoAtividade;

class ctrRamoAtividade extends Controller
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
        $tabela= mdlRamoAtividade::all();
       
        return view( 'ramoatividade/ramoatividade', compact('tabela')) ;        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'ramoatividade/ramoatividadenew');
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
        $t = new mdlRamoAtividade();
        $t->GER_RMA_DESCRICAO = $request->input('GER_RMA_DESCRICAO');
        
        $t->save();

        return redirect('ramoatividade/ramoatividade');

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
        $tabela= mdlRamoAtividade::find( $id);
        if( isset( $tabela )){
            
            return view( 'ramoatividade/ramoatividadeeditar', compact( 'tabela') ) ;
        }
        return redirect('ramoatividade/ramoatividade');
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tabela= mdlRamoAtividade::find( $id );
        if( isset( $tabela )){
            $tabela->GER_RMA_DESCRICAO = $request->input('GER_RMA_DESCRICAO');
            $tabela->save();
        }
        return redirect('ramoatividade/ramoatividade');
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $t= mdlRamoAtividade::find( $id );
        $t->delete();
        return redirect('ramoatividade/ramoatividade');


    }

    
    public function vereapagar($id)
    {

        
        $tabela= mdlRamoAtividade::find( $id );
        return view( 'ramoatividade/ramoatividadevereapagar', compact('tabela') ) ;
        //
    }

}
