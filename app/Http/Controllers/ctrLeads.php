<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlLeads;
use DB;

class ctrLeads extends Controller
{

    public function capturarVivaReal( Request $request)
    {
       
            $input = file_get_contents('php://input'); // Pega todos os dados do json
            $jsonDecode = json_decode($input); // Decodifica o json e transforma em objeto
            


            $lead = new mdlLeads;
            $lead->IMB_POR_ID = 1;
            $lead->IMB_IMB_ID = 1;
            $lead->IMB_LED_DTHATIVO =  date('Y/m/d H:i:s', strtotime(  $jsonDecode->timestamp ));
            $lead->IMB_IMV_ID = $jsonDecode->originListingId;
            $lead->IMB_LED_NOME = $jsonDecode->name;
            $lead->IMB_LED_DDD =  $jsonDecode->ddd;
            $lead->IMB_LED_TELEFONE =  $jsonDecode->phone;
            $lead->IMB_LED_MENSAGEM =  $jsonDecode->message;
            $lead->save();




/*

            {
                "leadOrigin": "VivaReal",
                "timestamp": "2017-10-23T15:50:30.619Z",
                "originLeadId": "59ee0fc6e4b043e1b2a6d863",
                "originListingId": "87027856",
                "clientListingId": "a40171",
                "name": "Nome Consumidor",
                "email": "nome.consumidor@email.com",
                "ddd": "11",
                "phone": "999999999",
                "phoneNumber": "11999999999",
                "message": "Olá, tenho interesse neste imóvel. Aguardo o contato. Obrigado."
              }

            dd( $leads );
  */     
    }
    
    
}
