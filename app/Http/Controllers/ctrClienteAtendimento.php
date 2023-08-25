<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAtd;
use App\mdlStatusImovel;
use App\mdlCondominio;
use App\mdlTipoImovel;
use App\mdlClienteAtendimento;
use App\mdlObs;
use App\mdlAtendente;
use App\mdlCliente;
use App\mdlLeads;
use DataTables;
use DB; 
use Auth;

class ctrClienteAtendimento extends Controller
{
 
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function novoAtendimento()
    {
        $bairros = DB::table('IMB_IMOVEIS')->distinct()->orderBy('CEP_BAI_NOME')
        ->where( 'IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
        ->get(['CEP_BAI_NOME','IMB_IMV_CIDADE']);

        $status= mdlStatusImovel::orderBy('VIS_STA_NOME','ASC')->get();

        $condominios = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->orderBy('IMB_CND_NOME')
            ->get();

        $tipos= mdlTipoImovel::orderBy('IMB_TIM_DESCRICAO')->get(); 
            

        return view( 'atendimento.ingatendimento', compact('bairros','condominios','tipos','status') );
    }


    public function atendimentoClientes( $id )
   {
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
       ->where( 'VIS_ATENDIMENTO.IMB_CLT_ID','=', $id)
       ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTO.IMB_ATD_ID')
       ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')
       ->orderBy('VIS_ATENDIMENTO.IMB_ATM_DTHINICIO','DESC')
      ->get();
        return $atm;
    }
        

    public function ingAtendimentoClientes( $id, $page )
   {

        $start_from = ($page - 1) * 10;        

        //dd( "$start_from - $page");

    
        $atm = mdlClienteAtendimento::select(
           [

                'IMB_CLIENTEATENDIMENTO.IMB_CLA_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_IDRETORNO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_PRIORIDADE',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATACADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATUALIZACAO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATENDIMENTO',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_COMENTARIO',
                'IMB_ATD_NOME',
                'IMB_CLT_NOME',
                'IMB_CLT_EMAIL',
                DB::raw( 'PEGAFONES( IMB_CLIENTEATENDIMENTO.IMB_CLT_ID ) as FONES ')
           ]
       )
       ->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID','=', $id)
       ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID')
       ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')
       ->orderBy('IMB_CLIENTEATENDIMENTO.IMB_CLA_ID','DESC');

       if( $page <> '0' )
            $atm->limit(10)->offset( $start_from  );

      return DataTables::of($atm)->make(true);
    }
      

    public function gravarNovo( Request $request )
    {
        
        //dd( $request->all() );
        $cliatm = new mdlClienteAtendimento;
        $cliatm->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $cliatm->IMB_ATD_IDCADASTRO = Auth::user()->IMB_ATD_ID;
        $cliatm->IMB_CLT_ID = $request->IMB_CLT_ID;
        $cliatm->IMB_ATD_ID = $request->IMB_ATD_ID;
        $cliatm->IMB_CLA_PRIORIDADE = $request->IMB_CLA_PRIORIDADE;
        $cliatm->IMB_CLA_STATUS = $request->IMB_CLA_STATUS;
        $cliatm->IMB_CLA_DATACADASTRO = date('Y-m-d H:i:s');
        $cliatm->IMB_CLA_DATAATUALIZACAO = date('Y-m-d H:i:s');
        $cliatm->IMB_CLA_DATAATENDIMENTO = $request->IMB_CLA_DATAATENDIMENTO;
        $cliatm->IMB_CLA_COMENTARIO = $request->IMB_CLA_COMENTARIO;
        $cliatm->IMB_CLA_PRETENSAO = $request->IMB_CLA_PRETENSAO;
        $cliatm->IMB_CLA_FINALIDADE = $request->IMB_CLA_FINALIDADE;
        $cliatm->save();

        $cl = mdlCliente::find( $request->IMB_CLT_ID );
        $cl->IMB_CLT_ULTIMOATENDIMENTO= date('Y-m-d H:i:s');
        $cl->IMB_CLT_DTHALTERACAO = date('Y-m-d H:i:s');
        $cl->save();

        return response()->json('ok',200);

    }

    public function corretorDataUltAtm( $id )
    {
        $atm = collect( DB::select("select CorretorUltAtdCliente('$id') as ultimocorretor "))->first()->ultimocorretor;

        return $atm;
    }

    public function dadosUltimoAtdCliente( $id )
    {
        $atm =mdlClienteAtendimento::select( [
            'IMB_CLIENTEATENDIMENTO.*',
            'IMB_ATD_NOME',
            'IMB_ATD_TELEFONE_1',
            'IMB_ATD_TELEFONE_2'

        ])
        ->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID','=',$id )
        ->where('IMB_CLIENTEATENDIMENTO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID','IMB_CLIENTEATENDIMENTO.IMB_ATD_ID')
        ->orderBy( 'IMB_CLA_DATACADASTRO','DESC')
        ->get();

        return $atm;
    }


    public function atmAbertoCorretor( $id )
    {
        $atm = collect( DB::select("select atmAbertoCliente('$id') as atmabertocorcli "))->first()->atmabertocorcli;

        return $atm;
    }    

    public function atmPendentesCorretor( )
    {
            $atm = mdlClienteAtendimento::select(
                [
                    'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                    'IMB_ATD_NOME',
                    'IMB_CLT_NOME',
                    'IMB_CLA_DATAATENDIMENTO',
                    'IMB_CLA_PRIORIDADE',
                    'IMB_ATENDENTE.IMB_ATD_ID',
                    'IMB_CLA_STATUS'
                ]
            )
            ->where( 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID )
            ->where( 'IMB_CLA_STATUS','=','Em atendimento' )
            ->orderBy( 'IMB_CLA_DATAATENDIMENTO')
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')    
            ->leftJoin('IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID')    
            ->get();

        return DataTables::of($atm)->make(true);
    }    


    public function atmPendentesOutroCorretor( )
    {
            $atm = mdlClienteAtendimento::select(
                [
                    'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                    'IMB_ATD_NOME',
                    'IMB_CLT_NOME',
                    'IMB_CLA_DATAATENDIMENTO',
                    'IMB_CLA_PRIORIDADE',
                    'IMB_ATENDENTE.IMB_ATD_ID',
                    'IMB_CLA_STATUS'
                ]
            )
            ->where( 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID','<>',Auth::user()->IMB_ATD_ID )
            ->where( 'IMB_CLIENTE.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_CLA_STATUS','=','Em atendimento' )
            ->orderBy( 'IMB_CLA_DATAATENDIMENTO')
            ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')    
            ->leftJoin('IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID')    
            ->get();

        return DataTables::of($atm)->make(true);
    }    

    public function totalMeusAtendimetos()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->count();

        return $totalatendimentos;

    }
    
    public function totalAtendimetosOutrosCorretores()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','<>', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
        ->count();

        return $totalatendimentos;

    }    



    public function totalMeusAtendimentosFinalizados()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_CLA_COMENTARIO','<>','Cliente Cadastrado')
        ->where( 'IMB_CLA_STATUS','=','Finalizado')
        ->count();

        return $totalatendimentos;
    }
    public function totalMeusAtendimentosEmAberto()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_CLA_COMENTARIO','<>','Cliente Cadastrado')
        ->where( 'IMB_CLA_STATUS','=','Em atendimento')
        ->count();

        return $totalatendimentos;
    }
    
    public function totalMeusAtendimentosAltaPrioridade()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_CLA_COMENTARIO','<>','Cliente Cadastrado')
        ->where( 'IMB_CLA_STATUS','=','Em atendimento')
        ->where( 'IMB_CLA_PRIORIDADE','=','Alta')
        ->count();

        return $totalatendimentos;
    }


    //demais corretores
    public function totalAtendimentosFinalizadosDemaisCorretores()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','<>', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_IMB_ID','<>', Auth::user()->IMB_IMB_ID)
        ->where( 'IMB_CLA_COMENTARIO','<>','Cliente Cadastrado')
        ->where( 'IMB_CLA_STATUS','=','Finalizado')
        ->count();

        return $totalatendimentos;
    }    

    public function totalAtendimentosEmAbertoDemaisCorretores()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','<>', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_IMB_ID','<>', Auth::user()->IMB_IMB_ID)
        ->where( 'IMB_CLA_COMENTARIO','<>','Cliente Cadastrado')
        ->where( 'IMB_CLA_STATUS','=','Em atendimento')
        ->count();

        return $totalatendimentos;
    }
    
    public function totalAtendimentosAltaPrioridadeDemaisCor()
    {
        $totalatendimentos = DB::table('IMB_CLIENTEATENDIMENTO')
        ->where( 'IMB_ATD_ID','<>', Auth::user()->IMB_ATD_ID)
        ->where( 'IMB_IMB_ID','<>', Auth::user()->IMB_IMB_ID)
        ->where( 'IMB_CLA_COMENTARIO','<>','Cliente Cadastrado')
        ->where( 'IMB_CLA_STATUS','=','Em atendimento')
        ->where( 'IMB_CLA_PRIORIDADE','=','Alta')
        ->count();

        return $totalatendimentos;
    }


    //estatitiscas do cliente logado



   public function listarAtendimentos( Request $request )
   {

    
        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
        }


        $vertodos = app('App\Http\Controllers\ctrDireitos')
        ->checarDireitoPHP( Auth::user()->IMB_ATD_ID, '204', 1 );


        $datainicio='';
        if( $request->datainicio <> '' )
            $datainicio       =  formatarData( $request->datainicio );

        $datafim='';
        if( $request->datafim <> '' )
                $datafim       =  formatarData( $request->datafim );

        $prioridade         =   $request->prioridade;
        $emaberto           =   $request->emaberto;
        $id                 =   $request->id;
        $idcliente          =   $request->idcliente;
        $idcorretor         =   $request->corretor;
        $idprioridade       =   $request->prioridade;
        
        //dd( "inicio $datainicio - data fim: $datafim");


    
        $atm = mdlClienteAtendimento::select(
           [

                'IMB_CLIENTEATENDIMENTO.IMB_CLA_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_IDRETORNO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_PRIORIDADE AS  VIS_PRI_NOME',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATACADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATUALIZACAO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATENDIMENTO',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_COMENTARIO',
                'IMB_ATD_NOME AS IMB_ATD_NOMECADASTRO',
                'IMB_CLT_NOME',
                'IMB_CLT_EMAIL',
                DB::raw( '( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE
                        WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_CLIENTEATENDIMENTO.IMB_ATD_ID) as IMB_ATD_NOME '),
                DB::raw( 'PEGAFONES( IMB_CLIENTEATENDIMENTO.IMB_CLT_ID ) as FONES ')
           ]
       )
       ->where( 'IMB_ATENDENTE.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
       ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO')
       ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')
       ->orderBy('IMB_CLIENTEATENDIMENTO.IMB_CLA_ID','DESC');

       if( $request->filtroatendimento=='MEU' or $vertodos <> 'S' ) 
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID','=',Auth::user()->IMB_ATD_ID );
       
        if( $request->filtroatendimento=='DEMAIS') 
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID','<>',Auth::user()->IMB_ATD_ID );

       if( $request->atendimentostatus=='Finalizado') 
           $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS','=','Finalizado');

        if( $request->atendimentostatus=='Aberto') 
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS','=','Em atendimento');

        if( $request->atendimentostatus=='Alta') 
        {
           $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_PRIORIDADE','=','Alta');
           $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS','=','Em atendimento');

        }

       if(  $idcorretor <> '' )
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID','=',$idcorretor );

        if(  $id <> '' )
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_ID','=',$id );

        if(  $idprioridade <> '' )
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_PRIORIDADE','=',$idprioridade );

        if(  $idcliente <> '' )
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID','=',$idcliente );

        if( $datafim <> '' )
            $atm->where(DB::raw('CAST(IMB_CLA_DATAATENDIMENTO AS DATE )'), '<=', $datafim);        

        if( $datainicio <> '' )
            $atm->where(DB::raw('CAST(IMB_CLA_DATAATENDIMENTO AS DATE )'), '>=', $datainicio);        

        if( $request->ocultarclientecadastrado == 'S')
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_COMENTARIO','<>','Cliente cadastrado' );

        if( $emaberto =='S' )
            $atm->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS','<>','Finalizado' );


        
        //    dd( '$request->filtroatendimento '.$request->filtroatendimento.' - $request->atendimentostatus '.$request->atendimentostatus) ;



      return DataTables::of($atm)->make(true);
    }

    public function transferirAtendimento( Request $request )
    {
        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
        }

        $atd = mdlAtendente::find( $request->IMB_ATD_ID );

        $idatual = $request->IMB_CLA_ID;

        $atmatual = mdlClienteAtendimento::find( $idatual );
        $atmatual->IMB_CLA_STATUS = 'Finalizado';
        $atmatual->IMB_CLA_COMENTARIO = $atmatual->IMB_CLA_COMENTARIO . '(atendimento tranferido)';
        $atmatual->save();

        $datahoraatendimento= formatarData(  $request->IMB_CLA_DATAATENDIMENTO ).' '.
                                            $request->IMB_CLA_HORAATENDIMENTO;


        $cliatm = new mdlClienteAtendimento;
        $cliatm->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $cliatm->IMB_ATD_IDCADASTRO = Auth::user()->IMB_ATD_ID;
        $cliatm->IMB_CLT_ID = $atmatual->IMB_CLT_ID;
        $cliatm->IMB_ATD_ID = $request->IMB_ATD_ID;
        $cliatm->IMB_CLA_PRIORIDADE = $atmatual->IMB_CLA_PRIORIDADE;
        $cliatm->IMB_CLA_STATUS = $atmatual->IMB_CLA_STATUS;
        $cliatm->IMB_CLA_DATACADASTRO = date('Y-m-d H:i:s');
        $cliatm->IMB_CLA_DATAATUALIZACAO = date('Y-m-d H:i:s');
        $cliatm->IMB_CLA_DATAATENDIMENTO = $datahoraatendimento;
        $cliatm->IMB_CLA_COMENTARIO = $request->IMB_CLA_COMENTARIO;
        $cliatm->IMB_CLA_PRETENSAO = $atmatual->IMB_CLT_PRETENSAO;
        $cliatm->IMB_CLA_FINALIDADE = $atmatual->IMB_CLA_FINALIDADE;
        $cliatm->save();

        $log = new mdlObs;
        $log->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $log->IMB_IMV_ID = 0;
        $log->IMB_CTR_ID = 0;
        $log->IMB_CLT_ID = $atmatual->IMB_CLT_ID;
        $log->IMB_RLT_NUMERO =0;
        $log->IMB_RLD_NUMERO =0;
        $log->IMB_OBS_OBSERVACAO = 'Atendimento transferido para '.$atd->IMB_ATD_NOME;
        $log->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $log->IMB_OBS_DTHATIVO = date('Y-m-d H:i:s');
        $log->IMB_OBS_PROCESSO = 'ATENDIMENTO';
        $log->save();

        return response()->json('ok',200);

    }


    public function ultimoAtendimentoClienteCorretor( $cli )
    {

        $atm = mdlClienteAtendimento::select(
           [

                'IMB_CLIENTEATENDIMENTO.IMB_CLA_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_IDRETORNO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_PRIORIDADE AS  VIS_PRI_NOME',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATACADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATUALIZACAO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATENDIMENTO',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_COMENTARIO',
                'IMB_ATD_NOME AS IMB_ATD_NOMECADASTRO',
                'IMB_CLT_NOME',
                'IMB_CLT_EMAIL',
                DB::raw( '( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE
                        WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_CLIENTEATENDIMENTO.IMB_ATD_ID) as IMB_ATD_NOME '),
                DB::raw( 'PEGAFONES( IMB_CLIENTEATENDIMENTO.IMB_CLT_ID ) as FONES ')
           ]
       )
       ->where( 'IMB_ATENDENTE.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
       ->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID','=',$cli)
       ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO')
       ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')
       ->orderBy('IMB_CLIENTEATENDIMENTO.IMB_CLA_ID','DESC')->first();

        return response()->json($atm,200);

    }

    public function notificarCorretorAtm()
    {
        $atm = mdlClienteAtendimento::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->where( 'IMB_CLA_STATUS','<>', 'Finalizado' )
        ->where( 'IMB_ATD_IDCADASTRO','<>', Auth::user()->IMB_ATD_ID )
        ->whereRaw( "coalesce(IMB_CLA_CIENTE, 'N') <>  'S'")
        ->count();
        
        return response()->json($atm,200);
    }    

    public function notificarNovosLeads()
    {
        $leads = mdlLeads::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->whereRaw( "coalesce(IMB_LED_CIENTE, 'N') <>  'S'")
        ->count();
        
        return response()->json($leads,200);
    }    

    public function verCorretorAtm()
    {
        $atm = mdlClienteAtendimento::select( 
            [
                'IMB_CLA_DATACADASTRO',
                'IMB_CLA_PRIORIDADE',
                'IMB_CLA_PRETENSAO',
                'IMB_CLA_DATAATENDIMENTO',
                'IMB_CLA_COMENTARIO',
                'IMB_CLA_ID',
                'IMB_CLT_NOME',
                DB::raw( '( select PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) ) as TELEFONE ')
            ]
        )
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')
        ->where( 'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->where( 'IMB_CLA_STATUS','<>', 'Finalizado' )
        ->where( 'IMB_ATD_IDCADASTRO','<>', Auth::user()->IMB_ATD_ID )
        ->whereRaw( "coalesce(IMB_CLA_CIENTE, 'N') <>  'S'")
        
        ->get();
        
        
        return $atm;
    }    

    public function cienteAtm( Request $request )
    {
        $id = $request->IMB_CLA_ID;

        $atm = mdlClienteAtendimento::find( $id );

        $atm->IMB_CLA_CIENTE = 'S';
        $atm->save();

        return response()->json( $id,200);
    }


    public function cienteLeads( Request $request )
    {
        $id = $request->IMB_LED_ID;

        $atm = mdlLeads::find( $id );

        $atm->IMB_LED_CIENTE = 'S';
        $atm->save();

        return response()->json( $id,200);
    }

    public function localizarAtendimentos( Request $request)
    {

        $ativos = $request->ativos;

        $atms = mdlClienteAtendimento::select(
            [
                'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                DB::raw( "(SELECT CONCAT( IMB_CLT_NOME,' - ',coalesce(IMB_CLT_EMAIL,''), ' - Telefone: ', coalesce(PEGAFONES(IMB_CLIENTEATENDIMENTO.IMB_CLT_ID),'') ) ) as linha "),
                'IMB_CLA_ID'
            ]
        )->leftJoin('IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')
        ->havingRaw( 'linha is not null')
        ->orderBy('IMB_CLT_NOME');

        if( $ativos == 'S')
                $atms = $atms->where( 'IMB_CLA_STATUS','=', 'Em atendimento');

        $atms = $atms->get();

        return response()->json( $atms, 200);
    }
        
    
    public function pegarDadosAtendimento( $id)
    {

        $atm = mdlClienteAtendimento::select(
           [

                'IMB_CLIENTEATENDIMENTO.IMB_CLA_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_IDRETORNO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_ID',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_PRIORIDADE AS  VIS_PRI_NOME',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_STATUS',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATACADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATUALIZACAO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_DATAATENDIMENTO',
                'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO',
                'IMB_CLIENTEATENDIMENTO.IMB_CLA_COMENTARIO',
                'IMB_ATD_NOME AS IMB_ATD_NOMECADASTRO',
                'IMB_CLT_NOME',
                'IMB_CLT_EMAIL',
                'IMB_CLT_RG',
                'IMB_CLT_CPF',
                DB::raw( '( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE
                        WHERE IMB_ATENDENTE.IMB_ATD_ID = IMB_CLIENTEATENDIMENTO.IMB_ATD_ID) as IMB_ATD_NOME '),
                DB::raw( 'PEGAFONES( IMB_CLIENTEATENDIMENTO.IMB_CLT_ID ) as FONES ')
           ]
       )
       ->where( 'IMB_CLIENTEATENDIMENTO.IMB_CLA_ID','=',$id)
       ->leftJoin( 'IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'IMB_CLIENTEATENDIMENTO.IMB_ATD_IDCADASTRO')
       ->leftJoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_CLIENTEATENDIMENTO.IMB_CLT_ID')
       ->orderBy('IMB_CLIENTEATENDIMENTO.IMB_CLA_ID','DESC')->first();

        return response()->json($atm,200);

    }
    

}
