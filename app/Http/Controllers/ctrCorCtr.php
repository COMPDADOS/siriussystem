<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCorCtr;
use App\mdlAtendente;

use Auth;

class ctrCorCtr extends Controller
{

    public function carga( $id )
    {
        $capimo = mdlCorCtr::select(
            [
            	'IMB_CORCTR.IMB_ATD_ID',
                'IMB_CORIMO_PERCENTUAL',
            	'IMB_CTR_ID',
                'IMB_ATENDENTE.IMB_ATD_NOME',
            ])
            ->leftjoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CORCTR.IMB_ATD_ID')
            ->where( 'IMB_CORCTR.IMB_CTR_ID', $id)
            ->get();

        return response()->json( $capimo,200);
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

            if( $request->input( 'IMB_CORCTR_ID') == '' )
                $capctr = new mdlCorCtr();
            else
                $capctr = mdlCorCtr::find( $request->input( 'IMB_CORCTR_ID') );

            //$capimo = new mdlCapImo();
            $capctr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $capctr->IMB_CTR_ID = $request->input( 'IMB_CTR_ID');
            $capctr->IMB_ATD_ID = $request->IMB_ATD_ID;
            $capctr->IMB_CORCTR_PERCENTUAL = $request->input( 'IMB_CORCTR_PERCENTUAL');
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
        $capctr = mdlCorCtr::find( $id );
        if( isset( $capctr ))
        {
            return response()->json( $capctr,200);
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
        $capimo = mdlCorCtr::find( $id );
        if( isset( $capimo ))
        {
            return response()->json( $capimo,200);
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
        $capimo = mdlCorCtr::find( $id );
        if( isset( $capimo ))
        {
            $capimo->delete();
            return response('ok',200);

        }
        return response('Já Excluido',404);
    }

}
