<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAtendente;
use Illuminate\Support\Facades\Hash;
use Auth;
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


    
    public function list( $empresamaster, $page, $busca)
    {
        $start_from = ($page - 1) * 15;        
        
        if( $busca == 'TODOSTODOSTODOS') $busca='';

        $busca="%$busca%";

        if( $empresamaster == '0')
        {

            if( $busca == '%%' ) 
            {
                $lf =  mdlAtendente::select( 
                    [
                        'IMB_ATD_ID',
                        'IMB_ATD_NOME',
                        'email',
                        'IMB_ATD_TELEFONE_1',
                        'IMB_ATD_DDD1',
                        DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                    ]
                )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
                ->orderBy('IMB_ATD_NOME')
                ->get();
            }
            else
            {
                $lf = 
                mdlAtendente::select( 
                    [
                        'IMB_ATD_ID',
                        'IMB_ATD_NOME',
                        'email',
                        'IMB_ATD_TELEFONE_1',
                        'IMB_ATD_DDD1',
                        DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                    ]
                )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
                ->where( 'IMB_ATD_NOME','LIKE', $busca)
                ->orderBy('IMB_ATD_NOME')
                ->get();                
            }
    
        }
        else
        {

            if( $busca == '%%' ) 
            {
                $lf = mdlAtendente::select( 
                    [
                        'IMB_ATD_ID',
                        'IMB_ATD_NOME',
                        'email',
                        'IMB_ATD_TELEFONE_1',
                        'IMB_ATD_DDD1',
                        DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                    ]
                )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
                ->where( 'IMB_ATENDENTE.IMB_IMB_ID', '=', $empresamaster )
                ->orderBy('IMB_ATD_NOME')
                ->get();

            }
            else
            {
                $lf = mdlAtendente::select( 
                    [
                        'IMB_ATD_ID',
                        'IMB_ATD_NOME',
                        'email',
                        'IMB_ATD_TELEFONE_1',
                        'IMB_ATD_DDD1',
                        DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                    ]
                )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
                ->where( 'IMB_ATD_NOME','LIKE', $busca)
                ->where( 'IMB_ATENDENTE.IMB_IMB_ID', '=', $empresamaster )
                ->orderBy('IMB_ATD_NOME')
                ->get();                
                   
            }
        }

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
        $atd->IMB_ATD_NOME  = $request->input('IMB_ATD_NOME');
        $atd->IMB_ATD_APELIDO = 'BRANCO';//$request->input('IMB_ATD_USUARIO');
        $atd->IMB_ATD_EMAIL = $request->input('IMB_ATD_EMAIL');
        $atd->IMB_ATD_TELEFONE_1 = $request->input('IMB_ATD_TELEFONE_1','0');
        $atd->IMB_ATD_TELEFONE_2 = $request->input('IMB_ATD_TELEFONE_2','0');
        $atd->IMB_ATD_DDD1 = $request->input('IMB_ATD_DDD1','0');
        $atd->IMB_ATD_DDD2 = $request->input('IMB_ATD_DDD2','0');
        $atd->IMB_ATD_TELTIPO1 = $request->input('IMB_ATD_TELTIPO1');
        $atd->IMB_ATD_TELTIPO2 = $request->input('IMB_ATD_TELTIPO2');
        $atd->IMB_ATP_ID                =  $request->input('IMB_ATP_ID');

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
        $atd->save();
        
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
        //$atd->IMB_ATD_APELIDO = $request->input('IMB_ATD_USUARIO');
        $atd->IMB_ATD_EMAIL             = $request->input('IMB_ATD_EMAIL');
        $atd->IMB_ATD_TELEFONE_1        = $request->input('IMB_ATD_TELEFONE_1','0');
        $atd->IMB_ATD_TELEFONE_2        = $request->input('IMB_ATD_TELEFONE_2','0');
        $atd->IMB_ATD_DDD1              = $request->input('IMB_ATD_DDD1','0');
        $atd->IMB_ATD_DDD2              = $request->input('IMB_ATD_DDD2','0');
        $atd->IMB_ATD_SOMENTECOMERCIAL  =  $request->input('IMB_ATD_SOMENTECOMERCIAL');
        $atd->IMB_ATP_ID                =  $request->input('IMB_ATP_ID');

         
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
        //
    }


    public function buscaTodosJson( $empresa )
    {
        
        if( $empresa == '0' )
        {
        
            $atendentes = mdlAtendente::select( 
                [
                    'IMB_ATD_ID',
                    'IMB_ATD_NOME',
                    'email',
                    'IMB_ATD_TELEFONE_1',
                    'IMB_ATD_DDD1',
                    DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                ]
            )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
            ->where( 'IMB_ATD_NOME', '<>','')
            ->orderBy('IMB_ATD_NOME')
            ->get();
        }
        else
        {
        
            $atendentes = mdlAtendente::select( 
                [
                    'IMB_ATD_ID',
                    'IMB_ATD_NOME',
                    'email',
                    'IMB_ATD_TELEFONE_1',
                    'IMB_ATD_DDD1',
                    DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS UNIDADE')
                ]
            )->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_ATENDENTE.IMB_IMB_ID')
            ->where( 'IMB_ATD_NOME', '<>','')
            ->whereNull('IMB_ATD_DATADEMISSAO')
            ->where( 'IMB_ATENDENTE.IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID )
                ->orderBy('IMB_ATD_NOME')
            ->get();
        }
            
        
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


}
