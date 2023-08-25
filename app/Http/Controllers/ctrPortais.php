<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlPortais;
use DataTables;
use DB;
use Auth;

class ctrPortais extends Controller
{


    public function list(Request $request)
        {
            $portais = mdlPortais::select(
                [
                    '*',
                    DB::raw("( SELECT QTIMOVEISPORTAL( $id  ) ) AS QUANTIDADE")
                ]
                );

            if( $request->empresamaster <> '0' )
                $portais->where( 'VIS_PORTAIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID);

            $cFiltrou = 'N';

            /*if ($request->has('id') && strlen(trim($request->id)) > 0){
                $cFiltrou = 'S';
                $portais->where('IMB_POR_ID', $request->id);
            }

            if ($request->has('nome') && strlen(trim($request->nome)) > 0){
                $cFiltrou = 'S';
                $portais->whereRaw("IMB_POR_NOME LIKE '%{$request->nome}%'");
            }
            if ( $cFiltrou == 'N') {
                $portais->limit(0);
            }
*/
            return DataTables::of($portais)->make(true);
            //return $portais;
        }        //
        


        public function index()
        {
            return view( 'portais.portaisindex');
        }
    
    public function carga( $empresa)
    {
        $portais = mdlPortais::select(
            [ 
                '*',
                DB::raw("( SELECT QTIMOVEISPORTAL( IMB_POR_ID  ) ) AS QUANTIDADE"),

            ]
        )->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
                               ->orderBy( 'IMB_POR_NOME', 'ASC')
                               ->get();

        return $portais;
    }


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
        $portais = new mdlPortais;
        //$portais->IMB_POR_ID = $request->IMB_POR_ID;
        $portais->IMB_IMB_ID = $request->IMB_IMB_ID;
        $portais->IMB_POR_NOME = $request->IMB_POR_NOME;
        $portais->IMB_POR_TITULO = $request->IMB_POR_TITULO;
        $portais->IMB_POR_TIPOMIDIA = $request->IMB_POR_TIPOMIDIA;
        $portais->IMB_POR_DESCRICAO = $request->IMB_POR_DESCRICAO;
        $portais->IMB_POR_LOGIN = $request->IMB_POR_LOGIN;
        $portais->IMB_POR_SENHA = $request->IMB_POR_SENHA;
        $portais->IMB_POR_FORMAENVIO = $request->IMB_POR_FORMAENVIO;
        $portais->IMB_POR_ENDERECOCOMPLETO = $request->IMB_POR_ENDERECOCOMPLETO;
        $portais->IMB_POR_MARCADAGUA = $request->IMB_POR_MARCADAGUA;
        $portais->IMB_POR_LINKENDPOINT = $request->IMB_POR_LINKENDPOINT;
        $portais->IMB_POR_LINKENDPOINT = $request->IMB_POR_LINKENDPOINT;
        $portais->IMB_ATD_ID = $request->IMB_ATD_ID;
        //$portais->IMB_POR_DTHATIVO = date( 'Y-m-d');
        $portais->save();

        return response()->json('OK', 200);
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portais = mdlPortais::find( $id );

        return $portais;
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
    public function update(Request $request)
    {
        $id = $request->IMB_POR_ID;

        //dd( $id );

        $portais = mdlPortais::find( $id );
        
        //$portais->IMB_POR_ID = $request->IMB_POR_ID;
        $portais->IMB_IMB_ID = $request->IMB_IMB_ID;
        $portais->IMB_POR_NOME = $request->IMB_POR_NOME;
        $portais->IMB_POR_TITULO = $request->IMB_POR_TITULO;
        $portais->IMB_POR_TIPOMIDIA = $request->IMB_POR_TIPOMIDIA;
        $portais->IMB_POR_DESCRICAO = $request->IMB_POR_DESCRICAO;
        $portais->IMB_POR_LOGIN = $request->IMB_POR_LOGIN;
        $portais->IMB_POR_SENHA = $request->IMB_POR_SENHA;
        $portais->IMB_POR_FORMAENVIO = $request->IMB_POR_FORMAENVIO;
        $portais->IMB_POR_ENDERECOCOMPLETO = $request->IMB_POR_ENDERECOCOMPLETO;
        $portais->IMB_POR_MARCADAGUA = $request->IMB_POR_MARCADAGUA;
        $portais->IMB_POR_LINKENDPOINT = $request->IMB_POR_LINKENDPOINT;
        $portais->IMB_ATD_ID = $request->IMB_ATD_ID;
        //$portais->IMB_POR_DTHATIVO = date( 'Y-m-d');
        $portais->save();

        return response()->json('OK', 200);
                
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
        
        $portais = mdlPortais::find( $id );
        $portais->IMB_POR_DTHINATIVO = date('Y/m/d H:i:s');
        $portais->save();

        return response()->json('OK', 200);

        //
    }

    public function quantidadeImoveis( $id )
    {
        $imoveis = mdlPortais::select(
            [
                DB::raw("( SELECT QTIMOVEISPORTAL( $id  ) ) AS QUANTIDADE"),
            ]
        )->first();

        return response()->json( $imoveis->QUANTIDADE,200);
    }

    
}
