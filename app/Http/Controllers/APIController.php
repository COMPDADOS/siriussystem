<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class APIController extends Controller
{
    public function token()
    {

        
        $guzzle = new \GuzzleHttp\Client(
            [
                'headers' => [
                    'gw-dev-app-key' => config('apiCobranca.gw_dev_api_key'),
                    'authorization' => config('apiCobranca.authorization'),
                    'content-type' => 'application/x-www-form-urlencoded'

                ],
                'verify' => false
            ]
        );

         $response = $guzzle->request( 'POST', 
         'https://oauth.hm.bb.com.br/oauth/token?gw-dev-app-key='.config('apiCobranca.gw_dev_api_key').'&grant_type=client_credentials',
         [
            'body' => json_encode(
                [
                'client_id' => config('apiCobranca.client_id'),
                'client_secret' => config('apiCobranca.client_secret'),
                'scope' => 'cobrancas.boletos-info cobrancas.boletos-requisicao'
            ])
        ]);
        
        $body = $response->getBody();
        $contents = $body->getContents();

        $token = json_decode($contents);

        return  $token->access_token;
        
    }

    public function registrar()
    {
        $body = array(
                "numeroConvenio"=> 3128557,
                "numeroCarteira"=> 17,
                "numeroVariacaoCarteira"=> 35,
                "codigoModalidade"=> 1,
                "dataEmissao"=> date('d.m.Y'),
                "dataVencimento"=> "10.01.2024",
                "valorOriginal"=> 123.45,
                "valorAbatimento"=> 0,
                "quantidadeDiasProtesto"=> 0,
                "quantidadeDiasNegativacao"=> 0,
                "orgaoNegativador"=> 0,
                "indicadorAceiteTituloVencido"=> "S",
                "numeroDiasLimiteRecebimento"=> 5,
                "codigoAceite"=> "N",
                "codigoTipoTitulo"=> 2,
                "descricaoTipoTitulo"=> "ALUGUEL->DASDS ASDAS AD",
                "indicadorPermissaoRecebimentoParcial"=> "N",
                "numeroTituloBeneficiario"=> "665969",
                "campoUtilizacaoBeneficiario"=> "",
                "numeroTituloCliente"=> "00031285570000969698",
                "mensagemBloquetoOcorrencia"=> "ASDSADASDA ADAS DSD",
                "multa" => array(
                  "tipo"=> 1,
                  "data"=> "11.01.2024",
                  "porcentagem"=> 0,
                  "valor"=> 10
                ),
                "pagador" => array (
                  "tipoInscricao"=> 2,
                  "numeroInscricao"=> 74910037000193,
                  "nome"=> "asdasdasdas ",
                  "endereco"=> "ASDAS AASDASD ASDA DA1",
                  "cep"=> 17018100,
                  "cidade"=> "Bauru",
                  "bairro"=> "samambaia",
                  "uf"=> "SP",
                  "telefone"=> "14991857709"
                )
            );

            $body = json_encode( $body );

            var_dump( $this->token());
            try {
                $guzzle = new  \GuzzleHttp\Client( 
                        [
                            'headers' => [
                                'Authorization' => 'Bearer '.$this->token(),
                                'Content-Type' => 'application/json',
                            ],
                            'verify' =>false
                        ]);
                        
                $response = $guzzle->request('POST','https://api.hm.bb.com.br/cobrancas/v2/boletos?gw-dev-app-key='.config('apiCobranca.gw_dev_api_key'),
                [
                    'body' => $body

                ]);

                $body = $response->getBody();

                $contents = $body->getContents();

                $boleto = json_decode( $contents); 

                dd( $boleto );

                } catch ( \Exception $e ) {

                    echo $e->getMessage();
                

            }


    }

    public function listar()
    {
        try
        {
            $guzzle = new \GuzzleHttp\Client( 
                [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->token(),
                        'Content-Type' => 'application/json',
                    ],
                    'verify' =>false
                ]);

                $response = $guzzle->request('GET','https://api.hm.bb.com.br/cobrancas/v2/boletos?gw-dev-app-key='.config('apiCobranca.gw_dev_api_key').
                '&indicadorSituacao='.'A'.
                '&agenciaBeneficiario='.'452'.
                '&contaBeneficiario='.'123873'.
                '&incide='.'300'.
                '&dataInicioVencimento='.'01.01.2024'.
                '&dataFimVencimento='.'01.02.2024');

                $body = $response->getBody();

                $contents = $body->getContents();

                $boleto = json_decode( $contents); 

                dd( $boleto);

        }
         catch ( \Exception $e ) 
         {
            echo $e->getMessage();
    

        }

        
    }    

    public function consultar()
    {
        $id = '00031285570000969698';
        try
        {
            $guzzle = new \GuzzleHttp\Client( 
                [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->token(),
                        'Content-Type' => 'application/json',
                    ],
                    'verify' =>false
                ]);

                $response = $guzzle->request('GET','https://api.hm.bb.com.br/cobrancas/v2/boletos/'.
                $id.
                '?gw-dev-app-key='.config('apiCobranca.gw_dev_api_key').
                '&numeroConvenio='.'3128557');

                $body = $response->getBody();

                $contents = $body->getContents();

                $boleto = json_decode( $contents); 

                dd( $boleto);

        }
         catch ( \Exception $e ) 
         {
            echo $e->getMessage();
    

        }

        
    }        

    public function baixar()
    {
        $id = '00031285570000969697';
        try
        {
            $guzzle = new \GuzzleHttp\Client( 
                [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->token(),
                        'Content-Type' => 'application/json',
                    ],
                    'verify' =>false
                ]);

                $response = $guzzle->request('POST','https://api.hm.bb.com.br/cobrancas/v2/boletos/'.
                $id.'/baixar'.
                '?gw-dev-app-key='.config('apiCobranca.gw_dev_api_key'),
                [
                    'body' => json_encode(
                        [
                            'numeroConvenio' => 3128557
                        ])
                ]);

                $body = $response->getBody();

                $contents = $body->getContents();

                $boleto = json_decode( $contents); 

                dd( $boleto);

        }
         catch ( \Exception $e ) 
         {
            echo $e->getMessage();
    

        }
        
    }        

    public function atualizar()
    {
        
    }    
}
