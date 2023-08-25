<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAtendimentoAgenda;
use App\mdlAtd;
class ctrAtendimentoAgenda extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
        
    
    
    
    public function ultimoStatus( $id )
    {
        $agenda = mdlAtendimentoAgenda::select(
            [
                'VIS_ATA_ID',
                'VIS_ATD_IDINICIO',
                'IMB_ATENDENTE.IMB_ATD_NOME',
                'VIS_ATENDIMENTOSTATUS.VIS_ATS_NOME',
                'VIS_ATENDIMENTOSTATUS.VIS_ATS_COLOR',
                'VIS_ATA_DATA',
                'VIS_ATA_HORA'
            ])
            ->leftJoin('IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTOAGENDA.VIS_ATD_IDINICIO')
            ->leftJoin('VIS_ATENDIMENTOSTATUS', 'VIS_ATENDIMENTOSTATUS.VIS_ATS_ID', 'VIS_ATENDIMENTOAGENDA.VIS_ATS_ID')
            ->where( 'VIS_ATM_ID', $id )
            ->orderBy( 'VIS_ATA_DATA', 'DESC')
            ->orderBy( 'VIS_ATA_HORA', 'DESC')
            ->limit(1)
            ->get();

        return $agenda->toJson();
        //
    }


    public function carga( $id )
    {
        $agenda = mdlAtendimentoAgenda::select('*')
        ->where( 'VIS_ATM_ID', $id )
        ->orderBy( 'VIS_ATA_DATA', 'DESC')
        ->orderBy( 'VIS_ATA_HORA', 'DESC')
        ->get();

        return $agenda->toJson();
        //
    }

    public function busca( $id )
    {
        $agenda = mdlAtendimentoAgenda::select('*')
        ->where( 'VIS_ATA_ID', $id )
        ->get();

        return $agenda->toJson();
        //
    }

    public function index()
    {
        //
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
    public function registroEncerramento(Request $request)
    {

        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }
                
        $dataagenda         = $request->input( 'VIS_ATA_DATA');
        $datahora           = $request->input( 'VIS_ATA_HORA');
        $dataencerramento   = $request->input( 'VIS_ATA_DATAENCERRAMENTO');
        $horaencerramento   = $request->input( 'VIS_ATA_HORAENCERRAMENTO');
        $atdinicio          = $request->input( 'VIS_ATD_IDINICIO');
        $observacoes        = $request->input( 'VIS_ATA_OBSERVACOES');
        $prioridade         = $request->input( 'VIS_PRI_ID');
        $forma              = $request->input( 'VIS_ATM_FORMA');
        $status             = $request->input( 'VIS_ATS_ID');
        $idusuario          = $request->input( 'IMB_ATD_ID');
        $cliente            = $request->input( 'IMB_CLT_ID');
        $atendimento        = $request->input( 'VIS_ATM_ID');
        $idagenda           = $request->input( 'VIS_ATA_ID');
        $operacao          = $request->input( 'OPERACAO');


        $atd = mdlAtd::find( $atendimento );
//        $datainicio =  date("d/m/Y", $atd->IMB_ATM_DTHINICIO);
        
        $datainicio =  strtotime( $atd->IMB_ATM_DTHINICIO ) ;
        $datainicio = date("d-m-Y H:i", $datainicio);

        $ata = new mdlAtendimentoAgenda;
        $ata->IMB_ATD_ID  = $idusuario;
        $ata->VIS_ATM_ID    = $atendimento;
        $ata->VIS_ATD_IDINICIO  = $atdinicio;
        $ata->VIS_PRI_ID  = 1;
        $ata->VIS_ATM_FORMA  = 'I';
        $ata->VIS_ATS_ID  = 9;
        $ata->VIS_ATA_DATA  =  date('Y/m/d');
        $ata->VIS_ATA_HORA  =  $request->VIS_ATA_HORA;
         $ata->VIS_ATA_DATAENCERRAMENTO  =  date('Y/m/d');
        $ata->VIS_ATA_HORAENCERRAMENTO  = $request->VIS_ATA_HORAENCERRAMENTO ;
        if( $operacao == 'E')
            $ata->VIS_ATA_OBSERVACOES  = 'Encerramento do atendimento iniciado em '.$datainicio;
        if( $operacao == 'R')
            $ata->VIS_ATA_OBSERVACOES  = 'Reabertura do atendimento ';
      
    //    $ata->IMB_ATD_ID  = 1;
  
        
        $ata->save();

        
        return response( 'ok', 200);


    }


    public function store(Request $request)
    {

        
        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }
        
        
        $dataagenda         = $request->input( 'VIS_ATA_DATA');
        $datahora           = $request->input( 'VIS_ATA_HORA');
        $dataencerramento   = $request->input( 'VIS_ATA_DATAENCERRAMENTO');
        $horaencerramento   = $request->input( 'VIS_ATA_HORAENCERRAMENTO');
        $atdinicio          = $request->input( 'VIS_ATD_IDINICIO');
        $observacoes        = $request->input( 'VIS_ATA_OBSERVACOES');
        $prioridade         = $request->input( 'VIS_PRI_ID');
        $forma              = $request->input( 'VIS_ATM_FORMA');
        $status             = $request->input( 'VIS_ATS_ID');
        $idusuario          = $request->input( 'IMB_ATD_ID');
        $cliente            = $request->input( 'IMB_CLT_ID');
        $atendimento        = $request->input( 'VIS_ATM_ID');
        $idagenda          = $request->input( 'VIS_ATA_ID');
        $idatd          = $request->input( 'VIS_ATD_IDINICIO');


        if ( $idagenda =='0' ) 
            $ata = new mdlAtendimentoAgenda;
        else
            $ata = mdlAtendimentoAgenda::find( $idagenda );
        

        $ata->IMB_ATD_ID  = $idatd;
        $ata->VIS_ATM_ID    = $atendimento;
        $ata->VIS_ATA_DATA  = formatarData( $dataagenda );

        $ata->VIS_ATA_HORA  = $datahora;
        if ( $dataencerramento <> '' )
            $ata->VIS_ATA_DATAENCERRAMENTO  = formatarData($dataencerramento);
        $ata->VIS_ATA_HORAENCERRAMENTO  = $horaencerramento;
        $ata->VIS_ATD_IDINICIO  = $atdinicio;
        $ata->VIS_ATA_OBSERVACOES  = $observacoes;
        $ata->VIS_PRI_ID  = $prioridade;
        $ata->VIS_ATM_FORMA  = $forma;
        $ata->VIS_ATS_ID  = $status;

        $ata->save();

        
        return response( 'ok', 200);


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

  
    public function qHoje( $idatd )
    {
    
        $datahoje = date('Y-m-d');
        $lf = mdlAtendimentoAgenda::where('IMB_ATD_ID', '=' , $idatd )
            ->where('VIS_ATA_DATA','=', $datahoje )
        ->get()->count();
    
        return $lf;
    
    }
    
  

}
