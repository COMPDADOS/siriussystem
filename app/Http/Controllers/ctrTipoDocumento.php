<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoDocumento;

class ctrTipoDocumento extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index( )
    {
    }

    public function carga( )
    {
            $tabela= mdlTipoDocumento::orderBy('FIN_TPD_DESCRICAO')->get();

        return $tabela;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'tipoimovel/tipoimovelnew');
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
    public function edit( Request $request )
    {

    }


    public function update(Request $request)
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
            return response()->json( 'OK',200 );
    }


    public function vereapagar($id)
    {

        //
    }

    public function buscar( $id )
    {

    }





}
