<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContratoSeguroIncendio;
use DataTables;
use DB;
use Auth;
use Log;
class ctrContratoSeguroIncendio extends Controller
{

    public function index()
    {
        return view( 'seguroincendio.seguroincendioindex',  [ 'idcontrato' => 0 ] );
    }
    
    function formatarData($data){
        $rData = implode("-", array_reverse(explode("/", trim($data))));
        return $rData;
    }
    
    public function carga( Request $request )
    {

        $id = $request->id;
        $idcontrato=$request->idcontrato;
        $idseguradora = $request->idseguradora;
//        dd( $idseguradora );
        $inicio =  $this->formatarData($request->inicio);
        $termino = $this->formatarData( $request->termino );
        
        $cs = mdlContratoSeguroIncendio::select(
            [
                'IMB_SCT_ID',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CONTRATOSEGUROINCENDIO.IMB_CTR_ID',
                'IMB_CTR_INICIO',
                'IMB_CONTRATOSEGUROINCENDIO.IMB_CLT_ID',
                'IMB_CTR_VIGENCIAINICIO',
                'IMB_CTR_VIGENCIATERMINO',
                'IMB_SCR_DRHINATIVO',
                'IMB_SCT_OBSERVACAO',
                'IMB_CTR_DATAAQUISICAO',
                'IMB_CLT_NOME AS SEGURADORA',
                'IMB_SCT_VALORSEGURO',
                'IMB_SCT_VALORCOBERTURA',
                                
                DB::Raw('( select PEGALOCADORPRINCIPALIMV( IMB_IMOVEIS.IMB_IMV_ID ) ) AS LOCADOR'),
                DB::Raw('( select PEGACPFLOCADORPRINCIPALIMV( IMB_IMOVEIS.IMB_IMV_ID ) ) AS LOCADORCPF'),
                DB::Raw('( select PEGALOCATARIOCONTRATO( IMB_CONTRATOSEGUROINCENDIO.IMB_CTR_ID ) ) AS LOCATARIO'),
                DB::Raw('( select PEGACPFLOCATARIOCONTRATO( IMB_CONTRATOSEGUROINCENDIO.IMB_CTR_ID ) ) AS LOCATARIOCPF'),
                'IMB_CTR_REFERENCIA',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) AS ENDERECO'),

            ]
        )
        
        ->where( 'IMB_CONTRATOSEGUROINCENDIO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID','IMB_CONTRATOSEGUROINCENDIO.IMB_CTR_ID')
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_CONTRATOSEGUROINCENDIO.IMB_CLT_ID')
        ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTRATO.IMB_IMV_ID');




        if( $id )
        {
            $cs = $cs->where( 'IMB_SCT_ID','=',$id );
            $inicio = '1900-01-01';
            $termino='2060-12-31';
          }
  
        if( $idcontrato )
        {
            $cs = $cs->where( 'IMB_CONTRATOSEGUROINCENDIO.IMB_CTR_ID', '=', $idcontrato );
            $inicio = '1900-01-01';
            $termino='2060-12-31';
          }
  
          if( $idseguradora )
            $cs = $cs->where( 'IMB_CONTRATOSEGUROINCENDIO.IMB_CLT_ID','=', $idseguradora);

          $cs = $cs->where( 'IMB_CTR_VIGENCIATERMINO','>=', $inicio)
                    ->where( 'IMB_CTR_VIGENCIATERMINO','<=', $termino);
  
        

                    Log::info( "Inicio: $inicio");
                    Log::info( "TERMINO: $termino");
                    Log::info( "Contrato: $idcontrato");

                    Log::info( $cs->toSql() );
        return DataTables::of($cs)->make(true);        


    }

    public function new( $idcontrato )
    {
        $idcontrato=$idcontrato;
        return view( 'seguroincendio.seguroincendioindex', [ 'idcontrato' => $idcontrato ] );

    }


    public function update( Request $request )
    {

        $id=$request->IMB_SCT_ID;
        if( $id )
            $stc = mdlContratoSeguroIncendio::find( $id);
        else
            $stc = new mdlContratoSeguroIncendio;

        $stc->IMB_CTR_ID = $request->IMB_CTR_ID;
        $stc->IMB_CTR_DATAAQUISICAO = $this->formatarData( $request->IMB_CTR_DATAAQUISICAO );
        $stc->IMB_CTR_VIGENCIAINICIO = $this->formatarData($request->IMB_CTR_VIGENCIAINICIO);
        $stc->IMB_CTR_VIGENCIATERMINO = $this->formatarData($request->IMB_CTR_VIGENCIATERMINO);
        $stc->IMB_SCT_OBSERVACAO = $request->IMB_SCT_OBSERVACAO;
        $stc->IMB_SCR_DTHATIVO = date('Y/m/d');
        $stc->IMB_CLT_ID = $request->IMB_CLT_ID;
        $stc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $stc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $stc->IMB_SCT_VALORSEGURO = $request->IMB_SCT_VALORSEGURO;
        $stc->IMB_SCT_VALORCOBERTURA = $request->IMB_SCT_VALORCOBERTURA;
        $stc->save();

        return response()->json( 'ok',200 );

    }

}
