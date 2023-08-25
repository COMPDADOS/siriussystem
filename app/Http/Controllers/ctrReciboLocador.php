<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContrato;
use App\mdlLancamentoFuturo;
use App\mdlTabelaEvento;
use App\mdlReciboLocador;
use App\mdlReciboLocadorControle;
use App\mdlPropImovel;
use App\mdlLanctoCaixa;
use App\mdlCaTran;
use App\mdlCliente;
use App\mdlParametros;
use App\mdlParametros2;

use App\mdlFormaPagamento;
use App\mdlTmpPlanilhaDeposito;
use App\mdlDimob;
use App\mdlImobiliaria;
use App\mdlImovel;
use App\mdlNFSE;

use Illuminate\Support\Facades\Mail;
use DB;
use Auth;
use PDF;
use DataTables;
use DateTime;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Illuminate\Support\Facades\URL;
use SplFileObject;
use Log;
class ctrReciboLocador extends Controller
{
    public function store(Request $request)
    {
        $dados = $request->dados;

        $par  = mdlParametros::find( Auth::user()->IMB_IMB_ID );
        $par->IMB_PRM_NUMEROPROCESSO = $par->IMB_PRM_NUMEROPROCESSO + 1;
        $par->save();
      
        $sbclocacao = $par->FIN_SBC_IDLOCACAO;
        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }

        $idcontrato =$dados[0]['IMB_CTR_ID'];
        $dvencimento=$dados[0]['IMB_RLD_DATAVENCIMENTO'];
        $idlocatario = collect( DB::select("select PEGACODIGOLOCATARIOCONTRATO('$idcontrato') as id "))->first()->id;

        $contrato   = mdlContrato::find( $idcontrato );
        $idimv      = $contrato->IMB_IMV_ID;
        $idimb2     = $contrato->IMB_IMB_ID2;
        $idcfc      ='';

        $lTemAluguel='N';

        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=',$idimv )->get();

        foreach( $ppi as $p )
        {

            $rd = mdlRecibolocadorControle::where( 'IMB_PRM_RECIBOLOCADOR','>',0)->first();
            if( $rd == '' )
            {
                $rd = new mdlRecibolocadorControle;
                $rd->IMB_PRM_RECIBOLOCADOR = 0;
            }

            $rd->IMB_PRM_RECIBOLOCADOR = $rd->IMB_PRM_RECIBOLOCADOR + 1;
            $rd->save();
            $numerorecibo = $rd->IMB_PRM_RECIBOLOCADOR;

            $cliente = mdlCliente::find( $p->IMB_CLT_ID);

            $lcx = new mdlLanctoCaixa;
            $lcx->FIN_LCX_DATACADASTRO              = date( 'Y/m/d');
            $lcx->FIN_LCX_DATAEMISSAO               = date( 'Y/m/d');
            $lcx->FIN_LCX_DATAENTRADA               = $dados[0]['IMB_RLD_DATAPAGAMENTO'];
            $lcx->FIN_LCX_OPERACAO                  = 'D';
            $lcx->FIN_LCX_VALOR                     = 0;
            $lcx->FIN_LCX_ORIGEM                    ='RD';
            $lcx->FIN_LCX_RECIBO                    = $numerorecibo;
            $lcx->IMB_IMB_ID                        = Auth::user()->IMB_IMB_ID;
            $lcx->FIN_LCX_HISTORICO                 = 'Repasse vencto '.app( 'App\Http\Controllers\ctrRotinas')->formatarData($dados[0]['IMB_RLD_DATAVENCIMENTO']).', Pasta: '.$contrato->IMB_CTR_REFERENCIA.' - Imóvel: '.$contrato->IMB_IMV_ID;
            $lcx->FIN_CCX_ID                        = $dados[0]['FIN_CCR_ID'];
            $lcx->FIN_LCX_COMPETENCIA               = $dados[0]['IMB_RLD_DATAVENCIMENTO'];
            $lcx->IMB_ATD_IDINCLUSAO                = Auth::user()->IMB_ATD_ID;
            $lcx->IMB_IMV_ID                        = $contrato->IMB_IMV_ID;
            $lcx->FIN_LCX_FORMA                     = $dados[0]['IMB_RLD_FORMAPAGAMENTO'];
            $lcx->FIN_LCX_DINHEIRO                  = 0;
            if( $dados[0]['FIN_LCX_CHEQUE'] == 'NaN' )
                $lcx->FIN_LCX_CHEQUE         = 0;
            else
                $lcx->FIN_LCX_CHEQUE         = $dados[0]['FIN_LCX_CHEQUE'];            
            $lcx->imb_imb_id2                       = Auth::user()->IMB_IMB_ID;
            $lcx->FIN_LCX_CONCILIADO                = 'S';
            $lcx->save();

            $sequencia = 0;
            $total = 0;
            foreach ($dados as $d)
            {


                $idlcf      = $d['IMB_LCF_ID'];
                $idtbe      = $d['IMB_TBE_ID'];
                $idlocador  = $d['IMB_CLT_IDLOCADOR'];
                //Log::info( "id locador: $idlocador");
                //Log::info( "tbe: $idtbe ");
                ////Log::info( 'locador: '.$idlocador );

                if( $idtbe == 1 or $idtbe == 24 ) $lTemAluguel = 'S';

                if( $idlcf <> 0 )
                {
                    $lf         = mdlLancamentoFuturo::find( $idlcf );
                    $idcfc      = $lf->FIN_CFC_ID;
                }

                $eve        = mdlTabelaEvento::where( 'IMB_TBE_ID', '=', $idtbe )->first();
                if( $eve == '' ) $idcfc == 'NDA';

                if( $idcfc == '' and $eve <> '' )
                    $idcfc = $eve->FIN_CFC_ID;

                $gravar = 'S';

                $recibo = new mdlReciboLocador;
                $recibo->IMB_RLD_NUMERO         = $numerorecibo;
                $recibo->IMB_RLD_DATAPAGAMENTO  = formatarData($d['IMB_RLD_DATAPAGAMENTO']);
                $recibo->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                $recibo->IMB_IMB_ID2            = Auth::user()->IMB_IMB_ID;
                $recibo->IMB_RLD_DATAVENCIMENTO = formatarData($d['IMB_RLD_DATAVENCIMENTO']);
                $recibo->IMB_RLD_LOCATARIOCREDEB= $d['IMB_RLD_LOCATARIOCREDEB'];
                $recibo->IMB_RLD_LOCADORCREDEB  = $d['IMB_RLD_LOCADORCREDEB'];
                if( $idlocador > 0 )
                {
                    //Log::info( 'direcinando para '.$idlocador );
                    if( $idlocador == $p->IMB_CLT_ID )
                        $recibo->IMB_RLD_VALOR          = $d['IMB_RLD_VALOR'] ;
                    else
                        $gravar = 'N';
                }
                else
                $recibo->IMB_RLD_VALOR          = $d['IMB_RLD_VALOR'] * $p->IMB_IMVCLT_PERCENTUAL4 / 100;

                $recibo->IMB_RLD_OBSERVACAO     = $d['IMB_RLD_OBSERVACAO'];
                $recibo->IMB_RLD_TIPO           = $d['IMB_RLD_TIPO'];
                $recibo->IMB_LCF_ID             = $d['IMB_LCF_ID'];
                $recibo->IMB_RLD_FORMAPAGAMENTO  = $d['IMB_RLD_FORMAPAGAMENTO'];
                $recibo->IMB_RLD_DATACAIXA    = formatarData($d['IMB_RLD_DATACAIXA']);
                $recibo->IMB_CTR_ID             = $idcontrato;
                $recibo->IMB_IMV_ID             = $idimv;
                $recibo->IMB_TBE_ID             = $idtbe;
                $recibo->FIN_CFC_ID             = $idcfc;
                $recibo->FIN_CCR_ID             = $d['FIN_CCR_ID'];
                $recibo->IMB_ATD_ID             = Auth::user()->IMB_IMB_ID;
                $recibo->IMB_RLD_DTHEMISSAO     = date('Y/m/d');
                $recibo->IMB_FORPAG_ID          = $d['IMB_FORPAG_ID'];
                if( $d['IMB_RLD_TOTALRECIBO'] == 'NaN' )
                    $recibo->IMB_RLD_TOTALRECIBO    = 0;
                else
                    $recibo->IMB_RLD_TOTALRECIBO    = $d['IMB_RLD_TOTALRECIBO'];

                if( $d['FIN_LCX_CHEQUE'] == 'NaN' )
                    $recibo->FIN_LCX_CHEQUE         = 0;
                else
                    $recibo->FIN_LCX_CHEQUE         = $d['FIN_LCX_CHEQUE'];
                $recibo->FIN_CFC_ID             = $idcfc;
                $recibo->IMB_CLT_ID_LOCATARIO   = $idlocatario;
                $recibo->IMB_CLT_ID     = $p->IMB_CLT_ID;

                if( $contrato->IMB_CTR_REPASSEDIAFIXO <> '' and  $contrato->IMB_CTR_REPASSEDIAFIXO <> 0 )
                {
                    $recibo->IMB_CTR_PROXIMOREPASSE =
                                app('App\Http\Controllers\ctrRotinas')
                                    ->addMeses( $contrato->IMB_CTR_REPASSEDIAFIXO,  1,$d['IMB_RLD_DATAVENCIMENTO'] );
                    $recibo->IMB_CTR_DATAREPASSEFIXO = $contrato->IMB_CTR_PROXIMOREPASSE;

                }
    
                $recibo->IMB_PRM_NUMEROPROCESSO = $par->IMB_PRM_NUMEROPROCESSO;
                if( $gravar == 'S')
                {
                    $recibo->save();

                    //salvar no catran

                    if( $d['IMB_RLD_LOCADORCREDEB'] == 'C' ) 
                        $total = $total + $d['IMB_RLD_VALOR'];
                    else
                    if( $d['IMB_RLD_LOCADORCREDEB'] == 'D' ) 
                        $total = $total - $d['IMB_RLD_VALOR'];

                    $sequencia = $sequencia +1;
                    $catran = new mdlCaTran;
                    $catran->FIN_LCX_ID                 = $lcx->FIN_LCX_ID;
                    $catran->FIN_CAT_SEQUENCIA          = $sequencia;
                    if( $d['IMB_RLD_LOCADORCREDEB'] == 'C')
                        $catran->FIN_CAT_OPERACAO = 'D';
                    if( $d['IMB_RLD_LOCADORCREDEB'] == 'D')
                        $catran->FIN_CAT_OPERACAO = 'C';
                    $catran->FIN_CAT_VALOR      = $d['IMB_RLD_VALOR'];
                    $catran->FIN_CFC_ID        = $recibo->FIN_CFC_ID;
                    $catran->FIN_SBC_ID         = $sbclocacao;
                    $catran->save();


                    if( $d['IMB_LCF_ID'] == 0 )
                    {
                        $parcelacontrato =  app('App\Http\Controllers\ctrLancamentoFuturo')
                        ->pegarNumeroParcelaConformeVencimento(
                            $idcontrato, $d['IMB_RLD_DATAVENCIMENTO'] );

                        $eve = mdlTabelaEvento::where( 'IMB_TBE_ID', '=', $d['IMB_TBE_ID'] )->first();

                        $lf = new mdlLancamentoFuturo();


                        $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                        $lf->IMB_CTR_ID = $idcontrato;
                        $lf->IMB_LCF_VALOR           = $recibo->IMB_RLD_VALOR;
                        $lf->IMB_LCF_LOCADORCREDEB   = $recibo->IMB_RLD_LOCADORCREDEB;
                        $lf->IMB_LCF_LOCATARIOCREDEB = $recibo->IMB_RLD_LOCATARIOCREDEB;
                        $lf->IMB_LCF_DATAVENCIMENTO  = $recibo->IMB_RLD_DATAVENCIMENTO;
                        $lf->IMB_IMV_ID              = $recibo->IMB_IMV_ID ;
                        $lf->IMB_TBE_ID              = $d['IMB_TBE_ID'];
                        $lf->IMB_ATD_ID              = Auth::user()->IMB_IMB_ID;
                        $lf->IMB_LCF_INCIRRF         = $eve->IMB_TBE_IRRF;
                        $lf->IMB_LCF_INCTAX          = $eve->IMB_TBE_TAXAADM;
                        $lf->IMB_LCF_INCJUROS        = $eve->IMB_TBE_JUROS;
                        $lf->IMB_LCF_INCCORRECAO     = $eve->IMB_TBE_CORRECAO;
                        $lf->IMB_LCF_INCISS          = $eve->IMB_TBE_INCISS;

                        $lf->IMB_LCF_OBSERVACAO      = $d['IMB_RLD_OBSERVACAO'];
                        $lf->IMB_LCF_NUMEROCONTROLE  = '0';
                        $lf->IMB_LCF_NUMPARREAJUSTE  = '0';
                        $lf->IMB_LCF_NUMPARCONTRATO  = $parcelacontrato;
                        $lf->IMB_LCF_CHAVE           = '0';
                        $lf->IMB_LCF_TIPO            = 'A';
                        $lf->IMB_CLT_IDLOCADOR       = $p->IMB_CLT_ID;;
                        $lf->IMB_LCF_DATAPAGAMENTO = $recibo->IMB_RLD_DATAPAGAMENTO;
                        $lf->IMB_RLD_NUMERO          = $recibo->IMB_RLD_NUMERO;
                        $lf->save();
                    }
                    else 
                    {
        
                        $tb =   "UPDATE IMB_LANCAMENTOFUTURO ".
                                "SET IMB_LANCAMENTOFUTURO.IMB_LCF_PAGO ='S', ".
                                "IMB_LANCAMENTOFUTURO.IMB_LCF_DATAPAGAMENTO = '$lcx->FIN_LCX_DATAENTRADA', ".
                                "IMB_LANCAMENTOFUTURO.IMB_RLD_NUMERO = '$recibo->IMB_RLD_NUMERO' ".
                                " WHERE IMB_LANCAMENTOFUTURO.IMB_LCF_ID = $lf->IMB_LCF_ID";
                        DB::statement("$tb");
                    }
                }


            }
            $lcx->FIN_LCX_VALOR = $total;
            $lcx->save();

        }
        app('App\Http\Controllers\ctrRotinas')
        ->gravarObs(  $contrato->IMB_IMV_ID,  $contrato->IMB_CTR_ID,0,0,0,'Repasse realizado - Vencto:  '.app( 'App\Http\Controllers\ctrRotinas')->formatarData($dados[0]['IMB_RLD_DATAVENCIMENTO']));

        //gerando a nfe
        $nfs = mdlNFSE::where( 'IMB_RLD_NUMERO','=', $recibo->IMB_RLD_NUMERO)->first();
        if( $nfs == '' )
        {
            $param2 = mdlParametros2::where( 'IMB_IMB_ID','=', $recibo->IMB_IMB_ID2 )->first();
            if( $param2->IMB_PRM_NFEAOBAIXAR == 'S' )
            {
                //Log::info( 'Acessando o gerarNFSew');
                $retorno = app('App\Http\Controllers\ctrIntegraNota')->gerarNfs( $numerorecibo );


            }
        }

        if($lTemAluguel=='S')
        {

            if( $contrato->IMB_CTR_REPASSEDIAFIXO <> '' and  $contrato->IMB_CTR_REPASSEDIAFIXO <> 0 )
            {
                $proximovencimento =  app('App\Http\Controllers\ctrRotinas')
                ->addMeses( $contrato->IMB_CTR_REPASSEDIAFIXO,  1,$contrato->IMB_CTR_PROXIMOREPASSE  );
                $contrato->IMB_CTR_PROXIMOREPASSE = $proximovencimento;
            }

            $proximovencimento =  app('App\Http\Controllers\ctrRotinas')
                ->addMeses( $contrato->IMB_CTR_DIAVENCIMENTO,  1,$dvencimento  );
            $contrato->IMB_CTR_VENCIMENTOLOCADOR = $proximovencimento;
            $contrato->save();
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs(  $contrato->IMB_IMV_ID,  $contrato->IMB_CTR_ID,0,0,0,'Mudou para o próximo vencto  '.app( 'App\Http\Controllers\ctrRotinas')->formatarData($proximovencimento));
    
        }

        return response()->json($recibo->IMB_RLD_NUMERO ,200);

    }

    public function carregarViewHistLd( $idcontrato )
    {
        return view( 'repasse.historicolocador', compact( 'idcontrato'));
    }

    public function carregarHistorico( $idcontrato, $tiporetorno  )
    {

        $array = [];
        $header = mdlReciboLocador::select(
            [

            'IMB_RLD_LOCADORCREDEB',
            'IMB_RLD_NUMERO',
            'IMB_RLD_DATAPAGAMENTO',
            'IMB_RLD_DATAVENCIMENTO',
            'IMB_RLD_DTHINATIVO',
            'IMB_CLT_NOME',
            DB::raw( ' (select COALESCE(sum( IMB_RLD_VALOR), 0) from IMB_RECIBOLOCADOR rd
            where rd.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO
            and rd.IMB_RLD_LOCADORCREDEB = "C" ) -
            (select COALESCE( sum( IMB_RLD_VALOR),0 ) from IMB_RECIBOLOCADOR rd
                        where rd.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO
                        and rd.IMB_RLD_LOCADORCREDEB = "D" ) AS TOTAL '),
            DB::raw( '(select FIN_CCX_DESCRICAO FROM FIN_CONTACAIXA
                    WHERE FIN_CONTACAIXA.FIN_CCX_ID = FIN_CCR_ID) AS FIN_CCX_DESCRICAO'),
            ])
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_RECIBOLOCADOR.IMB_CLT_ID')
            ->where( 'IMB_CTR_ID','=',$idcontrato )
            ->orderBy( 'IMB_RLD_DATAVENCIMENTO','desc')
            ->orderBy( 'IMB_RLD_NUMERO','ASC')
            ->get();



        $recibo = '';
        foreach( $header as $reg)
        {

            if( $recibo <> $reg->IMB_RLD_NUMERO )
            {
                array_push($array, $reg );
                $recibo = $reg->IMB_RLD_NUMERO;

            }



        }

        if( $tiporetorno == 'json')
                return response()->json( $array,200);
            else
                return $array;

    }

    public function pegarRecibo( $id, $imprimir )
    {
        $rec = mdlReciboLocador::select(
            [
                'IMB_RLD_ID',
                'IMB_RECIBOLOCADOR.IMB_CLT_ID',
                'IMB_RECIBOLOCADOR.IMB_IMV_ID',
                'IMB_RLD_DATAVENCIMENTO',
                'IMB_RLD_DATAPAGAMENTO',
                'IMB_RLD_NUMERO',
                'IMB_RLD_VALOR',
                'IMB_RECIBOLOCADOR.IMB_TBE_ID',
                'IMB_TBE_NOME',
                'IMB_RLD_OBSERVACAO',
                'IMB_RLD_TOTALRECIBO',
                'FIN_LCX_DINHEIRO',
                'FIN_LCX_CHEQUE',
                DB::raw('( SELECT IMB_CLT_NOME
                FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
                IMB_RECIBOLOCADOR.IMB_CLT_ID_LOCATARIO ) AS NOMELOCATARIO'),
                DB::raw('( SELECT IMB_CLT_CPF
                FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
                IMB_RECIBOLOCADOR.IMB_CLT_ID_LOCATARIO ) AS CPFLOCATARIO'),
                DB::raw('( SELECT IMB_CLT_NOME
                FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
                IMB_RECIBOLOCADOR.IMB_CLT_ID ) AS NOMELOCADOR'),
                DB::raw('imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                DB::raw('( SELECT CEP_BAI_NOME
                FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_CONTRATO.IMB_IMV_ID ) AS BAIRROIMOVEL'),
                DB::raw('( SELECT IMB_IMV_CIDADE
                FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_CONTRATO.IMB_IMV_ID ) AS IMB_IMV_CIDADE'),
                'IMB_RLD_LOCADORCREDEB',
                DB::raw("(CASE WHEN IMB_RLD_LOCADORCREDEB = 'D'
                THEN '-' WHEN IMB_RLD_LOCADORCREDEB = 'C'
                THEN '+'
                ELSE ' ' END) AS MAISMENOS"),
                'IMB_CTR_DATALOCACAO',
                'IMB_CTR_DATAREAJUSTE',
                'IMB_IMB_NOME',
                'CEP_BAI_NOME',
                'CEP_UF_SIGLA',
                'CEP_CID_NOME',
                'IMB_IMB_CRECI',
                'IMB_IMB_URL',
                'IMB_CTR_REFERENCIA',
                DB::raw("CONCAT( COALESCE(IMB_IMB_ENDERECO,''),' ', COALESCE(IMB_IMB_ENDERECONUMERO,''),' ', COALESCE(IMB_IMB_ENDERECOCOMPLEMENTO,'')) ENDERECO"),
                DB::raw("CONCAT( COALESCE(IMB_IMB_TELEFONE1,''),' ', COALESCE(IMB_IMB_TELEFONE2,''),' ', COALESCE(IMB_IMB_TELEFONE3,'') ) TELEFONE"),

                ])
            ->leftJoin('IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCADOR.IMB_TBE_ID')
            ->leftJoin('IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_RECIBOLOCADOR.IMB_CTR_ID')
            ->leftJoin('IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID','IMB_RECIBOLOCADOR.IMB_IMB_ID')
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID);

            if( $id == 0 )
            {
                $max = mdlReciboLocador::max( 'IMB_RLD_NUMERO');
                $rec = $rec->where( 'IMB_RLD_NUMERO','=',$max);
            }
            else
            $rec = $rec->where( 'IMB_RLD_NUMERO','=',$id);

            $rec = $rec->orderBy( 'IMB_TBE_ID','ASC')
                ->get();

        $ppi = mdlPropImovel::select( 
            [
                '*',
                DB::Raw( '(SELECT GER_BNC_NOME FROM GER_BANCOS WHERE GER_BANCOS.GER_BNC_NUMERO = IMB_PROPRIETARIOIMOVEL.GER_BNC_NUMERO LIMIT 1) AS GER_BNC_NOME')
            ]
        )->where( 'IMB_IMV_ID','=', $rec[0]->IMB_IMV_ID )
        ->where( 'IMB_CLT_ID','=', $rec[0]->IMB_CLT_ID)
        ->first();



        if( $imprimir == 'S' )
        {
            $pdf=PDF::loadView('reports.recibos.locador.recibolocador', compact( 'rec', 'ppi') );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('recibolocador.pdf');
        };


        return $rec;

    }

    public function estornar( Request $request )
    {
        $numero = $request->IMB_RLD_NUMERO;
        $processo = mdlReciboLocador::where('IMB_RLD_NUMERO','=', $numero )->first();
//        //Log::info( 'processo: '.$processo->IMB_PRM_NUMEROPROCESSO );
        if( $processo->IMB_PRM_NUMEROPROCESSO <> '' )
        {
            $numprocesso = $processo->IMB_PRM_NUMEROPROCESSO;
            $items = mdlReciboLocador::where('IMB_PRM_NUMEROPROCESSO','=', $numprocesso )->get();
        }
        else
            $items = mdlReciboLocador::where('IMB_RLD_NUMERO','=', $numero )->get();

        if( $items[0]->IMB_RLD_DTHINATIVO )
          return response()->json('Já Estornado!',404);


        $aluguel = 0;
        $idctr = $items[0]->IMB_CTR_ID;
        $idimv = $items[0]->IMB_IMV_ID;
        $dataatual = date( 'Y-m-d');

        foreach( $items as $item )
        {
            if( $item->IMB_TBE_ID == 1 or $item->IMB_TBE_ID == 24 )
            {
               $aluguel = 1;
               $datavencimento = $item->IMB_RLD_DATAVENCIMENTO;
               $proximorepasse = $item->IMB_CTR_PROXIMOREPASSE;
            };

            $numero = $item->IMB_RLD_NUMERO;
            $atualizaritens = mdlReciboLocador::
            where('IMB_RLD_NUMERO', '=', $numero)
            ->update(['IMB_RLD_DTHINATIVO' => $dataatual,
                      'IMB_ATD_IDINATIVO' => Auth::user()->IMB_ATD_ID ]);

            $atualizaritens = mdlLanctoCaixa::
                      where('FIN_LCX_RECIBO', '=', $numero)
                      ->where('FIN_LCX_ORIGEM','=', 'RD')
                      ->update(['FIN_LCX_DTHINATIVO' => $dataatual,
                                'IMB_ATD_IDINATIVO' => Auth::user()->IMB_ATD_ID ]);

            $atualizaritens = mdlLancamentoFuturo::
                    where('IMB_RLD_NUMERO', '=', $numero)
                ->update(['IMB_LCF_DATAPAGAMENTO' => null,
                        'IMB_RLD_NUMERO' => $numero ]);

            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $idimv, $idctr, 0, $numero,0 , 'Estorno de repasse evento: '.$item->IMB_TBE_ID.
                    ', do recibo numero: '.$numero.' data de vencimento: '.app('App\Http\Controllers\ctrRotinas')->formatarData($processo->IMB_RLD_DATAVENCIMENTO ));
        }


        if( $aluguel == 1 )
        {
            $ctr = mdlContrato::find( $idctr );
            $ctr->IMB_CTR_VENCIMENTOLOCADOR = $datavencimento;
            $ctr->IMB_CTR_PROXIMOREPASSE = $proximorepasse;
            $ctr->save();
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $idimv, $idctr, 0, $numero,0 , 'Vencimento voltando para: '.$datavencimento );

        }

        return response()->json($numero,200);
    }

    public function demonstrativos( Request $request)
    {

        $idcliente = $request->IMB_CLT_ID;
        $datainicial =$request->datainicial;
        $datafinal = $request->datafinal;
        $email = $request->email;
        $idimovel = $request->IMB_IMV_ID;




        if( $datainicial == '' or $datainicial == null  )
            $datainicial = date('Y/m/d');
        if( $datafinal == '' or $datafinal == null )
            $datafinal = date('Y/m/d');


            $recs = mdlReciboLocador::select(
            [
                'IMB_RECIBOLOCADOR.IMB_CTR_ID',
                'IMB_RLD_ID',
                'IMB_RECIBOLOCADOR.IMB_IMV_ID',
                'IMB_RLD_DATAVENCIMENTO',
                'IMB_RLD_DATAPAGAMENTO',
                'IMB_RLD_NUMERO',
                'IMB_RLD_VALOR',
                'IMB_RECIBOLOCADOR.IMB_TBE_ID',
                'IMB_TBE_NOME',
                'IMB_RLD_OBSERVACAO',
                'IMB_RLD_TOTALRECIBO',
                'FIN_LCX_DINHEIRO',
                'FIN_LCX_CHEQUE',
                'IMB_RECIBOLOCADOR.IMB_CLT_ID',
                DB::raw('( SELECT IMB_CLT_NOME
                FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
                IMB_RECIBOLOCADOR.IMB_CLT_ID_LOCATARIO ) AS NOMELOCATARIO'),
                DB::raw('( SELECT IMB_CLT_CPF
                FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
                IMB_RECIBOLOCADOR.IMB_CLT_ID_LOCATARIO ) AS CPFLOCATARIO'),
                DB::raw('( SELECT IMB_CLT_NOME
                FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
                IMB_RECIBOLOCADOR.IMB_CLT_ID ) AS NOMELOCADOR'),
                DB::raw('imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                DB::raw('( SELECT CEP_BAI_NOME
                FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_CONTRATO.IMB_IMV_ID ) AS BAIRROIMOVEL'),
                DB::raw('( SELECT IMB_IMV_CIDADE
                FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_CONTRATO.IMB_IMV_ID ) AS IMB_IMV_CIDADE'),
                'IMB_RLD_LOCADORCREDEB',
                DB::raw("(CASE WHEN IMB_RLD_LOCADORCREDEB = 'D'
                THEN '-' WHEN IMB_RLD_LOCADORCREDEB = 'C'
                THEN ''
                ELSE ' ' END) AS MAISMENOS"),
                'IMB_CTR_DATALOCACAO',
                'IMB_CTR_DATAREAJUSTE',
                'IMB_IMB_NOME',
                'CEP_BAI_NOME',
                'CEP_UF_SIGLA',
                'CEP_CID_NOME',
                'IMB_IMB_CRECI',
                'IMB_IMB_URL',
                'IMB_CTR_REFERENCIA',

                'IMB_CONTRATO.IMB_IMV_ID',
                DB::raw("CONCAT( COALESCE(IMB_IMB_ENDERECO,''),' ', COALESCE(IMB_IMB_ENDERECONUMERO,''),' ', COALESCE(IMB_IMB_ENDERECOCOMPLEMENTO,'')) ENDERECO"),
                DB::raw("CONCAT( COALESCE(IMB_IMB_TELEFONE1,''),' ', COALESCE(IMB_IMB_TELEFONE2,''),' ', COALESCE(IMB_IMB_TELEFONE3,'') ) TELEFONE"),
                'IMB_IMVCLT_PIX',
                DB::raw( '(SELECT IMB_FORPAG_CONTACORRENTE FROM IMB_FORMAPAGAMENTO WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_RECIBOLOCADOR.IMB_FORPAG_ID ) AS IMB_FORPAG_CONTACORRENTE'),
                DB::raw( '(SELECT IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_RECIBOLOCADOR.IMB_FORPAG_ID ) AS IMB_FORPAG_NOME'),
                DB::raw( '(SELECT GER_BNC_NOME FROM GER_BANCOS
                        WHERE GER_BANCOS.GER_BNC_NUMERO = IMB_PROPRIETARIOIMOVEL.GER_BNC_NUMERO LIMIT 1)
                            AS GER_BNC_NOME'),
                'GER_BNC_NUMERO',
                'GER_BNC_AGENCIA',
                'IMB_BNC_AGENCIADV',
                'IMB_CLTCCR_NUMERO',
                'IMB_CLTCCR_DV',
                'IMB_CLTCCR_NOME',
                'IMB_CLTCCR_CPF',
                'IMB_CLTCCR_POUPANCA',
                'IMB_IMV_CHEQUENOMINAL'
                ])
            ->leftJoin('IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCADOR.IMB_TBE_ID')
            ->leftJoin('IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_RECIBOLOCADOR.IMB_CTR_ID')
            ->leftJoin('IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID','IMB_RECIBOLOCADOR.IMB_IMB_ID')
            ->leftJoin('IMB_PROPRIETARIOIMOVEL','IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID','IMB_RECIBOLOCADOR.IMB_IMV_ID')
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID','=',$idcliente )
            ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_RECIBOLOCADOR.IMB_CLT_ID','=',$idcliente )
            ->whereNull( 'IMB_RLD_DTHINATIVO')

            ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','>=',$datainicial )
            ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','<=',$datafinal );

            if( $idimovel <> '' )
                $recs = $recs->where( 'IMB_IMV_ID','=', $imovel );


           //dd( $datainicial . ' - '.$datafinal );
            $recs = $recs->orderBy( 'IMB_RLD_NUMERO','ASC')
                    ->orderBy( 'IMB_TBE_ID','ASC')
                    ->get();

        


        if( $recs <> '[]')
        {
            $dados = new \stdClass();

            $dados->TMP_PVR_TITULO1 = 'Extrato de Recebimento de Aluguéres';

            $datainicial = app( 'App\Http\Controllers\ctrRotinas')->formatardata($datainicial);
            $datafinal =   app( 'App\Http\Controllers\ctrRotinas')->formatardata($datafinal);

            if( $datainicial == $datafinal )
                $dados->TMP_PVR_TITULO2 = 'Data: '.$datainicial;
            else
                $dados->TMP_PVR_TITULO2 = 'Periodo: '.$datainicial.' a '.
                                                    $datafinal;
            //return $recs;

            $cliente = mdlCliente::find( $idcliente );
            $enderecoemail = $cliente->IMB_CLT_EMAIL;
            $nomecliente = $cliente->IMB_CLT_NOME;
            $nomearquivo = "demonstrativo_locador";
            $imovel_log = $recs[0]->IMB_IMV_ID;
            $contrato_log = $recs[0]->IMB_CTR_ID;

            if( $email == 'S' )
            {
                
                $enderecoemail = $enderecoemail;
//          

                $array = explode(";",$enderecoemail);

                foreach( $array as $a )
                {
                    $a=str_replace( ';','',$a);
                    if( $a <> '' )
                    {

                        //Log::info( date('d/m/Y H:i:s').' - Demonstrativo email: '.$a );
                        $html = view('reports.locador.demonstrativo', compact( 'recs', 'dados') );
                        Mail::send('reports.locador.demonstrativomail', compact( 'nomecliente','dados'),
                        function( $message ) use ($a, $html,$nomearquivo, $imovel_log, $contrato_log)
                        {

                            ////Log::info('demonstrativo enviando para  '.$a );
                            $copiaend = env('APP_MAILDEMOCOPIA');                            
                            $pdf=PDF::loadHtml( $html,'UTF-8');
                            $message->attachData($pdf->output(), $nomearquivo.'.pdf');
        //                        $message->to( "suporte@compdados.com.br" );
                            $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                            
                            $message->to( $a  );
                            $message->cc( $copiaend  );
                            $message->bcc( 'suporte@compdados.com.br'  );
                            $message->subject('Extrato de Recebimento de Aluguéres');
                            app('App\Http\Controllers\ctrRotinas')
                            ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Extrato de Recebimentos enviado para '.$a.' com cópia para '.$copiaend);
                        });
                    }

                }
                //echo "<script>window.close();</script>";
                return response()->json('ok',200);
            }
            else
            {
                //$html = view( 'reports.locador.demonstrativo', compact( 'recs', 'dados'));
                $html = view( 'reports.locador.demonstrativonovaversao', compact( 'recs', 'dados'));
                $pdf=PDF::loadHtml( $html,'UTF-8');
                //$pdf->setPaper('A4', 'portrait');
//                dd('aqui');
                return $pdf->stream($nomearquivo.'pdf');

            }

        }


/*        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=', $rec[0]->IMB_IMV_ID )
        ->where( 'IMB_CLT_ID','=', $rec[0]->IMB_CLT_ID)
        ->get();
*/



    }

    public function demonstrativosIndex()
    {
        return view( 'reports.locador.demonstrativoindex');
    }


    public function repassadoPeriodo( Request $request )
    {
        $datainicio =  $request->recperdatainicio;
        $datafim =   $request->recperdatafim;
        $empresa = $request->recperempresa;
        $empresa = $request->origem;
        $imovel=$request->IMB_IMV_ID;

        if( $datainicio=='') $datainicio = date( 'Y/m/d');
        if( $datafim=='') $datafim = date( 'Y/m/d');

        $rec = mdlReciboLocador::select(
            [
                'IMB_RLD_NUMERO',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_RECIBOLOCADOR.IMB_RLD_DATAVENCIMENTO',
                'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO',
                DB::raw( '( select IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO
                        WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_RECIBOLOCADOR.IMB_FORPAG_ID) FORMAPAGAMENTO'),
                DB::raw('imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                DB::raw('PEGALOCATARIOCONTRATO( IMB_RECIBOLOCADOR.IMB_CTR_ID) AS NOMELOCATARIO'),
                DB::raw('PEGALOCADORPRINCIPALIMV( IMB_CONTRATO.IMB_IMV_ID) AS NOMELOCADOR'),
                DB::raw( "( SELECT REPASSADOTOTALRECIBO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO ) ) AS TOTALRECIBO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'8,5' ) ) AS DESCONTOS"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'6,-6,506' ) ) AS TAXAADM"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'7,25' ) ) AS TAXCON"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'17') ) AS IPTU"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'18') ) AS IRRF"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                DB::raw( "( select REPASSADOOUTROSEVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'1Z,-6,7,25,24,8,5,17,18,518,2,36,3,37,4,38' ) ) AS OUTROS")
            ])
            ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCADOR.IMB_CTR_ID')
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio)
            ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim)
            ->whereNull('IMB_RLD_DTHINATIVO');

            if( $empresa)
            $rec = $rec->where('IMB_CONTRATO.IMB_IMB_ID2','=',$empresa );

        if( $imovel)
            $rec = $rec->where('IMB_CONTRATO.IMB_IMV_ID','=',$imovel );

        $rec = $rec->distinct('IMB_RLD_NUMERO')
            ->orderBy( 'IMB_RLD_DATAPAGAMENTO')
            ->get();

        $datainicio = app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
        $datafim = app('App\Http\Controllers\ctrRotinas')->formatarData( $datafim );

       return view('reports.admimoveis.repassadosperiodo',compact( 'rec', 'datainicio','datafim') ) ;

       $pdf=PDF::loadView('reports.admimoveis.repassadosperiodo',compact( 'rec', 'datainicio','datafim') ) ;
       $pdf->setPaper('A4', 'portrait');
       return $pdf->stream('repassados_periodo.pdf');


    }
    function totaldoRecibo( $recibo )
    {
        $total = mdlReciboLocador::select(
            [
                DB::raw( "( SELECT REPASSADOTOTALRECIBO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO ) ) AS TOTALRECIBO"),
            ]
        )->where( 'IMB_RLD_NUMERO','=', $recibo)
        ->first();

        return $total->TOTALRECIBO;


    }

    function itensdoRecibo( $recibo )
    {
        $itens = mdlReciboLocador::select(
            [
                'IMB_RECIBOLOCADOR.IMB_TBE_ID',
                'IMB_TBE_NOME',
                'IMB_RLD_OBSERVACAO',
                'IMB_RLD_LOCADORCREDEB',
                'IMB_RLD_VALOR',
                'IMB_RLD_DATAVENCIMENTO'

            ]
        )->where( 'IMB_RLD_NUMERO','=', $recibo)
        ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_RECIBOLOCADOR.IMB_TBE_ID')
        ->get();

        return $itens;

    }

    public function resumoRepassadoPeriodo( $datainicio, $datafim, $empresa, $conta )
    {

        $array =[];

        $datainicio = app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
        $datafim = app('App\Http\Controllers\ctrRotinas')->formatarData( $datafim );
        $rec = mdlReciboLocador::select(
            [
                DB::raw( "( SELECT REPASSADOTOTALRECIBO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO ) ) AS TOTALRECIBO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'8,5' ) ) AS DESCONTOS"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'6,506') ) AS TAXAADM"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'7,25' ) ) AS TAXCON"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'17') ) AS IPTU"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'18') ) AS IRRF"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                DB::raw( "( select REPASSADOOUTROSEVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'1,6,-6,7,25,24,8,5,17,18,518,2,36,3,37,4,38' ) ) AS OUTROS")
            ])
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio)
            ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim)
//            ->where( 'IMB_RLD_NUMERO','=','2102068')
            ->groupBy( 'IMB_RLD_NUMERO')
            ->whereNull('IMB_RLD_DTHINATIVO');

        if( $conta)
            $rec = $rec->where('FIN_CCR_ID','=',$conta );


        if( $empresa)
            $rec = $rec->where('IMB_RECIBOLOCADOR.IMB_IMB_ID2','=',$empresa );

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
        $totaltaxadm=0;
        $totaltaxcon=0;
        foreach($rec as $item )
        {
            $totalrecibo = $totalrecibo + $item->TOTALRECIBO;
            $totalaluguel = $totalaluguel + $item->VALORALUGUEL;
            $totaldesconto = $totaldesconto + $item->DESCONTOS;
            $totaltaxadm = $totaltaxadm + $item->TAXAADM;
            $totaltaxcon = $totaltaxcon + $item->TAXCON;

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
            number_format($totaltaxadm,2,",","."),
            number_format($totaltaxcon,2,",","."),
            number_format($totaliptu,2,",","."),
            number_format($totalirrf,2,",","."),
            number_format($totalmulta,2,",","."),
            number_format($totaljuros,2,",","."),
            number_format($totalcorrecao,2,",","."),
            number_format($totaloutros,2,",","."),
            number_format($totalrecibo,2,",",".")

        ];

        return $array;

    }

    public function planilhaRepasse(Request $request)
    {

        $datainicio =  $request->datainicio;
        $datafim =   $request->datafim;
        $empresa = $request->IMB_IMB_ID;
        $IMB_CLT_ID = $request->IMB_CLT_ID;
        $dimob =  $request->dimob;
        $destino = $request->destino;
        if( $datainicio=='') $datainicio = date( 'Y/m/d');
        if( $datafim=='') $datafim = date( 'Y/m/d');


        $rec = mdlReciboLocador::select(
            [
                'IMB_RLD_NUMERO',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_RECIBOLOCADOR.IMB_RLD_DATAVENCIMENTO',
                'IMB_RECIBOLOCADOR.IMB_RLD_DATAVENCIMENTO AS IMB_RLT_DATACOMPETENCIA', // CRIEI PRA USAR GENERICO
                'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO',
                'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO AS IMB_RLT_DATAPAGAMENTO', //CRIEI PRA USAR GENERICO
                DB::raw('imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) AS ENDERECOIMOVEL'),
                DB::raw('PEGALOCATARIOCONTRATO( IMB_RECIBOLOCADOR.IMB_CTR_ID) AS NOMELOCATARIO'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_RECIBOLOCADOR.IMB_CLT_ID ) AS NOMELOCADOR'),
                DB::raw('( SELECT IMB_CLT_CPF FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_RECIBOLOCADOR.IMB_CLT_ID ) AS CPFLOCADOR'),
                DB::raw( "( SELECT REPASSADOTOTALRECIBO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO ) ) AS TOTALRECIBO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'1,24' ) ) AS VALORALUGUEL"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'8,5' ) ) AS DESCONTOS"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'6,-6,506' ) ) AS TAXAADM"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'7,25' ) ) AS TAXCON"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'7,25' ) ) AS TAXACONTRATO"),  //CRIEI PORQUE ESTOU USANDO GENERICO
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'17') ) AS IPTU"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'18,518') ) AS IRRF"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'2,36' ) ) AS MULTAATRASO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'3,37' ) ) AS JUROSATRASO"),
                DB::raw( "( select REPASSADOPOREVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'4,38' ) ) AS CORRECAOMONETARIA"),
                DB::raw( "( select REPASSADOOUTROSEVENTO(IMB_RECIBOLOCADOR.IMB_RLD_NUMERO,'1,6,-6,7,25,24,8,5,17,18,518,2,36,3,37,4,38' ) ) AS OUTROS")
            ])
            ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCADOR.IMB_CTR_ID')
            ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID', 'IMB_CONTRATO.IMB_IMV_ID')
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio)
            ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim)
            ->whereNull('IMB_RLD_DTHINATIVO');

        if( $dimob == 'D' )
            $rec = $rec->where('IMB_IMV_RELIRRF','=','S' );

        if( $empresa)
            $rec = $rec->where('IMB_CONTRATO.IMB_IMB_ID2','=',$empresa );


        if( $IMB_CLT_ID <> '')
            $rec = $rec->where('IMB_CLT_ID','=',  $IMB_CLT_ID);
            
        $rec = $rec->distinct('IMB_RLD_NUMERO')
            ->orderBy( 'IMB_RLD_DATAPAGAMENTO');


            return DataTables::of($rec)->make(true);

    }

    public function totalRepassadoPeriodo( $datainicio, $datafim, $fin_ccx_id )
    {

        $datainicio =  $datainicio;
        $datafim =$datafim;

        $tot =  mdlParametros::select(
            [
                DB::raw("(select REPASSADOTOTALPERIODO('{$datainicio}', '{$datafim}', '{$fin_ccx_id}' )) as total")
            ])->first();
        
        return $tot->total;

    }

    public function repassadoPeriodoRecibos( Request $request )
    {
        $datainicio =  $request->recperdatainicio;
        $datafim =   $request->recperdatafim;
        $IMB_CLT_ID = $request->IMB_CLT_ID;

        if( $datainicio=='') $datainicio = date( 'Y/m/d');
        if( $datafim=='') $datafim = date( 'Y/m/d');

        $recibos = mdlReciboLocador::select(
            [
                'IMB_RLD_NUMERO'
            ]
            )->distinct('IMB_RLD_NUMERO')
            ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio )
            ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim )
            ->whereNull('IMB_RLD_DTHINATIVO')
            ->orderBy( 'IMB_RLD_DATAPAGAMENTO');

            if( $IMB_CLT_ID <> '' ) 
                $recibos = $recibos->where('IMB_CLT_ID','=', $IMB_CLT_ID );

            $recibos= $recibos->get();

            
//            $pdf=PDF::loadView('reports.recibos.locador.recibolocadorlote', compact( 'recibos'));
  //          $pdf->setPaper('A4', 'portrait');
    //        return $pdf->stream('recibos.pdf');

            return view('reports.recibos.locador.recibolocadorlote', compact( 'recibos'));



    }
        

        public function demonstrativosNew( Request $request)
        {
    
            $idcliente = $request->IMB_CLT_ID;
            $datainicial =$request->datainicial;
            $datafinal = $request->datafinal;
            $email = $request->email;
            $idimovel = $request->IMB_IMV_ID;
            $pasta = $request->IMB_CTR_REFERENCIA;
    
            if( $datainicial == '' or $datainicial == null  )
                $datainicial = date('Y/m/d');
            if( $datafinal == '' or $datafinal == null )
                $datafinal = date('Y/m/d');
    
            $recs = mdlReciboLocador::select(
            [
                'IMB_RLD_NUMERO'
            ])
            ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_RECIBOLOCADOR.IMB_CLT_ID','=',$idcliente )
            ->whereNull( 'IMB_RLD_DTHINATIVO')
            ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','>=',$datainicial )
            ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','<=',$datafinal );

            if( $pasta <> '' )
            {
                $recs = $recs->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCADOR.IMB_CTR_ID' )
                ->where( 'IMB_CTR_REFERENCIA','=',$pasta );
            }
            if( $idimovel <> '' )
            $recs = $recs->where( 'IMB_RECIBOLOCADOR.IMB_IMV_ID','=',$idimovel );



            if( $idimovel <> '' )
                $recs = $recs->where( 'IMB_IMV_ID','=', $idimovel );

            $recs = $recs->distinct('IMB_RLD_NUMERO');
            $recs = $recs->orderBy( 'IMB_RLD_NUMERO','ASC')
                    ->orderBy( 'IMB_TBE_ID','ASC')
                    ->get();

            $datainicial = app('App\Http\Controllers\ctrRotinas')->formatarData($datainicial);
            $datafinal = app('App\Http\Controllers\ctrRotinas')->formatarData($datafinal);
            $regclt =  app('App\Http\Controllers\ctrRotinas')->clienteDadosFull( $idcliente );
            if( $regclt == '' ) 
                $nomecliente ='Nome do Locador não Encontrado, código: '.$idcliente;
            else
                $nomecliente = $regclt->IMB_CLT_NOME;


            if( $recs <> '[]' ) 
            {

                $recibo = mdlRecibolocador::where( 'IMB_RLD_NUMERO','=', $recs[0]->IMB_RLD_NUMERO )->first();
                $imovel_log = $recibo->IMB_IMV_ID;
                $contrato_log = $recibo->IMB_CTR_ID;

           
                if( $email == 'S' )
                {
                
                    $cliente = mdlCliente::find( $idcliente );
                    $enderecoemail = $cliente->IMB_CLT_EMAIL;
                        
                    $enderecoemail = $enderecoemail.';'.env('APP_MAILDEMOCOPIA');

    
                    //Log::info('Email bruto: '.$enderecoemail);

                    $array = explode(";",$enderecoemail);

                    $dados = new \stdClass();

                    $dados->TMP_PVR_TITULO1 = 'Extrato de Recebimento de Aluguéres';
        
                    $datainicial = $datainicial;
                    $datafinal = $datafinal;
        
                    if( $datainicial == $datafinal )
                        $dados->TMP_PVR_TITULO2 = 'Data: '.$datainicial;
                    else
                        $dados->TMP_PVR_TITULO2 = 'Periodo: '.$datainicial.' a '.
                                                            $datafinal;
                    //return $recs;                
                    $nomearquivo='extratoderecebimento';

                    $pasta="demonstrativos";
                    $html = view( 'reports.locador.demonstrativonovaversao', compact( 'recs', 'idcliente', 'datainicial', 'datafinal','nomecliente'));
                    $contents = (string) $html;
                    $filename = $idcliente.'_demonstrativo_'.$datainicial.'_a_'.$datafinal.'.html';
                    Storage::disk('public')->makeDirectory( $pasta);
                    Storage::disk('public')->put( $pasta.'/'.$filename, $contents);
                    $linkdocto = env('APP_URL').'/storage/'.$pasta.'/'.$filename;
                    Log::info( $linkdocto );

                    foreach( $array as $a )
                    {
                        $a=str_replace( ';','',$a);
                        //Log::info( 'email antes: '.$a );
                        ini_set('memory_limit', '1024M');
                        if( $a <> '' )
                        {
                  

                            Mail::send('reports.locador.demonstrativomail', compact( 'nomecliente','dados', 'linkdocto'),
                            function( $message ) use ($a, $html,$nomearquivo, $imovel_log, $contrato_log, $pasta, $filename)
                            {

                                //Log::info('demonstrativo enviando para  '.$a );
                                //Log::info( date('d/m/Y H:i:s').' - Demonstrativo email: '.$a );

                                $copiaend = env('APP_MAILBOLETOCOPIA');                            
//                                $pdf=PDF::loadHtml( $html,'UTF-8');
                              //$message->attachData($pdf->output(), $nomearquivo.'.pdf');
  //                            $message->attach( $pasta.'/'.$filename);
            //                        $message->to( "suporte@compdados.com.br" );
                                $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                                
                                Log::info( 'A$ '.$a );
                                Log::info( 'copia '.$copiaend );
                                $message->to( $a  );
                                $message->cc( $copiaend  );
                                $message->subject('Extrato de Recebimento de Aluguéres');
                                app('App\Http\Controllers\ctrRotinas')
                                ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Extrato de Recebimentos enviado para '.$a.' com cópia para '.$copiaend);
    
                                });
                        }

                    }
                    

                }
                else
                {   
//                    $html = view( 'reports.locador.demonstrativonew', compact( 'recs', 'idcliente', 'datainicial', 'datafinal','nomecliente'));
                    $html = view( 'reports.locador.demonstrativonovaversao', compact( 'recs', 'idcliente', 'datainicial', 'datafinal','nomecliente'));
   //                 $pdf=PDF::loadHtml( $html,'UTF-8');
                    //return $pdf->stream('demonstrativo.pdf');
                    return $html;
                }
            }
            
        }
    
        public function repassadoPlanilhaDepositosGerar( Request $request )
        {
            $datainicio =  $request->datainicio;
            $datafim =   $request->datafim;
            $conta = $request->FIN_CCX_ID;
            $limpar = $request->limpar;

            if( $limpar == 'N' or $limpar == 'I')
            {
                
               $tmp = mdlTmpPlanilhaDeposito::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->
                   orderBy( 'IMB_RLD_DATAPAGAMENTO')
                 ->orderBy( 'FAVORECIDO' );            
                 if( $limpar == 'I')
                 {
                    $tmp = $tmp->where( 'SELECIONADO','=', 'S' )->get();
                    $html =view( 'reports.locador.impressaocheques', compact( 'tmp'));                    
                    $pdf=PDF::loadHtml( $html,'UTF-8');
                    //$pdf->setPaper('A4', 'portrait');
    //                dd('aqui');
                    return $pdf->stream('cheques.pdf');
                    
                 }
                    
                 $tmp->get();
                  return DataTables::of($tmp)->make(true);

            }
    
            if( $datainicio=='') $datainicio = date( 'Y/m/d');
            if( $datafim=='') $datafim = date( 'Y/m/d');
    
            $recibos = mdlReciboLocador::select(
                [
                    'IMB_RLD_NUMERO'
                ]
                )->distinct('IMB_RLD_NUMERO')
                ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
                ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio )
                ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim )
                ->whereNull('IMB_RLD_DTHINATIVO');

            if( $conta <> '' )
                $recibos = $recibos->whereRaw( 'cast(FIN_CCR_ID as int) = '.intval($conta) );
                
            $recibos = $recibos->orderBy( 'IMB_RLD_DATAPAGAMENTO')->get();

            $tmp = mdlTmpPlanilhaDeposito::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->delete(); 
            
            foreach( $recibos as $recibo )
            {   
                //pegar informações recibo;
                $rld = mdlReciboLocador::where(  'IMB_RLD_NUMERO','=',$recibo->IMB_RLD_NUMERO )->first();
                $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=', $rld->IMB_IMV_ID )
                                    ->where( 'IMB_CLT_ID','=', $rld->IMB_CLT_ID)->first();
                $clt = mdlCliente::find( $rld->IMB_CLT_ID);

                $favorecido = $clt->IMB_CLT_NOME;

                $fp='';
                $tipoconta = 'Corrente';
                if( $ppi <> '')
                {
                    $fp = mdlFormaPagamento::find( $ppi->IMB_FORPAG_ID );
                    if( $clt->IMB_CLT_NOME <> $ppi->IMB_CLTCCR_NOME) 
                        $favorecido = $ppi->IMB_CLTCCR_NOME;
                    
                    if( $ppi->IMB_IMV_CHEQUENOMINAL <> '' )
                    $favorecido = $ppi->IMB_IMV_CHEQUENOMINAL;
                    if( $ppi->IMB_CLTCCR_POUPANCA == 'S') $tipoconta='Poup.';

                }
                else 
                {
                    $favorecido = 'Atenção! Pode ter havido mundança no locador';
                }
 

                if( $fp == '' ) 
                    $nomeformapagamento = '**NÃO ENCONTRADO**' ;
                else 
                    $nomeformapagamento=$fp->IMB_FORPAG_NOME;


                $tmp = new mdlTmpPlanilhaDeposito; 
                
                $tmp->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $tmp->SELECIONADO            = 'N';
                $tmp->IMB_RLD_NUMERO   = $recibo->IMB_RLD_NUMERO;
                $tmp->IMB_IMV_ID   = $rld->IMB_IMV_ID;
                $tmp->IMB_CTR_ID   = $rld->IMB_CTR_ID;
                $tmp->FIN_CCX_ID   = $rld->FIN_CCR_ID;
                $tmp->IMB_CTR_REFERENCIA   = app( 'App\Http\Controllers\ctrRotinas')->pegarReferencia($rld->IMB_CTR_ID);
                $tmp->IMB_CLT_NOME   = $clt->IMB_CLT_NOME;
                $tmp->IMB_CLT_CPF   = $clt->IMB_CLT_CPF;
                $tmp->FORMAPAGAMENTO   = $nomeformapagamento ;
                $tmp->IMB_FORPAG_ID   = $rld->IMB_FORPAG_ID ;
                $tmp->TOTALRECIBO   = $this->totaldoRecibo( $rld->IMB_RLD_NUMERO);
                $tmp->IMB_RLD_DATAPAGAMENTO   = $rld->IMB_RLD_DATAPAGAMENTO;
                $tmp->IMB_RLD_DATAVENCIMENTO   = $rld->IMB_RLD_DATAVENCIMENTO;
                $tmp->IMB_RLD_CHEQUE   = $rld->IMB_RLD_CHEQUE;
                if( $ppi <> '' )
                {
                    $tmp->GER_BNC_NUMERO   = $ppi->GER_BNC_NUMERO;
                    $tmp->BANCO   = app( 'App\Http\Controllers\ctrRotinas')->pegarBanco( $ppi->GER_BNC_NUMERO);
                    $tmp->IMB_BNC_AGENCIADV   = $ppi->IMB_BNC_AGENCIADV;
                    $tmp->IMB_CLTCCR_NUMERO   = $ppi->IMB_CLTCCR_NUMERO;
                    $tmp->IMB_CLTCCR_DV   = $ppi->IMB_CLTCCR_DV;
                    $tmp->IMB_CLTCCR_NOME   = $ppi->IMB_CLTCCR_NOME;
                    $tmp->IMB_CLTCCR_CPF   = $ppi->IMB_CLTCCR_CPF;
                    $tmp->GER_BNC_AGENCIA   = $ppi->GER_BNC_AGENCIA;
                    $tmp->IMB_CLTCCR_PESSOA   = $ppi->IMB_CLTCCR_PESSOA;
                    $tmp->IMB_CLTCCR_DOC   = $ppi->IMB_CLTCCR_DOC;
                    $tmp->IMB_CLTCCR_POUPANCA   = $ppi->IMB_CLTCCR_POUPANCA;
                    $tmp->IMB_IMV_CHEQUENOMINAL   = $ppi->IMB_IMV_CHEQUENOMINAL;
                    $tmp->IMB_IMV_PIX   = $ppi->IMB_IMV_PIX;
                }
                $tmp->ENDERECOIMOVEL   = app( 'App\Http\Controllers\ctrRotinas')->imovelEndereco( $rld->IMB_IMV_ID);
                $tmp->FAVORECIDO   = $favorecido;
                $tmp->TIPOCONTA   = $tipoconta;
                $tmp->OBSERVACAO   = '';
                $tmp->NOMELOCATARIO = app( 'App\Http\Controllers\ctrRotinas')->nomeLocatarioPrincipal( $rld->IMB_CTR_ID );
                $tmp->save();
            }

            $tmp = mdlTmpPlanilhaDeposito::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->
            orderBy( 'IMB_RLD_DATAPAGAMENTO')
            ->orderBy( 'FAVORECIDO' )
            ->get();
            
            return DataTables::of($tmp)->make(true);

    
    
        }

        public function selecionarDepositoOnOff( Request $request )
        {
            $id = $request->id;
            
            $pp = mdlTmpPlanilhaDeposito::find( $id );


            if( $pp->SELECIONADO == 'N' )
                $pp->SELECIONADO = 'S';
            else
                $pp->SELECIONADO = 'N';

            $pp->save();
            return response()->json('ok',200);

        }

    public function informeirrf( Request $request)
    {
    
        $idcliente = $request->IMB_CLT_ID;
        $ano = $request->ano;
        $email = $request->email;
    
    

        $imobiliaria = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
    
        $recs = mdlReciboLocador::select(
        [
            'IMB_RECIBOLOCADOR.IMB_CTR_ID',
            'IMB_RLD_ID',
            'IMB_RECIBOLOCADOR.IMB_IMV_ID',
            'IMB_RLD_DATAVENCIMENTO',
            'IMB_RLD_DATAPAGAMENTO',
            'IMB_RLD_NUMERO',
            'IMB_RLD_VALOR',
            'IMB_RECIBOLOCADOR.IMB_TBE_ID',
            'IMB_TBE_NOME',
            'IMB_RLD_OBSERVACAO',
            'IMB_RLD_TOTALRECIBO',
            'FIN_LCX_DINHEIRO',
            'FIN_LCX_CHEQUE',
            'IMB_CTR_INICIO',
            'IMB_RECIBOLOCADOR.IMB_CLT_ID',
            DB::raw('( SELECT IMB_CLT_NOME
            FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
            IMB_RECIBOLOCADOR.IMB_CLT_ID_LOCATARIO ) AS NOMELOCATARIO'),
            DB::raw('( SELECT IMB_CLT_NOME
            FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID =
            IMB_RECIBOLOCADOR.IMB_CLT_ID ) AS NOMELOCADOR'),
            DB::raw('imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) AS ENDERECOIMOVEL'),
            DB::raw('( SELECT CEP_BAI_NOME
            FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
            IMB_CONTRATO.IMB_IMV_ID ) AS BAIRROIMOVEL'),
            DB::raw('( SELECT IMB_IMV_CIDADE
            FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID =
            IMB_CONTRATO.IMB_IMV_ID ) AS IMB_IMV_CIDADE'),
            'IMB_RLD_LOCADORCREDEB',
            DB::raw("(CASE WHEN IMB_RLD_LOCADORCREDEB = 'D'
            THEN '-' WHEN IMB_RLD_LOCADORCREDEB = 'C'
            THEN ''
            ELSE ' ' END) AS MAISMENOS"),
            'IMB_CTR_DATALOCACAO',
            'IMB_CTR_DATAREAJUSTE',
            'IMB_IMB_NOME',
            'CEP_BAI_NOME',
            'CEP_UF_SIGLA',
            'CEP_CID_NOME',
            'IMB_IMB_CRECI',
            'IMB_IMB_URL',
            'IMB_CTR_REFERENCIA',
            'IMB_CONTRATO.IMB_IMV_ID',
            DB::raw("CONCAT( COALESCE(IMB_IMB_ENDERECO,''),' ', COALESCE(IMB_IMB_ENDERECONUMERO,''),' ', COALESCE(IMB_IMB_ENDERECOCOMPLEMENTO,'')) ENDERECO"),
            DB::raw("CONCAT( COALESCE(IMB_IMB_TELEFONE1,''),' ', COALESCE(IMB_IMB_TELEFONE2,''),' ', COALESCE(IMB_IMB_TELEFONE3,'') ) TELEFONE"),
            'IMB_IMVCLT_PIX',
            DB::raw( '(SELECT IMB_FORPAG_CONTACORRENTE FROM IMB_FORMAPAGAMENTO WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_RECIBOLOCADOR.IMB_FORPAG_ID ) AS IMB_FORPAG_CONTACORRENTE'),
            DB::raw( '(SELECT IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_RECIBOLOCADOR.IMB_FORPAG_ID ) AS IMB_FORPAG_NOME'),
            DB::raw( '(SELECT GER_BNC_NOME FROM GER_BANCOS
                    WHERE GER_BANCOS.GER_BNC_NUMERO = IMB_PROPRIETARIOIMOVEL.GER_BNC_NUMERO LIMIT 1)
                        AS GER_BNC_NOME'),
            'GER_BNC_NUMERO',
            'GER_BNC_AGENCIA',
            'IMB_BNC_AGENCIADV',
            'IMB_CLTCCR_NUMERO',
            'IMB_CLTCCR_DV',
            'IMB_CLTCCR_NOME',
            'IMB_CLTCCR_CPF',
            'IMB_CLTCCR_POUPANCA',
            'IMB_IMV_CHEQUENOMINAL',
            'IMB_TBE_INCISS' , 
            'IMB_TBE_IRRF' , 
            ])
        ->leftJoin('IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCADOR.IMB_TBE_ID')
        ->leftJoin('IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_RECIBOLOCADOR.IMB_CTR_ID')
        ->leftJoin('IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID','IMB_RECIBOLOCADOR.IMB_IMB_ID')
        ->leftJoin('IMB_PROPRIETARIOIMOVEL','IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID','IMB_RECIBOLOCADOR.IMB_IMV_ID')
        ->where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
//        ->where( 'IMB_TABELAEVENTOS.IMB_TBE_IRRF','=','S')
        ->where( 'IMB_TABELAEVENTOS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID);

        if( $idcliente <> '' )
        {
            $recs = $recs->where( 'IMB_RECIBOLOCADOR.IMB_CLT_ID','=',$idcliente )
                        ->where( 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID','=',$idcliente );
        }


        $recs = $recs->whereNull( 'IMB_RLD_DTHINATIVO')
        ->whereRaw( 'YEAR( IMB_RLD_DATAPAGAMENTO) = '.$ano )
        ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_LOCADORCREDEB','<>', 'N')
        //->where('IMB_RECIBOLOCADOR.IMB_CTR_ID','=', '19072' )
        ->orderBy( 'IMB_RECIBOLOCADOR.IMB_CLT_ID')
        ->orderBy( 'IMB_RECIBOLOCADOR.IMB_CTR_ID')
        ->orderBy( 'IMB_RECIBOLOCADOR.IMB_IMV_ID')
        ->orderBy( 'IMB_RLD_DATAPAGAMENTO')
        ->orderBy( 'IMB_RECIBOLOCADOR.IMB_TBE_ID','ASC')
        ->get();

        $dim = mdlDimob::where( 'imb_dil_anobase','=', $ano )->delete();

        foreach( $recs as $rec )
        {

            $dim = mdlDimob::where( 'imb_clt_idlocador','=', $rec->IMB_CLT_ID )
            ->where( 'imb_dil_anobase','=', $ano )
            ->where( 'imb_ctr_ID','=', $rec->IMB_CTR_ID )
            ->first();


            if( $dim == '' )
            {
    

                $locador = mdlCliente::find( $rec->IMB_CLT_ID);
                $idlocatario = app('App\Http\Controllers\ctrRotinas')->codigoLocatarioPrincipal( $rec->IMB_CTR_ID);
                $locatario = mdlCliente::find( $idlocatario );
                $imovel = mdlImovel::find( $rec->IMB_IMV_ID );
    
                $dim = new mdlDImob;
                $dim->imb_imv_id = $rec->IMB_IMV_ID;
                $dim->imb_imb_cnpj = $imobiliaria->IMB_IMB_CGC;
                $dim->imb_imb_nomeempresa = $imobiliaria->IMB_IMB_NOME;
                $dim->imb_imb_nomeresponsavel = $imobiliaria->IMB_IMB_REPRESENTANTE;
                $dim->imb_imb_cpfresposavel = $imobiliaria->IMB_IMB_REPRESENTANTECPF;
                $dim->imb_imv_enderecoempresa = $imobiliaria->IMB_IMB_ENDERECO.' '.
                                                $imobiliaria->IMB_IMB_ENDERECONUMERO.' '.
                                                $imobiliaria->IMB_IMB_ENDERECOCOMPLEMENTO;
                $dim->imb_imv_cidadecoempresa = $imobiliaria->CEP_CID_NOME;
                $dim->imb_imv_estadoempresa = $imobiliaria->CEP_UF_SIGLA;

                $dim->imb_clt_idlocador = $rec->IMB_CLT_ID;
                $dim->imb_clt_idlocatario = $idlocatario;
                if( $rec->IMB_CTR_REFERENCIA == '' )
                    $dim->imb_ctr_referencia = $rec->IMB_IMV_ID.$rec->IMB_CTR_ID;
                else
                    $dim->imb_ctr_referencia = $rec->IMB_CTR_REFERENCIA;

                $dim->imb_ctr_ID = $rec->IMB_CTR_ID;
                $dim->imb_ctr_inicio = $rec->IMB_CTR_INICIO;
                $dim->imb_dil_tipoimovel = 'U';
                $dim->imb_imv_endereco = $imovel->IMB_IMV_ENDERECO.' '.
                    $imovel->IMB_IMV_ENDERECONUMERO.' '.
                    $imovel->IMB_IMV_NUMAPT.' '.
                    $imovel->IMB_IMV_ENDERECONUMERO;
        
                $dim->imb_imv_estado = $imovel->IMB_IMV_ESTADO;
                $dim->imb_imv_cidade = $imovel->IMB_IMV_CIDADE;
                $dim->imb_imv_estado = $imovel->IMB_IMV_ESTADO;
                $dim->imb_imv_cep = $imovel->IMB_IMV_ENDERECOCEP;
                if( $imovel->IMB_IMV_RELIRRF == 'S')
                    $dim->imb_imv_seleleciona = 'S';
                else
                    $dim->imb_imv_seleleciona = 'N';

                $dim->imb_imv_codigocidaderaiz = $rec->imb_imv_codigocidaderaiz;
                $dim->imb_clt_nomelocador = $locador->IMB_CLT_NOME;
                $dim->imb_clt_nomelocatario = $locatario->IMB_CLT_NOME;
                $dim->imb_clt_cpflocador = $locador->IMB_CLT_CPF;
                $dim->imb_clt_cpflocatario = $locatario->IMB_CLT_CPF;
                $dim->imb_dil_anobase = $ano;
                $dim->imb_imb_id = Auth::user()->IMB_IMB_ID;

                $dim->imb_dil_rejeitado = 'N';
                $dim->imb_dil_rejeitadoobservacao = '';
                $dim->imb_dil_janbruto = 0;
                $dim->imb_dil_jancomissao = 0;
                $dim->imb_dil_janretido = 0;
                $dim->imb_dil_janrecibos='';
                $dim->imb_dil_fevbruto = 0;
                $dim->imb_dil_fevcomissao = 0;
                $dim->imb_dil_fevretido = 0;
                $dim->imb_dil_fevrecibos='';
                $dim->imb_dil_marbruto = 0;
                $dim->imb_dil_marcomissao = 0;
                $dim->imb_dil_marretido = 0;
                $dim->imb_dil_marrecibos ='';
                $dim->imb_dil_abrbruto = 0;
                $dim->imb_dil_abrcomissao = 0;
                $dim->imb_dil_abrretido = 0;
                $dim->imb_dil_abrrecibos ='';
                $dim->imb_dil_maibruto = 0;
                $dim->imb_dil_maicomissao = 0;
                $dim->imb_dil_mairetido = 0;
                $dim->imb_dil_mairecibos='';
                $dim->imb_dil_junbruto = 0;
                $dim->imb_dil_juncomissao = 0;
                $dim->imb_dil_junretido = 0;
                $dim->imb_dil_junrecibos='';
                $dim->imb_dil_julbruto = 0;
                $dim->imb_dil_julcomissao = 0;
                $dim->imb_dil_julretido = 0;
                $dim->imb_dil_julrecibos='';
                $dim->imb_dil_agobruto = 0;
                $dim->imb_dil_agocomissao = 0;
                $dim->imb_dil_agoretido = 0;
                $dim->imb_dil_agorecibos='';
                $dim->imb_dil_setbruto = 0;
                $dim->imb_dil_setcomissao = 0;
                $dim->imb_dil_setretido = 0;
                $dim->imb_dil_setrecibos='';
                $dim->imb_dil_outbruto = 0;
                $dim->imb_dil_outcomissao = 0;
                $dim->imb_dil_outretido = 0;
                $dim->imb_dil_outrecibos='';
                $dim->imb_dil_novbruto = 0;
                $dim->imb_dil_novcomissao = 0;
                $dim->imb_dil_novretido = 0;
                $dim->imb_dil_novrecibos='';
                $dim->imb_dil_dezbruto = 0;
                $dim->imb_dil_dezcomissao = 0;
                $dim->imb_dil_dezretido = 0;
                $dim->imb_dil_dezrecibos='';
                $dim->imb_dil_janfechado='N';
                $dim->imb_dil_fevfechado='N';
                $dim->imb_dil_marfechado='N';
                $dim->imb_dil_abrfechado='N';
                $dim->imb_dil_maifechado='N';
                $dim->imb_dil_junfechado='N';
                $dim->imb_dil_julfechado='N';
                $dim->imb_dil_agofechado='N';
                $dim->imb_dil_setfechado='N';
                $dim->imb_dil_outfechado='N';
                $dim->imb_dil_novfechado='N';
                $dim->imb_dil_dezfechado='N';
                $dim->save();
            }

            $mes = substr( $rec->IMB_RLD_DATAPAGAMENTO,5,2);
            if( $mes == '01')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_janbruto = $dim->imb_dil_janbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_janbruto = $dim->imb_dil_janbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_jancomissao = $dim->imb_dil_jancomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_jancomissao = $dim->imb_dil_jancomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_janretido = $dim->imb_dil_janretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_janretido = $dim->imb_dil_janretido - $rec->IMB_RLD_VALOR;
                }
            };
            
            if( $mes == '02')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_fevbruto = $dim->imb_dil_fevbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_fevbruto = $dim->imb_dil_fevbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_fevcomissao = $dim->imb_dil_fevcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_fevcomissao = $dim->imb_dil_fevcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_fevretido = $dim->imb_dil_fevretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_fevretido = $dim->imb_dil_fevretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '03')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_marbruto = $dim->imb_dil_marbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_marbruto = $dim->imb_dil_marbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_marcomissao = $dim->imb_dil_marcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_marcomissao = $dim->imb_dil_marcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_marretido = $dim->imb_dil_marretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_marretido = $dim->imb_dil_marretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '04')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_abrbruto = $dim->imb_dil_abrbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_abrbruto = $dim->imb_dil_abrbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_abrcomissao = $dim->imb_dil_abrcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_abrcomissao = $dim->imb_dil_abrcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_abrretido = $dim->imb_dil_abrretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_abrretido = $dim->imb_dil_abrretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '05')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_maibruto = $dim->imb_dil_maibruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_maibruto = $dim->imb_dil_maibruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_maicomissao = $dim->imb_dil_maicomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_maicomissao = $dim->imb_dil_maicomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_mairetido= $dim->imb_dil_mairetido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_mairetido = $dim->imb_dil_mairetido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '06')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_junbruto = $dim->imb_dil_junbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_junbruto = $dim->imb_dil_junbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_juncomissao = $dim->imb_dil_juncomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_juncomissao = $dim->imb_dil_juncomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_junretido= $dim->imb_dil_junretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_junretido = $dim->imb_dil_junretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '07')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_julbruto = $dim->imb_dil_julbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_julbruto = $dim->imb_dil_julbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_julcomissao = $dim->imb_dil_julcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_julcomissao = $dim->imb_dil_julcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_julretido= $dim->imb_dil_julretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_julretido = $dim->imb_dil_julretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '08')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_agobruto = $dim->imb_dil_agobruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_agobruto = $dim->imb_dil_agobruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_agocomissao = $dim->imb_dil_agocomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_agocomissao = $dim->imb_dil_agocomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_agoretido= $dim->imb_dil_agoretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_agoretido = $dim->imb_dil_agoretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '09')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_setbruto = $dim->imb_dil_setbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_setbruto = $dim->imb_dil_setbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_setcomissao = $dim->imb_dil_setcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_setcomissao = $dim->imb_dil_setcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_setretido= $dim->imb_dil_setretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_setretido = $dim->imb_dil_setretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '10')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_outbruto = $dim->imb_dil_outbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_outbruto = $dim->imb_dil_outbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_outcomissao = $dim->imb_dil_outcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_outcomissao = $dim->imb_dil_outcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_outretido= $dim->imb_dil_outretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_outretido = $dim->imb_dil_outretido - $rec->IMB_RLD_VALOR;
                }
            };


            if( $mes == '11')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_novbruto = $dim->imb_dil_novbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_novbruto = $dim->imb_dil_novbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_novcomissao = $dim->imb_dil_novcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_novcomissao = $dim->imb_dil_novcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_novretido= $dim->imb_dil_novretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_novretido = $dim->imb_dil_novretido - $rec->IMB_RLD_VALOR;
                }
            };

            if( $mes == '12')
            {
                if( $rec->IMB_TBE_IRRF =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_dezbruto = $dim->imb_dil_dezbruto + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_dezbruto= $dim->imb_dil_dezbruto - $rec->IMB_RLD_VALOR;
                }
         
                if( $rec->IMB_TBE_INCISS =='S' ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_dezcomissao = $dim->imb_dil_dezcomissao + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_dezcomissao = $dim->imb_dil_dezcomissao - $rec->IMB_RLD_VALOR;
                }

                if( $rec->IMB_TBE_ID == 18 or $rec->IMB_TBE_ID == -18 ) 
                {
                    if( $rec->IMB_RLD_LOCADORCREDEB == 'C')
                        $dim->imb_dil_dezretido= $dim->imb_dil_dezretido + $rec->IMB_RLD_VALOR;
                    else
                        $dim->imb_dil_dezretido = $dim->imb_dil_dezretido - $rec->IMB_RLD_VALOR;
                }
            };


            $dim->save();


        }


    }

    public function recibosPorProcesso( $aProcessos )
    {
    }
//
}
