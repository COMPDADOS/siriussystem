<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCobrancaGeradaPerm;
use App\mdlContaCaixa;
use App\mdlLocatarioContrato;
use App\mdlCliente;
use App\mdlReciboLocador;
use App\mdlTelefone;
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
        $whatsapp=$request->whatsapp;

        if( $datafim == '' and $datafim == '' )
        {
        
            $dias = "('0', '1', '10', '20')";

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
                ->where( 'IMB_CGR_ENTRADACONFIRMADA','=','S' )
                ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_COBRANCAGERADAPERM.IMB_CTR_ID' )
                //->where( 'IMB_CGR_DATAVENCIMENTO','>=', $datainicio )
    //            ->where( 'IMB_CGR_DATAVENCIMENTO','<=', $datafim );
                ->whereRaw( "( DATEDIFF (IMB_CGR_DATAVENCIMENTO, CURDATE() ) in $dias ) or ( IMB_CGR_DTHGERACAO = CURDATE() )" );

                //Log::info( $cobrancas->toSql());

        }
        else
        {
            $cobrancas = mdlCobrancaGeradaPerm::
                where( 'IMB_CTR_SITUACAO','=','ATIVO')
                ->whereNull( 'IMB_CGR_DATABAIXA')
                ->whereNull( 'IMB_CGR_DTHINATIVO')
                ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_COBRANCAGERADAPERM.IMB_CTR_ID' )
                ->where( 'IMB_CGR_ENTRADACONFIRMADA','=','S' )
                ->where( 'IMB_CGR_DATAVENCIMENTO','>=', $datainicio )
                ->where( 'IMB_CGR_DATAVENCIMENTO','<=', $datafim );
        }

            
       // Log::info( 'enviando cobrancas '.$datainicio.' a '.$datafim );
       // Log::info( 'sql: '.$cobrancas->toSql());


        $cobrancas = $cobrancas->get();

        foreach( $cobrancas as $cobranca)
        {
            $ccx = mdlContaCaixa::find( $cobranca->FIN_CCR_ID);

            $banco = $ccx->FIN_CCI_BANCONUMERO;

            Log::info( 'Data de vencimento: '.$cobranca->IMB_CGR_DATAVENCIMENTO );

            $lts = mdlLocatarioContrato::where('IMB_CTR_ID','=', $cobranca->IMB_CTR_ID )->get();



            foreach( $lts as $lt)
            {
                $clt = mdlCliente::find( $lt->IMB_CLT_ID );
                sleep( 5);
                //Log::info('Cliente: '.$clt->IMB_CLT_NOME );
                if( $clt )
                {

                    if( $whatsapp == 'S') 
                        $this->enviarPorWhatsapp( $lt->IMB_CLT_ID, $cobranca->IMB_CTR_ID, $banco, $cobranca->IMB_CGR_ID );
                    else
                    {

                        $email = app('App\Http\Controllers\ctrRotinas')->pegarEmailLocatarioPrincipalSemJson($cobranca->IMB_CTR_ID);
    //                    $email = $clt->IMB_CLT_EMAIL;
                        //Log::info( 'ctrprocessosautomaticos - Email: '.$email );

                        if( $email  )
                        {

                            try{
                                
                            Log::info('Enviando locatario: '.$clt->IMB_CLT_NOME);
                            Log::info( 'Vencimento '.date( 'd/m/Y', strtotime( $cobranca->IMB_CGR_DATAVENCIMENTO)));
                            if( $cobranca->FIN_CCI_BANCONUMERO == 341)
                                        app('App\Http\Controllers\ctrBoletoItau')
                                        ->index(  $cobranca->IMB_CGR_ID, 'S', $email );
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
                    
                                    catch (\Illuminate\Database\QueryException $e) {
                                        Log::info( 'Erro ao enviar boleto por email' );
                                    }    
                        }
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
            try
            {
                app('App\Http\Controllers\ctrReciboLocador')
                ->demonstrativosNew( $request );
            }
                    
            catch (\Illuminate\Database\QueryException $e) 
            {
                 Log::info( 'Erro ao enviar email demonstrativo' );
            }    
            $idclientepublico = '0';

            sleep(10);

        }
        if( $logged == 'N')
            Auth::logout();
        return response()->json('ok',200);

    }

    public function enviarPorWhatsapp( $idcliente, $idcontrato, $banco, $idcobranca )
    {
        $telefones = mdlTelefone::where( 'IMB_TLF_ID_CLIENTE','=', $idcliente )->get();
        foreach( $telefones as $telefone )
        {
            if( substr( $telefone->IMB_TLF_NUMERO,0,1) == '9' )
            {
                

                if( $banco == 33 )
                    $link= route('boleto.santander')."/".$idcobranca.'/N/X';
    
                if( $banco == 237 )
                    $link=  route('boleto.237')."/".$idcobranca.'/N/X';
                
                if( $banco == 341 )
                    $link= route('boleto.itau')."/".$idcobranca.'/N/X';
              
                if( $banco == 756 )
                    $link=  route('boleto.756')."/".$idcobranca.'/N/X';
    
                if( $banco == 84 )
                    $link=  route('boleto.084')."/".$idcobranca.'/N/X';
    
                if( $banco == 1 )
                    $link= route('boleto.001')."/".$idcobranca.'/N/X';
    
                if( $banco == 748 )
                    $link= route('boleto.748')."/".$idcobranca.'/N/X';


                $msg = 'Prezado cliente. Segue o link para que você possa pegar seu boleto de forma prática e segura. Link: '.$link;

                $MyRequest = new \Illuminate\Http\Request();
                $MyRequest->replace(['ddi' => $telefone->IMB_TLF_DDI ,   
                                        'ddd' => $telefone->IMB_TLF_DDD ,
                                        'numero' => $telefone->IMB_TLF_NUMERO ,
                                        'assunto' => 'Segue seu boleto para pagamento de aluguel',
                                        'idcontrato' => $idcontrato,
                                        'idcliente' => $idcliente,
                                        'msg' => $msg]);
                
                Log::info( 'Enviando automatico '.$telefone->IMB_TLF_NUMERO );
                app('App\Http\Controllers\ctrWhatsApp')->enviarMsg( $MyRequest);
                sleep(40);
            }

        }
    }
    
}
