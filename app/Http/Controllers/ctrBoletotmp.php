<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlBoletoitemtmp;
use App\mdlBoletotmp;
use App\mdlLancamentoFuturo;
use App\mdlEvento;

class ctrBoletotmp extends Controller
{

     public function __construct()
     {

         $this->middleware('auth');
     }


     public function zerarTmp( $id )
   {

    $res=mdlBoletotmp::where('IMB_ATD_ID',$id)->delete();
    $res=mdlBoletoitemtmp::where('IMB_ATD_ID',$id)->delete();

   }

   public function gerarLf(Request $request)
   {

        $lfs = $request->input('lf');
        $nidatd =  $request->input('IMB_ATD_ID');
        //return response( $nidatd, 200 );

        foreach ($lfs as $id)
        {
            $lf = mdlLancamentoFuturo::find( $id );
            $eve = mdlEvento::find( $lf->IMB_TBE_ID);

/*            return response( $lf->IMB_ATD_ID.' - '.
                    $lf->IMB_LCF_ID.' '.
                    $lf->IMB_TBE_ID.' '.
                    $eve->IMB_TBE_NOME.' '.
                    $lf->IMB_LCF_LOCATARIOCREDEB.' '.
                    $lf->IMB_LCF_VALOR.' '.
                    $lf->IMB_LCF_OBSERVACAO
                    ,200);
*/

            $btmp = new mdlBoletoitemtmp;

            $btmp->IMB_ATD_ID = $nidatd;
            $btmp->IMB_LCF_ID = $lf->IMB_LCF_ID;
            $btmp->IMB_TBE_ID = $lf->IMB_TBE_ID;
            $btmp->IMB_TBE_DESCRICAO = $eve->IMB_TBE_NOME;
            $btmp->IMB_RLT_LOCATARIOCREDEB = $lf->IMB_LCF_LOCATARIOCREDEB;
            $btmp->IMB_RLT_LOCADORCREDEB = $lf->IMB_LCF_LOCADORCREDEB;
            $btmp->IMB_LCF_VALOR = $lf->IMB_LCF_VALOR;
            $btmp->IMB_LCF_OBSERVACAO = $lf->IMB_LCF_OBSERVACAO;
            $btmp->IMB_LCF_DATAVENCIMENTO = $lf->IMB_LCF_DATAVENCIMENTO;
            $btmp->save();

        }

        $btmp = mdlBoletoitemtmp::where('IMB_ATD_ID','=', $nidatd)->get();

        return $btmp;

   }

   public function cargaItensTmp( $id )
   {
        $btmp = mdlBoletoitemtmp::where('IMB_ATD_ID','=', $id)->get();
        return $btmp;
   }


   public function excluir( $id )
   {
        $btmp = mdlBoletoitemtmp::find( $id);
        if( $btmp ) $btmp->delete();
   }






}
