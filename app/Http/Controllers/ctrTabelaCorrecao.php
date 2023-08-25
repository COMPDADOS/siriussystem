<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTabelaCorrecao;

class ctrTabelaCorrecao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $id) 
    {
        return view( 'indicereajuste.indicereajustetabcor', compact('id')) ;
    }

    public function find( $id )
    {
        $ind = mdlTabelaCorrecao::find( $id );
        
        return $ind;
        //
    }

    public function buscarIndiceMesAno( $id, $mes, $ano )
    {
        $ind = mdlTabelaCorrecao::where( "IMB_TBC_INDICEID","=", $id)
        ->where( "IMB_TBC_MES",'=', $mes)
        ->where( "IMB_TBC_ANO",'=', $ano)
        ->get();
        
        return $ind;
        //
    }

    public function carga( $id )
    {
        $ind = mdlTabelaCorrecao::where( 'IMB_TBC_INDICEID','=',$id)
        ->leftJoin( 'IMB_INDICEREAJUSTE','IMB_INDICEREAJUSTE.IMB_IRJ_ID', 'IMB_TBC_INDICEID')
        ->orderBy( 'IMB_TBC_ANO','DESC')
        ->orderBy( 'IMB_TBC_MES','DESC')
        ->get();
        
        return $ind;
        //
    }

    public function gravar( Request $request )
    {
        $id = $request->IMB_TBC_ID;

        if( $id <> '')
            $ind = mdlTabelaCorrecao::find( $id );
        else
            $ind = new mdlTabelaCorrecao;
        
        $ind->IMB_TBC_MES                   = $request->IMB_TBC_MES;
        $ind->IMB_TBC_ANO                   = $request->IMB_TBC_ANO;
        $ind->IMB_TBC_INDICEID              = $request->IMB_TBC_INDICEID;
        $ind->IMB_TBC_INDICECORRECAO        = $request->IMB_TBC_INDICECORRECAO;
        $ind->IMB_TBC_FATOR                 = $request->IMB_TBC_FATOR;
        $ind->IMB_IMB_ID                    = $request->IMB_IMB_ID;
        $ind->save();
        return response( 'ok' ,200);      
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }
}
