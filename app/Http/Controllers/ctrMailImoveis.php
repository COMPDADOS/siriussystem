<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ctrMailImoveis extends Controller
{
    public function resumoimoveis( Request $request )
    {

        $id = $request->id;

        //return view( 'mail.imoveis.mailimoveisresumo', compact( 'id' ) );

        return view ('emails.orders.shipped');


/*
        Mail::send( 'mail.imoveis.mailimoveisresumo', compact( 'id' ),
           function( $message ){
               $message->to( 'suporte@compdados.com.br');
               $message->subject('Teste de email - sirius');

           });*/
        //return "Email enviado!";

    }
}
