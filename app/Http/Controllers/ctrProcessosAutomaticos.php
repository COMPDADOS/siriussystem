<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCobrancaGeradaPerm;
use App\mdlContaCaixa;
use App\mdlLocatarioContrato;
use App\mdlCliente;
use App\mdlReciboLocador;
use DateTime;
use DateInterval;
use Auth;
use Log;

class ctrProcessosAutomaticos extends Controller
{
    public function boletosAutomaticos( Request $request)
    {

        $logged='S';
        if( ! Auth::check())
        {
            Auth::loginUsingId( 1,false);
            $logged = 'N';
        }
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;

        $datainicio = date( 'Y/m/d');
        $datafim = date( 'Y/m/d');
        
        $dias = "('0', '1', '10', '20')";

        //Log::info('Iniciando o processo de envio automatico');


        if( $datainicio == '' ) 
        {
            $datainicio = date( 'Y/m/d');
            $newDateIni = new DateTime($datainicio);
            $newDateIni->add(new DateInterval('P1D')); // P1D means a period of 1 day
            $datainicio = $newDateIni->format('Y-m-d');
        }
        
    
        if( $datafim == '' ) 
        {
            $datafim = date( 'Y/m/d');
            $newDateFim = new DateTime($datafim);
            $newDateFim->add(new DateInterval('P5D')); // P10D means a period of 10 day
            $datafim    = $newDateFim->format('Y-m-d');

        }
        else
        {
            $newDateFim = new DateTime($datafim);
            $newDateFim->add(new DateInterval('P1D')); // P10D means a period of 10 day
            $datafim    = $newDateFim->format('Y-m-d');

        }
   
        $cobrancas = mdlCobrancaGeradaPerm::
            where( 'IMB_CTR_SITUACAO','=','ATIVO')
            ->whereNull( 'IMB_CGR_DATABAIXA')
            ->whereNull( 'IMB_CGR_DTHINATIVO')
            ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_COBRANCAGERADAPERM.IMB_CTR_ID' )
//            ->where( 'IMB_CGR_DATAVENCIMENTO','>=', $datainicio )
  //          ->where( 'IMB_CGR_DATAVENCIMENTO','<=', $datafim )
            ->whereRaw( "( DATEDIFF (IMB_CGR_DATAVENCIMENTO, CURDATE() ) in $dias ) or ( IMB_CGR_DTHGERACAO = CURDATE() )" );

            //Log::info( $cobrancas->toSql());

            

        $cobrancas = $cobrancas->get();

        foreach( $cobrancas as $cobranca)
        {
            $ccx = mdlContaCaixa::find( $cobranca->FIN_CCR_ID);

            $banco = $ccx->FIN_CCI_BANCONUMERO;

            $lts = mdlLocatarioContrato::where('IMB_CTR_ID','=', $cobranca->IMB_CTR_ID )->get();

            foreach( $lts as $lt)
            {
                $clt = mdlCliente::find( $lt->IMB_CLT_ID );
                //Log::info('Cliente: '.$clt->IMB_CLT_NOME );
                if( $clt )
                {
                    $email = app('App\Http\Controllers\ctrRotinas')->pegarEmailLocatarioPrincipalSemJson($cobranca->IMB_CTR_ID);
//                    $email = $clt->IMB_CLT_EMAIL;
                    //Log::info( 'ctrprocessosautomaticos - Email: '.$email );

                    if( $email  )
                    {

                        //Log::info( 'banco '.$banco);
                        if( $cobranca->FIN_CCI_BANCONUMERO == 756)
                                    app('App\Http\Controllers\ctrBoleto756')
                                    ->index(  $cobranca->IMB_CGR_ID, 'S', $email );
                        if( $cobranca->FIN_CCI_BANCONUMERO == 237)
                                    app('App\Http\Controllers\ctrBoleto237')
                                    ->index(  $cobranca->IMB_CGR_ID, 'S', $email );
                        if( $cobranca->FIN_CCI_BANCONUMERO == 748)
                                    app('App\Http\Controllers\ctrBoleto748')
                                    ->index(  $cobranca->IMB_CGR_ID, 'S', $email );
                        if( $cobranca->FIN_CCI_BANCONUMERO == 1)
                                    app('App\Http\Controllers\ctrBoleto001')
                                    ->index(  $cobranca->IMB_CGR_ID, 'S', $email );
                        if( $cobranca->FIN_CCI_BANCONUMERO == 33)
                                    app('App\Http\Controllers\ctrBoleto033')
                                    ->index(  $cobranca->IMB_CGR_ID, 'S', $email );

                    }
                }

            }
        }
        if( $logged == 'N')
            Auth::logout();
        return response()->json( 'ok',200);

    }

    public function demonstrativosLocadorDiario( Request $request )
    {

        $logged='S';
        if( ! Auth::check())
        {
            Auth::loginUsingId( 1,false);
            $logged = 'N';
        }


        $datainicial =$request->datainicial;
        $datafinal = $request->datafinal;
        $email = $request->email;

        if( $datainicial == '' or $datainicial == null  )
            $datainicial = date('Y/m/d');
        if( $datafinal == '' or $datafinal == null )
            $datafinal = date('Y/m/d');

        $recs = mdlReciboLocador::select( [ 'IMB_CLT_ID'])->distinct( 'IMB_CLT_ID')
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','>=',$datainicial )
            ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','<=',$datafinal )
            ->get();

        foreach( $recs as $rec )
        {
            $idclientepublico = $rec->IMB_CLT_ID;
            $request->IMB_CLT_ID = $rec->IMB_CLT_ID;
            $request->email ='S';

            app('App\Http\Controllers\ctrReciboLocador')
            ->demonstrativos( $request );
            $idclientepublico = '0';

            sleep(10);

        }
        if( $logged == 'N')
            Auth::logout();
        return response()->json('ok',200);

    }
}
