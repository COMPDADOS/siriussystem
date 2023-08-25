<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlFiadorContrato;
use Auth;

class ctrFiadorContrato extends Controller
{
    
    public function carga( $idcontrato)
    {

        $fiador = mdlFiadorContrato::where( 'IMB_CTR_ID','=', $idcontrato)
        ->where( 'IMB_FIADORCONTRATO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_FIADORCONTRATO.IMB_CLT_ID')
        ->get();

        return $fiador;


    }
    
    
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
        $lt = new mdlFiadorContrato;

        $lt->IMB_IMB_ID           = Auth::user()->IMB_IMB_ID;
        $lt->IMB_ATD_ID           = Auth::user()->IMB_ATD_ID;
        $lt->IMB_CLT_ID           = $request->IMB_CLT_ID;
        $lt->IMB_CTR_ID           = $request->IMB_CTR_ID;
        $lt->save();
        
        return response()->json( 'ok', 200);
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
        $lt = mdlFiadorContrato::find( $id )->delete();
        return response()->json( 'OK', 200);
        //
    }
}
