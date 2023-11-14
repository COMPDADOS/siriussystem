<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaPermItem;
use App\mdlCobrancaGerada;
use App\mdlCobrancaGeradaItem;
use App\mdlLancamentoFuturo;
use App\mdlRetornoBancario;

use App\mdlCobrancaGeradaItemPerm;

use App\mdlImobiliaria;
use App\mdlContrato;
use App\mdlLocatarioContrato;
use App\mdlImovel;
use App\mdlCliente;
use App\mdlParametros;
use App\mdlContaCaixa;
use PDF;
use Picqer;
use Log;
use Auth;
use DateTime;
use DateInterval;
use DB;

use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Illuminate\Support\Facades\URL;
use SplFileObject;

class ctrBoleto756 extends Controller
{


    public function pegandoA()
    {
        echo 'pegando A<br>';
        return $this->pegandoB();
    }

    public function pegandob()
    {
        echo 'pegando B<br>';


    }


    public function index( $id, $poremail, $email )
    {

        $cp = mdlCobrancaGeradaPerm::find( $id );
        $cpi = mdlCobrancaGeradaItemPerm::select(
            [
                'IMB_CGI_ID',
	            'IMB_CGR_ID',
	            'IMB_LCF_ID',
	            'IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID',
                DB::raw( 'IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_DESCRICAO'),
                'IMB_RLT_LOCATARIOCREDEB',
	            'IMB_RLT_LOCADORCREDEB',
	            'IMB_LCF_VALOR',
	            'IMB_LCF_OBSERVACAO',
	            'IMB_COBRANCAGERADAITEMPERM.IMB_IMB_ID'
            ]
        )
        ->where( 'IMB_CGR_ID','=',$id)
        ->leftJoin( 'IMB_TABELAEVENTOS','IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_COBRANCAGERADAITEMPERM.IMB_TBE_ID' )
        ->get();
        $ctr = mdlContrato::find( $cp->IMB_CTR_ID);


/*        $lt = mdlLocatarioContrato::select( [ 'IMB_CLT_EMAIL'])
            ->where( 'IMB_LOCATARIOCONTRATO.IMB_CTR_ID','=', $cp->IMB_CTR_ID )
            ->where( 'IMB_LOCATARIOCONTRATO.IMB_LCTCTR_PRINCIPAL','=', 'S' )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
            ->first();



        $email = $lt->IMB_CLT_EMAIL;
        //dd( $email );

        if( $ctr->IMB_CTR_EMAIL <> '' )
            $email = $ctr->IMB_CTR_EMAIL;
*/



        if( $cp )
        {
            $ctr = mdlContrato::find( $cp->IMB_CTR_ID );
            $im = mdlImobiliaria::find( $ctr->IMB_IMB_ID );
            $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
            $par = mdlParametros::find( $ctr->IMB_IMB_ID );



            // DADOS DO BOLETO PARA O SEU CLIENTE
            $dias_de_prazo_para_pagamento = 5;
            $taxa_boleto = 0;
            $data_venc = date('d/m/Y',strtotime( $cp->IMB_CGR_DATAVENCIMENTO ) );

            //$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
            $valor_cobrado = $cp->IMB_CGR_VALOR; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
            $valor_boleto= number_format($valor_cobrado, 2, ',', '');

            $dadosboleto["IMB_CGR_ID"] = $id;
            $dadosboleto["FIN_CCI_BANCONUMERO"] = "756";
            $dadosboleto["nosso_numero"] = $cp->IMB_CGR_NOSSONUMERO;  // Nosso numero - REGRA: M�ximo de 8 caracteres!
            $dadosboleto["numero_documento"] = $cp->IMB_CTR_ID;	// Num do pedido ou nosso numero
            $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
            $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
            $dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
            $dadosboleto["valor_boleto_impresso"] = number_format($valor_cobrado, 2, ',', '.');; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
            $dadosboleto["IMB_IMV_OBJETOLOCACAO"]=app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $ctr->IMB_IMV_ID );
            // DADOS DO SEU CLIENTE
            $dadosboleto["sacado"] = $cp->IMB_CGR_DESTINATARIO;
            $dadosboleto["sacadocpf"] = $cp->IMB_CGR_CPF;
            $dadosboleto["endereco1"] = $cp->IMB_CGR_ENDERECO;
            $dadosboleto["endereco2"] =
                                        'Cep: '.$cp->IMV_CGR_CEP.' - Cidade: '.
                                        $cp->IMB_CEP_CID_NOME.' - UF: '.
                                        $cp->CEP_UF_SIGLA;

            // INFORMACOES PARA O CLIENTE
            $dadosboleto["demonstrativo1"] = 'DESCRICAO';
            $dadosboleto["demonstrativo2"] = "";
            $dadosboleto["demonstrativo3"] = "";
            $dadosboleto["instrucoes1"] = "";
            $dadosboleto["instrucoes2"] = "";
            $dadosboleto["instrucoes3"] = "";
            $dadosboleto["instrucoes4"] = "";

            // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
            $dadosboleto["quantidade"] = "1";
            $dadosboleto["valor_unitario"] = "";
            $dadosboleto["aceite"] = "";
            $dadosboleto["especie"] = "R$";
            $dadosboleto["especie_doc"] = "DM";


            // DADOS DA SUA CONTA - sant
            $dadosboleto["agencia"] = $cp->FIN_CCI_AGENCIANUMERO; // Num da agencia, sem digito
            $dadosboleto["conta"] = $cp->FIN_CCI_CONTANUMERO;	// Num da conta, sem digito
            $dadosboleto["conta_dv"] = $cp->FIN_CCI_CONTADIGITO; 	// Digito do Num da conta
            $dadosboleto["codigo_cliente"] = $cp->FIN_CCI_CODIGOCLIENTE; 	// Digito do Num da conta

            // DADOS PERSONALIZADOS - ITA�
            $dadosboleto["carteira"] = $cp->FIN_CCI_CARTEIRA;  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

            // SEUS DADOS
            $dadosboleto["identificacao"] = "";//BoletoPhp - C�digo Aberto de Sistema de Boletos";
            $dadosboleto["cpf_cnpj"] = $im->IMB_IMB_CGC;
            $dadosboleto["endereco"] =  $im->IMB_IMB_ENDERECO;
            $dadosboleto["cidade_uf"] = $im->IMB_IMB_CEP.' - '.
                                        $im->CEP_CID_NOME.
                                        '('.$im->CEP_UF_SIGLA.')';
            $dadosboleto["cedente"] = $im->IMB_IMB_NOME;

            $codigobanco = "756";
            $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
            $nummoeda = "9";
            $fixo     = "9";   // Numero fixo para a posi��o 05-05
            $ios	  = "0";   // IOS - somente para Seguradoras (Se 7% informar 7, limitado 9%)
            $fator_vencimento = $this->fator_vencimento( $dadosboleto["data_vencimento"] );

            //valor tem 10 digitos, sem virgula
            $valor = $this->formata_numero($dadosboleto["valor_boleto"],10,0,"valor");

            //codigocedente deve possuir 7 caracteres



            //agencia � 4 digitos
            $agencia = $this->formata_numero($dadosboleto["agencia"],4,0);
            //conta � 5 digitos + 1 do dv
            $conta = $this->formata_numero($dadosboleto["conta"],5,0);
            $conta_dv = $this->formata_numero($dadosboleto["conta_dv"],1,0);
            //carteira 175

            $codigocliente = $this->formata_numero($dadosboleto["codigo_cliente"],10,0);
            $codigoclienteLD = $this->formata_numero($dadosboleto["codigo_cliente"],7,0);

            $carteira = $dadosboleto["carteira"];

            //nosso_numero no maximo 8 digitos
            $nnum = $this->formata_numero($dadosboleto["nosso_numero"],7,0);



            
            $dv_nosso_numero = $this->modulo_11CrediCitrus($agencia.$codigocliente.$nnum);

            // nosso n�mero (com dvs) s�o 13 digitos
            $nossonumero = "00000".$nnum.$dv_nosso_numero;

            $vencimento = $dadosboleto["data_vencimento"];

            $vencjuliano = $this->dataJuliano($vencimento);

            // 43 numeros para o calculo do digito verificador do codigo de barras
//            $barra = "$codigobanco$nummoeda$fator_vencimento$valor$fixo$codigocliente$nossonumero$ios$carteira";
            $barra = $codigobanco.$nummoeda.$fator_vencimento.$valor.$carteira.$agencia."01".$codigoclienteLD.$nnum.$dv_nosso_numero."001";
                        // 43 numeros para o calculo do digito verificador
            //return $barra;
            $dv = $this->digitoVerificador_barra($barra);

            // Numero para o codigo de barras com 44 digitos
            $linha = substr($barra,0,4) . $dv . substr($barra,4);

            $agencia_codigo = $agencia." / ". $conta."-".$this->modulo_10($agencia.$conta);

            $dadosboleto["codigo_barras"] = $linha;
            $dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha); // verificar
            $dadosboleto["agencia_codigo"] = $agencia_codigo ;
            $dadosboleto["nosso_numero"] = $carteira.'000'.$nnum.'-'.$dv_nosso_numero;
            $dadosboleto["nosso_numero_somente"] = intval($cp->IMB_CGR_NOSSONUMERO).'-' .$dv_nosso_numero;
            
            $dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;


            //PARAMETROS PARA INSTRUÇÕES
            $nInstrucoes = 0;
            if( $par->IMB_PRM_COBBANTOLERANCIA <> '0' and $par->IMB_PRM_COBBANTOLERANCIA <> '')
            {
                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = "Não receber após $par->IMB_PRM_COBBANTOLERANCIA dias de vencido";
            }


            if( $par->IMB_PRM_COBBANMULTA <> '0' and $par->IMB_PRM_COBBANMULTA <> '')
            {
                //CALCULAR VALOR DA MULTA
                $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permanente' );

                
                $valormuta = round($basemultajuros['multa'] * $par->IMB_PRM_COBBANMULTA/100,2);

                $nInstrucoes = $nInstrucoes + 1;
                //$dadosboleto["instrucoes$nInstrucoes"] = 'Multa de R$ '.number_format($valormuta, 2, ',', '.').' após vencimento';
                $dadosboleto["instrucoes$nInstrucoes"] = 'Multa de '.number_format($par->IMB_PRM_COBBANMULTA, 2, ',', '.').'% após vencimento';

                if( $par->IMB_PRM_COBMULTANDIAS <> '0' and $par->IMB_PRM_COBMULTANDIAS <> '')
                {
                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permanente' );
                    $valormuta = round($basemultajuros['multa'] * $par->IMB_PRM_COBMULTANDIASPER/100,2);
    
                    if( $par->IMB_PRM_COBMULTANDIASPER > 0 )
                    $dadosboleto["instrucoes$nInstrucoes"] =
                    $dadosboleto["instrucoes$nInstrucoes"] .' - '.
                            'Após '.$par->IMB_PRM_COBMULTANDIAS.' dias de vencido, cobrar multa adicional de '.
//                            'R$ '.number_format($valormuta, 2, ',', '.');
                            'R$ '.number_format($par->IMB_PRM_COBMULTANDIASPER, 2, ',', '.').'%';
                }

            }



            if( $par->IMB_PRM_COBBANJUROSDIA <> '0' and $par->IMB_PRM_COBBANJUROSDIA <> '')
            {

                $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permanente' );
                $valorjuros = round($basemultajuros['juros'] * $par->IMB_PRM_COBBANJUROSDIA/100,2);

                $nInstrucoes = $nInstrucoes + 1;
//                $dadosboleto["instrucoes$nInstrucoes"] = 'Após o vencimento juros de R$ '.number_format($valorjuros, 2, ',', '.').' ao dia';
                $dadosboleto["instrucoes$nInstrucoes"] = 'Após o vencimento juros de '.number_format($par->IMB_PRM_COBBANJUROSDIA, 2, ',', '.').' ao dia';
                if( $par->IMB_PRM_COBBANCORRECAO <> '0' and $par->IMB_PRM_COBBANCORRECAO <> '')
                $dadosboleto["instrucoes$nInstrucoes"] =
                    $dadosboleto["instrucoes$nInstrucoes"] .', e '.
                            //'Após o vencimento correção monetária de R$ '.number_format($valorjuros, 2, ',', '.').' ao dia';
                            'Após o vencimento correção monetária de '.number_format($par->IMB_PRM_COBBANJUROSDIA, 2, ',', '.').'% ao dia';
            }

            if( $cp->IMB_CGR_VALORPONTUALIDADE > 0 )
            {
                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = '**ATENÇÃO** Até o vencimento desconto de '.number_format($cp->IMB_CGR_VALORPONTUALIDADE, 2, ',', '');
            }

            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($dadosboleto["codigo_barras"], $generator::TYPE_INTERLEAVED_2_5);
            $nossonumero_email=$dadosboleto["nosso_numero"];
            $imovel_log = $ctr->IMB_IMV_ID;
            $contrato_log = $ctr->IMB_CTR_ID;

            if( $poremail == 'S' )
            {
                app( 'App\Http\Controllers\ctrRotinas')->atualizarEmailLocatarioPrincipal( $ctr->IMB_CTR_ID, $email );

                $email = $email.';'.env('APP_MAILBOLETOCOPIA');
                $array = explode(";",$email);
                foreach( $array as $a )
                {
                    $a=str_replace( ';','',$a);
                    $html = view('boleto.756.boleto756', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                    $banconumber='756';
                    Mail::send('boleto.boletoemail', compact( 'dadosboleto', 'im','ctr', 'imv','banconumber' ) ,
                    function( $message ) use ($a, $html,$nossonumero_email, $imovel_log, $contrato_log)
                    {

                        if( $a <>'' )
                        {
                            $a = str_replace( ' ','', $a );                            
                            Log::info( 'enviado para '.$a );
                            $pdf=PDF::loadHtml( $html,'UTF-8');
//                                $message->attachData($pdf->output(), $nossonumero_email.'.pdf');
                            $message->to( $a  );
                            $message->subject('Aviso de vencimento de aluguel');
                            app('App\Http\Controllers\ctrRotinas')
                            ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Boleto enviado para '.$a);

                        }
                    });
                }
                //echo "<script>window.close();</script>";
                return response()->json('ok',200);
            }
            else
            {
                $html = view('boleto.756.boleto756', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                return $html;
                $pdf=PDF::loadHtml( $html,'UTF-8');
                //$pdf->setPaper('A4', 'portrait');
//                dd('aqui');
                return $pdf->stream('boleto'.$nossonumero.'.pdf');
            }


        }
    }


    public function digitoVerificador_barra($numero)
    {
        $resto2 = $this->modulo_11($numero, 9, 1);
        if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
           $dv = 1;
        } else {
            $dv = 11 - $resto2;
        }
        return $dv;
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

    public function fbarcode($valor){


        $fino = 1 ;
        $largo = 3 ;
        $altura = 50 ;

          $barcodes[0] = "00110" ;
          $barcodes[1] = "10001" ;
          $barcodes[2] = "01001" ;
          $barcodes[3] = "11000" ;
          $barcodes[4] = "00101" ;
          $barcodes[5] = "10100" ;
          $barcodes[6] = "01100" ;
          $barcodes[7] = "00011" ;
          $barcodes[8] = "10010" ;
          $barcodes[9] = "01010" ;
          for($f1=9;$f1>=0;$f1--){
            for($f2=9;$f2>=0;$f2--){
              $f = ($f1 * 10) + $f2 ;
              $texto = "" ;
              for($i=1;$i<6;$i++){
                $texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
              }
              $barcodes[$f] = $texto;
            }
          }


        //Desenho da barra


        //Guarda inicial
        ?><img src=imagens/p.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
        src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
        src=imagens/p.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
        src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
        <?php
        $texto = $valor ;
        if((strlen($texto) % 2) <> 0){
            $texto = "0" . $texto;
        }

        // Draw dos dados
        while (strlen($texto) > 0) {
          $i = round(esquerda($texto,2));
          $texto = direita($texto,strlen($texto)-2);
          $f = $barcodes[$i];
          for($i=1;$i<11;$i+=2){
            if (substr($f,($i-1),1) == "0") {
              $f1 = $fino ;
            }else{
              $f1 = $largo ;
            }
        ?>
            src=imagens/p.png width=<?php echo $f1?> height=<?php echo $altura?> border=0><img
        <?php
            if (substr($f,$i,1) == "0") {
              $f2 = $fino ;
            }else{
              $f2 = $largo ;
            }
        ?>
            src=imagens/b.png width=<?php echo $f2?> height=<?php echo $altura?> border=0><img
        <?php
          }
        }

        // Draw guarda final
        ?>
        src=imagens/p.png width=<?php echo $largo?> height=<?php echo $altura?> border=0><img
        src=imagens/b.png width=<?php echo $fino?> height=<?php echo $altura?> border=0><img
        src=imagens/p.png width=<?php echo 1?> height=<?php echo $altura?> border=0>
          <?php
    } //Fim da fun��o



    public function esquerda($entra,$comp)
    {
        return substr($entra,0,$comp);
    }

    public function direita($entra,$comp)
    {
        return substr($entra,strlen($entra)-$comp,$comp);
    }

    public function fator_vencimento($data)
    {
        //dd( $dia $mes $ano );

        $data = explode("/",$data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];



        return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }

    public function _dateToDays($year,$month,$day)
    {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);

        if ($month > 2)
        {
            $month -= 3;
        } else
        {
            $month += 9;
            if ($year)
            {
                $year--;
            }
            else
            {
                $year = 99;
                $century --;
            }
        }


        return ( floor((  146097 * $century)    /  4 ) +
                floor(( 1461 * $year)        /  4 ) +
                floor(( 153 * $month +  2) /  5 ) +
                    $day +  1721119);
    }

    public function modulo_10($num)
    {
		$numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo (falor 10)
            // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Ita�
            $temp = $numeros[$i] * $fator;
            $temp0=0;
            foreach (preg_split('//',$temp,-1,PREG_SPLIT_NO_EMPTY) as $k=>$v){ $temp0+=$v; }
            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2; // intercala fator de multiplicacao (modulo 10)
            }
        }

        // v�rias linhas removidas, vide fun��o original
        // Calculo do modulo 10
        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }

        return $digito;
    }

    public function modulo_11CrediCitrus($num)
    {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
         *
         *   Fun��o:
         *    Calculo do Modulo 11 para geracao do digito verificador
         *    de boletos bancarios conforme documentos obtidos
         *    da Febraban - www.febraban.org.br
         *
         *   Entrada:
         *     $num: string num�rica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Sa�da:
         *     Retorna o Digito verificador.
         *
         *   Observa��es:
         *     - Script desenvolvido sem nenhum reaproveitamento de c�digo pr� existente.
         *     - Assume-se que a verifica��o do formato das vari�veis de entrada � feita antes da execu��o deste script.
         */

        $soma = 0;
        $cConstante = '319731973197319731973';
        //$num=         '318800013162810017844';


        /* Separacao dos numeros */
        for ($i = 1;  $i <= strlen($num); $i++)
        {

            $caracter = substr( $cConstante, $i-1,1);

            $numeros[$i] = substr($num,$i-1,1);

            //return "car $caracter  -   num ".$numeros[$i];

            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = intval($numeros[$i]) * intval($caracter);
            // Soma dos digitos
            $soma += $parcial[$i];
        }

        $digito = 11-($soma % 11);

        if( $digito > 9)
        {
            $digito = 0;
        }

        return $digito;


    }

    function modulo_11_invertido($num)  // Calculo de Modulo 11 "Invertido" (com pesos de 9 a 2  e n�o de 2 a 9)
    {
       $ftini = 2;
       $fator = $ftfim = 9;
       $soma = 0;

       for ($i = strlen($num); $i > 0; $i--)
       {
          $soma += substr($num,$i-1,1) * $fator;
          if(--$fator < $ftini)
             $fator = $ftfim;
        }

        $digito = $soma % 11;

        if($digito > 9)
           $digito = 0;

        return $digito;
    }

    // Alterada por Glauber Portella para especifica��o do Ita�
    function monta_linha_digitavel($codigo)
    {
        // Posi��o 	Conte�do
        // 1 a 3    N�mero do banco
        // 4        C�digo da Moeda - 9 para Real ou 8 - outras moedas
        // 5        Fixo "9'
        // 6 a 9    PSK - codigo cliente (4 primeiros digitos)
        // 10 a 12  Restante do PSK (3 digitos)
        // 13 a 19  7 primeiros digitos do Nosso Numero
        // 20 a 25  Restante do Nosso numero (8 digitos) - total 13 (incluindo digito verificador)
        // 26 a 26  IOS
        // 27 a 29  Tipo Modalidade Carteira
        // 30 a 30  D�gito verificador do c�digo de barras
        // 31 a 34  Fator de vencimento (qtdade de dias desde 07/10/1997 at� a data de vencimento)
        // 35 a 44  Valor do t�tulo

        // 1. Primeiro Grupo - composto pelo c�digo do banco, c�digo da mo�da, Valor Fixo "9"
        // e 4 primeiros digitos do PSK (codigo do cliente) e DV (modulo10) deste campo
        $campo1 = substr($codigo,0,3) . substr($codigo,3,1) . substr($codigo,19,1) . substr($codigo,20,4);
        $campo1 = $campo1 . $this->modulo_10($campo1);
      $campo1 = substr($campo1, 0, 5).'.'.substr($campo1, 5);



        // 2. Segundo Grupo - composto pelas 3 �ltimas posi�oes do PSK e 7 primeiros d�gitos do Nosso N�mero
        // e DV (modulo10) deste campo
        $campo2 = substr($codigo,24,10);
        $campo2 = $campo2 . $this->modulo_10($campo2);
      $campo2 = substr($campo2, 0, 5).'.'.substr($campo2, 5);


        // 3. Terceiro Grupo - Composto por : Restante do Nosso Numero (6 digitos), IOS, Modalidade da Carteira
        // e DV (modulo10) deste campo
        $campo3 = substr($codigo,34,10);
        $campo3 = $campo3 . $this->modulo_10($campo3);
      $campo3 = substr($campo3, 0, 5).'.'.substr($campo3, 5);



        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($codigo, 4, 1);



        // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 0000000000 (dez zeros).
        $campo5 = substr($codigo, 5, 4) . substr($codigo, 9, 10);

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    function geraCodigoBanco($numero) {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }

    function dataJuliano($data)
    {
        $dia = (int)substr($data,1,2);
        $mes = (int)substr($data,3,2);
        $ano = (int)substr($data,6,4);
        $dataf = strtotime("$ano/$mes/$dia");
        $datai = strtotime(($ano-1).'/12/31');
        $dias  = (int)(($dataf - $datai)/(60*60*24));
      return str_pad($dias,3,'0',STR_PAD_LEFT).substr($data,9,4);
    }

    function abastecerPermanente( $cg )
    {

        $conta = mdlContaCaixa::find( $cg->FIN_CCR_ID);

        if( $cg->imb_cgr_idpermanente == '' )
        {
            $seqnn = intval($conta->FIN_CCI_NOSSONUMERO );
            $nossonumero = $conta->FIN_CCI_NOSSONUMERO;
            $conta->FIN_CCI_NOSSONUMERO = $seqnn + 1;
            $conta->save();
        }
        else
            $nossonumero = $cg->IMB_CGR_NOSSONUMERO;


        $nnum = $this->formata_numero($nossonumero,7,0);
        $dv_nosso_numero = $this->modulo_11($nnum,9,0);

        $dven = date('d/m/Y',strtotime( $cg->IMB_CGR_DATAVENCIMENTO ) );
        //dd( $dven );

        $codigobanco = $this->formata_numero($conta->FIN_CCI_BANCONUMERO,3,0);
        $nummoeda = "9";
        $fixo     = "9";   // Numero fixo para a posi��o 05-05
        $ios	  = "0";   // IOS - somente para Seguradoras (Se 7% informar 7, limitado 9%)
        $fator_vencimento = $this->fator_vencimento($dven);

        $valor= number_format($cg->IMB_CGR_VALOR, 2, ',', '');
        $valor = $this->formata_numero($valor,10,0,"valor");

        $codigocliente = $this->formata_numero($conta->FIN_CCI_CONVENIO,7,0);
        $nossonumero = "00000".$nnum.$dv_nosso_numero    ;
        $carteira = $conta->FIN_CCI_COBRANCACARTEIRA;
        $barra = "$codigobanco$nummoeda$fator_vencimento$valor$fixo$codigocliente$nossonumero$ios$carteira";

        $dv = $this->digitoVerificador_barra($barra);
                    // Numero para o codigo de barras com 44 digitos
        $linha = substr($barra,0,4) . $dv . substr($barra,4);
        $linhadigitavel = $this->monta_linha_digitavel($linha);

        if( $cg->imb_cgr_idpermanente == '' )
            $cgp = new mdlCobrancaGeradaPerm;
        else
            $cgp = mdlCobrancaGeradaPerm::find( $cg->imb_cgr_idpermanente );

        $cgp->IMB_IMV_ID = $cg->IMB_IMV_ID;
        $cgp->IMB_CGR_DESTINATARIO = $cg->IMB_CGR_DESTINATARIO;
        $cgp->IMB_CGR_ENDERECO = $cg->IMB_CGR_ENDERECO;
        $cgp->IMV_CGR_CEP = $cg->IMV_CGR_CEP;
        $cgp->IMB_CEP_BAI_NOME = $cg->IMB_CEP_BAI_NOME;
        $cgp->IMB_CEP_CID_NOME = $cg->IMB_CEP_CID_NOME;
        $cgp->IMB_CGR_DATAVENCIMENTO = $cg->IMB_CGR_DATAVENCIMENTO;
        $cgp->IMB_CGR_VALOR = $cg->IMB_CGR_VALOR;
        $cgp->CEP_UF_SIGLA = $cg->CEP_UF_SIGLA;
        $cgp->IMB_CGR_CPF = $cg->IMB_CGR_CPF;
        $cgp->IMB_CGR_PESSOA = $cg->IMB_CGR_PESSOA;
        $cgp->IMB_CGR_VALORDESCONTONORMAL = $cg->IMB_CGR_VALORDESCONTONORMAL;
        $cgp->IMB_CGR_VALORPONTUALIDADE = $cg->IMB_CGR_VALORPONTUALIDADE;
        $cgp->IMB_CGR_TARIFABOLETO = $cg->IMB_CGR_TARIFABOLETO;
        $cgp->IMB_CTR_ID = $cg->IMB_CTR_ID;
        $cgp->IMB_CGR_SELECIONADA = 'N';
        $cgp->IMB_CGR_IMOVEL = $cg->IMB_CGR_IMOVEL;
        $cgp->IMB_CGR_VALORIRRF = $cg->IMB_CGR_VALORIRRF;
        $cgp->IMB_CGR_NOSSONUMERO = $nnum;
        $cgp->FIN_CCR_ID  = $cg->FIN_CCR_ID ;
        $cgp->IMB_CGR_SITUACAO = '';
        $cgp->IMB_ATD_ID  = Auth::user()->IMB_ATD_ID;
        $cgp->IMB_CGR_VENCIMENTOORIGINAL = $cg->IMB_CGR_VENCIMENTOORIGINAL;
        $cgp->IMB_CGR_DTHGERACAO = date('Y/m/d');
        $cgp->IMB_CGR_INCONSISTENCIA = $cg->IMB_CGR_INCONSISTENCIA;
        $cgp->IMB_CGR_DATALIMITE  = $cg->IMB_CGR_DATALIMITE ;
        $cgp->IMB_CGR_OBSERVACAO  = '' ;
        $cgp->IMB_CGR_ENTRADACONFIRMADA = '';
        $cgp->IMB_CTR_REFERENCIA = $cg->IMB_CTR_REFERENCIA;
        $cgp->IMB_IMB_ID  = $cg->IMB_IMB_ID ;
        $cgp->IMB_CGR_NOSSONUMERODV  = $dv_nosso_numero;
        $cgp->IMB_CGR_DATAPROCESSAMENTO = date('Y/m/d');
        $cgp->FIN_CCI_BANCONUMERO = $conta->FIN_CCI_BANCONUMERO;
        $cgp->FIN_CCI_BANCODIGITO  = '';
        $cgp->FIN_CCI_AGENCIANUMERO  = $conta->FIN_CCI_AGENCIANUMERO;
        $cgp->FIN_CCI_AGENCIADIGITO  = $conta->FIN_CCI_AGENCIADIGITO ;
        $cgp->FIN_CCI_CARTEIRA  = $conta->FIN_CCI_COBRANCACARTEIRA ;
        $cgp->FIN_CCI_CARTEIRAVARIACAO  = $conta->FIN_CCI_COBRANCAVARIACAO ;
        $cgp->FIN_CCI_CODIGOCLIENTE  = $conta->FIN_CCI_CONVENIO ;
        $cgp->FIN_CCI_CONTANUMERO  = $conta->FIN_CCI_CONCORNUMERO    ;
        $cgp->FIN_CCI_CONTADIGITO  = $conta->FIN_CCI_CONCORDIGITO    ;
        $cgp->FIN_CCI_LINHADIGITAVEL = $linhadigitavel;
        $cgp->save();

        if( $cg->imb_cgr_idpermanente == '' )
        {
            $cgi = mdlCobrancaGeradaItem::where( 'IMB_CGR_ID','=', $cg->IMB_CGR_ID )->get();
            foreach( $cgi as $item)
            {
                $cgip = new mdlCobrancaGeradaItemPerm;
                $cgip->IMB_CGR_ID = $cgp->IMB_CGR_ID;
                $cgip->IMB_LCF_ID = $item->IMB_LCF_ID;
                $cgip->IMB_TBE_ID = $item->IMB_TBE_ID;
                $cgip->IMB_TBE_ID = $item->IMB_TBE_ID;
                $cgip->IMB_TBE_DESCRICAO = $item->IMB_TBE_DESCRICAO;
                $cgip->IMB_RLT_LOCATARIOCREDEB = $item->IMB_RLT_LOCATARIOCREDEB;
                $cgip->IMB_RLT_LOCADORCREDEB = $item->IMB_RLT_LOCADORCREDEB;
                $cgip->IMB_LCF_VALOR = $item->IMB_LCF_VALOR;
                $cgip->IMB_LCF_OBSERVACAO = $item->IMB_LCF_OBSERVACAO;
                $cgip->IMB_IMB_ID = $item->IMB_IMB_ID;
                $cgip->save();
                $lf = mdlLancamentoFuturo::find( $item->IMB_LCF_ID );
                if( $lf )
                {
                    $lf->IMB_LCF_NOSSONUMERO = $cgp->IMB_CGR_NOSSONUMERO;
                    $lf->IMB_CGR_ID = $cgp->IMB_CGR_ID;
                    $lf->save();
                }
                else
                {
                    $lf = new mdlLancamentoFuturo;
                    $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $lf->IMB_CTR_ID = $cgp->IMB_CTR_ID;
                    $lf->IMB_LCF_VALOR = $item->IMB_LCF_VALOR;
                    $lf->IMB_LCF_LOCADORCREDEB = $item->IMB_RLT_LOCADORCREDEB;
                    $lf->IMB_LCF_LOCATARIOCREDEB = $item->IMB_RLT_LOCATARIOCREDEB;
                    $lf->IMB_LCF_DATAVENCIMENTO = $cgp->IMB_CGR_DATAVENCIMENTO;
                    $lf->IMB_LCF_TIPO = 'A';
                    $lf->IMB_IMV_ID = $cgp->IMB_IMV_ID;
                    $lf->IMB_TBE_ID =$item->IMB_TBE_ID;
                    $lf->IMB_ATD_ID = Auth::user()->IMB_IMB_ID;
                    $lf->IMB_LCF_INCMUL ='N';
                    $lf->IMB_LCF_INCIRRF ='S';
                    $lf->IMB_LCF_INCTAX = 'S';
                    $lf->IMB_LCF_INCJUROS ='S';
                    $lf->IMB_LCF_INCCORRECAO = 'S';
                    $lf->IMB_LCF_INCISS = 'N';
                    $lf->IMB_LCF_OBSERVACAO = $item->IMB_LCF_OBSERVACAO;
                    $lf->IMB_LCF_NUMEROCONTROLE = 0;
                    $lf->IMB_LCF_NUMPARREAJUSTE = 0;
                    $lf->IMB_LCF_NUMPARCONTRATO = 0;
                    $lf->IMB_LCF_CHAVE          = 0;
                    $lf->IMB_LCF_REAJUSTAR          = '';
                    $lf->IMB_CLT_IDLOCADOR      = $item->IMB_CLT_ID      ;

                    $lf->IMB_LCF_NOSSONUMERO = $cgp->IMB_CGR_NOSSONUMERO;
                    $lf->IMB_CGR_ID = $cgp->IMB_CGR_ID;
                    //gravar o ID do lancamento no item da cobranca
                    $cgip->IMB_LCF_ID = $item->IMB_LCF_ID;
                    $cgip->save();


                }

            }
        }


        return $cgp;

    }





    public function gerarRemessa()
    {
        $empresa=Auth::user()->IMB_IMB_ID;
        $pasta='/files/'.$empresa;
        $filename = 'cnab200.txt';

        $cgs = mdlCobrancaGerada::where( 'IMB_CGR_SELECIONADA','=', 'S')
        ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->orderBy( 'IMB_CGR_ID')
        ->get();


        if( $cgs <> '[]')
        {
            $conta = mdlContaCaixa::find( $cgs[0]->FIN_CCR_ID );
            $seqarq = $conta->FIN_CCI_COBRANCAARQSEQ;
            $conta->FIN_CCI_COBRANCAARQSEQ = intval( $seqarq )+1;
            $conta->save();


            $statuscobranca = 'REMESSA-PRODUCAO';

            if( $conta->FIN_CCI_EMTESTE == 'S')
                $statuscobranca ='REMESSA-TESTE';

            $cCGCCedente = $conta->FIN_CCI_CGCCPF;

            $cCGCCedente = str_replace('.','',$cCGCCedente);
            $cCGCCedente = str_replace('-','',$cCGCCedente);
            $cCGCCedente = str_replace('/','',$cCGCCedente);
            $cCGCCedente = $this->formata_numero($cCGCCedente,14,0);

            $cPessoaCEDENTE = '2';
            if( $conta->FIN_CCI_PESSOA =='F')
                $cPessoaCEDENTE = '1';

            $nRegistroLote = 0;


            $conteudo = '';
            $conteudo .=
                    '756'. // 1-3
                    '0000'. // 4-7
                    '0' . // 8-8
                    str_repeat(' ',9). //9-17
                    $cPessoaCEDENTE.//18-18
                    $cCGCCedente. //19-32
                    str_repeat(' ',20). //33-52
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0). //53-57
                    str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //58-58 DV Agencia
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//59-70
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //71-71
                    '0'. //72-72
                    substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30).//73-102
                    str_pad('SICOOB',30,' ').//103-132
                    str_repeat(' ',10).//133-142
                    '1'. //REMESSA CLIENTE -> BANCO               143-143
                    date( 'dmY' ). //144-151
                    date("his"). //152-157
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,6,0).//158-163
                    '081'. //164-166
                    '00000'.//167-171
                    str_repeat(' ', 69 ).chr(13).chr(10);



            $conteudo .=
                    '756'. //1-3
                    '0001'.//4-7
                    '1'. //8-8
                    'R'.//9-9
                    '01'.//10-11
                    str_repeat(' ',2). //12-13
                    '040'. //14-16
                    ' './/17-17
                    $cPessoaCEDENTE.//18-18
                    '0'.
                    $cCGCCedente.//19-33
                    str_repeat(' ',20).//34-53
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0). //54-58
                    str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //59-59 DV Agencia
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//60-71
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //72-72
                    ' '. //73-73
                    str_pad(substr(
                        app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($conta->FIN_CCI_CONCORNOME),0,30),30).//74-103
                    str_repeat(' ',40). //104-143
                    str_repeat(' ',40). //144-183
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,8,0). //184-191
                    date('dmY'). //192-199
                    '00000000'. //200-207
                    str_repeat(' ',33).chr(13).chr(10);


            $nSequencia     = 0;
            $nTotalFat      = 1;
            $nTotalFatVal   = 0;
            $nTitulos       = 0;
            $nSeqLote       =0;

            foreach( $cgs as $cg )
            {

                $cp = $this->abastecerPermanente( $cg );

                $cCgc = $cg->IMB_CGR_CPF;
                $cCgc = str_replace('.','',$cCgc);
                $cCgc = str_replace('-','',$cCgc);
                $cCgc = str_replace('/','',$cCgc);

                $cpessoa = '1';
                $clt = mdlCliente::where('IMB_CLT_CPF','=', $cCgc )->first();
                if( $clt )
                {
                    if( $clt->IMB_CLT_PESSOA == 'J')
                        $cpessoa = '2';
                    else
                        $cpessoa = '1';

                }

                $cCgc = $this->formata_numero($cCgc,14,0);

                $cCepLt = $cg->IMV_CGR_CEP;
                $cCepLt = str_replace('.','',$cCepLt);
                $cCepLt = str_replace('-','',$cCepLt);
                $cCepLt = $this->formata_numero($cCepLt,8,0);


                $dataencargos = $cg->IMB_CGR_DATAVENCIMENTO;
                $dataencargos = new DateTime($dataencargos);
                $dataencargos->add(new DateInterval('P1D'));

                $dataencargos = ( new DateTime($cg->IMB_CGR_DATAVENCIMENTO))->modify('+1 day')->format('Y-m-d');
                $dataencargos = ( new DateTime($dataencargos))->format('dmY');


                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );
                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 and $par->IMB_PRM_COBBANJUROSDIA <> null)
                {
                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permamente' );
                    $valorjuros = round($basemultajuros['juros'] * $par->IMB_PRM_COBBANJUROSDIA/100,2);

                    ///no sicredi só pode ser informado em percentual

                    $cobrarjuros = '2';
                    $cvaljuros = $par->IMB_PRM_COBBANJUROSDIA  * 100;
                    $cvaljuros = $this->formata_numero( intval($cvaljuros),15,0);

                    $cdatajuros =$dataencargos;
                    //$cdatajuros = date( $cdatajuros, strtotime( '+1 day' ));
                }
                else
                {
                    $cobrarjuros = '0';
                    $nTaxaJurosMes = 0;
                    $cvaljuros =  str_repeat('0',15);
                    $cdatajuros = str_repeat('0',10);

                }



                if( $par->IMB_PRM_COBBANMULTA <> 0 and $par->IMB_PRM_COBBANMULTA <> null )
                {

                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permamente' );
                    $valormulta = round($basemultajuros['multa'] * $par->IMB_PRM_COBBANMULTA/100,2);
   

                    $cobrarmulta = '2';
                    $cmulta = $par->IMB_PRM_COBBANMULTA * 100;
                    $cmulta = $this->formata_numero( intval($cmulta),15,0);
                    $cdatamulta =$dataencargos;
                }
                else
                {
                    $cobrarmulta = '0';
                    $cmulta = str_repeat( '0',15 );
                    $cdatamulta = str_repeat( '0',10 );

                }


                $nValorLancamento   = 0;
                $nValAlu            = 0;
                $nValIPT            = 0;
                $nValCob            = 0;
                $nValBon            = 0;
                $nValorCondominio   = 0;
                $nValorFundoReserva = 0;
                $nValDes            = 0;
                $nValDiv            = 0;
                $nValIRRF            =0;


                $itens = app('App\Http\Controllers\ctrCobrancaGerada')
                ->cargaItensSemJson( $cg->IMB_CGR_ID );
                $nSeqLote++;

                $nSequencia++;
                $nTotalFat++;
                $nRegistroLote++;
                $nTitulos++;

                foreach( $itens as $item )
                {

                   $nValorLancamento = $item->IMB_LCF_VALOR;

                   if( $item->IMB_RLT_LOCATARIOCREDEB == 'C' )
                      $nValorLancamento = $item->IMB_LCF_VALOR * -1;


                   if($item->IMB_TBE_ID == 1 )
                      $nValAlu = $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 17 )
                      $nValIPT = $nValIPT + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 18 )
                      $nValIRRF = $nValIRRF + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 23 )
                      $nValCob = $nValCob + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 12 )
                      $nValorCondominio = $nValorCondominio + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 55 or $item->IMB_TBE_ID == 62)
                      $nValorFundoReserva = $nValorFundoReserva + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 8 )
                      $nValDes = $nValDes + $nValorLancamento;
                   else
                      $nValDiv = $nValDiv + $nValorLancamento;
                }

                $nValTot = $cg->IMB_CGR_VALOR;
                $nValTot = $nValTot + $nValDes; //jogo ele a mais no boleto para que
                                                //o desconto saia na área de instruçoes

                $cDatBon = '00000000';
                $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                $cValBon = $this->formata_numero( intval($cValBon),15,0);
                $cTipoBon='0';
                if( $cg->IMB_CGR_VALORPONTUALIDADE <> 0 )
                {
                    $cDatBon = date('dmY',strtotime($cg->IMB_CGR_DATAVENCIMENTO));
                    $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                    $cValBon = $this->formata_numero( intval($cValBon),15,0);
                    $cTipoBon='1';
                }

 //               dd( "cDatBon $cDatBon -  cValBon: $cValBon - cTipoBon: $cTipoBon");



                $cValTot = $cg->IMB_CGR_VALOR*100;
                $cValTot = $this->formata_numero( intval($cValTot),15,0);

                //$conteudo .= "nossonumero ".$cp->IMB_CGR_NOSSONUMERO.chr(13).chr(10);
                //$conteudo .= 'Pontualidade '.$nValBon.' até: '.$cDatBon.chr(13).chr(10);

                $tipocobranca = '1'; //registrada normal
                if( $conta->FIN_CCI_RAPIDAREGISTRO == 'S' )
                  $tipocobranca = "5";

                if( $conta->FIN_CCI_IMPRESSAOEENVIO == 'E' or intval($cp->IMB_CGR_NOSSONUMERO) > 0 )
                {
                    $nossonumero = $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,7,0);
                    $agencia = $this->formata_numero($conta->FIN_CCI_AGENCIANUMERO,4,0);
                    $codigocliente = $this->formata_numero($conta->FIN_CCI_CONVENIO,10,0);


                    $nossonumeroDV =  $this->modulo_11CrediCitrus($agencia.$codigocliente.$nossonumero);

                    $formaenvio = '2';
                    $nossonumero = '00'.$nossonumero;
                }
                else
                {

                    $nossonumero = str_repeat('0',9);
                    $nossonumeroDV = '0';
                    $formaenvio = '1';

                }


                $conteudo .=    '756'.
                '0001'.
                '3'.
                $this->formata_numero($nSequencia,5,0). //009-013
                'P'. //14-14
                ' '. //15-15
                '01'.//16-17
                $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0). //18-22Agencia Mantenedora
                str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //22-22 DV Agencia
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//24-35
                str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //36-36
                ' './/37-37
                $nossonumero. //38-46
                $nossonumeroDV.//47-47
                '01'.//48-49
                $this->formata_numero( $cp->FIN_CCI_CARTEIRA,2,0).//50-51
                '1'.//52-52
                str_repeat(' ',5). //53-57
                '1'.//58-58
                '0'.//59-59
                ' './/60-60
                $formaenvio. //61-61
                '2'. //62-62
                str_pad( $cp->IMB_CGR_ID,15,' ' ).//63-77
                date('dmY', strtotime($cg->IMB_CGR_DATAVENCIMENTO )).//78-85
                $cValTot.                          //86-100
                str_repeat('0',5). //101-105
                ' './/106-106
                '04'.//107-108
                'N'. //109-109
                date( 'dmY' ).//110-117
                $cobrarjuros . // 118-118 COBRAR JUROS
                $cdatajuros. //119-126
                $cvaljuros. //127-141
                $cTipoBon. //142-142   % desconto
                $cDatBon. //143-150
                $cValBon. //151-165
                str_repeat('0', 15 ) . //166-180   iof
                str_repeat('0', 15 ) . //181-195  valor abatimento
                str_pad($cp->IMB_CGR_ID,25,' ').//196-220
                '3' . // 221-221codigo protesto
                '00' . // 222-223 numero dias protesto
                '0' . //224-224  codigo baixa devbolução
                str_repeat(' ',3 ). //225-227
                '09' . // 228-229  oeda
                str_repeat('0',  10 ). //230-239
                str_repeat(' ',  1 ).chr(13).chr(10);


                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,0,40);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,15);
                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);

                $nSequencia++;
                $conteudo .=    '756'.
                    '0001'. //004-007
                    '3'. //008-008
                    $this->formata_numero( $nSequencia,5,0 ). //009-013
                    'Q' . //14-14
                    ' '. //15-15
                    '01' . //16-17
                    $cpessoa . //18-18
                    '0'.$cCgc. //19-33
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  $cdestinatario ),40,' ').//34-73
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  $cEndereco ),40,' '). //74-113
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  str_pad($cbairro,15) ),15,' '). //114-128
                    $cCepLt. //129-136
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  str_pad($ccidade,15) ),15,' '). //114-128
                    str_pad( $cg->CEP_UF_SIGLA,2,' ').//152-153
                    '0' . //154-154
                    str_repeat('0',15 ) . //155-169
                    str_repeat(' ', 40) . //170-209
                    str_repeat('0', 3 ) . //210-212
                    str_repeat(' ', 20 ) . //213-232
                    str_repeat(' ', 8 ). //233-240
                    chr(13).chr(10);

                    $nSequencia++;
                    $conteudo .=
                    '756'.                               //001-003
                    '0001'. //004-007
                    '3'. //008-008
                    $this->formata_numero($nSequencia,5,0). //009-013
                    'R'. //14-14
                    ' '. //15-15
                    '01'.//16-17
                    '0'.//18-18
                    str_repeat( '0',8). //19-26
                    str_repeat( '0',15). //27-41
                    '0'. //42-42
                    str_repeat( '0',8). //43-50
                    str_repeat( '0',15). //51-65
                    $cobrarmulta.//66-66
                    $cdatamulta.//67-74
                    $cmulta.//75-89
                    str_repeat(' ',10 ).//90-99
                    str_repeat(' ',40 ).//100-139
                    str_repeat(' ',40 ).//140-179
                    str_repeat(' ',20 ).//180-199
                    str_repeat('0',8 ).//200-207
                    str_repeat('0',3 ).//208-210
                    str_repeat('0',5 ).//211-215
                    str_repeat(' ',1 ).//216-216
                    str_repeat('0',12 ).//217-228
                    str_repeat(' ',1 ).//229
                    str_repeat(' ',1 ).//230
                    '0'.//31
                    str_repeat(' ',9 ).//232-240
                    chr(13).chr(10);


                    /*
                foreach( $itens as $item )
                {

                    //registrando os itens em permantente
                    $ip = new mdlCobrancaGeradaItemPerm;

                    $ip->IMB_CGR_ID = $cp->IMB_CGR_ID;
                    $ip->IMB_LCF_ID = $item->IMB_LCF_ID;
                    $ip->IMB_TBE_ID = $item->IMB_TBE_ID;
                    $ip->IMB_TBE_DESCRICAO = $item->IMB_TBE_DESCRICAO;
                    $ip->IMB_RLT_LOCATARIOCREDEB = $item->IMB_RLT_LOCATARIOCREDEB;
                    $ip->IMB_RLT_LOCADORCREDEB = $item->IMB_RLT_LOCADORCREDEB;
                    $ip->IMB_LCF_VALOR = $item->IMB_LCF_VALOR;
                    $ip->IMB_LCF_OBSERVACAO = $item->IMB_LCF_OBSERVACAO;
                    $ip->IMB_IMB_ID = $item->IMB_IMB_ID;
                    $ip->save();

                    $lf = mdlLancamentoFuturo::find( $item->IMB_LCF_ID );
                    if( $lf )
                    {
                        $lf->IMB_LCF_NOSSONUMERO = $cp->IMB_CGR_NOSSONUMERO;
                        $lf->IMB_CGR_ID = $cp->IMB_CGR_ID;
                        $lf->save();
                    }

                }
*/
                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );

                $cNaoReceber=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANTOLERANCIA <> 0 )
                   $cNaoReceber = 'NAO RECEBER APOS '.$par->IMB_PRM_COBBANTOLERANCIA.
                                ' DIAS DE VENCIDO';
                $cNaoReceber=str_pad( $cNaoReceber,219,' ');

                $cJurosMes=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 )
                     $cJurosMes = 'APOS O VENCIMENTO, COBRAR JUROS DIARIO DE '.
                     $par->IMB_PRM_COBBANJUROSDIA.'%';
                $cJurosMes=str_pad( $cJurosMes,219,' ');

                $cCorrecao=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANCORRECAO <> 0 )
                     $cCorrecao = '+ CORREÇÃO DE '.($par->IMB_PRM_COBBANCORRECAO/30).'% AO DIA';
                $cCorrecao=str_pad( $cCorrecao,219,' ');

                $nSequencia++;
                $conteudo .= '756'.                               //001-003
                            '0001' . //004-007
                            '3'. //008-008
                            $this->formata_numero($nSequencia,5,0 ). //009-013
                            'S'. //14-14
                            ' '. //15-15
                            '01'.//16-17
                            '3'.//18-18
                            str_pad( 'Valor Aluguel........: R$'.number_format($nValAlu, 2, ',', ''),40,' ').
                            str_pad( 'Valor IPTU...........: R$'.number_format($nValIPT, 2, ',', ''),40,' ').
                            str_pad( 'Valor IRRF...........: R$'.number_format($nValIRRF, 2, ',', ''),40,' ').
                            str_pad( 'Valor Desconto/Acordo: R$'.number_format($nValDes, 2, ',', ''),40,' ').
                            str_pad( 'Valores Diversos.....: R$'.number_format($nValDiv, 2, ',', ''),40,' ').
                            str_repeat(' ',22 ).
                            chr(13).chr(10);



    }
    $nSequencia++;
    $nTotalFat++;

    $nRegistroLote++;
    $nSequencia++;
    $conteudo .=  '756'.
                  '0001'. //004-007
                  '5'. //008-008
                  str_repeat(' ', 9 ). //09-17
                  $this->formata_numero($nSequencia,6,0 ). //018-23
                  $this->formata_numero($nTitulos,6,0 ). //024-29
                  str_repeat('0', 17 ).     //30-46
                  str_repeat('0', 6 ).     //47-52
                  str_repeat('0', 17 ).   //69
                  str_repeat('0', 6 ).   //75
                  str_repeat('0', 17 ). //92
                  str_repeat('0', 6 ).  //98
                  str_repeat('0', 17 ).   //115
                  str_repeat(' ', 8 ).
                  str_repeat(' ', 117 ).
                  chr(13).chr(10);

    $nSequencia++;
    $conteudo .=    '756'.
                    '9999'. //004-007
                    '9' . //008-008
                    str_repeat( ' ', 9 ). //009-017
                    '000001'.//18-23
                    $this->formata_numero($nSequencia+1,6,0 ). //24-29
                    str_repeat( '0', 6 ).
                    str_repeat( ' ', 205 ).
                    chr(13).chr(10);


            $filename = $this->formata_numero( $conta->FIN_CCI_COBRANCAARQSEQ,6,0 ).'.rem';

            Storage::disk('public')->makeDirectory( $pasta);
            Storage::disk('public')->put($pasta.'/'.$filename, $conteudo);
            $url = URL::to('/').'/storage'.$pasta.'/'.$filename;

            $cg = mdlCobrancaGerada::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->delete();
            $cgi = mdlCobrancaGeradaItem::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->delete();

            return $url;

            //echo '<a href='.'"
        }


    }

    public function modulo_11($num, $base=9, $r=0)
    {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
         *
         *   Fun��o:
         *    Calculo do Modulo 11 para geracao do digito verificador
         *    de boletos bancarios conforme documentos obtidos
         *    da Febraban - www.febraban.org.br
         *
         *   Entrada:
         *     $num: string num�rica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Sa�da:
         *     Retorna o Digito verificador.
         *
         *   Observa��es:
         *     - Script desenvolvido sem nenhum reaproveitamento de c�digo pr� existente.
         *     - Assume-se que a verifica��o do formato das vari�veis de entrada � feita antes da execu��o deste script.
         */

        $soma = 0;
        $fator = 2;


        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--)
        {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2
                $fator = 1;
            }
            $fator++;
        }

        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            return $digito;
        } elseif ($r == 1){
            $resto = $soma % 11;
            return $resto;
        }
    }

    public function lerRetorno240( $conta, $arquivo, $ocor, $nomeoriginal )
    {
        $file = new SplFileObject($arquivo);

        $cont = 0;

        $array = [];
        $id =  '';
        $nossonumero = '';
        $motivorejeicao = '';
        $ocorrencia ='';
        $valorcobranca = '';
        $valorpago='';
        $IMB_CTR_ID='';
        $IMB_CTR_REFERENCIA='';
        $IMB_IMV_ID='';
        $endereco = '';
        $bairro = '';
        $condominio = '';
        $locatario = '';
        $datavencimento = '';
        $datapagamento = '';
        $datacredito='';
        $encargos='';

        $rb = mdlRetornoBancario::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();


        $ccx = mdlContaCaixa::find( $conta );

	    while(!$file->eof())
	    {

            $cont++;
		    $linha = $file->fgets();

            if( substr( $linha,13,1 ) == 'T' or substr( $linha,13,1 ) =='U')
            {

                if( substr( $linha,13,1 ) == 'T')
                {
                    $id =  substr( $linha, 58,10 );
                    $nossonumero = substr( $linha, 40,5 );
                    $motivorejeicao = substr( $linha, 213,10 );
                    $ocorrencia =substr( $linha, 15,2 );
                    $valorcobranca = substr( $linha, 81,15 );
                    $datavencimento = substr( $linha, 77,4).'-'.
                                      substr( $linha, 75,2).'-'.
                                      substr( $linha, 73,2);

                    $locatario =  substr( $linha, 148,40);

                    Log::info( 'id: '.$id );

                    $cgp = mdlCobrancaGeradaPerm::find( $id );
                    if( $cgp )
                    {
                        Log::info('Ctr: '.$cgp->IMB_CTR_ID);
                        $IMB_CTR_ID=$cgp->IMB_CTR_ID;
                        $ctr = mdlContrato::find( $cgp->IMB_CTR_ID );
                        if( $ctr )
                        {
                            $IMB_CTR_REFERENCIA=$ctr->IMB_CTR_REFERENCIA;
                            $IMB_IMV_ID=$ctr->IMB_IMV_ID;
                            $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
                            if( $imv )
                            {
                                $endereco = $imv->IMB_IMV_ENDERECO.' '.
                                            $imv->IMB_IMV_ENDERECONUMERO.' '.
                                            $imv->IMB_IMV_NUMAPT.' '.
                                            $imv->IMB_IMV_ENDERECOCOMPLEMENTO;
                                $bairro = $imv->CEP_BAI_NOME;

                                if( $imv->IMB_CND_ID <> 0 )
                                {
                                    $condominio = app('App\Http\Controllers\ctrCondominio')
                                    ->busca($imv->IMB_CND_ID )->IMB_CND_NOME;
                                }
                                $locatario =
                                app('App\Http\Controllers\ctrRotinas')
                                ->nomeLocatarioPrincipal( $IMB_CTR_ID );

                            }
                        }

                    }

                };

                if( substr( $linha,13,1 ) == 'U')
                {
                    $valorpago = substr( $linha, 77,15 );
                    $datacredito =    substr( $linha, 149,4).'-'.
                                      substr( $linha, 147,2).'-'.
                                      substr( $linha, 145,2);

                    $datapagamento =  substr( $linha, 141,4).'-'.
                                      substr( $linha, 139,2).'-'.
                                      substr( $linha, 137,2);
                    if( $datacredito == '    -  -  ') $datacredito = null;
                    if( $datapagamento == '0000-00-00') $datapagamento = null;
                    if( $datavencimento == '0000-00-00') $datavencimento = null;

                    $encargos = substr( $linha, 17,15);

                    $encargos = intval( $encargos );
                    $valorpago = intval( $valorpago );
                    $valorcobranca = intval( $valorcobranca );

                    if( $encargos <> 0 )
                        $encargos = intval( $encargos)/100;
                    if( $valorpago <> 0 )
                        $valorpago = intval( $valorpago)/100;
                    if( $valorcobranca <> 0 )
                        $valorcobranca = intval( $valorcobranca)/100;

                    if( $cgp <> '' )
                    {
                        $japago = 'N';
                        $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO, $cgp->IMB_CGR_ID  );
                        if( $valorjapago <> 0 ) 
                            $japago='S';
                        else
                        {
                            $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->jaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_VENCIMENTOORIGINAL );
                            if( $valorjapago <> 0 ) 
                                $japago='S';

                        }


                        $rb = new mdlRetornoBancario;
                        $rb->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                        $rb->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                        $rb->id = $id;
                        $rb->imb_imv_id = $IMB_IMV_ID;
                        $rb->imb_ctr_referencia = $IMB_CTR_REFERENCIA;
                        $rb->codigoocorrencia = $ocorrencia;
                        $rb->nomeocorrencia = $this->ocorrencia( $ocorrencia);
                        $rb->nossonumero = $nossonumero;
                        $rb->valorpago = $valorpago;
                        $rb->valorcobranca = $valorcobranca;
                        $rb->motivorejeicao = $motivorejeicao;
                        $rb->encargos = $encargos;
                        $rb->observacoes = '';
                        $rb->endereco = $endereco;
                        $rb->locatario = $locatario;
                        $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
                        $rb->IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTOORIGINAL ;
                        $rb->datavencimento = $cgp->IMB_CGR_VENCIMENTOORIGINAL;
                        $rb->datapagamento = $datapagamento;
                        $rb->IMB_CTR_ID = $IMB_CTR_ID;
                        $rb->condominio = $condominio;
                        $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                        $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                        $rb->valorjapago = $valorjapago;


                        $totalareceber = app('App\Http\Controllers\ctrRecebimento')
                                ->calcularRecebimento( $ctr->IMB_CTR_ID,
                                            $cgp->IMB_CGR_VENCIMENTOORIGINAL,
                                            $datapagamento,
                                            'N',
                                            'N',
                                            'N',
                                            'boleto' );

                        if( $ocorrencia == '06')
                        {
                            if( $ctr <> '' )
                            app('App\Http\Controllers\ctrRotinas')
                          ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'Leitura do arquivo retorno '.$rb->nomedoarquivo.
                           ' como LIQUIDAÇÃO, Vencimento: '.implode("-", array_reverse(explode("-", trim($rb->datavencimento)))));

                            $rb->selecionado = 'S';
                        }

                        $rb->save();
                    //setando o status do boleto depois de lido o boleto

                        if( $ocorrencia == '02')
                        {
                            $cgp = mdlCobrancaGeradaPerm::find( $id );
                            $cgp->IMB_CGR_ENTRADACONFIRMADA = 'S';
                            $cgp->save();
                            if( $ctr <> '' )
                            app('App\Http\Controllers\ctrRotinas')
                          ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'Leitura do arquivo retorno '.$rb->nomedoarquivo.
                           ' como ENTRADA CONFIRMADA Vencimento: '.implode("-", array_reverse(explode("-", trim($rb->datavencimento)))));

                        }
                        else
                        if( $ocorrencia == '03')
                        {
                            $cgp = mdlCobrancaGeradaPerm::find( $id );
                            $cgp->IMB_CGR_ENTRADACONFIRMADA = 'N';
                            $cgp->IMB_CGR_DTHINATIVO = date( 'Y/m/d');
                            $cgp->save();
                            if( $ctr <> '' )
                            app('App\Http\Controllers\ctrRotinas')
                          ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'Leitura do arquivo retorno '.$rb->nomedoarquivo.
                           ' como ENTRADA REJEITADA Vencimento: '.implode("-", array_reverse(explode("-", trim($rb->datavencimento)))));

                        }
                    }
                    else
                    {
                        $rb = new mdlRetornoBancario;
                        $rb->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                        $rb->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                        $rb->id = $id;
                        $rb->imb_imv_id = 999999;
                        $rb->imb_ctr_referencia = 'nda';
                        $rb->codigoocorrencia = $ocorrencia;
                        $rb->nomeocorrencia = $this->ocorrencia( $ocorrencia);
                        $rb->nossonumero = $nossonumero;
                        $rb->valorpago = $valorpago;
                        $rb->valorcobranca = $valorcobranca;
                        $rb->motivorejeicao = $motivorejeicao;
                        $rb->encargos = $encargos;
                        $rb->observacoes = '';
                        $rb->endereco = '';
                        $rb->locatario = $locatario;
                        $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
                        $rb->datavencimento = $datavencimento;
                        $rb->datapagamento = $datapagamento;
                        $rb->IMB_CTR_ID = $IMB_CTR_ID;
                        //$rb->condominio = $condominio;
                        $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                        $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                        $rb->valorjapago = 0;

                    }

                };

            }
	    }

        $retornos = mdlRetornoBancario::
            where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
            ->orderBy( 'locatario');

        if( $ocor <> '' )
            $retornos = $retornos->where("codigoocorrencia",'=', $ocor );

        $retornos = $retornos->get();

//        return DataTables::of($rb)->make(true);


//        $array = json_encode( $array );
       return view( 'cobrancabancaria.resultadoleitura', compact( 'retornos'));


    }


    public function lerRetorno400( $conta, $arquivo, $ocor, $nomeoriginal )
    {
        $file = new SplFileObject($arquivo);

        $cont = 0;

        $array = [];
        $id =  '';
        $nossonumero = '';
        $motivorejeicao = '';
        $ocorrencia ='';
        $valorcobranca = '';
        $valorpago='';
        $IMB_CTR_ID='';
        $IMB_CTR_REFERENCIA='';
        $IMB_IMV_ID='';
        $endereco = '';
        $bairro = '';
        $condominio = '';
        $locatario = '';
        $datavencimento = '';
        $datapagamento = '';
        $datacredito='';
        $encargos='';

        $rb = mdlRetornoBancario::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

        $ccx = mdlContaCaixa::find( $conta );
        

	    while(!$file->eof())
	    {

            $cont++;
		    $linha = $file->fgets();
            if( substr( $linha,0,1 ) == '1' )
            {
                $id =  trim(substr( $linha, 116,10 ));
                $nossonumero = substr( $linha, 62,11 );

                //$motivorejeicao = substr( $linha, 213,10 );
                $ocorrencia =substr( $linha, 108,2 );
                $valorcobranca = substr( $linha, 152,13 );
                if( substr( $linha, 146,6) <>'000000')
                    $datavencimento = '20'.substr( $linha, 150,2).'-'.
                                  substr( $linha, 148,2).'-'.
                                  substr( $linha, 146,2);
                else
                    $datavencimento=null;



                $cgp = mdlCobrancaGeradaPerm::find( $id );
                
                $vencimentooriginal = '';

                if( $cgp )
                {
                    $IMB_CTR_ID=$cgp->IMB_CTR_ID;

                    $vencimentooriginal = $cgp->IMB_CGR_VENCIMENTOORIGINAL;


                    $japago = 'N';
                    $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO, $cgp->IMB_CGR_ID  );
                    if( $valorjapago <> 0 ) 
                        $japago='S';
                    else
                    {
                        $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->jaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_VENCIMENTOORIGINAL );
                        if( $valorjapago <> 0 ) 
                            $japago='S';

                    }



                    $ctr = mdlContrato::find( $cgp->IMB_CTR_ID );
                    if( $ctr )
                    {

                        $IMB_CTR_REFERENCIA=$ctr->IMB_CTR_REFERENCIA;
                        $IMB_IMV_ID=$ctr->IMB_IMV_ID;

                        $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
                        if( $imv )
                        {
                            $endereco = $imv->IMB_IMV_ENDERECO.' '.
                                        $imv->IMB_IMV_ENDERECONUMERO.' '.
                                        $imv->IMB_IMV_NUMAPT.' '.
                                        $imv->IMB_IMV_ENDERECOCOMPLEMENTO;
                            $bairro = $imv->CEP_BAI_NOME;

                            if( $imv->IMB_CND_ID <> 0 )
                            {
                                $condominio = app('App\Http\Controllers\ctrCondominio')
                                ->buscar($imv->IMB_CND_ID )->IMB_CND_NOME;
                            }
                            $locatario =
                            app('App\Http\Controllers\ctrRotinas')
                            ->nomeLocatarioPrincipal( $IMB_CTR_ID );

                        }
                    }


                    $datacredito = substr($linha, 175,6);

                    $valorpago = substr( $linha, 253,13 );
                    if( substr($linha, 175,6) <> '000000' )
                    $datacredito =    '20'.substr( $linha, 179,2).'-'.
                        substr( $linha, 177,2).'-'.
                        substr( $linha, 175,2);
                    else
                        $datacredito = null;


                    if( substr($linha, 114,6) <> '000000' )
                        $datapagamento =  '20'.substr( $linha, 114,2).'-'.
                                    substr( $linha, 112,2).'-'.
                                    substr( $linha, 110,2);
                    else
                        $datapagamento = null;

                    $calc = app( 'App\Http\Controllers\ctrRecebimento')->calcularRecebimento( $cgp->IMB_CTR_ID,
                                                $cgp->IMB_CGR_VENCIMENTOORIGINAL,
                                                $datapagamento,
                                                'N',
                                                'N',
                                                'N',
                                                'boleto' );

                    $totalCalculado = 0;
                    foreach( $calc as $c )
                    {
                        if( $c->IMB_LCF_LOCATARIOCREDEB == 'D')
                            $totalCalculado = $totalCalculado + $c->IMB_LCF_VALOR ;
                        else
                        if( $c->IMB_LCF_LOCATARIOCREDEB == 'C')
                            $totalCalculado = $totalCalculado - $c->IMB_LCF_VALOR ;
                    }

                    $encargos=0;
                    $rb = new mdlRetornoBancario;
                    $rb->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $rb->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $rb->id = $id;
                    $rb->imb_imv_id = $IMB_IMV_ID;
                    $rb->imb_ctr_referencia = $IMB_CTR_REFERENCIA;
                    $rb->codigoocorrencia = $ocorrencia;
                    $rb->nomeocorrencia = $this->ocorrencia( $ocorrencia);
                    $rb->nossonumero = $nossonumero;
                    $rb->valorpago = intval($valorpago)/100;
                    $rb->valorcobranca = intval($valorcobranca)/100;
                    $rb->motivorejeicao = $motivorejeicao;
                    $rb->datacredito = $datacredito;
                    $rb->encargos = intval($encargos);
                    $rb->endereco = $endereco;
                    $rb->locatario = $locatario;
                    $rb->datapagamento = $datapagamento;
                    if( $vencimentooriginal <> '')
                    {
                        $rb->IMB_CGR_VENCIMENTOORIGINAL = $vencimentooriginal ;
                        $rb->datavencimento = $vencimentooriginal ;
                    }
                    else
                    {
                        $rb->IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTO;
                        $rb->datavencimento = $cgp->IMB_CGR_VENCIMENTO ;

                    }
                    $rb->IMB_CTR_ID = $IMB_CTR_ID;
                    $rb->condominio = $condominio;
                    $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                    $rb->FIN_CCX_ID = $conta;
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    $rb->valorjapago = $valorjapago;
                                        
                    $rb->observacoes='';
                    if( $totalCalculado <> $rb->valorpago and $totalCalculado>0)
                    $rb->observacoes = 'Valor pago: '.$rb->valorpago.' -> Calculado: '.$totalCalculado.' ----> Inconsistência no valor pago com o valor calculado';
                    $rb->condominio = $condominio;
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;


                                       


                    if( $ocorrencia == '06' and $valorjapago == 0  )
                    {
                        $totalCalculado = $this->formata_numero( $totalCalculado*100,13,0);

                        if( strcmp( $valorpago, $totalCalculado )  == 0 )
                            $rb->pagonaoconfere ='N';
                        else
                            $rb->pagonaoconfere ='S';

    
                        $rb->selecionado = 'S';
                    }                        
                    $rb->save();


                    //setando o status do boleto depois de lido o boleto

                    if( $ocorrencia == '02')
                    {
                        $cgp = mdlCobrancaGeradaPerm::find( $id );
                        $cgp->IMB_CGR_ENTRADACONFIRMADA = 'S';
                        $cgp->save();
                    }
                    else
                    if( $ocorrencia == '03')
                    {
                        $cgp = mdlCobrancaGeradaPerm::find( $id );
                        $cgp->IMB_CGR_ENTRADACONFIRMADA = 'N';
                        $cgp->save();
                    }
                }
                else
                {
                    $rb = new mdlRetornoBancario;
                    $rb->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $rb->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $rb->id = $id;
                    $rb->imb_imv_id = 0;
                    $rb->imb_ctr_referencia = 0;
                    $rb->codigoocorrencia = $ocorrencia;
                    $rb->nomeocorrencia = $this->ocorrencia( $ocorrencia);
                    $rb->nossonumero = $nossonumero;
                    $rb->valorpago = intval($valorpago)/100;
                    $rb->valorcobranca = intval($valorcobranca)/100;
                    $rb->motivorejeicao = $motivorejeicao;
                    $rb->encargos = intval($encargos);
                    $rb->observacoes = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->endereco = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->locatario = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->datavencimento = $datavencimento;
//                    $rb->datapagamento = $datapagamento;
                    $rb->IMB_CTR_ID = 0;
                    $rb->condominio = 0;
                    $rb->contacorrente = '';
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    //$rb->valorjapago = $valorjapago;
                    $rb->save();

                }

            };
	    }

        $retornos = mdlRetornoBancario::
            where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
            ->orderBy( 'locatario');


        if( $ocor <> '' )
            $retornos = $retornos->where("codigoocorrencia",'=', $ocor );

        $retornos = $retornos->get();

       return view( 'cobrancabancaria.resultadoleitura', compact( 'retornos'));


    }



    public function ocorrencia( $id )
    {
        $nomeocorrencia='';
        if( $id == '02' ) $nomeocorrencia = 'Entrada Confirmada';
        if( $id == '03' ) $nomeocorrencia = 'Entrada rejeitada';
        if( $id == '06' ) $nomeocorrencia = 'Liquidação';
        if( $id == '07' ) $nomeocorrencia = 'Confirmação do recebimento da instrução de desconto';
        if( $id == '08' ) $nomeocorrencia = 'Confirmação do recebimento do cancelamento do desconto';
        if( $id == '09' ) $nomeocorrencia = 'Baixa';
        if( $id == '10' ) $nomeocorrencia = 'Pedido de Baixa';
        if( $id == '12' ) $nomeocorrencia = 'Confirmação do recebimento instrução de abatimento';
        if( $id == '13' ) $nomeocorrencia = 'Confirmação do recebimento instrução de cancelamento abatimento';
        if( $id == '14' ) $nomeocorrencia = 'Confirmação do recebimento instrução alteração de vencimento';
        if( $id == '17' ) $nomeocorrencia = 'Liquidação após baixa ou liquidação título não registrado';
        if( $id == '20' ) $nomeocorrencia = 'Confirmação do recebimento instrução de sustação/cancelamento de protesto';
        if( $id == '23' ) $nomeocorrencia = 'Remessa a cartório (aponte em cartório)';
        if( $id == '24' ) $nomeocorrencia = 'Retirada de cartório e manutenção em carteira';
        if( $id == '25' ) $nomeocorrencia = 'Protestado e baixado (baixa por ter sido protestado)';
        if( $id == '26' ) $nomeocorrencia = 'Instrução rejeitada';
        if( $id == '27' ) $nomeocorrencia = 'Confirmação do pedido de alteração de outros dados';
        if( $id == '28' ) $nomeocorrencia = 'Débito de tarifas custas';
        if( $id == '30' ) $nomeocorrencia = 'Alteração de dados rejeitada';
        if( $id == '36' ) $nomeocorrencia = 'Baixa rejeitada';
        if( $id == '51' ) $nomeocorrencia = 'Título DDA reconhecido pelo pagador';
        if( $id == '52' ) $nomeocorrencia = 'Título DDA não reconhecido pelo pagador';
        if( $id == '78' ) $nomeocorrencia = 'Confirmação de recebimento de pedido de negativação';
        if( $id == '79' ) $nomeocorrencia = 'Confirmação de recebimento de pedido de exclusão de negativação';
        if( $id == '80' ) $nomeocorrencia = 'Confirmação de entrada de negativação';
        if( $id == '81' ) $nomeocorrencia = 'Entrada de negativação rejeitada';
        if( $id == '82' ) $nomeocorrencia = 'Confirmação de exclusão de negativação';
        if( $id == '83' ) $nomeocorrencia = 'Exclusão de Negativação rejeitada';
        if( $id == '84' ) $nomeocorrencia = 'Exclusão de negativação por outros motivos';
        if( $id == '85' ) $nomeocorrencia = 'Ocorrência informacional por outros motivos';
        if( $id == '19' ) $nomeocorrencia = 'Confirmação do recebimento instrução de protesto';

        return $nomeocorrencia;
    }


    public function gerarRemessaComNumPosto()
    {
        $empresa=Auth::user()->IMB_IMB_ID;
        $pasta='/files/'.$empresa;
        $filename = 'cnab200.txt';

        $cgs = mdlCobrancaGerada::where( 'IMB_CGR_SELECIONADA','=', 'S')
        ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->orderBy( 'IMB_CGR_ID')
        ->get();


        if( $cgs <> '[]')
        {
            $conta = mdlContaCaixa::find( $cgs[0]->FIN_CCR_ID );
            $seqarq = $conta->FIN_CCI_COBRANCAARQSEQ;
            $conta->FIN_CCI_COBRANCAARQSEQ = intval( $seqarq )+1;
            $conta->save();


            $statuscobranca = 'REMESSA-PRODUCAO';

            if( $conta->FIN_CCI_EMTESTE == 'S')
                $statuscobranca ='REMESSA-TESTE';

            $cCGCCedente = $conta->FIN_CCI_CGCCPF;

            $cCGCCedente = str_replace('.','',$cCGCCedente);
            $cCGCCedente = str_replace('-','',$cCGCCedente);
            $cCGCCedente = str_replace('/','',$cCGCCedente);
            $cCGCCedente = $this->formata_numero($cCGCCedente,14,0);

            $cPessoaCEDENTE = '2';
            if( $conta->FIN_CCI_PESSOA =='F')
                $cPessoaCEDENTE = '1';

            $nRegistroLote = 0;


            $conteudo = '';
            $conteudo .=
                    '756'. // 1-3
                    '0000'. // 4-7
                    '0' . // 8-8
                    str_repeat(' ',9). //9-17
                    $cPessoaCEDENTE.//18-18
                    $cCGCCedente. //19-32
                    str_repeat(' ',20). //33-52
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0). //53-57
                    str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //58-58 DV Agencia
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//59-70
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //71-71
                    '0'. //72-72
                    substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30).//73-102
                    str_pad('SICOOB',30,' ').//103-132
                    str_repeat(' ',10).//133-142
                    '1'. //REMESSA CLIENTE -> BANCO               143-143
                    date( 'dmY' ). //144-151
                    date("his"). //152-157
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,6,0).//158-163
                    '081'. //164-166
                    '00000'.//167-171
                    str_repeat(' ', 69 ).chr(13).chr(10);



            $conteudo .=
                    '756'. //1-3
                    '0001'.//4-7
                    '1'. //8-8
                    'R'.//9-9
                    '01'.//10-11
                    str_repeat(' ',2). //12-13
                    '040'. //14-16
                    ' './/17-17
                    $cPessoaCEDENTE.//18-18
                    '0'.
                    $cCGCCedente.//19-33
                    str_repeat(' ',20).//34-53
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0). //54-58
                    str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //59-59 DV Agencia
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//60-71
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //72-72
                    ' '. //73-73
                    str_pad(substr(
                        app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($conta->FIN_CCI_CONCORNOME),0,30),30).//74-103
                    str_repeat(' ',40). //104-143
                    str_repeat(' ',40). //144-183
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,8,0). //184-191
                    date('dmY'). //192-199
                    '00000000'. //200-207
                    str_repeat(' ',33).chr(13).chr(10);


            $nSequencia     = 0;
            $nTotalFat      = 1;
            $nTotalFatVal   = 0;
            $nTitulos       = 0;
            $nSeqLote       =0;

            foreach( $cgs as $cg )
            {

                $cp = $this->abastecerPermanente( $cg );

                $cCgc = $cg->IMB_CGR_CPF;
                $cCgc = str_replace('.','',$cCgc);
                $cCgc = str_replace('-','',$cCgc);
                $cCgc = str_replace('/','',$cCgc);

                $cpessoa = '1';
                $clt = mdlCliente::where('IMB_CLT_CPF','=', $cCgc )->first();
                if( $clt )
                {
                    if( $clt->IMB_CLT_PESSOA == 'J')
                        $cpessoa = '2';
                    else
                        $cpessoa = '1';

                }

                $cCgc = $this->formata_numero($cCgc,14,0);

                $cCepLt = $cg->IMV_CGR_CEP;
                $cCepLt = str_replace('.','',$cCepLt);
                $cCepLt = str_replace('-','',$cCepLt);
                $cCepLt = $this->formata_numero($cCepLt,8,0);


                $dataencargos = $cg->IMB_CGR_DATAVENCIMENTO;
                $dataencargos = new DateTime($dataencargos);
                $dataencargos->add(new DateInterval('P1D'));

                $dataencargos = ( new DateTime($cg->IMB_CGR_DATAVENCIMENTO))->modify('+1 day')->format('Y-m-d');
                $dataencargos = ( new DateTime($dataencargos))->format('dmY');


                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );
                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 and $par->IMB_PRM_COBBANJUROSDIA <> null)
                {
                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permamente' );
                    $valorjuros = round($basemultajuros['juros'] * $par->IMB_PRM_COBBANJUROSDIA/100,2);

                    ///no sicredi só pode ser informado em percentual

                    $cobrarjuros = '2';
                    $cvaljuros = $par->IMB_PRM_COBBANJUROSDIA  * 100;
                    $cvaljuros = $this->formata_numero( intval($cvaljuros),15,0);

                    $cdatajuros =$dataencargos;
                    //$cdatajuros = date( $cdatajuros, strtotime( '+1 day' ));
                }
                else
                {
                    $cobrarjuros = '3';
                    $nTaxaJurosMes = 0;
                    $cvaljuros =  str_repeat('0',15);
                    $cdatajuros = str_repeat('0',10);

                }



                if( $par->IMB_PRM_COBBANMULTA <> 0 and $par->IMB_PRM_COBBANMULTA <> null )
                {

                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permamente' );
                    $valormulta = round($basemultajuros['multa'] * $par->IMB_PRM_COBBANMULTA/100,2);
   

                    $cobrarmulta = '2';
                    $cmulta = $par->IMB_PRM_COBBANMULTA * 100;
                    $cmulta = $this->formata_numero( intval($cmulta),15,0);
                    $cdatamulta =$dataencargos;
                }
                else
                {
                    $cobrarmulta = '0';
                    $cmulta = str_repeat( '0',15 );
                    $cdatamulta = str_repeat( '0',10 );

                }


                $nValorLancamento   = 0;
                $nValAlu            = 0;
                $nValIPT            = 0;
                $nValCob            = 0;
                $nValBon            = 0;
                $nValorCondominio   = 0;
                $nValorFundoReserva = 0;
                $nValDes            = 0;
                $nValDiv            = 0;
                $nValIRRF            =0;


                $itens = app('App\Http\Controllers\ctrCobrancaGerada')
                ->cargaItensSemJson( $cg->IMB_CGR_ID );
                $nSeqLote++;

                $nSequencia++;
                $nTotalFat++;
                $nRegistroLote++;
                $nTitulos++;

                foreach( $itens as $item )
                {

                   $nValorLancamento = $item->IMB_LCF_VALOR;

                   if( $item->IMB_RLT_LOCATARIOCREDEB == 'C' )
                      $nValorLancamento = $item->IMB_LCF_VALOR * -1;


                   if($item->IMB_TBE_ID == 1 )
                      $nValAlu = $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 17 )
                      $nValIPT = $nValIPT + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 18 )
                      $nValIRRF = $nValIRRF + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 23 )
                      $nValCob = $nValCob + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 12 )
                      $nValorCondominio = $nValorCondominio + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 55 or $item->IMB_TBE_ID == 62)
                      $nValorFundoReserva = $nValorFundoReserva + $nValorLancamento;
                   else
                   if($item->IMB_TBE_ID == 8 )
                      $nValDes = $nValDes + $nValorLancamento;
                   else
                      $nValDiv = $nValDiv + $nValorLancamento;
                }

                $nValTot = $cg->IMB_CGR_VALOR;
                $nValTot = $nValTot + $nValDes; //jogo ele a mais no boleto para que
                                                //o desconto saia na área de instruçoes

                $cDatBon = '00000000';
                $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                $cValBon = $this->formata_numero( intval($cValBon),15,0);
                $cTipoBon='0';
                if( $cg->IMB_CGR_VALORPONTUALIDADE <> 0 )
                {
                    $cDatBon = date('dmY',strtotime($cg->IMB_CGR_DATAVENCIMENTO));
                    $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                    $cValBon = $this->formata_numero( intval($cValBon),15,0);
                    $cTipoBon='1';
                }

 //               dd( "cDatBon $cDatBon -  cValBon: $cValBon - cTipoBon: $cTipoBon");



                $cValTot = $cg->IMB_CGR_VALOR*100;
                $cValTot = $this->formata_numero( intval($cValTot),15,0);

                //$conteudo .= "nossonumero ".$cp->IMB_CGR_NOSSONUMERO.chr(13).chr(10);
                //$conteudo .= 'Pontualidade '.$nValBon.' até: '.$cDatBon.chr(13).chr(10);

                $tipocobranca = '1'; //registrada normal
                if( $conta->FIN_CCI_RAPIDAREGISTRO == 'S' )
                  $tipocobranca = "5";

                if( $conta->FIN_CCI_IMPRESSAOEENVIO == 'E' or intval($cp->IMB_CGR_NOSSONUMERO) > 0 )
                {
                    $nossonumero = $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,7,0);
                    $agencia = $this->formata_numero($conta->FIN_CCI_AGENCIANUMERO,4,0);
                    $codigocliente = $this->formata_numero($conta->FIN_CCI_CONVENIO,10,0);
                    $numeroposto = $this->formata_numero($conta->FIN_CCI_COOPNUMERO,2,0);


                    $nossonumeroDV =  $this->modulo_11CrediCitrus($agencia.$numeroposto.$codigocliente.$nossonumero);

                    $formaenvio = '2';
                    $nossonumero = '00'.$nossonumero;
                }
                else
                {

                    $nossonumero = str_repeat('0',9);
                    $nossonumeroDV = '0';
                    $formaenvio = '1';

                }


                $conteudo .=    '756'.
                '0001'.
                '3'.
                $this->formata_numero($nSequencia,5,0). //009-013
                'P'. //14-14
                ' '. //15-15
                '01'.//16-17
                $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0). //18-22Agencia Mantenedora
                str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //22-22 DV Agencia
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//24-35
                str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //36-36
                ' './/37-37
                $nossonumero. //38-46
                $nossonumeroDV.//47-47
                '01'.//48-49
                $this->formata_numero( $cp->FIN_CCI_CARTEIRA,2,0).//50-51
                '1'.//52-52
                str_repeat(' ',5). //53-57
                '1'.//58-58
                '0'.//59-59
                ' './/60-60
                $formaenvio. //61-61
                '2'. //62-62
                str_pad( $cp->IMB_CGR_ID,15,' ' ).//63-77
                date('dmY', strtotime($cg->IMB_CGR_DATAVENCIMENTO )).//78-85
                $cValTot.                          //86-100
                str_repeat('0',5). //101-105
                ' './/106-106
                '04'.//107-108
                'N'. //109-109
                date( 'dmY' ).//110-117
                $cobrarjuros . // 118-118 COBRAR JUROS
                $cdatajuros. //119-126
                $cvaljuros. //127-141
                $cTipoBon. //142-142   % desconto
                $cDatBon. //143-150
                $cValBon. //151-165
                str_repeat('0', 15 ) . //166-180   iof
                str_repeat('0', 15 ) . //181-195  valor abatimento
                str_pad($cp->IMB_CGR_ID,25,' ').//196-220
                '3' . // 221-221codigo protesto
                '00' . // 222-223 numero dias protesto
                '0' . //224-224  codigo baixa devbolução
                str_repeat(' ',3 ). //225-227
                '09' . // 228-229  oeda
                str_repeat('0',  10 ). //230-239
                str_repeat(' ',  1 ).chr(13).chr(10);


                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,0,40);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,15);
                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);

                $nSequencia++;
                $conteudo .=    '756'.
                    '0001'. //004-007
                    '3'. //008-008
                    $this->formata_numero( $nSequencia,5,0 ). //009-013
                    'Q' . //14-14
                    ' '. //15-15
                    '01' . //16-17
                    $cpessoa . //18-18
                    '0'.$cCgc. //19-33
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  $cdestinatario ),40,' ').//34-73
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  $cEndereco ),40,' '). //74-113
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  str_pad($cbairro,15) ),15,' '). //114-128
                    $cCepLt. //129-136
                    str_pad( app('App\Http\Controllers\ctrRotinas')
                        ->tirarEspeciais(  str_pad($ccidade,15) ),15,' '). //114-128
                    str_pad( $cg->CEP_UF_SIGLA,2,' ').//152-153
                    '0' . //154-154
                    str_repeat('0',15 ) . //155-169
                    str_repeat(' ', 40) . //170-209
                    str_repeat('0', 3 ) . //210-212
                    str_repeat(' ', 20 ) . //213-232
                    str_repeat(' ', 8 ). //233-240
                    chr(13).chr(10);

                    $nSequencia++;
                    $conteudo .=
                    '756'.                               //001-003
                    '0001'. //004-007
                    '3'. //008-008
                    $this->formata_numero($nSequencia,5,0). //009-013
                    'R'. //14-14
                    ' '. //15-15
                    '01'.//16-17
                    '0'.//18-18
                    str_repeat( '0',8). //19-26
                    str_repeat( '0',15). //27-41
                    '0'. //42-42
                    str_repeat( '0',8). //43-50
                    str_repeat( '0',15). //51-65
                    $cobrarmulta.//66-66
                    $cdatamulta.//67-74
                    $cmulta.//75-89
                    str_repeat(' ',10 ).//90-99
                    str_repeat(' ',40 ).//100-139
                    str_repeat(' ',40 ).//140-179
                    str_repeat(' ',20 ).//180-199
                    str_repeat('0',8 ).//200-207
                    str_repeat('0',3 ).//208-210
                    str_repeat('0',5 ).//211-215
                    str_repeat(' ',1 ).//216-216
                    str_repeat('0',12 ).//217-228
                    str_repeat(' ',1 ).//229
                    str_repeat(' ',1 ).//230
                    '0'.//31
                    str_repeat(' ',9 ).//232-240
                    chr(13).chr(10);


                    /*
                foreach( $itens as $item )
                {

                    //registrando os itens em permantente
                    $ip = new mdlCobrancaGeradaItemPerm;

                    $ip->IMB_CGR_ID = $cp->IMB_CGR_ID;
                    $ip->IMB_LCF_ID = $item->IMB_LCF_ID;
                    $ip->IMB_TBE_ID = $item->IMB_TBE_ID;
                    $ip->IMB_TBE_DESCRICAO = $item->IMB_TBE_DESCRICAO;
                    $ip->IMB_RLT_LOCATARIOCREDEB = $item->IMB_RLT_LOCATARIOCREDEB;
                    $ip->IMB_RLT_LOCADORCREDEB = $item->IMB_RLT_LOCADORCREDEB;
                    $ip->IMB_LCF_VALOR = $item->IMB_LCF_VALOR;
                    $ip->IMB_LCF_OBSERVACAO = $item->IMB_LCF_OBSERVACAO;
                    $ip->IMB_IMB_ID = $item->IMB_IMB_ID;
                    $ip->save();

                    $lf = mdlLancamentoFuturo::find( $item->IMB_LCF_ID );
                    if( $lf )
                    {
                        $lf->IMB_LCF_NOSSONUMERO = $cp->IMB_CGR_NOSSONUMERO;
                        $lf->IMB_CGR_ID = $cp->IMB_CGR_ID;
                        $lf->save();
                    }

                }
*/
                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );

                $cNaoReceber=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANTOLERANCIA <> 0 )
                   $cNaoReceber = 'NAO RECEBER APOS '.$par->IMB_PRM_COBBANTOLERANCIA.
                                ' DIAS DE VENCIDO';
                $cNaoReceber=str_pad( $cNaoReceber,219,' ');

                $cJurosMes=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 )
                     $cJurosMes = 'APOS O VENCIMENTO, COBRAR JUROS DIARIO DE '.
                     $par->IMB_PRM_COBBANJUROSDIA.'%';
                $cJurosMes=str_pad( $cJurosMes,219,' ');

                $cCorrecao=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANCORRECAO <> 0 )
                     $cCorrecao = '+ CORREÇÃO DE '.($par->IMB_PRM_COBBANCORRECAO/30).'% AO DIA';
                $cCorrecao=str_pad( $cCorrecao,219,' ');

                $nSequencia++;
                $conteudo .= '756'.                               //001-003
                            '0001' . //004-007
                            '3'. //008-008
                            $this->formata_numero($nSequencia,5,0 ). //009-013
                            'S'. //14-14
                            ' '. //15-15
                            '01'.//16-17
                            '3'.//18-18
                            str_pad( 'Valor Aluguel........: R$'.number_format($nValAlu, 2, ',', ''),40,' ').
                            str_pad( 'Valor IPTU...........: R$'.number_format($nValIPT, 2, ',', ''),40,' ').
                            str_pad( 'Valor IRRF...........: R$'.number_format($nValIRRF, 2, ',', ''),40,' ').
                            str_pad( 'Valor Desconto/Acordo: R$'.number_format($nValDes, 2, ',', ''),40,' ').
                            str_pad( 'Valores Diversos.....: R$'.number_format($nValDiv, 2, ',', ''),40,' ').
                            str_repeat(' ',22 ).
                            chr(13).chr(10);



    }
    $nSequencia++;
    $nTotalFat++;

    $nRegistroLote++;
    $nSequencia++;
    $conteudo .=  '756'.
                  '0001'. //004-007
                  '5'. //008-008
                  str_repeat(' ', 9 ). //09-17
                  $this->formata_numero($nSequencia,6,0 ). //018-23
                  $this->formata_numero($nTitulos,6,0 ). //024-29
                  str_repeat('0', 17 ).     //30-46
                  str_repeat('0', 6 ).     //47-52
                  str_repeat('0', 17 ).   //69
                  str_repeat('0', 6 ).   //75
                  str_repeat('0', 17 ). //92
                  str_repeat('0', 6 ).  //98
                  str_repeat('0', 17 ).   //115
                  str_repeat(' ', 8 ).
                  str_repeat(' ', 117 ).
                  chr(13).chr(10);

    $nSequencia++;
    $conteudo .=    '756'.
                    '9999'. //004-007
                    '9' . //008-008
                    str_repeat( ' ', 9 ). //009-017
                    '000001'.//18-23
                    $this->formata_numero($nSequencia+1,6,0 ). //24-29
                    str_repeat( '0', 6 ).
                    str_repeat( ' ', 205 ).
                    chr(13).chr(10);


            $filename = $this->formata_numero( $conta->FIN_CCI_COBRANCAARQSEQ,6,0 ).'.rem';

            Storage::disk('public')->makeDirectory( $pasta);
            Storage::disk('public')->put($pasta.'/'.$filename, $conteudo);
            $url = URL::to('/').'/storage'.$pasta.'/'.$filename;

            $cg = mdlCobrancaGerada::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->delete();
            $cgi = mdlCobrancaGeradaItem::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->delete();

            return $url;

            //echo '<a href='.'"
        }


    }


}
