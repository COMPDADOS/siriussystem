<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCorImo;
use App\mdlAtendente;
use Auth;


class ctrCorImo extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
        
    
        public function index()
    {
        //
    }
    public function carga( $id )
    {
        $corimo = mdlCorImo::select( 
            [
            	'IMB_CORIMO.IMB_ATD_ID',
                'IMB_CORIMO_PERCENTUAL',
            	'IMB_IMV_ID',
                'IMB_ATENDENTE.IMB_ATD_NOME',
                'IMB_CORIMO_ID'


            ])
            ->leftjoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CORIMO.IMB_ATD_ID')
            ->where( 'IMB_CORIMO.IMB_IMV_ID', $id)
            ->get();

        return response()->json( $corimo,200);
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
        
        if( $request->input( 'IMB_CORIMO_ID') == '' )
            $corimo = new mdlCorImo();
        else
            $corimo = mdlCorImo::find( $request->input( 'IMB_CORIMO_ID') );

        $corimo->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $corimo->IMB_IMV_ID = $request->input( 'IMB_IMV_ID');
        $corimo->IMB_ATD_ID = $request->IMB_ATD_ID;
        $corimo->IMB_CORIMO_PERCENTUAL = $request->input( 'IMB_CORIMO_PERCENTUAL');
        $corimo->save();
        return response()->json( $corimo,200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $corimo = mdlCorImo::find( $id );
        if( isset( $corimo ))
        {
            return $corimo->toJson();
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
        $corimo = mdlCorImo::find( $id );
        if( isset( $corimo ))
        {
            return response()->json( $corimo, 200);
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
        $corimo = mdlCorImo::find( $id );
        if( isset( $corimo ))
        {
            $corimo = mdlCorImo::find( $id );
            $corimo->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $corimo->IMB_IMV_ID = $request->input( 'IMB_IMV_ID');
            $corimo->IMB_ATD_ID = $request->IMB_ATD_ID;
            $corimo->IMB_CORIMO_PERCENTUAL = 100;
            $corimo->save();
    
            return $corimo->toJson();
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
        $corimo = mdlCorImo::find( $id );
        if( isset( $corimo ))
        {
            $corimo->delete();
            return response('ok',200);

        }
        return response('Já Excluido',404);


    }

}
