<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTabelaMulta;
use Auth;

class ctrTabelaMulta extends Controller
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
        $tabela= mdlTabelaMulta::all();
       
        return view( 'tabelamulta/tabelamulta', compact('tabela')) ; 
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

    public function pegarBaseMulta( $dias )
    {

        $multas = mdlTabelaMulta::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_TBM_DE')->get();

        $nMultaFaixaImob = 0;
        $nMultaFaixaNormal = 0;

        foreach( $multas as $multa )
        {

           if (     $dias >= $multa->IMB_TBM_DE and
                    $dias <= $multa->IMB_TBM_ATE or
                    $dias > $multa->IMB_TBM_ATE)
                    if ($multa->IMB_TMB_DAIMOBILIARIA == 'S' )
                        $nMultaFaixaImob= $nMultaFaixaImob + $multa->IMB_TBM_PERCENTUAL;
                    else
                        $nMultaFaixaNormal = $nMultaFaixaNormal +  $multa->IMB_TBM_PERCENTUAL;

        }

        return  json_encode( [ 'faixaimob' => $nMultaFaixaImob,
                               'faixanormal' => $nMultaFaixaNormal ] );


    }
}
