<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlLanctoCaixa;
use App\mdlViewLanctoCaixa;
use App\mdlCaTran;
use App\mdlCFC;
use App\mdlSubConta;
use App\mdlTmpDREApuracao1;
USE App\mdlTmpDREApuracaoPre;
use DataTables;
use Auth;
use DB;
use Log;
class ctrLanctoCaixa extends Controller
{


    public function index( Request $request )
    {
        return view( 'financeiro.consultarcaixa');
    }

    public function menu( Request $request )
    {
        return view( 'financeiro.caixamenu');
    }


    public function carga( Request $request )
    {
  
        $rDataIni =$request->inicio;
        $rDataFim =$request->termino;
        $conciliado = $request->conciliado;
        $conta = $request->conta;
        $destino = $request->destino;

        $lc = mdlLanctoCaixa::
        whereRaw( "IMB_IMB_ID = ".Auth::user()->IMB_IMB_ID." and FIN_LCX_DATAENTRADA  between '".$rDataIni."' AND '".$rDataFim."'" )
        ->whereNull( 'FIN_LCX_DTHINATIVO');

        if( $conta <> '' )
            $lc->whereRaw( "FIN_CCX_ID = $conta" );

        
        if( $conciliado == 'S' ) $lc = $lc->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");
        if( $conciliado == 'D' ) $lc = $lc->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");

        $lc->orderBy( 'FIN_LCX_DATAENTRADA');

        if( $destino == 'RELATORIO')
        {
            $lc = $lc->get();
            $periodo = date( 'd/m/Y', strtotime( $rDataIni ) ).' a '. date( 'd/m/Y', strtotime( $rDataFim ) );
            return view( 'reports.admimoveis.relatoriocaixa', compact( 'lc', 'periodo'));
        }

        
        return DataTables::of($lc)->make(true);

    }

    public function find( $id  )
    {
        $lcx = mdlLanctoCaixa::select(
            [
                'FIN_LANCTOCAIXA.*',
                'IMB_ATD_NOME'
            ]
        )
        ->where( 'FIN_LCX_ID', '=',  $id )
        ->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID', 'IMB_ATD_IDINCLUSAO')
        ->first();

        return response()->json( $lcx,200);
    }

    public function salvar( Request $request )
    {


        $id = $request->FIN_LCX_ID;
        if( $id == null )
            $lcx = new mdlLanctoCaixa;
        else
            $lcx = mdlLanctoCaixa::find( $id );

        $lcx->FIN_LCX_DATACADASTRO = $request->FIN_LCX_DATACADASTRO;

        $lcx->FIN_LCX_DATAEMISSAO = date( 'Y/m/d');
        $lcx->FIN_LCX_DATAENTRADA =  $request->FIN_LCX_DATAENTRADA;
        $lcx->FIN_LCX_OPERACAO = $request->FIN_LCX_OPERACAO;
        $lcx->FIN_LCX_VALOR = $request->FIN_LCX_VALOR;
        $lcx->FIN_LCX_ORIGEM = $request->FIN_LCX_ORIGEM;
        $lcx->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        if( $request->FIN_LCX_FORMA == 'T' )
            $lcx->FIN_LCX_HISTORICO = 'Transferência entre contas:  '.
             app('App\Http\Controllers\ctrContaCaixa')
            ->nomeConta(  $request->FIN_CCX_IDDESTINO);
        else
            $lcx->FIN_LCX_HISTORICO =$request->FIN_LCX_HISTORICO;
        $lcx->FIN_CCX_ID = $request->FIN_CCX_ID;
        $lcx->FIN_LCX_CONCILIADO = $request->FIN_LCX_CONCILIADO;
        $lcx->FIN_LCX_FORMA = $request->FIN_LCX_FORMA;
        $lcx->imb_imb_id2 = Auth::user()->IMB_IMB_ID;
        $lcx->save();
        $idlcx = $lcx->FIN_LCX_ID;


        if( $request->FIN_LCX_FORMA == 'T')
        {
            $lcxt = new mdlLanctoCaixa;
            $lcxt->FIN_LCX_DATACADASTRO = $request->FIN_LCX_DATACADASTRO;

            $lcxt->FIN_LCX_DATAEMISSAO = date( 'Y/m/d');
            $lcxt->FIN_LCX_DATAENTRADA =  $request->FIN_LCX_DATAENTRADA;
            if( $request->FIN_LCX_OPERACAO == 'C')
                $lcxt->FIN_LCX_OPERACAO = 'D';
            else
            if( $request->FIN_LCX_OPERACAO == 'D')
                $lcxt->FIN_LCX_OPERACAO = 'C';

            $lcxt->FIN_LCX_VALOR = $request->FIN_LCX_VALOR;
            $lcxt->FIN_LCX_ORIGEM = $request->FIN_LCX_ORIGEM;
            $lcxt->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lcxt->FIN_LCX_HISTORICO = 'Transferência entre contas:  '.
            app('App\Http\Controllers\ctrContaCaixa')
                ->nomeConta(  $request->FIN_CCX_ID);

//            $lcxt->FIN_LCX_HISTORICO = $request->FIN_LCX_HISTORICO;
            $lcxt->FIN_CCX_ID = $request->FIN_CCX_IDDESTINO;
            $lcxt->FIN_LCX_CONCILIADO = $request->FIN_LCX_CONCILIADO;
            $lcxt->FIN_LCX_FORMA = $request->FIN_LCX_FORMA;
            $lcxt->imb_imb_id2 = Auth::user()->IMB_IMB_ID;
            $lcxt->fin_lcx_idorigem = $lcx->FIN_LCX_ID;
            $lcxt->save();

        }
        else
        {
            $catran = $request->CATRAN;
            $nseq=0;
            foreach( $catran as $det )
            {
       
                $nseq = $nseq  + 1;
                Log::info( 'DETA '.$det[5] );
                Log::info( "seq ".$nseq);
                if( $det[5] <> '' )
                    $cat =  mdlCaTran::find($det[5] );
                else
                   $cat = new mdlCaTran;
                $cat->FIN_LCX_ID = $idlcx;
                $cat->FIN_CAT_SEQUENCIA = $nseq;
                $cat->FIN_CAT_VALOR = $det[1];
                $cat->FIN_CFC_ID = $det[2];
                $cat->FIN_SBC_ID = $det[3];
                $cat->FIN_CAT_OPERACAO = $det[4];
                $cat->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;

                $cat->save();
            };
        }

        return $lcx->FIN_LCX_ID;
    }

    public function saldoInicial( Request $request )
    {
        $data = $request->data;
        $conta = $request->conta;
        $conciliado = $request->conciliado;
        

        Log::info( "Conciliado: $conciliado ");
        Log::info( "Data: $data ");
        $si = mdlLanctocaixa::where("FIN_CCX_ID","=", $conta )
        ->where( 'FIN_LCX_DATAENTRADA','<', $data )
        ->where( 'FIN_LCX_OPERACAO','=','C')
        ->whereNull('FIN_LCX_DTHINATIVO');

        if( $conciliado == 'S' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");
        if( $conciliado == 'D' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");

        Log::info( "sql: ".$si->toSql() );
        $si = $si->sum('FIN_LCX_VALOR');

        $totalCredito = $si;

        $si = mdlLanctocaixa::where("FIN_CCX_ID","=", $conta )
        ->where( 'FIN_LCX_DATAENTRADA','<', $data )
        ->where( 'FIN_LCX_OPERACAO','=','D')
        ->whereNull('FIN_LCX_DTHINATIVO');
        if( $conciliado == 'S' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");
        if( $conciliado == 'D' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");

        $si = $si->sum('FIN_LCX_VALOR');
        
        $totalDebito = $si;

        Log::info( $data );
        Log::info( $conta );

//        Log::info( $si->toSql() );

        return $totalCredito - $totalDebito;
    }

    public function saldoFinal( Request $request )
    {
        $data = $request->data;
        $conta = $request->conta;
        $conciliado = $request->conciliado;

  
        $si = mdlLanctocaixa::where("FIN_CCX_ID","=", $conta )
        ->where( 'FIN_LCX_DATAENTRADA','<=', $data )
        ->where( 'FIN_LCX_OPERACAO','=','C')
        ->whereNull('FIN_LCX_DTHINATIVO');
        if( $conciliado == 'S' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");
        if( $conciliado == 'D' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");

        $si = $si->sum('FIN_LCX_VALOR');

        $totalCredito = $si;

        $si = mdlLanctocaixa::where("FIN_CCX_ID","=", $conta )
        ->where( 'FIN_LCX_DATAENTRADA','<=', $data )
        ->where( 'FIN_LCX_OPERACAO','=','D')
        ->whereNull('FIN_LCX_DTHINATIVO');
        if( $conciliado == 'S' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");
        if( $conciliado == 'D' ) $si = $si->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N')='N' ");

        $si = $si->sum('FIN_LCX_VALOR');
        $totalDebito = $si;

        //return $si->toSql();

        return $totalCredito - $totalDebito;
    }

    public function desativarLancamento( $id )
    {

        $lcx = mdlLanctoCaixa::find( $id );
        
        if( $lcx <> '')
        {
        if( $lcx->FIN_LCX_ORIGEM == 'RD' )
            {
            $rld = mdlRecibolocador::where( 'IMB_RLD_NUMERO','=', $lcx->FIN_LCX_RECIBO )->whereNull( 'IMB_RLD_DTHINATIVO')->first();
            if( $rld <> '')
            {
                return response( 'Tem repasse! Estorne o repasse!', 404);
            }
            }
        if( $lcx->FIN_LCX_ORIGEM == 'RT' )
            {
    
            $rlt = mdlReciboLocatario::where( 'IMB_RLT_NUMERO','=', $lcx->FIN_LCX_RECIBO )->whereNull( 'IMB_RLT_DTHINATIVO')->first();
            if( $rld <> '')
            {
                return response( 'Tem repasse! Estorne o recebimento!', 404);
            }
            }
                
            $lcx->FIN_LCX_DTHINATIVO = date('Y/m/d');
            $lcx->IMB_ATD_IDEXCLUSAO = Auth::user()->IMB_ATD_ID;
            $lcx->save();

            return response()->json('OK',200);
        }


        else
            return response()->json('Não encontrado',404);
    }


    public function consolidadoDetalhadoSubConta( Request $request)
    {
    $datainicio = $request->datainicio;
    $datafim = $request->datafim;
    $FIN_SBC_ID = $request->FIN_SBC_ID;
    $tipocompetencia = $request->tipocompetencia;
    $tipo = $request->tipo;
    $gerarrelatorio = $request->gerarrelatorio;
    $subcontanome = $request->subcontanome;
    $periodo = $request->periodo;
        
    $lctos = mdlLanctoCaixa::select(
        [
            'FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA',
            'FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA',
            DB::raw( "COALESCE(FIN_CAT_APARECERCONSOLID,'S')"),
            DB::raw( "CONCAT('(', FIN_CATRAN.FIN_CFC_ID,')',FIN_CFC.FIN_CFC_DESCRICAO) CONCATENADO"),
            "FIN_CATRAN.FIN_CFC_ID",
            "FIN_CATRAN.FIN_CAT_OPERACAO",
               DB::raw("CASE WHEN FIN_CATRAN.FIN_CAT_OPERACAO = 'D' THEN FIN_CATRAN.FIN_CAT_VALOR * -1 Else FIN_CATRAN.FIN_CAT_VALOR  END as FIN_CAT_VALOR "),
            "FIN_LANCTOCAIXA.FIN_LCX_HISTORICO" ,
            "FIN_LANCTOCAIXA.FIN_LCX_ID",
            "FIN_LANCTOCAIXA.FIN_LCX_ORIGEM",
            "FIN_SBC_ID",
            "FIN_LANCTOCAIXA.FIN_APD_ID",
            "FIN_LANCTOCAIXA.FIN_ARD_ID",
            "FIN_LANCTOCAIXA.IMB_IMV_ID",
            DB::Raw('imovel( FIN_LANCTOCAIXA.IMB_IMV_ID ) as ENDERECO' ),
            "FIN_CAT_SEQUENCIA",
            "FIN_CFC.FIN_CFC_DESCRICAO",
            "FIN_GRUPOCFC.FIN_GCF_ID",
            "FIN_CONTACAIXA.FIN_CCX_DESCRICAO",
            "FIN_GRUPOCFC.FIN_GCF_DESCRICAO",
            "FIN_LANCTOCAIXA.FIN_LCX_RECIBO",
            DB::raw( "(SELECT FIN_SBC_DESCRICAO FROM FIN_SUBCONTA  WHERE FIN_CATRAN.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID ) FIN_SBC_DESCRICAO",
           "FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA")
        ])
        ->where( 'FIN_LANCTOCAIXA.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where( 'FIN_CATRAN.FIN_SBC_ID','=',$FIN_SBC_ID )
        ->whereNull('FIN_LCX_DTHINATIVO')
        ->leftJoin('FIN_CATRAN', 'FIN_CATRAN.FIN_LCX_ID', 'FIN_LANCTOCAIXA.FIN_LCX_ID')
        ->leftJoin('FIN_CFC', 'FIN_CFC.FIN_CFC_ID','FIN_CATRAN.FIN_CFC_ID')
        ->leftJoin('FIN_CONTACAIXA','FIN_CONTACAIXA.FIN_CCX_ID','FIN_LANCTOCAIXA.FIN_CCX_ID')
        ->leftJoin('FIN_GRUPOCFC','FIN_GRUPOCFC.FIN_GCF_ID','FIN_CFC.FIN_GCF_ID')
        ->whereRaw("COALESCE(FIN_CAT_APARECERCONSOLID,'S') <> 'N'");

        if( $tipo == 'RC') 
            $lctos->where('FIN_CFC_TIPORD','=', 'R' );

        if( $tipo == 'DP') 
            $lctos->where('FIN_CFC_TIPORD','=', 'D' );

        if( $tipocompetencia == "E" )
         $lctos->where('FIN_LCX_DATAENTRADA','>=', $datainicio )
            ->where('FIN_LCX_DATAENTRADA','<=', $datafim )
                    ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA')
                    ->orderBy( 'FIN_LANCTOCAIXA.IMB_IMV_ID')
                    ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_ORIGEM','DESC');                        
            else
                $lctos->where('FIN_LCX_COMPETENCIA','>=', $datainicio )
                    ->where('FIN_LCX_COMPETENCIA','<=', $datafim )
                    ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA')
                    ->orderBy( 'FIN_LANCTOCAIXA.IMB_IMV_ID')
                    ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_ORIGEM','DESC');     
                    
        if( $gerarrelatorio == 'S' )
        {
            $lctos = $lctos->get();
            $datainicio = app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
            $datafim = app('App\Http\Controllers\ctrRotinas')->formatarData( $datafim );

            return view( 'reports.admimoveis.relfinsubcontadetalhado', compact('lctos', 'subcontanome', 'datainicio', 'datafim') );
        }
            
        return DataTables::of($lctos)->make(true);


    }


    

    
    public function consolidadoDetalhado( Request $request)
    {
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $FIN_CFC_ID = $request->FIN_CFC_ID;
        $tipocompetencia = $request->tipocompetencia;
        $sbcid = $request->sbcid;
        $gerarrelatorio = $request->gerarrelatorio;
        $subcontanome = $request->subcontanome;
        $cfcnome=$request->cfcnome;
        $periodo = $request->periodo;
            
        $cfc = mdlCFC::where( 'FIN_CFC_ID','=', $FIN_CFC_ID )->first();
        $nomecfc = $cfc->FIN_CFC_DESCRICAO;
        Log::info( $sbcid);

        DB::statement("SET SQL_BIG_SELECTS=1;");
        $lctos = mdlLanctoCaixa::select(
            [
                'FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA',
                'FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA',
                DB::raw( "COALESCE(FIN_CAT_APARECERCONSOLID,'S')"),
                DB::raw( "CONCAT('(', FIN_CATRAN.FIN_CFC_ID,')',FIN_CFC.FIN_CFC_DESCRICAO) CONCATENADO"),
                "FIN_CATRAN.FIN_CFC_ID",
                "FIN_CATRAN.FIN_CAT_OPERACAO",
   	            DB::raw("CASE WHEN FIN_CATRAN.FIN_CAT_OPERACAO = 'D' THEN FIN_CATRAN.FIN_CAT_VALOR * -1 Else FIN_CATRAN.FIN_CAT_VALOR  END as FIN_CAT_VALOR "),
                "FIN_LANCTOCAIXA.FIN_LCX_HISTORICO" ,
                "FIN_LANCTOCAIXA.FIN_LCX_ID",
                "FIN_LANCTOCAIXA.FIN_LCX_ORIGEM",
                "FIN_SBC_ID",
                "FIN_LANCTOCAIXA.FIN_APD_ID",
                "FIN_LANCTOCAIXA.FIN_ARD_ID",
                "FIN_LANCTOCAIXA.IMB_IMV_ID",
                DB::Raw('imovel( FIN_LANCTOCAIXA.IMB_IMV_ID ) as ENDERECO' ),
                "FIN_CAT_SEQUENCIA",
                "FIN_CFC.FIN_CFC_DESCRICAO",
	            "FIN_GRUPOCFC.FIN_GCF_ID",
                "FIN_CONTACAIXA.FIN_CCX_DESCRICAO",
                "FIN_GRUPOCFC.FIN_GCF_DESCRICAO",
                "FIN_LANCTOCAIXA.FIN_LCX_RECIBO",
                DB::raw( "(SELECT FIN_SBC_DESCRICAO FROM FIN_SUBCONTA  WHERE FIN_CATRAN.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID ) FIN_SBC_DESCRICAO",
               "FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA")
            ])
            ->where( 'FIN_LANCTOCAIXA.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'FIN_CATRAN.FIN_CFC_ID','=',$FIN_CFC_ID )
            ->whereNull('FIN_LCX_DTHINATIVO')
            ->leftJoin('FIN_CATRAN', 'FIN_CATRAN.FIN_LCX_ID', 'FIN_LANCTOCAIXA.FIN_LCX_ID')
            ->leftJoin('FIN_CFC', 'FIN_CFC.FIN_CFC_ID','FIN_CATRAN.FIN_CFC_ID')
            ->leftJoin('FIN_CONTACAIXA','FIN_CONTACAIXA.FIN_CCX_ID','FIN_LANCTOCAIXA.FIN_CCX_ID')
            ->leftJoin('FIN_GRUPOCFC','FIN_GRUPOCFC.FIN_GCF_ID','FIN_CFC.FIN_GCF_ID')
            ->whereRaw("COALESCE(FIN_CAT_APARECERCONSOLID,'S') <> 'N'");

            if( $sbcid <> '-1' )
                $lctos->where( 'FIN_CATRAN.FIN_SBC_ID','=', $sbcid);

            if( $tipocompetencia == "E" )
                $lctos->where('FIN_LCX_DATAENTRADA','>=', $datainicio )
                        ->where('FIN_LCX_DATAENTRADA','<=', $datafim )
                        ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA')
                        ->orderBy( 'FIN_LANCTOCAIXA.IMB_IMV_ID')
                        ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_ORIGEM','DESC');                        
                else
                    $lctos->where('FIN_LCX_COMPETENCIA','>=', $datainicio )
                        ->where('FIN_LCX_COMPETENCIA','<=', $datafim )
                        ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA')
                        ->orderBy( 'FIN_LANCTOCAIXA.IMB_IMV_ID')
                        ->orderBy( 'FIN_LANCTOCAIXA.FIN_LCX_ORIGEM','DESC');                        
  

                        

        if( $gerarrelatorio == 'S' )
        {
            Log::info( $lctos->toSql() );
            $lctos = $lctos->get();
            $datainicio = app('App\Http\Controllers\ctrRotinas')->formatarData( $datainicio );
            $datafim = app('App\Http\Controllers\ctrRotinas')->formatarData( $datafim );
        
            return view( 'reports.admimoveis.relfincfcdetalhado', compact('lctos', 'subcontanome', 'nomecfc', 'datainicio', 'datafim') );
        }
        return DataTables::of($lctos)->make(true);


    }

    public function agruparCFC( Request $request )
    {

        $tmpdreap1 = mdlTmpDREApuracao1::where('IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID)->delete();
        $tabela = mdlTmpDREApuracaoPre::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

        $datini = $request->datini;
        $datfim = $request->datfim;
        $cfc = $request->cfc;
        $tipocomp = $request->tipocompetencia;


        if( $tipocomp == 'E')
            $lctos = mdlCFC::select(
                [   'FIN_CFC_ID',
                'FIN_CFC_TIPORD',
                'FIN_CFC_DESCRICAO',
                'FIN_GCF_ID',
                DB::Raw('( SELECT FIN_GCF_DESCRICAO FROM FIN_GRUPOCFC
                WHERE CAST(FIN_GRUPOCFC.FIN_GCF_ID AS INT )= CAST( FIN_CFC.FIN_GCF_ID AS INT ) ) AS FIN_GCF_DESCRICAO'),
                DB::raw("COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                    FROM FIN_CATRAN, FIN_LANCTOCAIXA
                    WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                    AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                    AND FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA BETWEEN '".$datini."' AND '".$datfim.
                    "' AND FIN_CAT_OPERACAO = 'C'
                    AND FIN_LCX_DTHINATIVO IS NULL
                    AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0)ENTRADA"),
                DB::raw("COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                    FROM FIN_CATRAN, FIN_LANCTOCAIXA
                    WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                    AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                    AND FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA BETWEEN '".$datini."' AND '".$datfim.
                    "' AND FIN_CAT_OPERACAO = 'D'
                    AND FIN_LCX_DTHINATIVO IS NULL
                    AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0)SAIDA"),
                DB::raw("COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                    FROM FIN_CATRAN, FIN_LANCTOCAIXA
                    WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                    AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                    AND FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA BETWEEN '".$datini."' AND '".$datfim.
                    "' AND FIN_CAT_OPERACAO = 'C'
                    AND FIN_LCX_DTHINATIVO IS NULL
                    AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0) -
                COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                    FROM FIN_CATRAN, FIN_LANCTOCAIXA
                    WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                    AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                    AND FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA BETWEEN '".$datini."' AND '".$datfim.
                    "' AND FIN_CAT_OPERACAO = 'D'
                    AND FIN_LCX_DTHINATIVO IS NULL
                    AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0)SALDO ")
                ]);
        else
        $lctos = mdlCFC::select(
            [   'FIN_CFC_ID',
            'FIN_CFC_TIPORD',
            'FIN_CFC_DESCRICAO',
            'FIN_GCF_ID',
            DB::Raw('( SELECT FIN_GCF_DESCRICAO FROM FIN_GRUPOCFC
            WHERE CAST(FIN_GRUPOCFC.FIN_GCF_ID AS INT )= CAST( FIN_CFC.FIN_GCF_ID AS INT )) AS FIN_GCF_DESCRICAO'),
            DB::raw("COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                FROM FIN_CATRAN, FIN_LANCTOCAIXA
                WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                AND FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA BETWEEN '".$datini."' AND '".$datfim.
                "' AND FIN_CAT_OPERACAO = 'C'
                AND FIN_LCX_DTHINATIVO IS NULL
                AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0)ENTRADA"),
            DB::raw("COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                FROM FIN_CATRAN, FIN_LANCTOCAIXA
                WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                AND FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA BETWEEN '".$datini."' AND '".$datfim.
                "' AND FIN_CAT_OPERACAO = 'D'
                AND FIN_LCX_DTHINATIVO IS NULL
                AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0)SAIDA"),
            DB::raw("COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                FROM FIN_CATRAN, FIN_LANCTOCAIXA
                WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                AND FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA BETWEEN '".$datini."' AND '".$datfim.
                "' AND FIN_CAT_OPERACAO = 'C'
                AND FIN_LCX_DTHINATIVO IS NULL
                AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0) -
            COALESCE( ( SELECT SUM( FIN_CAT_VALOR )
                FROM FIN_CATRAN, FIN_LANCTOCAIXA
                WHERE FIN_CATRAN.FIN_LCX_ID = FIN_LANCTOCAIXA.FIN_LCX_ID
                AND FIN_CFC.FIN_CFC_ID = FIN_CATRAN.FIN_CFC_ID
                AND FIN_LANCTOCAIXA.FIN_LCX_COMPETENCIA BETWEEN '".$datini."' AND '".$datfim.
                "' AND FIN_CAT_OPERACAO = 'D'
                AND FIN_LCX_DTHINATIVO IS NULL
                AND COALESCE(FIN_CAT_APARECERCONSOLID,'S')<>'N' ),0)SALDO ")
            ]);

            if( $cfc <> '' )
                $lctos->where('FIN_CFC_ID','=', $cfc );

            $lancamentos = $lctos->get();

            foreach( $lancamentos as $lf )
            {
                $tabela = new mdlTmpDREApuracaoPre;
                $tabela->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $tabela->FIN_CFC_ID = $lf->FIN_CFC_ID;
                $tabela->FIN_CFC_TIPORD = $lf->FIN_CFC_TIPORD;
                $tabela->FIN_CFC_DESCRICAO = $lf->FIN_CFC_DESCRICAO;
                $tabela->FIN_GCF_ID = $lf->FIN_GCF_ID;
                $tabela->FIN_GCF_DESCRICAO = $lf->FIN_GCF_DESCRICAO;
                $tabela->ENTRADA = $lf->ENTRADA;
                $tabela->SAIDA = $lf->SAIDA;
                $tabela->SALDO = $lf->SALDO;
                $tabela->save();
            };
            
            $retorno = mdlTmpDREApuracaoPre::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
                    ->orderBy( 'FIN_CFC_TIPORD','DESC')
                    ->orderBy( 'FIN_GCF_DESCRICAO')
                    ->orderBy( 'FIN_CFC_DESCRICAO')
                    ->get();

            $totaltipo=0;
            $totalgrupoentrada=0;
            $totalgruposaida=0;
            $totalgruposaldo=0;
                        
            $tipo=$retorno[0]->FIN_CFC_TIPORD;
            $grupo=$retorno[0]->FIN_GCF_ID;
            $nomegrupo=$retorno[0]->FIN_GCF_DESCRICAO;
            $itens = 0;


            foreach( $retorno as $ret )
            {
                    
                if( $ret->ENTRADA <> 0  or $ret->SAIDA <> 0 )
                {
                    if( $grupo <> $ret->FIN_GCF_ID)
                    {
                        if( $itens <> 0 and $nomegrupo <> null and $tipo <> '' )
                        {
                            $itens = $itens + 1;
                            $tmpdre = new mdlTmpDREApuracao1;
                            $tmpdre->FIN_GCF_DESCRICAO ='Sub Total do Grupo: '.$nomegrupo;
                            $tmpdre->ENTRADA =$totalgrupoentrada;
                            $tmpdre->SAIDA =$totalgruposaida;
                            $tmpdre->SALDO =$totalgruposaldo;
                            $tmpdre->FIN_CFC_TIPORD =$ret->FIN_CFC_TIPORD;
                            $tmpdre->LINHA =$itens;
                            $tmpdre->IMB_ATD_ID=Auth::user()->IMB_ATD_ID;
                            $tmpdre->save();
                        }
                        if( $ret->FIN_GCF_DESCRICAO<> null and $tipo <> '' )
                        {
                            $itens = $itens + 1;                                
                            $tmpdre = new mdlTmpDREApuracao1;
                            $tmpdre->FIN_GCF_DESCRICAO ='Grupo: '.$ret->FIN_GCF_DESCRICAO;
                            $tmpdre->FIN_CFC_TIPORD =$ret->FIN_CFC_TIPORD;
                            $tmpdre->LINHA =$itens;
                            $tmpdre->IMB_ATD_ID=Auth::user()->IMB_ATD_ID;
                            $tmpdre->save();
                        }
                        $totalgrupoentrada=0;
                        $totalgruposaida=0;
                        $totalgruposaldo=0;
                        $tipo=$ret->FIN_CFC_TIPORD;
                        $grupo=$ret->FIN_GCF_ID;
                        $nomegrupo=$ret->FIN_GCF_DESCRICAO;
                    }

                    $itens = $itens + 1;

                        

                    $tmpdre = new mdlTmpDREApuracao1;
                    $tmpdre->FIN_CFC_ID =$ret->FIN_CFC_ID;
                    $tmpdre->FIN_CFC_TIPORD='.';
                    $tmpdre->FIN_CFC_DESCRICAO =$ret->FIN_CFC_DESCRICAO;
                    $tmpdre->FIN_GCF_ID =$ret->FIN_GCF_ID;
                    $tmpdre->FIN_GCF_DESCRICAO  ='';
                    $tmpdre->ENTRADA   =$ret->ENTRADA;
                    $tmpdre->SAIDA    =$ret->SAIDA;
                    $tmpdre->SALDO     =$ret->SALDO;
                    $tmpdre->LINHA     =$itens;
                    $tmpdre->IMB_ATD_ID=Auth::user()->IMB_ATD_ID;
                    $tmpdre->save();

                    $totalgrupoentrada = $totalgrupoentrada + $ret->ENTRADA;
                    $totalgruposaida = $totalgruposaida + $ret->SAIDA;
                    $totalgruposaldo = $totalgruposaldo + $ret->SALDO;
                }
            }

            $itens = $itens + 1;
            $tmpdre = new mdlTmpDREApuracao1;
            $tmpdre->FIN_GCF_DESCRICAO ='Sub Total do Grupo: '.$ret->FIN_CFC_DESCRICAO;
            $tmpdre->ENTRADA =$totalgrupoentrada;
            $tmpdre->SAIDA =$totalgruposaida;
            $tmpdre->SALDO =$totalgruposaldo;
            $tmpdre->FIN_CFC_TIPORD =$ret->FIN_CFC_TIPORD;
            $tmpdre->LINHA =$itens;
            $tmpdre->IMB_ATD_ID=Auth::user()->IMB_ATD_ID;
            $tmpdre->save();
            $retorno =mdlTmpDREApuracao1::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
                ->where( 'FIN_CFC_TIPORD','<>', '' )
                ->OrderBy('LINHA')
                ->get();

                return DataTables::of($retorno)->make(true);

    }

    public function cfcPorPeriodo( Request $request )
    {
        $idcfc = $request->FIN_CFC_ID;
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $tipocompetencia = $request->tipocompetencia;
        $tipocfc = $request->tipocfc;
        $subid = $request->FIN_SBC_ID;

        $filtrosub='';
        if( $subid <> '-1' )
            $filtrosub = " and CX.FIN_SBC_ID = '$subid' ";

            Log::info( 'filtro '.$filtrosub);
        if( $datainicio == '') 
        {
            $datainicio = date( 'Y/m/d');
            $datafim = date( 'Y/m/d');
        }

        if( $tipocompetencia == 'E')
            $dados = mdlCFC::select( 
            [
                'FIN_CFC_ID',
                'FIN_CFC_DESCRICAO',
                DB::raw( "CASE WHEN FIN_CFC_TIPORD = 'R' THEN 'RECEITA' 
                    WHEN FIN_CFC_TIPORD = 'D' THEN 'DESPESAS' 
                    WHEN FIN_CFC_TIPORD = 'T' THEN 'TRANSITÓRIAS' 
                    ELSE 'NAO CLASSIFICADA' END AS TIPO "),
                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                    WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CX.FIN_CAT_OPERACAO = 'C' 
                        AND FIN_LCX_DTHINATIVO IS NULL
                        $filtrosub
                        AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' ) as Credito"),
                DB::raw("(SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                    WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CX.FIN_CAT_OPERACAO = 'D' 
                        AND FIN_LCX_DTHINATIVO IS NULL
                        $filtrosub
                        AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' )	as Debito"),
                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                        WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                            AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                            AND CX.FIN_CAT_OPERACAO = 'C' 
                            AND FIN_LCX_DTHINATIVO IS NULL
                            $filtrosub
                            AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' ) -
                            (	SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                                WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                                    AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                                    AND CX.FIN_CAT_OPERACAO = 'D' 
                                    $filtrosub
                                    AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' )	as Saldo")
            ])
            ->whereRaw( "(
                (SELECT COALESCE(SUM(FIN_CAT_VALOR), 0)
                   FROM FIN_CATRAN CX,
                        FIN_LANCTOCAIXA LX
                   WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID
                     AND CX.FIN_LCX_ID = LX.FIN_LCX_ID
                     AND CX.FIN_CAT_OPERACAO = 'C'
                     $filtrosub
                     AND FIN_LCX_DTHINATIVO IS NULL
                     AND LX.FIN_LCX_DATAENTRADA BETWEEN  '$datainicio' AND '$datafim') <>0 
                OR
                (SELECT COALESCE(SUM(FIN_CAT_VALOR), 0)
                   FROM FIN_CATRAN CX,
                        FIN_LANCTOCAIXA LX
                   WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID
                     AND CX.FIN_LCX_ID = LX.FIN_LCX_ID
                     AND CX.FIN_CAT_OPERACAO = 'D'
                     $filtrosub
                     AND FIN_LCX_DTHINATIVO IS NULL
                     AND LX.FIN_LCX_DATAENTRADA BETWEEN  '$datainicio' AND '$datafim' ) <>0 )");
        else
        $dados = mdlCFC::select( 
            [
                'FIN_CFC_ID',
                'FIN_CFC_DESCRICAO',
                DB::raw( "CASE WHEN FIN_CFC_TIPORD = 'R' THEN 'RECEITA' WHEN FIN_CFC_TIPORD = 'D' THEN 'DESPESAS' ELSE 'NAO CLASSIFICADA' END AS TIPO "),
                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                    WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CX.FIN_CAT_OPERACAO = 'C' 
                        $filtrosub
                        AND FIN_LCX_DTHINATIVO IS NULL
                        AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' ) as Credito"),
                DB::raw("(SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                    WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CX.FIN_CAT_OPERACAO = 'D' 
                        $filtrosub
                        AND FIN_LCX_DTHINATIVO IS NULL
                        AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' )	as Debito"),
                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                        WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                            AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                            AND CX.FIN_CAT_OPERACAO = 'C' 
                            $filtrosub
                            AND FIN_LCX_DTHINATIVO IS NULL
                            AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' ) -
                            (	SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX
                                WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID 
                                    AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                                    AND CX.FIN_CAT_OPERACAO = 'D' 
                                    $filtrosub
                                    AND FIN_LCX_DTHINATIVO IS NULL
                                    AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' )	as Saldo")
            ])
            ->whereRaw( "(
                (SELECT COALESCE(SUM(FIN_CAT_VALOR), 0)
                   FROM FIN_CATRAN CX,
                        FIN_LANCTOCAIXA LX
                   WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID
                     AND CX.FIN_LCX_ID = LX.FIN_LCX_ID
                     AND CX.FIN_CAT_OPERACAO = 'C'
                     $filtrosub
                     AND FIN_LCX_DTHINATIVO IS NULL
                     AND LX.FIN_LCX_COMPETENCIA BETWEEN  '$datainicio' AND '$datafim') <>0 
                OR
                (SELECT COALESCE(SUM(FIN_CAT_VALOR), 0)
                   FROM FIN_CATRAN CX,
                        FIN_LANCTOCAIXA LX
                   WHERE CX.FIN_CFC_ID = FIN_CFC.FIN_CFC_ID
                     AND CX.FIN_LCX_ID = LX.FIN_LCX_ID
                     AND CX.FIN_CAT_OPERACAO = 'D'
                     $filtrosub
                     AND FIN_LCX_DTHINATIVO IS NULL
                     AND LX.FIN_LCX_COMPETENCIA BETWEEN  '$datainicio' AND '$datafim' ) <>0 )");
                                 

            if( $tipocfc == 'RC') $dados->where( 'FIN_CFC_TIPORD','=', 'R' );
            if( $tipocfc == 'DP') $dados->where( 'FIN_CFC_TIPORD','=', 'D' );
            if( $tipocfc == 'TR') $dados->where( 'FIN_CFC_TIPORD','=', 'T' );
            if( $tipocfc == 'RP') $dados->whereRaw( "FIN_CFC_TIPORD = 'D' or FIN_CFC_TIPORD = 'R' ");   
            
            if( $idcfc <> '' )
                $dados->where( 'FIN_CFC_ID','=', $idcfc );

            Log::info( 'tipo de cfc '.$tipocfc );
            Log::info( $dados->toSql());
            return DataTables::of($dados)->make(true);
    }

    
    public function subContaPorPeriodo( Request $request )
    {
        $idsbc = $request->FIN_SBC_ID;
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $tipocompetencia = $request->tipocompetencia;
        $tipo = $request->tipo;
        $relatorio=$request->relatorio;

        if( $datainicio == '') 
        {
            $datainicio = date( 'Y/m/d');
            $datafim = date( 'Y/m/d');
        }

        Log::info('tipo: '.$tipo );

        $filtrotipo='';
        if( $tipo == 'RC' )
            $filtrotipo = " AND FIN_CFC_TIPORD = 'R'";
        else
        if( $tipo == 'DP' )
            $filtrotipo = " AND FIN_CFC_TIPORD = 'D'";

        if( $tipocompetencia == 'E')
            $dados = mdlSubConta::select( 
            [
                'FIN_SBC_ID',
                'FIN_SBC_DESCRICAO',
                DB::Raw( '( SELECT FIN_SBC_DESCRICAO FROM FIN_SUBCONTA X WHERE X.FIN_SBC_ID = FIN_SBC_IDCONSOL) AS Grupo' ),
                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                    WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                        AND CX.FIN_CAT_OPERACAO = 'C' 
                        AND FIN_LCX_DTHINATIVO IS NULL
                        AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' ) as Credito"),
                DB::raw("(SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                    WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CX.FIN_CAT_OPERACAO = 'D' 
                        AND FIN_LCX_DTHINATIVO IS NULL
                        AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                        AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' )	as Debito"),
                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                        WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                            AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                            AND CX.FIN_CAT_OPERACAO = 'C' 
                            AND FIN_LCX_DTHINATIVO IS NULL
                            AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                            AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' ) -
                            (	SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                                WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                                    AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                                    AND CX.FIN_CAT_OPERACAO = 'D' 
                                    AND FIN_LCX_DTHINATIVO IS NULL
                                    AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                                    AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' )	as Saldo")
            ]
            )->WhereRaw("( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
            WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                AND CX.FIN_CAT_OPERACAO = 'C' 
                AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' ) <> 0 
                or(SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                    AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                    AND CX.FIN_CAT_OPERACAO = 'D' 
                    AND FIN_LCX_DTHINATIVO IS NULL
                    AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                    AND LX.FIN_LCX_DATAENTRADA BETWEEN '$datainicio' AND '$datafim' ) <> 0");
        else
        $dados = mdlSubConta::select( 
            [
                'FIN_SBC_ID',
                'FIN_SBC_DESCRICAO',
                DB::Raw( '( SELECT FIN_SBC_DESCRICAO FROM FIN_SUBCONTA X WHERE X.FIN_SBC_ID = FIN_SBC_IDCONSOL) AS Grupo' ),

                DB::raw( "( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                    WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                        AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                        AND CX.FIN_CAT_OPERACAO = 'C' 
                        AND FIN_LCX_DTHINATIVO IS NULL
                        AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                        AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' ) as Credito"),


            ]
            )->WhereRaw("( SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX , FIN_CFC CFC
            WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                AND CX.FIN_CAT_OPERACAO = 'C' 
                AND FIN_LCX_DTHINATIVO IS NULL
                AND CFC.FIN_CFC_ID = CX.FIN_CFC_ID $filtrotipo 
                AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' ) <> 0 
                or(SELECT COALESCE(SUM( FIN_CAT_VALOR),0) FROM FIN_CATRAN CX, FIN_LANCTOCAIXA LX, FIN_CFC CFC
                WHERE CX.FIN_SBC_ID = FIN_SUBCONTA.FIN_SBC_ID 
                    AND CX.FIN_LCX_ID = LX.FIN_LCX_ID 
                    AND CX.FIN_CAT_OPERACAO = 'D' 
                    AND LX.FIN_LCX_COMPETENCIA BETWEEN '$datainicio' AND '$datafim' ) <> 0");
 
 
       
 

            if( $idsbc <> '-1' )
                $dados = $dados->where( 'FIN_SUBCONTA.FIN_SBC_ID','=', $idsbc);

            if( $relatorio == 'S')
            {
                $dados = $dados->get();
                
                return view('reports.admimoveis.relconsubcontaquadro', compact('dados','datainicio','datafim')) ;
            }
           
        return DataTables::of($dados)->make(true);
    }

    public function movimentoPorSubcontas( $dataini, $datafim, $tipo)
    {

        
        $mov = mdlSubConta::whereRaw( "EXISTS( SELECT FIN_SBC_ID FROM FIN_LANCTOCAIXA LX,
                FIN_CATRAN CA, FIN_CFC CFC
                WHERE LX.FIN_LCX_ID = CA.FIN_LCX_ID 
                AND FIN_SUBCONTA.FIN_SBC_ID = CA.FIN_SBC_ID 
                AND CFC.FIN_CFC_ID = CA.FIN_CFC_ID 
                AND FIN_CFC_TIPORD = '$tipo'
                AND FIN_LCX_DTHINATIVO IS NULL
                AND LX.FIN_LCX_DATAENTRADA BETWEEN '$dataini' and '$datafim')");
                
        $mov = $mov->get();

        return $mov;
    }

    public function movimentoDetalhadoPorSubcontas( $sbc, $dataini, $datafim)
    {

        DB::statement("SET SQL_BIG_SELECTS=1;");

        $mov = mdlLanctoCaixa::select( 
            [   'FIN_LANCTOCAIXA.FIN_LCX_DATAENTRADA',
                'FIN_LANCTOCAIXA.FIN_LCX_HISTORICO',
                'FIN_CONTACAIXA.FIN_CCX_DESCRICAO',
                'FIN_SUBCONTA.FIN_SBC_DESCRICAO',
                'FIN_CFC.FIN_CFC_DESCRICAO',
                'FIN_CFC.FIN_CFC_TIPORD',
                'FIN_CFC.FIN_CFC_ID',
//                'FIN_CAT_VALOR',
                DB::raw( "case when FIN_CAT_OPERACAO = 'D' THEN  FIN_CAT_VALOR * -1 ELSE FIN_CAT_VALOR END as FIN_CAT_VALOR")

                
            ])
        ->leftJoin( 'FIN_CATRAN','FIN_CATRAN.FIN_LCX_ID','FIN_LANCTOCAIXA.FIN_LCX_ID')
        ->leftJoin( 'FIN_CFC','FIN_CFC.FIN_CFC_ID','FIN_CATRAN.FIN_CFC_ID')
        ->leftJoin( 'FIN_SUBCONTA','FIN_SUBCONTA.FIN_SBC_ID','FIN_CATRAN.FIN_SBC_ID')
        ->leftJoin( 'FIN_CONTACAIXA','FIN_CONTACAIXA.FIN_CCX_ID','FIN_LANCTOCAIXA.FIN_CCX_ID')
        ->whereNull('FIN_LCX_DTHINATIVO')
        ->where('FIN_CFC_TIPORD', '=', 'D' )
        ->where('FIN_LCX_DATAENTRADA', '>=', $dataini )
        ->where('FIN_LCX_DATAENTRADA', '<=', $datafim )
        ->where('FIN_SUBCONTA.FIN_SBC_ID','=', $sbc)

//        return $mov->toSql();

        ->get();


        return $mov;
    }

    public function analiticoSBC( Request $request )
    {
        $sbc = $request->sbc;
        $dataini = $request->datini;
        $datafim = $request->datfim;
        return view('financeiro.analiticosubconta',compact('sbc','dataini','datafim' ));
    }


    public function relAnaliticoSBC( Request $request )
    {
        $sbc = $request->sbc;
        $datini = $request->datini;
        $datfim = $request->datfim;

        return view('reports.admimoveis.recaixaanalsubconta',compact('sbc','datini','datfim' ));
    }

    public function concilarLancamento( Request $request )
    {
        $id = $request->FIN_LCX_ID;
        $data = $request->FIN_LCX_DATAENTRADA;
        $cx = mdlLanctoCaixa::find( $id );
        if( $cx <> '' )
        {
            $cx->FIN_LCX_DTHCONCILIACAO = date('Y-m-d H:i:s');
            $cx->IMB_ATD_IDCONCILIACAO = Auth::user()->IMB_ATD_ID;
            $cx->FIN_LCX_CONCILIADO = 'S';
            $cx->FIN_LCX_DATAENTRADA = $data;
            $cx->save();
            return response()->json('ok',200);
        }

        return response()->json( 'Não encontrado',404 );
    }

    public function desconcilarLancamento( Request $request )
    {
        $id = $request->FIN_LCX_ID;
        $cx = mdlLanctoCaixa::find( $id );
        if( $cx <> '' )
        {
            $cx->FIN_LCX_CONCILIADO = 'N';
            $cx->save();
            return response()->json('ok',200);
        }

        return response()->json( 'Não encontrado',404 );
    }

    public function dre( Request $request )
    {
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $conciliado = $request->conciliado;

        $cx = mdlViewLanctoCaixa::select(
            [
                DB::raw( 'sum( FIN_CAT_VALOR ) AS VALOR'),
                'FIN_CAT_OPERACAO',
                'FIN_CFC_ID', 
                'FIN_LCX_MESANO',
                'FIN_LCX_MESANO',
                'FIN_LCX_COMPETENCIA'
            ]
        )
        ->whereRaw( "FIN_CFC_TIPOORD IN ('D', 'R' )  AND FIN_LCX_DATAENTRADA  between '$datainicio' and '$datafim'" );

        if( $conciliado == 'S' )
                $cx = $cx->whereRaw( " coalesce(FIN_LCX_CONCILIADO,'N') = 'S' ");

        if( $conciliado == 'N' )
            $cx = $cx->whereRaw( "coalesce(FIN_LCX_CONCILIADO,'N') <> 'S' ");

        $cx = $cx->groupBy('FIN_CAT_OPERACAO', 'FIN_CFC_ID', 'FIN_LCX_MESANO' )
        ->orderBy( 'FIN_CFC_ID','ASC');

        Log::info( $cx->toSql());

        $cx = $cx->get();

        return $cx;



    }



}
