<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mdlLeads;
use App\mdlImovel;
use Auth;
use DB;
use Log;

class ctrLeads extends Controller
{
    public function capturarVivaReal( Request $request)
    {
       
            Log::info('Capturando leads');
            $userdata = $request->input();
//            $dados = json_decode( $userdata );

            Auth::loginUsingId( 1,true);
            $imv = mdlImovel::where('IMB_IMV_REFERE','=', $userdata['clientListingId'])->first();
            
            $lead = new mdlLeads;
            $lead->IMB_POR_ID = 1;
            $lead->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lead->IMB_LED_DATAHORA = date( 'Y/m/d H:i:s');
            $lead->IMB_LED_DTHATIVO =  date('Y/m/d H:i:s');
            if( $imv <> '')
              $lead->IMB_IMV_ID = $imv->IMB_IMV_ID;
            else
              $lead->IMB_IMV_ID = 0;
            $lead->IMB_IMV_REFERE = $userdata['clientListingId'];
            $lead->IMB_LED_NOME = $userdata['name'];
            $lead->IMB_LED_EMAIL =  $userdata['email'];
            $lead->IMB_LED_DDD =  $userdata['ddd'];
            $lead->IMB_LED_TELEFONE =  $userdata['phone'];
            $lead->IMB_LED_MENSAGEM =  $userdata['message'];
            $lead->save();
            Log::info('Salvou lead');
            Auth::logout();
            return response()->json('ok',200);

    


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