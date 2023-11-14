<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mdlLeads;
use App\mdlImovel;
use App\mdlCliente;
use App\mdlWSMessages;
use App\mdlTelefone;
use Auth;
use DB;
use Log;

class ctrWhatsAppInterface extends Controller
{
  public function webhook( Request $request)
  {

    $array = $request->all();  

  $rec = strpos( $request,'{');
  $json = substr( $request, $rec );

  $tb = "INSERT into TMP_TEST( TEXTO ) VALUES( '$json' )";
  DB::statement("$tb");

  $json = json_decode( $json );

  if( $json->type == 'message')
  {
    $body = $json->body;
    $bodyKey = $body->key;
    $remoteJid = $bodyKey->remoteJid;
    $fromMe = $bodyKey->fromMe;
    $pushName = $body->pushName;
    $instanceKey = $request->instanceKey;

    $pos = strpos( $remoteJid,'@');
    $identificacaocliente = substr($remoteJid,0, $pos );

    $cli=0;
    $clt = mdlTelefone::whereRaw( "concat( '55', IMB_TLF_DDD, IMB_TLF_NUMERO) = '$identificacaocliente'" )->first();

    $msgs = mdlWSMessages::where( 'BODY_KEY_REMOTEJID','=', $remoteJid)->orderBy( 'BODY_MESSAGETIMESTAMP','DESC')->first();

    $nomecliente='';
    if( $clt <> '' )
    {
      $cli = $clt->IMB_TLF_ID_CLIENTE;
      $cliente = mdlCliente::find( $cli );
      if( $cliente <> '' )
          $nomecliente = $cliente->IMB_CLT_NOME;
    }


      $body = $request['body'];
  
    $msg = new mdlWSMessages;
      $msg->MTYPE                 =  $request->type;
      $msg->BODY_KEY_REMOTEJID    =  $remoteJid;
      $msg->BODY_KEY_FROMME       =  $fromMe;
      $msg->BODY_KEY_ID           =  $request['body']['key']['id'];
      $msg->BODY_MESSAGETIMESTAMP =  date(  'Y/m/d H:m:i' );
      $msg->BODY_PUSHNAME         =  $request['body']['pushName'];
      $msg->BODY_BROADCAST        =  $request['body']['broadcast'];
      $msg->BODY_INSTANCE_KEY        =  $request['instanceKey'];
      
      try
      {
        if( isset( $json->body->message->conversation) )
          $msg->MODY_MESSAGE_CONVERSATION =  $json->body->message->conversation;
        if( isset( $json->body->message->extendedTextMessage->text) )
          $msg->MODY_MESSAGE_CONVERSATION =  $json->body->message->extendedTextMessage->text;
      }
      catch (\Illuminate\Database\QueryException $e) 
      {
        $msg->MODY_MESSAGE_CONVERSATION = '**emotions**';
      }                    


      
      $msg->IMB_CLT_ID = $cli;
      $msg->save();
/*
      $request->IMB_CLT_NOME = $nomecliente;
      $request->ddi = '55';
      $request->ddd = '14';
      $request->numero = '991857709';
      $Request['assunto'] = 'O que você precisa?';
      
      $request['msg'] = $nomecliente.', o que vc precisa';

      app( 'App\Http\Controllers\ctrWhatsApp')->enviarMsg( $request );
*/
    }
  
  }

    
     

}