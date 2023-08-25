<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCapImo;
use App\mdlAtendente;
use Auth;

class ctrCapImo extends Controller
{
    public function usuarioEhCaptador( $idcorretor, $idimovel )
    {
        $cor = mdlCapImo::where( 'IMB_ATD_ID','=', $idcorretor )
                ->where( 'IMB_IMV_ID','=',$idimovel )
                ->first();
        if( $cor )
            return response()->json( 'S',200);
        
            return response()->json( 'N',200);
        
        //
    }
    public function carga( $id )
    {
        $capimo = mdlCapImo::select( 
            [
            	'IMB_CAPIMO.IMB_ATD_ID',
                'IMB_CAPIMO_PERCENTUAL',
            	'IMB_IMV_ID',
                'IMB_ATENDENTE.IMB_ATD_NOME',
                'IMB_CAPIMO_ID',
                'IMB_CAPIMO_TIPO'


            ])
            ->leftjoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CAPIMO.IMB_ATD_ID')
            ->where( 'IMB_CAPIMO.IMB_IMV_ID', $id)
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
        if( $request->input( 'IMB_CAPIMO_ID') == '' )
            $capimo = new mdlCapImo();
        else
            $capimo = mdlCapImo::find( $request->input( 'IMB_CAPIMO_ID') );

        //$capimo = new mdlCapImo();
        $capimo->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $capimo->IMB_IMV_ID = $request->input( 'IMB_IMV_ID');
        $capimo->IMB_ATD_ID = $request->IMB_ATD_ID;
        $capimo->IMB_CAPIMO_TIPO = $request->IMB_CAPIMO_TIPO;
        $capimo->IMB_CAPIMO_PERCENTUAL = $request->input( 'IMB_CAPIMO_PERCENTUAL');
        $capimo->save();
        //return dd( $capimo );
        //return $capimo->toJson();

        return response()->json( 'ok',200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capimo = mdlCapImo::find( $id );
        if( isset( $capimo ))
        {
            return $capimo->toJson();
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
        $capimo = mdlCapImo::find( $id );
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
        $capimo = mdlCapImo::find( $id );
        if( isset( $corimo ))
        {
            $capimo = mdlCapImo::find( $id );
            $capimo->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $capimo->IMB_IMV_ID = $request->input( 'IMB_IMV_ID');
            $capimo->IMB_ATD_ID = $request->IMB_ATD_ID;
            $capimo->IMB_CAPIMO_TIPO = $request->IMB_CAPIMO_TIPO;
            $capimo->IMB_CAPIMO_PERCENTUAL = 100;
            $capimo->save();
    
            return $capimo->toJson();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capimo = mdlCapImo::find( $id );
        if( isset( $capimo ))
        {
            $capimo->delete();
            return response('ok',200);

        }
        return response('Já Excluido',404);
    }

}
