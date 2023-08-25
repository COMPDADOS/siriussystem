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

use DataTables;
use App\User;
use DB;

class ctrImovel extends Controller
{
    

    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list(Request $request)
    {
        
        $imoveis = mdlImovel::select(
            [
                'IMB_IMOVEIS.IMB_IMV_ID',
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
                'IMB_IMOVEIS.IMB_TIM_ID',
                'IMB_IMOVEIS.IMB_IMV_DORQUA',
                'IMB_IMOVEIS.IMB_IMV_SUIQUA',
                'IMB_IMOVEIS.IMB_IMV_VALLOC',
                'IMB_IMOVEIS.IMB_IMV_VALVEN',
                'IMB_IMOVEIS.IMB_IMB_ID',
                'IMB_IMV_OBSWEB',
                'IMB_CLIENTE.IMB_CLT_NOME'

            ])
            ->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_IMOVEIS.IMB_IMB_ID')
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_IMOVEIS.IMB_CLT_ID');

         $cFiltrou = 'N';


/*         $imoveis->whereRaw( DB::raw("not exists( SELECT IMB_CTR_ID FROM IMB_CONTRATO
         WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CONTRATO.IMB_IMV_ID AND 
         IMB_CTR_SITUACAO <> 'ATIVO')"));
*/

        if ($request->has('agencia') && strlen(trim($request->agencia)) > 0){
            $cFiltrou = 'S';
            $imoveis->where('IMB_IMOVEIS.IMB_IMB_ID', $request->agencia);
        }

        /*
        if ($request->has('finalidade') && $request->finalidade <> 'T' )
        {
            $cFiltrou = 'S';

            if ( $request->finalidade <> 'L' ){
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC','>',0);
            };
            if ( $request->finalidade <> 'V' ){
                $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN','>',0);
            }
        }
        */

        if ($request->has('tipoimovel') && strlen(trim($request->tipoimovel)) > 0){
            $cFiltrou = 'S';
            $imoveis->where('IMB_IMOVEIS.IMB_TIM_ID', $request->tipoimovel);
        }

        if ($request->has('condominio') && strlen(trim($request->condominio)) > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw( DB::raw("exists( SELECT IMB_CND_ID FROM IMB_CONDOMINIO 
            WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID AND 
            IMB_CND_NOME LIKE '%{$request->condominio}%')"));
        }

        if ($request->has('corretor') && $request->corretor > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw( DB::raw("exists( SELECT IMB_ATD_ID FROM IMB_CORIMO
            WHERE IMB_IMOVEIS.IMB_IMV_ID = IMB_CORIMO.IMB_IMV_ID 
            AND IMB_CORIMO.IMB_ATD_ID = $request->corretor)"));
        }

        if ($request->has('cidade') && strlen(trim($request->cidade)) > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw("IMB_IMOVEIS.IMB_IMV_CIDADE LIKE '%{$request->cidade}%'");
        }
    

        if ($request->has('proprietario') && strlen(trim($request->proprietario)) > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw( "IMB_CLT_NOME LIKE '%{$request->proprietario}%'");
        }

        if ($request->has('id_completus') && strlen(trim($request->id_completus)) > 0){
            $cFiltrou = 'S';
            $imoveis->where('IMB_IMOVEIS.IMB_IMV_ID', '=', $request->id_completus);
        }

        if ($request->has('referencia') && strlen(trim($request->referencia)) > 0)
        {
            $cFiltrou = 'S';
            $imoveis->whereRaw("IMB_IMV_REFERE LIKE '%{$request->referencia}%'");
        }

        if ($request->has('endereco') && strlen(trim($request->endereco)) > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw(DB::raw("CONCAT( COALESCE(IMB_IMV_ENDERECO,''), ' ',
                              COALESCE( IMB_IMV_ENDERECONUMERO,''), ' ',
                              COALESCE( IMB_IMV_ENDERECOCOMPLEMENTO), ' ',
                              COALESCE( IMB_IMV_NUMAPT,'') ) LIKE  '%{$request->endereco}%'"));
        }

        if ($request->has('bairro') && strlen(trim($request->bairro)) > 0){
            $cFiltrou = 'S';
            $imoveis->whereRaw("IMB_IMOVEIS.CEP_BAI_NOME LIKE '%{$request->bairro}%'");
        }
    
        if ($request->has('faixainicial') && 
            $request->has('faixafinal') &&
            $request->faixafinal >= $request->faixainicial){
            if( $request->finalidade == 'L')
                {
                    $cFiltrou = 'S';
                    $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '>=', $request->faixainicial);
                    $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALLOC', '<=', $request->faixafinal);
                }
            if( $request->finalidade == 'V')
                {
                    $cFiltrou = 'S';
                    $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN', '>=', $request->faixainicial);
                    $imoveis->where('IMB_IMOVEIS.IMB_IMV_VALVEN', '<=', $request->faixafinal);
                }
                }
    
                if ($request->has('cidade') && strlen(trim($request->cidade)) > 0){
                    $cFiltrou = 'S';
                    $imoveis->whereRaw("IMB_IMOVEIS.IMB_IMV_CIDADE LIKE '%{$request->cidade}%'");
                }
            
                if ($request->has('dormitorio') && $request->dormitorio > 0){
            $cFiltrou = 'S';
            $imoveis->where('IMB_IMOVEIS.IMB_IMV_DORQUA','>=', $request->dormitorio);
        }
    
        if ($request->has('suite') && $request->suite > 0){
            $cFiltrou = 'S';
            $imoveis->where('IMB_IMOVEIS.IMB_IMV_SUIQUA','>=', $request->suite);
        }
    

//        $imoveis->orderBy('IMB_IMV_ENDERECO', 'DESC');
        if ( $cFiltrou == 'N') {
            $imoveis->limit(0);
        }


        //dd($request);
        return DataTables::of($imoveis)->make(true);
    }


     public function index()
     {

        return view('imovel.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
              //dd( $request );
        

        $valloc = $request->input('IMB_IMV_VALLOC',0);
        //$valloc = str_replace(',','.', str_replace('.','', $valloc ));
        //$valloc = str_replace('R$','', $valloc );

//        $valven = $request->input('IMB_IMV_VALVEN',0);
        //$valven = str_replace(',','.', str_replace('.','', $valven ));
        //$valven = str_replace('R$','', $valven );
     
        $imv = new mdlImovel();

        $IMB_IMV_DESTAQUE              =  $request->input('IMB_IMV_DESTAQUE','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_ID                     =  $request->input('IMB_IMV_ID');
        $IMB_IMV_WEBIMOVEL              =  $request->input('IMB_IMV_WEBIMOVEL','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_WEBLANCAMENTO         =  $request->input('IMB_IMV_WEBLANCAMENTO','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_ESCLUSIVO             =  $request->input('IMB_IMV_ESCLUSIVO','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_PLACA                 =  $request->input('IMB_IMV_PLACA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_PERMUTA               =  $request->input('IMB_IMV_PERMUTA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_ESCRIT                =  $request->input('IMB_IMV_ESCRIT','N')=='on' ? 'S' : 'N' ;           
        $IMB_IMV_SOBRADO               =  $request->input('IMB_IMV_SOBRADO','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_ASSOBRADADA           =  $request->input('IMB_IMV_ASSOBRADADA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_ACEITAFINANC          =  $request->input('IMB_IMV_ACEITAFINANC','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_TERREA                =  $request->input('IMB_IMV_TERREA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_COZPLA                =  $request->input('IMB_IMV_COZPLA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_EMPQUA                =  $request->input('IMB_IMV_EMPQUA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_LAVABOV                =  $request->input('IMB_IMV_LAVABOV','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_EMPWC                =  $request->input('IMB_IMV_EMPWC','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_DESPENSA                =  $request->input('IMB_IMV_DESPENSA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_PISCIN                =  $request->input('IMB_IMV_PISCIN','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_EDICUL                =  $request->input('IMB_IMV_EDICUL','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_QUINTA                =  $request->input('IMB_IMV_QUINTA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_CHURRA                =  $request->input('IMB_IMV_CHURRA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_PORELE                =  $request->input('IMB_IMV_PORELE','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_SALFES                =  $request->input('IMB_IMV_SALFES','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_SAUNA                =  $request->input('IMB_IMV_SAUNA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_QUADRAPOLIESPORTIVA                =  $request->input('IMB_IMV_QUADRAPOLIESPORTIVA','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_PLAGRO                =  $request->input('IMB_IMV_PLAGRO','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_DORAE                =  $request->input('IMB_IMV_DORAE','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_SUIHID                =  $request->input('IMB_IMV_SUIHID','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_LAVABO                =  $request->input('IMB_IMV_LAVABO','N') =='on' ? 'S' : 'N' ;
        $IMB_IMV_ENDERECOCOMPLEMENTO     =  $request->input('IMB_IMV_ENDERECOMPLEMENTO',' ') ;
        $IMB_IMV_ENDERECOTIPO           =  $request->input('IMB_IMV_ENDERECOTIPO',' ') ;
        $IMB_IMV_ENDERECONUMERO           =  $request->input('IMB_IMV_ENDERECONUMERO',' ') ;

        $imv->IMB_IMB_ID                    = 1;
        $imv->IMB_IMB_ID2                   = $request->input('IMB_IMB_ID') ;
        $imv->IMB_IMV_WEBIMOVEL             = $IMB_IMV_WEBIMOVEL;
        $imv->IMB_IMV_DESTAQUE              = $IMB_IMV_DESTAQUE;
        $imv->IMB_IMV_WEBLANCAMENTO         = $IMB_IMV_WEBLANCAMENTO;
        $imv->IMB_IMV_ESCLUSIVO             = $IMB_IMV_ESCLUSIVO;
        $imv->IMB_IMV_PLACA                 = $IMB_IMV_PLACA;
        $imv->IMB_IMV_TERREA                = $IMB_IMV_TERREA;
        $imv->IMB_IMV_PERMUTA               = $IMB_IMV_PERMUTA;
        $imv->IMB_IMV_ESCRIT                = $IMB_IMV_ESCRIT;
        $imv->IMB_IMV_SOBRADO               = $IMB_IMV_SOBRADO;
        $imv->IMB_IMV_ASSOBRADADA           = $IMB_IMV_ASSOBRADADA;
        $imv->IMB_IMV_ACEITAFINANC          = $IMB_IMV_ACEITAFINANC;
        $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA;
        $imv->IMB_IMV_COZPLA                =   $IMB_IMV_COZPLA ;
        $imv->IMB_IMV_EMPQUA                =   $IMB_IMV_EMPQUA ;
        $imv->IMB_IMV_LAVABO                 =  $IMB_IMV_LAVABO ;
        $imv->IMB_IMV_EMPWC                =    $IMB_IMV_EMPWC ;
        $imv->IMB_IMV_DESPENSA                = $IMB_IMV_DESPENSA;
        $imv->IMB_IMV_PISCIN                =   $IMB_IMV_PISCIN;
        $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA;
        $imv->IMB_IMV_EDICUL                =   $IMB_IMV_EDICUL;
        $imv->IMB_IMV_QUINTA                =   $IMB_IMV_QUINTA;
        $imv->IMB_IMV_CHURRA                =   $IMB_IMV_CHURRA;
        $imv->IMB_IMV_PORELE                =   $IMB_IMV_PORELE;
        $imv->IMB_IMV_SALFES                =   $IMB_IMV_SALFES;
        $imv->IMB_IMV_SAUNA                =    $IMB_IMV_SAUNA;
        $imv->IMB_IMV_QUADRAPOLIESPORTIVA    =  $IMB_IMV_QUADRAPOLIESPORTIVA ;
        $imv->IMB_IMV_PLAGRO                =   $IMB_IMV_PLAGRO ;
        $imv->IMB_IMV_DORAE                 = $IMB_IMV_DORAE ;
        $imv->IMB_IMV_SUIHID                = $IMB_IMV_SUIHID ;
        $imv->IMB_IMV_DORCLO                = $request->input('IMB_IMV_DORCLO','0');
    
/*        $imv->IMB_IMV_DATAATUALIZACAO       = date('Y/m/d');
        $imv->IMB_IMV_DATACADASTRO       = date('Y/m/d');
        $imv->IMB_IMV_DATFIL       = date('Y/m/d');
  */   
        $imv->IMB_TIM_ID                    = $request->input('IMB_TIM_ID');
     
        $imv->IMB_CLT_ID                    = $request->input('IMB_CLT_ID');
     
        $imv->IMB_IMV_REFERE                = $request->input('IMB_IMV_REFERE');
     
        $imv->IMB_IMV_VALVEN                = $request->input('IMB_IMV_VALVEN',0);
     
        $imv->IMB_IMV_VALLOC                = $valloc;
      
        
     
        $imv->IMB_IMV_ENDERECOTIPO          = $IMB_IMV_ENDERECOTIPO ;
     
        $imv->IMB_IMV_ENDERECONUMERO        = $IMB_IMV_ENDERECONUMERO ;
     
        $imv->IMB_IMV_ENDERECO              = $request->input('IMB_IMV_ENDERECO','');
     
        $imv->IMB_IMV_NUMAPT                = $request->input('IMB_IMV_NUMAPT','');
     
        $imv->IMB_IMV_ENDERECOCOMPLEMENTO   = $IMB_IMV_ENDERECOCOMPLEMENTO;
                                                

     
        $imv->IMB_CND_ID                    = $request->input('IMB_CND_ID');
     
        $imv->IMB_IMV_PREDIO                = $request->input('IMB_IMV_PREDIO','');
     
        if(  $request->input('IMB_IMV_ANDAR' ) <> '' )
            $imv->IMB_IMV_ANDAR                 = $request->input('IMB_IMV_ANDAR','');
     
        $imv->CEP_BAI_NOME                  = $request->input('CEP_BAI_NOME','');
     
        $imv->IMB_IMV_ENDERECOCEP           = $request->input('IMB_IMV_ENDERECOCEP','');
     
        $imv->IMB_IMV_QUADRA                = $request->input('IMB_IMV_QUADRA','');
     

     $imv->IMB_IMV_LOTE                     = $request->input('IMB_IMV_LOTE','');
     
        $imv->IMB_IMV_CIDADE                = $request->input('IMB_IMV_CIDADE','');
     
        $imv->IMB_IMV_ESTADO                = $request->input('IMB_IMV_ESTADO',''   );
     
        $imv->IMB_IMV_PROXIMIDADE           = $request->input('IMB_IMV_PROXIMIDADE');
     
        $imv->IMB_IMV_MEDTER                = $request->input('IMB_IMV_MEDTER',' ');
     
        if( $request->input('IMB_IMV_ARETOT' ) <> '' )
            $imv->IMB_IMV_ARETOT                = $request->input('IMB_IMV_ARETOT',0);
     
        if( $request->input('IMB_IMV_ARECON' ) <> '' )
            $imv->IMB_IMV_ARECON                = $request->input('IMB_IMV_ARECON',0);
     
        if( $request->input('IMB_IMV_AREUTI' ) <> '' )
            $imv->IMB_IMV_AREUTI                = $request->input('IMB_IMV_AREUTI',0);
     
        if( $request->input('IMB_IMV_DORQUA' ) <> '' )
            $imv->IMB_IMV_DORQUA                = $request->input('IMB_IMV_DORQUA',0);
     

        if( $request->input('IMB_IMV_SUIQUA' ) <> '' )
            $imv->IMB_IMV_SUIQUA                = $request->input('IMB_IMV_SUIQUA',0);
     
     
        if( $request->input('IMB_IMV_SALQUA' ) <> '' )
            $imv->IMB_IMV_SALQUA                = $request->input('IMB_IMV_SALQUA',0);
    
     
            if( $request->input('IMB_IMV_GARDES' ) <> '' )
            $imv->IMB_IMV_GARDES                = $request->input('IMB_IMV_GARDES',0);
     
        if( $request->input('IMB_IMV_GARCOB' ) <> '' )
            $imv->IMB_IMV_GARCOB                = $request->input('$IMB_IMV_GARCOB',0);
     
        $imv->IMB_IMV_IDADE                 = $request->input('IMB_IMV_IDADE',' ');
     
        $imv->IMB_IMV_OBSERV                = $request->input('IMB_IMV_OBSERV',' ');
     
        $imv->IMB_IMV_OBSWEB                = $request->input('IMB_IMV_OBSWEB',' ');
        $imv->IMB_IMB_IDMASTER              = 1;
        $imv->IMB_IMV_ID                    =  $request->input('IMB_IMV_ID');

        if( $imv->IMB_IMV_REFERE == '' )
        {
            $ntipoimovel = $request->input('IMB_TIM_ID');
            $tipoimovel  = mdlTipoImovel::select( 
                [
                    'IMB_TIM_SUPTIPO'
                ])
            ->where( 'IMB_TIM_ID','=',$ntipoimovel )
            ->first();
        
            $sub=$tipoimovel->IMB_TIM_SUPTIPO;
            $referencia = collect( DB::select("select NovaReferencia('$sub') as ref "))->first()->ref;
            $imv->IMB_IMV_REFERE = $referencia;
        }
    


/*
        $imv->IMB_IMV_VALLOC                = $request->input('IMB_IMV_VALLOC');         
        $imv->IMB_IMV_VALVEN                = $request->input('IMB_IMV_VALVEN');
        //$imv->IMB_IMV_VALVEN = $float = (double)$IMB_IMV_VALVEN/100;
     
//         $imv->IMB_IMV_ARECON = str_replace(',', '', $IMB_IMV_ARECON);
//         $imv->IMB_IMV_ARECON = str_replace('.', '', $IMB_IMV_ARECON);
//         $imv->IMB_IMV_ARECON = $float = (double)$IMB_IMV_ARECON/100;
     //
//         $imv->IMB_IMV_AREUTI = str_replace(',', '', $IMB_IMV_AREUTI);
//        $imv->IMB_IMV_AREUTI = str_replace('.', '', $IMB_IMV_AREUTI);
//         $imv->IMB_IMV_AREUTI = $float = (double)$IMB_IMV_AREUTI/100;
     
//         $imv->IMB_IMV_ARETOT = str_replace(',', '', $IMB_IMV_ARETOT);
//         $imv->IMB_IMV_ARETOT = str_replace('.', '', $IMB_IMV_ARETOT);
//         $imv->IMB_IMV_ARETOT = $float = (double)$IMB_IMV_ARETOT/100;

        
*/      
        //  dd(  $request->input('IMB_IMV_ID'));
         $imv->save(); 
        
//            return redirect("imovel/edit/".$imv->IMB_IMV_ID );
        
       return redirect('imovel');

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

        $imovel = mdlImovel::find($id);
        $imobiliaria = mdlImobiliaria::all();
        $tipoimovel = mdlTipoImovel::all();
        $condominio = mdlCondominio::select('*')
        ->orderBy( 'IMB_CND_NOME')
        ->get();
        $corimo = mdlCorImo::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->get();


        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->get();
        
        $cliente = mdlCliente::select('IMB_CLT_NOME', 'IMB_CLT_ID', 'IMB_CLT_CPF')->orderBy( 'IMB_CLT_NOME' )->limit(10)->get();
        return view('imovel.edit', compact('imovel', 'imobiliaria', 'tipoimovel', 'condominio', 'cliente', 'imagens', 'corimo') );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    
    {

        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }
        
        //dd($request)       ;
        
        $id = $request->input('IMB_IMV_ID');
//        return $request;

        $imv = mdlImovel::find($id);
        if( isset( $imv )){

//            $imv->IMB_IMV_ID   = $request->input('IMB_IMV_ID')
         
            $IMB_IMV_WEBIMOVEL             = $request->input('IMB_IMV_WEBIMOVEL','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_DESTAQUE              =  $request->input('IMB_IMV_DESTAQUE','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_WEBLANCAMENTO         =  $request->input('IMB_IMV_WEBLANCAMENTO','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_ESCLUSIVO             =  $request->input('IMB_IMV_ESCLUSIVO','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_PLACA                 =  $request->input('IMB_IMV_PLACA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_TERREA                 =  $request->input('IMB_IMV_TERREA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_PERMUTA               =  $request->input('IMB_IMV_PERMUTA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_ESCRIT                =  $request->input('IMB_IMV_ESCRIT','N')=='on' ? 'S' : 'N' ;           
            $IMB_IMV_SOBRADO               =  $request->input('IMB_IMV_SOBRADO','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_ASSOBRADADA           =  $request->input('IMB_IMV_ASSOBRADADA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_ACEITAFINANC          =  $request->input('IMB_IMV_ACEITAFINANC','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_COZPLA                =  $request->input('IMB_IMV_COZPLA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_EMPQUA                =  $request->input('IMB_IMV_EMPQUA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_LAVABOV                =  $request->input('IMB_IMV_LAVABOV','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_EMPWC                =  $request->input('IMB_IMV_EMPWC','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_DESPENSA                =  $request->input('IMB_IMV_DESPENSA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_PISCIN                =  $request->input('IMB_IMV_PISCIN','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_COZINHA                =  $request->input('IMB_IMV_COZINHA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_EDICUL                =  $request->input('IMB_IMV_EDICUL','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_QUINTA                =  $request->input('IMB_IMV_QUINTA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_CHURRA                =  $request->input('IMB_IMV_CHURRA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_PORELE                =  $request->input('IMB_IMV_PORELE','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_SALFES                =  $request->input('IMB_IMV_SALFES','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_SAUNA                =  $request->input('IMB_IMV_SAUNA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_QUADRAPOLIESPORTIVA                =  $request->input('IMB_IMV_QUADRAPOLIESPORTIVA','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_PLAGRO                =  $request->input('IMB_IMV_PLAGRO','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_DORAE                =  $request->input('IMB_IMV_DORAE','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_SUIHID                =  $request->input('IMB_IMV_SUIHID','N') =='on' ? 'S' : 'N' ;
            $IMB_IMV_LAVABO                =  $request->input('IMB_IMV_LAVABO','N') =='on' ? 'S' : 'N' ;


            $imv->IMB_IMB_ID                    = 1;
            $imv->IMB_IMB_ID2                   = $request->input('IMB_IMB_ID') ;
            $imv->IMB_IMV_WEBIMOVEL             = $IMB_IMV_WEBIMOVEL;
            $imv->IMB_IMV_DESTAQUE              = $IMB_IMV_DESTAQUE;
            $imv->IMB_IMV_WEBLANCAMENTO         = $IMB_IMV_WEBLANCAMENTO;
            $imv->IMB_IMV_ESCLUSIVO             = $IMB_IMV_ESCLUSIVO;
            $imv->IMB_IMV_PLACA                 = $IMB_IMV_PLACA;
            $imv->IMB_IMV_TERREA                = $IMB_IMV_TERREA;
            $imv->IMB_IMV_PERMUTA               = $IMB_IMV_PERMUTA;
            $imv->IMB_IMV_ESCRIT                = $IMB_IMV_ESCRIT;
            $imv->IMB_IMV_SOBRADO               = $IMB_IMV_SOBRADO;
            $imv->IMB_IMV_ASSOBRADADA           = $IMB_IMV_ASSOBRADADA;
            $imv->IMB_IMV_ACEITAFINANC          = $IMB_IMV_ACEITAFINANC;
            $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA;
            $imv->IMB_IMV_COZPLA                =   $IMB_IMV_COZPLA ;
            $imv->IMB_IMV_EMPQUA                =   $IMB_IMV_EMPQUA ;
            $imv->IMB_IMV_LAVABO                 =  $IMB_IMV_LAVABO ;
            $imv->IMB_IMV_EMPWC                =    $IMB_IMV_EMPWC ;
            $imv->IMB_IMV_DESPENSA                = $IMB_IMV_DESPENSA ;
            $imv->IMB_IMV_PISCIN                =   $IMB_IMV_PISCIN ;
            $imv->IMB_IMV_COZINHA                =  $IMB_IMV_COZINHA ;
            $imv->IMB_IMV_EDICUL                =   $IMB_IMV_EDICUL;
            $imv->IMB_IMV_QUINTA                =   $IMB_IMV_QUINTA ;
            $imv->IMB_IMV_CHURRA                =   $IMB_IMV_CHURRA ;
            $imv->IMB_IMV_PORELE                =   $IMB_IMV_PORELE ;
            $imv->IMB_IMV_SALFES                =   $IMB_IMV_SALFES ;
            $imv->IMB_IMV_SAUNA                =    $IMB_IMV_SAUNA ;
            $imv->IMB_IMV_QUADRAPOLIESPORTIVA    =  $IMB_IMV_QUADRAPOLIESPORTIVA ;
            $imv->IMB_IMV_PLAGRO                =   $IMB_IMV_PLAGRO ;
         
            $imv->IMB_IMV_DORAE                 = $IMB_IMV_DORAE;
            $imv->IMB_IMV_SUIHID                = $IMB_IMV_SUIHID;
           
            $imv->IMB_IMV_DORCLO                = $request->input('IMB_IMV_DORCLO');

         
            $imv->IMB_IMV_DATAATUALIZACAO       = date('Y/m/d');
         
            $imv->IMB_TIM_ID                    = $request->input('IMB_TIM_ID');
         
            $imv->IMB_CLT_ID                    = $request->input('IMB_CLT_ID');
         
            $imv->IMB_IMV_REFERE                = $request->input('IMB_IMV_REFERE');
         
            $imv->IMB_IMV_VALVEN                = $request->input('IMB_IMV_VALVEN');
         
            $imv->IMB_IMV_VALLOC                = $request->input('IMB_IMV_VALLOC');
         
            $imv->IMB_IMV_ENDERECOTIPO          = $request->input('IMB_IMV_ENDERECOTIPO');
         
            $imv->IMB_IMV_ENDERECONUMERO        = $request->input('IMB_IMV_ENDERECONUMERO');
         
            $imv->IMB_IMV_ENDERECO              = $request->input('IMB_IMV_ENDERECO');
         
            $imv->IMB_IMV_NUMAPT                = $request->input('IMB_IMV_NUMAPT');
         
            $imv->IMB_IMV_ENDERECOCOMPLEMENTO   = $request->input('IMB_IMV_ENDERECOCOMPLEMENTO');
         
            $imv->IMB_CND_ID                    = $request->input('IMB_CND_ID');
         
            $imv->IMB_IMV_PREDIO                = $request->input('IMB_IMV_PREDIO');
         
            $imv->IMB_IMV_ANDAR                 = $request->input('IMB_IMV_ANDAR');
         
            $imv->CEP_BAI_NOME                  = $request->input('CEP_BAI_NOME');
         
            $imv->IMB_IMV_ENDERECOCEP           = $request->input('IMB_IMV_ENDERECOCEP');
         
            $imv->IMB_IMV_QUADRA                = $request->input('IMB_IMV_QUADRA');
         

         $imv->IMB_IMV_LOTE                  = $request->input('IMB_IMV_LOTE');
         
            $imv->IMB_IMV_CIDADE                = $request->input('IMB_IMV_CIDADE');
         
            $imv->IMB_IMV_ESTADO                = $request->input('IMB_IMV_ESTADO');
         
            $imv->IMB_IMV_PROXIMIDADE           = $request->input('IMB_IMV_PROXIMIDADE');
         
            $imv->IMB_IMV_MEDTER                = $request->input('IMB_IMV_MEDTER');
         
            $imv->IMB_IMV_ARETOT                = $request->input('IMB_IMV_ARETOT');
         
            $imv->IMB_IMV_ARECON                = $request->input('IMB_IMV_ARECON');
         
            $imv->IMB_IMV_AREUTI                = $request->input('IMB_IMV_AREUTI');
         
           $imv->IMB_IMV_DORQUA                = $request->input('IMB_IMV_DORQUA');
         
            $imv->IMB_IMV_SUIQUA                = $request->input('IMB_IMV_SUIQUA');
         
         
            $imv->IMB_IMV_SALQUA                = $request->input('IMB_IMV_SALQUA');
         
 
         
            if( $request->input('IMB_IMV_GARDES' ) <> '' )
                $imv->IMB_IMV_GARDES                = $request->input('IMB_IMV_GARDES',0);
     
            if( $request->input('IMB_IMV_GARCOB' ) <> '' )
                $imv->IMB_IMV_GARCOB                = $request->input('$IMB_IMV_GARCOB',0);
         
            $imv->IMB_IMV_IDADE                 = $request->input('IMB_IMV_IDADE');
         
            $imv->IMB_IMV_OBSERV                = $request->input('IMB_IMV_OBSERV');
         
            $imv->IMB_IMV_OBSWEB                = $request->input('IMB_IMV_OBSWEB');
            $imv->IMB_IMB_IDMASTER              = 1;

            /*
            $imv->IMB_IMV_VALLOC                = $request->input('IMB_IMV_VALLOC');         
            $imv->IMB_IMV_VALVEN                = $request->input('IMB_IMV_VALVEN');
            //$imv->IMB_IMV_VALVEN = $float = (double)$IMB_IMV_VALVEN/100;
         
//         $imv->IMB_IMV_ARECON = str_replace(',', '', $IMB_IMV_ARECON);
//         $imv->IMB_IMV_ARECON = str_replace('.', '', $IMB_IMV_ARECON);
//         $imv->IMB_IMV_ARECON = $float = (double)$IMB_IMV_ARECON/100;
         //
//         $imv->IMB_IMV_AREUTI = str_replace(',', '', $IMB_IMV_AREUTI);
 //        $imv->IMB_IMV_AREUTI = str_replace('.', '', $IMB_IMV_AREUTI);
//         $imv->IMB_IMV_AREUTI = $float = (double)$IMB_IMV_AREUTI/100;
         
//         $imv->IMB_IMV_ARETOT = str_replace(',', '', $IMB_IMV_ARETOT);
//         $imv->IMB_IMV_ARETOT = str_replace('.', '', $IMB_IMV_ARETOT);
//         $imv->IMB_IMV_ARETOT = $float = (double)$IMB_IMV_ARETOT/100;

            


  */       
          
            if( $imv->IMB_IMV_REFERE == '' )
            {
                $ntipoimovel = $request->input('IMB_TIM_ID');
                $tipoimovel  = mdlTipoImovel::select( 
                    [
                        'IMB_TIM_SUPTIPO'
                    ])
                ->where( 'IMB_TIM_ID','=',$ntipoimovel )
                ->first();
            
                $sub=$tipoimovel->IMB_TIM_SUPTIPO;
                $referencia = collect( DB::select("select NovaReferencia('$sub') as ref "))->first()->ref;
                $imv->IMB_IMV_REFERE = $referencia;
            }
        
            $imv->save(); 
        

            $existe = mdlPropImovel::select( 
                [ 
                    'IMB_PPI_ID'
                ]
            )
            ->where( 'IMB_IMV_ID','=',$imv->IMB_IMV_ID )
            ->where( 'IMB_CLT_ID','=',$request->input('IMB_CLT_ID') )
            ->get();

            
           
             $original =  $request->input('IMB_CLT_IDORIGINAL');
            $atual =  $request->input('IMB_CLT_ID');
            $idimovel = $request->input('IMB_IMV_ID');
/*            if( $atual <> '' )
            {
                DB::table('IMB_PROPRIETARIOIMOVEL')
                    ->where('IMB_CLT_ID', '=',$original )
                    ->where('IMB_IMV_ID', '=',$idimovel )
                ->update( ['IMB_CLT_ID' =>  $atual ]) ;          
            };
*/
            
        }
//          return $IMB_IMV_WEBIMOVEL;
return redirect('imovel');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imovel = mdlImovel::find( $id );
        if( isset( $imovel ))
        {
            $imovel->delete();
            return response('ok',200);

        }
        return response('Já Excluido',404);
    }

    /**
     * Formulário para criação e edição de imóveis
     * @param int $id Identificador do imóvel
     * @return view
     */
    public function form(Request $request)
    {
        $imovel = new mdlImovel;

        if (isset($request->id)) 
        {
            $imovel = $imovel->find($request->id);
            $imobiliaria = mdlImobiliaria::all();
            $tipoimovel = mdlTipoImovel::all();
            $condominio = mdlCondominio::all();

        }

        return view('imovel.form', compact('imovel', 'imobiliaria', 'tipoimovel', 'condominio'));
    } 
    
    
    public function add()
    {

        $id = collect( DB::select("select auto_increment + 1 as novoid  from information_schema.tables where table_name = 'IMB_CLIENTE' "))->first()->novoid;
        
        $statement = "ALTER TABLE IMB_CLIENTE AUTO_INCREMENT= $id";
        DB::unprepared($statement);

        //$cliente = mdlCliente::select('IMB_CLT_NOME', 'IMB_CLT_ID', 'IMB_CLT_CPF')->orderBy( 'IMB_CLT_NOME' )->limit(10)->get();
//        return redirect("imovel/edit/".$imv->IMB_IMV_ID );


        return view( 'imovel.new', compact('id') );

        
    }

    public function galeria()
    {
        return 'OK';
    }

    public function mostrar($id)
    {

        $imovel = mdlImovel::select(
            [
                '*',
                DB::raw('( SELECT COALESCE(IMB_CND_NOME,"")
                        FROM IMB_CONDOMINIO WHERE IMB_IMOVEIS.IMB_CND_ID =
                        IMB_CONDOMINIO.IMB_CND_ID) AS CONDOMINIO' )
            ])
            ->where('IMB_IMOVEIS.IMB_IMV_ID', '=', $id)
            ->get();

//            $imovel = mdlImovel::find($id);
        return $imovel->toJson();

        //
    }




    
}
