<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\mdlBeSoft;
use App\mdlBeVistoriasGeradas;
use App\mdlBeTipImo;
use App\mdlBeSubTipImo;
use App\mdlBeVistoriares;

use App\mdlBeCidades;
use App\mdlBeEstados;

use Auth;
use DataTables;
use Log;

class ctrbeSoft extends Controller
{

    public function login()
    {   
        
        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );

        $ep_login = $be->BE_ENDPOINT_LOGINGERATOKEN;
        $ep_username= $be->BE_USERNAME;
        $ep_password= $be->BE_PASSWORD;

        $response = Http::post( $ep_login, 
        [
            'username' => $ep_username,
            'password' => $ep_password
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


    public function listaTiposImoveis()
    {
    
        $tipimo = mdlBeTipImo::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->orderBy('tic_nome')->get();

        return response()->json($tipimo,200);
        

    }

    public function listaSubTiposImoveis( $id )
    {
    
        $tipimo = mdlBeSubTipImo::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where( 'tic_codigo','=', $id )
        ->orderBy('ist_nome')->get();

        return response()->json($tipimo,200);
        

    }

    public function sincronizarTiposImoveis()
    {
    
        
        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_TIPOSIMOVEIS);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        curl_close($curl);

        $regs = json_decode( $resp );
        $regs = $regs->results;

        $tipimo = mdlBeTipImo::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->delete();
        $subtip = mdlBeSubTipImo::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->delete();

        foreach( $regs as $reg )
        {
            $tipimo = new mdlBeTipImo;

            $tipimo->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $tipimo->tic_codigo = $reg->tic_codigo;
            $tipimo->tic_nome = $reg->tic_nome;
            $tipimo->tic_dthsincroniza = date( 'Y/m/d H:m:i');
            
            $tipimo->save();
            $subtipo = $reg->imovelsubtipo_set;
            foreach( $subtipo as $st)
            {
                $novosub = new mdlBeSubTipImo;
                $novosub->tic_codigo = $reg->tic_codigo;
                $novosub->ist_codigo = $st->ist_codigo;
                $novosub->ist_nome = $st->ist_nome;
                $novosub->ist_dthsincroniza = date('Y/m/d H:m:i');
                $novosub->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $novosub->save();
                
                
            }
        }

        return response()->json('ok',200);
        

    }

    public function sincronizarVistoriadores()
    {
    
        
        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_VISTORIADORLIST);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        curl_close($curl);

        $regs = json_decode( $resp );
        $regs = $regs->results;

        $vis = mdlBeVistoriares::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->delete();
        
        foreach( $regs as $reg )
        {
            $vis = new mdlBeVistoriares;
            $vis->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $vis->usu_codigo = $reg->usu_codigo;
            $vis->username = $reg->username;
            $vis->first_name = $reg->first_name;
            $vis->last_name = $reg->last_name;
            $vis->usu_vistoriador = $reg->usu_vistoriador;
            $vis->Imobiliaria = $reg->Imobiliaria;
            $vis->email = $reg->email;
            $vis->save();
        }

        return response()->json('ok',200);
        

    }
    public function listVistoriadores()
    {
    
        
        $vis = mdlBeVistoriares::
            where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->orderBy('username')
            ->get();
        

        return response()->json( $vis,200);
        

    }

    
    public function listaTiposTemplates()
    {

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_TIPOSTEMPLATES);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);

        dd( $resp );

        //
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        var_dump($error_msg);
        }
        var_dump($resp);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        var_dump($response);
        curl_close($curl);

    }

    public function listaTiposVistorias()
    {

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_TIPOSVISTORIAS);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        curl_close($curl);

        $regs = json_decode( $resp );
        //$regs = $regs->results;

        return $regs;

    }
    public function listaTiposAssinantes()
    {

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_TIPOSASSINANTE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        curl_close($curl);

        $regs = json_decode( $resp );
        $regs = $regs->results;

        return $regs;

        //
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        var_dump($error_msg);
        }
        var_dump($resp);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        var_dump($response);
        curl_close($curl);

    }
    
    public function sincronizarCidades()
    {

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_LISTACIDADES);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'POST');

        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        curl_close($curl);

        $regs = json_decode( $resp );
        $regs = $regs->results;

        $cids = mdlBeCidades::delete();

        foreach( $cids as $cid )
        {
            $cid = new mdlBeCidades;
            $cid->cid_codigo = $cid->cid_codigo;
            $cid->cid_nome = $cid->cid_nome;
            $cid->est_codigo = $cid->est_codigo;
            $cid->save();
        }

        return response()->json( 'ok',200);
        
/*
        //
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        var_dump($error_msg);
        }
        var_dump($resp);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        var_dump($response);
        curl_close($curl);
        */

    }

    
    public function listaCidades()
    {

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $be->BE_ENDPOINT_LISTACIDADES);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'POST');

        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        curl_close($curl);

        $regs = json_decode( $resp );
        $regs = $regs->results;

        
        return $regs;


        //
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        var_dump($error_msg);
        }
        var_dump($resp);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        var_dump($response);
        curl_close($curl);

    }

    public function agendarVistoria( Request $request )
    {
        $csrf = $request->csrf;
        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $endp = $be->BE_ENDPOINT_VISTORIAAGENDA;

        $token = $this->login();

        $body = json_encode( $request->all() );
        /*
        $body =   '{
            "tipo": 1,
            "informacao_adicional": "(Opcional)",
            "data": "2022-07-31",
            "webhook": "https://link_de_retorno_quando_vistoria_estiver.pronta/aqui voce pode por um codigo interno de identificacao para retornarmos",
            "webhookauth": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE2NDM3MzM4MjF9.Y5oo2714ity2zi7V3fdgbH8gd-KjL6JAvrm8A1a0u1c",
            "empresa": 1,
            "imovel":{
                "identificador": 1,
                "tipo": 1,
                "subtipo": 1,
                "endereco": "logradouro",
                "numero": "numero do endereço",
                "complemento": "complemento", 
                "bairro": "bairro",
                "Cidade": 1000
            },
            "vistoriador": {
                "nome": "Jean Marcos",
                "cpf": "06781484818",
                "telefone": "(Opcional)",
                "email": "(Opcional)"
            },
            "assinantes": [
                {
                    "nome": "Fulano",
                    "cpf": "65451543545",
                    "tipo": 1
                },
                {
                    "nome": "Ciclano",
                    "cpf": "51515452155",
                    "tipo": 2
                }
            ]
        }';
*/


        $curl = curl_init();
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $endp);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl , CURLOPT_POSTFIELDS, $body);        

        $resp = curl_exec($curl);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $info = curl_getinfo($curl);
        $codret = $info["http_code"];

        curl_close($curl);
        if( $codret <> '200') 
            return response()->json('Erro', 500 );

        return response()->json( $response,200);

    }

    public function teste()
    {
        return view( 'besoft.teste');
    }

    public function painel()
    {
        return view( 'besoft.besoftvistorias');
    }

    public function getVistoria( Request $request )
    {
        Log::info('acessou!');

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();

        $id = $request->id;
        $endp = $be->BE_ENDPOINT_VISTORIAGET;


        if( $id <> '' )
            $endp = $be->BE_ENDPOINT_VISTORIAGET.'/'.$id;

        Log::info(' endpoint: '.$endp );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $endp);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $resp = curl_exec($curl);
        if ($resp == false)  
        {
            $empty = array("draw" => 0,"recordsTotal" => 0,"recordsFiltered"=>0,"data" =>[] );
           // $result = json_encode($empty); // "{}"            
            return response()->json($empty,200);
        }
        

        $regs = json_decode( $resp, false );
        $regs = $regs->results;

        

        $vistoria = mdlBeVistoriasGeradas::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->delete();
        
        foreach( $regs as $reg )
        {
            $imovel                         =  $reg->Imovel;
            $imoveltipo                     = $imovel->ImovelTipo;
            $imovelsubtipo_set              = $imoveltipo->imovelsubtipo_set;
            $ImovelSubtipo                  = $imovel->ImovelSubtipo;
            $imobiliaria                    = $imovel->Imobiliaria;
            $cidade                         = $imovel->Cidade;
            //$estado                         = $cidade->Estado;
            $statusimovel                   = $imovel->Status;
            $latitude = $imovel->imo_latitude;
            $longitude = $imovel->imo_longitude;
            $endereco = $imovel->imo_endereco;
            $numero = $imovel->imo_numero;
            $complemento = $imovel->imo_complemento;
            $bairro = $imovel->imo_bairro;
            $foto = $imovel->imo_foto;
            $identificador = $imovel->imo_identificador;
            $vistoriador = $reg->Vistoriador;
            $usuario = $reg->Usuario;
            $status = $reg->Status;
            $tipos = $reg->Tipo;
            $informacoes = $reg->vis_informacao;
            $datahora = $reg->vis_datahora;
            $vis_datarealizacao = $reg->vis_datarealizacao;
            $subsubtipo = '';
            foreach( $imovelsubtipo_set as $imvsub)
            {
                $subsubtipo = $subsubtipo . $imvsub->ist_nome.' ';
            }

            

            $vistoria = new mdlBeVistoriasGeradas;

            $vistoria->imb_imb_id                       = Auth::user()->IMB_IMB_ID;
            $vistoria->vis_codigo                       = $reg->vis_codigo;
            $vistoria->imo_codigo                       = $imovel->imo_codigo;
            $vistoria->ImovelTipo_tic_nome              = $imoveltipo->tic_nome;
            $vistoria->Imovel_Subtipo_ist_codigo        = $ImovelSubtipo->ist_codigo;
            $vistoria->Imovel_Imobiliaria_imb_codigo    = $imobiliaria->imb_codigo;
            $vistoria->Imovel_Imobiliaria_imb_nomefantasia = $imobiliaria->imb_nomefantasia;
            $vistoria->Imovel_Cidade_cid_nome            = 'Agudos';//$cidade->cid_nome;
            $vistoria->Imovel_Status             = $statusimovel;
            $vistoria->Imovel_imo_latitude             = $latitude;
            $vistoria->Imovel_imo_longitude             = $longitude;
            $vistoria->Imovel_imo_endereco             = $endereco;
            $vistoria->Imovel_imo_numero             = $numero;
            $vistoria->Imovel_imo_complemento             = $complemento;
            $vistoria->Imovel_imo_bairro             = $bairro;
            $vistoria->Imovel_imo_identificador      = $imovel->imo_identificador;
            $vistoria->Vistoriador_usu_codigo             = $vistoriador->usu_codigo;
            $vistoria->Vistoriador_username             = $vistoriador->username;
            $vistoria->Vistoriador_first_name             = $vistoriador->first_name;
            $vistoria->Vistoriador_first_name             = $vistoriador->last_name;
            $vistoria->Vistoriador_email                    = $vistoriador->email;
            $vistoria->Usuario_usu_codigo                   = $usuario->usu_codigo;
            $vistoria->Usuario_username                     = $usuario->username;
            $vistoria->Usuario_first_name                   = $usuario->first_name;
            $vistoria->Usuario_first_name                   = $usuario->last_name;
            $vistoria->Usuario_email                        = $usuario->email;
            $vistoria->Status_vist_codigo                   = $status->vist_codigo;
            $vistoria->Status_vist_status                   = $status->vist_status;
            $vistoria->Tipo_visti_codigo                    = $tipos->visti_codigo;
            $vistoria->Tipo_visti_tipo                    = $tipos->visti_tipo;
            $vistoria->vis_datahora                         = date('Y/m/d', strtotime( $datahora ));
            $vistoria->vis_datarealizacao                         = date('Y/m/d', strtotime( $vis_datarealizacao ));
            $vistoria->save();
            
/*            echo "<br>**************** Imobiliária **************";
            echo "<br>Código: ".$imobiliaria->imb_codigo;
            echo "<br>Nome: ".$imobiliaria->imb_nomefantasia;
            echo "<br>**************** Imóvel **************";
            echo "<br>Nome: ".$imovel->imo_nome;
            echo "<br>Código: ".$imovel->imo_codigo;
            echo "<br>tipo imovel: ".$imoveltipo->tic_nome." - Subtipo: ".$ImovelSubtipo->ist_nome;
            echo "<br>Sub tipo imovel: ".$subsubtipo;
            echo "<br>Status: ".$statusimovel;
            echo "<br>Latitude: ".$latitude;
            echo "<br>longitude: ".$longitude;
            echo "<br>Endereco: ".$endereco." - Nº: ".$numero.' - '.$complemento.' - Bairro: '.$bairro;
            echo "<br>Cidade: ".$cidade->cid_nome.' - '.$estado->est_nome;
            echo "<br>Foto: ".$foto;
            echo "<br>Identificador: ".$identificador;
            echo "<br>------------ Vistoriador -----------------";
            echo "   >Código: ".$vistoriador->usu_codigo.' - username: '.$vistoriador->username;
            echo "   >Nome: ".$vistoriador->first_name.' '.$vistoriador->last_name;
            echo "   >email: ".$vistoriador->email;
            echo "<br>------------ Usuáriuo -----------------";
            echo "   >Código: ".$usuario->usu_codigo.' - username: '.$usuario->username;
            echo "   >Nome:  ".$usuario->first_name.' '.$usuario->last_name;
            echo "   >email: ".$usuario->email;
            echo "<br>---------- Sobre a Vistoria -----------";
            echo "<br>Status: ".$status->vist_codigo." - ".$status->vist_status;
            echo "<br>Tipo: ".$tipos->visti_codigo." - ".$tipos->visti_tipo;
            echo "<br><br>Informações: ".$informacoes;
            echo "<br>Data: ".date( 'd/m/Y',strtotime($datahora));
            

            echo "<br>";
            */
        }

        $vistoria = mdlBeVistoriasGeradas::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID );

        return DataTables::of($vistoria)->make(true);
    }
    public function apagarVistoria( $id )
    {
        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $token = $this->login();
        $endp = $be->BE_ENDPOINT_VISTORIADELETEVISTORIA.'/'.$id.'/';
        //dd( $endp);


        $curl = curl_init();
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $endp);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);

        return $resp;

        //
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        var_dump($error_msg);
        }
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $resp;
    }
    public function gerarLaudo( Request $request )
    {

        $be = mdlBeSoft::find( Auth::user()->IMB_IMB_ID );
        $endp = $be->BE_ENDPOINT_VISTORIAGERARLAUDO;

        $token = $this->login();
        $body = json_encode( $request->all() );
//        dd( $body );
        $curl = curl_init();
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Token '.$token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $endp);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");        
        curl_setopt($curl , CURLOPT_POSTFIELDS, $body);        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $info = curl_getinfo($curl);
        $codret = $info["http_code"];

        $respx = json_decode( $resp );

        curl_close($curl);
        if( $codret <> '200') 
            return response()->json('Erro', 500 );

        return response()->json( $respx->arquivo, 200 );

    }


    
    
}
