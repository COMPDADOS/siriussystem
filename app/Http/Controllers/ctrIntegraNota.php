<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Http;
use CloudDfe\SdkPHP\Nfse;
use Illuminate\Http\Request;

use App\mdlNFSE;
use App\mdlReciboLocador;
use App\mdlImobiliaria;
use App\mdlParametros;
use App\mdlParametros2;
use App\mdlCliente;
use DOMDocument;;
use Auth;
use DataTables;
use Log;
use DB;

class ctrIntegraNota extends Controller
{
    public function index()
    {
        return view( 'nfe.nfseindex');
    }

    public function gerarNfs( Request $request  )
    {   

        $numerorecibo = $request->recibo;

        

        $recibo = mdlReciboLocador::where( 'IMB_RLD_NUMERO','=', $numerorecibo )->first();

        if(  $recibo == '') return '';

        $parm = mdlParametros::where( 'IMB_IMB_ID','=', $recibo->IMB_IMB_ID2 )->first();
        $parm2 = mdlParametros2::where( 'IMB_IMB_ID','=', $recibo->IMB_IMB_ID2 )->first();

        if( $parm->IMB_PRM_RETERISSTAXACONTRATO == 'S' )
            $eventos = '6,-6,7,25';        
        else
            $eventos = '6,-6';        

        $imb = mdlImobiliaria::where( 'IMB_IMB_ID','=', $recibo->IMB_IMB_ID2 )->first();
        $endereco = app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $recibo->IMB_IMV_ID );

        $valorservicodeb = mdlRecibolocador::where( 'IMB_RLD_NUMERO','=', $numerorecibo )
        ->where( 'IMB_RLD_LOCADORCREDEB','=', 'D' )
        ->whereRaw( "IMB_TBE_ID in ( $eventos)" )
        ->whereNull( 'IMB_RLD_DTHINATIVO')
        ->sum('IMB_RLD_VALOR');
        

        $valorservicocre = mdlRecibolocador::where( 'IMB_RLD_NUMERO','=', $numerorecibo )
        ->where( 'IMB_RLD_LOCADORCREDEB','=', 'C' )
        ->whereRaw( "IMB_TBE_ID in ( $eventos)" )
        ->whereNull( 'IMB_RLD_DTHINATIVO')
        ->sum('IMB_RLD_VALOR');

        $valoretencao =  mdlRecibolocador::where( 'IMB_RLD_NUMERO','=', $numerorecibo )
        ->where( 'IMB_TBE_ID','=', '57' )
        ->whereNull( 'IMB_RLD_DTHINATIVO')
        ->sum('IMB_RLD_VALOR');

        $temretencao = false;
        if( $valoretencao > 0 )  $temretencao = true;

        Log::info('Tem retenção: '.$temretencao );
        $valorservico = $valorservicodeb - $valorservicocre;

        Log::info( $valorservico );

        if( $valorservico <= 0) return '';
        
       
        $aliquota = 0;
        $aliquotacodigo = '1005';
        if( $parm->IMB_PRM_ISSALIQUOTA <> 0 )
        {
            $aliquota           = $parm->IMB_PRM_ISSALIQUOTA;
            $aliquotacodigo = '1711';

        }


        if( $parm->IMB_PRM_ISSALIQUOTA1005 <> 0 )
        {
            $aliquota           = $parm->IMB_PRM_ISSALIQUOTA1005;
            $aliquotacodigo = '1005';

        }


        $valoriss = $valorservico * $aliquota / 100;
        $numerorps = intval($numerorecibo);
        //if( $numerorps > 2000000 )
          //  $numerorps = strval($numerorecibo - 2100000);
        Log::info( "rps $numerorps");

        $cli = mdlCliente::where('IMB_CLT_ID','=', $recibo->IMB_CLT_ID)->first();
        $numeroendereco = $cli->IMB_CLT_RESENDNUM;
        if( $numeroendereco == '' )
            $numeroendereco='0';
        $numeroendereco = str_replace( $numeroendereco,'-','0');

        Log::info( "cliente: ".$cli->IMB_CLT_NOME);
        $clicpf = null;
        $clicnpj = null;
        
        if( $cli->IMB_CLT_PESSOA == 'F' ) 
            $clicpf = $cli->IMB_CLT_CPF;
        if( $cli->IMB_CLT_PESSOA == 'J' )
        { 
            $clicnpj = $cli->IMB_CLT_CPF;
            $temretencao = true;
            if( $valorretencao = 0 ) 
              $aliquota = 0;
        }

        try {
            $params = [
                'token' => $parm2->IMB_PRM_TOKENNFS,
                'ambiente' => Nfse::AMBIENTE_PRODUCAO,
                'options' => [
                    'debug' => false,
                    'timeout' => 60,
                    'port' => 443,
                    'http_version' => CURL_HTTP_VERSION_NONE
                ]
            ];
            Log::info('Passei pelo params');
            Log::info( 'serie: '.$parm2->IMB_PRM_NOTASERIE);
            $nfse = new Nfse($params);
            //dados do RPS para emissão da NFSe
            Log::info('instanciei nfsw');

            Log::info('Aliquota '.$aliquota);

            $payload = [
                "numero" => strval($numerorps),
                "serie" => $parm2->IMB_PRM_NOTASERIE,
                "tipo" => "1",
                "status" => "1",
                "data_emissao" => strval( date('Y-m-d').'T'.date('H:i:s').'-03:00'),
                "data_competencia" =>strval($recibo->IMB_RLD_DATAPAGAMENTO.'T'.date('H:i:s').'-03:00'), 
                "tomador" => [
                    "cnpj" => strval($clicnpj),
                    "cpf" => strval($clicpf) ,
                    "im" => null,
                    "razao_social" => $cli->IMB_CLT_NOME,
                    "endereco" => [
                        "logradouro" => $cli->IMB_CLT_RESEND,
                        "numero" => $numeroendereco,
                        "complemento" => $cli->IMB_CLT_RESCOM,
                        "bairro" => $cli->CEP_BAI_NOMERES,
                        "codigo_municipio" => $cli->IMB_CLT_CIDADEIBGE,
                        "uf" =>$cli->CEP_UF_SIGLARES ,
                        "cep" => $cli->IMB_CLT_RESENDCEP
                    ]
                ],
                "servico" => [
                    "codigo" => $aliquotacodigo,
                    "codigo_tributacao_municipio" => $aliquotacodigo,
                    "discriminacao" => "Administração do imóvel ".$endereco,
                    "codigo_municipio" => $parm2->IMB_PRM_CODIGOIBGE,
                    "valor_servicos" => $valorservico,
                    "valor_pis" => "0.00",
                    "valor_cofins" => "0.00",
                    "valor_inss" => "0.00",
                    "valor_ir" => "0.00",
                    "valor_csll" => "0.00",
                    "valor_outras" => "0.00",
                    //"valor_aliquota" => $aliquota,
                    "valor_iss" => $valoretencao,
                    "valor_aliquota" => $aliquota,
                    "valor_desconto_incondicionado" => "0.00",
                    "iss_retido" => $temretencao,
                    "exigibilidade_iss"=> "1"
                ],
                "intermediario" => [
                    "cnpj" => "22143913000108",
                    "cpf" => null,
                    "im" => null,
                    "razao_social" => "Compdados Tecnologia em Sistemas Ltda"
                ]
            ];
            Log::info('passei pela monagem do payload');
            //var_dump( $payload);
            $resp = $nfse->cria($payload);

            Log::info('Sucesso: '.$resp->sucesso);
            Log::info('Codigo: '.$resp->codigo);

 
            //dd( $resp );
          
            if ($resp->sucesso) 
            {
              
                //baixarXml($request );
                $chave = $resp->chave;
                if ($resp->codigo == 5023) {
                    /**
                     * Existem alguns provedores assincronos, necesse cenario a api
                     * sempre ira devolver o codigo 5023, após esse retorno
                     * é necessario buscar a NFSe pela chave de acesso
                     */
                    sleep(60);
                    $tentativa = 1;
                    while ($tentativa <= 5) {
                        $payload = [
                            'chave' => $chave
                        ];
                        $resp = $nfse->consulta($payload);
                        if ($resp->codigo != 5023) {
                            if ($resp->sucesso) {
                                // autorizado
                                $nfse = new mdlNFSE;
            	                $nfse->IMB_NFE_NOTA = $resp->numero;
	                            $nfse->IMB_NFE_SERIE = $parm2->IMB_PRM_NOTASERIE;
	                            $nfse->IMB_NFE_DATAEMISSAO = date('Y/m/d');
                                $nfse->IMB_NFE_VALORISS = $valoriss;
	                            $nfse->IMB_RLD_NUMERO = $numerorecibo;
	                            $nfse->IMB_NFE_VALORNOTA = $valorservico;
	                            $nfse->IMB_NFE_VALORISSBASE = $valorservico;
	                            $nfse->IMB_NFE_VALORRETENCAO = $valoretencao;
	                            $nfse->IMB_NFE_DATAPAGAMENTO = $recibo->IMB_RLD_DATAPAGAMENTO;
	                            $nfse->IMB_ATD_IDEMISSAO = Auth::user()->IMB_ATD_ID;
	                            $nfse->IMB_NFE_DTHATIVO = date( 'Y/m/d H:i:s');
	                            $nfse->IMB_CLT_ID = $recibo->IMB_CLT_ID;
	                            $nfse->IMB_CLT_PESSOA =$cli->IMB_CLT_PESSOA;
	                            $nfse->IMB_CLT_NOME = $cli->IMB_CLT_NOME;
	                            $nfse->IMB_CLT_ENDERECO= $cli->IMB_CLT_RESEND;
	                            $nfse->IMB_CLT_CPF= $cli->IMB_CLT_CPF;
	                            $nfse->IMB_CLT_CIDADE= $cli->CEP_CID_NOMERES;
	                            $nfse->IMB_CLT_ESTADO= $cli->CEP_UF_SIGLARES;
	                            $nfse->IMB_CLT_CEP = $cli->IMB_CLT_RESENDCEP;           
	                            $nfse->IMB_CLT_CODIGOCIDADEIBGER = $cli->IMB_CLT_CIDADEIBGE;
	                            $nfse->IMB_PRM_RPSNUMERO = $numerorecibo;
	                            $nfse->IMB_NFE_CHAVE = $resp->chave;
                                $nfse->save();
                                return response()->json( 'Gerada',200);
                                
                            } else {
                                // rejeição
                                var_dump($resp);
                                break;
                            }
                        }
                        sleep(5);
                        $tentativa++;
                    }
                } else {
                    // autorizado
                    
                    $nfse = new mdlNFSE;

	                $nfse->IMB_NFE_NOTA = $resp->numero;
	                $nfse->IMB_NFE_SERIE = $parm2->IMB_PRM_NOTASERIE;
	                $nfse->IMB_NFE_DATAEMISSAO = date('Y/m/d');
                    $nfse->IMB_NFE_VALORISS = $valoriss;
	                $nfse->IMB_RLD_NUMERO = $numerorecibo;
	                $nfse->IMB_NFE_VALORNOTA = $valorservico;
	                $nfse->IMB_NFE_VALORISSBASE = $valorservico;
	                $nfse->IMB_NFE_VALORRETENCAO = $valoretencao;
	                $nfse->IMB_NFE_DATAPAGAMENTO = $recibo->IMB_RLD_DATAPAGAMENTO;
	                $nfse->IMB_ATD_IDEMISSAO = Auth::user()->IMB_ATD_ID;
	                $nfse->IMB_NFE_DTHATIVO = date( 'Y/m/d H:i:s');
	                $nfse->IMB_CLT_ID = $recibo->IMB_CLT_ID;
	                $nfse->IMB_CLT_PESSOA =$cli->IMB_CLT_PESSOA;
	                $nfse->IMB_CLT_NOME = $cli->IMB_CLT_NOME;
	                $nfse->IMB_CLT_ENDERECO= $cli->IMB_CLT_RESEND;
	                $nfse->IMB_CLT_CPF= $cli->IMB_CLT_CPF;
	                $nfse->IMB_CLT_CIDADE= $cli->CEP_CID_NOMERES;
	                $nfse->IMB_CLT_ESTADO= $cli->CEP_UF_SIGLARES;
	                $nfse->IMB_CLT_CEP = $cli->IMB_CLT_RESENDCEP;
	                $nfse->IMB_CLT_CODIGOCIDADEIBGER = $cli->IMB_CLT_CIDADEIBGE;
	                $nfse->IMB_PRM_RPSNUMERO = $numerorecibo;
	                $nfse->IMB_NFE_CHAVE = $resp->chave;
                    $nfse->save();
                    return response()->json( 'Gerada',200);

                    
//                    var_dump($resp);
//                    var_dump($resp);
                    
                }
                } else if (in_array($resp->codigo, [5001, 5002])) 
                {
                // erro nos campos
                var_dump($resp->erros);
                } else if ($resp->codigo == 5008 or $resp->codigo >= 7000) {
                $chave = $resp->chave;
                // >= 7000 erro de timout ou de conexão
                // 5008 documento já criado
                var_dump($resp);
                $payload = [
                    'chave' => $chave
                ];
                // recomendamos fazer a consulta pela chave para sincronizar o documento
                $resp = $nfse->consulta($payload);
                if ($resp->sucesso) {
                    // autorizado

                    var_dump($resp);
                } else {
                    // rejeição
                    var_dump($resp);
                }
            } else {
                // rejeição
            //    var_dump($resp);
            }
        } catch (\Exception $e) {
            return  $e->getMessage();
        }        
    
    
}

public function cancelaNfes( Request $request)
{
    $chave = $request->chave;
    
    $parm = mdlParametros::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();
    $parm2 = mdlParametros2::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();
    if( $chave=='' ) 
        return response()->json( 'Chave não informada',404);

    try {
        $params = [
            'token' => $parm2->IMB_PRM_TOKENNFS,  
            'ambiente' => Nfse::AMBIENTE_PRODUCAO,
            'options' => [
                'debug' => false,
                'timeout' => 60,
                'port' => 443,
                'http_version' => CURL_HTTP_VERSION_NONE
            ]
        ];
        $nfse = new Nfse($params);
        $payload = [
            'chave' => strval($chave),
            'justificativa' => 'Erro nas informações', //minimo de 15 caracteres
            'codigo_cancelamento' => '1'
        ];
      
        //os payloads são sempre ARRAYS
        $resp = $nfse->cancela($payload);
        dd( $resp );
   
        if( $resp->sucesso)
        {
            $emitida = mdlNFSE::where( 'IMB_NFE_CHAVE','=', strval($chave));
            if( $emitida )
            {
                $emitida->IMB_NFE_DATACANCELAMENTO = date( 'Y/m/d');
                $emitida->IMB_NFE_MOTIVOCANCELAMENTO = 'Erro nas informações';
                $emitida->IMB_ATD_IDCANCELAMENTO = Auth::user()->IMB_ATD_ID;
                $emitida->save();
                return response()->json('ok',200);
            }
            else
               return response()->json('Chave não localizada',404 );

        }
    
    } catch (\Exception $e) {
        echo $e->getMessage();
    }        

}
public function gerarPdf( Request $request )
{
    $chave = $request->chave;
    if( $chave=='' ) 
        return response()->json( 'Chave não informada',404);

        $parm = mdlParametros::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();
        $parm2 = mdlParametros2::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();

    try {
        $params = [
            'token' => $parm2->IMB_PRM_TOKENNFS,
            'ambiente' => Nfse::AMBIENTE_PRODUCAO,
            'options' => [
                'debug' => false,
                'timeout' => 60,
                'port' => 443,
                'http_version' => CURL_HTTP_VERSION_NONE
            ]
        ];
        $nfse = new Nfse($params);
        $payload = [
            'chave' => strval($chave)
        ];
        //os payloads são sempre ARRAYS
        $resp = $nfse->consulta($payload);
        $resp = $resp->pdf;

        //dd( $resp );
        return view( 'nfe.nfsepdfview',compact( 'resp') );
        //$pdf = base64_decode( $resp->pdf, tru e );
        
        
        

    } catch (\Exception $e) {
        echo $e->getMessage();
    }        

}

    public function listNotas( Request $request )
    {

        $datainicio = $request->inicio;
        $datafim = $request->termino;
        if( $datainicio == '' ) $datainicio = date('Y/m/d');
        if( $datafim == '' ) $datafim = date('Y/m/d');
        $nfs = DB::table('IMB_RECIBOLOCADOR')->distinct()
        ->where( 'IMB_RLD_DATAPAGAMENTO','>=', $datainicio )
        ->where( 'IMB_RLD_DATAPAGAMENTO','<=', $datafim )
        ->whereNull('IMB_RLD_DTHINATIVO')
        ->get(
            [  
                DB::raw( '( select IMB_NFE_NOTA FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_NOTA'),
                DB::raw( '( select IMB_NFE_DATAEMISSAO FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_DATAEMISSAO'),
                'IMB_RECIBOLOCADOR.IMB_RLD_NUMERO',
                DB::raw( '( select IMB_NFE_VALORNOTA FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_VALORNOTA'),
                DB::raw( '( select IMB_NFE_VALORISSBASE FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_VALORISSBASE'),
                DB::raw( '( select IMB_NFE_VALORRETENCAO FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_VALORRETENCAO'),
                DB::raw( '( select SUM( IMB_RLD_VALOR) FROM IMB_RECIBOLOCADOR X WHERE X.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO AND IMB_TBE_ID IN(6,-6) ) TOTALTAXAADM '),
                DB::raw( '( select SUM( IMB_RLD_VALOR) FROM IMB_RECIBOLOCADOR X WHERE X.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO AND IMB_TBE_ID IN(7,25) ) TOTALTAXACONT '),
                'IMB_RLD_DATAPAGAMENTO',

                DB::raw( '( select IMB_NFE_DATACANCELAMENTO FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_DATACANCELAMENTO'),
                DB::raw( '( select IMB_PRM_RPSNUMERO FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_PRM_RPSNUMERO'),
                DB::raw( '( select IMB_NFE_CHAVE FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_CHAVE'),
                DB::raw( '( select IMB_NFE_VALORISS FROM IMB_NFES WHERE IMB_NFES.IMB_RLD_NUMERO = IMB_RECIBOLOCADOR.IMB_RLD_NUMERO LIMIT 1) IMB_NFE_VALORISS'),
                DB::raw( '(select IMB_CLT_NOME FROM IMB_CLIENTE
                        where  IMB_CLIENTE.IMB_CLT_ID =IMB_RECIBOLOCADOR.IMB_CLT_ID LIMIT 1 ) AS IMB_CLT_NOME' ),
                DB::raw( '(select imovel( IMB_RECIBOLOCADOR.IMB_IMV_ID ) FROM IMB_IMOVEIS
                        WHERE IMB_IMOVEIS.IMB_IMV_ID =IMB_RECIBOLOCADOR.IMB_IMV_ID LIMIT 1 ) AS ENDERECO' ),
                DB::raw( '(select IMB_IMV_RELIRRF FROM IMB_IMOVEIS
                        where  IMB_IMOVEIS.IMB_IMV_ID =IMB_RECIBOLOCADOR.IMB_IMV_ID LIMIT 1 ) AS IMB_IMV_RELIRRF' ),

                ]
        );

        return DataTables::of($nfs)->make(true);



    }

    public function mostrarDadosNova( Request $request )
    {
        try {
            //defina os parametros basicos
            $params = [
                'token' => $parm2->IMB_PRM_TOKENNFS,
                'ambiente' => Nfe::AMBIENTE_PRODUCAO,
                'options' => [
                    'debug' => false,
                    'timeout' => 60,
                    'port' => 443,
                    'http_version' => CURL_HTTP_VERSION_NONE
                ]
            ];
            //instancie a classe para a operação desejada
            $nfe = new Nfe($params);
        
            //realize a operação desejada
            $resp = $nfe->status();
        
            //$resp irá conter um OBJETO stdClass com o retorno da API
            echo "<pre>";
            print_r($resp);
            echo "</pre>";
        
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    
    public function gerarXML( Request $request )
    {
        $chave = $request->chave;
        if( $chave=='' ) 
            return response()->json( 'Chave não informada',404);

            $parm = mdlParametros::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();
            $parm2 = mdlParametros2::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();

        try {
            $params = [
                'token' => $parm2->IMB_PRM_TOKENNFS,                
                'ambiente' => Nfse::AMBIENTE_PRODUCAO,
                'options' => [
                    'debug' => false,
                    'timeout' => 60,
                    'port' => 443,
                    'http_version' => CURL_HTTP_VERSION_NONE
                ]
            ];
            $nfse = new Nfse($params);
            $payload = [
                'chave' => strval($chave)
            ];
            //os payloads são sempre ARRAYS
            $resp = $nfse->consulta($payload);
            $numero = $resp->numero;
            //dd( $resp );
            $resp = $resp->xml;
            $decoded_string = base64_decode($resp );

            // Create a new DOMDocument object and load the decoded string into it.
            $dom_document = new \DOMDocument();
            $dom_document->loadXML($decoded_string);
          
            // Set the Content-Type header to application/xml.
            header('Content-Type: application/xml');
          
            // Set the Content-Disposition header to attachment; filename="xml_file.xml".
            header("Content-Disposition: attachment; filename=XML_$numero.xml");
          
            // Echo the DOMDocument object's saveXML() method to the output buffer.
            echo $dom_document->saveXML();
          
            // Flush the output buffer to send the file to the browser.
            flush();
            //$pdf = base64_decode( $resp->pdf, tru e );
            
            
            

        } catch (\Exception $e) {
            echo $e->getMessage();
        }        

    }

}