<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlSolicitacoes;
use App\mdlTipoSolicitacao;
use App\mdlSolicitacoesEventos;


use DataTables;
use Auth;
use DB;
use Log;

class ctrSolicitacoes extends Controller
{

        public function __construct()

    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view( 'solicitacoes.solicitacoesindex');

    }


    public function list( Request $request)

    {
        $sol = mdlSolicitacoes::select(
            [
                'IMB_SOLICITACAO.IMB_SOL_ID' ,
                'IMB_SOL_PROTOCOLO',
                'IMB_SOLICITACAO.IMB_ATD_ID' ,
                'IMB_SOL_DTHATIVO',
                'IMB_SOL_DTHINATIVO',
                'IMB_ATD_IDDESTINO',
                'IMB_SOL_DTHVISUALIZACAO',
                'IMB_CLT_IDABERTURA',
                DB::raw('( select IMB_ATD_NOME FROM IMB_ATENDENTE WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_SOLICITACAO.IMB_ATD_ID)  AS ATENDENTEABERTURA '),
                DB::raw('( select IMB_ATD_NOME FROM IMB_ATENDENTE WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_SOLICITACAO.IMB_ATD_IDDESTINO)  AS ATENDENTEDESTINO '),
                DB::raw(' coalesce(IMB_CLT_IDLOCADOR,0) AS IMB_CLT_IDLOCADOR'),
                DB::raw('PEGARIMOVELCONTRATO( IMB_SOLICITACAO.IMB_CTR_ID ) ENDERECOIMOVEL'),
                DB::raw('( select IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDLOCADOR)  AS NOMELOCADOR '),
                DB::raw( 'COALESCE(IMB_CLT_IDLOCATARIO,0) AS IMB_CLT_IDLOCATARIO'),
                DB::raw('( select IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDLOCATARIO)  AS NOMELOCATARIO '),
                DB::raw( 'COALESCE(IMB_CLT_IDFIADOR,0) AS IMB_CLT_IDFIADOR ') ,
                DB::raw('( select IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDFIADOR)  AS NOMEFIADOR '),
                'IMB_CLT_IDIMOVEL' ,
                DB::raw( '(select IMB_CTR_REFERENCIA FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_CTR_ID = IMB_SOLICITACAO.IMB_CTR_ID) AS IMB_CTR_REFERENCIA'),
                DB::raw( 'PEGARIMOVELCONTRATO(IMB_SOLICITACAO.IMB_CTR_ID) AS ENDERECOCOMPLETO'),
                'IMB_SOL_CODIGOUNICO',
                'IMB_SOL_CONTATOORIGEM',
                'IMB_SOL_FORMACONTATO',
                'IMB_SOL_DATAPREVISAO',
                'IMB_SOL_TIPOSOLICITACAO',
                'IMB_SOL_TITULO',
                'IMB_SOL_OBSERVACAO',
                'IMB_SOL_DATAFECHAMENTO',
                'IMB_SOL_TIPOSOLICITANTE',
                'IMB_SOL_MOTIVOCANCELAMENTO',
                'IMB_TPS_ID' ,
                DB::raw('( select IMB_TPS_DESCRICAO FROM IMB_TIPOSOLICITACAO
                    WHERE IMB_TIPOSOLICITACAO.IMB_TPS_ID = IMB_SOLICITACAO.IMB_TPS_ID ) AS TIPOSOLICITACAO'),
                    'IMB_SOL_NOTIFICADODATAHORA',
                'EML_MNS_ID',
                'IMB_SOL_PRIORIDADE'


            ]
        )->where( 'IMB_SOLICITACAO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->orderBy( 'IMB_SOL_DTHATIVO');

        $IMB_SOL_ID = $request->IMB_SOL_ID;
        $IMB_CTR_ID = $request->IMB_CTR_ID;
        $datini = $request->datini;
        $datfim = $request->datfim;
        $atdorigem = $request->IMB_ATD_ID ;
        $atddestino = $request->IMB_ATD_IDDESTINO ;
        $abertas = $request->abertas;
       
        if( $IMB_SOL_ID <> '' )
        {
            $sol->where('IMB_SOLICITACAO.IMB_SOL_ID','=', $IMB_SOL_ID );
        }
        else
        {
            if( $IMB_CTR_ID<> '' ) $sol->where('IMB_CTR_ID','=', $IMB_CTR_ID );
            if( $datini <> '' and $datfim <> '' )
            {
                $sol->whereRaw("exists( select IMB_SLE_ID FROM IMB_SOLICITACAOEVENTOS WHERE 
                    IMB_SOLICITACAOEVENTOS.IMB_SOL_ID = IMB_SOLICITACAO.IMB_SOL_ID AND CAST(IMB_SLE_DATAHORA AS DATE)  between  '$datini' and '$datfim')");
            }
            else
            {
             
                if( $datfim == '' ) $datfim = date('Y/m/d');
               // $sol->whereRaw("exists( select IMB_SLE_ID FROM IMB_SOLICITACAOEVENTOS WHERE 
               // IMB_SOLICITACAOEVENTOS.IMB_SOL_ID = IMB_SOLICITACAO.IMB_SOL_ID AND CAST(IMB_SLE_DATAHORA AS DATE)  <= '$datfim')");
               $sol->where('IMB_SOL_DATAPREVISAO','<=', $datfim );
            }


            if( $atdorigem <> '' )
                $sol->where('IMB_SOLICITACAO.IMB_ATD_ID','=', $atdorigem);
        

            if( $atddestino <> '' )
                $sol->where('IMB_ATD_IDDESTINO','=', $atddestino);


        };
 
        
        if( $abertas == 'S') $sol->whereNull( 'IMB_SOL_DATAFECHAMENTO');
//        return $sol->toSql();
    //        return $sol->toSql();
    

        return DataTables::of($sol)->make(true);

        //
    }

    public function cargaTipo()
    {
        $tps = mdlTipoSolicitacao::all();
        return response()->json( $tps,200);
    }
    public function find( $id )
    {   $tps = mdlSolicitacoes::select( [ 
        'IMB_SOLICITACAO.*',
        DB::raw( '       CASE 
        WHEN COALESCE(IMB_CLT_IDLOCADOR,0) <> 0  THEN
         (SELECT IMB_CLT_NOME FROM IMB_CLIENTE  WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDLOCADOR) 
        WHEN COALESCE(IMB_CLT_IDLOCATARIO,0) <> 0 THEN
         (SELECT IMB_CLT_NOME FROM IMB_CLIENTE  WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDLOCATARIO) 
        WHEN COALESCE(IMB_CLT_IDFIADOR,0) <> 0 THEN
         (SELECT IMB_CLT_NOME FROM IMB_CLIENTE  WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDFIADOR) 			  			 
    END AS NOMECLIENTE'),
        
        DB::raw( 'CASE 
        WHEN COALESCE(IMB_CTR_ID, 0)<>0 THEN (SELECT PEGARIMOVELCONTRATO(IMB_SOLICITACAO.IMB_CTR_ID))
        WHEN COALESCE(IMB_CLT_IDIMOVEL, 0)<>0 THEN (SELECT IMOVEL(IMB_SOLICITACAO.IMB_CLT_IDIMOVEL))
        END AS ENDERECOIMOVEL'),
        DB::raw( '( SELECT IMB_CTR_REFERENCIA FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_CTR_ID = IMB_SOLICITACAO.IMB_CTR_ID) AS IMB_CTR_REFERENCIA')
          ])
          ->where('IMB_SOL_ID','=', $id);
        
        Log::info( $tps->toSql());
        $tps = $tps->first();
        return response()->json( $tps,200);
    }

    public function store( Request $request)
    {
        $IMB_SOL_ID = $request->IMB_SOL_ID;
        $IMB_CLT_ID = $request->IMB_CLT_ID;
        $IMB_SOL_TIPOSOLICITANTE = $request->IMB_SOL_TIPOSOLICITANTE;
        $IMB_SOL_TITULO = $request->IMB_SOL_TITULO;
        $IMB_SOL_DTHATIVO = app('App\Http\Controllers\ctrRotinas')->formatarData($request->IMB_SOL_DTHATIVO);
        $IMB_SOL_DATAPREVISAO = app('App\Http\Controllers\ctrRotinas')->formatarData($request->IMB_SOL_DATAPREVISAO);
        $IMB_TPS_ID = $request->IMB_TPS_ID;
        $IMB_ATD_IDDESTINO = $request->IMB_ATD_IDDESTINO;
        $IMB_SOL_OBSERVACAO = $request->IMB_SOL_OBSERVACAO;
        $IMB_CTR_ID = $request->IMB_CTR_ID;
        $IMB_CLT_IDLOCADOR = $request->IMB_CLT_IDLOCADOR;
        $IMB_CLT_IDLOCATARIO= $request->IMB_CLT_IDLOCATARIO;
        $IMB_CLT_IDFIADOR = $request->IMB_CLT_IDFIADOR;
        $IMB_SOL_PRIORIDADE = $request->IMB_SOL_PRIORIDADE;
        $IMB_ATD_IDNOTIFEXTRA = $request->IMB_ATD_IDNOTIFEXTRA;
        $IMB_SOL_PUBLICA = $request->IMB_SOL_PUBLICA;


        if( $IMB_SOL_ID == '' )
            $sol = new mdlSolicitacoes;
        else
            $sol =  mdlSolicitacoes::find( $IMB_SOL_ID );


        $sol->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $sol->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $sol->IMB_SOL_ID = $IMB_SOL_ID;
        $sol->IMB_CTR_ID = $IMB_CTR_ID;
        $sol->IMB_CLT_ID = $IMB_CLT_ID;
        $sol->IMB_SOL_TIPOSOLICITANTE = $IMB_SOL_TIPOSOLICITANTE;
        $sol->IMB_SOL_TITULO = $IMB_SOL_TITULO;
        $sol->IMB_SOL_DTHATIVO = app('App\Http\Controllers\ctrRotinas')->formatarData($IMB_SOL_DTHATIVO);
        if( $request->IMB_SOL_DATAPREVISAO <> '' )
            $sol->IMB_SOL_DATAPREVISAO = app('App\Http\Controllers\ctrRotinas')->formatarData($IMB_SOL_DATAPREVISAO);
        $sol->IMB_TPS_ID = $IMB_TPS_ID;
        $sol->IMB_ATD_IDDESTINO = $IMB_ATD_IDDESTINO;
        $sol->IMB_SOL_OBSERVACAO = $IMB_SOL_OBSERVACAO;
        $sol->IMB_CLT_IDLOCADOR = $IMB_CLT_IDLOCADOR;
        $sol->IMB_CLT_IDLOCATARIO = $IMB_CLT_IDLOCATARIO;
        $sol->IMB_CLT_IDFIADOR = $IMB_CLT_IDFIADOR;
        $sol->IMB_SOL_PRIORIDADE = $IMB_SOL_PRIORIDADE;
        $sol->IMB_ATD_IDNOTIFEXTRA = $IMB_ATD_IDNOTIFEXTRA;


        $sol->save();

        if( $IMB_SOL_ID == '' )
        {
            $sle =new  mdlSolicitacoesEventos;
            $sle->IMB_SOL_ID =  $sol->IMB_SOL_ID;
            $sle->IMB_SLE_DESCRICAO = $IMB_SOL_OBSERVACAO;
            $sle->IMB_SLE_DATAHORA = app('App\Http\Controllers\ctrRotinas')->formatarData($IMB_SOL_DTHATIVO);
            $sle->IMB_SLE_ATD_ID = Auth::user()->IMB_ATD_ID;
            $sle->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $sle->save();
        }


        return response()->json('Gravado',200);

    }

    public function solicitacoesEventos( $id )
    {
        $sle = mdlSolicitacoesEventos::select(
            [
                'IMB_SOL_ID',
	            'IMB_SLE_ID',
	            'IMB_SLE_DATAHORA',
	            'IMB_SLE_ATD_ID',
	            'IMB_SLE_DESCRICAO',
                'IMB_ATD_NOME'
            ]
        )
        ->where( 'IMB_SOL_ID','=', $id )
        ->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID','=', 'IMB_SOLICITACAOEVENTOS.IMB_SLE_ATD_ID')
        ->orderBy( 'IMB_SLE_DATAHORA')
        ->get();




        return response()->json($sle,200);

    }

    public function solicitacoesEventosSalvar( Request $request )
    {
        $IMB_SOL_ID = $request->IMB_SOL_ID;
        $IMB_SLE_DESCRICAO = $request->IMB_SLE_DESCRICAO;
        $fechamento = $request->fechamento;
        $reabrir = $request->reabrir;

        if( $fechamento == 'S' )
        {
            $tps = mdlSolicitacoes::find( $IMB_SOL_ID );
            $tps->IMB_SOL_DATAFECHAMENTO = date( 'Y/m/d');
            $tps->save();
            $IMB_SLE_DESCRICAO = 'Encerramento';
        }

        if( $reabrir == 'S' )
        {
            $tps = mdlSolicitacoes::find( $IMB_SOL_ID );
            $tps->IMB_SOL_DATAFECHAMENTO = null;
            $tps->save();
            $IMB_SLE_DESCRICAO = 'Reabrindo o chamado';
        }


        $sle =new  mdlSolicitacoesEventos;
        $sle->IMB_SOL_ID = $IMB_SOL_ID;
        $sle->IMB_SLE_DESCRICAO = $IMB_SLE_DESCRICAO;
        $sle->IMB_SLE_DATAHORA = date( 'Y/m/d H:i');
        $sle->IMB_SLE_ATD_ID = Auth::user()->IMB_ATD_ID;
        $sle->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $sle->save();

        return response()->json( 'ok',200);
    }

    public function solicitacoesComEventosContrato( Request $request )
    {
        $id = $request->IMB_SOL_ID;

        $sol = mdlSolicitacoes::select(
        [
            'IMB_SLE_DESCRICAO',
            'IMB_SLE_DATAHORA',
            'IMB_SOLICITACAO.IMB_SOL_ID' ,
            'IMB_SOL_PROTOCOLO',
            'IMB_SOLICITACAO.IMB_ATD_ID' ,
            'IMB_SOL_DTHATIVO',
            'IMB_SOL_DTHINATIVO',
            'IMB_ATD_IDDESTINO',
            'IMB_SOL_DTHVISUALIZACAO',
            'IMB_CLT_IDABERTURA',
            'IMB_SOLICITACAO.IMB_CTR_ID',
            DB::raw('( select IMB_ATD_NOME FROM IMB_ATENDENTE WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_SOLICITACAO.IMB_ATD_ID)  AS ATENDENTEABERTURA '),
            DB::raw('( select IMB_ATD_NOME FROM IMB_ATENDENTE WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_SOLICITACAO.IMB_ATD_IDDESTINO)  AS ATENDENTEDESTINO '),
            DB::raw(' coalesce(IMB_CLT_IDLOCADOR,0) AS IMB_CLT_IDLOCADOR'),
            DB::raw('PEGARIMOVELCONTRATO( IMB_SOLICITACAO.IMB_CTR_ID ) ENDERECOIMOVEL'),
            DB::raw('( select IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDLOCADOR)  AS NOMELOCADOR '),
            DB::raw( 'COALESCE(IMB_CLT_IDLOCATARIO,0) AS IMB_CLT_IDLOCATARIO'),
            DB::raw('( select IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDLOCATARIO)  AS NOMELOCATARIO '),
            DB::raw( 'COALESCE(IMB_CLT_IDFIADOR,0) AS IMB_CLT_IDFIADOR ') ,
            DB::raw('( select IMB_CLT_NOME FROM IMB_CLIENTE WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_SOLICITACAO.IMB_CLT_IDFIADOR)  AS NOMEFIADOR '),
            'IMB_CLT_IDIMOVEL' ,
            DB::raw( '(select IMB_CTR_REFERENCIA FROM IMB_CONTRATO WHERE IMB_CONTRATO.IMB_CTR_ID = IMB_SOLICITACAO.IMB_CTR_ID) AS IMB_CTR_REFERENCIA'),
            DB::raw( 'PEGARIMOVELCONTRATO(IMB_SOLICITACAO.IMB_CTR_ID) AS ENDERECOCOMPLETO'),
            'IMB_SOL_CODIGOUNICO',
            'IMB_SOL_CONTATOORIGEM',
            'IMB_SOL_FORMACONTATO',
            'IMB_SOL_DATAPREVISAO',
            'IMB_SOL_TIPOSOLICITACAO',
            'IMB_SOL_TITULO',
            'IMB_SOL_OBSERVACAO',
            'IMB_SOL_DATAFECHAMENTO',
            'IMB_SOL_TIPOSOLICITANTE',
            'IMB_SOL_MOTIVOCANCELAMENTO',
            'IMB_TPS_ID' ,
            DB::raw('( select IMB_TPS_DESCRICAO FROM IMB_TIPOSOLICITACAO
                WHERE IMB_TIPOSOLICITACAO.IMB_TPS_ID = IMB_SOLICITACAO.IMB_TPS_ID ) AS TIPOSOLICITACAO'),
                'IMB_SOL_NOTIFICADODATAHORA',
            'EML_MNS_ID',
            'IMB_SOL_PRIORIDADE'
        ]
        )->where( 'IMB_SOLICITACAO.IMB_CTR_ID','=',$id )
        ->leftJoin( 'IMB_SOLICITACAOEVENTOS','IMB_SOLICITACAOEVENTOS.IMB_SOL_ID','IMB_SOLICITACAO.IMB_SOL_ID')
        ->orderBy( 'IMB_SOL_DTHATIVO');

//        dd( $sol->get() );
        return DataTables::of($sol)->make(true);


    }

    public function countPendentes()
    {

        $sol = mdlSolicitacoes::where( 'IMB_ATD_IDDESTINO','=', Auth::user()->IMB_IMB_ID )
        ->orWhere( 'IMB_SOL_PUBLICA','=','S')
        ->whereNull( 'IMB_SOL_DATAFECHAMENTO')
        ->whereRaw( 'IMB_SOL_DATAPREVISAO <= now()')->count();
        return $sol;


    }

    public function chamadosNovosPraMimQtde()
    {
        $sol = mdlSolicitacoes::where( 'IMB_ATD_IDDESTINO','=', Auth::user()->IMB_IMB_ID )
        ->whereNull( 'IMB_SOL_DATAFECHAMENTO')
        ->whereRaw( "COALESCE( IMB_SOL_CIENTE,'N') ='N' ")
        ->count();
        
        return $sol;

    }





}
