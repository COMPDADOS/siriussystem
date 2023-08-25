<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlLanctoCaixa;
use App\mdlCaTran;
use DB;
use Auth;
class ctrCaTran extends Controller
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

    public function carga($id)
    {
        $empresa = Auth::user()->IMB_IMB_ID;

        $ct = mdlCaTran::select(
            [
                'FIN_CATRAN.*',
                DB::raw("( SELECT FIN_SBC_DESCRICAO FROM FIN_SUBCONTA 
                            WHERE FIN_SUBCONTA.FIN_SBC_ID =  FIN_CATRAN.FIN_SBC_ID
                            AND FIN_SUBCONTA.IMB_IMB_ID = $empresa
                            )  AS FIN_SBC_DESCRICAO"),
                DB::raw("( SELECT FIN_CFC_DESCRICAO FROM FIN_CFC 
                            WHERE FIN_CFC.IMB_IMB_ID = $empresa
                            AND FIN_CFC.FIN_CFC_ID =  FIN_CATRAN.FIN_CFC_ID
                            )  AS FIN_CFC_DESCRICAO")
            ]
        )
        ->where( 'FIN_LCX_ID','=',$id )
        ->orderBy('FIN_CAT_SEQUENCIA')
        ->get();

        return response()->json( $ct,200);
        
    }

    public function store( Request $request )
    {

    }

    

}
