<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContrato;
use App\mdlClienteAtendimento;
use DataTables;
use Auth;
use DB; 


class ctrEstatisticas extends Controller
{

    public function novasLocacoes( Request $request )
    {

        $datainicial = $request->datainicial;
        $datafinal = $request->datafinal;
        $agrupar = $request->agrupar;


        $result = mdlContrato::select(
            [
                DB::raw( ' concat( year(IMB_CTR_DATALOCACAO), LPAD(month(IMB_CTR_DATALOCACAO),2,0)) anomes'),
                DB::raw( ' concat( LPAD(month(IMB_CTR_DATALOCACAO),2,0), "/",year(IMB_CTR_DATALOCACAO) ) month'),
                DB::raw( 'count(IMB_CTR_ID) count')
            ])
            ->groupBy(['month','anomes'])
            ->orderBy('anomes')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_CTR_DATALOCACAO','>=', $datainicial )
                    ->where('IMB_CTR_DATALOCACAO','<=', $datafinal )
                    ->where('IMB_CTR_SITUACAO','<>', 'CANCELADO');
        

        $result = $result->get();

        return response()->json($result,200);


    }

    public function rescisoesRealizadas( Request $request )
    {

        $datainicial = $request->datainicial;
        $datafinal = $request->datafinal;
        $agrupar = $request->agrupar;


        $result = mdlContrato::select(
            [
                DB::raw( ' concat( year(IMB_CTR_DATARESCISAO), LPAD(month(IMB_CTR_DATARESCISAO),2,0)) anomes'),
                DB::raw( ' concat( LPAD(month(IMB_CTR_DATARESCISAO),2,0), "/",year(IMB_CTR_DATARESCISAO) ) month'),
                DB::raw( 'count(IMB_CTR_ID) count')
            ])
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->groupBy(['month','anomes'])
            ->orderBy('anomes')
            ->where( 'IMB_CTR_DATARESCISAO','>=', $datainicial )
                    ->where('IMB_CTR_DATARESCISAO','<=', $datafinal )
                    ->where('IMB_CTR_SITUACAO','=', 'ENCERRADO');
        

        $result = $result->get();

        return response()->json($result,200);

        
    }

    public function contratosAtivosTotal()
    {
        $ctr = mdlContrato::where('IMB_CTR_SITUACAO','=', 'ATIVO' )
        ->count();

        return $ctr;

    }

    public function porTaxaAdm()
    {
        $result = mdlContrato::select(
            [
                 
                DB::raw( "concat( 'Tx. Adm.: ', coalesce(IMB_CTR_TAXAADMINISTRATIVA,0),'%') AS Percentual"), 
                DB::raw( 'count(IMB_CTR_ID) count')
            ])
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->groupBy(['percentual'])
            ->orderBy('Percentual')
            ->where('IMB_CTR_TAXAADMINISTRATIVAFORMA','=', 'P')
            ->where('IMB_CTR_SITUACAO','=', 'ATIVO');
        

        $result = $result->get();

        return response()->json($result,200);

    }

    public function inadimplencia()
    {

        $resultado = array();
        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)

            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 1 AND 
                        DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) <=7 ')
            ->count();
            array_push($resultado, [ "Dias" => 'Até 7 dias', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 7 AND 
                        DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) <=15 ')
            ->count();
        array_push($resultado, [ "Dias" => 'Até 15 dias', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 15 AND 
                        DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) <=30 ')
            ->count();
            array_push($resultado, [ "Dias" => 'Até 30 dias', "count" => $result]);


        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 30 AND 
                        DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) <=60 ')
            ->count();
            array_push($resultado, [ "Dias" => 'Até 60 dias', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 61 AND 
                        DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) <=90 ')
            ->count();
            array_push($resultado, [ "Dias" => 'Até 90 dias', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 91 AND 
                        DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) <=120 ')
            ->count();
            array_push($resultado, [ "Dias" => 'Até 120 dias', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 120 ')
            ->count();
            array_push($resultado, [ "Dias" => 'acima de 120 dias', "count" => $result]);



        return response()->json($resultado,200);

    }

    public function contratosInadimplentesSemJur()
    {
        $ctr = mdlContrato::where('IMB_CTR_SITUACAO','=', 'ATIVO' )
        ->whereRaw( "coalesce(IMB_CTR_ADVOGADO,'N') <> 'S' AND DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 1")
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->count();

        return $ctr;

    }

    public function contratosInadimplentesJur()
    {
        $ctr = mdlContrato::where('IMB_CTR_SITUACAO','=', 'ATIVO' )
        ->whereRaw( "coalesce(IMB_CTR_ADVOGADO,'N') = 'S' AND DATEDIFF(CURDATE(), IMB_CTR_VENCIMENTOLOCATARIO) > 1")
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->count();

        return $ctr;

    }

    public function concentracaoRecebimentos()
    {
        $result = mdlContrato::select(
            [
                 
                DB::raw( "concat( 'Dia: ', IMB_CTR_DIAVENCIMENTO) AS Dia"), 
                DB::raw( 'count(IMB_CTR_ID) count')
            ])
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->groupBy(['dia'])
            ->orderBy('dia')
            ->where('IMB_CTR_SITUACAO','=', 'ATIVO');
        

        $result = $result->get();

        return response()->json($result,200);

    }


    public function faixadeValorAluguel()
    {

        $resultado = array();
        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('IMB_CTR_VALORALUGUEL <= 1000' )
            ->count();
        array_push($resultado, [ "Valor" => 'Até R$ 1.000,00', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('IMB_CTR_VALORALUGUEL > 1000 and IMB_CTR_VALORALUGUEL <= 2000 ' )
            ->count();
        array_push($resultado, [ "Valor" => 'Entre R$ 1.000,00 e R$ 2.000,00', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('IMB_CTR_VALORALUGUEL > 2000 and IMB_CTR_VALORALUGUEL <= 3000 ' )
            ->count();
        array_push($resultado, [ "Valor" => 'Entre R$ 1.000,00 e R$ 2.000,00', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('IMB_CTR_VALORALUGUEL > 3000 and IMB_CTR_VALORALUGUEL <= 4000 ' )
            ->count();
        array_push($resultado, [ "Valor" => 'Entre R$ 1.000,00 e R$ 2.000,00', "count" => $result]);

        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('IMB_CTR_VALORALUGUEL > 4000 and IMB_CTR_VALORALUGUEL <= 5000 ' )
            ->count();
        array_push($resultado, [ "Valor" => 'Entre R$ 4.000,00 e R$ 5.000,00', "count" => $result]);


        $result = mdlContrato::
            where('IMB_CTR_SITUACAO','=', 'ATIVO')
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereRaw('IMB_CTR_VALORALUGUEL > 5000' )
            ->count();
        array_push($resultado, [ "Valor" => 'Acima de R$ 5.000,00', "count" => $result]);


        return response()->json($resultado,200);

    }
    
    public function crmAtendimentos()
    {
        $resultado = array();
        $result = mdlClienteAtendimento::where( 'IMB_CLA_STATUS','=', 'Em atendimento' )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->whereRaw('DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) > 0 AND 
            DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) <=15 ')
        ->count();
        array_push($resultado, [ "Dias" => 'Até 15 dias', "count" => $result]);

        $result = mdlClienteAtendimento::where( 'IMB_CLA_STATUS','=', 'Em atendimento' )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->whereRaw('DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) >15 AND 
            DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) <=30 ')
        ->count();
        array_push($resultado, [ "Dias" => 'Até 30 dias', "count" => $result]);

        $result = mdlClienteAtendimento::where( 'IMB_CLA_STATUS','=', 'Em atendimento' )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->whereRaw('DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) >30 AND 
            DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) <=60 ')
        ->count();
        array_push($resultado, [ "Dias" => 'Até 60 dias', "count" => $result]);


        $result = mdlClienteAtendimento::where( 'IMB_CLA_STATUS','=', 'Em atendimento' )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->whereRaw('DATEDIFF(CURDATE(), IMB_CLA_DATAATUALIZACAO) >60')
        ->count();
        array_push($resultado, [ "Dias" => 'Acima de 60 dias', "count" => $result]);

        return  json_encode($resultado);

    }




}
