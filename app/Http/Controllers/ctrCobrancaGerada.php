<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCobrancaGerada;
use App\mdlCobrancaGeradaItem;
use App\mdlCobrancaGeradaItemPerm;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaPermSel;
use App\mdlContrato;
use App\mdlLancamentoFuturo;
use App\mdlImobiliaria;
use App\mdlContaCaixa;
use App\mdlRetornoBancario;
use App\mdlTabelaEvento;
use App\mdlReciboLocatario;
use App\mdlReciboLocatarioControle;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlTabelaMulta;
use App\mdlTmpPrevisaoRecebimentoDetail;
use App\mdlTmpPrevisaoRecebimento;
use App\mdlLocatarioContrato;
use App\mdlObs;

use Illuminate\Support\Carbon;

use DataTables;
use DateTime;
use Log ;
use DB;
use Auth;
use PDF;

class ctrCobrancaGerada extends Controller
{
    public $ordem = '';

    public function index()
    {
        return view( 'cobrancabancaria.cobrancaindex');
    }
    public function viewGerar( Request $request )
    {

        return view( 'cobrancabancaria.cobrancagerar');

    }



    public function selecionarContratos( Request $request )
    {

        //Log::info( 'gear!');
        $cob = mdlCobrancaGerada::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

        $contacobranca = $request->FIN_CCX_ID;
        $atrasado = $request->geraratrasado;
        $juridico = $request->gerarjuridico;
        $date = Carbon::today();



        $contratos = mdlContrato::where( 'IMB_CTR_SITUACAO','=','ATIVO')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_FORPAG_ID_LOCATARIO','=','1')
        ->where( 'FIN_CCR_ID_COBRANCA','=',$contacobranca) ;

        if( $juridico == 'N')
            $contratos = $contratos->whereRaw( "coalesce(IMB_CTR_ADVOGADO,'N') <> 'S'");

        if( $atrasado == 'N')
           $contratos= $contratos->whereDate('IMB_CTR_VENCIMENTOLOCATARIO', '>=', $date);


        if( $request->IMB_CTR_ID <> 0 )
        {
            $contratos = $contratos->where( 'IMB_CTR_ID','=', $request->IMB_CTR_ID );

        }

//        $contratos = $contratos->where( 'IMB_CTR_ID','=', 51239 );
        $contratos = $contratos->orderBy( 'IMB_IMV_ID','ASC');


        //Log::info( $contratos->toSql());        
        $contratos = $contratos->get();


        //$contratos = Datatables::eloquent($contratos);
        foreach( $contratos as $contrato)
        {

            Log::info( 'entou');


            $idcontrato     = $contrato->IMB_CTR_ID;

            $diainicial     = app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->diainicial, 2,0);

            $diafinal       =  app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->diafinal, 2,0);

            $mesinicial     = app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->mesinicial, 2,0);

            $mesfinal     = app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->mesfinal, 2,0);

            $anoinicial     = $request->anoinicial;
            $anofinal       = $request->anofinal;




                //Log::info('entrou 2');
                $this->gerar( $idcontrato,
                                    $contrato->IMB_CTR_DIAVENCIMENTO,
                                   $diainicial,
                                   $diafinal ,
                                   $mesinicial,
                                   $mesfinal ,
                                   $anoinicial,
                                   $anofinal,
                                   $contacobranca
                                );

        }

        $cob =  mdlCobrancaGerada::
        where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->where('IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_CGR_DATAVENCIMENTO')
        ->get();


        


        return response()->json( $cob,200);


    }


    public function gerar(  $idcontrato,
                                $diavencimentoctr,
                                $diainicial,
                                $diafinal ,
                                $mesinicial,
                                $mesfinal ,
                                $anoinicial,
                                $anofinal,
                                $contacobranca )

    {

        //dd( "inicial: ".$anoinicial.'-'.$mesinicial."-".$diainicial." <-> final: ".$anofinal.'-'.$mesfinal."-".$diafinal);

        $begin = new DateTime( $anoinicial.'-'.$mesinicial."-".$diainicial );
        $end = new DateTime( $anofinal.'-'.$mesfinal."-".$diafinal );

        $intervalo = $begin->diff( $end );

        //Repare que inverto a ordem, assim terei a subtração da ultima data pela primeira.
        //Calculando a diferença entre os meses
        $meses = ((int)$end->format('m') - (int)$begin->format('m'))
        //    e somando com a diferença de anos multiplacado por 12
            + (((int)$end->format('y') - (int)$begin->format('y')) * 12);
        
        $meses++;
//        $meses = $intervalo->m;
        //$meses = round($meses);
        //$meses = $meses + 1;

        $mes = $mesinicial;
        $ano = $anoinicial;
        $dia = $diainicial;
        
        $ultimodia = app('App\Http\Controllers\ctrRotinas')->ultimoDiaMes($mes,  $ano );
        if( $diavencimentoctr > $ultimodia )
           $diavencimentoctr = $ultimodia;

        $dataapp = mktime( 0, 0, 0, $mes,$diavencimentoctr, $ano);


        $datavencimento = $dataapp;
//        $qtdias = intval( $anofinal.$mesfinal.$diafinal ) - intval( $anoinicial.$mesinicial.$diainicial );
        //$qtdias += 10;
        //$meses = round($qtdias / 30);


        $intinicio = intval($anoinicial.$mesinicial.$diainicial);
        $intfim = intval($anofinal.$mesfinal.$diafinal );
        $intvencimento = intval(date( 'Ymd',$datavencimento));

//        Log::info( "$intvencimento >= $intinicio" );
        //Log::info( "$intvencimento <= $intfim" );

        if(  $intvencimento >= $intinicio
                    and $intvencimento <= $intfim)
        {
            if( $mesinicial == $mesfinal and $anoinicial == $anofinal ) $meses = 1;

            for($i = 1; $i <= $meses; $i++)
            {
                //Log::info('for');

                //Log::info('meses');
                //Log::info( $datavencimento );
                if( $this->existeBoleto( $datavencimento, $idcontrato  ) =='N')
                {
                    //Log::info( 'não existe');
                    //lancando os dixos
                    app('App\Http\Controllers\ctrLancamentoFuturo')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                    ->gerarFixos( $idcontrato, date( 'Y-m-d',$datavencimento),'LT'  );
                    $this->gerarItens( $datavencimento, $idcontrato,$contacobranca );

                }


                $mes++;
                if( $mes > 12 )
                {
                    $mes = 1;
                    $ano++;
                }

                $diactr = $diavencimentoctr;

                $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));

                if( $diavencimentoctr > $ultimo_dia)
                    $diactr = $ultimo_dia;

                $datavencimento = mktime( 0, 0, 0, $mes,$diactr, $ano);

            }
        }

        return response()->json('ok',200);

    }

    public function gerarItens( $datavencimento, $idcontrato,$contacobranca )
    {

        $objbases = new \stdClass();

        $vencimento = date( 'Y/m/d',$datavencimento);

       
        $ctr = mdlContrato::find( $idcontrato );

        $locatario = app('App\Http\Controllers\ctrRotinas')
                    ->nomeLocatarioPrincipal( $idcontrato );

        $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                    ->imovelEndereco( $ctr->IMB_IMV_ID );


        $endereco = app('App\Http\Controllers\ctrRotinas')
                    ->pegarEnderecoCobranca( $idcontrato );

        $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                    ->codigoLocatarioPrincipal( $idcontrato );

        $locatario =  app('App\Http\Controllers\ctrRotinas')
        ->clienteDadosFull( $idlocatario );

        $descontoacordo = app('App\Http\Controllers\ctrRotinas')
        ->verificarEventoLancado( $idcontrato, $vencimento, 8 );


        $tarifaBoleto = app('App\Http\Controllers\ctrRotinas')
        ->tarifaBoleto( $idcontrato, $vencimento );

        $datalimite = app('App\Http\Controllers\ctrRotinas')
        ->dataLimite( $idcontrato, $vencimento );

        $pontualidade=0;
        if( $ctr->IMB_CTR_VALORBONIFICACAO4 <> 0 )
            $pontualidade = app('App\Http\Controllers\ctrRotinas')
                        ->valorDescontoPontualidade( $idcontrato, $vencimento, $vencimento, $descontoacordo,'LT' );

        //Log::info('pasta: '.$ctr->IMB_CTR_REFERENCIA );
        //Log::info('IMOVEL: '.$endereco->IMB_CCB_ENDERECO);
        //Log::info('Locatario: '.$endereco->IMB_CCB_DESTINATARIO);
        
//        Log::info( 'Locatario: '.$locatario );

       if( $locatario)
        {

            $bairro=$endereco->IMB_CCB_BAIRRO;
            $bairro=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($bairro);
            $hd = new mdlCobrancaGerada;
            $hd->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $hd->IMB_CGR_DESTINATARIO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_DESTINATARIO);
            $hd->IMB_CGR_ENDERECO = substr(
                app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_ENDERECO).
                ' '.$endereco->IMB_CCB_ENDERECONUMERO.
                ' '.$endereco->IMB_CCB_ENDERECOCOMPLEMENTO,0,40);
            $hd->IMV_CGR_CEP = $endereco->IMB_CCB_CEP;
            
            $hd->IMB_CEP_BAI_NOME = substr(app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_BAIRRO),0,19);
            $hd->IMB_CEP_CID_NOME = substr(app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->CEP_CID_NOME),0,19);
            $hd->IMB_CGR_DATAVENCIMENTO = $vencimento;
            $hd->IMB_CGR_VENCIMENTOORIGINAL = $vencimento;
            $hd->CEP_UF_SIGLA = $endereco->CEP_UF_SIGLA;
            $hd->IMB_CGR_CPF = $locatario->IMB_CLT_CPF;
            $hd->IMB_CGR_PESSOA = $locatario->IMB_CLT_PESSOA;
            $hd->IMB_CTR_ID = $idcontrato;
            $hd->IMB_CGR_IMOVEL = $imovelendereco;
            $hd->IMB_CGR_DATALIMITE = $datalimite;
            $hd->IMB_CLT_EMAIL = $locatario->IMB_CLT_EMAIL;
            $hd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $hd->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $hd->IMB_CGR_VALORPONTUALIDADE = $pontualidade;
            $hd->IMB_CGR_TARIFABOLETO = $tarifaBoleto;
            $hd->IMB_CTR_REFERENCIA = $ctr->IMB_CTR_REFERENCIA;
            $hd->IMB_CGR_INCONSISTENCIA         = '';
            $hd->IMB_CGR_SELECIONADA         = 'S';
            $hd->FIN_CCR_ID     = $contacobranca;
            $hd->imb_cgr_idpermanente     = 0;

            $reajustar = app('App\Http\Controllers\ctrRotinas')->verificarReajustes(  $idcontrato,date('Y-m-d',strtotime($vencimento)),'N')  ;

            ////////Log::info('---- CTRCOBRANCA');
            ////////Log::info( 'Reajustar '.$reajustar );
            
            if( $reajustar == 'S' )
            {
                $hd->IMB_CGR_INCONSISTENCIA = 'Precisa de Reajuste';
                $hd->IMB_CGR_SELECIONADA ='N';
            };


            $hd->save();

            


            //if( $reajustar == 'N')
         //   {

                ////////Log::info('entrou no reajustar NÃO');
                $objbases->baseirrf      = 0;
                $objbases->basemulta     = 0;
                $objbases->basejuros     = 0;
                $objbases->basecorrecao  = 0;

                app('App\Http\Controllers\ctrRotinas')
                ->lancarAluguel($idcontrato, date( 'Y-m-d',$datavencimento) );

                $itemaluguel = 0;
                $irrflancando = 0;
                $tarifaboletolancado ='N';

                $lcfs = app('App\Http\Controllers\ctrLancamentoFuturo')
                ->lancamentomeslocatario( $vencimento, $idcontrato,'0' );


                foreach ( $lcfs as $lf )
                {
                    if( $lf->IMB_TBE_ID == 1 )
                    $itemaluguel = $lf->IMB_LCF_VALOR;
                    $valorlcf = $lf->IMB_LCF_VALOR;
                    if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C' )
                    $valorlcf = $valorlcf * -1;

                    if( $lf->IMB_TBE_ID == 18 ) $irrflancando = $lf->IMB_LCF_VALOR;
                    if( $lf->IMB_TBE_ID == 23 ) $tarifaboletolancado = 'S';
                    

                    if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideMulta( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basemulta = $objbases->basemulta + $valorlcf;


                    if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideJuros( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basejuros = $objbases->basejuros + $valorlcf;


                    if( app('App\Http\Controllers\ctrLancamentoFuturo')
                        ->incideCorrecao( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basecorrecao = $objbases->basecorrecao + $valorlcf;

                    if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideIRRF( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->baseirrf = $objbases->baseirrf + $valorlcf;

                    $item                               = new mdlCobrancaGeradaItem;
                    $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                    $item->IMB_LCF_ID                   = $lf->IMB_LCF_ID;
                    $item->IMB_TBE_ID                   = $lf->IMB_TBE_ID;
                    $item->IMB_TBE_DESCRICAO            = $lf->IMB_TBE_NOME;
                    $item->IMB_RLT_LOCATARIOCREDEB      = $lf->IMB_LCF_LOCATARIOCREDEB;
                    $item->IMB_RLT_LOCADORCREDEB        = $lf->IMB_LCF_LOCADORCREDEB;
                    $item->IMB_LCF_VALOR                = $lf->IMB_LCF_VALOR;
                    $item->IMB_LCF_OBSERVACAO           = $lf->IMB_LCF_OBSERVACAO;
                    $item->IMB_LCF_DATAVENCIMENTO       = $lf->IMB_LCF_DATAVENCIMENTO;
                    $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $item->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                    $item->save();
                }

                
                if ( $tarifaBoleto <> 0 and $tarifaboletolancado  == 'N' )
                {
                    $item                               = new mdlCobrancaGeradaItem;
                    $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                    $item->IMB_LCF_ID                   = 0;
                    $item->IMB_TBE_ID                   = 23;
                    $item->IMB_TBE_DESCRICAO            = 'Tarifa Boleto';
                    $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                    $item->IMB_RLT_LOCADORCREDEB        = 'N';
                    $item->IMB_LCF_VALOR                = $tarifaBoleto;
                    $item->IMB_LCF_OBSERVACAO           = '';
                    $item->IMB_LCF_DATAVENCIMENTO       = $vencimento;
                    $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $item->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                    $item->save();
                }


                $multa =  app('App\Http\Controllers\ctrRotinas')
                        ->calcularMulta( $idcontrato, $vencimento, '2100/12/30', $objbases->basejuros);

                if( $multa->repassarvalor <> 0 )
                {

                    if( $multa->repassardias <> 0 )
                        $hd->IMB_CGR_MULTA1DESCRICAO = 'Até '.$multa->repassardias.' dias de vencido, cobrar multa de '.
                                                    'R$ '.$multa->repassarvalor;
                    else
                        $hd->IMB_CGR_MULTA1DESCRICAO = 'Após '.$datalimite.' Cobrar multa de '.
                                'R$ '.$multa->repassarvalor;
                }
                if( $multa->reterdias <> 0 )
                {
                    $hd->IMB_CGR_MULTA2 = $multa->retervalor;
                    $hd->IMB_CGR_MULTA2DESCRICAO = 'Após, cobrar multa de R$ '.$multa->retervalor;

                }
                $hd->save();


                if(  $ctr->IMB_CTR_NUNCARETEIRRF <> 'S' and $irrflancando == 0 )
                {
                    $irrf=$valorirrf = app('App\Http\Controllers\ctrTabelaIRRF')
                    ->calcularIRRF( $idcontrato, $objbases->baseirrf );

                    foreach ($irrf as $irrfcal)
                    {
                        $item                               = new mdlCobrancaGeradaItem;
                        $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                        $item->IMB_LCF_ID                   = 0;
                        $item->IMB_TBE_ID                   = 18;
                        $item->IMB_TBE_DESCRICAO            = 'I.R.R.F.';
                        $item->IMB_RLT_LOCATARIOCREDEB      = 'C';
                        $item->IMB_RLT_LOCADORCREDEB        = 'D';
                        $item->IMB_LCF_VALOR                = $irrfcal['valorIRRF'];
                        $item->IMB_LCF_OBSERVACAO           = 'Retenção IRRF de '.
                                                        $irrfcal['cliente'].' - CPF: '.
                                                        $irrfcal['cpf'];
                        $item->IMB_LCF_DATAVENCIMENTO       = $vencimento;
                        $item->IMB_CLT_ID                   = $irrfcal['IMB_CLT_ID'];
                        $item->IMB_ATD_ID                   = Auth::user()->IMB_ATD_ID;
                        $item->save();
                    }
                }

                    //else
                    //if( strtotime($hd->IMB_CGR_DATAVENCIMENTO) > strtotime($ctr->IMB_CTR_TERMINO) )
                    //  $hd->IMB_CGR_INCONSISTENCIA = 'Renovar Contrato';

                //Calculando o total em itens do boleto
                $hd->IMB_CGR_VALOR = $this->calcularTotalBoleto( $hd->IMB_CGR_ID );
                $hd->save();
            //}

            if( $hd->IMB_CGR_VALOR  == 0 and $hd->IMB_CGR_INCONSISTENCIA == '' ) $hd->delete();
        }
        return response()->json('ok',200);

    }

    public function calcularTotalBoleto( $id )
    {
        $itens = mdlCobrancaGeradaItem::where('IMB_CGR_ID','=',$id )->get();

        $total = 0;
        foreach( $itens as $item )
        {
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'D')
              $total = $total + $item->IMB_LCF_VALOR;
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'C')
              $total = $total - $item->IMB_LCF_VALOR;
        }

        return $total;

    }

    public function geradas()
    {

        return view( 'cobrancabancaria.cobrancagerada');

    }
    public function carteira()
    {
        return view( 'cobrancabancaria.cobrancacarteira');

    }

    public function carga( Request $request )
    {
        $ordem = $request->ordem;
        if( $ordem == '') $ordem = 'IMB_CTR_REFERENCIA';
        $cob = mdlCobrancaGerada::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->orderBy( "$ordem")
        ->get();


        return $cob;


    }

    public function cargaCarteira( Request $request)
    {
        $FIN_CCX_ID = $request->FIN_CCX_ID;
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $contrato = $request->contrato;
        $pasta = $request->pasta;
        $baixado = $request->baixado;
        $selecionar = $request->selecionar;
        //dd( $FIN_CCX_ID );
        $user = Auth::user()->IMB_ATD_ID;
        $cob = mdlCobrancaGeradaPerm::select(   'IMB_COBRANCAGERADAPERM.*',
        DB::raw( "( select IMB_CTR_BOLETOVIAEMAIL FROM IMB_CONTRATO 
         WHERE IMB_CONTRATO.IMB_CTR_ID = IMB_COBRANCAGERADAPERM.IMB_CTR_ID LIMIT 1) AS IMB_CTR_BOLETOVIAEMAIL"),
        DB::raw("(select IMB_CGS_ID FROM IMB_COBRANCAGERADAPERMSEL WHERE
        IMB_COBRANCAGERADAPERMSEL.IMB_CGR_ID = IMB_COBRANCAGERADAPERM.IMB_CGR_ID
        AND IMB_COBRANCAGERADAPERMSEL.IMB_ATD_ID = $user limit 1) Selecao") )
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_COBRANCAGERADAPERM.IMB_CTR_ID')

        ->where( 'IMB_COBRANCAGERADAPERM.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where('FIN_CCR_ID','=',$FIN_CCX_ID )
        ->where('IMB_CTR_SITUACAO','=', 'ATIVO' )
        ->orderBy('IMB_CGR_DATAVENCIMENTO');

        if( $request->inativados <> 'S')
        $cob = $cob->whereNull( 'IMB_CGR_DTHINATIVO');

        if( $request->baixados <> 'S')
        $cob = $cob->whereNull( 'IMB_CGR_DATABAIXA');

        if( $contrato <> '' )
            $cob = $cob->where('IMB_COBRANCAGERADAPERM.IMB_CTR_ID','=',$contrato );

        if( $pasta <> '' )
            $cob = $cob->where('IMB_CTR_REFERENCIA','=',$pasta );


        if( $datainicio and $datafim )
        {
            $cob = $cob->where( "IMB_CGR_DATAVENCIMENTO",">=", $datainicio )
                        ->where( "IMB_CGR_DATAVENCIMENTO","<=", $datafim );
        };

        

        $reopen = $cob;
//        //////Log::info( $cob->toSql());
        $cob = $cob->get();

        if( $selecionar == 'S')
        {
            $perm = mdlCobrancaGeradaPermSel::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();
            foreach( $cob as $c )
            {

                $perm = new mdlCobrancaGeradaPermSel;
                $perm->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $perm->IMB_CGR_ID = $c->IMB_CGR_ID;
                $perm->save();
            };
        };
        if( $selecionar == 'N')
        {
            $perm = mdlCobrancaGeradaPermSel::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();
            foreach( $cob as $c )
            {
                $c = mdlCobrancaGeradaPermSel::where( 'IMB_CGR_ID','=', $c->IMB_CGR_ID )->delete();
            };

        };

        $reopen = $reopen->get();


        return response()->json($reopen,200);


    }

    public function cargaItens( $id )
    {
        $item = mdlCobrancaGeradaItem::where( 'IMB_CGR_ID','=',$id )
        ->leftJoin('IMB_TABELAEVENTOS',
                        'IMB_TABELAEVENTOS.IMB_TBE_ID',
                        'IMB_COBRANCAGERADAITEM.IMB_TBE_ID')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_COBRANCAGERADAITEM.IMB_TBE_ID')
        ->get();

        return response()->json($item,200);

    }

    public function cargaItensPerm( $id )
    {
        $item = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=',$id )
        ->leftJoin('IMB_TABELAEVENTOS',
                        'IMB_TABELAEVENTOS.IMB_TBE_ID',
                        'IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID')
        ->get();

        return response()->json($item,200);

    }

    public function cargaItensSemJson( $id )
    {
        $item = mdlCobrancaGeradaItem::where( 'IMB_CGR_ID','=',$id )
        ->leftJoin('IMB_TABELAEVENTOS',
                        'IMB_TABELAEVENTOS.IMB_TBE_ID',
                        'IMB_COBRANCAGERADAITEM.IMB_TBE_ID')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_COBRANCAGERADAITEM.IMB_TBE_ID')
        ->get();

        return $item;

    }


    public function cargaItensPermanenteSemJson( $id )
    {
        $item = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=',$id )
        ->leftJoin('IMB_TABELAEVENTOS',
                        'IMB_TABELAEVENTOS.IMB_TBE_ID',
                        'IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID');
        $item = $item->get();



        return $item;

    }


    public function cargaBoletoHeader( $id )
    {
        $hd = mdlCobrancaGerada::where( 'IMB_CGR_ID','=',$id )
        ->first();

        return response()->json($hd,200);

    }


    public function cargaBoletoHeaderPerm( $id )
    {
        $hd = mdlCobrancaGeradaPerm::where( 'IMB_CGR_ID','=',$id )
        ->first();

        return response()->json($hd,200);

    }

    public function bloquearBoleto( $id, $sn )
    {
        $hd = mdlCobrancaGerada::find( $id );
        $hd->IMB_CGR_SELECIONADA=$sn;
        if( $sn == 'S') $hd->IMB_CGR_INCONSISTENCIA='';
        $hd->save();

        return response()->json($hd,200);

    }

    public function pdfCobrancaGerada()
    {
        $request = new \Illuminate\Http\Request();

        $request->replace(['ordem' => 'IMB_CTR_REFERENCIA',]);


        $cob = $this->carga( $request );
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );

        return view('cobrancabancaria.reports.pdfcobrancagerada', compact( 'cob', 'imb' ) );
//        $pdf=PDF::loadView('cobrancabancaria.reports.pdfcobrancagerada', compact( 'cob', 'imb' ) );
        //$pdf->setPaper('A4', 'portrait');
        //return $pdf->stream('cobrancagerada.pdf');
    }

    public function gerarPermanente( Request $request )
    {

        $idgerada = $request->IMB_CGR_ID;


        $cgs = mdlCobrancaGerada::where( 'IMB_CGR_SELECIONADA','=',"S")
            ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID);




        if( $idgerada )
           $cgs = $cgs->where('IMB_CGR_ID','=', $idgerada );

        $cgs = $cgs->get();

           //dd( $cg->toSql());

        foreach( $cgs as $cg )
        {
            $conta = mdlContaCaixa::where( 'FIN_CCX_ID','=', $cg->FIN_CCR_ID)->first();

            app('App\Http\Controllers\ctrRotinas')->
            gravarObs( $cg->IMB_IMV_ID, $cg->IMB_CTR_ID,
                    0, 0, 0, 'Geração do boleto com vencimento em '.
                    date('d/m/Y',$cg->IMB_CGR_DATAVENCIMENTO));

            if( $conta->FIN_CCI_BANCONUMERO == 748 )
            {
                $cp = app('App\Http\Controllers\ctrBoleto748')
                ->abastecerPermanente( $cg,'x' );

            }
            if( $conta->FIN_CCI_BANCONUMERO == 33 )
            {
                $cp = app('App\Http\Controllers\ctrBoletoSantander')
                ->abastecerPermanente( $cg,'x' );

            }

        }
        //dd( $cp->IMB_CGR_ID);
        if( $idgerada )
            return response()->json($cp->IMB_CGR_ID,200);
        else
            return response()->json($cg,200);


    }

    public function gerarRemessa( Request $request )
    {

        $idgerada = $request->IMB_CGR_ID;
        $permanenteToTemp = $request->PERMANENTETOTEMP;

        if ( $permanenteToTemp == 'S')
        {
            $cg = mdlCobrancaGerada::
            where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
            ->delete();
            $cgi = mdlCobrancaGeradaItem::
            where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
            ->delete();

            $this->permanenteToTemporaria();

        }
        $cg = mdlCobrancaGerada::where( 'IMB_CGR_SELECIONADA','=',"S")
            ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();



        if( $cg )
        {
            $conta = mdlContaCaixa::where( 'FIN_CCX_ID','=', $cg->FIN_CCR_ID)->first();



            if( $conta->FIN_CCI_BANCONUMERO == 1 )
            {
                $url = app('App\Http\Controllers\ctrBoleto001')
                    ->gerarRemessa();

            }


            if( $conta->FIN_CCI_BANCONUMERO == 33 )
            {
                if( $conta->FIN_CCO_COBRANCALAYOUT == 'CNAB400')
                $url = app('App\Http\Controllers\ctrBoleto033')
                    ->cnab400();
                else
                    $url = app('App\Http\Controllers\ctrBoleto033')
                        ->cnab240H7815();

            }

            if( $conta->FIN_CCI_BANCONUMERO == 341 )
            {
                if( $conta->FIN_CCX_ARQCOBRANCANOVOPADRAO =='S' )
                    $url = app('App\Http\Controllers\ctrBoletoItau')
                        ->gerarRemessaNovoPadrao();
                else
                    $url = app('App\Http\Controllers\ctrBoletoItau')
                        ->gerarRemessa();

            }

            if( $conta->FIN_CCI_BANCONUMERO == 756 )
            {
                if( $conta->FIN_CCI_COOPNUMERO <> '' and $conta->FIN_CCI_COOPNUMERO <> '0' )
                    $url = app('App\Http\Controllers\ctrBoleto756')
                    ->gerarRemessaComNumPosto();
                else
                $url = app('App\Http\Controllers\ctrBoleto756')
                    ->gerarRemessa();

            }

            if( $conta->FIN_CCI_BANCONUMERO == 748 )
            {
                $url = app('App\Http\Controllers\ctrBoleto748')
                    ->gerarRemessa();

            }
            if( $conta->FIN_CCI_BANCONUMERO == 237 )
            {
                $url = app('App\Http\Controllers\ctrBoleto237')
                    ->gerarRemessa();

            }

            if( $conta->FIN_CCI_BANCONUMERO == 84 )
            {
                $url = app('App\Http\Controllers\ctrBoleto084')
                    ->gerarRemessa();

            }

            if( $conta->FIN_CCI_BANCONUMERO == 77)
            {
                $url = app('App\Http\Controllers\ctrBoleto077')
                    ->gerarRemessa();

            }

            return response()->json( $url, 200 );
        }


    }

    public function existeBoleto( $datavencimento, $idcontrato  )
    {
        $tem = 'N';
        $ctr = mdlContrato::find( $idcontrato );
        //Log::info('Vencimento: '.$datavencimento);
        //Log::info('IMB_CTR_VENCIMENTOLOCATARIO '.$ctr->IMB_CTR_VENCIMENTOLOCATARIO);
        if( strtotime($ctr->IMB_CTR_VENCIMENTOLOCATARIO) > $datavencimento ) $tem = 'S';

        $data = date( 'Y-m-d', $datavencimento);
        $gerar='N';
        $cp = mdlCobrancaGeradaPerm::where( 'IMB_CGR_VENCIMENTOORIGINAL','=', $data )
        ->where( 'IMB_CTR_ID','=', $idcontrato )
        ->whereNull( "IMB_CGR_DTHINATIVO")  //is null or COALESCE(IMB_CGR_ENTRADACONFIRMADA,'') ='N'")
        ->first();

        if( $cp <> null ) return $tem='S';


        return $tem;


    }

    public function selecionarCobrancaPerm( $id )
    {
        $ci = mdlCobrancaGeradaPermSel::
        where( 'IMB_CGR_ID','=', $id )
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->get();

        $selecionada='';
        if( $ci == '[]' )
        {
            $ci = new mdlCobrancaGeradaPermSel;
            $ci->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $ci->IMB_CGR_ID = $id;
            $ci->save();
            $selecionada='Selecionada';
        }
        else
        {
            $ci = mdlCobrancaGeradaPermSel::where( 'IMB_CGR_ID','=',$id )->delete();
        }

        return response()->json('ok',200);

    }




    public function gerarItensAvulsos( Request $request  )
    {
        $datavencimento = $request->datavencimento;
        $idcontrato = $request->idcontrato;
        $selecao = $request->selecao;
        $contacobranca = $request->contacobranca;

        $objbases = new \stdClass();

        $vencimento = $datavencimento;

        $ctr = mdlContrato::find( $idcontrato );

        $locatario = app('App\Http\Controllers\ctrRotinas')
                    ->nomeLocatarioPrincipal( $idcontrato );

        $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                    ->imovelEndereco( $ctr->IMB_IMV_ID );


        $endereco = app('App\Http\Controllers\ctrRotinas')
                    ->pegarEnderecoCobranca( $idcontrato );

        $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                    ->codigoLocatarioPrincipal( $idcontrato );

        $locatario =  app('App\Http\Controllers\ctrRotinas')
        ->clienteDadosFull( $idlocatario );

        $descontoacordo = app('App\Http\Controllers\ctrRotinas')
        ->verificarEventoLancado( $idcontrato, $vencimento, 8 );

        $tarifaBoleto = app('App\Http\Controllers\ctrRotinas')
        ->tarifaBoleto( $idcontrato, $vencimento );

        $datalimite = app('App\Http\Controllers\ctrRotinas')
        ->dataLimite( $idcontrato, $vencimento );

        $pontualidade = app('App\Http\Controllers\ctrRotinas')
                        ->valorDescontoPontualidade( $idcontrato, $vencimento, $vencimento, $descontoacordo, 'LT' );


        if( $locatario )
        {

            $bairro=$endereco->IMB_CCB_BAIRRO;
            $bairro=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($bairro);

            $hd = new mdlCobrancaGerada;
            $hd->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $hd->IMB_CGR_DESTINATARIO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_DESTINATARIO);
            $hd->IMB_CGR_ENDERECO =
                                app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_ENDERECO).' '.
                                app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_ENDERECONUMERO).' '.
                                app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_ENDERECOCOMPLEMENTO);
            $hd->IMV_CGR_CEP = $endereco->IMB_CCB_CEP;
            $hd->IMB_CEP_BAI_NOME = substr($bairro,0,20);
            $hd->IMB_CEP_CID_NOME = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais(substr($endereco->CEP_CID_NOME,0,20));
            $hd->IMB_CGR_DATAVENCIMENTO = $vencimento;
            $hd->IMB_CGR_VENCIMENTOORIGINAL = $vencimento;
            $hd->CEP_UF_SIGLA = $endereco->CEP_UF_SIGLA;
            $hd->IMB_CGR_CPF = $locatario->IMB_CLT_CPF;
            $hd->IMB_CGR_PESSOA = $locatario->IMB_CLT_PESSOA;
            $hd->IMB_CTR_ID = $idcontrato;
            $hd->IMB_CGR_IMOVEL = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imovelendereco);
            $hd->IMB_CGR_DATALIMITE = $datalimite;
            $hd->IMB_CLT_EMAIL = $locatario->IMB_CLT_EMAIL;
            $hd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $hd->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $hd->IMB_CGR_VALORPONTUALIDADE = $pontualidade;
            $hd->IMB_CGR_TARIFABOLETO = $tarifaBoleto;
            $hd->IMB_CTR_REFERENCIA = $ctr->IMB_CTR_REFERENCIA;
            $hd->IMB_CGR_INCONSISTENCIA         = '';
            $hd->IMB_CGR_SELECIONADA         = 'S';
            $hd->FIN_CCR_ID     = $contacobranca;
            $hd->save();



            $objbases->baseirrf      = 0;
            $objbases->basemulta     = 0;
            $objbases->basejuros     = 0;
            $objbases->basecorrecao  = 0;

            $itemaluguel = 0;

            foreach ( $selecao as $sel )
            {

                $lf = mdlLancamentoFuturo::find( $sel );

                $valorlcf = $lf->IMB_LCF_VALOR;

                if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C' )
                $valorlcf = $valorlcf * -1;

                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideMulta( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                $objbases->basemulta = $objbases->basemulta + $valorlcf;


                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideJuros( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                $objbases->basejuros = $objbases->basejuros + $valorlcf;


                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideCorrecao( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                $objbases->basecorrecao = $objbases->basecorrecao + $valorlcf;

                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideIRRF( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                $objbases->baseirrf = $objbases->baseirrf + $valorlcf;

                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_LCF_ID                   = $lf->IMB_LCF_ID;
                $item->IMB_TBE_ID                   = $lf->IMB_TBE_ID;
                $item->IMB_TBE_DESCRICAO            = $lf->IMB_TBE_NOME;
                $item->IMB_RLT_LOCATARIOCREDEB      = $lf->IMB_LCF_LOCATARIOCREDEB;
                $item->IMB_RLT_LOCADORCREDEB        = $lf->IMB_LCF_LOCADORCREDEB;
                $item->IMB_LCF_VALOR                = $lf->IMB_LCF_VALOR;
                $item->IMB_LCF_OBSERVACAO           = $lf->IMB_LCF_OBSERVACAO;
                $item->IMB_LCF_DATAVENCIMENTO       = $lf->IMB_LCF_DATAVENCIMENTO;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                $item->save();
            }

            $multa =  app('App\Http\Controllers\ctrRotinas')
                    ->calcularMulta( $idcontrato, $vencimento, '2100/12/30', $objbases->basejuros);

            if( $multa->repassarvalor <> 0 )
            {

                if( $multa->repassardias <> 0 )
                    $hd->IMB_CGR_MULTA1DESCRICAO = 'Até '.$multa->repassardias.' dias de vencido, cobrar multa de '.
                                                'R$ '.$multa->repassarvalor;
                else
                    $hd->IMB_CGR_MULTA1DESCRICAO = 'Após '.$datalimite.' Cobrar multa de '.
                            'R$ '.$multa->repassarvalor;
            }
            if( $multa->reterdias <> 0 )
            {
                $hd->IMB_CGR_MULTA2 = $multa->retervalor;
                $hd->IMB_CGR_MULTA2DESCRICAO = 'Após, cobrar multa de R$ '.$multa->retervalor;

            }
            $hd->save();

            $irrf=$valorirrf = app('App\Http\Controllers\ctrTabelaIRRF')
            ->calcularIRRF( $idcontrato, $objbases->baseirrf );

            foreach ($irrf as $irrfcal)
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_LCF_ID                   = 0;
                $item->IMB_TBE_ID                   = 18;
                $item->IMB_TBE_DESCRICAO            = 'I.R.R.F.';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'C';
                $item->IMB_RLT_LOCADORCREDEB        = 'D';
                $item->IMB_LCF_VALOR                = $irrfcal['valorIRRF'];
                $item->IMB_LCF_OBSERVACAO           = 'Retenção IRRF de '.
                                                    $irrfcal['cliente'].' - CPF: '.
                                                    $irrfcal['cpf'];
                $item->IMB_LCF_DATAVENCIMENTO       = $vencimento;
                $item->IMB_CLT_ID                   = $irrfcal['IMB_CLT_ID'];
                $item->IMB_ATD_ID                   = Auth::user()->IMB_ATD_ID;
                $item->save();
            }

            if( $itemaluguel == 0 )
            {
                $hd->IMB_CGR_SELECIONADA ='N';

                if( $hd->IMB_CGR_DATAVENCIMENTO > $ctr->IMB_CTR_DATAREAJUSTE )
                    $hd->IMB_CGR_INCONSISTENCIA = 'Reajustar';
                else
                if( $hd->IMB_CGR_DATAVENCIMENTO > $ctr->IMB_CTR_TERMINO )
                    $hd->IMB_CGR_INCONSISTENCIA = 'Renovar Contrato';
                else
                    $hd->IMB_CGR_INCONSISTENCIA = 'Sem parcela de aluguel lançada!';
            }
            //Calculando o total em itens do boleto
            $hd->IMB_CGR_VALOR = $this->calcularTotalBoleto( $hd->IMB_CGR_ID );
            $hd->save();
        }
        return response()->json('ok',200);

    }

    public function inativarBoleto( $id )
    {

        $cgp = mdlCobrancaGeradaPerm::find( $id );
        $cgp->IMB_CGR_DTHINATIVO = date('Y-m-d');
        $cgp->IMB_ATD_IDINATIVO = Auth::user()->IMB_ATD_ID;
        $cgp->save();

        return response()->json('OK',200);

    }


    public function permanenteToTemporaria()
    {
        $css = mdlCobrancaGeradaPermSel::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->get();

        foreach( $css as $cs )
        {
            $cgp =mdlCobrancaGeradaPerm::find($cs->IMB_CGR_ID);
            if( $cgp <> '')
            {

                $bairro=$cgp->IMB_CEP_BAI_NOME;
                $bairro=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($bairro);

                $hd = new mdlCobrancaGerada;
                $hd->IMB_IMV_ID = $cgp->IMB_IMV_ID;
                $hd->IMB_CGR_DESTINATARIO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CGR_DESTINATARIO);
                $hd->IMB_CGR_ENDERECO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CGR_ENDERECO);
                $hd->IMV_CGR_CEP = $cgp->IMV_CGR_CEP;
                $hd->IMB_CEP_BAI_NOME = $bairro;
                $hd->IMB_CEP_CID_NOME = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CEP_CID_NOME);
                $hd->IMB_CGR_DATAVENCIMENTO = $cgp->IMB_CGR_DATAVENCIMENTO ;
                $hd->IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTOORIGINAL;
                $hd->IMB_CGR_NOSSONUMERO = $cgp->IMB_CGR_NOSSONUMERO;
                $hd->IMB_CGR_VALOR = $cgp->IMB_CGR_VALOR;
                $hd->CEP_UF_SIGLA = $cgp->CEP_UF_SIGLA;
                $hd->IMB_CGR_CPF = $cgp->IMB_CGR_CPF;
                $hd->IMB_CGR_PESSOA = $cgp->IMB_CGR_PESSOA;
                $hd->IMB_CTR_ID = $cgp->IMB_CTR_ID;
                $hd->IMB_CGR_IMOVEL = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CGR_IMOVEL);
                $hd->IMB_CGR_DATALIMITE = $cgp->IMB_CGR_DATALIMITE;
                $hd->IMB_CLT_EMAIL = $cgp->IMB_CLT_EMAIL;
                $hd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $hd->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $hd->IMB_CGR_VALORPONTUALIDADE = $cgp->IMB_CGR_VALORPONTUALIDADE ;
                $hd->IMB_CGR_TARIFABOLETO = $cgp->IMB_CGR_TARIFABOLETO;
                $hd->IMB_CTR_REFERENCIA = $cgp->IMB_CTR_REFERENCIA;
                $hd->IMB_CGR_INCONSISTENCIA         = $cgp->IMB_CGR_INCONSISTENCIA;
                $hd->IMB_CGR_SELECIONADA         = 'S';
                $hd->FIN_CCR_ID     = $cgp->FIN_CCR_ID;
                $hd->imb_cgr_idpermanente = $cs->IMB_CGR_ID;
                $hd->save();

                $cgis = mdlCobrancaGeradaItemPerm::
                where( 'IMB_CGR_ID','=',$cgp->IMB_CGR_ID)->get();

                foreach( $cgis as $cgi )
                {
                    $item                               = new mdlCobrancaGeradaItem;
                    $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                    $item->IMB_LCF_ID                   = $cgi->IMB_LCF_ID;
                    $item->IMB_TBE_ID                   = $cgi->IMB_TBE_ID;
                    $item->IMB_TBE_DESCRICAO            = $cgi->IMB_TBE_NOME;
                    $item->IMB_RLT_LOCATARIOCREDEB      = $cgi->IMB_LCF_LOCATARIOCREDEB;
                    $item->IMB_RLT_LOCADORCREDEB        = $cgi->IMB_LCF_LOCADORCREDEB;
                    $item->IMB_LCF_VALOR                = $cgi->IMB_LCF_VALOR;
                    $item->IMB_LCF_OBSERVACAO           = $cgi->IMB_LCF_OBSERVACAO;
                    $item->IMB_LCF_DATAVENCIMENTO       = $cgi->IMB_LCF_DATAVENCIMENTO;
                    $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $item->save();
                };


                $cs->delete();
            }
        }

        return 'ok';

    }

    public function lerRetorno( Request $request )
    {
        return view( 'cobrancabancaria.lerretornoindex');
    }

    public function lerRetornoPasso2( Request $request )
    {
        $dadosconta = app('App\Http\Controllers\ctrContaCaixa')
        ->find( $request->conta );



        if( $dadosconta )
        {

            if( $dadosconta->FIN_CCI_BANCONUMERO == 748 )
                $dados = app('App\Http\Controllers\ctrBoleto748')
                ->lerRetorno( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
            else
            if( $dadosconta->FIN_CCI_BANCONUMERO == 756 )
            {
                if( $dadosconta->FIN_CCO_COBRANCALAYOUT == 'CNAB240')
                    $dados = app('App\Http\Controllers\ctrBoleto756')
                    ->lerRetorno240( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
                else
                    $dados = app('App\Http\Controllers\ctrBoleto756')
                    ->lerRetorno400( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
            }
            if( $dadosconta->FIN_CCI_BANCONUMERO == 237 )
            {
                $dados = app('App\Http\Controllers\ctrBoleto237')
                ->lerRetorno400( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
            }
            if( $dadosconta->FIN_CCI_BANCONUMERO == 341 )
            {
                $dados = app('App\Http\Controllers\ctrBoletoItau')
                ->lerRetorno400( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
            }
            
            if( $dadosconta->FIN_CCI_BANCONUMERO == 77 )
            {
                Log::info( 'vou acessar o 77');
                $dados = app('App\Http\Controllers\ctrBoleto077')
                ->lerRetorno400( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );

            }   if( $dadosconta->FIN_CCI_BANCONUMERO == 84 )
            {
                $dados = app('App\Http\Controllers\ctrBoleto084')
                ->lerRetorno400( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
            }
            if( $dadosconta->FIN_CCI_BANCONUMERO == 33 )
            {
                if( $dadosconta->FIN_CCO_COBRANCALAYOUT =='CNAB400')
                    $dados = app('App\Http\Controllers\ctrBoleto033')
                        ->lerRetorno400( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
                else
                    $dados = app('App\Http\Controllers\ctrBoleto033')
                    ->lerRetorno240( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );


            }
//            dd( $dadosconta->FIN_CCI_BANCONUMERO);
            if( $dadosconta->FIN_CCI_BANCONUMERO == 1 )
            {
                $dados = app('App\Http\Controllers\ctrBoleto001')
                ->lerRetorno240( $request->conta, $request->arquivo, $request->ocor, $request->nomeoriginal );
            }

            $retornos = mdlRetornoBancario::
            where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
            ->orderBy( 'imb_ctr_referencia');

            if( $request->ocor <> '' )
                $retornos = $retornos->where("codigoocorrencia",'=', $request->ocor );

            $retornos = $retornos->get();

        return view( 'cobrancabancaria.resultadoleitura');
            //return response()->json($retornos,200);

        }

        return response()->json;
    }

    public function outroControllerTeste( $idcontrato  )
    {
        //$r = app('App\Http\Controllers\ctrLancamentoFuturo')->teste( $id );
        //dd( "r ".$r);

        $diainicial = 1;
        $diafinal = 15;
        $mesinicial = 1;
        $mesfinal = 12;
        $anoinicial =2021;
        $anofinal = 2021;

        $idcontrato = 23990;
        $ctr = mdlContrato::find( $idcontrato );
        $diavencimentoctr = $ctr->IMB_CTR_DIAVENCIMENTO;


        $begin = new DateTime( $anoinicial.'-'.$mesinicial."-".$diainicial );
        $end = new DateTime( $anofinal.'-'.$mesfinal."-".$diafinal );

        $intervalo = $begin->diff( $end );

        $meses = $intervalo->m;
        if( $meses == 0 ) $meses = 1;

        $mes = $mesinicial;
        $ano = $anoinicial;
        $dia = $diainicial;
        $dataapp = mktime( 0, 0, 0, $mes,$dia, $ano);
        $datavencimento = $dataapp;
        for($i = 1; $i <= $meses; $i++)
        {


            $mes++;
            if( $mes > 12 )
            {
                $mes = 1;
                $ano++;
            }


            $diactr = $diavencimentoctr;

            $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));

            if( $diavencimentoctr > $ultimo_dia)
                $diactr = $ultimo_dia;

            $datavencimento = mktime( 0, 0, 0, $mes,$diactr, $ano);


        }


    }

    public function baixaAutomatica( Request $request )
    {


        
        $ret = mdlRetornoBancario::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->where('selecionado','=', 'S' )
        ->orderBy( 'nossonumero')
        ->get();


        foreach( $ret as $registro)
        {
            $cgr = mdlCobrancaGeradaPerm::find( $registro->id );



            if( $cgr and $cgr->IMB_CGR_DATABAIXA == '')
            {


                if( $registro->codigoocorrencia =='06' )
                {
                    $this->baixaBancaria( $registro->id,
                                    $registro->datapagamento,
                                    $registro->IMB_CGR_VENCIMENTOORIGINAL,
                                    $registro->datacredito,
                                    $cgr->FIN_CCR_ID,
                                    $registro->valorpago
                                    );

                }
            }
        }


        return response()->json('Feito',200);




    }

    public function baixaBancaria( $id,
                                    $datapagamento,
                                    $datavencimento,
                                    $datacredito,
                                    $FIN_CCR_ID,
                                    $valorpago )
    {


        $cgr = mdlCobrancaGeradaPerm::find( $id );
        $cgi = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=', $id )->get();


        $ctr = mdlContrato::find( $cgr->IMB_CTR_ID );

        //CALCULARRECEBIMENTO
        $calc = app('App\Http\Controllers\ctrRecebimento')
        ->calcularRecebimento( $ctr->IMB_CTR_ID,
                            $datavencimento,
                            $datapagamento,
                            'N',
                            'N',
                            'N',
                        'boleto');

        $totalCalculado = 0;


        //Log::info( 'ctrCobrancaGerada');
        foreach( $calc as $c )
        {

            if( $c->IMB_LCF_LOCATARIOCREDEB == 'D')
                $totalCalculado = $totalCalculado + $c->IMB_LCF_VALOR ;
            else
            if( $c->IMB_LCF_LOCATARIOCREDEB == 'C')
                $totalCalculado = $totalCalculado - $c->IMB_LCF_VALOR ;
            //Log::info( 'TBE_ID: '.$c->IMB_TBE_ID.' - VALOR: '.$c->IMB_LCF_VALOR );
                
            }
        Log::info('total calculado  '.$totalCalculado );



        $totalitensboleto = 0;
        foreach( $cgi as $item )
        {
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'D')
                $totalitensboleto = $totalitensboleto + $item->IMB_LCF_VALOR ;
            else
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'C')
                $totalitensboleto = $totalitensboleto - $item->IMB_LCF_VALOR ;



        }
        Log::info('total itens boleto  '.$totalitensboleto );
        Log::info( 'strtotime($cgr->IMB_CGR_DATALIMITE): '.strtotime($cgr->IMB_CGR_DATALIMITE));
        Log::info( 'strtotime(datapagamento): '.strtotime($datapagamento));
        
        if( strtotime($cgr->IMB_CGR_DATALIMITE) >= strtotime($datapagamento) )
        {
            $totalitensboleto = $totalitensboleto - $cgr->IMB_CGR_VALORPONTUALIDADE;
            //////Log::info( 'Tirou '.$cgr->IMB_CGR_VALORPONTUALIDADE );
            //////Log::info( 'ficou '.$totalitensboleto );
        }

        $diferenca =  round( floatval($totalitensboleto),2) - round(floatval($totalCalculado),2);
        
            $proximorecibo = $this->proximoRecibo();
            //Fazer as baixas dos ítens
            $itemaluguel = 0;
            
            foreach( $calc as $item )
            {

                //Log::info( 'for pra gravar o recibo: '.$item->IMB_TBE_ID);
                $idcontrato =$ctr->IMB_CTR_ID;

                $idlcf = $item->IMB_LCF_ID;
                $idtbe = $item->IMB_TBE_ID;

                $idlocador = $item->IMB_CLT_IDLOCADOR;
                Log::info('LT: '.$item->IMB_LCF_LOCATARIOCREDEB);
                Log::info('LD: '.$item->IMB_LCF_LOCADOR );

                $idlocatario = collect( DB::select("select PEGACODIGOLOCATARIOCONTRATO('$idcontrato') as id "))->first()->id;
                $idimv      = $ctr->IMB_IMV_ID;
                $idimb2     = $ctr->IMB_IMB_ID2;
                $idcfc      ='';


                if( $idlcf <> 0 and $idlcf<>'')
                {
                    $lf         = mdlLancamentoFuturo::find( $idlcf );
                    $idcfc      = $lf->FIN_CFC_ID;
                }

                $eve        = mdlTabelaEvento::where('IMB_TBE_ID','=', $idtbe )->first();

                if( $eve == '' ) //Log::info('Evendo não encontrado');

                if( $idcfc == '' )
                    $idcfc = $eve->FIN_CFC_ID;


                if( $item->IMB_TBE_ID == 1 or $item->IMB_TBE_ID == 24 )
                    $itemaluguel = 1;

                $recibo = new mdlReciboLocatario;
                $recibo->IMB_RLT_NUMERO         = $proximorecibo;
                $recibo->IMB_RLT_DATAPAGAMENTO  = $datapagamento;
                $recibo->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                $recibo->IMB_RLT_DATACOMPETENCIA= $datavencimento;
                $recibo->IMB_RLT_LOCATARIOCREDEB= $item->IMB_LCF_LOCATARIOCREDEB;
                $recibo->IMB_RLT_LOCADORCREDEB  = $item->IMB_LCF_LOCADORCREDEB;
                $recibo->IMB_RLT_VALOR          = $item->IMB_LCF_VALOR;
                $recibo->IMB_RLT_OBSERVACAO     = $item->IMB_LCF_OBSERVACAO;
                $recibo->IMB_RLT_TIPORECEBIMENTO= 'B';
                $recibo->IMB_LCF_ID             = $item->IMB_LCF_ID;
                $recibo->IMB_RLT_DATACAIXA      = $item->$datacredito;
                $recibo->IMB_RLT_FORMARECEBIMENTO  = 'BANCO';
                $recibo->IMB_RLT_DATACONTABIL   = $datacredito;
                $recibo->IMB_CTR_ID             = $idcontrato;
                $recibo->IMB_IMV_ID             = $idimv;
                $recibo->IMB_TBE_ID             = $item->IMB_TBE_ID;
                $recibo->FIN_CFC_ID             = $idcfc;
                $recibo->FIN_CCR_ID             = $FIN_CCR_ID;
                $recibo->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                $recibo->IMB_RLT_DTHEMISSAO     = date('Y/m/d');
                $recibo->IMB_IMB_ID2            = $idimb2;
                $recibo->IMB_FORPAG_ID          = 1;
                $recibo->IMB_RLT_TOTALRECIBO    = $valorpago;
                $recibo->IMB_RLT_DATALIMITE     = $datavencimento;
                $recibo->FIN_LCX_DINHEIRO       = $valorpago;
                $recibo->FIN_LCX_CHEQUE         = 0;
                $recibo->FIN_CFC_ID             = $idcfc;
                $recibo->IMB_CLT_ID_LOCATARIO   = $idlocatario;
                $recibo->IMB_CLT_ID_LOCADOR     = $idlocador;
                $recibo->FIN_PCT_NOSSONUMERO     = $cgr->IMB_CGR_NOSSONUMERO;
                $recibo->save();
                if( $item->IMB_LCF_ID == 0 )
                {
                    $eve = mdlTabelaEvento::where( 'IMB_TBE_ID','=',  $item->IMB_TBE_ID )->first();
                    $lf = new mdlLancamentoFuturo();
                    $lf->IMB_IMB_ID              = Auth::user()->IMB_IMB_ID;
                    $lf->IMB_CTR_ID              = $idcontrato;
                    $lf->IMB_LCF_VALOR           = $item->IMB_LCF_VALOR;
                    $lf->IMB_LCF_LOCADORCREDEB   = $item->IMB_LCF_LOCADORCREDEB;
                    $lf->IMB_LCF_LOCATARIOCREDEB = $item->IMB_LCF_LOCATARIOCREDEB;
                    $lf->IMB_LCF_DATAVENCIMENTO  = $datavencimento;
                    $lf->IMB_IMV_ID              = $idimv;
                    $lf->IMB_CLT_IDLOCADOR       = 0;
                    $lf->IMB_TBE_ID              = $item->IMB_TBE_ID;
                    $lf->IMB_ATD_ID              = Auth::user()->IMB_IMB_ID;
                    $lf->IMB_LCF_INCMUL          = $eve->IMB_TBE_MULTA;
                    $lf->IMB_LCF_INCIRRF         = $eve->IMB_TBE_IRRF;
                    $lf->IMB_LCF_INCTAX          = $eve->IMB_TBE_TAXAADM;
                    $lf->IMB_LCF_INCJUROS        = $eve->IMB_TBE_JUROS;
                    $lf->IMB_LCF_INCCORRECAO     = $eve->IMB_TBE_CORRECAO;
                    $lf->IMB_LCF_GARANTIDO       = 'N';
                    $lf->IMB_LCF_INCISS          = $eve->IMB_TBE_INCISS;
                    $lf->IMB_LCF_OBSERVACAO      = $item->IMB_RLT_OBSERVACAO;
                    $lf->IMB_LCF_NUMEROCONTROLE  = '0';
                    $lf->IMB_LCF_NUMPARREAJUSTE  = '0';
                    $lf->IMB_LCF_NUMPARCONTRATO  = '0';
                    $lf->IMB_LCF_CHAVE           = '0';
                    $lf->IMB_LCF_TIPO            = 'A';
                    $lf->IMB_LCF_DATARECEBIMENTO = $datapagamento;
                    $lf->IMB_RLT_NUMERO          = $proximorecibo;
                    $lf->IMB_LCF_DATALANCAMENTO  = date('Y/m/d');
                    $lf->IMB_LCF_ORIGEM          = 'BOLETO';
                    $lf->save();
                };
            }

            if( $cgr )
            {
                $cgr->IMB_RLT_NUMERO = $recibo->IMB_RLT_NUMERO;
                $cgr->IMB_CGR_DATABAIXA = $datapagamento;
                $cgr->IMB_CGR_MOTIVOBAIXA = 'PAGTO. BOLETO';
                $cgr->IMB_CGR_VALORPAGO = $valorpago;
                $cgr->save();

                if( $itemaluguel == 1 )
                {
                    $proximovencimento =  app('App\Http\Controllers\ctrRotinas')
                        ->addMeses( $ctr->IMB_CTR_DIAVENCIMENTO,  1,$datavencimento );
                    $ctr->IMB_CTR_VENCIMENTOLOCATARIO = $proximovencimento;
                    $ctr->save();
                }
            }

            return $recibo->IMB_RLT_NUMERO;
        

    }



    public function proximoRecibo()
    {

        $rec = mdlReciboLocatarioControle::first();
        if( $rec == '')

        {
            $rec = new mdlReciboLocatarioControle;
            $rec->IMB_PRM_RECIBOLOCATARIO = '1000000';

        }
        $rec->IMB_PRM_RECIBOLOCATARIO = $rec->IMB_PRM_RECIBOLOCATARIO + 1;
        $rec->save();

        return $rec->IMB_PRM_RECIBOLOCATARIO;
    }

    public function cargaTmpRetorno( Request $request )
    {
        $somentebaixados = $request->somentebaixados;

        $retornos = mdlRetornoBancario::
        where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID );

        if( $somentebaixados == 'S' )
            $retornos->where('selecionado','=', 'S');

        $retornos ->orderBy( 'imb_ctr_referencia')->get();

        return DataTables::of($retornos)->make(true);

    }
    public function cargaTmpRetornoRelatorio( Request $request )
    {
        $somentebaixados = $request->somentebaixados;
        $codigoocorrencia = $request->codigoocorrencia;

        $retornos = mdlRetornoBancario::
        where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID );

        if( $somentebaixados == 'S' )
            $retornos->where('selecionado','=', 'S');

        if( $codigoocorrencia <> '' )
            $retornos->where('codigoocorrencia','=', $codigoocorrencia);

        $retornos = $retornos->orderBy( 'imb_ctr_referencia')->get();

        return $retornos;

    }


    public function selecionarTMPRetorno($id )
    {
        $par = mdlRetornoBancario::find( $id );

        if( $par->selecionado == 'S' )
            $par->selecionado = 'N';
        else
            $par->selecionado = 'S';
        $par->save();
        return response()->json( 'OK', 200);

    }

    public function selecionarTodos()
    {
        DB::statement("update TMP_RETORNOBANCARIO set  selecionado = 'S' where IMB_ATD_ID = ".Auth::user()->IMB_ATD_ID );

        return response()->json( 'OK', 200);

    }

    public function tirarSelecoes()
    {
        DB::statement("update TMP_RETORNOBANCARIO set selecionado = 'N' where IMB_ATD_ID = ".Auth::user()->IMB_ATD_ID );

        return response()->json( 'OK', 200);

    }


    public function basesItemCobranca( $id)
    {
        $cgi = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=', $id )->get();
        $objbases = new \stdClass();
        $objbases->baseirrf      = 0;
        $objbases->basemulta     = 0;
        $objbases->basejuros     = 0;
        $objbases->basecorrecao  = 0;
        foreach( $cgi as $item )
        {
            $valorlcf = $item->IMB_LCF_VALOR;
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'C' )
               $valorlcf = $valorlcf * -1;



            if( app('App\Http\Controllers\ctrLancamentoFuturo')
               ->incideMulta( $item->IMB_TBE_ID, $item->IMB_LCF_ID) =='S' )
               $objbases->basemulta = $objbases->basemulta + $valorlcf;


            if( app('App\Http\Controllers\ctrLancamentoFuturo')
               ->incideJuros( $item->IMB_TBE_ID, $item->IMB_LCF_ID ) =='S' )
               $objbases->basejuros = $objbases->basejuros + $valorlcf;


            if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideCorrecao( $item->IMB_TBE_ID, $item->IMB_LCF_ID ) =='S' )
               $objbases->basecorrecao = $objbases->basecorrecao + $valorlcf;

        }

        return response()->json( $objbases ,200);

    }

    public function basesItemCobrancaTMP( $id)
    {
        $cgi = mdlCobrancaGeradaItem::where( 'IMB_CGR_ID','=', $id )->get();
        $objbases = new \stdClass();
        $objbases->baseirrf      = 0;
        $objbases->basemulta     = 0;
        $objbases->basejuros     = 0;
        $objbases->basecorrecao  = 0;
        foreach( $cgi as $item )
        {
            $valorlcf = $item->IMB_LCF_VALOR;
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'C' )
               $valorlcf = $valorlcf * -1;



            if( app('App\Http\Controllers\ctrLancamentoFuturo')
               ->incideMulta( $item->IMB_TBE_ID, $item->IMB_LCF_ID) =='S' )
               $objbases->basemulta = $objbases->basemulta + $valorlcf;


            if( app('App\Http\Controllers\ctrLancamentoFuturo')
               ->incideJuros( $item->IMB_TBE_ID, $item->IMB_LCF_ID ) =='S' )
               $objbases->basejuros = $objbases->basejuros + $valorlcf;


            if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideCorrecao( $item->IMB_TBE_ID, $item->IMB_LCF_ID ) =='S' )
               $objbases->basecorrecao = $objbases->basecorrecao + $valorlcf;

        }

        return response()->json( $objbases ,200);

    }

    public function calcularMultaBoleto( $idcontrato, $vencimento, $datapagamento, $basemulta )
    {


       $calcular = true;

       $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );

       $ctr = mdlContrato::find( $idcontrato );

       //echo "user Auth::user()->IMB_IMB_ID";
       $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();

       $datalimite = app('App\Http\Controllers\ctrRotinas')
                ->dataLimite( $idcontrato, $vencimento );

       $datainicio = new DateTime( $datalimite );
       $datafim = new DateTime( $datapagamento );


       $difdias = 0;
       if( $datafim > $datainicio )
       {
          $intervalo = $datainicio->diff( $datafim);
          $difdias =  $intervalo->days;
       };


       $objmulta = new \stdClass();
       $objmulta->reterpercentual         = 0;
       $objmulta->reterdias               = 0;
       $objmulta->retervalor              = 0;
       $objmulta->repassarpercentual      = 0;
       $objmulta->repassardias            = 0;
       $objmulta->repassarvalor           = 0;
       $objmulta->diasatraso              = $difdias;


       if( $difdias > 0 )
       {

          if( $ctr->IMB_CTR_MULTA == 0 )
          {


             foreach( $tm as $multa )
             {
                if ( ( $difdias >= $multa->IMB_TBM_DE and $difdias <= $multa->IMB_TBM_ATE ) or
                   ( $difdias > $multa->IMB_TBM_ATE) )
                {
                   if( $multa->IMB_TMB_DAIMOBILIARIA =='S')
                   {
                      $objmulta->reterpercentual =
                      $objmulta->reterpercentual + $multa->IMB_TBM_PERCENTUAL;
                         $objmulta->reterdias       = $multa->IMB_TBM_ATE;
                   }
                   else
                   {
                      $objmulta->repassarpercentual =
                            $objmulta->repassarpercentual + $multa->IMB_TBM_PERCENTUAL;
                            $objmulta->repassardias       =  $multa->IMB_TBM_ATE;
                   }
                }
             }
          }
          else
          {
             if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S')
                $objmulta->reterpercentual    = $ctr->IMB_CTR_MULTA;
             else
                $objmulta->repassarpercentual = $ctr->IMB_CTR_MULTA;

          }

          if( $objmulta->reterpercentual <> 0 )
             $objmulta->retervalor     = $basemulta * $objmulta->reterpercentual / 100;

          if( $objmulta->repassarpercentual <> 0 )
             $objmulta->repassarvalor      = $basemulta * $objmulta->repassarpercentual / 100;

       }
       return response()->json( $objmulta, 200);

    }


    public function calcularJurosBoleto ( $idcontrato, $vencimento, $datapagamento, $basejuros )
    {

       $calcular = true;

       $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );
       $param = mdlParametros::find(  Auth::user()->IMB_IMB_ID );

       $ctr = mdlContrato::find( $idcontrato );

       //echo "user Auth::user()->IMB_IMB_ID";
       $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();


       $datalimite = app('App\Http\Controllers\ctrRotinas')
                ->dataLimite( $idcontrato, $vencimento );


       $datainicio = new DateTime( $datalimite );
       $datafim = new DateTime( $datapagamento );

       $difdias = 0;
       if( $datafim > $datainicio )
       {
          $intervalo = $datainicio->diff( $datafim);
          $difdias = $intervalo->days;
       };


       $objjuros = new \stdClass();
       $objjuros->jurosdias               = 0;
       $objjuros->jurospercentual         = 0;
       $objjuros->retervalor              = 0;
       $objjuros->repassarvalor           = 0;

       if( $difdias > 0 )
       {

          if( $param->IMB_PRM_COBRARJUROS == 'S' )
          {

             $objjuros->jurospercentual = $ctr->IMB_CTR_JUROS;
             $objjuros->jurosdias =  $difdias;

             if(  $ctr->IMB_CTR_JUROS == 0 )
                $objjuros->jurospercentual = $param->IMB_PRM_COBBANJUROSDIA;

             if( $objjuros->jurospercentual <> 0 )
             {
                $valordojuros = ( ( $basejuros * $objjuros->jurospercentual ) * $difdias ) / 100;

                if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S')
                   $objjuros->retervalor    = $valordojuros;
                else
                   $objjuros->repassarvalor = $valordojuros;
             }
          }

       }

       return response()->json( $objjuros, 200);

    }

    public function gerarCobrancaPermReprogramacao( Request $request )
    {

        $id = $request->IMB_CGR_ID;
        $multarep = $request->multarep;
        $multaret = $request->multaret;
        $jurosrep = $request->jurosrep;
        $jurosret = $request->jurosret;
        $datavencimento = $request->datavencimento;
        $pontualidade = $request->pontualidade;

        $valortotal = $request->valortotal;

        $cgp =mdlCobrancaGeradaPerm::find($id);

        if(  $cgp )
        {
            $cob = mdlCobrancaGerada::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();
            $vencimentooriginal = $cgp->IMB_CGR_DATAVENCIMENTO;



            $conta = mdlContaCaixa::find( $cgp->FIN_CCR_ID );
            $seqnn = intval($conta->FIN_CCI_NOSSONUMERO );
            $nossonumero = $conta->FIN_CCI_NOSSONUMERO;
            $conta->FIN_CCI_NOSSONUMERO = $seqnn + 1;
            $conta->save();



            $hd = new mdlCobrancaGerada;
            $hd->IMB_IMV_ID = $cgp->IMB_IMV_ID;
            $hd->IMB_CGR_DESTINATARIO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CGR_DESTINATARIO);
            $hd->IMB_CGR_ENDERECO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CGR_ENDERECO);
            $hd->IMV_CGR_CEP = $cgp->IMV_CGR_CEP;
            $hd->IMB_CEP_BAI_NOME = utf8_encode($cgp->IMB_CEP_BAI_NOME) ;
            $hd->IMB_CEP_CID_NOME = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CEP_CID_NOME);
            $hd->IMB_CGR_DATAVENCIMENTO = $datavencimento;
            $hd->IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTOORIGINAL;
            $hd->IMB_CGR_NOSSONUMERO = $nossonumero;
            $hd->IMB_CGR_VALOR = $valortotal;
            $hd->CEP_UF_SIGLA = $cgp->CEP_UF_SIGLA;
            $hd->IMB_CGR_CPF = $cgp->IMB_CGR_CPF;
            $hd->IMB_CGR_PESSOA = $cgp->IMB_CGR_PESSOA;
            $hd->IMB_CTR_ID = $cgp->IMB_CTR_ID;
            $hd->IMB_CGR_IMOVEL = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cgp->IMB_CGR_IMOVEL);
            $hd->IMB_CGR_DATALIMITE = $datavencimento;
            $hd->IMB_CLT_EMAIL = $cgp->IMB_CLT_EMAIL;
            $hd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $hd->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            if( $pontualidade == 'S')
                 $hd->IMB_CGR_VALORPONTUALIDADE = $cgp->IMB_CGR_VALORPONTUALIDADE ;
            else
             $hd->IMB_CGR_VALORPONTUALIDADE = 0;
            $hd->IMB_CGR_TARIFABOLETO = $cgp->IMB_CGR_TARIFABOLETO;
            $hd->IMB_CTR_REFERENCIA = $cgp->IMB_CTR_REFERENCIA;
            $hd->IMB_CGR_INCONSISTENCIA         = $cgp->IMB_CGR_INCONSISTENCIA;
            $hd->IMB_CGR_SELECIONADA         = 'S';
            $hd->FIN_CCR_ID     = $cgp->FIN_CCR_ID;
            //$hd->imb_cgr_idpermanente = '';
            $hd->save();

            $cgis = mdlCobrancaGeradaItemPerm::
                    where( 'IMB_CGR_ID','=',$cgp->IMB_CGR_ID)->get();

            $total = 0;
            foreach( $cgis as $cgi )
            {

                if( substr($cgi->IMB_LCF_OBSERVACAO,0,12) == 'Reprogramaçã')
                {
                    $lf = mdlLancamentoFuturo::find( $cgi->IMB_LCF_ID);
                    if( $lf <> '' )
                    {
                        $lf->IMB_LCF_DTHINATIVO=date('Y/m/d');
                        $lf->IMB_ATD_IDINATIVO = Auth::user()->IMB_ATD_ID;
                        $lf->save();
                    }
                }
                else
                {
                    $valorlcf = $cgi->IMB_LCF_VALOR;
                    if( $cgi->IMB_LCF_LOCATARIOCREDEB == 'C' )
                    $valorlcf = $valorlcf * -1;

                    $total = $total + $valorlcf;

                    $item                               = new mdlCobrancaGeradaItem;
                    $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                    $item->IMB_LCF_ID                   = $cgi->IMB_LCF_ID;
                    $item->IMB_TBE_ID                   = $cgi->IMB_TBE_ID;
                    $item->IMB_TBE_DESCRICAO            = $cgi->IMB_TBE_DESCRICAO;
                    $item->IMB_RLT_LOCATARIOCREDEB      = $cgi->IMB_RLT_LOCATARIOCREDEB;
                    $item->IMB_RLT_LOCADORCREDEB        = $cgi->IMB_RLT_LOCATARIOCREDEB;
                    $item->IMB_LCF_VALOR                = $cgi->IMB_LCF_VALOR;
                    $item->IMB_LCF_OBSERVACAO           = $cgi->IMB_LCF_OBSERVACAO;
                    $item->IMB_LCF_DATAVENCIMENTO       = $cgi->IMB_LCF_DATAVENCIMENTO;
                    $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $item->save();
                }
            };

            if( $multarep > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 2;
                $item->IMB_TBE_DESCRICAO            = 'Multa';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'C';
                $item->IMB_LCF_VALOR                = $multarep;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento ';
                $item->IMB_LCF_DATAVENCIMENTO       = $datavencimento;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $total = $total + $multarep;

                $item->save();

            }

            if( $multaret > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 36;
                $item->IMB_TBE_DESCRICAO            = 'Multa II';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'N';
                $item->IMB_LCF_VALOR                = $multaret;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento';
                $item->IMB_LCF_DATAVENCIMENTO       = $datavencimento;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $item->save();
                $total = $total + $multaret;

            }

            if( $jurosret > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 37;
                $item->IMB_TBE_DESCRICAO            = 'Juros II';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'N';
                $item->IMB_LCF_VALOR                = $jurosret;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento';
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $item->save();
                $total = $total + $jurosrep;


            }

            if( $jurosrep > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 3;
                $item->IMB_TBE_DESCRICAO            = 'Juros';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'C';
                $item->IMB_LCF_VALOR                = $jurosrep;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento';
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $item->save();
                $total = $total + $jurosret;

            }

            $hd->IMB_CGR_VALOR = $valortotal;
            $hd->save();

            $cgp->IMB_CGR_DTHINATIVO = date('Y/m/d');
            $cgp->IMB_ATD_IDINATIVO = Auth::user()->IMB_ATD_ID;
            $cgp->save();
        }



        return response()->json( 'ok',200 );

    }

    public function gerarCobrancaTMPReprogramacao( Request $request )
    {

        $id = $request->IMB_CGR_ID;
        $multarep = $request->multarep;
        $multaret = $request->multaret;
        $jurosrep = $request->jurosrep;
        $jurosret = $request->jurosret;
        $datavencimento = $request->datavencimento;
        $vencimetooriginal = $request->vencimentooriginal;
        $valortotal = $request->valortotal;


        $cgp =mdlCobrancaGerada::find($id);

        if(  $cgp )
        {
            $cgp->IMB_CGR_DATAVENCIMENTO = $datavencimento;
            $cgp->IMB_CGR_DATALIMITE = $datavencimento;
            $cgp->IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTOORIGINAL;
            $cgp->save();

            $cgis = mdlCobrancaGeradaItem::
                    where( 'IMB_CGR_ID','=',$cgp->IMB_CGR_ID)
                    ->where('IMB_LCF_OBSERVACAO','=', 'Reprogramação de Vencimento' )
                    ->delete();

            $cgis = mdlCobrancaGeradaItem::
                    where( 'IMB_CGR_ID','=',$cgp->IMB_CGR_ID)->get();

            $total = 0;
            foreach( $cgis as $cgi )
            {
                $valorlcf = $cgi->IMB_LCF_VALOR;
                if( $cgi->IMB_LCF_LOCATARIOCREDEB == 'C' )
                    $valorlcf = $valorlcf * -1;

                $total = $total + $valorlcf;

            };

            if( $multarep > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $cgp->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 2;
                $item->IMB_TBE_DESCRICAO            = 'Multa';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'C';
                $item->IMB_LCF_VALOR                = $multarep;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento ';
                $item->IMB_LCF_DATAVENCIMENTO       = $datavencimento;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $total = $total + $multarep;

                $item->save();

            }

            if( $multaret > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $cgp->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 36;
                $item->IMB_TBE_DESCRICAO            = 'Multa II';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'N';
                $item->IMB_LCF_VALOR                = $multaret;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento';
                $item->IMB_LCF_DATAVENCIMENTO       = $datavencimento;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $item->save();
                $total = $total + $multaret;

            }

            if( $jurosret > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $cgp->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 37;
                $item->IMB_TBE_DESCRICAO            = 'Juros II';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'N';
                $item->IMB_LCF_VALOR                = $jurosret;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento';
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $item->save();
                $total = $total + $jurosrep;


            }

            if( $jurosrep > 0 )
            {
                $item                               = new mdlCobrancaGeradaItem;
                $item->IMB_CGR_ID                   = $cgp->IMB_CGR_ID;
                $item->IMB_TBE_ID                   = 3;
                $item->IMB_TBE_DESCRICAO            = 'Juros';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'C';
                $item->IMB_LCF_VALOR                = $jurosrep;
                $item->IMB_LCF_OBSERVACAO           = 'Reprogramação de Vencimento';
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $item->save();
                $total = $total + $jurosret;

            }

            $cgp->IMB_CGR_VALOR = $valortotal;
            $cgp->save();
        }



        return response()->json( 'ok',200 );

    }

    public function cargaItensPermSemJson( $id )
    {
        $item = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=',$id )
        ->leftJoin('IMB_TABELAEVENTOS',
                        'IMB_TABELAEVENTOS.IMB_TBE_ID',
                        'IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID')
        ->get();

        return $item;

    }



    public function contratoAVencer( Request $request)
    {

        $date = Carbon::today();

        //funcao pra testar
        $contacobranca = $request->FIN_CCX_ID;

        $contratos = mdlContrato::where( 'IMB_CTR_SITUACAO','=','ATIVO')
        ->where( 'IMB_CTR_ADVOGADO','<>','S')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_FORPAG_ID_LOCATARIO','=', 1)
        ->where( 'FIN_CCR_ID_COBRANCA','=',$contacobranca)
        ->whereDate('IMB_CTR_VENCIMENTOLOCATARIO', '>', $date)
        ->get();

        return $contratos;
    }

    public function retornoBancarioCarga()
    {

        $retornos = mdlRetornoBancario:://where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        where('codigoocorrencia','=', '06' )
        ->get();

        return $retornos;

    }


    public function previewBaixaAutomatica()
    {
        return view('reports.admimoveis.previabaixaautomatica');
    }

    public function baseMultaJurosBoletoPerm( $id, $tabela )
    {
            $itens = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=', $id )
            ->leftJoin( 'IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID' )
            ->get();

        $basemulta = 0;
        $basejuros = 0;
        foreach( $itens as $item )
        {
            if( $item->IMB_RLT_LOCATARIOCREDEB =='D' and $item->IMB_TBE_MULTA =='S')
                $basemulta = $basemulta + $item->IMB_LCF_VALOR;
            if( $item->IMB_RLT_LOCATARIOCREDEB =='C' and $item->IMB_TBE_MULTA =='S')
                $basemulta = $basemulta - $item->IMB_LCF_VALOR;

            if( $item->IMB_RLT_LOCATARIOCREDEB =='D' and $item->IMB_TBE_MULTA =='S')
                $basejuros = $basejuros + $item->IMB_LCF_VALOR;
            if( $item->IMB_RLT_LOCATARIOCREDEB =='C' and $item->IMB_TBE_MULTA =='S')
                $basejuros = $basejuros - $item->IMB_LCF_VALOR;
        }

        
        $basesmultajuros = [ 'multa' => $basemulta, 'juros' => $basejuros];
        

        return $basesmultajuros;
    }

    public function relatorioretornoliquida()
    {
        return view( 'reports.admimoveis.relatorioretornoliquidacoes');
    }

    public function relatorioretorno()
    {
        return view( 'reports.admimoveis.relatorioretorno');
    }

    public function boletosVencendoCarga( Request $request )
    {
        $datainicio = $request->datainicio;
        $datafim    = $request->datafim;
        $semjson    = $request->semjson;
        if( $datainicio == '' ) $datainicio = date('Y/m/d');
        if( $datafim == '' ) $datafim = date('Y/m/d');

        $boletos    = mdlCobrancaGeradaPerm::select(
            [
                'IMB_COBRANCAGERADAPERM.*',
                DB::raw( '( select PEGALOCATARIOCONTRATO( IMB_COBRANCAGERADAPERM.IMB_CTR_ID) ) AS LOCATARIO')
                
            ])
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_COBRANCAGERADAPERM.IMB_CTR_ID')
        ->where('IMB_CONTRATO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_CGR_DATAVENCIMENTO','>=', $datainicio )
        ->where( 'IMB_CGR_DATAVENCIMENTO','<=', $datafim )
        ->where( 'IMB_CTR_SITUACAO','=', 'ATIVO')
        ->whereNull( 'IMB_CGR_DATABAIXA')
        ->whereNull( 'IMB_CGR_DTHINATIVO')
        ->orderBy( 'IMB_CGR_DATAVENCIMENTO')
        ->get();

        if( $semjson == 'S' ) return $boletos;
        return response()->json($boletos,200);




    }

    public function boletosVencendoQtde( Request $request )
    {
        $datainicio = $request->datainicio;
        $datafim    = $request->datafim;
        $semjson = $request->semjson;
        if( $datainicio == '' ) $datainicio = date('Y/m/d');
        if( $datafim == '' ) $datafim = date('Y/m/d');

        $boletos    = mdlCobrancaGeradaPerm::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_CGR_DATAVENCIMENTO','>=', $datainicio )
        ->where( 'IMB_CGR_DATAVENCIMENTO','<=', $datafim )
        ->whereNull( 'IMB_CGR_DATABAIXA')
        ->whereNull( 'IMB_CGR_DTHINATIVO')
        ->orderBy( 'IMB_CGR_DATAVENCIMENTO')
        ->count();

        if( $semjson == 'S' ) return $boletos;
        return response()->json($boletos,200);


    }
    


    public function previsaoRecebimento( Request $request )
    {

        return view( 'reports.admimoveis.previsaorecebimentogerar');

    }


    public function selecionarContratosPrevisao( Request $request )
    {
        

        //Log::info('selecionar contratos previsao' );
        $cob = mdlTmpPrevisaoRecebimento::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();
        $cob = mdlTmpPrevisaoRecebimentoDetail::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

        $date = Carbon::today();

        $contratos = mdlContrato::where( 'IMB_CTR_SITUACAO','=','ATIVO')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID );
        $contratos = $contratos->orderBy( 'IMB_IMV_ID','ASC');
        $contratos = $contratos->get();


        //$contratos = Datatables::eloquent($contratos);
        foreach( $contratos as $contrato)
        {



            $idcontrato     = $contrato->IMB_CTR_ID;

            $diainicial     = app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->diainicial, 2,0);

            $diafinal       =  app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->diafinal, 2,0);

            $mesinicial     = app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->mesinicial, 2,0);

            $mesfinal     = app('App\Http\Controllers\ctrRotinas')
            ->formata_numero($request->mesfinal, 2,0);

            $anoinicial     = $request->anoinicial;
            $anofinal       = $request->anofinal;



            if( $contrato->IMB_CTR_ADVOGADO <> 'A')
                $this->gerarPrevisao( $idcontrato,
                                    $contrato->IMB_CTR_DIAVENCIMENTO,
                                   $diainicial,
                                   $diafinal ,
                                   $mesinicial,
                                   $mesfinal ,
                                   $anoinicial,
                                   $anofinal
                                );

        }


        return response()->json($cob,200);
        


    }

    public function gerarPrevisao(  $idcontrato,
    $diavencimentoctr,
    $diainicial,
    $diafinal ,
    $mesinicial,
    $mesfinal ,
    $anoinicial,
    $anofinal)

    {


        $begin = new DateTime( $anoinicial.'-'.$mesinicial."-".$diainicial );
        $end = new DateTime( $anofinal.'-'.$mesfinal."-".$diafinal );

        $intervalo = $begin->diff( $end );

        //Repare que inverto a ordem, assim terei a subtração da ultima data pela primeira.
        //Calculando a diferença entre os meses
        $meses = ((int)$end->format('m') - (int)$begin->format('m'))
                + (((int)$end->format('y') - (int)$begin->format('y')) * 12);

        $meses++;

        $mes = $mesinicial;
        $ano = $anoinicial;
        $dia = $diainicial;

        $ultimodia = app('App\Http\Controllers\ctrRotinas')->ultimoDiaMes($mes,  $ano );
        if( $diavencimentoctr > $ultimodia )
            $diavencimentoctr = $ultimodia;

        $dataapp = mktime( 0, 0, 0, $mes,$diavencimentoctr, $ano);


        $datavencimento = $dataapp;

        $intinicio = intval($anoinicial.$mesinicial.$diainicial);
        $intfim = intval($anofinal.$mesfinal.$diafinal );
        $intvencimento = intval(date( 'Ymd',$datavencimento));

        if(  $intvencimento >= $intinicio
            and $intvencimento <= $intfim)
        {
            if( $mesinicial == $mesfinal and $anoinicial == $anofinal ) $meses = 1;
            for($i = 1; $i <= $meses; $i++)
            {
                //lancando os dixos
                app('App\Http\Controllers\ctrLancamentoFuturo')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                        ->gerarFixos( $idcontrato, date( 'Y-m-d',$datavencimento),'LT'  );
                $this->gerarItensPrevisao( $datavencimento, $idcontrato );
                $mes++;
                if( $mes > 12 )
                {
                    $mes = 1;
                    $ano++;
                }
                $diactr = $diavencimentoctr;
                $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
                if( $diavencimentoctr > $ultimo_dia)
                $diactr = $ultimo_dia;
                $datavencimento = mktime( 0, 0, 0, $mes,$diactr, $ano);
            }
        }

        return response()->json('ok',200);

    }

    public function gerarItensPrevisao( $datavencimento, $idcontrato )
    {

        $objbases = new \stdClass();

        $vencimento = date( 'Y/m/d',$datavencimento);

       
        $ctr = mdlContrato::find( $idcontrato );

        $locatario = app('App\Http\Controllers\ctrRotinas')
                    ->nomeLocatarioPrincipal( $idcontrato );

        $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                    ->imovelEndereco( $ctr->IMB_IMV_ID );


        $endereco = app('App\Http\Controllers\ctrRotinas')
                    ->pegarEnderecoCobranca( $idcontrato );

        $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                    ->codigoLocatarioPrincipal( $idcontrato );

        $locatario =  app('App\Http\Controllers\ctrRotinas')
        ->clienteDadosFull( $idlocatario );

        $descontoacordo = app('App\Http\Controllers\ctrRotinas')
        ->verificarEventoLancado( $idcontrato, $vencimento, 8 );


        $tarifaBoleto = app('App\Http\Controllers\ctrRotinas')
        ->tarifaBoleto( $idcontrato, $vencimento );

        $datalimite = app('App\Http\Controllers\ctrRotinas')
        ->dataLimite( $idcontrato, $vencimento );

        $pontualidade=0;
        if( $ctr->IMB_CTR_VALORBONIFICACAO4 <> 0 )
            $pontualidade = app('App\Http\Controllers\ctrRotinas')
                        ->valorDescontoPontualidade( $idcontrato, $vencimento, $vencimento, $descontoacordo,'LT' );

       if( $locatario)
        {

            $bairro=$endereco->IMB_CCB_BAIRRO;
            $bairro=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($bairro);
            $hd = new mdlTmpPrevisaoRecebimento;
            $hd->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $hd->IMB_CGR_DESTINATARIO = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_DESTINATARIO);
            $hd->IMB_CGR_ENDERECO = substr(
                app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_ENDERECO).
                ' '.$endereco->IMB_CCB_ENDERECONUMERO.
                ' '.$endereco->IMB_CCB_ENDERECOCOMPLEMENTO,0,40);
            $hd->IMV_CGR_CEP = $endereco->IMB_CCB_CEP;
            
            $hd->IMB_CEP_BAI_NOME = substr(app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->IMB_CCB_BAIRRO),0,19);
            $hd->IMB_CEP_CID_NOME = substr(app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($endereco->CEP_CID_NOME),0,19);
            $hd->IMB_CGR_DATAVENCIMENTO = $vencimento;
//            $hd->IMB_CGR_VENCIMENTOORIGINAL = $vencimento;
            $hd->CEP_UF_SIGLA = $endereco->CEP_UF_SIGLA;
            $hd->IMB_CGR_CPF = $locatario->IMB_CLT_CPF;
            $hd->IMB_CGR_PESSOA = $locatario->IMB_CLT_PESSOA;
            $hd->IMB_CTR_ID = $idcontrato;
            $hd->IMB_CGR_IMOVEL = $imovelendereco;
            $hd->IMB_CGR_DATALIMITE = $datalimite;
//            $hd->IMB_CLT_EMAIL = $locatario->IMB_CLT_EMAIL;
            $hd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            //$hd->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $hd->IMB_CGR_VALORPONTUALIDADE = $pontualidade;
            $hd->IMB_CTR_REFERENCIA = $ctr->IMB_CTR_REFERENCIA;

            $reajustar = app('App\Http\Controllers\ctrRotinas')->verificarReajustes(  $idcontrato,date('Y-m-d',strtotime($vencimento)),'N')  ;

            $hd->save();
                
            $objbases->baseirrf      = 0;
            $objbases->basemulta     = 0;
            $objbases->basejuros     = 0;
            $objbases->basecorrecao  = 0;

            app('App\Http\Controllers\ctrRotinas')
                ->lancarAluguel($idcontrato, date( 'Y-m-d',$datavencimento) );

            $itemaluguel = 0;
            $irrflancando = 0;
            $tarifaboletolancado ='N';

            $lcfs = app('App\Http\Controllers\ctrLancamentoFuturo')
                ->lancamentomeslocatario( $vencimento, $idcontrato,'0' );


            foreach ( $lcfs as $lf )
            {
                if( $lf->IMB_TBE_ID == 1 )
                    $itemaluguel = $lf->IMB_LCF_VALOR;
                    $valorlcf = $lf->IMB_LCF_VALOR;
                if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C' )
                    $valorlcf = $valorlcf * -1;

                if( $lf->IMB_TBE_ID == 18 ) $irrflancando = $lf->IMB_LCF_VALOR;
                if( $lf->IMB_TBE_ID == 23 ) $tarifaboletolancado = 'S';
        

                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideMulta( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basemulta = $objbases->basemulta + $valorlcf;


                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideJuros( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basejuros = $objbases->basejuros + $valorlcf;


                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                        ->incideCorrecao( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basecorrecao = $objbases->basecorrecao + $valorlcf;

                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideIRRF( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->baseirrf = $objbases->baseirrf + $valorlcf;

                $item                               = new mdlTmpPrevisaoRecebimentoDetail;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_LCF_ID                   = $lf->IMB_LCF_ID;
                $item->IMB_TBE_ID                   = $lf->IMB_TBE_ID;
                $item->IMB_TBE_DESCRICAO            = $lf->IMB_TBE_NOME;
                $item->IMB_RLT_LOCATARIOCREDEB      = $lf->IMB_LCF_LOCATARIOCREDEB;
                $item->IMB_RLT_LOCADORCREDEB        = $lf->IMB_LCF_LOCADORCREDEB;
                $item->IMB_LCF_VALOR                = $lf->IMB_LCF_VALOR;
                $item->IMB_LCF_OBSERVACAO           = $lf->IMB_LCF_OBSERVACAO;
                $item->IMB_LCF_DATAVENCIMENTO       = $lf->IMB_LCF_DATAVENCIMENTO;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                $item->save();
            }

                
            if ( $tarifaBoleto <> 0 and $tarifaboletolancado  == 'N' )
            {
                $item                               = new mdlTmpPrevisaoRecebimentoDetail;
                $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                $item->IMB_LCF_ID                   = 0;
                $item->IMB_TBE_ID                   = 23;
                $item->IMB_TBE_DESCRICAO            = 'Tarifa Boleto';
                $item->IMB_RLT_LOCATARIOCREDEB      = 'D';
                $item->IMB_RLT_LOCADORCREDEB        = 'N';
                $item->IMB_LCF_VALOR                = $tarifaBoleto;
                $item->IMB_LCF_OBSERVACAO           = '';
                $item->IMB_LCF_DATAVENCIMENTO       = $vencimento;
                $item->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $item->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                $item->save();
            }


            $hd->save();


            if(  $ctr->IMB_CTR_NUNCARETEIRRF <> 'S' and $irrflancando == 0 )
            {
                $irrf=$valorirrf = app('App\Http\Controllers\ctrTabelaIRRF')
                    ->calcularIRRF( $idcontrato, $objbases->baseirrf );

                foreach ($irrf as $irrfcal)
                {
                    $item                               = new mdlTmpPrevisaoRecebimentoDetail;
                    $item->IMB_CGR_ID                   = $hd->IMB_CGR_ID;
                    $item->IMB_LCF_ID                   = 0;
                    $item->IMB_TBE_ID                   = 18;
                    $item->IMB_TBE_DESCRICAO            = 'I.R.R.F.';
                    $item->IMB_RLT_LOCATARIOCREDEB      = 'C';
                    $item->IMB_RLT_LOCADORCREDEB        = 'D';
                    $item->IMB_LCF_VALOR                = $irrfcal['valorIRRF'];
                    $item->IMB_LCF_OBSERVACAO           = 'Retenção IRRF de '.
                                                        $irrfcal['cliente'].' - CPF: '.
                                                        $irrfcal['cpf'];
                    $item->IMB_LCF_DATAVENCIMENTO       = $vencimento;
                    $item->IMB_CLT_ID                   = $irrfcal['IMB_CLT_ID'];
                    $item->IMB_ATD_ID                   = Auth::user()->IMB_ATD_ID;
                    $item->save();
                }
            }

                //Calculando o total em itens do boleto
            $hd->IMB_CGR_VALOR = $this->calcularTotalPrevisao( $hd->IMB_CGR_ID );
            $hd->save();
            //}

            //if( $hd->IMB_CGR_VALOR  == 0 and $hd->IMB_CGR_INCONSISTENCIA == '' ) $hd->delete();
        }
        return response()->json('ok',200);
    }
    public function calcularTotalPrevisao( $id )
    {
        $itens = mdlTmpPrevisaoRecebimentoDetail::where('IMB_CGR_ID','=',$id )->get();

        $total = 0;
        foreach( $itens as $item )
        {
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'D')
              $total = $total + $item->IMB_LCF_VALOR;
            if( $item->IMB_RLT_LOCATARIOCREDEB == 'C')
              $total = $total - $item->IMB_LCF_VALOR;
        }

        return $total;

    }

    public function previsaoRecebimentoRelatorio( $periodo)
    {
        $cob =  mdlTmpPrevisaoRecebimento::
        where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->orderBy('IMB_CGR_DATAVENCIMENTO')
        ->get();

        return view( 'reports.admimoveis.relprevisaorecebimento', compact( 'cob', 'periodo' ));

    }

    public function pegaNossoNumeroBoletoVencimento( $idcontrato, $vencimento)
    {
        $cob = mdlCobrancaGeradaPerm::where( 'IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_CGR_DATAVENCIMENTO','=', $vencimento )
        ->first();
        if( $cob == '' ) return '';

        return $cob->IMB_CGR_NOSSONUMERO;
    }


    public function cargaHeader( $ordem )
    {
        if( $ordem == '') $ordem = 'IMB_CGR_DATAVENCIMENTO';
        $cob = mdlCobrancaGerada::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->orderBy( "$ordem")
        ->get();

        return $cob;


    }
    public function cargaDetail( $id )
    {
        $cob = mdlCobrancaGeradaItem::where( 'IMB_CGR_ID','=',$id )
        ->orderBy( 'IMB_TBE_ID')
        ->get();

        return $cob;


    }
    public function pegarTelLocatarios( $id )
    {
        $cob = mdlCobrancaGeradaPerm::where( 'IMB_CGR_ID','=',$id )->first();

        $telefones = mdlLocatarioContrato::select(
            [
                'IMB_TLF_DDI',
                'IMB_TLF_DDD',
                'IMB_TLF_TIPOTELEFONE',
                'IMB_TLF_NUMERO',
                'IMB_CLT_NOME',
                'IMB_CTR_ID',
                'IMB_CLIENTE.IMB_CLT_ID',
            ]
        )
        ->where( 'IMB_CTR_ID','=', $cob->IMB_CTR_ID )
        ->leftJoin( 'IMB_TELEFONES', 'IMB_TELEFONES.IMB_TLF_ID_CLIENTE', 'IMB_LOCATARIOCONTRATO.IMB_CLT_ID' )
        ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID','IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
        ->get();

        return response()->json( $telefones, 200);
    }


    public function cargaBoletosPeriodoJson( Request $request )
    {

        $logged='S';
        if( ! Auth::check())
        {
            Auth::loginUsingId( 1,false);
            $logged = 'N';
        }
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;

        $cobrancas = mdlCobrancaGeradaPerm::select( '*',
        db::Raw( '( select PEGAEMAILLOCATARIOCONTRATO( IMB_COBRANCAGERADAPERM.IMB_CTR_ID) ) EMAIL'))
                ->where( 'IMB_CTR_SITUACAO','=','ATIVO')
                ->whereNull( 'IMB_CGR_DATABAIXA')
                ->whereNull( 'IMB_CGR_DTHINATIVO')
                ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_COBRANCAGERADAPERM.IMB_CTR_ID' )
                ->where( 'IMB_CGR_ENTRADACONFIRMADA','=','S' )
                ->where( 'IMB_CGR_DATAVENCIMENTO','>=', $datainicio )
                ->where( 'IMB_CGR_DATAVENCIMENTO','<=', $datafim );

        $cobrancas = $cobrancas->get();

        return response()->json($cobrancas,200 );

    }

    public function painelBoletosEnviadosCarga( Request $request )
    {

        $datainicio = $request->datainicio;
        $datafim = $request->datafim;

        $boletos = mdlObs::
        select( 
            '*', 
            db::raw( '( SELECT IMB_CTR_REFERENCIA FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_CTR_ID = IMB_OBSERVACAOGERAL.IMB_CTR_ID) AS IMB_CTR_REFERENCIA' ),
            db::raw( '( select PEGALOCATARIOCONTRATO( IMB_OBSERVACAOGERAL.IMB_CTR_ID) ) AS IMB_CLT_NOME')
        )
        ->whereRaw( " cast(IMB_OBS_DTHATIVO as date ) between '$datainicio' and '$datafim' and  IMB_OBS_OBSERVACAO like 'Boleto enviado para%'")
        ->orderBy( 'IMB_OBS_ID','desc' );



        return DataTables::of($boletos)->make(true);        



    }





}

