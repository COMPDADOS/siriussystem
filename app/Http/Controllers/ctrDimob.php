<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlReciboLocador;
use App\mdlTabelaEvento;
use App\mdlContrato;
use App\mdlCliente;
use App\mdlImovel;
use App\mdlDimob;
use App\mdlImobiliaria;
use App\mdlLancamentoFuturo;
use DataTables;
use DB;
use Auth;
use Log;


class ctrDimob extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        return view( 'dimob.dimobindex');

    }

    public function telaGerar()
    {
        return view( 'dimob.dimobgerar');
    }

    public function gerar( Request $request)
    {
        $idcontrato = $request->IMB_CTR_ID;
        $idcliente = $request->IMB_CLT_ID;
        $idimovel = $request->IMB_IMV_ID;
        $anobase = $request->anobase;
        $imobiliaria = $request->imobiliaria;

        $dimob = mdlDimob::where( 'imb_imb_id','=',$imobiliaria )
            ->where('imb_dil_anobase','=', $anobase )
            ->whereRaw("not 
            ( COALESCE( imb_dil_janfechado, 'N' ) = 'S'  
            or COALESCE(imb_dil_fevfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_marfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_abrfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_maifechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_junfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_julfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_agofechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_setfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_outfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_novfechado,'N'  ) = 'S' 
            or COALESCE(imb_dil_dezfechado,'N'  ) = 'S' )");

            if( $idcontrato <> '' )
            $dimob = $dimob->where( 'imb_ctr_id','=', $idcontrato );
        
        $dimob = $dimob->delete();


        $recibos = mdlReciboLocador::distinct()
        ->select(['IMB_CLT_ID', 'IMB_CTR_ID'])
        ->whereRaw( ' year( IMB_RLD_DATAPAGAMENTO ) = '.$anobase )
        ->whereNull( 'IMB_RLD_DTHINATIVO')
        //->where(    'IMB_IMV_ID','=',115)
        ->distinct( ['IMB_CLT_ID','IMB_CTR_ID']);

        $imob = mdlImobiliaria::find( $imobiliaria );

        if( $idcontrato <> '' )
        $recibos = $recibos->where( 'IMB_CTR_ID','=', $idcontrato );

        $recibos = $recibos->get();// ['IMB_CLT_ID','IMB_RLD_NUMERO','IMB_RLD_DATAPAGAMENTO', 'IMB_CTR_ID']);

        //return $recibos;
        foreach ($recibos as $recibo) 
        {

            $contrato = mdlContrato::find( $recibo->IMB_CTR_ID);

            if( $contrato <> '')
            {
                $cliente = mdlCliente::find( $recibo->IMB_CLT_ID);
                $cpflocador = str_replace( '-','', $cliente->IMB_CLT_CPF);
                $cpflocador = str_replace( '.','', $cpflocador);
                $cpflocador = str_replace( '/','', $cpflocador);
                
                $imovel = mdlImovel::find( $contrato->IMB_IMV_ID);
                $endereco =  app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $contrato->IMB_IMV_ID); 
                $endereco =  app('App\Http\Controllers\ctrRotinas')->tirarEspeciais( $endereco );
                $endereco = substr( $endereco,0,60);
                $cep = $imovel->IMB_IMV_ENDERECOCEP;
                $cep = str_replace( '-','', $cep);
                
                $codigolocatario =  app('App\Http\Controllers\ctrRotinas')->codigoLocatarioPrincipal( $contrato->IMB_CTR_ID);
                $locatario = mdlCliente::find( $codigolocatario );
                $cpflocatario = str_replace( '-','', $locatario->IMB_CLT_CPF);
                $cpflocatario = str_replace( '.','', $cpflocatario);
                $cpflocatario = str_replace( '/','', $cpflocatario);

                //CRIANDO OS REGISTROS
                $dimob = new mdlDimob;
                $dimob->imb_imv_id = $imovel->IMB_IMV_ID;
                $dimob->IMB_IMB_ID = $imobiliaria;
                $dimob->imb_imb_cnpj = $imob->IMB_IMB_CGC;
                $dimob->imb_imb_nomeresponsavel = $imob->IMB_IMB_RESPONSAVEL;
                $dimob->imb_imb_cpfresposavel= $imob->IMB_IMB_REPRESENTANTECPF;
                $dimob->imb_imv_enderecoempresa =$imob->IMB_IMB_ENDERECO.' '.
                            $imob->IMB_IMB_ENDERECOCOMPLEMENTO.' '.
                            $imob->IMB_IMB_ENDERECONUMERO;
                $dimob->imb_imv_cidadecoempresa =$imob->CEP_CID_NOME;
                $dimob->imb_imv_estadoempresa=$imob->CEP_UF_SIGLA;
                $dimob->imb_clt_idlocador = $recibo->IMB_CLT_ID;
                $dimob->imb_clt_nomelocador = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais( $cliente->IMB_CLT_NOME);
                $dimob->imb_clt_cpflocador = $cpflocador;
                $dimob->imb_clt_idlocatario = $codigolocatario;
                $dimob->imb_clt_nomelocatario = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais( $locatario->IMB_CLT_NOME);
                $dimob->imb_clt_cpflocatario = $cpflocatario;
                $dimob->imb_ctr_ID = $contrato->IMB_CTR_ID;
                $dimob->imb_ctr_referencia = $contrato->IMB_CTR_ID;
                $dimob->imb_ctr_inicio = $contrato->IMB_CTR_INICIO;
                $dimob->imb_dil_tipoimovel = 'U';
                $dimob->imb_imv_endereco =  $endereco;
                $dimob->imb_imv_cidade   =   $imovel->IMB_IMV_CIDADE;
                $dimob->imb_imv_estado = $imovel->IMB_IMV_ESTADO;
                $dimob->imb_imv_cep = $cep;
                $dimob->imb_imv_seleleciona = $imovel->IMB_IMV_RELIRRF;
                $dimob->imb_imv_codigocidaderaiz = $imovel->imb_imv_codigocidaderaiz;
                $dimob->imb_dil_anobase =  $anobase;

                $reciboscompletos = mdlReciboLocador::where( 'IMB_CTR_ID','=', $recibo->IMB_CTR_ID )
                ->where('IMB_CLT_ID','=', $recibo->IMB_CLT_ID )
                ->whereRaw( ' year( IMB_RLD_DATAPAGAMENTO ) = '.$anobase )
                ->whereNull('IMB_RLD_DTHINATIVO')
                ->get();


                $nBruto        = 0;
                $nComissao     = 0;
                $nIrrf         = 0;

                $dimob->imb_dil_janbruto =0;
                $dimob->imb_dil_jancomissao= 0;
                $dimob->imb_dil_janretido= 0;
                $dimob->imb_dil_janrecibos= '1';
                $dimob->imb_dil_fevbruto= 0;
                $dimob->imb_dil_fevcomissao= 0;
                $dimob->imb_dil_fevretido= 0;
                $dimob->imb_dil_fevrecibos= '1';
                $dimob->imb_dil_marbruto= 0;
                $dimob->imb_dil_marcomissao= 0;
                $dimob->imb_dil_marretido= 0;
                $dimob->imb_dil_marrecibos= '1';
                $dimob->imb_dil_abrbruto= 0;
                $dimob->imb_dil_abrcomissao= 0;
                $dimob->imb_dil_abrretido= 0;
                $dimob->imb_dil_abrrecibos= '1';
                $dimob->imb_dil_maibruto= 0;
                $dimob->imb_dil_maicomissao= 0;
                $dimob->imb_dil_mairetido= 0;
                $dimob->imb_dil_mairecibos= '1';
                $dimob->imb_dil_junbruto= 0;
                $dimob->imb_dil_juncomissao= 0;
                $dimob->imb_dil_junretido= 0;
                $dimob->imb_dil_junrecibos= '1';
                $dimob->imb_dil_julbruto= 0;
                $dimob->imb_dil_julcomissao= 0;
                $dimob->imb_dil_julretido= 0;
                $dimob->imb_dil_julrecibos= '1';
                $dimob->imb_dil_agobruto= 0;
                $dimob->imb_dil_agocomissao= 0;
                $dimob->imb_dil_agoretido= 0;
                $dimob->imb_dil_agorecibos= '1';
                $dimob->imb_dil_setbruto= 0;
                $dimob->imb_dil_setcomissao= 0;
                $dimob->imb_dil_setretido= 0;
                $dimob->imb_dil_setrecibos= '1';
                $dimob->imb_dil_outbruto= 0;
                $dimob->imb_dil_outcomissao= 0;
                $dimob->imb_dil_outretido= 0;
                $dimob->imb_dil_outrecibos= '1';
                $dimob->imb_dil_novbruto= 0;
                $dimob->imb_dil_novcomissao= 0;
                $dimob->imb_dil_novretido= 0;
                $dimob->imb_dil_novrecibos= '1';
                $dimob->imb_dil_dezbruto= 0;
                $dimob->imb_dil_dezcomissao= 0;
                $dimob->imb_dil_dezretido= 0;
                $dimob->imb_dil_dezrecibos= 0;
                $dimob->imb_dil_janfechado='N';
                $dimob->imb_dil_fevfechado='N';
                $dimob->imb_dil_marfechado='N';
                $dimob->imb_dil_abrfechado='N';
                $dimob->imb_dil_maifechado='N';
                $dimob->imb_dil_junfechado='N';
                $dimob->imb_dil_julfechado='N';
                $dimob->imb_dil_agofechado='N';
                $dimob->imb_dil_setfechado='N';
                $dimob->imb_dil_outfechado='N';
                $dimob->imb_dil_novfechado='N';
                $dimob->imb_dil_dezfechado='N';

                
                foreach( $reciboscompletos as $recibocompleto )
                {
                    $eventos = mdlTabelaEvento::find( $recibocompleto->IMB_TBE_ID );
                    $mes = date( 'm', strtotime($recibocompleto->IMB_RLD_DATAPAGAMENTO) );    


                    $nBruto        = 0;
                    $nComissao     = 0;
                    $nIrrf         = 0;

                    $incirrf = 'N';
                    if( $eventos )
                        $incirrf = $eventos->IMB_TBE_IRRF;
                    
                    $inciss = 'N';
                    if( $eventos )
                        $inciss = $eventos->IMB_TBE_INCISS;
    
                    if( $recibocompleto->IMB_LCF_ID <> '' )
                    {
                        $lf = mdlLancamentoFuturo::find($recibocompleto->IMB_LCF_ID);
                        if($lf )
                            $incirrf = $lf->IMB_LCF_INCIRRF;
                    }

                    if ( $incirrf == 'S' )
                    {
                        if( $recibocompleto->IMB_RLD_LOCADORCREDEB == 'C' )
                            $nBruto = $recibocompleto->IMB_RLD_VALOR;
                        else
                        if( $recibocompleto->IMB_RLD_LOCADORCREDEB == 'D' )
                            $nBruto = $recibocompleto->IMB_RLD_VALOR * -1;
             
                    }

                    if( $inciss == 'S' ) 
                    {
                        if( $recibocompleto->IMB_RLD_LOCADORCREDEB == 'C' )
                            $nComissao = $recibocompleto->IMB_RLD_VALOR;
                        else
                        if( $recibocompleto->IMB_RLD_LOCADORCREDEB == 'D' )
                            $nComissao = $recibocompleto->IMB_RLD_VALOR * -1;
                    }

                    if( $recibocompleto->IMB_TBE_ID == 18 or $recibocompleto->IMB_TBE_ID == -18 ) 
                    {
                        if( $recibocompleto->IMB_RLD_LOCADORCREDEB == 'C' )
                            $nIrrf = $recibocompleto->IMB_RLD_VALOR;
                        else
                        if( $recibocompleto->IMB_RLD_LOCADORCREDEB == 'D' )
                            $nIrrf = $recibocompleto->IMB_RLD_VALOR *  -1;
                    }



                    if( intval($mes) == 1)
                    {
                        $dimob->imb_dil_janbruto = $dimob->imb_dil_janbruto      + $nBruto;
                        $dimob->imb_dil_jancomissao= $dimob->imb_dil_jancomissao + abs($nComissao);
                        $dimob->imb_dil_janretido= $dimob->imb_dil_janretido     + abs($nIrrf);
                    }
                    if( intval($mes) == 2)
                    {
                        $dimob->imb_dil_fevbruto    = $dimob->imb_dil_fevbruto      + $nBruto;
                        $dimob->imb_dil_fevcomissao = $dimob->imb_dil_fevcomissao   + abs($nComissao);
                        $dimob->imb_dil_fevretido   = $dimob->imb_dil_fevretido     + abs($nIrrf);        
                    }
                    if( intval($mes) == 3)
                    {
                        $dimob->imb_dil_marbruto    = $dimob->imb_dil_marbruto      + $nBruto;
                        $dimob->imb_dil_marcomissao = $dimob->imb_dil_marcomissao   + abs($nComissao);
                        $dimob->imb_dil_marretido   = $dimob->imb_dil_marretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 4)
                    {
                        $dimob->imb_dil_abrbruto    = $dimob->imb_dil_abrbruto      + $nBruto;
                        $dimob->imb_dil_abrcomissao = $dimob->imb_dil_abrcomissao   + abs($nComissao);
                        $dimob->imb_dil_abrretido   = $dimob->imb_dil_abrretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 5)
                    {
                        $dimob->imb_dil_maibruto    = $dimob->imb_dil_maibruto      + $nBruto;
                        $dimob->imb_dil_maicomissao = $dimob->imb_dil_maicomissao   + abs($nComissao);
                        $dimob->imb_dil_mairetido   = $dimob->imb_dil_mairetido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 6)
                    {
                        $dimob->imb_dil_junbruto    = $dimob->imb_dil_junbruto      + $nBruto;
                        $dimob->imb_dil_juncomissao = $dimob->imb_dil_juncomissao   + abs($nComissao);
                        $dimob->imb_dil_junretido   = $dimob->imb_dil_junretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 7)
                    {
                        $dimob->imb_dil_julbruto    = $dimob->imb_dil_julbruto      + $nBruto;
                        $dimob->imb_dil_julcomissao = $dimob->imb_dil_julcomissao   + abs($nComissao);
                        $dimob->imb_dil_julretido   = $dimob->imb_dil_julretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 8)
                    {
                        $dimob->imb_dil_agobruto    = $dimob->imb_dil_agobruto      + $nBruto;
                        $dimob->imb_dil_agocomissao = $dimob->imb_dil_agocomissao   + abs($nComissao);
                        $dimob->imb_dil_agoretido   = $dimob->imb_dil_agoretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 9)
                    {
                        $dimob->imb_dil_setbruto    = $dimob->imb_dil_setbruto      + $nBruto;
                        $dimob->imb_dil_setcomissao = $dimob->imb_dil_setcomissao   + abs($nComissao);
                        $dimob->imb_dil_setretido   = $dimob->imb_dil_setretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 10)
                    {
                        $dimob->imb_dil_outbruto    = $dimob->imb_dil_outbruto      + $nBruto;
                        $dimob->imb_dil_outcomissao = $dimob->imb_dil_outcomissao   + abs($nComissao);
                        $dimob->imb_dil_outretido   = $dimob->imb_dil_outretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 11)
                    {
                        $dimob->imb_dil_novbruto    = $dimob->imb_dil_novbruto      + $nBruto;
                        $dimob->imb_dil_novcomissao = $dimob->imb_dil_novcomissao   + abs($nComissao);
                        $dimob->imb_dil_novretido   = $dimob->imb_dil_novretido     + abs($nIrrf);        
                    }

                    if( intval($mes) == 12)
                    {
                        $dimob->imb_dil_dezbruto    = $dimob->imb_dil_dezbruto      + $nBruto;
                        $dimob->imb_dil_dezcomissao = $dimob->imb_dil_dezcomissao   + abs($nComissao);
                        $dimob->imb_dil_dezretido   = $dimob->imb_dil_dezretido     + abs($nIrrf);        
                    }


                }

                $dimob->save();
                


            }

            
        }
/*
        $dimob = mdlDimob::where( 'imb_imb_id','=',$imobiliaria )
        ->where('imb_dil_anobase','=', $anobase );

        if( $idcontrato <> '' )
        $dimob = $dimob->where( 'imb_ctr_id','=', $idcontrato );
    
        return DataTables::of($dimob)->make(true);        
*/
        return response()->json('ok',200);


    }

    public function consularBase( Request $request)
    {
        $idcontrato = $request->IMB_CTR_ID;
        $idcliente = $request->IMB_CLT_ID;
        $idimovel = $request->IMB_IMV_ID;
        $anobase = $request->anobase;
        $imobiliaria = $request->imobiliaria;

        $dimob = mdlDimob::where( 'imb_imb_id','=',$imobiliaria )
            ->where('imb_dil_anobase','=', $anobase );

        if( $idcontrato <> '' )
            $dimob = $dimob->where( 'imb_ctr_id','=', $idcontrato );
        
        return DataTables::of($dimob)->make(true);        
    }

    
 }
