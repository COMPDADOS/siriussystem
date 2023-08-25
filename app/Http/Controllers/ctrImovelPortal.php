<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImovelPortal;
use App\mdlImovel;
use App\mdlHistoricoImovel;
use Log;
use DB;
use Auth;

class ctrImovelPortal extends Controller
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
    public function carga( $id )
    {
        $portal = mdlImovelPortal::select(
            [
                'IMB_IMP_ID',
                'IMB_POR_NOME'
            ]
        )
        ->leftjoin( 'VIS_PORTAIS','VIS_PORTAIS.IMB_POR_ID','IMB_IMOVELPORTAL.IMB_POR_ID')
        ->where('IMB_IMOVELPORTAL.IMB_IMV_ID','=', $id )
        ->get();

        return $portal;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $portal = new mdlImovelPortal;
        
        $portal->IMB_POR_ID = $request->IMB_POR_ID;
        $portal->IMB_IMV_ID = $request->IMB_IMV_ID;
        $portal->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $portal->save();

        return response()->json('OK', 200);

        
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

        $portal = mdlImovelPortal::where( 'IMB_IMP_ID','=', $id )->delete();
        //$portal->delete();

        return response()->json('OK', 200);
        //
    }
    public function replicarTodosImoveis( $portal )
    {
        Log::info( 'Inicio');
        $imoveis = mdlImovel::
        select( [ 'IMB_IMV_ID'] )
        ->where('IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID)
        ->get();        

        Log::info( 'Entrando...');
        foreach( $imoveis as $imovel )
        {
            Log::info( 'Primeiro.....');

            $pi = mdlImovelPortal::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_IMV_ID','=', $imovel->IMB_IMV_ID )
            ->where( 'IMB_POR_ID','=', $portal)
            ->first();

            if ( $pi == '' )
            {
                    $pi = new mdlImovelPortal;
                Log::info( 'New.....');
                $pi->IMB_POR_ID = $portal;
                $pi->IMB_IMV_ID = $imovel->IMB_IMV_ID;
                $pi->IMB_IMB_ID = auth::user()->IMB_IMB_ID;
                Log::info( 'vou salvar');
                $pi->save();
                Log::info( 'salvei');

                $his = new mdlHistoricoImovel;
                $his->IMB_IMV_ID = $imovel->IMB_IMV_ID;
                $his->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $his->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $his->IMB_IMH_IDALTERACAO = Auth::user()->IMB_ATD_ID;
                $his->IMB_IMH_DTHALTERACAO = date('Y-m-d H:i:s');
                $his->IMB_GRT_CODIGO = 'PORTALIMOVEL';
                $his->IMB_IMH_CAMPO = 'PORTAL';
                $his->IMB_IMH_VALORANTERIOR = 'Em branco';
                $his->IMB_IMH_VALORATUAL =  $portal;
                $his->save();
            }

        }
        return response()->json('ok',200);
    }


}
