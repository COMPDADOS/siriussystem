<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImoveisNotificacoes;
use DB;
use Auth;
use Log;

class ctrImoveisNotificacoes extends Controller
{
    public function novosImoveis(  )
    {
        $nt = mdlImoveisNotificacoes::select(
                ['*',
                DB::raw('(select imovel( IMB_IMOVEISNOTIFICACOES.IMB_IMV_ID)) AS ENDERECO'),
                DB::raw('(SELECT IMB_CND_NOME FROM IMB_CONDOMINIO WHERE IMB_CONDOMINIO.IMB_CND_ID
                    = IMB_IMOVEIS.IMB_CND_ID) AS IMB_CND_NOME' ),
                DB::raw('(SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL WHERE IMB_TIPOIMOVEL.IMB_TIM_ID
                    = IMB_IMOVEIS.IMB_TIM_ID) AS IMB_TIM_DESCRICAO' )
                ]
        )->where('IMB_IMOVEISNOTIFICACOES.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->where('IMB_IMOVEISNOTIFICACOES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->whereNull( 'IMB_IMN_DTHVISUALIZACAO')
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_IMOVEISNOTIFICACOES.IMB_IMV_ID')
        ->orderBy( 'IMB_IMN_DTHCADASTRO')
        ->get();

        return $nt;

    }
    public function novosImoveisQtd( )
    {
        $nt = mdlImoveisNotificacoes::
            where('IMB_IMOVEISNOTIFICACOES.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
            ->where('IMB_IMOVEISNOTIFICACOES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_IMN_DTHVISUALIZACAO')
            ->count();

        return $nt;

    }

    public function informarImovelVisualizado( Request $request )
    {
        $id = $request->id;
        $iv = mdlImoveisNotificacoes::find( $id );
        $iv->IMB_IMN_DTHVISUALIZACAO =  date('Y-m-d H:i:s');
        $iv->save();

        return response()->json('ok',200);


    }
    
}
