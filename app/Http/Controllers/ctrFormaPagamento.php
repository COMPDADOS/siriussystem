<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlFormaPagamento;
use App\mdlRamoAtividade;
use Auth;

class ctrFormaPagamento extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
            $forma= mdlFormaPagamento::select('*')
            ->where( 'IMB_FORPAG_NOME', '<>', '' )
            ->get();
            return $forma->toJson();
    }

    public function create()
    {
        return view( 'formapagamento/formapagamentonova');
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
        $forpag = new mdlFormaPagamento();
        $forpag->IMB_FORPAG_NOME = $request->input('IMB_FORPAG_NOME');
        $forpag->IMB_IMB_ID =  Auth::user()->IMB_IMB_ID;
        $forpag->save();

        return json_encode( $forpag );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forma= mdlFormaPagamento::find( $id );
        if( isset( $forma ))
            return json_encode( $forma );

        return response('Não Encontrado', 404);
        //
        //
    }

    public function vereapagar($id)
    {

        $forma= mdlFormaPagamento::find( $id );
        return view( 'formapagamento/formapagamentovereapagar', compact('forma') ) ;
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
        $forma= mdlFormaPagamento::find( $id);
        if( isset( $forma )){
            
            return view( 'formapagamento/formapagamentoeditar', compact( 'forma') ) ;
        }
        return redirect('formapagamento/formapagamento');
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
        $forma= mdlFormaPagamento::find( $id );
        if( isset( $forma )){
            $forma->IMB_FORPAG_NOME = $request->input('IMB_FORPAG_NOME');
            $forma->save();
            return json_encode( $forma );

        }
       
        return response('Não Encontrado', 404);
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
        $forma= mdlFormaPagamento::find( $id );
        if( isset( $forma ) ){
            
           $forma->delete();
           return response( 'OK', 200 );
        }
        return response('Não Encontrado', 404);
        //
    }
    public function indexView()
        {
            return view( 'formapagamento/formapagamento') ;        
        }

        public function carga()
        {
            $forma = mdlFormaPagamento::
                where( 'IMB_IMB_ID','=',  Auth::user()->IMB_IMB_ID )
                ->get();
            return $forma;
        }
        public function pegarForma( $id )
        {
            $forma = mdlFormaPagamento::find( $id );
            if( $forma )
                return $forma->IMB_FORPAG_NOME;
            else
                return "não informado";
        }
        public function formaehcontacorrente( $id )
        {
            $forma = mdlFormaPagamento::find( $id );
            if( $forma )
                return $forma->IMB_FORPAG_CONTACORRENTE;
            else
                return "";
        }



        
        
}
