<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAvisoDesocupacao;
use DataTables;
use Auth;
use DB;

class ctrAvisoDesocupacao extends Controller
{
    public function index()
    {
        return view( 'avisodesocupacao.avisodesocupacaoindex');
    }

    public function list( Request $request )
    {
        $datainicio =$request->datainicio;
        $datafim = $request->datafim;
        $contrato='';
        if( $request->has('idcontrato') and $request->idcontrato <> '' )
            $contrato=$request->idcontrato;

        $avd = mdlAvisoDesocupacao::select(
            [
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_AVD_ID',
                'IMB_CONTRATOAVISODESOC.IMB_IMB_ID',
                'IMB_CONTRATOAVISODESOC.IMB_CTR_ID',
                'IMB_AVD_DATAAVISO',
                'IMB_AVD_DATAPREVISAO',
                'IMB_AVD_RELATO',
                'IMB_AVD_LIBERADOPROP',
                'IMB_CONTRATOAVISODESOC.IMB_ATD_ID',
                'IMB_AVD_DTHATIVO',
                'IMB_AVD_DTHINATIVO',
                'IMB_AVD_NOME',
                'IMB_AVD_CPF',
                'IMB_AVD_RG',
                'IMB_CTR_REFERENCIA',
                'IMB_ATD_NOME',
                DB::raw( '(select imovel( IMB_CONTRATO.IMB_IMV_ID) ) as Endereco')

            ]
        )
        ->where('IMB_CONTRATOAVISODESOC.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->where('IMB_CTR_SITUACAO','=','ATIVO' );

        if( $datainicio <> '' )
            $avd->whereBetween('IMB_CONTRATOAVISODESOC.IMB_AVD_DATAPREVISAO', [$datainicio, $datafim]);

        if( $contrato <> '')
           $avd->where('IMB_CONTRATOAVISODESOC.IMB_CTR_ID','=', $contrato );


        $avd->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_CONTRATOAVISODESOC.IMB_CTR_ID');
        $avd->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID','IMB_CONTRATOAVISODESOC.IMB_ATD_ID');


        return DataTables::of($avd)->make(true);
    }

    public function store( Request $request)
    {
        $avd = new mdlAvisoDesocupacao;
        $avd->IMB_CTR_ID = $request->IMB_CTR_ID;
        $avd->IMB_AVD_DATAAVISO = $request->IMB_AVD_DATAAVISO;
        $avd->IMB_AVD_DATAPREVISAO = $request->IMB_AVD_DATAPREVISAO;
        $avd->IMB_AVD_RELATO = $request->IMB_AVD_RELATO;
        $avd->IMB_AVD_LIBERADOPROP = $request->IMB_AVD_LIBERADOPROP;
        $avd->IMB_AVD_DTHATIVO = date('Y/m/d');
        $avd->IMB_AVD_NOME = $request->IMB_AVD_NOME;
        $avd->IMB_AVD_CPF = $request->IMB_AVD_CPF;
        $avd->IMB_AVD_RG = $request->IMB_AVD_RG;
        $avd->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $avd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $avd->save();

        return response()->json('ok',200);


    }

    public function inativar( $id )
    {
        $avd = mdlAvisoDesocupacao::find( $id );
        $avd->IMB_AVD_DTHINATIVO = date( 'Y/m/d');
        $avd->IMB_ATD_IDINATIVO = Auth::user()->IMB_ATD_ID;
        $avd->save();

        return response()->json('ok',200 );

    }
    //
}
