<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCliente;
use App\mdlLancamentoFuturo;
use App\mdlTabelaEvento;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlContrato;
use App\mdlRecebimento;
use DataTables;
use DateTime;

use DB;
use Auth;
use Log;

class ctrRecebimento extends Controller
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
        return view( 'recebimento.recebimento', compact( 'id' ) ) ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function calcularRecebimento( $idcontrato,
                                        $datavencimento,
                                        $datapagamento,
                                        $liberarmulta1,
                                        $liberarmulta2,
                                        $liberarjuros,
                                        $origem )
    {


    //    dd( " $idcontrato, $datavencimento,  $datapagamento" ) ;
        //primeira parte é limpar a tabela para que possa colocar novas infoamções.

        
        $param = mdlParametros::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->first();

        $date1=date_create($datapagamento);
        $date2=date_create($datavencimento);

        $diferencadias = date_diff($date1,$date2);
        $diferencadias = $diferencadias->format("%R%a");
        $diferencadias = abs($diferencadias);
        if( $param->IMB_PRM_JUROSAPOSUMMES == 'S' and $diferencadias <= 30 ) $liberarjuros = 'S';

       // //Log:info('calculando recebimento');
        ////Log:info( 'dias '.$diferencadias );
        if( $origem == 'boleto')
        {
           // //Log:info('Origem: boleto');
            $tmp = mdlRecebimento::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
                    ->delete();
        }
        else
            $tmp = mdlRecebimento::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
                ->where('TMP_REC_FIXADO','<>','S' )
                    ->delete();


        $objbases = new \stdClass();

       // //Log:info( 'calculando recebimento contrato '.$idcontrato );
        $vencimento = $datavencimento;
        ////Log:info( 'vencimento '.$datavencimento );

        app('App\Http\Controllers\ctrRotinas')
                    ->lancarAluguel( $idcontrato, $vencimento) ;

        app('App\Http\Controllers\ctrLancamentoFuturo')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                    ->gerarFixos( $idcontrato, $datavencimento,'LT' );

        $lcfs = app('App\Http\Controllers\ctrLancamentoFuturo')
            ->lancamentomeslocatario( $vencimento, $idcontrato,'0' );

        $ctr = mdlContrato::find( $idcontrato );

        if( $ctr <> '' )
        {

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

            ////Log:info( "data vencto $datavencimento");
            ////Log:info( "data limite $datalimite");


            $pontualidade = app('App\Http\Controllers\ctrRotinas')  //valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo )
                            ->valorDescontoPontualidade( $idcontrato, $datavencimento, $datapagamento, $descontoacordo,'LT' );

            //s//Log:info( "pontualidade ".$pontualidade );


            //VERIFICANDO OS FIXOS


            $objbases->baseirrf      = 0;
            $objbases->basemulta     = 0;
            $objbases->basejuros     = 0;
            $objbases->basecorrecao  = 0;

            foreach ( $lcfs as $lf )
            {

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


            $tmp = new mdlRecebimento;
            $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
            $tmp->IMB_CTR_ID             = $ctr->$idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
            $tmp->IMB_TBE_ID             = $lf->IMB_TBE_ID;
            $tmp->IMB_TBE_NOME           = $lf->IMB_TBE_NOME;
            $tmp->IMB_LCF_LOCATARIOCREDEB= $lf->IMB_LCF_LOCATARIOCREDEB;
            $tmp->IMB_LCF_LOCADORCREDEB  = $lf->IMB_LCF_LOCADORCREDEB;
            $tmp->IMB_LCF_INCMUL         = $lf->IMB_LCF_INCMUL;
            $tmp->IMB_LCF_INCJUROS       = $lf->IMB_LCF_INCJUROS;
            $tmp->IMB_LCF_INCCORRECAO    = $lf->IMB_LCF_INCCORRECAO;
            $tmp->IMB_LCF_INCIRRF        = $lf->IMB_LCF_INCIRRF;
            $tmp->IMB_LCF_INCTAX         = $lf->IMB_LCF_INCTAX;
            $tmp->IMB_LCF_VALOR          = $lf->IMB_LCF_VALOR;
            $tmp->IMB_LCF_ID             = $lf->IMB_LCF_ID;
            $tmp->FIN_CFC_ID             = $lf->FIN_CFC_ID;
            $tmp->IMB_LCF_OBSERVACAO     = $lf->IMB_LCF_OBSERVACAO;
            $tmp->TMP_REC_FIXADO     = 'N';
            $tmp->save();
            }



            if( $liberarmulta1 <> 'S' and $this->verificarFixado( 2 ) =='' ) 
            {
          
                $multa =  app('App\Http\Controllers\ctrRotinas')
                    ->calcularMulta( $idcontrato, $datavencimento, $datapagamento, $objbases->basemulta);

            
                   // //Log:info( '$multa->repassarvalor '.$multa->repassarvalor);

                    if( $multa->repassarvalor <> 0 )
                    {
                        $tmp = new mdlRecebimento;
                        $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                        $tmp->IMB_CTR_ID             = $idcontrato;
                        $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                        $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                        $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
                        $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
                        $tmp->IMB_TBE_ID             = 2;
                        $tmp->IMB_TBE_NOME           = 'Multa pelo Atraso no Pagamento';
                        $tmp->IMB_LCF_LOCATARIOCREDEB= 'D';
                        $tmp->IMB_LCF_LOCADORCREDEB  = 'C';
                        $tmp->IMB_LCF_INCMUL         = 'N';
                        $tmp->IMB_LCF_INCJUROS       = 'N';
                        $tmp->IMB_LCF_INCCORRECAO    = 'N';
                        $tmp->IMB_LCF_INCIRRF        = 'S';
                        $tmp->IMB_LCF_INCTAX         = 'N';
                        $tmp->IMB_LCF_VALOR          = $multa->repassarvalor;
                        $tmp->IMB_LCF_ID             = 0;
                        $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                                        ->pegarCFCPadrao( 2 );
                        $tmp->IMB_LCF_OBSERVACAO     = '';
                        $tmp->TMP_REC_FIXADO     = 'N';
    
                        $tmp->save();
                    }
                    
                    if( $multa->retervalor <> 0 )
                    {
                        $tmp = new mdlRecebimento;
                        $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                        $tmp->IMB_CTR_ID             = $idcontrato;
                        $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                        $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                        $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
                        $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
                        $tmp->IMB_TBE_ID             = 2;
                        $tmp->IMB_TBE_NOME           = 'Multa pelo Atraso no Pagamento';
                        $tmp->IMB_LCF_LOCATARIOCREDEB= 'D';
                        $tmp->IMB_LCF_LOCADORCREDEB  = 'N';
                        $tmp->IMB_LCF_INCMUL         = 'N';
                        $tmp->IMB_LCF_INCJUROS       = 'N';
                        $tmp->IMB_LCF_INCCORRECAO    = 'N';
                        $tmp->IMB_LCF_INCIRRF        = 'N';
                        $tmp->IMB_LCF_INCTAX         = 'N';
                        $tmp->IMB_LCF_VALOR          = $multa->retervalor;
                        $tmp->IMB_LCF_ID             = 0;
                        $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                                        ->pegarCFCPadrao( 2 );
                        $tmp->IMB_LCF_OBSERVACAO     = '';
                        $tmp->TMP_REC_FIXADO     = 'N';
    
                        $tmp->save();
                    }
                    }

            /*
            if( $liberarmulta2 <> 'S' and $this->verificarFixado( 36 ) =='' ) 
            {
                $multa =  app('App\Http\Controllers\ctrRotinas')
                    ->calcularMulta( $idcontrato, $datalimite, $datapagamento, $objbases->basemulta);

                if( $multa->retervalor <> 0 )
                {
                    $tmp = new mdlRecebimento;
                    $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                    $tmp->IMB_CTR_ID             = $ctr->$idcontrato;
                    $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                    $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                    $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
                    $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
                    $tmp->IMB_TBE_ID             = 36;
                    $tmp->IMB_TBE_NOME           = 'Multa pelo Atraso no Pagamento';
                    $tmp->IMB_LCF_LOCATARIOCREDEB= 'D';
                    $tmp->IMB_LCF_LOCADORCREDEB  = 'N';
                    $tmp->IMB_LCF_INCMUL         = 'N';
                    $tmp->IMB_LCF_INCJUROS       = 'N';
                    $tmp->IMB_LCF_INCCORRECAO    = 'N';
                    $tmp->IMB_LCF_INCIRRF        = 'N';
                    $tmp->IMB_LCF_INCTAX         = 'N';
                    $tmp->IMB_LCF_VALOR          = $multa->repassarvalor;
                    $tmp->IMB_LCF_ID             = 0;
                    $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                                    ->pegarCFCPadrao( 36 );
                    $tmp->IMB_LCF_OBSERVACAO     = '';
                    $tmp->TMP_REC_FIXADO     = 'N';
                    $tmp->save();
                }
            }
            */
            if( $liberarjuros <> 'S') 
            {

                $juros =  app('App\Http\Controllers\ctrRotinas')
                        ->calcularJuros( $idcontrato, $datavencimento, $datapagamento, $objbases->basejuros);

                if( $juros->retervalor <> 0 or $juros->repassarvalor <> 0)
                {
                    $tmp = new mdlRecebimento;
                    $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                    $tmp->IMB_CTR_ID             = $ctr->$idcontrato;
                    $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                    $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                    $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
                    $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
                    if( $juros->retervalor <> 0 )
                    {
                        $tmp->IMB_TBE_ID             = 37;
                        $tmp->IMB_LCF_LOCADORCREDEB  = 'N';
                        $tmp->IMB_LCF_INCIRRF        = 'N';
                        $tmp->IMB_LCF_VALOR          = $juros->retervalor;

                    }
                    else
                    {
                        $tmp->IMB_TBE_ID             = 3;
                        $tmp->IMB_LCF_LOCADORCREDEB  = 'C';
                        $tmp->IMB_LCF_INCIRRF        = 'S';
                        $tmp->IMB_LCF_VALOR          = $juros->repassarvalor;
                    }
                    $tmp->IMB_TBE_NOME           = 'Juros no Atraso de Pagamento';

                    $tmp->IMB_LCF_LOCATARIOCREDEB= 'D';
                    $tmp->IMB_LCF_INCMUL         = 'N';
                    $tmp->IMB_LCF_INCJUROS       = 'N';
                    $tmp->IMB_LCF_INCCORRECAO    = 'N';
                    $tmp->IMB_LCF_INCTAX         = 'N';
                    $tmp->IMB_LCF_ID             = 0;
                    $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                    ->pegarCFCPadrao( $tmp->IMB_TBE_ID );
                    $tmp->IMB_LCF_OBSERVACAO     = $juros->jurosdias.' dias de atraso no pagamento';
                    $tmp->TMP_REC_FIXADO     = 'N';

                    if( $this->verificarFixado( $tmp->IMB_TBE_ID ) =='' )
                        $tmp->save();
                }
            }



            $tarifaboletolancada = app('App\Http\Controllers\ctrRotinas')->verificarEventoLancado( $idcontrato, $vencimento, 23 );
            if( $tarifaBoleto <> 0 and $this->verificarFixado( 23 ) =='' and $tarifaboletolancada == 0 )
            {
                $tmp = new mdlRecebimento;
                $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                $tmp->IMB_CTR_ID             = $ctr->$idcontrato;
                $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
                $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
                $tmp->IMB_TBE_ID             = 23;
                $tmp->IMB_TBE_NOME           = 'Tarifa Boleto';
                $tmp->IMB_LCF_LOCATARIOCREDEB= 'D';
                $tmp->IMB_LCF_LOCADORCREDEB  = 'N';
                $tmp->IMB_LCF_INCMUL         = 'N';
                $tmp->IMB_LCF_INCJUROS       = 'N';
                $tmp->IMB_LCF_INCCORRECAO    = 'N';
                $tmp->IMB_LCF_INCIRRF        = 'N';
                $tmp->IMB_LCF_INCTAX         = 'N';
                $tmp->IMB_LCF_VALOR          = $tarifaBoleto;
                $tmp->IMB_LCF_ID             = 0;
                $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                                ->pegarCFCPadrao( 36 );
                $tmp->IMB_LCF_OBSERVACAO     = '';
                $tmp->TMP_REC_FIXADO     = 'N';

                $tmp->save();
            }

            if( $pontualidade <> 0 )
            {
                $tmp = new mdlRecebimento;
                $tmp->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                $tmp->IMB_CTR_ID             = $ctr->$idcontrato;
                $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
                $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
                $tmp->IMB_TBE_ID             = 5;
                $tmp->IMB_TBE_NOME           = 'Desconto Por Pontualidade';
                $tmp->IMB_LCF_LOCATARIOCREDEB= 'C';
                $tmp->IMB_LCF_LOCADORCREDEB  = 'D';
                $tmp->IMB_LCF_INCMUL         = 'N';
                $tmp->IMB_LCF_INCJUROS       = 'N';
                $tmp->IMB_LCF_INCCORRECAO    = 'N';
                $tmp->IMB_LCF_INCIRRF        = 'S';
                $tmp->IMB_LCF_INCTAX         = 'S';
                $tmp->IMB_LCF_VALOR          = $pontualidade;
                $tmp->IMB_LCF_ID             = 0;
                $tmp->FIN_CFC_ID             =   app('App\Http\Controllers\ctrRotinas')
                                                ->pegarCFCPadrao( 5 );
                $tmp->IMB_LCF_OBSERVACAO     = '';
                $tmp->TMP_REC_FIXADO     = 'N';
     //           //Log:info( 'POntualidade lancada: Locador: '.$tmp->IMB_LCF_LOCADORCREDEB  );
      //          //Log:info( 'POntualidade lancada: Locatario: '.$tmp->IMB_LCF_LOCATARIOCREDEB  );
                $tmp->save();
            }

            $this->recalcularRecebimento(
                $idcontrato,$ctr->IMB_IMV_ID, $datavencimento, $datapagamento );



            $tmp =  mdlRecebimento::select(
                [
                    'IMB_IMV_ID',
                    'IMB_CTR_ID',
                    'IMB_IMB_ID',
                    'IMB_ATD_ID',
                    'IMB_REC_DATAVENCIMENTO',
                    'IMB_REC_DATAPAGAMENTO',
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
                    'IMB_LCF_OBSERVACAO',
                    'IMB_REC_ID',
                    DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                    WHERE IMB_CLIENTE.IMB_CLT_ID = TMP_RECEBIMENTO.IMB_CLT_ID)
                    AS IMB_CLT_NOMELOCADOR')

                ]
            )
            ->where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
            ->orderBy('IMB_TBE_ID')
            ->get();

            if( $origem == 'boleto')  //quando vem da baixa de cobranca bancária
                return $tmp;
            return response()->json( $tmp,200);

        }
        return '[]';


    }

    public function recalcularRecebimento( $idcontrato, $idimovel, $datavencimento, $datapagamento )
    {
        $tmp =  mdlRecebimento::where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->get();
        $ctr = mdlContrato::find( $idcontrato );

        $irrflancado =0;
        $baseirrf = 0;
        foreach ($tmp as $item)
        {


            $valoritem = $item->IMB_LCF_VALOR;

            if( $item->IMB_LCF_ID == 0  and  $item->IMB_TBE_ID == 18 )
                $this->itemDelete( $item->IMB_REC_ID );
            else
            if( $item->IMB_TBE_ID == 18 and $item->IMB_LCF_ID <> 0  ) 
            {
                $irrflancado = $valoritem;                
            }

            if( $item->IMB_LCF_ID == 0  and  $item->IMB_TBE_ID == 57 )
                $this->itemDelete( $item->IMB_REC_ID );

            if( $item->IMB_LCF_LOCATARIOCREDEB == 'C')
              $valoritem = $valoritem * -1;

            if( $item->IMB_LCF_INCIRRF =='S' )
                $baseirrf = $baseirrf + $valoritem;


        }

        //dd( $baseirrf );

        Log::info( '$ctr->IMB_CTR_NUNCARETEIRRF '.$ctr->IMB_CTR_NUNCARETEIRRF );
        Log::info( '$irrflancado '.$irrflancado );
        
        if(  $ctr->IMB_CTR_NUNCARETEIRRF <> 'S' and $irrflancado == 0 )
            $this->lancarIRRF( $idcontrato, $idimovel, $datavencimento, $datapagamento,$baseirrf );

        return $tmp;


    }

    public function lancarIRRF( $idcontrato, $idimovel, $datavencimento, $datapagamento,$baseirrf )
    {

        Log::info( 'base irrf '.$baseirrf);
        $irrf= app('App\Http\Controllers\ctrTabelaIRRF')
        ->calcularIRRF( $idcontrato, $baseirrf );
        


        foreach ($irrf as $irrfcal)
        {
            $tmp = new mdlRecebimento;
            $tmp->IMB_IMV_ID             = $idimovel;
            $tmp->IMB_CTR_ID             = $idcontrato;
            $tmp->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $tmp->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $tmp->IMB_REC_DATAVENCIMENTO = $datavencimento;
            $tmp->IMB_REC_DATAPAGAMENTO  = $datapagamento;
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
        }
    }

    public function totalizarLancamentos()
    {
        $tmp =  mdlRecebimento::where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->get();

        $total = 0;
        foreach ($tmp as $item)
        {

                $valor = $item->IMB_LCF_VALOR;
            if( $item->IMB_LCF_LOCATARIOCREDEB == 'C')
                $valor = $valor * -1;
            $total = $total + $valor;

        }

        return response()->json( $total,200);

    }

    public function itemDelete( $id)
    {

       // //Log:info( 'id tmp '.$id );

        $rec = mdlRecebimento::find( $id );

        if( $rec )
        {
           // //Log:info( 'id lf: '.$rec->IMB_LCF_ID);

            if( $rec->IMB_LCF_ID <> 0 )
            {
                $lf = mdlLancamentoFuturo::find( $rec->IMB_LCF_ID );
                if( $lf )
                {
                    $ctr = mdlContrato::find( $lf->IMB_CTR_ID );
                   // //Log:info( "ctr->IMB_CTR_DIAVENCIMENTO $ctr->IMB_CTR_DIAVENCIMENTO");
                   // //Log:info( "lf->IMB_LCF_DATAVENCIMENTO $lf->IMB_LCF_DATAVENCIMENTO");
                    $lf->IMB_LCF_DATAVENCIMENTO =  app('App\Http\Controllers\ctrRotinas')
                        ->addMeses( $ctr->IMB_CTR_DIAVENCIMENTO,  1,$lf->IMB_LCF_DATAVENCIMENTO );
                    $lf->save();
                  //  //Log:info('salvo!');
                }
            }

           // //Log:info('deletando ');
            $rec->delete();
            //$ir = mdlRecebimento::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
            //->where( 'IMB_TBE_ID','=', 18 )->delete();
            //apago o irrf pra forçar novo calculo
        }

        return response()->json('ok',200);
    }

    public function itemAlterarFixar( Request $request )
    {
        
        $id = $request->TMP_REC_ID;
        $valor = $request->IMB_LCF_VALOR;

        $lf = mdlRecebimento::find( $id );
        $lf->IMB_LCF_VALOR = $valor;
        $lf->TMP_REC_FIXADO = 'S';
        $lf->save();

        return response()->json( 'ok',200);
        
    }

    public function verificarFixado( $idtbe )
    {
        $tmp = mdlRecebimento::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->where( 'IMB_TBE_ID','=', $idtbe )
        ->where('TMP_REC_FIXADO','=','S' )
        ->first();

        return $tmp;



    }

    public function limparTMP()
    {
        $tmp = mdlRecebimento::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)
        ->delete();
        
    }



}
