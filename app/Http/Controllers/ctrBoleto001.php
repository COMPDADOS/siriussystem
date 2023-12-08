<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaItemPerm;
use App\mdlCobrancaGerada;
use App\mdlCobrancaGeradaItem;
use App\mdlCobrancaGeradaPermSel;
use App\mdlLancamentoFuturo;
use App\mdlRetornoBancario;
use App\mdlTmpDadosBoleto;
use App\mdlImobiliaria;
use App\mdlContrato;
use App\mdlLocatarioContrato;
use App\mdlImovel;
use App\mdlCliente;
use App\mdlParametros;
use App\mdlContaCaixa;
use App\mdlTabelaEvento;
use PDF;
use Picqer;
use Log;
use Auth;
USE DB;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Illuminate\Support\Facades\URL;
use SplFileObject;
use DataTables;
use DateTime;
use DateInterval;


class ctrBoleto001 extends Controller
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

/*        if( $email == 'X')
        {
            $request = Request::createFromGlobals();
            
            $ip = $request->getClientIp();            
            $venbolbr = app( 'App\Http\Controllers\ctrRotinas')->formatarData( $cp->IMB_CGR_DATAVENCIMENTO );
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( $ctr->IMB_IMV_ID, $ctr->IMB_CTR_ID,0,0,0,'*** Acessaram o link pra visualizar o boleto com vencimento em '.$venbolbr.'. Foi pegou pelo IP publico número: '.$ip);
        }
  */      

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
                          


        //Log::info('Acessou para enviar index e vou localizar CP');
        if( $cp ) 
        {
            $ctr = mdlContrato::find( $cp->IMB_CTR_ID );
            $im = mdlImobiliaria::find( $ctr->IMB_IMB_ID );
            $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
            $par = mdlParametros::find( $ctr->IMB_IMB_ID );
            $conta = mdlContaCaixa::find( $cp->FIN_CCR_ID);

            $objendereco = app('App\Http\Controllers\ctrRotinas')->pegarEnderecoCobranca( $cp->IMB_CTR_ID );
            //Log::info('Encontrou CP!');


            // DADOS DO BOLETO PARA O SEU CLIENTE
            $dias_de_prazo_para_pagamento = 5;
            $taxa_boleto = 0;
            $data_venc = date('d/m/Y',strtotime( $cp->IMB_CGR_DATALIMITE) );
            $data_vencoriginal = date('d/m/Y',strtotime( $cp->IMB_CGR_DATAVENCIMENTO) );

            //$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
            $valor_cobrado = $cp->IMB_CGR_VALOR; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
            $valor_boleto= number_format($valor_cobrado, 2, ',', '');
            $dadosboleto["IMB_CGR_ID"] = $id;
            $dadosboleto["IMB_CTR_ID" ]= $cp->IMB_CTR_ID;
            $dadosboleto["FIN_CCI_BANCONUMERO"] = "001";
            $dadosboleto["nosso_numero"] = $cp->IMB_CGR_NOSSONUMERO;  // Nosso numero - REGRA: M�ximo de 8 caracteres!
            $dadosboleto["numero_documento"] = $cp->IMB_CTR_ID;	// Num do pedido ou nosso numero
            $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_vencimentooriginal"] = $data_vencoriginal; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
            $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
            $dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

            // DADOS DO SEU CLIENTE
            $dadosboleto["sacado"] = $cp->IMB_CGR_DESTINATARIO;
            $dadosboleto["sacadocpf"] = $cp->IMB_CGR_CPF;

            /*
            if( $imv->IMB_IMV_NUMAPT <> 0 and $imv->IMB_IMV_NUMAPT <> '' )
                $dadosboleto["endereco1"]  =  $imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' Apto: '.$imv->IMB_IMV_NUMAPT.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
            else
                $dadosboleto["endereco1"]  =  $imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;

                */

            
            $dadosboleto["endereco1"]  =  $objendereco->IMB_CCB_ENDERECO.' '.$objendereco->IMB_CCB_ENDERECONUMERO.' '.$objendereco->IMB_CCB_ENDERECOCOMPLEMENTO;
            $dadosboleto["endereco2"] =  'Cep: '.$objendereco->IMB_CCB_CEP. ' - Cidade: '.$objendereco->CEP_CID_NOME.' - UF: '.$objendereco->CEP_UF_SIGLA;
            
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

        
            // DADOS DA SUA CONTA
            $dadosboleto["agencia"] = $cp->FIN_CCI_AGENCIANUMERO; // Num da agencia, sem digito
            $dadosboleto["conta"] = $cp->FIN_CCI_CONTANUMERO;	// Num da conta, sem digito
            $dadosboleto["conta_dv"] = $cp->FIN_CCI_CONTADIGITO; 	// Digito do Num da conta
            $dadosboleto["codigo_cliente"] = $cp->FIN_CCI_CODIGOCLIENTE; 	// Digito do Num da conta
            $dadosboleto["convenio"] = $conta->FIN_CCI_CONVENIO; 	// Digito do Num da conta

            $dadosboleto["carteira"] = $cp->FIN_CCI_CARTEIRA;  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

            // SEUS DADOS
            $dadosboleto["identificacao"] = "";//BoletoPhp - C�digo Aberto de Sistema de Boletos";
            $dadosboleto["cpf_cnpj"] = $im->IMB_IMB_CGC;

            if( $imv->IMB_IMV_NUMAPT <> 0 and $imv->IMB_IMV_NUMAPT <> '' )
                $dadosboleto["endereco"] =  $imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' Apto: '.$imv->IMB_IMV_NUMAPT.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
            else
                $dadosboleto["endereco"] =  $imv->IMB_IMV_ENDERECO.' '.$imv->IMB_IMV_ENDERECONUMERO.' '.$imv->IMB_IMV_ENDERECOCOMPLEMENTO;
            $dadosboleto["cidade_uf"] = $imv->IMB_IMB_CEP.' - '.
                                        $imv->CEP_CID_NOME.
                                        '('.$imv->CEP_UF_SIGLA.')';
            $dadosboleto["cedente"] = $imv->IMB_IMB_NOME;        

            $codigobanco = "001";
            $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
            $nummoeda = "9";
            $fator_vencimento = $this->fator_vencimento( $dadosboleto["data_vencimento"] );
            
            //valor tem 10 digitos, sem virgula
            $valor = $this->formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
            $agencia = $this->formata_numero($dadosboleto["agencia"],4,0);
            $conta = $this->formata_numero($dadosboleto["conta"],8,0);

            $conta_dv =$this->modulo_11($conta);

            $carteira = $dadosboleto["carteira"];

            $agencia_codigo = $agencia."-". $this->modulo_11($agencia) ." / ". $conta ."-". $this->modulo_11($conta);

            $livre_zeros='000000';

            $convenio = $this->formata_numero($dadosboleto["convenio"],7,0);
            // Nosso n�mero de at� 10 d�gitos
            $nossonumero = $this->formata_numero($dadosboleto["nosso_numero"],10,0);


            $dv=$this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
            $linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
            $nossonumero = $convenio.$nossonumero;


            $codigocliente = $this->formata_numero($dadosboleto["codigo_cliente"],10,0);
            $codigoclienteLD = $this->formata_numero($dadosboleto["codigo_cliente"],7,0);

            $dadosboleto["codigo_barras"] = $linha;
            $dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha);
            $dadosboleto["agencia_codigo"] = $agencia_codigo;
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
/*
                if( $par->IMB_PRM_COBMULTANDIAS <> '0' and $par->IMB_PRM_COBMULTANDIAS <> '')
                    $dadosboleto["instrucoes$nInstrucoes"] = 
                    $dadosboleto["instrucoes$nInstrucoes"] .' - '.
                            'Após '.$par->IMB_PRM_COBMULTANDIAS.' dias de vencido, cobrar multa de '.
                        $par->IMB_PRM_COBMULTANDIASPER.'%';
*/
            }

            if( $par->IMB_PRM_COBBANJUROSDIA <> '0' and $par->IMB_PRM_COBBANJUROSDIA <> '')
            {
                $nInstrucoes = $nInstrucoes + 1;
                $dadosboleto["instrucoes$nInstrucoes"] = 'Após o vencimento juros de '.$par->IMB_PRM_COBBANJUROSDIA.'% ao dia';
                if( $par->IMB_PRM_JUROSAPOSUMMES  == 'S' )
                    $dadosboleto["instrucoes$nInstrucoes"] = $dadosboleto["instrucoes$nInstrucoes"] .', apos 30 das de vencido';

                if( $par->IMB_PRM_COBBANCORRECAO <> '0' and $par->IMB_PRM_COBBANCORRECAO <> '')
                $dadosboleto["instrucoes$nInstrucoes"] = 
                    $dadosboleto["instrucoes$nInstrucoes"] .', e '.
                            'Após o vencimento correção monetária de '.$par->IMB_PRM_COBBANCORRECAO.' % ao dia';
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
            $datavencimento = $cp->IMB_CGR_DATAVENCIMENTO;
            

            //Log::info('Por email: '.$poremail );
            //Log::info( 'Emails Originais: '.$email);
            if( $poremail == 'S' )
            {
                //$email = $email.';suporte@compdados.com.br';
                $array = explode(";",$email);
                $banconumber='001';
                foreach( $array as $a )
                {
                    $a=str_replace( ';','',$a);
                    //Log::info( date( 'd/m/Y H:i:s').' - Email para:'.$a );
                    $nomeimobiliaria = $im->IMB_IMB_NOME;

                    $html = view('boleto.001.boleto001', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                    try
                    {

                    Mail::send('boleto.boletoemail', compact( 'dadosboleto', 'im','ctr', 'imv','banconumber' ) ,
                    function( $message ) use ($a, $html,$nossonumero_email, $imovel_log, $contrato_log, $datavencimento, $nomeimobiliaria)
                    {
                        $copiaend = env('APP_MAILBOLETOCOPIA');
                        $message->subject( $nomeimobiliaria.' Informa: Informações sobre próximo vencimento ');
                        app('App\Http\Controllers\ctrRotinas')->gravarObs( $imovel_log, $contrato_log,0,0,0,'Inicio envio Boleto vencimento '.$datavencimento.' enviado para '.$a.' com cópia para '.$copiaend);
                        $a = trim( $a );
                        Log::info('Email encontrado: '.$a );
                        if( $a <>'' and filter_var($a, FILTER_VALIDATE_EMAIL))
                        {

//                            $pdf=PDF::loadHtml( $html,'UTF-8');
  //                                  $message->attachData($pdf->output(), $nossonumero_email.'.pdf');

                            $message->to( $a );
                            $message->cc( $copiaend );
                            //$message->bcc("suporte@compdados.com.br");
                            $message->subject('Aviso de vencimento de aluguel');
                            app('App\Http\Controllers\ctrRotinas')
                            ->gravarObs( $imovel_log, $contrato_log,0,0,0,'Enviado Boleto vencimento '.$datavencimento.' enviado para '.$a.' com cópia para '.$copiaend);

                        }
                    });
                }
                catch (\Illuminate\Database\QueryException $e) {
                    Log::info( 'Erro: '.$e->getCode() );
                }                                        
                }
                //echo "<script>window.close();</script>";
                return response()->json('ok',200);
            }
            else
            {
                $html = view('boleto.001.boleto001', compact( 'dadosboleto', 'im','ctr', 'imv','barcode', 'cpi' ) );
                $pdf=PDF::loadHtml( $html,'UTF-8');
                //$pdf->setPaper('A4', 'portrait');
//                dd('aqui');
                return $pdf->stream('boleto'.$nossonumero.'.pdf');
            }


        }
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


        $codigobanco = "001";
        $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
        $nummoeda = "9";
        $fator_vencimento = $this->fator_vencimento($dven);
        
        //valor tem 10 digitos, sem virgula
        $valor = $this->formata_numero($cg->IMB_CGR_VALOR,10,0,"valor");
        $agencia = $this->formata_numero($conta->FIN_CCI_AGENCIANUMERO,4,0);
        $contacor = $this->formata_numero($conta->FIN_CCI_CONTANUMERO,8,0);
        $conta_dv =$this->modulo_11($contacor);
        $carteira = $conta->FIN_CCI_CARTEIRA;
        

        $agencia_codigo = $agencia."-". $this->modulo_11($agencia) ." / ". $contacor ."-". $this->modulo_11($contacor);

        $livre_zeros='000000';

        $convenio = $this->formata_numero($conta->FIN_CCI_CONVENIO,7,0);
        // Nosso n�mero de at� 10 d�gitos
        $nossonumero = $this->formata_numero( $nossonumero,10,0);
        $nossonumero = $convenio.$nossonumero;

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


                if( $item->IMB_LCF_ID  == 0 or $lf == '' )
                {
                    $eve = mdlTabelaEvento::where( 'IMB_TBE_ID', '=', $item->IMB_TBE_ID )->first();

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
                    $lf->IMB_LCF_INCIRRF         = $eve->IMB_TBE_IRRF;
                    $lf->IMB_LCF_INCTAX          = $eve->IMB_TBE_TAXAADM;
                    $lf->IMB_LCF_INCJUROS        = $eve->IMB_TBE_JUROS;
                    $lf->IMB_LCF_INCCORRECAO     = $eve->IMB_TBE_CORRECAO;
                    $lf->IMB_LCF_GARANTIDO       = 'N';
                    $lf->IMB_LCF_INCISS          = $eve->IMB_TBE_INCISS;
                    $lf->IMB_CLT_IDLOCADOR      = $item->IMB_CLT_ID      ;
                    $lf->IMB_LCF_OBSERVACAO = $item->IMB_LCF_OBSERVACAO;
                    $lf->IMB_LCF_NUMEROCONTROLE = 0;
                    $lf->IMB_LCF_NUMPARREAJUSTE = 0;
                    $lf->IMB_LCF_NUMPARCONTRATO = 0;
                    $lf->IMB_LCF_CHAVE          = 0;
                    $lf->IMB_LCF_REAJUSTAR          = '';
                    $lf->IMB_LCF_NOSSONUMERO = $cgp->IMB_CGR_NOSSONUMERO;
                    $lf->save();


                };

                $lf->IMB_LCF_NOSSONUMERO = $cgp->IMB_CGR_NOSSONUMERO;
                $lf->IMB_CGR_ID = $cgp->IMB_CGR_ID;
                $lf->save();
                
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



            $conteudo = '';

            $conteudo .= 
                        '001'.
                        '0000'.
                        '0'.
                        str_repeat( ' ', 9 ).
                        $cPessoaCEDENTE.
                        $cCGCCedente. //19-32
                        $this->formata_numero( $conta->FIN_CCI_CONVENIO,9,0).
                        '0014'.
                        $this->formata_numero( $conta->FIN_CCI_COBRANCACARTEIRA,2,0).
                        $this->formata_numero( $conta->FIN_CCI_COBRANCAVARIACAO,3,0).
                        str_repeat(' ', 2 ). //33-52
                        $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0).
                        str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //58-58 DV Agencia
                        $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//59-70
                        str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //71-71
                        '0'.//72-72
                        substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30).//73-102
                        str_pad('BANCO DO BRASIL S.A.',30,' ').//103-132
                        str_repeat(' ',10).//133-142
                        '1' . //REMESSA CLIENTE -> BANCO               143-143
                        date( 'dmY' ). //144-151
                        date("his"). //152-157
                        $this->formata_numero($conta->FIN_CCI_COBRANCAARQSEQ,6,0).//158-163
                        '050' . //164-166
                        str_repeat( '0', 5 ). //167-171
                        str_repeat(' ', 69 ).chr(13).chr(10);



            $nRegistroLote = 0;
                    $conteudo .= 
                    '001'. //1-3
                    '0001'.//4-7
                    '1'. //8-8
                    'R'.//9-9
                    '01'.//10-11
                    str_repeat(' ',2). //12-13
                    '042'. //14-16
                    ' './/17-17
                    $cPessoaCEDENTE.//18-18
                    '0'.$cCGCCedente. //19-33
                    $this->formata_numero( $conta->FIN_CCI_CONVENIO,9,0).
                    '0014'.
                    $this->formata_numero( $conta->FIN_CCI_COBRANCACARTEIRA,2,0).
                    $this->formata_numero( $conta->FIN_CCI_COBRANCAVARIACAO,3,0).
                    str_repeat(' ',2). 
                    $this->formata_numero( $conta->FIN_CCI_AGENCIANUMERO,5,0).
                    str_pad( $conta->FIN_CCI_AGENCIADIGITO,1,' '). //58-58 DV Agencia
                    $this->formata_numero( $conta->FIN_CCI_CONCORNUMERO,12,0).//59-70
                    str_pad( $conta->FIN_CCI_CONCORDIGITO,1,' '). //71-71
                    '0'.//72-72
                    substr( str_pad($conta->FIN_CCI_CONCORNOME,30,' '),0,30).//73-102
                    str_repeat(' ', 40 ).
                    str_repeat(' ', 40 ). //144-183
                    $this->formata_numero( $conta->FIN_CCI_COBRANCAARQSEQ,8,0).
                    date( 'dmY' ).  //192-199
                    str_repeat('0', 8 ).//200-207
                    str_repeat(' ',33 ).chr(13).chr(10);
                  
                  
                  
            
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

                $clt = mdlCliente::where('IMB_CLT_CPF','=', $cCgc )->first();
                if( strlen($cCgc) > 11 )
                    $cpessoa = '2';
                else
                    $cpessoa = '1';

                
                $cCgc = $this->formata_numero($cCgc,14,0);

                $cCepLt = $cg->IMV_CGR_CEP;
                $cCepLt = str_replace('.','',$cCepLt);
                $cCepLt = str_replace('-','',$cCepLt);
                $cCepLt = $this->formata_numero($cCepLt,8,0);


                $dataencargos = $cg->IMB_CGR_DATALIMITE;
                $dataencargos = new DateTime($dataencargos);
                $dataencargos->add(new DateInterval('P1D'));

                $dataencargos = ( new DateTime($cg->IMB_CGR_DATALIMITE))->modify('+1 day')->format('Y-m-d');
                $dataencargos = ( new DateTime($dataencargos))->format('dmY');
                $par = mdlParametros::find( Auth::user()->IMB_IMB_ID );
                
                if( $par->IMB_PRM_JUROSAPOSUMMES <> 'S' and $par->IMB_PRM_COBBANJUROSDIA <> 0 and $par->IMB_PRM_COBBANJUROSDIA <> null)
                {
                    $cobrarjuros = '2';
                    $nTaxaJurosMes = $par->IMB_PRM_COBBANJUROSDIA;
                    $cvaljuros = $nTaxaJurosMes * 100;
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
                
    
                if( $par->IMB_PRM_COBBANJUROSDIA <> 0 and $par->IMB_PRM_COBBANJUROSDIA <> null )
                    $nValorJurosDiario = $cg->IMB_CGR_VALOR * $par->IMB_PRM_COBBANJUROSDIA / 100;
                else
                    $nValorJurosDiario = 0;

                
                if( $par->IMB_PRM_COBBANMULTA <> 0 and $par->IMB_PRM_COBBANMULTA <> null )
                {
                    $cobrarmulta = '2';
                    $ntaxamulta = $par->IMB_PRM_COBBANMULTA;
                    $cmulta = $ntaxamulta * 100;
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

                if( $conta->FIN_CCI_IMPRESSAOEENVIO == 'E' )
                {
                    $nossonumero = $this->formata_numero( $cp->IMB_CGR_NOSSONUMERO,10,0);
                    $impressaoenvio = '2';
                }
                else
                {
                    $nossonumero = str_repeat('0',10);
                    $impressaoenvio = '1';

                }


               $nRegistroLote++;
               $nSequencia++;
               $conteudo .=    '001'.
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
                '0'.//37-37
                $this->formata_numero( $conta->FIN_CCI_CONVENIO,7,0).
                $nossonumero. //38-54
                str_repeat( ' ',3 ).//55-57
                '7' . //para carteira simples 17 58-58
                '1' . //59-59
                '1' . //60-60
                '2' . //61-61
                $impressaoenvio. //62-62
                str_pad( $cp->IMB_CGR_ID,15,' ' ).//63-77
                date('dmY', strtotime($cg->IMB_CGR_DATALIMITE )).//78-85
                $cValTot.                          //86-100
                str_repeat('0',5). //101-105
                ' './/106-106
                '17'.//107-108
                'N'. //109-109
                date( 'dmY' ).//110-117
                3 . // 118-118 COBRAR JUROS
                str_repeat('0',8). //119-126
                str_repeat('0',15). //127-141
                $cTipoBon.
                $cDatBon.
                $cValBon. //142-165
                str_repeat('0', 15 ) . //166-180   iof
                str_repeat('0', 15 ) . //181-195  valor abatimento
                str_pad($cp->IMB_CGR_ID,25,' ').//196-220
                '3' . // 221-221codigo protesto
                '00' . // 222-223 numero dias protesto
                '0' . //224-224  codigo baixa devbolução
                str_repeat('0',3 ). //225-227
                '09' . // 228-229  oeda
                str_repeat('0',  10 ). //230-239
                str_repeat(' ',  1 ).chr(13).chr(10);         


                $cdestinatario=substr($cg->IMB_CGR_DESTINATARIO,0,40);
                $cEndereco =substr($cg->IMB_CGR_ENDERECO,0,40);
                $cbairro =substr($cg->IMB_CEP_BAI_NOME,0,15);
                $ccidade =substr($cg->IMB_CEP_CID_NOME,0,15);

                $nRegistroLote++;
                $nSequencia++;
                $conteudo .=    '001'.
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
                        ->tirarEspeciais(  str_pad($ccidade,15) ),15,' '). //137-151
                    str_pad( $cg->CEP_UF_SIGLA,2,' ').//152-153
                    '0' . //154-154
                    str_repeat('0',15 ) . //155-169
                    str_repeat(' ', 40) . //170-209
                    str_repeat('0', 3 ) . //210-212
                    str_repeat(' ', 20 ) . //213-232
                    str_repeat(' ', 8 ). //233-240
                    chr(13).chr(10);

/*                    $nSequencia++;
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
*/


                                        
    }
    $nSequencia++;
    $nTotalFat++;
  
    $nRegistroLote++;
    
    $nSequencia++;
    $conteudo .=  '001'.
                  '0001'. //004-007
                  '5'. //008-008
                  str_repeat(' ', 9 ). //09-17
                  $this->formata_numero($nRegistroLote,6,0 ). //018-23
                  str_repeat(' ', 217 ).     //24-240
                  chr(13).chr(10);
  
    $nSequencia++;
    $conteudo .=    '001'.
                    '9999'. //004-007
                    '9' . //008-008
                    str_repeat( ' ', 9 ). //009-017
                    '000001'.//18-23
                    $this->formata_numero($nSequencia,6,0 ). //24-29
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
                    $id =  trim(substr( $linha, 58,10 ));
//                    //Log::info('ID: '.$id);
                    $nossonumero = substr( $linha, 44,10 );
                    $motivorejeicao = substr( $linha, 213,10 );
                    $ocorrencia =substr( $linha, 15,2 );
                    $valorcobranca = substr( $linha, 81,15 );
                    $datavencimento = substr( $linha, 77,4).'-'.
                                      substr( $linha, 75,2).'-'.
                                      substr( $linha, 73,2);

                    $lregistrada=0;
                    $cgp = mdlCobrancaGeradaPerm::find( $id );

                    Log::info( "vai entrar" );

                    if( $cgp )
                    {
                        
                        
                        $lregistrada = 1;
                        $IMB_CTR_ID=$cgp->IMB_CTR_ID;
                        $ctr = mdlContrato::find( $cgp->IMB_CTR_ID );
                        //Log::info( 'contrato: '.$ctr->IMB_CTR_ID);
                        $IMB_CGR_VENCIMENTOORIGINAL = $cgp->IMB_CGR_VENCIMENTOORIGINAL ;

                        if( $ctr )
                        {
                            //verificar pagagameto
                            $japago = 'N';
                            $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO, $cgp->IMB_CGR_ID  );
                            Log::info( "Valor já pago $valorjapago" );
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

                    }

                };

                if( substr( $linha,13,1 ) == 'U' and $lregistrada == 1)
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
                    if( $datacredito <> '0000-00-00') 
                        $rb->datacredito = $datacredito;
                    $rb->encargos = $encargos;
                    $rb->observacoes = '';
                    $rb->endereco = $endereco;
                    $rb->locatario = $locatario;
                    if( $datavencimento <> '0000-00-00') 
                        $rb->datavencimento = $datavencimento;
                                                
                    if( $datapagamento <> '0000-00-00') 
                        $rb->datapagamento = $datapagamento;
                    $rb->IMB_CTR_ID = $IMB_CTR_ID;
                    $rb->condominio = $condominio;
                    $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    $rb->valorjapago = $valorjapago;
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
                    $rb->pagonaoconfere ='S';                    
                    $rb->IMB_CGR_VENCIMENTOORIGINAL = $IMB_CGR_VENCIMENTOORIGINAL;
                                                            
                    if( $ocorrencia == '06' and $valorjapago == 0)
                        $rb->selecionado = 'S';
                      
                    $rb->save();


                    //setando o status do boleto depois de lido o boleto

                    if( $ocorrencia == '02')
                    {
                        $cgp = mdlCobrancaGeradaPerm::find( $id );
                        $cgp->IMB_CGR_NOSSONUMERO=$nossonumero;
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

                }
                else
                if( substr( $linha,13,1 ) == 'U' and $lregistrada == 0)
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
                if( $cgp )
                {
                    $IMB_CTR_ID=$cgp->IMB_CTR_ID;

                    $japago = 'N';
                    
                    $japago = 'N';
                    $valorjapago = app( 'App\Http\Controllers\ctrReciboLocatario')->boletoJaRecebido( $cgp->IMB_CTR_ID,$cgp->IMB_CGR_NOSSONUMERO, $cgp->IMB_CGR_ID  );
                    if( $valorjapago <> 0 ) 
                        $japago='S';
                    
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
                    $rb->observacoes = '';
                    $rb->endereco = $endereco;
                    $rb->locatario = $locatario;
                    $rb->datavencimento = $datavencimento;
                    $rb->datapagamento = $datapagamento;
                    $rb->IMB_CTR_ID = $IMB_CTR_ID;
                    $rb->condominio = $condominio;
                    $rb->contacorrente = $ccx->FIN_CCX_DESCRICAO;
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    //$rb->valorjapago = $valorjapago;
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;
                                                            
                    if( $ocorrencia == '06')
                    {
                        if( $japago == 'N')
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
                        $cgp->IMB_CGR_DTHINATIVO = date( 'Y/m/d');
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
                    $rb->datacredito = $datacredito;
                    $rb->encargos = intval($encargos);
                    $rb->observacoes = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->endereco = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->locatario = 'NÃO IDENTIFICADO NO RETORNO';
                    $rb->datavencimento = $datavencimento;
                    $rb->datapagamento = $datapagamento;
                    $rb->IMB_CTR_ID = 0;
                    $rb->condominio = 0;
                    $rb->contacorrente = '';
                    $rb->nomedoarquivo = str_replace( 'C:\\fakepath\\','', $nomeoriginal);
                    $rb->FIN_CCX_ID = $ccx->FIN_CCX_ID;

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
    
    function esquerda($entra,$comp){
        return substr($entra,0,$comp);
    }
    
    function direita($entra,$comp){
        return substr($entra,strlen($entra)-$comp,$comp);
    }
    
    function fator_vencimento($data) {
        $data = explode("/",$data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return(abs(( $this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));

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
    
    /*
    #################################################
    FUN��O DO M�DULO 10 RETIRADA DO PHPBOLETO
    
    ESTA FUN��O PEGA O D�GITO VERIFICADOR DO PRIMEIRO, SEGUNDO
    E TERCEIRO CAMPOS DA LINHA DIGIT�VEL
    #################################################
    */
    function modulo_10($num) { 
        $numtotal10 = 0;
        $fator = 2;
     
        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num,$i-1,1);
            $parcial10[$i] = $numeros[$i] * $fator;
            $numtotal10 .= $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            }
            else {
                $fator = 2; 
            }
        }
        
        $soma = 0;
        for ($i = strlen($numtotal10); $i > 0; $i--) {
            $numeros[$i] = substr($numtotal10,$i-1,1);
            $soma += $numeros[$i]; 
        }
        $resto = $soma % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }
    
        return $digito;
    }
    
    /*
    #################################################
    FUN��O DO M�DULO 11 RETIRADA DO PHPBOLETO
    
    MODIFIQUEI ALGUMAS COISAS...
    
    ESTA FUN��O PEGA O D�GITO VERIFICADOR:
    
    NOSSONUMERO
    AGENCIA
    CONTA
    CAMPO 4 DA LINHA DIGIT�VEL
    #################################################
    */
    
    function modulo_11($num, $base=9, $r=0) {

        $soma = 0;
        $fator = 2; 
        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num,$i-1,1);
            $parcial[$i] = $numeros[$i] * $fator;
            $soma += $parcial[$i];
            if ($fator == $base) {
                $fator = 1;
            }
            $fator++;
        }
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            
            //corrigido
            if ($digito == 10) {
                $digito = "X";
            }
    
            /*
            alterado por mim, Daniel Schultz
    
            Vamos explicar:
    
            O m�dulo 11 s� gera os digitos verificadores do nossonumero,
            agencia, conta e digito verificador com codigo de barras (aquele que fica sozinho e triste na linha digit�vel)
            s� que � foi um rolo...pq ele nao podia resultar em 0, e o pessoal do phpboleto se esqueceu disso...
            
            No BB, os d�gitos verificadores podem ser X ou 0 (zero) para agencia, conta e nosso numero,
            mas nunca pode ser X ou 0 (zero) para a linha digit�vel, justamente por ser totalmente num�rica.
    
            Quando passamos os dados para a fun��o, fica assim:
    
            Agencia = sempre 4 digitos
            Conta = at� 8 d�gitos
            Nosso n�mero = de 1 a 17 digitos
    
            A unica vari�vel que passa 17 digitos � a da linha digitada, justamente por ter 43 caracteres
    
            Entao vamos definir ai embaixo o seguinte...
    
            se (strlen($num) == 43) { n�o deixar dar digito X ou 0 }
            */
            
            if (strlen($num) == "43") {
                //ent�o estamos checando a linha digit�vel
                if ($digito == "0" or $digito == "X" or $digito > 9) {
                        $digito = 1;
                }
            }
            return $digito;
        } 
        elseif ($r == 1){
            $resto = $soma % 11;
            return $resto;
        }
    }
    
    /*
    Montagem da linha digit�vel - Fun��o tirada do PHPBoleto
    N�o mudei nada
    */
    function monta_linha_digitavel($linha) {
        // Posi��o 	Conte�do
        // 1 a 3    N�mero do banco
        // 4        C�digo da Moeda - 9 para Real
        // 5        Digito verificador do C�digo de Barras
        // 6 a 19   Valor (12 inteiros e 2 decimais)
        // 20 a 44  Campo Livre definido por cada banco
    
        // 1. Campo - composto pelo c�digo do banco, c�digo da mo�da, as cinco primeiras posi��es
        // do campo livre e DV (modulo10) deste campo
        $p1 = substr($linha, 0, 4);
        $p2 = substr($linha, 19, 5);
        $p3 = $this->modulo_10("$p1$p2");
        $p4 = "$p1$p2$p3";
        $p5 = substr($p4, 0, 5);
        $p6 = substr($p4, 5);
        $campo1 = "$p5.$p6";
    
        // 2. Campo - composto pelas posi�oes 6 a 15 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($linha, 24, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo2 = "$p4.$p5";
    
        // 3. Campo composto pelas posicoes 16 a 25 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($linha, 34, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo3 = "$p4.$p5";
    
        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($linha, 4, 1);
    
        // 5. Campo composto pelo valor nominal pelo valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
        $campo5 = substr($linha, 5, 14);
    
        return "$campo1 $campo2 $campo3 $campo4 $campo5"; 
    }
    
    function geraCodigoBanco($numero) {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }
                
    public function impressaoLote( Request $request )
    {

        $registros = mdlCobrancaGeradaPermSel::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->get();

        $dbl = mdlTmpDadosBoleto::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

        foreach( $registros as $reg )
        {
            $id = $reg->IMB_CGR_ID;
            $cp = mdlCobrancaGeradaPerm::find( $id );
            $cpi = mdlCobrancaGeradaItemPerm::where( 'IMB_CGR_ID','=',$id)->get();

            if( $cp ) 
            {
                    $ctr = mdlContrato::find( $cp->IMB_CTR_ID );
                    $im = mdlImobiliaria::find( $ctr->IMB_IMB_ID );
                    $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
                    $par = mdlParametros::find( $ctr->IMB_IMB_ID );
                    $conta = mdlContaCaixa::find( $cp->FIN_CCR_ID);
                    $objendereco = app('App\Http\Controllers\ctrRotinas')->pegarEnderecoCobranca( $cp->IMB_CTR_ID );
                            
                    //Log::info('Encontrou CP!');


                    // DADOS DO BOLETO PARA O SEU CLIENTE
                    $dias_de_prazo_para_pagamento = 5;
                    $taxa_boleto = 0;
                    $data_venc = date('d/m/Y',strtotime( $cp->IMB_CGR_DATALIMITE) );
                    $data_vencoriginal = date('d/m/Y',strtotime( $cp->IMB_CGR_DATAVENCIMENTO) );
        
                    //$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
                    $valor_cobrado = $cp->IMB_CGR_VALOR; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
                    $valor_boleto= number_format($valor_cobrado, 2, ',', '');

                    $dbl = new mdlTmpDadosBoleto;

                    $dbl->IMB_CGR_ID = $id;
                    $dbl->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $dbl->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $dbl->IMB_IMV_OBJETOLOCACAO =  app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $ctr->IMB_IMV_ID );
                    $dbl->IMB_CGR_VENCIMENTOORIGINAL =  $data_vencoriginal;
                    $dbl->FIN_CCI_BANCONUMERO = "001";
                    $dbl->nosso_numero = $cp->IMB_CGR_NOSSONUMERO;  // Nosso numero - REGRA: M�ximo de 8 caracteres!
                    $dbl->numero_documento = $cp->IMB_CTR_ID;	// Num do pedido ou nosso numero
                    $dbl->data_vencimento = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
                    $dbl->data_documento = date("d/m/Y"); // Data de emiss�o do Boleto
                    $dbl->data_processamento = date("d/m/Y"); // Data de processamento do boleto (opcional)
                    $dbl->valor_boleto = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

                    Log::info('oirifginal '.$data_vencoriginal );
                    // DADOS DO SEU CLIENTE
                    $dbl->sacado = $cp->IMB_CGR_DESTINATARIO;
                    $dbl->sacadocpf = $cp->IMB_CGR_CPF;

                    $dbl->endereco1 =  $objendereco->IMB_CCB_ENDERECO.' '.$objendereco->IMB_CCB_ENDERECONUMERO.' '.$objendereco->IMB_CCB_ENDERECOCOMPLEMENTO;
                    $dbl->endereco2 =   'Cep: '.$objendereco->IMB_CCB_CEP. ' - Bairro: '.$objendereco->IMB_CCB_BAIRRO.' - Cidade: '.$objendereco->CEP_CID_NOME.' - UF: '.$objendereco->CEP_UF_SIGLA;
                    Log::info('bairro: '.$objendereco->IMB_CCB_BAIRRO);
        

                    // INFORMACOES PARA O CLIENTE
                    $dbl->demonstrativo1 = 'DESCRICAO';
                    $dbl->demonstrativo2 = "";
                    $dbl->demonstrativo3 = "";
                    $dbl->instrucoes1 = "";
                    $dbl->instrucoes2 = "";
                    $dbl->instrucoes3 = "";
                    $dbl->instrucoes4 = "";

                    // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
                    $dbl->quantidade = "1";
                    $dbl->valor_unitario = "";
                    $dbl->aceite = "";		
                    $dbl->especie = "R$";
                    $dbl->especie_doc = "DM";

                
                    // DADOS DA SUA CONTA
                    $dbl->agencia = $cp->FIN_CCI_AGENCIANUMERO; // Num da agencia, sem digito
                    $dbl->conta = $cp->FIN_CCI_CONTANUMERO;	// Num da conta, sem digito
                    $dbl->conta_dv = $cp->FIN_CCI_CONTADIGITO; 	// Digito do Num da conta
                    $dbl->codigo_cliente = $cp->FIN_CCI_CODIGOCLIENTE; 	// Digito do Num da conta
                    $dbl->convenio = $conta->FIN_CCI_CONVENIO; 	// Digito do Num da conta

                    $dbl->carteira = $cp->FIN_CCI_CARTEIRA;  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

                    // SEUS DADOS
                    $dbl->identificacao = "";//BoletoPhp - C�digo Aberto de Sistema de Boletos";
                    $dbl->cpf_cnpj = $im->IMB_IMB_CGC;
                    if( $im->IMB_IMV_NUMAPT <> 0 and $im->IMB_IMV_NUMAPT <> '' )
                        $dbl->endereco =  $im->IMB_IMV_ENDERECO.' '.$im->IMB_IMV_ENDERECONUMERO.' Apto: '.$im->IMB_IMV_NUMAPT.' '.$im->IMB_IMV_ENDERECOCOMPLEMENTO;
                    else
                        $dbl->endereco =  $im->IMB_IMV_ENDERECO.' '.$im->IMB_IMV_ENDERECONUMERO.' '.$im->IMB_IMV_ENDERECOCOMPLEMENTO;
                    $dbl->cidade_uf = $im->IMB_IMB_CEP.' - '.
                                                $im->CEP_CID_NOME.
                                                '('.$im->CEP_UF_SIGLA.')';
                    $dbl->cedente = $im->IMB_IMB_NOME;        

                    $codigobanco = "001";
                    $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
                    $nummoeda = "9";
                    $fator_vencimento = $this->fator_vencimento( $dbl->data_vencimento );
                    
                    //valor tem 10 digitos, sem virgula
                    $valor = $this->formata_numero($dbl->valor_boleto,10,0,"valor");
                    $agencia = $this->formata_numero($dbl->agencia,4,0);
                    $conta = $this->formata_numero($dbl->conta,8,0);

                    $conta_dv =$this->modulo_11($conta);

                    $carteira = $dbl->carteira;

                    $agencia_codigo = $agencia."-". $this->modulo_11($agencia) ." / ". $conta ."-". $this->modulo_11($conta);

                    $livre_zeros='000000';

                    $convenio = $this->formata_numero($dbl->convenio,7,0);
                    // Nosso n�mero de at� 10 d�gitos
                    $nossonumero = $this->formata_numero($dbl->nosso_numero,10,0);


                    $dv=$this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
                    $linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
                    $nossonumero = $convenio.$nossonumero;


                    $codigocliente = $this->formata_numero($dbl->codigo_cliente,10,0);
                    $codigoclienteLD = $this->formata_numero($dbl->codigo_cliente,7,0);

                    $dbl->codigo_barras = $linha;
                    $dbl->linha_digitavel = $this->monta_linha_digitavel($linha);
                    $dbl->agencia_codigo = $agencia_codigo;
                    $dbl->nosso_numero = $nossonumero;
                    $dbl->codigo_banco_com_dv = $codigo_banco_com_dv;
                    

                    //PARAMETROS PARA INSTRUÇÕES
                    $nInstrucoes = 0;
                    $dbl->instrucoes2 = '';
                    $dbl->instrucoes1 = '';
                    if( $par->IMB_PRM_COBBANTOLERANCIA <> '0' and $par->IMB_PRM_COBBANTOLERANCIA <> '')
                    {
                        $nInstrucoes = $nInstrucoes + 1;
                        $dbl->instrucoes1 = "Nao receber apos $par->IMB_PRM_COBBANTOLERANCIA dias de vencido";
                    }
                    if( $par->IMB_PRM_COBBANMULTA <> '0' and $par->IMB_PRM_COBBANMULTA <> '')
                    {
                        $nInstrucoes = $nInstrucoes + 1;
                        $dbl->instrucoes1 = $dbl->instrucoes1.' Multa de '.$par->IMB_PRM_COBBANMULTA.'% apos vencimento';

                        if( $par->IMB_PRM_COBMULTANDIAS <> '0' and $par->IMB_PRM_COBMULTANDIAS <> '')
                        $dbl->instrucoes2=
                                    'Após '.$par->IMB_PRM_COBMULTANDIAS.' dias de vencido, cobrar multa de '.
                                $par->IMB_PRM_COBMULTANDIASPER.'%';

                    }

                    if( $par->IMB_PRM_COBBANJUROSDIA <> '0' and $par->IMB_PRM_COBBANJUROSDIA <> '')
                    {
                        $dbl->instrucoes2 = $dbl->instrucoes2 . 'Apos o vencimento juros de '.$par->IMB_PRM_COBBANJUROSDIA.'% ao dia';
                        if( $par->IMB_PRM_JUROSAPOSUMMES  == 'S' )
                            $dbl->instrucoes2 = $dbl->instrucoes2 .', apos 30 das de vencido';

                        if( $par->IMB_PRM_COBBANCORRECAO <> '0' and $par->IMB_PRM_COBBANCORRECAO <> '')
                        $dbl->instrucoes2 =
                        $dbl->instrucoes2 .', e '.
                                    'Apos o vencimento correcao monetaria de '.$par->IMB_PRM_COBBANCORRECAO.' % ao dia';
                    }
                    if( $cp->IMB_CGR_VALORPONTUALIDADE > 0 )
                    {
                        $nInstrucoes = $nInstrucoes + 1;
                        $dbl->instrucoe1 = $dbl->instrucoe1.'   **ATENCAO** Ate o vencimento desconto de '.number_format($cp->IMB_CGR_VALORPONTUALIDADE, 2, ',', '');
                    }
        
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    $barcode = $generator->getBarcode($dbl->codigo_barras, $generator::TYPE_INTERLEAVED_2_5);
                    $nossonumero_email=$dbl->nosso_numero;
                    $imovel_log = $ctr->IMB_IMV_ID;
                    $contrato_log = $ctr->IMB_CTR_ID;
                    $datavencimento = $cp->IMB_CGR_DATAVENCIMENTO;

                    $imovel_log = $ctr->IMB_IMV_ID;
                    $contrato_log = $ctr->IMB_CTR_ID;
                    $dbl->valor_boleto_impresso = number_format( $valor_cobrado,2,',','.');
                    $dbl->barcode = $barcode;
                    $dbl->save();
                }
        }

        $dbl = mdlTmpDadosBoleto::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->orderBy('data_vencimento')
        ->orderBy('sacado')
        ->get();
  
        $html = view('boleto.001.boleto001lote', compact( 'dbl'));
        return $html;
        $pdf=PDF::loadHtml( $html,'UTF-8');
        //$pdf->setPaper('A4', 'portrait');
//                dd('aqui');
        $dbl = mdlCobrancaGeradaPermSel::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

        return $pdf->stream('boletos.pdf');
    }

}   