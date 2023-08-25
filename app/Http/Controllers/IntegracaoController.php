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
use App\mdlPortais;
use App\mdlHistoricoImovel;


use DB;
use Log;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;



class IntegracaoController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function getImoveis( $imb, $portal ){
        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMOVEIS.IMB_IMV_ID',
                DB::raw('( SELECT PEGACAPIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECAPTADOR'),
                DB::raw('( SELECT PEGACORIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECORRETOR'),
                DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE'),
                DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                 COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                 COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                 COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                DB::Raw( '( select CEP_BAI_NOME FROM CEP_BAIRRO WHERE CEP_BAIRRO.CEP_BAI_ID = IMB_IMOVEIS.CEP_BAI_ID) AS CEP_BAI_NOME'),
                'IMB_IMOVEIS.IMB_IMV_CIDADE',
                'IMB_IMOVEIS.IMB_IMV_ENDERECOCEP',
                'IMB_IMOVEIS.IMB_TIM_ID',
                'IMB_IMOVEIS.IMB_IMV_VALORIPTU',
                'IMB_IMOVEIS.IMB_IMV_VALORCONDOMINIO',
                'IMB_IMOVEIS.IMB_IMV_TITULO',
                'IMB_IMOVEIS.IMB_IMV_GARDES',
                'IMB_IMOVEIS.IMB_IMV_GARCOB',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_DORAE',
                'IMB_IMOVEIS.IMB_IMV_ARECON',
                'IMB_IMOVEIS.IMB_IMV_AREUTI',
                'IMB_IMOVEIS.IMB_IMV_ARETOT',
                'IMB_IMOVEIS.IMB_IMV_MEDTER',
                'IMB_IMOVEIS.IMB_IMV_PISCIN',
                'IMB_IMOVEIS.IMB_IMV_SALFES',
                'IMB_IMOVEIS.IMB_IMV_CHURRA',
                'IMB_IMOVEIS.IMB_IMV_EMPQUA',
                'IMB_IMOVEIS.IMB_IMV_WCQUA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMV_DATAATUALIZACAO',
                'IMB_IMV_DATACADASTRO',
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMOVEIS.IMB_IMV_DESTAQUE',
                'IMB_IMV_OBSWEB',
                'IMB_CLIENTE.IMB_CLT_NOME',
                'IMB_IMOVEIS.IMB_IMV_FINALIDADE',
                DB::raw('( SELECT COALESCE(IMB_IMG_ARQUIVO,"logo.jpg")
                FROM IMB_IMAGEM WHERE IMB_IMOVEIS.IMB_IMV_ID =
                IMB_IMAGEM.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMAGEM'),
                DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                WHERE IMB_IMOVEIS.IMB_TIM_ID =
                IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')

            ])
            // ->where('IMB_IMOVEIS.IMB_IMB_ID', '=' , $request->empresamaster )
            ->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_IMOVEIS.IMB_IMB_ID')
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID')
            ->leftJoin('IMB_IMOVELPORTAL', 'IMB_IMOVELPORTAL.IMB_IMV_ID', 'IMB_IMOVEIS.IMB_IMV_ID')
            ->leftJoin('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', 'IMB_IMOVEIS.VIS_STA_ID')
            ->where( 'IMB_IMOVELPORTAL.IMB_POR_ID','=', $portal)
            ->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', $imb)
            ->where('IMB_IMOVEIS.IMB_IMV_WEBIMOVEL','S')
            ->where( 'VIS_STATUSIMOVEL.VIS_STA_SITUACAO','=','A')
            ->orderBy( 'IMB_IMOVEIS.IMB_IMV_DESTAQUE', 'DESC')
            ->orderBy( 'IMB_IMOVEIS.IMB_IMV_DATAATUALIZACAO', 'DESC')
            ->get()
            ->map(function ($imovel){

                // Imagens
                $imagens = mdlImagem::Select( '*')
                    ->where( 'IMB_IMV_ID', $imovel['IMB_IMV_ID'] )
                    ->get();
                $imovel->imagens = $imagens;

                // Tipo de Imóvel
                switch ($imovel->IMB_IMV_DESTAQUE) 
                {
                        case 'S':
                                $imovel->TIPOOFERTA = 2;
                        break;
                        
                        case 'N':
                                $imovel->TIPOOFERTA = 1;
                        break;
                        case 'N':
                                $imovel->TIPOOFERTA= 1;
                        break;
                }

                // Tipo de Imóvel
                switch ($imovel->IMB_TIM_ID) 
                {


                        case '1':
                                $imovel->OLX_SUBTIPO_VARIACAO = 4;
                                $imovel->OLX_SUBTIPO_IMOVEL = "Galpão Comercial";
                        break;

                    case '2':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Terreno";
                            break;
    
                    case '3':
                            $imovel->OLX_SUBTIPO_VARIACAO = 2;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Sobrado";
                            break;
                    case '4':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Sala Comercial";
                            break;
    
                    case '5':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Chácara";
                            break;
    
                    case '6':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Sítio";
                            break;
    
                    case '7':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Fazenda";
                            break;
    
                    case '8':
                            $imovel->OLX_SUBTIPO_VARIACAO = 1;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Apartamento";
                            break;
    
                    case '9':
                            $imovel->OLX_SUBTIPO_VARIACAO = 2;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Casa";
                            break;
                            
                    case '10':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Salão Comercial";
                            break;
    
                            
                    case '11':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Terreno";
                            break;
    
                    case '12':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Terreno";
                            break;
    
                    case '13':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Terreno";
                            break;
    
                    case '15':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Casa Comercial";
                            break;
    
                    case '16':
                            $imovel->OLX_SUBTIPO_VARIACAO = 2;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Casa em Condomínio";
                            break;
    
                    case '17':
                            $imovel->OLX_SUBTIPO_VARIACAO = 1;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Flat";
                            break;
    
                    case '18':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Loja";
                            break;
    
                    case '19':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Indústria";
                            break;
    
                    case '20':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Hotel";
                            break;
    
                    case '21':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Prédio";
                            break;
        
                    case '25':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Ponto Comercial";
                            break;
    
                    case '26':
                            $imovel->OLX_SUBTIPO_VARIACAO = 1;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Kitnet";
                            break;
    
                    case '27':
                            $imovel->OLX_SUBTIPO_VARIACAO = 1;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Box Garagem";
                            break;
    
    
                    case '28':
                            $imovel->OLX_SUBTIPO_VARIACAO = 2;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Casa";
                            break;
    
    
                    case '29':
                            $imovel->OLX_SUBTIPO_VARIACAO = 1;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Cobertura";
                            break;
    
    
                    case '30':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Conjunto Comercial";
                            break;
    
                            case '31':
                                $imovel->OLX_SUBTIPO_VARIACAO = 2;
                                $imovel->OLX_SUBTIPO_IMOVEL = "Casa";
                                break;
        
                    case '31':
                            $imovel->OLX_SUBTIPO_VARIACAO = 2;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Casa";
                            break;
    
                    case '32':
                            $imovel->OLX_SUBTIPO_VARIACAO = 3;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Chácara";
                            break;
    
                    case '33':
                            $imovel->OLX_SUBTIPO_VARIACAO = 4;
                            $imovel->OLX_SUBTIPO_IMOVEL = "Galpão Comercial";
                            break;
    
                }
                
                return $imovel;                

/*
                    case '1':
                        $imovel->OLX_SUBTIPO_VARIACAO = 1;
                        if($imovel->CONDOMINIO){
                            $imovel->OLX_SUBTIPO_IMOVEL = "Casa em Condomínio";
                            break;
                        }
                        $imovel->OLX_SUBTIPO_IMOVEL = "Casa";
                        break;
                    case '2':
                        $imovel->OLX_SUBTIPO_VARIACAO = 2;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Apartamento";
                        break;
                    case '3':
                        $imovel->OLX_SUBTIPO_VARIACAO = 2;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Terreno";
                        break;
                    case '4':
                        $imovel->OLX_SUBTIPO_VARIACAO = 3;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Chácara";
                        break;
                    case '5':
                        $imovel->OLX_SUBTIPO_VARIACAO = 3;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Sítio";
                        break;
                    case '6':
                        $imovel->OLX_SUBTIPO_VARIACAO = 3;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Fazenda";
                        break;
                    case '7':
                        $imovel->OLX_SUBTIPO_VARIACAO = 4;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Loja";
                        break;
                    case '8':
                        $imovel->OLX_SUBTIPO_VARIACAO = 4;
                        $imovel->OLX_SUBTIPO_IMOVEL = "Salão Comercial  ";
                        break;
*/

                

            });

            return $imoveis;
    }

    private function checkDebug($imoveis)
    {
        if(request()->debug == 1){
            dd($imoveis);
        }
    }

    public function xmlolx($token, $imb, $portal)
    {
        if($token != "O2CS8mO6hUBXvvjckefEgThg7OXh7O2tGKiLFsyhUecNvs"){
            return redirect('/');
        }
        $imoveis = $this->getImoveis($imb,$portal);
        $this->checkDebug($imoveis);

        $portal         = mdlPortais::find( $portal );
        $nomedaview     = $portal->VIS_POR_NOMEVIEW;
        $pastaxml       = $portal->VIS_POR_PASTAXML.'/'.$imb;
//        $nomedaview = 'integracoes.xml-olx';

        $view = view( $nomedaview, compact('imoveis'));

        $contents = (string) $view;
        // or
        //$contents = $view->render();
        
        //$pasta = '/integrators/olx/'.$imb;

        $pasta  = $pastaxml;
        $this->registrarHistorico( $imoveis, "OLX" );


        //return $pasta;
        $filename = '/carga_olx.xml';
        Storage::disk('public')->makeDirectory( $pasta);
        Storage::disk('public')->put( $pasta.'/'.$filename, $contents);

        //$filename = '/carga_zap.xml';
        //Storage::disk('public')->put( $pasta.'/'.$filename, $contents);

//        $filename = '/carga_viva.xml';
        //Storage::disk('public')->put( $pasta.'/'.$filename, $contents);

        //registrando no historico
        
        


        //file_put_contents( $pasta., $contents);
    }


    public function noPortal( $portal )
    {
        $imoveis = mdlImovel::select(
                [
                    'IMB_IMOVEIS.IMB_IMV_ID',
                    DB::raw('( SELECT PEGACAPIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECAPTADOR'),
                    DB::raw('( SELECT PEGACORIMO( IMB_IMOVEIS.IMB_IMV_ID ) ) AS IMB_ATD_NOMECORRETOR'),
                    DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE'),
                    DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                            FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                            IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO'),
                    DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                     COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                     COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                     COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                    'IMB_IMOVEIS.IMB_IMV_REFERE',
                    'IMB_IMOVEIS.CEP_BAI_NOME',
                    'IMB_IMOVEIS.IMB_IMV_CIDADE',
                    'IMB_IMOVEIS.IMB_IMV_ENDERECOCEP',
                    'IMB_IMOVEIS.IMB_TIM_ID',
                    'IMB_IMOVEIS.IMB_IMV_VALORIPTU',
                    'IMB_IMOVEIS.IMB_IMV_VALORCONDOMINIO',
                    'IMB_IMOVEIS.IMB_IMV_TITULO',
                    'IMB_IMOVEIS.IMB_IMV_GARDES',
                    'IMB_IMOVEIS.IMB_IMV_GARCOB',
                    'IMB_IMOVEIS.IMB_IMV_DORQUA',
                    'IMB_IMOVEIS.IMB_IMV_DORAE',
                    'IMB_IMOVEIS.IMB_IMV_ARECON',
                    'IMB_IMOVEIS.IMB_IMV_AREUTI',
                    'IMB_IMOVEIS.IMB_IMV_ARETOT',
                    'IMB_IMOVEIS.IMB_IMV_MEDTER',
                    'IMB_IMOVEIS.IMB_IMV_PISCIN',
                    'IMB_IMOVEIS.IMB_IMV_SALFES',
                    'IMB_IMOVEIS.IMB_IMV_CHURRA',
                    'IMB_IMOVEIS.IMB_IMV_EMPQUA',
                    'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                    'IMB_IMOVEIS.IMB_IMV_VALLOC',
                    'IMB_IMOVEIS.IMB_IMV_VALVEN',
                    'IMB_IMV_DATAATUALIZACAO',
                    'IMB_IMV_DATACADASTRO',
                    'IMB_IMOVEIS.IMB_IMB_ID',
                    'IMB_IMV_OBSWEB',
                    'IMB_CLIENTE.IMB_CLT_NOME',
                    DB::raw('( SELECT COALESCE(IMB_IMG_ARQUIVO,"logo.jpg")
                    FROM IMB_IMAGEM WHERE IMB_IMOVEIS.IMB_IMV_ID =
                    IMB_IMAGEM.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMAGEM'),
                    DB::raw('( SELECT IMB_TIM_DESCRICAO FROM IMB_TIPOIMOVEL
                    WHERE IMB_IMOVEIS.IMB_TIM_ID =
                    IMB_TIPOIMOVEL.IMB_TIM_ID) AS IMB_TIM_DESCRICAO')
    
                ])
                // ->where('IMB_IMOVEIS.IMB_IMB_ID', '=' , $request->empresamaster )
                ->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_IMOVEIS.IMB_IMB_ID')
                ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID')
                ->leftJoin('IMB_IMOVELPORTAL', 'IMB_IMOVELPORTAL.IMB_IMV_ID', 'IMB_IMOVEIS.IMB_IMV_ID')
                ->leftJoin('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', 'IMB_IMOVEIS.VIS_STA_ID')
                ->where( 'IMB_IMOVELPORTAL.IMB_POR_ID','=', $portal)
                //->where( 'IMB_IMOVEIS.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
                ->where('IMB_IMOVEIS.IMB_IMV_WEBIMOVEL','S')
                ->where( 'VIS_STATUSIMOVEL.VIS_STA_SITUACAO','=','A')
                ->count();

        return response()->json( $imoveis,200);
    }


    public function registrarHistorico( $imoveis, $portal )
    {

        
        foreach( $imoveis as $imovel)
        {
                $hist = new mdlHistoricoImovel;
                $hist->IMB_IMV_ID = $imovel->IMB_IMV_ID;
                $hist->IMB_IMB_ID = 3;
                $hist->IMB_IMH_IDALTERACAO =1;
                $hist->IMB_ATD_ID = 1;
                $hist->IMB_IMH_DTHALTERACAO = date('Y-m-d H:i:s');
                $hist->IMB_GRT_CODIGO = $portal;
                $hist->IMB_IMH_CAMPO = 'Dados';
                $hist->IMB_IMH_VALORANTERIOR = 'Dados Enviados';
                $hist->IMB_IMH_VALORATUAL = 'Enviados '.$portal;
                $hist->save();

        }
        

    }


    public function xmlChaveMao($token, $imb, $portal)
    {
        if($token != "O2CS8mO6hUBXvvjckefEgThg7OXh7O2tGKiLFsyhUecNvs"){
            return redirect('/');
        }
        $imoveis = $this->getImoveis($imb,$portal);
        $this->checkDebug($imoveis);

        $portal         = mdlPortais::find( $portal );
        $nomedaview     = $portal->VIS_POR_NOMEVIEW;
        $pastaxml       = $portal->VIS_POR_PASTAXML.'/'.$imb;
//        $nomedaview = 'integracoes.xml-olx';

        $view = view( $nomedaview, compact('imoveis'));

        $contents = (string) $view;
        // or
        //$contents = $view->render();
        
        //$pasta = '/integrators/'.$imb.'/';

        $pasta  = $pastaxml;
        $this->registrarHistorico( $imoveis, "OLX" );


        //return $pasta;
        $filename = '/chavemao.xml';
        Storage::disk('public')->makeDirectory( $pasta);
        Storage::disk('public')->put( $pasta.'/'.$filename, $contents);

        //registrando no historico
        
        


        //file_put_contents( $pasta., $contents);
    }

    public function novoZap($token)
    {


        if($token != "O2CS8mO6hUBXvvjckefEgThg7OXh7O2tGKiLFsyhUecNvs"){
            return redirect('/');
        }
        $imoveis = $this->getImoveis($imb,$portal);
        $this->checkDebug($imoveis);

        $portal         = mdlPortais::find( $portal );
        $nomedaview     = $portal->VIS_POR_NOMEVIEW;
        $pastaxml       = $portal->VIS_POR_PASTAXML.'/'.$imb;
//        $nomedaview = 'integracoes.xml-olx';

        $view = view( $nomedaview, compact('imoveis'));

        $contents = (string) $view;
        // or
        //$contents = $view->render();
        
        //$pasta = '/integrators/'.$imb.'/';

        $pasta  = $pastaxml;
        $this->registrarHistorico( $imoveis, "ZAP" );

        //return $pasta;
        $filename = '/novozap.xml';
        Storage::disk('public')->makeDirectory( $pasta);
        Storage::disk('public')->put( $pasta.'/'.$filename, $contents);

     }




}
