<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaItemPerm;
use DataTables;
        
use App\mdlImobiliaria;
use App\mdlContrato;
use App\mdlLocatarioContrato;
use App\mdlImovel;
use App\mdlCliente;
use App\mdlParametros;
use App\mdlContaCaixa;
use PDF;
use Picqer;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Illuminate\Support\Facades\URL;
use SplFileObject;
use Log;

class ctrClienteBoleto756 extends Controller
{


    public function index( $id, $imb )
    {



        $cp = mdlCobrancaGeradaPerm::find( $id );
        $cpi = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=',$id)->get();
        $par = mdlParametros::find( $cp->IMB_IMB_ID );
        $ctr = mdlContrato::find( $cp->IMB_CTR_ID);
        
        //dd( $email );


        if( $cp ) 
        {
            $im = mdlImobiliaria::find( $ctr->IMB_IMB_ID );
            $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
            $par = mdlParametros::find( $cp->IMB_IMB_ID);
            $ctr = mdlContrato::find( $cp->IMB_CTR_ID);



            // DADOS DO BOLETO PARA O SEU CLIENTE
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
            


                $html = view('boleto.756.boleto756', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                $pdf=PDF::loadHtml( $html,'UTF-8');
                //$pdf->setPaper('A4', 'portrait');
//                dd('aqui');
                return $pdf->stream('boleto'.$nossonumero.'.pdf');


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
    
}   