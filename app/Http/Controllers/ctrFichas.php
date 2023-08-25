<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImovel;
use App\mdlImobiliaria;
use App\mdlAtendente;
use App\mdlImagem;
use App\mdlTipoImovel;
use App\mdlPropImovel;
use App\mdlCliente;
use App\mdlCondominio;
use App\mdlStatusImovel;
use PDF;
use DB;
use Auth;

class ctrFichas extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function fichaImovel( Request $request)
    {
        $id = $request->idimovel;
        $completa = $request->tipo;
        
        $imv = mdlImovel::find( $id );
        $tim = mdlTipoImovel::find( $imv->IMB_TIM_ID );
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );
        $img = mdlImagem::where( 'IMB_IMV_ID','=',$id)
        ->where('IMB_IMG_PRINCIPAL','=','S')
        ->first();
        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=',$id)
        ->where('IMB_IMVCLT_PRINCIPAL','=','S')
        ->first();
        $cli = mdlCliente::find( $ppi->IMB_CLT_ID);
        $sta = mdlStatusImovel::find( $imv->VIS_STA_ID);
        $status = $sta->VIS_STA_NOME;

        $con = mdlCondominio::find( $imv->IMB_CND_ID);
        $condominio = '';
        if( $con )
            $condominio = $con->IMB_CND_NOME;

        $fone = collect( DB::select("select PEGAFONES('$cli->IMB_CLT_ID') as fones "))->first()->fones;

        $endereco= collect( DB::select("select imovel('$id') as endereco "))->first()->endereco;

        $cap= collect( DB::select("select PEGACAPIMO('$id') as captadores "))->first()->captadores;
         
        $cor= collect( DB::select("select PEGACORIMO('$id') as corretores "))->first()->corretores;

        if ( ! $img )
        {
            $img = mdlImagem::where( 'IMB_IMV_ID','=',$id)
            ->orderBy( 'IMB_IMG_SEQUENCIA')
            ->first();
            if ( ! $img )
                $image="";
            else
                $image=$img->IMB_IMG_ARQUIVO;
                    
    
        }
        else
            $image=$img->IMB_IMG_ARQUIVO;


        $divprop='';

        if( $completa <> 'S' ) $divprop = "display:none";

        return view( 'fichas.imovel.imovelfichaint', compact( 'imv', 'imb', 'atd', 
        'image', 'tim', 'cli','fone','endereco', 'divprop','cap','cor',
        'condominio','status') );

            $pdf=PDF::loadView( 'fichas.imovel.imovelfichaint', compact( 'imv', 'imb', 'atd', 
            'image', 'tim', 'cli','fone','endereco', 'divprop','cap','cor',
            'condominio','status') );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('test_pdf.pdf');
        
     
    }


    

    
    public function fichasCaptacaoEmpreend()
    {
        return view('fichas.empreendimentos.fichascaptacaoempreend');

    }

    public function fichasCaptacaoMenu()
    {
        return view('fichas.imovel.fichascaptacao');

    }

    public function  captaCaoandarCorp()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoandarcorp',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoandarcorp',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_andarcorp.pdf');
        

    }



    public function captacaoApartameto()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoapartameto',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoapartameto',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_apto.pdf');
        

    }

    public function apartamentoDuplex()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.apartamentoduplex',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.apartamentoduplex',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_aptoduplex.pdf');
        

    }
    public function apartamentoTriplex()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.apartamentotriplex',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.apartamentotriplex',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_aptotriplex.pdf');
    }

    public function captacaoArea()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoarea',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoarea',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_area.pdf');
    }


    public function captacaoBangalo()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaobangalo',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaobangalo',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_bangalo.pdf');
    }
    

    public function captacaoBoxGaragem()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoboxgaragem',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoboxgaragem',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoboxgaragem.pdf');
    }

    
    public function captacaoCasa()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaocasa',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaocasa',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaocasa.pdf');
    }

    
    public function captacaoChacara()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaochacara',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaochacara',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaochacara.pdf');
    }


    
    public function captacaoCobertura()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaocobertura',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaocobertura',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaocobertura.pdf');
    }
    
    public function captacaoConjunto()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoconjunto',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoconjunto',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoconjunto.pdf');
    }
    
        
    public function captacaoEdicula()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoedicula',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoedicula',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoedicula.pdf');
    }
    
        
    public function captacaoFazenda()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaofazenda',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaofazenda',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaofazenda.pdf');
    }
    
    public function captacaoFlat()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoflat',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoflat',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoflat.pdf');
    }

    public function captacaoGalpao()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaogalpao',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaogalpao',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaogalpao.pdf');
    }


    public function captacaoHaras()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoharas',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoharas',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoharas.pdf');
    }

    
    public function captacaoHoel()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaohoel',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaohoel',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaohoel.pdf');
    }

    public function captacaoIlha()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoilha',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoilha',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoilha.pdf');
    }


    public function captacaoKitnet()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaokitnet',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaokitnet',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaokitnet.pdf');
    }


    public function captacaoLaje()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaolaje',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaolaje',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaolaje.pdf');
    }


    public function captacaoLoft()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoloft',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoloft',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoloft.pdf');
    }

    

    public function captacaoLoja()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoloja',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoloja',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('captacaoloja.pdf');
    }


    public function captacaoPavilhao()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaopavilhao',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaopavilhao',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaopavilhao.pdf');
    }


    public function captacaoPonto()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoponto',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoponto',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoponto.pdf');
    }

    public function captacaoPousada()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaopousada',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaopousada',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaopousada.pdf');
    }

    
    public function captacaoPredio()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaopredio',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaopredio',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaopredio.pdf');
    }

    
    public function captacaoRancho()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaorancho',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaorancho',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaorancho.pdf');
    }

    
    public function captacaoSala()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaosala',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaosala',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaosala.pdf');
    }

    public function captacaoSalao()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaosalao',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaosalao',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaosalao.pdf');
    }

    public function captacaoSitio()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaositio',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaositio',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaositio.pdf');
    }


    public function captacaoSobrado()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaosobrado',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaosobrado',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaosobrado.pdf');
    }


    public function captacaoTerreno()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.imovel.captacaoterreno',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoterreno',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoterreno.pdf');
    }
        

    public function captacaoEmpreendimentos()
    {
        $imb = mdlImobiliaria::find( Auth::user()->IMB_IMB_ID );
        $atd = mdlAtendente::find(  Auth::user()->IMB_ATD_ID );

        return view( 'fichas.empreendimentos.captacaoempreendimentos',compact('imb','atd'));

            $pdf=PDF::loadView( 'fichas.imovel.captacaoempreendimentos',compact('imb','atd')  );
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('ficha_captacaoempreendimentos.pdf');
    }
        
    public function menuPersonalizados()
    {

        $docs = app('App\Http\Controllers\ctrDocsPersonalizados')
        ->carga();

        return view( 'fichas.personalizados.menupersonalizados', compact('docs'));
    }
        
    
    
        
                
                            
    

    //
}
