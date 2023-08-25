<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlParametros2;
use App\mdlCliente;
use App\mdlWSMessages;
use Log;
use DB;
use DataTables;

use Auth;

class ctrWhatsApp extends Controller
{

    public function instanceInit( Request $request )
    {

        $key = $request->key;
        $token = $request->token;
        $webhook  = $request->webhook;
        $webhookUrl  = $request->webhookUrl;
        
        $url = "http://191.252.214.117:3000";

        $token = "Mz@728o73";

        $urltotal = "$url/instance/init?key=$key&token=$token&webhook=$webhook&webhookUrl=$webhookUrl";

        Log::info( 'Urlotal '.$urltotal );

        //$key = 'COMPDADOS';


        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $urltotal,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);

        curl_close($curl);
        return response()->json( 'ok',200);
        //echo $response;
        
    }


    public function scanearQrCode( Request $request)
    {
        $key = $request->key;
        $url = "http://191.252.214.117:3000";
    
        $curl = curl_init();
        curl_setopt_array($curl, array(

        CURLOPT_URL => "$url/instance/qr?key=$key",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        

        curl_close($curl);
        echo $response;
    }

    public function resetar( Request $request)
    {
        $key = $request->key;
        $url = "http://191.252.214.117:3000";

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "$url/instance/delete?key=$key",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return response()->json( 'ok',200);
    }

    public function logout( Request $request)
    {
        $key = $request->key;
        $url = "http://191.252.214.117:3000";

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "$url/instance/logout?key=$key",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
//        echo $response;
                
        return response()->json( 'ok',200);
    }

    public function enviarMsg( Request $request)
    {

        $logged='S';
        if( ! Auth::check())
        {
            Auth::loginUsingId( 1,false);
            $logged = 'N';
        }

        $key = $request->instanceKey;
        if( $key == '' )
        {
            $par = mdlParametros2::find( Auth::user()->IMB_IMB_ID);
            $key = $par->IMB_PRM_WSAPELIDO;
        }
        $ddi = $request->ddi;
        $ddd = $request->ddd;
        $numero = $request->numero;
        $assunto = $request->assunto;
        $idcontrato = $request->idcontrato;
        $idcliente = $request->idcliente;
        
        $msg = $request->msg;
        $url = "http://191.252.214.117:3000";

        if( $ddi == '' or $ddi == null )
            $ddi = '55';

        
        if( intval( $ddd ) > 27 )
        {
            if( intval( $numero) > 99999999 )
                $numero=substr($numero,1,8);
        }


        $curl = curl_init();

        if( strlen( $numero ) > 10 )
            $id=$numero;
        else
            $id=$ddi.$ddd.$numero;

        curl_setopt_array($curl, array(
             CURLOPT_URL => "$url/message/text?key=$key",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => "id=$id&message=$msg",
        ));

        $response = curl_exec($curl);
        $datasearch = json_decode($response);
  
        //var_dump( $response );

        if( $datasearch->error == 1)
        {
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( 0, $idcontrato,0,0,0,"  FALHA AO ENVIAR msg whastapp numero ($ddd)$numero -> $msg");
        };

        $data = $datasearch->data;
        $datakey = $data->key;
        $remoteJid= $datakey->remoteJid;

        if( $idcliente <> '')
        {
            $cl = mdlCliente::find( $idcliente );
            if( $cl )
            {
                $cl->IMB_CLT_WHATSID = $remoteJid;
                $cl->save();

                $m = new mdlWSMessages;
                $m->MTYPE                 =  'message';
                $m->BODY_KEY_REMOTEJID    =  $ddi.$ddd.$numero;
                    $m->BODY_KEY_FROMME       =  '1';
                  
                $m->BODY_MESSAGETIMESTAMP =  date(  'Y/m/d H:m:i' );
                $m->BODY_PUSHNAME         =  $cl->IMB_CLT_NOME;
                $m->BODY_BROADCAST        =  '0';
                $m->BODY_INSTANCE_KEY        =  $key;
                $m->MODY_MESSAGE_CONVERSATION = $msg;
                $m->IMB_CLT_ID = $cl->IMB_CLT_ID;
                $m->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $m->save();
            
            
                $tb = "UPDATE IMB_TELEFONES SET IMB_CLT_WHATSID = '$remoteJid', IMB_TLF_TIPOTELEFONE='Whastapp(confirmado)' ".
                "WHERE IMB_TLF_DDD=$ddd and IMB_TLF_NUMERO= $numero" ;
                DB::statement("$tb");        

            }

        }

       // $remoteJid= $retorno['remoteJid'];

        curl_close($curl);

        app('App\Http\Controllers\ctrRotinas')
        ->gravarObs( 0, $idcontrato,0,0,0,"  -> ".$remoteJid." * whastapp numero ($ddd)$numero -> $msg");

        if( $logged =='N')
            Auth::logout();        
/*
        $curl = curl_init();

        $numero=substr($numero,1,8);
        $id=$ddi.$ddd.$numero;
        Log::info( '2: '.$id );
        curl_setopt_array($curl, array(
             CURLOPT_URL => "$url/message/text?key=$key",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => "id=$id&message=$msg",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
*/

        return response()->json( 'ok',200);
//echo $response;

    }

    public function mensagensTrocadas( Request $request )
    {
        $idcliente = $request->IMB_CLT_ID;
        $datainicio = $request->inicio;
        $datafim = $request->termino;

        if( $datainicio == '' ) $datainicio = date( 'Y/m/d');
        if( $datafim == '' ) $datafim = date( 'Y/m/d');
        

        $msgs = mdlWSMessages::select(
            [   'MTYPE',
	            'BODY_MESSAGETIMESTAMP',
	            'MODY_MESSAGE_CONVERSATION',
                'BODY_PUSHNAME',
	            'IMB_CLT_NOME',
                DB::raw('(select IMB_ATD_NOME FROM IMB_ATENDENTE WHERE IMB_ATENDENTE.IMB_ATD_ID = WSMENSAGENS.IMB_ATD_ID) AS IMB_ATD_NOME'),
            ]
        )
        ->leftJoin('IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','WSMENSAGENS.IMB_CLT_ID')
        ->whereRaw( "cast(BODY_MESSAGETIMESTAMP as date ) >= '$datainicio' and cast(BODY_MESSAGETIMESTAMP as date ) <= '$datafim' ");
        

        if( $idcliente <> '' )
            $msgs = $msgs->where( 'WSMENSAGENS.IMB_CLT_ID','=', $idcliente );

            $msgs = $msgs ->orderBy( 'BODY_MESSAGETIMESTAMP');

        return DataTables::of($msgs)->make(true);

    }


    
}
