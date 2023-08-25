<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoImovel;
use App\mdlContrato;
use App\mdlCobrancaGeradaPerm;
use App\mdlImovel;
use App\mdlWSMessages;
use stdClass;
use DB;
use Image;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;

use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
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
    

    
    
}
