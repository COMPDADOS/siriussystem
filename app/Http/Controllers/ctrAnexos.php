<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAnexos;
use Auth;
use DataTables;

use DB;

class ctrAnexos extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function list( Request $request)
    {


        $iddestino = $request->iddestino;
        $tipodestino = $request->tipodestino;

        if( $iddestino == ''  ) return response()->json( 'Faltando parametros id destino', 404);

        if( $tipodestino == ''  ) return  response()->json( 'Faltando parametros tipodestino', 404);

        $anxs = mdlAnexos::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_ANX_TIPODESTINO','=', $tipodestino )
            ->where( 'IMB_ANX_CODIGODESTINO','=', $iddestino )
            ->orderBy( 'IMB_ANX_TIPODESTINO' )
            ->orderBy( 'IMB_ANX_TITULO')
            ->get();

        return DataTables::of($anxs)->make(true);

    }



}
