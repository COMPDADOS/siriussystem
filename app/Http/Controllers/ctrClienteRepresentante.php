<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlClienteRepresentante;

class ctrClienteRepresentante extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
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
           
        $t = new mdlClienteRepresentante();
        $t->IMB_CLT_IDMASTER    = $request->input('IMB_CLT_IDMASTER');
        $t->IMB_CLT_ID          = $request->input('IMB_CLT_ID');
        $t->save();

        return   redirect()->back();
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
    public function destroy( $id)
    {
        
        $tabela= mdlClienteRepresentante::find( $id );
        $tabela->delete();
        return   redirect()->back();
    }

    public function indexJson( $id )
    {
        $imagens = mdlClienteRepresentante::Select( 
            [ 
                'IMB_CLIENTEREPRESENTANTE.IMB_CLT_ID',
                'IMB_CLT_IDMASTER',
                'IMB_CLT_NOME',
                'IMB_CLR_ID'
            ]
        )
        ->leftjoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEREPRESENTANTE.IMB_CLT_ID')
        ->where( 'IMB_CLT_IDMASTER', $id )
        ->get();

        return $imagens->toJson();
        //
    }
}    

