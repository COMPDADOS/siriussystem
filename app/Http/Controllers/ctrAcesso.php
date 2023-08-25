<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\mdlAtendente;
use App\mdlImobiliaria;
use App\mdlModulo;
use App\mdlDireitos;
use App\mdlTipoCliente;
use App\mdlAtendimentoStatus;
use App\mdlStatusImovel;


class ctrAcesso extends Controller
{
    //



    public function checarEmail( $email )
    {
        $atendente = mdlAtendente::select( 
            [
                'IMB_ATD_EMAIL'
            ]
                
        )->where( 'IMB_ATD_EMAIL', '=',$email )
        ->first();

        //dd( 'email: '.$email.' - '.$atendente );
        if ($atendente === null) 
        {
            return response()->json('ok', 200);
        }
        return response()->json('já cadastrado', 404);

    }

    public function indexGeral()
    {

        return view( 'login.acesso');

    }
    public function criarAcesso()
    {

        return view( 'login.criaracesso');

    }

    public function gerarUsuario(Request $request)
    {

        $imob = new mdlImobiliaria;
        $imob->IMB_IMB_NOME = $request->input('IMB_ATD_NOME');
        $imob->save();
        
        $imob =  mdlImobiliaria::find( $imob->IMB_IMB_ID);
        $imob->IMB_IMB_IDMASTER = $imob->IMB_IMB_ID;
        $imob->save();

        $senharand = rand();
        $novasenha = Hash::make($senharand);  

        
        $atd = new mdlAtendente;
        $atd->IMB_IMB_ID = $imob->IMB_IMB_ID;
        $atd->IMB_ATD_NOME  = $request->IMB_ATD_NOME;
        $atd->IMB_ATD_APELIDO = 'BRANCO';//$request->input('IMB_ATD_USUARIO');
        $atd->IMB_ATD_EMAIL = $request->IMB_ATD_EMAIL;
        $atd->IMB_ATD_TELEFONE_1 = $request->IMB_ATD_TELEFONE_1;
        $atd->IMB_ATD_DDD1 = $request->IMB_ATD_DDD1;
        $atd->VIS_AGE_ID = $imob->IMB_IMB_ID;
        $atd->imb_imb_id2 = $imob->IMB_IMB_ID;
        $atd->IMB_ATD_SENHA = $senharand;
        $atd->password = $novasenha;
        $atd->email = $request->IMB_ATD_EMAIL;
        $atd->login = $request->IMB_ATD_NOME;
        $atd->IMB_ATD_SOMENTECOMERCIAL  = 'S';
        $atd->save();

        $modulos = mdlModulo::
        where( 'IMB_MDL_BASICOCOMERCIAL','=','S')
        ->get();
        
        foreach ($modulos as $modulo) 
        {
            $novosdireitos = new mdlDireitos;

            $novosdireitos->IMB_IMB_ID = $imob->IMB_IMB_ID;
            $novosdireitos->IMB_STM_ID = 1;
            $novosdireitos->IMB_ATD_ID = $atd->IMB_ATD_ID;
            $novosdireitos->IMB_DIRACE_INCLUSAO = 'S';
            $novosdireitos->IMB_DIRACE_ALTERACAO = 'S';
            $novosdireitos->IMB_DIRACE_EXCLUSAO = 'S';
            $novosdireitos->IMB_DIRACE_ACESSO = 'S';
            $novosdireitos->IMB_MDL_ID = $modulo->IMB_MDL_ID;
            $novosdireitos->save();
        }
        //abastecendo os tipos de clientes padrão
        $tiposclientes = mdlTipoCliente::
        where( 'IMB_IMB_ID','=','0')
        ->get();
        
        foreach ($tiposclientes as $tipocliente) 
        {
            $novotipo = new mdlTipoCliente;

            $novotipo->IMB_IMB_ID = $imob->IMB_IMB_ID;
            $novotipo->IMB_ATD_ID = $atd->IMB_ATD_ID;
            $novotipo->IMB_TIPCLI_DESCRICAO = $tipocliente->IMB_TIPCLI_DESCRICAO;
            $novotipo->save();
        }

        $status = mdlAtendimentoStatus::
        where( 'IMB_IMB_ID','=','0')
        ->get();
        
        foreach ($status as $st) 
        {
            $novost = new mdlAtendimentoStatus;

            $novost->IMB_IMB_ID = $imob->IMB_IMB_ID;
            $novost->VIS_ATD_ID = $atd->IMB_ATD_ID;
            $novost->VIS_ATS_NOME = $st->VIS_ATS_NOME;
            $novost->save();
        }


        $statusimv = mdlStatusImovel::
        where( 'IMB_IMB_ID','=','0')
        ->get();
        
        foreach ($statusimv as $stimv) 
        {
            $novostimv = new mdlStatusImovel;

            $novostimv->IMB_IMB_ID = $imob->IMB_IMB_ID;
            $novostimv->IMB_ATD_ID = $atd->IMB_ATD_ID;
            $novostimv->VIS_STA_NOME = $stimv->VIS_STA_NOME;
            $novostimv->save();
        }


        $mensagem ='Parabéns! Você agora faz parte da rede Sirius! Apoio aos corretores de imóveis de todo o país!'.
        'Dados para acesso no sistema Sirius: Usuario: '.$request->IMB_ATD_EMAIL.' - Senha: '.$senharand.
        ' - acesse: http://www.siriussystem.com.br/sys';
        $mensagem= str_replace( ' ','%20',$mensagem);

        $url = "http://sms.mkmservice.com/api/?modo=envio&empresa=cdl.bauru"
        ."&usuario=cdl.bauru&senha=mkm@@2017&telefone=$request->IMB_ATD_DDI"."$request->IMB_ATD_DDD1"."$request->IMB_ATD_TELEFONE_1&mensagem=$mensagem&centro_custo=ShortCode&agendamento=";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            return response()->json('Telefone Inválido', 404);
        }

        return response()->json('ok', 200);
           
    }


}
