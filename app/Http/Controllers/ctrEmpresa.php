<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlEmpresa;
use DataTables;
use App\User;
use DB;
use Auth;
use Log;
class ctrEmpresa extends Controller
{
    public function index()
    {
        return view( 'contasapagar.fornecedores');
    }

    public function list( Request $request)
    {
        $fornecedores = mdlEmpresa::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID);
        $origem = $request->origem;


        $nome=$request->nome;
        $cnpj=$request->cnpj;
        if( $nome <> '' )
           $fornecedores->whereRaw(DB::raw("IMB_EEP_NOMEFANTASIA like '%{$nome}%'"));

        if( $cnpj <> '' )
           $fornecedores->where('IMB_EEP_CGC','=', $cnpj );

        $fornecedores->OrderBy( 'IMB_EEP_NOMEFANTASIA');

        if( $origem =='carga') return $fornecedores->get();

        return DataTables::of($fornecedores)->make(true);;



    }

    public function find( $id )
    {
        $gc = mdlEmpresa::find( $id );
        return $gc;
    }

    public function salvar( Request $request )
    {

        $IMB_EEP_ID = $request->IMB_EEP_ID;
        $IMB_EEP_NOMEFANTASIA = $request->IMB_EEP_NOMEFANTASIA;
        $IMB_EEP_RAZAOSOCIAL = $request->IMB_EEP_RAZAOSOCIAL;
        $IMB_EEP_ENDERECO = $request->IMB_EEP_ENDERECO;
        $IMB_EEP_ENDERECONUMERO = $request->IMB_EEP_ENDERECONUMERO;
        $IMB_EEP_ENDERECOCEP = $request->IMB_EEP_ENDERECOCEP;
        $IMB_EEP_EMAIL = $request->IMB_EEP_EMAIL;
        $IMB_EEP_URL = $request->IMB_EEP_URL;
        $IMB_EEP_CONTATO1 = $request->IMB_EEP_CONTATO1;
        $IMB_EEP_CONTATO2 = $request->IMB_EEP_CONTATO2;
        $IMB_EEP_CONTATO3 = $request->IMB_EEP_CONTATO3;
        $IMB_EEP_CGC = $request->IMB_EEP_CGC;
        $IMB_EEP_PESSOA = $request->IMB_EEP_PESSOA;
        $IMB_EEP_OBSERVACAO = $request->IMB_EEP_OBSERVACAO;
        $CEP_CID_NOME = $request->CEP_CID_NOME;
        $CEP_BAI_NOME = $request->CEP_BAI_NOME;
        $CEP_UF_SIGLA = $request->CEP_UF_SIGLA;
        $FIN_CFC_ID = $request->FIN_CFC_ID;
        $FIN_SBC_ID = $request->FIN_SBC_ID;
        $IMB_EEP_PIX = $request->IMB_EEP_PIX;


        if( $IMB_EEP_ID == '' )
            $gc = new mdlEmpresa;
        else
            $gc = mdlEmpresa::Find( $IMB_EEP_ID  );

        $gc->IMB_EEP_NOMEFANTASIA           = $IMB_EEP_NOMEFANTASIA;
        $gc->IMB_EEP_RAZAOSOCIAL            = $IMB_EEP_RAZAOSOCIAL;
        $gc->IMB_EEP_ENDERECO               = $IMB_EEP_ENDERECO;
        $gc->IMB_EEP_ENDERECONUMERO         = $IMB_EEP_ENDERECONUMERO;
        $gc->IMB_EEP_ENDERECOCEP            = $IMB_EEP_ENDERECOCEP;
        $gc->IMB_EEP_EMAIL                  = $IMB_EEP_EMAIL;
        $gc->IMB_EEP_URL                    = $IMB_EEP_URL;
        $gc->IMB_EEP_CONTATO1               = $IMB_EEP_CONTATO1;
        $gc->IMB_EEP_CONTATO2               = $IMB_EEP_CONTATO2;
        $gc->IMB_EEP_CONTATO3               = $IMB_EEP_CONTATO3;
        $gc->IMB_EEP_CGC                    = $IMB_EEP_CGC;
        $gc->IMB_EEP_PESSOA                 = $IMB_EEP_PESSOA;
        $gc->IMB_EEP_OBSERVACAO             = $IMB_EEP_OBSERVACAO;
        $gc->CEP_CID_NOME                   = $CEP_CID_NOME;
        $gc->CEP_BAI_NOME                   = $CEP_BAI_NOME;
        $gc->CEP_UF_SIGLA                   = $CEP_UF_SIGLA;
        $gc->FIN_CFC_ID                     = $FIN_CFC_ID;
        $gc->FIN_SBC_ID                     = $FIN_SBC_ID;
        $gc->IMB_EEP_PIX                     = $IMB_EEP_PIX;
        $gc->IMB_EEP_DATACADASTRO           = date('Y/m/d');
        $gc->IMB_ATD_ID                     = Auth::user()->IMB_ATD_ID;
        $gc->IMB_ATD_ID                     = Auth::user()->IMB_ATD_ID;
        $gc->IMB_IMB_ID                     = Auth::user()->IMB_IMB_ID;
        $gc->save();

        return response()->json( 'ok',200);

    }

    public function inativar( $id )
    {
        $gc = mdlGrupoCFC::Find( $id  );

        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;

        if ( $gc->IMB_GCF_DTHINATIVO=='')
            $gc->IMB_GCF_DTHINATIVO = date('Y-m-d H:i:s');
        else
        $gc->IMB_GCF_DTHINATIVO = null;

        $gc->save();

        return response()->json( 'ok',200);

    }


    public function porCnpj( $cnpj )
    {
        $fornecedores = mdlEmpresa::where( 'IMB_EEP_CGC','=', $cnpj)->first();

        if( $fornecedores ) return response()->json( $fornecedores,200);

        return response()->json('não encontrato',404);

    }





    //
}
