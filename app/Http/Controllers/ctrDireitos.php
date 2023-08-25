<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlDireitos;
use App\mdlModulo;
use App\mdlAtendente;
use DB;
use Auth;

class ctrDireitos extends Controller
{
    
    public function __construct()
    {

        $this->middleware('auth');
    }
        
    
    public function index( $id )
    {
        return view( 'direito.direitoindex', compact('id'));

    }



    public function carga( $perfil, $busca )
    {

        if( $busca == 'TODOSTODOSTODOS') $busca='';

        $busca="%$busca%";

        if( $busca == '%%' ) 
        {
   
            $direitos = mdlDireitos::select(
                [
                    'IMB_ATD_ID',
                    'IMB_DIRACE_INCLUSAO',
                    'IMB_DIRACE_ALTERACAO',
                    'IMB_DIRACE_EXCLUSAO',
                    'IMB_DIRACE_ACESSO',
                    'IMB_DIRACE_ID',
                    'IMB_DIREITOACESSO.IMB_MDL_ID',
                    DB::raw('IMB_MODULO.IMB_MDL_DESCRICAO AS IMB_MDL_DESCRICAO')
                ]
            )
            ->where( 'IMB_ATP_ID','=', $perfil )
            ->leftJoin('IMB_MODULO', 'IMB_MODULO.IMB_MDL_ID', 'IMB_DIREITOACESSO.IMB_MDL_ID')
            ->orderBy( 'IMB_MDL_DESCRICAO')
            ->get();
        }
        else
        {
            $direitos = mdlDireitos::select(
                [
                    'IMB_ATD_ID',
                    'IMB_DIRACE_INCLUSAO',
                    'IMB_DIRACE_ALTERACAO',
                    'IMB_DIRACE_EXCLUSAO',
                    'IMB_DIRACE_ACESSO',
                    'IMB_DIRACE_ID',
                    'IMB_DIREITOACESSO.IMB_MDL_ID',
                    DB::raw('IMB_MODULO.IMB_MDL_DESCRICAO AS IMB_MDL_DESCRICAO')
                ]
            )
            ->where( 'IMB_ATP_ID','=', $perfil )
            ->where( 'IMB_MDL_DESCRICAO','LIKE', $busca)
            ->leftJoin('IMB_MODULO', 'IMB_MODULO.IMB_MDL_ID', 'IMB_DIREITOACESSO.IMB_MDL_ID')
            ->orderBy( 'IMB_MDL_DESCRICAO')
            ->get();
        }

        return $direitos;


    }

    public function gerar( $funcionarioorigem, $funcionariodestino )
    {


        $deletado = mdlDireitos::where( 'IMB_ATP_ID','=', $funcionariodestino )->delete();
        
        $atd = mdlAtendente::find( $funcionarioorigem );

        $empresaorigem = $atd[ 'IMB_IMB_ID'];

        $modulos = mdlModulo::all();

        $direitos = mdlDireitos::where( 'IMB_ATP_ID','=', $funcionarioorigem )
        ->get();

        if ( $direitos == '[]' ) 
        {

            foreach ($modulos as $value) 
            {

                $novosdireitos = new mdlDireitos;

                $novosdireitos->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                $novosdireitos->IMB_ATD_ID = 0;
                $novosdireitos->IMB_ATP_ID = $funcionariodestino;
                $novosdireitos->IMB_MDL_ID = $value->IMB_MDL_ID;
                $novosdireitos->IMB_STM_ID = '1';
                $novosdireitos->IMB_DIRACE_INCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ALTERACAO='N';
                $novosdireitos->IMB_DIRACE_EXCLUSAO='N';
                $novosdireitos->IMB_DIRACE_ACESSO='N';
                $novosdireitos->save();
            }
        }
        else
        {

            foreach ($direitos as $value) 
            {

                $novosdireitos = new mdlDireitos;

                $novosdireitos->IMB_IMB_ID = Auth::user()->IMB_ATD_ID;
                $novosdireitos->IMB_ATD_ID = 0;
                $novosdireitos->IMB_ATP_ID = $funcionariodestino;
                $novosdireitos->IMB_MDL_ID = $value->IMB_MDL_ID;
                $novosdireitos->IMB_STM_ID = '1';
                $novosdireitos->IMB_DIRACE_INCLUSAO=$value->IMB_DIRACE_INCLUSAO;
                $novosdireitos->IMB_DIRACE_ALTERACAO=$value->IMB_DIRACE_ALTERACAO;
                $novosdireitos->IMB_DIRACE_EXCLUSAO=$value->IMB_DIRACE_EXCLUSAO;
                $novosdireitos->IMB_DIRACE_ACESSO=$value->IMB_DIRACE_ACESSO;
                $novosdireitos->save();
            }

        }

        $direitos = mdlDireitos::where( 'IMB_ATD_ID','=', $funcionarioorigem )
        ->get();
        return $direitos;

    }

    public function permitir( $id, $item )
    {

        $direitos = mdlDireitos::find( $id );

        if( $item == 1 ) 
        {
            $direitos->IMB_DIRACE_ACESSO =  'S';
        }

        if( $item == 2 ) 
        {
            $direitos->IMB_DIRACE_INCLUSAO =  'S';
        }

        if( $item == 3 ) 
        {
            $direitos->IMB_DIRACE_ALTERACAO =  'S';
        }

        if( $item == 4 ) 
        {
            $direitos->IMB_DIRACE_EXCLUSAO=  'S';
        }

        $direitos->save();

        return response()->json('OK', 200);

    }

    public function negar( $id, $item )
    {

        $direitos = mdlDireitos::find( $id );

        if( $item == 1 ) 
        {
            $direitos->IMB_DIRACE_ACESSO =  'N';
        }
        if( $item == 2 ) 
        {
            $direitos->IMB_DIRACE_INCLUSAO =  'N';
        }

        if( $item == 3 ) 
        {
            $direitos->IMB_DIRACE_ALTERACAO =  'N';
        }

        if( $item == 4 ) 
        {
            $direitos->IMB_DIRACE_EXCLUSAO=  'N';
        }

        $direitos->save();

        return response()->json('OK', 200);
    }

    public function checar( $funcionario, $modulo, $opcao )
    {

        $atd = mdlAtendente::find( $funcionario );
        if( $atd )
        {
            $direitos = mdlDireitos::where( 'IMB_ATP_ID','=', $atd->IMB_ATP_ID )
            ->where( 'IMB_MDL_ID','=', $modulo)
            ->get();

            if ( ! $direitos  ) return  response()->json( 'N',404);
            if( $opcao == 1 ) return response()->json(  $direitos[0]->IMB_DIRACE_ACESSO,200);
            if( $opcao == 2 ) return  response()->json( $direitos[0]->IMB_DIRACE_INCLUSAO,200);
            if( $opcao == 3 ) return response()->json(  $direitos[0]->IMB_DIRACE_ALTERACAO,200);
            if( $opcao == 4 ) return  response()->json( $direitos[0]->IMB_DIRACE_EXCLUSAO,200);
        }

        return response()->json( 'N' , 200);
    }

    public function checarDireitoPHP( $funcionario, $modulo, $opcao )
    {

        $atd = mdlAtendente::find( $funcionario );
        if( $atd )
        {
            $direitos = mdlDireitos::where( 'IMB_ATP_ID','=', $atd->IMB_ATP_ID )
            ->where( 'IMB_MDL_ID','=', $modulo)
            ->get();

            if ( ! $direitos  ) return  'N';
            if( $opcao == 1 ) return $direitos[0]->IMB_DIRACE_ACESSO;
            if( $opcao == 2 ) return $direitos[0]->IMB_DIRACE_INCLUSAO;
            if( $opcao == 3 ) return  $direitos[0]->IMB_DIRACE_ALTERACAO;
            if( $opcao == 4 ) return $direitos[0]->IMB_DIRACE_EXCLUSAO;
        }

        return 'N';
    }



}
