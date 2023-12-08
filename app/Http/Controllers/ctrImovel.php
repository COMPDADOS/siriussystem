<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCliente;
use App\mdlImovel;
use App\mdlImobiliaria;
use App\mdlImagem;
use App\mdlTipoImovel;
use App\mdlCondominio;
use App\mdlPropImovel;
use App\mdlStatusImovel;
use App\mdlAtendente;
use App\mdlCorImo;
use App\mdlLog;
use App\mdlHistoricoImovel;
use App\mdlImoveisNotificacoes;
use App\mdlPortais;

use DataTables;
use App\User;
use DB;
use Log;

use Auth;

class ctrImovel extends Controller
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

    public function list(Request $request)
    {

//        Log::info( $request->pesquisagenerica);
        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                DB::raw('( SELECT PEGACAPIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECAPTADOR'),
                DB::raw('( SELECT PEGACORIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECORRETOR'),
                DB::raw('( SELECT IMB_IMB_NOME
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS UNIDADE'),
                    DB::raw('( SELECT IMB_ATD_NOME
                        FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_ID =
                        IMB_ATENDENTE.IMB_ATD_ID) AS CADASTRADOPOR'),
                    DB::raw('( SELECT IMB_ATD_NOME
                        FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_IDALTERACAO =
                        IMB_ATENDENTE.IMB_ATD_ID) AS ALTERADOPOR'),

                    DB::raw('( SELECT IMB_IMB_URLIMOVELSITE
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS URLIMOVELSITE'),
                        DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                        DB::raw('( SELECT VIS_STA_NOME
                        FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                        VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_NOME'),
                        DB::raw('( SELECT VIS_STA_SITUACAO
                        FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                        VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_SITUACAO'),
                        DB::raw("imovel( IMB_IMOVEIS.IMB_IMV_ID ) AS ENDERECOCOMPLETO"),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                DB::raw( '(select CEP_BAI_NOME FROM CEP_BAIRRO WHERE CEP_BAIRRO.CEP_BAI_ID = IMB_IMOVEIS.CEP_BAI_ID ) AS CEP_BAI_NOME'),
                'IMB_IMOVEIS.IMB_IMV_CIDADE',
                'IMB_IMOVEIS.IMB_TIM_ID',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_DORAE',
                'IMB_IMOVEIS.IMB_IMV_ARECON',
                'IMB_IMOVEIS.IMB_IMV_AREUTI',
                'IMB_IMOVEIS.IMB_IMV_ARETOT',
                'IMB_IMOVEIS.IMB_IMV_MEDTER',
                'IMB_IMOVEIS.IMB_IMV_PISCIN',
                'IMB_IMOVEIS.IMB_IMV_CHURRA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_WCQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMV_TITULO',
                'IMB_IMOVEIS.IMB_IMV_SALQUA',
                'IMB_IMOVEIS.IMB_IMV_GARDES',
                'IMB_IMOVEIS.IMB_IMV_GARCOB',
                'IMB_IMOVEIS.IMB_IMV_CAMFUT',
                'IMB_IMOVEIS.IMB_IMV_PLAGRO',
                'IMB_IMOVEIS.IMB_IMV_EDICUL',
                'IMB_IMOVEIS.IMB_IMV_QUINTA',
                'IMB_IMV_OBSERV',
                'IMB_IMOVEIS.VIS_STA_ID',
                'IMB_IMOVEIS.IMB_IMV_QUADRAPOLIESPORTIVA',
                'IMB_IMOVEIS.IMB_IMV_ENDERECOCEP',
                'IMB_IMV_DATAATUALIZACAO',
                'IMB_IMV_DATACADASTRO',
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMV_OBSWEB',
                'IMB_IMV_CHABOX',
                'IMB_IMV_CHAVES',
                'IMB_CLIENTE.IMB_CLT_NOME',
                'IMB_CCH_ID',
                'IMB_CCH_RESERVAR',
                'IMB_CCH_RESERVARDATALIMITE',
                DB::Raw( 'CASE WHEN EXISTS( SELECT IMB_CTR_ID FROM IMB_CONTRATO 
                    WHERE IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID ) THEN " =>(C/Histórico Locação)<=" ELSE "" END AS TEMLOCACAO'),
                DB::Raw(' CASE
                WHEN EXISTS( SELECT IMB_CCH_ID FROM IMB_CONTROLECHAVE
                        WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) THEN "Em Visita/Manutenção"
                        ELSE ""
                        END AS SITUACAOCHAVE'),
                DB::Raw('( SELECT IMB_CCH_DTHDEVOLUCAOESPERADA FROM IMB_CONTROLECHAVE
                        WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) AS IMB_CCH_DTHDEVOLUCAOESPERADA'),

                DB::raw('( SELECT COALESCE(IMB_IMG_ARQUIVO,"logo.jpg")
                FROM IMB_IMAGEM WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_IMAGEM.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMAGEM'),
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')

            ])
            ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID');

         $cFiltrou = 'S';

         $pesquisagenerica = $request->pesquisagenerica;

         $sortitem = $request->sortitem;

         if ( $request->endereco <> '' )
         {
             $cFiltrou = 'S';
             $imoveis->whereRaw(DB::raw("imovel( IMB_IMOVEIS.IMB_IMV_ID ) LIKE '%{$request->endereco}%'"));
         }
         else
         if( $pesquisagenerica <> '' )
         {
            $cFiltrou = 'S';
            $imoveis->whereRaw(DB::raw(" IMB_IMV_ENDERECO LIKE  '%{$pesquisagenerica}%'
                              or IMB_IMOVEIS.IMB_IMV_REFERE LIKE '%{$pesquisagenerica}%'
                              or IMB_IMOVEIS.CEP_BAI_NOME LIKE '%{$pesquisagenerica}%'
                              and exists( select VIS_STA_SITUACAO FROM VIS_STATUSIMOVEL
                              where VIS_STATUSIMOVEL.VIS_STA_ID = IMB_IMOVEIS.VIS_STA_ID
                              and VIS_STA_SITUACAO ='A' )"));
         }

         if ($request->has('referencia') && strlen(trim($request->referencia)) > 0)
         {
             $cFiltrou = 'S';
             $imoveis->whereRaw("IMB_IMV_REFERE LIKE '%{$request->referencia}%'");
         }
         else
         {

            if ($request->has('agencia') && strlen(trim($request->agencia)) > 0)
            {
                $cFiltrou = 'S';
                $imoveis->where('IMB_IMOVEIS.IMB_IMB_ID', $request->agencia);
            }

            
            if ($request->has('finalidade') && $request->finalidade <> 'T' )
            {
                $cFiltrou = 'S';

                if ( $request->finalidade == 'L' ){
                    $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC','>',0);
                };
                if ( $request->finalidade == 'V' ){
                    $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN','>',0);
                }
            }
            


            if( $request->caddatainicial <> '' && $request->caddatafinal <> '' )
            {
                $cFiltrou = 'S';
                $imoveis->whereRaw( DB::raw("IMB_IMV_DATACADASTRO between '$request->caddatainicial' and '$request->caddatafinal'"));
            }

            if ($request->has('corretor') && $request->corretor > 0)
            {
                $cFiltrou = 'S';
                $imoveis->whereRaw( DB::raw("exists( SELECT IMB_ATD_ID FROM IMB_CORIMO
                WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CORIMO.IMB_IMV_ID
                AND IMB_CORIMO.IMB_ATD_ID = $request->corretor)"));
            }

            if ($request->has('captador') && $request->captador > 0){
                $cFiltrou = 'S';
                $imoveis->whereRaw( DB::raw("exists( SELECT IMB_ATD_ID FROM IMB_CAPIMO
                WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CAPIMO.IMB_IMV_ID
                AND IMB_CAPIMO.IMB_ATD_ID = $request->captador)"));
            }


            if ($request->has('cadastradopor') && $request->cadastradopor > 0)
            {
                $cFiltrou = 'S';
                $imoveis->where( 'IMB_IMOVEIS.IMB_ATD_ID','=', $request->cadastradopor);
            }

            if ($request->has('cidade') && strlen(trim($request->cidade)) > 0){
                $cFiltrou = 'S';
                $imoveis->whereRaw("IMB_IMOVEIS.IMB_IMV_CIDADE LIKE '%{$request->cidade}%'");
            }


            if ($request->has('proprietario') && strlen(trim($request->proprietario)) > 0){
                $cFiltrou = 'S';
                $imoveis->whereRaw( "IMB_CLT_NOME LIKE '%{$request->proprietario}%'");
            }

            if ($request->has('id_completus') && strlen(trim($request->id_completus)) > 0){
                $cFiltrou = 'S';
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_ID', '=', $request->id_completus);
            }



            if ($request->has('status') && strlen(trim($request->status)) > 0){
                if ( $request->status <> 'null')
                {
                    $cFiltrou = 'S';
                    $status = $request->status;
                    $status = explode(',',$status);
                    $statu = array( $status);
                    $imoveis->whereIn( "VIS_STA_ID", $status );
                }

            }

            if ($request->has('tipoimovel') && strlen(trim($request->tipoimovel)) > 0){
                if ( $request->tipoimovel <> 'null')
                {
                    $cFiltrou = 'S';
                    $tipos = $request->tipoimovel;
                    $tipos = explode(',',$tipos);
                    $tipo = array( $tipos);
                    $imoveis->whereIn( "IMB_TIM_ID", $tipos );
                }

            }

            if( $request->destaque == 'S')
            {
                $cFiltrou = 'S';
                $imoveis->whereRaw("coalesce(IMB_IMV_DESTAQUE,'N') = 'S' ");
            }

            if( $request->superdestaque == 'S')
            {
                $cFiltrou = 'S';
                $imoveis->whereRaw("coalesce(IMB_IMV_SUPERDESTAQUE,'N') = 'S' ");
            }




            /*
            if ($request->has('condominio') && strlen(trim($request->condominio)) > 0)
            {
                if ( $request->condominio <> 'null')
                {
                    $cFiltrou = 'S';
                    $condominios = $request->condominio;
                    $condominios = explode(',',$condominios);
                    $condominio = array( $condominios);
                    $imoveis->whereIn( "IMB_CND_ID", $condominios );
                }
            }
    */

            if ($request->has('bairro') && strlen(trim($request->bairro)) > 0)
            {
                if ( $request->bairro <> 'null') {
                    $cFiltrou = 'S';
                    $bairros = $request->bairro;
                    $bairros = explode( ',', $bairros );
                    $bairro = array( $bairros );
                    $monbai = '';

//                    Log::info( 'count '.count( $bairro ));
                    foreach( $bairro[0] as $b)
                    {
                        if( $monbai )
                            $monbai = $monbai . ",'$b'";
                        else
                            $monbai = $monbai . "'$b'";


                    }

        //            return 'bairros explode '.$bairros;
//                     $imoveis->whereIn('IMB_IMOVEIS.CEP_BAI_NOME', $bairros);

                    if ($request->has('bairro') && strlen(trim($request->bairro)) > 0)
                    {
                        $cFiltrou = 'S';
                        $imoveis->whereRaw( DB::raw( "( exists( SELECT CEP_BAI_ID FROM CEP_BAIRRO 
                                                    WHERE CEP_BAIRRO.CEP_BAI_ID = IMB_IMOVEIS.CEP_BAI_ID AND CEP_BAIRRO.CEP_BAI_NOME in ( $monbai ) ) 
                                                or exists( SELECT IMB_CND_ID 
                                    FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID
                                    AND IMB_CND_NOME IN ($monbai) ) )"));
                    }
                                    
                }
            }

    //        $faixainicial = number_format(str_replace(",",".",str_replace(".","",$request->faixainicial)), 2, '.', '');


            if ($request->faixainicial <> '' and  $request->faixafinal <> '' and $request->faixafinal >= $request->faixainicial)
            {
                if( $request->finalidade == 'L')
                    {
                        $cFiltrou = 'S';
                        if( $request->faixainicial == '' )
                            $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '<>', 0);
                        else
                        {
                            $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '>=', $request->faixainicial);
                            $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '<=', $request->faixafinal);
                        }

                    }
                if( $request->finalidade == 'V')
                    {
                        $cFiltrou = 'S';
                        if( $request->faixainicial == '' )
                            $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN', '<>',0);
                        else
                        {
                            $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN', '>=', $request->faixainicial);
                            $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN', '<=', $request->faixafinal);                        # code...
                        };


                    }
                    }

                    if ($request->has('cidade') && strlen(trim($request->cidade)) > 0){
                        $cFiltrou = 'S';
                        $imoveis->whereRaw("IMB_IMOVEIS.IMB_IMV_CIDADE LIKE '%{$request->cidade}%'");
                    }

            if ($request->has('dormitorio') && $request->dormitorio > 0)
            {
                $cFiltrou = 'S';

                if( $request->dormitorio == 4 )
                    $imoveis = $imoveis->whereRaw('cast( IMB_IMOVEIS.IMB_IMV_DORQUA as int) >= '.intval($request->dormitorio));
                else
                    $imoveis = $imoveis->whereRaw('cast(IMB_IMOVEIS.IMB_IMV_DORQUA as int) = '.intval($request->dormitorio));
            }

            if ($request->has('suite') && $request->suite > 0){
                $cFiltrou = 'S';
                $imoveis->whereRaw( 'cast(IMB_IMOVEIS.IMB_IMV_SUIQUA as int ) >= '.intval( $request->suite));
            }
            if ($request->has('tipolocacao') && $request->tipolocacao <> '' )
            {
                $cFiltrou = 'S';
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_FINALIDADE','=', $request->tipolocacao);
            }

            if ($request->has('condominio') && strlen(trim($request->condominio)) > 0)
            {
                if ( $request->condominio <> 'null')
                    $imoveis->whereRaw( DB::raw("exists( SELECT IMB_CND_ID
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID
                        AND IMB_CND_NOME LIKE '%{$request->condominio}%')"));
            }

            $ascdes = $request->ascdes;

            if( $sortitem == '' )
                $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_ID','DESC');
    //        else
    //          $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_ID',"$ascdes");

            if( $sortitem == 'Bairro' )
                $imoveis->orderBy( 'IMB_IMOVEIS.CEP_BAI_NOME',"$ascdes");

            if( $sortitem == 'Cidade' )
                $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_CIDADE',"$ascdes");

            if( $sortitem == 'dataatualizacao' )
                $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_DATAATUALIZACAO',"$ascdes");

            if( $sortitem == 'datacadastro' )
                $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_DATACADASTRO',"$ascdes");

            if( $sortitem == 'precolocacao' )
                $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_VALLOC',"$ascdes");

            if( $sortitem == 'precovenda' )
                $imoveis->orderBy( 'IMB_IMOVEIS.IMB_IMV_VALVEN',"$ascdes");
        }

        
//        Log::info( $imoveis->toSql());


//        $imoveis->orderBy('IMB_IMV_ENDERECO', 'DESC');
        if ( $cFiltrou == 'N') {
            $imoveis->limit(0);
        }

        //dd( $imoveis );


//        dd($request);
        return DataTables::of($imoveis)->make(true);
    }


    public function index( Request $request)
    {
        $idatendimento = $request->IMB_CLA_ID;
        $bairros = DB::table('IMB_IMOVEIS')->distinct()->orderBy('CEP_BAI_NOME')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->get(['CEP_BAI_NOME','IMB_IMV_CIDADE']);

        $status= mdlStatusImovel::orderBy('VIS_STA_NOME','ASC')->get();

        $condominios = mdlCondominio::select(
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->orderBy('IMB_CND_NOME')
            ->get();

        $tipos= mdlTipoImovel::orderBy('IMB_TIM_DESCRICAO')->get();

        return view('imovel.index', compact('bairros','condominios','tipos','status','idatendimento') );
    }

    public function bairrosCadastrados( $cidade )
    {
        $bairros = DB::table('IMB_IMOVEIS')->distinct()->orderBy('CEP_BAI_NOME')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->where( 'IMB_IMV_CIDADE','=',$cidade)
        ->get(['CEP_BAI_NOME','IMB_IMV_CIDADE']);

        return $bairros;
    }
    public function cidadesCadastradas()
    {
        $cidades = DB::table('IMB_IMOVEIS')->distinct()->orderBy('IMB_IMV_CIDADE')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->get(['IMB_IMV_CIDADE']);

        return $cidades;
    }

    public function store(Request $request)
    {


        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }
    //$valloc = str_replace(',','.', str_replace('.','', $valloc ));
        //$valloc = str_replace('R$','', $valloc );

//        $valven = $request->input('IMB_IMV_VALVEN',0);
        //$valven = str_replace(',','.', str_replace('.','', $valven ));
        //$valven = str_replace('R$','', $valven );

        $IMB_IMV_ID = $request->IMB_IMV_ID;
        
        $imv = mdlImovel::find( $IMB_IMV_ID);
        $novoimovel='N';
        if( $imv == '') 
        {
            $imv = new mdlImovel;
            $novoimovel='S';
        }

        $IMB_IMV_WEBIMOVEL             = $request->input('IMB_IMV_WEBIMOVEL');
        $IMB_IMV_DESTAQUE              =  $request->input('IMB_IMV_DESTAQUE');
        $IMB_IMV_WEBLANCAMENTO         =  $request->input('IMB_IMV_WEBLANCAMENTO');
        $IMB_IMV_ESCLUSIVO             =  $request->input('IMB_IMV_ESCLUSIVO');
        $IMB_IMV_PLACA                 =  $request->input('IMB_IMV_PLACA');
        $IMB_IMV_TERREA                =  $request->input('IMB_IMV_TERREA');
        $IMB_IMV_PERMUTA               =  $request->input('IMB_IMV_PERMUTA');
        $IMB_IMV_ESCRIT                =  $request->input('IMB_IMV_ESCRIT');
        $IMB_IMV_SOBRADO               =  $request->input('IMB_IMV_SOBRADO');
        $IMB_IMV_ASSOBRADADA           =  $request->input('IMB_IMV_ASSOBRADADA');
        $IMB_IMV_ACEITAFINANC          =  $request->input('IMB_IMV_ACEITAFINANC');
        $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA');
        $IMB_IMV_COZPLA                =  $request->input('IMB_IMV_COZPLA');
        $IMB_IMV_EMPQUA                =  $request->input('IMB_IMV_EMPQUA');
        $IMB_IMV_LAVABOV                =  $request->input('IMB_IMV_LAVABOV');
        $IMB_IMV_EMPWC                =  $request->input('IMB_IMV_EMPWC');
        $IMB_IMV_DESPENSA                =  $request->input('IMB_IMV_DESPENSA');
        $IMB_IMV_PISCIN                =  $request->input('IMB_IMV_PISCIN');
        $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA');
        $IMB_IMV_EDICUL                =  $request->input('IMB_IMV_EDICUL');
        $IMB_IMV_QUINTA                =  $request->input('IMB_IMV_QUINTA');
        $IMB_IMV_CHURRA                =  $request->input('IMB_IMV_CHURRA');
        $IMB_IMV_PORELE                =  $request->input('IMB_IMV_PORELE');
        $IMB_IMV_SALFES                =  $request->input('IMB_IMV_SALFES');
        $IMB_IMV_SAUNA                =  $request->input('IMB_IMV_SAUNA');
        $IMB_IMV_QUADRAPOLIESPORTIVA                =  $request->input('IMB_IMV_QUADRAPOLIESPORTIVA');
        $IMB_IMV_PLAGRO                =  $request->input('IMB_IMV_PLAGRO');
        $IMB_IMV_DORAE                =  $request->input('IMB_IMV_DORAE');
        $IMB_IMV_SUIHID                =  $request->input('IMB_IMV_SUIHID');
        $IMB_IMV_LAVABO                =  $request->input('IMB_IMV_LAVABO');
        $IMB_IMV_SUSPENSO                =  $request->input('IMB_IMV_SUSPENSO');
        $IMB_IMV_DORAE                =  $request->input('IMB_IMV_DORAE');
        $IMB_IMV_SACADA                =  $request->IMB_IMV_SACADA;
        
        $IMB_IMV_ELEVADORES                =  $request->IMB_IMV_ELEVADORES;


        $imv->IMB_IMB_ID                    = $request->input('IMB_IMB_ID') ;
        $imv->IMB_IMB_ID2                   = $request->input('IMB_IMB_ID2') ;
        $imv->IMB_IMV_WEBIMOVEL             = $IMB_IMV_WEBIMOVEL;
        $imv->IMB_IMV_DESTAQUE              = $IMB_IMV_DESTAQUE;
        $imv->IMB_IMV_WEBLANCAMENTO         = $IMB_IMV_WEBLANCAMENTO;

        $imv->IMB_IMV_ESCLUSIVO             = $IMB_IMV_ESCLUSIVO;
        $imv->IMB_IMV_PLACA                 = $IMB_IMV_PLACA;
        $imv->imb_imv_terrea                = $IMB_IMV_TERREA;
        $imv->IMB_IMV_PERMUTA               = $IMB_IMV_PERMUTA;
        $imv->IMB_IMV_ESCRIT                = $IMB_IMV_ESCRIT;
        $imv->IMB_IMV_SOBRADO               = $IMB_IMV_SOBRADO;
        $imv->IMB_IMV_ASSOBRADADA           = $IMB_IMV_ASSOBRADADA;
        $imv->IMB_IMV_SACADA           = $IMB_IMV_SACADA;
        $imv->IMB_IMV_ELEVADORES           = $IMB_IMV_ELEVADORES;


        $imv->IMB_IMV_ACEITAFINANC          = $IMB_IMV_ACEITAFINANC;
        $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA;
        $imv->IMB_IMV_COZPLA                =   $IMB_IMV_COZPLA ;
        $imv->IMB_IMV_EMPQUA                =   $IMB_IMV_EMPQUA ;
        $imv->IMB_IMV_LAVABO                 =  $IMB_IMV_LAVABO ;
        $imv->IMB_IMV_EMPWC                =    $IMB_IMV_EMPWC ;
        $imv->IMB_IMV_DESPENSA                = $IMB_IMV_DESPENSA ;
        $imv->IMB_IMV_PISCIN                =   $IMB_IMV_PISCIN ;

        $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA ;
        $imv->IMB_IMV_EDICUL                =   $IMB_IMV_EDICUL;
        $imv->IMB_IMV_QUINTA                =   $IMB_IMV_QUINTA ;
        $imv->IMB_IMV_CHURRA                =   $IMB_IMV_CHURRA ;
        $imv->IMB_IMV_PORELE                =   $IMB_IMV_PORELE ;
        $imv->IMB_IMV_SALFES                =   $IMB_IMV_SALFES ;

        $imv->IMB_IMV_SAUNA                =    $IMB_IMV_SAUNA ;
        $imv->IMB_IMV_QUADRAPOLIESPORTIVA    =  $IMB_IMV_QUADRAPOLIESPORTIVA ;
        $imv->IMB_IMV_PLAGRO                =   $IMB_IMV_PLAGRO ;

        $imv->IMB_IMV_DORAE                 = $IMB_IMV_DORAE;
        $imv->IMB_IMV_SUIHID                = $IMB_IMV_SUIHID;

        $imv->IMB_IMV_DORCLO                = $request->input('IMB_IMV_DORCLO');

        $imv->IMB_TIM_ID                    = $request->input('IMB_TIM_ID');

        $imv->IMB_CLT_ID                    = $request->input('IMB_CLT_ID');

        $imv->IMB_IMV_REFERE                = $request->input('IMB_IMV_REFERE');

        $imv->IMB_IMV_VALVEN                = $request->input('IMB_IMV_VALVEN');

        $imv->IMB_IMV_VALLOC                = $request->input('IMB_IMV_VALLOC');

        $imv->IMB_IMV_ENDERECOTIPO          = $request->input('IMB_IMV_ENDERECOTIPO');

        $imv->IMB_IMV_ENDERECONUMERO        = $request->input('IMB_IMV_ENDERECONUMERO');

        $imv->IMB_IMV_ENDERECO              = $request->input('IMB_IMV_ENDERECO');

        $imv->IMB_IMV_NUMAPT                = $request->input('IMB_IMV_NUMAPT');

        $imv->IMB_IMV_ENDERECOCOMPLEMENTO   = $request->input('IMB_IMV_ENDERECOCOMPLEMENTO');

        $imv->IMB_CND_ID                    = $request->input('IMB_CND_ID');

        $imv->IMB_IMV_PREDIO                = $request->input('IMB_IMV_PREDIO');

        $imv->IMB_IMV_ANDAR                 = $request->input('IMB_IMV_ANDAR');

        $imv->CEP_BAI_NOME                  = $request->input('CEP_BAI_NOME');
        $imv->CEP_BAI_ID                  = $request->input('CEP_BAI_ID');
        $imv->IMB_IMV_WCQUA                  = $request->input('IMB_IMV_WCQUA');

        $imv->IMB_IMV_ENDERECOCEP           = $request->input('IMB_IMV_ENDERECOCEP');

        $imv->IMB_IMV_QUADRA                = $request->input('IMB_IMV_QUADRA');

        $imv->IMB_IMV_LOTE                  = $request->input('IMB_IMV_LOTE');

        $imv->IMB_IMV_CIDADE                = $request->input('IMB_IMV_CIDADE');

        $imv->IMB_IMV_ESTADO                = $request->input('IMB_IMV_ESTADO');

        $imv->IMB_IMV_PROXIMIDADE           = $request->input('IMB_IMV_PROXIMIDADE');

        $imv->IMB_IMV_MEDTER                = $request->input('IMB_IMV_MEDTER');

        $imv->IMB_IMV_ARETOT                = $request->input('IMB_IMV_ARETOT');

        $imv->IMB_IMV_ARECON                = $request->input('IMB_IMV_ARECON');

        $imv->IMB_IMV_AREUTI                = $request->input('IMB_IMV_AREUTI');

       $imv->IMB_IMV_DORQUA                = $request->input('IMB_IMV_DORQUA');

        $imv->IMB_IMV_SUIQUA                = $request->input('IMB_IMV_SUIQUA');


        $imv->IMB_IMV_SALQUA                = $request->input('IMB_IMV_SALQUA');

        $imv->IMB_IMV_SUSPENSO               =  $IMB_IMV_SUSPENSO;


        if( $request->input('IMB_IMV_GARDES' ) <> '' )
            $imv->IMB_IMV_GARDES                = $request->input('IMB_IMV_GARDES',0);

        if( $request->input('IMB_IMV_GARCOB' ) <> '' )
            $imv->IMB_IMV_GARCOB                = $request->input('IMB_IMV_GARCOB',0);

        $imv->IMB_IMV_IDADE                 = $request->input('IMB_IMV_IDADE');
        $imv->IMB_IMV_LINKVIDEO                 = $request->input('IMB_IMV_LINKVIDEO');

        $imv->IMB_IMV_OBSWEB                = $request->input('IMB_IMV_OBSWEB');
        $imv->IMB_IMV_OBSERV                = $request->input('IMB_IMV_OBSERV');
        $imv->IMB_IMV_DATFIL                = date('Y-m-d');
        $imv->IMB_IMV_DATACADASTRO          = date('Y-m-d');
        $imv->IMB_IMV_RADAR                 = $request->IMB_IMV_RADAR;
        $imv->IMB_IMV_SUPERDESTAQUE                 = $request->IMB_IMV_SUPERDESTAQUE;
        $imv->IMB_ATD_ID                    = Auth::user()->IMB_ATD_ID;;
        $imv->IMB_IMV_TITULO                    = $request->IMB_IMV_TITULO;
        $imv->imb_imv_varandagourmet                    = $request->imb_imv_varandagourmet;
        $imv->IMB_IMV_ARESER                    = $request->IMB_IMV_ARESER;
        $imv->IMB_IMV_ORIENTACAOSOLAR                    = $request->IMB_IMV_ORIENTACAOSOLAR;
        $imv->IMB_IMV_POSICAO                    = $request->IMB_IMV_POSICAO;
        $imv->IMB_IMV_ALQPAU                    = $request->IMB_IMV_ALQPAU;
        $imv->IMB_IMV_ARESER                    = $request->IMB_IMV_ARESER;
        $imv->IMB_IMV_ORIENTACAOSOLAR                    = $request->IMB_IMV_ORIENTACAOSOLAR;
        $imv->IMB_IMV_ALQGOI                    = $request->IMB_IMV_ALQGOI;
        $imv->IMB_IMV_ALQMIN                    = $request->IMB_IMV_ALQMIN;
        $imv->IMB_IMV_ALQNOR                    = $request->IMB_IMV_ALQNOR;
        $imv->IMB_IMV_TOPOGR                    = $request->IMB_IMV_TOPOGR;
        $imv->IMB_IMV_IDADE                    = $request->IMB_IMV_IDADE;
        $imv->IMB_IMV_AECORREDOR                    = $request->IMB_IMV_AECORREDOR;
        $imv->IMB_IMV_AECLOSET                    = $request->IMB_IMV_AECLOSET;
        $imv->IMB_IMV_AESALA                    = $request->IMB_IMV_AESALA;
        $imv->IMB_IMV_AEESCRITORIO                    = $request->IMB_IMV_AEESCRITORIO;
        $imv->IMB_IMV_SALAAMOCO                    = $request->IMB_IMV_SALAAMOCO;
        $imv->imb_imv_deposito                    = $request->imb_imv_deposito;
        $imv->imb_imv_varandagourmet                    = $request->imb_imv_varandagourmet;
        $imv->IMB_IMV_QUADRAPOLIESPORTIVA                    = $request->IMB_IMV_QUADRAPOLIESPORTIVA;
        $imv->IMB_IMV_CAMFUT                    = $request->IMB_IMV_CAMFUT;
        $imv->IMB_IMV_SALESC                    = $request->IMB_IMV_SALESC;
        $imv->IMB_IMV_HOME                    = $request->IMB_IMV_HOME;
        $imv->IMB_IMV_VARANDA                    = $request->IMB_IMV_VARANDA;
        $imv->IMB_IMV_MURADO                    = $request->IMB_IMV_MURADO;
        $imv->IMB_IMV_PISOAQUECIDO                    = $request->IMB_IMV_PISOAQUECIDO;
        $imv->IMB_IMV_PISOARDOSIA                    = $request->IMB_IMV_PISOARDOSIA;
        $imv->IMB_IMV_PISOBLOQUETE                    = $request->IMB_IMV_PISOBLOQUETE;
        $imv->IMB_IMV_PISOCARPETE                    = $request->IMB_IMV_PISOCARPETE;
        $imv->IMB_IMV_PISOCARPETEACRIL                    = $request->IMB_IMV_PISOCARPETEACRIL;
        $imv->IMB_IMV_PISOCARPETEMADEIRA                    = $request->IMB_IMV_PISOCARPETEMADEIRA;
        $imv->IMB_IMV_PISOCARPETENYLON                    = $request->IMB_IMV_PISOCARPETENYLON;
        $imv->IMB_IMV_PISOCERAMICA                    = $request->IMB_IMV_PISOCERAMICA;
        $imv->IMB_IMV_PISOCIMENTO                    = $request->IMB_IMV_PISOCIMENTO;
        $imv->IMB_IMV_PISOCONTRAPISO                    = $request->IMB_IMV_PISOCONTRAPISO;
        $imv->IMB_IMV_PISOEMBORRACHADO                    = $request->IMB_IMV_PISOEMBORRACHADO;
        $imv->IMB_IMV_PISOGRANITO                    = $request->IMB_IMV_PISOGRANITO;
        $imv->IMB_IMV_PISOLAMINADO                    = $request->IMB_IMV_PISOLAMINADO;
        $imv->IMB_IMV_PISOMARMORE                    = $request->IMB_IMV_PISOMARMORE;
        $imv->IMB_IMV_PISOLAMINADO                    = $request->IMB_IMV_PISOLAMINADO;
        $imv->IMB_IMV_PISOTABUA                    = $request->IMB_IMV_PISOTABUA;
        $imv->IMB_IMV_PISOTACOMADEIRA                    = $request->IMB_IMV_PISOTACOMADEIRA;
        $imv->IMB_IMV_PISOVINICULO                    = $request->IMB_IMV_PISOVINICULO;
        $imv->IMB_IMV_VALORIPTU                    = $request->IMB_IMV_VALORIPTU;
        $imv->imb_imv_valorcondominio                    = $request->imb_imv_valorcondominio;
        $imv->IMB_IMV_CHAVES                    = $request->IMB_IMV_CHAVES;
        $imv->IMB_IMV_CHAVESSITUACAO                    = $request->IMB_IMV_CHAVESSITUACAO;
        $imv->IMB_ATD_IDCHAVE                    = $request->IMB_ATD_IDCHAVE;
        $imv->IMB_IMV_SUPERDESTAQUE                 = $request->IMB_IMV_SUPERDESTAQUE;
        $imv->IMB_IMV_SALESC                    = $request->IMB_IMV_SALESC;
        $imv->IMB_IMV_COPA                    = $request->IMB_IMV_COPA;
        $imv->IMB_IMV_SUICLO                    = $request->IMB_IMV_SUICLO;
        $imv->IMB_IMV_SALQUA                    = $request->IMB_IMV_SALQLO;
        $imv->IMB_IMV_COZAE                    = $request->IMB_IMV_COZAE;
        $imv->IMB_IMV_AECORREDOR                    = $request->IMB_IMV_AECORREDOR;
        $imv->IMB_IMV_AECLOSET                    = $request->IMB_IMV_AECLOSET;
        $imv->IMB_IMV_AESALA                    = $request->IMB_IMV_AESALA;
        $imv->IMB_IMV_AEESCRITORIO                    = $request->IMB_IMV_AEESCRITORIO;
        $imv->IMB_IMV_AEWC                    = $request->IMB_IMV_AEWC;
        $imv->IMB_IMV_MANTERSITE                    = $request->IMB_IMV_MANTERSITE;
        $imv->VIS_STA_ID                    = $request->VIS_STA_ID;
        $imv->IMB_IMV_FINALIDADE                    = $request->IMB_IMV_FINALIDADE;
        $imv->IMB_IMV_PADRAO                    = $request->IMB_IMV_PADRAO;
        $imv->IMB_IMV_ANOCONSTRUCAO                    = $request->IMB_IMV_ANOCONSTRUCAO;
        $imv->IMB_IMV_CONDICOESCOMERCIAIS                    = $request->IMB_IMV_CONDICOESCOMERCIAIS;
        $imv->IMB_IMV_PISOPORCELANATO                    = $request->IMB_IMV_PISOPORCELANATO;
        $imv->IMB_IMV_CHABOX                    = $request->IMB_IMV_CHABOX;
        $imv->IMB_IMV_ALARME                    = $request->IMB_IMV_ALARME;
        $imv->IMB_IMV_ARAPARELHO                    = $request->IMB_IMV_ARAPARELHO;
        $imv->IMB_IMV_LAREIRA                    = $request->IMB_IMV_LAREIRA;
        $imv->IMB_IMV_SEMIMOB                    = $request->IMB_IMV_SEMIMOB;
        $imv->IMB_IMV_INTERF                    = $request->IMB_IMV_INTERF;
        $imv->IMB_IMV_AGUAQUENTE                    = $request->IMB_IMV_AGUAQUENTE;
        $imv->IMB_IMV_PORTALQUADROCHAVES=       $request->IMB_IMV_PORTALQUADROCHAVES;

        $ntipoimovel                        = $request->input('IMB_TIM_ID');
        $imv->save();

         if( $novoimovel == 'S' )
         {
            if( $imv->IMB_IMV_WEBIMOVEL == 'N' )
                $this->gravarHistorico( $imv->IMB_IMV_ID, 'Imóvel', 'Internet',' ', 'Novo Imóvel gravado sem a opção internet!');

            $tipoimovel  = mdlTipoImovel::find( $ntipoimovel);

            $sub=$tipoimovel->imb_tim_prefixo   ;
            $referencia = collect( DB::select("select NovaReferencia('$sub') as ref "))->first()->ref;
            $imv->IMB_IMV_REFERE = $referencia;
            $imv->IMB_IMV_RELIRRF               =  'S';
            $imv->save();

            $atends = mdlAtendente::where( 'IMB_ATD_ATIVO','=','A')->get();
            foreach( $atends as $atend)
            {
                $nt = new mdlImoveisNotificacoes;
                $nt->IMB_IMV_ID = $imv->IMB_IMV_ID;
                $nt->IMB_ATD_ID =  $atend->IMB_ATD_ID;
                $nt->IMB_IMB_ID =Auth::user()->IMB_IMB_ID;
                $nt->IMB_IMN_DTHCADASTRO = date('Y-m-d H:i:s');
                $nt->IMB_IMN_TIPOENTRADA = 'Novo';
                $nt->save();
            }
         }


//            return redirect("imovel/edit/".$imv->IMB_IMV_ID );

       return  response( $imv,200);

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
    public function edit( Request $request)
    {

        $somenteleitura = $request->readonly;
        $id = $request->input( 'id');
        $imovel = mdlImovel::find($id);
        $imobiliaria = mdlImobiliaria::all();
        $tipoimovel = mdlTipoImovel::all();
        $condominio = mdlCondominio::select('*')
        ->orderBy( 'IMB_CND_NOME')
        ->get();
        $corimo = mdlCorImo::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->get();


        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->get();


        $cliente = mdlCliente::select('IMB_CLT_NOME', 'IMB_CLT_ID', 'IMB_CLT_CPF')->orderBy( 'IMB_CLT_NOME' )->limit(10)->get();
        return view('imovel.edit', compact('imovel', 'imobiliaria', 'tipoimovel', 'condominio', 'cliente', 'imagens', 'corimo','somenteleitura') );
        //
    }

    public function carga( $id )
    {

        $imovel = mdlImovel::select( 
            [
                '*',
                DB::Raw( '( SELECT CEP_BAI_NOME FROM CEP_BAIRRO WHERE CEP_BAIRRO.CEP_BAI_ID = IMB_IMOVEIS.CEP_BAI_ID ) as CEP_BAI_NOME' ),
                DB::Raw( '( SELECT IMB_CND_NOME FROM IMB_CONDOMINIO WHERE IMB_CONDOMINIO.IMB_CND_ID = IMB_IMOVEIS.IMB_CND_ID ) as IMB_CND_NOME' )
            ]
        )->where( 'IMB_IMV_ID','=', $id )->first();
        return $imovel;
        //
    }

    public function cargaJson( $id )
    {

        $imovel = mdlImovel::find($id);
        return response()->json($imovel,200);
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)

    {

        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }

         $this->verificarAlteracao( $request->IMB_IMV_ID, $request );




//        dd($request)       ;

        $id = $request->input('IMB_IMV_ID');
//        return $request;

        $imv = mdlImovel::find($id);
        if( isset( $imv )){

//            $imv->IMB_IMV_ID   = $request->input('IMB_IMV_ID')

            $mudanca = '';
            if( $request->IMB_IMV_VALLOC <> $imv->IMB_IMV_VALLOC ) $mudanca='$ Locação';
            if( $request->IMB_IMV_VALVEN <> $imv->IMB_IMV_VALVEN ) $mudanca='$ Venda';
            if( $request->VIS_STA_ID <> $imv->VIS_STA_ID ) $mudanca='Status';


            $IMB_IMV_WEBIMOVEL             = $request->input('IMB_IMV_WEBIMOVEL');
            $IMB_IMV_DESTAQUE              =  $request->input('IMB_IMV_DESTAQUE');
            $IMB_IMV_WEBLANCAMENTO         =  $request->input('IMB_IMV_WEBLANCAMENTO');
            $IMB_IMV_ESCLUSIVO             =  $request->input('IMB_IMV_ESCLUSIVO');
            $IMB_IMV_PLACA                 =  $request->input('IMB_IMV_PLACA');
            $IMB_IMV_TERREA                =  $request->input('IMB_IMV_TERREA');
            $IMB_IMV_PERMUTA               =  $request->input('IMB_IMV_PERMUTA');
            $IMB_IMV_ESCRIT                =  $request->input('IMB_IMV_ESCRIT');
            $IMB_IMV_SOBRADO               =  $request->input('IMB_IMV_SOBRADO');
            $IMB_IMV_ASSOBRADADA           =  $request->input('IMB_IMV_ASSOBRADADA');
            $IMB_IMV_ACEITAFINANC          =  $request->input('IMB_IMV_ACEITAFINANC');
            $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA');
            $IMB_IMV_COZPLA                =  $request->input('IMB_IMV_COZPLA');
            $IMB_IMV_EMPQUA                =  $request->input('IMB_IMV_EMPQUA');
            $IMB_IMV_LAVABOV                =  $request->input('IMB_IMV_LAVABOV');
            $IMB_IMV_EMPWC                =  $request->input('IMB_IMV_EMPWC');
            $IMB_IMV_DESPENSA                =  $request->input('IMB_IMV_DESPENSA');
            $IMB_IMV_PISCIN                =  $request->input('IMB_IMV_PISCIN');
            $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA');
            $IMB_IMV_EDICUL                =  $request->input('IMB_IMV_EDICUL');
            $IMB_IMV_QUINTA                =  $request->input('IMB_IMV_QUINTA');
            $IMB_IMV_CHURRA                =  $request->input('IMB_IMV_CHURRA');
            $IMB_IMV_PORELE                =  $request->input('IMB_IMV_PORELE');
            $IMB_IMV_SALFES                =  $request->input('IMB_IMV_SALFES');
            $IMB_IMV_SAUNA                =  $request->input('IMB_IMV_SAUNA');
            $IMB_IMV_QUADRAPOLIESPORTIVA                =  $request->input('IMB_IMV_QUADRAPOLIESPORTIVA');
            $IMB_IMV_PLAGRO                =  $request->input('IMB_IMV_PLAGRO');
            $IMB_IMV_DORAE                =  $request->input('IMB_IMV_DORAE');
            $IMB_IMV_SUIHID                =  $request->input('IMB_IMV_SUIHID');
            $IMB_IMV_LAVABO                =  $request->input('IMB_IMV_LAVABO');
            $IMB_IMV_SUSPENSO                =  $request->input('IMB_IMV_SUSPENSO');
            $IMB_IMV_DORAE                =  $request->input('IMB_IMV_DORAE');
            $imv->IMB_IMV_SUPERDESTAQUE                 = $request->IMB_IMV_SUPERDESTAQUE;
            $imv->IMB_IMB_ID                    = $request->input('IMB_IMB_ID') ;
            $imv->IMB_IMB_ID2                   = $request->input('IMB_IMB_ID2') ;
            $imv->IMB_IMV_WEBIMOVEL             = $IMB_IMV_WEBIMOVEL;
            $imv->IMB_IMV_DESTAQUE              = $IMB_IMV_DESTAQUE;
            $imv->IMB_IMV_WEBLANCAMENTO         = $IMB_IMV_WEBLANCAMENTO;

            $imv->IMB_IMV_ESCLUSIVO             = $IMB_IMV_ESCLUSIVO;
            $imv->IMB_IMV_PLACA                 = $IMB_IMV_PLACA;
            $imv->imb_imv_terrea                = $IMB_IMV_TERREA;
            $imv->IMB_IMV_PERMUTA               = $IMB_IMV_PERMUTA;
            $imv->IMB_IMV_ESCRIT                = $IMB_IMV_ESCRIT;
            $imv->IMB_IMV_SOBRADO               = $IMB_IMV_SOBRADO;
            $imv->IMB_IMV_ASSOBRADADA           = $IMB_IMV_ASSOBRADADA;

            $imv->IMB_IMV_ACEITAFINANC          = $IMB_IMV_ACEITAFINANC;
            $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA;
            $imv->IMB_IMV_COZPLA                =   $IMB_IMV_COZPLA ;
            $imv->IMB_IMV_EMPQUA                =   $IMB_IMV_EMPQUA ;
            $imv->IMB_IMV_LAVABO                 =  $IMB_IMV_LAVABO ;
            $imv->IMB_IMV_EMPWC                =    $IMB_IMV_EMPWC ;
            $imv->IMB_IMV_DESPENSA                = $IMB_IMV_DESPENSA ;
            $imv->IMB_IMV_PISCIN                =   $IMB_IMV_PISCIN ;

            $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA ;
            $imv->IMB_IMV_EDICUL                =   $IMB_IMV_EDICUL;
            $imv->IMB_IMV_QUINTA                =   $IMB_IMV_QUINTA ;
            $imv->IMB_IMV_CHURRA                =   $IMB_IMV_CHURRA ;
            $imv->IMB_IMV_PORELE                =   $IMB_IMV_PORELE ;
            $imv->IMB_IMV_SALFES                =   $IMB_IMV_SALFES ;


            $imv->IMB_IMV_SAUNA                =    $IMB_IMV_SAUNA ;
            $imv->IMB_IMV_QUADRAPOLIESPORTIVA    =  $IMB_IMV_QUADRAPOLIESPORTIVA ;
            $imv->IMB_IMV_PLAGRO                =   $IMB_IMV_PLAGRO ;

            $imv->IMB_IMV_DORAE                 = $IMB_IMV_DORAE;
            $imv->IMB_IMV_SUIHID                = $IMB_IMV_SUIHID;

            $imv->IMB_IMV_DORCLO                = $request->input('IMB_IMV_DORCLO');


            $imv->IMB_IMV_DATAATUALIZACAO       = date('Y-m-d');

            $imv->IMB_TIM_ID                    = $request->input('IMB_TIM_ID');

            $imv->IMB_CLT_ID                    = $request->input('IMB_CLT_ID');

            $imv->IMB_IMV_REFERE                = $request->input('IMB_IMV_REFERE');

            $imv->IMB_IMV_VALVEN                = $request->input('IMB_IMV_VALVEN');

            $imv->IMB_IMV_VALLOC                = $request->input('IMB_IMV_VALLOC');

            $imv->IMB_IMV_ENDERECOTIPO          = $request->input('IMB_IMV_ENDERECOTIPO');

            $imv->IMB_IMV_ENDERECONUMERO        = $request->input('IMB_IMV_ENDERECONUMERO');

            $imv->IMB_IMV_ENDERECO              = $request->input('IMB_IMV_ENDERECO');

            $imv->IMB_IMV_NUMAPT                = $request->input('IMB_IMV_NUMAPT');

            $imv->IMB_IMV_ENDERECOCOMPLEMENTO   = $request->input('IMB_IMV_ENDERECOCOMPLEMENTO');

            if( $request->input('IMB_CND_ID') <> '' )
                $imv->IMB_CND_ID                    = $request->input('IMB_CND_ID');
            else
                $imv->IMB_CND_ID                    = null;


            $imv->IMB_IMV_PREDIO                = $request->input('IMB_IMV_PREDIO');

            $imv->IMB_IMV_ANDAR                 = $request->input('IMB_IMV_ANDAR');

            $imv->CEP_BAI_NOME                  = $request->input('CEP_BAI_NOME');
            $imv->CEP_BAI_ID                  = $request->input('CEP_BAI_ID');

            $imv->IMB_IMV_ENDERECOCEP           = $request->input('IMB_IMV_ENDERECOCEP');

            $imv->IMB_IMV_QUADRA                = $request->input('IMB_IMV_QUADRA');


         $imv->IMB_IMV_LOTE                  = $request->input('IMB_IMV_LOTE');

            $imv->IMB_IMV_CIDADE                = $request->input('IMB_IMV_CIDADE');

            $imv->IMB_IMV_ESTADO                = $request->input('IMB_IMV_ESTADO');

            $imv->IMB_IMV_PROXIMIDADE           = $request->input('IMB_IMV_PROXIMIDADE');

            $imv->IMB_IMV_MEDTER                = $request->input('IMB_IMV_MEDTER');

            $imv->IMB_IMV_ARETOT                = $request->input('IMB_IMV_ARETOT');

            $imv->IMB_IMV_ARECON                = $request->input('IMB_IMV_ARECON');

            $imv->IMB_IMV_AREUTI                = $request->input('IMB_IMV_AREUTI');

           $imv->IMB_IMV_DORQUA                = $request->input('IMB_IMV_DORQUA');

            $imv->IMB_IMV_SUIQUA                = $request->input('IMB_IMV_SUIQUA');


            $imv->IMB_IMV_SALQUA                = $request->input('IMB_IMV_SALQUA');

            $imv->IMB_IMV_SUSPENSO               =  $IMB_IMV_SUSPENSO;

            $imv->IMB_IMV_OBSWEB                = $request->input('IMB_IMV_OBSWEB');


            if( $request->input('IMB_IMV_GARDES' ) <> '' )
                $imv->IMB_IMV_GARDES                = $request->input('IMB_IMV_GARDES',0);

            if( $request->input('IMB_IMV_GARCOB' ) <> '' )
                $imv->IMB_IMV_GARCOB                = $request->input('IMB_IMV_GARCOB',0);

            $imv->IMB_IMV_IDADE                 = $request->input('IMB_IMV_IDADE');

            $imv->IMB_IMV_LINKVIDEO             = $request->input('IMB_IMV_LINKVIDEO');
            $imv->IMB_IMV_OBSERV                = $request->input('IMB_IMV_OBSERV');
            $imv->IMB_IMB_IDMASTER              = $request->input('IMB_IMB_ID');
            $imv->IMB_IMV_SUPERDESTAQUE                 = $request->IMB_IMV_SUPERDESTAQUE;
            $imv->IMB_ATD_ID                    = $request->IMB_ATD_ID;
            $imv->IMB_IMV_TITULO                = $request->IMB_IMV_TITULO;
            $imv->VIS_STA_ID                    = $request->VIS_STA_ID;
            $imv->IMB_IMV_WCQUA                  = $request->input('IMB_IMV_WCQUA');
            $imv->IMB_IMV_CHAVESSITUACAO                    = $request->IMB_IMV_CHAVESSITUACAO;
            $imv->IMB_ATD_IDCHAVE                    = $request->IMB_ATD_IDCHAVE;
            $imv->IMB_IMV_CHAVES                    = $request->IMB_IMV_CHAVES;
            $imv->IMB_IMV_WCQUA                    = $request->IMB_IMV_WCQUA;
            $imv->imb_imv_varandagourmet                    = $request->imb_imv_varandagourmet;
            $imv->IMB_IMV_ARESER                    = $request->IMB_IMV_ARESER;
            $imv->IMB_IMV_ORIENTACAOSOLAR                    = $request->IMB_IMV_ORIENTACAOSOLAR;
            $imv->IMB_IMV_POSICAO                    = $request->IMB_IMV_POSICAO;
            $imv->IMB_IMV_SACADA           = $request->IMB_IMV_SACADA;
            $imv->IMB_IMV_ELEVADORES           = $request->IMB_IMV_ELEVADORES;
            $imv->IMB_IMV_HECTARES                    = $request->IMB_IMV_HECTARES;
            $imv->IMB_IMV_ALQPAU                    = $request->IMB_IMV_ALQPAU;
            $imv->IMB_IMV_ALQGOI                    = $request->IMB_IMV_ALQGOI;
            $imv->IMB_IMV_ALQMIN                    = $request->IMB_IMV_ALQMIN;
            $imv->IMB_IMV_ALQNOR                    = $request->IMB_IMV_ALQNOR;
            $imv->IMB_IMV_TOPOGR                    = $request->IMB_IMV_TOPOGR;
            $imv->IMB_IMV_IDADE                    = $request->IMB_IMV_IDADE;
            $imv->IMB_IMV_AECORREDOR                    = $request->IMB_IMV_AECORREDOR;
            $imv->IMB_IMV_AECLOSET                    = $request->IMB_IMV_AECLOSET;
            $imv->IMB_IMV_AESALA                    = $request->IMB_IMV_AESALA;
            $imv->IMB_IMV_AEESCRITORIO                    = $request->IMB_IMV_AEESCRITORIO;
            $imv->IMB_IMV_SALAAMOCO                    = $request->IMB_IMV_SALAAMOCO;
            $imv->imb_imv_deposito                    = $request->imb_imv_deposito;
            $imv->imb_imv_varandagourmet                    = $request->imb_imv_varandagourmet;
            $imv->IMB_IMV_QUADRAPOLIESPORTIVA                    = $request->IMB_IMV_QUADRAPOLIESPORTIVA;
            $imv->IMB_IMV_CAMFUT                    = $request->IMB_IMV_CAMFUT;
            $imv->IMB_IMV_SALESC                    = $request->IMB_IMV_SALESC;
            $imv->IMB_IMV_HOME                    = $request->IMB_IMV_HOME;
            $imv->IMB_IMV_VARANDA                    = $request->IMB_IMV_VARANDA;
            $imv->IMB_IMV_MURADO                    = $request->IMB_IMV_CAMFUT;
            $imv->IMB_IMV_PISOAQUECIDO                    = $request->IMB_IMV_PISOAQUECIDO;
            $imv->IMB_IMV_PISOARDOSIA                    = $request->IMB_IMV_PISOARDOSIA;
            $imv->IMB_IMV_PISOBLOQUETE                    = $request->IMB_IMV_PISOBLOQUETE;
            $imv->IMB_IMV_PISOCARPETE                    = $request->IMB_IMV_PISOCARPETE;
            $imv->IMB_IMV_PISOCARPETEACRIL                    = $request->IMB_IMV_PISOCARPETEACRIL;
            $imv->IMB_IMV_PISOCARPETEMADEIRA                    = $request->IMB_IMV_PISOCARPETEMADEIRA;
            $imv->IMB_IMV_PISOCARPETENYLON                    = $request->IMB_IMV_PISOCARPETENYLON;
            $imv->IMB_IMV_PISOCERAMICA                    = $request->IMB_IMV_PISOCERAMICA;
            $imv->IMB_IMV_PISOCIMENTO                    = $request->IMB_IMV_PISOCIMENTO;
            $imv->IMB_IMV_PISOCONTRAPISO                    = $request->IMB_IMV_PISOCONTRAPISO;
            $imv->IMB_IMV_PISOEMBORRACHADO                    = $request->IMB_IMV_PISOEMBORRACHADO;
            $imv->IMB_IMV_PISOGRANITO                    = $request->IMB_IMV_PISOGRANITO;
            $imv->IMB_IMV_PISOLAMINADO                    = $request->IMB_IMV_PISOLAMINADO;
            $imv->IMB_IMV_PISOMARMORE                    = $request->IMB_IMV_PISOMARMORE;
            $imv->IMB_IMV_PISOTABUA                    = $request->IMB_IMV_PISOTABUA;
            $imv->IMB_IMV_PISOTACOMADEIRA                    = $request->IMB_IMV_PISOTACOMADEIRA;
            $imv->IMB_IMV_PISOVINICULO                    = $request->IMB_IMV_PISOVINICULO;
            $imv->IMB_IMV_VALORIPTU                    = $request->IMB_IMV_VALORIPTU;
            $imv->imb_imv_valorcondominio                    = $request->imb_imv_valorcondominio;
            $imv->IMB_IMV_SALESC                    = $request->IMB_IMV_SALESC;
            $imv->IMB_IMV_COPA                    = $request->IMB_IMV_COPA;
            $imv->IMB_IMV_SUICLO                    = $request->IMB_IMV_SUICLO;
            $imv->IMB_IMV_SALQUA                    = $request->IMB_IMV_SALQUA;
            $imv->IMB_IMV_COZAE                    = $request->IMB_IMV_COZAE;
            $imv->IMB_IMV_AECORREDOR                    = $request->IMB_IMV_AECORREDOR;
            $imv->IMB_IMV_AECLOSET                    = $request->IMB_IMV_AECLOSET;
            $imv->IMB_IMV_AESALA                    = $request->IMB_IMV_AESALA;
            $imv->IMB_IMV_AEESCRITORIO                    = $request->IMB_IMV_AEESCRITORIO;
            $imv->IMB_IMV_AEWC                    = $request->IMB_IMV_AEWC;
            $imv->IMB_IMV_MANTERSITE                    = $request->IMB_IMV_MANTERSITE;
            $imv->IMB_IMV_FINALIDADE                    = $request->IMB_IMV_FINALIDADE;
            $imv->IMB_IMV_PADRAO                    = $request->IMB_IMV_PADRAO;
            $imv->IMB_IMV_ANOCONSTRUCAO                    = $request->IMB_IMV_ANOCONSTRUCAO;
            $imv->IMB_IMV_CONDICOESCOMERCIAIS                    = $request->IMB_IMV_CONDICOESCOMERCIAIS;
            $imv->IMB_IMV_PISOPORCELANATO                    = $request->IMB_IMV_PISOPORCELANATO;
            $imv->IMB_ATD_IDALTERACAO                    = Auth::user()->IMB_ATD_ID;
            $imv->IMB_IMV_CHABOX                    = $request->IMB_IMV_CHABOX;
            $imv->IMB_IMV_ALARME                    = $request->IMB_IMV_ALARME;
            $imv->IMB_IMV_ARAPARELHO                    = $request->IMB_IMV_ARAPARELHO;
            $imv->IMB_IMV_LAREIRA                    = $request->IMB_IMV_LAREIRA;
            $imv->IMB_IMV_SEMIMOB                    = $request->IMB_IMV_SEMIMOB;
            $imv->IMB_IMV_INTERF                    = $request->IMB_IMV_INTERF;
            $imv->IMB_IMV_AGUAQUENTE                    = $request->IMB_IMV_AGUAQUENTE;
            $imv->IMB_IMV_PORTALQUADROCHAVES=       $request->IMB_IMV_PORTALQUADROCHAVES;

            $imv->save();


            if( $imv->IMB_IMV_REFERE == '' )
            {
                $ntipoimovel = $request->input('IMB_TIM_ID');
                $tipoimovel  = mdlTipoImovel::select(
                    [
                        'IMB_TIM_SUPTIPO'
                    ])
                ->where( 'IMB_TIM_ID','=',$ntipoimovel )
                ->first();

                $sub=$tipoimovel->IMB_TIM_SUPTIPO;
                $referencia = collect( DB::select("select NovaReferencia('$sub') as ref "))->first()->ref;
                $imv->IMB_IMV_REFERE = $referencia;
            }

            if( $mudanca <> '' )
            {
                $atends = mdlAtendente::where( 'IMB_ATD_ATIVO','=','A')->get();
                foreach( $atends as $atend)
                {
                    $nt = new mdlImoveisNotificacoes;
                    $nt->IMB_IMV_ID = $imv->IMB_IMV_ID;
                    $nt->IMB_ATD_ID =  $atend->IMB_ATD_ID;
                    $nt->IMB_IMB_ID =Auth::user()->IMB_IMB_ID;
                    $nt->IMB_IMN_TIPOENTRADA = $mudanca;
                    $nt->IMB_IMN_DTHCADASTRO = date('Y-m-d H:i:s');
                    $nt->save();
                }
            }

            //$imv->save();


            $existe = mdlPropImovel::select(
                [
                    'IMB_PPI_ID'
                ]
            )
            ->where( 'IMB_IMV_ID','=',$imv->IMB_IMV_ID )
            ->where( 'IMB_CLT_ID','=',$request->input('IMB_CLT_ID') )
            ->get();



             $original =  $request->input('IMB_CLT_IDORIGINAL');
            $atual =  $request->input('IMB_CLT_ID');
            $idimovel = $request->input('IMB_IMV_ID');

             return response('ok',200);


/*            if( $atual <> '' )
            {
                DB::table('IMB_PROPRIETARIOIMOVEL')
                    ->where('IMB_CLT_ID', '=',$original )
                    ->where('IMB_IMV_ID', '=',$idimovel )
                ->update( ['IMB_CLT_ID' =>  $atual ]) ;
            };
*/

        }
//          return $IMB_IMV_WEBIMOVEL;
return redirect('imovel');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imovel = mdlImovel::find( $id );

        $endereco = $imovel->IMB_IMV_REFERE.' - '.
            $imovel->IMB_IMV_ENDERECO.' '.
            $imovel->IMB_IMV_ENDERECONUMERO.' '.
            $imovel->IMB_IMV_NUMAPT.' '.
            $imovel->IMB_IMV_ENDERECOCOMPLEMENTO.' ';


        if( isset( $imovel ))
        {
            $imovel->delete();
            $log = new mdlLog;
            $log->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $log->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $log->IMB_MDL_CODIGO = 'IMOVEIS';
            $log->IMB_LOG_OPERACAO = 'O';
            $log->IMB_LOG_DESCRICAO = 'Exclusao do Imóvel '.$endereco;
            $log->IMB_LOG_DATAHORA = date('Y-m-d H:i:s');
            $log->IMB_LOG_TABELA = 'IMB_IMOVEIS';

            $log->save();

            return response()->json( $endereco, 200 );

        }
        return response()->json( 'já excluido', 404 );
    }

    /**
     * Formulário para criação e edição de imóveis
     * @param int $id Identificador do imóvel
     * @return view
     */
    public function form(Request $request)
    {
        $imovel = new mdlImovel;

        if (isset($request->id))
        {
            $imovel = $imovel->find($request->id);
            $imobiliaria = mdlImobiliaria::all();
            $tipoimovel = mdlTipoImovel::all();
            $condominio = mdlCondominio::all();

        }

        return view('imovel.form', compact('imovel', 'imobiliaria', 'tipoimovel', 'condominio'));
    }


    public function add()
    {

        $id = collect( DB::select("select auto_increment + 1 as novoid  from information_schema.tables where table_name = 'IMB_CLIENTE' "))->first()->novoid;

        $statement = "ALTER TABLE IMB_CLIENTE AUTO_INCREMENT= $id";
        DB::unprepared($statement);

        //$cliente = mdlCliente::select('IMB_CLT_NOME', 'IMB_CLT_ID', 'IMB_CLT_CPF')->orderBy( 'IMB_CLT_NOME' )->limit(10)->get();
//        return redirect("imovel/edit/".$imv->IMB_IMV_ID );


        return view( 'imovel.new', compact('id') );


    }

    public function galeria()
    {
        return 'OK';
    }

    public function mostrar($id)
    {

        $imovel = mdlImovel::select(
            [
                '*',
                DB::raw( '(select CEP_BAI_NOME FROM CEP_BAIRRO WHERE CEP_BAIRRO.CEP_BAI_ID = IMB_IMOVEIS.CEP_BAI_ID ) AS CEP_BAI_NOME'),                
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO'),
                DB::raw("imovel( IMB_IMOVEIS.IMB_IMV_ID ) AS ENDERECOCOMPLETO"),
                DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO' )
            ])
            ->where('IMB_IMOVEIS.IMB_IMV_ID', '=', $id)
            ->get();

//            $imovel = mdlImovel::find($id);
        return $imovel->toJson();

        //
    }

    public function trocarStatusImovel( Request $request)
    {

        $imovel = $request->IMB_IMV_ID;
        $status = $request->VIS_STA_ID;

        $imv = mdlImovel::find( $imovel );
        $statusanterior =
        app('App\Http\Controllers\ctrStatusImovel')
        ->buscar( $imv->VIS_STA_ID )->VIS_STA_NOME;

        $statusnovo =
        app('App\Http\Controllers\ctrStatusImovel')
        ->buscar($status )->VIS_STA_NOME;

        $imv->VIS_STA_ID = $status;

        $imv->save();
        $this->gravarHistorico( $imovel, 'Imóvel', 'Status', $statusanterior, $statusnovo);

        if( app('App\Http\Controllers\ctrRotinas')
        ->pegarSituacaoStatus( $imv->VIS_STA_ID ) == 'A' )
        {
            $atends = mdlAtendente::where( 'IMB_ATD_ATIVO','=','A')->get();
            foreach( $atends as $atend)
            {
                $nt = new mdlImoveisNotificacoes;
                $nt->IMB_IMV_ID = $imv->IMB_IMV_ID;
                $nt->IMB_ATD_ID =  $atend->IMB_ATD_ID;
                $nt->IMB_IMB_ID =Auth::user()->IMB_IMB_ID;
                $nt->IMB_IMN_DTHCADASTRO = date('Y-m-d H:i:s');
                $nt->IMB_IMN_TIPOENTRADA = 'Reativado';
                $nt->save();

            }

        }



        return response()->json( 'ok', 200 );

        //
    }

    public function detalhecomfoto( $id )
    {

        $imagens = mdlImagem::select('*')
        ->where( 'IMB_IMV_ID',$id)
        ->get();

        $imovel = mdlImovel::find( $id );

        return view( 'imovel.detalhecomfotos', compact( 'imovel', 'imagens') );


    }

    public function teste()
    {
        $imv = mdlImovel::where('IMB_IMB_ID','=','3')
        ->limit(100)
        ->get();

        return $imv;

    }

    public function verificarAlteracao( $imovel, $request)
    {

        if( $imovel == '' ) return response()->json('ok',200);
        $ant = mdlImovel::find( $imovel );



        if( $ant->IMB_IMV_REFERE <> $request->IMB_IMV_REFERE )
        $this->gravarHistorico( $imovel, 'IMOVEL', 'Referência', $ant->IMB_IMV_REFERE,  $request->IMB_IMV_REFERE);

        if( $ant->IMB_IMV_CHABOX <> $request->IMB_IMV_CHABOX )
        $this->gravarHistorico( $imovel, 'IMOVEL', 'Nº Chaves', $ant->IMB_IMV_CHABOX,  $request->IMB_IMV_CHABOX);

        if( $ant->IMB_IMV_PREDIO <> $request->IMB_IMV_PREDIO )
        $this->gravarHistorico( $imovel, 'IMOVEL', 'Nome do Prédio', $ant->IMB_IMV_PREDIO,  $request->IMB_IMV_PREDIO);

        if( $ant->IMB_IMV_NUMAPT <> $request->IMB_IMV_NUMAPT )
        $this->gravarHistorico( $imovel, 'IMOVEL', 'Nº Apto.', $ant->IMB_IMV_NUMAPT,  $request->IMB_IMV_NUMAPT);

        if( $ant->IMB_IMV_ENDERECOTIPO <> $request->IMB_IMV_ENDERECOTIPO )
        $this->gravarHistorico( $imovel, 'IMOVEL', 'Tipo Logradouro', $ant->IMB_IMV_ENDERECOTIPO,  $request->IMB_IMV_ENDERECOTIPO);

        if( $ant->IMB_IMV_ENDERECO <> $request->IMB_IMV_ENDERECO )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Logradouro', $ant->IMB_IMV_ENDERECO,  $request->IMB_IMV_ENDERECO);

        if( $ant->IMB_IMV_ENDERECONUMERO <> $request->IMB_IMV_ENDERECONUMERO )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Nº no Endereço', $ant->IMB_IMV_ENDERECONUMERO,  $request->IMB_IMV_ENDERECONUMERO);

        if( $ant->IMB_IMV_ENDERECOCOMPLEMENTO <> $request->IMB_IMV_ENDERECOCOMPLEMENTO )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Imediações', $ant->IMB_IMV_ENDERECOCOMPLEMENTO,  $request->IMB_IMV_ENDERECOCOMPLEMENTO);

            if( $ant->IMB_IMV_MEDTER  <> $request->IMB_IMV_MEDTER  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Medida Terreno', $ant->IMB_IMV_MEDTER,  $request->IMB_IMV_MEDTER);

/*
            if( $ant->IMB_IMV_ASFALT  <> $request->IMB_IMV_ASFALT  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Asfalto', $ant->IMB_IMV_ASFALT ,  $request->IMB_IMV_ASFALT );

            if( $ant->IMB_IMV_LAJE  <> $request->IMB_IMV_LAJE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Laje', $ant->IMB_IMV_LAJE ,  $request->IMB_IMV_LAJE );

            if( $ant->IMB_IMV_FORRO  <> $request->IMB_IMV_FORRO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Forro', $ant->IMB_IMV_FORRO ,  $request->IMB_IMV_FORRO );
*/
            if( $ant->IMB_IMV_DORAE  <> $request->IMB_IMV_DORAE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Dormitorios', $ant->IMB_IMV_DORAE ,  $request->IMB_IMV_DORAE );

            if( $ant->imb_imv_valorcondominio  <> $request->imb_imv_valorcondominio  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Valor Comndomínio', $ant->imb_imv_valorcondominio ,  $request->imb_imv_valorcondominio );

            if( $ant->IMB_IMV_DORCLO  <> $request->IMB_IMV_DORCLO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Closet', $ant->IMB_IMV_DORCLO ,  $request->IMB_IMV_DORCLO );

            if( $ant->IMB_IMV_SUIAE  <> $request->IMB_IMV_SUIAE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Suite', $ant->IMB_IMV_SUIAE ,  $request->IMB_IMV_SUIAE );

            if( $ant->IMB_IMV_SUICLO  <> $request->IMB_IMV_SUICLO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Suíte Closet', $ant->IMB_IMV_SUICLO ,  $request->IMB_IMV_SUICLO );

            if( $ant->IMB_IMV_LAVABO  <> $request->IMB_IMV_LAVABO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Lavabo', $ant->IMB_IMV_LAVABO ,  $request->IMB_IMV_LAVABO );

            if( $ant->IMB_IMV_WS  <> $request->IMB_IMV_WS  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'WS Social', $ant->IMB_IMV_WS ,  $request->IMB_IMV_WS );

            if( $ant->IMB_IMV_SALEST  <> $request->IMB_IMV_SALEST  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Sala Estar', $ant->IMB_IMV_SALEST ,  $request->IMB_IMV_SALEST );

            if( $ant->IMB_IMV_SALJAN  <> $request->IMB_IMV_SALJAN  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Sala Jantar', $ant->IMB_IMV_SALJAN ,  $request->IMB_IMV_SALJAN );

            if( $ant->IMB_IMV_SALTV  <> $request->IMB_IMV_SALTV  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Sala Escritório', $ant->IMB_IMV_SALTV ,  $request->IMB_IMV_SALTV );

            if( $ant->IMB_IMV_COZINHA  <> $request->IMB_IMV_COZINHA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Cozinha', $ant->IMB_IMV_COZINHA ,  $request->IMB_IMV_COZINHA );

            if( $ant->IMB_IMV_COZAE  <> $request->IMB_IMV_COZAE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Cozinha', $ant->IMB_IMV_COZAE ,  $request->IMB_IMV_COZAE );

            if( $ant->IMB_IMV_COZGAB  <> $request->IMB_IMV_COZGAB  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Gabinete Cozinha', $ant->IMB_IMV_COZGAB ,  $request->IMB_IMV_COZGAB );

            if( $ant->IMB_IMV_COZPLA  <> $request->IMB_IMV_COZPLA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Cozinha Planejada', $ant->IMB_IMV_COZPLA ,  $request->IMB_IMV_COZPLA );

            if( $ant->IMB_IMV_EMPQUA  <> $request->IMB_IMV_EMPQUA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Dormitório Empregada', $ant->IMB_IMV_EMPQUA ,  $request->IMB_IMV_EMPQUA );

            if( $ant->IMB_IMV_EMPWC <> $request->IMB_IMV_EMPWC  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Banheiro  Empregada', $ant->IMB_IMV_EMPWC ,  $request->IMB_IMV_EMPWC );

            if( $ant->IMB_IMV_DESQUA  <> $request->IMB_IMV_DESQUA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quarto Despejo', $ant->IMB_IMV_DESQUA ,  $request->IMB_IMV_DESQUA );

            if( $ant->IMB_IMV_ARESER  <> $request->IMB_IMV_ARESER  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Área Serviço', $ant->IMB_IMV_ARESER ,  $request->IMB_IMV_ARESER );

            if( $ant->IMB_IMV_QUINTA  <> $request->IMB_IMV_QUINTA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quintal', $ant->IMB_IMV_QUINTA ,  $request->IMB_IMV_QUINTA );

            if( $ant->IMB_IMV_PLAGRO  <> $request->IMB_IMV_PLAGRO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Playground', $ant->IMB_IMV_PLAGRO ,  $request->IMB_IMV_PLAGRO );

            if( $ant->IMB_IMV_PISCIN  <> $request->IMB_IMV_PISCIN  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piscina', $ant->IMB_IMV_PISCIN ,  $request->IMB_IMV_PISCIN );

            if( $ant->IMB_IMV_CHURRA  <> $request->IMB_IMV_CHURRA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Churrasqueira', $ant->IMB_IMV_CHURRA ,  $request->IMB_IMV_CHURRA );

            if( $ant->IMB_IMV_SALFES  <> $request->IMB_IMV_SALFES  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Salão de Festas', $ant->IMB_IMV_SALFES ,  $request->IMB_IMV_SALFES );

            if( $ant->IMB_IMV_PORELE  <> $request->IMB_IMV_PORELE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Portão Eletrônico', $ant->IMB_IMV_PORELE ,  $request->IMB_IMV_PORELE );

            
            if( $ant->IMB_IMV_PLACA  <> $request->IMB_IMV_PLACA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Placa', $ant->IMB_IMV_PLACA ,  $request->IMB_IMV_PLACA );

            if( $ant->IMB_IMV_IPTU  <> $request->IMB_IMV_IPTU  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Tem IPTU', $ant->IMB_IMV_IPTU ,  $request->IMB_IMV_IPTU );

            if( $ant->IMB_IMV_ESCRIT  <> $request->IMB_IMV_ESCRIT  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Tem Escritura', $ant->IMB_IMV_ESCRIT ,  $request->IMB_IMV_ESCRIT );

            if( $ant->IMB_IMV_REGIST  <> $request->IMB_IMV_REGIST  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Referência', $ant->XXXXXXXXX,  $request->IMB_IMV_REGIST );

            if( $ant->IMB_IMV_CAMFUT <> $request->IMB_IMV_CAMFUT )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Campo Futebol', $ant->IMB_IMV_CAMFUT,  $request->IMB_IMV_CAMFUT);

            /*if( $ant->IMB_IMV_WEBFOTO  <> $request->IMB_IMV_WEBFOTO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Fotos na Internet', $ant->IMB_IMV_WEBFOTO ,  $request->IMB_IMV_WEBFOTO );
*/
            if( $ant->IMB_IMV_VALVEN  <> $request->IMB_IMV_VALVEN  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Valor Venda', $ant->IMB_IMV_VALVEN ,  $request->IMB_IMV_VALVEN );

            if( $ant->IMB_IMV_VALLOC  <> $request->IMB_IMV_VALLOC  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Valor Locação', $ant->IMB_IMV_VALLOC ,  $request->IMB_IMV_VALLOC );

            if( $ant->IMB_IMV_DORQUA  <> $request->IMB_IMV_DORQUA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quantidade Dormitórios', $ant->IMB_IMV_DORQUA ,  $request->IMB_IMV_DORQUA );

            if( $ant->IMB_IMV_SUIQUA  <> $request->IMB_IMV_SUIQUA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quantidade de Suítes', $ant->IMB_IMV_SUIQUA ,  $request->IMB_IMV_SUIQUA );

            if( $ant->IMB_IMV_COPA  <> $request->IMB_IMV_COPA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Copa', $ant->IMB_IMV_COPA ,  $request->IMB_IMV_COPA );

            if( $ant->IMB_IMV_GARCOB  <> $request->IMB_IMV_GARCOB  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Garagem Coberta', $ant->IMB_IMV_GARCOB ,  $request->IMB_IMV_GARCOB );

            if( $ant->IMB_IMV_GARDES  <> $request->IMB_IMV_GARDES  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Garagem Descoberta', $ant->IMB_IMV_GARDES ,  $request->IMB_IMV_GARDES );

            if( $ant->IMB_IMV_WCQUA  <> $request->IMB_IMV_WCQUA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quantidade de WC', $ant->IMB_IMV_WCQUA ,  $request->IMB_IMV_WCQUA );

            if( $ant->IMB_IMV_ENDERECOCEP  <> $request->IMB_IMV_ENDERECOCEP  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Cep do Imóvel', $ant->IMB_IMV_ENDERECOCEP ,  $request->IMB_IMV_ENDERECOCEP );

            if( $ant->IMB_IMV_CHAVES <> $request->IMB_IMV_CHAVES )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'OBSEVA', $ant->IMB_IMV_CHAVES,  $request->IMB_IMV_CHAVES);

            if( $ant->IMB_CND_ID  <> $request->IMB_CND_ID  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Condominio', $this->condominio($ant->IMB_CND_ID),  $this->condominio($request->IMB_CND_ID) );

            if( $ant->IMB_IMV_QUADRAPOLIESPORTIVA  <> $request->IMB_IMV_QUADRAPOLIESPORTIVA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quadra Poliesportiva', $ant->IMB_IMV_QUADRAPOLIESPORTIVA ,  $request->IMB_IMV_QUADRAPOLIESPORTIVA );

/*            if( $ant->IMB_IMV_WEBCAPA  <> $request->IMB_IMV_WEBCAPA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Capa do Site', $ant->IMB_IMV_WEBCAPA ,  $request->IMB_IMV_WEBCAPA );
*/
            if( $ant->IMB_IMV_WEBLANCAMENTO  <> $request->IMB_IMV_WEBLANCAMENTO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Imóvel Lançamento', $ant->IMB_IMV_WEBLANCAMENTO ,  $request->IMB_IMV_WEBLANCAMENTO );

            if( $ant->IMB_IMV_CIDADE  <> $request->IMB_IMV_CIDADE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Cidade', $ant->IMB_IMV_CIDADE ,  $request->IMB_IMV_CIDADE );

            if( $ant->IMB_IMV_ESTADO  <> $request->IMB_IMV_ESTADO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Estado', $ant->IMB_IMV_ESTADO ,  $request->IMB_IMV_ESTADO );

            if( $ant->IMB_IMV_SUIHID  <> $request->IMB_IMV_SUIHID  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Suite com Hidromassagem', $ant->IMB_IMV_SUIHID ,  $request->IMB_IMV_SUIHID );

            if( $ant->IMB_IMV_SUIBOX  <> $request->IMB_IMV_SUIBOX  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Suíte com Box', $ant->IMB_IMV_SUIBOX ,  $request->IMB_IMV_SUIBOX );

            if( $ant->IMB_IMV_WEBIMOVEL  <> $request->IMB_IMV_WEBIMOVEL  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Imóvel no Site', $ant->IMB_IMV_WEBIMOVEL ,  $request->IMB_IMV_WEBIMOVEL );

            if( $ant->IMB_IMV_WEBOBS  <> $request->IMB_IMV_WEBOBS  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Observações na Internet', $ant->IMB_IMV_WEBOBS,  $request->IMB_IMV_WEBOBS );

            if( $ant->IMB_IMV_CPFLINSCRICAO  <> $request->IMB_IMV_CPFLINSCRICAO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Matrícula Energia Elétrica', $ant->IMB_IMV_CPFLINSCRICAO ,  $request->IMB_IMV_CPFLINSCRICAO );

            if( $ant->IMB_IMV_CPFLSENHA  <> $request->IMB_IMV_CPFLSENHA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Senha Energia Elétrica', $ant->IMB_IMV_CPFLSENHA ,  $request->IMB_IMV_CPFLSENHA );

            if( $ant->IMB_IMV_DAEINSCRICAO  <> $request->IMB_IMV_DAEINSCRICAO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Matrícula Agua e Esgoto', $ant->IMB_IMV_DAEINSCRICAO ,  $request->IMB_IMV_DAEINSCRICAO );

            if( $ant->IMB_IMV_VALORIPTU  <> $request->IMB_IMV_VALORIPTU  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Valor IPTU', $ant->IMB_IMV_VALORIPTU ,  $request->IMB_IMV_VALORIPTU );

            if( $ant->IMB_IMV_ESCLUSIVO  <> $request->IMB_IMV_ESCLUSIVO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Exclusividade', $ant->IMB_IMV_ESCLUSIVO ,  $request->IMB_IMV_ESCLUSIVO );

            if( $ant->IMB_IMV_ANOCONSTRUCAO  <> $request->IMB_IMV_ANOCONSTRUCAO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Ano Construção', $ant->IMB_IMV_ANOCONSTRUCAO ,  $request->IMB_IMV_ANOCONSTRUCAO );

            if( $ant->IMB_IMV_TITULO  <> $request->IMB_IMV_TITULO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Título do Imóvel', $ant->IMB_IMV_TITULO ,  $request->IMB_IMV_TITULO );

            if( $ant->IMB_IMV_LINKVIDEO <> $request->IMB_IMV_LINKVIDEO )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Link do Vídeo', $ant->IMB_IMV_LINKVIDEO,  $request->IMB_IMV_LINKVIDEO);

            if( $ant->IMB_IMV_HABITESE  <> $request->IMB_IMV_HABITESE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Habite-se', $ant->IMB_IMV_HABITESE ,  $request->IMB_IMV_HABITESE );


/*            if( $ant->IMB_IMV_DATAAVALIACAO  <> $request->IMB_IMV_DATAAVALIACAO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Data Avaliação', $ant->IMB_IMV_DATAAVALIACAO ,  $request->IMB_IMV_DATAAVALIACAO );

            if( $ant->IMB_IMV_DATAAUTORIZACAO <> $request->IMB_IMV_DATAAUTORIZACAO )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Data Autorização', $ant->IMB_IMV_DATAAUTORIZACAO,  $request->IMB_IMV_DATAAUTORIZACAO);
*/
            if( $ant->IMB_IMV_QUITADO  <> $request->IMB_IMV_QUITADO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Quitado', $ant->IMB_IMV_QUITADO ,  $request->IMB_IMV_QUITADO );

/*            if( $ant->IMB_IMV_ANDARES <> $request->IMB_IMV_ANDARES )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Andares', $ant->IMB_IMV_ANDARES,  $request->IMB_IMV_ANDARES);
*/
            if( $ant->IMB_IMV_UNIDADEANDARES  <> $request->IMB_IMV_UNIDADEANDARES  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Unidades por Andar', $ant->IMB_IMV_UNIDADEANDARES ,  $request->IMB_IMV_UNIDADEANDARES );

/*            if( $ant->IMB_IMV_PINTURANOVA  <> $request->IMB_IMV_PINTURANOVA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Pintura Nova', $ant->IMB_IMV_PINTURANOVA ,  $request->IMB_IMV_PINTURANOVA );
*/
            if( $ant->IMB_IMV_PONTOSFORTES <> $request->IMB_IMV_PONTOSFORTES )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Pontos Fortes', $ant->IMB_IMV_PONTOSFORTES,  $request->IMB_IMV_PONTOSFORTES);

            /*if( $ant->IMB_IMV_MOBILIADO  <> $request->IMB_IMV_MOBILIADO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Mobiliado', $ant->IMB_IMV_MOBILIADO ,  $request->IMB_IMV_MOBILIADO );
*/
            if( $ant->IMB_IMV_FINALIDADE  <> $request->IMB_IMV_FINALIDADE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Finalidade', $ant->IMB_IMV_FINALIDADE ,  $request->IMB_IMV_FINALIDADE );

            if( $ant->IMB_IMV_DORAC  <> $request->IMB_IMV_DORAC  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AC nos Dormitórios', $ant->IMB_IMV_DORAC ,  $request->IMB_IMV_DORAC );

            if( $ant->IMB_IMV_SUIAC  <> $request->IMB_IMV_SUIAC  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AC na Suíte', $ant->IMB_IMV_SUIAC ,  $request->IMB_IMV_SUIAC );

            if( $ant->IMB_IMV_LIVING  <> $request->IMB_IMV_LIVING  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Living', $ant->IMB_IMV_LIVING ,  $request->IMB_IMV_LIVING );

            if( $ant->IMB_IMV_AGUAQUENTE  <> $request->IMB_IMV_AGUAQUENTE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Agua Quente', $ant->IMB_IMV_AGUAQUENTE ,  $request->IMB_IMV_AGUAQUENTE );

  /*          if( $ant->IMB_IMV_ARCENTRAL  <> $request->IMB_IMV_ARCENTRAL  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Ar Central', $ant->IMB_IMV_ARCENTRAL ,  $request->IMB_IMV_ARCENTRAL );
*/
            if( $ant->IMB_IMV_LAREIRA  <> $request->IMB_IMV_LAREIRA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Lareira', $ant->IMB_IMV_LAREIRA ,  $request->IMB_IMV_LAREIRA );

            if( $ant->IMB_IMV_SACADA  <> $request->IMB_IMV_SACADA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Sauna', $ant->IMB_IMV_SACADA ,  $request->IMB_IMV_SACADA );

/*            if( $ant->IMB_IMV_TERRACO  <> $request->IMB_IMV_TERRACO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Terraço', $ant->IMB_IMV_TERRACO ,  $request->IMB_IMV_TERRACO );
*/
            if( $ant->IMB_IMV_DESTAQUE  <> $request->IMB_IMV_DESTAQUE)
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Destaque', $ant->IMB_IMV_DESTAQUE ,  $request->IMB_IMV_DESTAQUE );

            if( $ant->VIS_STA_ID <> $request->VIS_STA_ID )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'OBSEVA', $this->status($ant->VIS_STA_ID),  $this->status($request->VIS_STA_ID) );

            if( $ant->imb_imv_varandagourmet  <> $request->imb_imv_varandagourmet  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Varanda Gourmet', $ant->imb_imv_varandagourmet ,  $request->imb_imv_varandagourmet );

            if( $ant->IMB_IMV_ANDAR <> $request->IMB_IMV_ANDAR )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Andar', $ant->IMB_IMV_ANDAR,  $request->IMB_IMV_ANDAR);

            if( $ant->IMB_IMV_ARECON  <> $request->IMB_IMV_ARECON  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Área Construída', $ant->IMB_IMV_ARECON ,  $request->IMB_IMV_ARECON );

            if( $ant->IMB_IMV_AREUTI  <> $request->IMB_IMV_AREUTI  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Área Útil', $ant->IMB_IMV_AREUTI ,  $request->IMB_IMV_AREUTI );

            if( $ant->IMB_IMV_ARETOT  <> $request->IMB_IMV_ARETOT  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Área Total', $ant->IMB_IMV_ARETOT ,  $request->IMB_IMV_ARETOT );

            if( $ant->IMB_IMV_SUPERDESTAQUE  <> $request->IMB_IMV_SUPERDESTAQUE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Super Destaque', $ant->IMB_IMV_SUPERDESTAQUE ,  $request->IMB_IMV_SUPERDESTAQUE );

            if( $ant->IMB_IMV_CONDICOESCOMERCIAIS  <> $request->IMB_IMV_CONDICOESCOMERCIAIS  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Condições Comerciais', $ant->IMB_IMV_CONDICOESCOMERCIAIS ,  $request->IMB_IMV_CONDICOESCOMERCIAIS );

/*            if( $ant->IMB_IMV_BAIRROCOMERCIAL  <> $request->IMB_IMV_BAIRROCOMERCIAL  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Bairro Comercial', $ant->IMB_IMV_BAIRROCOMERCIAL ,  $request->IMB_IMV_BAIRROCOMERCIAL );
*/
            if( $ant->IMB_IMV_LATITUDE  <> $request->IMB_IMV_LATITUDE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Latitude', $ant->IMB_IMV_LATITUDE ,  $request->IMB_IMV_LATITUDE );

            if( $ant->IMB_IMV_LONGITUDE  <> $request->IMB_IMV_LONGITUDE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Longitude', $ant->IMB_IMV_LONGITUDE ,  $request->IMB_IMV_LONGITUDE );

            if( $ant->IMB_IMV_DOCUMENTACAO  <> $request->IMB_IMV_DOCUMENTACAO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Documentação', $ant->IMB_IMV_DOCUMENTACAO ,  $request->IMB_IMV_DOCUMENTACAO );

            if( $ant->IMB_IMV_SUPERDESTAQUE  <> $request->IMB_IMV_SUPERDESTAQUE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Super Destaque', $ant->IMB_IMV_SUPERDESTAQUE ,  $request->IMB_IMV_SUPERDESTAQUE );

            if( $ant->IMB_IMV_DATASOLPLACA  <> $request->IMB_IMV_DATASOLPLACA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Data Solicitação de Placa', $ant->IMB_IMV_DATASOLPLACA ,  $request->IMB_IMV_DATASOLPLACA );

            if( $ant->IMB_IMV_DATACOLPLACA  <> $request->IMB_IMV_DATACOLPLACA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Data Locação de Placa', $ant->IMB_IMV_DATACOLPLACA ,  $request->IMB_IMV_DATACOLPLACA );

            if( $ant->IMB_IMV_DATARETPLACA  <> $request->IMB_IMV_DATARETPLACA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Data Retirada Placa', $ant->IMB_IMV_DATARETPLACA ,  $request->IMB_IMV_DATARETPLACA );

            if( $ant->IMB_IMV_PLACATIPO <> $request->IMB_IMV_PLACATIPO )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Tipo de Placa', $ant->IMB_IMV_PLACATIPO,  $request->IMB_IMV_PLACATIPO);

            if( $ant->IMB_IMV_HECTARES  <> $request->IMB_IMV_HECTARES  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Hectares', $ant->IMB_IMV_HECTARES ,  $request->IMB_IMV_HECTARES );

            if( $ant->IMB_IMV_ALQPAU  <> $request->IMB_IMV_ALQPAU  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Alqueira Paulista', $ant->IMB_IMV_ALQPAU ,  $request->IMB_IMV_ALQPAU );

            if( $ant->IMB_IMV_ALQMIN  <> $request->IMB_IMV_ALQMIN  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Alqueira Mineiro', $ant->IMB_IMV_ALQMIN ,  $request->IMB_IMV_ALQMIN );

            if( $ant->IMB_IMV_ALQGOI  <> $request->IMB_IMV_ALQGOI  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Alqueire Goiano', $ant->IMB_IMV_ALQGOI ,  $request->IMB_IMV_ALQGOI );

            if( $ant->IMB_IMV_ALQNOR  <> $request->IMB_IMV_ALQNOR  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Alqueire Norte', $ant->IMB_IMV_ALQNOR ,  $request->IMB_IMV_ALQNOR );

            if( $ant->IMB_IMV_AECORREDOR  <> $request->IMB_IMV_AECORREDOR  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Corredor', $ant->IMB_IMV_AECORREDOR ,  $request->IMB_IMV_AECORREDOR );

            if( $ant->IMB_IMV_AEWC  <> $request->IMB_IMV_AEWC  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE WC', $ant->IMB_IMV_AEWC ,  $request->IMB_IMV_AEWC );

            if( $ant->IMB_IMV_AECLOSET  <> $request->IMB_IMV_AECLOSET  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Closet', $ant->IMB_IMV_AECLOSET ,  $request->IMB_IMV_AECLOSET );

            if( $ant->IMB_IMV_AESALA  <> $request->IMB_IMV_AESALA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Sala ', $ant->IMB_IMV_AESALA ,  $request->IMB_IMV_AESALA );

            if( $ant->IMB_IMV_AEESCRITORIO  <> $request->IMB_IMV_AEESCRITORIO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'AE Escritório', $ant->IMB_IMV_AEESCRITORIO ,  $request->IMB_IMV_AEESCRITORIO );

            if( $ant->IMB_IMV_VARANDA  <> $request->IMB_IMV_VARANDA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Varanda', $ant->IMB_IMV_VARANDA ,  $request->IMB_IMV_VARANDA );

            if( $ant->IMB_IMV_PISOAQUECIDO  <> $request->IMB_IMV_PISOAQUECIDO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Aquecido', $ant->IMB_IMV_PISOAQUECIDO ,  $request->IMB_IMV_PISOAQUECIDO );

            if( $ant->IMB_IMV_PISOARDOSIA  <> $request->IMB_IMV_PISOARDOSIA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Ardósia', $ant->IMB_IMV_PISOARDOSIA ,  $request->IMB_IMV_PISOARDOSIA );

            if( $ant->IMB_IMV_PISOBLOQUETE  <> $request->IMB_IMV_PISOBLOQUETE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Bloquete', $ant->IMB_IMV_PISOBLOQUETE ,  $request->IMB_IMV_PISOBLOQUETE );

            if( $ant->IMB_IMV_PISOCARPETEMADEIRA  <> $request->IMB_IMV_PISOCARPETEMADEIRA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Carpete Madeira', $ant->IMB_IMV_PISOCARPETEMADEIRA ,  $request->IMB_IMV_PISOCARPETEMADEIRA );

            if( $ant->IMB_IMV_PISOCARPETE  <> $request->IMB_IMV_PISOCARPETE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Carpete', $ant->IMB_IMV_PISOCARPETE ,  $request->IMB_IMV_PISOCARPETE );

            if( $ant->IMB_IMV_PISOCARPETEACRIL  <> $request->IMB_IMV_PISOCARPETEACRIL  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Carpete Acrilico', $ant->IMB_IMV_PISOCARPETEACRIL ,  $request->IMB_IMV_PISOCARPETEACRIL );

            if( $ant->IMB_IMV_PISOCERAMICA  <> $request->IMB_IMV_PISOCERAMICA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Cerâmica', $ant->IMB_IMV_PISOCERAMICA ,  $request->IMB_IMV_PISOCERAMICA );

            if( $ant->IMB_IMV_PISOCIMENTO  <> $request->IMB_IMV_PISOCIMENTO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Cimento', $ant->IMB_IMV_PISOCIMENTO ,  $request->IMB_IMV_PISOCIMENTO );

            if( $ant->IMB_IMV_PISOCONTRAPISO  <> $request->IMB_IMV_PISOCONTRAPISO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Contrapiso', $ant->IMB_IMV_PISOCONTRAPISO ,  $request->IMB_IMV_PISOCONTRAPISO );

            if( $ant->IMB_IMV_PISOEMBORRACHADO  <> $request->IMB_IMV_PISOEMBORRACHADO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Emborrachado', $ant->IMB_IMV_PISOEMBORRACHADO ,  $request->IMB_IMV_PISOEMBORRACHADO );

            if( $ant->IMB_IMV_PISOGRANITO  <> $request->IMB_IMV_PISOGRANITO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Granito', $ant->IMB_IMV_PISOGRANITO ,  $request->IMB_IMV_PISOGRANITO );

            if( $ant->IMB_IMV_PISOMARMORE  <> $request->IMB_IMV_PISOMARMORE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Mármore', $ant->IMB_IMV_PISOMARMORE ,  $request->IMB_IMV_PISOMARMORE );

            if( $ant->IMB_IMV_PISOLAMINADO  <> $request->IMB_IMV_PISOLAMINADO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Lâminado', $ant->IMB_IMV_PISOLAMINADO ,  $request->IMB_IMV_PISOLAMINADO );

            if( $ant->IMB_IMV_PISOTABUA  <> $request->IMB_IMV_PISOTABUA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Tábua', $ant->IMB_IMV_PISOTABUA ,  $request->IMB_IMV_PISOTABUA );

            if( $ant->IMB_IMV_PISOTACOMADEIRA  <> $request->IMB_IMV_PISOTACOMADEIRA  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Taco Madeira', $ant->IMB_IMV_PISOTACOMADEIRA ,  $request->IMB_IMV_PISOTACOMADEIRA );

            if( $ant->IMB_IMV_PISOVINICULO  <> $request->IMB_IMV_PISOVINICULO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Vinil', $ant->IMB_IMV_PISOVINICULO ,  $request->IMB_IMV_PISOVINICULO );

            if( $ant->IMB_IMV_PISOCARPETENYLON  <> $request->IMB_IMV_PISOCARPETENYLON  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Carpete Nylon', $ant->IMB_IMV_PISOCARPETENYLON ,  $request->IMB_IMV_PISOCARPETENYLON );

            if( $ant->IMB_IMV_MANTERSITE  <> $request->IMB_IMV_MANTERSITE  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Manter no Site', $ant->IMB_IMV_MANTERSITE ,  $request->IMB_IMV_MANTERSITE );

            if( $ant->IMB_IMV_PISOPORCELANATO  <> $request->IMB_IMV_PISOPORCELANATO  )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Piso Porcelanato', $ant->IMB_IMV_PISOPORCELANATO ,  $request->IMB_IMV_PISOPORCELANATO );

            if( $ant->IMB_ATD_IDCHAVE   <> $request->IMB_ATD_IDCHAVE   )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'Corretor com Chave', $this->atendente($ant->IMB_ATD_IDCHAVE ) ,  $this->atendente($request->IMB_ATD_IDCHAVE ) );

            if( $ant->IMB_IMV_QUADROCHAVES   <> $request->IMB_IMV_QUADROCHAVES   )
            $this->gravarHistorico( $imovel, 'IMOVEL', 'portal www.quadrochaves.com.br',$ant->IMB_IMV_QUADROCHAVES  ,  $request->IMB_IMV_QUADROCHAVES   );

        return response()->json('ok',200);

    }



    public function gravarHistorico( $imovel, $codigo, $campo, $anterior, $atual )
    {


        $his = new mdlHistoricoImovel;

        $his->IMB_IMV_ID = $imovel;
        $his->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $his->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $his->IMB_IMH_IDALTERACAO = Auth::user()->IMB_ATD_ID;
        $his->IMB_IMH_DTHALTERACAO = date('Y-m-d H:i:s');
        $his->IMB_GRT_CODIGO = $codigo;
        $his->IMB_IMH_CAMPO = $campo;
        $his->IMB_IMH_VALORANTERIOR = $anterior;
        $his->IMB_IMH_VALORATUAL =  $atual;
        $his->save();

    }

    public function condominio( $id )
    {
        $con = mdlCondominio::find( $id );
        if( $con )
            return $con->IMB_CND_NOME;
        else
        return '';
    }

    public function status( $id )
    {
        $con = mdlStatusImovel::find( $id );
        if( $con )
            return $con->VIS_STA_NOME;
        else
        return '';
    }

    public function atendente( $id )
    {
        $con = mdlAtendente::find( $id );
        if( $con )
            return $con->IMB_ATD_NOME;
        else
        return '';
    }


    public function dadosMinimos(Request $request)
    {


        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                DB::raw('( SELECT PEGACAPIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECAPTADOR'),
                DB::raw('( SELECT PEGACORIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECORRETOR'),
                DB::raw('( SELECT IMB_IMB_NOME
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS UNIDADE'),
                    DB::raw('( SELECT IMB_ATD_NOME
                        FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_ID =
                        IMB_ATENDENTE.IMB_ATD_ID) AS CADASTRADOPOR'),
                    DB::raw('( SELECT IMB_ATD_NOME
                        FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_IDALTERACAO =
                        IMB_ATENDENTE.IMB_ATD_ID) AS ALTERADOPOR'),

                    DB::raw('( SELECT IMB_IMB_URLIMOVELSITE
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS URLIMOVELSITE'),
                        DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                        DB::raw('( SELECT VIS_STA_NOME
                        FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                        VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_NOME'),
                        DB::raw('( SELECT VIS_STA_SITUACAO
                        FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                        VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_SITUACAO'),
                DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                 COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                 COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                 COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                'IMB_IMOVEIS.CEP_BAI_NOME',
                'IMB_IMOVEIS.IMB_IMV_CIDADE',
                'IMB_IMOVEIS.IMB_TIM_ID',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_DORAE',
                'IMB_IMOVEIS.IMB_IMV_ARECON',
                'IMB_IMOVEIS.IMB_IMV_AREUTI',
                'IMB_IMOVEIS.IMB_IMV_MEDTER',
                'IMB_IMOVEIS.IMB_IMV_PISCIN',
                'IMB_IMOVEIS.IMB_IMV_CHURRA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMV_TITULO',
                'IMB_IMOVEIS.VIS_STA_ID',
                'IMB_IMOVEIS.IMB_IMV_ENDERECOCEP',
                'IMB_IMV_DATAATUALIZACAO',
                'IMB_IMV_DATACADASTRO',
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMV_OBSWEB',
                'IMB_IMV_CHABOX',
                'IMB_IMV_CHAVES',
                'IMB_CLIENTE.IMB_CLT_NOME',
                DB::Raw(' CASE
                        WHEN EXISTS( SELECT IMB_CCH_ID FROM IMB_CONTROLECHAVE
                        WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) THEN "Em Visita/Manutenção"
                        ELSE ""
                        END AS SITUACAOCHAVE'),
                DB::Raw('( SELECT IMB_CCH_DTHDEVOLUCAOESPERADA FROM IMB_CONTROLECHAVE
                        WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) AS IMB_CCH_DTHDEVOLUCAOESPERADA'),

                DB::raw('( SELECT COALESCE(IMB_IMG_ARQUIVO,"logo.jpg")
                FROM IMB_IMAGEM WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_IMAGEM.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMAGEM'),
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')

            ])
            ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID');

         $cFiltrou = 'S';

         $pesquisagenerica = $request->pesquisagenerica;
         if( $pesquisagenerica <> '' )
         {
            $cFiltrou = 'S';
            $imoveis = $imoveis->whereRaw(DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                              COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                              COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                              COALESCE( IMB_IMV_NUMAPT,'') ) LIKE  '%{$pesquisagenerica}%'
                              or IMB_IMOVEIS.IMB_IMV_REFERE LIKE '%{$pesquisagenerica}%'
                              or IMB_IMOVEIS.CEP_BAI_NOME LIKE '%{$pesquisagenerica}%' "));
         }

         $imoveis = $imoveis->get();

         return $imoveis;

    }


    public function indexDadosMinimos()
    {

        return view('imovel.indeximoveissimples');
    }

    public function relImovelProprietario( Request $request )
    {
        return view('reports.imovel.imovelcomproprietario' );


    }

    public function getImovelProprietario( Request $request )
    {
        $situacao = $request->situacao;
        $ordem = $request->ordem;



        $imv = mdlImovel::select(
            [
                'IMB_IMV_REFERE',
                'IMB_IMV_ID',
                DB::raw( 'imovel( IMB_IMOVEIS.IMB_IMV_ID ) as endereco'),
                'IMB_CLT_NOME',
                DB::raw( '( select IMB_CND_NOME FROM IMB_CONDOMINIO WHERE IMB_CONDOMINIO.IMB_CND_ID = IMB_IMOVEIS.IMB_CND_ID) AS IMB_CND_NOME'),
                DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as telefones'),
                'VIS_STA_SITUACAO',
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')

            ]
        )
        ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->whereRaw( "coalesce( IMB_IMV_ENDERECO,'')<>'' ")
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID')
        ->leftJoin('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', 'IMB_IMOVEIS.VIS_STA_ID');

        if( $situacao == 'A')
        {
            $imv = $imv->whereRaw("coalesce(VIS_STA_SITUACAO,'A') <> 'I' ");
        }


        $imv = $imv->orderBy( "$ordem" )->get();

        return $imv;


    }



    public function relGeralImoveis( Request $request )
    {
        return view('reports.imovel.geraldeimoveis' );

    }

    public function getGeralImoveis( Request $request )
    {
        $situacao = $request->situacao;
        $situacao_net = $request->situacao;
        $origem = $request->origem;
       
        $ordem = $request->ordem;

        $imv = mdlImovel::select(
            [
                'IMB_IMV_REFERE',
                'IMB_IMV_WEBIMOVEL',
                'IMB_IMV_DESTAQUE',
                'IMB_IMV_ID',
                'IMB_IMV_REFERE',
                DB::raw( 'imovel( IMB_IMOVEIS.IMB_IMV_ID ) as endereco'),
                'IMB_CLT_NOME',
                DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as telefones'),
                'VIS_STA_SITUACAO',
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO'),
                'IMB_IMOVEIS.VIS_STA_ID'
            ]
        )
        ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID')
        ->leftJoin('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', 'IMB_IMOVEIS.VIS_STA_ID');

        if( $situacao == 'A')
        {
            $imv = $imv->where('VIS_STA_SITUACAO','=','A');
        }
        if( $situacao_net == 'S')
        {
            $imv = $imv->where('IMB_IMV_WEBIMOVEL','=','S');
        }
        if( $situacao_net == 'N')
        {
            $imv = $imv->where('IMB_IMV_WEBIMOVEL','<>','S');
        }

        if( $situacao == 'I')
        {
            $imv = $imv->where('VIS_STA_SITUACAO','=','I');
        }


        $imv = $imv->orderBy( "$ordem" )->get();

        if( $origem == 'RELATORIO' )
            return view( 'reports.imovel.relgeralimoveis', compact('imv') );


        return $imv;


    }


    public function imoveisIncricoes( Request $request )
    {

        $ordem    =  $request->ordem;
        $situacao    = $request->situacao;

        $imoveis = mdlImovel::select(
              [
                  'IMB_IMOVEIS.IMB_IMV_ID',
                  DB::raw( 'imovel( IMB_IMV_ID ) AS ENDERECO'),
                  DB::raw( 'PEGALOCADORPRINCIPALIMV( IMB_IMV_ID ) AS PROPRIETARIO'),
                  DB::raw( 'PEGACPFLOCADORPRINCIPALIMV( IMB_IMV_ID ) AS CPF'),
                  'IMB_IMV_CPFLINSCRICAO',
                  'IMB_IMV_DAEINSCRICAO',
                  'IMB_IMV_DAESENHA',
                  'IMB_IMV_IPTU1',
                  'IMB_IMV_IPTU2',
                  'IMB_IMV_IPTU3',
                  'IMB_IMV_IPTU4',
                  'VIS_STA_SITUACAO',
                  DB::raw( 'CASE 
                            WHEN exists( select IMB_CTR_ID FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID AND IMB_CTR_SITUACAO = "ATIVO" ) THEN "ALUGADO" 
                            ELSE "" END SITUACAO')
              ]
        )->where('IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->whereRaw( 'exists( select IMB_CTR_ID FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID)')
        ->leftJoin('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', 'IMB_IMOVEIS.VIS_STA_ID');

        if( $situacao == 'A')
            $imoveis = $imoveis->whereRaw('exists( select IMB_CTR_ID FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID AND IMB_CTR_SITUACAO = "ATIVO" )');

        $imoveis = $imoveis ->orderBy( "$ordem" );

        $imoveis = $imoveis->get();


        return $imoveis;

    }

    public function imoveisPessoas( $idpessoa, $tipo )
    {
        if( $tipo == 'LT')
        {

            $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                'CEP_BAI_NOME',
                DB::raw('( SELECT IMB_IMB_NOME
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS UNIDADE'),
                DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                    FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                    IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                DB::raw('( SELECT VIS_STA_SITUACAO
                    FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                    VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_SITUACAO'),
                DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                    COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                    COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                    COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                    WHERE IMB_IMOVEIS.IMB_TIM_ID =
                    IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO'),
                DB::raw("( select IMB_CONTRATO.IMB_CTR_ID FROM IMB_LOCATARIOCONTRATO, IMB_CONTRATO
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID = $idpessoa
                    AND IMB_CONTRATO.IMB_CTR_ID = IMB_LOCATARIOCONTRATO.IMB_CTR_ID
                    AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID) AS IMB_CTR_ID"),
                DB::raw("( select IMB_CTR_SITUACAO FROM IMB_LOCATARIOCONTRATO, IMB_CONTRATO
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID = $idpessoa
                    AND IMB_CONTRATO.IMB_CTR_ID = IMB_LOCATARIOCONTRATO.IMB_CTR_ID
                    AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID) AS IMB_CTR_SITUACAO"),
                DB::raw("( select IMB_CTR_REFERENCIA FROM IMB_LOCATARIOCONTRATO, IMB_CONTRATO
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID = $idpessoa
                    AND IMB_CONTRATO.IMB_CTR_ID = IMB_LOCATARIOCONTRATO.IMB_CTR_ID
                    AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID) as IMB_CTR_REFERENCIA")

            ])
            ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
            ->whereRaw( "exists( select IMB_LOCATARIOCONTRATO.IMB_CTR_ID FROM IMB_LOCATARIOCONTRATO, IMB_CONTRATO
                WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID = $idpessoa
                AND IMB_CONTRATO.IMB_CTR_ID = IMB_LOCATARIOCONTRATO.IMB_CTR_ID
                AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID)");
        };

    if( $tipo == 'FD')
    {
        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                'CEP_BAI_NOME',
                DB::raw('( SELECT IMB_IMB_NOME
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS UNIDADE'),
                DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                    FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                    IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                DB::raw('( SELECT VIS_STA_SITUACAO
                    FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                    VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_SITUACAO'),
                DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                    COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                    COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                    COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                    WHERE IMB_IMOVEIS.IMB_TIM_ID =
                    IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO'),
                DB::raw("( select IMB_CONTRATO.IMB_CTR_ID FROM IMB_FIADORCONTRATO, IMB_CONTRATO
                    WHERE IMB_FIADORCONTRATO.IMB_CLT_ID = $idpessoa
                    AND IMB_CONTRATO.IMB_CTR_ID = IMB_FIADORCONTRATO.IMB_CTR_ID
                    AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID) AS IMB_CTR_ID"),
                DB::raw("( select IMB_CTR_SITUACAO FROM IMB_FIADORCONTRATO, IMB_CONTRATO
                    WHERE IMB_FIADORCONTRATO.IMB_CLT_ID = $idpessoa
                    AND IMB_CONTRATO.IMB_CTR_ID = IMB_FIADORCONTRATO.IMB_CTR_ID
                    AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID) AS IMB_CTR_SITUACAO"),
                DB::raw("( select IMB_CTR_REFERENCIA FROM IMB_FIADORCONTRATO, IMB_CONTRATO
                    WHERE IMB_FIADORCONTRATO.IMB_CLT_ID = $idpessoa
                    AND IMB_CONTRATO.IMB_CTR_ID = IMB_FIADORCONTRATO.IMB_CTR_ID
                    AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID) as IMB_CTR_REFERENCIA")

            ])
            ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
            ->whereRaw( "exists( select IMB_FIADORCONTRATO.IMB_CTR_ID FROM IMB_FIADORCONTRATO, IMB_CONTRATO
                WHERE IMB_FIADORCONTRATO.IMB_CLT_ID = $idpessoa
                AND IMB_CONTRATO.IMB_CTR_ID = IMB_FIADORCONTRATO.IMB_CTR_ID
                AND IMB_CONTRATO.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID)");
    };

    //return $imoveis->toSql();
    $imoveis = $imoveis->get();
    return response()->json( $imoveis, 200 );

    }

    public function clonar( $id )
    {

        $old = mdlImovel::find( $id );

        $ntipoimovel                        = $old->IMB_TIM_ID;
        $tipoimovel                         = mdlTipoImovel::find( $ntipoimovel);
        $sub=$tipoimovel->imb_tim_prefixo   ;
        $referencia = collect( DB::select("select NovaReferencia('$sub') as ref "))->first()->ref;


        $imv = new mdlImovel();
        $imv->IMB_IMB_ID                    = $old->IMB_IMB_ID                   ;
        $imv->IMB_IMB_ID2                   = $old->IMB_IMB_ID2                  ;
        $imv->IMB_IMV_WEBIMOVEL             = $old->IMB_IMV_WEBIMOVEL            ;
        $imv->IMB_IMV_DESTAQUE              = $old->IMB_IMV_DESTAQUE             ;
        $imv->IMB_IMV_WEBLANCAMENTO         = $old->IMB_IMV_WEBLANCAMENTO        ;
        $imv->IMB_IMV_ESCLUSIVO             = $old->IMB_IMV_ESCLUSIVO            ;
        $imv->IMB_IMV_PLACA                 = $old->IMB_IMV_PLACA                ;
        $imv->imb_imv_terrea                = $old->imb_imv_terrea               ;
        $imv->IMB_IMV_PERMUTA               = $old->IMB_IMV_PERMUTA              ;
        $imv->IMB_IMV_ESCRIT                = $old->IMB_IMV_ESCRIT               ;
        $imv->IMB_IMV_SOBRADO               = $old->IMB_IMV_SOBRADO              ;
        $imv->IMB_IMV_ASSOBRADADA           = $old->IMB_IMV_ASSOBRADADA          ;
        $imv->IMB_IMV_SACADA                = $old->IMB_IMV_SACADA               ;
        $imv->IMB_IMV_ELEVADORES            = $old->IMB_IMV_ELEVADORES           ;
        $imv->IMB_IMV_ACEITAFINANC          = $old->IMB_IMV_ACEITAFINANC         ;
        $imv->IMB_IMV_COZINHA               = $old->IMB_IMV_COZINHA              ;
        $imv->IMB_IMV_COZPLA                = $old->IMB_IMV_COZPLA               ;
        $imv->IMB_IMV_EMPQUA                = $old->IMB_IMV_EMPQUA               ;
        $imv->IMB_IMV_LAVABO                = $old->IMB_IMV_LAVABO               ;
        $imv->IMB_IMV_EMPWC                 = $old->IMB_IMV_EMPWC                ;
        $imv->IMB_IMV_DESPENSA              = $old->IMB_IMV_DESPENSA             ;
        $imv->IMB_IMV_PISCIN                = $old->IMB_IMV_PISCIN               ;
        $imv->IMB_IMV_COZINHA               = $old->IMB_IMV_COZINHA              ;
        $imv->IMB_IMV_EDICUL                = $old->IMB_IMV_EDICUL               ;
        $imv->IMB_IMV_QUINTA                = $old->IMB_IMV_QUINTA               ;
        $imv->IMB_IMV_CHURRA                = $old->IMB_IMV_CHURRA               ;
        $imv->IMB_IMV_PORELE                = $old->IMB_IMV_PORELE               ;
        $imv->IMB_IMV_SALFES                = $old->IMB_IMV_SALFES               ;
        $imv->IMB_IMV_SAUNA                 = $old->IMB_IMV_SAUNA                ;
        $imv->IMB_IMV_QUADRAPOLIESPORTIVA   = $old->IMB_IMV_QUADRAPOLIESPORTIVA  ;
        $imv->IMB_IMV_PLAGRO                = $old->IMB_IMV_PLAGRO               ;
        $imv->IMB_IMV_DORAE                 = $old->IMB_IMV_DORAE                ;
        $imv->IMB_IMV_SUIHID                = $old->IMB_IMV_SUIHID               ;
        $imv->IMB_IMV_DORCLO                = $old->IMB_IMV_DORCLO               ;
        $imv->IMB_TIM_ID                    = $old->IMB_TIM_ID                   ;
        $imv->IMB_CLT_ID                    = $old->IMB_CLT_ID                   ;
        $imv->IMB_IMV_REFERE                = $referencia               ;
        $imv->IMB_IMV_VALVEN                = $old->IMB_IMV_VALVEN               ;
        $imv->IMB_IMV_VALLOC                = $old->IMB_IMV_VALLOC               ;
        $imv->IMB_IMV_ENDERECOTIPO          = $old->IMB_IMV_ENDERECOTIPO         ;
        $imv->IMB_IMV_ENDERECONUMERO        = $old->IMB_IMV_ENDERECONUMERO       ;
        $imv->IMB_IMV_ENDERECO              = $old->IMB_IMV_ENDERECO             ;
        $imv->IMB_IMV_NUMAPT                = $old->IMB_IMV_NUMAPT               ;
        $imv->IMB_IMV_ENDERECOCOMPLEMENTO   = $old->IMB_IMV_ENDERECOCOMPLEMENTO  ;
        $imv->IMB_CND_ID                    = $old->IMB_CND_ID                   ;
        $imv->IMB_IMV_PREDIO                = $old->IMB_IMV_PREDIO               ;
        $imv->IMB_IMV_ANDAR                 = $old->IMB_IMV_ANDAR                ;
        $imv->CEP_BAI_NOME                  = $old->CEP_BAI_NOME                 ;
        $imv->IMB_IMV_WCQUA                 = $old->IMB_IMV_WCQUA                ;
        $imv->IMB_IMV_ENDERECOCEP           = $old->IMB_IMV_ENDERECOCEP          ;
        $imv->IMB_IMV_QUADRA                = $old->IMB_IMV_QUADRA               ;
        $imv->IMB_IMV_LOTE                  = $old->IMB_IMV_LOTE                 ;
        $imv->IMB_IMV_CIDADE                = $old->IMB_IMV_CIDADE               ;
        $imv->IMB_IMV_ESTADO                = $old->IMB_IMV_ESTADO               ;
        $imv->IMB_IMV_PROXIMIDADE           = $old->IMB_IMV_PROXIMIDADE          ;
        $imv->IMB_IMV_MEDTER                = $old->IMB_IMV_MEDTER               ;
        $imv->IMB_IMV_ARETOT                = $old->IMB_IMV_ARETOT               ;
        $imv->IMB_IMV_ARECON                = $old->IMB_IMV_ARECON               ;
        $imv->IMB_IMV_AREUTI                = $old->IMB_IMV_AREUTI               ;
        $imv->IMB_IMV_DORQUA                = $old->IMB_IMV_DORQUA               ;
        $imv->IMB_IMV_SUIQUA                = $old->IMB_IMV_SUIQUA               ;
        $imv->IMB_IMV_SALQUA                = $old->IMB_IMV_SALQUA               ;
        $imv->IMB_IMV_SUSPENSO              = $old->IMB_IMV_SUSPENSO             ;
        $imv->IMB_IMV_GARDES                = $old->IMB_IMV_GARDES               ;
        $imv->IMB_IMV_GARCOB                = $old->IMB_IMV_GARCOB               ;
        $imv->IMB_IMV_IDADE                 = $old->IMB_IMV_IDADE                ;
        $imv->IMB_IMV_LINKVIDEO             = $old->IMB_IMV_LINKVIDEO            ;
        $imv->IMB_IMV_OBSWEB                = $old->IMB_IMV_OBSWEB               ;
        $imv->IMB_IMV_OBSERV                = $old->IMB_IMV_OBSERV               ;
        $imv->IMB_IMV_DATFIL                = $old->IMB_IMV_DATFIL               ;
        $imv->IMB_IMV_DATACADASTRO          = $old->IMB_IMV_DATACADASTRO         ;
        $imv->IMB_IMV_RADAR                 = $old->IMB_IMV_RADAR                ;
        $imv->IMB_IMV_SUPERDESTAQUE         = $old->IMB_IMV_SUPERDESTAQUE        ;
        $imv->IMB_ATD_ID                    = $old->IMB_ATD_ID                   ;
        $imv->IMB_IMV_TITULO                = $old->IMB_IMV_TITULO               ;
        $imv->imb_imv_varandagourmet        = $old->imb_imv_varandagourmet       ;
        $imv->IMB_IMV_ARESER                = $old->IMB_IMV_ARESER               ;
        $imv->IMB_IMV_ORIENTACAOSOLAR       = $old->IMB_IMV_ORIENTACAOSOLAR      ;
        $imv->IMB_IMV_POSICAO               = $old->IMB_IMV_POSICAO              ;
        $imv->IMB_IMV_ALQPAU                = $old->IMB_IMV_ALQPAU               ;
        $imv->IMB_IMV_ARESER                = $old->IMB_IMV_ARESER               ;
        $imv->IMB_IMV_ORIENTACAOSOLAR       = $old->IMB_IMV_ORIENTACAOSOLAR      ;
        $imv->IMB_IMV_ALQGOI                = $old->IMB_IMV_ALQGOI               ;
        $imv->IMB_IMV_ALQMIN                = $old->IMB_IMV_ALQMIN               ;
        $imv->IMB_IMV_ALQNOR                = $old->IMB_IMV_ALQNOR               ;
        $imv->IMB_IMV_TOPOGR                = $old->IMB_IMV_TOPOGR               ;
        $imv->IMB_IMV_IDADE                 = $old->IMB_IMV_IDADE                ;
        $imv->IMB_IMV_AECORREDOR            = $old->IMB_IMV_AECORREDOR           ;
        $imv->IMB_IMV_AECLOSET              = $old->IMB_IMV_AECLOSET             ;
        $imv->IMB_IMV_AESALA                = $old->IMB_IMV_AESALA               ;
        $imv->IMB_IMV_AEESCRITORIO          = $old->IMB_IMV_AEESCRITORIO         ;
        $imv->IMB_IMV_SALAAMOCO             = $old->IMB_IMV_SALAAMOCO            ;
        $imv->imb_imv_deposito              = $old->imb_imv_deposito             ;
        $imv->imb_imv_varandagourmet        = $old->imb_imv_varandagourmet       ;
        $imv->IMB_IMV_QUADRAPOLIESPORTIVA   = $old->IMB_IMV_QUADRAPOLIESPORTIVA  ;
        $imv->IMB_IMV_CAMFUT                = $old->IMB_IMV_CAMFUT               ;
        $imv->IMB_IMV_SALESC                = $old->IMB_IMV_SALESC               ;
        $imv->IMB_IMV_HOME                  = $old->IMB_IMV_HOME                 ;
        $imv->IMB_IMV_VARANDA               = $old->IMB_IMV_VARANDA              ;
        $imv->IMB_IMV_MURADO                = $old->IMB_IMV_MURADO               ;
        $imv->IMB_IMV_PISOAQUECIDO          = $old->IMB_IMV_PISOAQUECIDO         ;
        $imv->IMB_IMV_PISOARDOSIA           = $old->IMB_IMV_PISOARDOSIA          ;
        $imv->IMB_IMV_PISOBLOQUETE          = $old->IMB_IMV_PISOBLOQUETE         ;
        $imv->IMB_IMV_PISOCARPETE           = $old->IMB_IMV_PISOCARPETE          ;
        $imv->IMB_IMV_PISOCARPETEACRIL      = $old->IMB_IMV_PISOCARPETEACRIL     ;
        $imv->IMB_IMV_PISOCARPETEMADEIRA    = $old->IMB_IMV_PISOCARPETEMADEIRA   ;
        $imv->IMB_IMV_PISOCARPETENYLON      = $old->IMB_IMV_PISOCARPETENYLON     ;
        $imv->IMB_IMV_PISOCERAMICA          = $old->IMB_IMV_PISOCERAMICA         ;
        $imv->IMB_IMV_PISOCIMENTO           = $old->IMB_IMV_PISOCIMENTO          ;
        $imv->IMB_IMV_PISOCONTRAPISO        = $old->IMB_IMV_PISOCONTRAPISO       ;
        $imv->IMB_IMV_PISOEMBORRACHADO      = $old->IMB_IMV_PISOEMBORRACHADO     ;
        $imv->IMB_IMV_PISOGRANITO           = $old->IMB_IMV_PISOGRANITO          ;
        $imv->IMB_IMV_PISOLAMINADO          = $old->IMB_IMV_PISOLAMINADO         ;
        $imv->IMB_IMV_PISOMARMORE           = $old->IMB_IMV_PISOMARMORE          ;
        $imv->IMB_IMV_PISOLAMINADO          = $old->IMB_IMV_PISOLAMINADO         ;
        $imv->IMB_IMV_PISOTABUA             = $old->IMB_IMV_PISOTABUA            ;
        $imv->IMB_IMV_PISOTACOMADEIRA       = $old->IMB_IMV_PISOTACOMADEIRA      ;
        $imv->IMB_IMV_PISOVINICULO          = $old->IMB_IMV_PISOVINICULO         ;
        $imv->IMB_IMV_VALORIPTU             = $old->IMB_IMV_VALORIPTU            ;
        $imv->imb_imv_valorcondominio       = $old->imb_imv_valorcondominio      ;
        $imv->IMB_IMV_CHAVES                = $old->IMB_IMV_CHAVES               ;
        $imv->IMB_IMV_CHAVESSITUACAO        = $old->IMB_IMV_CHAVESSITUACAO       ;
        $imv->IMB_ATD_IDCHAVE               = $old->IMB_ATD_IDCHAVE              ;
        $imv->IMB_IMV_SUPERDESTAQUE         = $old->IMB_IMV_SUPERDESTAQUE        ;
        $imv->IMB_IMV_SALESC                = $old->IMB_IMV_SALESC               ;
        $imv->IMB_IMV_COPA                  = $old->IMB_IMV_COPA                 ;
        $imv->IMB_IMV_SUICLO                = $old->IMB_IMV_SUICLO               ;
        $imv->IMB_IMV_SALQUA                = $old->IMB_IMV_SALQUA               ;
        $imv->IMB_IMV_COZAE                 = $old->IMB_IMV_COZAE                ;
        $imv->IMB_IMV_AECORREDOR            = $old->IMB_IMV_AECORREDOR           ;
        $imv->IMB_IMV_AECLOSET              = $old->IMB_IMV_AECLOSET             ;
        $imv->IMB_IMV_AESALA                = $old->IMB_IMV_AESALA               ;
        $imv->IMB_IMV_AEESCRITORIO          = $old->IMB_IMV_AEESCRITORIO         ;
        $imv->IMB_IMV_AEWC                  = $old->IMB_IMV_AEWC                 ;
        $imv->IMB_IMV_MANTERSITE            = $old->IMB_IMV_MANTERSITE           ;
        $imv->VIS_STA_ID                    = 5                   ;
        $imv->IMB_IMV_FINALIDADE            = $old->IMB_IMV_FINALIDADE           ;
        $imv->IMB_IMV_PADRAO                = $old->IMB_IMV_PADRAO               ;
        $imv->IMB_IMV_ANOCONSTRUCAO         = $old->IMB_IMV_ANOCONSTRUCAO        ;
        $imv->IMB_IMV_CONDICOESCOMERCIAIS   = $old->IMB_IMV_CONDICOESCOMERCIAIS  ;
        $imv->IMB_IMV_PISOPORCELANATO       = $old->IMB_IMV_PISOPORCELANATO      ;
        $imv->IMB_IMV_CHABOX                = $old->IMB_IMV_CHABOX               ;
        $imv->IMB_IMV_ALARME                = $old->IMB_IMV_ALARME               ;
        $imv->IMB_IMV_ARAPARELHO            = $old->IMB_IMV_ARAPARELHO           ;
        $imv->IMB_IMV_LAREIRA               = $old->IMB_IMV_LAREIRA              ;
        $imv->IMB_IMV_SEMIMOB               = $old->IMB_IMV_SEMIMOB              ;
        $imv->IMB_IMV_INTERF                = $old->IMB_IMV_INTERF               ;
        $imv->IMB_IMV_AGUAQUENTE            = $old->IMB_IMV_AGUAQUENTE           ;
        $imv->IMB_IMV_PORTALQUADROCHAVES    = $old->IMB_IMV_PORTALQUADROCHAVES   ;
        $imv->save();

        $ppold = mdlPropImovel::where( 'IMB_IMV_ID','=', $old->IMB_IMV_ID )->get();


        foreach( $ppold as $pi )
        {

            $ppnew = new mdlPropImovel;
            $ppnew->IMB_IMB_ID              = Auth::user()->IMB_IMB_ID;
            $ppnew->IMB_ATD_ID              = Auth::user()->IMB_ATD_ID;
            $ppnew->IMB_IMV_ID              = $imv->IMB_IMV_ID;
            $ppnew->IMB_CLT_ID              = $pi->IMB_CLT_ID;
            $ppnew->IMB_IMVCLT_PERCENTUAL   = $pi->IMB_IMVCLT_PERCENTUAL;
            $ppnew->IMB_IMVCLT_PERCENTUAL4  = $pi->IMB_IMVCLT_PERCENTUAL4;
            $ppnew->IMB_IMVCLT_PRINCIPAL    = $pi->IMB_IMVCLT_PRINCIPAL;
            $ppnew->save();
        }

        return response()->json( $imv,200);


    }

 public function imoveisGeral()
 {
    $imoveis = mdlImovel::select((
        [
            'IMB_IMV_ID',
            'IMB_IMV_REFERE',
            'IMB_IMV_ENDERECO',
            'IMB_IMV_ENDERECONUMERO',
            'IMB_IMV_ENDERECOCOMPLEMENTO',
            'IMB_IMV_NUMAPT',
            'IMB_IMV_CIDADE',
            'CEP_BAI_NOME',
            'VIS_STATUSIMOVEL.VIS_STA_NOME',
            DB::raw('( select imovel( IMB_IMOVEIS.IMB_IMV_ID )) as enderecocompleto')
        ]
    ))
    ->leftJoin( 'VIS_STATUSIMOVEL','VIS_STATUSIMOVEL.VIS_STA_ID','IMB_IMOVEIS.VIS_STA_ID')
    ->get();

    return response()->json( $imoveis,200);

 }

 public function pegarImoveisAtivosPortal( $portal )
 {

    
    $logged='S';
    if( ! Auth::check())
    {
        Auth::loginUsingId( 1,false);
        $logged = 'N';
    }

    $imoveis = mdlImovel::where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
    ->where( 'VIS_STA_SITUACAO','=','A' )
//    ->where( 'IMB_IMV_ID','=', '29176032')
    ->whereRaw( "(  exists( select IMB_POR_ID FROM IMB_IMOVELPORTAL
        WHERE IMB_IMOVELPORTAL.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
        AND IMB_IMOVELPORTAL.IMB_POR_ID = $portal) )")
    ->leftJoin( 'VIS_STATUSIMOVEL','VIS_STATUSIMOVEL.VIS_STA_ID','IMB_IMOVEIS.VIS_STA_ID')
    ->leftJoin( 'IMB_TIPOIMOVEL','IMB_TIPOIMOVEL.IMB_TIM_ID','IMB_IMOVEIS.IMB_TIM_ID')
    ->get();
    
    if( $logged == 'N')
        Auth::logout();


    return $imoveis;

 }

 public function portaisdoImovel( $id )
 {
    $portais = mdlPortais::select( 
        [
            DB::Raw( "CASE ".
	        "WHEN EXISTS( SELECT IP.IMB_IMV_ID FROM IMB_IMOVELPORTAL IP WHERE IP.IMB_POR_ID = VIS_PORTAIS.IMB_POR_ID ".
		            "AND IP.IMB_IMV_ID = $id) THEN		'S' ELSE 'N' END NOPORTAL"),
	        'VIS_PORTAIS.IMB_POR_NOME'
        ]
    )->orderBy( 'IMB_POR_NOME')
    ->get();

    return $portais;

 }

 public function dadosMinimosPorID( $id)
 {


     $imoveis = mdlImovel::select(
         [
             'IMB_IMOVEIS.IMB_IMV_ID',

             DB::raw('( SELECT PEGACAPIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECAPTADOR'),
             DB::raw('( SELECT PEGACORIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECORRETOR'),
             DB::raw('( SELECT IMB_IMB_NOME
                     FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                     IMB_IMOBILIARIA.IMB_IMB_ID) AS UNIDADE'),
                 DB::raw('( SELECT IMB_ATD_NOME
                     FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_ID =
                     IMB_ATENDENTE.IMB_ATD_ID) AS CADASTRADOPOR'),
                 DB::raw('( SELECT IMB_ATD_NOME
                     FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_IDALTERACAO =
                     IMB_ATENDENTE.IMB_ATD_ID) AS ALTERADOPOR'),

                 DB::raw('( SELECT IMB_IMB_URLIMOVELSITE
                     FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                     IMB_IMOBILIARIA.IMB_IMB_ID) AS URLIMOVELSITE'),
                     DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                     FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                     IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                     DB::raw('( SELECT VIS_STA_NOME
                     FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                     VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_NOME'),
                     DB::raw('( SELECT VIS_STA_SITUACAO
                     FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                     VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_SITUACAO'),
             DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
              COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
              COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
              COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
             'IMB_IMOVEIS.IMB_IMV_REFERE',
             DB::raw('( SELECT CEP_BAIRRO.CEP_BAI_NOME FROM CEP_BAIRRO WHERE CEP_BAIRRO.CEP_BAI_ID = IMB_IMOVEL.CEP_BAI_ID ) AS CEP_BAI_NOME'),
             'IMB_IMOVEIS.CEP_BAI_NOME',
             'IMB_IMOVEIS.IMB_IMV_CIDADE',
             'IMB_IMOVEIS.IMB_TIM_ID',
             'IMB_IMOVEIS.IMB_IMV_DORQUA',
             'IMB_IMOVEIS.IMB_IMV_DORAE',
             'IMB_IMOVEIS.IMB_IMV_ARECON',
             'IMB_IMOVEIS.IMB_IMV_AREUTI',
             'IMB_IMOVEIS.IMB_IMV_MEDTER',
             'IMB_IMOVEIS.IMB_IMV_PISCIN',
             'IMB_IMOVEIS.IMB_IMV_CHURRA',
             'IMB_IMOVEIS.IMB_IMV_SUIQUA',
             'IMB_IMOVEIS.IMB_IMV_VALLOC',
             'IMB_IMOVEIS.IMB_IMV_VALVEN',
             'IMB_IMOVEIS.IMB_IMV_TITULO',
             'IMB_IMOVEIS.VIS_STA_ID',
             'IMB_IMOVEIS.IMB_IMV_ENDERECOCEP',
             'IMB_IMV_DATAATUALIZACAO',
             'IMB_IMV_DATACADASTRO',
             'IMB_IMOVEIS.IMB_IMB_ID',
             'IMB_IMV_OBSWEB',
             'IMB_IMV_CHABOX',
             'IMB_IMV_CHAVES',
             'IMB_CLIENTE.IMB_CLT_NOME',
             DB::Raw(' CASE
                     WHEN EXISTS( SELECT IMB_CCH_ID FROM IMB_CONTROLECHAVE
                     WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                     AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL
                     AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) THEN "Em Visita/Manutenção"
                     ELSE ""
                     END AS SITUACAOCHAVE'),
             DB::Raw('( SELECT IMB_CCH_DTHDEVOLUCAOESPERADA FROM IMB_CONTROLECHAVE
                     WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                     AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL
                     AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) AS IMB_CCH_DTHDEVOLUCAOESPERADA'),

             DB::raw('( SELECT COALESCE(IMB_IMG_ARQUIVO,"logo.jpg")
             FROM IMB_IMAGEM WHERE IMB_IMOVEIS.IMB_IMV_ID =
             IMB_IMAGEM.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMAGEM'),
             DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
             WHERE IMB_IMOVEIS.IMB_TIM_ID =
             IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')

         ])
         ->where( 'IMB_IMOVEIS.IMB_IMV_ID','=', $id)
         ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID')
         ->first();

      return $imoveis;

 }

}
