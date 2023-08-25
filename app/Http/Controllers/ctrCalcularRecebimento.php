<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;
use App\mdlCalcularRecebimento;

class ctrCalcularRecebimento extends Controller
{
    public function __construct()
    
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IMB_CTR_ID         = request()->input('IMB_CTR_ID');
        $dDataVencimento    =  request()->input('dDataVencimento');
        $dDataPagamento     =  request()->input('dDataPagamento');

        $dDataPagamento = '2019-08-10';
        $dDataVencimento = '2019-08-10';
        
        $tabela = DB::select("CALL ProcCalcularRecebimento('$IMB_CTR_ID', '$dDataVencimento', '$dDataVencimento' )");  
        $tabela = DB::table('TBLRECEBER')
        ->select('*')
        ->get();
        
        return view( '/recebimento/recebimentocalculado', compact( 'tabela', 'IMB_CTR_ID', 'dDataPagamento', 'dDataPagamento' ) );

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
        //
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
        //
    }
}
