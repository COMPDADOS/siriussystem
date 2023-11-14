<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAtendente;
use App\mdlTipoAtendente;
use App\mdlImobiliaria;
use App\mdlAtendenteUnidade;
use App\mdlAtendentePerfilLead;
use App\mdlAtendentePerfilLeadNeg;
use App\mdlAtendentePerfilLeadBairro;
use App\mdlAtendentePerfilLeadCondom;
use App\mdlAtendentePerfilLeadTipImo;
use App\mdlNegocio;
use App\mdlTipoImovel;
use App\mdlCondominio;
use App\mdlBairro;
use Illuminate\Support\Facades\Hash;
use App\classes\PQ_Image;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
use Auth;
use Log;
use DB;

class ctrAtendente extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {
        return view( 'atendente.atendenteindex');
        //
    }



    public function list( $empresamaster, $page, $busca,$somenteativos)
    {
        $start_from = ($page - 1) * 15;

        if( $busca == 'TODOSTODOSTODOS') $busca='';

        $busca="%$busca%";


            if( $busca == '%%' )
            {
                $lf = mdlAtendente::select(
                    [
                        'IMB_ATD_ID',
                        'IMB_ATD_NOME',
                        DB::raw("coalesce(email,'-') as email"),
                        DB::raw("coalesce(IMB_ATD_TELEFONE_1,'-') as IMB_ATD_TELEFONE_1"),
                        DB::raw("coalesce(IMB_ATD_DDD1,'-' ) as IMB_ATD_DDD1"),
                        'IMB_ATD_DATADEMISSAO',
                        'IMB_ATD_ATIVO',
                        DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                    ]
                )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
                ->where( 'IMB_ATENDENTE.IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID );
            

            }
            else
            {
                $lf = mdlAtendente::select(
                    [
                        'IMB_ATD_ID',
                        'IMB_ATD_NOME',
                        DB::raw("coalesce(email,'') as email"),
                        DB::raw("coalesce(IMB_ATD_TELEFONE_1,'') as IMB_ATD_TELEFONE_1"),
                        DB::raw("coalesce(IMB_ATD_DDD1,'' ) as IMB_ATD_DDD1"),
                        'IMB_ATD_DATADEMISSAO',
                        'IMB_ATD_ATIVO',

                        DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')

                    ]
                )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
                ->where( 'IMB_ATD_NOME','LIKE', $busca)
                ->where( 'IMB_ATENDENTE.IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID );
                
            }

            if( $somenteativos == 'S' ) 
                $lf = $lf->where('IMB_ATD_ATIVO', '=' ,'A');

            $lf = $lf->orderBy('IMB_ATD_NOME');
            Log::info( $lf->toSql());
            $lf = $lf->get();


                

        return $lf;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $novasenha = Hash::make($request->input('IMB_ATD_SENHA'));


        $atd = new mdlAtendente;
        $atd->IMB_IMB_ID = $request->input('IMB_IMB_ID');
        $atd->IMB_ATD_CPF = $request->input('IMB_ATD_CPF');
        $atd->IMB_ATD_NOME  = $request->input('IMB_ATD_NOME');
        $atd->IMB_ATD_APELIDO = $request->input('IMB_ATD_APELIDO');
        $atd->IMB_ATD_EMAIL = $request->input('IMB_ATD_EMAIL');
        $atd->IMB_ATD_TELEFONE_1 = $request->input('IMB_ATD_TELEFONE_1','0');
        $atd->IMB_ATD_TELEFONE_2 = $request->input('IMB_ATD_TELEFONE_2','0');
        $atd->IMB_ATD_DDD1 = $request->input('IMB_ATD_DDD1','0');
        $atd->IMB_ATD_DDD2 = $request->input('IMB_ATD_DDD2','0');
        $atd->IMB_ATD_TELTIPO1 = $request->input('IMB_ATD_TELTIPO1');
        $atd->IMB_ATD_TELTIPO2 = $request->input('IMB_ATD_TELTIPO2');
        $atd->IMB_ATP_ID                =  $request->input('IMB_ATP_ID');
        $atd->IMB_ATD_CPF                =  $request->input('IMB_ATD_CPF');
        $atd->IMB_ATD_RG                =  $request->input('IMB_ATD_RG');
        $atd->IMB_ATD_CRECI                =  $request->input('IMB_ATD_CRECI');
        $atd->IMB_ATD_HABILITARFILA                =  $request->input('IMB_ATD_HABILITARFILA');
        $atd->IMB_TIPATE_ID                         = $request->IMB_TIPATE_ID                           ;
        $atd->IMB_ATD_COMISSAOCAPLOC = $request->IMB_ATD_COMISSAOCAPLOC;
        $atd->IMB_ATD_COMISSAOCAPVENDA = $request->IMB_ATD_COMISSAOCAPVENDA;
        $atd->IMB_ATD_COMISSAOCORLOC = $request->IMB_ATD_COMISSAOCORLOC;
        $atd->IMB_ATD_COMISSAOCORVENDA = $request->IMB_ATD_COMISSAOCORVENDA;
        $atd->IMB_ATD_COMISSAOPAGDIAFIXO = $request->IMB_ATD_COMISSAOPAGDIAFIXO;
        $atd->IMB_ATD_COMISSAOPAGDIASEMANA = $request->IMB_ATD_COMISSAOPAGDIASEMANA;
        $atd->IMB_ATD_NOTIFICARNOVOATM = $request->IMB_ATD_NOTIFICARNOVOATM;
       
        
        if ( $request->input('IMB_ATD_DATAADMISSAO')  <>'' )
           $atd->IMB_ATD_DATAADMISSAO = $request->input('IMB_ATD_DATAADMISSAO');

        if ( $request->input('IMB_ATD_DATADEMISSAO') <>'' )
           $atd->IMB_ATD_DATADEMISSAO = $request->input('IMB_ATD_DATADEMISSAO');

        $atd->VIS_AGE_ID = $request->input('IMB_IMB_ID2');
        $atd->imb_imb_id2 = $request->input('IMB_IMB_ID2');
//        $atd->IMB_ATD_SENHA = $novasenha;
        $atd->password = $novasenha;
        $atd->email = $request->input('IMB_ATD_EMAIL');
        $atd->login = $request->input('IMB_ATD_NOME');
        $atd->IMB_ATD_ATIVO='A';

        $atd->save();

        $unidades = mdlImobiliaria::all();

        foreach( $unidades as $imob )
        {
            $atu = new mdlAtendenteUnidade;

            if( $imob->IMB_IMB_ID == $atd->imb_imb_id2 )
                $atu->IMB_ATU_STATUS = 'S';
            else
                $atu->IMB_ATU_STATUS = 'N';
            $atu->IMB_ATD_ID = $atd->IMB_ATD_ID;
            $atu->IMB_IMB_ID = $imob->IMB_IMB_ID;
            $atu->save();
        }

        return response()->json('OK', 200);

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
        return view( 'atendente.atendenteedit', compact('id') );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $atd =  mdlAtendente::find( $request->input( 'IMB_ATD_ID'));


        $atd->IMB_ATD_NOME  = $request->input('IMB_ATD_NOME');
        $atd->IMB_ATD_CPF = $request->input('IMB_ATD_CPF');
        $atd->IMB_ATD_NOME  = $request->input('IMB_ATD_NOME');
        $atd->IMB_ATD_APELIDO = $request->input('IMB_ATD_APELIDO');
        $atd->IMB_ATD_EMAIL             = $request->input('IMB_ATD_EMAIL');
        $atd->IMB_ATD_TELEFONE_1        = $request->input('IMB_ATD_TELEFONE_1','0');
        $atd->IMB_ATD_TELEFONE_2        = $request->input('IMB_ATD_TELEFONE_2','0');
        $atd->IMB_ATD_DDD1              = $request->input('IMB_ATD_DDD1','0');
        $atd->IMB_ATD_DDD2              = $request->input('IMB_ATD_DDD2','0');
        $atd->IMB_ATD_SOMENTECOMERCIAL  =  $request->input('IMB_ATD_SOMENTECOMERCIAL');
        $atd->IMB_ATD_ATIVO  =  $request->input('IMB_ATD_ATIVO');
        $atd->IMB_ATP_ID                =  $request->input('IMB_ATP_ID');
        $atd->IMB_ATD_CPF                =  $request->input('IMB_ATD_CPF');
        $atd->IMB_ATD_RG                =  $request->input('IMB_ATD_RG');
        $atd->IMB_ATD_CRECI                =  $request->input('IMB_ATD_CRECI');
        $atd->IMB_ATD_HABILITARFILA                =  $request->input('IMB_ATD_HABILITARFILA');
        $atd->IMB_TIPATE_ID                         = $request->IMB_TIPATE_ID                           ;
        $atd->IMB_ATD_COMISSAOCAPLOC = $request->IMB_ATD_COMISSAOCAPLOC;
        $atd->IMB_ATD_COMISSAOCAPVENDA = $request->IMB_ATD_COMISSAOCAPVENDA;
        $atd->IMB_ATD_COMISSAOCORLOC = $request->IMB_ATD_COMISSAOCORLOC;
        $atd->IMB_ATD_COMISSAOCORVENDA = $request->IMB_ATD_COMISSAOCORVENDA;
        $atd->IMB_ATD_COMISSAOPAGDIAFIXO = $request->IMB_ATD_COMISSAOPAGDIAFIXO;
        $atd->IMB_ATD_COMISSAOPAGDIASEMANA = $request->IMB_ATD_COMISSAOPAGDIASEMANA;
        if ( ( $request->input('IMB_ATD_DATAADMISSAO')  <> '--' ) and
        ( $request->input('IMB_ATD_DATAADMISSAO')  <> '' ) )
            $atd->IMB_ATD_DATAADMISSAO = $request->input('IMB_ATD_DATAADMISSAO');
        else
            $atd->IMB_ATD_DATAADMISSAO = null;

        if ( ( $request->input('IMB_ATD_DATADEMISSAO') <>'--' ) and
             ( $request->input('IMB_ATD_DATADEMISSAO')  <> '' ) )
            $atd->IMB_ATD_DATADEMISSAO = $request->input('IMB_ATD_DATADEMISSAO');
        else
            $atd->IMB_ATD_DATADEMISSAO = null;

        $atd->VIS_AGE_ID = $request->input('IMB_IMB_ID2');
        $atd->imb_imb_id2 = $request->input('IMB_IMB_ID2');
        //$atd->IMB_ATD_SENHA = Hash::make('IMB_ATD_SENHA');
        $atd->email = $request->input('IMB_ATD_EMAIL');
        $atd->login = $request->input('IMB_ATD_NOME');
        //$atd->password = Hash::make('IMB_ATD_SENHA');
        //dd( 'dddd '.$request->input('IMB_ATD_SOMENTECOMERCIAL','N') );

        $atd->save();

        return response( $atd->IMB_ATD_ID ,200);
        //return response('ok',200);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atd = mdlAtendente::find( $id );
        $atd->IMB_ATD_ATIVO = 'I';
        $atd->save();


    }


    public function buscaTodosJson( $empresa )
    {

            $atendentes = mdlAtendente::select(
                [
                    'IMB_ATD_ID',
                    'IMB_ATD_NOME',
                    'email',
                    'IMB_ATD_TELEFONE_1',
                    'IMB_ATD_DDD1',
                    'IMB_ATD_DATADEMISSAO',
                    'IMB_ATD_ATIVO',

                    DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                ]
            )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
            ->where( 'IMB_ATD_NOME', '<>','')
            ->where( 'IMB_ATENDENTE.IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID )
            ->orderBy('IMB_ATD_NOME')
            ->get();


        return $atendentes->toJson();


    }

    public function localizarAtd( $email )
    {

        $atendentes = mdlAtendente::select(
            [
                'IMB_ATD_ID',
                'IMB_ATD_NOME',
                'IMB_ATD_EMAIL',
                'IMB_IMB_ID',
                'IMB_IMB_ID2',
                'IMB_ATD_DATADEMISSAO',
                'IMB_ATD_ATIVO',

                DB::raw('(SELECT IMB_IMB_NOME FROM IMB_IMOBILIARIA
                WHERE IMB_IMB_ID = IMB_ATENDENTE.IMB_IMB_ID2 ) AS IMB_IMB_NOME ')
            ]

        )->where( 'IMB_ATD_EMAIL', '=',$email )
        ->first();

        return  $atendentes;


    }

    public function codigoUnidadeAtd( $email )
    {

        $atendentes = mdlAtendente::select(
            [
                'IMB_IMB_ID2'
            ]
        )->where( 'IMB_ATD_EMAIL', '=',$email )
        ->first();

        return   $atendentes;


    }
    public function nomeUnidadeAtd( $id )
    {

        $atendentes = mdlAtendente::select(
            [
                DB::raw('(SELECT IMB_IMB_NOME FROM IMB_IMOBILIARIA
                WHERE IMB_IMB_ID = IMB_ATENDENTE.IMB_IMB_ID2 ) AS IMB_IMB_NOME ')
            ]
        )->where( 'IMB_ATD_ID', '=',$id )
        ->first();

        return  $atendentes->toJson();


    }
    public function find( $id )
    {

        $atendentes = mdlAtendente::find( $id);

        return  $atendentes;


    }


    public function novo()
    {

        return  view( 'atendente.atendentenew');

    }

    public function findEmail( $email )
    {

        $atendentes = mdlAtendente::select( '*')
        ->where( "IMB_ATD_EMAIL", $email)
        ->get();

        return  $atendentes->toJson();
    }

    public function novaSenha( $email )
    {

        $senha='Cpd2335392';
        $novasenha= Hash::make( $senha);
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Nova senha: '.$novasenha;
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';

        if ( Mail::to( $email )->send(new mailsirius($objDemo)) )
            return response( 'OK', 200);
        else
            return response( 'erro', 404);
    }

    public function countRecords( $empresamaster )
    {
        $atendentes = mdlAtendente::where( 'IMB_IMB_ID','=',$empresamaster )
        ->get()->count();
        return $atendentes;
    }

    public function alterarSenha(Request $request)
    {
        $atd =  mdlAtendente::find( $request->input( 'IMB_ATD_ID'));
        $senha = Hash::make( $request->input( 'IMB_ATD_SENHA') );
        $atd->password = $senha;

        $atd->save();

        return response( $atd->IMB_ATD_ID ,200);
    }

    public function cargaAtivos()
    {
        $atd =  mdlAtendente::where('IMB_ATD_ATIVO','=','A')
                ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
                ->orderBy('IMB_ATD_NOME')
                ->get();
        return $atd;
    }


    public function uploadFoto(Request $request)
    {

        $images=$request->file('arquivo');

        $file_name=time().'.'.$image->getClientOriginalExtension();

        $pasta='/images/'.$request->input('imbmaster').'/logos/';

        Storage::disk('public')->makeDirectory( $pasta);

        $photo = Image::make( $image )
                        ->resize(200, null, function ($constraint) { $constraint->aspectRatio(); } )
                        ->encode('jpg',80);
                        Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);

    }

    public function desativar( Request $request )
    {
        $id = $request->IMB_ATD_ID;

        $atd = mdlAtendente::find( $id );
        if( $atd )
        {
            $atd->IMB_ATD_ATIVO = 'I';
            $atd->save();
            return response()->json('ok',200);
        }

        return response()->json('erro',404);
    }
    public function cargaAvatar( $id )
    {
        return "<div>{{env('APP_URL')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/usuarios/avatar{{$id}}.jpg</div>";
    }

    public function cargaUnidades( $atd)
    {
        $imbs = mdlAtendenteUnidade::select(
            [
                'IMB_ATU_ID',
                'IMB_IMB_NOME',
                'IMB_ATU_STATUS'
            ]
        )->where( 'IMB_ATD_ID','=', $atd )
        ->leftJoin( 'IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID','IMB_ATENDENTEUNIDADE.IMB_IMB_ID');

        Log::info( $imbs->toSql());

        $imbs = $imbs->get();

        return $imbs;
    }
    public function atendentePerfilLead( $id )
    {
        $atls = mdlAtendentePerfilLead::select(
            [
                'IMB_ATENDENTEPERFILLEAD.*',
                DB::raw( 'imovel( IMB_IMV_ID ) AS ENDERECO'),

            ]
        )->where( 'IMB_ATD_ID','=', $id )->get();

        return response()->json( $atls, 200 );

    }

    public function perfilAtmNegocio ($id )
    {
        $negs = mdlNegocio::select(
                [
                    'IMB_NEG_ID',
                    'IMB_NEG_DESCRICAO',
                    DB::raw( "case when exists( select IMB_ATL_ID FROM IMB_ATENDENTEPERFILLEADNEGOCIO 
                            WHERE IMB_ATENDENTEPERFILLEADNEGOCIO.IMB_NEG_ID = IMB_NEGOCIO.IMB_NEG_ID
                            AND  IMB_ATENDENTEPERFILLEADNEGOCIO.IMB_ATL_ID = $id ) then 'selected' 
                            END as selection")
                ]
            )->get();
            
    
        return  $negs;
    
    
    
    }
    public function perfilAtmTipoImovel($id )
    {
        $negs = mdlTipoImovel::select(
                [
                    'IMB_TIM_ID',
                    'IMB_TIM_DESCRICAO',
                    DB::raw( "case when exists( select IMB_ATI_ID FROM IMB_ATENDENTEPERFILLEADTIPIMO
                            WHERE IMB_ATENDENTEPERFILLEADTIPIMO.IMB_TIM_ID = IMB_TIPOIMOVEL.IMB_TIM_ID
                            AND  IMB_ATENDENTEPERFILLEADTIPIMO.IMB_ATL_ID = $id ) then 'selected' 
                            END as selection")
                ]
            )->get();
            
    
        return  $negs;
    
    
    
    }

    public function perfilAtmCondominio( $id )
    {
        $negs = mdlCondominio::select(
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    DB::raw( "case when exists( select IMB_ATC_ID FROM IMB_ATENDENTEPERFILLEADCONDOM
                            WHERE IMB_ATENDENTEPERFILLEADCONDOM.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID
                            AND  IMB_ATENDENTEPERFILLEADCONDOM.IMB_ATL_ID = $id ) then 'selected' 
                            END as selection")
                ]
            )->get();
            
    
        return  $negs;
       
    
    }

    public function perfilAtmBairro( $id )
    {
        $negs = mdlBairro::select(
                [
                    'CEP_BAI_ID',
                    'CEP_BAI_NOME',
                    DB::raw( "case when exists( select IMB_ATB_ID FROM IMB_ATENDENTEPERFILLEADBAIRRO
                            WHERE IMB_ATENDENTEPERFILLEADBAIRRO.CEP_BAI_ID = CEP_BAIRRO.CEP_BAI_ID
                            AND  IMB_ATENDENTEPERFILLEADBAIRRO.IMB_ATL_ID = $id ) then 'selected' 
                            END as selection")
                ]
            )->get();
            
    
        return  $negs;
       
    
    }

    public function apagarPerfis( $idatd )
    {
        log::info( 'apagar os perfis. '.$idatd );
        $perld = mdlAtendentePerfilLead::where( 'IMB_ATD_ID','=', $idatd )->delete();
        return response()->json('OK',200);
    }

    public function gravarPerfilAtd( Request $request )
    {

        $IMB_ATD_ID                    = $request->IMB_ATD_ID;
        $IMB_ATL_FAIXAINICIALPRECO      = $request->IMB_ATL_FAIXAINICIALPRECO;
        $IMB_ATL_FAIXAFINALPRECO         = $request->IMB_ATL_FAIXAFINALPRECO;
       
        $tipos                          = $request->tipos;
        $atuas                          = $request->atua;
        $bairros                        = $request->bairros;
        $condominios                    = $request->condominios;

    ///    $perld = mdlAtendentePerfilLead::where( 'IMB_ATD_ID','=', $IMB_ATD_ID )->delete();


        Log::info( '--------------------------------------------------------------');
        Log::info( '*** Inicio: '.$IMB_ATL_FAIXAINICIALPRECO);
        $perld = new mdlAtendentePerfilLead;
        $perld->IMB_ATD_ID = $IMB_ATD_ID;
        $perld->IMB_ATL_FAIXAINICIALPRECO = $IMB_ATL_FAIXAINICIALPRECO;
        $perld->IMB_ATL_FAIXAFINALPRECO = $IMB_ATL_FAIXAFINALPRECO;
        $perld->IMB_ATL_DTHATIVO = date('Y/m/d');
        $perld->save();
        Log::info( '*** Salvei');

        for ($i = 0; $i < count($tipos); $i++) 
        {
            Log::info( '*** Tipo: '.$tipos[ $i ]);
            $pertip = new mdlAtendentePerfilLeadTipImo;
            $pertip->IMB_TIM_ID = $tipos[ $i ];
            $pertip->IMB_ATL_ID = $perld->IMB_ATL_ID;
            $pertip->save();
        }


        for ($i = 0; $i < count($atuas); $i++) 
        {
            Log::info( '*** Atuacao: '.$atuas[ $i ]);
            $peratua =  new mdlAtendentePerfilLeadNeg;
            $peratua->IMB_ATL_ID  = $perld->IMB_ATL_ID;
            $peratua->IMB_NEG_ID  = $atuas[ $i ];
            $peratua->save();
        }
        
        
        if ( $bairros  <> '' )
        {
            for ($i = 0; $i < count($bairros); $i++) 
            {
                $perbai =  new mdlAtendentePerfilLeadBairro;
                $perbai->IMB_ATL_ID  = $perld->IMB_ATL_ID;
                $perbai->CEP_BAI_ID  = $bairros[ $i ];
                $perbai->save();
            }
        }
        Log::info( "passei pelo bairro");

        if( $condominios <> '' )
        {
            
            for ($i = 0; $i < count($condominios); $i++) 
            {
                $perbai =  new mdlAtendentePerfilLeadCondom;
                $perbai->IMB_ATL_ID  = $perld->IMB_ATL_ID;
                $perbai->IMB_CND_ID  = $condominios[ $i ];
                $perbai->save();
            }
        }
        Log::info( "passei pelo condominio");


    }

    public function cargaTipoAtendente()
    {
        $ta = mdlTipoAtendente::all();
        return $ta;
        
    }


        


}
