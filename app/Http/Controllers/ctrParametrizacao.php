<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlImobiliaria;
use Auth;

class ctrParametrizacao extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
        
        
    public function index()
    {
        $imb = mdlImobiliaria::where( 'IMB_IMB_IDMASTER','=',Auth::user()->IMB_IMB_ID);
        return view('parametrizacao.paramempresa', compact('imb'));
    }

    public function pegarParametros1( Request $request )
    {

        $par = mdlParametros::where( 'IMB_PARAMETROS.IMB_IMB_ID','=', $request->id )
        ->leftJoin( 'IMB_PARAMETROS2','IMB_PARAMETROS2.IMB_IMB_ID', 'IMB_PARAMETROS.IMB_IMB_ID')
        ->first();
        return response()->json( $par,200);
    }
}
