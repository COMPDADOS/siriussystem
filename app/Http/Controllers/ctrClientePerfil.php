<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlClientePerfil;
use Auth;

class ctrClientePerfil extends Controller
{
    public function carga( $id )
    {
        $perfil = mdlClientePerfil::select('*')
        ->where( "IMB_CLT_ID",'=',$id)
        ->leftJoin( 'IMB_TIPOIMOVEL','IMB_TIPOIMOVEL.IMB_TIM_ID', 'IMB_CLIENTEPERFIL.IMB_TIM_ID')
        ->orderBy( 'IMB_CLP_DATACADASTRO','ASC')
        ->get();

        return $perfil;
        
    }

    public function gravar( Request $request )
    {

            $regiao = explode(",",$request->REGIAO);


            $IMB_CLP_VALVENINI = $request->IMB_CLP_VALVENINI;
            if( $IMB_CLP_VALVENINI == '') 
                $IMB_CLP_VALVENINI="0";

            $IMB_CLP_VALVENFIM = $request->IMB_CLP_VALVENFIM;
            if( $IMB_CLP_VALVENFIM == '') 
                $IMB_CLP_VALVENFIM="0";

            $IMB_CLP_VALLOCINI = $request->IMB_CLP_VALLOCINI;
            if( $IMB_CLP_VALLOCINI == '') 
                $IMB_CLP_VALLOCINI="0";

            $IMB_CLP_VALLOCFIM = $request->IMB_CLP_VALLOCFIM;
            if( $IMB_CLP_VALLOCFIM == '') 
                $IMB_CLP_VALLOCFIM="0";

            $IMB_TIM_ID = $request->IMB_TIM_ID;
            if( $IMB_TIM_ID == '') 
                $IMB_TIM_ID="0";

            $IMB_IMV_DORQUA = $request->IMB_IMV_DORQUA;
            if( $IMB_IMV_DORQUA == '') 
                $IMB_IMV_DORQUA="0";

            $IMB_IMV_GARAGEM = $request->IMB_IMV_GARAGEM;
            if( $IMB_IMV_GARAGEM == '') 
                $IMB_IMV_GARAGEM="0";

            $IMB_IMV_SUIQUA = $request->IMB_IMV_SUIQUA;
            if( $IMB_IMV_SUIQUA == '') 
                $IMB_IMV_SUIQUA="0";

            $IMB_IMV_AREUTI = $request->IMB_IMV_AREUTI;
            if( $IMB_IMV_AREUTI == '') 
                $IMB_IMV_AREUTI="0";

            $IMB_CLP_AREACONSTRUIDA = $request->IMB_CLP_AREACONSTRUIDA ;
            if( $IMB_CLP_AREACONSTRUIDA == '') 
                $IMB_CLP_AREACONSTRUIDA="0";

            $IMB_CLP_AREATOTAL = $request->IMB_CLP_AREATOTAL;
            if( $IMB_CLP_AREATOTAL == '') 
                $IMB_CLP_AREATOTAL="0";

        $perfil = new mdlClientePerfil;

        $perfil->IMB_CLT_ID = $request->IMB_CLT_ID;
        $perfil->IMB_CLP_DATACADASTRO = date('Y/m/d');
        $perfil->IMB_CLP_VALVENINI = $IMB_CLP_VALVENINI;
        $perfil->IMB_CLP_VALVENFIM = $IMB_CLP_VALVENFIM;
        $perfil->IMB_CLP_VALLOCINI = $IMB_CLP_VALLOCINI;
        $perfil->IMB_CLP_VALLOCFIM = $IMB_CLP_VALLOCFIM;
        $perfil->IMB_TIM_ID = $IMB_TIM_ID;
        $perfil->IMB_IMV_FINALIDADE = $request->IMB_IMV_FINALIDADE;
        $perfil->IMB_CLP_CIDADE = $regiao[0];
        $perfil->IMB_CLP_BAIRRO = $regiao[1];
        $perfil->IMB_IMV_DORQUA = $IMB_IMV_DORQUA;
        $perfil->IMB_IMV_GARAGEM = $IMB_IMV_GARAGEM;
        $perfil->IMB_IMV_SUIQUA = $IMB_IMV_SUIQUA;
        $perfil->IMB_IMV_AREUTI = $IMB_IMV_AREUTI;
        $perfil->IMB_CLP_AREACONSTRUIDA = $IMB_CLP_AREACONSTRUIDA;
        $perfil->IMB_CLP_AREATOTAL = $IMB_CLP_AREATOTAL;
        $perfil->IMB_IMV_EMCONDOMINIO = substr($request->IMB_IMV_EMCONDOMINIO,0,1);
        $perfil->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $perfil->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $perfil->save();
        
        return response()->json( 'ok',200);
    }

}
