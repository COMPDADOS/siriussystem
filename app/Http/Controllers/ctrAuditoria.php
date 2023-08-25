<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlObs;
use App\mdlLog;
use DataTables;
use Auth;

class ctrAuditoria extends Controller
{
    public function logClienteIndex( $IMB_CLT_ID )
    {
        return view( 'auditoria.auditoriacliente',compact('IMB_CLT_ID') );
    }

    public function geralIndex()
    {
        return view( 'auditoria.auditoriaindex');
    }
    public function logCliente( Request $request )
    {
        $idcliente=$request->IMB_CLT_ID;

        $obs = mdlObs::where('IMB_OBSERVACAOGERAL.IMB_CLT_ID','=',$idcliente )
        ->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID',
        'IMB_OBSERVACAOGERAL.IMB_ATD_ID')
        ->orderBy( 'IMB_OBS_DTHATIVO','DESC')
        ->get();

        return DataTables::of($obs)->make(true);

    }

    public function logImovel( Request $request )
    {
        $idimovel=$request->IMB_IMV_ID;

        $obs = mdlObs::where('IMB_IMV_ID','=',$idimovel )
        ->orderBy( 'IMB_OBS_DTHATIVO','DESC')
        ->get();

        return DataTables::of($obs)->make(true);

    }

    public function gravarLogCliente( Request $request )
    {

    }


    public function cargaLog( Request $request )
    {

        $datainicio = $request->datainicio;
        $datatermino = $request->datatermino;
        $IMB_IMV_ID = $request->IMB_IMV_ID;
        $IMB_CTR_ID = $request->IMB_CTR_ID;
        $IMB_CLT_ID = $request->IMB_CLT_ID;
        $origem = $request->origem;


        $obs = mdlObs::select(
            [
                'IMB_OBSERVACAOGERAL.IMB_ATD_ID',
                'IMB_ATENDENTE.IMB_ATD_NOME',
                'IMB_OBS_DTHATIVO',
                'IMB_OBS_OBSERVACAO'
            ])
        ->where( 'IMB_OBSERVACAOGERAL.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_OBSERVACAOGERAL.IMB_ATD_ID');

        if( $datainicio and $datatermino )
            $obs->where( 'IMB_OBS_DTHATIVO','>=', $datainicio )
                ->where( 'IMB_OBS_DTHATIVO','<=', $datatermino );


        if( $IMB_CTR_ID <> 0 )
            $obs->where( 'IMB_CTR_ID','=', $IMB_CTR_ID );

        $obs->orderBy('IMB_OBS_DTHATIVO','DESC');


        return DataTables::of($obs)->make(true);



    }

}
