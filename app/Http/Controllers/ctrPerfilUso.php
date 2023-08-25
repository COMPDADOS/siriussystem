<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlPerfilUso;
use App\mdlModulo;
use App\mdlDireitos;

use Auth;

class ctrPerfilUso extends Controller
{

    public function __construct()
    {
 
        $this->middleware('auth');
    }
        
 
    public function index()
    {
        return view( 'perfil.perfilindex');

    }
    public function carga()
    {

        $perfil = mdlPerfilUso::orderBy( 'IMB_ATP_DESCRICAO')->get();

        return response()->json(  $perfil,200);


    }

    public function salvar( Request $request)
    {

        $id = $request->IMB_ATP_ID;
        if( $id == '' )
            $per = new mdlPerfilUso;
        else
            $per = mdlPerfilUso::find( $id );
        
        $per->IMB_ATP_DESCRICAO = $request->IMB_ATP_DESCRICAO;
        $per->IMB_ATD_ID        = Auth::user()->IMB_ATD_ID;
        $per->save();

        if( $id == '' )
        {
            $mdls = mdlModulo::all();
            foreach ($mdls as $mdl) 
            {
                $novosdireitos = new mdlDireitos;
                $novosdireitos->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $novosdireitos->IMB_ATD_ID = 0;
                $novosdireitos->IMB_ATP_ID = $per->IMB_ATP_ID;
                $novosdireitos->IMB_MDL_ID = $mdl->IMB_MDL_ID;
                $novosdireitos->IMB_STM_ID = '1';
                $novosdireitos->IMB_DIRACE_INCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ALTERACAO='N';
                $novosdireitos->IMB_DIRACE_EXCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ACESSO='N';
                $novosdireitos->save();
            }
        }

        return response()->json(  $per->IMB_ATP_ID,200);

    }

    public function buscar( $id )
    {
        $per = mdlPerfilUso::find( $id );
        return response()->json( $per,200);

    }    

    public function apagar( $id )
    {
        $per = mdlPerfilUso::find( $id );
        if( $per->IMB_ATD_DTHINATIVO == null )
        {
            $per->IMB_ATD_DTHINATIVO = date('Y/m/d');
            $msg = "Inativado!";
        }
        else
        {
            $per->IMB_ATD_DTHINATIVO = null;
            $msg = "Reativado!";

        }
        $per->save();
        
        return response()->json( $msg,200);

    }        
}
