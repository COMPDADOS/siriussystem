<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCliente;
use App\mdlTelefone;
use App\Atendente;
use App\Http\Controllers\Controller;
use App\Mail\mailselfboasvindas;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\mdlAtendente;
use App\mdlDireitos;
use App\mdlImobiliaria;
 
class ctrAutoCadastro extends Controller
{

    public function index( $empresa )
    {
        return view( 'interacao.autocadastrocliente', compact( 'empresa') );
         
    }
    public function checarjacadastrado( $cpf )
    {

        $cpf =  str_replace( '.','', $cpf);   
        $cpf =  str_replace( '-','', $cpf);   
        $cpf =  str_replace( '/','', $cpf);   

        $tabela= mdlCliente::select( [
            'IMB_CLT_ID', 
            'IMB_CLT_NOME'
        ])
        ->where( 'IMB_CLT_CPF','=', $cpf )
//        ->limit(100)
        ->first();
        return $tabela->toJson();
        
    }
    
    public function store(Request $request)
    {

            function formatarData($data){
                $rData = implode("-", array_reverse(explode("/", trim($data))));
                return $rData;
            }
            
    //           dd( $request );
                $cpf =  str_replace( '.', '', $request->input( 'CIMB_CLT_CPF'));   
                $cpf =  str_replace( '-','', $cpf);   
                $cpf =  str_replace( '/','', $cpf);   
                $cliente = new mdlCliente;
                
                $cliente->IMB_IMB_ID = $request->input( 'IMB_IMB_ID');
                $cliente->IMB_IMB_ID2 = $request->input( 'IMB_IMB_ID2');
                $cliente->IMB_IMB_IDMASTER = $request->input( 'IMB_IMB_ID2');;
                $cliente->IMB_CLT_NOME = $request->input( 'IMB_CLT_NOME');
                $cliente->IMB_CLT_PESSOA = $request->input( 'IMB_CLT_PESSOA');
                $cliente->IMB_CLT_ESTADOCIVIL = $request->input( 'IMB_CLT_ESTADOCIVIL');
                $cliente->IMB_CLT_SEXO = $request->input( 'IMB_CLT_SEXO');
                $cliente->IMB_CLT_CPF = $request->input( 'IMB_CLT_CPF');
                $cliente->IMB_CLT_RG = $request->input( 'IMB_CLT_RG');
                $cliente->IMB_CLT_RGESTADO = $request->input( 'IMB_CLT_RGESTADO');
                if ( $request->input( 'IMB_CLT_DATNAS') <> '' ) 
                    $cliente->IMB_CLT_DATNAS = formatarData( $request->input( 'IMB_CLT_DATNAS') );
                
                $cliente->IMB_CLT_NACIONALIDADE = $request->input( 'IMB_CLT_NACIONALIDADE');
                $cliente->IMB_CLT_PRECADASTRO = 'S';
                $cliente->IMB_CLT_ORIGEM = 'INTERNET';
                $cliente->IMB_CLT_RESEND = $request->input( 'IMB_CLT_RESEND');
                $cliente->IMB_CLT_RESENDNUM = $request->input( 'IMB_CLT_RESENDNUM');
                $cliente->IMB_CLT_RESENDCOM = $request->input( 'IMB_CLT_RESENDCOM');
                $cliente->IMB_CLT_RESENDCEP = $request->input( 'IMB_CLT_RESENDCEP');
                $cliente->CEP_BAI_NOMERES = $request->input( 'CEP_BAI_NOMERES');
                $cliente->CEP_CID_NOMERES = $request->input( 'CEP_CID_NOMERES');
                $cliente->CEP_UF_SIGLARES = $request->input( 'CEP_UF_SIGLARES');
                $cliente->IMB_CLT_EMAIL = $request->input( 'IMB_CLT_EMAIL');
                $cliente->save();

                $atd = new mdlAtendente;
                $atd->IMB_IMB_ID = $request->input('IMB_IMB_ID');
                $atd->IMB_ATD_NOME  = $request->input( 'IMB_CLT_NOME');
                $atd->IMB_ATD_APELIDO = '';
                $atd->IMB_ATD_EMAIL = $request->input( 'IMB_CLT_EMAIL');
                $atd->email = $request->input( 'IMB_CLT_EMAIL');
                $atd->IMB_ATD_TELEFONE_1 = '';
                $atd->IMB_ATD_TELEFONE_2 = '';
                $atd->IMB_ATD_DDD1 = '';
                $atd->IMB_ATD_DDD2 = '';
                $atd->IMB_ATD_TELTIPO1 = '';
                $atd->IMB_ATD_CLIENTE='S';
                $atd->IMB_ATD_CPF = $request->input( 'IMB_CLT_CPF');
                $atd->IMB_ATD_DATAADMISSAO = date( 'Y-m-d');
        
                $atd->VIS_AGE_ID = $request->input('IMB_IMB_ID2');
                $atd->imb_imb_id2 = $request->input('IMB_IMB_ID2');
                $atd->email = $request->input('IMB_CLT_EMAIL');
                $atd->login = $request->input('IMB_CLT_NOME');
                $atd->IMB_CLT_ID = $cliente->IMB_CLT_ID;
                $atd->save();

                $novosdireitos = new mdlDireitos;

                $novosdireitos->IMB_IMB_ID = $request->input('IMB_IMB_ID');
                $novosdireitos->IMB_ATD_ID = $atd->IMB_ATD_ID;
                $novosdireitos->IMB_MDL_ID = 14;
                $novosdireitos->IMB_STM_ID = '1';
                $novosdireitos->IMB_DIRACE_INCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ALTERACAO='S';
                $novosdireitos->IMB_DIRACE_EXCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ACESSO='N';
                $novosdireitos->save();

                return response()->json( $cliente, 200);
                    
        }

        public function telefoneGravar( Request $request)
        {
            
            $t = new mdlTelefone();
            $t->IMB_TLF_ID_CLIENTE      = $request->input('IMB_TLF_ID_CLIENTE');
            $t->IMB_TLF_DDD             = $request->input('IMB_TLF_DDD');
            $t->IMB_TLF_NUMERO          = $request->input('IMB_TLF_NUMERO');
            $t->IMB_TLF_TIPOTELEFONE    = 'Celular';
            $t->IMB_TLF_TIPO            ='C';
            $t->save();
            
            return  response( 'gravado', 200);        
        }

        public function gravarClientSelf(Request $request)
        {

//            return response()->json('OK', 200);
            
        }

        public function sendBoasVindas( $email )
        {    
            /*$senha = rand( 1000,100000);
            $novasenha = Hash::make( $senha ); 
            
            $atd =  mdlAtendente::where( 'email',$email)
                    ->get();
            $atd->password=$novasenha;
            $atd->save();
              */              
            $objDados = new \stdClass();
            $objDados->demo_one = 'Demo One Value';
            $objDados->demo_two = 'Demo Two Value';
            $objDados->sender = 'atendimento@siriussystem.com.br';
            $objDados->novasenha= '1111';
            $objDados->receiver = 'suporte@compdados.com.br';
            
            Mail::to( $objDados->receiver )->send(new mailselfboasvindas($objDados));                

        
        }            

        public function lerArquivoIni( $caminho)
        {
            $lines = file( $caminho.'/iniself.ini');
            return $lines;
        }


        public function pegarIdEmpresa( $codigo )
        {
            $tabela= mdlImobiliaria::select( [
                'IMB_IMB_ID'
            ])
            ->where( 'IMB_IMB_CODIGO','=', $codigo )
    //        ->limit(100)
            ->first();
            return $tabela->toJson();
        }
                


//
}
