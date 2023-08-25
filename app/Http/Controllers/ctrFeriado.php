<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlFeriado;
use Auth;
use DataTables;
use Log;

class ctrFeriado extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('feriados.feriadosindex');
    }

    public function carga()
    {
        $fer = mdlFeriado::
            where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->orderBy('GER_FRD_ANO');
            
        return DataTables::of($fer)->make(true);

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
        $GER_FRD_ID = $request->GER_FRD_ID;

        Log::info("Todos ".$request->GER_FRD_TODOSANOS);

        if ( $GER_FRD_ID == '' )
            $fer = new mdlFeriado;
        else
            $fer = mdlFeriado::find( $GER_FRD_ID );

        $fer->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $fer->GER_FRD_DIA = $request->GER_FRD_DIA;

        $fer->GER_FRD_MES = $request->GER_FRD_MES;
        $fer->GER_FRD_ANO = $request->GER_FRD_ANO;
        $fer->GER_FRD_MOTIVO = $request->GER_FRD_MOTIVO;
        $fer->GER_FRD_TODOSANOS = $request->GER_FRD_TODOSANOS;
        $fer->save();

        return response()->json( 'ok', 200 );
        

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
        $fer = mdlFeriado::find( $id );

        return response()->json($fer,200);
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
        $fer = mdlFeriado::find( $id );
        if($fer <> '' )
            $fer->delete();

        return response()->json('excluido!',200);
        
    }
}
