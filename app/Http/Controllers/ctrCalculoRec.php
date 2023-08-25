<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContrato;
use App\mdlTabelaMulta;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlLocatarioContrato;
use App\mdlCliente;
use App\mdlLancamentoFuturo;
use App\mdlPropImovel;
use App\mdlTabelaIRRF;
use App\mdlEvento;


use  DateTime;
class ctrCalculoRec extends Controller
{

    public function diaUtil( $data )
    {
        $diasemana = date('w', strtotime($data)) ;

        $res =  ($diasemana > 0 && $diasemana < 6);
        return response()->json($res);

    }
    

    public function baseLocatario( $idevento, $idlf, $cdlt, $valorlancamento)
    {
        $encontrou = "S";

        if( $cdlt ==  'C')
            $valorlancamento = $valorlancamento * 1;

        $basemulta      = 0;
        $baseirrf       = 0;
        $basejuros      = 0;
        $basecorrecao   = 0;
        $basetaxa       = 0;

        if( $idlf <> 0 )
        {
            $encontrou = "S";
            
            $lf = mdlLancamentoFuturo::find( $idlf );

            if( $lf )
            {

                if( $lf->IMB_LCF_INCMUL == 'S' ) 
                    $basemulta = $basemulta + $valorlancamento;
                if( $lf->IMB_LCF_INCIRRF == 'S' ) 
                    $baseirrf = $baseirrf + $valorlancamento;
                if( $lf->IMB_LCF_INCJUROS == 'S' ) 
                    $basejuros = $basejuros + $valorlancamento;
                if( $lf->IMB_LCF_INCCORRECAO == 'S' ) 
                    $basecorrecao = $basecorrecao + $valorlancamento;
                if( $lf->IMB_LCF_INCTAX == 'S' ) 
                    $basetaxa = $basetaxa + $valorlancamento;

            }
        }

        $baseobj =new \stdClass;
        $baseobj->basemulta         = $basemulta;
        $baseobj->baseirrf          = $baseirrf;
        $baseobj->basejuros         = $basejuros;
        $baseobj->basecorrecao      = $basecorrecao;
        $baseobj->basetaxa          = $basetaxa;
        
        return $baseobj;

    }


    public function calcularPontualidade( $contrato, $datavencimento, $datapagamento, $valorbase  )
    {

        $contrato = mdlContrato::find( $contrato );

        $descontovalor = $contrato->IMB_CTR_VALORBONIFICACAO4;
        $descontotipo = $contrato->IMB_CTR_BONIFICACAOTIPO;
        $tolerancia = $contrato->IMB_CTR_TOLERANCIA;
        $limite =$datavencimento;
        
        $limite = date('Y-m-d', strtotime("+".$tolerancia." days",   strtotime($datavencimento)));

        $valorbonificacao = 0;
        if( $descontovalor <> 0 )
        {
        
            $dia = date('w', strtotime($limite) );
            while ( ( $dia =='0' || $dia =='6' )  )
            {
                $limite= date('Y-m-d', strtotime("+1 days",   strtotime($limite) ) );
                $dia = date('w', strtotime($limite) );
            }

            if( $datapagamento <= $limite)
            {
                if( $descontotipo == 'V')
                    $valorbonificacao = $descontovalor;
                else
                if( $descontotipo == 'P')
                    $valorbonificacao = $valorbase * $descontovalor / 100;
                
            }

        }
       
        return $valorbonificacao;


    }
    //
    public function calcularMulta( $idcontrato, $datavencimento, $datapagamento, $valorbase  )
    {

        $contrato       =   mdlContrato::find( $idcontrato );

        $tolerancia     =   $contrato->IMB_CTR_TOLERANCIA;
        $limite         =   $datavencimento;
        $diasatraso     =   0;
        $empresa        =   $contrato->IMB_IMB_ID;
        
        $limite = date('Y-m-d', strtotime("+".$tolerancia." days",   strtotime($datavencimento)));

        $dia = date('w', strtotime($limite) );
        while ( ( $dia =='0' || $dia =='6' )  )
        {
            $limite= date('Y-m-d', strtotime("+1 days",   strtotime($limite) ) );
            $dia = date('w', strtotime($limite) );
        }

        $datainicial    = new DateTime( $limite );
        $datafinal      = new DateTime( $datapagamento );
        
        $diasatraso = $datainicial->diff($datafinal)      ;

        $dias = $diasatraso->d;
        if ( $diasatraso->invert == 1 )
           $dias = $dias * -1;

//        return $dias;

        if( $dias > 0 )
        {
            $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', $empresa)->orderBy( 'IMB_TBM_DE')->get();

            $multa = 0;
            $multaimob = 0;

            if( $contrato->IMB_CTR_MULTA == 0 )
            {
                foreach ($tm as $faixa) 
                {
                    if  ( ( $dias >= $faixa->IMB_TBM_DE ) &&
                        ( $dias <= $faixa->IMB_TBM_ATE ) ||
                        ( $dias > $faixa->IMB_TBM_ATE ) )
                    {
                        if ( $faixa->IMB_TMB_DAIMOBILIARIA == 'S')
                        $multaimob = $multaimob + $faixa->IMB_TBM_PERCENTUAL;
                        else
                        $multa = $multa + $faixa->IMB_TBM_PERCENTUAL;

                    }
                }
            }
            else
            {
                $multa = $contrato->IMB_CTR_MULTA;
            }
        }

        $multaobj =new \stdClass;
        $multaobj->normal        = $valorbase * $multa / 100;
        $multaobj->imobiliaria   = $valorbase * $multaimob / 100;
        
        return $multaobj;


    }


    public function calcularJuros( $idcontrato, $datavencimento, $datapagamento, $valorbase  )
    {

        $contrato       = mdlContrato::find( $idcontrato );

        $tolerancia     = $contrato->IMB_CTR_TOLERANCIA;
        $empresa        = $contrato->IMB_IMB_ID;
        $limite         = $datavencimento;
        $diasatraso     = 0;

        
        $limite = date('Y-m-d', strtotime("+".$tolerancia." days",   strtotime($datavencimento)));

        $dia = date('w', strtotime($limite) );
        while ( ( $dia =='0' || $dia =='6' )  )
        {
            $limite= date('Y-m-d', strtotime("+1 days",   strtotime($limite) ) );
            $dia = date('w', strtotime($limite) );
        }

        $datainicial    = new DateTime( $limite );
        $datafinal      = new DateTime( $datapagamento );
        
        $diasatraso = $datainicial->diff($datafinal)      ;

        $dias = $diasatraso->d;
        if ( $diasatraso->invert == 1 )
           $dias = 0;

//        return $dias;

        $nValorJuros = 0;
        if( $dias > 0 )
        {
            $param = mdlParametros::where( 'IMB_IMB_ID','=', $empresa)->get();
                         
            if ( $param[0]->IMB_PRM_COBRARJUROS == 'S'  ||  $param[0]->IMB_CTR_JUROSDIARIO <> 0 )
            {   
                if ( $contrato->IMB_CTR_JUROSDIARIO <> 0 )
                   $nValorJuros = ( $valorbase * $contrato->IMB_CTR_JUROSDIARIO) / 100 * $dias;
                else
                if ( $param[0]->IMB_PRM_JUROSAPOSUMMES == 'S' && $dias > 30 )
                    $nValorJuros = ( $valorbase * $param[0]->IMB_PRM_JUROSMES / 30 ) / 100 * $dias;
                else
                if ( $param[0]->IMB_PRM_JUROSAPOSUMMES <> 'S' )
                    $nValorJuros =  ( $valorbase * $param[0]->IMB_PRM_JUROSMES / 30 ) / 100  *  $dias;
            }
        }

        
        $jurosobj =new \stdClass;
        $jurosobj->valorjuros       = $nValorJuros;
        $jurosobj->diasatraso       = $dias;
        
        return $jurosobj;

    }

    public function calcularCorrecao( $idcontrato, $datavencimento, $datapagamento, $valorbase  )
    {

        $contrato       = mdlContrato::find( $idcontrato );

        $tolerancia     = $contrato->IMB_CTR_TOLERANCIA;
        $empresa        = $contrato->IMB_IMB_ID;
        $limite         = $datavencimento;
        $diasatraso     = 0;

        
        $limite = date('Y-m-d', strtotime("+".$tolerancia." days",   strtotime($datavencimento)));

        $dia = date('w', strtotime($limite) );
        while ( ( $dia =='0' || $dia =='6' )  )
        {
            $limite= date('Y-m-d', strtotime("+1 days",   strtotime($limite) ) );
            $dia = date('w', strtotime($limite) );
        }

        $datainicial    = new DateTime( $limite );
        $datafinal      = new DateTime( $datapagamento );
        
        $diasatraso = $datainicial->diff($datafinal)      ;

        $dias = $diasatraso->d;
        if ( $diasatraso->invert == 1 )
           $dias = 0;

//        return $dias;

        $nValorCorrecao = 0;
        if( $dias > 0 )
        {
            $param = mdlParametros::where( 'IMB_IMB_ID','=', $empresa)->get();
               
            if ( $param[0]->IMB_PRM_COBRARCORRECAO == 'S'  ||  $contrato->IMB_CTR_PERMANDIARIA <> 0 )
            {   
                if ( $contrato->IMB_CTR_PERMANDIARIA <> 0 )
                   $nValorCorrecao =  $valorbase * $contrato->IMB_CTR_PERMANDIARIA * $dias;
                else
                if ( $param[0]->IMB_PRM_CORRECAOMES <> 0 )
                    $nValorCorrecao =  ( $valorbase * $param[0]->IMB_PRM_CORRECAOMES / 30 ) / 100  *  $dias;
            }
        }

        
        $jurosobj =new \stdClass;
        $jurosobj->valorcorrecao    = $nValorCorrecao;
        $jurosobj->diasatraso       = $dias;
        
        return $jurosobj;

    }

    public function calcularIrrf( $idcontrato, $datavencimento, $datapagamento, $valorbase  )
    {

        $continuar = 'S';

        $contrato       = mdlContrato::find( $idcontrato );
        
        $lctctr = mdlLocatarioContrato::
        where('IMB_CTR_ID', '=', $idcontrato )
        ->where('IMB_LCTCTR_PRINCIPAL','=','S')
        ->first();

        $codlocatarioprincipal = $lctctr->IMB_CLT_ID;

        $empresa        = $contrato->IMB_IMB_ID;

        $locatario = mdlCliente::find( $codlocatarioprincipal );

        if( $locatario->IMB_CLT_PESSOA <> 'J')
            $continuar = 'N';

        $param2 = mdlParametros2::where( 'IMB_IMB_ID','=', $empresa)->first();

        if( $param2->IMB_PRM_IRRFRESPEITARCTR =='S' && $contrato->IMB_CTR_IRRF <> 'S' )
            $continuar = 'N';

        if( $param2->IMB_PRM_NUNCAIRRF =='S' ) 
            $continuar = 'N';

        $arrayirrf = array();


        if( $continuar == 'S' )
        {

            $nValortIrrfTotal = 0;

            $lf = mdlLancamentoFuturo::where('IMB_TBE_ID','=','18')
            ->where( 'IMB_CTR_ID','=', $idcontrato )
            ->where( 'IMB_LCF_DATAVENCIMENTO','=',$datavencimento)
            ->where( 'IMB_LCF_LOCATARIOCREDEB', '<>', 'N')
            ->get();

            if( ! count( $lf ) )
            {

                $pi = mdlPropImovel::where( 'IMB_IMV_ID','=',$contrato->IMB_IMV_ID)->get();

                foreach ($pi as $proprietario) 
                {

                    $cliente = mdlCliente::find( $proprietario->IMB_CLT_ID );

                    if( $cliente->IMB_CLT_PESSOA == 'F')
                    {

                        $baseprop = $valorbase * $proprietario->IMB_IMVCLT_PERCENTUAL4 / 100;

                        $tabelairrf = mdlTabelaIRRF::whereRaw( $baseprop.' between  IMB_TIR_DE and IMB_TIR_ATE')->get();

                        if( count( $tabelairrf ) )
                        {

                            $percirrf = $tabelairrf[0]->IMB_TIR_PERCENTUAL;
                            $deducao = $tabelairrf[0]->IMB_TIR_DEDUCAO;
                            
                            $valorirrf =  ( $baseprop * $percirrf / 100 ) - $deducao;

                            $objirrf =new \stdClass;
                            $objirrf->idcliente = $cliente->IMB_CLT_ID;
                            $objirrf->cliente = $cliente->IMB_CLT_NOME;
                            $objirrf->valor = $valorirrf;
                            $objirrf->descricao = 'RETENÇÃO IRRF - '.
                                                $cliente->IMB_CLT_NOME.' - CPF: '.$cliente->IMB_CLT_CPF;
                                
                            array_push( $arrayirrf, $objirrf );
               

                        }

                    }

                }

            }

        }
    
        return$arrayirrf; 
    }


    public function calcularRecebimento( $idcontrato, $datavencimento, $datapagamento )
    {

        $lancamentos = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=', $idcontrato )
                ->where( 'IMB_LCF_DATAVENCIMENTO', '<=', $datavencimento )
                ->where( 'IMB_LCF_LOCATARIOCREDEB', '<>', 'N' )
                ->whereNull('IMB_LCF_DATARECEBIMENTO')
                ->orderBy('IMB_TBE_ID','DESC')
                ->get();

        $registros = array();

        $basemulta      = 0;
        $basejuros      = 0;
        $basecorrecao   = 0;
        $basetaxa       = 0;
        $baseirrf       = 0;
        foreach ($lancamentos as $lancamento ) 
        {


            $evento = mdlEvento::find( $lancamento->IMB_TBE_ID );

            $objdet =new \stdClass;
            $objdet->IMB_TBE_ID         = $lancamento->IMB_TBE_ID;
            $objdet->IMB_TBE_NOME       = $evento->IMB_TBE_NOME;
            $objdet->TMP_CREDITODEBITO  = $lancamento->IMB_LCF_LOCATARIOCREDEB;
            $objdet->TMP_LOCADORDEBCRE  = $lancamento->IMB_LCF_LOCADORCREDEB;
            $objdet->TMP_VALOR          = $lancamento->IMB_LCF_VALOR;
            $objdet->IMB_TBE_OBSERVACAO = $lancamento->IMB_LCF_OBSERVACAO;
            $objdet->IMB_LCF_ID         = $lancamento->IMB_LCF_ID;
            if ( $lancamento->FIN_CFC_ID == '' )
                $objdet->FIN_CFC_ID         = $evento->FIN_CFC_ID;
            else
                $objdet->FIN_CFC_ID         = $lancamento->FIN_CFC_ID;
            $objdet->DataVencimento         = $lancamento->IMB_LCF_DATAVENCIMENTO;
            
            $objdet->MAISMENOS         = ' ';

            if ( $lancamento->IMB_LCF_LOCATARIOCREDEB =='C' )
                $objdet->MAISMENOS         = '-';
            else
            if ( $lancamento->IMB_LCF_LOCATARIOCREDEB =='D' )
                $objdet->MAISMENOS         = '+';
            
            $retornobases = $this->baseLocatario(  $lancamento->IMB_TBE_ID, 
                            $lancamento->IMB_LCF_ID, 
                            $lancamento->IMB_LCF_LOCATARIOCREDEB,                             
                            $lancamento->IMB_LCF_VALOR );                             

            $basemulta = $basemulta + $retornobases->basemulta;
            $basejuros = $basejuros + $retornobases->basejuros;
            $basecorrecao = $basecorrecao + $retornobases->basecorrecao;
            $baseirrf = $baseirrf + $retornobases->baseirrf;
            $basetaxa = $basetaxa + $retornobases->basetaxa;

            array_push( $registros, $objdet );


        }

        if( $basemulta <> 0 )
        {
            $multaobj = $this->calcularMulta( $idcontrato, $datavencimento, $datapagamento, $basemulta  );
            if( $multaobj->normal <> 0 )
            {
                $evento = mdlEvento::find( 2 );

                $objdet =new \stdClass;
                $objdet->IMB_TBE_ID         = 2;
                $objdet->IMB_TBE_NOME       = 'Multa por atraso';
                $objdet->TMP_CREDITODEBITO  = 'D';
                $objdet->TMP_LOCADORDEBCRE  = 'N';
                $objdet->TMP_VALOR          = $multaobj->normal;
                $objdet->FIN_CFC_ID         = $evento->FIN_CFC_ID;
                $objdet->DataVencimento      = $datavencimento;
                $objdet->MAISMENOS         = '+';
                array_push( $registros, $objdet );
            }



            if( $basejuros <> 0 )
            {
                $jurosobj = $this->calcularJuros( $idcontrato, $datavencimento, $datapagamento, $basemulta  );
                if( $jurosobj->valorjuros <> 0 )
                {
                    $evento = mdlEvento::find( 3 );
    
                    $objdet =new \stdClass;
                    $objdet->IMB_TBE_ID         = 3;
                    $objdet->IMB_TBE_NOME       = 'Juros por atraso';
                    $objdet->TMP_CREDITODEBITO  = 'D';
                    $objdet->TMP_LOCADORDEBCRE  = 'N';
                    $objdet->TMP_VALOR          = $jurosobj->valorjuros;
                    $objdet->FIN_CFC_ID         = $evento->FIN_CFC_ID;
                    $objdet->IMB_TBE_OBSERVACAO = 'Ref. '.$jurosobj->diasatraso;
                    $objdet->DataVencimento      = $datavencimento;
                    $objdet->MAISMENOS         = '+';
                    array_push( $registros, $objdet );
                }
    
                //echo $multa;
    
            }

            if( $basecorrecao <> 0 )
            {
                $correcaoobj = $this->calcularCorrecao( $idcontrato, $datavencimento, $datapagamento, $basemulta  );
                if( $correcaoobj->valorcorrecao <> 0 )
                {
                    $evento = mdlEvento::find( 4 );
    
                    $objdet =new \stdClass;
                    $objdet->IMB_TBE_ID         = 4;
                    $objdet->IMB_TBE_NOME       = 'Correção Monetária';
                    $objdet->TMP_CREDITODEBITO  = 'D';
                    $objdet->TMP_LOCADORDEBCRE  = 'N';
                    $objdet->TMP_VALOR          = $correcaoobj->valorcorrecao;
                    $objdet->FIN_CFC_ID         = $evento->FIN_CFC_ID;
                    $objdet->IMB_TBE_OBSERVACAO = 'Ref. '.$correcaoobj->diasatraso;
                    $objdet->DataVencimento      = $datavencimento;
                    $objdet->MAISMENOS         = '+';
                    array_push( $registros, $objdet );
                }
    
                //echo $multa;
    
            }

            if( $baseirrf <> 0 )
            {
                $irrfobj = $this->calcularIrrf( $idcontrato, $datavencimento, $datapagamento, $basemulta  );

                foreach ($irrfobj as $key => $value)
                {

//                return $irrfobj;
                    if( $value->valor <> 0 )
                    {
                        $evento = mdlEvento::find( 18 );
                    
//                    return $irrfobj;

                        $objdet =new \stdClass;
                        $objdet->IMB_TBE_ID         = 18;
                        $objdet->IMB_TBE_NOME       = 'I.R.R.F.';
                        $objdet->TMP_CREDITODEBITO  = 'C';
                        $objdet->TMP_LOCADORDEBCRE  = 'D';
                        $objdet->TMP_VALOR          = $value->valor;
                        $objdet->FIN_CFC_ID         = $evento->FIN_CFC_ID;
                        $objdet->IMB_TBE_OBSERVACAO = $value->descricao;
                        $objdet->DataVencimento      = $datavencimento;
                        $objdet->MAISMENOS         = '+';
                        array_push( $registros, $objdet );
                    }
                }
    
                //echo $multa;
    
            }

            //echo $multa;

        }




//        return "BaseMulta:$basemulta - BaseJuros:$basejuros - 
            //BaseCorrecao:$basecorrecao - Basetaxa:$basetaxa  -  - Baseirrf:$baseirrf";
        
        return response()->json($registros); 

    }
    //
}
