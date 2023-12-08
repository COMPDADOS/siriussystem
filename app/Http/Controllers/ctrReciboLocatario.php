<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlReciboLocatario;
use App\mdlTabelaEvento;
use App\mdlLancamentoFuturo;
use App\mdlContrato;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlLanctoCaixa;
use App\mdlCliente;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaItemPerm;
use App\mdlTMPRecebimentoDia;
use Illuminate\Support\Facades\Mail;

use DB;
use Auth;
use DataTables;
use PDF;
use Log;

class ctrReciboLocatario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        $dados = $request->dados;
        $idcontrato =$dados[0]['IMB_CTR_ID'];
        $datapagamento = $dados[0]['IMB_RLT_DATAPAGAMENTO'];
        $datavencimento = $dados[0]['IMB_RLT_DATACOMPETENCIA'];
        $numerorecibo = $dados[0]['IMB_RLT_NUMERO'];
        
        $aluguel = 0;
        $troco = 0;
        $trocofuturo = 'N';
        //Log::info( 'abater ');
        //Log::info($dados[0]['IMB_RLT_ABATER'] );

        if( $dados[0]['IMB_RLT_ABATER'] == 'S' )
        {
            $contrato   = mdlContrato::find( $idcontrato );
            $idimv      = $contrato->IMB_IMV_ID;
            $idimb2     = $contrato->IMB_IMB_ID2;
            $idcfc      ='';

            $idlocador = $dados[0]['IMB_CLT_IDLOCADOR'];

            $idlocatario = collect( DB::select("select PEGACODIGOLOCATARIOCONTRATO('$idcontrato') as id "))->first()->id;

            $tbe = mdlTabelaEvento::where('IMB_TBE_ID','=', 200 )->first();;
            if( $tbe <> '' ) $idcfc = $tbe->FIN_CFC_ID;

            $recibo = new mdlReciboLocatario;
            $recibo->IMB_RLT_NUMERO         = $dados[0]['IMB_RLT_NUMERO'];
            $recibo->IMB_RLT_DATAPAGAMENTO  = $dados[0]['IMB_RLT_DATAPAGAMENTO'];
            $recibo->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $recibo->IMB_RLT_DATACOMPETENCIA= $dados[0]['IMB_RLT_DATACOMPETENCIA'];
            $recibo->IMB_RLT_LOCATARIOCREDEB= 'D';
            $recibo->IMB_RLT_LOCADORCREDEB  = 'N';
            $recibo->IMB_RLT_VALOR          = $dados[0]['IMB_RLT_TOTDIN']+
                                                $dados[0]['IMB_RLT_TOTCHE'];
            $recibo->IMB_RLT_OBSERVACAO     = $dados[0]['IMB_RLT_OBSERVACAO'];
            $recibo->IMB_RLT_TIPORECEBIMENTO= $dados[0]['IMB_RLT_TIPORECEBIMENTO'];
            $recibo->IMB_LCF_ID             = 0;
            $recibo->IMB_RLT_DATACAIXA      = $dados[0]['IMB_RLT_DATACAIXA'];
            $recibo->IMB_RLT_FORMARECEBIMENTO  = $dados[0]['IMB_RLT_FORMARECEBIMENTO'];
            $recibo->IMB_RLT_DATACONTABIL   = $dados[0]['IMB_RLT_DATACAIXA'];
            $recibo->IMB_CTR_ID             = $dados[0]['IMB_CTR_ID'];
            $recibo->IMB_IMV_ID             = $idimv;
            $recibo->IMB_TBE_ID             = '200';
            $recibo->FIN_CFC_ID             = $idcfc;
            $recibo->FIN_CCR_ID             = $dados[0]['FIN_CCR_ID'];
            $recibo->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $recibo->IMB_RLT_DTHEMISSAO     = date('Y/m/d');
            $recibo->IMB_IMB_ID2            = $idimb2;
            $recibo->IMB_FORPAG_ID          = $dados[0]['IMB_FORPAG_ID'];
            $recibo->IMB_RLT_DATALIMITE     = app('App\Http\Controllers\ctrRotinas')
                                    ->dataLimite( $idcontrato, $dados[0]['IMB_RLT_DATACOMPETENCIA'] );
            $recibo->FIN_LCX_DINHEIRO       = $dados[0]['FIN_LCX_DINHEIRO'];
            $recibo->FIN_LCX_CHEQUE         = $dados[0]['FIN_LCX_CHEQUE'];
            $recibo->IMB_RLT_PIX         = $dados[0]['IMB_RLT_PIX'];
            $recibo->FIN_CFC_ID             = $idcfc;
            $recibo->IMB_CLT_ID_LOCATARIO   = $idlocatario;
            $recibo->IMB_CLT_ID_LOCADOR     = $idlocador;
            $recibo->IMB_RLT_TROCO          = 0;
            $recibo->IMB_RLT_TROCOFUTURO    ='N';
            $recibo->IMB_RLT_ABATER         ='S';
            $recibo->IMB_RLT_TOTALRECIBO    = $recibo->IMB_RLT_VALOR;
            $recibo->save();

            $lf = new mdlLancamentoFuturo();
            $lf->IMB_IMB_ID              = Auth::user()->IMB_IMB_ID;
            $lf->IMB_CTR_ID              = $dados[0]['IMB_CTR_ID'];
            $lf->IMB_LCF_VALOR           = $recibo->IMB_RLT_VALOR;
            $lf->IMB_LCF_LOCADORCREDEB   = 'N';
            $lf->IMB_LCF_LOCATARIOCREDEB = 'C';
            $lf->IMB_LCF_DATAVENCIMENTO  = $recibo->IMB_RLT_DATACOMPETENCIA;
            $lf->IMB_IMV_ID              = $recibo->IMB_IMV_ID ;
            $lf->IMB_CLT_IDLOCADOR       = $recibo->IMB_CLT_ID_LOCADOR;
            $lf->IMB_TBE_ID              = $recibo->IMB_TBE_ID;
            $lf->IMB_ATD_ID              = Auth::user()->IMB_IMB_ID;
            $lf->IMB_LCF_INCMUL          = 'N';
            $lf->IMB_LCF_INCIRRF         = 'N';
            $lf->IMB_LCF_INCTAX          = 'S';
            $lf->IMB_LCF_INCJUROS        = 'N';
            $lf->IMB_LCF_INCCORRECAO     = 'N';
            $lf->IMB_LCF_GARANTIDO       = 'N';
            $lf->IMB_LCF_INCISS          = 'N';
            $lf->IMB_LCF_OBSERVACAO      = 'PARTE DE PAGAMENTO DO VENCIMENTO '. app('App\Http\Controllers\ctrRotinas')->formatarData( $recibo->IMB_RLT_DATACOMPETENCIA  );
            $lf->IMB_LCF_NUMEROCONTROLE  = '0';
            $lf->IMB_LCF_NUMPARREAJUSTE  = '0';
            $lf->IMB_LCF_NUMPARCONTRATO  = '0';
            $lf->IMB_LCF_CHAVE           = '0';
            $lf->IMB_LCF_TIPO            = 'A';
            $lf->IMB_LCF_ORIGEM            = 'MANUAL';

            $lf->save();

            app('App\Http\Controllers\ctrRotinas')  
            ->gravarObs( $contrato->IMB_IMV_ID, $contrato->IMB_CTR_ID, 0, $recibo->IMB_RLT_NUMERO,0 , 'Recebendo parte de pagamento vencimento'.
                app('App\Http\Controllers\ctrRotinas')->formatarData( $recibo->IMB_RLT_DATACOMPETENCIA  )); 
            
            return response()->json($recibo->IMB_RLT_NUMERO,200);

    
        }

        
        foreach ($dados as $d)
        {

            $idlcf = $d['IMB_LCF_ID'];
            $idtbe = $d['IMB_TBE_ID'];



            $idlocador = $d['IMB_CLT_IDLOCADOR'];

            $idlocatario = collect( DB::select("select PEGACODIGOLOCATARIOCONTRATO('$idcontrato') as id "))->first()->id;

            $contrato   = mdlContrato::find( $idcontrato );
            $idimv      = $contrato->IMB_IMV_ID;
            $idimb2     = $contrato->IMB_IMB_ID2;
            $idcfc      ='';

            Log::info( "lfid $idlcf");
            if( $idlcf <> 0 )
            {
                $lf         = mdlLancamentoFuturo::find( $idlcf );
                if( $lf <> '' )
                $idcfc      = $lf->FIN_CFC_ID;
            }

            $eve        = mdlTabelaEvento::where( 'IMB_TBE_ID', '=', $idtbe )->first();

            if( $idcfc == '' or $idcfc == null)

                $idcfc = $eve->FIN_CFC_ID;

            if( $idtbe == 1 or $idtbe == 24 ) $aluguel = 1;

            $recibo = new mdlReciboLocatario;
            $recibo->IMB_RLT_NUMERO         = $d['IMB_RLT_NUMERO'];
            $recibo->IMB_RLT_DATAPAGAMENTO  = $d['IMB_RLT_DATAPAGAMENTO'];
            $recibo->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $recibo->IMB_RLT_DATACOMPETENCIA= $d['IMB_RLT_DATACOMPETENCIA'];
            $recibo->IMB_RLT_LOCATARIOCREDEB= $d['IMB_RLT_LOCATARIOCREDEB'];
            $recibo->IMB_RLT_LOCADORCREDEB  = $d['IMB_RLT_LOCADORCREDEB'];
            $recibo->IMB_RLT_VALOR          = $d['IMB_RLT_VALOR'];
            $recibo->IMB_RLT_OBSERVACAO     = $d['IMB_RLT_OBSERVACAO'];
            //$recibo->IMB_RLT_SITUACAO       = $d['IMB_RLT_SITUACAO'];
            $recibo->IMB_RLT_TIPORECEBIMENTO= $d['IMB_RLT_TIPORECEBIMENTO'];
            $recibo->IMB_LCF_ID             = $d['IMB_LCF_ID'];
            $recibo->IMB_RLT_DATACAIXA      = $d['IMB_RLT_DATACAIXA'];
            $recibo->IMB_RLT_FORMARECEBIMENTO  = $d['IMB_RLT_FORMARECEBIMENTO'];
            $recibo->IMB_RLT_DATACONTABIL   = $d['IMB_RLT_DATACAIXA'];
            $recibo->IMB_CTR_ID             = $d['IMB_CTR_ID'];
            $recibo->IMB_IMV_ID             = $idimv;
            $recibo->IMB_TBE_ID             = $idtbe;
            $recibo->FIN_CFC_ID             = $idcfc;
            $recibo->FIN_CCR_ID             = $d['FIN_CCR_ID'];
            $recibo->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $recibo->IMB_RLT_DTHEMISSAO     = date('Y/m/d');
            $recibo->IMB_IMB_ID2            = $idimb2;
            $recibo->IMB_FORPAG_ID          = $d['IMB_FORPAG_ID'];
            $recibo->IMB_RLT_DATALIMITE     = app('App\Http\Controllers\ctrRotinas')
                                    ->dataLimite( $idcontrato, $d['IMB_RLT_DATACOMPETENCIA'] );
            $recibo->FIN_LCX_DINHEIRO       = $d['FIN_LCX_DINHEIRO'];
            $recibo->FIN_LCX_CHEQUE         = $d['FIN_LCX_CHEQUE'];
            $recibo->IMB_RLT_PIX            = $d['IMB_RLT_PIX'];
            $recibo->FIN_CFC_ID             = $idcfc;
            $recibo->IMB_CLT_ID_LOCATARIO   = $idlocatario;
            $recibo->IMB_CLT_ID_LOCADOR     = $idlocador;
            $recibo->IMB_RLT_TROCO          = abs($d['IMB_RLT_TROCO']);
            $recibo->IMB_RLT_TROCOFUTURO          = $d['IMB_RLT_TROCOFUTURO'];
            if( $d['IMB_RLT_TROCOFUTURO'] == 'S')
            $recibo->IMB_RLT_TOTALRECIBO    = $recibo->FIN_LCX_DINHEIRO 
                + $recibo->FIN_LCX_CHEQUE ;
            else
                $recibo->IMB_RLT_TOTALRECIBO    = $recibo->FIN_LCX_DINHEIRO 
                                                + $recibo->FIN_LCX_CHEQUE 
                                                + $d['IMB_RLT_TROCO'];

            $recibo->save();
            if( $d['IMB_RLT_TROCO'] <> 0 )
              $troco = $d['IMB_RLT_TROCO'];
            if( $d['IMB_RLT_TROCOFUTURO'] =='S' )
                $trocofuturo = 'S';


            if( $d['IMB_LCF_ID'] == 0 )
            {
                $eve = mdlTabelaEvento::where( 'IMB_TBE_ID', '=', $idtbe )->first();

                $lf = new mdlLancamentoFuturo();
                $lf->IMB_IMB_ID              = Auth::user()->IMB_IMB_ID;
                $lf->IMB_CTR_ID              = $d['IMB_CTR_ID'];
                $lf->IMB_LCF_VALOR           = $d['IMB_RLT_VALOR'];
                $lf->IMB_LCF_LOCADORCREDEB   = $recibo->IMB_RLT_LOCADORCREDEB;
                $lf->IMB_LCF_LOCATARIOCREDEB = $recibo->IMB_RLT_LOCATARIOCREDEB;
                $lf->IMB_LCF_DATAVENCIMENTO  = $recibo->IMB_RLT_DATACOMPETENCIA;
                $lf->IMB_IMV_ID              = $recibo->IMB_IMV_ID ;
                $lf->IMB_CLT_IDLOCADOR       = $recibo->IMB_CLT_ID_LOCADOR;
                $lf->IMB_TBE_ID              =  $idtbe;
                $lf->IMB_ATD_ID              = Auth::user()->IMB_IMB_ID;
                $lf->IMB_LCF_INCMUL          = 'N';
                $lf->IMB_LCF_INCIRRF         = $eve->IMB_TBE_IRRF;
                $lf->IMB_LCF_INCTAX          = $eve->IMB_TBE_TAXAADM;
                $lf->IMB_LCF_INCJUROS        = $eve->IMB_TBE_JUROS;
                $lf->IMB_LCF_INCCORRECAO     = $eve->IMB_TBE_CORRECAO;
                $lf->IMB_LCF_GARANTIDO       = 'N';
                $lf->IMB_LCF_INCISS          = $eve->IMB_TBE_INCISS;
                $lf->IMB_LCF_OBSERVACAO      = $d['IMB_RLT_OBSERVACAO'];
                $lf->IMB_LCF_NUMEROCONTROLE  = '0';
                $lf->IMB_LCF_NUMPARREAJUSTE  = '0';
                $lf->IMB_LCF_NUMPARCONTRATO  = '0';
                $lf->IMB_LCF_CHAVE           = '0';
                $lf->IMB_LCF_TIPO            = 'A';
                $lf->IMB_LCF_DATARECEBIMENTO = $recibo->IMB_RLT_DATAPAGAMENTO;
                $lf->IMB_RLT_NUMERO          = $recibo->IMB_RLT_NUMERO;
                $lf->IMB_LCF_ORIGEM            = 'MANUAL';                
                $lf->save();

                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( $contrato->IMB_IMV_ID, $contrato->IMB_CTR_ID, 0, $recibo->IMB_RLT_NUMERO,0 , 'Lancamento automatico no  momento do recebimento
                - Evento: '.$eve->IMB_TBE_NOME.' - valor: '.$d['IMB_RLT_VALOR'].' - Vencimento: '.$recibo->IMB_RLT_DATACOMPETENCIA);
        
            }
        }

        if( $trocofuturo == 'S' )
        {
            $tbe = mdlTabelaEvento::where('IMB_TBE_ID','=',42)->first();

            $numerorecibo       = $recibo->IMB_RLT_NUMERO;
            $datapagamento      = $recibo->IMB_RLT_DATAPAGAMENTO  ;
            $datavencimento     = $recibo->IMB_RLT_DATACOMPETENCIA ;
            $formarecebimento   = $recibo->IMB_RLT_FORMARECEBIMENTO;
            $tiporecebimento    = $recibo->IMB_RLT_TIPORECEBIMENTO;
            $datacaixa          = $recibo->IMB_RLT_DATACAIXA;
            $datacontabil       = $recibo->IMB_RLT_DATACONTABIL;
            $idcontrato         = $recibo->IMB_CTR_ID;
            $idimovel           = $recibo->IMB_IMV_ID;
            $conta              = $recibo->FIN_CCR_ID;
            $formapagamento     = $recibo->IMB_FORPAG_ID;
            $totalrecebido      = $recibo->IMB_RLT_TOTALRECIBO ;
            $datalimite         = $recibo->IMB_RLT_DATALIMITE;
            $dinheiro           = $recibo->FIN_LCX_DINHEIRO;
            $cheque             = $recibo->FIN_LCX_CHEQUE;
            $idlocatario        = $recibo->IMB_CLT_ID_LOCATARIO;
            $idlocador          = $recibo->IMB_CLT_ID_LOCADOR;

            $idcfc = '';
            if( $tbe <> '' )
                $idcfc = $tbe->FIN_CFC_ID;

            $recibo = new mdlReciboLocatario;
            $recibo->IMB_RLT_NUMERO         = $numerorecibo;
            $recibo->IMB_RLT_DATAPAGAMENTO  =  $datapagamento;
            $recibo->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
            $recibo->IMB_RLT_DATACOMPETENCIA= $datavencimento;
            $recibo->IMB_RLT_LOCADORCREDEB  = 'N';
            $recibo->IMB_RLT_TIPORECEBIMENTO= $tiporecebimento;
            $recibo->IMB_LCF_ID             = 0;
            $recibo->IMB_RLT_DATACAIXA      = $datacaixa;
            $recibo->IMB_RLT_FORMARECEBIMENTO  = $formarecebimento;
            $recibo->IMB_RLT_DATACONTABIL   = $datacontabil;
            $recibo->IMB_CTR_ID             = $idcontrato;
            $recibo->IMB_IMV_ID             = $idimovel;
            $recibo->IMB_TBE_ID             = '42';
            $recibo->FIN_CFC_ID             = $idcfc;
            $recibo->FIN_CCR_ID             = $conta;
            $recibo->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
            $recibo->IMB_RLT_DTHEMISSAO     = date('Y/m/d');
            $recibo->IMB_IMB_ID2            = $contrato->IMB_IMB_ID2;
            $recibo->IMB_FORPAG_ID          = $formapagamento;
            $recibo->IMB_RLT_DATALIMITE     = $datalimite;
            $recibo->FIN_LCX_DINHEIRO       = $dinheiro;
            $recibo->FIN_LCX_CHEQUE         = $cheque;
            $recibo->IMB_CLT_ID_LOCATARIO   = $idlocatario;
            $recibo->IMB_CLT_ID_LOCADOR     = $idlocador;
            $recibo->IMB_RLT_TROCO          = abs($troco);
            $recibo->IMB_RLT_TROCOFUTURO    = 'S';
            $recibo->IMB_RLT_VALOR          = abs($troco);
            $recibo->IMB_RLT_TOTALRECIBO    = $dinheiro
                                            + $cheque;

            if( $troco > 0 )
            {

                
                $recibo->IMB_RLT_LOCATARIOCREDEB     = 'C';
                $recibo->IMB_RLT_OBSERVACAO          = 'Troco-Lançado em Débito Próximo Vencimento';
                $recibo->save();

                $lf = new mdlLancamentoFuturo();
                $lf->IMB_IMB_ID              = Auth::user()->IMB_IMB_ID;
                $lf->IMB_CTR_ID              = $contrato->IMB_CTR_ID;
                $lf->IMB_LCF_VALOR           = abs( $troco );
                $lf->IMB_LCF_LOCADORCREDEB   = 'N';
                $lf->IMB_LCF_LOCATARIOCREDEB = 'D';
                $lf->IMB_LCF_DATAVENCIMENTO  = app('App\Http\Controllers\ctrRotinas')
                                            ->addMeses( $contrato->IMB_CTR_DIAVENCIMENTO,  1,$recibo->IMB_RLT_DATACOMPETENCIA );
                $lf->IMB_IMV_ID              = $recibo->IMB_IMV_ID ;
                $lf->IMB_CLT_IDLOCADOR       = $recibo->IMB_CLT_ID_LOCADOR;
                $lf->IMB_TBE_ID              = 42;
                $lf->IMB_ATD_ID              = Auth::user()->IMB_IMB_ID;
                $lf->IMB_LCF_INCMUL          = 'N';
                $lf->IMB_LCF_INCIRRF         = 'N';
                $lf->IMB_LCF_INCTAX          = 'N';
                $lf->IMB_LCF_INCJUROS        = 'N';
                $lf->IMB_LCF_INCCORRECAO     = 'N';
                $lf->IMB_LCF_GARANTIDO       = 'N';
                $lf->IMB_LCF_INCISS          = 'N';
                $lf->IMB_LCF_OBSERVACAO      = 'Valor pendente no pagamento aterior';
                $lf->IMB_LCF_NUMEROCONTROLE  = '0';
                $lf->IMB_LCF_NUMPARREAJUSTE  = '0';
                $lf->IMB_LCF_NUMPARCONTRATO  = '0';
                $lf->IMB_LCF_CHAVE           = '0';
                $lf->IMB_LCF_TIPO            = 'A';
                $lf->IMB_LCF_ORIGEM            = 'MANUAL';                
                $lf->save();
            }
            if( $troco < 0 )
            {

                $recibo->IMB_RLT_LOCATARIOCREDEB     = 'D';
                $recibo->IMB_RLT_OBSERVACAO          = 'Troco-Lançado em Crédito Próximo Vencimento';
                $recibo->save();

                $lf = new mdlLancamentoFuturo();
                $lf->IMB_IMB_ID              = Auth::user()->IMB_IMB_ID;
                $lf->IMB_CTR_ID              = $contrato->IMB_CTR_ID;
                $lf->IMB_LCF_VALOR           = abs( $troco );
                $lf->IMB_LCF_LOCADORCREDEB   = 'N';
                $lf->IMB_LCF_LOCATARIOCREDEB = 'C';
                $lf->IMB_LCF_DATAVENCIMENTO  = app('App\Http\Controllers\ctrRotinas')
                                            ->addMeses( $contrato->IMB_CTR_DIAVENCIMENTO,  1,$recibo->IMB_RLT_DATACOMPETENCIA );
                $lf->IMB_IMV_ID              = $recibo->IMB_IMV_ID ;
                $lf->IMB_CLT_IDLOCADOR       = $recibo->IMB_CLT_ID_LOCADOR;
                $lf->IMB_TBE_ID              = 42;
                $lf->IMB_ATD_ID              = Auth::user()->IMB_IMB_ID;
                $lf->IMB_LCF_INCMUL          = 'N';
                $lf->IMB_LCF_INCIRRF         = 'N';
                $lf->IMB_LCF_INCTAX          = 'N';
                $lf->IMB_LCF_INCJUROS        = 'N';
                $lf->IMB_LCF_INCCORRECAO     = 'N';
                $lf->IMB_LCF_GARANTIDO       = 'N';
                $lf->IMB_LCF_INCISS          = 'N';
                $lf->IMB_LCF_OBSERVACAO      = 'Ressarcimento de valor pago a mais em recebimento anterior';
                $lf->IMB_LCF_NUMEROCONTROLE  = '0';
                $lf->IMB_LCF_NUMPARREAJUSTE  = '0';
                $lf->IMB_LCF_NUMPARCONTRATO  = '0';
                $lf->IMB_LCF_CHAVE           = '0';
                $lf->IMB_LCF_TIPO            = 'A';
                $lf->IMB_LCF_ORIGEM            = 'MANUAL';                
                $lf->save();
            }

        }

      //atualizando a data de recebimento da taxa de contrato
      $tb = "UPDATE IMB_LANCAMENTOFUTURO SET IMB_LCF_DATARECEBIMENTO = '$datapagamento', ".
      "IMB_RLT_NUMERO = '$numerorecibo' WHERE IMB_LCF_DATAVENCIMENTO = '$datavencimento' and ".
      "IMB_TBE_ID IN( 7,25) AND IMB_CTR_ID = $idcontrato";
      DB::statement("$tb");

        $cg = mdlCobrancaGeradaPerm::where( 'IMB_CGR_DATAVENCIMENTO','=',$dados[0]['IMB_RLT_DATACOMPETENCIA'])
        ->where('IMB_CTR_ID','=', $idcontrato )
        ->first();
        if( $cg <> '' )
        {
            $cg->IMB_CGR_DATABAIXA = $recibo->IMB_RLT_DATAPAGAMENTO;
            $cg->save();
        }


        app('App\Http\Controllers\ctrRotinas')
        ->gravarObs( $contrato->IMB_IMV_ID, $contrato->IMB_CTR_ID, 0, $recibo->IMB_RLT_NUMERO,0 , 'Baixa de recebimento - Vencto:  '.$dados[0]['IMB_RLT_DATACOMPETENCIA'] );

        if( $aluguel == 1 )
        {
            $proximovencimento =  app('App\Http\Controllers\ctrRotinas')
                ->addMeses( $contrato->IMB_CTR_DIAVENCIMENTO,  1,$dados[0]['IMB_RLT_DATACOMPETENCIA'] );
            $contrato->IMB_CTR_VENCIMENTOLOCATARIO = $proximovencimento;
            $contrato->save();

            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $contrato->IMB_IMV_ID, $contrato->IMB_CTR_ID, 0, $recibo->IMB_RLT_NUMERO,0 , 'Próximo Vencto Alterado para:  '.$proximovencimento );
    
        }

        return response()->json($recibo->IMB_RLT_NUMERO,200);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pegarRecibo( $id, $imprimir )
    {
        
        $rec = mdlReciboLocatario::select(
            [
                'IMB_RLT_ID',
                'IMB_CONTRATO.IMB_CTR_ID',
                'IMB_RECIBOLOCATARIO.IMB_IMV_ID',
                'IMB_RLT_DATACOMPETENCIA',
                'IMB_RLT_DATAPAGAMENTO',
                'IMB_RLT_NUMERO',
                'IMB_RLT_VALOR',
                'IMB_RECIBOLOCATARIO.IMB_TBE_ID',
                'IMB_TBE_NOME',
                'IMB_RLT_OBSERVACAO',
                'IMB_RLT_TOTALRECIBO',
                'FIN_LCX_DINHEIRO',
                'IMB_RLT_TROCO',
                'IMB_RLT_PIX',
                'FIN_LCX_CHEQUE',
                'FIN_PCT_NOSSONUMERO',
                'IMB_RECIBOLOCATARIO.IMB_IMV_ID',
                DB::raw('( SELECT IMB_CLT_NOME
                FROM IMB_CLIENTE,IMB_LOCATARIOCONTRATO
                WHERE IMB_LOCATARIOCONTRATO.IMB_CTR_ID = IMB_RECIBOLOCATARIO.IMB_CTR_ID
                AND IMB_LOCATARIOCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                AND IMB_LCTCTR_PRINCIPAL = "S" ) AS NOMELOCATARIO'),
                DB::raw('PEGALOCADORPRINCIPALIMV( IMB_RECIBOLOCATARIO.IMB_IMV_ID) AS NOMELOCADOR'),
                DB::raw('imovel( IMB_RECIBOLOCATARIO.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                DB::raw('( SELECT CEP_BAI_NOME
                FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_CONTRATO.IMB_IMV_ID ) AS BAIRROIMOVEL'),
                DB::raw('( SELECT IMB_IMV_CIDADE
                FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_CONTRATO.IMB_IMV_ID ) AS IMB_IMV_CIDADE'),
                'IMB_RLT_LOCATARIOCREDEB',
                DB::raw("(CASE WHEN IMB_RLT_LOCATARIOCREDEB = 'D'
                THEN '+' WHEN IMB_RLT_LOCATARIOCREDEB = 'C'
                THEN '-'
                ELSE ' ' END) AS MAISMENOS"),
                'IMB_CTR_DATALOCACAO',
                'IMB_CTR_DATAREAJUSTE',
                'IMB_IMB_NOME',
                'CEP_BAI_NOME',
                'CEP_UF_SIGLA',
                'CEP_CID_NOME',
                'IMB_IMB_CRECI',
                'IMB_IMB_URL',
                'IMB_FORPAG_ID',
                'IMB_CTR_REFERENCIA',
                DB::raw("CONCAT( COALESCE(IMB_IMB_ENDERECO,''),' ', COALESCE(IMB_IMB_ENDERECONUMERO,''),' ', COALESCE(IMB_IMB_ENDERECOCOMPLEMENTO,'')) ENDERECO"),
                DB::raw("CONCAT( COALESCE(IMB_IMB_TELEFONE1,''),' ', COALESCE(IMB_IMB_TELEFONE2,''),' ', COALESCE(IMB_IMB_TELEFONE3,'') ) TELEFONE"),

                ])
            ->leftJoin('IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCATARIO.IMB_TBE_ID')
            ->leftJoin('IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_RECIBOLOCATARIO.IMB_CTR_ID')
            ->leftJoin('IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID','IMB_RECIBOLOCATARIO.IMB_IMB_ID')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_RECIBOLOCATARIO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID );

        if( $id == 0 )
        {
            $max = mdlReciboLocatario::max( 'IMB_RLT_NUMERO');
            $rec = $rec->where( 'IMB_RLT_NUMERO','=',$max);
        }
        else
        $rec = $rec->where( 'IMB_RLT_NUMERO','=',$id);

        $rec = $rec->orderBy( 'IMB_TBE_ID','ASC')
            ->get();


        if( $imprimir == 'S' )
        {
            $param = app( 'App\Http\Controllers\ctrRotinas')->parametros( Auth::user()->IMB_IMB_ID );
            if( $param->IMB_PRM_MODRECLOCATARIO  == 'H' )
                $pdf=PDF::loadView('reports.recibos.locatario.recibolocatariocomresumorepasse', compact( 'rec') );
            else            
                $pdf=PDF::loadView('reports.recibos.locatario.recibolocatarionovaversao', compact( 'rec') );
            
            
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('recibolocatario.pdf');
            
        };

        return $rec;

    }

    public function carregarViewHistLt( $idcontrato )
    {
        return view( 'recebimento.historicolocatario', compact( 'idcontrato'));
    }


    public function carregarHistorico( $idcontrato, $tiporetorno )
    {
        $array =[];

        $header = mdlReciboLocatario::select(
            [

            'IMB_RLT_LOCATARIOCREDEB',
            'IMB_RLT_NUMERO',
            'IMB_RLT_DATAPAGAMENTO',
            'IMB_RLT_DATACOMPETENCIA',
            'IMB_RLT_DTHINATIVO',
            DB::raw( ' (select COALESCE(sum( IMB_RLT_VALOR), 0) from IMB_RECIBOLOCATARIO rt
            where rt.IMB_RLT_NUMERO = IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO
            and rt.IMB_RLT_LOCATARIOCREDEB = "D" ) -
            (select COALESCE( sum( IMB_RLT_VALOR),0 ) from IMB_RECIBOLOCATARIO rt
                        where rt.IMB_RLT_NUMERO = IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO
                        and rt.IMB_RLT_LOCATARIOCREDEB = "C" ) AS TOTAL '),
            DB::raw( '(select FIN_CCX_DESCRICAO FROM FIN_CONTACAIXA
                    WHERE FIN_CONTACAIXA.FIN_CCX_ID = FIN_CCR_ID) AS FIN_CCX_DESCRICAO'),
            ])
            ->where( 'IMB_CTR_ID','=',$idcontrato )
            ->orderBy( 'IMB_RLT_DATACOMPETENCIA','DESC')
            ->orderBy( 'IMB_RLT_DATAPAGAMENTO','DESC')
            ->orderBy( 'IMB_RLT_NUMERO')
            ->get();

            $recibo = '';
            foreach( $header as $reg)
            {

                if( $recibo <> $reg->IMB_RLT_NUMERO )
                {
                    array_push($array, $reg );
                    $recibo = $reg->IMB_RLT_NUMERO;

                }
            }



            if( $tiporetorno == 'json')
                return response()->json( $array,200);
            else
                return $array;


    }

    public function ultimoReciboLocatario()
    {
        $rt = mdlReciboLocatario::select( ['IMB_RLT_NUMERO'])
        ->where('IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->orderBy( 'IMB_RLT_ID','DESC' )
        ->first();

        return $rt->IMB_RLT_NUMERO;

    }

    public function planilhaRecebimento(Request $request)
    {

        $datainicio =  $request->datainicio;
        $datafim =   $request->datafim;
        $empresa = $request->IMB_IMB_ID;
        $origem =  $request->origem;
        $conta = $request->conta;
        $dimob =  $request->dimob;
        $destino = $request->destino;
        $metodologia = $request->metodologia;


        if( $datainicio=='') $datainicio = date( 'Y/m/d');
        if( $datafim=='') $datafim = date( 'Y/m/d');

        $par2 = mdlParametros2::find( Auth::user()->IMB_IMB_ID);

        
        if( $destino <> 'PREREPASSSE')
        {

            if( $par2->IMB_PRM_PLARECTCDATARECTO == 'S')
                $rec = mdlReciboLocatario::select(
                [
                    'IMB_RLT_NUMERO',
                    'IMB_CONTRATO.IMB_IMV_ID',
                    'IMB_CONTRATO.IMB_CTR_ID',
                    'IMB_CTR_REFERENCIA',
                    'IMB_RECIBOLOCATARIO.IMB_RLT_DATACOMPETENCIA',
                    'IMB_RECIBOLOCATARIO.IMB_RLT_DATAPAGAMENTO',
                    DB::raw('imovel( IMB_RECIBOLOCATARIO.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                    DB::raw('PEGALOCATARIOCONTRATO( IMB_RECIBOLOCATARIO.IMB_CTR_ID) AS NOMELOCATARIO'),
                    DB::raw('PEGALOCADORPRINCIPALIMV( IMB_CONTRATO.IMB_IMV_ID) AS NOMELOCADOR'),
                    DB::raw('PEGACPFLOCADORPRINCIPALIMV( IMB_CONTRATO.IMB_IMV_ID) AS CPFLOCADOR'),
                    DB::raw( "( SELECT RECEBIDOTOTALRECIBO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TOTALRECIBO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'8,5' ) ) AS DESCONTOS"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'17') ) AS IPTU"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'23') ) AS TARIFABOLETO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'18') ) AS IRRF"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                    DB::raw( "( select TAXACONTRATONORECIBOLOCATARIO( IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO )) AS TAXACONTRATO"),
                    DB::raw( "( select TAXAADMNORECIBOLOCATARIO( IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO )) AS TAXAADM"),
                    DB::raw( "( select RECEBIDOOUTROSEVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24,23,8,5,17,18,2,36,3,37,4,38' ) ) AS OUTROS")
                ])
                ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCATARIO.IMB_CTR_ID')
                ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID', 'IMB_CONTRATO.IMB_IMV_ID')
                ->where( 'IMB_RECIBOLOCATARIO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
                ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio)
                ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim)
                ->whereNull('IMB_RLT_DTHINATIVO');
            else
                $rec = mdlReciboLocatario::select(
                [
                    'IMB_RLT_NUMERO',
                    'IMB_CONTRATO.IMB_IMV_ID',
                    'IMB_CONTRATO.IMB_CTR_ID',
                    'IMB_CTR_REFERENCIA',
                    'IMB_RECIBOLOCATARIO.IMB_RLT_DATACOMPETENCIA',
                    'IMB_RECIBOLOCATARIO.IMB_RLT_DATAPAGAMENTO',
                    DB::raw('imovel( IMB_RECIBOLOCATARIO.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                    DB::raw('PEGALOCATARIOCONTRATO( IMB_RECIBOLOCATARIO.IMB_CTR_ID) AS NOMELOCATARIO'),
                    DB::raw('PEGALOCADORPRINCIPALIMV( IMB_CONTRATO.IMB_IMV_ID) AS NOMELOCADOR'),
                    DB::raw('PEGACPFLOCADORPRINCIPALIMV( IMB_CONTRATO.IMB_IMV_ID) AS CPFLOCADOR'),
                                    
                    DB::raw( "( SELECT RECEBIDOTOTALRECIBO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TOTALRECIBO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'8,5' ) ) AS DESCONTOS"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'17') ) AS IPTU"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'23') ) AS TARIFABOLETO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'18') ) AS IRRF"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                    DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                    DB::raw( "( select TAXACONTRATONORECIBOLOCATARIO( IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO )) AS TAXACONTRATO"),
                    DB::raw( "( select TAXAADMNORECIBOLOCATARIO( IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TAXAADM"),
                    DB::raw( "( select RECEBIDOOUTROSEVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24,23,8,5,17,18,2,36,3,37,4,38' ) ) AS OUTROS")
                ])
                ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCATARIO.IMB_CTR_ID')
                ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID', 'IMB_CONTRATO.IMB_IMV_ID')
                ->where( 'IMB_RECIBOLOCATARIO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
                ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio)
                ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim)
                ->whereNull('IMB_RLT_DTHINATIVO');


            if( $dimob == 'D' )
                $rec = $rec->where('IMB_IMV_RELIRRF','=','S' );

            if( $empresa)
            $rec = $rec->where('IMB_CONTRATO.IMB_IMB_ID2','=',$empresa );

            if( $conta <> '' )
                $rec = $rec->whereRaw( "CAST( FIN_CCR_ID AS INT ) = $conta ");

            $rec = $rec->distinct('IMB_RLT_NUMERO')
                ->orderBy( 'IMB_RLT_DATAPAGAMENTO')
                ->orderBy( 'IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO');

            Log::info( '***************************************************');
            Log::info( $rec->toSql());
            if( $destino == 'SINTETICO') 
            {
                $rec = $rec->get();
                return view('reports.admimoveis.recebidosperiodosintetico',compact( 'rec', 'datainicio','datafim') ) ;

            }
            return DataTables::of($rec)->make(true);
        }

        if( $destino == 'PREREPASSSE')
        {

            $rec = mdlReciboLocatario::select( 'IMB_RLT_NUMERO')
                ->distinct( 'IMB_RLT_NUMERO')
                ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
                ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio)
                ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim)
                ->whereNull('IMB_RLT_DTHINATIVO')
                ->orderBy( 'IMB_RLT_NUMERO');


            $tmprep = mdlTMPRecebimentoDia::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->delete();

            $rec = $rec->get();
            foreach( $rec as $r )
            {
                $numerorecibo = $r->IMB_RLT_NUMERO;
                $objrecibo =  mdlReciboLocatario::where( 'IMB_RLT_NUMERO','=', $numerorecibo )
                ->whereNull( 'IMB_RLT_DTHINATIVO')
                ->get();

                $totaldebitos =0;
                $totalcreditos = 0;
                foreach ( $objrecibo as $or )
                {
                    if( $or->IMB_RLT_LOCATARIOCREDEB == 'C')
                        $totalcreditos = $totalcreditos + $or->IMB_RLT_VALOR;
                    if( $or->IMB_RLT_LOCATARIOCREDEB == 'D')
                        $totaldebitos = $totaldebitos + $or->IMB_RLT_VALOR;
                }


                $tmprep = new mdlTMPRecebimentoDia;
                $tmprep->IMB_RLT_NUMERO             = $or->IMB_RLT_NUMERO;
                $tmprep->IMB_CTR_ID                 = $or->IMB_CTR_ID;
                $tmprep->IMB_IMV_ID                 = $or->IMB_IMV_ID;
                $tmprep->TMP_RRD_ENDERECOIMOVEL     = app( 'App\Http\Controllers\ctrRotinas')->imovelEndereco( $or->IMB_IMV_ID );
                $tmprep->TMP_RRD_NOMELOCATARIO      = app( 'App\Http\Controllers\ctrRotinas')->nomeLocatarioPrincipal( $or->IMB_CTR_ID );
                $tmprep->IMB_RLT_DATAPAGAMENTO      = $or->IMB_RLT_DATAPAGAMENTO;
                $tmprep->IMB_RLT_DATACOMPETENCIA    = $or->IMB_RLT_DATACOMPETENCIA;
                $tmprep->IMB_RLT_FORMAPAGAMENTO     = app( 'App\Http\Controllers\ctrRotinas')->formaPagamento( $or->IMB_FORPAG_ID );
                $tmprep->FIN_CCX_ID                 = $or->FIN_CCR_ID;
                $tmprep->IMB_TBE_ID                 = $or->IMB_TBE_ID;
                $tmprep->IMB_TBE_NOME               = app( 'App\Http\Controllers\ctrRotinas')->evento( $or->IMB_TBE_ID )->IMB_TBE_NOME;
                $tmprep->IMB_ATD_ID                 = Auth::User()->IMB_ATD_ID;
                $tmprep->CREDITOS                   = $totalcreditos;
                $tmprep->DEBITOS                    = $totaldebitos;
                $tmprep->IMB_CTR_REFERENCIA         = app( 'App\Http\Controllers\ctrRotinas')->pegarReferencia( $or->IMB_CTR_ID);
                $tmprep->TOTALRECIBO                =  $totaldebitos - $totalcreditos;
                $tmprep->save();
            }

            $tmprep = mdlTMPRecebimentoDia::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
            ->orderBy( 'IMB_RLT_DATAPAGAMENTO' )
            ->orderBy( 'IMB_CTR_ID' )
            ->get();

            return DataTables::of($tmprep)->make(true);

        }

        

    }

    public function totalRecebidoPeriodo( $datainicio, $datafim, $empresa, $conta )
    {

        $datainicio =  $datainicio;
        $datafim =$datafim;
        $conta = $conta;

        $tot =  mdlParametros::select(
            [
                DB::raw("(select RECEBIDOTOTALPERIODO('{$datainicio}', '{$datafim}', '{$empresa}',{$conta}' )) as total")
            ])->first();
        return $tot->total;
        //app('App\Http\Controllers\ctrReciboLocatario')->totalRecebidoPeriodo( $request->datafim);
    }

    public function estornar( Request $request )
    {
        $numero = $request->IMB_RLT_NUMERO;
        $cx = mdlLanctoCaixa::where('FIN_LCX_ORIGEM','=','RT')
                                ->where( 'FIN_LCX_RECIBO','=', $numero )->first();
        if( $cx <> '' )
        {
            if( $cx->FIN_LCX_CONCILIADO == 'S')
            {
                return response()->json('Permissão Negada! Já tem um lancamento no caixa como conciliado!',404);
            }
        }

        $items = mdlReciboLocatario::where('IMB_RLT_NUMERO','=', $numero )->get();

        if( $items[0]->IMB_RLT_DTHINATIVO )
          return response()->json('Já Estornado!',404);


        $nossonumero = $items[0]->FIN_PCT_NOSSONUMERO;

        $aluguel = 0;
        $idctr = $items[0]->IMB_CTR_ID;


        foreach( $items as $item )
        {
            if( $item->IMB_TBE_ID == 1 or $item->IMB_TBE_ID == 24 )
            {
               $aluguel = 1;
               $datavencimento = $item->IMB_RLT_DATACOMPETENCIA;
            }

        }

        $dataatual = date( 'Y-m-d');

        $atualizaritens = mdlReciboLocatario::
                    where('IMB_RLT_NUMERO', '=', $numero)
                    ->update(['IMB_RLT_DTHINATIVO' => $dataatual,
                              'IMB_ATD_IDINATIVO' => Auth::user()->IMB_ATD_ID ]);

        $atualizaritens = mdlLanctoCaixa::
                              where('FIN_LCX_RECIBO', '=', $numero)
                              ->where('FIN_LCX_ORIGEM','=', 'RT')
                              ->update(['FIN_LCX_DTHINATIVO' => $dataatual,
                                        'IMB_ATD_IDINATIVO' => Auth::user()->IMB_ATD_ID ]);

        $atualizaritens = mdlLancamentoFuturo::
            where('IMB_RLT_NUMERO', '=', $numero)
            ->update(['IMB_LCF_DATARECEBIMENTO' => null,
                      'IMB_RLT_NUMERO' => $numero ]);

        $deletarLF_A = mdlLancamentoFuturo::
                      where('IMB_RLT_NUMERO', '=', $numero)
                      ->where('IMB_LCF_TIPO','=','A')
                      ->whereNull('IMB_LCF_DATAPAGAMENTO')
                      ->delete();


        if( $aluguel == 1 )
        {
            $ctr = mdlContrato::find( $idctr );
            $ctr->IMB_CTR_VENCIMENTOLOCATARIO = $datavencimento;
            $ctr->save();
        }

        if( $nossonumero <> '')
        {
            $tb = "UPDATE IMB_COBRANCAGERADAPERM SET IMB_CGR_DATABAIXA = NULL  WHERE IMB_CGR_NOSSONUMERO = '$nossonumero'";
            DB::statement("$tb");
        }



        app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $idctr, 0, 0, 0, $numero, 'Estorno de recebimento '.
        ' do recibo numero: '.$numero.' data de vencimento: '.$datavencimento );


        return response()->json($numero,200);
    }

    public function recibosLocatarioPeriodo( Request $request )
    {
        $datainicio = $request->datainicio;
        $datafim    = $request->datafim;
        $conta      = $request->FIN_CCX_ID;
        $unidade    = $request->unidade;
        $selecao    = $request->selecao;

        $recibos = mdlReciboLocatario::select( 'IMB_RLT_NUMERO')
        ->distinct( 'IMB_RLT_NUMERO')
        ->orderBy( 'IMB_RLT_NUMERO');

        if( $unidade )
           $recibos = $recibos->where('IMB_RLT_DATAPAGAMENTO','>=', $datainicio )
           ->where('IMB_RLT_DATAPAGAMENTO','<=', $datafim );

        if( $conta )
            $recibos = $recibos->where('FIN_CCR_ID','=', $conta );

        if( $unidade )
        $recibos = $recibos->where('IMB_IMB_ID2','=', $unidade );

        if( $selecao =='A' )
            $recibos = $recibos->whereNull( 'IMB_RLT_DTHINATIVO');

        if( $selecao =='I' )
            $recibos = $recibos->whereNotNull( 'IMB_RLT_DTHINATIVO');

        $recibos = $recibos->get();

        return $recibos;

    }

    public function recebidoPeriodo( Request $request )
    {
        $datainicio =  $request->recperdatainicio;
        $datafim =   $request->recperdatafim;
        $empresa = $request->recperempresa;
        $origem = $request->origem;

        if( $datainicio=='') $datainicio = date( 'Y/m/d');
        if( $datafim=='') $datafim = date( 'Y/m/d');

        $rec = mdlReciboLocatario::select(
            [
                'IMB_RLT_NUMERO',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_RECIBOLOCATARIO.IMB_RLT_DATACOMPETENCIA',
                'IMB_RECIBOLOCATARIO.IMB_RLT_DATAPAGAMENTO',
                DB::raw( '( select IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO
                        WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_RECIBOLOCATARIO.IMB_FORPAG_ID) FORMAPAGAMENTO'),
                DB::raw('imovel( IMB_RECIBOLOCATARIO.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                DB::raw('PEGALOCATARIOCONTRATO( IMB_RECIBOLOCATARIO.IMB_CTR_ID) AS NOMELOCATARIO'),
                DB::raw('PEGALOCADORPRINCIPALIMV( IMB_CONTRATO.IMB_IMV_ID) AS NOMELOCADOR'),
                DB::raw( "( SELECT RECEBIDOTOTALRECIBO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TOTALRECIBO"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'8,5' ) ) AS DESCONTOS"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'17') ) AS IPTU"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'18') ) AS IRRF"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                DB::raw( "( select RECEBIDOOUTROSEVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24,8,5,17,18,2,36,3,37,4,38' ) ) AS OUTROS")
            ])
            ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCATARIO.IMB_CTR_ID')
            ->leftJoin( 'IMB_IMOVEL','IMB_IMOVEL.IMB_IMV_ID', 'IMB_CONTRATO.IMB_IMV_ID')
            ->where( 'IMB_RECIBOLOCATARIO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio)
            ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim)
            ->whereNull('IMB_RLT_DTHINATIVO');

        if( $empresa)
            $rec = $rec->where('IMB_CONTRATO.IMB_IMB_ID2','=',$empresa );

        $rec = $rec->distinct('IMB_RLT_NUMERO')
            ->orderBy( 'IMB_RLT_DATAPAGAMENTO')
            ->get();

        $datainicio = app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
        $datafim = app('App\Http\Controllers\ctrRotinas')->formatarData( $datafim );

       return view('reports.admimoveis.recebidosperiodo',compact( 'rec', 'datainicio','datafim') ) ;

       $pdf=PDF::loadView('reports.admimoveis.recebidosperiodo',compact( 'rec', 'datainicio','datafim') ) ;
       $pdf->setPaper('A4', 'portrait');
       return $pdf->stream('recebido_periodo.pdf');


    }

    function totaldoRecibo( $recibo )
    {
        $total = mdlReciboLocatario::select(
            [
                DB::raw( "( SELECT RECEBIDOTOTALRECIBO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TOTALRECIBO"),
            ]
        )->where( 'IMB_RLT_NUMERO','=', $recibo)
        ->first();

        return $total->TOTALRECIBO;


    }

    function itensdoRecibo( $recibo )
    {
        $itens = mdlReciboLocatario::select(
            [
                'IMB_RECIBOLOCATARIO.IMB_TBE_ID',
                'IMB_TBE_NOME',
                'IMB_RLT_OBSERVACAO',
                'IMB_RLT_LOCATARIOCREDEB',
                'IMB_RLT_VALOR'

            ]
        )->where( 'IMB_RLT_NUMERO','=', $recibo)
        ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_RECIBOLOCATARIO.IMB_TBE_ID')
        ->get();

        return $itens;

    }

    public function resumoRecebidoPeriodo( $datainicio, $datafim, $empresa, $conta )
    {

        $array =[];

        $datainicio = app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
        $datafim = app('App\Http\Controllers\ctrRotinas')->formatarData( $datafim );
        $rec = mdlReciboLocatario::select(
            [
                DB::raw( "( SELECT RECEBIDOTOTALRECIBO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TOTALRECIBO"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'8,5' ) ) AS DESCONTOS"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'17') ) AS IPTU"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'18') ) AS IRRF"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                DB::raw( "( select RECEBIDOOUTROSEVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24,8,5,17,18,2,36,3,37,4,38' ) ) AS OUTROS")
            ])
            ->where( 'IMB_RECIBOLOCATARIO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio)
            ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim)
            ->groupBy( 'IMB_RLT_NUMERO')
            ->whereNull('IMB_RLT_DTHINATIVO');

        if( $conta)
            $rec = $rec->where('FIN_CCR_ID','=',$conta );


        if( $empresa)
            $rec = $rec->where('IMB_RECIBOLOCATARIO.IMB_IMB_ID2','=',$empresa );

        $rec = $rec->get();



        $totalrecibo=0;
        $totalaluguel=0;
        $totaldesconto=0;
        $totaliptu=0;
        $totalirrf=0;
        $totalmulta=0;
        $totaljuros=0;
        $totalcorrecao=0;
        $totaloutros=0;
        foreach($rec as $item )
        {
            $totalrecibo = $totalrecibo + $item->TOTALRECIBO;
            $totalaluguel = $totalaluguel + $item->VALORALUGUEL;
            $totaldesconto = $totaldesconto + $item->DESCONTOS;
            $totaliptu = $totaliptu + $item->IPTU;
            $totalirrf = $totalirrf + $item->IRRF;
            $totalmulta = $totalmulta + $item->MULTAATRASO;
            $totaljuros = $totaljuros + $item->JUROSATRASO;
            $totalcorrecao = $totalcorrecao + $item->CORRECAOMONETARIA;
            $totaloutros = $totaloutros + $item->OUTROS;
        }

        $array =
        [
            number_format($totalaluguel,2,",","."),
            number_format($totaldesconto,2,",","."),
            number_format($totaliptu,2,",","."),
            number_format($totalirrf,2,",","."),
            number_format($totalmulta,2,",","."),
            number_format($totaljuros,2,",","."),
            number_format($totalcorrecao,2,",","."),
            number_format($totalrecibo,2,",","."),
            number_format($totalrecibo,2,",",".")

        ];

        return $array;

    }

    public function extratoRecebimentoLocatario( $idcontrato, $datainicio, $datafim, $enviaremail, $email )
    {
        $recibos = mdlReciboLocatario::select(
            [
                'IMB_RLT_NUMERO',
                'IMB_CTR_REFERENCIA',
                'IMB_CONTRATO.IMB_IMV_ID',
                DB::Raw( 'imovel( IMB_CONTRATO.IMB_IMV_ID ) as endereco'),
                DB::Raw(' PEGALOCATARIOCONTRATO(IMB_CONTRATO.IMB_CTR_ID) Locatario')
            ]
        )
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_RECIBOLOCATARIO.IMB_CTR_ID')
        ->where( 'IMB_RECIBOLOCATARIO.IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio )
        ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim )
        ->distinct('IMB_RLT_NUMERO')
        ->get();  

        
        if ( $recibos == '[]'  ) return '';

        if( $enviaremail == 'S' )
        {

            $idlocatario = app( 'App\Http\Controllers\ctrRotinas')->codigoLocatarioPrincipal( $idcontrato );
            $cliente = mdlCliente::find( $idlocatario );
            if( $email <> $cliente->IMB_CLT_EMAIL )
            {
                $cliente->IMB_CLT_EMAIL = $email;
                $cliente->save();
            }

            $email = $email.';'.env('APP_MAILBOLETOCOPIA');
            $array = explode(";",$email);

            foreach( $array as $a )
            {
                $a=str_replace( ';','',$a);

                if( $a <> '' )
                {
                    $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                    $html = view( 'reports.locatario.extratolocatario',compact( 'recibos', 'datainicio', 'datafim'));
                    $nomecliente = $cliente->IMB_CLT_NOME;
                
                    Mail::send('mail.mailextratolocatario', compact( 'nomecliente', 'datainicio','datafim' ) ,
                    function( $message ) use ($a, $html)
                    {

                        $pdf=PDF::loadHtml( $html,'UTF-8');
                        $message->attachData($pdf->output(), 'extrato_pagamento_aluguel.pdf');
                        $message->to( $a );
                        $message->subject('Extrato de Pagamento de Aluguéres');
                    });
                    app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $idcontrato,0,0,0,"Extrato de Pagamentos enviado ao locatário do periodo $datainicio a $datafim - email: $a");
                }

            }
            return response()->json('ok',200);
        }

        $html = view( 'reports.locatario.extratolocatario',compact( 'recibos', 'datainicio', 'datafim'));
        $pdf=PDF::loadHtml( $html,'UTF-8');
        return $pdf->stream('extratorecebimentos.pdf');
        
    }

    public function jaRecebido( $idcontrato, $vencimento)
    {
        //Log::info( "id contrato ".$idcontrato );
        //Log::info( "vencimento ".$vencimento );
        $rlt = mdlReciboLocatario::where(   'IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_RLT_DATACOMPETENCIA','=', $vencimento )
        ->whereNull( 'IMB_RLT_DTHINATIVO')
        ->sum('IMB_RLT_VALOR');

        return $rlt;

    }

    public function boletoJaRecebido( $idcontrato, $nossonumero, $idcgr)
    {
        $cgi = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=', $idcgr )
        ->whereRaw( 'COALESCE(IMB_COBRANCAGERADAITEMPERM.IMB_LCF_ID,0) <> 0 ')
        ->leftJoin( 'IMB_RECIBOLOCATARIO', 'IMB_RECIBOLOCATARIO.IMB_LCF_ID', 'IMB_COBRANCAGERADAITEMPERM.IMB_LCF_ID')
        ->first();

        $retorno = 0;

        if( $cgi <> '' )
        {
            Log::info('************************************************');
            Log::info( 'recibo '.$cgi->IMB_RLT_NUMERO);
            
    
            if( $cgi->IMB_RLT_NUMERO <> '' )
            {
                $rlt = collect( DB::select("select RECEBIDOTOTALRECIBO($cgi->IMB_RLT_NUMERO) as rlt "))->first();
                if( $rlt <> '')
                $retorno = floatval($rlt->rlt) ;
            }
        }

        Log::info( 'retorno '.$retorno );
        return $retorno;

    }


    public function recebidoDetalhado( Request $request )
    {

        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $recs = mdlReciboLocatario::where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio )
        ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim )
        ->distinct('IMB_RLT_NUMERO')
        ->get();


        foreach( $recs as $rec)
        {

            $recibos = mdlReciboLocatario::where( 'IMB_RLT_NUMERO','=', $rec->IMB_IMB_RLT_NUMERO )->get();

            foreach( $recibos as $recibo )
            {
                $totais = mdlRecibolocatario::select(
                    [
                        DB::raw( "( SELECT RECEBIDOTOTALRECIBO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO ) ) AS TOTALRECIBO"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'8,5' ) ) AS DESCONTOS"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'17') ) AS IPTU"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'18') ) AS IRRF"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'23') ) AS TARIFABOLETO"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                        DB::raw( "( select RECEBIDOPOREVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                        DB::raw( "( select RECEBIDOOUTROSEVENTO(IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO,'1,24,8,23,5,17,18,2,36,3,37,4,38' ) ) AS OUTROS")
                    ]
                    )
                ->where( 'IMB_RLT_NUMERO','=', $recibo->IMB_RLT_NUMERO )
                ->get();


            }
    


        }


        return $mont;


    }

    public function alterarDataPagto( Request $request )
    {

       $data = $request->novadata;
       $recibo = $request->recibo;

       $rlt = mdlRecibolocatario::where( 'IMB_RLT_NUMERO','=', $request->recibo)->first();
       if( $rlt <> ' ')
       {

           app('App\Http\Controllers\ctrRotinas')  
           ->gravarObs( $rlt->IMB_IMV_ID, $rlt->IMB_CTR_ID, 0, $recibo,0 , 'Alterado a data de pagamento do recibo '.$recibo.
           ' vencimento '.date('d/m/Y', strtotime($rlt->IMB_RLT_DATACOMPETENCIA) ).', de '.date('d/m/Y', strtotime( $rlt->IMB_RLT_DATACOMPETENCIA) ).
           " para data('d/m/Y', strtodate( $rlt->IMB_RLT_DATACOMPETENCIA) )");
            $sql = "UPDATE IMB_RECIBOLOCATARIO SET IMB_RLT_DATAPAGAMENTO = '$data' where IMB_RLT_NUMERO = $recibo";
            DB::statement("$sql");
       }

       return response()->json('ok',200);

    }



}
