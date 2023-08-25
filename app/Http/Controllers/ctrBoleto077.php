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

class ctrBoleto077 extends Controller
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
            $dadosconta = mdlContaCaixa::find( $cp->FIN_CCR_ID);

            //dd( $dadosconta );


            // DADOS DO BOLETO PARA O SEU CLIENTE
            $dias_de_prazo_para_pagamento = 5;
            $taxa_boleto = 0;
            $data_venc = date('d/m/Y',strtotime( $cp->IMB_CGR_DATAVENCIMENTO ) );

            //$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
            $valor_cobrado = $cp->IMB_CGR_VALOR; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
            $valor_boleto= number_format($valor_cobrado, 2, ',', '');

            $dadosboleto["IMB_CGR_ID"] = $id;
            $dadosboleto["FIN_CCI_BANCONUMERO"] = "077";
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

            // DADOS PERSONALIZADOS - Bradesco
            $dadosboleto["conta_cedente"] = $dadosconta->FIN_CCI_CONCORNUMERO; // ContaCedente do Cliente, sem digito (Somente N�meros)
            $dadosboleto["conta_cedente_dv"] =$dadosconta->FIN_CCI_CONCORDIGITO; // Digito da ContaCedente do Cliente


            // DADOS DA SUA CONTA - sant
            $dadosboleto["agencia"] = $dadosconta->FIN_CCI_AGENCIANUMERO; // Num da agencia, sem digito
            $dadosboleto["agencia_dv"] = $dadosconta->FIN_CCI_AGENCIADIGITO; // Digito do Num da agencia
            $dadosboleto["conta"] = $dadosconta->FIN_CCI_CONCORNUMERO;	// Num da conta, sem digito
            $dadosboleto["conta_dv"] = $dadosconta->FIN_CCI_CONCORDIGITO; 	// Digito do Num da conta
            $dadosboleto["codigo_cliente"] = $dadosconta->FIN_CCI_IDENTEMPRESA; 	// Digito do Num da conta

            // DADOS PERSONALIZADOS - ITA�
            $dadosboleto["carteira"] = $dadosconta->FIN_CCI_COBRANCACARTEIRA;  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

            // SEUS DADOS
            $dadosboleto["identificacao"] = "";//BoletoPhp - C�digo Aberto de Sistema de Boletos";
            $dadosboleto["cpf_cnpj"] = $im->IMB_IMB_CGC;
            $dadosboleto["endereco"] =  $im->IMB_IMB_ENDERECO;
            $dadosboleto["cidade_uf"] = $im->IMB_IMB_CEP.' - '.
                                        $im->CEP_CID_NOME.
                                        '('.$im->CEP_UF_SIGLA.')';
            $dadosboleto["cedente"] = $im->IMB_IMB_NOME;

            $codigobanco = "077";
            $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
            $nummoeda = "9";
            $fixo     = "9";   // Numero fixo para a posi��o 05-05
            $ios	  = "0";   // IOS - somente para Seguradoras (Se 7% informar 7, limitado 9%)
            $fator_vencimento = $this->fator_vencimento( $dadosboleto["data_vencimento"] );

            $valor = $this->formata_numero($dadosboleto["valor_boleto"],10,0,"valor");

            $agencia = $this->formata_numero($dadosboleto["agencia"],4,0);
            //conta � 5 digitos + 1 do dv
            $conta = $this->formata_numero($dadosboleto["conta"],6,0);
            $conta_dv = $this->formata_numero($dadosboleto["conta_dv"],1,0);
            //carteira 175
            $carteira = $dadosboleto["carteira"];

            //nosso_numero no maximo 8 digitos
            $nnum = $this->formata_numero($dadosboleto["carteira"],2,0).$this->formata_numero($dadosboleto["nosso_numero"],11,0);
            $dv_nosso_numero = $this->digitoVerificador_nossonumero($nnum);

            $conta_cedente = $this->formata_numero($dadosboleto["conta_cedente"],7,0);
            $conta_cedente_dv = $this->formata_numero($dadosboleto["conta_cedente_dv"],1,0);
            $dv =$this->digitoVerificador_barra("$codigobanco$nummoeda$fator_vencimento$valor$agencia$nnum$conta_cedente".'0', 9, 0);

            $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$agencia$nnum$conta_cedente"."0";

            $nossonumero = substr($nnum,0,2).'/'.substr($nnum,2).'-'.$dv_nosso_numero;
            $agencia_codigo = $agencia."-".$dadosboleto["agencia_dv"]." / ". $conta_cedente ."-". $conta_cedente_dv;


            $dadosboleto["codigo_barras"] = $linha;
            $dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha);
            $dadosboleto["agencia_codigo"] = $agencia_codigo;
            $dadosboleto["nosso_numero"] = $nossonumero;
            $dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

            ///dd( $dadosboleto);

            //PARAMETROS PARA INSTRUÇÕES
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
                app( 'App\Http\Controllers\ctrRotinas')->atualizarEmailLocatarioPrincipal( $ctr->IMB_CTR_ID, $email );

                $email = $email;
                $array = explode(";",$email);
                foreach( $array as $a )
                {
                    $banconumber='077';

                    $a=str_replace( ';','',$a);

                    $html = view('boleto.077.boleto077', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                    Mail::send('boleto.boletoemail', compact( 'dadosboleto', 'im','ctr', 'imv','banconumber' ) ,
                    function( $message ) use ($a, $html,$nossonumero_email, $imovel_log, $contrato_log)
                    {
                        $copiaend = env('APP_MAILBOLETOCOPIA');
                        $a = trim( $a );
                        if( $a <>'' and filter_var($a, FILTER_VALIDATE_EMAIL))
                        {

                            $pdf=PDF::loadHtml( $html,'UTF-8');
                                    $message->attachData($pdf->output(), $nossonumero_email.'.pdf');
    //                        $message->to( "suporte@compdados.com.br" );
                            $message->to( $a  );
                            $message->cc( $copiaend );
                            //$message->bcc("suporte@compdados.com.br");
                            $message->subject('Aviso de vencimento de aluguel');

                            app('App\Http\Controllers\ctrRotinas')
                            ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Boleto enviado para '.$a.' com cópia para '.$copiaend);
                        }
    
                    });

                }
                //echo "<script>window.close();</script>";
                return response()->json('ok',200);
            }
            else
            {
                $html = view('boleto.077.boleto077', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                $pdf=PDF::loadHtml( $html,'UTF-8');
                //$pdf->setPaper('A4', 'portrait');
//                dd('aqui');
                return $pdf->stream('boleto'.$nossonumero.'.pdf');
            }


        }
    }



    public function esquerda($entra,$comp)
    {
        return substr($entra,0,$comp);
    }

    public function direita($entra,$comp)
    {
        return substr($entra,strlen($entra)-$comp,$comp);
    }

    function abastecerPermanente( $cg, $filename )
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


        $nnum = $this->formata_numero($nossonumero,11,0);
        $dv_nosso_numero = $this->modulo_11($nnum,11,0);

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
        $cgp->IMB_CGR_NOMEARQUIVO = $filename;
        
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


        if( $cgs <> '[]')
        {
            $conta = mdlContaCaixa::find( $cgs[0]->FIN_CCR_ID );
            $seqarq = $conta->FIN_CCI_COBRANCAARQSEQ;
            $conta->FIN_CCI_COBRANCAARQSEQ = intval( $seqarq )+1;
            $conta->save();

            $filename = 'CI400_001_'.$this->formata_numero( $conta->FIN_CCI_COBRANCAARQSEQ,7,0 ).'.rem';

            $statuscobranca = 'REMESSA-PRODUCAO';

            if( $conta->FIN_CCI_EMTESTE == 'S')
                $statuscobranca ='REMESSA-TESTE';

            $cCGCCedente = $conta->FIN_CCI_CGCCPF;

            $cCGCCedente = str_replace('.','',$cCGCCedente);
            $cCGCCedente = str_replace('-','',$cCGCCedente);
            $cCGCCedente = str_replace('/','',$cCGCCedente);
            $cCGCCedente = $this->formata_numero($cCGCCedente,14,0);

            $cPessoaCEDENTE = '02';
            if( $conta->FIN_CCI_PESSOA =='F')
                $cPessoaCEDENTE = '01';

            $nRegistroLote = 0;

            $nboletos = 0;


            $conteudo = '';

            $conteudo .=
                    '0'. //001 a 001 
                    '1'. //002 a 002
                    'REMESSA' . //003 a 009 
                    '01'. //010 a 011 
                    'COBRANCA       '. //012 a 026
                    str_repeat(' ',20). //027 a 046
                    substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30). //047 a 07
                    '077'. //077 a 079 
                    str_pad('Inter',15,' '). //080 a 094 
                    date( 'dmy' ). //095 a 100 
                    str_repeat(' ',10).//101 a 110 
                    $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,7,0). //111 a 117 
                    str_repeat(' ', 277 ). //118 a 394 
                    '000001'.chr(13).chr(10); //395 a 400 





            $nSequencia     = 0;
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


                $datalimite =  app( 'App\Http\Controllers\ctrRotinas')->dataLimite( $cp->IMB_CTR_ID, $cg->IMB_CGR_DATAVENCIMENTO );
                $datalimite =  date('dmy', strtotime($datalimite  ) );
                $dataencargos =   strtotime( "+1 days", strtotime($cg->IMB_CGR_DATALIMITE) );
                $dataencargos =  date('dmy', $dataencargos );
                //$dataencargos = date('dmY', strtotime("+1 days",$dataencargos  ));
                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );

                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 and $par->IMB_PRM_COBBANJUROSDIA <> null)
                {
                    $cobrarjuros = '2';
                    $nTaxaJurosMes = $par->IMB_PRM_COBBANJUROSDIA;
                    $cvaljuros = ($cg->IMB_CGR_VALOR * $nTaxaJurosMes / 100) * 100;
                    $cvaljuros = $this->formata_numero( intval($cvaljuros),13,0);

                    $cdatajuros =$dataencargos;
                    //$cdatajuros = date( $cdatajuros, strtotime( '+1 day' ));
                }
                else
                {
                    $cobrarjuros = '0';
                    $nTaxaJurosMes = 0;
                    $cvaljuros =  str_repeat('0',13);
                    $cdatajuros = str_repeat('0',6);

                }


                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 and $par->IMB_PRM_COBBANJUROSDIA <> null )
                    $nValorJurosDiario = $cg->IMB_CGR_VALOR * $par->IMB_PRM_COBBANJUROSDIA / 100;
                else
                    $nValorJurosDiario = 0;


                if( $par->IMB_PRM_COBBANMULTA <> 0 and $par->IMB_PRM_COBBANMULTA <> null )
                {
                    $cobrarmulta = '2';
                    $ntaxamulta = $par->IMB_PRM_COBBANMULTA;
                    $cmulta = $ntaxamulta * 100;
                    $cmulta = $this->formata_numero( intval($cmulta),13,0);
                    $cdatamulta =$dataencargos;
                }
                else
                {
                    $cobrarmulta = '0';
                    $cmulta = str_repeat( '0',13 );
                    $cdatamulta = str_repeat( '0',6 );

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

                $cDatBon = '000000';
                $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                $cValBon = $this->formata_numero( intval($cValBon),13,0);
                $cTipoBon='0';
                if( $cg->IMB_CGR_VALORPONTUALIDADE <> 0 )
                {
                    $cDatBon = date('dmy',strtotime($cg->IMB_CGR_DATAVENCIMENTO));
                    $cValBon = $cg->IMB_CGR_VALORPONTUALIDADE*100;
                    $cValBon = $this->formata_numero( intval($cValBon),13,0);
                    $cTipoBon='1';
                }

 //               dd( "cDatBon $cDatBon -  cValBon: $cValBon - cTipoBon: $cTipoBon");



                $cValTot = $cg->IMB_CGR_VALOR*100;
                $cValTot = $this->formata_numero( intval($cValTot),13,0);

                //$conteudo .= "nossonumero ".$cp->IMB_CGR_NOSSONUMERO.chr(13).chr(10);
                //$conteudo .= 'Pontualidade '.$nValBon.' até: '.$cDatBon.chr(13).chr(10);

                $tipocobranca = '1'; //registrada normal
                if( $conta->FIN_CCI_RAPIDAREGISTRO == 'S' )
                  $tipocobranca = "5";

                if( $conta->FIN_CCI_IMPRESSAOEENVIO == 'E'  )
                {
                    $nossonumero = $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,11,0);
                    $nossonumeroDV = $this->CalcularDigitoNossoNumeroBradesco( $conta->FIN_CCI_COBRANCACARTEIRA, $nossonumero);
                    $formaenvio = '2';
                }
                else
                {

                    $nossonumero = str_repeat('0',11);
                    $nossonumeroDV = '0';
                    $formaenvio = '1';

                }

                $cdestinatario=str_pad(trim($cg->IMB_CGR_DESTINATARIO),40,' ');
                $cEndereco =str_pad( substr(trim($cg->IMB_CGR_ENDERECO),0,39),40,' ');

                $nboletos++;
                $nSequencia++;
                $conteudo .=
                '1'.              //001 a 001
                str_repeat( ' ', 19 ). //002 a 020 
                $this->formata_numero( $conta->FIN_CCI_COBRANCACARTEIRA,3,0). //021 a 023 
                $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,4,0). //024 a 027 
                $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,10,0). //028 a 037
                $this->formata_numero( $cp->IMB_CGR_ID,25,0). //038 a 062 
                str_repeat( ' ', 3 ). //063-065
                '2'. //066 a 066
                str_repeat( '0', 13 ). //067 a 079
                '1000'. //0080 a 083
                $dataencargos. //084 a 089 
                $nossonumero.//099 a 100
                str_repeat( ' ', 8 ). //101 a 108
                '01'. //109-110
                $this->formata_numero( $cp->IMB_CGR_ID,10,0). //111 a 120	Nº do Documento	010
                $datalimite. //121 a 126	Data do Vencimento do Título	006
                $cValTot. //127 a 139	Valor do Título	013
                '15'. // 140 a 141
                str_repeat( ' ', 6 ). //142 a 147 
                '01'. //148 a 149
                'N'. //150 a 150 
                str_repeat( ' ', 6 ). //151 a 156 
                str_repeat( ' ', 3 ). //157 a 159 
                '0'. //160-160  2=juros em percentual
                str_repeat( '0', 13 ). //161 a 173
                str_repeat( '0', 4 ). //174 a 177
                str_repeat( '0', 6 ). //178 a 183
                $cTipoBon. // 184 184
                $cValBon. // 185-197
                str_repeat( '0', 4 ). //198-201
                $cDatBon. //201-207
                str_repeat( ' ', 13 ). //208 -220
                $cpessoa.  //221 a 222	Identificação do Tipo de Inscrição do Sacado	002
                $cCgc.//223 a 236	Nº Inscrição do Sacado	014
                $cdestinatario.//237 a 276	Nome do Sacado	040
                $cEndereco.//277-316	Endereço Completo	040
                $cCepLt. //317 a 324	CEP	008
                str_repeat( ' ', 70).//335 a 394	Sacador/Avalista  ou 2ª Mensagem	060
                $this->formata_numero(  $nSequencia,6,0) //395 a 400	Nº Seqüencial do Registro	006
                .chr(13).chr(10);



                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );

                $cNaoReceber=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANTOLERANCIA <> 0 )
                   $cNaoReceber = 'NAO RECEBER APOS '.$par->IMB_PRM_COBBANTOLERANCIA.
                                ' DIAS DE VENCIDO';
                $cNaoReceber=str_pad( $cNaoReceber,219,' ');

                $cmensagemmulta='';
                if( $par->IMB_PRM_COBBANMULTA <> '0' and $par->IMB_PRM_COBBANMULTA <> '')
                {
                    $cmensagemmulta = 'Multa de '.$par->IMB_PRM_COBBANMULTA.'% apos vencto.';
                }

                $cJurosMes=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 )
                     $cJurosMes = 'APOS O VENCIMENTO, COBRAR JUROS DIARIO DE '.
                     $par->IMB_PRM_COBBANJUROSDIA.'%';
                $cJurosMes=str_pad( $cJurosMes,219,' ');

                $cCorrecao=str_repeat(' ',219);
                if( $par->IMB_PRM_COBBANCORRECAO <> 0 )
                     $cCorrecao = '+ CORRECAO DE '.($par->IMB_PRM_COBBANCORRECAO/30).'% AO DIA';
                $cCorrecao=str_pad( $cCorrecao,219,' ');



                $nSequencia++;
                $conteudo .= '2'. //001-001
                str_pad( 'Valor Aluguel........: R$'.number_format($nValAlu, 2, ',', ''),39,' ').
                str_pad( 'Valor IPTU...........: R$'.number_format($nValIPT, 2, ',', ''),39,' ').
                
                str_pad( 'Valor IRRF...........: R$'.number_format($nValIRRF, 2, ',', ''),39,' ').
                str_pad( 'Valor Desconto/Acordo: R$'.number_format($nValDes, 2, ',', ''),39,' ').
                
                str_pad( 'Valores Diversos.....: R$'.number_format($nValDiv, 2, ',', ''),39,' ').
                str_pad( 'Condominio...........: R$'.number_format($nValorCondominio ), 39,' ' ).
                
                str_pad(  $cmensagemmulta, 39,' ').
                str_repeat( ' ', 39 ).

                str_repeat( '0', 6).
                str_repeat( '0', 13 ).
                str_repeat( '0', 4).
                str_repeat( ' ', 10 ).

                str_repeat( '0', 6).
                str_repeat( '0', 13 ).
                str_repeat( '0', 4).
                str_repeat( ' ', 10 ).

                str_repeat( '0', 11 ).

                str_repeat( ' ', 4).
                $this->formata_numero(  $nSequencia,6,0) //395 a 400	Nº Seqüencial do Registro	006
                .chr(13).chr(10);

                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( $cp->IMB_IMV_ID, $cp->IMB_IMV_ID,0,0,0,'Gerando o registro para enviar boleto ao banco vencimento: '.implode("-", array_reverse(explode("-", trim($cp->IMB_CGR_DATAVENCIMENTO)))));


    }
  
            $nRegistroLote++;
            $nSequencia++;
            $conteudo .=  '9'.
                $this->formata_numero(  $nboletos,6,0).
                str_repeat(' ', 387 ). //09-17
                $this->formata_numero(  $nSequencia,6,0).
                  chr(13).chr(10);



            Storage::disk('public')->makeDirectory( $pasta);
            Storage::disk('public')->put($pasta.'/'.$filename, $conteudo);
            $url = URL::to('/').'/storage'.$pasta.'/'.$filename;

            $cg = mdlCobrancaGerada::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->delete();
            $cgi = mdlCobrancaGeradaItem::where( 'IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )->delete();

            return $url;

            //echo '<a href='.'"
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


                  /*  //verificando se já houve pagamento
                    $pagodeb = mdlLancamentoFuturo::
                    where( 'IMB_CGR_ID','=', $id )
                    ->whereNotNull( 'IMB_LCF_DATARECEBIMENTO')
                    ->where('IMB_LCF_LOCATARIOCREDEB','=','D' )
                    ->sum('IMB_LCF_VALOR')
                    ->get();

                    $pagocre = mdlLancamentoFuturo::
                    where( 'IMB_CGR_ID','=', $id )
                    ->whereNotNull( 'IMB_LCF_DATARECEBIMENTO')
                    ->where('IMB_LCF_LOCATARIOCREDEB','=','C' )
                    ->sum('IMB_LCF_VALOR')
                    ->get();

                    $totaljapago = $pagodeb - $pagocre;
*/


                    $cgp = mdlCobrancaGeradaPerm::find( $id );
                    if( $cgp )
                    {

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


                        $IMB_CTR_ID=$cgp->IMB_CTR_ID;
                        $ctr = mdlContrato::find( $cgp->IMB_CTR_ID );
                        if( $ctr )
                        {

                            //verificar pagagameto
                            $japago = 'N';
                            $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO );
                            if( $valorjapago <> 0 ) 
                                $japago='S';
                            else
                            {
                                $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->jaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_VENCIMENTOORIGINAL );
                                if( $valorjapago <> 0 ) 
                                    $japago='S';

                            }


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
                    $rb->datacredito = $datacredito;
                    $rb->encargos = $encargos;
                    $rb->observacoes = '';
                    $rb->endereco = $endereco;
                    $rb->locatario = $locatario;
                    $rb->datavencimento = $datavencimento;
                    $rb->datapagamento = $datapagamento;
                    $rb->IMB_CTR_ID = $IMB_CTR_ID;
                    $rb->condominio = $condominio;
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
                    $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    $rb->valorjapago = $valorjapago;

                    if( $ocorrencia == '06')
                        $rb->selecionado = 'S';

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
                        $cgp->IMB_CGR_DTHINATIVO = date( 'Y/m/d');
                        $cgp->save();
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
                $nossonumero = substr( $linha, 70,11 );
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
                        $datacredito =    '20'.substr( $linha, 179,2).'-'.
                        substr( $linha, 177,2).'-'.
                        substr( $linha, 175,2);
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
                        $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO );
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

    function digitoVerificador_nossonumero($numero) {
        $resto2 = $this->modulo_11($numero, 7, 1);
         $digito = 11 - $resto2;
         if ($digito == 10) {
            $dv = "P";
         } elseif($digito == 11) {
             $dv = 0;
        } else {
            $dv = $digito;
             }
         return $dv;
    }


    function digitoVerificador_barra($numero) {
        $resto2 = $this->modulo_11($numero, 9, 1);
         if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
            $dv = 1;
         } else {
             $dv = 11 - $resto2;
         }
         return $dv;
    }


    // FUN��ES
    // Algumas foram retiradas do Projeto PhpBoleto e modificadas para atender as particularidades de cada banco

    function formata_numero($numero,$loop,$insert,$tipo = "geral") {
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


    function fbarcode($valor){

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
      $i = round($this->esquerda($texto,2));
      $texto = $this->direita($texto,strlen($texto)-2);
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


    function fator_vencimento($data) {
        $data = explode("/",$data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }

    function _dateToDays($year,$month,$day) {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }
        return ( floor((  146097 * $century)    /  4 ) +
                floor(( 1461 * $year)        /  4 ) +
                floor(( 153 * $month +  2) /  5 ) +
                    $day +  1721119);
    }

    function modulo_10($num) {
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

    function modulo_11($num, $base=9, $r=0)  {
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
        for ($i = strlen($num); $i > 0; $i--) {
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

    function monta_linha_digitavel($codigo) {

        // 01-03    -> C�digo do banco sem o digito
        // 04-04    -> C�digo da Moeda (9-Real)
        // 05-05    -> D�gito verificador do c�digo de barras
        // 06-09    -> Fator de vencimento
        // 10-19    -> Valor Nominal do T�tulo
        // 20-44    -> Campo Livre (Abaixo)

        // 20-23    -> C�digo da Agencia (sem d�gito)
        // 24-05    -> N�mero da Carteira
        // 26-36    -> Nosso N�mero (sem d�gito)
        // 37-43    -> Conta do Cedente (sem d�gito)
        // 44-44    -> Zero (Fixo)


            // 1. Campo - composto pelo c�digo do banco, c�digo da mo�da, as cinco primeiras posi��es
            // do campo livre e DV (modulo10) deste campo

            $p1 = substr($codigo, 0, 4);							// Numero do banco + Carteira
            $p2 = substr($codigo, 19, 5);						// 5 primeiras posi��es do campo livre
            $p3 = $this->modulo_10("$p1$p2");						// Digito do campo 1
            $p4 = "$p1$p2$p3";								// Uni�o
            $campo1 = substr($p4, 0, 5).'.'.substr($p4, 5);

            // 2. Campo - composto pelas posi�oes 6 a 15 do campo livre
            // e livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 24, 10);						//Posi��es de 6 a 15 do campo livre
            $p2 = $this->modulo_10($p1);								//Digito do campo 2
            $p3 = "$p1$p2";
            $campo2 = substr($p3, 0, 5).'.'.substr($p3, 5);

            // 3. Campo composto pelas posicoes 16 a 25 do campo livre
            // e livre e DV (modulo10) deste campo
            $p1 = substr($codigo, 34, 10);						//Posi��es de 16 a 25 do campo livre
            $p2 = $this->modulo_10($p1);								//Digito do Campo 3
            $p3 = "$p1$p2";
            $campo3 = substr($p3, 0, 5).'.'.substr($p3, 5);

            // 4. Campo - digito verificador do codigo de barras
            $campo4 = substr($codigo, 4, 1);

            // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
            // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
            // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
            $p1 = substr($codigo, 5, 4);
            $p2 = substr($codigo, 9, 10);
            $campo5 = "$p1$p2";

            return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    function geraCodigoBanco($numero) {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }


    function CalcularDigitoNossoNumeroBradesco( $carteira, $nossonumero  )
    {

       $result = '0';


       $digito = $this->modulo_11($carteira . $nossonumero);


        if ( $digito == 1 )
            $digito = 'P';
        else
        if ($digito > 1 )
            $digito =  11 - $digito;

       return $digito;

    }

}
