<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlLancamentoFuturo;
use App\mdlFeriado;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlContrato;
use App\mdlImovel;
use App\mdlFiadorContrato;
use App\mdlCliente;
use App\mdlContratoCobrancaBancaria;
use App\mdlContratoHistoricoReajuste;
use App\mdlContratoHistoricoRenovacao;
use App\mdlTabelaMulta;
use App\mdlTabelaEvento;
use App\mdlCondominio;
use App\mdlStatusImovel;
use App\mdlTabelaCorrecao;
use App\mdlIndiceReajuste;
use App\mdlTMPAtrasadoHeader;
use App\mdlTMPAtrasadoDetail;
use App\mdlCobrancaRealizada;
use App\mdlAltVen;
use App\mdlCamposMesclagem;
use App\mdlObs;
use App\mdlLog;
use App\mdlImobiliaria;
use App\mdlMotivoRescisao;
use App\mdlPropImovel;
use App\mdlEmpresa;
use App\mdlEnderecoCobranca;
use App\mdlRedeBancaria;
use App\mdlCamposSistema;
use App\mdlAtendente;
use App\mdlTmpTaxaRecebida;
use App\mdlReciboLocador;
use App\mdlReciboLocatario;
use App\mdlLeads;
use App\mdlBairro;
use App\mdlRecursos;
use App\mdlAtendenteDireitoAcesso;
use App\mdlFormaPagamento;
use App\mdlRegiaoCidade;

use DB;
use Auth;
use DateTime;
use Config;
use DataTables;
use Log;
use DateInterval;


use PDF;
use Picqer;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Illuminate\Support\Facades\URL;
use SplFileObject;


class ctrRotinas extends Controller
{


   public function __construct()
   {

       $this->middleware('auth');
   }


   public function gerarParcelamento( $dia, $meses, $datainicial, $valor, $usarparcelavalor )
   {


      //usarparcelavalor  - se for S então será o mesmo valor da parcela o valor do lancamento
      $dataPrimeiraParcela = explode( "-",$datainicial);

      $dia = $dataPrimeiraParcela[2];
      $mes = $dataPrimeiraParcela[1];
      $ano = $dataPrimeiraParcela[0];


        $valorparcela = $valor / $meses;
        $valorparcela = floor($valorparcela * 100) / 100;

        $diferenca = $valor - ($valorparcela * $meses );

        //return 'diferenca '.$diferenca;

        if( $usarparcelavalor == 'S' )
         $valorparcela = $valor;

        for($x = 0; $x <= $meses-1; $x++)
        {
            $dt_parcelas[$x] = date("Y-m-d",strtotime("+".$x." month",strtotime($datainicial ) )) ;
        }//for


        $linha='';


        $myArray = array();
      foreach($dt_parcelas as $indice => $datas)
      {
         if ( ( $linha == '' ) and ( $usarparcelavalor <> 'S' ) )
         {
            $valorprimeira = $valorparcela + $diferenca;
            $linha = $linha . '<tr><td>'.$datas.'</td><td>'.$valorprimeira.'</td></tr>';
            $arraylinha = array( 'data' => $datas, 'valor' => $valorprimeira );
         }
         else
         {
            $linha = $linha . '<tr><td>'.$datas.'</td><td>'.$valorparcela.'</td></tr>';
            $arraylinha = array( 'data' => $datas, 'valor' => $valorparcela );
         }

         array_push($myArray,$arraylinha);

      }

       return $myArray;
       //foreach
   }//function


   public function proximoDiaUtilemDias( $datainicial, $datafinal )
   {

      $datainicial = implode('-', array_reverse(explode('/', $datainicial)));
      $datafinal = implode('-', array_reverse(explode('/', $datafinal)));

      // converte as datas para o formato timestamp
      $d1 = strtotime($datainicial);
      $d2 = strtotime($datafinal);

      // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
      $datacalculada = ($d2 - $d1) /86400;

      // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
      if($datacalculada < 0)
        $datacalculada *= -1;



      return $datacalculada;


   }

   public function formaPagamento( $id )
   {
      //Log:info( 'For id'.$id );
      $fp = mdlFormaPagamento::find( $id );
      if ( $fp <> '' )
         return $fp->IMB_FORPAG_NOME;

         
      
      return "-";

   }


   //posicionar para o proximo dia util
   public function proximodiaUtil( Request $request )
   {
      $datavencimento = $request->datavencimento;

      $datavencimento = implode('-', array_reverse(explode('/', $datavencimento)));

      $dnovadata = date("Y-m-d", strtotime($datavencimento));

//      dd('Nova data '.$dnovadata.' - datavencimetno '.$datavencimento );

      $diasemana  = date('w', strtotime($dnovadata));

      $ndia = date('d', strtotime($dnovadata));
      $nmes = date('m', strtotime($dnovadata));
      $nano = date('Y', strtotime($dnovadata));
      $diaferiado =false;

      $tbfer = mdlFeriado::where( 'GER_FRD_DIA','=',$ndia )
      ->where( 'GER_FRD_MES','=',$nmes)
      ->whereRaw( "( GER_FRD_ANO = $nano or GER_FRD_TODOSANOS = 'S' )")
      ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
      ->get();
      if( $tbfer <> '[]' )
         $diaferiado = true;

      while ( ( $diasemana == 0 ) or ( $diasemana==6 ) or ($diaferiado) )
      {

         $dnovadata = date('Y-m-d', strtotime( $dnovadata . " +1 days"));
         $diasemana  = date('w', strtotime($dnovadata));
         $ndia = date('d', strtotime($dnovadata));
         $nmes = date('m', strtotime($dnovadata));
         $nano = date('Y', strtotime($dnovadata));

         $tbfer = mdlFeriado::where( 'GER_FRD_DIA','=',$ndia )
         ->where( 'GER_FRD_MES','=',$nmes)
         ->where( 'GER_FRD_ANO','=',$nano)
         ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
         ->get();


         $diaferiado =false;

         if( $tbfer <> '[]' )
            $diaferiado = true;

      };
      return response()->json( $dnovadata, 200 );

   }


   public function diasVencido( $datavencimento, $datapagamento)
   {

      $datavencimento = implode('-', array_reverse(explode('/', $datavencimento)));
      $datapagamento = implode('-', array_reverse(explode('/', $datapagamento)));
      $datavencimento = date("Y-m-d", strtotime($datavencimento));
      $datapagamento = date("Y-m-d", strtotime($datapagamento));
      $datapagamento =new DateTime($datapagamento);
      $datavencimento =new DateTime($datavencimento);

      $diff=$datavencimento->diff($datapagamento);
      // converte as datas para o formato timestamp
      //$diff=date_diff($datavencimento,$datapagamento);

      $dias =  $diff->days;
      if ($datapagamento < $datavencimento)
         $dias = $dias * -1;

      return $dias;
   }

   public function pegarBasesContrato( $idContrato )
   {

      $param  = mdlParametros::find( Auth::user()->IMB_IMB_ID );

      $ctr    = mdlContrato::find( $idContrato );

      $nJurosDiario        = 0;
      $nCorrecao           = 0;
      $nValorBoleto        = 0;
      $aluguelGarantido    = 'N';

      if( $param )
      {

         $cobrarJuros      = $param->IMB_PRM_COBRARJUROS;
         $nValorBoleto      = $param->IMB_PRM_COBBANVALOR;

         $cobrarCorrecao   = $param->IMB_PRM_COBRARCORRECAO;
         $nJurosDiario     = $param->IMB_PRM_COBBANJUROSDIA;
         $nCorrecao        = $param->IMB_PRM_COBBANCORRECAO;

         if( $ctr )
         {
            if( $cobrarJuros == 'S' )
            {
               if( $ctr->IMB_CTR_JUROSDIARIO <> 0  )
                  $nJurosDiario     = $ctr->IMB_CTR_JUROSDIARIO;

               if( $ctr->IMB_CTR_PERMANDIARIA <> 0  )
                  $nCorrecao     = $ctr->IMB_CTR_PERMANDIARIA;
            }

            if( $ctr->IMB_CTR_COBRARBOLETO == 'S')
               if( $ctr->IMB_CTR_COBRANCAVALOR <> 0 )
                  $nValorBoleto = $ctr->IMB_CTR_COBRANCAVALOR;

            $aluguelGarantido = $ctr->IMB_CTR_ALUGUELGARANTIDO;

         };

      }
      if( $nCorrecao == 'null')
         $nCorrecao = 0;

      if( $nJurosDiario == 'null')
         $nJurosDiario = 0;

      if( $nValorBoleto == 'null')
         $nValorBoleto = 0;

      return  response()->json( [ 'jurosdiario' => $nJurosDiario,
                             'correcaodiaria' => $nCorrecao,
                             'valorboleto' => $nValorBoleto,
                              'aluguelgarantido' => $aluguelGarantido ],200 );

   }

   public function adicionarMeses( $dia, $meses, $datainicial )
   {
        //$dataPrimeiraParcela = explode( "/",$datainicial);

        $dia = date('d', $datainicial );
        $mes = date('m', $datainicial );
        $ano = date('YYYY', $datainicial );

        for($x = 0; $x <= $meses-1; $x++)
        {
         $dt_parcelas[$x] = date("Y-m-d",strtotime("+".$x." month",strtotime($datainicial ) )) ;

        }//for

        return $dt_parcelas;

        $linha='';


        $myArray = array();
      foreach($dt_parcelas as $indice => $datas)
      {
         if ( ( $linha == '' ) and ( $usarparcelavalor <> 'S' ) )
         {
            $valorprimeira = $valorparcela + $diferenca;
            $linha = $linha . '<tr><td>'.$datas.'</td><td>'.$valorprimeira.'</td></tr>';
            $arraylinha = array( 'data' => $datas, 'valor' => $valorprimeira );
         }
         else
         {
            $linha = $linha . '<tr><td>'.$datas.'</td><td>'.$valorparcela.'</td></tr>';
            $arraylinha = array( 'data' => $datas, 'valor' => $valorparcela );
         }

         array_push($myArray,$arraylinha);

      }

       return $myArray;
       //foreach
   }//function


   public function pegarEnderecoCobranca( $idcontrato )
   {
      $ctr = mdlContrato::find( $idcontrato );
      if( $ctr )
      {

         $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
         $objendereco = new \stdClass();
         $objendereco->IMB_CCB_DESTINATARIO = $this->nomeLocatarioPrincipal( $idcontrato );
         $objendereco->IMB_CCB_ENDERECO = $imv->IMB_IMV_ENDERECOTIPO.' '.
                                          $imv->IMB_IMV_ENDERECO;
         $objendereco->IMB_CCB_ENDERECONUMERO = $imv->IMB_IMV_ENDERECONUMERO;
         $objendereco->IMB_CCB_ENDERECOCOMPLEMENTO =
            $imv->IMB_IMV_NUMAPT.' '.
            $imv->IMB_IMV_ENDERECOCOMPLEMENTO;
         $objendereco->IMB_CCB_BAIRRO =  $this->pegarBairroImovel(  $ctr->IMB_IMV_ID );
         $objendereco->IMB_CCB_CEP     = $imv->IMB_IMV_ENDERECOCEP;
         $objendereco->CEP_CID_NOME     = $imv->IMB_IMV_CIDADE;
         $objendereco->CEP_UF_SIGLA     = $imv->IMB_IMV_ESTADO;

         $end = mdlContratoCobrancaBancaria::find( $idcontrato );
         if( $end <> '')
         {
            $objendereco->IMB_CCB_DESTINATARIO = $end->IMB_CCB_DESTINATARIO;
            $objendereco->IMB_CCB_ENDERECO = $end->IMB_CCB_ENDERECO;
            $objendereco->IMB_CCB_ENDERECONUMERO = $end->IMB_CCB_ENDERECONUMERO;
            $objendereco->IMB_CCB_ENDERECOCOMPLEMENTO = $end->IMB_CCB_ENDERECOCOMPLEMENTO;
            $objendereco->IMB_CCB_BAIRRO =  $end->IMB_CCB_BAIRRO;
            $objendereco->IMB_CCB_CEP     = $end->IMB_CCB_CEP;
            $objendereco->CEP_CID_NOME     = $end->CEP_CID_NOME;
            $objendereco->CEP_UF_SIGLA     = $end->CEP_UF_SIGLA;
         }
         

      }
      else
      {
         $objendereco = new \stdClass();
         $objendereco->IMB_CCB_DESTINATARIO = 'CONTRATO '.$idcontrato;
         $objendereco->IMB_CCB_ENDERECO = '';
         $objendereco->IMB_CCB_ENDERECONUMERO = '';
         $objendereco->IMB_CCB_ENDERECOCOMPLEMENTO = '';
         $objendereco->IMB_CCB_BAIRRO =  '';
         $objendereco->IMB_CCB_CEP     = '';
         $objendereco->CEP_CID_NOME     = '';
         $objendereco->CEP_UF_SIGLA     = '';

      }

      return $objendereco;

   }


   public function nomeLocatarioPrincipal( $idcontrato )
   {

      if( $idcontrato <> ''  )
         $locatario = collect( DB::select("select PEGALOCATARIOCONTRATO('$idcontrato') as ref "))->first()->ref;
      else
         $locatario = 'não encontrato';
      return $locatario;


   }

   public function codigoLocatarioPrincipal( $idcontrato )
   {
      if( $idcontrato <> ''  )
         $locatario = collect( DB::select("select PEGACODIGOLOCATARIOCONTRATO('$idcontrato') as ref "))->first()->ref;
      else
         $locatario = '0';
      
      return $locatario;


   }


   public function imovelEnderecoCompleto( $idimovel )
   {
      //Log:info( 'endereco');
      $imv = mdlImovel::find( $idimovel );
      $bairro = $this->pegarBairroImovel(  $idimovel );
      $imovel = '';
      if( $imv->IMB_CND_ID <> '' )
      {
         $cnd = mdlCondominio::find( $imv->IMB_CND_ID );
         if( $cnd )
         {
            $imovel = 'Condomínio '.$cnd->IMB_CND_NOME.', ';
      
         }
      }
      
      if( $imv->IMB_IMV_NUMAPT <> '' and $imv->IMB_IMV_NUMAPT <> '0' )
      {
         $imovel = $imovel.$imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.'Apto: '.$imv->IMB_IMV_NUMAPT.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
      }
      else
         $imovel = $imovel.$imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;

      $imovel = $imovel.', Cep: '.$imv->IMB_IMV_ENDERECOCEP.', bairro: '.$bairro.' na cidade de '.$imv->IMB_IMV_CIDADE.', estado de '.$imv->IMB_IMV_ESTADO;
      //else
         //$imovel = $imovel.$imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
      
      //Log:info( 'imovel '.$imovel );
      
      return $imovel;
   }
      
   public function imovelEndereco( $idimovel )
   {
      //Log:info( 'endereco');
      $imv = mdlImovel::find( $idimovel );
      $bairro = $this->pegarBairroImovel(  $idimovel );
      $imovel = '';
      if( $imv->IMB_CND_ID <> '' )
      {
         $cnd = mdlCondominio::find( $imv->IMB_CND_ID );
         if( $cnd )
         {
            $imovel = 'Condomínio '.$cnd->IMB_CND_NOME.', ';
      
         }
      }
      
      if( $imv->IMB_IMV_NUMAPT <> '' and $imv->IMB_IMV_NUMAPT <> '0' )
      {
         $imovel = $imovel.$imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.'Apto: '.$imv->IMB_IMV_NUMAPT.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
      }
      else
         $imovel = $imovel.$imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;

      //else
         //$imovel = $imovel.$imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
      
      //Log:info( 'imovel '.$imovel );
      
      return $imovel;
   }
   public function imovelEnderecoJson( $idimovel )
   {
      $imovel = collect( DB::select("select imovel('$idimovel') as ref "))->first()->ref;
      return  response()->json($imovel,200);
   }

   public function atualizarEmailLocatarioPrincipal( $idcontrato, $email )
   {
        $idlt = $this->codigoLocatarioPrincipal( $idcontrato);
        if( $idlt )
       {
           $clt = mdlCliente::find( $idlt);

           if( $clt )
           {
               $clt->IMB_CLT_EMAIL = $email;
               $clt->save();
           }
       };
   }


   public function clienteDadosFull( $id )
   {

      $cli = mdlCliente::find( $id );

      return $cli;

   }

   public function valorDescontoPontualidade( $idcontrato, $vencimento, $datapagamento, $descontoacordo,$destino )
   {

      $calcular = 1;

      $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );

      $ctr = mdlContrato::find( $idcontrato );

    

      ////Log:info( 'contrato: '.$idcontrato );
      ////Log:info( 'vencimento: '.$vencimento );
      ////Log:info( 'datapagamento: '.$datapagamento );
      ////Log:info( 'descontoacordo: '.$descontoacordo );

      $nBonificacaocalculada = 0;

      $datalimite = $this->dataLimite( $idcontrato, $vencimento );

      ////Log:info( 'datalimite: '.$datalimite );

      //verificando se já tem lancamento de desconto de pontualidade para este vencimento em aberto
      $lf = mdlLancamentoFuturo::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
                                ->where( 'IMB_TBE_ID','=', 5 )
                                ->where( 'IMB_CTR_ID','=', $idcontrato )
                                ->where( 'IMB_LCF_DATAVENCIMENTO','=', $vencimento);
      if( $destino == 'LT')
         $lf = $lf->whereNull( 'IMB_LCF_DATARECEBIMENTO');
      if( $destino == 'LD')
         $lf = $lf->whereNull( 'IMB_LCF_DATAPAGAMENTO');  
   

      $lf = $lf->whereNull( 'IMB_LCF_DTHINATIVADO');

      $lf = $lf->first();

      
      if( $lf <> '') 
      {
         $calcular = 0;
         //////Log:info('Encontrou no lf');
      }

      ////Log:info( 'calcular: '.$calcular );

      if( strtotime($datalimite) < strtotime($datapagamento) ) 
      {
         $calcular = 0;
         ////Log:info( 'strtotime($datalimite) < strtotime($datapagamento)' );
      }

      if( $ctr->IMB_CTR_PONTUALIDADEVALIDADE <> '' )
         if( strtotime($ctr->IMB_CTR_PONTUALIDADEVALIDADE) < strtotime($datalimite) )
         {
            $calcular = 0;
            ////Log:info( 'Perdeu a validade' );

         }
 

      if( $calcular == 1 )
      {
        $valorbonificacao = $ctr->IMB_CTR_VALORBONIFICACAO4;
        $tipo = $ctr->IMB_CTR_BONIFICACAOTIPO;

         $nBonificacaocalculada= $valorbonificacao;

         if( $tipo == 'P')
         {

            if( $par2->IMB_PRM_PONTUAL_SOB_ACORDO == 'S')
               $nBonificacaocalculada= ($ctr->IMB_CTR_VALORALUGUEL - $descontoacordo) *
                                          $valorbonificacao /100;
            else
              $nBonificacaocalculada= $ctr->IMB_CTR_VALORALUGUEL * $valorbonificacao /100;

         };


      }


      return $nBonificacaocalculada;

   }

   public function verificarEventoLancado( $idcontrato, $vencimento, $evento )
   {
      $lf = mdlLancamentoFuturo::select( [ 'IMB_LCF_VALOR' ])
      ->where( 'IMB_CTR_ID','=', $idcontrato)
      ->where('IMB_TBE_ID','=', $evento)
      ->where('IMB_LCF_DATAVENCIMENTO','=', $vencimento)
      ->whereNull('IMB_LCF_DATARECEBIMENTO')
      ->whereNull('IMB_LCF_DTHINATIVADO')
      ->first();

      if( $lf =='' )
         return 0;
      else
         return $lf->IMB_LCF_VALOR;

      //return $lf->IMB_LCF_VALOR;

   }

   public function tarifaBoleto( $idcontrato, $vencimento )
   {
      $lf = mdlContrato::select( [
                  'IMB_FORPAG_ID_LOCATARIO',
                  'IMB_CTR_COBRANCAVALOR',
                  'IMB_CTR_COBRARBOLETO'
                  ])
      ->where( 'IMB_CTR_ID','=', $idcontrato)
      ->get();

      $tarifalancada = app('App\Http\Controllers\ctrRotinas')
      ->verificarEventoLancado( $idcontrato, $vencimento, 23 );

      ////Log:info( "Tarifa: ".$tarifalancada );
      if( $tarifalancada <> 0)
         return $tarifalancada;

      $par = mdlParametros::find(  Auth::user()->IMB_IMB_ID );

      $tarifa = $tarifalancada;
      ////Log:info( "Cobrar tarifa: ".$lf[0]->IMB_CTR_COBRARBOLETO);
      if( $lf[0]->IMB_CTR_COBRARBOLETO == 'S' )
      {

         if( $tarifa == 0 )
         {
            if( $lf[0]->IMB_CTR_COBRANCAVALOR <> 0 )
               $tarifa = $lf[0]->IMB_CTR_COBRANCAVALOR;
            else
               $tarifa = $par->IMB_PRM_COBBANVALOR;
         }
      }

      return $tarifa;

   }

   public function dataLimite( $idcontrato, $vencimento )
   {
      $lf = mdlContrato::select( [
         DB::raw('coalesce(IMB_CTR_TOLERANCIA,0) as IMB_CTR_TOLERANCIA'),
         DB::raw('coalesce(IMB_CTR_TOLERANCIAFATOR,0) as IMB_CTR_TOLERANCIAFATOR')
                  ])
      ->where( 'IMB_CTR_ID','=', $idcontrato)
      ->first();

      $datavencimento = $vencimento;

      $datavencimento = implode('-', array_reverse(explode('/', $datavencimento)));
      $toleranciadias = $lf->IMB_CTR_TOLERANCIA;
 

      $dnovadata = date('Y-m-d', strtotime( $datavencimento . " +$toleranciadias days"));
  
//      $dnovadata = date("Y-m-d", strtotime($datavencimento));

   //      dd('Nova data '.$dnovadata.' - datavencimetno '.$datavencimento );

      $diasemana  = date('w', strtotime($dnovadata));

      $ndia = date('d', strtotime($dnovadata));
      $nmes = date('m', strtotime($dnovadata));
      $nano = date('Y', strtotime($dnovadata));
      $diaferiado =false;

      $tbfer = mdlFeriado::where( 'GER_FRD_DIA','=',$ndia )
      ->where( 'GER_FRD_MES','=',$nmes)
      ->where( 'GER_FRD_ANO','=',$nano)
      ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
      ->get();
      if( $tbfer <> '[]' )
         $diaferiado = true;

      while ( ( $diasemana == 0 ) or ( $diasemana==6 ) or ($diaferiado) )
      {

         $dnovadata = date('Y-m-d', strtotime( $dnovadata . " +1 days"));
         $diasemana  = date('w', strtotime($dnovadata));
         $ndia = date('d', strtotime($dnovadata));
         $nmes = date('m', strtotime($dnovadata));
         $nano = date('Y', strtotime($dnovadata));

         $tbfer = mdlFeriado::where( 'GER_FRD_DIA','=',$ndia )
         ->where( 'GER_FRD_MES','=',$nmes)
         ->where( 'GER_FRD_ANO','=',$nano)
         ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
         ->get();


         $diaferiado =false;

         if( $tbfer <> '[]' )
            $diaferiado = true;

      };
      return  $dnovadata;

   }

   //verificando se o contrato possui locatário pessoa fisica e também se está habilitado calcular irrf
   public function permitirIRRF( $idcontrato )
   {
      $idlocatario = app('App\Http\Controllers\ctrRotinas')
                     ->codigoLocatarioPrincipal( $idcontrato );

      $locatario =   app('App\Http\Controllers\ctrRotinas')
                     ->clienteDadosFull( $idlocatario );

      $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );

      $ctr = mdlContrato::find( $idcontrato );

      if( $locatario->IMB_CLT_PESSOA <> 'J' )
         return false;
  }


  public function calcularMulta( $idcontrato, $vencimento, $datapagamento, $basemulta )
   {


      $calcular = true;

      $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );

      $ctr = mdlContrato::find( $idcontrato );

      //echo "user Auth::user()->IMB_IMB_ID";
      $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();

      $datalimite = $this->dataLimite( $idcontrato, $vencimento );

      $datainicio = new DateTime( $datalimite );
      $datafim = new DateTime( $datapagamento );

      $datalimite = $this->proximodiaUtilSemJson( $datalimite);


      $difdias = 0;
      if( $datafim > $datainicio )
      {
         $intervalo = $datainicio->diff( $datafim);
         $difdias =  $intervalo->days;
      };


      $objmulta = new \stdClass();
      $objmulta->reterpercentual         = 0;
      $objmulta->reterdias               = 0;
      $objmulta->retervalor              = 0;
      $objmulta->repassarpercentual      = 0;
      $objmulta->repassardias            = 0;
      $objmulta->repassarvalor           = 0;
      $objmulta->diasatraso              = $difdias;


      if( $difdias > 0 )
      {

         if( $ctr->IMB_CTR_MULTA == 0 )
         {


            foreach( $tm as $multa )
            {
               if ( ( $difdias >= $multa->IMB_TBM_DE and $difdias <= $multa->IMB_TBM_ATE ) or
                  ( $difdias > $multa->IMB_TBM_ATE) )
               {
                  if( $multa->IMB_TMB_DAIMOBILIARIA =='S')
                  {
                     $objmulta->reterpercentual =
                     $objmulta->reterpercentual + $multa->IMB_TBM_PERCENTUAL;
                        $objmulta->reterdias       = $multa->IMB_TBM_ATE;
                  }
                  else
                  {
                     $objmulta->repassarpercentual =
                           $objmulta->repassarpercentual + $multa->IMB_TBM_PERCENTUAL;
                           $objmulta->repassardias       =  $multa->IMB_TBM_ATE;
                  }
               }
            }
         }
         else
         {
            if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S')
               $objmulta->reterpercentual    = $ctr->IMB_CTR_MULTA;
            else
               $objmulta->repassarpercentual = $ctr->IMB_CTR_MULTA;

         }

         if( $objmulta->reterpercentual <> 0 )
            $objmulta->retervalor     = $basemulta * $objmulta->reterpercentual / 100;

         if( $objmulta->repassarpercentual <> 0 )
            $objmulta->repassarvalor      = $basemulta * $objmulta->repassarpercentual / 100;

      }

      return $objmulta;

   }

   public function calcularMultaUmLancto( $idcontrato, $idlf, $datapagamento )
   {

      $objmulta = new \stdClass();
      $objmulta->reterpercentual         = 0;
      $objmulta->reterdias               = 0;
      $objmulta->retervalor              = 0;
      $objmulta->repassarpercentual      = 0;
      $objmulta->repassardias            = 0;
      $objmulta->repassarvalor           = 0;
      $objmulta->diasatraso              = 0;

      $calcular = true;

      $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );

      $ctr = mdlContrato::find( $idcontrato );

      //echo "user Auth::user()->IMB_IMB_ID";
      $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();

      $lf = mdlLancamentoFuturo::find( $idlf );   
      $basemulta = $lf->IMB_LCF_VALOR;
      if( $lf->IMB_LCF_LOCATARIOCREDEB =='C') $basemulta = $basemulta * -1;

      $datalimite = $lf->IMB_LCF_DATAVENCIMENTO;
      $datalimite = $this->proximodiaUtilSemJson( $datalimite);

      $datainicio = new DateTime( $datalimite );
      $datafim = new DateTime( $datapagamento );


      $difdias = 0;
      if( $datafim > $datainicio )
      {
         $intervalo = $datainicio->diff( $datafim);
         $difdias =  $intervalo->days;
         if( $lf->IMB_LCF_INCMUL <> 'S') 
         {
            return $objmulta;
         }

         $objmulta->diasatraso              = $difdias;
         if( $difdias > 0 )
         {
            if( $ctr->IMB_CTR_MULTA == 0 )
            {
               foreach( $tm as $multa )
               {
                  if ( ( $difdias >= $multa->IMB_TBM_DE and $difdias <= $multa->IMB_TBM_ATE ) or
                     ( $difdias > $multa->IMB_TBM_ATE) )
                  {
                     if( $multa->IMB_TMB_DAIMOBILIARIA =='S')
                     {
                        $objmulta->reterpercentual =
                        $objmulta->reterpercentual + $multa->IMB_TBM_PERCENTUAL;
                           $objmulta->reterdias       = $multa->IMB_TBM_ATE;
                     }
                     else
                     {
                        $objmulta->repassarpercentual =
                              $objmulta->repassarpercentual + $multa->IMB_TBM_PERCENTUAL;
                              $objmulta->repassardias       =  $multa->IMB_TBM_ATE;
                     }
                  }
               }
            }
            else
            {
               if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S')
                  $objmulta->reterpercentual    = $ctr->IMB_CTR_MULTA;
               else
                  $objmulta->repassarpercentual = $ctr->IMB_CTR_MULTA;

            }

            if( $objmulta->reterpercentual <> 0 )
               $objmulta->retervalor     = $basemulta * $objmulta->reterpercentual / 100;

            if( $objmulta->repassarpercentual <> 0 )
               $objmulta->repassarvalor      = $basemulta * $objmulta->repassarpercentual / 100;

         }
      }
      //////Log:info('5');

      
      return response()->json($objmulta,200);

   }


   public function calcularJurosUmLancto( $idcontrato, $idlf, $datapagamento )
   {

      $calcular = true;
      $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );
      $param = mdlParametros::find(  Auth::user()->IMB_IMB_ID );

      $ctr = mdlContrato::find( $idcontrato );

      //echo "user Auth::user()->IMB_IMB_ID";
      $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();

      $lf = mdlLancamentoFuturo::find( $idlf );   
      $basejuros = $lf->IMB_LCF_VALOR;
      if( $lf->IMB_LCF_LOCATARIOCREDEB =='C') $basejuros = $basejuros * -1;

      $datalimite = $lf->IMB_LCF_DATAVENCIMENTO;
      $datalimite = $this->proximodiaUtilSemJson( $datalimite);

      $datainicio = new DateTime( $datalimite );
      $datafim = new DateTime( $datapagamento );



      $difdias = 0;
      if( $datafim > $datainicio )
      {
         $intervalo = $datainicio->diff( $datafim);
         $difdias = $intervalo->days;
      };

   ;

      $objjuros = new \stdClass();
      $objjuros->jurosdias               = 0;
      $objjuros->jurospercentual         = 0;
      $objjuros->retervalor              = 0;
      $objjuros->repassarvalor           = 0;
      $objjuros->diasatraso           = 0;

      //////Log:info('dias');
      ////Log:info( $difdias);
      if( $difdias > 0 )
      {

         if( $param->IMB_PRM_COBRARJUROS == 'S' and $lf->IMB_LCF_INCJUROS =='S' )
         {

            $objjuros->jurospercentual = $ctr->IMB_CTR_JUROS;
            $objjuros->jurosdias =  $difdias;

            if(  $ctr->IMB_CTR_JUROS == 0 )
               $objjuros->jurospercentual = $param->IMB_PRM_COBBANJUROSDIA;

            if( $objjuros->jurospercentual <> 0 )
            {
               $valordojuros = ( ( $basejuros * $objjuros->jurospercentual ) * $difdias ) / 100;

               if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S')
                  $objjuros->retervalor    = $valordojuros;
               else
                  $objjuros->repassarvalor = $valordojuros;
            }
         }

      }
      return response()->json($objjuros,200);
   }



      
   public function calcularJuros( $idcontrato, $vencimento, $datapagamento, $basejuros )
   {

      $calcular = true;

      $par2 = mdlParametros2::find(  Auth::user()->IMB_IMB_ID );
      $param = mdlParametros::find(  Auth::user()->IMB_IMB_ID );

      $ctr = mdlContrato::find( $idcontrato );

      //echo "user Auth::user()->IMB_IMB_ID";
      $tm = mdlTabelaMulta::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();

      $datalimite = $this->dataLimite( $idcontrato, $vencimento );

      $datainicio = new DateTime( $datalimite );
      $datafim = new DateTime( $datapagamento );

      $difdias = 0;
      if( $datafim > $datainicio )
      {
         $intervalo = $datainicio->diff( $datafim);
         $difdias = $intervalo->days;
      };

   ;

      $objjuros = new \stdClass();
      $objjuros->jurosdias               = 0;
      $objjuros->jurospercentual         = 0;
      $objjuros->retervalor              = 0;
      $objjuros->repassarvalor           = 0;

      if( $difdias > 0 )
      {

         if( $param->IMB_PRM_COBRARJUROS == 'S' )
         {

            $objjuros->jurospercentual = $ctr->IMB_CTR_JUROS;
            $objjuros->jurosdias =  $difdias;

            if(  $ctr->IMB_CTR_JUROS == 0 )
               $objjuros->jurospercentual = $param->IMB_PRM_COBBANJUROSDIA;

            if( $objjuros->jurospercentual <> 0 )
            {
               $valordojuros = ( ( $basejuros * $objjuros->jurospercentual ) * $difdias ) / 100;
              // //Log:info( 'garantia '.$ctr->IMB_CTR_ALUGUELGARANTIDO );
               if( $ctr->IMB_CTR_ALUGUELGARANTIDO =='S')
                  $objjuros->retervalor    = $valordojuros;
               else
                  $objjuros->repassarvalor = $valordojuros;
            }
         }

      }

      return $objjuros;

   }


   public function pegarCFCPadrao( $evento)
   {
      $eve = mdlTabelaEvento::where('IMB_TBE_ID','=', $evento )->first();
      if( $eve == '' ) return 'NDA';
      return $eve->FIN_CFC_ID;
   }

   public function pegarBairros( $cidade )
   {
      

      $cidade = strtoupper( $cidade );
      $bairros = mdlBairro::select( 
         [
            'CEP_BAI_ID',
            DB::raw('trim(upper(CEP_BAI_NOME)) as CEP_BAI_NOME'),
            'CEP_CID_ID',
            DB::raw(' trim(upper(CEP_CID_NOME)) AS CEP_CID_NOME'),
         ]
      )
      ->whereRaw("upper(CEP_CID_NOME) = '$cidade' " )
         ->orderBy( 'CEP_BAI_NOME')->get();
      return response()->json($bairros,200);

   }

   public function setVariavelImovelGlobal( Request $request )
   {

      session()->put( 'imovelpesquisa', $request->id);
      return response()->json($request->id,200);

   }
   public function setarlistadesatualizados()
   {

      session()->put( 'desatualizadodesde', 'S');
      return response()->json($request->id,200);

   }



   public function setVariavelCliente( Request $request )
   {

      session()->put( 'clientetipopesquisa', $request->clientetipopesquisa);
      session()->put( 'clientepesquisa', $request->clientepesquisa);
      return response()->json('ok',200);

   }

   public function getVariavelImovelGlobal( Request $request )
   {
      return session()->pull('imovelpesquisa');

   }

   public function pegarSituacaoStatus( $id)
   {
      $st = mdlStatusImovel::find( $id );
      return $st->VIS_STA_SITUACAO;
   }

   public function tirarEspeciais( $frase )
   {
      $caracteres_sem_acento = array('Š'=>'S', 'š'=>'s', 'Ð'=>'Dj',''=>'Z', ''=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
      'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
      'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
      'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
      'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
      'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
      'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
      'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T'
      );
      return $nova_string = strtr($frase, $caracteres_sem_acento);
   }

   public function evento( $id )
   {
      $eve = mdlTabelaEvento::where( 'IMB_TBE_ID','=', $id )->first();
      return $eve;

   }

   public function formatarData($data)
   {
      if( strpos( $data,'/' )  <> '' )
         $rData = implode("-", array_reverse(explode("/", trim($data))));
      else
         $rData = implode("-", array_reverse(explode("-", trim($data))));

      return $rData;
   }

   public function reajustarIndex()
   {
      return view( 'processos.reajustaraluguel');
   }

   public function renovarCarga( Request $request )
   {
      $mes = $request->mes;
      $ano = $request->ano;
      $empresa = Auth::user()->IMB_IMB_ID;
      $carga = mdlContrato::select(
         [
            'IMB_CTR_ID',
            'IMB_IMV_ID',
            'IMB_CTR_REFERENCIA',
            'IMB_CTR_DATAREAJUSTE',
            'IMB_CTR_INICIO',
            'IMB_CTR_TERMINO',
            'IMB_CTR_VALORALUGUEL',
            'IMB_CTR_DURACAO',
            DB::Raw( 'imovel( IMB_IMV_ID ) AS ENDERECO'),
            DB::Raw( 'PEGALOCADORCONTRATO( IMB_CTR_ID ) AS LOCADOR'),
            DB::Raw( 'PEGALOCATARIOCONTRATO( IMB_CTR_ID ) AS LOCATARIO'),
         ])
         ->whereYear( 'IMB_CTR_TERMINO','=', $ano
         )->whereMonth( 'IMB_CTR_TERMINO','=', $mes
         )->where( 'IMB_CTR_SITUACAO','=', 'ATIVO');


         ////Log:info( $carga->toSlq());
         return DataTables::of($carga)->make(true);
   }

   public function reajustarCarga( Request $request )
   {
      $mes = $request->mes;
      $ano = $request->ano;
      $empresa = Auth::user()->IMB_IMB_ID;
      $carga = mdlContrato::select(
         [
            'IMB_CTR_ID',
            'IMB_IMV_ID',
            'IMB_CTR_REFERENCIA',
            'IMB_CTR_DATAREAJUSTE',
            'IMB_CTR_INICIO',
            'IMB_CTR_TERMINO',
            'IMB_CTR_VALORALUGUEL',
            DB::Raw('IMB_IRJ_NOME as INDICE'),
            DB::Raw( 'imovel( IMB_IMV_ID ) AS ENDERECO'),
            DB::Raw( 'PEGALOCADORCONTRATO( IMB_CTR_ID ) AS LOCADOR'),
            DB::Raw( 'PEGALOCATARIOCONTRATO( IMB_CTR_ID ) AS LOCATARIO'),
            DB::Raw( "( SELECT IMB_TBC_FATOR FROM IMB_TABELACORRECAO 
            WHERE IMB_TBC_INDICECORRECAO = IMB_INDICEREAJUSTE.IMB_IRJ_ID 
            AND IMB_TBC_MES = $mes 
            AND IMB_TBC_INDICECORRECAO = IMB_INDICEREAJUSTE.IMB_IRJ_ID AND IMB_TBC_ANO = $ano ) as IMB_TBC_FATOR")
         ]
         )->leftJoin( 'IMB_INDICEREAJUSTE','IMB_INDICEREAJUSTE.IMB_IRJ_ID', 'IMB_CONTRATO.IMB_IRJ_ID')
         ->whereYear( 'IMB_CTR_DATAREAJUSTE','=', $ano
         )->whereMonth( 'IMB_CTR_DATAREAJUSTE','=', $mes
         )->where( 'IMB_CTR_SITUACAO','=', 'ATIVO');


         return DataTables::of($carga)->make(true);
   }

   public function realizarReajuste( Request $request )
   {
      $id = $request->IMB_CTR_ID;
      $ctr = mdlContrato::find( $id );
      $valordigitado=$request->valordigitado;
      $valordesconto = $request->valordesconto;

      $irj = mdlIndiceReajuste::find( $ctr->IMB_IRJ_ID);
      $par = mdlParametros::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->first();

      $datareajuste = explode( "-",$ctr->IMB_CTR_DATAREAJUSTE);
      $mes = $datareajuste[1];
      $ano = $datareajuste[0];

      ////Log:info( 'data reajuste: '.$ctr->IMB_CTR_DATAREAJUSTE);
      ////Log:info( "Mes $mes");
      ////Log:info( "Ano $ano");


      $tc = mdlTabelaCorrecao::where( 'IMB_TBC_INDICEID','=', $ctr->IMB_IRJ_ID )
      ->where( 'IMB_TBC_MES','=',$mes )
      ->where( 'IMB_TBC_ANO','=',$ano )
      ->first();

      if( $tc == '' ) return response()->json(  [ 'erro' =>'Indice não localizado!'] ,404);


      Log::info('acessei');
      if( $tc <> '' )
      {

         $diavencimento = $ctr->IMB_CTR_DIAVENCIMENTO;
         $meses = $ctr->IMB_CTR_FORMAREAJUSTE;

         $data =$ctr->IMB_CTR_DATAREAJUSTE;
         $dataparcela = $data;
         //$dataparcela = $this->addMeses( $ctr->IMB_CTR_DIAVENCIMENTO,  1, $data);
         
         //$data = date_create_from_format("m-d-Y", $data);
         $novovalor = $ctr->IMB_CTR_VALORALUGUEL + ( $ctr->IMB_CTR_VALORALUGUEL * $tc->IMB_TBC_FATOR / 100 );

         if( $par->IMB_PRM_ARREDONTARREAJSTE == 'S' )
            $novovalor = round( $novovalor);

         if( $valordigitado <> '0' )
            $novovalor = $valordigitado;


         $endereco = app('App\Http\Controllers\ctrImovel')
         ->carga( $ctr->IMB_IMV_ID );
         $endereco = $endereco->IMB_IMV_ENDERECO.' '.
                     $endereco->IMB_IMV_ENDERECONUMERO.' '.
                     $endereco->IMB_IMV_COMPLEMENTO.' '.
                     $endereco->IMB_IMV_NUMAPT;


         return response()->json(
           [ [ "idcontrato"=>$id,
               "pasta" =>$ctr->IMB_IMV_REFERE,
               "IMB_CTR_DATAREAJUSTE"=>$ctr->IMB_CTR_DATAREAJUSTE,
               "IMB_CTR_VALORALUGUEL"=>$ctr->IMB_CTR_VALORALUGUEL,
               "endereco"=>$endereco,
               "sugestao"=>$novovalor,
              "nomeindice" => $irj->IMB_IRJ_NOME,
              "indice"=>$tc->IMB_TBC_FATOR,
              "datareajuse"=>$data], $this->parcelamentoJson( $diavencimento, $meses, $dataparcela,$novovalor,0,$ctr->IMB_CTR_ID)],200);

      }
      return $tc;
   }
   public function realizarRenovacao( Request $request )
   {
      $id = $request->IMB_CTR_ID;

      $ctr = mdlContrato::find( $id );

      $par = mdlParametros::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->first();

      $datafim = $ctr->IMB_CTR_TERMINO;
      $newDateIni = new DateTime($datafim);
      $newDateIni->add(new DateInterval('P1D')); // P1D means a period of 1 day
      $IMB_CTR_INICIO = $newDateIni->format('Y-m-d');
      $dia =  $newDateIni->format('Y-m-d');

      $IMB_CTR_TERMINO = $this->addMeses( $dia,  $ctr->IMB_CTR_DURACAO, $IMB_CTR_INICIO);


      $IMB_CTR_DATAREAJUSTE = $this->addMeses( $dia,  12, $IMB_CTR_INICIO);
      $datafim = $IMB_CTR_DATAREAJUSTE;
      $IMB_CTR_DATAREAJUSTE = new DateTime($datafim);
      $IMB_CTR_DATAREAJUSTE->add(new DateInterval('P1D')); // P1D means a period of 1 day
     
      $IMB_CTR_DATAREAJUSTE = $IMB_CTR_DATAREAJUSTE->format('Y-m-d');
     
      $endereco = app('App\Http\Controllers\ctrImovel')
         ->carga( $ctr->IMB_IMV_ID );
      $endereco = $endereco->IMB_IMV_ENDERECO.' '.
                     $endereco->IMB_IMV_ENDERECONUMERO.' '.
                     $endereco->IMB_IMV_COMPLEMENTO.' '.
                     $endereco->IMB_IMV_NUMAPT;

      return response()->json(
           [ [ "idcontrato"=>$id,
               "pasta" =>$ctr->IMB_IMV_REFERE,
               "IMB_CTR_DATAREAJUSTE"=>$IMB_CTR_DATAREAJUSTE,
               "IMB_CTR_VALORALUGUEL"=>$ctr->IMB_CTR_VALORALUGUEL,
               "IMB_CTR_INICIO"=>$IMB_CTR_INICIO,
               "IMB_CTR_TERMINO"=>$IMB_CTR_TERMINO,
               "IMB_CTR_DURACAO"=>$ctr->IMB_CTR_DURACAO,
               "IMB_CTR_FORMAREAJUSTE"=>$ctr->IMB_CTR_FORMAREAJUSTE,
               "endereco"=>$endereco,
               ]
            ],200);

   }

   public function addMeses( $diaoriginal,  $meses, $data)
   {
      $datainicial = explode( "-",$data);

      $mes =$datainicial[1];
      $ano =$datainicial[0];
//      return 'ano. '.$ano;

      //echo "addMeses( $diaoriginal,  $meses, $data)<b>";

      for ($x = 1; $x <= $meses; $x++)
      {
         $mes++;
         if( $mes > 12 )
         {
            $mes = 1;
            $ano++;
         };

         $dia = $diaoriginal;
         //echo "dia original $dia<br>";
         $ultimodia = $this->ultimoDiaMes($mes,  $ano );
         //echo "Ultimo dia  $ultimodia<br>";
         if( $ultimodia < $dia )
            $dia = $ultimodia;

            $data = date( 'Y-m-d', mktime(0, 0, 0,$mes,$dia,$ano));
         //echo "$mes,$dia,$ano";

      }
      return $data;

   }
   public function subtrairMeses( $diaoriginal,  $meses, $data)
   {
      $datainicial = explode( "-",$data);

      $mes =$datainicial[1];
      $ano =$datainicial[0];
//      return 'ano. '.$ano;

      for ($x = 1; $x <= $meses; $x++)
      {
         $mes--;
         if( $mes < 1 )
         {
            $mes = 12;
            $ano--;
         };

         $dia = $diaoriginal;
         $ultimodia = $this-> ultimoDiaMes($mes,  $ano );
         if( $ultimodia < $dia )
            $dia = $ultimodia;

         $data = date( 'Y-m-d', mktime(0, 0, 0,$mes,$dia,$ano));
         //$data = $ano.'-'.str_pad($mes, 2, '0', STR_PAD_LEFT).'-'.str_pad($dia,2,'0', STR_PAD_LEFT);

      }

      return $data;

   }

   public function ultimoDiaMes( $mes, $ano )
   {
      
      $bissexto = $ano % 4;
      $array = [ 31,28,31,30,31,30,31,31,30,31,30,31];

      if( $mes == 2 && $bissexto == 0 )
         return 29;


      return $array[$mes-1];
   }

   public function parcelamentoJson( $diaoriginal,  $meses, $data, $valorparcela, $valortotal, $idcontrato )
   {
      $datainicial = explode( "-",$data);

      $mes = $datainicial[1];
      $ano = $datainicial[0];      

      //////Log:info( 'Data '.$data );
      //////Log:info( "Meses: ".$meses);
      //////Log:info( "total: ".$valortotal);

      $array = [];

      if( $valortotal <> 0 )
         $valorparcela = round($valortotal / $meses,2);

      $diferenca = 0;
      if( $valortotal <> 0 )
        $diferenca = round(floatval($valortotal) - ($valorparcela * intval($meses) ),2);

        //////Log:info( "diferenca: ".$diferenca);

        for ($x = 1; $x <= $meses; $x++)
      {

         $dia = $diaoriginal;
         $ultimodia = $this-> ultimoDiaMes($mes,  $ano );
         if( $ultimodia < $dia )
            $dia = $ultimodia;

         $parcelacalculada = $valorparcela;
         if( $x==1) $parcelacalculada = $valorparcela + $diferenca;

         $data = date( 'Y-m-d', mktime(0, 0, 0,$mes,$dia,$ano));

         //////Log:info( "data: ".$data );

         $obs ='';

         //dd( $idcontrato);
         if( $idcontrato <> 0)
            $obs = $this->gerarPeriodo( $idcontrato, $data);
//         $data = $ano.'-'.str_pad($mes, 2, '0', STR_PAD_LEFT).'-'.str_pad($dia,2,'0', STR_PAD_LEFT);
         //$data = date_create_from_format("Y-m-d", $data)->format('Y/m/d');
         $array2 = array( "parcela" => $x, "data" => $data, "valor" => $parcelacalculada, "observacao"=>$obs);

         array_push($array, $array2);
         $mes++;
         if( $mes > 12 )
         {
            $mes = 1;
            $ano++;
         };


      }

      return $array;

   }
   public function parcelamentoJsonCP( $diaoriginal,  $meses, $data, $valorparcela, $valortotal, $idcontrato )
   {
      $datainicial = explode( "-",$data);

      $mes = $datainicial[1];
      $ano = $datainicial[0];


      $array = [];

      if( $valortotal <> 0 )
         $valorparcela = round($valortotal / $meses,2);

      $diferenca = 0;
      if( $valortotal <> 0 )
        $diferenca = round(floatval($valortotal) - ($valorparcela * intval($meses) ),2);

      for ($x = 1; $x <= $meses; $x++)
      {
      
         $dia = $diaoriginal;
         $ultimodia = $this-> ultimoDiaMes($mes,  $ano );
         if( $ultimodia < $dia )
            $dia = $ultimodia;

         $parcelacalculada = $valorparcela;
         if( $x==1) $parcelacalculada = $valorparcela + $diferenca;

         $data = date( 'Y-m-d', mktime(0, 0, 0,$mes,$dia,$ano));

         $obs ='';

         //dd( $idcontrato);
         if( $idcontrato <> 0)
            $obs = $this->gerarPeriodo( $idcontrato, $data);
//         $data = $ano.'-'.str_pad($mes, 2, '0', STR_PAD_LEFT).'-'.str_pad($dia,2,'0', STR_PAD_LEFT);
         //$data = date_create_from_format("Y-m-d", $data)->format('Y/m/d');
         $array2 = array( "parcela" => $x, "data" => $data, "valor" => $parcelacalculada, "observacao"=>$obs);

         array_push($array, $array2);
         $mes++;
         if( $mes > 12 )
         {
            $mes = 1;
            $ano++;
         };


      }

      return $array;

   }

   public function gerarPeriodo( $idcontrato, $data )
   {
      $ctr = mdlContrato::find( $idcontrato );
      $param2 = mdlParametros2::find( Auth::user()->IMB_IMB_ID );
      $obs = 'Aluguel do Mês';
      $dataexp = explode('-', $data );
      $anoparametro = $dataexp[0];
      $mesparametro = $dataexp[1];
      $diaparametro = $dataexp[2];
      $periodofim = 0;

      //////Log:info( '$ctr->IMB_CTR_TOLERANCIAFATOR: '.$ctr->IMB_CTR_TOLERANCIAFATOR );

      if( $param2->IMB_PRM_PER_DIAS_FIM <> '' && $param2->IMB_PRM_PER_DIAS_FIM <> null )
         $periodofim=$param2->IMB_PRM_PER_DIAS_FIM;

      $periodoini = 0;
      if( $param2->IMB_PRM_PER_DIAS_INICIO <> '' && $param2->IMB_PRM_PER_DIAS_INICIO <> null )
         $periodoini=$param2->IMB_PRM_PER_DIAS_INICIO;

      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='5')
         {
            
            $obs = "Referente ao Aluguel do Mês";
            ////////Log:info('Entrei no 3');
         };

      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='3')
         {
            $mesanterior = $this->subtrairMeses( 1,1,$data);//pegar o mes anterior para preencher o periodo para mes fechado
            $mesantexplode = explode( "-", $mesanterior);
            $anoant = $mesantexplode[0];
            $mesant = $mesantexplode[1];
            $diaant = $mesantexplode[2];

            $ultimodia = $this->ultimoDiaMes( $mesant, $anoant);

            $obs = "Referente ao Período de $diaant/$mesant/$anoant a $ultimodia/$mesant/$anoant";
            ////////Log:info('Entrei no 3');
         };
      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='4')
         {
            $datafimcalc = $this->addMeses( $diaparametro,1,$data);//pegar o mes anterior ANTECIPADO
            $datafimcalc = explode( "-", $datafimcalc);
            $anoant = $datafimcalc[0];
            $mesant = $datafimcalc[1];
            $diaant = $datafimcalc[2];

            $diaven = $ctr->IMB_CTR_DIAVENCIMENTO;
            $ultimodia = $this->ultimoDiaMes( $mesant, $anoant) ;

            if( $ultimodia < $diaven )
               $diaven = $ultimodia;

            $datafim = $diaven.'-'.$mesant.'-'.$anoant;
               //$datateste = date( 'd/m/Y', $diaant.'/'.$mesant.'/'.$anoant );


            $dataini = date('d/m/Y', strtotime($periodoini.' days', strtotime($data)));
            $datafim = date('d/m/Y', strtotime($periodofim.' days', strtotime($datafim )));

            $obs = "Referente ao Período de ".$dataini." a $datafim";
            ////////Log:info('Entrei no 4');
         };
      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='2' or $ctr->IMB_CTR_TOLERANCIAFATOR == '0'  or $ctr->IMB_CTR_TOLERANCIAFATOR == '1')
         {
            ////////Log:info('Entrei no 2');
            $mesanterior = $this->subtrairMeses( $diaparametro,1,$data);//pegar o mes anterior para preencher o periodo para mes fechado
            $mesantexplode = explode( "-", $mesanterior);
            $anoant = $mesantexplode[0];
            $mesant = $mesantexplode[1];
            $diaant = $mesantexplode[2];

            $ultimodia = $this->ultimoDiaMes( $mesant, $anoant);
            if( $ultimodia <= $ctr->IMB_CTR_DIAVENCIMENTO)
               $ultimodia = $ctr->IMB_CTR_DIAVENCIMENTO;

               //$datateste = date( 'd/m/Y', $diaant.'/'.$mesant.'/'.$anoant );


            $dataini = $diaant.'-'.$mesant.'-'.$anoant;
            $dataini = date('d/m/Y', strtotime($dataini. ' '.$periodoini.' days'));
            //$dataini = DateTime::createFromFormat('d/m/Y', $dataini);
//            $periodofim            = -1;
            $datafim = date('d/m/Y', strtotime($periodofim.' days', strtotime($data)));
            //$dataini = date('d/m/Y', strtotime($periodoini.'+ days', strtotime($dataini)));
            //$dataini->add(new DateInterval('P2D')); // 2 dias


            $obs = "Referente ao Período de ".$dataini." a $datafim";

         }

         return $obs;


   }

   public function periodoInicial( $idcontrato, $data )
   {
      $ctr = mdlContrato::find( $idcontrato );
      $param2 = mdlParametros2::find( Auth::user()->IMB_IMB_ID );
      $obs = 'Aluguel do Mês';
      $dataexp = explode('-', $data );
      $anoparametro = $dataexp[0];
      $mesparametro = $dataexp[1];
      $diaparametro = $dataexp[2];
      $periodofim = 0;

      //////Log:info( '$ctr->IMB_CTR_TOLERANCIAFATOR: '.$ctr->IMB_CTR_TOLERANCIAFATOR );

      if( $param2->IMB_PRM_PER_DIAS_FIM <> '' && $param2->IMB_PRM_PER_DIAS_FIM <> null )
         $periodofim=$param2->IMB_PRM_PER_DIAS_FIM;

      $periodoini = 0;
      if( $param2->IMB_PRM_PER_DIAS_INICIO <> '' && $param2->IMB_PRM_PER_DIAS_INICIO <> null )
         $periodoini=$param2->IMB_PRM_PER_DIAS_INICIO;

      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='3')
         {
            $mesanterior = $this->subtrairMeses( 1,1,$data);//pegar o mes anterior para preencher o periodo para mes fechado
            $mesantexplode = explode( "-", $mesanterior);
            $anoant = $mesantexplode[0];
            $mesant = $mesantexplode[1];
            $diaant = $mesantexplode[2];

            $ultimodia = $this->ultimoDiaMes( $mesant, $anoant);

            $obs = "$diaant/$mesant/$anoant";
            ////////Log:info('Entrei no 3');
         };
      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='4')
         {
            $datafimcalc = $this->addMeses( $diaparametro,1,$data);//pegar o mes anterior ANTECIPADO
            $datafimcalc = explode( "-", $datafimcalc);
            $anoant = $datafimcalc[0];
            $mesant = $datafimcalc[1];
            $diaant = $datafimcalc[2];

            $diaven = $ctr->IMB_CTR_DIAVENCIMENTO;
            $ultimodia = $this->ultimoDiaMes( $mesant, $anoant) ;

            if( $ultimodia < $diaven )
               $diaven = $ultimodia;

            $datafim = $diaven.'-'.$mesant.'-'.$anoant;
               //$datateste = date( 'd/m/Y', $diaant.'/'.$mesant.'/'.$anoant );


            $dataini = date('d/m/Y', strtotime($periodoini.' days', strtotime($data)));
            $datafim = date('d/m/Y', strtotime($periodofim.' days', strtotime($datafim )));

            $obs = $dataini;
            ////////Log:info('Entrei no 4');
         };
      if( $ctr->IMB_CTR_TOLERANCIAFATOR =='2' or $ctr->IMB_CTR_TOLERANCIAFATOR == '0'  or $ctr->IMB_CTR_TOLERANCIAFATOR == '1')
         {
            ////////Log:info('Entrei no 2');
            $mesanterior = $this->subtrairMeses( $diaparametro,1,$data);//pegar o mes anterior para preencher o periodo para mes fechado
            $mesantexplode = explode( "-", $mesanterior);
            $anoant = $mesantexplode[0];
            $mesant = $mesantexplode[1];
            $diaant = $mesantexplode[2];

            $ultimodia = $this->ultimoDiaMes( $mesant, $anoant);
            if( $ultimodia <= $ctr->IMB_CTR_DIAVENCIMENTO)
               $ultimodia = $ctr->IMB_CTR_DIAVENCIMENTO;

               //$datateste = date( 'd/m/Y', $diaant.'/'.$mesant.'/'.$anoant );


            $dataini = $diaant.'-'.$mesant.'-'.$anoant;
            $dataini = date('d/m/Y', strtotime($dataini. ' '.$periodoini.' days'));
            //$dataini = DateTime::createFromFormat('d/m/Y', $dataini);
//            $periodofim            = -1;
            $datafim = date('d/m/Y', strtotime($periodofim.' days', strtotime($data)));
            //$dataini = date('d/m/Y', strtotime($periodoini.'+ days', strtotime($dataini)));
            //$dataini->add(new DateInterval('P2D')); // 2 dias


            $obs = $dataini;

         }

         return response()->json($obs,200);;


   }

   public function confirmarReajuste( Request $request )
   {
      $id = $request->id;
      $parcelas = $request->parcelas;
      $valoratual = $request->valoratual;
      $valornovo = $request->valornovo;
      $fator = $request->fator;
      $valordesconto = $request->valordesconto;
      $ctr = mdlContrato::find( $id );

      $chave=date('YmdHis');
      $meses = sizeof($parcelas);

      $cont = 0;
      foreach( $parcelas as $parc )
      {

         $cont = $cont + 1;
         $data = $this->formatarData($parc[1] );

         //Primeiro apagar lancamneto de aluguel dentro do mes caso esteja sem receber e pagar
         $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$id )
         ->where( 'IMB_LCF_DATAVENCIMENTO','=', $data )
         ->where( 'IMB_TBE_ID','=',1)
         ->whereNull('IMB_LCF_DATARECEBIMENTO')
         ->whereNull('IMB_LCF_DATAPAGAMENTO')
         ->delete();


         //se ainda ficou algum lancamento de alguel e tem recto ou repasse, então não posso gerar valor
         $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$id )
         ->where( 'IMB_LCF_DATAVENCIMENTO','=', $data )
         ->where( 'IMB_TBE_ID','=',1)
         ->first();



         if( $lf == '' )
         {
            $lf = new mdlLancamentoFuturo;
            $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_CTR_ID = $id;
            $lf->IMB_LCF_VALOR = $parc[2];
            $lf->IMB_LCF_LOCADORCREDEB ='C';
            $lf->IMB_LCF_LOCATARIOCREDEB ='D';
            $lf->IMB_LCF_DATAVENCIMENTO = $data;
            $lf->IMB_LCF_TIPO = 'R';
            $lf->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $lf->IMB_CLT_IDLOCADOR = 0;
            $lf->IMB_TBE_ID = '1';
            $lf->IMB_ATD_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_LCF_INCMUL ='S';
            $lf->IMB_LCF_INCIRRF ='S';
            $lf->IMB_LCF_INCTAX = 'S';
            $lf->IMB_LCF_INCJUROS = 'S';
            $lf->IMB_LCF_INCCORRECAO =  'S';
            $lf->IMB_LCF_GARANTIDO = 'N';
            $lf->IMB_LCF_INCISS = 'N';
            $lf->IMB_LCF_OBSERVACAO = $parc[3];
            $lf->IMB_LCF_NUMEROCONTROLE = 0;
            $lf->IMB_LCF_NUMPARREAJUSTE = $cont;
            $lf->IMB_LCF_NUMPARCONTRATO = 0;
            $lf->IMB_LCF_CHAVE          = 0;
            $lf->IMB_LCF_REAJUSTAR          ='N';
            $lf->save();
         }

         if( $valordesconto <> '' )
         {
            $lf = new mdlLancamentoFuturo;
            $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_CTR_ID = $id;
            $lf->IMB_LCF_VALOR = $valordesconto;
            $lf->IMB_LCF_LOCADORCREDEB ='D';
            $lf->IMB_LCF_LOCATARIOCREDEB ='C';
            $lf->IMB_LCF_DATAVENCIMENTO = $data;
            $lf->IMB_LCF_TIPO = 'R';
            $lf->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $lf->IMB_CLT_IDLOCADOR = 0;
            $lf->IMB_TBE_ID = '8';
            $lf->IMB_ATD_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_LCF_INCMUL ='S';
            $lf->IMB_LCF_INCIRRF ='S';
            $lf->IMB_LCF_INCTAX = 'S';
            $lf->IMB_LCF_INCJUROS = 'S';
            $lf->IMB_LCF_INCCORRECAO =  'S';
            $lf->IMB_LCF_GARANTIDO = 'N';
            $lf->IMB_LCF_INCISS = 'N';
            $lf->IMB_LCF_OBSERVACAO = 'Desconto no Reajuste';
            $lf->IMB_LCF_NUMEROCONTROLE = 0;
            $lf->IMB_LCF_NUMPARREAJUSTE = 0;
            $lf->IMB_LCF_NUMPARCONTRATO = 0;
            $lf->IMB_LCF_CHAVE          = 0;
            $lf->IMB_LCF_REAJUSTAR          ='N';
            $lf->save();
         }
      }

      $proximoreajuste = $this->addMeses(
        $ctr->IMB_CTR_DIAVENCIMENTO, $meses, $ctr->IMB_CTR_DATAREAJUSTE );

      $his = new mdlContratoHistoricoReajuste;
      $his->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
      $his->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $his->IMB_CTR_ID =  $id;
      $his->IMB_CTR_VALORANTERIOR =  $valoratual;
      $his->IMB_CTR_VALOR =  $valornovo;
      $his->IMB_IRJ_ID =  $ctr->IMB_IRJ_ID;
      $his->IMB_CHR_FATOR =  $fator;
      $his->IMB_CHR_DATAREAJUSTE = $ctr->IMB_CTR_DATAREAJUSTE;
      $his->IMB_CHR_DATAPROXIMOREAJUSTE = $proximoreajuste;
      $his->IMB_CHR_DESCONTO = $valordesconto;
      $his->IMB_CHR_DTHATIVO = date( 'Y/m/d');
      $his->save();

      $ctr->IMB_CTR_VALORALUGUEL = $parc[2];
      $ctr->IMB_CTR_DATAREAJUSTE =$proximoreajuste;
      $ctr->save();

      return response()->json('ok',200);

   }

   public function confirmarRenovacao( Request $request )
   {


      $id = $request->id;
      $IMB_CTR_DURACAO = $request->IMB_CTR_DURACAO ;
      $IMB_CTR_INICIO = $request->IMB_CTR_INICIO ;
      $IMB_CTR_TERMINO =$request->IMB_CTR_TERMINO ;
      $IMB_CTR_VALORALUGUEL = $request->IMB_CTR_VALORALUGUEL;
      $IMB_CTR_DATAREAJUSTE = $request->IMB_CTR_DATAREAJUSTE;

      $ctr = mdlContrato::find( $id );
      $inicioant = $ctr->IMB_CTR_INICIO;
      $terminoant = $ctr->IMB_CTR_TERMINO;
      $valorant = $ctr->IMB_CTR_VALORALUGUEL;

      $his = new mdlContratoHistoricoRenovacao;
      $his->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
      $his->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $his->IMB_CTR_ID =  $id;
      $his->IMB_CTR_INICIO = $IMB_CTR_INICIO;
      $his->IMB_CTR_FIM = $IMB_CTR_TERMINO;
      $his->IMB_CTR_VALOR = $IMB_CTR_VALORALUGUEL;
      $his->IMB_CTR_VALORANTERIOR =  $valorant;
      $his->IMB_CHR_INICIOANTERIOR =  $inicioant;
      $his->IMB_CHR_FIMANTERIOR =  $terminoant;
      $his->IMB_CHR_DTHATIVO = date( 'Y/m/d');
      $his->save();

      $ctr->IMB_CTR_VALORALUGUEL = $IMB_CTR_VALORALUGUEL;
      $ctr->IMB_CTR_DATAREAJUSTE = $IMB_CTR_DATAREAJUSTE;
      $ctr->IMB_CTR_TERMINO = $IMB_CTR_TERMINO;
      $ctr->IMB_CTR_INICIO = $IMB_CTR_INICIO;
      $ctr->save();

      return response()->json('ok',200);

   }

   public function proximoVencimentoLT( $id )
   {

/*      $lf = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )
      ->whereIn( 'IMB_TBE_ID',[ '1', '24' ] )
      ->whereNull( 'IMB_LCF_DATARECEBIMENTO')
      ->orderBy( 'IMB_LCF_DATAVENCIMENTO')
      ->first();

      if( $lf )
      {
         $pv = $lf->IMB_LCF_DATAVENCIMENTO;
         $parcela = $lf->IMB_LCF_NUMPARCONTRATO;
      }
      else
      {
         $ctr = mdlContrato::find( $id );
         $pv = $ctr->IMB_CTR_PRIMEIROVENCIMENTO;
         $parcela = 1;
      }
      */
      $ctr = mdlContrato::find( $id );
      $dados = [ "proximovencimento" => $ctr->IMB_CTR_VENCIMENTOLOCATARIO, "parcela" => 1];


//      $dados = [ "proximovencimento" => $pv, "parcela" => $parcela ];

      return json_encode( $dados );
   }
   public function proximoVencimentoLD( $id )
   {

      $lf = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )
      ->whereIn( 'IMB_TBE_ID',[ '1', '24' ] )
      ->whereNull( 'IMB_LCF_DATAPAGAMENTO')
      ->orderBy( 'IMB_LCF_DATAVENCIMENTO')
      ->first();

      if( $lf )
      {
         $pv = $lf->IMB_LCF_DATAVENCIMENTO;
         $parcela = $lf->IMB_LCF_NUMPARCONTRATO;
      }
      else
      {
         $ctr = mdlContrato::find( $id );
         $pv = $ctr->IMB_CTR_PRIMEIROVENCIMENTO;
         $parcela = 1;
      }

      $dados = [ "proximovencimento" => $pv, "parcela" => $parcela ];

      return json_encode( $dados );
   }


   public function inadimplentesIndex()
   {

      return view('inadimplentes.inadimplentesindex');

   }
   public function forcarLimparTMPAtrasados()
   {

      $headers = mdlTMPAtrasadoHeader::
         where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
      ->delete();
   }

   public function inadimplentesCalcular( Request $request)
   {


      $datainicio = $this->formatarData( $request->datainicio );
      $datafim = $this->formatarData( $request->datafim );
    
      

      if( $request->acordos == 'S' )
         $atrs = mdlContrato::
         whereRaw( "( IMB_IMB_ID = ".Auth::user()->IMB_IMB_ID." and IMB_CTR_SITUACAO=  'ATIVO' )
         and ( IMB_CTR_VENCIMENTOLOCATARIO < curdate() and IMB_CTR_VENCIMENTOLOCATARIO is not null 
         AND IMB_CTR_VENCIMENTOLOCATARIO between $datainicio and $datafim  )
         or ( select exists( select LF.IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO LF 
                        WHERE LF.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND IMB_TBE_ID = 14 
                        AND IMB_LCF_DATAVENCIMENTO < CURDATE() AND IMB_LCF_DATARECEBIMENTO IS NULL) )
               ORDER BY IMB_CTR_VENCIMENTOLOCATARIO");
      else

      if( $request->opcaovencimento == 'P' and $request->datafim <> '' and $request->datainicio )
      {
         $atrs = mdlContrato::
         where( 'IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID)
         ->where('IMB_CTR_SITUACAO','=','ATIVO'  )
         ->whereRaw(" ADDDATE(IMB_CTR_VENCIMENTOLOCATARIO, INTERVAL coalesce(IMB_CTR_TOLERANCIA,0) day) >= '$datainicio'" )
         ->whereRaw(" ADDDATE(IMB_CTR_VENCIMENTOLOCATARIO, INTERVAL coalesce(IMB_CTR_TOLERANCIA,0) day) <= '$datafim'" );
      }
      else
      $atrs = mdlContrato::
         whereRaw( "( IMB_IMB_ID = ".Auth::user()->IMB_IMB_ID." and IMB_CTR_SITUACAO=  'ATIVO' )
         and ( ( IMB_CTR_VENCIMENTOLOCATARIO < curdate() and IMB_CTR_VENCIMENTOLOCATARIO is not null ) 
         or ( select exists( select LF.IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO LF 
                        WHERE LF.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND IMB_TBE_ID = 14 
                        AND IMB_LCF_DATAVENCIMENTO < CURDATE() AND IMB_LCF_DATARECEBIMENTO IS NULL) ))");

 
    
      if( $request->situacao == 'E' )
         $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') <> 'S'" );

         if( $request->situacao == 'J' )
         $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') =  'S' " );
        
         Log::info( $atrs->toSql() );
         

         $atrs = $atrs->orderBy('IMB_CTR_VENCIMENTOLOCATARIO');
   /*   if( $request->opcaovencimento == 'P' and $request->datafim <> '' and $request->datainicio )
      {
         $atrs = $atrs->where( 'IMB_CTR_VENCIMENTOLOCATARIO','>=', $this->formatarData( $request->datainicio ) )
                      ->where( 'IMB_CTR_VENCIMENTOLOCATARIO','<=', $this->formatarData( $request->datafim ) );
      }
*/
      $atrs = $atrs->get();
      //dd( $atrs );

      $this->forcarLimparTMPAtrasados();


      foreach( $atrs as $atr)
      {
         $enderecocompleto = $this->imovelEndereco( $atr->IMB_IMV_ID );
         $juridico = '';
         $codigolt = $this->codigoLocatarioPrincipal( $atr->IMB_CTR_ID );
         $clt = mdlCliente::find( $codigolt );

         $fiador1nome='';
         $fiador1fone='';
         $fiador1email='';
         $fiador2nome='';
         $fiador2fone='';
         $fiador2email='';
         $fiador1id=null;
         $fiador2id=null;

         if( $atr->IMB_CTR_ADVOGADO == 'S'  ) $juridico = "JURÍDICO";


         if( $clt )
         {
    

            $fds = mdlFiadorContrato::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_FIADORCONTRATO.IMB_CLT_ID' )
            ->get();

            $cont = 0;
            foreach( $fds as $fd)
            {
               $cont++;
               if( $cont == 1 )
               {
                  $fiador1nome = $fd->IMB_CLT_NOME;
                  $fiador1email = $fd->IMB_CLT_EMAIL;
                  $fiador1fone= $this->pegarFone( $fd->IMB_CLT_ID );
                  $fiador1id= $fd->IMB_CLT_ID;
               }
               else
               if( $cont == 2 )
               {
                  $fiador2nome = $fd->IMB_CLT_NOME;
                  $fiador2email = $fd->IMB_CLT_EMAIL;
                  $fiador2fone= $this->pegarFone( $fd->IMB_CLT_ID );
                  $fiador2id= $fd->IMB_CLT_ID;

               }


            }
            $lca = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID ) 
            ->where('IMB_LCF_LOCATARIOCREDEB','=','D')
            ->where( 'IMB_TBE_ID','=', 14 )
            ->whereNull('IMB_LCF_DATARECEBIMENTO')
            ->whereNull('IMB_LCF_DTHINATIVADO')
//            ->whereRaw( 'coalesce(IMB_ACD_IDDESTINO,0) <> 0')
            ->first();
            
            $ehacordo = '';
            if( $lca <> '') $ehacordo = 'ACORDO';

            $cont = 'S';

            if( $request->acordos == 'S' and $ehacordo <> 'ACORDO')  $cont = 'N';
            if( $request->acordos <> 'S' and $atr->IMB_CTR_SITUACAO <> 'ATIVO')  $cont = 'N';

            //Log:info('cont '.$cont );
            
            if( $cont == 'S')
            {
               $headers = new mdlTMPAtrasadoHeader;
               $headers->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
               $headers->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
               $headers->IMB_IMV_ID = $atr->IMB_IMV_ID;
               $headers->IMB_CTR_ID = $atr->IMB_CTR_ID;
               $headers->ENDERECOCOMPLETO = $enderecocompleto;
               $headers->IMB_CTR_VENCIMENTOLOCATARIO = $atr->IMB_CTR_VENCIMENTOLOCATARIO;
               $headers->IMB_CTR_VALORALUGUEL = $atr->IMB_CTR_VALORALUGUEL;
               $headers->JURIDICO = $juridico;
               $headers->IMB_CLT_NOMELOCATARIO = $this->nomeLocatarioPrincipal( $atr->IMB_CTR_ID );
               $headers->IMB_CLT_IDLOCATARIO = $codigolt;
               $headers->IMB_CLT_EMAIL = $clt->IMB_CLT_EMAIL;
               $headers->DATAULTIMACOBRANCA = $this->ultimaCobrancaRealizada( $atr->IMB_CTR_ID );
               $headers->FIADOR1NOME = $fiador1nome;
               $headers->FIADOR1FONE= $fiador1fone;
               $headers->FIADOR1EMAIL= $fiador1email;
               $headers->FIADOR2NOME = $fiador2nome;
               $headers->FIADOR2FONE= $fiador2fone;
               $headers->FIADOR2EMAIL= $fiador2email;
               $headers->IMB_CLT_IDFIADOR1= $fiador1id;
               $headers->IMB_CLT_IDFIADOR2= $fiador2id;
               $headers->IMB_CTR_REFERENCIA= $atr->IMB_CTR_REFERENCIA;
               $headers->ENCERRADO= '';
               $headers->ACORDO= $ehacordo;
               if( $codigolt )
                  $headers->FONELOCATARIO = $this->pegarFone( $codigolt );
               $headers->IMB_CTR_DATALIMITE = $this->dataLimite( $atr->IMB_CTR_ID, $atr->IMB_CTR_VENCIMENTOLOCATARIO );

               $headers->save();
            }
         }

      }

      if( $request->ativos <> 'S')
      {
         //calcular os encerrados
         $atrs = mdlContrato::select(
            ['IMB_CONTRATO.*',
            DB::raw( '( select MIN(IMB_LCF_DATAVENCIMENTO) FROM IMB_LANCAMENTOFUTURO 
            WHERE IMB_LANCAMENTOFUTURO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID 
            and IMB_LCF_DTHINATIVADO is null
            AND IMB_LCF_LOCATARIOCREDEB = "D" and IMB_LCF_DATARECEBIMENTO IS NULL) AS vencimento')]
         )->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
         ->whereRaw( 'exists ( select IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO 
                  WHERE IMB_LANCAMENTOFUTURO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID 
                  AND IMB_LCF_LOCATARIOCREDEB = "D" and IMB_LCF_DATARECEBIMENTO IS NULL
                  and IMB_LCF_DTHINATIVADO is null) ')
         ->orderBy('IMB_CTR_VENCIMENTOLOCATARIO');

         
         $atrs = $atrs->where( 'IMB_CTR_SITUACAO','=', 'ENCERRADO' );

         if( $request->situacao == 'E' )
            $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') <> 'S'" );

            if( $request->situacao == 'J' )
            $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') =  'S' " );
         
         ////Log:info( $atrs->toSql());
         $atrs = $atrs->get();

         foreach( $atrs as $atr)
         {

            $enderecocompleto = $this->imovelEndereco( $atr->IMB_IMV_ID );
            $juridico = '';
            $codigolt = $this->codigoLocatarioPrincipal( $atr->IMB_CTR_ID );
            $clt = mdlCliente::find( $codigolt );

            $fiador1nome='';
            $fiador1fone='';
            $fiador1email='';
            $fiador2nome='';
            $fiador2fone='';
            $fiador2email='';
            $fiador1id=null;
            $fiador2id=null;

            if( $atr->IMB_CTR_ADVOGADO == 'S'  ) $juridico = "JURÍDICO";

            if( $clt )
            {


               $fds = mdlFiadorContrato::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID )
               ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_FIADORCONTRATO.IMB_CLT_ID' )
               ->get();

               $cont = 0;
               foreach( $fds as $fd)
               {
                  $cont++;
                  if( $cont == 1 )
                  {
                     $fiador1nome = $fd->IMB_CLT_NOME;
                     $fiador1email = $fd->IMB_CLT_EMAIL;
                     $fiador1fone= $this->pegarFone( $fd->IMB_CLT_ID );
                     $fiador1id= $fd->IMB_CLT_ID;
                  }
                  else
                  if( $cont == 2 )
                  {
                     $fiador2nome = $fd->IMB_CLT_NOME;
                     $fiador2email = $fd->IMB_CLT_EMAIL;
                     $fiador2fone= $this->pegarFone( $fd->IMB_CLT_ID );
                     $fiador2id= $fd->IMB_CLT_ID;

                  }


               }

    
               $lca = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID ) 
               ->where('IMB_LCF_LOCATARIOCREDEB','=','D')
               ->whereNull('IMB_LCF_DATARECEBIMENTO')
               ->whereNull('IMB_LCF_DTHINATIVADO')
               ->whereRaw( 'coalesce(IMB_ACD_IDDESTINO,0) <> 0')
               ->first();
               $ehacordo='';
               if( $lca <> '') $ehacordo = 'ACORDO';
               $cont = 'S';

               if( $request->acordos == 'S' and $ehacordo <> 'ACORDO')  $cont = 'N';
               
               if( $cont == 'S')
               {
                  $headers = new mdlTMPAtrasadoHeader;
                  $headers->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                  $headers->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                  $headers->IMB_IMV_ID = $atr->IMB_IMV_ID;
                  $headers->IMB_CTR_ID = $atr->IMB_CTR_ID;
                  $headers->ENDERECOCOMPLETO = $enderecocompleto;
                  $headers->IMB_CTR_VENCIMENTOLOCATARIO = $atr->vencimento;
                  $headers->IMB_CTR_VALORALUGUEL = $atr->IMB_CTR_VALORALUGUEL;
                  $headers->JURIDICO = $juridico;
                  $headers->IMB_CLT_NOMELOCATARIO = $this->nomeLocatarioPrincipal( $atr->IMB_CTR_ID );
                  $headers->IMB_CLT_IDLOCATARIO = $codigolt;
                  $headers->IMB_CLT_EMAIL = $clt->IMB_CLT_EMAIL;
                  $headers->DATAULTIMACOBRANCA = $this->ultimaCobrancaRealizada( $atr->IMB_CTR_ID );
                  $headers->FIADOR1NOME = $fiador1nome;
                  $headers->FIADOR1FONE= $fiador1fone;
                  $headers->FIADOR1EMAIL= $fiador1email;
                  $headers->FIADOR2NOME = $fiador2nome;
                  $headers->FIADOR2FONE= $fiador2fone;
                  $headers->FIADOR2EMAIL= $fiador2email;
                  $headers->IMB_CLT_IDFIADOR1= $fiador1id;
                  $headers->IMB_CLT_IDFIADOR2= $fiador2id;
                  $headers->IMB_CTR_REFERENCIA= $atr->IMB_CTR_REFERENCIA;
                  $headers->ENCERRADO= 'ENCERRADO';
                  $headers->ACORDO= $ehacordo;


                  if( $codigolt )
                     $headers->FONELOCATARIO = $this->pegarFone( $codigolt );
                  $headers->IMB_CTR_DATALIMITE = $this->dataLimite( $atr->IMB_CTR_ID, $atr->IMB_CTR_VENCIMENTOLOCATARIO );

                  $headers->save();
               }
            }
         }
      }


      //dd( $atrs );      
      $headers = mdlTMPAtrasadoHeader::where( 'TMP_ATRASADOSHEADER.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->where('TMP_ATRASADOSHEADER.IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
      ->orderBy('TMP_ATRASADOSHEADER.IMB_CTR_VENCIMENTOLOCATARIO');

      return DataTables::of($headers)->make(true);

   }

   public function pegarFone( $id )
   {

      $fone='';
      if( $id )
      {
         $fone = collect( DB::select("select PEGAFONES('$id') as FONES"))->first()->FONES;
         return $fone;
      }
      return $fone;

   }

   public function ultimaCobrancaRealizada( $id )
   {
      $cbr = mdlCobrancaRealizada::
            select(
               [
                 DB::raw('max( IMB_CBR_DATA) as data')
               ]
            )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_CTR_ID','=', $id)
            ->first();

      return $cbr->data;

   }

   public function cobrancasRealizadas( $id )
   {
      $cbr = mdlCobrancaRealizada::
      select(
         [
            'IMB_CBR_DATA',
            'IMB_CBR_HORA',
            'IMB_CTR_VENCIMENTOLOCATARIO',
            'IMB_ATD_NOME',
            DB::raw(' coalesce(IMB_CBR_OBSERVACAO,"") as IMB_CBR_OBSERVACAO')
         ]
      )
      ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID','IMB_COBRANCAREALIZADA.IMB_ATD_ID')
      ->where( 'IMB_COBRANCAREALIZADA.IMB_CTR_ID','=', $id )
      ->where('IMB_COBRANCAREALIZADA.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->orderBy( 'IMB_CBR_DATA','DESC')
      ->orderBy('IMB_CBR_HORA','DESC')
      ->get();

      return $cbr;

   }

   function gravarCobrancaRealizada( Request $request )
   {
      $cbr = new mdlCobrancaRealizada;
      $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
      $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $cbr->IMB_CTR_ID = $request->IMB_CTR_ID;
      $cbr->IMB_CBR_DATA = date('Y/m/d');
      $cbr->IMB_CBR_HORA = date('H:i');
      $cbr->IMB_CBR_OBSERVACAO = $request->tipocliente.' - '.$request->IMB_CBR_OBSERVACAO;
      $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $request->IMB_CTR_VENCIMENTOLOCATARIO;
      $cbr->save();

      return response()->json( 'ok',200);

   }


   function calcularDetalheAtrasados( $id, $origem )
   {
      
      $ctr = mdlContrato::find( $id );
    
      $det = mdlTMPAtrasadoDetail::
               where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
               ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
               ->delete();
      //////Log:info('ATRASADO '.$ctr->IMB_CTR_SITUACAO );
      //////Log:info('id '.$ctr->IMB_CTR_ID );
      if( $ctr->IMB_CTR_SITUACAO == 'ATIVO')
      {
         $datainicial = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
         //////Log:info('ATRASADO ENTROU ATIVO');
   
         while ( strtotime($datainicial) <= strtotime(date( 'Y/m/d')) )
         {

            $this->calcularDetalheAtrasadoVencimento( $id, $datainicial );

            $datainicial = $this->addMeses( $ctr->IMB_CTR_DIAVENCIMENTO,  1, $datainicial);

         }
      }
      else
      $this->calcularDetalheAtrasadoVencimentoEncerrados( $id );

      $det = mdlTMPAtrasadoDetail::
      where('IMB_CTR_ID','=', $id )
     ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
     ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID );




        if( $origem == 'relatorio')
        {
            $det = $det->where( 'IMB_TBE_ID','<>',999999)
            ->orderBy('DATAVENCIMENTO')
            ->get();
            return $det ;
        }
        else
            return DataTables::of($det->orderBy('TMP_ATR_ID'))->make(true);



   }


   public function calcularDetalheAtrasadoVencimento( $idcontrato, $ven )
   {


      $ctr = mdlContrato::find( $idcontrato);

      $lfaluguel = mdlLancamentoFuturo::
      where( 'IMB_CTR_ID','=', $idcontrato )
      ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
      ->where('IMB_LCF_LOCATARIOCREDEB','<>','N' )
      ->where('IMB_LCF_DATAVENCIMENTO','=', $ven)
      ->whereNull( 'IMB_LCF_DTHINATIVADO')
      ->whereNull( 'IMB_LCF_DATARECEBIMENTO')
      ->where('IMB_TBE_ID','=', 1)
      ->first();





      $lfs = mdlLancamentoFuturo::
      where( 'IMB_CTR_ID','=', $idcontrato )
      ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
      ->where('IMB_LCF_LOCATARIOCREDEB','<>','N' )
      ->where('IMB_LCF_DATAVENCIMENTO','=', $ven)
      ->whereNull( 'IMB_LCF_DATARECEBIMENTO')
      ->whereNull( 'IMB_LCF_DTHINATIVADO')
      ->orderBy( 'IMB_TBE_ID')
      ->get();

      $subtotalmulta = 0;
      $subtotaljuros = 0;
      $subtotalitem = 0;
      $subtotaltotal = 0;

      foreach( $lfs as $lf)
      {

         $multa = 0;
         $multatotal = 0;
         $jurostotal = 0;
         $valorlancamento =  $lf->IMB_LCF_VALOR;

         ////Log:info( '$lf->IMB_TBE_MULTA '.$lf->IMB_TBE_MULTA );
         ////Log:info( '$lf->IMB_TBE_ID '.$lf->IMB_TBE_ID );
         ////Log:info( '$lf->IMB_LCF_VALOR '.$lf->IMB_LCF_VALOR );
         if( $lf->IMB_LCF_INCMUL == 'S')
         {
            $multa =  $this->calcularMulta(
            $idcontrato,
            $lf->IMB_LCF_DATAVENCIMENTO,
            date('Y/m/d'),
            $lf->IMB_LCF_VALOR );

            $multatotal = $multa->retervalor + $multa->repassarvalor;
         }
         if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C' )
         {
            if( $multatotal <> 0 )
               $multatotal = $multatotal * -1;

            $valorlancamento =  $lf->IMB_LCF_VALOR * -1;

         }

         
         $juros = 0;
         if( $lf->IMB_LCF_INCJUROS == 'S')
         {
            $juros= $this->calcularJuros( $idcontrato,
                                 $lf->IMB_LCF_DATAVENCIMENTO,
                                 date('Y/m/d'),
                                 $lf->IMB_LCF_VALOR );
            $jurostotal = $juros->retervalor + $juros->repassarvalor;
            
            if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C'  )
                                 $jurostotal = $jurostotal * -1;

         }

         $evento = app('App\Http\Controllers\ctrEvento')
            ->find(  $lf->IMB_TBE_ID );


         $subtotaljuros += $jurostotal;
         $subtotalmulta += $multatotal;
         $subtotalitem += $valorlancamento;

         $det = new mdlTMPAtrasadoDetail;

         $det->IMB_TBE_ID = $lf->IMB_TBE_ID;
         if( $evento <> '')
            $det->IMB_TBE_NOME = $evento->IMB_TBE_NOME;
         else
            $det->IMB_TBE_NOME = 'NÃO IDENTIFICADO('.$lf->IMB_TBE_ID.')';
         $det->TMP_CREDITODEBITO = $lf->IMB_LCF_LOCATARIOCREDEB;
         $det->TMP_VALOR = $valorlancamento;
         $det->IMB_TBE_OBSERVACAO = $lf->IMB_LCF_OBSERVACAO;
         $det->IMB_LCF_ID = $lf->IMB_LCF_ID;

         if( $lf->IMB_LCF_LOCATARIOCREDEB == 'D')
            $det->MAISMENOS = '+';
         else
            $det->MAISMENOS = '-';

         $det->TMP_LOCADORDEBCRE = $lf->IMB_LCF_LOCADORCREDEB;
         $det->DATAVENCIMENTO = $lf->IMB_LCF_DATAVENCIMENTO;
         if( $lf->IMB_LCF_INCMUL == 'S')
            $det->MULTA = $multatotal;
         else
            $det->MULTA = 0;
         
         if( $lf->IMB_LCF_INCJUROS == 'S')
            $det->JUROS = $jurostotal;
         else
            $det->JUROS = 0;

         
         $det->PERMANENCIA = 0;
         $det->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
         if( $lf->IMB_LCF_INCMUL == 'S')
         $det->DIASATRASO = $multa->diasatraso;
         else
         $det->DIASATRASO = 0;
         $det->IMB_CTR_ID = $idcontrato;
         $det->IMB_IMB_ID= Auth::user()->IMB_IMB_ID;
         $det->TOTALREGISTRO = $valorlancamento + $multatotal + $jurostotal;
         $det->save();

      }

      if( $lfaluguel == '' )
      {
         $det = new mdlTMPAtrasadoDetail;

         $multa =  $this->calcularMulta(
                  $idcontrato,
                  $ven,
                  date('Y/m/d'),
                  $ctr->IMB_CTR_VALORALUGUEL);

         $multatotal = $multa->retervalor + $multa->repassarvalor;
         $valorlancamento =  $ctr->IMB_CTR_VALORALUGUEL;
         $juros= $this->calcularJuros( $idcontrato,
                                 $ven,
                                 date('Y/m/d'),
                                 $ctr->IMB_CTR_VALORALUGUEL );
         $jurostotal = $juros->retervalor + $juros->repassarvalor;

         $subtotaljuros += $jurostotal;
         $subtotalmulta += $multatotal;
         $subtotalitem += $valorlancamento;

         $det->IMB_TBE_ID = 1;
         $det->IMB_TBE_NOME = 'Aluguel';
         $det->TMP_CREDITODEBITO = 'D';
         $det->TMP_VALOR = $ctr->IMB_CTR_VALORALUGUEL;
         $det->IMB_TBE_OBSERVACAO = $this->gerarPeriodo( $idcontrato, $ven);;
         $det->IMB_LCF_ID = 0;

         $det->MAISMENOS = '+';

         $det->TMP_LOCADORDEBCRE = 'C';
         $det->DATAVENCIMENTO = $ven;
         $det->MULTA = $multatotal;
         $det->JUROS = $jurostotal;
         $det->PERMANENCIA = 0;
         $det->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
         $det->DIASATRASO = $multa->diasatraso;
         $det->IMB_CTR_ID = $idcontrato;
         $det->IMB_IMB_ID= Auth::user()->IMB_IMB_ID;
         $det->TOTALREGISTRO = $valorlancamento + $multatotal + $jurostotal;
         $det->save();


      }

      $det = new mdlTMPAtrasadoDetail;
      $det->IMB_TBE_ID = 999999;
      $det->IMB_TBE_NOME = 'Total do Vencimento';
      $det->TMP_CREDITODEBITO = '';
      $det->TMP_VALOR = round($subtotalitem,2);
      $det->IMB_TBE_OBSERVACAO = '';
      $det->IMB_LCF_ID = 0;
      $det->TMP_LOCADORDEBCRE = '';
      $det->DATAVENCIMENTO = null;
      $det->MAISMENOS = '';
      $det->MULTA = round($subtotalmulta,2);
      $det->JUROS = round($subtotaljuros,2);
      $det->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $det->DIASATRASO = 0;
      $det->IMB_CTR_ID = $idcontrato;
      $det->IMB_IMB_ID= Auth::user()->IMB_IMB_ID;
      $det->TOTALREGISTRO =   $det->TMP_VALOR +
                              $det->MULTA +
                              $det->JUROS;

      $det->save();

   }
   public function calcularDetalheAtrasadoVencimentoEncerrados( $idcontrato )
   {


      $ctr = mdlContrato::find( $idcontrato);


      $lfs = mdlLancamentoFuturo::
      where( 'IMB_CTR_ID','=', $idcontrato )
      ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
      ->where('IMB_LCF_LOCATARIOCREDEB','<>','N' )
      ->whereNull( 'IMB_LCF_DTHINATIVADO')
      ->orderBy( 'IMB_TBE_ID')
      ->get();

      $subtotalmulta = 0;
      $subtotaljuros = 0;
      $subtotalitem = 0;
      $subtotaltotal = 0;

      foreach( $lfs as $lf)
      {


         $multa =  $this->calcularMulta(
            $idcontrato,
            $lf->IMB_LCF_DATAVENCIMENTO,
            date('Y/m/d'),
            $lf->IMB_LCF_VALOR );

         $multatotal = $multa->retervalor + $multa->repassarvalor;
         $valorlancamento =  $lf->IMB_LCF_VALOR;
         if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C' )
         {
            if( $multatotal <> 0 )
               $multatotal = $multatotal * -1;

            $valorlancamento =  $lf->IMB_LCF_VALOR * -1;

         }

         $juros= $this->calcularJuros( $idcontrato,
                                 $lf->IMB_LCF_DATAVENCIMENTO,
                                 date('Y/m/d'),
                                 $lf->IMB_LCF_VALOR );
                                 $jurostotal = $juros->retervalor + $juros->repassarvalor;
         if( $lf->IMB_LCF_LOCATARIOCREDEB == 'C' and $multatotal <> 0 )
            $jurostotal = $jurostotal * -1;

         $evento = app('App\Http\Controllers\ctrEvento')
            ->find(  $lf->IMB_TBE_ID );


         $subtotaljuros += $jurostotal;
         $subtotalmulta += $multatotal;
         $subtotalitem += $valorlancamento;

         $det = new mdlTMPAtrasadoDetail;

         $det->IMB_TBE_ID = $lf->IMB_TBE_ID;
         if( $evento <> '')
            $det->IMB_TBE_NOME = $evento->IMB_TBE_NOME;
         else
            $det->IMB_TBE_NOME = 'NÃO IDENTIFICADO('.$lf->IMB_TBE_ID.')';
         $det->TMP_CREDITODEBITO = $lf->IMB_LCF_LOCATARIOCREDEB;
         $det->TMP_VALOR = $valorlancamento;
         $det->IMB_TBE_OBSERVACAO = $lf->IMB_LCF_OBSERVACAO;
         $det->IMB_LCF_ID = $lf->IMB_LCF_ID;

         if( $lf->IMB_LCF_LOCATARIOCREDEB == 'D')
            $det->MAISMENOS = '+';
         else
            $det->MAISMENOS = '-';

         $det->TMP_LOCADORDEBCRE = $lf->IMB_LCF_LOCADORCREDEB;
         $det->DATAVENCIMENTO = $lf->IMB_LCF_DATAVENCIMENTO;
         $det->MULTA = $multatotal;
         $det->JUROS = $jurostotal;
         $det->PERMANENCIA = 0;
         $det->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
         $det->DIASATRASO = $multa->diasatraso;
         $det->IMB_CTR_ID = $idcontrato;
         $det->IMB_IMB_ID= Auth::user()->IMB_IMB_ID;
         $det->TOTALREGISTRO = $valorlancamento + $multatotal + $jurostotal;
         $det->save();

      }

    

      $det = new mdlTMPAtrasadoDetail;
      $det->IMB_TBE_ID = 999999;
      $det->IMB_TBE_NOME = 'Total do Vencimento';
      $det->TMP_CREDITODEBITO = '';
      $det->TMP_VALOR = round($subtotalitem,2);
      $det->IMB_TBE_OBSERVACAO = '';
      $det->IMB_LCF_ID = 0;
      $det->TMP_LOCADORDEBCRE = '';
      $det->DATAVENCIMENTO = null;
      $det->MAISMENOS = '';
      $det->MULTA = round($subtotalmulta,2);
      $det->JUROS = round($subtotaljuros,2);
      $det->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $det->DIASATRASO = 0;
      $det->IMB_CTR_ID = $idcontrato;
      $det->IMB_IMB_ID= Auth::user()->IMB_IMB_ID;
      $det->TOTALREGISTRO =   $det->TMP_VALOR +
                              $det->MULTA +
                              $det->JUROS;

      $det->save();

   }


   public function totalizarTMPAtrasadosDetail( Request $request)
   {
      $idcontrato='';

      if( $request->has( 'idcontrato') and $request->has( 'idcontrato') <> ''  )
         $idcontrato = $request->idcontrato;

      $det = mdlTMPAtrasadoDetail::
      select(
         [
            DB::raw( 'sum(TMP_VALOR) AS TOTALVALOR'),
            DB::raw( 'sum(MULTA) AS TOTALMULTA'),
            DB::raw( 'sum(JUROS) AS TOTALJUROS'),
            DB::raw( 'sum(TOTALREGISTRO) AS TOTALTOTAL'),
         ]
      )
      ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
      ->whereNotNull( 'DATAVENCIMENTO');

     if( $idcontrato <> '' )
     $det = $det->where( 'IMB_CTR_ID','=', $idcontrato );

     $det = $det->get();

     return $det;

   }

   public function alteracaoVencimento( Request $request )
   {
      $cav = new  mdlAltVen;

      $contrato = mdlContrato::find( $request->IMB_CTR_ID);

      $cav->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
      $cav->IMB_CTR_ID = $request->IMB_CTR_ID;
      $cav->IMB_IMV_ID = $contrato->IMB_IMV_ID;
      $cav->IMB_CAV_DIASDELOCACAO = $request->IMB_CAV_DIASDELOCACAO;
      $cav->IMB_CAV_PERIODODATAINICIO = $request->IMB_CAV_PERIODODATAINICIO;
      $cav->IMB_CAV_PERIODODATAFIM = $request->IMB_CAV_PERIODODATAFIM;
      $cav->IMB_CAV_VALOR = $request->IMB_CAV_VALOR;
      $cav->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $cav->IMB_CAV_DATA = date('Y/m/d');
      $cav->IMB_CAV_DIAANTERIOR = $contrato->IMB_CTR_DIAVENCIMENTO;
      $cav->IMB_CAV_DIAATUAL = $request->IMB_CAV_DIAATUAL;
      $cav->IMB_CAV_OBSERVACAO = $request->IMB_CAV_OBSERVACAO;
      $cav->IMB_LCF_ID = $request->IMB_LCF_ID;
      $cav->IMB_CAV_TIPO = $request->IMB_CAV_TIPO;
      $cav->IMB_CAV_LIBERADO = $request->IMB_CAV_LIBERADO;

      if( $request->IMB_CAV_LIBERADO <> 'S')
      {
         $lf = new mdlLancamentoFuturo;
         $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
         $lf->IMB_CTR_ID = $request->IMB_CTR_ID;
         $lf->IMB_LCF_VALOR = $request->IMB_CAV_VALOR;
         $lf->IMB_LCF_LOCADORCREDEB = 'C';
         $lf->IMB_LCF_LOCATARIOCREDEB ='D';
         $lf->IMB_LCF_DATAVENCIMENTO = $request->IMB_CAV_PERIODODATAFIM;
         $lf->IMB_LCF_TIPO = '';
         $lf->IMB_IMV_ID = $contrato->IMB_IMV_ID;
         //$lf->IMB_CLT_IDLOCADOR =
         $lf->IMB_TBE_ID = 24;;
         $lf->IMB_ATD_ID = Auth::user()->IMB_IMB_ID;
         $lf->IMB_LCF_INCMUL = 'S';
         $lf->IMB_LCF_INCIRRF ='S';
         $lf->IMB_LCF_INCTAX = 'S';
         $lf->IMB_LCF_INCJUROS = 'S';
         $lf->IMB_LCF_INCCORRECAO =  'S';
         $lf->IMB_LCF_GARANTIDO = 'S';
         $lf->IMB_LCF_OBSERVACAO = $request->IMB_CAV_OBSERVACAO;
         $lf->IMB_LCF_NUMEROCONTROLE = '0';
         $lf->IMB_LCF_NUMPARREAJUSTE = '0';
         $lf->IMB_LCF_NUMPARCONTRATO = '0';
         $lf->IMB_LCF_CHAVE          = '0';
         $lf->IMB_LCF_REAJUSTAR      = 'N';
         $cav->IMB_LCF_ID = $lf->IMB_LCF_ID;
         $lf->save();
      }

      $cav->save();

      $lfs = mdlLancamentoFuturo::
      where( 'IMB_CTR_ID','=', $request->IMB_CTR_ID )
      ->where( 'IMB_LCF_DATAVENCIMENTO','>=', $request->IMB_CAV_PERIODODATAINICIO )
      ->orderBy( 'IMB_LCF_DATAVENCIMENTO')
      ->get();

      //dd( $lfs );

      if( $lfs <> '[]')
      {
         foreach( $lfs as $lf )
         {
            $dataexplode = explode( '-', $lf->IMB_LCF_DATAVENCIMENTO );
            $mes = $dataexplode[1];
            $ano = $dataexplode[0];
            $dia = $dataexplode[2];

            $novodia = $request->IMB_CAV_DIAATUAL;

            $ultimodia = $this->ultimoDiaMes($mes,  $ano );
            if( $novodia > $ultimodia )
               $novodia = $ultimodia;

            $novadata = $ano.'-'.$mes.'-'.$novodia;

            $lf->IMB_LCF_DATAVENCIMENTO = $novadata;
            if( $lf->IMB_TBE_ID == 1 )
               $lf->IMB_LCF_OBSERVACAO =  $this->gerarPeriodo( $request->IMB_CTR_ID, $novadata);
            $lf->save();
         }

      }

      $contrato->IMB_CTR_VENCIMENTOLOCADOR = $request->IMB_CAV_PERIODODATAFIM;
      $contrato->IMB_CTR_VENCIMENTOLOCATARIO = $request->IMB_CAV_PERIODODATAFIM;
      $contrato->IMB_CTR_DIAVENCIMENTO = $request->IMB_CAV_DIAATUAL;
      $contrato->save();

      return response()->json( 'ok',200);

   }

   public function alteracaoVenCarga ( $id )
   {
      $av = mdlAltVen::where('IMB_CONTRATOALTOVENC.IMB_CTR_ID','=', $id )
      ->where('IMB_CONTRATOALTOVENC.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CONTRATOALTOVENC.IMB_ATD_ID')
      ->orderBy( 'IMB_CAV_DATA')
      ->get();

      return $av;

   }

   public function camposMesclagem()
   {

      $campos = mdlCamposMesclagem::orderBy( 'GER_CMM_NOMECAMPO')->get();

      return $campos;


   }

   public function lancarAluguel( $idcontrato, $vencimento)
   {
      $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$idcontrato )
      ->where( 'IMB_LCF_DATAVENCIMENTO','=', $vencimento )
      ->where( 'IMB_TBE_ID','=',1 )
      ->whereNull( 'IMB_LCF_DTHINATIVADO')
      ->first();

      ////Log:info( 'lancaraluguel '.$idcontrato.' - '.$vencimento );

      if( $lf <> '' )
      {

         if( $lf->IMB_LCF_OBSERVACAO == 'Aluguel do Mês')
         {
            $lf->IMB_LCF_OBSERVACAO = app('App\Http\Controllers\ctrRotinas')
                  ->gerarPeriodo( $idcontrato, $vencimento );
            $lf->save();
         }

      }
      else
      {


         $idcfc = '';
         $eve        = mdlTabelaEvento::where( 'IMB_TBE_ID', '=', 1 )->first();
         if( $eve <> '' )
            $idcfc = $eve->FIN_CFC_ID;

         $ctr=mdlContrato::find( $idcontrato );

         if( $ctr <> '' )
         {
            $lf = new mdlLancamentoFuturo;
            $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_CTR_ID = $idcontrato;
            $lf->IMB_LCF_VALOR = $ctr->IMB_CTR_VALORALUGUEL;
            $lf->IMB_LCF_LOCADORCREDEB = 'C';
            $lf->IMB_LCF_LOCATARIOCREDEB = 'D';
            $lf->IMB_LCF_DATAVENCIMENTO = $vencimento;
            $lf->IMB_LCF_TIPO = 'M';
            $lf->IMB_IMV_ID = $ctr->IMB_IMV_ID;
            $lf->IMB_CLT_IDLOCADOR = 0;
            $lf->IMB_TBE_ID = 1;
            $lf->IMB_ATD_ID = Auth::user()->IMB_IMB_ID;
            $lf->IMB_LCF_INCMUL ='S';
            $lf->IMB_LCF_INCIRRF ='S';
            $lf->IMB_LCF_INCTAX = 'S';
            $lf->IMB_LCF_INCJUROS = 'S';
            $lf->IMB_LCF_INCCORRECAO =  'S';
            $lf->IMB_LCF_GARANTIDO = 'S';
            $lf->IMB_LCF_INCISS = 'N';
            $lf->IMB_LCF_OBSERVACAO = app('App\Http\Controllers\ctrRotinas')
            ->gerarPeriodo( $idcontrato, $vencimento );
            $lf->IMB_LCF_NUMEROCONTROLE = 1;
            $lf->IMB_LCF_NUMPARREAJUSTE = 1;
            $lf->IMB_LCF_NUMPARCONTRATO = 1;
            $lf->IMB_LCF_CHAVE          = 1;
            $lf->IMB_LCF_REAJUSTAR          = 'N';
            $lf->IMB_LCF_DATALANCAMENTO = date('Y/m/d');
            $lf->FIN_CFC_ID = $idcfc;
            $lf->save();
            $this->gravarObs( 0, $idcontrato, 0, 0, 0, 'Lancamento automatio de aluguel no recebimento: '.$ctr->IMB_CTR_VALORALUGUEL.
            ' - Vencto: '.$this->formatarData( $vencimento) );
         }
         //////Log:info( 'Entrei pra gerar aluguel');
      }

   }

   public function gravarObs( $IMB_IMV_ID, $IMB_CTR_ID, $IMB_CLT_ID, $IMB_RLD_NUMERO, $IMB_RLT_NUMERO, $IMB_OBS_OBSERVACAO)
   {
      $obs = new mdlObs;
      $obs->IMB_IMV_ID = $IMB_IMV_ID;
      $obs->IMB_CTR_ID = $IMB_CTR_ID;
      $obs->IMB_CLT_ID = $IMB_CLT_ID;
      $obs->IMB_RLD_NUMERO = $IMB_RLD_NUMERO;
      $obs->IMB_RLT_NUMERO = $IMB_RLT_NUMERO;
      $obs->IMB_OBS_OBSERVACAO = $IMB_OBS_OBSERVACAO;
      $obs->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
      $obs->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
      $obs->IMB_OBS_DTHATIVO = date('Y/m/d H:i:s');
      $obs->save();
    }

    public function gravarRelato( Request $request)
    {
       $obs = new mdlObs;
       $obs->IMB_IMV_ID = 0;
       $obs->IMB_CTR_ID = $request->IMB_CTR_ID;
       $obs->IMB_CLT_ID = 0;
       $obs->IMB_RLD_NUMERO = 0;
       $obs->IMB_RLT_NUMERO = 0;
       $obs->IMB_OBS_OBSERVACAO = '[Manual] - '.$request->IMB_OBS_OBSERVACAO;
       $obs->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
       $obs->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
       $obs->IMB_OBS_DTHATIVO = date('Y/m/d H:i:s');
       $obs->save();
       return response()->json('ok',200);
     }
 
     public function gravarLog( $IMB_MDL_CODIGO, $IMB_LOG_OPERACAO, $IMB_LOG_DESCRICAO)
    {
       $obs = new mdlLog;
       $obs->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
       $obs->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
       $obs->IMB_LOG_DATAHORA = date('Y/m/d H:i:s');
       $obs->IMB_LOG_DESCRICAO = $IMB_LOG_DESCRICAO;
       $obs->IMB_LOG_OPERACAO = $IMB_LOG_OPERACAO;
       $obs->IMB_MDL_CODIGO = $IMB_MDL_CODIGO;
       $obs->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
       $obs->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
       $obs->save();
     }

     public function relatoriosAdmImoveis()
    {

      return view( 'reports.admimoveis.menurelatoriosadmimoveis');
    }


    public function formatCnpjCpf($value)
    {
      $cnpj_cpf = preg_replace("/\D/", '', $value);

      if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
      }

      return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    public function dataExtenso( $data )
    {
         if( strpos( $data,'/' )  <> '' )
            $rData =explode("/", trim($data));
         else
            $rData =explode("-", trim($data));

         $dia = $rData[2];
         $mes = intval($rData[1]);
         $ano = $rData[0];
            $nomemes[1]='Janeiro';
            $nomemes[2]='Fevereiro';
            $nomemes[3]='Março';
            $nomemes[4]='Abril';
            $nomemes[5]='Maio';
            $nomemes[6]='Junho';
            $nomemes[7]='Julho';
            $nomemes[8]='Agosto';
            $nomemes[9]='Setembro';
            $nomemes[10]='Outubro';
            $nomemes[11]='Novembro';
            $nomemes[12]='Dezembro';

         return $dia.' de '.$nomemes[ $mes ].' de '.$ano;


    }

    public function mesExtenso( $data )
    {
         if( strpos( $data,'/' )  <> '' )
            $rData =explode("/", trim($data));
         else
            $rData =explode("-", trim($data));

         $mes = intval($rData[1]);
         $nomemes[1]='Janeiro';
         $nomemes[2]='Fevereiro';
         $nomemes[3]='Março';
         $nomemes[4]='Abril';
         $nomemes[5]='Maio';
         $nomemes[6]='Junho';
         $nomemes[7]='Julho';
         $nomemes[8]='Agosto';
         $nomemes[9]='Setembro';
         $nomemes[10]='Outubro';
         $nomemes[11]='Novembro';
         $nomemes[12]='Dezembro';
         
         $ano = $rData[0];
         
         return $nomemes[ $mes ].'/'.$ano;


    }
    public function numeroextenso($valor = 0, $maiusculas = false) {
      $singular = ["Centavo", "", "Mil", "Milhão", "Bilhão", "Trilhão",  "Quatrilhão"];
     $plural = ["centavos", "", "mil", "milhões", "Bilhões", "Trilhões", "Quatrilhões"];
     $u = ["", "Um", "Dois", "Três", "Quatro", "Cinco", "Seis",  "Sete", "Oito", "Nove"];

 $c = ["", "Cem", "Duzentos", "Trezentos", "Quatrocentos", "Quinhentos", "Seiscentos", "Setecentos", "Oitocentos", "Novecentos"];
 $d = ["", "Dez", "Vinte", "Trinta", "Quarenta", "Cinquenta", "Sessenta", "Setenta", "Oitenta", "Noventa"];
 $d10 = ["Dez", "Onze", "Doze", "Treze", "Quatorze", "Quinze", "Dezesseis", "Dezesete", "Dezoito", "Dezenove"];

 $z = 0;
 $rt = "";

 $valor = number_format($valor, 2, ".", ".");
 $inteiro = explode(".", $valor);
 for($i=0;$i<count($inteiro);$i++)
 for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
 $inteiro[$i] = "0".$inteiro[$i];

 $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
 for ($i=0;$i<count($inteiro);$i++) {
     $valor = $inteiro[$i];
     $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
     $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
     $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

     $r = $rc.(($rc && ($rd || $ru)) ? " E " : "").$rd.(($rd &&
     $ru) ? " e " : "").$ru;
     $t = count($inteiro)-1-$i;
     $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
     if ($valor == "000")$z++; elseif ($z > 0) $z--;
     if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " DE " : "").$plural[$t];
     if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " E ") : " ") . $r;
 }

 if(!$maiusculas){
     $return = $rt ? $rt : "ZERO";
 } else {
         $return = ($rt) ? ($rt) : "ZERO" ;
 }

     return $return;
}
public function valorExtenso($valor = 0, $maiusculas = false) {
           $singular = ["CENTAVO", "REAIS", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO",  "QUATRILHÃO"];
          $plural = ["CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", "QUATRILHÕES"];
          $u = ["", "UM", "DOIS", "TRÊS", "QUATRO", "CINCO", "SEIS",  "SETE", "OITO", "NOVE"];

      $c = ["", "CEM", "DUZENTOS", "TREZENTOS", "QUATROCENTOS", "QUINHENTOS", "SEISCENTOS", "SETECENTOS", "OITOCENTOS", "NOVECENTOS"];
      $d = ["", "DEZ", "VINTE", "TRINTA", "QUARENTA", "CINQUENTA", "SESSENTA", "SETENTA", "OITENTA", "NOVENTA"];
      $d10 = ["DEZ", "ONZE", "DOZE", "TREZE", "QUATORZE", "QUINZE", "DEZESSEIS", "DEZESETE", "DEZOITO", "DEZENOVE"];

      $z = 0;
      $rt = "";

      $valor = number_format($valor, 2, ".", ".");
      $inteiro = explode(".", $valor);
      for($i=0;$i<count($inteiro);$i++)
      for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
      $inteiro[$i] = "0".$inteiro[$i];

      $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
      for ($i=0;$i<count($inteiro);$i++) {
          $valor = $inteiro[$i];
          $rc = (($valor > 100) && ($valor < 200)) ? "CENTO" : $c[$valor[0]];
          $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
          $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

          $r = $rc.(($rc && ($rd || $ru)) ? " E " : "").$rd.(($rd &&
          $ru) ? " e " : "").$ru;
          $t = count($inteiro)-1-$i;
          $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
          if ($valor == "000")$z++; elseif ($z > 0) $z--;
          if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " DE " : "").$plural[$t];
          if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " E ") : " ") . $r;
      }

      if(!$maiusculas){
          $return = $rt ? $rt : "ZERO";
      } else {
              $return = ($rt) ? ($rt) : "ZERO" ;
      }

          return $return;
  }


  public function formatarReal( $valor )
  {
      Log::info( 'valor '.$valor );
      return number_format($valor,2,",",".");
  }

  public function buscarIndiceReajuste( $id )
  {
     $irj = mdlIndiceReajuste::find( $id );
     if( $irj )
        return $irj->IMB_IRJ_NOME;

      return 'Não Encontrado';

  }

  public function pegarUsuarioLogado()
  {
   return Auth::user()->IMB_ATD_NOME;
  }

  public function pegaNomeEvento( $id )
  {
     $eve = mdlTabelaEvento::where( 'IMB_TBE_ID','=', $id )
     ->first();

     return $eve->IMB_TBE_NOME;

  }

  public function formata_numero($numero,$loop,$insert,$tipo = "geral")
  {
      if ($tipo == "geral") {
          $numero = str_replace(",","",$numero);
          while(strlen($numero)<$loop){
              $numero = $insert . $numero;
          }
      }
      if ($tipo == "valor") {
          /*
          retira as virgulas
          formata o numero
          preenche com zeros
          */
          $numero = str_replace(",","",$numero);
          while(strlen($numero)<$loop){
              $numero = $insert . $numero;
          }
      }
      if ($tipo == "convenio") {
          while(strlen($numero)<$loop){
              $numero = $numero . $insert;
          }
      }
      return $numero;
  }

  public function pegarDetalheDebitoTMPDetail( $idcontrato, $ven )
  {
      $detail = mdlTMPAtrasadoDetail::where( 'IMB_CTR_ID','=', $idcontrato )
      ->where( 'DATAVENCIMENTO','=', $ven )
      ->where( 'IMB_TBE_ID','<>', '999999' )
      ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
      ->orderBy( 'IMB_TBE_ID')
      ->get();
      return $detail;

  }

  public function pegarVencimentosDebitoTMPDetail( $idcontrato )
  {
    $vencimentos = mdlTMPAtrasadoDetail::select( [ 'DATAVENCIMENTO'])
      ->where( 'IMB_CTR_ID','=', $idcontrato )
      ->where( 'IMB_TBE_ID','<>', '999999' )
      ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
      ->distinct( 'DATAVENCIMENTO')
      ->orderBy( 'DATAVENCIMENTO')
      ->get();
      return $vencimentos;

  }

  public function relatorioDebitoCliente( $idcontrato )
  {
      $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID);
      $ctr = mdlContrato::find( $idcontrato );
      $enderecoimovel = $this->imovelEndereco( $ctr->IMB_IMV_ID);
      $locatario = $this->nomeLocatarioPrincipal( $idcontrato );

      app( '\App\Http\Controllers\ctrRotinas')->calcularDetalheAtrasados( $idcontrato, 'relatorio');
      return view( 'reports.admimoveis.relatoriodebitocliente', compact( 'imb','enderecoimovel','locatario','idcontrato'));
  }

  public function cargaReajustados( Request $request )
  {
        $datainicio = $request->datainicio;
        $IMB_IMB_ID = $request->IMB_IMB_ID;
        $datafim    = $request->datafim;
        $origem    = $request->origem;

        if( $datainicio == '')
            $datainicio=date( 'Y/m/d');
        else
            $datainicio =  $this->formatarData( $datainicio );

        if( $datafim == '')
            $datafim=date( 'Y/m/d');
        else
            $datafim =  $this->formatarData( $datafim );

            $reajustados = mdlContratoHistoricoReajuste::select(
                [
                    'IMB_CHR_ID',
            	'IMB_CONTRATOHISTREA.IMB_IMB_ID',
            	'IMB_CONTRATO.IMB_IMV_ID',
	            'IMB_CONTRATOHISTREA.IMB_CTR_ID',
	            'IMB_CTR_VALORANTERIOR',
	            'IMB_CONTRATOHISTREA.IMB_CTR_VALOR',
	            'IMB_CHR_OBSERVACAO',
	            'IMB_CONTRATOHISTREA.IMB_IRJ_ID',
	            'IMB_CHR_FATOR',
	            'IMB_CHR_DATAREAJUSTE' ,
	            'IMB_CHR_DATAPROXIMOREAJUSTE',
	            'IMB_CONTRATOHISTREA.IMB_ATD_ID',
	            'IMB_CHR_DTHATIVO',
	            'IMB_CHR_DTINATIVO',
                'IMB_CTR_REFERENCIA',
                DB::raw(' COALESCE(IMB_CHR_DESCONTO,0) IMB_CHR_DESCONTO '),
                DB::raw( 'imovel( IMB_CONTRATO.IMB_IMV_ID ) AS ENDERECO'),
                DB::raw( 'PEGALOCATARIOCONTRATO( IMB_CONTRATO.IMB_CTR_ID ) AS locatario'),
                DB::raw( 'PEGACODIGOLOCATARIOCONTRATO( IMB_CONTRATO.IMB_CTR_ID ) AS idlocatario'),
                
                'IMB_ATD_NOME',
                'IMB_IMB_NOME',
                'IMB_IMB_URL',
                'IMB_IMB_ENDERECO',
                'IMB_IMB_ENDERECONUMERO',
                'IMB_IMB_ENDERECOCOMPLEMENTO',
                'IMB_IMOBILIARIA.IMB_IMB_CEP',
                'IMB_IMOBILIARIA.IMB_IMB_TELEFONE1',
                'IMB_IMOBILIARIA.IMB_IMB_EMAIL',
                'IMB_IMOBILIARIA.CEP_CID_NOME',
                'IMB_IMOBILIARIA.CEP_UF_SIGLA',
                'IMB_IRJ_NOME',
                'IMB_IMV_CIDADE',
                'IMB_IMV_ESTADO',
                'IMB_IMOVEIS.CEP_BAI_NOME AS CEP_BAI_NOMEIMOVEL',
                'IMB_IMV_ENDERECOCEP',
            ])
        ->leftJoin( 'IMB_CONTRATO', 'IMB_CONTRATO.IMB_CTR_ID','IMB_CONTRATOHISTREA.IMB_CTR_ID')
        ->leftJoin( 'IMB_IMOVEIS', 'IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTRATO.IMB_IMV_ID')
        ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID','IMB_CONTRATOHISTREA.IMB_ATD_ID')
        ->leftJoin( 'IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID','IMB_CONTRATOHISTREA.IMB_IMB_ID')
        ->leftJoin( 'IMB_INDICEREAJUSTE', 'IMB_INDICEREAJUSTE.IMB_IRJ_ID','IMB_CONTRATOHISTREA.IMB_IRJ_ID')
        ->whereNull( 'IMB_CHR_DTINATIVO')
        ->whereRaw( "IMB_CHR_DATAREAJUSTE between '$datainicio' and '$datafim'" );
//        ->where( 'IMB_CHR_DATAREAJUSTE','<=', $datafim );

        if( $IMB_IMB_ID <> '' )
            $reajustados = $reajustados->where('IMB_CONTRATOHISTREA.IMB_IMB_ID','=', $IMB_IMB_ID );

        if( $origem == 'RELATORIO')
        {
            $reajustados = $reajustados->get();
            return $reajustados;
        };

        if( $origem == 'CARTAS')
        {
            $reajustados = $reajustados->get();

            ini_set('memory_limit', '256M');

            $pdf=PDF::loadView( 'reports.admimoveis.cartasreajustes', compact( 'reajustados') );;
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('cartasreajuste.pdf');

        }
        else
        if( $origem == 'EMAIL')
        {
         $reajustados = $reajustados->get();
            foreach( $reajustados as $reaj)
            {

               app('App\Http\Controllers\ctrDocsAutomaticos')->emailAvisoReajusteLocatario( $reaj->idlocatario, $reaj->IMB_CTR_ID);

            }

            return response()->json( 'ok',200);
            

        }


        return DataTables::of($reajustados)->make(true);


  }
  public function motivoRescisaoCarga()
  {
      $motivos = mdlMotivoRescisao::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->get();
      return $motivos;
  }
  public function proprietarioPrincipal( $idimovel )
  {
      $ppn = mdlPropImovel::where( 'IMB_IMV_ID','=', $idimovel )
      ->where( 'IMB_IMVCLT_PRINCIPAL','=', 'S' )
      ->first();
      if( $ppn )
      {
          $clt = mdlCliente::find( $ppn->IMB_CLT_ID);
          return $clt->IMB_CLT_NOME;
      }

      return 'Descadastrado';
  }
  public function dadosLocadorPrincipal( $idimovel )
  {
      $ppn = mdlPropImovel::where( 'IMB_IMV_ID','=', $idimovel )
      ->where( 'IMB_IMVCLT_PRINCIPAL','=', 'S' )
      ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID')
      ->first();

      return response()->json( $ppn,200 );
  }

  public function fornecedor( $id )
  {

    $for = mdlEmpresa::find( $id );

    return $for->IMB_EEP_RAZAOSOCIAL;

  }

  public function enderecoCobrancaFind( $id)
  {
    $ec = mdlEnderecoCobranca::find( $id );

    return response()->json($ec,200);

  }

  public function enderecoCobrancaGravar( Request $request)
  {
    $IMB_CTR_ID =$request->IMB_CTR_ID;
    $IMB_CCB_ENDERECO =$request->IMB_CCB_ENDERECO;
    $IMB_CCB_ENDERECOCOMPLEMENTO =$request->IMB_CCB_ENDERECOCOMPLEMENTO;
    $IMB_CCB_ENDERECONUMERO =$request->IMB_CCB_ENDERECONUMERO;
    $IMB_CCB_BAIRRO =$request->IMB_CCB_BAIRRO;
    $IMB_CCB_DESTINATARIO =$request->IMB_CCB_DESTINATARIO;
    $IMB_CCB_CEP =$request->IMB_CCB_CEP;
    $CEP_CID_NOME =$request->CEP_CID_NOME;
    $CEP_UF_SIGLA =$request->CEP_UF_SIGLA;

    $ec =  mdlEnderecoCobranca::find( $IMB_CTR_ID );

    if( $ec == '' )
        $ec = new mdlEnderecoCobranca;

    $ec->IMB_CCB_DESTINATARIO = $IMB_CCB_DESTINATARIO;
    $ec->IMB_CCB_ENDERECO = $IMB_CCB_ENDERECO;
    $ec->IMB_CCB_ENDERECOCOMPLEMENTO = $IMB_CCB_ENDERECOCOMPLEMENTO;
    $ec->IMB_CCB_ENDERECONUMERO = $IMB_CCB_ENDERECONUMERO;
    $ec->IMB_CCB_BAIRRO = $IMB_CCB_BAIRRO;
    $ec->IMB_CCB_CEP = $IMB_CCB_CEP;
    $ec->CEP_CID_NOME = $CEP_CID_NOME;
    $ec->CEP_UF_SIGLA = $CEP_UF_SIGLA;
    $ec->IMB_CTR_ID  =$IMB_CTR_ID ;
    $ec->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
    $ec->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
    $ec->save();

    return response()->json('ok',200);


  }

  public function enderecoCobrancaExcluir( $id )
  {
    $ec =  mdlEnderecoCobranca::find( $id);
    if( $ec )
        $ec->delete();

    return response()->json( 'ok',200);
  }


  public function pegarReferencia( $id )
  {
      $ctr = mdlContrato::find( $id );
      return $ctr->IMB_CTR_REFERENCIA;
  }

  public function pegarIdContrato( $referencia )
  {
      $ctr = mdlContrato::where( 'IMB_CTR_REFERENCIA','=', $referencia )->first();
      return $ctr->IMB_CTR_ID;
  }

  public function pegarBanco( $id )
  {
      $bc = mdlRedeBancaria::where( 'GER_BNC_NUMERO','=', $id )->first();
   
      if( $bc == '' )
          return '';
      else
         return $bc->GER_BNC_NOME;
  }

  public function reajustesAtrasadosCount()
  {

   /*
      $data = date('Y/m/d');

      $reajustes = mdlContrato::where( 'IMB_CTR_SITUACAO','=', 'ATIVO' )
      ->where( 'IMB_CTR_DATAREAJUSTE','<', $data )
      ->count();

      return $reajustes;
      */

  }

  public function aluguelAtrasadosCount()
  {
   /*

      $data = date('Y/m/d');

      $reajustes = mdlContrato::where( 'IMB_CTR_SITUACAO','=', 'ATIVO' )
      ->where( 'IMB_CTR_VENCIMENTOLOCATARIO','<', $data )
      ->count();

      return $reajustes;
      */

  }

  public function reajustarAutomatico( Request $request )
  {
     $mes = $request->mes;
     $ano = $request->ano;
     $empresa = Auth::user()->IMB_IMB_ID;
     $carga = mdlContrato::select(
        [
           'IMB_CTR_ID',
           'IMB_IMV_ID',
           'IMB_CTR_REFERENCIA',
           'IMB_CTR_DATAREAJUSTE',
           'IMB_CTR_TERMINO',
           'IMB_CTR_VALORALUGUEL',
           DB::Raw('IMB_IRJ_NOME as INDICE'),
           DB::Raw( 'imovel( IMB_IMV_ID ) AS ENDERECO'),
           DB::Raw( 'PEGALOCADORCONTRATO( IMB_CTR_ID ) AS LOCADOR'),
           DB::Raw( 'PEGALOCATARIOCONTRATO( IMB_CTR_ID ) AS LOCATARIO'),
           DB::Raw( "( SELECT IMB_TBC_FATOR FROM IMB_TABELACORRECAO 
           WHERE IMB_TBC_INDICECORRECAO = IMB_INDICEREAJUSTE.IMB_IRJ_ID 
           AND IMB_TBC_MES = $mes 
           AND IMB_TBC_INDICECORRECAO = IMB_INDICEREAJUSTE.IMB_IRJ_ID AND IMB_TBC_ANO = $ano ) as IMB_TBC_FATOR")
        ]
        )->leftJoin( 'IMB_INDICEREAJUSTE','IMB_INDICEREAJUSTE.IMB_IRJ_ID', 'IMB_CONTRATO.IMB_IRJ_ID')
        ->whereYear( 'IMB_CTR_DATAREAJUSTE','=', $ano
        )->whereMonth( 'IMB_CTR_DATAREAJUSTE','=', $mes
        )->where( 'IMB_CTR_SITUACAO','=', 'ATIVO');

      $carga = $carga->get();
      $naoreajustado = 0;

      foreach( $carga as $dados )
      {

         $id = $dados->IMB_CTR_ID;
         $ctr = mdlContrato::find( $id );

         $irj = mdlIndiceReajuste::find( $ctr->IMB_IRJ_ID);
   
         $datareajuste = explode( "-",$ctr->IMB_CTR_DATAREAJUSTE);
         $mes = $datareajuste[1];
         $ano = $datareajuste[0];
   
         $tc = mdlTabelaCorrecao::where( 'IMB_TBC_INDICEID','=', $ctr->IMB_IRJ_ID )
         ->where( 'IMB_TBC_MES','=',$mes )
         ->where( 'IMB_TBC_ANO','=',$ano )
         ->first();
   
         if( $tc <> '' )
         {
   
            $diavencimento = $ctr->IMB_CTR_DIAVENCIMENTO;
            $meses = $ctr->IMB_CTR_FORMAREAJUSTE;
   
            $data =$ctr->IMB_CTR_DATAREAJUSTE;
            //$data = date_create_from_format("m-d-Y", $data);
            $valoratual = $ctr->IMB_CTR_VALORALUGUEL;
            $novovalor = $ctr->IMB_CTR_VALORALUGUEL + ( $ctr->IMB_CTR_VALORALUGUEL * $tc->IMB_TBC_FATOR / 100 );
            $novovalor = round( $novovalor);
   
            $ctr = mdlContrato::find( $id );

            $datainicial = explode( "-",$data);

            $mes = $datainicial[1];
            $ano = $datainicial[0];
      
            $array = [];
      
            for ($x = 1; $x <= $meses; $x++)
            {
            
               $dia = $diavencimento;
               $ultimodia = $this-> ultimoDiaMes($mes,  $ano );
               if( $ultimodia < $dia )
                  $dia = $ultimodia;
      
               $data = date( 'Y-m-d', mktime(0, 0, 0,$mes,$dia,$ano));
      
               $obs ='';
      
               $obs = $this->gerarPeriodo( $ctr->IMB_CTR_ID, $data);
      
               $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$id )
                  ->where( 'IMB_LCF_DATAVENCIMENTO','=', $data )
                  ->where( 'IMB_TBE_ID','=',1)
                  ->whereNull('IMB_LCF_DATARECEBIMENTO')
                  ->whereNull('IMB_LCF_DATAPAGAMENTO')
                  ->delete();
         
         
                  //se ainda ficou algum lancamento de alguel e tem recto ou repasse, então não posso gerar valor
               $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$id )
                  ->where( 'IMB_LCF_DATAVENCIMENTO','=', $data )
                  ->where( 'IMB_TBE_ID','=',1)
                  ->first();
         
               if( $lf == '' )
               {
                     $lf = new mdlLancamentoFuturo;
                     $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                     $lf->IMB_CTR_ID = $id;
                     $lf->IMB_LCF_VALOR = $novovalor;;
                     $lf->IMB_LCF_LOCADORCREDEB ='C';
                     $lf->IMB_LCF_LOCATARIOCREDEB ='D';
                     $lf->IMB_LCF_DATAVENCIMENTO = $data;
                     $lf->IMB_LCF_TIPO = 'R';
                     $lf->IMB_IMV_ID = $ctr->IMB_IMV_ID;
                     $lf->IMB_CLT_IDLOCADOR = 0;
                     $lf->IMB_TBE_ID = '1';
                     $lf->IMB_ATD_ID = Auth::user()->IMB_IMB_ID;
                     $lf->IMB_LCF_INCMUL ='S';
                     $lf->IMB_LCF_INCIRRF ='S';
                     $lf->IMB_LCF_INCTAX = 'S';
                     $lf->IMB_LCF_INCJUROS = 'S';
                     $lf->IMB_LCF_INCCORRECAO =  'S';
                     $lf->IMB_LCF_GARANTIDO = 'N';
                     $lf->IMB_LCF_INCISS = 'N';
                     $lf->IMB_LCF_OBSERVACAO = $obs;
                     $lf->IMB_LCF_NUMEROCONTROLE = 0;
                     $lf->IMB_LCF_NUMPARREAJUSTE = 0;
                     $lf->IMB_LCF_NUMPARCONTRATO = 0;
                     $lf->IMB_LCF_CHAVE          = 0;
                     $lf->IMB_LCF_REAJUSTAR          ='N';
                     $lf->save();
               }
               $mes++;
               if( $mes > 12 )
               {
                  $mes = 1;
                  $ano++;
               };
      

            }
         
            $proximoreajuste = $this->addMeses(
              $ctr->IMB_CTR_DIAVENCIMENTO, $meses, $ctr->IMB_CTR_DATAREAJUSTE );
         
            $his = new mdlContratoHistoricoReajuste;
            $his->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $his->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $his->IMB_CTR_ID =  $id;
            $his->IMB_CTR_VALORANTERIOR =  $valoratual;
            $his->IMB_CTR_VALOR =  $novovalor;
            $his->IMB_IRJ_ID =  $ctr->IMB_IRJ_ID;
            $his->IMB_CHR_FATOR =  $tc->IMB_TBC_FATOR;
            $his->IMB_CHR_DATAREAJUSTE = $ctr->IMB_CTR_DATAREAJUSTE;
            $his->IMB_CHR_DATAPROXIMOREAJUSTE = $proximoreajuste;
            $his->IMB_CHR_DTHATIVO = date( 'Y/m/d');
            $his->save();
         
            $ctr->IMB_CTR_VALORALUGUEL = $novovalor;
            $ctr->IMB_CTR_DATAREAJUSTE =$proximoreajuste;
            $ctr->save();

            $this->gravarObs( 0, $ctr->IMB_CTR_ID, 0, 0, 0, 'Contrato reajustado data de reajuste para '.$this->formatarData($proximoreajuste).
            ' - valor de R$ '.$valoratual.' Para> '.$novovalor );
         
         }
         else
         {
            $naoreajustado = $naoreajustado  + 1;
            $this->gravarObs( 0, $ctr->IMB_CTR_ID, 0, 0, 0, 'Não foi reajustado automaticamente por não ter o percentual do índice cadastrado
             para o mês '.$mes.'/'.$ano );
         }
      }
      if( $naoreajustado == 0 )
         return response()->json( 'ok',200 );
      else
         return response()->json( 'Atenção. Houveram '.$naoreajustado.' que possam ter tido problemas com o reajuste',404 );
   
  }

  public function camposSistema( $campo )
  {
      $cs = mdlCamposSistema::where( 'campo','=', $campo )->first();
      if( $cs == '') return ' ';


      return $cs->descricao;



  }

  public function setarIdContratoPublico( $id )
  {
      $mdl->idcontratopublico = $id;
      $mdl->save();
      return '';
  }

  public function parametros( $id )
  {
      $par = mdlParametros::find( $id);

      return $par;

  }

  public function parametros2( $id )
  {
      $par = mdlParametros2::find( $id);

      return $par;

  }

  public function situacaoImovel( $id )
  {
    $ctr = mdlContrato::where( 'IMB_IMV_ID','=', $id )
    ->where('IMB_CTR_SITUACAO','=', 'ATIVO' )
    ->first();
    if( $ctr == '' ) return 'DISPONÍVEL';
    return "ALUGADO";
  }

  public function sms( Request $request)
  {

      $imb = mdlImobiliaria::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->first();

      $ddd = $request->ddd;
      $numero = $request->numero;
      $conteudo = $request->conteudo;
      $conteudo = $imb->IMB_IMB_NOME.' - Segue linha digitável para pagamento de seu boleto: '.$conteudo;

      $conteudo =  str_replace(" ","%20", $conteudo );

      $endp ="http://sms.mkmservice.com/api/?modo=envio&empresa=cdl.bauru&usuario=cdl.bauru&senha=mkm@@2017&telefone=$ddd$numero&mensagem=$conteudo&centro_custo=ShortCode&agendamento=";


      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $endp);
      // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      $header = array();
      $header[] = 'Content-Type: application/json';
      curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
      $resp = curl_exec($curl);

      $resp = json_encode( $resp );
      
   
      if (curl_errno($curl)) 
      {
         $error_msg = curl_error($curl);
         var_dump($error_msg);
      }


      return response()->json( $resp,200);

  }


  public function gravarparcelasaluguel( $diaoriginal, $data, $dataReajuste, $valorparcela, $idcontrato )
  {
     $datainicial = explode( "-",$data);

     $mes = $datainicial[1];
     $ano = $datainicial[0];      

     //////Log:info( 'Data '.$data );
     //////Log:info( "Meses: ".$meses);
     //////Log:info( "total: ".$valortotal);

     $array = [];

     ////Log:info( 'strtotime($data) '.strtotime($data) . ' strtotime( $dataReajuste) '.strtotime( $dataReajuste) );
     while ( strtotime($data) < strtotime( $dataReajuste) )

     {
         
         $ctr = mdlContrato::find( $idcontrato);


        $dia = $ctr->IMB_CTR_DIAVENCIMENTO;
        $ultimodia = $this-> ultimoDiaMes($mes,  $ano );
        if( $ultimodia < $dia )
           $dia = $ultimodia;

        $data = date( 'Y-m-d', mktime(0, 0, 0,$mes,$dia,$ano));

        ////Log:info( 'strtotime($data): '.strtotime($data).' - strtotime( $dataReajuste)'.strtotime( $dataReajuste) );
        if( strtotime($data) < strtotime( $dataReajuste) )
        {
         $obs ='';

         if( $idcontrato <> 0)
            $obs = $this->gerarPeriodo( $idcontrato, $data);
         $array2 = array( "data" => $data, "valor" => $valorparcela, "observacao"=>$obs);
         array_push($array, $array2);
         //////Log:info('Lancaralguel vai');
         $this->lancarAluguel( $idcontrato, $data );
        }



        $mes++;
        if( $mes > 12 )
        {
           $mes = 1;
           $ano++;
        };


     }

  }

  public function lancarAluguelEmTodosAtivosAteReajuste()
  {

      $ctrs = mdlContrato::where( 'IMB_CTR_SITUACAO','=', 'ATIVO' )
      ->orderBy( 'IMB_CTR_ID')
      ->get();

      foreach( $ctrs as $ctr )
      {

         $dtlt = strtotime( $ctr->IMB_CTR_VENCIMENTOLOCATARIO);
         $dtld = strtotime( $ctr->IMB_CTR_VENCIMENTOLOCADOR);

         $data = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
         if( $dtld > $dtlt )
            $data = $ctr->IMB_CTR_VENCIMENTOLOCADOR;

         //////Log:info('contrato '.$ctr->IMB_CTR_ID. ' DATA '.$data );

         $this->gravarparcelasaluguel( 
               $ctr->IMB_CTR_DIAVENCIMENTO, 
               $data, 
               $ctr->IMB_CTR_DATAREAJUSTE, 
               $ctr->IMB_CTR_VALORALUGUEL,
               $ctr->IMB_CTR_ID)         ;

      }

      return response()->json( 'ok',200 );
  }

public function verificarReajustes( $idcontrato, $vencimento, $json)
{

   $par2 = mdlParametros2::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->first();
   $ctr = mdlContrato::find( $idcontrato );

   
   $reajustar = 'N';
   if( $par2->IMB_PRM_REAJUSTEFIMPARCELAS == 'S') 
   {
      
      $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=', $idcontrato )
      ->where('IMB_TBE_ID','=',1 )
      ->where( 'IMB_LCF_DATAVENCIMENTO','>=', $vencimento )
      ->whereNull( 'IMB_LCF_DTHINATIVADO')
      ->first();

      if( $lf == '')
         $reajustar = 'S';

   }
   else
      if( strtotime( $vencimento) > strtotime( $ctr->IMB_CTR_DATAREAJUSTE) )
         $reajustar = 'S';


   if ( $json == 'S' )
      return response()->json( $reajustar,200);

   return $reajustar;

  }

  public function taxasRetidas( Request $request )
  {
      
      
      $datainicial = $request->datini;
      $datafinal = $request->datfim;

      if( $datainicial == '') $datainicial = date( 'Y/m/d');
      if( $datafinal == '') $datafinal = date( 'Y/m/d');
      

      $reclds = mdlReciboLocador::where( 'IMB_RECIBOLOCADOR.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicial )
      ->where( 'IMB_RLD_DATAPAGAMENTO', '<=', $datafinal )
      ->where( 'IMB_RLD_LOCADORCREDEB','=','D' )
      ->where( 'IMB_RLD_LOCATARIOCREDEB','=','N' )
      ->where( 'IMB_TBE_INCISS','=','S')
      //->where( 'IMB_RLD_NUMERO','=','2102068')
      ->whereNull( 'IMB_RLD_DTHINATIVO')
      ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_RECIBOLOCADOR.IMB_TBE_ID')
      ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCADOR.IMB_CTR_ID')
      ->orderBy( 'IMB_RLD_DATAPAGAMENTO')
      ->get();

      $taxas = mdlTmpTaxaRecebida::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->delete();

      $total = 0;
      foreach( $reclds as $recld )
      {
         $ld = mdlCliente::find( $recld->IMB_CLT_ID);

    

         $imovel = $this->imovelEndereco( $recld->IMB_IMV_ID);
         $locatario = $this->nomeLocatarioPrincipal( $recld->IMB_CTR_ID );
         $locador = $ld->IMB_CLT_NOME;
         ////Log:info( "locador ".$locador);
         $taxas = new mdlTmpTaxaRecebida;
         $taxas->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
         $taxas->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
         $taxas->IMB_TAXREC_ORIGEM = 'Repasse';
         $taxas->IMB_TBE_ID = $recld->IMB_TBE_ID;
         $taxas->IMB_TBE_NOME = $recld->IMB_TBE_NOME;
         $taxas->IMB_RLD_DATAVENCIMENTO = $recld->IMB_RLD_DATAVENCIMENTO;
         $taxas->IMB_RLD_DATAPAGAMENTO = $recld->IMB_RLD_DATAPAGAMENTO;
         $taxas->FIN_CCX_ID = $recld->FIN_CCX_ID;
         $taxas->IMB_RLD_VALOR = $recld->IMB_RLD_VALOR;
         $taxas->IMB_RLD_OBSERVACAO = $recld->IMB_RLD_OBSERVACAO;
         $taxas->IMB_CTR_REFERENCIA = $recld->IMB_CTR_REFERENCIA;
         $taxas->IMB_IMV_ID = $recld->IMB_IMV_ID;
         $taxas->ENDERECOIMOVEL = $imovel;
         $taxas->CONDOMINIO = '';
         $taxas->LOCADOR = $locador;
         $taxas->LOCATARIO = $locatario;
         $total = $total + $recld->IMB_RLD_VALOR;
         $taxas->save();
      }


      /*$reclts = mdlReciboLocador::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicial )
      ->where( 'IMB_RLT_DATAPAGAMENTO', '<=', $datafinal )
      ->where( 'IMB_RLT_LOCADORCREDEB','=','N' )
      ->where( 'IMB_RLT_LOCATARIOCREDEB','=','D' )
      ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_RECIBOLOTARIO.IMB_TBE_ID')
      ->orderBy( 'IMB_RLT_DATAPAGAMENTO')
      ->get();
*/
      $taxas =mdlTmpTaxaRecebida::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->orderBy('IMB_RLD_DATAPAGAMENTO')->get();
      foreach( $taxas as $taxa)
      {
         $taxa->TOTALRELATORIO = $total;

      }

      return DataTables::of($taxas)->make(true);
      
      //return view( 'financeiro.relataxasrecebidas','taxas');

  }

  public function proximodiaUtilSemJson( $datavencimento )
  {


     $dnovadata = date("Y-m-d", strtotime($datavencimento));

//      dd('Nova data '.$dnovadata.' - datavencimetno '.$datavencimento );

     $diasemana  = date('w', strtotime($dnovadata));

     $ndia = date('d', strtotime($dnovadata));
     $nmes = date('m', strtotime($dnovadata));
     $nano = date('Y', strtotime($dnovadata));
     $diaferiado =false;

     $tbfer = mdlFeriado::where( 'GER_FRD_DIA','=',$ndia )
     ->where( 'GER_FRD_MES','=',$nmes)
     ->where( 'GER_FRD_ANO','=',$nano)
     ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
     ->get();
     if( $tbfer <> '[]' )
        $diaferiado = true;

        ////Log:info( "Dia: ".$ndia);
        ////Log:info( "Mes: ".$nmes);
        ////Log:info( "Ano: ".$nano);
     while ( ( $diasemana == 0 ) or ( $diasemana==6 ) or ($diaferiado) )
     {

        $dnovadata = date('Y-m-d', strtotime( $dnovadata . " +1 days"));
        $diasemana  = date('w', strtotime($dnovadata));
        $ndia = date('d', strtotime($dnovadata));
        $nmes = date('m', strtotime($dnovadata));
        $nano = date('Y', strtotime($dnovadata));

        $tbfer = mdlFeriado::where( 'GER_FRD_DIA','=',$ndia )
        ->where( 'GER_FRD_MES','=',$nmes)
        ->where( 'GER_FRD_ANO','=',$nano)
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->get();


        $diaferiado =false;

        if( $tbfer <> '[]' )
           $diaferiado = true;

     };
     return $dnovadata;

  }

  public function cargaLeads( Request $request )
  {

      $leads = mdlLeads::select( 
         [
            'IMB_LED_DATAHORA',
            'IMB_LED_ID',
            'IMB_LED_NOME',
            'IMB_LED_EMAIL',
            'IMB_LED_TELEFONE',
            'IMB_IMV_REFERE',
            DB::raw('(select imovel( IMB_IMV_ID) ) as endereco' ),
            'IMB_POR_NOME',
            DB::raw( '( select IMB_ATD_NOME FROM IMB_CLIENTEATENDIMENTO ATM, IMB_ATENDENTE ATD
							WHERE ATD.IMB_ATD_ID = ATM.IMB_ATD_ID
                     AND ATM.IMB_CLT_ID =
                  (select TEL.IMB_TLF_ID_CLIENTE FROM IMB_TELEFONES TEL 
                  WHERE CONCAT(IMB_TLF_DDD,IMB_TLF_NUMERO) = IMB_LED_TELEFONE limit 1) limit 1) AS ATENDIDOPOR'),
            DB::raw('(select TEL.IMB_TLF_ID_CLIENTE FROM IMB_TELEFONES TEL 
                     WHERE CONCAT(IMB_TLF_DDD,IMB_TLF_NUMERO) = IMB_LED_TELEFONE limit 1) AS EHCLIENTE')

         ])
         ->leftJoin( 'VIS_PORTAIS','VIS_PORTAIS.IMB_POR_ID','IMB_LEADS.IMB_POR_ID')
         ->where('IMB_LEADS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
         ->orderBy( 'IMB_LED_DATAHORA', 'desc');
      ////Log:info( $leads->toSql() );
      return DataTables::of($leads)->make(true);


  }


   public function bairrosSistemaCarga()
   {
        $bairros = DB::table('IMB_IMOVEIS')->distinct()->orderBy('CEP_BAI_NOME')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->get(['CEP_BAI_NOME','IMB_IMV_CIDADE']);

        return $bairros;

   }

   public function statusImoveisCarga()
   {

   
        $status= mdlStatusImovel::orderBy('VIS_STA_NOME','ASC')->get();

        return $status;

   }

   public function pegarCondominioImovel( $idimv )
   {
      $con = mdlImovel::select( [ DB::raw( "coalesce(IMB_CND_NOME,'') as IMB_CND_NOME") ]  )
      ->where( 'IMB_IMV_ID','=', $idimv )
      ->leftJoin( 'IMB_CONDOMINIO', 'IMB_CONDOMINIO.IMB_CND_ID', 'IMB_IMOVEIS.IMB_CND_ID');

      //Log:info( $con->toSql());

      $con = $con->first();

      if( $con->IMB_CND_NOME == '' )
         return '';
      
      return 'Condomínio: '.$con->IMB_CND_NOME;
      


   }
   public function condominiosSistemaCarga()
   {

        $condominios = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->orderBy('IMB_CND_NOME')
            ->get();

            return $condominios;
   }


   public function abastecerBairros()
   {
   
      //////Log:info('emtramndp rptoma');
      $bairros = mdlBairro::whereNotNull('CEP_BAI_ID')->delete();
      $imvs = mdlImovel::select( 
         [
            'IMB_IMV_ID',
            'CEP_BAI_NOME'
            
         ])->
      whereNotNull( 'CEP_BAI_NOME')
      ->where('CEP_BAI_NOME','<>', '' )
      ->get();


      ////Log:info( "entrando no loop");
      foreach( $imvs as $imv )
      {
            $bairro = mdlBairro::where( 'CEP_BAI_NOME','=', $imv->CEP_BAI_NOME )->first();





         if( $bairro == '' )
         {
            //////Log:info('Cadastrando o bairro');
            $bairro = new mdlBairro;
            $bairro->CEP_BAI_NOME = $imv->CEP_BAI_NOME;
            $bairro->CEP_CID_NOME = strtoupper($imv->IMB_IMV_CIDADE);
            $bairro->save();
            //////Log:info('Salvou bairro');

            $imv->CEP_BAI_ID = $bairro->CEP_BAI_ID;
         }
         else
            $imv->CEP_BAI_ID = $bairro->CEP_BAI_ID;

            //////Log:info('vou salvar o imovel');
            $imv->save();
            //////Log:info('Salvei o imovel');


      }
   }

   public function pegarBairroImovel( $id )
   {

      $bai = mdlImovel::where( 'IMB_IMV_ID','=', $id )
      ->leftJoin( 'CEP_BAIRRO', 'CEP_BAIRRO.CEP_BAI_ID', 'IMB_IMOVEIS.CEP_BAI_ID' );

      //////Log:info( $bai->toSql());
      $bai = $bai->first();

      if( $bai <> '' )
         return $bai->CEP_BAI_NOME;
      else
         return "";

   }

   public function verificarRecurso( $label, $nome, $modulo, $grupo, $acessodefault, $tipoacesso, $tiporecurso)
   {
      $recurso = mdlRecursos::where( 'IMB_RSC_LABEL','=', $label )->first();
      if( $recurso == '' )
      {
      
         $recurso = new mdlRecursos;
         $recurso->IMB_RSC_NOME     = $nome;
         $recurso->IMB_RSC_LABEL     = $label;
         $recurso->IMB_RSC_MODULO     = $modulo;
         $recurso->IMB_RSC_GRUPO     = $grupo;
         $recurso->IMB_RSC_TIPORECURSO  = $tiporecurso;
         $recurso->IMB_RSC_DTHATIVO     = date( 'Y/m/d H:i:s');
         $recurso->save();

         $atds = mdlAtendente::whereNotNull('IMB_ATD_ID')->get();

         
         foreach( $atds as $atd )
         {
           
            $dirace = new mdlAtendenteDireitoAcesso;
            $dirace->IMB_ATD_ID        = $atd->IMB_ATD_ID;
            $dirace->IMB_DIRACE_INCLUSAO        = 'S';
            $dirace->IMB_DIRACE_ALTERACAO        = 'S';
            $dirace->IMB_DIRACE_EXCLUSAO        = 'S';
            $dirace->IMB_DIRACE_ACESSO        = $acessodefault;
            $dirace->IMB_RSC_ID                = $recurso->IMB_RSC_ID;
            $dirace->save();
         }

      };

         $dirace = mdlAtendenteDireitoAcesso::where( 'IMB_RSC_ID', $recurso->IMB_RSC_ID )
         ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->first();

         if( $dirace <> '' )
         {
            if( $tipoacesso == 'X' and $dirace->IMB_DIRACE_ACESSO     <> 'S' ) return "escondido";
            if( $tipoacesso == 'I' and $dirace->IMB_DIRACE_INCLUSAO   <> 'S' ) return "escondido";
            if( $tipoacesso == 'A' and $dirace->IMB_DIRACE_ALTERACAO  <> 'S' ) return "escondido";
            if( $tipoacesso == 'E' and $dirace->IMB_DIRACE_EXCLUSAO   <> 'S' ) return "escondido";

         };

      return 'normal';


 

   }

   public function movimentacaoPorEvento( Request $request)
   {

      $eventos = $request->eventos;
      $porcompetencia = $request->porcompetencia;

      $datainicio = $request->inicio;
      $pasta = $request->pasta;

      $datafim = $request->termino;
      if( $datafim == '' ) $datafim = date( 'Y/m/d');
      if( $datainicio == '' ) $datainicio = date( 'Y/m/d');

      
      
      if( $pasta <> '' )
      {
         $contrato = mdlContrato::where( 'IMB_CTR_REFERENCIA','=', $pasta )->first();
         $idcontrato = $contrato->IMB_CTR_ID;
         if( $porcompetencia == 'S' )
            $mov = mdlTabelaEvento::select( 
            [
               'IMB_TBE_ID',
               'IMB_TBE_NOME',
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID AND IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Entrada"),

               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID AND IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Saida"),

               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID AND IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) -
                        COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and   IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL ),0) AS Recebimento"),           
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID  and IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAVENCIMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL),0) -
                        COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID  and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAVENCIMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0) AS Repassado"),
               DB::raw( "  (COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL ),0) -
                        COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATACOMPETENCIA  BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL ),0)) -
                      (COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAVENCIMENTO  BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL ),0) -
                        COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAVENCIMENTO  BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0)) AS Saldo")           
                        
            ]
            );
         else
         $mov = mdlTabelaEvento::select( 
            [
               'IMB_TBE_ID',
               'IMB_TBE_NOME',
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID AND IMB_CTR_ID = $idcontrato
               AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Entrada"),

                DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID AND IMB_CTR_ID = $idcontrato
               AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Saida"),

               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID  and IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) -
                        COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0) AS Recebimento"),           
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL ),0) -
                        COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0) AS Repassado"),
               DB::raw( "  (COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) -
                        COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and IMB_CTR_ID = $idcontrato
                           AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0)) -
                      (COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL),0) -
                        COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID and  IMB_CTR_ID = $idcontrato
                           AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0)) AS Saldo")           
                        
                           
                           
         ]
         );
      }
      else
      {
         if( $porcompetencia == 'S' )
            $mov = mdlTabelaEvento::select( 
            [
               'IMB_TBE_ID',
               'IMB_TBE_NOME',
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID 
               AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Entrada"),

                DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID 
               AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Saida"),

               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) -
                           COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL ),0) AS Recebimento"),           
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAVENCIMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL),0) -
                           COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAVENCIMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0) AS Repassado"),
                  DB::raw( "  (COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATACOMPETENCIA BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL ),0) -
                           COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATACOMPETENCIA  BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL ),0)) -
                        (COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAVENCIMENTO  BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL ),0) -
                           COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAVENCIMENTO  BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0)) AS Saldo")           
                           
            ]
            );
         else
         $mov = mdlTabelaEvento::select( 
            [
               'IMB_TBE_ID',
               'IMB_TBE_NOME',
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID 
               AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Entrada"),

                DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID 
               AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0) as Recebimento_Saida"),

               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) -
                           COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0) AS Recebimento"),           
               DB::raw( "  COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL ),0) -
                           COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0) AS Repassado"),
                  DB::raw( "  (COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'D' AND IMB_RLT_DTHINATIVO IS NULL),0) -
                           COALESCE( (SELECT SUM( IMB_RLT_VALOR ) FROM IMB_RECIBOLOCATARIO RT WHERE RT.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLT_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLT_LOCATARIOCREDEB = 'C' AND IMB_RLT_DTHINATIVO IS NULL),0)) -
                        (COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'C' AND IMB_RLD_DTHINATIVO IS NULL),0) -
                           COALESCE( (SELECT SUM( IMB_RLD_VALOR ) FROM IMB_RECIBOLOCADOR RD WHERE RD.IMB_TBE_ID = IMB_TABELAEVENTOS.IMB_TBE_ID
                              AND IMB_RLD_DATAPAGAMENTO BETWEEN '$datainicio' and '$datafim' AND IMB_RLD_LOCADORCREDEB = 'D' AND IMB_RLD_DTHINATIVO IS NULL ),0)) AS Saldo")           
                           
                              
                              
            ]
            );
   }

      
      $mov = $mov->havingRaw( ' Recebimento_Entrada <> 0 or Recebimento_Saida <> 0 or Repassado <> 0 ')
            ->whereNotNull( 'IMB_TBE_ID')
            ->orderBy( 'IMB_TBE_NOME', 'ASC');

      if( $eventos <> '' )
            $mov = $mov->whereIn( 'IMB_TBE_ID', $eventos );

            
            Log::info( '===>>>> movimentação por evento <<<===');
            Log::info( $mov->toSql());
            
      return DataTables::of($mov)->make(true);


   }

   public function movimentacaoPorEventoDetalheView( Request $request)
   {
      $eventos = $request->eventos;
      $porcompetencia = $request->porcompetencia;
      $datainicio = $request->inicio;
      $datafim = $request->termino;
      $pasta = $request->pasta;
      $debcre = $request->debcre;
      if( $datafim == '' ) $datafim = date( 'Y/m/d');
      if( $datainicio == '' ) $datainicio = date( 'Y/m/d');

      return   view( 'reports.admimoveis.movimentacaoporeventodetalhe', compact( 'eventos', 'porcompetencia','datainicio','datafim','pasta', 'debcre') );
      //return DataTables::of($mov)->make(true);


   }

   public function movimentacaoPorEventoDetalheRepassadoView( Request $request)
   {
      $eventos = $request->eventos;
      $porcompetencia = $request->porcompetencia;
      $datainicio = $request->inicio;
      $datafim = $request->termino;
      $pasta = $request->pasta;
      if( $datafim == '' ) $datafim = date( 'Y/m/d');
      if( $datainicio == '' ) $datainicio = date( 'Y/m/d');

      return   view( 'reports.admimoveis.movimentacaoporeventodetalherepassado', compact( 'eventos', 'porcompetencia','datainicio','datafim') );
      //return DataTables::of($mov)->make(true);


   }

   public function movimentacaoPorEventoDetalheCarga( Request $request)
   {

      $eventos = $request->eventos;
      $porcompetencia = $request->porcompetencia;
      $datainicio = $request->inicio;
      $datafim = $request->termino;
      $pasta = $request->pasta;
      $relatorio = $request->relatorio;
      $debcre = $request->debcre;
      if( $datafim == '' ) $datafim = date( 'Y/m/d');
      if( $datainicio == '' ) $datainicio = date( 'Y/m/d');
      
      $idcontrato='';
      if( $pasta <> '' )
      {
         
         $contrato = mdlContrato::where( 'IMB_CTR_REFERENCIA','=', $pasta)->first();
         $idcontrato = $contrato->IMB_CTR_ID;
      }
      if( $porcompetencia == 'S' )
      {
         $mov = mdlReciboLocatario::select( 
         [
            'IMB_RECIBOLOCATARIO.IMB_TBE_ID',
            'IMB_TBE_NOME',
            'IMB_RECIBOLOCATARIO.IMB_IMV_ID',
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCATARIO.IMB_RLT_DATAPAGAMENTO, "%d/%m/%Y") AS IMB_RLT_DATAPAGAMENTO'),
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCATARIO.IMB_RLT_DATACOMPETENCIA, "%d/%m/%Y") AS IMB_RLT_DATACOMPETENCIA'),
            DB::raw( '( SELECT PEGALOCATARIOCONTRATO( IMB_RECIBOLOCATARIO.IMB_CTR_ID) ) AS LOCATARIO '),
            DB::raw( '( SELECT imovel( IMB_RECIBOLOCATARIO.IMB_IMV_ID) ) AS ENDERECO' ),
            'IMB_RLT_LOCATARIOCREDEB',
            'IMB_RLT_LOCADORCREDEB',
            'IMB_RLT_NUMERO',
            'IMB_RLT_VALOR',
            'IMB_RLT_OBSERVACAO',
            'IMB_CTR_REFERENCIA'
                        
         ]
         )->where( 'IMB_RLT_DATACOMPETENCIA','>=', $datainicio )
         ->where( 'IMB_RLT_DATACOMPETENCIA','<=', $datafim )
         ->whereNull('IMB_RLT_DTHINATIVO');

         if( $debcre <> '' )
         $mov = $mov->where( 'IMB_RECIBOLOCATARIO.IMB_RLT_LOCATARIOCREDEB','=',$debcre );

         if( $idcontrato <> '' )
         $mov = $mov->where( 'IMB_RECIBOLOCATARIO.IMB_CTR_ID','=', $idcontrato );
         
         $mov = $mov->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCATARIO.IMB_TBE_ID')
         ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCATARIO.IMB_CTR_ID')
         ->orderBy( 'IMB_RLT_NUMERO');
         }
      else
      {
         $mov = mdlReciboLocatario::select( 
         [
            'IMB_RECIBOLOCATARIO.IMB_TBE_ID',
            'IMB_TBE_NOME',
            'IMB_RECIBOLOCATARIO.IMB_IMV_ID',
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCATARIO.IMB_RLT_DATAPAGAMENTO, "%d/%m/%Y") AS IMB_RLT_DATAPAGAMENTO'),
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCATARIO.IMB_RLT_DATACOMPETENCIA, "%d/%m/%Y") AS IMB_RLT_DATACOMPETENCIA'),
            DB::raw( '( SELECT PEGALOCATARIOCONTRATO( IMB_RECIBOLOCATARIO.IMB_CTR_ID) ) AS LOCATARIO '),
            DB::raw( '( SELECT imovel( IMB_RECIBOLOCATARIO.IMB_IMV_ID) ) AS ENDERECO' ),
            'IMB_RLT_LOCATARIOCREDEB',
            'IMB_RLT_LOCADORCREDEB',
            'IMB_RLT_NUMERO',
            'IMB_RLT_VALOR',
            'IMB_RLT_OBSERVACAO',
            'IMB_CTR_REFERENCIA'            
                        
         ]
         )->where( 'IMB_RLT_DATAPAGAMENTO','>=', $datainicio )
         ->where( 'IMB_RLT_DATAPAGAMENTO','<=', $datafim )
         ->whereNull('IMB_RLT_DTHINATIVO');

         if( $idcontrato <> '' )
         $mov = $mov->where( 'IMB_RECIBOLOCATARIO.IMB_CTR_ID','=', $idcontrato );

         $mov = $mov->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCATARIO.IMB_TBE_ID')
         ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCATARIO.IMB_CTR_ID')
         ->orderBy( 'IMB_RLT_NUMERO');
      }

      $mov = $mov->where( 'IMB_RECIBOLOCATARIO.IMB_TBE_ID','=', $eventos );

      if( $debcre <> '' )
      $mov = $mov->where( 'IMB_RECIBOLOCATARIO.IMB_RLT_LOCATARIOCREDEB','=',$debcre );


      if( $relatorio == 'S')
      {
         Log::info('********** movimentacao por evento movimentacaoPorEventoDetalheCarga ******************');
         Log::info( $mov->toSql() );
         $mov =  $mov->get();
         return view('reports.admimoveis.relmovrecperdetalhado',compact( 'mov', 'eventos','porcompetencia', 'porcompetencia',
         'datainicio','datafim','pasta') );

      }
         

      
      Log::info( $mov->toSql());
      $mov = DataTables::of($mov)->make(true);
      return   $mov;
      //return DataTables::of($mov)->make(true);


   }

   public function movimentacaoPorEventoDetalheRepassadoCarga( Request $request)
   {

      $eventos = $request->eventos;
      $porcompetencia = $request->porcompetencia;
      $datainicio = $request->inicio;
      $datafim = $request->termino;
      if( $datafim == '' ) $datafim = date( 'Y/m/d');
      if( $datainicio == '' ) $datainicio = date( 'Y/m/d');
      

      if( $porcompetencia == 'S' )
         $mov = mdlReciboLocador::select( 
         [
            'IMB_RECIBOLOCADOR.IMB_TBE_ID',
            'IMB_TBE_NOME',
            'IMB_RECIBOLOCADOR.IMB_IMV_ID',
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO, "%d/%m/%Y") AS IMB_RLD_DATAPAGAMENTO'),
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCADOR.IMB_RLD_DATAVENCIMENTO, "%d/%m/%Y") AS IMB_RLD_DATAVENCIMENTO'),
            DB::raw( '( SELECT PEGALOCADORCONTRATO( IMB_RECIBOLOCADOR.IMB_CTR_ID) ) AS LOCADOR '),
            DB::raw( '( SELECT imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) ) AS ENDERECO' ),
            'IMB_RLD_LOCATARIOCREDEB',
            'IMB_RLD_LOCADORCREDEB',
            'IMB_RLD_NUMERO',
            'IMB_RLD_VALOR',
            'IMB_RLD_OBSERVACAO',
            'IMB_CTR_REFERENCIA'
                        
         ]
         )->where( 'IMB_RLD_DATAVENCIMENTO','>=', $datainicio )
         ->where( 'IMB_RLD_DATAVENCIMENTO','<=', $datafim )
         ->whereNull('IMB_RLD_DTHINATIVO')
         ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCADOR.IMB_TBE_ID')
         ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCADOR.IMB_CTR_ID')
         ->orderBy( 'IMB_RLD_DATAVENCIMENTO');
      else
      $mov = mdlReciboLocador::select( 
         [
            'IMB_RECIBOLOCADOR.IMB_TBE_ID',
            'IMB_TBE_NOME',
            'IMB_RECIBOLOCADOR.IMB_IMV_ID',
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO, "%d/%m/%Y") AS IMB_RLD_DATAPAGAMENTO'),
            DB::raw( ' DATE_FORMAT(IMB_RECIBOLOCADOR.IMB_RLD_DATAVENCIMENTO, "%d/%m/%Y") AS IMB_RLD_DATAVENCIMENTO'),
            DB::raw( '( SELECT PEGALOCADORCONTRATO( IMB_RECIBOLOCADOR.IMB_CTR_ID) ) AS LOCADOR '),
            DB::raw( '( SELECT imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID) ) AS ENDERECO' ),
            'IMB_RLD_LOCATARIOCREDEB',
            'IMB_RLD_LOCADORCREDEB',
            'IMB_RLD_NUMERO',
            'IMB_RLD_VALOR',
            'IMB_RLD_OBSERVACAO',
            'IMB_CTR_REFERENCIA'
                        
         ]
         )->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio )
         ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim )
         ->whereNull('IMB_RLD_DTHINATIVO')
         ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID','IMB_RECIBOLOCADOR.IMB_TBE_ID')
         ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_RECIBOLOCADOR.IMB_CTR_ID')
         ->orderBy( 'IMB_RLD_DATAPAGAMENTO');

      $mov = $mov->where( 'IMB_RECIBOLOCADOR.IMB_TBE_ID','=', $eventos );

      $mov = DataTables::of($mov)->make(true);
      return   $mov;


   }

   public function taxaContratoValorTotal( $id )
   {

      $array = array();

      $tc = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )->
         whereRaw( 'IMB_TBE_ID in (7,27) and IMB_LCF_DTHINATIVADO IS NULL' )
         ->count();
         $parcelas = $tc;
         

      $tc = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )->
         whereRaw( 'IMB_TBE_ID in (7,27) and IMB_LCF_DTHINATIVADO IS NULL' )
         ->sum( 'IMB_LCF_VALOR');
      $total = $tc;

         

      $tc = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )->
         whereRaw( 'IMB_TBE_ID in (7,27) and IMB_LCF_DTHINATIVADO IS NULL and IMB_LCF_DATARECEBIMENTO IS NULL' )
         ->sum( 'IMB_LCF_VALOR');
      $aberta = $tc;

      

      $tc = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )->
         whereRaw( 'IMB_TBE_ID in (7,27) and IMB_LCF_DTHINATIVADO IS NULL and IMB_LCF_DATARECEBIMENTO IS NOT NULL' )
         ->sum( 'IMB_LCF_VALOR');
      $recebida = $tc;

      array_push( $array, [ "total" => $total, "parcelas" => $parcelas, "aberta" => $aberta, "recebida" => $recebida ]);
      $array = json_encode( $array);
      return response()->json( $array, 200 );

   }
   

   public function taxaContratoDoContrato( $id )
   {

      $tc = mdlLancamentoFuturo::where('IMB_CTR_ID','=', $id )->
         whereRaw( 'IMB_TBE_ID in (7,27) and IMB_LCF_DTHINATIVADO IS NULL' )
         ->orderBy( 'IMB_LCF_DATAVENCIMENTO')
         ->get();
         
      return response()->json( $tc, 200);
   }

   public function inadimplentesCalcularNew( Request $request)
   {


      $datainicio = $this->formatarData( $request->datainicio );
      $datafim = $this->formatarData( $request->datafim );
      //Log:info(" request->opcaovencimento $request->opcaovencimento");
      //Log:info('Auth::user()->IMB_IMB_ID '.Auth::user()->IMB_IMB_ID);
      //Log:info('$datainicio '.$datainicio);
      //Log:info('$datafim '.$datafim);
      

      if( $request->acordos == 'S' )
         $atrs = mdlContrato::
         whereRaw( "( IMB_IMB_ID = ".Auth::user()->IMB_IMB_ID." and IMB_CTR_SITUACAO=  'ATIVO' )
         and ( IMB_CTR_VENCIMENTOLOCATARIO < curdate() and IMB_CTR_VENCIMENTOLOCATARIO is not null 
         AND IMB_CTR_VENCIMENTOLOCATARIO between $datainicio and $datafim  )
         or ( select exists( select LF.IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO LF 
                        WHERE LF.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND IMB_TBE_ID = 14 
                        AND IMB_LCF_DATAVENCIMENTO < CURDATE() AND IMB_LCF_DATARECEBIMENTO IS NULL) )
               ORDER BY IMB_CTR_VENCIMENTOLOCATARIO");
      else

      if( $request->opcaovencimento == 'P' and $request->datafim <> '' and $request->datainicio )
      {
         
         $atrs = mdlContrato::
         where( 'IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID)
         ->where('IMB_CTR_SITUACAO','=','ATIVO'  )
         ->whereRaw(" ADDDATE(IMB_CTR_VENCIMENTOLOCATARIO, INTERVAL IMB_CTR_TOLERANCIA day) >= $datainicio" )
         ->whereRaw(" ADDDATE(IMB_CTR_VENCIMENTOLOCATARIO, INTERVAL IMB_CTR_TOLERANCIA day) <= $datafim" )
            ->orderBy('IMB_CTR_VENCIMENTOLOCATARIO');
      }
      else
      $atrs = mdlContrato::
         whereRaw( "( IMB_IMB_ID = ".Auth::user()->IMB_IMB_ID." and IMB_CTR_SITUACAO=  'ATIVO' )
         and ( IMB_CTR_VENCIMENTOLOCATARIO < curdate() and IMB_CTR_VENCIMENTOLOCATARIO is not null ) 
         or ( select exists( select LF.IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO LF 
                        WHERE LF.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID AND IMB_TBE_ID = 14 
                        AND IMB_LCF_DATAVENCIMENTO < CURDATE() AND IMB_LCF_DATARECEBIMENTO IS NULL) )
               ORDER BY IMB_CTR_VENCIMENTOLOCATARIO");

 
         Log::info( $atrs->toSql());

      if( $request->situacao == 'E' )
         $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') <> 'S'" );

         if( $request->situacao == 'J' )
         $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') =  'S' " );

   /*   if( $request->opcaovencimento == 'P' and $request->datafim <> '' and $request->datainicio )
      {
         $atrs = $atrs->where( 'IMB_CTR_VENCIMENTOLOCATARIO','>=', $this->formatarData( $request->datainicio ) )
                      ->where( 'IMB_CTR_VENCIMENTOLOCATARIO','<=', $this->formatarData( $request->datafim ) );
      }
*/
      //Log:info( $atrs->toSql());
      $atrs = $atrs->get();
      //dd( $atrs );

      $this->forcarLimparTMPAtrasados();


      foreach( $atrs as $atr)
      {
         //Log:info('acessou');
         $enderecocompleto = $this->imovelEndereco( $atr->IMB_IMV_ID );
         $juridico = '';
         $codigolt = $this->codigoLocatarioPrincipal( $atr->IMB_CTR_ID );
         $clt = mdlCliente::find( $codigolt );

         $fiador1nome='';
         $fiador1fone='';
         $fiador1email='';
         $fiador2nome='';
         $fiador2fone='';
         $fiador2email='';
         $fiador1id=null;
         $fiador2id=null;

         if( $atr->IMB_CTR_ADVOGADO == 'S'  ) $juridico = "JURÍDICO";


         if( $clt )
         {
            //Log:info('entrei no cliente');


            $fds = mdlFiadorContrato::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_FIADORCONTRATO.IMB_CLT_ID' )
            ->get();

            $cont = 0;
            foreach( $fds as $fd)
            {
               $cont++;
               if( $cont == 1 )
               {
                  $fiador1nome = $fd->IMB_CLT_NOME;
                  $fiador1email = $fd->IMB_CLT_EMAIL;
                  $fiador1fone= $this->pegarFone( $fd->IMB_CLT_ID );
                  $fiador1id= $fd->IMB_CLT_ID;
               }
               else
               if( $cont == 2 )
               {
                  $fiador2nome = $fd->IMB_CLT_NOME;
                  $fiador2email = $fd->IMB_CLT_EMAIL;
                  $fiador2fone= $this->pegarFone( $fd->IMB_CLT_ID );
                  $fiador2id= $fd->IMB_CLT_ID;

               }


            }
            $lca = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID ) 
            ->where('IMB_LCF_LOCATARIOCREDEB','=','D')
            ->where( 'IMB_TBE_ID','=', 14 )
            ->whereNull('IMB_LCF_DATARECEBIMENTO')
            ->whereNull('IMB_LCF_DTHINATIVADO')
//            ->whereRaw( 'coalesce(IMB_ACD_IDDESTINO,0) <> 0')
            ->first();
            
            $ehacordo = '';
            if( $lca <> '') $ehacordo = 'ACORDO';

            $cont = 'S';

            if( $request->acordos == 'S' and $ehacordo <> 'ACORDO')  $cont = 'N';
            if( $request->acordos <> 'S' and $atr->IMB_CTR_SITUACAO <> 'ATIVO')  $cont = 'N';

            //Log:info('cont '.$cont );
            
            if( $cont == 'S')
            {
               $headers = new mdlTMPAtrasadoHeader;
               $headers->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
               $headers->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
               $headers->IMB_IMV_ID = $atr->IMB_IMV_ID;
               $headers->IMB_CTR_ID = $atr->IMB_CTR_ID;
               $headers->ENDERECOCOMPLETO = $enderecocompleto;
               $headers->IMB_CTR_VENCIMENTOLOCATARIO = $atr->IMB_CTR_VENCIMENTOLOCATARIO;
               $headers->IMB_CTR_VALORALUGUEL = $atr->IMB_CTR_VALORALUGUEL;
               $headers->JURIDICO = $juridico;
               $headers->IMB_CLT_NOMELOCATARIO = $this->nomeLocatarioPrincipal( $atr->IMB_CTR_ID );
               $headers->IMB_CLT_IDLOCATARIO = $codigolt;
               $headers->IMB_CLT_EMAIL = $clt->IMB_CLT_EMAIL;
               $headers->DATAULTIMACOBRANCA = $this->ultimaCobrancaRealizada( $atr->IMB_CTR_ID );
               $headers->FIADOR1NOME = $fiador1nome;
               $headers->FIADOR1FONE= $fiador1fone;
               $headers->FIADOR1EMAIL= $fiador1email;
               $headers->FIADOR2NOME = $fiador2nome;
               $headers->FIADOR2FONE= $fiador2fone;
               $headers->FIADOR2EMAIL= $fiador2email;
               $headers->IMB_CLT_IDFIADOR1= $fiador1id;
               $headers->IMB_CLT_IDFIADOR2= $fiador2id;
               $headers->IMB_CTR_REFERENCIA= $atr->IMB_CTR_REFERENCIA;
               $headers->ENCERRADO= '';
               $headers->ACORDO= $ehacordo;
               if( $codigolt )
                  $headers->FONELOCATARIO = $this->pegarFone( $codigolt );
               $headers->IMB_CTR_DATALIMITE = $this->dataLimite( $atr->IMB_CTR_ID, $atr->IMB_CTR_VENCIMENTOLOCATARIO );

               $headers->save();
            }
         }

      }

      if( $request->ativos <> 'S')
      {
         //calcular os encerrados
         $atrs = mdlContrato::select(
            ['IMB_CONTRATO.*',
            DB::raw( '( select MIN(IMB_LCF_DATAVENCIMENTO) FROM IMB_LANCAMENTOFUTURO 
            WHERE IMB_LANCAMENTOFUTURO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID 
            and IMB_LCF_DTHINATIVADO is null
            AND IMB_LCF_LOCATARIOCREDEB = "D" and IMB_LCF_DATARECEBIMENTO IS NULL) AS vencimento')]
         )->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
         ->whereRaw( 'exists ( select IMB_LCF_ID FROM IMB_LANCAMENTOFUTURO 
                  WHERE IMB_LANCAMENTOFUTURO.IMB_CTR_ID = IMB_CONTRATO.IMB_CTR_ID 
                  AND IMB_LCF_LOCATARIOCREDEB = "D" and IMB_LCF_DATARECEBIMENTO IS NULL
                  and IMB_LCF_DTHINATIVADO is null) ')
         ->orderBy('IMB_CTR_VENCIMENTOLOCATARIO');

         
         $atrs = $atrs->where( 'IMB_CTR_SITUACAO','=', 'ENCERRADO' );

         if( $request->situacao == 'E' )
            $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') <> 'S'" );

            if( $request->situacao == 'J' )
            $atrs = $atrs->whereRaw( "COALESCE(IMB_CTR_ADVOGADO,'N') =  'S' " );
         
         ////Log:info( $atrs->toSql());
         $atrs = $atrs->get();

         foreach( $atrs as $atr)
         {

            $enderecocompleto = $this->imovelEndereco( $atr->IMB_IMV_ID );
            $juridico = '';
            $codigolt = $this->codigoLocatarioPrincipal( $atr->IMB_CTR_ID );
            $clt = mdlCliente::find( $codigolt );

            $fiador1nome='';
            $fiador1fone='';
            $fiador1email='';
            $fiador2nome='';
            $fiador2fone='';
            $fiador2email='';
            $fiador1id=null;
            $fiador2id=null;

            if( $atr->IMB_CTR_ADVOGADO == 'S'  ) $juridico = "JURÍDICO";

            if( $clt )
            {


               $fds = mdlFiadorContrato::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID )
               ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_FIADORCONTRATO.IMB_CLT_ID' )
               ->get();

               $cont = 0;
               foreach( $fds as $fd)
               {
                  $cont++;
                  if( $cont == 1 )
                  {
                     $fiador1nome = $fd->IMB_CLT_NOME;
                     $fiador1email = $fd->IMB_CLT_EMAIL;
                     $fiador1fone= $this->pegarFone( $fd->IMB_CLT_ID );
                     $fiador1id= $fd->IMB_CLT_ID;
                  }
                  else
                  if( $cont == 2 )
                  {
                     $fiador2nome = $fd->IMB_CLT_NOME;
                     $fiador2email = $fd->IMB_CLT_EMAIL;
                     $fiador2fone= $this->pegarFone( $fd->IMB_CLT_ID );
                     $fiador2id= $fd->IMB_CLT_ID;

                  }


               }

    
               $lca = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=',$atr->IMB_CTR_ID ) 
               ->where('IMB_LCF_LOCATARIOCREDEB','=','D')
               ->whereNull('IMB_LCF_DATARECEBIMENTO')
               ->whereNull('IMB_LCF_DTHINATIVADO')
               ->whereRaw( 'coalesce(IMB_ACD_IDDESTINO,0) <> 0')
               ->first();
               $ehacordo='';
               if( $lca <> '') $ehacordo = 'ACORDO';
               $cont = 'S';

               if( $request->acordos == 'S' and $ehacordo <> 'ACORDO')  $cont = 'N';
               
               if( $cont == 'S')
               {
                  $headers = new mdlTMPAtrasadoHeader;
                  $headers->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                  $headers->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                  $headers->IMB_IMV_ID = $atr->IMB_IMV_ID;
                  $headers->IMB_CTR_ID = $atr->IMB_CTR_ID;
                  $headers->ENDERECOCOMPLETO = $enderecocompleto;
                  $headers->IMB_CTR_VENCIMENTOLOCATARIO = $atr->vencimento;
                  $headers->IMB_CTR_VALORALUGUEL = $atr->IMB_CTR_VALORALUGUEL;
                  $headers->JURIDICO = $juridico;
                  $headers->IMB_CLT_NOMELOCATARIO = $this->nomeLocatarioPrincipal( $atr->IMB_CTR_ID );
                  $headers->IMB_CLT_IDLOCATARIO = $codigolt;
                  $headers->IMB_CLT_EMAIL = $clt->IMB_CLT_EMAIL;
                  $headers->DATAULTIMACOBRANCA = $this->ultimaCobrancaRealizada( $atr->IMB_CTR_ID );
                  $headers->FIADOR1NOME = $fiador1nome;
                  $headers->FIADOR1FONE= $fiador1fone;
                  $headers->FIADOR1EMAIL= $fiador1email;
                  $headers->FIADOR2NOME = $fiador2nome;
                  $headers->FIADOR2FONE= $fiador2fone;
                  $headers->FIADOR2EMAIL= $fiador2email;
                  $headers->IMB_CLT_IDFIADOR1= $fiador1id;
                  $headers->IMB_CLT_IDFIADOR2= $fiador2id;
                  $headers->IMB_CTR_REFERENCIA= $atr->IMB_CTR_REFERENCIA;
                  $headers->ENCERRADO= 'ENCERRADO';
                  $headers->ACORDO= $ehacordo;


                  if( $codigolt )
                     $headers->FONELOCATARIO = $this->pegarFone( $codigolt );
                  $headers->IMB_CTR_DATALIMITE = $this->dataLimite( $atr->IMB_CTR_ID, $atr->IMB_CTR_VENCIMENTOLOCATARIO );

                  $headers->save();
               }
            }
         }
      }


      //dd( $atrs );      
      $headers = mdlTMPAtrasadoHeader::where( 'TMP_ATRASADOSHEADER.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
      ->where('TMP_ATRASADOSHEADER.IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
      ->orderBy('TMP_ATRASADOSHEADER.IMB_CTR_VENCIMENTOLOCATARIO');

      return DataTables::of($headers)->make(true);



   }

   public function estornarReajuse( $id )
   {
      $rea = mdlContratoHistoricoReajuste::find( $id );
      if( $rea == '' )
         return response()->json( 'não encontrato',404);

      $datareajuste = $rea->IMB_CHR_DATAREAJUSTE;
      $valor = $rea->IMB_CTR_VALORANTERIOR;

      $ctr = mdlContrato::find( $rea->IMB_CTR_ID);

      if( $ctr <> '' )
      {
         $ctr->IMB_CTR_DATAREAJUSTE = $datareajuste;
         $ctr->IMB_CTR_VALORALUGUEL = $valor;
         $ctr->save();

         $this->gravarObs( 0, $rea->IMB_CTR_ID, 0, 0, 0, 'Reajuste estornado. Voltando para o valor de aluguel  '.$ctr->IMB_CTR_VALORALUGUEL);
            
         $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=' ,$ctr->IMB_CTR_ID )
         ->where( 'IMB_TBE_ID','=', 1 )
         ->where( 'IMB_LCF_DATAVENCIMENTO','>', $datareajuste )
         ->delete();
         
         $rea->IMB_CHR_DTINATIVO = date('Y/m/d');
         $rea->save();

      }



      return response()->json('ok',200);


   }

   public function valorTotalAtrasados()
   {
      $total = mdlTMPAtrasadoHeader::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
      ->sum( 'IMB_CTR_VALORALUGUEL');
      return response()->json( $total,200);
   }

   public function pegarEmailLocatarioPrincipal( $id )
   {
      $contrato = mdlContrato::find( $id );
      if( $contrato )
      {
         if( $contrato->IMB_CTR_EMAIL <> '')
            return response()->json($contrato->IMB_CTR_EMAIL,200);

         $idlocatario = $this->codigoLocatarioPrincipal( $id );

         $cliente = mdlCliente::find( $idlocatario );

         return response()->json( $cliente->IMB_CLT_EMAIL);
      };

   }

   public function pegarEmailLocatarioPrincipalSemJson( $id )
   {
      $contrato = mdlContrato::find( $id );
      if( $contrato )
      {
         if( $contrato->IMB_CTR_EMAIL <> '')
            return $contrato->IMB_CTR_EMAIL;

         $idlocatario = $this->codigoLocatarioPrincipal( $id );

         $cliente = mdlCliente::find( $idlocatario );

         return $cliente->IMB_CLT_EMAIL;
      };

   }

   public function cargaRegiaoCidade()
   {
      $regiao = mdlRegiaoCidade::orderBy( 'IMB_RGC_NOME')->get();
      return response()->json( $regiao, 200);
   }

   public function fluxoNegocioCliente( $idcliente )
   {
      return view('layout.modalfluxonegociocliente',compact('idcliente'));
   }

   public function instanciarRequest()
   {
      $request = new Request;
      return $request;
   }

}

