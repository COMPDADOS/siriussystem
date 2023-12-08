<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoImovel;
use App\mdlContrato;
use App\mdlCobrancaGeradaPerm;
use App\mdlLocatarioContrato;
use App\mdlImovel;
use App\mdlCliente;
use App\mdlPropImovel;
use App\mdlWSMessages;
use stdClass;
use DB;
use Image;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use Asmpkg\Ofx;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;
use File;
use PDF;
use Picqer;
use DateTime;
use SplFileObject;
use SoapClient;
use Soap;
use Log;
use Illuminate\Support\Facades\Http;

class ctrTeste extends Controller
{

    public function variavel()
    {
        $cont=1;
        $pre = "locador_$cont";
        $$pre = 'sou o locador 1 ';
        echo $pre;
    }
    public function enviarSOAP()
    {
        $url ="https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl";
        $customers = Soap::to( $url)
        ->consultaCEP(['cep' => '17018100']);

        dd( $url );
        
    }

    public function marca()
    {
        /*
        $img = Image::make('/home/oisistema/sys/storage/app/public/images/background.png');

        $img->insert(env('WATERMARK'), 'left-right', 10, 10);
    
        $img->save('/home/oisistema/sys/storage/app/public/images/new-image.png');
        */

        return view( 'testes.teste');
    }


    /*
        
        $img = Image::make(public_path('images/background.png'));

        $img->insert(public_path('images/watermark.png'), 'bottom-right', 10, 10);

        $img->save(public_path('images/new-image.png'));

        $img->encode('png');
        $type = 'png';
        $new_image = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return view('show_watermark', compact('new_image'));
    */

    public function dragDrop()
    {

        return view( 'testes.dragdrop');
    }
    
    public function upload( Request $request )
    {


        $image = $request->file('file');

        $imageName = 'sirius'.(rand(10,1000000)). '.' . $image->extension();

        $image->move( public_path( 'images'), $imageName );
        
        return response()->json( ['success' => $imageName]);


        

    }

    public function curl()
    {   
        

        $response = Http::post('https://compdados.besoft.com.br/painel/api/web/auth/token/login/', [
            'username' => 'demetrius',
            'password' => 'vistorias2022'
        ]);
        
        if ($response->failed()) 
        {
           // return failure
        } else 
        {
           // return success
        }
        
///        var_dump(json_decode($response));
        //$r = json_decode($response, true);
        $r = $response;

        return $r['auth_token'];

    }

    public function lerXml( )
    {

        $link = "https://www.redentora-miami.com.br/sys/storage/dados.xml";
        $xml = simplexml_load_file($link);

        $imv = mdlImovel::where( 'IMB_IMV_REFERE', '<>', 'CA0001')
        ->where( 'IMB_IMV_REFERE', '<>', 'CA0002')
        ->delete();


        foreach( $xml as $imovel)
        {
            $transacao = $imovel->transacao;
            if( $transacao == 'Locação' )
                echo '<br>'.$imovel->id. ' Imóvel para locação valor: '.$imovel->valor;
        }

      

    }

    public function testeWord()
    {
        $templateProcessor = new TemplateProcessor(Storage::path('/public/teste.docx'));
            $templateProcessor->setValues(
                [
                    'LONGTEXT' =>'22333333'
                ]
            );
//            dd( storage_path());

            $filename = storage_path() . '/app/public/dcontrato.docx';
            $templateProcessor->saveAs($filename);
    }

    public function criarRequest()
    {
        $request = new Request;
        $request->data = '2023-01-01';
        dd( $request );
    }

    public function testeCss()
    {
        return view( 'testes.testecss');
    }

    public function banco2()
    {
        $b2 = mdlWSMessages::all();

        return $b2;

    }

    public function ofx( $arquivo, $conta )
    {
        $ofxParser = new \OfxParser\Parser();
        $ofx = $ofxParser->loadFromFile(  $arquivo );     

        //dd( $ofx );
        foreach ($ofx->bankAccounts as $accountData) {
            // Loop over transactions
            foreach ($accountData->statement->transactions as $ofxEntity) {
                // Keep in mind... not all properties are inherited for all transaction types...
        
                // Maybe you'll want to do something based on the transaction properties:
                $nodeName = $ofxEntity->type;
                if ($nodeName == 'DEBIT') {
                    // @see OfxParser\Entities\Investment\Transaction...
        
                    $amount = abs($ofxEntity->amount);
                    $cusip = $ofxEntity->uniqueId;
                    $data  = $ofxEntity->date;
                    $data = $data->format('d-m-Y');
                    $ref= $ofxEntity->memo;
                    

                    echo "ID: ".$cusip." - Valor  R$ ".number_format($amount,2,',','.').'   Data: '. $data.' - Ref: '.$ref.'<br>';
        
                    // ...
                }
        
                // Maybe you'll want to do something based on the entity:
                if ($ofxEntity instanceof InvEntities\Transaction\BuyStock) {
                    // ...
                }
        
            }
        }
    }
 
    public function lerJsonCliente()
    {
        $jsonString = File::get('/home/redentora-miami/sys/storage/app/public/proprietario.json');


        $data = json_decode($jsonString, true);

        $dados =  $data['data'];

        foreach( $dados as $dado)
        {

            $cliente = new mdlCliente;

            $cliente->IMB_IMB_ID = 1;
            $cliente->IMB_IMB_ID2 = 1;
            $cliente->IMB_CLT_NOME = $dado['st_nome_pes'];

            if( strlen($dado[ 'st_cnpj_pes'] ) > 11 )
                $cliente->IMB_CLT_PESSOA = 'J';
            else
                $cliente->IMB_CLT_PESSOA = 'F';

            if( $dado['st_estadocivil_pes']  == 1 )
                $cliente->IMB_CLT_ESTADOCIVIL = 'C';
            if( $dado['st_estadocivil_pes']  == 2 )
                $cliente->IMB_CLT_ESTADOCIVIL = 'S';
                
            if( $dado['st_sexo_pes']  == 2 )
                $cliente->IMB_CLT_SEXO = 'F';

            if( $dado['st_sexo_pes']  == 1 )
                $cliente->IMB_CLT_SEXO = 'M';
                
            $cliente->IMB_CLT_CPF = $dado['st_cnpj_pes'];
            $cliente->IMB_CLT_RG = $dado['st_rg_pes'];
            $cliente->IMB_CLT_RGORGAO = $dado['st_orgao_pes'];

            if ( $dado['dt_nascimento_pes'] )
                $cliente->IMB_CLT_DATNAS = date( 'Y/m/d', strtotime($dado['dt_nascimento_pes'] ));

                //dd(  $dado['st_endereco_pes']);
            $cliente->IMB_CLT_NACIONALIDADE = $dado['st_nacionalidade_pes'];
            $cliente->IMB_CLT_LOCADOR = '';
            $cliente->IMB_CLT_LOCATARIO = '';
            $cliente->IMB_CLT_FIADOR = '';
            $cliente->IMB_CLT_RESEND = $dado['st_endereco_pes'];
            $cliente->IMB_CLT_RESENDNUM = $dado['st_numero_pes'];
            $cliente->IMB_CLT_RESENDCOM = $dado['st_complemento_pes'];
            $cliente->IMB_CLT_RESENDCEP = $dado['st_cep_pes'];
            $cliente->CEP_BAI_NOMERES = $dado['st_bairro_pes'];
            $cliente->CEP_CID_NOMERES = $dado['st_cidade_pes'];
            $cliente->CEP_UF_SIGLARES = $dado['st_estado_pes'];
            $cliente->IMB_CLT_PROFISSAO=$dado['st_profissao_pes'];
            $cliente->IMB_CLT_EMAIL                 = $dado['st_email_pes'];
            
            $cliente->IMB_CLTCJG_NOME               = $dado['st_nome_coj'];
            $cliente->IMB_CLTCJG_CPF                = $dado['st_cpf_coj'];
            $cliente->IMB_CLTCJG_RG                 = $dado['st_rg_coj'];
            $cliente->IMB_CLTCJG_NACIONALIDADE      = $dado['st_nacionalidade_coj'];

            if( $dado['st_sexo_coj']  == 1)
                $cliente->IMB_CLTCJG_SEXO = 'M';
            if( $dado['st_sexo_coj']  == 2)
                $cliente->IMB_CLTCJG_SEXO = 'F';

                        
            $cliente->IMB_CLTCJG_PROFISSAO          = $dado['st_profissao_coj'];
            $cliente->IMB_CLT_OBSERVACAO            = $dado['st_observacao_pes'];


            $cliente->IMB_CLT_DATACADASTRO          = date('Y-m-d H:i:s');
            $cliente->IMB_CLT_DTHALTERACAO          = date('Y-m-d H:i:s');
            $cliente->IMB_ATD_ID = 1;

            $cliente->save();

        }
        
        
    }

    public function lerJsonImv()
    {
        $jsonString = File::get('/home/redentora-miami/sys/storage/app/public/jsonimoveis.json');


        $data = json_decode($jsonString, true);

        $dados =  $data['data'];

        foreach( $dados as $dado )
        {
            dd( $dado);
            $imv = new mdlImovel;
            
            $imv->IMB_IMV_ID = $dado['id_imovel_imo'];
            
        }

        

    }

    public function lerJsonContratos()
    {
        $jsonString = File::get('/home/redentora-miami/sys/storage/app/public/contratos_json.json');


        $data = json_decode($jsonString, true);

        $dados =  $data['data'];

        //dd( $dados );

        $imv = mdlImovel::whereNotNull( 'IMB_IMV_ID')->delete();
        $ppi = mdlPropImovel::whereNotNull( 'IMB_IMV_ID')->delete();
        
        $lct = mdlLocatarioContrato::whereNotNull('IMB_CTR_ID')->delete();
        $ctr = mdlContrato::whereNotNull('IMB_CTR_ID')->delete();
        
        foreach( $dados as $dado )
        {
            $imv = new mdlImovel;
            $ctr = new mdlContrato;

            $datareaj = date( 'm/d/Y', strtotime($dado['dt_ultimoreajuste_con']));
            $anoultreajuste = date( 'Y',strtotime($datareaj));
            $datareaj = date( 'Y/m/d', strtotime($datareaj) );

            $inicont = date( 'm/d/Y', strtotime($dado['dt_inicio_con']));
            $inicont = date( 'Y/m/d', strtotime($inicont) );

            $tercont = date( 'm/d/Y', strtotime($dado['dt_fim_con']));
            $tercont = date( 'Y/m/d', strtotime($tercont) );

            $datalocacao = date( 'm/d/Y', strtotime($dado['dt_cadastro_con']));
            $datalocacao = date( 'Y/m/d', strtotime($datalocacao) );

            
            
            $tipocontrato = 'Residencial';
            if( $dado['id_tipo_con']==3 ) $tipocontrato = 'Comercial';
            $ctr->IMB_IMB_ID = 1;
            $ctr->IMB_IMV_ID = $dado['id_imovel_imo'];
            $ctr->IMB_CTR_SITUACAO='ATIVO';
            $ctr->IMB_CTR_ID = $dado['id_contrato_con'];
            $ctr->IMB_CTR_INICIO = $inicont;
            $ctr->IMB_CTR_TERMINO = $tercont;
            $ctr->IMB_CTR_TAXAADMINISTRATIVA =  $dado['tx_adm_con'];
            $ctr->IMB_CTR_VALORALUGUEL =  $dado['vl_aluguel_con'];
            $ctr->IMB_CTR_DIAVENCIMENTO =  $dado['nm_diavencimento_con'];
            $ctr->IMB_CTR_REPASSEDIA =  $dado['nm_diarepasse_con'];
            $ctr->IMB_CTR_MESREAJUSTE =  $dado['nm_mesreajuste_con'];
            $ctr->IMB_CTR_DATAULTIMOREAJUSTE =  $datareaj;
            $ctr->IMB_CTR_FINALIDADE =$tipocontrato;
            $ctr->IMB_CTR_DATAREAJUSTE =($anoultreajuste+1).'/'.$ctr->IMB_CTR_MESREAJUSTE.'/01';
            $ctr->IMB_CTR_DATALOCACAO = $datalocacao;
            $ctr->IMB_CTR_REFERENCIA = $dado['codigo_contrato'];


            $pps =  $dado['proprietarios_beneficiarios'];
            foreach( $pps as $pp )
            {
                $ppi = new mdlPropImovel;
                $ppi->IMB_IMB_ID = 1;
                $ppi->IMB_IMV_ID = $dado['id_imovel_imo'];
                $ppi->IMB_CLT_ID = $pp['id_pessoa_pes'];
                $ppi->IMB_IMVCLT_PERCENTUAL4 = $pp['nm_fracao_prb'];
                if( $pp['fl_principal_prb'] == 1 )
                {
                    $ppi->IMB_IMVCLT_PRINCIPAL ='S';
                    $imv->IMB_CLT_ID = $dado['id_imovel_imo'];
                }
                $ppi->save();
            }
            
            $ctr->save();
            
            
            


            //$ctr->IMB_CTR_DATAULTIMOREAJUSTE

            $inq = $dado['inquilinos'];
            foreach( $inq as $lt )
            {

                //dd( $lt);
                $lct = new mdlLocatarioContrato;
                $lct->IMB_IMB_ID = 1;
                $lct->IMB_CLT_ID = $lt['id_pessoa_pes'];
                $lct->IMB_LCTCTR_PRINCIPAL ='N';
                if( $lt['fl_principal_inq'] == 1 )
                    $lct->IMB_LCTCTR_PRINCIPAL ='S';
                $lct->IMB_LCTCTR_PERCENTUAL4 = $lt['nm_fracao_inq'];
                $lct->IMB_CTR_ID = $lt['id_contrato_con'];
                $lct->save();
            }
            $tipoimovel = 0;
            if( $dado['id_imovel_imo'] == 11)
                $tipoimovel = 4;
            if( $dado['id_imovel_imo'] == 4)
                $tipoimovel = 8;
            if( $dado['id_imovel_imo'] == 7)
                $tipoimovel = 26;
            if( $dado['id_imovel_imo'] == 1)
                $tipoimovel = 9;
            if( $dado['id_imovel_imo'] == 2)
                $tipoimovel = 16;

            if( $dado['id_imovel_imo'] == 16)
                $tipoimovel = 33;

            if( $dado['id_imovel_imo'] == 17)
                $tipoimovel = 2;

            if( $dado['id_imovel_imo'] == 24)
                $tipoimovel = 3;

            $imv->IMB_IMV_ID = $dado['id_imovel_imo'];
            $imv->IMB_IMB_ID = 1;
            $imv->IMB_TIM_ID = $tipoimovel;
            $imv->IMB_IMV_ENDERECO = $dado['st_endereco_imo'];
            $imv->IMB_IMV_IDENTIFICADOR = $dado['st_identificador_imo'];
            $imv->IMB_IMV_ENDERECOCOMPLEMENTO = $dado['st_complemento_imo'];
            $imv->CEP_BAI_NOME = $dado['st_bairro_imo'];
            $imv->CEP_BAI_NOME = $dado['st_bairro_imo'];
            $imv->IMB_IMV_ENDERECONUMERO = $dado['st_numero_imo'];
            $imv->IMB_IMV_ENDERECOCEP = str_replace( '-','', $dado['st_cep_imo']);
            $imv->IMB_IMV_CIDADE = $dado['st_cidade_imo'];
            $imv->IMB_IMV_ESTADO = $dado['st_estado_imo'];
            $imv->IMB_IMV_WEBOBS = $dado['st_observacao_imo'];
            $imv->IMB_IMV_ARETOT = $dado['st_areatotal_imo'];
            if( $dado['vl_venda_imo'] <> '' )
                $imv->IMB_IMV_VALVEN = $dado['vl_venda_imo'];
            else
                $imv->IMB_IMV_VALVEN = 0;

            $imv->save();
            
        }

        

    }    
}
