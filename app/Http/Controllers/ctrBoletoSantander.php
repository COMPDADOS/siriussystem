<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaPermItem;
use App\mdlCobrancaGerada;
use App\mdlCobrancaGeradaItem;
use App\mdlLancamentoFuturo;

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
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Illuminate\Support\Facades\URL;
class ctrBoletoSantander extends Controller
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
        $cpi = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=',$id)->get();
        $ctr = mdlContrato::find( $cp->IMB_CTR_ID);

        $lt = mdlLocatarioContrato::select( [ 'IMB_CLT_EMAIL'])
            ->where( 'IMB_LOCATARIOCONTRATO.IMB_CTR_ID','=', $cp->IMB_CTR_ID )
            ->where( 'IMB_LOCATARIOCONTRATO.IMB_LCTCTR_PRINCIPAL','=', 'S' )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
            ->first();

/*
        $email = $lt->IMB_CLT_EMAIL;
        //dd( $email );

        if( $ctr->IMB_CTR_EMAIL <> '' )
  */          $email = $ctr->IMB_CTR_EMAIL;




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

            $dadosboleto["nosso_numero"] = $cp->IMB_CGR_NOSSONUMERO;  // Nosso numero - REGRA: M�ximo de 8 caracteres!
            $dadosboleto["numero_documento"] = $cp->IMB_CTR_ID;	// Num do pedido ou nosso numero
            $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
            $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
            $dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

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

            $codigobanco = "033";
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

            $codigocliente = $this->formata_numero($dadosboleto["codigo_cliente"],7,0);

            $carteira = $dadosboleto["carteira"];

            //nosso_numero no maximo 8 digitos
            $nnum = $this->formata_numero($dadosboleto["nosso_numero"],7,0);

            $dv_nosso_numero = $this->modulo_11($nnum,9,0);
            // nosso n�mero (com dvs) s�o 13 digitos
            $nossonumero = "00000".$nnum.$dv_nosso_numero;

            $vencimento = $dadosboleto["data_vencimento"];

            $vencjuliano = $this->dataJuliano($vencimento);

            // 43 numeros para o calculo do digito verificador do codigo de barras
            $barra = "$codigobanco$nummoeda$fator_vencimento$valor$fixo$codigocliente$nossonumero$ios$carteira";
                        // 43 numeros para o calculo do digito verificador
            $dv = $this->digitoVerificador_barra($barra);
            // Numero para o codigo de barras com 44 digitos
            $linha = substr($barra,0,4) . $dv . substr($barra,4);

            $agencia_codigo = $agencia." / ". $conta."-".$this->modulo_10($agencia.$conta);

            $dadosboleto["codigo_barras"] = $linha;
            $dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha); // verificar
            $dadosboleto["agencia_codigo"] = $agencia_codigo ;
            $dadosboleto["nosso_numero"] = $nossonumero;
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
                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = 'Multa de '.$par->IMB_PRM_COBBANMULTA.'% após vencimento';

                if( $par->IMB_PRM_COBMULTANDIAS <> '0' and $par->IMB_PRM_COBMULTANDIAS <> '')
                    $dadosboleto["instrucoes$nInstrucoes"] =
                    $dadosboleto["instrucoes$nInstrucoes"] .' - '.
                            'Após '.$par->IMB_PRM_COBMULTANDIAS.' dias de vencido, cobrar multa de '.
                        $par->IMB_PRM_COBMULTANDIASPER.'%';

            }

            if( $par->IMB_PRM_COBBANJUROSDIA <> '0' and $par->IMB_PRM_COBBANJUROSDIA <> '')
            {
                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = 'Após o vencimento juros de '.$par->IMB_PRM_COBBANJUROSDIA.'% ao dia';
                if( $par->IMB_PRM_COBBANCORRECAO <> '0' and $par->IMB_PRM_COBBANCORRECAO <> '')
                $dadosboleto["instrucoes$nInstrucoes"] =
                    $dadosboleto["instrucoes$nInstrucoes"] .', e '.
                            'Após o vencimento correção monetária de '.$par->IMB_PRM_COBBANCORRECAO.' % ao dia';
            }


            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode($dadosboleto["codigo_barras"], $generator::TYPE_INTERLEAVED_2_5);
            $nossonumero_email=$dadosboleto["nosso_numero"];
            $imovel_log = $ctr->IMB_IMV_ID;
            $contrato_log = $ctr->IMB_CTR_ID;

            if( $poremail == 'S' )
            {
                $email = $email.';'.env('APP_MAILBOLETOCOPIA');
                $array = explode(";",$email);
                foreach( $array as $a )
                {
                    $a=str_replace( ';','',$a);
                    $html = view('boleto.santander.boletosantander', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                    Mail::send('boleto.boletoemail', compact( 'dadosboleto', 'im','ctr', 'imv' ) ,
                    function( $message ) use ($a, $html,$nossonumero_email, $imovel_log, $contrato_log)
                    {

                        if( strlen( $a ) > 4 )
                        {
//                            $pdf=PDF::loadHtml( $html,'UTF-8');
  //                              $message->attachData($pdf->output(), $nossonumero_email.'.pdf');
    //                        $message->to( "suporte@compdados.com.br" );
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
                $html = view('boleto.santander.boletosantander', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
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

        $seqnn = intval($conta->FIN_CCI_NOSSONUMERO );
        $conta->FIN_CCI_NOSSONUMERO = $seqnn + 1;
        $conta->save();

        $nossonumero = $conta->FIN_CCI_NOSSONUMERO;
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

            $cgi = mdlCobrancaGeradaItem::where( 'IMB_CGR_ID','=', $cg->IMB_CGR_ID )->get();
            foreach( $cgi as $item)
            {
                $cgip = new mdlCobrancaGeradaItem;
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
            }


        return $cgp;

    }





    public function cnab240H7815()
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
                    '033'. // 1-3
                    '0000'. // 4-7
                    '0' . // 8-8
                    str_repeat(' ',8). //9-16
                    $cPessoaCEDENTE. // 17-17
                    '0'.
                    $cCGCCedente. //18-32
                    $this->formata_numero($conta->IMB_CCI_IDCLIENTEARQREM,10,0).//33-47
                    str_repeat(' ',25). //9-16
                    str_pad(substr($conta->FIN_CCI_CONCORNOME,0,30),30).//73-102
                    str_pad('BANCO SANTANDER',30).//103-132
                    str_repeat(' ',10).//133-142
                    '1'. //REMESSA CLIENTE -> BANCO               143-143
                    date( 'dmY' ). //144-151
                    str_repeat(' ',6). //152-157
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,6,0).//158-163
                    '040'. //164-166
                    str_repeat(' ', 74 ).chr(13).chr(10);

            $conteudo .=
                    '033'. //1-3
                    '0001'.//4-7
                    '1'. //8-8
                    'R'.//9-9
                    '01'.//10-11
                    str_repeat(' ',2). //12-13
                    '030'. //14-16
                    ' './/17-17
                    $cPessoaCEDENTE.//18-18
                    '0'.
                    $cCGCCedente.//19-33
                    str_repeat(' ',20).//34-53
                    $this->formata_numero($conta->IMB_CCI_IDCLIENTEARQREM,15,0).//54-68
                    str_repeat(' ',5). //69-73
                    str_pad(substr($conta->FIN_CCI_CONCORNOME,0,30),30). //74-103
                    str_repeat(' ',40). //104-143
                    str_repeat(' ',40). //144-183
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,8,0). //184-191
                    date('dmY'). //192-199
                    str_repeat(' ',41).chr(13).chr(10);


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
                $cpessoa = '2';
                if( strlen( $cCgc < 14  ) )
                    $cpessoa = '1';

                $cCgc = $this->formata_numero($cCgc,14,0);

                $cCepLt = $cg->IMV_CGR_CEP;
                $cCepLt = str_replace('.','',$cCepLt);
                $cCepLt = str_replace('-','',$cCepLt);
                $cCepLt = $this->formata_numero($cCepLt,8,0);


                $nValorLancamento   = 0;
                $nValAlu            = 0;
                $nValIPT            = 0;
                $nValCob            = 0;
                $nValBon            = 0;
                $nValorCondominio   = 0;
                $nValorFundoReserva = 0;
                $nValDes            = 0;
                $nValDiv            = 0;


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

                $conteudo .=    '033'.
                '0001'.
                '3'.
                $this->formata_numero($nSequencia,5,0). //009-013
                'P'. //14-14
                ' '. //15-15
                '01'.//16-17
                $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //18-21Agencia Mantenedora
                str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //22-22 DV Agencia
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,9,0).//23-31
                str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //32-32
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,9,0).//33-41
                str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //42-42
                str_repeat(' ',2). //43-44
                $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,12,0). //45-56
                $cp->IMB_CGR_NOSSONUMERODV. //57/57
                $tipocobranca.//58 -58tipo cobranca
                '1' .//59 - forma cadastramento
                '1' . //60Tipo documento  1=tradionlal  2 escritural
                ' '. //61
                ' '. //62
                str_pad( $cp->imb_cgr_id,15,' ' ).//63-77
                date('dmY', strtotime($cg->IMB_CGR_DATAVENCIMENTO )).//78-85
                $cValTot.                          //86-100
                str_repeat( '0', 4 ). //101-104
                '0'.  //105-105 dv aghencioa
                ' '.
                '17' . //107-108
                'N' . //109-109
                date( 'dmY' ).//110-117
                '3' . // 118-118 COBRAR JUROS
                str_repeat('0', 8 ). //119-126
                str_repeat('0', 15 ). //127-141
                $cTipoBon. //142-142   % desconto
                $cDatBon. //143-150
                $cValBon. //151-165
                str_repeat('0', 15 ) . //166-180   iof
                str_repeat('0', 15 ) . //181-195  valor abatimento
                str_pad($cp->imb_cgr_idpermanente,25,' ').//196-220
                '0' . // 221-221codigo protesto
                '00' . // 222-223 numero dias protesto
                '3' . //224-224  codigo baixa devbolução
                '0' . //225
                '00' . //226-227 numero dias devolução
                '00' . // 228-229  oeda
                str_repeat(' ',  11 ).chr(13).chr(10);

                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,1,40);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,15);
                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);

                $nSequencia++;
                $conteudo .=    '033'.
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
                str_repeat('0', 3 ) . //213-215
                str_repeat('0', 3 ) . //216-218
                str_repeat('0', 3 ) . //216-218
                str_repeat(' ', 19 ). //222-230
                chr(13).chr(10);

                $lLinhaRecSacado = 0;

                foreach( $itens as $item )
                {
                    $nValorLancamento = $item->IMB_LCF_VALOR;
                    if ($item->IMB_RLT_LOCATARIOCREDEB == 'C')
                         $nValorLancamento = $item->IMB_LCF_VALOR * -1;

                    $lLinhaRecSacado++;
                    $nSequencia++;
                    $nRegistroLote++;

                    $cEventoDesc =app('App\Http\Controllers\ctrRotinas')
                        ->evento( $item->IMB_TBE_ID);
                    $cEventoDesc = substr( $cEventoDesc->IMB_TBE_NOME,0,20);
                    $cValorLanc = number_format( $nValorLancamento,2,",",".");
                    $cValorLanc = str_pad( $cValorLanc,10,' ' );

                    $cObs = $item->IMB_LCF_OBSERVACAO;
                    $cObs = str_pad( substr( $cObs,0,67),67,' ');

                    $cDescricao = str_pad( str_pad( $cEventoDesc,20,' ').
                    'R$ '.$cValorLanc.'('.$cObs.')',219,' ');

                    $conteudo .=
                                    '033'.                               //001-003
                                    '0001'. //004-007
                                    '3'. //008-008
                                    $this->formata_numero($nSequencia,5,0). //009-013
                                    'S'. //14-14
                                    ' '. //15-15
                                    '01'.//16-17
                                    '1'.//18-18
                                    $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                    '4'. //21-21
                                    $cDescricao.
                                    chr(13).chr(10);

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

                                $lLinhaRecSacado++;
                                $nSequencia++;
                                $nRegistroLote++;
                                $conteudo .= '033'.                               //001-003
                                                   '0001' . //004-007
                                                   '3'. //008-008
                                                   $this->formata_numero($nSequencia,5,0 ). //009-013
                                                   'S'. //14-14
                                                   ' '. //15-15
                                                   '01'.//16-17
                                                   '1'.//18-18
                                                   $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                   '4'. //21-21
                                                   str_repeat(' ',100 ).
                                                   str_repeat(' ', 119 ).
                                                   chr(13).chr(10);


                                                   $lLinhaRecSacado++;
                                                   $nSequencia++;
                                                   $nRegistroLote++;
                                                   $conteudo .= '033'.                               //001-003
                                                                      '0001' . //004-007
                                                                      '3'. //008-008
                                                                      $this->formata_numero($nSequencia,5,0 ). //009-013
                                                                      'S'. //14-14
                                                                      ' '. //15-15
                                                                      '01'.//16-17
                                                                      '1'.//18-18
                                                                      $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                                      '4'. //21-21
                                                                      $cNaoReceber.
                                                                      chr(13).chr(10);

                                $lLinhaRecSacado++;
                                $nSequencia++;
                                $nRegistroLote++;
                                $conteudo .= '033'.                               //001-003
                                                     '0001' . //004-007
                                                   '3'. //008-008
                                                   $this->formata_numero($nSequencia,5,0 ). //009-013
                                                   'S'. //14-14
                                                   ' '. //15-15
                                                   '01'.//16-17
                                                   '1'.//18-18
                                                   $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                   '4'. //21-21
                                                   $cJurosMes.
                                                   chr(13).chr(10);


/*                                $lLinhaRecSacado++;
                                $nSequencia++;
                                $nRegistroLote++;
                                $conteudo .= '033'.                               //001-003
                                                     '0001' . //004-007
                                                   '3'. //008-008
                                                   $this->formata_numero($nSequencia,5,0 ). //009-013
                                                   'S'. //14-14
                                                   ' '. //15-15
                                                   '01'.//16-17
                                                   '1'.//18-18
                                                   $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                   '4'. //21-21
                                                   $cCorrecao.
                                                   chr(13).chr(10);

  */
    }
    $nSequencia++;
    $nTotalFat++;

    $nRegistroLote++;
    $nSequencia++;
    $conteudo .=  '033'.
                  '0001'. //004-007
                  '5'. //008-008
                  str_repeat(' ', 9 ). //09-17
                  $this->formata_numero($nSequencia,6,0 ). //018-23
                  str_repeat(' ', 217 ).
                  chr(13).chr(10);

    $nSequencia++;
    $conteudo .=  '033'.
              '9999'. //004-007
              '9' . //008-008
              '         '. //009-017
              '000001'.//18-23
              $this->formata_numero($nSequencia+1,6,0 ). //24-29
              str_repeat( ' ', 211 ).
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




    public function cnab400()
    {
        $empresa=Auth::user()->IMB_IMB_ID;
        $pasta='/files/'.$empresa;
        $filename = 'cnab400.txt';

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
                    '0'.
                    '1'.
                    'REMESSA'.
                    '01' . 
                    'COBRANCA       '.
                    str_pad($conta->IMB_CCI_IDCLIENTEARQREM,20,' ').
                    str_pad(substr($conta->FIN_CCI_CONCORNOME,0,30),30).
                    '033'.
                    str_pad('SANTANDER',15,' '). //9-16
                    date('dmy').
                    str_repeat( '0',16 ).
                    str_repeat( '0',275 ).
                    '000'.
                    '000001'.chr(13).chr(10);



            $conteudo .=
                    '033'. //1-3
                    '0001'.//4-7
                    '1'. //8-8
                    'R'.//9-9
                    '01'.//10-11
                    str_repeat(' ',2). //12-13
                    '030'. //14-16
                    ' './/17-17
                    $cPessoaCEDENTE.//18-18
                    '0'.
                    $cCGCCedente.//19-33
                    str_repeat(' ',20).//34-53
                    $this->formata_numero($conta->IMB_CCI_IDCLIENTEARQREM,15,0).//54-68
                    str_repeat(' ',5). //69-73
                    str_pad(substr($conta->FIN_CCI_CONCORNOME,0,30),30). //74-103
                    str_repeat(' ',40). //104-143
                    str_repeat(' ',40). //144-183
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,8,0). //184-191
                    date('dmY'). //192-199
                    str_repeat(' ',41).chr(13).chr(10);


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
                $cpessoa = '2';
                if( strlen( $cCgc < 14  ) )
                    $cpessoa = '1';

                $cCgc = $this->formata_numero($cCgc,14,0);

                $cCepLt = $cg->IMV_CGR_CEP;
                $cCepLt = str_replace('.','',$cCepLt);
                $cCepLt = str_replace('-','',$cCepLt);
                $cCepLt = $this->formata_numero($cCepLt,8,0);


                $nValorLancamento   = 0;
                $nValAlu            = 0;
                $nValIPT            = 0;
                $nValCob            = 0;
                $nValBon            = 0;
                $nValorCondominio   = 0;
                $nValorFundoReserva = 0;
                $nValDes            = 0;
                $nValDiv            = 0;


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

                $conteudo .=    '033'.
                '0001'.
                '3'.
                $this->formata_numero($nSequencia,5,0). //009-013
                'P'. //14-14
                ' '. //15-15
                '01'.//16-17
                $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //18-21Agencia Mantenedora
                str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //22-22 DV Agencia
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,9,0).//23-31
                str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //32-32
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,9,0).//33-41
                str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //42-42
                str_repeat(' ',2). //43-44
                $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,12,0). //45-56
                $cp->IMB_CGR_NOSSONUMERODV. //57/57
                $tipocobranca.//58 -58tipo cobranca
                '1' .//59 - forma cadastramento
                '1' . //60Tipo documento  1=tradionlal  2 escritural
                ' '. //61
                ' '. //62
                str_pad( $cp->imb_cgr_id,15,' ' ).//63-77
                date('dmY', strtotime($cg->IMB_CGR_DATAVENCIMENTO )).//78-85
                $cValTot.                          //86-100
                str_repeat( '0', 4 ). //101-104
                '0'.  //105-105 dv aghencioa
                ' '.
                '17' . //107-108
                'N' . //109-109
                date( 'dmY' ).//110-117
                '3' . // 118-118 COBRAR JUROS
                str_repeat('0', 8 ). //119-126
                str_repeat('0', 15 ). //127-141
                $cTipoBon. //142-142   % desconto
                $cDatBon. //143-150
                $cValBon. //151-165
                str_repeat('0', 15 ) . //166-180   iof
                str_repeat('0', 15 ) . //181-195  valor abatimento
                str_pad($cp->imb_cgr_idpermanente,25,' ').//196-220
                '0' . // 221-221codigo protesto
                '00' . // 222-223 numero dias protesto
                '3' . //224-224  codigo baixa devbolução
                '0' . //225
                '00' . //226-227 numero dias devolução
                '00' . // 228-229  oeda
                str_repeat(' ',  11 ).chr(13).chr(10);

                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,1,40);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,15);
                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);

                $nSequencia++;
                $conteudo .=    '033'.
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
                str_repeat('0', 3 ) . //213-215
                str_repeat('0', 3 ) . //216-218
                str_repeat('0', 3 ) . //216-218
                str_repeat(' ', 19 ). //222-230
                chr(13).chr(10);

                $lLinhaRecSacado = 0;

                foreach( $itens as $item )
                {
                    $nValorLancamento = $item->IMB_LCF_VALOR;
                    if ($item->IMB_RLT_LOCATARIOCREDEB == 'C')
                         $nValorLancamento = $item->IMB_LCF_VALOR * -1;

                    $lLinhaRecSacado++;
                    $nSequencia++;
                    $nRegistroLote++;

                    $cEventoDesc =app('App\Http\Controllers\ctrRotinas')
                        ->evento( $item->IMB_TBE_ID);
                    $cEventoDesc = substr( $cEventoDesc->IMB_TBE_NOME,0,20);
                    $cValorLanc = number_format( $nValorLancamento,2,",",".");
                    $cValorLanc = str_pad( $cValorLanc,10,' ' );

                    $cObs = $item->IMB_LCF_OBSERVACAO;
                    $cObs = str_pad( substr( $cObs,0,67),67,' ');

                    $cDescricao = str_pad( str_pad( $cEventoDesc,20,' ').
                    'R$ '.$cValorLanc.'('.$cObs.')',219,' ');

                    $conteudo .=
                                    '033'.                               //001-003
                                    '0001'. //004-007
                                    '3'. //008-008
                                    $this->formata_numero($nSequencia,5,0). //009-013
                                    'S'. //14-14
                                    ' '. //15-15
                                    '01'.//16-17
                                    '1'.//18-18
                                    $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                    '4'. //21-21
                                    $cDescricao.
                                    chr(13).chr(10);

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

                                $lLinhaRecSacado++;
                                $nSequencia++;
                                $nRegistroLote++;
                                $conteudo .= '033'.                               //001-003
                                                   '0001' . //004-007
                                                   '3'. //008-008
                                                   $this->formata_numero($nSequencia,5,0 ). //009-013
                                                   'S'. //14-14
                                                   ' '. //15-15
                                                   '01'.//16-17
                                                   '1'.//18-18
                                                   $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                   '4'. //21-21
                                                   str_repeat(' ',100 ).
                                                   str_repeat(' ', 119 ).
                                                   chr(13).chr(10);


                                                   $lLinhaRecSacado++;
                                                   $nSequencia++;
                                                   $nRegistroLote++;
                                                   $conteudo .= '033'.                               //001-003
                                                                      '0001' . //004-007
                                                                      '3'. //008-008
                                                                      $this->formata_numero($nSequencia,5,0 ). //009-013
                                                                      'S'. //14-14
                                                                      ' '. //15-15
                                                                      '01'.//16-17
                                                                      '1'.//18-18
                                                                      $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                                      '4'. //21-21
                                                                      $cNaoReceber.
                                                                      chr(13).chr(10);

                                $lLinhaRecSacado++;
                                $nSequencia++;
                                $nRegistroLote++;
                                $conteudo .= '033'.                               //001-003
                                                     '0001' . //004-007
                                                   '3'. //008-008
                                                   $this->formata_numero($nSequencia,5,0 ). //009-013
                                                   'S'. //14-14
                                                   ' '. //15-15
                                                   '01'.//16-17
                                                   '1'.//18-18
                                                   $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                   '4'. //21-21
                                                   $cJurosMes.
                                                   chr(13).chr(10);


/*                                $lLinhaRecSacado++;
                                $nSequencia++;
                                $nRegistroLote++;
                                $conteudo .= '033'.                               //001-003
                                                     '0001' . //004-007
                                                   '3'. //008-008
                                                   $this->formata_numero($nSequencia,5,0 ). //009-013
                                                   'S'. //14-14
                                                   ' '. //15-15
                                                   '01'.//16-17
                                                   '1'.//18-18
                                                   $this->formata_numero($lLinhaRecSacado,2,0 ). //19-20
                                                   '4'. //21-21
                                                   $cCorrecao.
                                                   chr(13).chr(10);

  */
    }
    $nSequencia++;
    $nTotalFat++;

    $nRegistroLote++;
    $nSequencia++;
    $conteudo .=  '033'.
                  '0001'. //004-007
                  '5'. //008-008
                  str_repeat(' ', 9 ). //09-17
                  $this->formata_numero($nSequencia,6,0 ). //018-23
                  str_repeat(' ', 217 ).
                  chr(13).chr(10);

    $nSequencia++;
    $conteudo .=  '033'.
              '9999'. //004-007
              '9' . //008-008
              '         '. //009-017
              '000001'.//18-23
              $this->formata_numero($nSequencia+1,6,0 ). //24-29
              str_repeat( ' ', 211 ).
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
