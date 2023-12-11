<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContrato;
use App\mdlVContratos;
use App\mdlImovel;
use App\mdlLancamentoFuturo;
use App\mdlParametros2;
use App\mdlCamposSistema;
use App\mdlContratoAnexos;

use DataTables;
use App\User;
use DB;
use Auth;
use Log;

class ctrContrato extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');
    }


    public function list(Request $request)
    {
                                   
        $imprimirvisao = $request->imprimirvisao;


        $contrato = mdlContrato::select(
            [
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_DIAVENCIMENTO',
                'IMB_CONTRATO.IMB_CTR_ID',
                'IMB_CONTRATO.IMB_CTR_REFERENCIA',
                'IMB_CONTRATO.IMB_CTR_VALORALUGUEL',
                'IMB_CONTRATO.IMB_CTR_SITUACAO',
                'IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCATARIO',
                'IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCADOR',
                'IMB_CONTRATO.IMB_CTR_INICIO',
                'IMB_CONTRATO.IMB_CTR_TERMINO',
                'IMB_CONTRATO.IMB_CTR_DATAREAJUSTE',
                'IMB_CONTRATO.IMB_CTR_DATARESCISAO',
                'IMB_CTR_PROXIMOREPASSE',
                'IMB_CTR_REPASSEDIAFIXO',
                'IMB_IMV_PREDIO',
                DB::Raw('(SELECT imovel(IMB_CONTRATO.IMB_IMV_ID) ) AS ENDERECOCOMPLETO'),

                DB::Raw('(SELECT VISUALLANCALTCONTRATOHTML(IMB_CONTRATO.IMB_CTR_ID,
                IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCATARIO) ) AS LANCTOLT'),
                DB::Raw('(SELECT VISUALLANCALDCONTRATOHTML(IMB_CONTRATO.IMB_CTR_ID,
                IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCADOR) ) AS LANCTOLD'),
                'IMB_IMOVEIS.CEP_BAI_NOME',
                DB::Raw('(SELECT PROXIMOVENCIMENTOLOCATARIO(IMB_CONTRATO.IMB_CTR_ID)) AS PROXIMORECEBIMENTO'),
                DB::Raw('(SELECT PROXIMOVENCIMENTOLOCADOR(IMB_CONTRATO.IMB_CTR_ID)) AS PROXIMOREPASSE'),

                DB::Raw('(SELECT IMB_CLT_NOME FROM IMB_LOCATARIOCONTRATO ,IMB_CLIENTE
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND
                    IMB_LOCATARIOCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                    ORDER BY IMB_LCTCTR_PRINCIPAL DESC LIMIT 1) AS IMB_CLT_NOMELOCATARIO'),

                DB::Raw('(SELECT IMB_LOCATARIOCONTRATO.IMB_CLT_ID FROM IMB_LOCATARIOCONTRATO ,IMB_CLIENTE
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND
                    IMB_LOCATARIOCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                    ORDER BY IMB_LCTCTR_PRINCIPAL DESC LIMIT 1) AS IMB_CLT_IDLOCATARIO'),

                DB::raw('(SELECT IMB_AVD_DATAPREVISAO FROM IMB_CONTRATOAVISODESOC
                            WHERE IMB_CONTRATOAVISODESOC.IMB_CTR_ID=IMB_CONTRATO.IMB_CTR_ID
                            AND IMB_AVD_DTHINATIVO IS NULL LIMIT 1 ) AS IMB_AVD_DATAPREVISAO'),

                            DB::raw('( SELECT IMB_CLT_NOME
                            FROM IMB_PROPRIETARIOIMOVEL, IMB_CLIENTE
                            WHERE IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID
                            AND IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                            AND IMB_PROPRIETARIOIMOVEL.IMB_IMVCLT_PRINCIPAL = "S"
                            LIMIT 1) AS PROPRIETARIO'),
                        DB::raw('( SELECT IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID
                            FROM IMB_PROPRIETARIOIMOVEL, IMB_CLIENTE
                            WHERE IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID
                            AND IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                            AND IMB_PROPRIETARIOIMOVEL.IMB_IMVCLT_PRINCIPAL = "S"
                            LIMIT 1) AS IMB_CLT_IDLOCADOR'),
                             DB::raw('( SELECT IMB_CND_NOME
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                'IMB_IMV_CIDADE',
                DB::raw('( SELECT IMB_CLT_NOME
                FROM IMB_CLIENTE WHERE IMB_IMOVEIS.IMB_CLT_ID =
                IMB_CLIENTE.IMB_CLT_ID) AS IMB_CLT_NOME'),
                'IMB_IMB_NOME AS UNIDADE',
                'IMB_CTR_VALORBONIFICACAO4',
                'IMB_CTR_BONIFICACAOTIPO',
                'IMB_CTR_TAXAADMINISTRATIVA',
                'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                'IMB_CTR_ALUGUELGARANTIDO',
                'IMB_CTR_ADVOGADO',
                'IMB_CTR_OBSERVACAO',
                'IMB_CTR_OBSERVACAOLOCADOR',
                'IMB_CTR_OBSERVACAOLOCATARIO',
                'IMB_CTR_EXIGENCIA',
                'IMB_IMV_IPTU1',
                'IMB_IMV_IPTU1REFERENTE',
                'IMB_IMV_IPTU2REFERENTE',
                'IMB_IMV_IPTU3REFERENTE',
                'IMB_IMV_IPTU4REFERENTE',
                'IMB_IMV_IPTU5REFERENTE',
                'IMB_IMV_IPTU2',
                'IMB_IMV_IPTU3',
                'IMB_IMV_IPTU4',
                'IMB_IMV_IPTU5',
                'IMB_IMV_CPFLINSCRICAO',
                'IMB_IMV_CPFLSENHA',
                'IMB_IMV_DAEINSCRICAO',
                'IMB_IMV_DAESENHA',
                DB::raw( "(select coalesce(IMB_PRM_CODIGOIMOVELRECIBOS,'') from IMB_PARAMETROS2 P2 WHERE P2.IMB_IMB_ID = IMB_CONTRATO.IMB_IMB_ID) AS IMB_PRM_CODIGOIMOVELRECIBOS"),
                DB::Raw( '( select IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO WHERE IMB_CONTRATO.IMB_FORPAG_ID_LOCATARIO = IMB_FORMAPAGAMENTO.IMB_FORPAG_ID ) AS FORMAPAGLT' ),
                DB::Raw( '( select coalesce(FIN_CCX_DESCRICAO,"") FROM FIN_CONTACAIXA WHERE FIN_CONTACAIXA.FIN_CCX_ID = IMB_CONTRATO.FIN_CCR_ID_COBRANCA ) AS CONTARECEB' ),
                DB::Raw( "( select  IMB_CAU_VALOR FROM IMB_CONTRATOCAUCAO WHERE IMB_CONTRATOCAUCAO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID LIMIT 1) AS VALORCAUCAO" ),
                DB::Raw( "( select IMB_CTR_VIGENCIATERMINO FROM IMB_CONTRATOSEGUROINCENDIO WHERE IMB_CONTRATOSEGUROINCENDIO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID order by IMB_CTR_VIGENCIAINICIO desc LIMIT 1) AS SEGUROINCENDIO" ),

            ])
            ->leftjoin('IMB_IMOVEIS', 'IMB_IMOVEIS.IMB_IMV_ID', 'IMB_CONTRATO.IMB_IMV_ID')
            ->leftjoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_CONTRATO.IMB_IMB_ID');


            $cFiltrou = 'N';
            $situacao = $request->situacao;
            $advogado = $request->advogado;
            $advogadoexceto = $request->advogadoexceto;

            $diavencimento = $request->diavencimento;
            $semseguro = $request->semseguro;
            
            
            $contrato->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID );

            if( $request->agencia <> '0' )
            {
                $cFiltrou = 'S';
                $contrato->where('IMB_CONTRATO.IMB_IMB_ID2','=', $request->agencia );

            }

            if(  $situacao == 'A' )
            {
                $cFiltrou = 'S';
                $contrato->where('IMB_CONTRATO.IMB_CTR_SITUACAO', 'ATIVO');
            };


            if(  $situacao == 'E' )
            {
                $cFiltrou = 'S';
                $contrato->where('IMB_CONTRATO.IMB_CTR_SITUACAO', 'ENCERRADO');
            };
            
            if(  $advogadoexceto == 'S' )
            {
                $cFiltrou = 'S';
                $contrato->whereRaw("coalesce(IMB_CONTRATO.IMB_CTR_ADVOGADO,'N') <>  'S'");
            };

            if(  $advogado == 'S' )
            {
                $cFiltrou = 'S';
                $contrato->where('IMB_CONTRATO.IMB_CTR_ADVOGADO', 'S');
            };

            if(  $diavencimento <> '' )
            {
                $cFiltrou = 'S';
                $contrato->where('IMB_CONTRATO.IMB_CTR_DIAVENCIMENTO', $diavencimento );
            };

            


            if ($request->has('condominio') && strlen(trim($request->condominio)) > 0){
                $cFiltrou = 'S';
                $contrato->whereRaw( "( exists( SELECT IMB_CND_ID FROM IMB_CONDOMINIO
                WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID AND
                IMB_CND_NOME LIKE '%{$request->condominio}%') or IMB_IMV_PREDIO LIKE '%{$request->condominio}%')") ;
            }


            if ($request->has('locatario') && strlen(trim($request->locatario)) > 0){
                $cFiltrou = 'S';
                $contrato->whereRaw( DB::raw("exists(
                        SELECT IMB_LOCATARIOCONTRATO.IMB_CLT_ID FROM IMB_LOCATARIOCONTRATO,IMB_CLIENTE
                WHERE IMB_LOCATARIOCONTRATO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND
                IMB_LOCATARIOCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID AND
                IMB_CLT_NOME LIKE '%{$request->locatario}%')"));
            }

            if ($request->has('fiador') && strlen(trim($request->fiador)) > 0){
                $cFiltrou = 'S';
                $contrato->whereRaw( DB::raw("exists(
                        SELECT IMB_FIADORCONTRATO.IMB_CLT_ID FROM IMB_FIADORCONTRATO,IMB_CLIENTE
                WHERE IMB_FIADORCONTRATO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND
                IMB_FIADORCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID AND
                IMB_CLT_NOME LIKE '%{$request->fiador}%')"));
            }


            if ($request->has('proprietario') && strlen(trim($request->proprietario)) > 0){
                $cFiltrou = 'S';

                $contrato->whereRaw( DB::raw("exists(
                    SELECT IMB_CLIENTE.IMB_CLT_ID FROM IMB_PROPRIETARIOIMOVEL,IMB_CLIENTE
                    WHERE IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID AND
                    IMB_CLIENTE.IMB_CLT_ID = IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID AND
                    IMB_CLT_NOME LIKE '%{$request->proprietario}%')"));
            }



            if ($request->has('endereco') && strlen(trim($request->endereco)) > 0)
            {
                $cFiltrou = 'S';
                $contrato->whereRaw(DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                          COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                          COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO,''), ' ',
                          COALESCE( IMB_IMV_NUMAPT,'') ) LIKE  '%{$request->endereco}%'"));

            }

            if ($request->has('cidade') && strlen(trim($request->cidade)) > 0)
            {
                $cFiltrou = 'S';
                $contrato->whereRaw( "IMB_IMV_CIDADE LIKE '%{$request->cidade}%'");
            }

            if ($request->has('bairro') && strlen(trim($request->bairro)) > 0)
            {
                $cFiltrou = 'S';
                $contrato->whereRaw( "IMB_IMOVEIS.CEP_BAI_NOME LIKE '%{$request->bairro}%'");
            }

                if( $request->has( 'referencia') && $request->referencia <> '' )
        {
            $cFiltrou = 'S';
            $contrato->whereRaw("IMB_CONTRATO.IMB_CTR_REFERENCIA LIKE '%{$request->referencia}%'");

        }

        if( $request->has( 'id_completus') && $request->id_completus <> '' )
        {
            $cFiltrou = 'S';
            $contrato->where('IMB_CONTRATO.IMB_IMV_ID', $request->id_completus);

        }

        if( $semseguro == 'S')
        {
            $cFiltrou = 'S';
            $param2 = mdlParametros2::find( Auth::user()->IMB_IMB_ID );
            $idseguro = $param2->IMB_TBE_IDSEGINC;
            $contrato->whereRaw("NOT EXISTS( SELECT IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO A WHERE A.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID
                            AND IMB_TBE_ID = $idseguro AND IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCATARIO = IMB_LCF_DATAVENCIMENTO LIMIT 1)");

        }

        if( $imprimirvisao == 'S') 
        {
            $contrato = $contrato->orderBy('IMB_CTR_DIAVENCIMENTO');
            $contrato = $contrato->get();

            $titulo = 'Relatório de Contratos ';
            if( $situacao == 'E') 
                $titulo = $titulo . ' - Encerrados';
            
            if( $situacao == 'A') 
                $titulo = $titulo . ' - Ativos';

                if( $advogado == 'S')
                $titulo = $titulo . ' - Juridicos';
            
            if( $advogadoexceto == 'S')
                $titulo = $titulo . ' - Exceto Juridicos';
            

            return view( 'reports.admimoveis.relcontratosvisaoger', compact( 'contrato','titulo'));
        }
            

        if ( $cFiltrou == 'N') {
            $contrato->limit(0);
        }

        //Log::info('ctrcontrato');
        //Log::info( $contrato->toSql());

        return DataTables::of($contrato)->make(true);
    }



    public function index()
    {
        return view('contrato.index');

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

    public function novo( Request $request )
    {
        $idimovel = $request->input( 'idimovel');
        return view('contrato.newcontrato', compact( 'idimovel' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }

         ////Log::info('validade '.$request->IMB_CTR_PONTUALIDADEVALIDADE );

         $novocontrato = 'N';
        if( $request->IMB_CTR_ID == '' )
        {
            $contrato = new mdlContrato;
            $novocontrato = 'S';
        }
        else
        {
            
            $contrato =  mdlContrato::find( $request->IMB_CTR_ID );

            //SETAR AS VARIAVEIS COMO ESTAVAM
            $IMB_CTR_INICIO                       = $contrato->IMB_CTR_INICIO;
            $IMB_CTR_TERMINO                      = $contrato->IMB_CTR_TERMINO;
            $IMB_CTR_VENCIMENTOLOCATARIO          = $contrato->IMB_CTR_VENCIMENTOLOCATARIO;
            $IMB_CTR_VENCIMENTOLOCADOR            = $contrato->IMB_CTR_VENCIMENTOLOCADOR;
            $IMB_CTR_VALORALUGUEL                 = $contrato->IMB_CTR_VALORALUGUEL;
            $IMB_CTR_TOLERANCIA                   = $contrato->IMB_CTR_TOLERANCIA;
            $IMB_CTR_DATALOCACAO                  = $contrato->IMB_CTR_DATALOCACAO                  ;
            $IMB_CTR_DATAREAJUSTE                 = $contrato->IMB_CTR_DATAREAJUSTE                 ;
            $IMB_CTR_MULTA                        = $contrato->IMB_CTR_MULTA                        ;
            $IMB_CTR_DURACAO                      = $contrato->IMB_CTR_DURACAO                      ;
            $IMB_CTR_DIAVENCIMENTO                = $contrato->IMB_CTR_DIAVENCIMENTO                ;
            $IMB_CTR_DESCONTO                     = $contrato->IMB_CTR_DESCONTO                     ;
            $IMB_CTR_DESCONTOMESES                = $contrato->IMB_CTR_DESCONTOMESES                ;
            $IMB_CTR_CONTRATOPARCELAS             = $contrato->IMB_CTR_CONTRATOPARCELAS             ;
            $IMB_CTR_CONTRATOVALOR                = $contrato->IMB_CTR_CONTRATOVALOR                ;
            $IMB_CTR_CONTRATOVENPAR1              = $contrato->IMB_CTR_CONTRATOVENPAR1              ;
            $IMB_CTR_CONTRATOVENPAR2              = $contrato->IMB_CTR_CONTRATOVENPAR2              ;
            $IMB_CTR_CONTRATOVENPAR3              = $contrato->IMB_CTR_CONTRATOVENPAR3              ;
            $IMB_CTR_CONTRATOVENPAR4              = $contrato->IMB_CTR_CONTRATOVENPAR4              ;
            $IMB_CTR_CONTRATOVALPAR1              = $contrato->IMB_CTR_CONTRATOVALPAR1              ;
            $IMB_CTR_CONTRATOVALPAR2              = $contrato->IMB_CTR_CONTRATOVALPAR2              ;
            $IMB_CTR_CONTRATOVALPAR3              = $contrato->IMB_CTR_CONTRATOVALPAR3              ;
            $IMB_CTR_CONTRATOVALPAR4              = $contrato->IMB_CTR_CONTRATOVALPAR4              ;
            $IMB_CTR_COBTAXAADM1                  = $contrato->IMB_CTR_COBTAXAADM1                  ;
            $IMB_CTR_COBTAXAADM2                  = $contrato->IMB_CTR_COBTAXAADM2                  ;
            $IMB_CTR_COBTAXAADM3                  = $contrato->IMB_CTR_COBTAXAADM3                  ;
            $IMB_CTR_COBTAXAADM4                  = $contrato->IMB_CTR_COBTAXAADM4                  ;
            $IMB_CTR_SITUACAO                     = $contrato->IMB_CTR_SITUACAO                     ;
            $IMB_CTR_FINALIDADE                   = $contrato->IMB_CTR_FINALIDADE                   ;
            $IMB_IRJ_ID                           = $contrato->IMB_IRJ_ID                           ;
            $IMB_CTR_FORMAREAJUSTE                = $contrato->IMB_CTR_FORMAREAJUSTE                ;
            $IMB_CTR_BONIFICACAOTIPO              = $contrato->IMB_CTR_BONIFICACAOTIPO              ;
            $IMB_IMV_ID                           = $contrato->IMB_IMV_ID                           ;
            $IMB_CTR_TAXAADMINISTRATIVA           = $contrato->IMB_CTR_TAXAADMINISTRATIVA           ;
            $IMB_CTR_TAXAADMINISTRATIVAFORMA      = $contrato->IMB_CTR_TAXAADMINISTRATIVAFORMA      ;
            $IMB_CTR_REPASSEDIA                   = $contrato->IMB_CTR_REPASSEDIA                   ;
            $IMB_FORPAG_ID_LOCATARIO              = $contrato->IMB_FORPAG_ID_LOCATARIO              ;
            $IMB_CTR_EXIGENCIA                    = $contrato->IMB_CTR_EXIGENCIA                    ;
            $IMB_CTR_COBRARBOLETO                 = $contrato->IMB_CTR_COBRARBOLETO                 ;
            $IMB_CTR_ALUGUELGARANTIDO             = $contrato->IMB_CTR_ALUGUELGARANTIDO             ;
            $FIN_CCR_ID_COBRANCA                  = $contrato->FIN_CCR_ID_COBRANCA                  ;
            $IMB_CTR_COBRANCAVALOR                = $contrato->IMB_CTR_COBRANCAVALOR                ;
            $IMB_CTR_IPTUINCLUSO                  = $contrato->IMB_CTR_IPTUINCLUSO                  ;
            $IMB_ATD_ID                           = $contrato->IMB_ATD_ID                           ;
            $IMB_CTR_FINALIDADEDESCRICAO          = $contrato->IMB_CTR_FINALIDADEDESCRICAO          ;
            $IMB_IMB_ID2                          = $contrato->IMB_IMB_ID2                          ;
            $IMB_CTR_REFERENCIA                   = $contrato->IMB_CTR_REFERENCIA                   ;
            $IMB_CTR_JUROSDIARIO                  = $contrato->IMB_CTR_JUROSDIARIO                  ;
            $IMB_CTR_PERMANDIARIA                 = $contrato->IMB_CTR_PERMANDIARIA                 ;
            $IMB_CTR_PINTURANOVA                  = $contrato->IMB_CTR_PINTURANOVA                  ;
            $IMB_CTR_BOLETOVIAEMAIL               = $contrato->IMB_CTR_BOLETOVIAEMAIL               ;
            $IMB_CTR_PARCELALT                    = $contrato->IMB_CTR_PARCELALT                    ;
            $IMB_CTR_PARCELALD                    = $contrato->IMB_CTR_PARCELALD                    ;
            $IMB_CTR_MAIORINDICE                  = $contrato->IMB_CTR_MAIORINDICE                  ;
            $IMB_CTR_PONTUALIDADEVALIDADE         = $contrato->IMB_CTR_PONTUALIDADEVALIDADE         ;
            $IMB_CTR_CLAUSULA12MESES              = $contrato->IMB_CTR_CLAUSULA12MESES              ;
            $IMB_CTR_TOLERANCIAFATOR              = $contrato->IMB_CTR_TOLERANCIAFATOR              ;
            $IMB_CTR_VALORPRIMVEN                 = $contrato->IMB_CTR_VALORPRIMVEN                 ;
            $IMB_CTR_VALORCOND                    = $contrato->IMB_CTR_VALORCOND                    ;
            $IMB_CTR_SEGUROVALOR                  = $contrato->IMB_CTR_SEGUROVALOR                  ;
            $IMB_CTR_BONIF_NAOINC_TA              = $contrato->IMB_CTR_BONIF_NAOINC_TA              ;
            $IMB_CTR_CORRETAGEMPERC               = $contrato->IMB_CTR_CORRETAGEMPERC               ;
            $IMB_CTR_CAPTAPERC                    = $contrato->IMB_CTR_CAPTAPERC                    ;
            $IMB_ctr_seguroparcelas               = $contrato->IMB_ctr_seguroparcelas               ;
            $IMB_CTR_VALORBONIFICACAO4            = $contrato->IMB_CTR_VALORBONIFICACAO4            ;
            $IMB_CTR_FCI                          = $contrato->IMB_CTR_FCI                          ;
            $IMB_SGR_ID                           = $contrato->IMB_SGR_ID                           ;
            $IMB_CTR_IPTUVALOR                    = $contrato->IMB_CTR_IPTUVALOR                    ;
            $IMB_CTR_IPTULOCADOR                  = $contrato->IMB_CTR_IPTULOCADOR                  ;
            $IMB_CTR_IPTULOCATARIO                = $contrato->IMB_CTR_IPTULOCATARIO                ;
            $IMB_CTR_IPTUQTDEPARCLAS              = $contrato->IMB_CTR_IPTUQTDEPARCLAS              ;
            $IMB_CTR_DIASACERTO                   = $contrato->IMB_CTR_DIASACERTO                   ;
            $IMB_CTR_DIASVALOR                    = $contrato->IMB_CTR_DIASVALOR                    ;
            $IMB_CTR_IRRF                         = $contrato->IMB_CTR_IRRF                         ;
            $imb_ctr_naoemitirnfe                 = $contrato->imb_ctr_naoemitirnfe                 ;
            $IMB_CTR_CALISS                       = $contrato->IMB_CTR_CALISS                       ;
            $IMB_CTR_IRPERC                       = $contrato->IMB_CTR_IRPERC                       ;
            $IMB_CTR_COFINS                       = $contrato->IMB_CTR_COFINS                       ;
            $IMB_CTR_CONTSIND                     = $contrato->IMB_CTR_CONTSIND                     ;
            $IMB_CTR_PIS                          = $contrato->IMB_CTR_PIS                          ;
            $IMB_CTR_OBSERVACAOLOCADOR            = $contrato->IMB_CTR_OBSERVACAOLOCADOR            ;
            $IMB_CTR_OBSERVACAOLOCATARIO          = $contrato->IMB_CTR_OBSERVACAOLOCATARIO          ;
            $IMB_CTR_OBSERVACAO                   = $contrato->IMB_CTR_OBSERVACAO                   ;
            $IMB_CTR_ADVOGADO                     = $contrato->IMB_CTR_ADVOGADO                     ;
            $IMB_CTR_NUNCARETEIRRF                = $contrato->IMB_CTR_NUNCARETEIRRF;
            $IMB_CTR_EMAIL                          = $contrato->IMB_CTR_EMAIL;
            $IMB_CTR_BOLETOVIAEMAIL                          = $contrato->IMB_CTR_BOLETOVIAEMAIL;
            
        }





        $contrato->IMB_CTR_INICIO                       = formatarData($request->IMB_CTR_INICIO);
        $contrato->IMB_IMB_ID                           = Auth::user()->IMB_IMB_ID;
        $contrato->IMB_CTR_TERMINO                      = formatarData($request->IMB_CTR_TERMINO);
        $contrato->IMB_CTR_VALORALUGUEL                 = $request->IMB_CTR_VALORALUGUEL;
        $contrato->IMB_CTR_TOLERANCIA                   = $request->IMB_CTR_TOLERANCIA;
        if( $request->IMB_CTR_PRIMEIROVENCIMENTO<>'' )
            $contrato->IMB_CTR_PRIMEIROVENCIMENTO           = formatarData($request->IMB_CTR_PRIMEIROVENCIMENTO);

        if( $request->IMB_CTR_DATALOCACAO<>'' )
           $contrato->IMB_CTR_DATALOCACAO                  = formatarData($request->IMB_CTR_DATALOCACAO);
        $contrato->IMB_CTR_DATAREAJUSTE                 = formatarData($request->IMB_CTR_DATAREAJUSTE);
        $contrato->IMB_CTR_MULTA                        = $request->IMB_CTR_MULTA;
        $contrato->IMB_CTR_DURACAO                      = $request->IMB_CTR_DURACAO;
        $contrato->IMB_CTR_DIAVENCIMENTO                = $request->IMB_CTR_DIAVENCIMENTO;
        $contrato->IMB_CTR_DESCONTO                     = $request->IMB_CTR_DESCONTO;
        $contrato->IMB_CTR_DESCONTOMESES                = $request->IMB_CTR_DESCONTOMESES;
        $contrato->IMB_CTR_CONTRATOPARCELAS             = $request->IMB_CTR_CONTRATOPARCELAS;
        $contrato->IMB_CTR_CONTRATOVALOR                = $request->IMB_CTR_CONTRATOVALOR;
            $contrato->IMB_CTR_CONTRATOVENPAR1              = $request->IMB_CTR_CONTRATOVENPAR1;
            $contrato->IMB_CTR_CONTRATOVENPAR2              = $request->IMB_CTR_CONTRATOVENPAR2;
            $contrato->IMB_CTR_CONTRATOVENPAR3              = $request->IMB_CTR_CONTRATOVENPAR3;
            $contrato->IMB_CTR_CONTRATOVENPAR4              = $request->IMB_CTR_CONTRATOVENPAR4;
        $contrato->IMB_CTR_CONTRATOVALPAR1              = $request->IMB_CTR_CONTRATOVALPAR1;
        $contrato->IMB_CTR_CONTRATOVALPAR2              = $request->IMB_CTR_CONTRATOVALPAR2;
        $contrato->IMB_CTR_CONTRATOVALPAR3              = $request->IMB_CTR_CONTRATOVALPAR3;
        $contrato->IMB_CTR_CONTRATOVALPAR4              = $request->IMB_CTR_CONTRATOVALPAR4;
        $contrato->IMB_CTR_COBTAXAADM1                  = $request->IMB_CTR_COBTAXAADM1;
        $contrato->IMB_CTR_COBTAXAADM2                  = $request->IMB_CTR_COBTAXAADM2;
        $contrato->IMB_CTR_COBTAXAADM3                  = $request->IMB_CTR_COBTAXAADM3;
        $contrato->IMB_CTR_COBTAXAADM4                  = $request->IMB_CTR_COBTAXAADM4;
        if( $novocontrato == 'S')
            $contrato->IMB_CTR_SITUACAO                     = 'ATIVO';
        $contrato->IMB_CTR_FINALIDADE                   = $request->IMB_CTR_FINALIDADE;
        $contrato->IMB_IRJ_ID                           = $request->IMB_IRJ_ID;
        $contrato->IMB_CTR_FORMAREAJUSTE                = $request->IMB_CTR_FORMAREAJUSTE;
        $contrato->IMB_CTR_BONIFICACAOTIPO              = $request->IMB_CTR_BONIFICACAOTIPO;
        $contrato->IMB_IMV_ID                           = $request->IMB_IMV_ID;
        $contrato->IMB_CTR_TAXAADMINISTRATIVA           = $request->IMB_CTR_TAXAADMINISTRATIVA;
        $contrato->IMB_CTR_TAXAADMINISTRATIVAFORMA      = $request->IMB_CTR_TAXAADMINISTRATIVAFORMA;
        if( $request->IMB_CTR_ID == '' )
        {
            $contrato->IMB_CTR_VENCIMENTOLOCADOR            = formatarData($request->IMB_CTR_PRIMEIROVENCIMENTO);
            $contrato->IMB_CTR_VENCIMENTOLOCATARIO          = formatarData($request->IMB_CTR_PRIMEIROVENCIMENTO);
        }
        else
         {
            $contrato->IMB_CTR_VENCIMENTOLOCADOR            = formatarData($request->IMB_CTR_VENCIMENTOLOCADOR);
            $contrato->IMB_CTR_VENCIMENTOLOCATARIO          = formatarData($request->IMB_CTR_VENCIMENTOLOCATARIO);
        }
        $contrato->IMB_CTR_REPASSEDIA                   = $request->IMB_CTR_REPASSEDIA;
        $contrato->IMB_FORPAG_ID_LOCATARIO              = $request->IMB_FORPAG_ID_LOCATARIO;
        $contrato->IMB_CTR_EXIGENCIA                    = $request->IMB_CTR_EXIGENCIA;
        $contrato->IMB_CTR_COBRARBOLETO                 = $request->IMB_CTR_COBRARBOLETO;
        $contrato->IMB_CTR_ALUGUELGARANTIDO             = $request->IMB_CTR_ALUGUELGARANTIDO;
        $contrato->FIN_CCR_ID_COBRANCA                  = $request->FIN_CCR_ID_COBRANCA;
        $contrato->IMB_CTR_COBRANCAVALOR                = $request->IMB_CTR_COBRANCAVALOR;
        $contrato->IMB_CTR_IPTUINCLUSO                  = $request->IMB_CTR_IPTUINCLUSO;
        $contrato->IMB_ATD_ID                           = $request->IMB_ATD_ID;
        $contrato->IMB_CTR_FINALIDADEDESCRICAO          = $request->IMB_CTR_FINALIDADEDESCRICAO;
        $contrato->IMB_IMB_ID2                          = $request->IMB_IMB_ID2;
        $contrato->IMB_CTR_REFERENCIA                   = $request->IMB_CTR_REFERENCIA;
        $contrato->IMB_CTR_JUROSDIARIO                  = $request->IMB_CTR_JUROSDIARIO;
        $contrato->IMB_CTR_PERMANDIARIA                 = $request->IMB_CTR_PERMANDIARIA;
        $contrato->IMB_CTR_PINTURANOVA                  = $request->IMB_CTR_PINTURANOVA;
        $contrato->IMB_CTR_BOLETOVIAEMAIL               = $request->IMB_CTR_BOLETOVIAEMAIL;
        $contrato->IMB_CTR_PARCELALT                    = 1;
        $contrato->IMB_CTR_PARCELALD                    = 1;
        $contrato->IMB_CTR_MAIORINDICE                  = $request->IMB_CTR_MAIORINDICE;
        if( $request->IMB_CTR_PONTUALIDADEVALIDADE <> '' )
            $contrato->IMB_CTR_PONTUALIDADEVALIDADE         = formatarData($request->IMB_CTR_PONTUALIDADEVALIDADE);
        else
            $contrato->IMB_CTR_PONTUALIDADEVALIDADE = null;

        $contrato->IMB_CTR_CLAUSULA12MESES              = $request->IMB_CTR_CLAUSULA12MESES;
        $contrato->IMB_CTR_TOLERANCIAFATOR              = $request->IMB_CTR_TOLERANCIAFATOR;
        $contrato->IMB_CTR_VALORPRIMVEN                 = $request->IMB_CTR_VALORPRIMVEN;
        $contrato->IMB_CTR_VALORCOND                    = $request->IMB_CTR_VALORCOND;
        $contrato->IMB_CTR_SEGUROVALOR                  = $request->IMB_CTR_SEGUROVALOR;
        $contrato->IMB_CTR_BONIF_NAOINC_TA              = $request->IMB_CTR_BONIF_NAOINC_TA;
        $contrato->IMB_CTR_CORRETAGEMPERC               = $request->IMB_CTR_CORRETAGEMPERC;
        $contrato->IMB_CTR_CAPTAPERC                    = $request->IMB_CTR_CAPTAPERC;
        $contrato->IMB_ctr_seguroparcelas               = $request->IMB_ctr_seguroparcelas;
        $contrato->IMB_CTR_VALORBONIFICACAO4            = $request->IMB_CTR_VALORBONIFICACAO4;
        $contrato->IMB_CTR_FCI                          = $request->IMB_CTR_FCI;
        $contrato->IMB_SGR_ID                           = $request->IMB_SGR_ID;
        $contrato->IMB_CTR_IPTUVALOR                    = $request->IMB_CTR_IPTUVALOR;
        $contrato->IMB_CTR_IPTULOCADOR                  = $request->IMB_CTR_IPTULOCADOR;
        $contrato->IMB_CTR_IPTULOCATARIO                = $request->IMB_CTR_IPTULOCATARIO;
        $contrato->IMB_CTR_IPTUQTDEPARCLAS              = $request->IMB_CTR_IPTUQTDEPARCLAS;
        $contrato->IMB_CTR_DIASACERTO                   = $request->IMB_CTR_DIASACERTO;
        $contrato->IMB_CTR_DIASVALOR                    = $request->IMB_CTR_DIASVALOR;
        $contrato->IMB_CTR_IRRF                         = $request->IMB_CTR_IRRF;
        $contrato->imb_ctr_naoemitirnfe                 = $request->imb_ctr_naoemitirnfe;
        $contrato->IMB_CTR_CALISS                       = $request->IMB_CTR_CALISS;
        $contrato->IMB_CTR_IRPERC                       = $request->IMB_CTR_IRPERC;
        $contrato->IMB_CTR_COFINS                       = $request->IMB_CTR_COFINS;
        $contrato->IMB_CTR_CONTSIND                     = $request->IMB_CTR_CONTSIND;
        $contrato->IMB_CTR_PIS                          = $request->IMB_CTR_PIS;
        $contrato->IMB_CTR_OBSERVACAOLOCADOR            = $request->IMB_CTR_OBSERVACAOLOCADOR;
        $contrato->IMB_CTR_OBSERVACAOLOCATARIO          = $request->IMB_CTR_OBSERVACAOLOCATARIO;
        $contrato->IMB_CTR_OBSERVACAO                   = $request->IMB_CTR_OBSERVACAO;
        $contrato->IMB_CTR_ADVOGADO                     = $request->IMB_CTR_ADVOGADO;
        $contrato->IMB_CTR_NUNCARETEIRRF                     = $request->IMB_CTR_NUNCARETEIRRF;

        $contrato->IMB_CTR_REPASSEDIAFIXO                     = $request->IMB_CTR_REPASSEDIAFIXO;
        $contrato->IMB_CTR_PROXIMOREPASSE                     = $request->IMB_CTR_PROXIMOREPASSE;
        $contrato->IMB_CTR_EMAIL                     = $request->IMB_CTR_EMAIL;
        $contrato->IMB_CTR_BOLETOVIAEMAIL                     = $request->IMB_CTR_BOLETOVIAEMAIL;
        $contrato->IMB_CTR_JURIDICOANOTACOES                     = $request->IMB_CTR_JURIDICOANOTACOES;
                        
        
        //definir em qual parcela será o proximo reajuste
        if( $request->IMB_CTR_ID == '' )
        {
            $datainicial = $contrato->IMB_CTR_VENCIMENTOLOCATARIO;
            for ($x = 1; $x <= $contrato->IMB_CTR_FORMAREAJUSTE; $x++)
            {
                $datainicial = app('App\Http\Controllers\ctrRotinas')
                ->addMeses( $contrato->IMB_CTR_DIAVENCIMENTO,  1, $datainicial);
            }
            $contrato->IMB_CTR_REAJUSTARPARCELAVENCTO = $datainicial;
        }

        $contrato->save();


        //Log::info( "IMB_CTR_INICIO: $request->IMB_CTR_ID ");
        if( $request->IMB_CTR_ID <> '' )
        {
            //GRAVANDO OS LOGS DE CONTRATO;
            //SETAR AS VARIAVEIS COMO ESTAVAM
            //Log::info( "IMB_CTR_INICIO: $IMB_CTR_INICIO ");
            //Log::info( "request->IMB_CTR_INICIO: $request->IMB_CTR_INICIO");

            if( $IMB_CTR_VALORALUGUEL <> $request->IMB_CTR_VALORALUGUEL )
            {
                $today = date( 'Y/m/d');
                //Log::info( "TOTAL $today");

                ////Log::info('Fazendo a replicação');
                        DB::statement("UPDATE IMB_LANCAMENTOFUTURO SET IMB_LCF_VALOR = $request->IMB_CTR_VALORALUGUEL ".
                "WHERE IMB_CTR_ID = $request->IMB_CTR_ID and IMB_TBE_ID = 1 AND ".
                "IMB_LCF_DATAVENCIMENTO >= '$today' and IMB_LCF_DATARECEBIMENTO IS NULL AND IMB_LCF_DATAPAGAMENTO IS NULL");
            }

            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_INICIO', $IMB_CTR_INICIO, $contrato->IMB_CTR_INICIO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_VALORALUGUEL', $IMB_CTR_VALORALUGUEL, $contrato->IMB_CTR_VALORALUGUEL);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_TOLERANCIA', $IMB_CTR_TOLERANCIA, $contrato->IMB_CTR_TOLERANCIA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_DATALOCACAO', $IMB_CTR_DATALOCACAO, $contrato->IMB_CTR_DATALOCACAO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_DATAREAJUSTE', $IMB_CTR_DATAREAJUSTE, $contrato->IMB_CTR_DATAREAJUSTE);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_MULTA', $IMB_CTR_MULTA, $contrato->IMB_CTR_MULTA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_DURACAO', $IMB_CTR_DURACAO, $contrato->IMB_CTR_DURACAO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_DIAVENCIMENTO', $IMB_CTR_DIAVENCIMENTO, $contrato->IMB_CTR_DIAVENCIMENTO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_DESCONTO', $IMB_CTR_DESCONTO, $contrato->IMB_CTR_DESCONTO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_DESCONTOMESES', $IMB_CTR_DESCONTOMESES, $contrato->IMB_CTR_DESCONTOMESES);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOPARCELAS', $IMB_CTR_CONTRATOPARCELAS, $contrato->IMB_CTR_CONTRATOPARCELAS);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVALOR', $IMB_CTR_CONTRATOVALOR, $contrato->IMB_CTR_CONTRATOVALOR);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVENPAR1', $IMB_CTR_CONTRATOVENPAR1, $contrato->IMB_CTR_CONTRATOVENPAR1);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVENPAR2', $IMB_CTR_CONTRATOVENPAR2, $contrato->IMB_CTR_CONTRATOVENPAR2);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVENPAR3', $IMB_CTR_CONTRATOVENPAR3, $contrato->IMB_CTR_CONTRATOVENPAR3);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVENPAR4', $IMB_CTR_CONTRATOVENPAR4, $contrato->IMB_CTR_CONTRATOVENPAR4);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVALPAR1', $IMB_CTR_CONTRATOVALPAR1, $contrato->IMB_CTR_CONTRATOVALPAR1);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVALPAR2', $IMB_CTR_CONTRATOVALPAR2, $contrato->IMB_CTR_CONTRATOVALPAR2);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVALPAR3', $IMB_CTR_CONTRATOVALPAR3, $contrato->IMB_CTR_CONTRATOVALPAR3);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CONTRATOVALPAR4', $IMB_CTR_CONTRATOVALPAR4, $contrato->xIMB_CTR_CONTRATOVALPAR4);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_COBTAXAADM1', $IMB_CTR_COBTAXAADM1, $contrato->IMB_CTR_COBTAXAADM1);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_COBTAXAADM2', $IMB_CTR_COBTAXAADM2, $contrato->IMB_CTR_COBTAXAADM2);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_COBTAXAADM3', $IMB_CTR_COBTAXAADM3, $contrato->IMB_CTR_COBTAXAADM3);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_COBTAXAADM4', $IMB_CTR_COBTAXAADM4, $contrato->IMB_CTR_COBTAXAADM4);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_SITUACAO', $IMB_CTR_SITUACAO, $contrato->IMB_CTR_SITUACAO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_FINALIDADE', $IMB_CTR_FINALIDADE, $contrato->IMB_CTR_FINALIDADE);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_IRJ_ID', $IMB_IRJ_ID, $contrato->IMB_IRJ_ID);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_FORMAREAJUSTE', $IMB_CTR_FORMAREAJUSTE, $contrato->IMB_CTR_FORMAREAJUSTE);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_BONIFICACAOTIPO', $IMB_CTR_BONIFICACAOTIPO, $contrato->IMB_CTR_BONIFICACAOTIPO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_TAXAADMINISTRATIVA', $IMB_CTR_TAXAADMINISTRATIVA, $contrato->IMB_CTR_TAXAADMINISTRATIVA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_TAXAADMINISTRATIVAFORMA', $IMB_CTR_TAXAADMINISTRATIVAFORMA, $contrato->IMB_CTR_TAXAADMINISTRATIVAFORMA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_REPASSEDIA', $IMB_CTR_REPASSEDIA, $contrato->IMB_CTR_REPASSEDIA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_FORPAG_ID_LOCATARIO', $IMB_FORPAG_ID_LOCATARIO, $contrato->IMB_FORPAG_ID_LOCATARIO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_EXIGENCIA', $IMB_CTR_EXIGENCIA, $contrato->IMB_CTR_EXIGENCIA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_COBRARBOLETO', $IMB_CTR_COBRARBOLETO, $contrato->IMB_CTR_COBRARBOLETO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_ALUGUELGARANTIDO', $IMB_CTR_ALUGUELGARANTIDO, $contrato->IMB_CTR_ALUGUELGARANTIDO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'FIN_CCR_ID_COBRANCA', $FIN_CCR_ID_COBRANCA, $contrato->FIN_CCR_ID_COBRANCA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_COBRANCAVALOR', $IMB_CTR_COBRANCAVALOR, $contrato->IMB_CTR_COBRANCAVALOR);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_IPTUINCLUSO', $IMB_CTR_IPTUINCLUSO, $contrato->IMB_CTR_IPTUINCLUSO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_FINALIDADEDESCRICAO', $IMB_CTR_FINALIDADEDESCRICAO, $contrato->IMB_CTR_FINALIDADEDESCRICAO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_IMB_ID2', $IMB_IMB_ID2, $contrato->IMB_IMB_ID2);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_REFERENCIA', $IMB_CTR_REFERENCIA, $contrato->IMB_CTR_REFERENCIA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_JUROSDIARIO', $IMB_CTR_JUROSDIARIO, $contrato->IMB_CTR_JUROSDIARIO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_PINTURANOVA', $IMB_CTR_PINTURANOVA, $contrato->IMB_CTR_PINTURANOVA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_BOLETOVIAEMAIL', $IMB_CTR_BOLETOVIAEMAIL, $contrato->IMB_CTR_BOLETOVIAEMAIL);
            //$this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_PONTUALIDADEVALIDADE', $IMB_CTR_PONTUALIDADEVALIDADE, $contrato->IMB_CTR_PONTUALIDADEVALIDADE);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CLAUSULA12MESES', $IMB_CTR_CLAUSULA12MESES, $contrato->IMB_CTR_CLAUSULA12MESES);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_TOLERANCIAFATOR', $IMB_CTR_TOLERANCIAFATOR, $contrato->IMB_CTR_TOLERANCIAFATOR);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_VALORPRIMVEN', $IMB_CTR_VALORPRIMVEN, $contrato->IMB_CTR_VALORPRIMVEN);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_VALORCOND', $IMB_CTR_VALORCOND, $contrato->IMB_CTR_VALORCOND);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_BONIF_NAOINC_TA', $IMB_CTR_BONIF_NAOINC_TA, $contrato->IMB_CTR_BONIF_NAOINC_TA);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_VALORBONIFICACAO4', $IMB_CTR_VALORBONIFICACAO4, $contrato->IMB_CTR_VALORBONIFICACAO4);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_IRRF', $IMB_CTR_IRRF, $contrato->IMB_CTR_IRRF);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'imb_ctr_naoemitirnfe', $imb_ctr_naoemitirnfe, $contrato->imb_ctr_naoemitirnfe);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_CALISS', $IMB_CTR_CALISS, $contrato->IMB_CTR_CALISS);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_OBSERVACAOLOCADOR', $IMB_CTR_OBSERVACAOLOCADOR, $contrato->IMB_CTR_OBSERVACAOLOCADOR);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_OBSERVACAOLOCATARIO', $IMB_CTR_OBSERVACAOLOCATARIO, $contrato->IMB_CTR_OBSERVACAOLOCATARIO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_OBSERVACAO', $IMB_CTR_OBSERVACAO, $contrato->IMB_CTR_OBSERVACAO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_ADVOGADO', $IMB_CTR_ADVOGADO, $contrato->IMB_CTR_ADVOGADO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_NUNCARETEIRRF', $IMB_CTR_NUNCARETEIRRF, $contrato->IMB_CTR_NUNCARETEIRRF);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_VENCIMENTOLOCADOR', $IMB_CTR_VENCIMENTOLOCADOR, $contrato->IMB_CTR_VENCIMENTOLOCADOR);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_VENCIMENTOLOCATARIO', $IMB_CTR_VENCIMENTOLOCATARIO, $contrato->IMB_CTR_VENCIMENTOLOCATARIO);
            $this->verificarAlteracoes( $contrato->IMB_CTR_ID, 'IMB_CTR_EMAIL', $IMB_CTR_EMAIL, $contrato->IMB_CTR_EMAIL);
                        
        }


        $par2 = mdlParametros2::find( Auth::user()->IMB_IMB_ID );
        //DEIXAR O IMOVEL COMO ALUGADO

        $imv = mdlImovel::find( $contrato->IMB_IMV_ID );
        if( $request->IMB_CTR_ID == '' )
            $imv->VIS_STA_ID = $par2->VIS_STA_IDALUGADO;
        $imv->IMB_IMV_RELIRRF=$request->IMB_IMV_RELIRRF;

        $imv->IMB_IMV_ALUGUELAGREGAR               = $request->IMB_IMV_ALUGUELAGREGAR;
        $imv->IMB_IMV_AGREGADOLDCREDEB             = $request->IMB_IMV_AGREGADOLDCREDEB;
        $imv->IMB_IMV_AGREGADOLTCREDEB             = $request->IMB_IMV_AGREGADOLTCREDEB;
        if( $novocontrato =='N')
        {
            $imv->IMB_IMV_DAESENHA             = $request->IMB_IMV_DAESENHA;
            $imv->IMB_IMV_DAEINSCRICAO             = $request->IMB_IMV_DAEINSCRICAO;
            $imv->IMB_IMV_CPFLINSCRICAO             = $request->IMB_IMV_CPFLINSCRICAO;
            $imv->IMB_IMV_IPTU1             = $request->IMB_IMV_IPTU1;
            $imv->IMB_IMV_IPTU1REFERENTE= $request->IMB_IMV_IPTU1REFERENTE;
            $imv->IMB_IMV_IPTU2             = $request->IMB_IMV_IPTU2;
            $imv->IMB_IMV_IPTU2REFERENTE= $request->IMB_IMV_IPTU2REFERENTE;
            $imv->IMB_IMV_IPTU3             = $request->IMB_IMV_IPTU3;
            $imv->IMB_IMV_IPTU3REFERENTE= $request->IMB_IMV_IPTU3REFERENTE;
            $imv->IMB_IMV_IPTU4             = $request->IMB_IMV_IPTU4;
            $imv->IMB_IMV_IPTU4REFERENTE= $request->IMB_IMV_IPTU4REFERENTE;


            $imv->IMB_IMV_13COBRAR= $request->IMB_IMV_13COBRAR;
            $imv->IMB_IMV_13PERCENTUAL= $request->IMB_IMV_13PERCENTUAL;
            $imv->IMB_IMV_13MES= $request->IMB_IMV_13MES;

            $imv->IMB_IMV_13_2PERCENTUAL= $request->IMB_IMV_13_2PERCENTUAL;
            $imv->IMB_IMV_13_2MES= $request->IMB_IMV_13_2MES;

            $imv->IMB_IMV_13_3PERCENTUAL= $request->IMB_IMV_13_3PERCENTUAL;
            $imv->IMB_IMV_13_3MES= $request->IMB_IMV_13_3MES;
        }

        $imv->save();


        return response()->json( $contrato->IMB_CTR_ID, 200);




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
    public function edit( Request $request )
    {

        $idcontratopesquisa = $request->IMB_CTR_ID;

        return view( 'contrato.contratoedit', compact( 'idcontratopesquisa') );

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

    public function find($id)
    {
        $contrato =mdlContrato::select(
            [   'IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_IMV_ID',
                'IMB_CTR_TAXAADMINISTRATIVA',
                'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) as ENDERECOCOMPLETO'),
                DB::Raw('( SELECT CEP_BAIRRO.CEP_BAI_NOME FROM IMB_IMOVEIS,CEP_BAIRRO WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID AND IMB_IMOVEIS.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID LIMIT 1) AS BAIRRO'),
                DB::Raw('PEGALOCADORPRINCIPALIMV(IMB_IMV_ID) AS PROPRIETARIO'),
                DB::Raw('PEGALOCATARIOCONTRATO(IMB_CTR_ID) AS IMB_CLT_NOME_LOCATARIO'),
                'IMB_IMV_ID',
                'IMB_CTR_SITUACAO',
                'IMB_CTR_TOLERANCIA',
                'IMB_CTR_INICIO',
                'IMB_CTR_DATAREAJUSTE',
                'IMB_CTR_REPASSEDIA',
                'IMB_CTR_DIAVENCIMENTO',
                'IMB_CTR_VENCIMENTOLOCATARIO',
                'IMB_CTR_VENCIMENTOLOCADOR',
                'IMB_CTR_VALORALUGUEL',
                'IMB_CTR_PROXIMOREPASSE',
                'IMB_CTR_REPASSEDIAFIXO',
                DB::raw('( SELECT MAX( IMB_RLT_DATACOMPETENCIA)
                FROM IMB_RECIBOLOCATARIO WHERE IMB_RECIBOLOCATARIO.IMB_CTR_ID =
                    IMB_CTR_ID ) AS ULTIMORECEBIMENTO'),
                DB::raw('( SELECT MAX( IMB_RLD_DATAVENCIMENTO)
                FROM IMB_RECIBOLOCADOR WHERE IMB_RECIBOLOCADOR.IMB_CTR_ID =
                    IMB_CTR_ID ) AS ULTIMOREPASSE'),

                //DB::raw('proximovencimentolocador( IMB_CONTRATO.IMB_CTR_ID ) AS VENCIMENTOLOCADOR'),
                //DB::raw('proximovencimentolocatario( IMB_CONTRATO.IMB_CTR_ID ) AS VENCIMENTOLOCATARIO')
            ]
            )->where( 'IMB_CTR_ID', '=', $id
            )->orderBy('IMB_CTR_SITUACAO'
            )->orderBy('ENDERECOCOMPLETO');

            //Log::info( $contrato->toSql());

            $contrato = $contrato->get();
            return $contrato;
        //
    }

    public function findFull($id)
    {
        $contrato =mdlContrato::select(
            [
                'IMB_CONTRATO.*',
                'IMB_IMOVEIS.*',
                'IMB_CONTRATO.IMB_IMB_ID2 AS IMB_IMB_ID2',
                DB::raw( '( SELECT IMB_CND_NOME FROM IMB_CONDOMINIO 
                            WHERE IMB_CONDOMINIO.IMB_CND_ID = IMB_IMOVEIS.IMB_CND_ID ) AS IMB_CND_NOME' ),
                DB::raw( 'PEGALOCATARIOCONTRATO( IMB_CONTRATO.IMB_CTR_ID ) AS LOCATARIO'),
                DB::raw('imovel( IMB_CONTRATO.IMB_IMV_ID) ENDERECOCOMPLETO '),
                'IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCADOR AS VENCIMENTOLOCADOR',
                'IMB_CONTRATO.IMB_CTR_VENCIMENTOLOCATARIO AS VENCIMENTOLOCATARIO',
            ]
        )
        ->where( 'IMB_CONTRATO.IMB_CTR_ID','=',$id)
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID', 'IMB_CONTRATO.IMB_IMV_ID')
        ->first();

        return $contrato;

        //
    }

    public function findPasta($id)
    {
        $contrato =mdlContrato::select(
            [   'IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                DB::raw('( select CEP_BAIRRO.CEP_BAI_NOME FROM IMB_IMOVEIS, CEP_BAIRRO 
                        WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID 
                        AND IMB_IMOVEIS.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID LIMIT 1) AS BAIRRO'),
                DB::raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID) ) as ENDERECOCOMPLETO'),
                DB::raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATO.IMB_CTR_ID) )as IMB_CLT_NOME_LOCATARIO'),
                DB::raw('( select PEGALOCADORCONTRATO( IMB_CONTRATO.IMB_CTR_ID) )as PROPRIETARIO'),
                'IMB_IMV_ID',
                'IMB_CTR_SITUACAO'
            ]
            )->where( 'IMB_CONTRATO.IMB_CTR_REFERENCIA', '=', $id)
            ->where( 'IMB_CONTRATO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->get();
            return $contrato;
        //
    }


    public function BuscaIncrementalCtrLocatario( $str, $imobiliaria )
    {
        if( isset( $str ) )
        {
        
            $contrato =mdlContrato::select(
                [   'IMB_CTR_ID',
                    'IMB_CTR_REFERENCIA',
                    DB::raw('( select CEP_BAIRRO.CEP_BAI_NOME FROM IMB_IMOVEIS, CEP_BAIRRO 
                            WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID 
                            AND IMB_IMOVEIS.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID LIMIT 1) AS BAIRRO'),
                    DB::raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID) ) as ENDERECOCOMPLETO'),
                    DB::raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATO.IMB_CTR_ID) )as IMB_CLT_NOME_LOCATARIO'),
                    DB::raw('( select PEGALOCADORCONTRATO( IMB_CONTRATO.IMB_CTR_ID) )as PROPRIETARIO'),
                    'IMB_IMV_ID',
                    'IMB_CTR_SITUACAO'
                ]
            
            )->where( 'IMB_CONTRATO.IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID
            )->having( 'IMB_CLT_NOME_LOCATARIO', 'like', '%'.$str.'%'
            )->orderBy('IMB_CONTRATO.IMB_CTR_SITUACAO'
            )->get();
            return $contrato;
        }

    }

    public function BuscaIncrementalCtrLocador( $str, $imobiliaria )
    {
        if( isset( $str ) )
        {
            $contrato =mdlContrato::select(
                [   'IMB_CTR_ID',
                    'IMB_CTR_REFERENCIA',
                    DB::raw('( select CEP_BAIRRO.CEP_BAI_NOME FROM IMB_IMOVEIS, CEP_BAIRRO 
                            WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID 
                            AND IMB_IMOVEIS.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID LIMIT 1) AS BAIRRO'),
                    DB::raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID) ) as ENDERECOCOMPLETO'),
                    DB::raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATO.IMB_CTR_ID) )as IMB_CLT_NOME_LOCATARIO'),
                    DB::raw('( select PEGALOCADORCONTRATO( IMB_CONTRATO.IMB_CTR_ID) )as PROPRIETARIO'),
                    'IMB_IMV_ID',
                    'IMB_CTR_SITUACAO'
                ]
            
            )->where( 'IMB_CONTRATO.IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID
            )->having( 'PROPRIETARIO', 'like', '%'.$str.'%'
            )->orderBy('IMB_CONTRATO.IMB_CTR_SITUACAO'
            )->get();


            return $contrato;
        }

    }

    public function BuscaIncrementalCtrEndereco( $str, $imobiliaria )
    {
        if( isset( $str ) )
        {
            $contrato =mdlVContratos::select(
            [   'IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'ENDERECOCOMPLETO',
                'BAIRRO',
                'IMB_CLT_NOME_LOCATARIO',
                'PROPRIETARIO',
                'IMB_IMV_ID',
                'IMB_CTR_SITUACAO'
            ]
            )->where( 'IMB_IMB_ID', '=', $imobiliaria
            )->where( 'ENDERECOCOMPLETO', 'like', '%'.$str.'%'
            )->orderBy('IMB_CTR_SITUACAO'
            )->orderBy('IMB_CLT_NOME_LOCATARIO'
            )->get();
            return $contrato;
        }

    }

    function sequencia()
    {
        $num = mdlContrato::select(DB::raw('max( cast( IMB_CTR_REFERENCIA as INTEGER) ) as seq'))
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->get();

        $numero = $num[0]->seq;
        $numero = (int)$numero;
        $numero = str_pad($numero+1 , 5 , '0' , STR_PAD_LEFT);
        return response()->json( $numero, 200);
    }

    function menuAdmImoveis()
    {
        return view('admimoveis.menuadm');
    }


    function locacoesRealizadas( Request $request )
    {
        $unidade = $request->unidade;
        $datainicio = $request->datainicio;
        $datatermino = $request->datafim;

        if( $datainicio == '' ) $datainicio = date( 'Y/m/d');
        if( $datatermino == '' ) $datatermino = date( 'Y/m/d');

        $contratos = mdlContrato::select(
            [
                'IMB_CTR_ID',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_REFERENCIA',
                'IMB_CTR_DATALOCACAO',
                'IMB_CTR_INICIO',
                'IMB_CTR_TERMINO',
                'IMB_CTR_VALORALUGUEL',
                'IMB_CTR_TAXAADMINISTRATIVA',
                'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                DB::raw( '( select sum(IMB_LCF_VALOR ) FROM IMB_LANCAMENTOFUTURO WHERE IMB_LANCAMENTOFUTURO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID 
                    and IMB_TBE_ID in (7,25) AND IMB_LCF_DTHINATIVADO IS NULL) AS TAXACONTRATO'),
                DB::raw('(SELECT imovel(IMB_CONTRATO.IMB_IMV_ID) ) AS ENDERECO'),
                DB::raw('( SELECT PEGALOCATARIOCONTRATO(IMB_CONTRATO.IMB_CTR_ID)) AS LOCATARIO'),
                DB::raw('( SELECT PEGALOCADORCONTRATO(IMB_CONTRATO.IMB_CTR_ID)) AS  LOCADOR'),
                DB::raw('( SELECT PEGACORCTR(IMB_CONTRATO.IMB_CTR_ID)) AS  CORRETORES'),
                DB::raw('( SELECT PEGACAPCTR(IMB_CONTRATO.IMB_CTR_ID)) AS  CAPTADORES')

            ]
        )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where('IMB_CTR_SITUACAO','<>','CANCELADO')
        ->where( 'IMB_CTR_INICIO','>=', $datainicio )
        ->where( 'IMB_CTR_INICIO','<=', $datatermino );

        if( $unidade <> '' )
            $contratos->where( 'IMB_IMB_ID2','=', $unidade );


//        return $contratos->toSql();
        $contratos->orderBy( 'IMB_CTR_INICIO' );
        return DataTables::of($contratos )->make(true);

    }

    function vencimentoContrato( Request $request )
    {
        $unidade = $request->unidade;
        $datainicio = $request->datainicio;
        $datatermino = $request->datafim;

        $datainicio =  app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
        $datatermino =  app('App\Http\Controllers\ctrRotinas')->formatarData( $datatermino );

        $contratos = mdlContrato::select(
            [
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_REFERENCIA',
                'IMB_CTR_INICIO',
                'IMB_CTR_TERMINO',
                'IMB_CTR_DATAREAJUSTE',
                DB::raw('(SELECT imovel(IMB_CONTRATO.IMB_IMV_ID) ) AS ENDERECO'),
                DB::raw('( SELECT PEGALOCATARIOCONTRATO(IMB_CONTRATO.IMB_CTR_ID)) AS LOCATARIO'),
                DB::raw('( SELECT PEGALOCADORCONTRATO(IMB_CONTRATO.IMB_CTR_ID)) AS  LOCADOR'),

            ]
        )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where('IMB_CTR_SITUACAO','=','ATIVO')
        ->where( 'IMB_CTR_TERMINO','>=', $datainicio )
        ->where( 'IMB_CTR_TERMINO','<=', $datatermino );

        if( $unidade <> '' )
            $contratos->where( 'IMB_IMB_ID2','=', $unidade );


//        return $contratos->toSql();
        $contratos->orderBy( 'IMB_CTR_TERMINO' );
        return DataTables::of($contratos )->make(true);

    }

    function rescisoesRealizadas( Request $request )
    {
        $unidade = $request->unidade;
        $datainicio = $request->datainicio;
        $datatermino = $request->datafim;

        if( $datainicio == '' ) $datainicio = date( 'Y/m/d');
        if( $datatermino == '' ) $datatermino = date( 'Y/m/d');

        $contratos = mdlContrato::select(
            [
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_REFERENCIA',
                'IMB_CTR_DATALOCACAO',
                'IMB_CTR_INICIO',
                'IMB_CTR_TERMINO',
                'IMB_CTR_VALORALUGUEL',
                'IMB_CTR_TAXAADMINISTRATIVA',
                'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                'IMB_CTR_DATARESCISAO',
                DB::raw('(SELECT imovel(IMB_CONTRATO.IMB_IMV_ID) ) AS ENDERECO'),
                DB::raw('( SELECT PEGALOCATARIOCONTRATO(IMB_CONTRATO.IMB_CTR_ID)) AS LOCATARIO'),
                DB::raw('( SELECT PEGALOCADORCONTRATO(IMB_CONTRATO.IMB_CTR_ID)) AS  LOCADOR'),

            ]
        )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
//        ->where('IMB_CTR_SITUACAO','=','ATIVO')
        ->where( 'IMB_CTR_DATARESCISAO','>=', $datainicio )
        ->where( 'IMB_CTR_DATARESCISAO','<=', $datatermino );

        if( $unidade <> '' )
            $contratos->where( 'IMB_IMB_ID2','=', $unidade );


//        return $contratos->toSql();
        $contratos->orderBy( 'IMB_CTR_DATARESCISAO' );
        return DataTables::of($contratos )->make(true);

    }


    public function rescindir( Request $request)
    {
        $id = $request->IMB_CTR_ID;
        $datarescisao = $request->datarescisao;
        $dias = $request->dias;
        $diasvalor = $request->diasvalor;
        $diasobservacao = $request->obervacao;

        $ctr = mdlContrato::find( $id );

        $ctr->IMB_CTR_SITUACAO = 'ENCERRADO';
        $ctr->IMB_CTR_DATARESCISAO = $datarescisao;
        $ctr->save();

        $imv = mdlImovel::find( $ctr->IMB_IMV_ID);
        $imv->VIS_STA_ID = $request->statusimovel;
        $imv->save();

        if( $diasvalor <> 0 )
        {
            if( $dias > 0 )
            {
                $cdlt = 'D';
                $cdld = 'C';
            }
            else
            {
                $cdlt = 'C';
                $cdld = 'D';

            }

            $lf = new mdlLancamentoFuturo;
            $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $lf->IMB_CTR_ID = $id;
            $lf->IMB_LCF_VALOR = $diasvalor;
            $lf->IMB_LCF_LOCADORCREDEB = $cdld;
            $lf->IMB_LCF_LOCATARIOCREDEB = $cdlt;
            $lf->IMB_LCF_DATAVENCIMENTO = $datarescisao;
            $lf->IMB_LCF_TIPO = 'M';
            $lf->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $lf->IMB_TBE_ID = 24;
            $lf->IMB_LCF_INCMUL ='S';
            $lf->IMB_LCF_INCIRRF ='S';
            $lf->IMB_LCF_INCTAX ='S';
            $lf->IMB_LCF_INCJUROS ='S';
            $lf->IMB_LCF_INCCORRECAO = 'S';
            $lf->IMB_LCF_GARANTIDO = 'S';
            $lf->IMB_LCF_INCISS = 'N';
            $lf->IMB_LCF_OBSERVACAO = $diasobservacao;
            $lf->IMB_LCF_REAJUSTAR         ='';
            $lf->save();

        }

        $tb = "UPDATE IMB_COBRANCAGERADAPERM SET IMB_CGR_DTHINATIVO=curdate() where IMB_CTR_ID = $id ".
        " AND IMB_CGR_DATAVENCIMENTO > curdate()";
        DB::statement("$tb");
                    //3632859
        app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $ctr->IMB_IMV_ID, $id, 0, 0, 0, 'Rescisão Realizada ');

        return response()->json( 'ok',200 );


    }

    public function reativarContrato( Request $request)
    {

        $id = $request->IMB_CTR_ID;

        $ctr = mdlContrato::find( $id );

        $ctr->IMB_CTR_SITUACAO = 'ATIVO';
        $ctr->IMB_CTR_DATARESCISAO = null;
        $ctr->save();

        $imv = mdlImovel::find( $ctr->IMB_IMV_ID);
        $imv->VIS_STA_ID = 16;
        $imv->save();

        app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $ctr->IMB_IMV_ID, $id, 0, 0, 0, 'Contrato Reativado');


        return response()->json('ok',200);


    }

    public function verificarAlteracoes( $idcontrato, $campo, $campoanterior, $campoatual)
    {

        $ctr = mdlContrato::find( $idcontrato );

        $nomecampo = app('App\Http\Controllers\ctrRotinas')->camposSistema( $campo);

        if( $campoanterior == 'F') return '';
        if( $campoanterior == '' and $campoatual == '0.00' ) return '';
        if( $campoanterior == '' and $campoatual == 'N' ) return '';
        if( $campoatual == '' ) return '';
        

        if( $campoatual<>'' )
        {
            if(  $campoanterior <> $campoatual )
                    app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID, 0, 0 ,0 ,$nomecampo.'('.$campo.')'.
            ' alterado de '.$campoanterior.' para '.$campoatual);
        }


    }

    public function pegaUm($id)
    {
        $contrato =mdlContrato::select(
            [   'IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_IMV_ID',
                'IMB_CTR_TAXAADMINISTRATIVA',
                'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) as ENDERECOCOMPLETO'),
                DB::Raw('( SELECT CEP_BAI_NOME FROM IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_IMV_ID LIMIT 1) AS BAIRRO'),
                DB::Raw('PEGALOCADORCONTRATO(IMB_CTR_ID) AS PROPRIETARIO'),
                DB::Raw('PEGALOCATARIOCONTRATO(IMB_CTR_ID) AS IMB_CLT_NOME_LOCATARIO'),
                'IMB_IMV_ID',
                'IMB_CTR_SITUACAO',
                'IMB_CTR_TOLERANCIA',
                'IMB_CTR_INICIO',
                'IMB_CTR_TERMINO',
                'IMB_CTR_DATAREAJUSTE',
                'IMB_CTR_REPASSEDIA',
                'IMB_CTR_DIAVENCIMENTO',
                'IMB_CTR_DATALOCACAO',
                'IMB_CTR_VENCIMENTOLOCATARIO',
                'IMB_CTR_VENCIMENTOLOCADOR',
                'IMB_CTR_VALORALUGUEL',
                'IMB_CTR_PROXIMOREPASSE',
                'IMB_CTR_REPASSEDIAFIXO',
                DB::raw('( SELECT MAX( IMB_RLT_DATACOMPETENCIA)
                FROM IMB_RECIBOLOCATARIO WHERE IMB_RECIBOLOCATARIO.IMB_CTR_ID =
                    IMB_CTR_ID ) AS ULTIMORECEBIMENTO'),
                DB::raw('( SELECT MAX( IMB_RLD_DATAVENCIMENTO)
                FROM IMB_RECIBOLOCADOR WHERE IMB_RECIBOLOCADOR.IMB_CTR_ID =
                    IMB_CTR_ID ) AS ULTIMOREPASSE'),

                //DB::raw('proximovencimentolocador( IMB_CONTRATO.IMB_CTR_ID ) AS VENCIMENTOLOCADOR'),
                //DB::raw('proximovencimentolocatario( IMB_CONTRATO.IMB_CTR_ID ) AS VENCIMENTOLOCATARIO')
            ]
            )->where( 'IMB_CTR_ID', '=', $id
            )->first();
            return $contrato;
        //
    }

    public function relGeralContratos( Request $request)
    {
        $ordem = $request->ordem;
        $situacao = $request->situacao;
        $locador = $request->locador;
        $destino = $request->destino;

        $contratos = mdlContrato::select(
            [
                'IMB_CTR_DIAVENCIMENTO',
                'IMB_CTR_SITUACAO',
                'IMB_IMV_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_CTR_INICIO',
                'IMB_CTR_DATAREAJUSTE',
                DB::Raw( '( SELECT IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO 
                     WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_CONTRATO.IMB_FORPAG_ID_LOCATARIO) AS IMB_FORPAG_NOME'),
                DB::Raw( "CASE WHEN COALESCE( IMB_CTR_ALUGUELGARANTIDO,'') ='S' THEN 'Garantido' else '' END AS GARANTIDO"),
                'IMB_CTR_TAXAADMINISTRATIVA',
                'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                DB::Raw( 'imovel(IMB_IMV_ID) AS ENDERECOCOMPLETO '),
                DB::Raw( '( select IMB_CND_NOME FROM IMB_CONDOMINIO, IMB_IMOVEIS 
                   WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID 
                   AND IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID ) AS IMB_CND_NOME'),
                DB::Raw( '( select CEP_BAIRRO.CEP_BAI_NOME from CEP_BAIRRO,IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID
                    AND IMB_IMOVEIS.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID ) AS CEP_BAI_NOME'),
                    DB::Raw('(SELECT PROXIMOVENCIMENTOLOCATARIO(IMB_CONTRATO.IMB_CTR_ID)) AS PROXIMORECEBIMENTO'),
                    DB::Raw('(SELECT PROXIMOVENCIMENTOLOCADOR(IMB_CONTRATO.IMB_CTR_ID)) AS PROXIMOREPASSE'),
                    DB::Raw('(SELECT IMB_CLT_NOME FROM IMB_LOCATARIOCONTRATO ,IMB_CLIENTE
                        WHERE IMB_LOCATARIOCONTRATO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND
                        IMB_LOCATARIOCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                        ORDER BY IMB_LCTCTR_PRINCIPAL DESC LIMIT 1) AS IMB_CLT_NOMELOCATARIO'),

    
                    DB::Raw('(SELECT IMB_CLT_NOME FROM IMB_FIADORCONTRATO ,IMB_CLIENTE
                        WHERE IMB_FIADORCONTRATO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND
                        IMB_FIADORCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS IMB_CLT_NOMEFIADOR'),
    
                    DB::raw('( SELECT IMB_CLT_NOME
                                FROM IMB_PROPRIETARIOIMOVEL, IMB_CLIENTE
                                WHERE IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID
                                AND IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                                AND IMB_PROPRIETARIOIMOVEL.IMB_IMVCLT_PRINCIPAL = "S"
                                LIMIT 1) AS PROPRIETARIO'),
                    'IMB_CTR_VALORALUGUEL',
                    DB::Raw( '( SELECT IMB_LCF_VALOR FROM IMB_LANCAMENTOFUTURO WHERE IMB_LANCAMENTOFUTURO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID
                        AND IMB_TBE_ID  = 17 AND YEAR( IMB_LCF_DATAVENCIMENTO ) = YEAR( CURDATE() ) LIMIT 1) AS IMB_LCF_VALOR')
            ]
            );

            if( $situacao == 'E' ) $contratos = $contratos->where( 'IMB_CTR_SITUACAO','=', 'ENCERRADO');
            if( $situacao == 'A' ) $contratos = $contratos->where( 'IMB_CTR_SITUACAO','=', 'ATIVO');
            $contratos = $contratos->orderBy( $ordem);

           // Log::info( $contratos->toSql());
            if( $destino == 'RELATORIO') 
            {
                $contratos = $contratos->get();
                return $contratos;
            }
            return DataTables::of($contratos)->make(true);

        }

        public function anexos( $idcontrato)
        {
            return view( 'contrato.dragdropdocumentos', compact( 'idcontrato'));
        }

        public function findJson($id)
        {
            $contrato =mdlContrato::select(
                [   'IMB_CTR_ID',
                    'IMB_CTR_REFERENCIA',
                    'IMB_IMV_ID',
                    'IMB_CTR_TAXAADMINISTRATIVA',
                    'IMB_CTR_TAXAADMINISTRATIVAFORMA',
                    DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) as ENDERECOCOMPLETO'),
                    DB::Raw('( SELECT CEP_BAIRRO.CEP_BAI_NOME FROM IMB_IMOVEIS,CEP_BAIRRO WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID AND IMB_IMOVEIS.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID LIMIT 1) AS BAIRRO'),
                    DB::Raw('PEGALOCADORPRINCIPALIMV(IMB_IMV_ID) AS PROPRIETARIO'),
                    DB::Raw('PEGALOCATARIOCONTRATO(IMB_CTR_ID) AS IMB_CLT_NOME_LOCATARIO'),
                    'IMB_IMV_ID',
                    'IMB_CTR_SITUACAO',
                    'IMB_CTR_TOLERANCIA',
                    'IMB_CTR_INICIO',
                    'IMB_CTR_DATAREAJUSTE',
                    'IMB_CTR_REPASSEDIA',
                    'IMB_CTR_DIAVENCIMENTO',
                    'IMB_CTR_VENCIMENTOLOCATARIO',
                    'IMB_CTR_VENCIMENTOLOCADOR',
                    'IMB_CTR_VALORALUGUEL',
                    'IMB_CTR_PROXIMOREPASSE',
                    'IMB_CTR_REPASSEDIAFIXO',
                    DB::raw('( SELECT MAX( IMB_RLT_DATACOMPETENCIA)
                    FROM IMB_RECIBOLOCATARIO WHERE IMB_RECIBOLOCATARIO.IMB_CTR_ID =
                        IMB_CTR_ID ) AS ULTIMORECEBIMENTO'),
                    DB::raw('( SELECT MAX( IMB_RLD_DATAVENCIMENTO)
                    FROM IMB_RECIBOLOCADOR WHERE IMB_RECIBOLOCADOR.IMB_CTR_ID =
                        IMB_CTR_ID ) AS ULTIMOREPASSE'),
    
                    //DB::raw('proximovencimentolocador( IMB_CONTRATO.IMB_CTR_ID ) AS VENCIMENTOLOCADOR'),
                    //DB::raw('proximovencimentolocatario( IMB_CONTRATO.IMB_CTR_ID ) AS VENCIMENTOLOCATARIO')
                ]
                )->where( 'IMB_CTR_ID', '=', $id
                )->orderBy('IMB_CTR_SITUACAO'
                )->orderBy('ENDERECOCOMPLETO');
    
                //Log::info( $contrato->toSql());
    
                $contrato = $contrato->first();
                return $contrato;
            //
        }

        public function findSoContrato( $id)
        {
            $contrato = mdlContrato::find( $id );
            return $contrato;
        }

}
