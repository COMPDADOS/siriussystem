<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImobiliaria;
use App\mdlCobrancaGeradaPerm;
use App\mdlCliente;
use App\mdlTelefone;
use App\mdlLocatarioContrato;
use App\mdlContrato;
use App\mdlReciboLocatario;
use App\mdlReciboLocador;
use Auth;
use PDF;

use DB;

class ctrClienteAcesso extends Controller
{


    public function portal()
    {
        $imb =mdlImobiliaria::first();
        if( $imb )
            return view( 'meuimovel.login', compact('imb') );

        return "Empresa não encontrado!";
    }

    public function validar( Request $request )
    {
        $cpf = $request->cpf;
        $senha = $request->password;

        $cgs = mdlCobrancaGeradaPerm::
        select( 
                [ 'IMB_CTR_ID as id',
                  'IMB_CTR_REFERENCIA AS Pasta',
                  'IMB_CGR_ENDERECO as Endereco' 
                ]
        )
        ->distinct()
        ->where( 'IMB_CGR_CPF', '=', $cpf )
        ->get(['IMB_CTR_ID', 'IMB_CTR_REFERENCIA','IMB_CGR_ENDERECO']);


        if( $cgs <> '[]' )
        {

            return response()->json($cgs, 200 );

        }

            

        return response()->json( 'Usuario ou Senha Inválidos!', 404 );


    }

    public function iniciar( $cgc )
    {
        $imb =mdlImobiliaria::where("IMB_IMB_CGC","=", $cgc )->first();
        if( $imb )
            return view( 'portalcliente.portalclientelogin', compact('imb') );

        return "Empresa não encontrado!";
    }

    public function loginMeuImovel( $cgc)
    {
        $imb =mdlImobiliaria::where("IMB_IMB_CGC","=", $cgc )->first();
        if( $imb )
            return view( 'meuimovel.login', compact('imb') );

        return "Empresa não encontrado!";
    }


    public function boletos( $contrato )
    {
        $cob = mdlCobrancaGeradaPerm::where( 'IMB_CTR_ID','=', $contrato )
        ->whereNull( 'IMB_CGR_DTHINATIVO')
        ->whereNull( 'IMB_CGR_DATABAIXA')
        ->orderBy( 'IMB_CGR_DATAVENCIMENTO')
        ->get();

        return $cob;

    }

    public function meuImovelRecSenha( $cgc )
    {
        $imb =mdlImobiliaria::where("IMB_IMB_CGC","=", $cgc )->first();
        
        if( $imb )
            return view( 'meuimovel.recebersenha', compact('imb') );
        
        return "Empresa não encontrado!";
                
    }

    public function clienteCPF( $imb, $cpf )
    {
        $clt = mdlCliente::select( 
            [
                'IMB_CLT_EMAIL',
                'IMB_CLT_ID',
                'IMB_CLT_NOME',
                'IMB_TLF_NUMERO',
                'IMB_TLF_DDD',
                'IMB_TLF_TIPOTELEFONE',
                'IMB_CLT_SEXO',
                'IMB_CLT_SENHA',
                'IMB_CLT_CPF',
                DB::RAW( '( select IMB_CLT_ID FROM IMB_PROPRIETARIOIMOVEL A WHERE A.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID LIMIT 1 ) AS IDPROP ')

            ]
        )->where( 'IMB_CLIENTE.IMB_IMB_ID','=', $imb )
        ->where('IMB_CLT_CPF','=',$cpf )
        ->leftJoin( 'IMB_TELEFONES','IMB_TLF_ID_CLIENTE', 'IMB_CLT_ID')
        ->get();

       return response()->json( $clt, 200 );
       
    }


    public function meuImovelenviarSenhaSMS( Request $request )
    {
        
        header("Location: https://www.compdados.com.br");
        return response()->json( 'ok',200);
     
       
    }

    public function meusImoveis( Request $request)
    {
        $id = $request->id;

        $clt = mdlCliente::find( $id);
        $imb = mdlImobiliaria::find( $clt->IMB_IMB_ID);

        return view( 'meuimovel.meusimoveisindex', compact( 'clt', 'imb') );
    }

    public function meusContratos( $id)
    {
        //$id = $request->id;

        $clt = mdlCliente::find( $id);
        $contratos = mdlLocatarioContrato::select(
            [
                'IMB_CONTRATO.IMB_CTR_ID',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATO.IMB_CTR_INICIO',
                'IMB_CONTRATO.IMB_CTR_DATAREAJUSTE',
                'IMB_CONTRATO.IMB_CTR_DURACAO',
                'IMB_CONTRATO.IMB_CTR_DIAVENCIMENTO',
                DB::Raw( 'imovel( IMB_CONTRATO.IMB_IMV_ID ) AS ENDERECO'),
                'IMB_CTR_REFERENCIA',
                'CEP_BAI_NOME',
                'IMB_IMV_CIDADE'

            ]
        )
        
        ->where( 'IMB_LOCATARIOCONTRATO.IMB_CLT_ID','=',$id )
        ->leftJoin('IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_LOCATARIOCONTRATO.IMB_CTR_ID')
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTRATO.IMB_IMV_ID')
        ->get();

        return view( 'meuimovel.meuscontratos', compact('contratos','clt'));
    }

    public function dadosContrato( Request $request )
    {
        $id = $request->id;
        $ctr = mdlContrato::select(
            [
                'IMB_CTR_ID',
                'IMB_CTR_INICIO',
                'IMB_CTR_TERMINO',
                'IMB_CTR_DATAREAJUSTE',
                'IMB_CTR_DIAVENCIMENTO',
                'IMB_CTR_VENCIMENTOLOCATARIO',
                'IMB_CTR_VALORALUGUEL',
                'IMB_CTR_VALORBONIFICACAO4',
                'IMB_CTR_BONIFICACAOTIPO',
                'IMB_CTR_DURACAO',
                'IMB_CTR_SITUACAO',
                DB::Raw( '(SELECT IMB_IRJ_NOME FROM IMB_INDICEREAJUSTE 
                    WHERE IMB_CONTRATO.IMB_IRJ_ID = IMB_INDICEREAJUSTE.IMB_IRJ_ID) AS IMB_IRJ_NOME' )
            ]
        )
        ->where( 'IMB_CTR_ID','=', $id )
        ->first();

        return $ctr;


    }

    public function carregarHistoricoLT( $id)
    {
        $array =[];

        $header = mdlReciboLocatario::select( 
            [
           
            'IMB_RLT_LOCATARIOCREDEB',
            'IMB_RLT_NUMERO',
            'IMB_RLT_DATAPAGAMENTO',
            'IMB_RLT_DATACOMPETENCIA',
            DB::raw( ' (select COALESCE(sum( IMB_RLT_VALOR), 0) from IMB_RECIBOLOCATARIO rt
            where rt.IMB_RLT_NUMERO = IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO
            and rt.IMB_RLT_LOCATARIOCREDEB = "D" ) -
            (select COALESCE( sum( IMB_RLT_VALOR),0 ) from IMB_RECIBOLOCATARIO rt
                        where rt.IMB_RLT_NUMERO = IMB_RECIBOLOCATARIO.IMB_RLT_NUMERO
                        and rt.IMB_RLT_LOCATARIOCREDEB = "C" ) AS TOTAL '),
            DB::raw( '(select FIN_CCX_DESCRICAO FROM FIN_CONTACAIXA 
                    WHERE FIN_CONTACAIXA.FIN_CCX_ID = FIN_CCR_ID) AS FIN_CCX_DESCRICAO'),
            ])
            ->where( 'IMB_CTR_ID','=',$id )
            ->whereNull( 'IMB_RLT_DTHINATIVO')
            ->orderBy( 'IMB_RLT_DATACOMPETENCIA','DESC')
            ->get();

            $recibo = '';
            foreach( $header as $reg)
            {
                
                if( $recibo <> $reg->IMB_RLT_NUMERO )
                {
                    array_push($array, $reg );
                    $recibo = $reg->IMB_RLT_NUMERO;
    
                }
            }
              
    
    
                        
        return response()->json( $array,200);

    }    

    public function localizarNomePorCpf( Request $request )
    {

        $cpf = $request->cpf;
        if( $cpf == '' ) return response()->json( 'Informe o CPF ou CNPJ', 404);
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
        
        return response()->json( $tabela->IMB_CLT_NOME,200 );
            
    }

    public function demonstrativosNew( Request $request)
    {

        $logged='S';
        if( ! Auth::check())
        {
            Auth::loginUsingId( 1,false);
            $logged = 'N';
        }
        $idcliente = $request->IMB_CLT_ID;
        $datainicial =$request->datainicial;
        $datafinal = $request->datafinal;
        $email = $request->email;
        $idimovel = $request->IMB_IMV_ID;

        if( $datainicial == '' or $datainicial == null  )
            $datainicial = date('Y/m/d');
        if( $datafinal == '' or $datafinal == null )
            $datafinal = date('Y/m/d');


        $recs = mdlReciboLocador::select(
        [
            'IMB_RLD_NUMERO'
        ])
        ->where( 'IMB_RECIBOLOCADOR.IMB_CLT_ID','=',$idcliente )
        ->whereNull( 'IMB_RLD_DTHINATIVO')
        ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','>=',$datainicial )
        ->where( 'IMB_RECIBOLOCADOR.IMB_RLD_DATAPAGAMENTO','<=',$datafinal );


        if( $idimovel <> '' )
            $recs = $recs->where( 'IMB_IMV_ID','=', $idimovel );

        $recs = $recs->distinct('IMB_RLD_NUMERO');
        $recs = $recs->orderBy( 'IMB_RLD_NUMERO','ASC')
                ->orderBy( 'IMB_TBE_ID','ASC')
                ->get();

        $datainicial = app('App\Http\Controllers\ctrRotinas')->formatarData($datainicial);
        $datafinal = app('App\Http\Controllers\ctrRotinas')->formatarData($datafinal);
        $regclt =  app('App\Http\Controllers\ctrRotinas')->clienteDadosFull( $idcliente );
        if( $regclt == '' ) 
            $nomecliente ='Nome do Locador não Encontrado, código: '.$idcliente;
        else
            $nomecliente = $regclt->IMB_CLT_NOME;


        if( $recs <> '[]' ) 
        {

            $recibo = mdlRecibolocador::where( 'IMB_RLD_NUMERO','=', $recs[0]->IMB_RLD_NUMERO )->first();
            $imovel_log = $recibo->IMB_IMV_ID;
            $contrato_log = $recibo->IMB_CTR_ID;

            $html = view( 'reports.locador.demonstrativonew', compact( 'recs', 'idcliente', 'datainicial', 'datafinal','nomecliente'));
            $pdf=PDF::loadHtml( $html,'UTF-8');
            Auth::logout();
            return $pdf->stream('demonstrativo.pdf');
        }
        
        if( $logged == 'N')
            Auth::logout();
    }



}
