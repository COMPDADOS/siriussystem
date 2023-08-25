<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCalendar;
use Auth;

class ctrCalendar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        
        return view('calendario.calendario' );

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

    public function carga( Request $request )
    {

        $iduser = $request->iduser;
        //dd( $iduser);

        $calendar = mdlCalendar::where( 'IMB_ATD_ID','=', $iduser)->get();
        $res=array();

        foreach( $calendar as $value )
        {
            $event = array( 
                    'id' => $value->id,
                    'title' => $value->event_title,
                    'start' => $value->event_start,
                    'end' => $value->event_end,
                    'backgroundColor' => '#12B6D0',
                    'allday' => false);
            array_push( $res, $event );
        };

        return $res;

    }

    public function salvar( Request $request)
    {


        $id = $request->input( 'id');
        $atdid=$request->input( 'IMB_ATD_ID');
        if( $atdid == '' )
            $atdid = Auth::user()->IMB_ATD_ID;
        
        if ( $id ) 
           $cal = mdlCalendar::find( $id );
        else
           $cal = new mdlCalendar;

        $cal->event_title = $request->input('title');
        $cal->event_start = $request->input('start');
        $cal->event_end   = $request->input('end');
        $cal->IMB_ATD_ID  = $atdid;
        $cal->IMB_IMB_ID  = Auth::user()->IMB_IMB_ID;

        $cal->save();

        return response()->json( $cal, 200);

    }


}
