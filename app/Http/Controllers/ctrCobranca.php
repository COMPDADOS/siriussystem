<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCobrancaGeradaPerm;
use App\mdlContaCaixa;
use Log;

use Auth;

class ctrCobranca extends Controller
{
    public function cargaBoletosContrato( $id )
    {
        $cob = mdlCobrancaGeradaPerm::
        where( 'IMB_CTR_ID','=',$id )
        ->leftJoin( 'FIN_CONTACAIXA','FIN_CONTACAIXA.FIN_CCX_ID', 'IMB_COBRANCAGERADAPERM.FIN_CCR_ID')
        ->orderBy( 'IMB_CGR_DATAVENCIMENTO','DESC')
        ->where( 'IMB_COBRANCAGERADAPERM.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->limit(12)
        ->get();



        return $cob;
    }


    public function gerarGenerico( $id )
    {

        $cob = mdlCobrancaGeradaPerm::find( $id );

        $conta = mdlContaCaixa::find( $cob->FIN_CCR_ID );

        Log::info( $conta->FIN_CCI_BANCONUMERO );

        if( $conta->FIN_CCI_BANCONUMERO == 33 )
            $view = app('App\Http\Controllers\ctrBoletoSantander')
            ->index( $id);


    }
}
