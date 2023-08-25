<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAtendimentoStatus;
use DB;
class ctrAtendimentoStatus extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
        
    
     public function lista( $empresa )
     {
        
        if( $empresa == '0')
        {
            $tabela = mdlAtendimentoStatus::select(
            [
                '*',
                DB::raw('( SELECT VIS_PRI_NOME 
                        FROM VIS_ATENDIMENTOPRIORIDADE 
                        WHERE VIS_ATENDIMENTOPRIORIDADE.VIS_PRI_ID =
                        VIS_ATENDIMENTOSTATUS.VIS_PRI_ID) AS VIS_PRI_NOME' )
            ])
            ->get();
        }
        else
        {
            $tabela = mdlAtendimentoStatus::select(
                [
                    '*',
                    DB::raw('( SELECT VIS_PRI_NOME 
                            FROM VIS_ATENDIMENTOPRIORIDADE 
                            WHERE VIS_ATENDIMENTOPRIORIDADE.VIS_PRI_ID =
                            VIS_ATENDIMENTOSTATUS.VIS_PRI_ID) AS VIS_PRI_NOME' )
                ])
                ->where( 'VIS_ATENDIMENTOSTATUS.IMB_IMB_ID','=', $empresa)
                ->get();
        }
     
        return $tabela->toJson();
    } 

     public function index()
    {
        //       $atendentes = mdlAtendente::select( 
        return view( 'statusatendimento/statusatendimento');
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
        $id = $request->input('VIS_ATS_ID');
        $t = new mdlAtendimentoStatus;
                                                      
        $t->VIS_ATS_NOME            = $request->input('VIS_ATS_NOME');
        //$t->VIS_PRI_ID              = $request->input('VIS_PRI_ID');
        $t->VIS_ATS_ESCALAANDAMENTO = $request->input('VIS_ATS_ESCALAANDAMENTO');
        $t->VIS_ATS_COLOR =           $request->input('VIS_ATS_COLOR');
        $t->IMB_IMB_ID =              $request->input('IMB_IMB_ID');
        $t->VIS_ATD_ID =              $request->input('IMB_ATD_ID');

        $t->save();
        

        return   redirect()->back();
    }
    
    public function show($id)
    {
        $tabela= mdlAtendimentoStatus::find( $id );
        return   $tabela->toJson();
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
        $tabela= mdlAtendimentoStatus::find( $id );
        $tabela->delete();
        return   redirect()->back();
    }
}
