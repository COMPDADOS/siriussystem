<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlClienteUsuario;
use App\mdlClienteNotificacoes;
use Auth;
use DB;

class ctrClienteUsuario extends Controller
{
    public function corretorCliente( $id )
    {
        $corretor = mdlClienteUsuario::select(
            [
                'IMB_CLIENTEUSUARIO.IMB_ATD_ID',
                'IMB_ATD_NOME',
                'IMB_CLU_DTHCADASTRO',
                'IMB_CLU_DTHATUALIZACAO',
                'IMB_CLU_TIPO',
                'IMB_CLU_ID',
                DB::raw( 'CONCAT("(",IMB_ATD_DDD1,")",IMB_ATD_TELEFONE_1) AS IMB_ATD_TELEFONE_1 '),
                DB::raw( 'CONCAT("(",IMB_ATD_DDD2,")",IMB_ATD_TELEFONE_2) AS IMB_ATD_TELEFONE_2 '),
                DB::raw('( select MAX(IMB_CLA_DATACADASTRO) FROM IMB_CLIENTEATENDIMENTO 
                WHERE IMB_CLIENTEATENDIMENTO.IMB_CLT_ID = IMB_CLIENTEUSUARIO.IMB_CLT_ID
                AND IMB_CLIENTEATENDIMENTO.IMB_ATD_ID = IMB_CLIENTEUSUARIO.IMB_ATD_ID) AS ULTIMOATENDIMENTOPELOCORRETOR'),
                DB::raw('( select MAX(IMB_CLA_DATACADASTRO) FROM IMB_CLIENTEATENDIMENTO 
                WHERE IMB_CLIENTEATENDIMENTO.IMB_CLT_ID = IMB_CLIENTEUSUARIO.IMB_CLT_ID
                AND IMB_CLIENTEATENDIMENTO.IMB_ATD_ID <> IMB_CLIENTEUSUARIO.IMB_ATD_ID) AS ULTIMOATENDIMENTOPOROUTROCORRETOR'),

            ]
        )
        ->where( 'IMB_CLIENTEUSUARIO.IMB_CLT_ID','=', $id)
        ->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID','IMB_CLIENTEUSUARIO.IMB_ATD_ID')
        ->orderBy( 'IMB_CLU_DTHCADASTRO','DESC')
        ->get();

        return $corretor;

    }


    public function novo(  Request $request )
    {

        if( $request->SUBSTITUIR == 'S' )
        {
            $cli = mdlClienteUsuario::where( 'IMB_CLT_ID','=',$request->IMB_CLT_ID )
            ->where( 'IMB_CLU_TIPO','=', $request->SUBSTITUIRQUAL )
            ->delete();
        }


        $cli = new mdlClienteUsuario;
        $cli->IMB_ATD_ID = $request->IMB_ATD_ID;
        $cli->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $cli->IMB_CLT_ID = $request->IMB_CLT_ID;
        $cli->IMB_CLU_TIPO = $request->IMB_CLU_TIPO;
        $cli->IMB_CLU_DTHCADASTRO = date( 'Y/m/d');
        $cli->IMB_CLU_DTHATUALIZACAO = date( 'Y/m/d');
        $cli->save();

        $nt = new mdlClienteNotificacoes;
        $nt->IMB_CLT_ID = $cli->IMB_CLT_ID;
        $nt->IMB_ATD_IDCADASTRO =  Auth::user()->IMB_ATD_ID;
        $nt->IMB_ATD_ID =  $request->IMB_ATD_ID;
        $nt->IMB_IMB_ID =Auth::user()->IMB_IMB_ID;
        $nt->IMB_IMN_TIPOENTRADA = '';
        $nt->save();

        return response()->json('ok',200);

    }

    public function deletar(  Request $request )
    {
        $id = $request->IMB_CLU_ID;

        $cli = mdlClienteUsuario::find( $id );
        $cli->delete();
        return response()->json( 'ok',200);

    }


    public function totalMeusClientes()
    {
        $clientes = DB::table('IMB_CLIENTEUSUARIO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->count();

        return $clientes;

    }

    public function meusInteressados()
    {
        $clientes = DB::table('IMB_CLIENTEUSUARIO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->whereRaw('exists( SELECT IMB_CLA_ID  
                     FROM IMB_CLIENTEATENDIMENTO where IMB_CLIENTEUSUARIO.IMB_CLT_ID = IMB_CLIENTEATENDIMENTO.IMB_CLT_ID)')
        ->count();

        return $clientes;

    }

    public function meusProprietarios()
    {
        $clientes = DB::table('IMB_CLIENTEUSUARIO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->whereRaw('exists( SELECT IMB_PPI_ID
                     FROM IMB_PROPRIETARIOIMOVEL where IMB_CLIENTEUSUARIO.IMB_CLT_ID = IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID)')
        ->count();

        return $clientes;

    }

    public function interessadosDemaisCorretores()
    {
        $clientes = DB::table('IMB_CLIENTEUSUARIO')
        ->where( 'IMB_ATD_ID','<>', Auth::user()->IMB_ATD_ID)
        ->whereRaw('exists( SELECT IMB_CLA_ID  
                     FROM IMB_CLIENTEATENDIMENTO where IMB_CLIENTEUSUARIO.IMB_CLT_ID = IMB_CLIENTEATENDIMENTO.IMB_CLT_ID)')
        ->count();

        return $clientes;

    }

    public function proprietariosDemaisCorretores()
    {
        $clientes = DB::table('IMB_CLIENTEUSUARIO')
        ->where( 'IMB_ATD_ID','<>', Auth::user()->IMB_ATD_ID)
        ->whereRaw('exists( SELECT IMB_PPI_ID
                     FROM IMB_PROPRIETARIOIMOVEL where IMB_CLIENTEUSUARIO.IMB_CLT_ID = IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID)')
        ->count();

        return $clientes;

    }


    

        

        

}
