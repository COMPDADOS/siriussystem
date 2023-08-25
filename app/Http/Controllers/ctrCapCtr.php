<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCapCtr;
use App\mdlAtendente;
use Auth;

class ctrCapCtr extends Controller
{

    public function carga( $id )
    {
        $capimo = mdlCapCtr::select(
            [
            	'IMB_CAPCTR.IMB_ATD_ID',
                'IMB_CAPIMO_PERCENTUAL',
            	'IMB_CTR_ID',
                'IMB_ATD_NOME',
                'IMB_CAPCTR_ID',


            ])
            ->leftjoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CAPCTR.IMB_ATD_ID')
            ->where( 'IMB_CAPCTR.IMB_CTR_ID', $id)
            ->get();

        return $capimo->toJson();
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
    public function store( Request $request )
    {
        $atd = mdlAtendente::find( $request->IMB_ATD_ID );
        if( $atd <> '' )
        {

            if( $request->input( 'IMB_CAPCTR_ID') == '' )
                $capctr = new mdlCapCtr();
            else
                $capctr = mdlCapCtr::find( $request->input( 'IMB_CAPCTR_ID') );

            //$capimo = new mdlCapImo();
            $capctr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $capctr->IMB_CTR_ID = $request->input( 'IMB_CTR_ID');
            $capctr->IMB_ATD_ID = $request->IMB_ATD_ID;
            $capctr->IMB_CAPIMO_PERCENTUAL = $request->input( 'IMB_CAPIMO_PERCENTUAL');
            $capctr->save();
        }
        //return dd( $capimo );
    
        //return $capimo->toJson();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capctr = mdlCapCtr::find( $id );
        if( isset( $capctr ))
        {
            return $capctr->toJson();
        }
        return response( 'não encontrato',404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capimo = mdlCapCtr::find( $id );
        if( isset( $capimo ))
        {
            return $capimo->toJson();
        }
        return response( 'não encontrato',404);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capctr = mdlCapCtr::find( $id );
        if( isset( $capctr ))
        {
            $capctr->delete();
            return response()->json('ok',200);

        }
        
        return response('Já Excluido',404);
    }

}
