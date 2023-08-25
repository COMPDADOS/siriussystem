<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAdmCondominio;

class ctrAdmCondominio extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( '/admcon/admconindex');
    }


    public function buscar( $id )
    {
        $con = mdlAdmCondominio::find( $id );
        return $con;
    }

    public function salvar( Request $request )
    {
        $id = $request->input('IMB_ADMCON_ID');

        if( $id == '' )
            $con = new mdlAdmCondominio;
        else
            $con =  mdlAdmCondominio::find( $id );

        $con->IMB_ADMCON_NOME     = $request->input('IMB_ADMCON_NOME');
        $con->IMB_ADMCON_CONTATO1 = $request->input('IMB_ADMCON_CONTATO1');
        $con->IMB_ADMCON_FONE1    = $request->input('IMB_ADMCON_FONE1');
        $con->IMB_ADMCON_EMAIL    = $request->input('IMB_ADMCON_EMAIL');
        $con->IMB_IMB_ID          = $request->input('IMB_IMB_ID');
        $con->save();
        return response()->json( 'ok', 200);

    }

    public function carga( $empresa )
    {

        if( $empresa == '0')
        {
            $dados = mdlAdmCondominio::all();
        }
        else
        {
            $dados = mdlAdmCondominio::where('IMB_IMB_ID','=', $empresa)->get();

        }

        return $dados;
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
    public function destroy( $id )
    {
        $con = mdlAdmCondominio::find( $id );
        if( $con->IMB_ADMCON_DTHINATIVO == '')
            $con->IMB_ADMCON_DTHINATIVO = date( 'Y/m/d');
        else
            $con->IMB_ADMCON_DTHINATIVO = null;
        $con->save();
        return response()->json( 'ok', 200);

    }


    public function pesquisar( $texto, $empresa )
    {

        if( $empresa == '0')
        {
            $condominio = mdlAdmCondominio::
                where('IMB_ADMCON_NOME','like', "%".$texto."%")
                ->orderBy('IMB_ADMCON_NOME')
                ->get();
            
        }
        else
        {
            $condominio = mdlAdmCondominio::where('IMB_ADMCON_NOME','like', "%".$texto."%")
            ->where('IMB_IMB_ID','=', $empresa)
            ->orderBy('IMB_ADMCON_NOME')
            ->get();
        }

        return $condominio;
    }
}
