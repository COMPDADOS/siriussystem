<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\mdlAtendente;
use App\mdlImovel;
use App\mdlImagem;
use App\mdlImobiliaria;
use DB;

class ctrPdf extends Controller
{


    public function gerarresumoimovel( $id, $email  )
    {

//        dd( $email );
        $imagem = mdlImagem::where( 'IMB_IMV_ID','=', $id )->get();

        $imovel = mdlImovel::select(
            [
                '*',
                DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO' ),
                        DB::raw('( SELECT COALESCE(IMB_TIM_DESCRICAO,"")
                        FROM IMB_TIPOIMOVEL WHERE IMB_IMOVEIS.IMB_TIM_ID =
                        IMB_TIPOIMOVEL.IMB_TIM_ID) AS TIPOIMOVEL' )
            ])
            ->where('IMB_IMOVEIS.IMB_IMV_ID', '=', $id)
            ->get();

        $imobiliaria = mdlImobiliaria::where( 'IMB_IMB_ID','=', $imovel[0]->IMB_IMB_ID2 )->get();

        $referencia = $imovel[0]->IMB_IMV_REFERE;
        $bairro = $imovel[0]->CEP_BAI_NOME;

        Mail::send( 'imovel.pdfresumoimovel', compact('imovel', 'imagem', 'imobiliaria'),
           function( $message ) use ($email, $referencia, $bairro)
           {
            $message->from( 'suporte@compdados.com.br');
            $message->to( $email );
            $message->subject('Imóvel: '.$referencia. ' - '.$bairro);

           });
        return "Email enviado!";
/*

        $PDF = \PDF::loadView('imovel.pdfresumoimovel', compact('imovel', 'imagem', 'imobiliaria'));
        file_put_contents( 'public/atendimentos/imovel_'.$imovel[0]->IMB_IMB_ID.'_'.$id.'.pdf', $PDF->output() );
//        ->download('imovel_'.$imovel[0]->IMB_IMV_REFERE.'.pdf');        

        return redirect()->back(-1);
*/
    }
}
