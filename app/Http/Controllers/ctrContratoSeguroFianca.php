<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContratoSeguroFianca;
use App\mdlContrato;
use DataTables;
use DB;
use Auth;
class ctrContratoSeguroFianca extends Controller
{

    public function index()
    {
        return view( 'segurofianca.segurofiancaindex',  [ 'idcontrato' => 0 ] );
    }
    
    function formatarData($data){
        $rData = implode("-", array_reverse(explode("/", trim($data))));
        return $rData;
    }
    
    public function cargaMarcadosSeguroFianca( Request $request )
    { 
        $ctrs = mdlContrato::select( 
            [
                'IMB_CTR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_CTR_INICIO',
                'IMB_CTR_DATARESCISAO',
                DB::raw( 'imovel( IMB_IMV_ID) AS ENDERECO'),
                DB::raw( 'PEGALOCATARIOCONTRATO( IMB_CTR_ID) AS LOCATARIO' )
            ]
        )->where( 'IMB_CTR_EXIGENCIA','=','S' )
        ->where('IMB_CTR_SITUACAO','=','ATIVO')
        ->orderBy( 'IMB_CTR_REFERENCIA')
        ->get();

        return view( 'reports.admimoveis.relsegfiancamarcados', compact( 'ctrs'));


    }
    public function carga( Request $request )
    {

        $id = $request->id;
        $idcontrato=$request->idcontrato;
        $idseguradora = $request->idseguradora;
//        dd( $idseguradora );
        $inicio =  $this->formatarData($request->inicio);
        $termino = $this->formatarData( $request->termino );
        
        $cs = mdlContratoSeguroFianca::select(
            [
                'IMB_SCC_ID',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATOSEGUROFIANCA.IMB_CTR_ID',
                'IMB_CTR_INICIO',
                'IMB_CONTRATOSEGUROFIANCA.IMB_CLT_ID',
                'IMB_CTR_VIGENCIAINICIO',
                'IMB_CTR_VIGENCIATERMINO',
                'IMB_SCC_DRHINATIVO',
                'IMB_SCC_OBSERVACAO',
                'IMB_SCC_VALOR',
                'IMB_SCC_MESES',
                'IMB_CTR_DATAAQUISICAO',
                'IMB_CLT_NOME AS SEGURADORA',
                DB::Raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATOSEGUROFIANCA.IMB_CTR_ID ) ) AS LOCATARIO'),
                'IMB_CTR_REFERENCIA',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) AS ENDERECO'),

            ]
        )
        
        ->where( 'IMB_CONTRATOSEGUROFIANCA.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_CONTRATOSEGUROFIANCA.IMB_CTR_ID')
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_CONTRATOSEGUROFIANCA.IMB_CLT_ID')
        ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTRATO.IMB_IMV_ID');




        if( $id )
        {
            $cs = $cs->where( 'IMB_SCT_ID','=',$id );
            $inicio = '1900-01-01';
            $termino='2060-12-31';
          }
  
        if( $idcontrato )
        {
            $cs = $cs->where( 'IMB_CONTRATOSEGUROFIANCA.IMB_CTR_ID', '=', $idcontrato );
            $inicio = '1900-01-01';
            $termino='2060-12-31';
          }
  
          if( $idseguradora )
            $cs = $cs->where( 'IMB_CONTRATOSEGUROFIANCA.IMB_CLT_ID','=', $idseguradora);

          $cs = $cs->where( 'IMB_CTR_VIGENCIATERMINO','>=', $inicio)
                    ->where( 'IMB_CTR_VIGENCIATERMINO','<=', $termino);
  
        

        return DataTables::of($cs)->make(true);        


    }

    public function new( $idcontrato )
    {
        $idcontrato=$idcontrato;
        return view( 'segurofianca.segurofiancaindex', [ 'idcontrato' => $idcontrato ] );

    }


    public function update( Request $request )
    {

        $id=$request->IMB_SCC_ID;
        if( $id )
            $stc = mdlContratoSeguroFianca::find( $id);
        else
            $stc = new mdlContratoSeguroFianca;

        $stc->IMB_CTR_ID = $request->IMB_CTR_ID;
        $stc->IMB_CTR_DATAAQUISICAO = $this->formatarData( $request->IMB_CTR_DATAAQUISICAO );
        $stc->IMB_CTR_VIGENCIAINICIO = $this->formatarData($request->IMB_CTR_VIGENCIAINICIO);
        $stc->IMB_CTR_VIGENCIATERMINO = $this->formatarData($request->IMB_CTR_VIGENCIATERMINO);
        $stc->IMB_SCC_NUMERODOCUMENTO = $request->IMB_SCC_NUMERODOCUMENTO;
        $stc->IMB_SCC_OBSERVACAO = $request->IMB_SCC_OBSERVACAO;
        $stc->IMB_SCC_MESES = $request->IMB_SCC_MESES;
        $stc->IMB_SCC_VALORPARCELA = $request->IMB_SCC_VALORPARCELA;
        $stc->IMB_SCC_DTHATIVO = date('Y/m/d');
        $stc->IMB_CLT_ID = $request->IMB_CLT_ID;
        $stc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $stc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $stc->save();

        return response()->json( 'ok',200 );

    }

    public function find( $id )
    {

        $cs = mdlContratoSeguroFianca::find( $id);

        return $cs;
    }
//  

}
