<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImobiliaria;
use App\mdlMetasDet;
use App\mdlMetas;
use App\mdlClienteAtendimento;
use DataTables;
use DB;
use Auth;


class ctrDashboard extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index( $id, $idagencia, $idatd, $mes, $ano )
    {


        $objmes = new \stdClass();
        $arraymes = array();

        if( $mes == 0 )
            $mes = date('m');
        if( $ano == 0 )
            $ano = date('Y');

        //return $met;
        $objmes->IMB_IMB_ID                =0;
        $objmes->IMB_IMB_ID2               =0;
        $objmes->IMB_ATD_ID                =0;
        $objmes->IMB_MET_METANOVOS         =0;
        $objmes->IMB_MET_REALIZADO         =0;
        $objmes->MES                       =0;
        $objmes->ANO                       =0;
        $objmes->QUADRO                    ='Novos Imóveis';
        $objmes->PERCENTUAL                =0;
        $objmes->TIPO                      ='';     //M->Mes   A->Ano

        $metas = mdlMetasDet::select(
            [
                'IMB_MET_VALOR',
                'IMB_MET_NOME',
                DB::raw("( SELECT NOVOSIMOVEIS( $mes,$ano,1,$id  ) ) AS QUANTIDADE"),

            ])
        ->where( 'IMB_METASDET.IMB_IMB_ID','=', $id )
        ->where( 'IMB_METASDET.IMB_MET_ID','=',1 )
        ->where( 'IMB_METASDET.IMB_MET_MES','=', $mes )
        ->where( 'IMB_METASDET.IMB_MET_ANO','=', $ano )
        ->where( 'IMB_METAS.IMB_MET_NOME','=', 'IMOVEIS' )

        ->join( 'IMB_METAS', 'IMB_METAS.IMB_MET_ID', 'IMB_METASDET.IMB_MET_ID')
        ->get();

        if( count( $metas ) > 0 )
        {

            $objmes->IMB_IMB_ID                =$id;
            $objmes->IMB_IMB_ID2               =$idagencia;;
            $objmes->IMB_ATD_ID                =$idatd;
            $objmes->IMB_MET_METANOVOS         =$metas[0]->IMB_MET_VALOR;
            $objmes->IMB_MET_REALIZADO         =$metas[0]->QUANTIDADE;
            $objmes->MES                       =$mes;
            $objmes->ANO                       =$ano;
            $objmes->QUADRO                    ='Novos Imóveis';
            if( $objmes->IMB_MET_METANOVOS  <> 0 )
                $objmes->PERCENTUAL                =
                                        $objmes->IMB_MET_REALIZADO  /
                                        $objmes->IMB_MET_METANOVOS * 100;
            $objmes->TIPO                      ='';     //M->Mes   A->Ano

            array_push( $arraymes, $objmes );

        }



        //NOVOS CLIENTES
        $objclimes = new \stdClass();
        $objclimes->IMB_IMB_ID                =0;
        $objclimes->IMB_IMB_ID2               =0;
        $objclimes->IMB_ATD_ID                =0;
        $objclimes->IMB_MET_METANOVOS         =0;
        $objclimes->IMB_MET_REALIZADO         =0;
        $objclimes->MES                       =0;
        $objclimes->ANO                       =0;
        $objclimes->QUADRO                    ='Novos Imóveis';
        $objclimes->PERCENTUAL                =0;
        $objclimes->TIPO                      ='';     //M->Mes   A->Ano

        $metas = mdlMetasDet::select(
            [
                'IMB_MET_VALOR',
                'IMB_MET_NOME',
                DB::raw("( SELECT NOVOSCLIENTESGERAL( $mes,$ano,$id  ) ) AS QUANTIDADE"),

            ])
        ->where( 'IMB_METASDET.IMB_IMB_ID','=', $id )
        ->where( 'IMB_METASDET.IMB_MET_MES','=', $mes )
        ->where( 'IMB_METASDET.IMB_MET_ANO','=', $ano )
        ->where( 'IMB_METAS.IMB_MET_NOME','=', 'CLIENTES' )
        ->join( 'IMB_METAS', 'IMB_METAS.IMB_MET_ID', 'IMB_METASDET.IMB_MET_ID')
        ->get();

        if( count( $metas ) > 0 )
        {

            $objclimes->IMB_IMB_ID                =$id;
            $objclimes->IMB_IMB_ID2               =$idagencia;;
            $objclimes->IMB_ATD_ID                =$idatd;
            $objclimes->IMB_MET_METANOVOS         =$metas[0]->IMB_MET_VALOR;
            $objclimes->IMB_MET_REALIZADO         =$metas[0]->QUANTIDADE;
            $objclimes->MES                       =$mes;
            $objclimes->ANO                       =$ano;
            $objclimes->QUADRO                    ='Novos Clientes';
            if( $objclimes->IMB_MET_METANOVOS  <> 0 )
                $objclimes->PERCENTUAL                =
                                        $objclimes->IMB_MET_REALIZADO  /
                                        $objclimes->IMB_MET_METANOVOS * 100;
            $objclimes->TIPO                      ='';     //M->Mes   A->Ano

            array_push( $arraymes, $objclimes );

        }



        $metames =  $arraymes;





        //return $metames;


        //$resultado  =  json_encode(  $metas );
        //return 'XX ->'.$metas[0]->IMB_MET_VALOR;
        return view( 'comercial.dashboard.index', compact('metames') );
        return json_encode($metas);
    }

    public function panoramaold( $empresa )
    {
        $mes = date( 'm');
        $ano = date(' Y');

        $datahoje = date( 'Y-m-d');
        $datahoje =date('Y-m-d', strtotime($datahoje. ' - 30 days') ) ;

        $imvmes = mdlImobiliaria::select(
            [
                DB::raw("( SELECT NOVOSIMOVEIS( $mes,$ano,'0',$empresa  ) ) AS QUANTIDADE"),

            ])
            ->where('IMB_IMB_ID','=',$empresa)
            ->first();
        $imvmes = $imvmes->QUANTIDADE;

        $cltmes = mdlImobiliaria::select(
            [
                DB::raw("( SELECT NOVOSCLIENTESGERAL( $mes,$ano,$empresa  ) ) AS QUANTIDADE"),

            ])
            ->where('IMB_IMB_ID','=',$empresa)
            ->first();
            $cltmes = $cltmes->QUANTIDADE;

        $atdmes = DB::table('VIS_ATENDIMENTO')->where( 'IMB_IMB_ID','=', $empresa)
        ->whereMonth('IMB_ATM_DTHINICIO','=', $mes )
        ->whereYear('IMB_ATM_DTHINICIO','=', $ano )
        ->count();

        $imvtot = DB::table('IMB_IMOVEIS')->where( 'IMB_IMB_ID','=', $empresa)->count();


        $imvtot  = mdlImobiliaria::select(
            [
                DB::raw("( SELECT QTIMOVEISATIVOS( $empresa  ) ) AS QUANTIDADE"),

            ])
            ->where('IMB_IMB_ID','=',$empresa)
            ->first();
        $imvtot = $imvtot->QUANTIDADE;

        $imv30 = DB::table('IMB_IMOVEIS')->where( 'IMB_IMB_ID','=', $empresa)
        ->where('IMB_IMV_DATACADASTRO','>=', $datahoje)
        ->count();

        $clttot = DB::table('IMB_CLIENTE')->where( 'IMB_IMB_ID','=', $empresa)->count();
        $clt30 = DB::table('IMB_IMOVEIS')->where( 'IMB_IMB_ID','=', $empresa)
        ->where('IMB_IMV_DATACADASTRO','>=', $datahoje)
        ->count();

        $atdtot = DB::table('VIS_ATENDIMENTO')->where( 'IMB_IMB_ID','=', $empresa)->count();
        $atd30 = DB::table('VIS_ATENDIMENTO')->where( 'IMB_IMB_ID','=', $empresa)
        ->where('IMB_ATM_DTHINICIO','>=', $datahoje)
        ->count();
//         return DataTables::of($atmsaberto)->make(true);

//        return view( 'dashboard.comercial.dsbdefault',
                    //compact( 'imvmes', 'imvtot','imv30','cltmes','clttot','clt30','atdmes','atd30','atdtot' ) );

    }


    public function panorama()
    {
        $empresa = Auth::user()->IMB_IMB_ID;
        $totalativos = $this->imoveisAtivos();
        $novosimoveis= $this->totalNovosImoveis();
        //$foradosite = $this->ativosForadoSite();

        $imoveisdesatualizados = $this->imoveisDesatualizados();

        return view( 'dashboard.comercial.dsbdefault',
                compact('totalativos','novosimoveis','imoveisdesatualizados')) ;


    }

    public function imoveisAtivos()
    {
        $empresa = Auth::user()->IMB_IMB_ID;
        $imvtot  = mdlImobiliaria::select(
            [
                DB::raw("( SELECT QTIMOVEISATIVOS( $empresa  ) ) AS QUANTIDADE"),

            ])
            ->where('IMB_IMB_ID','=',$empresa)
            ->first();
        if( $imvtot )
            return  $imvtot->QUANTIDADE;
        else
                return 0;
    }

    public function imoveisTotal()
    {
        $empresa = Auth::user()->IMB_IMB_ID;
        $imvtot  = mdlImobiliaria::select(
            [
                DB::raw("(SELECT count(*) from IMB_IMOVEIS) AS QUANTIDADE"),

            ])
            ->where('IMB_IMB_ID','=',$empresa)
            ->first();
        return  $imvtot->QUANTIDADE;
    }


    public function totalNovosImoveis()
    {

        $dataatual = date('Y/m/d');

        $data = date('Y/m/d', strtotime('-7 days',strtotime( $dataatual )));

        $novos = DB::table('IMB_IMOVEIS')->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->where('IMB_IMV_DATACADASTRO','>=', $data)
        ->count();

        return $novos;
    }

    public function imoveisDesatualizados()
    {

        $dataatual = date('Y/m/d');

        $data = date('Y/m/d', strtotime('-60 days',strtotime( $dataatual )));

        $desatualizados = DB::table('IMB_IMOVEIS')->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->where('IMB_IMV_DATAATUALIZACAO','<=', $data)
        ->count();

        return $desatualizados;
    }

    public function totalAtivosForadoSite()
    {
        $foradosite = DB::table('IMB_IMOVEIS')
        ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->where('VIS_STATUSIMOVEL.VIS_STA_SITUACAO','A' )
        ->where('IMB_IMV_WEBIMOVEL','<>','S')
        ->leftJoin( 'VIS_STATUSIMOVEL','VIS_STATUSIMOVEL.VIS_STA_ID','IMB_IMOVEIS.VIS_STA_ID')
        ->count();

        return $foradosite;
    }

    public function meusAtivosForadoSite()
    {
        $foradosite = DB::table('IMB_IMOVEIS')
        ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->where('VIS_STATUSIMOVEL.VIS_STA_SITUACAO','A' )
        ->where('IMB_IMV_WEBIMOVEL','<>','S')
        ->whereRaw( 'exists( select IMB_CAPIMO_ID FROM IMB_CAPIMO
                    WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CAPIMO.IMB_IMV_ID
                    AND IMB_ATD_ID = '.Auth::user()->IMB_ATD_ID.')' )
        ->leftJoin( 'VIS_STATUSIMOVEL','VIS_STATUSIMOVEL.VIS_STA_ID','IMB_IMOVEIS.VIS_STA_ID')
        ->count();

        return $foradosite;
    }

    public function listaImoveisDesatualizados()
    {

        $dataatual = date('Y/m/d');

        $data = date('Y/m/d', strtotime('-60 days',strtotime( $dataatual )));

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

        session()->put( 'desatualizadodesde',$data);

        return view('imovel.index', compact('bairros','condominios','tipos','status') );


    }

    public function totalImoveisDestaque()
    {
        $foradosite = DB::table('IMB_IMOVEIS')
        ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->where('VIS_STATUSIMOVEL.VIS_STA_SITUACAO','A' )
        ->where('IMB_IMV_DESTAQUE','=','S')
        ->leftJoin( 'VIS_STATUSIMOVEL','VIS_STATUSIMOVEL.VIS_STA_ID','IMB_IMOVEIS.VIS_STA_ID')
        ->count();

        return $foradosite;
    }





}
