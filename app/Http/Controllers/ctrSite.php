<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlTipoImovel;
use App\mdlImovel;
use App\mdlImagem;
use App\mdlImobiliaria;
use DB;
class ctrSite extends Controller
{
    public function index()
    {

        $tipoimovel = mdlTipoImovel::all();
        $agencias = mdlImobiliaria::all();
        $cidades=\DB::table('IMB_IMOVEIS')
        ->select('IMB_IMV_CIDADE')
        ->groupBy('IMB_IMV_CIDADE')
        ->get(); 
    
        $bairros=\DB::table('IMB_IMOVEIS')
        ->select('CEP_BAI_NOME')
        ->groupBy('CEP_BAI_NOME')
        ->get(); 
        
        $capa = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                'IMB_IMOVEIS.CEP_BAI_NOME',
                'IMB_IMOVEIS.IMB_IMV_CIDADE',
                'IMB_IMOVEIS.IMB_IMV_SALQUA',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMV_OBSWEB',
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMAGEM.IMB_IMG_ID',
                DB::raw( "(select IMB_CND_NOME FROM IMB_CONDOMINIO
                WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID LIMIT 1) AS IMB_CND_NOME"),
                DB::raw("IMB_TIPOIMOVEL.IMB_TIM_DESCRICAO AS IMB_TIM_DESCRICAO"),
                DB::raw("IMB_IMAGEM.IMB_IMG_PRINCIPAL AS IMB_IMG_PRINCIPAL"),
                DB::raw("IMB_IMAGEM.IMB_IMG_ARQUIVO IMB_IMG_ARQUIVO")
            ])
            ->join('IMB_IMAGEM', 'IMB_IMAGEM.IMB_IMV_ID','=','IMB_IMOVEIS.IMB_IMV_ID')
            ->join('IMB_TIPOIMOVEL', 'IMB_TIPOIMOVEL.IMB_TIM_ID', '=', 'IMB_IMOVEIS.IMB_TIM_ID')
            ->where('IMB_IMOVEIS.IMB_IMB_ID','=',2)
            ->where('IMB_IMAGEM.IMB_IMG_PRINCIPAL','=','S')
            ->where('IMB_IMV_WEBIMOVEL','=','S')
            ->where('IMB_IMV_SUSPENSO','<>','S')
            ->limit(10)
            ->get();

        
        $ultimos = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                'IMB_IMOVEIS.CEP_BAI_NOME',
                'IMB_IMOVEIS.IMB_IMV_CIDADE',
                'IMB_IMOVEIS.IMB_IMV_SALQUA',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_WCQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMV_OBSWEB',
                'IMB_IMOVEIS.IMB_IMB_ID',
                DB::raw("IMB_IMOBILIARIA.IMB_IMB_NOME AS IMB_IMB_NOME"),
                DB::raw("IMB_TIPOIMOVEL.IMB_TIM_DESCRICAO AS IMB_TIM_DESCRICAO"),
                DB::raw( '(select IMB_IMG_ARQUIVO FROM IMB_IMAGEM 
                        WHERE IMB_IMAGEM.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID 
                        ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMB_IMG_ARQUIVO'),
           ])
//            ->join('IMB_IMAGEM', 'IMB_IMAGEM.IMB_IMV_ID', 'IMB_IMOVEIS.IMB_IMV_ID')
            ->join('IMB_TIPOIMOVEL', 'IMB_TIPOIMOVEL.IMB_TIM_ID', 'IMB_IMOVEIS.IMB_TIM_ID')
            ->join('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_IMOVEIS.IMB_IMB_ID')
//            ->where('IMB_IMAGEM.IMB_IMG_PRINCIPAL','=','S')
            ->orderBy('IMB_IMV_DATACADASTRO','desc')
            ->where('IMB_IMOVEIS.IMB_IMB_ID','=',2)
            ->limit(20)
            ->get();
    
            //return $capa;
        
        //return $capa->toJson();
    
            //return var_dump( $capa );

        return view( '/fluxoimoveis/index', compact('tipoimovel','cidades', 'bairros', 'capa','agencias', 'ultimos'));
        
    }

    public function pesquisar( Request $request)
    {
        
        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
                'IMB_IMOVEIS.IMB_IMV_CODIGOCOMPLETUS',
                DB::raw("IMB_IMOBILIARIA.IMB_IMB_NOME AS IMB_IMB_NOME"),
                DB::raw("IMB_TIPOIMOVEL.IMB_TIM_DESCRICAO AS IMB_TIM_DESCRICAO"),
  //              DB::raw("IMB_IMAGEM.IMB_IMG_PRINCIPAL AS IMB_IMG_PRINCIPAL"),
//                DB::raw("IMB_IMAGEM.IMB_IMG_ARQUIVO IMB_IMG_ARQUIVO"),
                 DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                 COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ', 
                 COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ', 
                 COALESCE( IMB_IMV_NUMAPT,'') ) AS ENDERECOCOMPLETO"),
                 DB::raw( '(select IMB_IMG_ARQUIVO FROM IMB_IMAGEM 
                 WHERE IMB_IMAGEM.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMB_IMG_ARQUIVO'),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                'IMB_IMOVEIS.CEP_BAI_NOME',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMV_SALQUA',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_ARECON',
                'IMB_IMOVEIS.IMB_IMV_WCQUA',
                'IMB_IMOVEIS.IMB_IMV_OBSWEB'
            ])
//            ->join('IMB_IMAGEM', 'IMB_IMAGEM.IMB_IMV_ID', 'IMB_IMOVEIS.IMB_IMV_ID')
            ->join('IMB_TIPOIMOVEL', 'IMB_TIPOIMOVEL.IMB_TIM_ID', 'IMB_IMOVEIS.IMB_TIM_ID')
            ->join('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_IMOVEIS.IMB_IMB_ID')
            ->join('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', '=', 'IMB_IMOVEIS.VIS_STA_ID')
            ->where('IMB_IMOVEIS.IMB_IMB_ID','=',2)
            ->where('VIS_STA_SITUACAO','=','A')
            ->where('IMB_IMV_SUSPENSO', '<>','S' )
            ->where('IMB_IMV_WEBIMOVEL','S');

        $cFiltrou = 'S';
            if ($request->has('unidade') && ($request->unidade) <> 0)
        {
            $cFiltrou = 'S';
            $imoveis = $imoveis->where('IMB_IMOVEIS.IMB_IMB_ID2', $request->unidade);
        }
 
        if ($request->has('referencia') && strlen(trim($request->referencia)) > 0)
        {
            $cFiltrou = 'S';
            $imoveis->whereRaw("IMB_IMV_REFERE LIKE '%{$request->referencia}%'");
        }
        if ($request->has('IMB_IMV_CIDADE') && strlen( trim($request->IMB_IMV_CIDADE)) > 0)
        {
            $cFiltrou = 'S';
            $imoveis = $imoveis->where('IMB_IMV_CIDADE', $request->IMB_IMV_CIDADE);
        }

        if ($request->has('IMB_TIM_ID') && $request->IMB_TIM_ID > 0)
        {
            $cFiltrou = 'S';
            $imoveis = $imoveis->where('IMB_IMOVEIS.IMB_TIM_ID', $request->IMB_TIM_ID);
        }

        if ($request->has('bairro') && strlen(trim($request->bairro)) > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw("IMB_IMOVEIS.CEP_BAI_NOME LIKE '%{$request->bairro}%'");
        }
    
        if ($request->has('valorfinal') && $request->has('valorfinal') ) 
        {
            if( $request->finalidade == 'L') {
                $cFiltrou = 'S';
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '>=', $request->valorinicial );
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '<=', $request->valorfinal );
            };
            if( $request->finalidade == 'V') {
                $cFiltrou = 'S';
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN','>=', $request->valorinicial );
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN','<=', $request->valorfinal );
            };
        }
    
        if( $request->finalidade == 'V')
            $imoveis = $imoveis->orderBy( 'IMB_IMV_VALVEN', 'DESC');
        
        if( $request->finalidade == 'L')
            $imoveis = $imoveis->orderBy( 'IMB_IMV_VALLOC', 'DESC');

        $imoveis = $imoveis->get();



        if ( isset( $imoveis ) )
           return view( '/fluxoimoveis/lista', compact('imoveis') );
        
    }

    public function detalhe( $id )
    {

        $imagens = mdlImagem::select('*')
        ->where( 'IMB_IMV_ID',$id)
        ->get();

        $imovel = mdlImovel::find( $id );

        return view( '/fluxoimoveis/detalhe', compact( 'imovel', 'imagens') );


    }

}
