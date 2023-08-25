<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAtd;
use App\mdlAtendimentoAgenda;
use App\mdlTmpImoveisSelecionados;
use App\mdlAtendimentoImoveis;
use DataTables;
use DB;
use App\User;
use Auth;


class ctrAtendimento extends Controller
{
    
    public function __construct()
    {

        $this->middleware('auth');
    }
    
    

    public function index( Request $request)
    {

        if( $request->filtroatendimento) 
            session()->put( 'filtroatendimento', $request->filtroatendimento);      
        if( $request->filtroatendimento) 
            session()->put( 'atendimentostatus', $request->atendimentostatus);      
        

        return view('atendimento.atdindex');
   }
   

   public function atendimento( Request $request )
   {
     $id = $request->input('id');
    
     return view('atendimento.atendimento', compact( 'id') );

  }
  

  public function buscarAtendimento( $id )
  {
    $atendimento = mdlAtd::Select
    (
        [   'VIS_ATENDIMENTO.IMB_ATM_DTHINICIO',
            'VIS_ATENDIMENTO.IMB_ATM_DTHFIM',
            'IMB_CLIENTE.IMB_CLT_NOME',
            'IMB_CLIENTE.IMB_CLT_ID',
            'IMB_CLIENTE.IMB_CLT_EMAIL',
            'IMB_CLIENTE.IMB_CLT_RG',
            'IMB_CLIENTE.IMB_CLT_CPF',
            'IMB_ATD_NOME',
            'VIS_ATENDIMENTO.IMB_ATD_ID',
            'VIS_ATENDIMENTO.VIS_ATM_ID'
        ]
    )
    ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')
    ->leftJoin('IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTO.IMB_ATD_ID')
    ->where( 'VIS_ATENDIMENTO.VIS_ATM_ID',$id)
    ->get();

    //dd( $atendimento );
    return $atendimento->toJson();

 }
 

 
   public function imoveis( Request $request )
   {


//    $selecionados = mdlTmpImoveisSelecionados::all();
    
    /*     foreach( $selecionados as $sel )
        {
             $ati = new mdlAtendimentoImoveis;
             $ati->IMB_IMV_ID = $sel->IMB_IMV_ID;
             $ati->VIS_ATM_ID = $idatd;
             $ati->save();
         }
         */
         return response( "ok",200); 
 
   }
   public function reabrir( Request $request )
   {

        $id = $request->input( 'VIS_ATM_ID');      
        $idfun = $request->input( 'IMB_ATD_ID');      

        $atd = mdlAtd::find( $id );
        $atd->IMB_ATM_DTHFIM            = null;
        $atd->IMB_ATD_IDFECHAMENTO      =  null;
        $atd->save();


        return response('ok',200);



   }


   public function store( Request $request )
   {

        $idatd = $request->input( 'IMB_ATD_ID');      
        $idclt = $request->input( 'IMB_CLT_ID');      
        
        date_default_timezone_set('America/Sao_Paulo');

         $atendimentos = new mdlAtd;
         $atendimentos->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
         $atendimentos->IMB_CLT_ID = $idclt;
         $atendimentos->IMB_ATD_IDCADASTRO= Auth::user()->IMB_ATD_ID;
         $atendimentos->IMB_ATD_ID= $idatd;
         $atendimentos->IMB_ATM_PERPECTIVA='1';
         $atendimentos->VIS_ATM_FORMA='C';
         $atendimentos->VIS_ATM_DATAATUALIZACAO = date( 'Y-m-d' );
         $atendimentos->save();


         //Gravar primeiro registro na agenda
         $ata = new mdlAtendimentoAgenda;
         $ata->IMB_ATD_ID       = $idatd;
         $ata->VIS_ATM_ID       = $atendimentos->VIS_ATM_ID;
         $ata->VIS_ATA_DATA      = date( 'Y-m-d' );
         $ata->VIS_ATA_HORA      = $request->VIS_ATA_HORA;
         $ata->VIS_ATD_IDINICIO  = $idatd;
         $ata->VIS_ATA_OBSERVACOES  ='Abertura de Atendimento';
         $ata->VIS_PRI_ID  = '0';
         $ata->VIS_ATM_FORMA  = 'I';
         $ata->VIS_ATS_ID  = '0';
         $ata->save();


        //salvar os imoveis selecionados parao atendimetno
        $tis = mdlTmpImoveisSelecionados::all();
        ///where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID);

        foreach( $tis as $ti)
        {
            $is = new mdlAtendimentoImoveis;
            $is->VIS_ATM_ID = $atendimentos->VIS_ATM_ID;
            $is->IMB_IMV_ID = $ti->IMB_IMV_ID;
            $is->save();
        }
        
        $this->limparSelecao( 1 );  //o 1 é irrelevante

         return response( $atendimentos->VIS_ATM_ID  ,200); 
 
   }

   public function save( Request $request )
   {

        $id     = $request->input( 'VIS_ATM_ID');      
        $idatd  = $request->input( 'VIS_ATD_ID');      
        

        $atd = mdlAtd::find( $id );
        $atd->IMB_ATM_DTHFIM            = $request->IMB_ATM_DTHFIM;

        $atd->IMB_ATM_PERPECTIVA        =  $request->input( 'IMB_ATM_PERPECTIVA');
        $atd->IMB_ATM_OBSERVACAO        =  $request->input( 'IMB_ATM_OBSERVACAO');
        $atd->VIS_ATM_AVISAR            =  $request->input( 'IMB_ATM_AVISAR');
        $atd->VIS_ATM_NADAENCONTRADO    =  $request->input( 'IMB_ATM_NADAENCONTRATO');
        $atd->IMB_ATD_IDFECHAMENTO      =  $request->input( 'IMB_ATD_IDFECHAMENTO');
        $atd->save();


        DB::delete('delete from TMP_IMOVEISSELECIONADOS where IMB_ATD_ID = ?',[$idatd]);
    
        return response('ok',200);
   }

   public function clienteAdd()
   {

      return view('atendimento.newcliente');
  }
  
  public function list( Request $request )
   {
        
//          dd( 'empresa: '.$request->empresamaster. 
  //        ' - Nome: '.$request->nome );

              $vertudo= app('App\Http\Controllers\ctrDireitos')
                    ->checarDireitoPHP( $usuariologado,'205', '1' );
                    //205 ver clientes de outros corretores


    
            $atendimentos= mdlAtd::select( 
            [
                'VIS_ATM_ID',
                'IMB_ATM_DTHINICIO',
                'IMB_ATM_DTHFIM',
                'IMB_CLT_NOME',
                DB::raw( '( select VIS_PRI_NOME FROM VIS_ATENDIMENTOPRIORIDADE 
                            WHERE VIS_ATENDIMENTO.VIS_PRI_ID = VIS_ATENDIMENTOPRIORIDADE.VIS_PRI_ID ) AS VIS_PRI_NOME' )
            ]
            )
            ->where('VIS_ATENDIMENTO.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')

            ->orderBy( 'IMB_ATM_DTHINICIO','DESC');

    //        dd(Auth::user()->IMB_ATD_ID);
            $cFiltrou = 'S';

            $rDataIni = implode("-", array_reverse(explode("/", trim($request->inicio) ) ) );
            $rDataFim = implode("-", array_reverse(explode("/", trim($request->termino) ) ) );

        //dd( 'Data Inicial: '.$rDataIni.' - '.$rDataFim);

        $atendimentos->where( 'VIS_ATENDIMENTO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID);

        if( $request->somenteaberto == 'S' )
        {
            $cFiltrou = 'S';
            $atendimentos->whereNull('IMB_ATM_DTHFIM');
        }

        if ($request->has('id') && strlen(trim($request->id)) > 0)
        {
            $cFiltrou = 'S';
            $atendimentos->where('VIS_ATM_ID', $request->id);            
        }

        if ($request->has('nome') && strlen(trim($request->nome)) > 0){
            $cFiltrou = 'S';
            $atendimentos->whereRaw("IMB_CLT_NOME LIKE '%{$request->nome}%'");
        }

        if ($request->has('inicio') && strlen(trim($request->inicio)) > 1 &&
           $request->has('termino') && strlen(trim($request->termino)) > 1 )
        {
            $cFiltrou = 'S';

            $atendimentos->whereRaw( DB::raw("exists( SELECT VIS_ATA_ID FROM VIS_ATENDIMENTOAGENDA
            WHERE VIS_ATENDIMENTOAGENDA.VIS_ATM_ID = VIS_ATENDIMENTO.VIS_ATM_ID
            AND VIS_ATA_DATA  between '".$rDataIni."' AND '".$rDataFim."')" ));
            //$atendimentos->whereRaw("IMB_ATM_DTHINICIO  between '".$rDataIni." 00:00:00' and '".$rDataFim." 23:59:59'");
        }

        

        //dd( $atendimentos);

//        using datetime >= '2009-10-20 00:00:00' AND datetime <= '2009-10-20 23:59:59'

        if ( $cFiltrou == 'N') {
            $atendimentos->limit(0);
        }

//        return 'filtrou '.$cFiltrou;
        return DataTables::of($atendimentos)->make(true);
    }        //


    public function selecionarImoveis( request $request  )
    {
        $idatd = $request->input( 'IMB_ATD_ID');      
        $id = $request->input( 'IMB_IMV_ID');      

        $selecionado = mdlTmpImoveisSelecionados::where('IMB_IMV_ID', '=', $id )
//        ->where( 'IMB_ATD_ID', '=', $idatd)
        ->first();
        if ($selecionado == null)
        {
            $adicionado = new mdlTmpImoveisSelecionados;
            $adicionado->IMB_IMV_ID = $id;
            $adicionado->IMB_ATD_ID = $idatd;
            $adicionado->save();
            return response()->json( 'ok',200); 
        }
        else
            return response()->json( 'error',404); 

        
     }        //

     public function cargaSelecionados()
     {
       
         $imoveis = mdlTmpImoveisSelecionados::select( 
             [
                 'IMB_IMV_ID',
                 'IMB_IMS_ID',
                 DB::raw('( SELECT IMB_IMV_REFERE FROM IMB_IMOVEIS 
                 WHERE IMB_IMOVEIS.IMB_IMV_ID = TMP_IMOVEISSELECIONADOS.IMB_IMV_ID)
                  AS IMB_IMV_REFERE'),
                  DB::raw('( SELECT IMB_IMV_CHABOX FROM IMB_IMOVEIS 
                            WHERE IMB_IMOVEIS.IMB_IMV_ID=TMP_IMOVEISSELECIONADOS.IMB_IMV_ID) AS IMB_IMV_CHABOX'),
                  DB::raw('( SELECT imovel( TMP_IMOVEISSELECIONADOS.IMB_IMV_ID ) ) AS ENDERECO'),
                  DB::Raw(' CASE
                                WHEN EXISTS( SELECT IMB_CCH_ID FROM IMB_CONTROLECHAVE
                            WHERE IMB_CONTROLECHAVE.IMB_IMV_ID = TMP_IMOVEISSELECIONADOS.IMB_IMV_ID
                            AND IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA IS NOT NULL 
                            AND IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA IS NULL ) THEN "Indisponível"
                            ELSE "Disponível"
                             END AS SITUACAOCHAVE')
                 ])
                 ->where( 'IMB_ATD_ID', '=', Auth::user()->IMB_ATD_ID )
                 ->get();
 
         return $imoveis->toJson();
    }
       
    public function cargaSelecionadosEfetivos( Request $request )
    {
      
        $imoveis = mdlAtendimentoImoveis::select(
            [
                'IMB_IMV_ID',
                'VIS_ATM_ID',
                'VIS_ATI_ID',
                DB::raw('( SELECT IMB_IMV_REFERE FROM IMB_IMOVEIS 
                WHERE IMB_IMOVEIS.IMB_IMV_ID = VIS_ATENDIMENTOIMOVEIS.IMB_IMV_ID)
                 AS IMB_IMV_REFERE'),
                DB::raw('( SELECT imovel( VIS_ATENDIMENTOIMOVEIS.IMB_IMV_ID ) ) AS ENDERECO')
                ])
                ->where( 'VIS_ATM_ID', '=', $request->VIS_ATM_ID )
                ->get();

        return $imoveis->toJson();
   }
      
   public function apagarImvSelecEfetivo(  request $request )
    {

        $selecionado = mdlAtendimentoImoveis::where('VIS_ATI_ID', '=', $request->VIS_ATI_ID )->delete();

        return response()->json('ok',200);


   }

   public function apagarImvSelec(  request $request )
    {

        $id = $request->input( 'IMB_IMS_ID');      

        $selecionado = mdlTmpImoveisSelecionados::find( $id );
        $selecionado->delete();

        return response()->json( 'ok',200 );


   }


   public function limparSelecao( $idatd )
   {
   
    $selecionado = mdlTmpImoveisSelecionados::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();

    return response()->json( 'ok',200);
    
    }

    public function qAbertos( $idatd )
    {
    
 
        $lf = mdlAtd::where('IMB_ATD_ID', '=' , $idatd )
                ->where('IMB_ATM_DTHFIM',null)
                ->get()->count();

        return $lf;

    }

    public function listarImovelAtdImvClt( $idatendente, $idcliente )
    {

        $atendimentos= mdlAtd::select( 
        [
            'VIS_ATM_ID',
            'IMB_ATM_DTHINICIO',
            'IMB_ATM_DTHFIM',
            'IMB_CLT_NOME',
            'IMB_ATD_NOME'
        ]
        );


        if( $idatendente <>'0' )
        {
            $atendimentos->where( 'VIS_ATENDIMENTO.IMB_ATD_ID','=',$idatendente );
        }

        if( $idcliente <>'0' )
        {
            $atendimentos->where( 'VIS_ATENDIMENTO.IMB_CLT_ID','=',$idcliente );
        }

        $atendimentos->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')
                     ->leftJoin('IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTO.IMB_ATD_ID')
                     ->orderBy( 'IMB_ATM_DTHINICIO','DESC');
 
 //        return 'filtrou '.$cFiltrou;
         return DataTables::of($atendimentos)->make(true);
     }        //

     public function idUltimoAtendimento( $cliente )
     {
         $idatm = mdlAtd::select(DB::raw('max(VIS_ATM_ID) as id'))
         ->where('IMB_CLT_ID','=', $cliente )
         ->first();

         return $idatm->id;
     }

     public function ultimoAtendimento( $id )
     {
         $idultimo = $this->idUltimoAtendimento( $id );


         $atm = mdlAtd::select(
            [
                'VIS_ATENDIMENTO.IMB_CLT_ID',
                'VIS_ATENDIMENTO.VIS_ATM_ID',
                'VIS_ATENDIMENTO.IMB_ATD_ID',
                'VIS_ATENDIMENTO.IMB_ATD_IDCADASTRO',
                'VIS_ATENDIMENTO.IMB_ATM_DTHINICIO',
                'VIS_ATENDIMENTO.IMB_ATM_DTHFIM',
                'VIS_ATENDIMENTO.IMB_ATM_PERPECTIVA',
                'VIS_ATENDIMENTO.IMB_ATM_OBSERVACAO',
                'VIS_ATENDIMENTO.VIS_ATM_FORMA',
                'VIS_ATENDIMENTO.IMB_ATD_IDFECHAMENTO',
                'VIS_ATENDIMENTO.VIS_ATM_DATAATUALIZACAO',
                'IMB_ATD_NOME',
                'IMB_CLT_NOME',
                'IMB_CLT_EMAIL',
                DB::raw( 'PEGAFONES( VIS_ATENDIMENTO.IMB_CLT_ID ) as FONES ')
            ]
        )
        ->where( 'VIS_ATENDIMENTO.VIS_ATM_ID','=', $idultimo)
        ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTO.IMB_ATD_ID')
        ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')
       ->get();


         return $atm;
     }


     public function atendimentoCliente( $cliente )
     {

         $atm = mdlAtd::select(
             [
                 'IMB_CLT_ID',
                 'IMB_ATD_ID',
                 'IMB_ATD_IDCADASTRO',
                 'IMB_ATM_DTHINICIO',
                 'IMB_ATM_DTHFIM',
                 'IMB_ATM_PERPECTIVA',
                 'IMB_ATM_OBSERVACAO',
                 'VIS_ATM_FORMA',
                 'IMB_ATD_IDFECHAMENTO',
                 'VIS_ATM_DATAATUALIZACAO',
                 'IMB_ATD_NOME',
                 'IMB_CLT_NOME',
                 'IMB_CLT_EMAIL',
                 DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES ')
             ]
         )
         ->where( 'VIS_ATENDIMENTO.IMB_CLT_ID','=', $cliente)
         ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTO.IMB_ATD_ID')
         ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')
        ->get();

         return $atm;
     }
  

   
          
    
 }
