<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlLocatarioContrato;

use Auth;
use DB;

class ctrLocatarioContrato extends Controller
{
    
    public function carga( $idcontrato)
    {

        $locat = mdlLocatarioContrato::where( 'IMB_CTR_ID','=', $idcontrato)
        ->where( 'IMB_LOCATARIOCONTRATO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
        ->get();

        return $locat;


    }
    
    public function cargaAtivos()
    {

        $locat = mdlLocatarioContrato::select(
            [
                'IMB_CLT_NOME',
                'IMB_LOCATARIOCONTRATO.IMB_CTR_ID',
                DB::Raw('( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) as ENDERECOCOMPLETO'),
                'IMB_CONTRATO.IMB_CTR_ID'
            ]
        )
        ->where( 'IMB_LOCATARIOCONTRATO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->where( 'IMB_CONTRATO.IMB_CTR_SITUACAO','=','ATIVO')
        ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
        ->leftJoin( 'IMB_CONTRATO', 'IMB_CONTRATO.IMB_CTR_ID', 'IMB_LOCATARIOCONTRATO.IMB_CTR_ID')
        ->get();

        return $locat;


    }    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lt = new mdlLocatarioContrato;

        $prin = 'N';
        if( $request->IMB_LCTCTR_PRINCIPAL == 'Principal')
           $prin="S";

        $lt->IMB_IMB_ID           = Auth::user()->IMB_IMB_ID;
        $lt->IMB_CLT_ID           = $request->IMB_CLT_ID;
        $lt->IMB_CTR_ID           = $request->IMB_CTR_ID;
        $lt->IMB_LCTCTR_PRINCIPAL = $prin;
        $lt->save();
        
        return response()->json( 'ok', 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lt = mdlLocatarioContrato::find( $id );
        if( $lt == '' ) 
            return response()->json( 'já excluido',404);

        $lt->delete();

        return response()->json( 'OK', 200);
    }

    public function contratosdoLocatario( $id )
    {
        $contratos = mdlLocatarioContrato::select( [
            'IMB_LOCATARIOCONTRATO.IMB_CTR_ID',
            'IMB_LOCATARIOCONTRATO.IMB_CLT_ID',
            'IMB_CLT_NOME',
            'IMB_CONTRATO.IMB_CTR_ID',
            'IMB_CTR_REFERENCIA',
            'IMB_CTR_DATALOCACAO',
            'IMB_CTR_INICIO',
            'IMB_CTR_VALORALUGUEL',
            'IMB_CTR_DATARESCISAO',
            'IMB_CTR_SITUACAO',
            DB::raw( '( select imovel( IMB_CONTRATO.IMB_IMV_ID ) ) as ENDERECO')

        ])
        ->where( 'IMB_LOCATARIOCONTRATO.IMB_CLT_ID','=', $id )
        ->leftJoin( 'IMB_CONTRATO', 'IMB_CONTRATO.IMB_CTR_ID', 'IMB_LOCATARIOCONTRATO.IMB_CTR_ID' )
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
        ->orderBy( 'IMB_CTR_INICIO')
        ->get();

        if (count($contratos) < 1) return response()->json('NA',404);
        return response()->json( $contratos, 200 );

    }
}
