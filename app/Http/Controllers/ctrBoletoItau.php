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
use App\mdlTmpPlanilhaDeposito;
use App\mdlPropImovel;

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



class ctrBoletoItau extends Controller
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


        if( $cp )
        {
            $ctr = mdlContrato::find( $cp->IMB_CTR_ID );
            $im = mdlImobiliaria::find( $ctr->IMB_IMB_ID );
            $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
            $par = mdlParametros::find( $ctr->IMB_IMB_ID );

            // DADOS DO BOLETO PARA O SEU CLIENTE
            $dias_de_prazo_para_pagamento = 5;
            $taxa_boleto = 0;
            $data_venc = date('d/m/Y',strtotime( $cp->IMB_CGR_DATALIMITE ) );

            //$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
            $valor_cobrado = $cp->IMB_CGR_VALOR; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
            $valor_boleto= number_format($valor_cobrado, 2, ',', '');
            $dadosboleto["IMB_CGR_ID"] = $id;
            $dadosboleto["FIN_CCI_BANCONUMERO"] = "341";

            $dadosboleto["nosso_numero"] = $cp->IMB_CGR_NOSSONUMERO;  // Nosso numero - REGRA: M�ximo de 8 caracteres!
            $dadosboleto["numero_documento"] = $cp->IMB_CTR_ID;	// Num do pedido ou nosso numero
            $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
            $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
            $dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
            $dadosboleto["valor_boleto_impresso"] = number_format($valor_cobrado, 2, ',', '.');; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

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


            // DADOS DA SUA CONTA - ITA�
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

            $codigobanco = "341";
            $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
            $nummoeda = "9";
            $fator_vencimento = $this->fator_vencimento($dadosboleto["data_vencimento"]);

            //valor tem 10 digitos, sem virgula
            $valor = $this->formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
            //agencia � 4 digitos
            $agencia = $this->formata_numero($dadosboleto["agencia"],4,0);
            //conta � 5 digitos + 1 do dv
            $conta = $this->formata_numero($dadosboleto["conta"],5,0);
            $conta_dv = $this->formata_numero($dadosboleto["conta_dv"],1,0);
            //carteira 175
            $carteira = $dadosboleto["carteira"];
            //nosso_numero no maximo 8 digitos
            $nnum = $this->formata_numero($dadosboleto["nosso_numero"],8,0);

            if( $carteira == '112' )
               $codigo_barras = $codigobanco.$nummoeda.$fator_vencimento.$valor.$carteira.$nnum.$this->modulo_10($carteira.$nnum).$agencia.$conta.$this->modulo_10($agencia.$conta).'000';
            else
               $codigo_barras = $codigobanco.$nummoeda.$fator_vencimento.$valor.$carteira.$nnum.$this->modulo_10($agencia.$conta.$carteira.$nnum).$agencia.$conta.$this->modulo_10($agencia.$conta).'000';
            // 43 numeros para o calculo do digito verificador
            $dv = $this->digitoVerificador_barra($codigo_barras);
            // Numero para o codigo de barras com 44 digitos
            $linha = substr($codigo_barras,0,4).$dv.substr($codigo_barras,4,43);
            if ( $carteira == '112')
               $nossonumero = $carteira.'/'.$nnum.'-'.$this->modulo_10($carteira.$nnum);
            else
               $nossonumero = $carteira.'/'.$nnum.'-'.$this->modulo_10($agencia.$conta.$carteira.$nnum);

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
                //CALCULAR VALOR DA MULTA
                $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permanente' );

                
                $valormuta = round($basemultajuros['multa'] * $par->IMB_PRM_COBBANMULTA/100,2);

                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = 'Após '.date( 'd/m/Y',strtotime($cp->IMB_CGR_DATALIMITE) ).' Multa de R$ '.number_format($valormuta, 2, ',', '.').' após vencimento';

/*                if( $par->IMB_PRM_COBMULTANDIAS <> '0' and $par->IMB_PRM_COBMULTANDIAS <> '')
                {
                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permanente' );
                    $valormuta = round($basemultajuros['multa'] * $par->IMB_PRM_COBMULTANDIASPER/100,2);
    
                    $dadosboleto["instrucoes$nInstrucoes"] =
                    $dadosboleto["instrucoes$nInstrucoes"] .' - '.
                           'Após '.$par->IMB_PRM_COBMULTANDIAS.' dias de vencido, cobrar multa adicional de '.
                            'R$ '.number_format($par->IMB_PRM_COBMULTANDIASPER, 2, ',', '.');
                }
*/
            }



            if( $par->IMB_PRM_COBBANJUROSDIA <> '0' and $par->IMB_PRM_COBBANJUROSDIA <> '')
            {

                $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permanente' );
                $valorjuros = round($basemultajuros['juros'] * $par->IMB_PRM_COBBANJUROSDIA/100,2);

                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = 'Após '.date( 'd/m/Y',strtotime($cp->IMB_CGR_DATALIMITE) ).'  juros de R$ '.number_format($valorjuros, 2, ',', '.').' ao dia';
                if( $par->IMB_PRM_COBBANCORRECAO <> '0' and $par->IMB_PRM_COBBANCORRECAO <> '')
                $dadosboleto["instrucoes$nInstrucoes"] =
                    $dadosboleto["instrucoes$nInstrucoes"] .', e '.
                            'Após o vencimento correção monetária de R$ '.number_format($valorjuros, 2, ',', '.').' ao dia';
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
                $banconumber='itau';
                $email = $email;
                $array = explode(";",$email);
                foreach( $array as $a )
                {
                    $a=str_replace( ';','',$a);
                    $html = view('boleto.341.boleto341', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                    try
                    {

                    Mail::send('boleto.boletoemail', compact( 'dadosboleto', 'im','ctr', 'imv','banconumber' ) ,

                    function( $message ) use ($a, $html,$nossonumero_email, $imovel_log, $contrato_log)
                    {
                        if( $a <>'' and filter_var($a, FILTER_VALIDATE_EMAIL))
                        {
                            Log::info( 'Enviando para: '.$a );
                            //$pdf=PDF::loadHtml( $html,'UTF-8');
                              //  $message->attachData($pdf->output(), $nossonumero_email.'.pdf');
//                        $message->to( "suporte@compdados.com.br" );
                            $message->to( $a  );
                            $message->subject('Aviso de vencimento de aluguel');
                        }
                        app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Boleto enviado para '.$a);
    
                    });
                    Log::info( 'Enviado para: '.$a );

                    }
                    
                    catch (\Illuminate\Database\QueryException $e) {
                        app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Erro ao enviar boleto por email '.$a);
                    }                    


                }
                //echo "<script>window.close();</script>";
                return response()->json('ok',200);
            }
            else
            {
                $html = view('boleto.341.boleto341', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
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
        $digito = 11 - $resto2;
         if ($digito == 0 || $digito == 1 || $digito == 10  || $digito == 11) {
            $dv = 1;
         } else {
            $dv = $digito;
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
        for($f1=9;$f1>=0;$f1--)
        {
            for($f2=9;$f2>=0;$f2--)
            {
            $f = ($f1 * 10) + $f2 ;
            $texto = "" ;
            for($i=1;$i<6;$i++)
            {
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
        if((strlen($texto) % 2) <> 0)
        {
            $texto = "0" . $texto;
        }

        // Draw dos dados
        while (strlen($texto) > 0)
        {
            $i = round(esquerda($texto,2));
            $texto = $this->direita($texto,strlen($texto)-2);
            $f = $barcodes[$i];
            for($i=1;$i<11;$i+=2)
            {
                if (substr($f,($i-1),1) == "0")
                {
                    $f1 = $fino ;
                }else
                {
                $f1 = $largo ;
                }
        ?>
                src=imagens/p.png width=<?php echo $f1?> height=<?php echo $altura?> border=0><img
        <?php
                if (substr($f,$i,1) == "0")
                {
                    $f2 = $fino ;
                }
                else
                {
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
            for ($i = strlen($num); $i > 0; $i--)
            {
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
                if ($fator == 2)
                {
                    $fator = 1;
                }
                else
                {
                    $fator = 2; // intercala fator de multiplicacao (modulo 10)
                }
            }

            // v�rias linhas removidas, vide fun��o original
            // Calculo do modulo 10
            $resto = $numtotal10 % 10;
            $digito = 10 - $resto;
            if ($resto == 0)
            {
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
            if ($fator == $base)
            {
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

    // Alterada por Glauber Portella para especifica��o do Ita�
    public function monta_linha_digitavel($codigo)
    {
            // campo 1
        $banco    = substr($codigo,0,3);
        $moeda    = substr($codigo,3,1);
        $ccc      = substr($codigo,19,3);
        $ddnnum   = substr($codigo,22,2);
        $dv1      = $this->modulo_10($banco.$moeda.$ccc.$ddnnum);
            // campo 2
        $resnnum  = substr($codigo,24,6);
        $dac1     = substr($codigo,30,1);//modulo_10($agencia.$conta.$carteira.$nnum);
        $dddag    = substr($codigo,31,3);
        $dv2      = $this->modulo_10($resnnum.$dac1.$dddag);
            // campo 3
        $resag    = substr($codigo,34,1);
        $contadac = substr($codigo,35,6); //substr($codigo,35,5).modulo_10(substr($codigo,35,5));
        $zeros    = substr($codigo,41,3);
        $dv3      = $this->modulo_10($resag.$contadac.$zeros);
            // campo 4
        $dv4      = substr($codigo,4,1);
            // campo 5
        $fator    = substr($codigo,5,4);
        $valor    = substr($codigo,9,10);

        $campo1 = substr($banco.$moeda.$ccc.$ddnnum.$dv1,0,5) . '.' . substr($banco.$moeda.$ccc.$ddnnum.$dv1,5,5);
        $campo2 = substr($resnnum.$dac1.$dddag.$dv2,0,5) . '.' . substr($resnnum.$dac1.$dddag.$dv2,5,6);
        $campo3 = substr($resag.$contadac.$zeros.$dv3,0,5) . '.' . substr($resag.$contadac.$zeros.$dv3,5,6);
        $campo4 = $dv4;
        $campo5 = $fator.$valor;

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    public function geraCodigoBanco($numero)
    {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }


    function abastecerPermanente( $cg, $arquivo )
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
        $cgp->IMB_CGR_NOMEARQUIVO = $arquivo;
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
                    $lf->save();

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

        Log::info('padrao antigo');

        $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );

        if( $cgs <> '[]')
        {
            $conta = mdlContaCaixa::find( $cgs[0]->FIN_CCR_ID );
            $seqarq = $conta->FIN_CCI_COBRANCAARQSEQ;
            $conta->FIN_CCI_COBRANCAARQSEQ = intval( $seqarq )+1;
            $conta->save();

            $cToleranciaBoleto = '21';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 10  )
                $cToleranciaBoleto = '20';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 5 )
                $cToleranciaBoleto = '19';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 15  )
                $cToleranciaBoleto = '21';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 20  )
                $cToleranciaBoleto = '22';

            if ( $par->IMB_PRM_COBBANTOLERANCIA == 30 )
                $cToleranciaBoleto = '24';


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


            $conteudo .= '0'.   //001-001
                        '1'. // 002-002
                        'REMESSA'. //003-009
                        '01'.  //010-011
                        'COBRANCA       '. //12-26
                        $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //27-30
                        '00' . //31-32
                        $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,5,0).//33-37
                        str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //38-38
                        str_repeat(' ',8).//39-46
                        substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30).//47-76
                        '341'. //77-79
                        str_pad('BANCO ITAU SA',15,' ').
                        date( 'dmy' ).
                        str_repeat(' ',294).
                        '000001'.chr(13).chr(10);;


            $nSequencia     = 1;
            $nTotalFat      = 1;
            $nTotalFatVal   = 0;
            $nTitulos       = 0;
            $nSeqLote       =0;

            foreach( $cgs as $cg )
            {

                $cp = $this->abastecerPermanente( $cg, $filename );

                $cCgc = $cg->IMB_CGR_CPF;
                $cCgc = str_replace('.','',$cCgc);
                $cCgc = str_replace('-','',$cCgc);
                $cCgc = str_replace('/','',$cCgc);

                $clt = mdlCliente::where('IMB_CLT_CPF','=', $cCgc )->first();
                if( $clt )
                {
                    if( $clt->IMB_CLT_PESSOA == 'J')
                        $cpessoa = '02';
                    else
                        $cpessoa = '01';

                }

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
                $nValIRRF            =0;


                $itens = app('App\Http\Controllers\ctrCobrancaGerada')
                ->cargaItensSemJson( $cg->IMB_CGR_ID );
                $nSeqLote++;

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


                    $cobrarjuros = '1';
                    $cvaljuros = $valorjuros * 100;
                    $cvaljuros = $this->formata_numero( intval($cvaljuros),13,0);

                    $cdatajuros =$dataencargos;
                    //$cdatajuros = date( $cdatajuros, strtotime( '+1 day' ));
                }
                else
                {
                    $cobrarjuros = '0';
                    $nTaxaJurosMes = 0;
                    $cvaljuros =  str_repeat('0',13);
                    $cdatajuros = str_repeat('0',10);

                }



                if( $par->IMB_PRM_COBBANMULTA <> 0 and $par->IMB_PRM_COBBANMULTA <> null )
                {

                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permamente' );
                    $valormulta = round($basemultajuros['multa'] * $par->IMB_PRM_COBBANMULTA/100,2);
   

                    $cobrarmulta = '1';
                    $cmulta = $valormulta * 100;
                    $cmulta = $this->formata_numero( intval($cmulta),13,0);
                    $cdatamulta =$dataencargos;
                }
                else
                {
                    $cobrarmulta = '0';
                    $cmulta = str_repeat( '0',13 );
                    $cdatamulta = str_repeat( '0',10 );

                }



                $cDatBon = '000000';
                $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                $cValBon = $this->formata_numero( intval($cValBon),13,0);
                if( $cg->IMB_CGR_VALORPONTUALIDADE <> 0 )
                {
                    $cDatBon = date('dmy',strtotime($cg->IMB_CGR_DATAVENCIMENTO));
                    $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                    $cValBon = $this->formata_numero( intval($cValBon),13,0);
                }

 //               dd( "cDatBon $cDatBon -  cValBon: $cValBon - cTipoBon: $cTipoBon");

                $cValTot = $cg->IMB_CGR_VALOR*100;
                $cValTot = $this->formata_numero( intval($cValTot),13,0);

                //$conteudo .= "nossonumero ".$cp->IMB_CGR_NOSSONUMERO.chr(13).chr(10);
                //$conteudo .= 'Pontualidade '.$nValBon.' até: '.$cDatBon.chr(13).chr(10);

                $nossonumero = $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,8,0);

                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,0,30);
                $cdestinatario=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cdestinatario);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cEndereco =app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cEndereco);
                
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,12);
                $cbairro=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cbairro);

                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);
                $ccidade=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($ccidade);


                $dataLimite  = 
                $nSequencia++;
                $conteudo .= '1'. //001-001
                    '02'. //002-003
                    $cCGCCedente. //004-017
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //018-021
                     '00'.
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,5,0).//024-28
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //029-029
                    str_repeat(' ', 4 ). //030-033
                    str_repeat('0',4 ).//034-37
                    str_pad( $cp->IMB_CGR_ID, 25,' ' ). //38-62
                    $nossonumero.
                    str_repeat('0',13).//replicate('0',13 )+//071-083
                    str_pad( $conta->FIN_CCI_COBRANCACARTEIRA,'0',3 ).//084-086
                    str_repeat(' ',21 ) . //087-107
                    'I' . //108/108
                    '01'.//109-110
                    $this->formata_numero($cp->IMB_CGR_ID,10,0 ).//111-120
                    date('dmy', strtotime($cg->IMB_CGR_DATALIMITE )).//0121-126
                    $cValTot.//127-139
                    '341'. //140+142
                    str_repeat('0', 5 ) . //143-147
                    '01'. //148-149
                    'N'. //150-150
                    date('dmy'). //151-156
                    $cToleranciaBoleto.
                    '00'.  //159-160  NÃO RECEBER APOS VENCIMENTO
                    $cvaljuros. //161-173
                    $cDatBon. //174-179
                    $cValBon. //180-192
                    str_repeat('0', 13 ). //193-205
                    str_repeat('0', 13 ). //206-218
                    $cpessoa. //219-220
                    $cCgc. //221-234
                    str_pad($cdestinatario,30,' '). //235-264
                    str_repeat(' ', 10 ). //265-274
                    str_pad($cEndereco,40,' '). //275-314
                    str_pad($cbairro,12,' ' ). //166-177
                    $cCepLt. //327-334
                    str_pad($ccidade,15,' ').//335-349
                    str_pad($cg->CEP_UF_SIGLA,2,'X').//350-351
                    str_repeat(' ', 30 ). //352-381
                    str_repeat(' ', 4 ). //382-385
                    date( 'dmy' ).//386-391
                    $this->formata_numero( $par->IMB_PRM_COBBANTOLERANCIA,2,0). //392-393
                    ' '. //394-394
                    $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);

            }

            $nSequencia++;
            $conteudo .='2'.//001-001
                      '1'. //002-002
                      date('dmY', strtotime($cg->IMB_CGR_DATAVENCIMENTO )). //003-010
                      $cmulta .
                      str_repeat(' ', 371 ).
                      $this->formata_numero( $nSequencia,6,0 ).
                      chr(13).chr(10);

            $nSequencia++;

            $conteudo .='9'.
                str_repeat(' ', 393 ).
                $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);;



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

    public function remessaPagamentos( Request $request )
    {
        $idconta = $request->FIN_CCX_ID;

        $contacaixa = mdlContaCaixa::find( $idconta);

        $imob = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );

        $cCpf = $contacaixa->FIN_CCI_CGCCPF;
        $cCpf = str_replace('.','',$cCpf);
        $cCpf = str_replace('-','',$cCpf);
        $cCpf = str_replace('/','',$cCpf);
        $cCpf = trim( $cCpf );

        if( strlen( $cCpf ) > 11 ) 
            $cTipoInscricao = '2';
        else
            $cTipoInscricao ='1';

        $cCep = str_replace( '.','',$imob->IMB_IMB_CEP);
        $cCep = str_replace( ',-','', $cCep);

        $texto = 
            $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).//1-3
            '0000'. //4-7
            '0'.  //8-8
            str_repeat(' ',6 ). //9-14
            '080'. //15-17
            $cTipoInscricao. //18-18
            $this->formata_numero( $cCpf,14,'0'). //19-32
            str_repeat( ' ', 20 ). //33-52
            $this->formata_numero( $contacaixa->FIN_CCI_AGENCIANUMERO,5,0).//53-57
            ' '. //58-58
            $this->formata_numero( $contacaixa->FIN_CCI_CONCORNUMERO,12,0).     //59-70
            ' '. //71-71
            str_pad( trim( $contacaixa->FIN_CCI_CONCORDIGITO),1, ' '). //72-72
            str_pad( substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($contacaixa->FIN_CCI_CONCORNOME),0,30),30,' ').//73-102
            str_pad( 'BANCO ITAU', 30, ' ' ).//103-132
            str_repeat(' ', 10 ). //133-142
            '1' . //143-143
            date( 'dmY' ) . //144-151
            date( 'his' ) . //152-157
            $this->formata_numero( $contacaixa->FIN_CCX_DOCSEQUENCIA,9,0).//158 - 166
            str_repeat('0', 5 ). //167-171
            str_repeat(' ', 69 ).//172-240
            chr(13).chr(10);



        $nRegistrosLote = 1;
        // Gravando o Header do Lote

        $texto .=  $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).//1-3
            '0001'. //4-7
            '1'.  //8-8
            'C'. //9-9 
            '20'. //10-11
            '41'. //12-13
            '040'. //14/16
            ' '. //17-17
            $cTipoInscricao. //18-18
            $this->formata_numero( $cCpf,14,0). //19-32
            str_repeat(' ', 4 ) . //33-36
            str_repeat( ' ', 16 ). //37-52
            $this->formata_numero( $contacaixa->FIN_CCI_AGENCIANUMERO,5,0).//53-57
            ' './/58-58
            $this->formata_numero( $contacaixa->FIN_CCI_CONCORNUMERO,12,0).     //59-70
            ' '. //71-71
            str_pad( $contacaixa->FIN_CCI_CONCORDIGITO,1,' ').
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($contacaixa->FIN_CCI_CONCORNOME),0,30),30,' '). //73-102
            str_repeat(' ', 30 ). //103-132
            str_repeat(' ', 10 ). //133-142
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECO),0,30), 30,' ' ).
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECONUMERO),0,5),5,' ').//173-177
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECOCOMPLEMENTO),0,15),15,' '). //178-192
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->CEP_CID_NOME),0,20),20,' '). //193-212
            $this->formata_numero( $cCep,8,0). //213-220
            str_pad( $imob->CEP_UF_SIGLA,2,0). //221-222
            str_repeat(' ',  8 ).//223-230
            str_repeat(' ', 10 ). //231-240 
            chr(13).chr(10);

            $tmp = mdlTmpPlanilhaDeposito::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
            ->where( 'SELECIONADO','=','S' )
            ->where( 'GER_BNC_NUMERO','<>', '341' )
            ->orderBy( 'IMB_RLD_DATAPAGAMENTO')
            ->orderBy( 'FAVORECIDO' )
            ->get();

            $nTotalFat          = 0;
            $nTotalFatVal       = 0;
            $nSequencia         = 2;
            $nSequenciaDet      = 0;
            foreach ($tmp as $item) 
            {
               //Posicionando sobre a conta corrente do imóvel
               $inconsistencia='';

                $cNumeroBanco = '000';
                if( $item->GER_BNC_NUMERO== '' )
                    $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' sem banco ';
                else
                    $cNumeroBanco = $this->formata_numero( $item->GER_BNC_NUMERO,3,0);
     
                $cNumeroAgencia = '00000';
                if( $item->GER_BNC_AGENCIA == '' )
                    $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' Sem Agencia ';
                else
                    $cNumeroAgencia =$this->formata_numero( $item->GER_BNC_AGENCIA,5,0);
      
                $cNumeroContaCorrente = '000000000000';
                if( $item->IMB_CLTCCR_NUMERO == '' )
                    $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' Sem C/C ';
                else
                    $cNumeroContaCorrente = $this->formata_numero( $item->IMB_CLTCCR_NUMERO,12,0);

                $cValorDoc = $item->TOTALRECIBO * 100;
                $cValorDoc = $this->formata_numero( intval($cValorDoc),15,0);

                $nTotalFat =  $nTotalFat + intval( $cValorDoc );
                $nTotalFatVal =  $nTotalFatVal +intval( $cValorDoc );

                $cpfclt = $item->IMB_CLT_CPF;
                $cpfclt = str_replace('.','',$cpfclt);
                $cpfclt = str_replace('-','',$cpfclt);
                $cpfclt = str_replace('/','',$cpfclt);
                $cpfclt = trim( $cpfclt );
        
                $cpfccrclt = $item->IMB_CLTCCR_CPF;
                $cpfccrclt = str_replace('.','',$cpfccrclt);
                $cpfccrclt = str_replace('-','',$cpfccrclt);
                $cpfccrclt = str_replace('/','',$cpfccrclt);
                $cpfccrclt = trim( $cpfccrclt );
        
      
                if( $cpfclt == '' and $cpfccrclt == '' )
                    $inconsistencia .= 'Proprietario '.$item->IMB_CLT_NOME.' Sem CPF';
                else
                {
                    $cCpf = $cpfccrclt;
                    if( $item->IMB_CLTCCR_CPF == '' )
                        $cCpf = $cpfclt;
                }

                if( strlen( $cCpf) == 11)
                     $cCpf = '000'.$cCpf;
                if( strlen( $cCpf) == 10)
                     $cCpf = '0000'.$cCpf;
                  
                $nSequencia             = $nSequencia + 1;
                $nRegistrosLote         = $nRegistrosLote + 1;
                $nSequenciaDet          = $nSequenciaDet  + 1;
                     
                $texto .=
                $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).
                    '0001'. //4-8  Lote de Serviço
                    '3' . //8-8
                    $this->formata_numero( $nSequenciaDet,5,0 ). //9-13
                    'A'. //14-14
                    '000' . //15-17
                    '000'.
                    $cNumeroBanco;

            if  ( $item->GER_BNC_NUMERO == '341'  or  $item->GER_BNC_NUMERO == '409' )
                $texto .=
                        '0' .
                        $cNumeroAgencia. //25-28
                        ' '. //29-29
                        str_repeat( '0', 6 ) . //30-35
                        $this->formata_numero($item->IMB_CLTCCR_NUMERO,6,0). // 36-41
                        ' '. //42-42
                        str_pad(substr( $item->IMB_CLTCCR_DV,0,1),1,' ');//43-43
                else
                    $texto .= 
                             $cNumeroAgencia . //24 - 28
                             ' '. //29-29
                             $this->formata_numero($item->IMB_CLTCCR_NUMERO,12,0). // 30-41
                             ' '. //42-42
                             str_pad(substr( $item->IMB_CLTCCR_DV,0,1),1,' ');//43-43

                $texto .=                             
                    str_pad( substr($item->IMB_CLTCCR_NOME,0,30 ),30,' ') . //44-73
                    $this->formata_numero( $item->IMB_CTR_ID,7,0).'-'. //74-80
                    date('d/m/Y', strtotime( $item->IMB_RLD_DATAVENCIMENTO)).
                    str_repeat(' ', 2 ). //74-93
                    date('dmY', strtotime( $item->IMB_RLD_DATAPAGAMENTO)). //94-101
                    '009'. //102-104
                    str_repeat('0', 15 ). //105-119
                    $cValorDoc . //120-134
                    str_repeat( ' ', 15 ) . //135-149
                    str_repeat( ' ', 5 )  . //150-154
                    str_repeat( '0', 8  ) . //155-162
                    str_repeat( '0', 15 ) . //163-177
                    str_repeat( ' ', 18 ) . //178-195
                    str_repeat( ' ', 2  ) . //196-197
                    str_repeat( '0', 6  ) . //198-203
                    $cCpf . //204-217
                    '01'. //218-219
                    '00010'. //220-224
                    str_repeat( ' ', 5 ). //225-229
                    '0' . //230-230
                    str_repeat(' ', 10 ).
                    chr(13).chr(10);

                $stant = "UPDATE IMB_RECIBOLOCADOR SET IMB_RLD_DOCELETRONICO = 'N' 
                        WHERE IMB_RLD_NUMERO = ".$item->IMB_RLD_NUMERO;
                $rld = $sel = DB::statement( $stant );
            }
           
            $cTotDoc = $this->formata_numero($nTotalFatVal*100,20,0);
            $cTotDocQuantMoeda =$this->formata_numero($nTotalFatVal*100,13,0);

            $nRegistrosLote .= 1;
            $nSequencia.= 1;
            $texto .=            
            $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0). //001-003
                '0001'.//004-007  lote de serviço
                '5' . //008-008
                str_repeat(' ', 9 ). //009-017
                $this->formata_numero( $nRegistrosLote,6,0 ) . //18-23
                $this->formata_numero( $nTotalFat,18,0)  . //24-41
                str_repeat('0',18 ) . //42-59
                str_repeat(' ', 171 ). //58-230
                str_repeat(' ', 10 ).
                chr(13).chr(10);

            $nSequencia.= 1;
            $texto .=   
            $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0). //001-003
                '9999'.//004-007  lote de serviço
                '9' . //008-008
                str_repeat(' ', 9 ). //009-017
                '000001'. //18-23
                $this->formata_numero($nSequencia,6,0 ).
                str_repeat(' ', 211 ).
                chr(13).chr(10);

            $pasta='/files/'.Auth::user()->IMB_IMB_ID;

            $contacaixa->FIN_CCX_DOCSEQUENCIA  = $contacaixa->FIN_CCX_DOCSEQUENCIA  + 1;
            $contacaixa->save();

            $filename = 
                'D'.
                date('dm').
                $this->formata_numero( $contacaixa->FIN_CCX_DOCSEQUENCIA,3,0);
            
            Storage::disk('public')->makeDirectory( $pasta);
            Storage::disk('public')->put($pasta.'/'.$filename, $texto);
            $url = URL::to('/').'/storage'.$pasta.'/'.$filename;
            
            $arquivos = array();
            array_push( $arquivos, [ "file" => $url, 'tipo' =>'Arquivo para DOC e TED para outros bancos' ]);


            //arquivo para transferencias entre contas do ITAU
            $contacaixa = mdlContaCaixa::find( $idconta);

            $imob = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
    
            $cCpf = $contacaixa->FIN_CCI_CGCCPF;
            $cCpf = str_replace('.','',$cCpf);
            $cCpf = str_replace('-','',$cCpf);
            $cCpf = str_replace('/','',$cCpf);
            $cCpf = trim( $cCpf );
    
            if( strlen( $cCpf ) > 11 ) 
                $cTipoInscricao = '2';
            else
                $cTipoInscricao ='1';
    
            $cCep = str_replace( '.','',$imob->IMB_IMB_CEP);
            $cCep = str_replace( ',-','', $cCep);
    
            $texto = 
                $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).//1-3
                '0000'. //4-7
                '0'.  //8-8
                str_repeat(' ',6 ). //9-14
                '080'. //15-17
                $cTipoInscricao. //18-18
                $this->formata_numero( $cCpf,14,'0'). //19-32
                str_repeat( ' ', 20 ). //33-52
                $this->formata_numero( $contacaixa->FIN_CCI_AGENCIANUMERO,5,0).//53-57
                ' '. //58-58
                $this->formata_numero( $contacaixa->FIN_CCI_CONCORNUMERO,12,0).     //59-70
                ' '. //71-71
                str_pad( trim( $contacaixa->FIN_CCI_CONCORDIGITO),1, ' '). //72-72
                str_pad( substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($contacaixa->FIN_CCI_CONCORNOME),0,30),30,' ').//73-102
                str_pad( 'BANCO ITAU', 30, ' ' ).//103-132
                str_repeat(' ', 10 ). //133-142
                '1' . //143-143
                date( 'dmY' ) . //144-151
                date( 'his' ) . //152-157
                $this->formata_numero( $contacaixa->FIN_CCX_DOCSEQUENCIA,9,0).//158 - 166
                str_repeat('0', 5 ). //167-171
                str_repeat(' ', 69 ).//172-240
                chr(13).chr(10);
    
    
    
            $nRegistrosLote = 1;
            // Gravando o Header do Lote
    
            $texto .=  $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).//1-3
                '0001'. //4-7
                '1'.  //8-8
                'C'. //9-9 
                '20'. //10-11
                '41'. //12-13
                '040'. //14/16
                ' '. //17-17
                $cTipoInscricao. //18-18
                $this->formata_numero( $cCpf,14,0). //19-32
                str_repeat(' ', 4 ) . //33-36
                str_repeat( ' ', 16 ). //37-52
                $this->formata_numero( $contacaixa->FIN_CCI_AGENCIANUMERO,5,0).//53-57
                ' './/58-58
                $this->formata_numero( $contacaixa->FIN_CCI_CONCORNUMERO,12,0).     //59-70
                ' '. //71-71
                str_pad( $contacaixa->FIN_CCI_CONCORDIGITO,1,' ').
                str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($contacaixa->FIN_CCI_CONCORNOME),0,30),30,' '). //73-102
                str_repeat(' ', 30 ). //103-132
                str_repeat(' ', 10 ). //133-142
                str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECO),0,30), 30,' ' ).
                str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECONUMERO),0,5),5,' ').//173-177
                str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECOCOMPLEMENTO),0,15),15,' '). //178-192
                str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->CEP_CID_NOME),0,20),20,' '). //193-212
                $this->formata_numero( $cCep,8,0). //213-220
                str_pad( $imob->CEP_UF_SIGLA,2,0). //221-222
                str_repeat(' ',  8 ).//223-230
                str_repeat(' ', 10 ). //231-240 
                chr(13).chr(10);
    
                $tmp = mdlTmpPlanilhaDeposito::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
                ->where( 'SELECIONADO','=','S' )
                ->where( 'GER_BNC_NUMERO','=', '341' )
                ->orderBy( 'IMB_RLD_DATAPAGAMENTO')
                ->orderBy( 'FAVORECIDO' )
                ->get();
    
                $nTotalFat          = 0;
                $nTotalFatVal       = 0;
                $nSequencia         = 2;
                $nSequenciaDet      = 0;
                foreach ($tmp as $item) 
                {
                   //Posicionando sobre a conta corrente do imóvel
                   $inconsistencia='';
    
                    $cNumeroBanco = '000';
                    if( $item->GER_BNC_NUMERO== '' )
                        $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' sem banco ';
                    else
                        $cNumeroBanco = $this->formata_numero( $item->GER_BNC_NUMERO,3,0);
         
                    $cNumeroAgencia = '00000';
                    if( $item->GER_BNC_AGENCIA == '' )
                        $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' Sem Agencia ';
                    else
                        $cNumeroAgencia =$this->formata_numero( $item->GER_BNC_AGENCIA,5,0);
          
                    $cNumeroContaCorrente = '000000000000';
                    if( $item->IMB_CLTCCR_NUMERO == '' )
                        $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' Sem C/C ';
                    else
                        $cNumeroContaCorrente = $this->formata_numero( $item->IMB_CLTCCR_NUMERO,12,0);
    
                    $cValorDoc = $item->TOTALRECIBO * 100;
                    $cValorDoc = $this->formata_numero( intval($cValorDoc),15,0);
    
                    $nTotalFat =  $nTotalFat + intval( $cValorDoc );
                    $nTotalFatVal =  $nTotalFatVal +intval( $cValorDoc );
    
                    $cpfclt = $item->IMB_CLT_CPF;
                    $cpfclt = str_replace('.','',$cpfclt);
                    $cpfclt = str_replace('-','',$cpfclt);
                    $cpfclt = str_replace('/','',$cpfclt);
                    $cpfclt = trim( $cpfclt );
            
                    $cpfccrclt = $item->IMB_CLTCCR_CPF;
                    $cpfccrclt = str_replace('.','',$cpfccrclt);
                    $cpfccrclt = str_replace('-','',$cpfccrclt);
                    $cpfccrclt = str_replace('/','',$cpfccrclt);
                    $cpfccrclt = trim( $cpfccrclt );
            
          
                    if( $cpfclt == '' and $cpfccrclt == '' )
                        $inconsistencia .= 'Proprietario '.$item->IMB_CLT_NOME.' Sem CPF';
                    else
                    {
                        $cCpf = $cpfccrclt;
                        if( $item->IMB_CLTCCR_CPF == '' )
                            $cCpf = $cpfclt;
                    }
    
                    if( strlen( $cCpf) == 11)
                         $cCpf = '000'.$cCpf;
                    if( strlen( $cCpf) == 10)
                         $cCpf = '0000'.$cCpf;
                      
                    $nSequencia             = $nSequencia + 1;
                    $nRegistrosLote         = $nRegistrosLote + 1;
                    $nSequenciaDet          = $nSequenciaDet  + 1;
                         
                    $texto .=
                    $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).
                        '0001'. //4-8  Lote de Serviço
                        '3' . //8-8
                        $this->formata_numero( $nSequenciaDet,5,0 ). //9-13
                        'A'. //14-14
                        '000' . //15-17
                        '000'.//18-20
                        $cNumeroBanco.//21-23
                        '0' .//24-25
                        $cNumeroAgencia. //25-28
                        ' '. //29-29
                        str_repeat( '0', 6 ) . //30-35
                    $this->formata_numero($item->IMB_CLTCCR_NUMERO,6,0). // 36-41
                        ' '. //42-42
                        str_pad(substr( $item->IMB_CLTCCR_DV,0,1),1,' ').//43-43
                        str_pad( substr(app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($item->IMB_CLTCCR_NOME),0,30 ),30,' ') . //44-73
                        $this->formata_numero( $item->IMB_CTR_ID,7,0).'-'. //74-80
                        date('d/m/Y', strtotime( $item->IMB_RLD_DATAVENCIMENTO)).
                        str_repeat(' ', 2 ). //74-93
                        date('dmY', strtotime( $item->IMB_RLD_DATAPAGAMENTO)). //94-101
                        '009'. //102-104
                        str_repeat('0', 15 ). //105-119
                        $cValorDoc . //120-134
                        str_repeat( ' ', 15 ) . //135-149
                        str_repeat( ' ', 5 )  . //150-154
                        str_repeat( '0', 8  ) . //155-162
                        str_repeat( '0', 15 ) . //163-177
                        str_repeat( ' ', 18 ) . //178-195
                        str_repeat( ' ', 2  ) . //196-197
                        str_repeat( '0', 6  ) . //198-203
                        $cCpf . //204-217
                        '01'. //218-219
                        '00010'. //220-224
                        str_repeat( ' ', 5 ). //225-229
                        '0' . //230-230
                        str_repeat(' ', 10 ).
                        chr(13).chr(10);
    
                    $stant = "UPDATE IMB_RECIBOLOCADOR SET IMB_RLD_DOCELETRONICO = 'N' 
                            WHERE IMB_RLD_NUMERO = ".$item->IMB_RLD_NUMERO;
                    $rld = $sel = DB::statement( $stant );
                }
               
                $cTotDoc = $this->formata_numero($nTotalFatVal*100,20,0);
                $cTotDocQuantMoeda =$this->formata_numero($nTotalFatVal*100,13,0);
    
                $nRegistrosLote .= 1;
                $nSequencia.= 1;
                $texto .=            
                $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0). //001-003
                    '0001'.//004-007  lote de serviço
                    '5' . //008-008
                    str_repeat(' ', 9 ). //009-017
                    $this->formata_numero( $nRegistrosLote,6,0 ) . //18-23
                    $this->formata_numero( $nTotalFat,18,0)  . //24-41
                    str_repeat('0',18 ) . //42-59
                    str_repeat(' ', 171 ). //58-230
                    str_repeat(' ', 10 ).
                    chr(13).chr(10);
    
                $nSequencia.= 1;
                $texto .=   
                $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0). //001-003
                    '9999'.//004-007  lote de serviço
                    '9' . //008-008
                    str_repeat(' ', 9 ). //009-017
                    '000001'. //18-23
                    $this->formata_numero($nSequencia,6,0 ).
                    str_repeat(' ', 211 ).
                    chr(13).chr(10);
    
                $pasta='/files/'.Auth::user()->IMB_IMB_ID;
    
                $contacaixa->FIN_CCX_DOCSEQUENCIA  = $contacaixa->FIN_CCX_DOCSEQUENCIA  + 1;
                $contacaixa->save();
    

            $filename = 
                'I'.
                date('dm').
                $this->formata_numero( $contacaixa->FIN_CCX_DOCSEQUENCIA,3,0);
            
            Storage::disk('public')->makeDirectory( $pasta);
            Storage::disk('public')->put($pasta.'/'.$filename, $texto);

            $url = URL::to('/').'/storage'.$pasta.'/'.$filename;
            array_push( $arquivos, [ "file" => $url, 'tipo' =>'Arquivo para Tranferência Entre Contas Itaú' ]);

//            $retorno = json_encode( $arquivos);
            return response()->json( $arquivos,200);

    }

    public function remessaPix( Request $request )
    {
        $idconta = $request->FIN_CCX_ID;
    
        $contacaixa = mdlContaCaixa::find( $idconta);
    
        $imob = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
    
        $cCpf = $contacaixa->FIN_CCI_CGCCPF;
        $cCpf = str_replace('.','',$cCpf);
        $cCpf = str_replace('-','',$cCpf);
        $cCpf = str_replace('/','',$cCpf);
        $cCpf = trim( $cCpf );
    
        if( strlen( $cCpf ) > 11 ) 
            $cTipoInscricao = '2';
        else
            $cTipoInscricao ='1';
    
        $cCep = str_replace( '.','',$imob->IMB_IMB_CEP);
        $cCep = str_replace( ',-','', $cCep);
    
        $texto = 
            $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).//1-3
            '0000'. //4-7
            '0'.  //8-8
            str_repeat(' ',6 ). //9-14
            '080'. //15-17
            $cTipoInscricao. //18-18
            $this->formata_numero( $cCpf,14,'0'). //19-32
            str_repeat( ' ', 20 ). //33-52
            $this->formata_numero( $contacaixa->FIN_CCI_AGENCIANUMERO,5,0).//53-57
            ' '. //58-58
            $this->formata_numero( $contacaixa->FIN_CCI_CONCORNUMERO,12,0).     //59-70
            ' '. //71-71
            str_pad( trim( $contacaixa->FIN_CCI_CONCORDIGITO),1, ' '). //72-72
            str_pad( substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($contacaixa->FIN_CCI_CONCORNOME),0,30),30,' ').//73-102
            str_pad( 'BANCO ITAU', 30, ' ' ).//103-132
            str_repeat(' ', 10 ). //133-142
            '1' . //143-143
            date( 'dmY' ) . //144-151
            date( 'his' ) . //152-157
            $this->formata_numero( $contacaixa->FIN_CCX_DOCSEQUENCIA,9,0).//158 - 166
            str_repeat('0', 5 ). //167-171
            str_repeat(' ', 69 ).//172-240
            chr(13).chr(10);
    
    
    
        $nRegistrosLote = 1;
        // Gravando o Header do Lote
    
        $texto .=  $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).//1-3
            '0001'. //4-7
            '1'.  //8-8
            'C'. //9-9 
            '20'. //10-11
            '45'. //12-13
            '040'. //14/16
            ' '. //17-17
            $cTipoInscricao. //18-18
            $this->formata_numero( $cCpf,14,0). //19-32
            str_repeat(' ', 4 ) . //33-36
            str_repeat( ' ', 16 ). //37-52
            $this->formata_numero( $contacaixa->FIN_CCI_AGENCIANUMERO,5,0).//53-57
            ' './/58-58
            $this->formata_numero( $contacaixa->FIN_CCI_CONCORNUMERO,12,0).     //59-70
            ' '. //71-71
            str_pad( $contacaixa->FIN_CCI_CONCORDIGITO,1,' ').
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($contacaixa->FIN_CCI_CONCORNOME),0,30),30,' '). //73-102
            str_repeat(' ', 30 ). //103-132
            str_repeat(' ', 10 ). //133-142
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECO),0,30), 30,' ' ).
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECONUMERO),0,5),5,' ').//173-177
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->IMB_IMB_ENDERECOCOMPLEMENTO),0,15),15,' '). //178-192
            str_pad(substr( app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($imob->CEP_CID_NOME),0,20),20,' '). //193-212
            $this->formata_numero( $cCep,8,0). //213-220
            str_pad( $imob->CEP_UF_SIGLA,2,0). //221-222
            str_repeat(' ',  8 ).//223-230
            str_repeat(' ', 10 ). //231-240 
            chr(13).chr(10);
        
        $tmp = mdlTmpPlanilhaDeposito::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->where( 'SELECIONADO','=','S' )
        ->orderBy( 'IMB_RLD_DATAPAGAMENTO')
        ->orderBy( 'FAVORECIDO' )
        ->get();
    
        $nTotalFat          = 0;
        $nTotalFatVal       = 0;
        $nSequencia         = 2;
        $nSequenciaDet      = 0;
        foreach ($tmp as $item) 
        {
           //Posicionando sobre a conta corrente do imóvel
           $inconsistencia='';
    
            $cNumeroBanco = '000';
            if( $item->GER_BNC_NUMERO== '' )
                $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' sem banco ';
            else
                $cNumeroBanco = $this->formata_numero( $item->GER_BNC_NUMERO,3,0);
        
            $cNumeroAgencia = '00000';
            if( $item->GER_BNC_AGENCIA == '' )
                $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' Sem Agencia ';
            else
                $cNumeroAgencia =$this->formata_numero( $item->GER_BNC_AGENCIA,5,0);
        
            $cNumeroContaCorrente = '000000000000';
            if( $item->IMB_CLTCCR_NUMERO == '' )
                $inconsistencia .= 'Imovel '.$item->IMB_IMV_ID.' Sem C/C ';
            else
                $cNumeroContaCorrente = $this->formata_numero( $item->IMB_CLTCCR_NUMERO,12,0);
    
            $cValorDoc = $item->TOTALRECIBO * 100;
            $cValorDoc = $this->formata_numero( intval($cValorDoc),15,0);
    
            $nTotalFat =  $nTotalFat + intval( $cValorDoc );
            $nTotalFatVal =  $nTotalFatVal +intval( $cValorDoc );
    
            $cpfclt = $item->IMB_CLT_CPF;
            $cpfclt = str_replace('.','',$cpfclt);
            $cpfclt = str_replace('-','',$cpfclt);
            $cpfclt = str_replace('/','',$cpfclt);
            $cpfclt = trim( $cpfclt );
                        $cpfccrclt = $item->IMB_CLTCCR_CPF;
            $cpfccrclt = str_replace('.','',$cpfccrclt);
            $cpfccrclt = str_replace('-','',$cpfccrclt);
            $cpfccrclt = str_replace('/','',$cpfccrclt);
            $cpfccrclt = trim( $cpfccrclt );
                  
            if( $cpfclt == '' and $cpfccrclt == '' )
                $inconsistencia .= 'Proprietario '.$item->IMB_CLT_NOME.' Sem CPF';
            else
            {
                $cCpf = $cpfccrclt;
                if( $item->IMB_CLTCCR_CPF == '' )
                    $cCpf = $cpfclt;
            }
    
            if( strlen( $cCpf) == 11)
                 $cCpf = '000'.$cCpf;
            if( strlen( $cCpf) == 10)
                 $cCpf = '0000'.$cCpf;
              
            $nSequencia             = $nSequencia + 1;
            $nRegistrosLote         = $nRegistrosLote + 1;
            $nSequenciaDet          = $nSequenciaDet  + 1;
                 
            $texto .=
            $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0).
                '0001'. //4-8  Lote de Serviço
                '3' . //8-8
                $this->formata_numero( $nSequenciaDet,5,0 ). //9-13
                'A'. //14-14
                '000' . //15-17
                '000'.
                $cNumeroBanco;
    
            if  ( $item->GER_BNC_NUMERO == '341'  or  $item->GER_BNC_NUMERO == '409' )
                $texto .=
                    '0' .
                    $cNumeroAgencia. //25-28
                    ' '. //29-29
                    str_repeat( '0', 6 ) . //30-35
                    $this->formata_numero($item->IMB_CLTCCR_NUMERO,6,0). // 36-41
                    ' '. //42-42
                    str_pad(substr( $item->IMB_CLTCCR_DV,0,1),1,' ');//43-43
            else
                $texto .= 
                         $cNumeroAgencia . //24 - 28
                         ' '. //29-29
                         $this->formata_numero($item->IMB_CLTCCR_NUMERO,12,0). // 30-41
                         ' '. //42-42
                         str_pad(substr( $item->IMB_CLTCCR_DV,0,1),1,' ');//43-43
    
            $texto .=                             
                str_pad( substr(app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($item->IMB_CLTCCR_NOME),0,30 ),30,' ') . //44-73
                $this->formata_numero( $item->IMB_CTR_ID,7,0).'-'. //74-80
                date('d/m/Y', strtotime( $item->IMB_RLD_DATAVENCIMENTO)).
                str_repeat(' ', 2 ). //74-93
                date('dmY', strtotime( $item->IMB_RLD_DATAPAGAMENTO)). //94-101
                '009'. //102-104
                str_repeat('0', 15 ). //105-119
                $cValorDoc . //120-134
                str_repeat( ' ', 15 ) . //135-149
                str_repeat( ' ', 5 )  . //150-154
                str_repeat( '0', 8  ) . //155-162
                str_repeat( '0', 15 ) . //163-177
                str_repeat( ' ', 18 ) . //178-195
                str_repeat( ' ', 2  ) . //196-197
                str_repeat( '0', 6  ) . //198-203
                $cCpf . //204-217
                '01'. //218-219
                '00010'. //220-224
                str_repeat( ' ', 5 ). //225-229
                '0' . //230-230
                str_repeat(' ', 10 ).
                chr(13).chr(10);
    
            $stant = "UPDATE IMB_RECIBOLOCADOR SET IMB_RLD_DOCELETRONICO = 'N' 
                    WHERE IMB_RLD_NUMERO = ".$item->IMB_RLD_NUMERO;
            $rld = $sel = DB::statement( $stant );
        }
            
        $cTotDoc = $this->formata_numero($nTotalFatVal*100,20,0);
        $cTotDocQuantMoeda =$this->formata_numero($nTotalFatVal*100,13,0);
            $nRegistrosLote .= 1;
        $nSequencia.= 1;
        $texto .=            
        $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0). //001-003
            '0001'.//004-007  lote de serviço
            '5' . //008-008
            str_repeat(' ', 9 ). //009-017
            $this->formata_numero( $nRegistrosLote,6,0 ) . //18-23
            $this->formata_numero( $nTotalFat,18,0)  . //24-41
            str_repeat('0',18 ) . //42-59
            str_repeat(' ', 171 ). //58-230
            str_repeat(' ', 10 ).
            chr(13).chr(10);
            $nSequencia.= 1;
        $texto .=   
        $this->formata_numero( $contacaixa->FIN_CCI_BANCONUMERO,3,0). //001-003
            '9999'.//004-007  lote de serviço
            '9' . //008-008
            str_repeat(' ', 9 ). //009-017
            '000001'. //18-23
            $this->formata_numero($nSequencia,6,0 ).
            str_repeat(' ', 211 ).
            chr(13).chr(10);
            $pasta='/files/'.Auth::user()->IMB_IMB_ID;
            $contacaixa->FIN_CCX_DOCSEQUENCIA  = $contacaixa->FIN_CCX_DOCSEQUENCIA  + 1;
        $contacaixa->save();
            $filename = 
            'P'.
            date('dm').
            $this->formata_numero( $contacaixa->FIN_CCX_DOCSEQUENCIA,3,0);
        
        Storage::disk('public')->makeDirectory( $pasta);
        Storage::disk('public')->put($pasta.'/'.$filename, $texto);
        $url = URL::to('/').'/storage'.$pasta.'/'.$filename;
        
        $arquivos = array();
        array_push( $arquivos, [ "file" => $url, 'tipo' =>'Arquivo de Arquivo: REMESSA PIX' ]);
        return response()->json( $arquivos,200);


        
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
                $id =  intval(trim(substr( $linha, 37,25 )));
                $nossonumero = substr( $linha, 85,8 );
                //$motivorejeicao = substr( $linha, 213,10 );
                $ocorrencia =substr( $linha, 108,2 );
                $valorcobranca = substr( $linha, 152,13 );
                if( substr( $linha, 146,6) <>'000000')
                    $datavencimento = '20'.substr( $linha, 150,2).'-'.
                                  substr( $linha, 148,2).'-'.
                                  substr( $linha, 146,2);
                else
                    $datavencimento=null;

                $valorpago = substr( $linha, 253,13 );
                if( substr($linha, 175,6) <> '000000' )
                    $datacredito =    '20'.substr( $linha, 299,2).'-'.
                        substr( $linha, 197,2).'-'.
                        substr( $linha, 195,2);
                else
                    $datacredito = null;


                $cgp = mdlCobrancaGeradaPerm::find( $id );
                if( $cgp )
                {
                    $IMB_CTR_ID=$cgp->IMB_CTR_ID;

                    $ctr = mdlContrato::find( $cgp->IMB_CTR_ID );
                    if( $ctr )
                    {
                        //verificar pagagameto
                        $japago = 'N';
                        $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO, $cgp->IMB_CGR_ID );
                        if( $valorjapago <> 0 ) 
                            $japago='S';

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

                            if( $imv->IMB_CND_ID <> 0 and $imv->IMB_CND_ID == ' ')
                            {
                                $condominio = app('App\Http\Controllers\ctrCondominio')
                                ->busca($imv->IMB_CND_ID );
                            }
                            $locatario =
                            app('App\Http\Controllers\ctrRotinas')
                            ->nomeLocatarioPrincipal( $IMB_CTR_ID );

                        }
                    }



                    if( substr($linha, 114,6) <> '000000' )
                        $datapagamento =  '20'.substr( $linha, 114,2).'-'.
                                    substr( $linha, 112,2).'-'.
                                    substr( $linha, 110,2);
                    else
                        $datapagamento = null;

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
//                    $rb->datacredito = $datacredito;
                    $rb->encargos = intval($encargos);
                    $rb->observacoes = '';
                    $rb->endereco = $endereco;
                    $rb->locatario = $locatario;
                    $rb->datavencimento = $cgp->IMB_CGR_VENCIMENTOORIGINAL;
                    $rb->datapagamento = $datapagamento;
                    $rb->IMB_CTR_ID = $IMB_CTR_ID;
                    $rb->condominio = $condominio;
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
                    $rb->IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTOORIGINAL ;

                    $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    $rb->pagonaoconfere ='S';                    
                    $rb->valorjapago = $valorjapago;





                    if( $ocorrencia == '06')
                    {
                        if( $japago == 'N')
                            $rb->selecionado = 'S';
                        $rb->pagonaoconfere ='N';                            
                        $cgp->IMB_CGR_ARQRETORNO = $rb->nomedoarquivo;
                        if( $ctr <> '' )
                             app('App\Http\Controllers\ctrRotinas')
                           ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'Leitura do arquivo retorno '.$rb->nomedoarquivo.
                            ' como ENTRADA LIQUIDAÇÃO, Vencimento: '.implode("-", array_reverse(explode("-", trim($rb->datavencimento)))));

                    }

                    $rb->save();


                    //setando o status do boleto depois de lido o boleto

                    if( $ocorrencia == '02')
                    {
                        $cgp = mdlCobrancaGeradaPerm::find( $id );
                        $cgp->IMB_CGR_NOSSONUMERO=$nossonumero;
                        $cgp->IMB_CGR_ENTRADACONFIRMADA = 'S';
                        $cgp->IMB_CGR_ARQRETORNO = $rb->nomedoarquivo;
                        if( $ctr <> '' )
                        app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'Leitura do arquivo retorno '.$rb->nomedoarquivo.
                            ' como ENTRADA CONFIRMADA, Vencimento: '.implode("-", array_reverse(explode("-", trim($rb->datavencimento)))));
                        $cgp->save();
                    }
                    else
                    if( $ocorrencia == '03')
                    {
                        $cgp = mdlCobrancaGeradaPerm::find( $id );
                        $cgp->IMB_CGR_ENTRADACONFIRMADA = 'N';
                        $cgp->save();
                        $cgp->IMB_CGR_ARQRETORNO = $rb->nomedoarquivo;
                        if( $ctr <> '' )
                        app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'Leitura do arquivo retorno '.$rb->nomedoarquivo.
                            ' como ENTRADA REJEITADA, Vencimento: '.implode("-", array_reverse(explode("-", trim($rb->datavencimento)))));
                    }
                }
                else
                {
                    Log::info( 'valor cob '.$valorcobranca);

                    $rb = new mdlRetornoBancario;
                    $rb->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $rb->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $rb->codigoocorrencia = $ocorrencia;
                    $rb->nomeocorrencia = $this->ocorrencia( $ocorrencia);
                    $rb->nossonumero = $nossonumero;
                    $rb->valorpago = intval($valorpago)/100;
                    $rb->valorcobranca = intval($valorcobranca)/100;
                    $rb->motivorejeicao = $motivorejeicao;
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
//                    $rb->datacredito = $datacredito;
                    $rb->encargos = intval($encargos);
                    $rb->observacoes = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->endereco = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->locatario = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->datavencimento = $datavencimento;
//                    $rb->datapagamento = $datapagamento;
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
        if( $id == '24' ) $nomeocorrencia = 'Entrada Rejeitada por CEP Irregular';
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

    public function gerarRemessaNovoPadrao()
    {
        $empresa=Auth::user()->IMB_IMB_ID;
        $pasta='/files/'.$empresa;
        $filename = 'cnab200.txt';

        $cgs = mdlCobrancaGerada::where( 'IMB_CGR_SELECIONADA','=', 'S')
        ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->orderBy( 'IMB_CGR_ID')
        ->get();

        $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );
        
        Log::info('padrao antigo');
        
        if( $cgs <> '[]')
        {
            $conta = mdlContaCaixa::find( $cgs[0]->FIN_CCR_ID );
            $seqarq = $conta->FIN_CCI_COBRANCAARQSEQ;
            $conta->FIN_CCI_COBRANCAARQSEQ = intval( $seqarq )+1;
            $conta->save();
            $filename = $this->formata_numero( $conta->FIN_CCI_COBRANCAARQSEQ,6,0 ).'.rem';

            $cToleranciaBoleto= '39';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 10  )
                $cToleranciaBoleto = '20';

            if ( $par->IMB_PRM_COBBANTOLERANCIA == 5  )
                $cToleranciaBoleto = '02';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 15  )
                $cToleranciaBoleto = '21';


            if ( $par->IMB_PRM_COBBANTOLERANCIA == 20  )
                $cToleranciaBoleto = '22';

            if ( $par->IMB_PRM_COBBANTOLERANCIA == 30 )
                $cToleranciaBoleto = '24';


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


            $conteudo .= '0'.   //001-001
                        '1'. // 002-002
                        'REMESSA'. //003-009
                        '01'.  //010-011
                        'COBRANCA       '. //12-26
                        $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //27-30
                        '00' . //31-32
                        $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,5,0).//33-37
                        str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //38-38
                        str_repeat(' ',8).//39-46
                        substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30).//47-76
                        '341'. //77-79
                        str_pad('BANCO ITAU SA',15,' ').
                        date( 'dmy' ).
                        str_repeat(' ',294).
                        '000001'.chr(13).chr(10);;


            $nSequencia     = 1;
            $nTotalFat      = 1;
            $nTotalFatVal   = 0;
            $nTitulos       = 0;
            $nSeqLote       =0;

            foreach( $cgs as $cg )
            {

                $cp = $this->abastecerPermanente( $cg, $filename );

                $cCgc = $cg->IMB_CGR_CPF;
                $cCgc = str_replace('.','',$cCgc);
                $cCgc = str_replace('-','',$cCgc);
                $cCgc = str_replace('/','',$cCgc);

                $clt = mdlCliente::where('IMB_CLT_CPF','=', $cCgc )->first();
                if( $clt )
                {
                    if( $clt->IMB_CLT_PESSOA == 'J')
                        $cpessoa = '02';
                    else
                        $cpessoa = '01';

                }

                $cCgc = $this->formata_numero($cCgc,14,0);

                $cCepLt = $cg->IMV_CGR_CEP;
                $cCepLt = str_replace('.','',$cCepLt);
                $cCepLt = str_replace('-','',$cCepLt);
                $cCepLt = $this->formata_numero($cCepLt,8,0);

                $dadoscontrato = mdlContrato::find( $cg->IMB_CTR_ID);

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


                    $cobrarjuros = '1';
                    $cvaljuros = $valorjuros * 100;
                    $cvaljuros = $this->formata_numero( intval($cvaljuros),13,0);

                    $cdatajuros =$dataencargos;
                    //$cdatajuros = date( $cdatajuros, strtotime( '+1 day' ));
                }
                else
                {
                    $valorjuros=0;
                    $cobrarjuros = '0';
                    $nTaxaJurosMes = 0;
                    $cvaljuros =  str_repeat('0',13);
                    $cdatajuros = str_repeat('0',10);

                }



                if( $par->IMB_PRM_COBBANMULTA <> 0 and $par->IMB_PRM_COBBANMULTA <> null )
                {

                    $basemultajuros = app( 'App\Http\Controllers\ctrCobrancaGerada')->baseMultaJurosBoletoPerm( $cp->IMB_CGR_ID,'permamente' );
                    $valormulta = round($basemultajuros['multa'] * $par->IMB_PRM_COBBANMULTA/100,2);
   

                    $cobrarmulta = '1';
                    $cmulta = $valormulta * 100;
                    $cmulta = $this->formata_numero( intval($cmulta),13,0);
                    $cdatamulta =$dataencargos;
                }
                else
                {
                    $valormulta=0;
                    $cobrarmulta = '0';
                    $cmulta = str_repeat( '0',13 );
                    $cdatamulta = str_repeat( '0',10 );

                }



                $cDatBon = '000000';
                $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                $cValBon = $this->formata_numero( intval($cValBon),13,0);
                if( $cg->IMB_CGR_VALORPONTUALIDADE <> 0 )
                {
                    $cDatBon = date('dmy',strtotime($cg->IMB_CGR_DATAVENCIMENTO));
                    $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                    $cValBon = $this->formata_numero( intval($cValBon),13,0);
                }

 //               dd( "cDatBon $cDatBon -  cValBon: $cValBon - cTipoBon: $cTipoBon");

                $cValTot = $cg->IMB_CGR_VALOR*100;
                $cValTot = $this->formata_numero( intval($cValTot),13,0);

                //$conteudo .= "nossonumero ".$cp->IMB_CGR_NOSSONUMERO.chr(13).chr(10);
                //$conteudo .= 'Pontualidade '.$nValBon.' até: '.$cDatBon.chr(13).chr(10);

                if( $conta->FIN_CCI_CODIGOFLASH <> '' )                 
                    $nossonumero = str_repeat( '0',8);
            else
                $nossonumero = $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,8,0);


                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,0,30);
                $cdestinatario=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cdestinatario);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cEndereco =app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cEndereco);
                
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,12);
                $cbairro=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($cbairro);

                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);
                $ccidade=app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($ccidade);


                $nSequencia++;
                $conteudo .= '1'. //001-001
                    '02'. //002-003
                    $cCGCCedente. //004-017
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //018-021
                     '00'.
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,5,0).//024-28
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //029-029
                    str_repeat(' ', 4 ). //030-033
                    str_repeat('0',4 ).//034-37
                    str_pad( $cp->IMB_CGR_ID, 25,' ' ). //38-62
                    $nossonumero.
                    str_repeat('0',13).//replicate('0',13 )+//071-083
                    str_pad( $conta->FIN_CCI_COBRANCACARTEIRA,'0',3 ).//084-086
                    str_repeat(' ',21 ) . //087-107
                    'I' . //108/108
                    '01'.//109-110
                    $this->formata_numero($cp->IMB_CGR_ID,10,0 ).//111-120
                    date('dmy', strtotime($cg->IMB_CGR_DATALIMITE )).//0121-126
                    $cValTot.//127-139
                    '341'. //140+142
                    str_repeat('0', 5 ) . //143-147
                    '01'. //148-149
                    'N'. //150-150
                    date('dmy'). //151-156
                    $cToleranciaBoleto.
                    '00'.  //159-160  NÃO RECEBER APOS VENCIMENTO
                    $cvaljuros. //161-173
                    $cDatBon. //174-179
                    $cValBon. //180-192
                    str_repeat('0', 13 ). //193-205
                    str_repeat('0', 13 ). //206-218
                    $cpessoa. //219-220
                    $cCgc. //221-234
                    str_pad($cdestinatario,30,' '). //235-264
                    str_repeat(' ', 10 ). //265-274
                    str_pad($cEndereco,40,' '). //275-314
                    str_pad($cbairro,12,' ' ). //166-177
                    $cCepLt. //327-334
                    str_pad($ccidade,15,' ').//335-349
                    str_pad($cg->CEP_UF_SIGLA,2,'X').//350-351
                    str_repeat(' ', 30 ). //352-381
                    str_repeat(' ', 4 ). //382-385
                    date( 'dmy' ).//386-391
                    $this->formata_numero( $par->IMB_PRM_COBBANTOLERANCIA,2,0). //392-393
                    ' '. //394-394
                    $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);

                $nSequencia++;
                $conteudo .='2'.//001-001
                    '1'. //002-002
                    date('dmY', strtotime($cg->IMB_CGR_DATALIMITE )). //003-010
                    $cmulta .
                    str_repeat(' ', 371 ).
                    $this->formata_numero( $nSequencia,6,0 ).
                    chr(13).chr(10);
        
                if( $conta->FIN_CCI_CODIGOFLASH <> ''  )
                {
                    $nSequencia++;
                    $conteudo .= '7'. //001-001
                        trim( $conta->FIN_CCI_CODIGOFLASH). //002-004
                        '01'.
                        str_pad( str_pad( substr( $cdestinatario,0,40),59,' ' ).
                        str_pad( trim($cCgc),20,' ').
                        str_pad( date( 'd/m/Y', strtotime($cg->IMB_CGR_DATAVENCIMENTO)),15,' '), 128,' ').
                        '03'.
                        str_repeat( ' ', 16).
                        str_pad( trim( 'CART.:'.trim( $conta->FIN_CCI_COBRANCACARTEIRA)),10,' ').
                        str_repeat( ' ',51 ).
                        str_pad( $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0).'/'.
                            $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,5,0).'-'.
                            str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '), 15 , ' ').
                        str_repeat( ' ', 36 ).
                        '06'.
                        str_pad( 
                            str_pad( date( 'd/m/Y',strtotime($dadoscontrato->IMB_CTR_INICIO)),18,' ').
                            str_pad( date( 'd/m/Y',strtotime($dadoscontrato->IMB_CTR_DATAREAJUSTE)),14,' ').
                            str_repeat(' ',20).
                            str_repeat(' ',8).
                            str_pad( $dadoscontrato->IMB_CTR_REFERENCIA,16,' ').
                            str_pad( 'R$ '.number_format( $cg->IMB_CGR_VALOR,2,',','.'),15),127,' '  ).
                        '0'.
                        $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);

                    $nSequencia++;
                    $conteudo .= '7'. //001-001
                        trim( $conta->FIN_CCI_CODIGOFLASH). //002-004
                        '08'.
                        str_pad( trim($cEndereco),128 ).
                        '09'.
                        str_pad( 'Imovel: '.trim($cEndereco),128,' ').
                        '10'.
                        str_pad( trim( $cdestinatario),127).
                        '0'.
                        $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);                                                
                          

                    $nRegistroMensagem= 0;
                    $nLinhadoSacado =10;
                    $cMensagemFlash1 = '';
                    $cMensagemFlash2 = '';
                    $cMensagemFlash3= '';
                           
                    foreach( $itens as $item )
                    {          
                        $evento = app('App\Http\Controllers\ctrRotinas')-> pegaNomeEvento( $item->IMB_TBE_ID);
                        $evento = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($evento);

                        $obs = $item->IMB_LCF_OBSERVACAO;
                        $obs = app('App\Http\Controllers\ctrRotinas')->tirarEspeciais($obs);


                        $nRegistroMensagem = $nRegistroMensagem + 1;
                        $nLinhadoSacado = $nLinhadoSacado + 1;
                
                        if ( $nRegistroMensagem == 1 )
                            $cMensagemFlash1 =
                                $this->formata_numero($nLinhadoSacado,2,0).
                               str_pad( 
                                str_pad(substr($evento,0,29),29,' ').
                                str_pad( 'R$ '.number_format( $item->IMB_LCF_VALOR,2,',','.'),10,' ').
                                substr( ' '.$obs,0,86),128,' ');


                        if ( $nRegistroMensagem == 2 )
                            $cMensagemFlash2 =
                               $this->formata_numero($nLinhadoSacado,2,0).
                               str_pad( 
                                str_pad(substr($evento,0,29),29,' ').
                                str_pad( 'R$ '.number_format( $item->IMB_LCF_VALOR,2,',','.'),10,' ').
                                substr( ' '.$obs,0,86),128,' ');
                                               
                        if ( $nRegistroMensagem == 3 )
                               $cMensagemFlash3 =
                               $this->formata_numero($nLinhadoSacado,2,0).
                               str_pad( 
                                        str_pad(substr($evento,0,29),29,' ').
                                        str_pad( 'R$ '.number_format( $item->IMB_LCF_VALOR,2,',','.'),10,' ').
                                        ' '.substr( $obs,0,85),127,' ');
                            
                        if($nRegistroMensagem == 3 )
                        {
                            $nSequencia = $nSequencia + 1;
                            $conteudo .= '7'. //001-001
                                trim( $conta->FIN_CCI_CODIGOFLASH). //002-004
                                $cMensagemFlash1.
                                $cMensagemFlash2.
                                $cMensagemFlash3.
                                '0'.
                                $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);
                            $nRegistroMensagem = 0;
                            $cMensagemFlash1 ='';
                            $cMensagemFlash2 ='';
                            $cMensagemFlash3 ='';                                
                        }


             
                    }


                    if ( $nRegistroMensagem == 1  )
                    {
                        $nLinhadoSacado =  $nLinhadoSacado + 1;
                        $cMensagemFlash2 =
                            $this->formata_numero($nLinhadoSacado,2,0).
                            str_repeat(' ', 128);

                        $nLinhadoSacado =  $nLinhadoSacado + 1;
                        $cMensagemFlash3 =
                            $this->formata_numero($nLinhadoSacado,2,0).
                            str_repeat(' ',127 );
                    }

               
                    if ($nRegistroMensagem == 2 )
                    {
                        $nLinhadoSacado =  $nLinhadoSacado + 1;
                        $cMensagemFlash3 =
                            $this->formata_numero($nLinhadoSacado,2,0).
                            str_repeat(' ',127 );
                    }
               
                    if ($nRegistroMensagem <> 0)
                    {
                        $nSequencia = $nSequencia + 1;
                        $conteudo .= '7'. //001-001
                            trim( $conta->FIN_CCI_CODIGOFLASH). //002-004
                            $cMensagemFlash1.
                            $cMensagemFlash2.
                            $cMensagemFlash3.
                            '0'.
                            $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);                                                
                    }

                }

            }

            $nSequencia++;
            $conteudo .='9'.
                str_repeat(' ', 393 ).
                $this->formata_numero( $nSequencia,6,0).chr(13).chr(10);;



          

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
