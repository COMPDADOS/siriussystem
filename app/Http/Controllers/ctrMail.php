<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\mailsirius;
use App\Mail\mailsenha;
use App\Mail\mailsenhacliente;
use App\Mail\mailbemvindolocatario;
use App\mdlLocatarioContrato;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\mdlAtendente;
use App\mdlCliente;
use App\mdlImobiliaria;
use App\mdlContrato;
use Log;
class ctrMail extends Controller
{

    public function send()
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';

        Mail::to("lindomar.demetrius@compdados.com.br")->send(new mailsirius($objDemo));
    }

    public function bvLocatario( Request $request )
    {
        $IMB_CTR_ID = $request->IMB_CTR_ID;
        $to = 'suporte@compdados.com.br';


        $data = date( 'Y-m-d');
        $contratos = mdlContrato::where('IMB_CTR_INICIO','=', $data )->get();

        foreach( $contratos as $ctr )
        {

//            if( $ctr )
            //{

                $locatarios = mdlLocatarioContrato::where( 'IMB_CTR_ID','=', $ctr->IMB_CTR_ID )->get();

                foreach( $locatarios as $locatario)
                {


                    $clt = mdlCliente::find( $locatario->IMB_CLT_ID);

                    if( $clt )
                    {

                        $imb = mdlImobiliaria::find( $ctr->IMB_IMB_ID);

                        $enderecoimovel = app('App\Http\Controllers\ctrRotinas')
                                        ->imovelEndereco( $ctr->IMB_IMV_ID );


                        $objDados = new \stdClass();
                        $objDados->IMB_IMB_NOME = $imb->IMB_IMB_NOME;
                        $objDados->IMB_IMB_URL = $imb->IMB_IMB_URL;
                        $objDados->IMB_IMB_TELEFONE = $imb->IMB_IMB_TELEFONE1;
                        $objDados->IMB_IMB_ENDERECO = $imb->IMB_IMB_ENDERECO.' - '.
                                                    $imb->CEP_BAI_NOME.' - '.
                                                    $imb->CEP_CID_NOME.'('.$imb->CEP_UF_SIGLA.')';
                        $objDados->IMB_IMB_EMAIL = $imb->IMB_IMB_EMAIL;
                        $objDados->IMB_CLT_NOME = $clt->IMB_CLT_NOME;
                        $objDados->enderecoimovel = $enderecoimovel;
                        $objDados->IMB_CTR_DURACAO = $ctr->IMB_CTR_DURACAO;
                        $objDados->IMB_CTR_INICIO = $this->formatarData($ctr->IMB_CTR_INICIO);
                        $objDados->IMB_CTR_TERMINO = $this->formatarData($ctr->IMB_CTR_TERMINO);
                        $objDados->IMB_CTR_VALORALUGUEL = number_format($ctr->IMB_CTR_VALORALUGUEL,2,",",".");
                        $objDados->IMB_CTR_DATAREAJUSTE = $this->formatarData($ctr->IMB_CTR_DATAREAJUSTE);
                        $objDados->IMB_CTR_DIAVENCIMENTO = $ctr->IMB_CTR_DIAVENCIMENTO;

                        Mail::to( $to )->send(new mailbemvindolocatario($objDados));

                    }
                }
        }
        return response()->json('OK', 200);


    }
    public function sendSenha( $email )
    {

        $email = trim( $email );

        $atualiza =  mdlAtendente::where( 'email',$email);



        $atualiza = $atualiza->get();



        if( $atualiza[0]->IMB_ATD_EMAIL == $email )
        {

            $id = $atualiza[0]->IMB_ATD_ID;


            $senha = rand( 1000,100000);
            $novasenha = Hash::make($senha)        ;
            $objDados = new \stdClass();
            $objDados->demo_one = 'Demo One Value';
            $objDados->demo_two = 'Demo Two Value';
            $objDados->sender = 'naoresponde@xxxxxx.com.br';
            $objDados->novasenha= $senha;
            $objDados->receiver = $email;

            $atj = mdlAtendente::find( $id );
            $atj->password=$novasenha;
            $atj->save();

            Mail::to( $email )->send(new mailsenha($objDados));

            return response()->json('OK', 200);
        }
        else
            return response()->json('error', 404);

    }

    public function sendSenhaClienteEmail( Request $request )
    {




        $id = $request->idcliente;

        $senha = rand( 1000000,9999999);

        $atj = mdlCliente::find( $id );

        $imb = mdlImobiliaria::select( [ 'IMB_IMB_CGC', 'IMB_IMB_NOME'])
                ->where('IMB_IMB_ID','=', $atj->IMB_IMB_ID )->first();


        if( $atj )
        {
            $atj->IMB_CLT_SENHA=$senha;
            $atj->save();


            $objDados = new \stdClass();
            $objDados->demo_one = 'Demo One Value';
            $objDados->demo_two = 'Demo Two Value';
            $objDados->sender = 'naoresponde@xxxxxx.com.br';
            $objDados->novasenha= $senha;
            $objDados->receiver = $atj->IMB_CLT_NOME;
            $objDados->IMB_IMB_ID = $atj->IMB_IMB_ID;
            $objDados->IMB_IMB_CGC = $imb->IMB_IMB_CGC;
            $objDados->IMB_IMB_NOME = $imb->IMB_IMB_NOME;
            $email = $atj->IMB_CLT_EMAIL;
            $array = explode(";",$email);
            foreach( $array as $a )
            {
                $a=str_replace( ';','',$a);
                $a = filter_var( $a, FILTER_SANITIZE_EMAIL );

                Mail::to( $a )->send(new mailsenhacliente($objDados));
            }

            return response()->json('OK', 200);
        }
        else
            return response()->json('error', 404);

    }

    public function formatarData($data)
    {
        $rData = implode("/", array_reverse(explode("-", trim($data))));
        return $rData;
    }


}
