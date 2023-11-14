<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoImovel;
use App\mdlContrato;
use App\mdlCobrancaGeradaPerm;
use App\mdlImovel;
use App\mdlCliente;
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

        dd( $dados);

    }
}
