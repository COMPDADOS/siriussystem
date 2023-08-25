<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlMotivoRescisao;

class ctrMotivoRescisao extends Controller
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
     
        $tabela= mdlMotivoRescisao::all();
        return view( 'motivorescisao/motivorescisao', compact('tabela')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'motivorescisao/motivorescisaonew');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $mtr = new mdlMotivoRescisao();
        $mtr->IMB_MTR_DESCRICAO = $request->input('IMB_MTR_NOME');
        
        $mtr->save();

        return redirect('motivorescisao/motivorescisao');
//
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
     
        $tabela= mdlMotivoRescisao::find( $id);
        if( isset( $tabela )){
            
            return view( 'motivorescisao/motivorescisaoeditar', compact( 'tabela') ) ;
        }
        return redirect('motivorescisao/motivorescisao');
       //
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
        $tabela= mdlMotivoRescisao::find( $id );
        if( isset( $tabela )){
            $tabela->IMB_MTR_DESCRICAO = $request->input('IMB_MTR_DESCRICAO');
            $tabela->save();
        }
        return redirect('motivorescisao/motivorescisao');
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
        $forma= mdlMotivoRescisao::find( $id );
        $forma->delete();
        return redirect('motivorescisao/motivorescisao');


    }

    
    public function vereapagar($id)
    {

        
        $tabela= mdlMotivoRescisao::find( $id );
        return view( 'motivorescisao/motivorescisaovereapagar', compact('tabela') ) ;
        //
    }

}
