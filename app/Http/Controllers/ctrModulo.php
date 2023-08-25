<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlModulo;
use App\mdlDireitos;
use App\mdlPerfilUso;
use App\mdlAtendente;
use Auth;

class ctrModulo extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
        
        
    
    public function countRecords( $busca )
    {

        if( $busca == 'TODOSTODOSTODOS') $busca='';

        $busca="%$busca%";


        if( $busca == '%%' ) {
            $lf = mdlModulo::orderBy( 'IMB_MDL_DESCRICAO')
            ->get()->count();
        }
        else
        {
            $lf = mdlModulo::where( 'IMB_MDL_DESCRICAO','LIKE', $busca)
            ->orderBy( 'IMB_MDL_DESCRICAO')
            ->get()->count();

        }


        return $lf;
    }


    public function list(  $page, $busca)
    {
        $start_from = ($page - 1) * 15;        
        
        if( $busca == 'TODOSTODOSTODOS') $busca='';

        $busca="%$busca%";


        if( $busca == '%%' ) {
            $lf = mdlModulo::orderBy( 'IMB_MDL_DESCRICAO')
            ->get();
        }
        else
        {
            $lf = mdlModulo::where( 'IMB_MDL_DESCRICAO','LIKE', $busca)
            ->orderBy( 'IMB_MDL_DESCRICAO')
            ->get();

        }
        return $lf;

    }

     public function index()
    {
        return view('modulo.moduloindex');
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

    public function carga($idmaster)
    {

        if ( $idmaster == '0' )
        {
            $mdl = mdlModulo::select('*')
            ->orderBy('IMB_MDL_DESCRICAO')
            ->get();
        }
        else
         {
            $mdl = mdlModulo::select('*')
            ->where('IMB_MDL_IDPAI',$idmaster)
            ->orderBy('IMB_MDL_DESCRICAO')
            ->get();
            # code...
        }

        return $mdl;

        //
    }

    public function novo()
    {
        return view('modulo.modulonew');
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


        

        $mdl = new mdlModulo;
        $mdl->IMB_MDL_DESCRICAO = $request->INPUT( 'IMB_MDL_DESCRICAO');
        $mdl->IMB_MOD_CFG = $request->INPUT( 'IMB_MOD_CFG');
        $mdl->IMB_MOD_CRM= $request->INPUT( 'IMB_MOD_CRM');
        $mdl->IMB_MOD_FIN = $request->INPUT( 'IMB_MOD_FIN');
        $mdl->IMB_MOD_ADM= $request->INPUT( 'IMB_MOD_ADM');
        if( $request->INPUT( 'IMB_MDL_IDPAI') > 0 ) 
            $mdl->IMB_MDL_IDPAI = $request->INPUT( 'IMB_MDL_IDPAI');
        $mdl->IMB_STM_ID = 1;
        $mdl->save() ;

        $id=$mdl->IMB_MDL_ID;

            $atds = mdlPerfilUso::all();
            foreach ($atds as $atd) 
            {
                $novosdireitos = new mdlDireitos;
                $novosdireitos->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $novosdireitos->IMB_ATD_ID = 0;
                $novosdireitos->IMB_ATP_ID = $atd->IMB_ATP_ID;
                $novosdireitos->IMB_MDL_ID = $id;
                $novosdireitos->IMB_STM_ID = '1';
                $novosdireitos->IMB_DIRACE_INCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ALTERACAO='N';
                $novosdireitos->IMB_DIRACE_EXCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ACESSO='N';
                $novosdireitos->save();
            }
                
            return response()->json('ok',200);
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
        $mdl =  mdlModulo::find( $id);
        return $mdl;
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
        return view( 'modulo.moduloedit', compact( 'id' ) );
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
        $id = $request->input('IMB_MDL_ID');
        $mdl =  mdlModulo::find( $id );
        $mdl->IMB_MDL_DESCRICAO = $request->input( 'IMB_MDL_DESCRICAO');
        $mdl->IMB_MOD_CFG = $request->INPUT( 'IMB_MOD_CFG');
        $mdl->IMB_MOD_CRM= $request->INPUT( 'IMB_MOD_CRM');
        $mdl->IMB_MOD_FIN = $request->INPUT( 'IMB_MOD_FIN');
        $mdl->IMB_MOD_ADM= $request->INPUT( 'IMB_MOD_ADM');

        if( $request->input( 'IMB_MDL_IDPAI') <> null )
            $mdl->IMB_MDL_IDPAI = $request->input( 'IMB_MDL_IDPAI');
        //

        if ( $mdl->save() )
            return response()->json('OK', 200);

        return response()->json('ERRO NA GRAVAÇÃO', 404);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mdl = mdlModulo::find( $id );
        if ( $mdl )
        {
            $dir = mdlDireitos::where( "IMB_MDL_ID","=", $id)->delete();
            $mdl->delete();
            return response()->json('ok', 200);
        }

        return response()->json('erro',404);
        //
    }


}
