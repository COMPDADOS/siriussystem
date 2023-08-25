<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlEquipe;
use App\mdlEquipeNegocio;
use App\mdlNegocio;
use App\mdlAtendente;
use App\mdlEquipeMembro;
use App\mdlBairro;
use Auth;
use DB;
use Log;
class ctrEquipe extends Controller
{

    public function __construct()
    
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view( 'equipe.equipe' );
    }

    public function carga( )
    {
            $tabela= mdlEquipe::orderBy('IMB_EQP_DESCRICAO')->get(); 
       
        return $tabela;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function salvar(Request $request)
    {
        $id = $request->input('id');
        $atua = $request->atuacao;
        $membros = $request->membros;
        if( $id == '' )
            $t = new mdlEquipe;
        else
            $t = mdlEquipe::find( $id );

        $t->IMB_EQP_DESCRICAO = $request->input('IMB_EQP_DESCRICAO');
        $t->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $t->IMB_EQP_DTHATIVO = date( 'Y/m/d H:i');
        $t->save();

        if( $atua <> null )
        {
            $eqn = mdlEquipeNegocio::where( 'IMB_EQP_ID','=', $id )->delete();

            for ($i = 0; $i < count($atua); $i++) 
            {
                $eqn = new mdlEquipeNegocio;
                $eqn->IMB_NEG_ID = $atua[ $i ];
                $eqn->IMB_EQP_ID = $t->IMB_EQP_ID;
                $eqn->save();
            }
        }

        //dd( $membros );
        if( $membros <> null )
        {
            $eqm = mdlEquipeMembro::where( 'IMB_EQP_ID','=', $id )->delete();
            foreach ( $membros as $membro)
            {
                $eqn = new mdlEquipeMembro;
                $eqn->IMB_EQP_ID = $t->IMB_EQP_ID;
                $eqn->IMB_ATD_ID = $membro["IMB_ATD_ID"];
                $eqn->IMB_EPM_GERENTE = $membro["IMB_EPM_GERENTE"];
                $eqn->IMB_EPM_LIDER = $membro["IMB_EPM_LIDER"];
                $eqn->save();
            }
        }

        return response()->json( 'ok', 200);

    }

    public function destroy($id)
    {
//        $im = mdlImovel::where( 'IMB_TIM_ID','=', $id )->get();
            $t= mdlEquipe::find( $id );
            if( $t->IMB_EQP_DTHINATIVO <> ''  )
                $t->IMB_EQP_DTHINATIVO = null;
            else
                $t->IMB_EQP_DTHINATIVO = date('Y/m/d');
            $t->save();
            return response()->json( 'OK',200 );
    }

    

    public function buscar( $id )
    {
        $tabela= mdlEquipe::find( $id);
        return $tabela;
      
    }

    public function equipeNegocio( $id)
    {
        if( $id == '') $id = 9999999;
            $negs = mdlNegocio::select(
            [
                'IMB_NEG_ID',
                'IMB_NEG_DESCRICAO',
                DB::raw( "case when exists( select IMB_EQP_ID FROM IMB_EQUIPENEGOCIO 
                        WHERE IMB_EQUIPENEGOCIO.IMB_NEG_ID = IMB_NEGOCIO.IMB_NEG_ID
                        AND  IMB_EQUIPENEGOCIO.IMB_EQP_ID = $id ) then 'selected' 
                        END as selection")
            ]
        )->
        whereNull( 'IMB_NEG_DTHINATIVO')->orderBy( 'IMB_NEG_DESCRICAO')->get();
        

        return  $negs;
    }



    public function membrosEquipe( $id)
    {
        if( $id == '') $id = 9999999;
            $negs = mdlAtendente::select(
            [
                'IMB_ATD_ID',
                'IMB_ATD_NOME', 
	            DB::raw("COALESCE( (select IMB_EPM_ID FROM IMB_EQUIPEMEMBROS
                        WHERE IMB_EQUIPEMEMBROS.IMB_ATD_ID = IMB_ATENDENTE.IMB_ATD_ID
                        AND  IMB_EQUIPEMEMBROS.IMB_EQP_ID = $id limit 1),'') as IMB_EPM_ID") , 
	            DB::raw("COALESCE( (select IMB_EPM_LIDER FROM IMB_EQUIPEMEMBROS
                        WHERE IMB_EQUIPEMEMBROS.IMB_ATD_ID = IMB_ATENDENTE.IMB_ATD_ID
                        AND  IMB_EQUIPEMEMBROS.IMB_EQP_ID = $id limit 1),'') as IMB_EPM_LIDER") , 
                DB::raw( "COALESCE( (select IMB_EPM_ID FROM IMB_EQUIPEMEMBROS
                        WHERE IMB_EQUIPEMEMBROS.IMB_ATD_ID = IMB_ATENDENTE.IMB_ATD_ID
                        AND  IMB_EQUIPEMEMBROS.IMB_EQP_ID = $id limit 1),'') as IMB_EPM_ID") , 
                DB::raw("COALESCE( (select IMB_EPM_GERENTE FROM IMB_EQUIPEMEMBROS
                        WHERE IMB_EQUIPEMEMBROS.IMB_ATD_ID = IMB_ATENDENTE.IMB_ATD_ID
                        AND  IMB_EQUIPEMEMBROS.IMB_EQP_ID = $id limit 1),'') as IMB_EPM_GERENTE") , 
                DB::raw("case 
		            when exists( select IMB_EPM_ID FROM IMB_EQUIPEMEMBROS
                        WHERE IMB_EQUIPEMEMBROS.IMB_ATD_ID = IMB_ATENDENTE.IMB_ATD_ID
                        AND  IMB_EQUIPEMEMBROS.IMB_EQP_ID = $id limit 1) then 'selected' ELSE ''
                    END as selection ")
            ]
        )
        ->where( 'IMB_ATD_ATIVO','=','A')
        ->orderBy( 'IMB_ATD_NOME');

        $negs = $negs->get();

        return  $negs;
    }

    public function membroGerenteEquipe( $idequipe, $idmembro, $gerente)
    {

        $eqm = mdlEquipeMembro::where( 'IMB_EQP_ID','=', $idequipe )
        ->where('IMB_ATD_ID','=', $idmembro )->firsts();

        if( $gerente == 'S') $eqm->IMB_EPM_GERENTE = 'N';
        if( $gerente == 'N') $eqm->IMB_EPM_GERENTE = 'S';
        $eqm->save();
        return response()-json('ok',200);


    }



    





}
