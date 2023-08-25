<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlHistoricoImovel;
use App\mdlImovel;
use DataTables;
use Auth;

class ctrHistoricoImovel extends Controller
{
    public function carga( $id )
    {
        $his = mdlHistoricoImovel::select(
            [
                'IMB_GRT_DESCRICAO',
                'IMB_ATD_NOME',
                'IMB_IMH_ID',
                'IMB_IMV_ID',
                'IMB_IMH_DTHALTERACAO',
                'IMB_IMH_CAMPO',
                'IMB_IMH_VALORANTERIOR',
                'IMB_IMH_VALORATUAL'
            ]
        )
        ->where( "IMB_IMV_ID",'=',$id)
        ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID','IMB_IMOVEISHISTORICO.IMB_ATD_ID')
        ->leftJoin( 'IMB_GRUPOTELA', 'IMB_GRUPOTELA.IMB_GRT_ID','IMB_IMOVEISHISTORICO.IMB_GRT_ID')
        ->orderBy('IMB_IMH_DTHALTERACAO','DESC')

        ->get();

        return DataTables::of($his)->make(true);

    }

    public function find( $id )
    {
        $his = mdlHistoricoImovel::find( $id );

        return $his;
    }





}
