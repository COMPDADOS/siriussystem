<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCaucao;

use DataTables;
use DB;
use Auth;
use Log;
class ctrContratoCaucao extends Controller
{

    public function index()
    {
        return view( 'caucao.caucaoindex',  [ 'idcontrato' => 0 ] );
    }
    
    function formatarData($data){
        $rData = implode("-", array_reverse(explode("/", trim($data))));
        return $rData;
    }

    public function mostrar( $id )
    {

    //    dd( $id );
        $cs = mdlCaucao::select(
            [
                'IMB_CAU_ID',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATOCAUCAO.IMB_CTR_ID',
                'GER_BNC_NUMERO',
                DB::Raw('( select GER_BNC_NOME FROM GER_BANCOS WHERE GER_BANCOS.GER_BNC_NUMERO =  GER_BANCOS.GER_BNC_NUMERO LIMIT 1) AS BANCO'),
                'IMB_CONTRATOCAUCAO.FIN_CCX_ID',
                DB::Raw('( select FIN_CCX_DESCRICAO FROM FIN_CONTACAIXA WHERE IMB_CONTRATOCAUCAO.FIN_CCX_ID =  FIN_CONTACAIXA.FIN_CCX_ID ) AS FIN_CCX_DESCRICAO'),
                DB::Raw('( select FIN_CCI_CONCORNUMERO FROM FIN_CONTACAIXA WHERE IMB_CONTRATOCAUCAO.FIN_CCX_ID =  FIN_CONTACAIXA.FIN_CCX_ID ) AS FIN_CCI_CONCORNUMERO'),
                'IMB_CAU_CONTACORRENTE',
                'IMB_CAU_AGENCIA',
                'IMB_CAU_DATADEPOSITO',
                'IMB_CAU_DATAATUALIZACAO',
                'IMB_CAU_OBSERVACAO',
                'IMB_CAU_VALOR',
                'IMB_CAU_VALORATUALIZADO',
                'IMB_CAU_MESES',
                DB::Raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATOCAUCAO.IMB_CTR_ID ) ) AS LOCATARIO'),
                'IMB_CTR_REFERENCIA',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) AS ENDERECO'),

            ]
        )
        ->where( 'IMB_CONTRATOCAUCAO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_CAU_ID','=',$id )
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_CONTRATOCAUCAO.IMB_CTR_ID')
        ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTRATO.IMB_IMV_ID')
        ->first();

        return $cs;

    }
    
    public function carga( Request $request )
    {

        $id = $request->id;
        $idcontrato=$request->idcontrato;
        $idconta = $request->idconta;
//        dd( $idseguradora );
        $inicio =  $request->inicio;
        $termino =  $request->termino ;
        $somenteativos = $request->somenteativos;

        $inicio = $this->formatarData( $inicio );
        $termino =$this->formatarData(  $termino );
        $cs = mdlCaucao::select(
            [
                'IMB_CAU_ID',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATOCAUCAO.IMB_CTR_ID',
                'GER_BNC_NUMERO',
                DB::Raw('( select GER_BNC_NOME FROM GER_BANCOS WHERE GER_BANCOS.GER_BNC_NUMERO =  GER_BANCOS.GER_BNC_NUMERO LIMIT 1) AS BANCO'),
                'IMB_CONTRATOCAUCAO.FIN_CCX_ID',
                DB::Raw('( select FIN_CCX_DESCRICAO FROM FIN_CONTACAIXA WHERE IMB_CONTRATOCAUCAO.FIN_CCX_ID =  FIN_CONTACAIXA.FIN_CCX_ID ) AS FIN_CCX_DESCRICAO'),
                DB::Raw('( select FIN_CCI_CONCORNUMERO FROM FIN_CONTACAIXA WHERE IMB_CONTRATOCAUCAO.FIN_CCX_ID =  FIN_CONTACAIXA.FIN_CCX_ID ) AS FIN_CCI_CONCORNUMERO'),
                'IMB_CAU_CONTACORRENTE',
                'IMB_CAU_AGENCIA',
                'IMB_CAU_DATADEPOSITO',
                'IMB_CAU_DATAATUALIZACAO',
                'IMB_CAU_OBSERVACAO',
                'IMB_CAU_VALOR',
                'IMB_CAU_VALORATUALIZADO',
                'IMB_CAU_MESES',
                DB::Raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATOCAUCAO.IMB_CTR_ID ) ) AS LOCATARIO'),
                'IMB_CTR_REFERENCIA',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) AS ENDERECO'),

            ]
        )
        ->where( 'IMB_CONTRATOCAUCAO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_CONTRATOCAUCAO.IMB_CTR_ID')
        ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTRATO.IMB_IMV_ID');

        if( $somenteativos == 'S' )
            $cs = $cs->where( 'IMB_CTR_SITUACAO','=','ATIVO' );
        
        if( $id )
        {
            $cs = $cs->where( 'IMB_CAU_ID','=',$id );
            $inicio = '1900-01-01';
            $termino='2060-12-31';
        }
        else
        if( $idcontrato )
        {
            $cs = $cs->where( 'IMB_CONTRATOCAUCAO.IMB_CTR_ID', '=', $idcontrato );
            $inicio = '1900-01-01';
            $termino='2060-12-31';
        }
        else
            $cs = $cs->whereRaw( "IMB_CAU_DATADEPOSITO BETWEEN '$inicio' and '$termino'");

        if( $idconta <> '-1' )
            $cs = $cs->where( 'IMB_CONTRATOCAUCAO.FIN_CCX_ID','=', $idconta);

        
        //dd( $cs->toSql());

        return DataTables::of($cs)->make(true);        


    }

    public function new( $idcontrato )
    {
        $idcontrato=$idcontrato;
        return view( 'caucao.caucaoindex', [ 'idcontrato' => $idcontrato ] );

    }


    public function update( Request $request )
    {


        $conta = app('App\Http\Controllers\ctrContaCaixa')
        ->find( $request->FIN_CCX_ID );


        $id=$request->IMB_CAU_ID;
        if( $id )
            $stc = mdlCaucao::find( $id);
        else
            $stc = new mdlCaucao;

        $stc->IMB_CTR_ID = $request->IMB_CTR_ID;
        $stc->IMB_CAU_DATADEPOSITO = $this->formatarData( $request->IMB_CAU_DATADEPOSITO );
        $stc->IMB_CAU_VALOR = $request->IMB_CAU_VALOR;
        $stc->IMB_CAU_MESES = $request->IMB_CAU_MESES;
        $stc->IMB_CAU_OBSERVACAO = $request->IMB_CAU_OBSERVACAO;
        $stc->IMB_CAU_DTHATIVO = date('Y/m/d');
        $stc->FIN_CCX_ID = $request->FIN_CCX_ID;
        $stc->GER_BNC_NUMERO = $conta->FIN_CCI_BANCONUMERO;
        $stc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $stc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        if(  $request->IMB_CAU_DATAATUALIZACAO )
            $stc->IMB_CAU_DATAATUALIZACAO = $this->formatarData( $request->IMB_CAU_DATAATUALIZACAO );
        if(  $request->IMB_CAU_VALORATUALIZADO )
            $stc->IMB_CAU_VALORATUALIZADO = $this->formatarData( $request->IMB_CAU_VALORATUALIZADO );


        $stc->save();

        return response()->json( 'ok',200 );

    }
    


}
