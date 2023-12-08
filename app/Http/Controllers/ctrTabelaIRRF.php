<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTabelaIRRF;
use App\mdlImovel;
use App\mdlPropImovel;
use App\mdlCliente;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlContrato;
use Log;

use Auth;

class ctrTabelaIRRF extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $id = $request->IMB_TIR_ID;

        if( $id == '' )
            $ti = new mdlTabelaIRRF;
        else
            $ti = mdlTabelaIRRF::find( $id );

        $ti->IMB_TIR_DE = $request->IMB_TIR_DE;
        $ti->IMB_TIR_ATE = $request->IMB_TIR_ATE;
        $ti->IMB_TIR_PERCENTUAL = $request->IMB_TIR_PERCENTUAL;
        $ti->IMB_TIR_DEDUCAO = $request->IMB_TIR_DEDUCAO;
        $ti->save();

        return response()->json('ok',200);


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

    public function calcularIRRF( $idcontrato, $nvalorbase )
    {


        $calculados = array();


        $idlocatario = app('App\Http\Controllers\ctrRotinas')
                        ->codigoLocatarioPrincipal( $idcontrato );

        $locatario =   app('App\Http\Controllers\ctrRotinas')
                        ->clienteDadosFull( $idlocatario );

        $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );

        $ctr = mdlContrato::find( $idcontrato );
        $idimovel = $ctr->IMB_IMV_ID;

       // Log::info( 'ctrtabelairrf - Imóvel: '.$idimovel);

       Log::info( '$locatario->IMB_CLT_PESSOA '.$locatario->IMB_CLT_PESSOA);
        if( $locatario->IMB_CLT_PESSOA <> 'J' )
            return [];

            Log::info( '$par2->IMB_PRM_IRRFRESPEITARCTR '.$par2->IMB_PRM_IRRFRESPEITARCTR);
            Log::info( '$ctr->IMB_CTR_IRRF '.$ctr->IMB_CTR_IRRF);
            Log::info( '$par2->IMB_PRM_NUNCAIRRF '.$par2->IMB_PRM_NUNCAIRRF);
            if( $par2->IMB_PRM_IRRFRESPEITARCTR =='S' and $ctr->IMB_CTR_IRRF <> 'S' )
            return [];

        if( $par2->IMB_PRM_NUNCAIRRF =='S' )
            return [];




        $propimo = mdlPropImovel::where( 'IMB_IMV_ID','=', $idimovel)->get();

        $totalirrf = 0;



        Log::info( "propimovel vou entrar");

        foreach( $propimo as $prop)
        {
            Log::info( "entrei");

//Log::info('ctrtabelairrf - Cliente: '.$prop->IMB_CLT_ID);

            $baseprop = $nvalorbase * $prop->IMB_IMVCLT_PERCENTUAL4 /100;

            $cliente = mdlCliente::find( $prop->IMB_CLT_ID );
            Log::info('Ld: '.$cliente->IMB_CLT_NOME.' - '.$baseprop);
            Log::info('Pessoa: '.$cliente->IMB_CLT_PESSOA );

            if( $cliente->IMB_CLT_PESSOA == 'F')
            {
                $IRRF = mdlTabelaIRRF::where( 'IMB_TIR_DE','<=', $baseprop)
                    ->where( 'IMB_TIR_ATE','>=', $baseprop)
                    ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
                    ->get();
                    if( $IRRF <> '[]' )
                    {
                        $percentual = $IRRF[0]->IMB_TIR_PERCENTUAL;
                        //Log::info('perc: '.$percentual);
                        $deducao = $IRRF[0]->IMB_TIR_DEDUCAO;
                        $valorcalculado = ($baseprop * $percentual / 100) - $deducao;
                        $totalirrf = $totalirrf + round($valorcalculado,2);
                        //Log::info( 'Valor valorcalculado: '.$valorcalculado);
                        array_push($calculados, ['IMB_CLT_ID' => $prop->IMB_CLT_ID,
                                            'cliente' => $cliente->IMB_CLT_NOME,
                                            'cpf' => $cliente->IMB_CLT_CPF,
                                            'valorbase' => $baseprop,
                                            'valorIRRF' => round($valorcalculado,2),
                                            'valortotalirrf' => $totalirrf ] );
                    }
            }

        }

        return $calculados;


    }


    public function carga()
    {
        $ti = mdlTabelaIRRF::orderBy( 'IMB_TIR_DE')
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->get();
        
        return $ti;
    }


    public function find( $id )
    {
        $ti = mdlTabelaIRRF::find( $id );
        
        return response()->json($ti,200);
    }



}
