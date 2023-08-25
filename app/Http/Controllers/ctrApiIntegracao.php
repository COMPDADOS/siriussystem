<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCliente;
use App\mdlImovel;
use App\mdlImobiliaria;
use App\mdlImagem;
use App\mdlTipoImovel;
use App\mdlCondominio;
use App\mdlPropImovel;
use App\mdlStatusImovel;
use App\mdlAtendente;
use App\mdlCorImo;
use App\mdlLog;
use App\mdlHistoricoImovel;
use App\mdlPortais;

use DataTables;
use App\User;
use DB;
use Log;

use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;

use Auth;

class ctrApiIntegracao extends Controller
{
    

    public function list(Request $request)
    {
        if( $request->token <> 'O2CS8mO6hUBXvvjckefEgThg7OXh7O2tGKiLFsyhUecNvs' ) 
          return response()->json( 'Token Invalido');

        if ($request->has('empresa') && strlen(trim($request->empresa)) > 0)
        {
            $unidade=$request->empresa;
        }
        else
        {
            return response()->json('Informe a empresa');
        }
        
        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                'IMB_IMOVEIS.IMB_IMB_ID',
                DB::raw('( SELECT PEGACAPIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECAPTADOR'),
                DB::raw('( SELECT PEGACORIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECORRETOR'),
                DB::raw('( SELECT IMB_IMB_NOME
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS UNIDADE'),
                    DB::raw('( SELECT IMB_ATD_NOME
                        FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_ID =
                        IMB_ATENDENTE.IMB_ATD_ID) AS CADASTRADOPOR'),
                    DB::raw('( SELECT IMB_ATD_NOME
                        FROM IMB_ATENDENTE WHERE IMB_IMOVEIS.IMB_ATD_IDALTERACAO =
                        IMB_ATENDENTE.IMB_ATD_ID) AS ALTERADOPOR'),

                    DB::raw('( SELECT IMB_IMB_URLIMOVELSITE
                        FROM IMB_IMOBILIARIA WHERE IMB_IMOVEIS.IMB_IMB_ID =
                        IMB_IMOBILIARIA.IMB_IMB_ID) AS URLIMOVELSITE'),
                        DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                        DB::raw('( SELECT VIS_STA_NOME
                        FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                        VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_NOME'),
                        DB::raw('( SELECT VIS_STA_SITUACAO
                        FROM VIS_STATUSIMOVEL WHERE IMB_IMOVEIS.VIS_STA_ID =
                        VIS_STATUSIMOVEL.VIS_STA_ID) AS VIS_STA_SITUACAO'),
                DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                 COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ', 
                 COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ', 
                 COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                'IMB_IMOVEIS.CEP_BAI_NOME',
                'IMB_IMOVEIS.IMB_IMV_CIDADE',
                'IMB_IMOVEIS.IMB_TIM_ID',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_DORAE',
                'IMB_IMOVEIS.IMB_IMV_ARECON',
                'IMB_IMOVEIS.IMB_IMV_AREUTI',
                'IMB_IMOVEIS.IMB_IMV_MEDTER',
                'IMB_IMOVEIS.IMB_IMV_PISCIN',
                'IMB_IMOVEIS.IMB_IMV_CHURRA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMV_TITULO',
                'IMB_IMOVEIS.VIS_STA_ID',
                'IMB_IMV_DATAATUALIZACAO',
                'IMB_IMV_DATACADASTRO',
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMV_OBSWEB',
                'IMB_IMV_CHABOX',
                'IMB_IMV_CHAVES',
                DB::Raw(' CASE
                        WHEN EXISTS( SELECT IMB_CCH_ID FROM IMB_CONTROLECHAVE
                        WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL 
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) THEN "Em Visita/Manutenção"
                        ELSE ""
                        END AS SITUACAOCHAVE'),
                DB::Raw('( SELECT IMB_CCH_DTHDEVOLUCAOESPERADA FROM IMB_CONTROLECHAVE
                        WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL 
                        AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) AS IMB_CCH_DTHDEVOLUCAOESPERADA'),

                DB::raw('( SELECT COALESCE(IMB_IMG_ARQUIVO,"logo.jpg")
                FROM IMB_IMAGEM WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_IMAGEM.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMAGEM'),
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')

            ])
            ->join('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', '=', 'IMB_IMOVEIS.VIS_STA_ID')
            ->where('VIS_STA_SITUACAO','=','A')
            ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=',$unidade )
            ->where( 'IMB_IMV_WEBIMOVEL','=','S');
             
        //$imoveis->limit(1000);

        //dd( $imoveis );


//        dd($request);
        return DataTables::of($imoveis)->make(true);
    }

    public function gerarRemessaZap( $portal )
    {

/*        if($token != "O2CS8mO6hUBXvvjckefEgThg7OXh7O2tGKiLFsyhUecNvs"){
            return redirect('/');
        }
        */
        
        $imoveis = app('App\Http\Controllers\ctrImovel')->pegarImoveisAtivosPortal( $portal );
        $portal         = mdlPortais::find( $portal );
        $nomedaview     = 'integracoes.zap';//$portal->VIS_POR_NOMEVIEW;
        $pastaxml       = $portal->VIS_POR_PASTAXML.'/'.Auth::user()->IMB_IMB_ID;
//        $nomedaview = 'integracoes.xml-olx';

        $idimobiliaria = Auth::user()->IMB_IMB_ID;
        $view = view( $nomedaview, compact('imoveis','idimobiliaria'));

        $contents = (string) $view;
        // or
        //$contents = $view->render();
        
        //$pasta = '/integrators/olx/'.$imb;

        $pasta  = $pastaxml;
//        $this->registrarHistorico( $imoveis, "OLX" );


        //return $pasta;
        $filename = '/carga_zap.xml';
        Storage::disk('public')->makeDirectory( $pasta);
        Storage::disk('public')->put( $pasta.'/'.$filename, $contents);


    }

        



    
}
