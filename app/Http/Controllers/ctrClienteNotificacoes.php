<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlClienteNotificacoes;
use DB;
use Auth;
use Log;

class ctrClienteNotificacoes extends Controller
{
    public function novosClientes(  )
    {
        $nt = mdlClienteNotificacoes::select(
                [ 'IMB_CLIENTENOTIFICACOES.*',
                'IMB_CLT_NOME',
                DB::raw('(select PEGAFONES( IMB_CLIENTENOTIFICACOES.IMB_CLT_ID)) AS FONES')
                ]
        )->where('IMB_CLIENTENOTIFICACOES.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->where('IMB_CLIENTENOTIFICACOES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->whereNull( 'IMB_IMN_DTHVISUALIZACAO')
        ->leftJoin('IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_CLIENTENOTIFICACOES.IMB_CLT_ID')
        ->get();

        return $nt;

    }
    public function novosClientesQtd( )
    {
        $nt = mdlClienteNotificacoes::
            where('IMB_CLIENTENOTIFICACOES.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
            ->where('IMB_CLIENTENOTIFICACOES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_IMN_DTHVISUALIZACAO')
            ->count();

        return $nt;

    }

    public function informarClienteVisualizado( Request $request )
    {
        $id = $request->id;
        $iv = mdlClienteNotificacoes::find( $id );
        $iv->IMB_IMN_DTHVISUALIZACAO =  date('Y-m-d H:i:s');
        $iv->save();

        return response()->json('ok',200);


    }

}
