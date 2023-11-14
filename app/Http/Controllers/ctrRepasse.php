<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\mdlRepasse;
use App\mdlCliente;
use App\mdlLancamentoFuturo;
use App\mdlTabelaEvento;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlContrato;
use App\mdlImovel;
use App\mdlPropImovel;
use App\mdlImobiliaria;
use App\mdlContratoTaxDif;
use App\mdlTmpPrevisaoRepasse;
use App\mdlTmpPrevisaoTaxAdm;

use DataTables;
use DateTime;

use DB;
use Auth;

use PDF;

use Log;


class ctrRepasse extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request  )
    {
        $id = $request->IMB_CTR_ID;
        return view( 'repasse.repasse', compact( 'id' ) ) ;

    }

    public function calcularRepasse( $idcontrato, $datavencimento,  $datapagamento, $somentemes )
    {

    //    dd( " $idcontrato, $datavencimento,  $datapagamento" ) ;
        //primeira parte é limpar a tabela para que possa colocar novas infoamções.

        //dd( 'calcular');

       ////// //////Log::info( " idcontrato: $idcontrato, datavencimento: $datavencimento,  datapagamento: $datapagamento, somentemes: $somentemes ");

       
       ////Log::info('entrei com o somentemes: '.$somentemes);

       //////Log::info( "data vencimento: ".$datavencimento );
        $tmp = mdlRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->whereRaw("coalesce(TMP_REC_FIXADO,'N') <> 'S' ")
        ->delete();

        $objbases = new \stdClass();

        $vencimento = $datavencimento;

        //verificando se tem aluguel lançado
        app('App\Http\Controllers\ctrRotinas')
                        ->lancarAluguel( $idcontrato, $vencimento);


       ////// ////////Log::info('entrar nos fixos');
        //lancando os fixos
        app('App\Http\Controllers\ctrLancamentoFuturo')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                ->gerarFixos( $idcontrato, $datavencimento,'LD' );


        $lcfs = app('App\Http\Controllers\ctrLancamentoFuturo')
            ->lancamentoLocadorAberto( $vencimento, $idcontrato,'0',$somentemes);

        
            $ctr = mdlContrato::find( $idcontrato );
//            ////Log::info( "Contrato: ".$ctr->IMB_CTR_REFERENCIA );
//            ////Log::info( "LANCAMENTOS*************");

    
                

        $liberadorepasse="S";

        //if( $ctr->IMB_CTR_ALUGUELGARANTIDO <> 'S' and
            //$ctr->IMB_CTR_VENCIMENTOLOCATARIO <= $ctr->IMB_CTR_VENCIMENTOLOCADOR )
            //$liberadorepasse = 'N';

        if( $liberadorepasse == 'S' )
        {
            $locatario = app('App\Http\Controllers\ctrRotinas')
                        ->nomeLocatarioPrincipal( $idcontrato );

            $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                        ->imovelEndereco( $ctr->IMB_IMV_ID );

            $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                        ->codigoLocatarioPrincipal( $idcontrato );

            $locatario =  app('App\Http\Controllers\ctrRotinas')
            ->clienteDadosFull( $idlocatario );

            $descontoacordo = app('App\Http\Controllers\ctrRotinas')
            ->verificarEventoLancado( $idcontrato, $vencimento, 8 );

            $pontualidade = app('App\Http\Controllers\ctrRotinas')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                            ->valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo, 'LD' );


            $objbases->baseirrf      = 0;
            $objbases->basemulta     = 0;
            $objbases->basejuros     = 0;
            $objbases->basecorrecao  = 0;
            $objbases->baseiss       = 0;
            $objbases->basetaxa       = 0;

            $calculartaxaadm = 'S';

            //dd( $lcfs );
            foreach ( $lcfs as $lf )
            {
                //Log::info('tbe '.$lf->IMB_TBE_ID );
                //Log::info('IMB_CLT '.$lf->IMB_CLT_IDLOCADOR );
                

                $valorlcf = $lf->IMB_LCF_VALOR;
                if( $lf->IMB_LCF_LOCADORCREDEB == 'D' )
                $valorlcf = $valorlcf * -1;

                //////Log::info( $lf->IMB_TBE_ID );

                if (   ( $lf->IMB_TBE_ID == 6 ) or  ( $lf->IMB_TBE_ID == 7 and $lf->IMB_LCF_COBRARTAXADMMES == 'N' ) )
                $calculartaxaadm = 'N';

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

                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideISS( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->baseiss = $objbases->baseiss + $valorlcf;

                if( app('App\Http\Controllers\ctrLancamentoFuturo')
                    ->incideTaxaAdm( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                    $objbases->basetaxa = $objbases->basetaxa + $valorlcf;

            //Log::info('1 calcular taxa: '.$calculartaxaadm);
                    $recebido = 'N';
            if( $lf->IMB_LCF_DATARECEBIMENTO <> null and $lf->IMB_LCF_LOCATARIOCREDEB =='D' and $lf->IMB_LCF_LOCADORCREDEB == 'C' ) 
                $recebido  = 'S';
                
            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
            $tmp->IMB_CTR_ID             = $ctr->IMB_CTR_ID;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID             = $lf->IMB_TBE_ID;
            $tmp->IMB_TBE_NOME           = $lf->IMB_TBE_NOME;
            $tmp->IMB_LCF_LOCATARIOCREDEB= $lf->IMB_LCF_LOCATARIOCREDEB;
            $tmp->IMB_LCF_LOCADORCREDEB  = $lf->IMB_LCF_LOCADORCREDEB;
            $tmp->IMB_LCF_INCMUL         = $lf->IMB_LCF_INCMUL;
            $tmp->IMB_LCF_INCJUROS       = $lf->IMB_LCF_INCJUROS;
            $tmp->IMB_LCF_INCCORRECAO    = $lf->IMB_LCF_INCCORRECAO;
            $tmp->IMB_LCF_INCIRRF        = $lf->IMB_LCF_INCIRRF;
            $tmp->IMB_LCF_INCTAX         = $lf->IMB_LCF_INCTAX;
            $tmp->IMB_LCF_INCISS         = $lf->IMB_LCF_INCISS;
            $tmp->IMB_LCF_VALOR          = $lf->IMB_LCF_VALOR;
            $tmp->IMB_LCF_ID             = $lf->IMB_LCF_ID;
            $tmp->FIN_CFC_ID             = $lf->FIN_CFC_ID;
            $tmp->IMB_LCF_OBSERVACAO     = $lf->IMB_LCF_OBSERVACAO;
            $tmp->IMB_CLT_ID             = $lf->IMB_CLT_IDLOCADOR;
            $tmp->IMB_CLT_NOMELOCADOR      = '';
            $tmp->RECEBIDO              = $recebido;
            ////// ////////Log::info('evento' . $lf->IMB_TBE_ID);
            if( $tmp->IMB_CLT_ID > 0 )
                $tmp->IMB_CLT_NOMELOCADOR      = app('App\Http\Controllers\ctrCliente')->pegarNomeCliente( $tmp->IMB_CLT_ID);

            

            $tmp->IMB_LCF_LIBERADOREPASSE= $liberadorepasse;;

            $tmp->save();
            }

            ////////Log::info('Calcular taxa: '.$calculartaxaadm );
        ////// //////Log::info("varreu os LF");

            if( $pontualidade <> 0 )
            {
                $eve = mdlTabelaEvento::where('IMB_TBE_ID','=', 5 )->first();


                $tmp = new mdlRepasse;
                $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                $tmp->IMB_CTR_ID             = $ctr->$idcontrato;
                $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
                $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
                $tmp->IMB_TBE_ID             = 5;
                $tmp->IMB_TBE_NOME           = 'Desconto Por Pontualidade';
                $tmp->IMB_LCF_LOCATARIOCREDEB= 'C';
                $tmp->IMB_LCF_LOCADORCREDEB  = 'D';
                $tmp->IMB_LCF_INCMUL          = 'N';
                $tmp->IMB_LCF_INCIRRF         = $eve->IMB_TBE_IRRF;
                $tmp->IMB_LCF_INCTAX          = $eve->IMB_TBE_TAXAADM;
                $tmp->IMB_LCF_INCJUROS        = $eve->IMB_TBE_JUROS;
                $tmp->IMB_LCF_INCCORRECAO     = $eve->IMB_TBE_CORRECAO;
                $tmp->IMB_LCF_INCISS          = $eve->IMB_TBE_INCISS;
    //            $tmp->IMB_LCF_GARANTIDO       = 'N';
                $tmp->IMB_LCF_VALOR          = $pontualidade;
                $tmp->IMB_LCF_ID             = 0;
                $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                                ->pegarCFCPadrao( 5 );
                $tmp->IMB_LCF_OBSERVACAO     = '';
                $tmp->IMB_LCF_LIBERADOREPASSE= $liberadorepasse;;

                if( $eve->IMB_TBE_TAXAADM == 'S' )
                    $objbases->basetaxa = $objbases->basetaxa - $pontualidade;

                $tmp->save();
            }

            if( $ctr->IMB_CTR_TAXAADMINISTRATIVA == 0 )
                $calculartaxaadm = 'N';

            Log::info('2 calcular taxa: '.$calculartaxaadm);

                
            $IPTUDestaque = $this->destacarIPTUAdministracao( $idcontrato, $datavencimento );

            if( $IPTUDestaque <> 0 )
            {
                $IPTUTaxa =$this->calcularTaxaPadraoContrato( $idcontrato, $IPTUDestaque, 'N' );
                $this->gravarTaxaAdm( $idcontrato, $datavencimento, $datapagamento, $IPTUTaxa,'Taxa Administrativa sobre IPTU');
            }

            $this->cobraItemTaxaDiferente( $idcontrato,$ctr->IMB_IMV_ID, $datavencimento, $datapagamento );


            //dd( "$calculartaxaadm and $objbases->basetaxa");
            if( $calculartaxaadm =='S' and $objbases->basetaxa <> 0 and $this->verificarFixado( 6 ) =='' )
            {
                $valortaxaadm = $this->calcularTaxaPadraoContrato( $idcontrato, $objbases->basetaxa, 'S' );
                $this->gravarTaxaAdm( $idcontrato, $datavencimento, $datapagamento, $valortaxaadm,'');
            }


    //        //////Log::info('entrando no recalcular');
            $this->recalcularRepasse( $idcontrato,$ctr->IMB_IMV_ID, $datavencimento, $datapagamento);


            $tmp =  mdlRepasse::select(
                [
                    'IMB_IMV_ID',
                    'IMB_CTR_ID',
                    'IMB_IMB_ID',
                    'IMB_ATD_ID',
                    'IMB_PAG_DATAVENCIMENTO',
                    'IMB_PAG_DATAPAGAMENTO',
                    'IMB_TBE_ID',
                    'IMB_TBE_NOME',
                    'IMB_LCF_LOCATARIOCREDEB',
                    'IMB_LCF_LOCADORCREDEB',
                    'IMB_LCF_INCMUL',
                    'IMB_LCF_INCJUROS',
                    'IMB_LCF_INCCORRECAO',
                    'IMB_LCF_INCIRRF',
                    'IMB_LCF_INCTAX',
                    'IMB_LCF_VALOR',
                    'IMB_LCF_ID',
                    'FIN_CFC_ID',
                    'IMB_CLT_ID',
                    'IMB_PAG_ID',
                    'IMB_LCF_OBSERVACAO',
                    'IMB_LCF_LIBERADOREPASSE',
                    DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                    WHERE IMB_CLIENTE.IMB_CLT_ID = TMP_REPASSE.IMB_CLT_ID)
                    AS IMB_CLT_NOMELOCADOR')

                ]
            )
            ->where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->orderBy('IMB_TBE_ID')->get();

            return $tmp;
        }
        else
        {
            //Log::info('*** atencao vazio ***');
            return '[]';
        }


    }

    public function recalcularRepasse( $idcontrato, $idimovel, $datavencimento, $datapagamento )
    {
        $tmp =  mdlRepasse::select( [
            '*',
            DB::raw( '( SELECT IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = TMP_REPASSE.IMB_CLT_ID) AS NOMELOCADOR')
        ])
        ->where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->orderBy('IMB_TBE_ID')->get();

        $ctr = mdlContrato::find( $idcontrato );
        $imovel = mdlImovel::find( $ctr->IMB_IMV_ID);
        $baseirrf = 0;
        $nvalorbaseiss=0;
        $irrflancado=0;
        $d13lancado = 0;
        foreach ($tmp as $item)
        {
            $valoritem = $item->IMB_LCF_VALOR;
            if( $item->IMB_LCF_LOCADORCREDEB == 'D')
              $valoritem = $valoritem * -1;

            if( $item->IMB_LCF_INCIRRF =='S' )
                $baseirrf = $baseirrf + $valoritem;

            if( $item->IMB_LCF_INCISS == 'S')
            {
                $nvalorbaseiss = $nvalorbaseiss + $valoritem;
            }

            if( $item->IMB_LCF_ID == 0  and  $item->IMB_TBE_ID == 18 )
                $this->itemDelete( $item->IMB_PAG_ID );

            if( $item->IMB_LCF_ID == 0  and  $item->IMB_TBE_ID == 57 )
                $this->itemDelete( $item->IMB_PAG_ID );
            
            if( $item->IMB_TBE_ID == 18 ) $irrflancado = $item->IMB_LCF_VALOR;

            if( $item->IMB_TBE_ID == 35 ) $d13lancado = $item->IMB_LCF_VALOR;

        }

        $isslancado = app('App\Http\Controllers\ctrRotinas')
                      ->verificarEventoLancado( $idcontrato, $datavencimento, 57);

        //Log::info( 'recalcular');
        //Log::info('iss lancado '.$isslancado);
        //dd( $nvalorbase1005, $nvalorbase1701 )          ;

        if( $isslancado == 0 )
        {
            ////Log::info( 'Acessando a rotina lancasr iss' );
            $this->lancarISS( $idcontrato, $idimovel, $datavencimento, $datapagamento,$nvalorbaseiss )          ;
        }    
        
//        $irrflancado = app('App\Http\Controllers\ctrRotinas')
                      //->verificarEventoLancado( $idcontrato, $datavencimento, 18 );

//        ////Log::info( "irrflancado $irrflancado     IMB_CTR_NUNCARETEIRRF ".$ctr->IMB_CTR_NUNCARETEIRRF);

        if( $irrflancado == 0 and $ctr->IMB_CTR_NUNCARETEIRRF <> 'S')
            $this->lancarIRRF( $idcontrato, $idimovel, $datavencimento, $datapagamento,$baseirrf );

        
        if( $d13lancado ==  0 and $imovel->IMB_IMV_13COBRAR == 'S')
            $this->lancar13( $idcontrato, $idimovel, $datavencimento, $datapagamento,$nvalorbaseiss );

        return $tmp;

    }

    public function lancarIRRF( $idcontrato, $idimovel, $datavencimento, $datapagamento,$baseirrf )
    {
//        ////Log::info( 'Ebntrou na lancarIRRF');

        $irrf=$valorirrf = app('App\Http\Controllers\ctrTabelaIRRF')
        ->calcularIRRF( $idcontrato, $baseirrf );




        foreach ($irrf as $irrfcal)
        {
//            ////Log::info( 'NO LACO');

            //Log::info( 'Gravando cliente tmp: '.$irrfcal['IMB_CLT_ID']);
            //Log::info( 'Gravando valor: '.$irrfcal['valorIRRF'] );

            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID                   = 18;
            $tmp->IMB_TBE_NOME            = 'I.R.R.F.';
            $tmp->IMB_LCF_LOCATARIOCREDEB      = 'C';
            $tmp->IMB_LCF_LOCADORCREDEB        = 'D';
            $tmp->IMB_LCF_VALOR                = $irrfcal['valorIRRF'];
            $tmp->IMB_LCF_OBSERVACAO           = 'retenção IRRF de '.
                                              $irrfcal['cliente'].' - CPF: '.
                                              $irrfcal['cpf'];
            $tmp->IMB_CLT_ID              = $irrfcal['IMB_CLT_ID'];
            $tmp->IMB_LCF_ID             = 0;
            $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                            ->pegarCFCPadrao( 18 );
            $tmp->save();
            //Log::info( 'VALORES SALVOS DE IRRF' );
            //////Log::info( 'VALOR: '. $tmp->IMB_LCF_VALOR  );
            //////Log::info( 'ID TMP: '. $tmp->IMB_PAG_ID  );
            
            
            //////Log::info( 'salvou irrf ma tabela');

        }

    }

    public function totalizarLancamentos()
    {
        $tmp =  mdlRepasse::where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->get();

        $total = 0;
        foreach ($tmp as $item)
        {
            $valor = $item->IMB_LCF_VALOR;
            if( $item->IMB_LCF_LOCADORCREDEB == 'D')
                $valor = $valor * -1;
            $total = $total + $valor;
            //////Log::info("Total $$total");
        }

        return response()->json( $total,200);

    }

    public function gravarTaxaAdm( $idcontrato, $datavencimento, $datapagamento, $valortaxa, $texto)
    {


        $ctr = mdlContrato::find( $idcontrato );
        $imv = mdlImovel::find( $ctr->IMB_IMV_ID);

        $texto = '';
        if( $ctr->IMB_CTR_TAXAADMINISTRATIVAFORMA == 'P') 
            $texto = "Percentual de Taxa Administrativa: ".$ctr->IMB_CTR_TAXAADMINISTRATIVA.'%';
        if( $ctr->IMB_CTR_TAXAADMINISTRATIVAFORMA == 'V') 
            $texto = 'Taxa administrativa fixada em Reais';


        $tmp = new mdlRepasse;
        $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
        $tmp->IMB_CTR_ID             = $idcontrato;
        $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
        $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
        $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
        $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
        $tmp->IMB_TBE_ID                   = 6;
        $tmp->IMB_TBE_NOME            = 'Taxa Administrativa';
        $tmp->IMB_LCF_LOCATARIOCREDEB      = 'N';
        $tmp->IMB_LCF_LOCADORCREDEB        = 'D';
        $tmp->IMB_LCF_VALOR                = $valortaxa;
        $tmp->IMB_LCF_OBSERVACAO           = $texto;
        $tmp->IMB_LCF_INCISS         = 'S';
        $tmp->IMB_CLT_ID              = 0;
        $tmp->IMB_LCF_ID             = 0;
        $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                        ->pegarCFCPadrao( 6 );
        $tmp->save();


    }

    public function cobraItemTaxaDiferente( $idcontrato, $idimovel, $datavencimento, $datapagamento )
    {

        $tmp =  mdlRepasse::where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->get();

        $taxaitens = 0;
        foreach ($tmp as $item)
        {
            $td = mdlContratoTaxDif::where( 'IMB_CTR_ID','=',$idcontrato  )
                    ->where('IMB_TBE_ID','=',$item->IMB_TBE_ID )
                    ->get();


            if( !$td->isEmpty() )
            {

                $valor = $item->IMB_LCF_VALOR;

                $taxaitens = $taxaitens + ( $valor * $td[0]->IMB_CTD_PERCENTUAL /100 );
            }
        }

        if( $taxaitens <> 0 )
        {
            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID                   = 6;
            $tmp->IMB_TBE_NOME            = 'TAXA ADMINISTRATIVA';
            $tmp->IMB_LCF_LOCATARIOCREDEB      = 'N';
            $tmp->IMB_LCF_LOCADORCREDEB        = 'D';
            $tmp->IMB_LCF_VALOR                = $taxaitens;
            $tmp->IMB_CLT_ID              = 0;
            $tmp->IMB_LCF_INCISS         = 'S';
            $tmp->IMB_LCF_OBSERVACAO             = 'Taxa Adm. Sobre Outros Ítens';
            $tmp->IMB_LCF_ID             = 0;
            $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                            ->pegarCFCPadrao( 6 );
            $tmp->save();

        }
        return 'ok';

    }

    public function destacarIPTUAdministracao( $idcontrato, $datavencimento )
    {

        $ctr = mdlContrato::find( $idcontrato );

        $par = mdlParametros2::find( Auth::user()->IMB_IMB_ID );
//        dd( $par );

        $destacarIPTU = 'S';
        if( $par->IMB_PRM_NAODESTACARTA_IPTU == 'S' )
          $destacarIPTU = 'N';

        $lcf='';
        if( $destacarIPTU == 'S')
        {
            $lcf = mdlLancamentoFuturo::whereIn( 'IMB_TBE_ID', [ 12, 32 ] )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID  )
            ->where( 'IMB_LCF_DATAVENCIMENTO','=',$datavencimento )
            ->where( 'IMB_CTR_ID','=', $idcontrato )
            ->where( 'IMB_LCF_LOCADORCREDEB','=','N')
            ->where( 'IMB_LCF_LOCATARIOCREDEB','=','D')
            ->where( 'IMB_LCF_INCTAX','=','S')
            ->sum( 'IMB_LCF_VALOR');
        }

        return $lcf;



    }

    public function calcularTaxaPadraoContrato( $idcontrato, $baseTaxaAdministrativa, $comagregado )
    {

        $ctr = mdlContrato::find( $idcontrato );
        $imv = mdlImovel::find( $ctr->IMB_IMV_ID);

        if( $ctr->IMB_CTR_TAXAADMINISTRATIVAFORMA == 'P' )
        {
            $agregado = $imv->imb_imv_aluguelagregar;
            if ( $agregado == '') $agregado = 0;

            if( $comagregado <> 'S' )
              $agregado = 0;

            $valortaxa = $agregado + ( ( $baseTaxaAdministrativa - $agregado ) * $ctr->IMB_CTR_TAXAADMINISTRATIVA / 100);

            if( $agregado == '0')
                $ctexto = $ctr->IMB_CTR_TAXAADMINISTRATIVA.'%';
        }
        else
            $valortaxa = $ctr->IMB_CTR_TAXAADMINISTRATIVA;


        return $valortaxa;

    }

    public function itemDelete( $id)
    {

        $pg = mdlRepasse::find( $id );
        if( $pg->IMB_LCF_ID <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $pg->IMB_LCF_ID );
            if( $lf )
            {
                $ctr = mdlContrato::find( $lf->IMB_CTR_ID );
//                Log::info( "ctr->IMB_CTR_DIAVENCIMENTO $ctr->IMB_CTR_DIAVENCIMENTO");
                //Log::info( "lf->IMB_LCF_DATAVENCIMENTO $lf->IMB_LCF_DATAVENCIMENTO");
                $lf->IMB_LCF_DATAVENCIMENTO =  app('App\Http\Controllers\ctrRotinas')
                    ->addMeses( $ctr->IMB_CTR_DIAVENCIMENTO,  1,$lf->IMB_LCF_DATAVENCIMENTO );
                $lf->save();
//                Log::info('salvo!');
            }
        }

        $pg->delete();
        
        //Log::info( 'id lf: '.$pg->IMB_LCF_ID);
        return response()->json('ok',200);
    }


    public function calcularISS( $idcontrato, $nvalorbaseiss )
    {

        if( $nvalorbaseiss == 0 )
        return [];
        
            $nvalorbaseiss = abs($nvalorbaseiss);

        //////Log::info('entrando na rotina calculariss');
        ////Log::info( "nvalorbaseiss - $nvalorbaseiss");

        $calculados = array();
        $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );
        $par = mdlParametros::find(  Auth::user()->IMB_IMB_ID );
        $imob = mdlImobiliaria::find(  Auth::user()->IMB_IMB_ID );
        $ctr = mdlContrato::find( $idcontrato );
//        Log::info('nao calcular'.$ctr->imb_ctr_naoemitirnfe);
        if( $ctr->imb_ctr_naoemitirnfe == 'S')
            return [];

        

//        dd( 'pessoa: '.$imob->IMB_IMB_PESSOA.' - respeitar: '.$par2->imb_prm_ISSRESPEITARUSUARIO
        //.' - caliss: '.$ctr->IMB_CTR_CALISS);

        $cidadeimobiliaria = strtoupper($imob->CEP_CID_NOME);

        $aliquota = 0;
        if( intval($par->IMB_PRM_ISSALIQUOTA) <> 0 ) $aliquota = $par->IMB_PRM_ISSALIQUOTA;
        if( intval($par->IMB_PRM_ISSALIQUOTA1005) <> 0 ) $aliquota = $par->IMB_PRM_ISSALIQUOTA1005;


        
        if( $aliquota == 0 )
            return [];

        $calcular = 'S';
        //Log::info('calcular');

        ////Log::info( "imob->IMB_IMB_PESSOA: $imob->IMB_IMB_PESSOA ");
        if( $imob->IMB_IMB_PESSOA <> 'J' )
            return [];

        if( $par2->imb_prm_ISSRESPEITARUSUARIO == 'S'and $ctr->IMB_CTR_CALISS <> 'S' )
            return [];

        $idimovel = $ctr->IMB_IMV_ID;
        $propimo = mdlPropImovel::where( 'IMB_IMV_ID','=', $idimovel)->get();
        foreach( $propimo as $prop)
        {
            $base = $nvalorbaseiss * $prop->IMB_IMVCLT_PERCENTUAL4 /100;

            $cliente = mdlCliente::find( $prop->IMB_CLT_ID );
            if( $cliente )
            {
                if( $cliente->IMB_CLT_PESSOA == 'J'
                    and $cliente->IMB_CLT_MEI <> 'S'
                    and ( strtoupper($cliente->CEP_CID_NOMERES) ) == $cidadeimobiliaria )
                {

                        $valorcalculado = ($base * $aliquota / 100);
                        array_push($calculados, ['IMB_CLT_ID' => $prop->IMB_CLT_ID,
                                            'cliente' => $cliente->IMB_CLT_NOME,
                                            'descricao' => '-',
                                            'valorbase' => $base,
                                            'valorISS' => round($valorcalculado,2),
                                            'evento' => 57 ]);
                }
            }
        }
        return $calculados;
    }

    public function lancarISS( $idcontrato, $idimovel, $datavencimento, $datapagamento,$nvalorbaseiss )
    {
//        Log::info( 'lancar iss. valor base '.$nvalorbaseiss);


        $iss=$this->calcularISS( $idcontrato, $nvalorbaseiss );

        foreach ($iss as $i)
        {

            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID                   = 57;
            $tmp->IMB_TBE_NOME            = 'I.S.S.';
            $tmp->IMB_LCF_LOCATARIOCREDEB      = 'N';
            $tmp->IMB_LCF_LOCADORCREDEB        = 'C';
            $tmp->IMB_LCF_VALOR                = abs( $i['valorISS'] );
            $tmp->IMB_LCF_OBSERVACAO           = 'Retenção de I.S.S.';
            $tmp->IMB_CLT_ID              = $i['IMB_CLT_ID'];
            $tmp->IMB_LCF_ID             = 0;
            $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                            ->pegarCFCPadrao( 57 );
            $tmp->save();
        }
    }


    public function previsaoRepasseJaRecebido( Request $request )
    {

        
        $tr = mdlTmpPrevisaoRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->delete();


        $datainicio =$request->inicio;

        $datatermino =$request->termino;

        $titulo1 = $request->titulo1;
        $titulo2 = $request->titulo2;
        $titulo3 = $request->titulo3;
        $ordem = "data";
        if( $request->ordem == 'nome' )
           $ordem="nome";

        $idcliente = $request->idcliente;
        $gerardatatable = $request->gerardatatable;


        //////Log::info('entrou');
        //dd( $datainicio.' '.$datatermino);

        $lfa = DB::table('IMB_LANCAMENTOFUTURO')->distinct()->orderBy('IMB_CTR_ID')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_LCF_LOCADORCREDEB','<>','N')
        ->where( 'IMB_LCF_DATARECEBIMENTO','>=', $datainicio )
        ->where( 'IMB_LCF_DATARECEBIMENTO','<=', $datatermino )
        ->whereNotNull( 'IMB_CTR_ID')
        ->where('IMB_CTR_ID','<>',0)
        ->whereNull( 'IMB_LCF_DATAPAGAMENTO')
        ->get( ['IMB_CTR_ID','IMB_LCF_DATAVENCIMENTO'] );

        if(count($lfa) == 0)
            return response()->json( 'Nenhum contrato com aluguel garantido encontrado!',500);

        //Log::info( 'entrar no laco');
        foreach( $lfa as $lf)
        {
            $ctr = mdlContrato::find( $lf->IMB_CTR_ID);

            ////Log::info('acessar o calcular repasse');
            $tmp = $this->calcularRepasse( $lf->IMB_CTR_ID,
            $lf->IMB_LCF_DATAVENCIMENTO,
            $lf->IMB_LCF_DATAVENCIMENTO,
            'S' );
            ////Log::info('saiu do calcular repa');

            $this->recalcularRepasse(
                $ctr->IMB_CTR_ID,
                $ctr->IMB_IMV_ID,
                $lf->IMB_LCF_DATAVENCIMENTO,
                $lf->IMB_LCF_DATAVENCIMENTO);

            $locatario = app('App\Http\Controllers\ctrRotinas')
                        ->nomeLocatarioPrincipal( $lf->IMB_CTR_ID );

            $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                        ->codigoLocatarioPrincipal( $lf->IMB_CTR_ID  );

            $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                        ->imovelEndereco( $ctr->IMB_IMV_ID );

            $locatario =  app('App\Http\Controllers\ctrRotinas')
                        ->clienteDadosFull( $idlocatario );

            $imovel =   app('App\Http\Controllers\ctrImovel')
                        ->carga( $ctr->IMB_IMV_ID );

            $diasrepasse = $ctr->IMB_CTR_REPASSEDIA;
            $diafixo = $ctr->IMB_CTR_REPASSEDIAFIXO;
            if( $diafixo > 0 )
            {
                $datarepasse = $ctr->IMB_CTR_PROXIMOREPASSE;
            }
            else
            if( $diasrepasse )
            {
                if( $diasrepasse  > 0 )
                {
                    $datarepasse = date( 'Y/m/d', strtotime($lf->IMB_LCF_DATAVENCIMENTO. ' + '.$diasrepasse.' days')) ;
                }
            }
            else
            {
                $datarepasse=$lf->IMB_LCF_DATAVENCIMENTO;
                $diasrepasse = 0;
            }

            if( $tmp <> '[]' )
            {
                foreach( $tmp as $c )
                {

                    $ppi = mdlPropImovel::
                    where( 'IMB_IMV_ID','=', $ctr->IMB_IMV_ID)
                    ->get();


                    foreach( $ppi as $prop )
                    {

                        $tr = new mdlTmpPrevisaoRepasse;
                        $tr->IMB_IMV_ID = $ctr->IMB_IMV_ID;
                        $tr->IMB_CTR_ID = $ctr->IMB_CTR_ID;
                        $tr->IMB_CTR_REFERENCIA = $ctr->IMB_CTR_REFERENCIA;
        //                $tr->IMB_LCF_ID = $c->IMB_LCF_ID;
                        $tr->IMB_IMB_ID  = Auth::user()->IMB_IMB_ID;
                        $tr->IMB_ATD_ID  = Auth::user()->IMB_ATD_ID;
                        $tr->ENDERECOCOMPLETO = $imovelendereco;
                        $tr->CEP_BAI_NOME = $imovel->CEP_BAI_NOME;
                        $tr->CEP_CID_NOME =  $imovel->IMB_IMV_CIDADE;
                        $tr->CEP_UF_SIGLA =  $imovel->IMB_IMV_ESTADO;
                        $tr->IMB_IMV_CEP = $imovel->IMB_IMV_CEP;;
                        $tr->IMB_CLT_IDLOCADOR = $prop->IMB_CLT_ID;
                        $tr->IMB_CLT_IDLOCATARIO = $idlocatario;                        
                        $tr->IMB_CLT_NOMELOCADOR = substr(app('App\Http\Controllers\ctrCliente')
                                ->pegarNomeCliente( $prop->IMB_CLT_ID ),0,40);
                        $tr->IMB_CLT_NOMELOCATARIO = substr($locatario->IMB_CLT_NOME,0,40);
                        $tr->IMB_CLT_NOMELOCATARIO = $locatario->IMB_CLT_NOME;
                        $tr->IMB_LCF_DATAVENCIMENTO = $c->IMB_PAG_DATAVENCIMENTO;
                        $tr->IMB_LCF_DATAPAGAMENTO = $c->IMB_PAG_DATAPAGAMENTO;
                        $tr->DATAPREVISAOPAGAMENTO = $datarepasse;

                        $tr->IMB_CTR_VENCIMENTOLOCADOR = $c->IMB_PAG_DATAVENCIMENTO;
                        $tr->IMB_CTR_VENCIMENTOLOCATARIO = $c->IMB_PAG_DATAVENCIMENTO;
                        $tr->IMB_CTR_REPASSEDIA = $diasrepasse;
                        $tr->IMB_TBE_ID = $c->IMB_TBE_ID;
                        $tr->IMB_TBE_NOME = $c->IMB_TBE_NOME;
                        $tr->IMB_TBE_ID = $c->IMB_TBE_ID;
                        $tr->IMB_LCF_OBSERVACAO = $c->IMB_LCF_OBSERVACAO;
                        if( $c->IMB_CLT_ID <> '0' and $c->IMB_CLT_ID <> '' )
                        {
                            if( $prop->IMB_CLT_ID == $c->IMB_CLT_ID )
                                $tr->IMB_LCF_VALOR = $c->IMB_LCF_VALOR;
                            else
                            {
                                $tr->IMB_LCF_VALOR = 0;
                                $tr->IMB_LCF_OBSERVACAO = '';
                            }
                        }
                        else

                        $tr->IMB_LCF_VALOR = $c->IMB_LCF_VALOR * $prop->IMB_IMVCLT_PERCENTUAL4 / 100;

                        $tr->IMB_LCF_LOCADORCREDEB = $c->IMB_LCF_LOCADORCREDEB;
                        $tr->IMB_LCF_LOCATARIOCREDEB = $c->IMB_LCF_LOCATARIOCREDEB;
                        $tr->GER_BNC_NOME = app('App\Http\Controllers\ctrRedeBancaria')
                                            ->nomeBanco( $prop->GER_BNC_NUMERO );
                        $tr->GER_BNC_NUMERO = $prop->GER_BNC_NUMERO;
                        $tr->GER_BNC_AGENCIA = $prop->GER_BNC_AGENCIA;
                        $tr->IMB_CLTCCR_NUMERO = $prop->IMB_CLTCCR_NUMERO;
                        $tr->IMB_CLTCCR_DV = $prop->IMB_CLTCCR_DV;
                        $tr->IMB_CLTCCR_NOME = $prop->IMB_CLTCCR_NOME;
                        $tr->IMB_CLTCCR_CPF = $prop->IMB_CLTCCR_CPF;
                        $tr->IMB_CLTCCR_PESSOA = $prop->IMB_CLTCCR_PESSOA;
                        $tr->IMB_CLTCCR_DOC = $prop->IMB_CLTCCR_DOC;
                        $tr->IMB_CLTCCR_POUPANCA = $prop->IMB_CLTCCR_POUPANCA;
                        $tr->IMB_BNC_AGENCIADV = $prop->IMB_BNC_AGENCIADV;
                        $tr->IMB_IMV_CHEQUENOMINAL = $prop->IMB_IMV_CHEQUENOMINAL;
                        $tr->IMB_FORPAG_ID = $prop->IMB_FORPAG_ID;
                        $tr->IMB_FORPAG_NOME = app('App\Http\Controllers\ctrFormaPagamento')
                                                ->pegarForma( $prop->IMB_FORPAG_ID );
                        $tr->IMB_IMVCLT_PIX = $prop->IMB_IMVCLT_PIX;
                        $tr->IMB_FORPAG_CONTACORRENTE =app('App\Http\Controllers\ctrFormaPagamento')
                                                    ->formaehcontacorrente( $prop->IMB_FORPAG_ID );
                        $tr->TMP_PVR_TITULO1 = $titulo1;
                        $tr->TMP_PVR_TITULO2 = $titulo2;
                        $tr->TMP_PVR_TITULO3 = $titulo3;
                        $tr->save();
                    }

                }
            }

        }

        $tr = mdlTmpPrevisaoRepasse::
        where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->orderBy('IMB_CTR_ID');


        if( $idcliente <> '')
        {
            $tr = $tr->where( 'IMB_CLT_IDLOCADOR','<>', $idcliente )->delete();
            return response()->json($tr,200);
        }
    
        $tr = $tr->get();

        return $tr;



    }


    public function previsaoBaseGerada( $idcliente )
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID);

        if( $idcliente <> 0 )
            $dados =  $dados->where( 'IMB_CLT_IDLOCADOR','=', $idcliente );

        
        $dados =  $dados->orderBy('IMB_CLT_NOMELOCADOR')
        ->orderBy('IMB_CLT_IDLOCADOR')
        ->orderBy('IMB_CTR_ID')
        ->orderBy('IMB_LCF_DATAVENCIMENTO')
        ->get(['IMB_CLT_NOMELOCADOR','IMB_CLT_IDLOCADOR','IMB_CTR_ID',
                'IMB_LCF_DATAVENCIMENTO','TMP_PVR_TITULO1',
                'TMP_PVR_TITULO2','TMP_PVR_TITULO3',
            'ENDERECOCOMPLETO']);

        
        return  $dados;


    }

    public function previsaoBaseGeradaLocadores( $idcliente )
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID);

        if( $idcliente <> 0 )
            $dados =  $dados->where( 'IMB_CLT_IDLOCADOR','=', $idcliente );

        
        $dados =  $dados
        ->orderBy( 'IMB_FORPAG_NOME')
        ->orderBy('IMB_CLT_NOMELOCADOR')
        ->orderBy('IMB_CLT_IDLOCADOR')
        ->get(['IMB_CLT_NOMELOCADOR','IMB_CLT_IDLOCADOR']);

        
        return  $dados;


    }


    public function previsaoBaseGeradaImoveisLocador( $idcliente )
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID);
        
        $dados =  $dados->where( 'IMB_CLT_IDLOCADOR','=', $idcliente );

        
        $dados =  $dados->orderBy('IMB_FORPAG_NOME')
                ->get(['IMB_FORPAG_NOME', 'ENDERECOCOMPLETO','IMB_CTR_ID','IMB_IMV_ID', 'IMB_CTR_REFERENCIA', 'IMB_LCF_DATAVENCIMENTO','DATAPREVISAOPAGAMENTO']);

        
        return  $dados;


    }


    public function previsaoBaseGeradaImovelLocadorVencto( $idcliente, $idcontrato, $vencimento )
    {

        $dados = mdlTmpPrevisaoRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID);
        
        $dados =  
            $dados->where( 'IMB_CLT_IDLOCADOR','=', $idcliente )
            ->where( 'IMB_CTR_ID','=', $idcontrato )
            ->where( 'IMB_LCF_DATAVENCIMENTO','=', $vencimento );            

        
        $dados =  $dados->orderBy('IMB_TBE_ID')->get();

        
        return  $dados;


    }



    public function relPrevisaoView( $idcliente)
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID);

        if( $idcliente <> 0 )
            $dados =  $dados->where( 'IMB_CLT_IDLOCADOR','=', $idcliente );


        
            $dados =  $dados->orderBy('IMB_CLT_NOMELOCADOR')
        ->orderBy('IMB_CLT_IDLOCADOR')
        ->orderBy('IMB_CTR_ID')
        ->orderBy('IMB_LCF_DATAVENCIMENTO');

        $dados =  $dados->get(['IMB_CLT_NOMELOCADOR','IMB_CLT_IDLOCADOR','IMB_CTR_ID',
                'IMB_LCF_DATAVENCIMENTO','TMP_PVR_TITULO1',
                'TMP_PVR_TITULO2','TMP_PVR_TITULO3',
            'ENDERECOCOMPLETO']);

        return view('reports.admimoveis.relprevisaorepasse', compact('dados', 'idcliente') );



        $pdf=PDF::loadView('reports.admimoveis.relprevisaorepasse', compact('dados'));;
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('previsaorepasse.pdf');




    }

    public function detalhePrevisao( $idcliente, $idcontrato, $vencimento )
    {
        $tr = mdlTmpPrevisaoRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->where('IMB_CLT_IDLOCADOR','=', $idcliente )
        ->where('IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_LCF_DATAVENCIMENTO','=', $vencimento )
        ->orderBy('IMB_TBE_ID')
        ->get();

        return $tr;


    }

    public function previsaoGarantidos( Request $request )
    {
        $tr = mdlTmpPrevisaoRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->delete();

        $datainicio = $request->inicio;

        $datatermino = $request->termino;

        $titulo1 = $request->titulo1;
        $titulo2 = $request->titulo2;
        $titulo3 = $request->titulo3;
        $idcliente= $request->idcliente;
        $gerardatatable = $request->gerardatatable;
        $ordem = "data";
        if( $request->ordem == 'nome' )
           $ordem="nome";


       ////// //////Log::info( "previsão de repasse");

       $garantidos = mdlContrato::select(
        [
            'IMB_CONTRATO.*',
            DB::raw( '( SELECT DATAPROXIMOREPASSE( IMB_CONTRATO.IMB_CTR_ID ) ) AS PROXIMOREPASSE ')
        ]
        )
    
        ->where( 'IMB_CTR_ALUGUELGARANTIDO','=','S' )
        ->where('IMB_CTR_SITUACAO','=', 'ATIVO' )
        ->whereRaw(" DATAPROXIMOREPASSE( IMB_CONTRATO.IMB_CTR_ID ) between '$datainicio' and '$datatermino'")        
        ->orderBy( 'IMB_CTR_ID')
//        ->toSql();
        ->get();

        if(count($garantidos) == 0)
            return response()->json( 'Nenhum contrato com aluguel garantido encontrado!',500);



       ////// //////Log::info( 'entrando no loop');
        foreach( $garantidos as $garantido )
        {
           ////// //////Log::info( 'looping').


            $cont = '1';

            if( $cont == '1' and $garantido->IMB_CTR_ID <> '' )
            {
                $datavencimento = $garantido->IMB_CTR_VENCIMENTOLOCADOR;
                $tmp = $this->calcularRepasse( $garantido->IMB_CTR_ID, $datavencimento,  $datavencimento, 'S' );
                $this->recalcularRepasse(
                    $garantido->IMB_CTR_ID,
                    $garantido->IMB_IMV_ID,
                    $datavencimento,
                    $datavencimento);


                $locatario = app('App\Http\Controllers\ctrRotinas')
                            ->nomeLocatarioPrincipal( $garantido->IMB_CTR_ID );

                $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                            ->codigoLocatarioPrincipal( $garantido->IMB_CTR_ID  );

//                Log::info( 'id locatario: contrato: '. $garantido->IMB_CTR_ID.' -> '.$idlocatario );
                $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                            ->imovelEndereco( $garantido->IMB_IMV_ID );

                $locatario =  app('App\Http\Controllers\ctrRotinas')
                            ->clienteDadosFull( $idlocatario );

                $imovel =   app('App\Http\Controllers\ctrImovel')
                            ->carga( $garantido->IMB_IMV_ID );


                if( $tmp <> '[]' )
                {
                    foreach( $tmp as $c )
                    {

                        $ppi = mdlPropImovel::
                        where( 'IMB_IMV_ID','=', $garantido->IMB_IMV_ID)
                        ->get();

                        foreach( $ppi as $prop )
                        {

                            $tr = new mdlTmpPrevisaoRepasse;
                            $tr->IMB_IMV_ID = $garantido->IMB_IMV_ID;
                            $tr->IMB_CTR_ID = $garantido->IMB_CTR_ID;
                            if( $garantido->IMB_CTR_REFERENCIA )
                                $tr->IMB_CTR_REFERENCIA = $garantido->IMB_CTR_REFERENCIA;
                            else
                                $tr->IMB_CTR_REFERENCIA = $garantido->IMB_IMV_ID;

                            $tr->IMB_CTR_ALUGUELGARANTIDO = $garantido->IMB_CTR_ALUGUELGARANTIDO;
                            $tr->IMB_IMB_ID  = Auth::user()->IMB_IMB_ID;
                            $tr->IMB_ATD_ID  = Auth::user()->IMB_ATD_ID;
                            $tr->ENDERECOCOMPLETO = $imovelendereco;
                            $tr->CEP_BAI_NOME = $imovel->CEP_BAI_NOME;
                            $tr->CEP_CID_NOME =  $imovel->IMB_IMV_CIDADE;
                            $tr->CEP_UF_SIGLA =  $imovel->IMB_IMV_ESTADO;
                            $tr->IMB_IMV_CEP = $imovel->IMB_IMV_CEP;;
                            $tr->IMB_CLT_IDLOCADOR = $prop->IMB_CLT_ID;
                            $tr->IMB_CLT_IDLOCATARIO = $idlocatario;
                            $tr->IMB_CTR_VENCIMENTOLOCADOR = $datavencimento;
                            $tr->IMB_CTR_VENCIMENTOLOCATARIO = $garantido->IMB_CTR_VENCIMENTOLOCATARIO;

                            $tr->IMB_CLT_NOMELOCADOR = substr(app('App\Http\Controllers\ctrCliente')
                            ->pegarNomeCliente( $prop->IMB_CLT_ID ),0,40);
                            $tr->IMB_CLT_NOMELOCATARIO = substr($locatario->IMB_CLT_NOME,0,40);
                            $tr->IMB_LCF_DATAVENCIMENTO = $c->IMB_PAG_DATAVENCIMENTO;
                            $tr->IMB_LCF_DATAPAGAMENTO = $garantido->PROXIMOREPASSE ;
                            $tr->DATAPREVISAOPAGAMENTO = $garantido->PROXIMOREPASSE ;

                            $tr->IMB_CTR_REPASSEDIA = $garantido->IMB_CTR_REPASSEDIA ;
                            $tr->IMB_TBE_ID = $c->IMB_TBE_ID;
                            $tr->IMB_TBE_NOME = $c->IMB_TBE_NOME;
                            $tr->IMB_LCF_OBSERVACAO = $c->IMB_LCF_OBSERVACAO;
                            if( $c->IMB_CLT_ID <> '0' and $c->IMB_CLT_ID <> '' )
                            {
                                if( $prop->IMB_CLT_ID == $c->IMB_CLT_ID )
                                    $tr->IMB_LCF_VALOR = $c->IMB_LCF_VALOR;
                                else
                                {
                                    $tr->IMB_LCF_VALOR = 0;
                                    $tr->IMB_LCF_OBSERVACAO = '';
                                }
                            }
                            else

                            $tr->IMB_LCF_VALOR = $c->IMB_LCF_VALOR * $prop->IMB_IMVCLT_PERCENTUAL4 / 100;

                            $tr->IMB_LCF_LOCADORCREDEB = $c->IMB_LCF_LOCADORCREDEB;
                            $tr->IMB_LCF_LOCATARIOCREDEB = $c->IMB_LCF_LOCATARIOCREDEB;
                            $tr->GER_BNC_NOME = app('App\Http\Controllers\ctrRedeBancaria')
                                                ->nomeBanco( $prop->GER_BNC_NUMERO );
                            $tr->GER_BNC_NUMERO = $prop->GER_BNC_NUMERO;
                            $tr->GER_BNC_AGENCIA = $prop->GER_BNC_AGENCIA;
                            $tr->IMB_CLTCCR_NUMERO = $prop->IMB_CLTCCR_NUMERO;
                            $tr->IMB_CLTCCR_DV = $prop->IMB_CLTCCR_DV;
                            $tr->IMB_CLTCCR_NOME = $prop->IMB_CLTCCR_NOME;
                            $tr->IMB_CLTCCR_CPF = $prop->IMB_CLTCCR_CPF;
                            $tr->IMB_CLTCCR_PESSOA = $prop->IMB_CLTCCR_PESSOA;
                            $tr->IMB_CLTCCR_DOC = $prop->IMB_CLTCCR_DOC;
                            $tr->IMB_CLTCCR_POUPANCA = $prop->IMB_CLTCCR_POUPANCA;
                            $tr->IMB_BNC_AGENCIADV = $prop->IMB_BNC_AGENCIADV;
                            $tr->IMB_IMV_CHEQUENOMINAL = $prop->IMB_IMV_CHEQUENOMINAL;
                            $tr->IMB_FORPAG_ID = $prop->IMB_FORPAG_ID;
                            $tr->IMB_FORPAG_NOME = app('App\Http\Controllers\ctrFormaPagamento')
                                                    ->pegarForma( $prop->IMB_FORPAG_ID );
                            $tr->IMB_IMVCLT_PIX = $prop->IMB_IMVCLT_PIX;
                            $tr->IMB_FORPAG_CONTACORRENTE =app('App\Http\Controllers\ctrFormaPagamento')
                                                        ->formaehcontacorrente( $prop->IMB_FORPAG_ID );
                            $tr->TMP_PVR_TITULO1 = $titulo1;
                            $tr->TMP_PVR_TITULO2 = $titulo2;
                            $tr->TMP_PVR_TITULO3 = $titulo3;
                            $tr->save();
                        }

                    }
                }


            }
        }

        $tr = mdlTmpPrevisaoRepasse::
        where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->orderBy('IMB_CTR_ID');

/*
        if( $ordem == 'data')
        
            $tr = $tr->orderBy( 'DATAPREVISAOPAGAMENTO')
            ->orderBy( 'IMB_CLT_NOMELOCADOR');
        else
        if( $ordem=='nome')
            $tr = $tr->orderBy( 'IMB_CLT_NOMELOCADOR');


        if( $idcliente <> '')
        {
            $tr = $tr->where( 'IMB_CLT_IDLOCADOR','<>', $idcliente )->delete();
            return response()->json($tr,200);
        }
*/
    
        $tr = $tr->get();

        return response()->json($tr,200);



    }

    public function previsaoTodos( Request $request )
    {
        $tr = mdlTmpPrevisaoRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->delete();

        $datainicio = $request->inicio;


        $datatermino =$request->termino;

        $ordem = "data";
        if( $request->ordem == 'nome' )
           $ordem="nome";

        $titulo1 = $request->titulo1;
        $titulo2 = $request->titulo2;
        $titulo3 = $request->titulo3;
        $gerardatatable = $request->gerardatatable;
        $idcliente= $request->idcliente;
         
        $garantidos = mdlContrato::select(
            [
                'IMB_CONTRATO.*',
                DB::raw( '( SELECT DATAPROXIMOREPASSE( IMB_CONTRATO.IMB_CTR_ID ) ) AS PROXIMOREPASSE ')
            ]
        )
        ->where('IMB_CTR_SITUACAO','=', 'ATIVO' )
        ->whereRaw(" DATAPROXIMOREPASSE( IMB_CONTRATO.IMB_CTR_ID ) between '$datainicio' and '$datatermino'")
        ->orderBy( 'IMB_CTR_ID');
      //  dd( $garantidos->toSql());

        $garantidos = $garantidos->get();


        if(count($garantidos) == 0)
            return response()->json( 'Nenhum contrato !',500);

           ////// //////Log::info( $datainicio );
            
        
            
           foreach( $garantidos as $garantido )
        {

            $cont = '1';

            //////Log::info( "Contrato: ".$garantido->IMB_CTR_ID );
            //////Log::info( "Dia vencto: ".$garantido->IMB_CTR_DIAVENCIMENTO );
            

            $datavencimento = $garantido->IMB_CTR_VENCIMENTOLOCADOR;
            $anoinicio = substr( $datainicio,0,4);
            $mesinicio = substr( $datainicio,5,2);
            if( $garantido->IMB_CTR_REPASSEDIAFIXO > 0 )
                $diafixoounormal = str_pad($garantido->IMB_CTR_REPASSEDIAFIXO,2,"0",STR_PAD_LEFT);
            else
            $diafixoounormal = str_pad($garantido->IMB_CTR_DIAVENCIMENTO,2,"0",STR_PAD_LEFT);
            $ultimodia = app('App\Http\Controllers\ctrRotinas')
                        ->ultimoDiaMes($mesinicio,  $anoinicio );
            
            $dia = str_pad($garantido->IMB_CTR_DIAVENCIMENTO,2,"0",STR_PAD_LEFT);


            //////Log::info( "Cont $cont");
            if( $cont == '1')
            {
                $tmp = $this->calcularRepasse( $garantido->IMB_CTR_ID, $datavencimento,  $datavencimento, 'S' );
                $this->recalcularRepasse(
                    $garantido->IMB_CTR_ID,
                    $garantido->IMB_IMV_ID,
                    $datavencimento,
                    $datavencimento);



                $locatario = app('App\Http\Controllers\ctrRotinas')
                            ->nomeLocatarioPrincipal( $garantido->IMB_CTR_ID );

                $idlocatario =  app('App\Http\Controllers\ctrRotinas')
                            ->codigoLocatarioPrincipal( $garantido->IMB_CTR_ID  );

                $imovelendereco = app('App\Http\Controllers\ctrRotinas')
                            ->imovelEndereco( $garantido->IMB_IMV_ID );

                $locatario =  app('App\Http\Controllers\ctrRotinas')
                            ->clienteDadosFull( $idlocatario );

                $imovel =   app('App\Http\Controllers\ctrImovel')
                            ->carga( $garantido->IMB_IMV_ID );



                if( $tmp <> '[]' )
                {

                    foreach( $tmp as $c )
                    {

                        $ppi = mdlPropImovel::
                        where( 'IMB_IMV_ID','=', $garantido->IMB_IMV_ID)
                        ->get();

                        foreach( $ppi as $prop )
                        {

                            if( $c->IMB_CTR_ID <> null  )
                            {
                                $tr = new mdlTmpPrevisaoRepasse;
                                $tr->IMB_IMV_ID = $garantido->IMB_IMV_ID;
                                $tr->IMB_CTR_ID = $c->IMB_CTR_ID;
                                if( $garantido->IMB_CTR_REFERENCIA )
                                    $tr->IMB_CTR_REFERENCIA = $garantido->IMB_CTR_REFERENCIA;
                                else
                                    $tr->IMB_CTR_REFERENCIA = $garantido->IMB_IMV_ID;

                                $tr->IMB_CTR_ALUGUELGARANTIDO = $garantido->IMB_CTR_ALUGUELGARANTIDO;
                                $tr->IMB_IMB_ID  = Auth::user()->IMB_IMB_ID;
                                $tr->IMB_ATD_ID  = Auth::user()->IMB_ATD_ID;
                                $tr->ENDERECOCOMPLETO = $imovelendereco;
                                $tr->CEP_BAI_NOME = $imovel->CEP_BAI_NOME;
                                $tr->CEP_CID_NOME =  $imovel->IMB_IMV_CIDADE;
                                $tr->CEP_UF_SIGLA =  $imovel->IMB_IMV_ESTADO;
                                $tr->IMB_IMV_CEP = $imovel->IMB_IMV_CEP;;
                                $tr->IMB_CLT_IDLOCADOR = $prop->IMB_CLT_ID;
                                $tr->IMB_CLT_IDLOCATARIO = $idlocatario;
                                $tr->IMB_CTR_VENCIMENTOLOCADOR = $datavencimento;
                                $tr->IMB_CTR_VENCIMENTOLOCATARIO = $garantido->IMB_CTR_VENCIMENTOLOCATARIO;

                                $tr->IMB_CLT_NOMELOCADOR = substr(app('App\Http\Controllers\ctrCliente')
                                                        ->pegarNomeCliente( $prop->IMB_CLT_ID ),0,40);
                                $tr->IMB_CLT_NOMELOCATARIO = substr($locatario->IMB_CLT_NOME,0,40);
                                $tr->IMB_LCF_DATAVENCIMENTO = $c->IMB_PAG_DATAVENCIMENTO;
                                $tr->IMB_LCF_DATAPAGAMENTO = $garantido->PROXIMOREPASSE;
                                $tr->DATAPREVISAOPAGAMENTO = $garantido->PROXIMOREPASSE;

                                $tr->IMB_CTR_REPASSEDIA = $garantido->IMB_CTR_REPASSEDIA;
                                $tr->IMB_TBE_ID = $c->IMB_TBE_ID;
                                $tr->IMB_TBE_NOME = $c->IMB_TBE_NOME;
                                $tr->IMB_LCF_OBSERVACAO = $c->IMB_LCF_OBSERVACAO;
                                if( $c->IMB_CLT_ID <> '0' and $c->IMB_CLT_ID <> '' )
                                {
                                    if( $prop->IMB_CLT_ID == $c->IMB_CLT_ID )
                                        $tr->IMB_LCF_VALOR = $c->IMB_LCF_VALOR;
                                    else
                                    {
                                        $tr->IMB_LCF_VALOR = 0;
                                        $tr->IMB_LCF_OBSERVACAO = '';
                                    }
                                }
                                else

                                $tr->IMB_LCF_VALOR = $c->IMB_LCF_VALOR * $prop->IMB_IMVCLT_PERCENTUAL4 / 100;

                                $tr->IMB_LCF_LOCADORCREDEB = $c->IMB_LCF_LOCADORCREDEB;
                                $tr->IMB_LCF_LOCATARIOCREDEB = $c->IMB_LCF_LOCATARIOCREDEB;
                                $tr->GER_BNC_NOME = app('App\Http\Controllers\ctrRedeBancaria')
                                                    ->nomeBanco( $prop->GER_BNC_NUMERO );
                                $tr->GER_BNC_NUMERO = $prop->GER_BNC_NUMERO;
                                $tr->GER_BNC_AGENCIA = $prop->GER_BNC_AGENCIA;
                                $tr->IMB_CLTCCR_NUMERO = $prop->IMB_CLTCCR_NUMERO;
                                $tr->IMB_CLTCCR_DV = $prop->IMB_CLTCCR_DV;
                                $tr->IMB_CLTCCR_NOME = $prop->IMB_CLTCCR_NOME;
                                $tr->IMB_CLTCCR_CPF = $prop->IMB_CLTCCR_CPF;
                                $tr->IMB_CLTCCR_PESSOA = $prop->IMB_CLTCCR_PESSOA;
                                $tr->IMB_CLTCCR_DOC = $prop->IMB_CLTCCR_DOC;
                                $tr->IMB_CLTCCR_POUPANCA = $prop->IMB_CLTCCR_POUPANCA;
                                $tr->IMB_BNC_AGENCIADV = $prop->IMB_BNC_AGENCIADV;
                                $tr->IMB_IMV_CHEQUENOMINAL = $prop->IMB_IMV_CHEQUENOMINAL;
                                $tr->IMB_FORPAG_ID = $prop->IMB_FORPAG_ID;
                                $tr->IMB_FORPAG_NOME = app('App\Http\Controllers\ctrFormaPagamento')
                                                        ->pegarForma( $prop->IMB_FORPAG_ID );
                                $tr->IMB_IMVCLT_PIX = $prop->IMB_IMVCLT_PIX;
                                $tr->IMB_FORPAG_CONTACORRENTE =app('App\Http\Controllers\ctrFormaPagamento')
                                                            ->formaehcontacorrente( $prop->IMB_FORPAG_ID );
                                $tr->TMP_PVR_TITULO1 = $titulo1;
                                $tr->TMP_PVR_TITULO2 = $titulo2;
                                $tr->TMP_PVR_TITULO3 = $titulo3;
                                $tr->save();
                            }
                        }

                    }
                }


            }
        }

       
        $tr = mdlTmpPrevisaoRepasse::
        where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->orderBy('IMB_CTR_ID');
/*
        if( $ordem == 'data')
        
            $tr = $tr->orderBy( 'DATAPREVISAOPAGAMENTO')
            ->orderBy( 'IMB_CLT_NOMELOCADOR');
        else
        if( $ordem=='nome')
            $tr = $tr->orderBy( 'IMB_CLT_NOMELOCADOR');
  */      
        if( $idcliente <> '')
        {
            $tr = $tr->where( 'IMB_CLT_IDLOCADOR','<>', $idcliente )->delete();
            return response()->json($tr,200);
        }
        
            

        $tr = $tr->get();

        return response()->json($tr,200);



    }

    public function calcularBaseTaxaAdm( $idcontrato, $vencimento )
    {

        app('App\Http\Controllers\ctrRotinas')
                        ->lancarAluguel( $idcontrato, $vencimento);

        $lcfs = app('App\Http\Controllers\ctrLancamentoFuturo')
            ->lancamentoLocadorAberto( $vencimento, $idcontrato,'0','S');

        $ctr = mdlContrato::find( $idcontrato );

        $pontualidade = app('App\Http\Controllers\ctrRotinas')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                        ->valorDescontoPontualidade( $idcontrato, $vencimento, $vencimento, 0,'LD' );

        $basetaxa       = 0;
        $basetaxa + $pontualidade;

        $calculartaxaadm = 'S';

        foreach ( $lcfs as $lf )
        {


            $valorlcf = $lf->IMB_LCF_VALOR;
            if( $lf->IMB_LCF_LOCADORCREDEB == 'D' )
               $valorlcf = $valorlcf * -1;




            if (   ( $lf->IMB_TBE_ID == 6 ) or  ( $lf->IMB_TBE_ID == 7 and $lf->IMB_LCF_INCTAX <> 'S' ) )
              $calculartaxaadm = 'N';

            if( app('App\Http\Controllers\ctrLancamentoFuturo')
                ->incideTaxaAdm( $lf->IMB_TBE_ID, $lf->IMB_LCF_ID ) =='S' )
                $basetaxa = $basetaxa + $valorlcf;


        }

        if( $ctr->IMB_CTR_TAXAADMINISTRATIVA == 0 )
            $calculartaxaadm = 'N';

        $valortaxaadm = 0;
        if( $calculartaxaadm =='S' and $basetaxa <> 0 )
        {
                $valortaxaadm = $this->calcularTaxaPadraoContrato( $idcontrato, $basetaxa, 'S' );
        }

        return $valortaxaadm;


    }


    public function calcularPrevisaoTaxAdmContrato( Request $request )
    {

        $cob =mdlTmpPrevisaoTaxAdm::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();


        $anoinicio =  $request->anoinicial;
        $mesinicio =  $request->mesinicial;


        if( $mesinicio == null ) $mesinicio = date('m');
        if( $anoinicio == '' ) $anoinicio = date('Y');

        $contratos = mdlContrato::where( 'IMB_CTR_SITUACAO','=','ATIVO')
        ->where( 'IMB_CTR_ADVOGADO','<>','S')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID );

        $contratos = $contratos->orderBy( 'IMB_IMV_ID','ASC');
        $contratos = $contratos->get();

        foreach( $contratos as $contrato)
        {
            $diavencimento = $contrato->IMB_CTR_DIAVENCIMENTO;

            $ultimodia = app('\App\Http\Controllers\ctrRotinas')->
                        ultimoDiaMes($mesinicio,  $anoinicio );
            //echo "Ultimo dia  $ultimodia<br>";

            if( $ultimodia < $diavencimento )
               $diavencimento = $ultimodia;

            $data = date( 'Y-m-d', mktime(0, 0, 0,$mesinicio,$diavencimento,$anoinicio));

            $tmp = new mdlTmpPrevisaoTaxAdm;
            $tmp->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_CTR_ID = $contrato->IMB_CTR_ID;
            $tmp->IMB_CTR_REFERENCIA = $contrato->IMB_CTR_REFERENCIA;
            $tmp->IMB_IMV_ID = $contrato->IMB_IMV_ID;
            $tmp->ENDERECO = app('\App\Http\Controllers\ctrRotinas')->imovelEndereco( $contrato->IMB_IMV_ID );
            $tmp->LOCADOR =  app('\App\Http\Controllers\ctrRotinas')->proprietarioPrincipal( $contrato->IMB_IMV_ID );
            $tmp->DATAVENCIMENTO = $data;
            $tmp->VALORTAXA     =  $this->calcularBaseTaxaAdm($contrato->IMB_CTR_ID,$data);
            $tmp->VALORTAXACONTRATO =  $this->calcularTaxaContrato($contrato->IMB_CTR_ID,$data);
            $tmp->IMB_ATD_ID= Auth::user()->IMB_ATD_ID;
            $tmp->save();
        }

        $cob =  mdlTmpPrevisaoTaxAdm::
        where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
        ->where('IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy('DATAVENCIMENTO')
        ->get();

        return DataTables::of($cob)->make(true);



    }

    public function totalizarPrevTaxAdm()
    {
        $array = array();

        $tmp = mdlTmpPrevisaoTaxAdm::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->get;
        $total=0;
        $totaltc=0;
        foreach( $tmp as $tm )
        {
            $total = $total + $tm->VALORTAXA;
            $totaltc = $totaltc + $tm->VALORTAXACONTRATO;
        }

        array_push($array,
            [   'TAXAADM' => $total,
                'TAXACONTRATO' =>$totaltc ]);

        return response()->json( $array, 200 );
    }

    public function previsaoTaxaAdm()
    {
        return view( 'reports.admimoveis.relatorioprevisaotaxaadm' );
    }

    public function calcularTaxaContrato( $idcontrato, $vencimento )
    {
        $deb = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_LCF_DATAVENCIMENTO','=', $vencimento )
        ->where( 'IMB_LCF_LOCADORCREDEB','=', 'D' )
        ->whereIn( 'IMB_TBE_ID',[7,25])
        ->whereNull( 'IMB_LCF_DATAPAGAMENTO')
        ->sum( 'IMB_LCF_VALOR');


        $cre = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_LCF_DATAVENCIMENTO','=', $vencimento )
        ->where( 'IMB_LCF_LOCADORCREDEB','=', 'C' )
        ->whereIn( 'IMB_TBE_ID',[7,25])
        ->whereNull( 'IMB_LCF_DATAPAGAMENTO')
        ->sum( 'IMB_LCF_VALOR');

        $taxacontrato = $deb - $cre;
        return $taxacontrato;

    }

    public function itemAlterarFixar( Request $request )
    {
        
        $id = $request->TMP_REC_ID;
        $valor = $request->IMB_LCF_VALOR;

        $lf = mdlRepasse::find( $id );
        $lf->IMB_LCF_VALOR = $valor;
        $lf->TMP_REC_FIXADO = 'S';
        $lf->save();

        return response()->json( 'ok',200);
        
    }

    public function verificarFixado( $idtbe )
    {
        $tmp = mdlRepasse::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->where( 'IMB_TBE_ID','=', $idtbe )
        ->where('TMP_REC_FIXADO','=','S' )
        ->first();

        return $tmp;



    }


    public function limparTMP()
    {
        $tmp = mdlRepasse::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->delete();
        
    }

    public function distinctBaseGeradaForma()
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID);
        
        $dados = $dados->orderBy('IMB_FORPAG_NOME')
                        ->orderBy('DATAPREVISAOPAGAMENTO')
         ->get(['IMB_FORPAG_NOME','IMB_FORPAG_ID', 'TMP_PVR_TITULO2']);

         return  $dados;


    }
    public function distinctBaseGeradaFormaCliente( $forma)
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
                ->where( 'IMB_FORPAG_ID','=',$forma );
        
        $dados =  $dados->orderBy('DATAPREVISAOPAGAMENTO')->orderBy('IMB_CLT_NOMELOCADOR')
         ->get(['IMB_CLT_NOMELOCADOR', 'IMB_CLT_IDLOCADOR']);

         return  $dados;

    }

    public function distinctBaseGeradaRepassesClienteForma( $forma, $cliente)
    {

        $dados = mdlTmpPrevisaoRepasse::
                distinct()
                ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
                ->where( 'IMB_FORPAG_ID','=', $forma)
                ->where( 'IMB_CLT_IDLOCADOR', '=', $cliente);
        
        $dados =  $dados
        ->orderBy('DATAPREVISAOPAGAMENTO')
         ->get(
                [
                    'IMB_FORPAG_NOME',
                    'IMB_CLT_IDLOCADOR', 
                    'IMB_CTR_VENCIMENTOLOCADOR', 
                    'DATAPREVISAOPAGAMENTO', 
                    'IMB_RLD_DATAVENCIMENTO',
                    'IMB_CLT_NOMELOCATARIO',
                    'ENDERECOCOMPLETO',
                    'IMB_IMV_ID',
                    'IMB_CTR_ID',
                    'IMB_IMV_PASTAALFA',
                    'GER_BNC_NOME',
                    'GER_BNC_AGENCIA',
                    'IMB_CLTCCR_NUMERO',
                    'IMB_CLTCCR_DV',
                    'IMB_FORPAG_CONTACORRENTE',
                    'IMB_CLTCCR_NOME',
                    'IMB_CLTCCR_PESSOA',
                    'IMB_CLTCCR_CPF',
                    'IMB_IMVCLT_PIX',
                    'IMB_CLTCCR_POUPANCA',
                    'IMB_BNC_AGENCIADV',
                ]
                );

        
        return  $dados;


    }


    public function relPrevisaoRepasseRelatorio()
    {
        return view( 'reports.admimoveis.relprevisaopagamentonovo');

    }

    public function distinctBaseGeradaRepassesMovimentoContratoVen( $idlocador, $idcontrato, $vencimento)
    {

        $dados = mdlTmpPrevisaoRepasse::
                where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
                ->where( 'IMB_CLT_IDLOCADOR','=', $idlocador)
                ->where( 'IMB_CTR_ID', '=', $idcontrato)
                ->where( 'IMB_CTR_VENCIMENTOLOCADOR','=', $vencimento)
                ->orderBy('IMB_TBE_ID')
                ->get();
        
        return  $dados;


    }

    public function lancar13( $idcontrato, $idimovel, $datavencimento, $datapagamento, $valortaxaadm)
    {
        $mes = date( 'm',strtotime( $datavencimento) );

        $imovel = mdlImovel::find( $idimovel);

        if( $imovel->IMB_IMV_13MES == $mes )
        {
            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID                   = 35;
            $tmp->IMB_TBE_NOME            = 'Décima Terceira Parcela';
            $tmp->IMB_LCF_LOCATARIOCREDEB      = 'N';
            $tmp->IMB_LCF_LOCADORCREDEB        = 'D';
            $tmp->IMB_LCF_VALOR                = abs($valortaxaadm)  * $imovel->IMB_IMV_13PERCENTUAL / 100;
            $tmp->IMB_LCF_OBSERVACAO           = '';
            $tmp->IMB_LCF_ID             = 0;
            $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                        ->pegarCFCPadrao( 35 );
             $tmp->save();    
        }


        if( $imovel->IMB_IMV_13_2MES == $mes )
        {
            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID                   = 35;
            $tmp->IMB_TBE_NOME            = 'Décima Terceira Parcela';
            $tmp->IMB_LCF_LOCATARIOCREDEB      = 'N';
            $tmp->IMB_LCF_LOCADORCREDEB        = 'D';
            $tmp->IMB_LCF_VALOR                = abs($valortaxaadm * $imovel->IMB_IMV_13_2PERCENTUAL / 100);
            $tmp->IMB_LCF_OBSERVACAO           = '';
            $tmp->IMB_LCF_ID             = 0;
            $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                        ->pegarCFCPadrao( 35 );
             $tmp->save();    
        }


        if( $imovel->IMB_IMV_13_3MES == $mes )
        {
            $tmp = new mdlRepasse;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_PAG_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_PAG_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID                   = 35;
            $tmp->IMB_TBE_NOME            = 'Décima Terceira Parcela';
            $tmp->IMB_LCF_LOCATARIOCREDEB      = 'N';
            $tmp->IMB_LCF_LOCADORCREDEB        = 'D';
            $tmp->IMB_LCF_VALOR                = abs($valortaxaadm * $imovel->IMB_IMV_13_3PERCENTUAL / 100);
            $tmp->IMB_LCF_OBSERVACAO           = '';
            $tmp->IMB_LCF_ID             = 0;
            $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                        ->pegarCFCPadrao( 35 );
             $tmp->save();    
        }

    }
    //
}
