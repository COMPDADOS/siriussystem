<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\mdlCliente;
use Auth;
use PDF;
use Log;
class ctrMkt extends Controller
{

    public function camp1( )
    {
        
        //$cl=mdlCliente::find(48925357);
        //return view('mail.marketing_camp1', compact( 'cl' ) );

        $this->enviarCamp1();
    }


    public function enviarCamp1()
    {
        $clientes = mdlCliente::whereRaw( 'not exists( select IMB_CTR_ID FROM IMB_LOCATARIOCONTRATO 
        where IMB_LOCATARIOCONTRATO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID)')->get();


        foreach( $clientes as $cl )
        {
            $a = trim($cl->IMB_CLT_EMAIL);
            

            
            Mail::send('mail.marketing_camp1', compact( 'cl' ) ,
            function( $message ) use ($a,$cl)
            {

//                if( filter_var($a, FILTER_VALIDATE_EMAIL) )
                //{
                    $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                    if( $a <> '' )
                    {
//                        $a='suporte@compdados.com.br';
                        $message->to( $a );
                        $message->cc( 'suporte@compdados.com.br' );
                        $message->subject('Sirius System: Implantação Custo zero. com carência de até 5 meses para começar a pagar');
                        
                    }
                    else
                    {
                        
                        $message->to( 'suporte@compdados.com.br' );
                        $message->subject('Cliente '.$cl->IMB_CLT_NOME.' sem email');
                    }
            //    }
                    return '0';
            });        
        }
    }


        
        
}
