<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlAcordo;
use App\mdlLancamentoFuturo;
use App\mdlContrato;
use App\mdlTMPResumoAcordo;
use DataTables;
use Auth;
use DB; 
use Log;    
class ctrAcordo extends Controller
{

    public function index( Request $request)
    {
        return view( 'acordos.acordosindex');

    }

    public function list( Request $request)
    {

        $acordos = mdlAcordo::select(
            [
                'IMB_ACORDO.IMB_ACD_ID',
	            'IMB_ACORDO.IMB_CTR_ID',
	            'IMB_ACORDO.IMB_ACD_DATAACORDO',
	            'IMB_ACORDO.IMB_ACD_MOTIVOACORDO',
	            'IMB_ACORDO.IMB_ATD_ID',
	            'IMB_ACORDO.IMB_ACD_VALOR',
	            'IMB_ACORDO.IMB_ACD_PARCELAS',
	            'IMB_ACORDO.IMB_ACD_ITENS',
	            'IMB_ACORDO.IMB_ACD_COBRARCOMALUGUEL',
	            'IMB_ACORDO.IMB_ACD_VALORENTRADA',
	            'IMB_ACORDO.IMB_ACD_DTHINATIVO',
	            'IMB_ACORDO.IMB_ACD_MOTIVOINATIVO',
	            'IMB_ACORDO.IMB_ACD_DATAENTRADA',
                'IMB_CONTRATO.IMB_IMV_ID',
                'IMB_CTR_REFERENCIA',
                DB::raw( 'imovel( IMB_CONTRATO.IMB_IMV_ID) Endereco' ),
                DB::raw( 'PEGALOCATARIOCONTRATO( IMB_ACORDO.IMB_CTR_ID) Locatario')
            ]
        )->leftJoin( 'IMB_CONTRATO','IMB_CONTRATO.IMB_CTR_ID', 'IMB_ACORDO.IMB_CTR_ID' );


        return DataTables::of($acordos)->make(true);

    }

    public function acordosContrato( $id )
    {
        $acds = mdlAcordo::where( 'IMB_CTR_ID','=', $id )
        ->orderBy('IMB_CTR_ID')
        ->get();

        return $acds;
    }

    public function store( Request $request )
    {
        if( $request->IMB_ACD_ID == '' )
            $acd = new mdlAcordo;
        else
            $acd = mdlAcordo::find( $request->IMB_CAPCTR_ID );

        //$capimo = new mdlCapImo();

        $ctr = mdlContrato::find( $request->IMB_CTR_ID );

        $acd->IMB_CTR_ID = $request->IMB_CTR_ID;
        $acd->IMB_ACD_DATAACORDO = $request->IMB_ACD_DATAACORDO;
        $acd->IMB_ACD_MOTIVOACORDO = $request->IMB_ACD_MOTIVOACORDO;
        $acd->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $acd->IMB_ACD_VALOR = $request->IMB_ACD_VALOR;
        $acd->IMB_ACD_PARCELAS = $request->IMB_ACD_PARCELAS;
        $acd->IMB_ACD_ITENS = $request->IMB_ACD_ITENS;
        $acd->IMB_ACD_COBRARCOMALUGUEL = $request->IMB_ACD_COBRARCOMALUGUEL;
        $acd->IMB_ACD_VALORENTRADA = $request->IMB_ACD_VALORENTRADA;
        $acd->IMB_ACD_DATAENTRADA = $request->IMB_ACD_DATAENTRADA;
        $acd->save();
        app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( 0, $acd->IMB_CTR_ID, 0, 0,0 ,
            'Acordo realizado no valor de '.$request->IMB_ACD_VALOR.' em '.
            $request->IMB_ACD_PARCELAS);

        $tmp = mdlTMPResumoAcordo::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->delete();
        
        $lfs = $request->lfs;
        $total=0;
        foreach( $lfs as $lf )
        {
            $lc = mdlLancamentoFuturo::find($lf);

            $lc->IMB_ACD_ID = $acd->IMB_ACD_ID;
            $lc->IMB_LCF_DTHINATIVADO = date( 'Y/m/d H:i');
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( 0, $acd->IMB_CTR_ID, 0, 0,0 ,
            'Lancamento '.$lc->IMB_TBE_ID.', vencimento em '.$lc->IMB_LCF_DATAVENCIMENTO.', valor de '.$lc->IMB_LCF_VALOR
            .' foi desativado, pois entrou no acordo realizado');
            $lc->save();

            $tmp = mdlTMPResumoAcordo::where( 'IMB_TBE_ID','=', $lc->IMB_TBE_ID )
            ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
            ->first();
            if( $tmp == '' )
            {
                $evento = app('App\Http\Controllers\ctrEvento')
                ->find(  $lc->IMB_TBE_ID )                ;
                $tmp = new mdlTMPResumoAcordo;
                $tmp->IMB_TBE_ID            = $lc->IMB_TBE_ID;
                $tmp->IMB_TBE_NOME          = $evento->IMB_TBE_NOME;
                $tmp->IMB_LCF_VALOR         = 0;
                $tmp->IMB_ATD_ID            = Auth::user()->IMB_ATD_ID;
                $tmp->IMB_IMB_ID            = Auth::user()->IMB_IMB_ID;
            }
            $valorlancamento = $lc->IMB_LCF_VALOR;
            if( $lc->IMB_LCF_LOCATARIOCREDEB =='C' ) $valorlancamento = $valorlancamento * -1;
    
            $total = $total + $valorlancamento;
            $tmp->IMB_LCF_VALOR = $tmp->IMB_LCF_VALOR + $lc->IMB_LCF_VALOR;
            $tmp->save();
            
        };

        $tmp = mdlTMPResumoAcordo::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->get();
        foreach( $tmp as $t )
        {
            $t->PROPORCAO = $t->IMB_LCF_VALOR / $total;
            $t->save();
        }
    


        $parcelamento  = $request->parcelas;

        if( $request->detalhar == 'S' )
        {
            foreach( $parcelamento as $parc )
            {
                foreach( $tmp as $t )
                {

                    $evento = app('App\Http\Controllers\ctrEvento')
                    ->find(  $t->IMB_TBE_ID );
        
            
                    $lf = new mdlLancamentoFuturo;
                    $lf->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                    $lf->IMB_CTR_ID             = $acd->IMB_CTR_ID;
                    $lf->IMB_LCF_VALOR          = $parc[2] * $t->PROPORCAO;
                    $lf->IMB_LCF_LOCADORCREDEB  = 'N';
                    $lf->IMB_LCF_LOCATARIOCREDEB='D';
                    $lf->IMB_LCF_DATAVENCIMENTO = app('App\Http\Controllers\ctrRotinas')->formatarData($parc[0]);
                    $lf->IMB_LCF_TIPO           = 'M';
                    $lf->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                    $lf->IMB_TBE_ID             = 14;
                    $lf->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                    $lf->IMB_LCF_INCMUL         = $evento->IMB_TBE_MULTA;
                    $lf->IMB_LCF_INCIRRF        = $evento->IMB_TBE_IRRF;
                    $lf->IMB_LCF_INCTAX         = $evento->IMB_TBE_TAXAADM;
                    $lf->IMB_LCF_INCJUROS       = $evento->IMB_TBE_JUROS;
                    $lf->IMB_LCF_INCCORRECAO    = $evento->IMB_TBE_CORRECAO;
                    $lf->IMB_LCF_GARANTIDO      = 'N';
                    $lf->IMB_LCF_INCISS         = $evento->IMB_TBE_INCISS;
                    $lf->IMB_LCF_OBSERVACAO     = 'Acordo - '.$t->IMB_TBE_NOME.' - Parcela: '.$parc[1];
                    $lf->IMB_ACD_IDDESTINO      = $acd->IMB_ACD_ID;

                    $lf->save();

                    app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $acd->IMB_CTR_ID, 0, 0,0 ,
                    'Lançamento gerado pelo acordo: Evento '.$lf->IMB_TBE_ID.', vencimento em '.
                            $lf->IMB_LCF_DATAVENCIMENTO.', valor de '.$lf->IMB_LCF_VALOR);
                }
            }

        }
        else
        {
            foreach( $parcelamento as $parc )
            {
                    $lf = new mdlLancamentoFuturo;
                    $lf->IMB_IMB_ID             = Auth::user()->IMB_IMB_ID;
                    $lf->IMB_CTR_ID             = $acd->IMB_CTR_ID;
                    $lf->IMB_LCF_VALOR          = $parc[2];
                    $lf->IMB_LCF_LOCADORCREDEB  = 'N';
                    $lf->IMB_LCF_LOCATARIOCREDEB='D';
                    $lf->IMB_LCF_DATAVENCIMENTO = app('App\Http\Controllers\ctrRotinas')->formatarData($parc[0]);
                    $lf->IMB_LCF_TIPO           = 'M';
                    $lf->IMB_IMV_ID             = $ctr->IMB_IMV_ID;
                    $lf->IMB_TBE_ID             = 14;
                    $lf->IMB_ATD_ID             = Auth::user()->IMB_ATD_ID;
                    $lf->IMB_LCF_INCMUL         = $evento->IMB_TBE_MULTA;
                    $lf->IMB_LCF_INCIRRF        = $evento->IMB_TBE_IRRF;
                    $lf->IMB_LCF_INCTAX         = $evento->IMB_TBE_TAXAADM;
                    $lf->IMB_LCF_INCJUROS       = $evento->IMB_TBE_JUROS;
                    $lf->IMB_LCF_INCCORRECAO    = $evento->IMB_TBE_CORRECAO;
                    $lf->IMB_LCF_GARANTIDO      = 'N';
                    $lf->IMB_LCF_INCISS         = $evento->IMB_TBE_INCISS;
                    $lf->IMB_LCF_OBSERVACAO     = 'Acordo Parcela: '.$parc[1];
                    $lf->IMB_ACD_IDDESTINO      = $acd->IMB_ACD_ID;

                    $lf->save();

                    app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $acd->IMB_CTR_ID, 0, 0,0 ,
                    'Lançamento gerado pelo acordo: Evento '.$lf->IMB_TBE_ID.', vencimento em '.
                            $lf->IMB_LCF_DATAVENCIMENTO.', valor de '.$lf->IMB_LCF_VALOR);
            }


        }

        return response()->json();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capctr = mdlCapCtr::find( $id );
        if( isset( $capctr ))
        {
            return $capctr->toJson();
        }
        return response( 'não encontrato',404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function acordoDetalhes( $id )
    {
        return view( 'acordos.acordorealizado',compact('id'));
    }

    public function acordoDados( $id)
    {
        $acordo = mdlAcordo::find( $id );

        return $acordo;

    }

    public function parcelasAcordo( $id )
    {

        $par = mdlLancamentoFuturo::select(
            [
                'IMB_LCF_ID',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR'
            ]
        )->where( 'IMB_ACD_IDDESTINO','=', $id)
        ->orderBy( 'IMB_LCF_DATAVENCIMENTO');

        Log::info( $par->toSql() );
        $par = $par->get();

        return $par;

    }

    public function origensAcordo( $id )
    {

        $par = mdlLancamentoFuturo::select(
            [
                'IMB_LCF_ID',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR'
            ]
        )->where( 'IMB_ACD_ID','=', $id)
        ->orderBy( 'IMB_LCF_DATAVENCIMENTO')
        ->get();

        return $par;

    }

}
