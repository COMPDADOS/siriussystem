<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlLancamentoFuturo;
use App\mdlEvento;
use App\mdlParametros2;
use App\mdlCobrancaGeradaPerm;
use App\mdlCobrancaGeradaItemPerm;

use Illuminate\Support\Facades\Auth;
use DB;
use DataTables;
use Log;

class ctrLancamentoFuturo extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

        public function list( $id, $empresamaster, $page, $evento, $aberto, $ven )
        {

        //como o parametro $empresamaster não será mais utilizado, então usarei pra trazer o conteudo
        //no return sem o datatable
        $lf = mdlLancamentoFuturo::where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID', '=' , $id )
        ->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
        ->get()->count();

        $registros = $lf;

        $start_from = ($page - 1) * 100;

        $lf = mdlLancamentoFuturo::select(
            [
                DB::raw('IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_NOME'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_LANCAMENTOFUTURO.IMB_CLT_IDLOCADOR)
                            AS IMB_CLT_NOMELOCADOR'),
                'IMB_LCF_ID',
                'IMB_LANCAMENTOFUTURO.IMB_IMV_ID',
                'IMB_LANCAMENTOFUTURO.IMB_CTR_ID',
                'IMB_LANCAMENTOFUTURO.IMB_TBE_ID',
                'IMB_LCF_LOCADORCREDEB',
                'IMB_LCF_LOCATARIOCREDEB',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_RECEBIDO',
                'IMB_LCF_DATALANCAMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR',
                'IMB_LCF_RESTITUIDO',
                'IMB_RLT_NUMERO',
                'IMB_RLD_NUMERO',
                'IMB_LCF_TIPO',
                'IMB_LCF_FORMARECEBIMENTO',
                'IMB_LCF_FORMAPAGAMENTO',
                'IMB_LCF_AUTOMATICO',
                'IMB_LCF_NOSSONUMERO',
                'IMB_LCF_PAGO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_DATAPAGAMENTO',
                'IMB_LANCAMENTOFUTURO.FIN_CFC_ID',
                'FIN_LCC_ID',
                'FIN_APD_ID',
                'IMB_LCF_BOLETOAVULSO',
                'IMB_LCF_EMACORDO',
                'IMB_ACD_ID',
                'IMB_ACD_IDDESTINO',
                'IMB_LCF_INCMUL',
                'IMB_LCF_INCIRRF',
                'IMB_LCF_INCTAX',
                'IMB_LCF_INCJUROS',
                'IMB_LCF_INCCORRECAO',
                'IMB_LCF_GARANTIDO',
                'IMB_LCF_INCISS',
                'IMB_LCF_FIXO',
                'IMB_LCF_SOMENTELOCADOR',
                'IMB_RLD_LOCALPAGAMENTO',
                'IMB_CLT_IDLOCADOR',
                'IMB_LCF_REPASSEPENDENTE',
                'IMB_LCF_TC_COM_TA',
                'PROXIMOREPASSE',
                'IMB_LCF_NUMEROCONTROLE',
                'IMB_LCF_NUMPARREAJUSTE',
                'IMB_LCF_NUMPARCONTRATO',
                'IMB_LCF_ANTECIPADO',
                'IMB_LCF_DTHINATIVADO',
                'IMB_LCF_CHAVE',
                'IMB_CGR_ID',
                'IMB_CTR_REFERENCIA',
                'IMB_PRM_USARPARCELAS',
                DB::raw( 'imovel( IMB_LANCAMENTOFUTURO.IMB_IMV_ID) AS ENDERECO'),
                DB::raw( '(select FIN_CCI_BANCONUMERO FROM IMB_COBRANCAGERADAPERM
                            WHERE IMB_COBRANCAGERADAPERM.IMB_CGR_ID = IMB_LANCAMENTOFUTURO.IMB_CGR_ID) AS FIN_CCI_BANCONUMERO')

            ]
        )
        ->leftJoin('IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID')
        ->leftJoin('IMB_CONTRATO', 'IMB_CONTRATO.IMB_CTR_ID', 'IMB_LANCAMENTOFUTURO.IMB_CTR_ID')
        ->leftJoin( 'IMB_PARAMETROS', 'IMB_PARAMETROS.IMB_IMB_ID','IMB_LANCAMENTOFUTURO.IMB_IMB_ID')
        ->where('IMB_TABELAEVENTOS.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
        ->where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID', '=' , $id )
        ->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID)
        ->whereNull( 'IMB_LCF_DTHINATIVADO');

        //if( $page <> '0' )
          //  $lf->limit(100)->offset( $start_from  );

        if( $evento <> 'null' and $evento <> '0' )
            $lf->where( 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID','=', $evento);

        if( $ven <> '' and $ven <> '0' and $ven <> 'null' )
        $lf->where( 'IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO','=', $ven);

        if( $aberto == 'F')
        {
            $lf->whereRaw( "coalesce( IMB_LCF_FIXO,'N') = 'S' ");
        }
    
        if( $aberto == 'A' )
        {
            $lf->whereRaw( "((IMB_LANCAMENTOFUTURO.IMB_LCF_LOCATARIOCREDEB <> 'N' 
                            and IMB_LANCAMENTOFUTURO.IMB_LCF_DATARECEBIMENTO is null) or
                            (IMB_LANCAMENTOFUTURO.IMB_LCF_LOCADORCREDEB <>  'N' 
                            and IMB_LANCAMENTOFUTURO.IMB_LCF_DATAPAGAMENTO is null))");
        }

        if( $aberto == 'T')
        {
            $lf->where(  function( $query )
            {

                $query->orWhere( 'IMB_LANCAMENTOFUTURO.IMB_LCF_LOCATARIOCREDEB', '<>', 'N');
                $query->Where( 'IMB_LANCAMENTOFUTURO.IMB_LCF_DATARECEBIMENTO','=', null) ;
            });
        }
        if( $aberto == 'D')
        {
            $lf->Where(  function( $query )
            {

                $query->orWhere( 'IMB_LANCAMENTOFUTURO.IMB_LCF_LOCADORCREDEB', '<>', 'N');
                $query->Where( 'IMB_LANCAMENTOFUTURO.IMB_LCF_DATAPAGAMENTO','=', null) ;
            });
        }

        if( $aberto ==  'ORDEMCRESCENTE')
            $lf->orderBy( 'IMB_LCF_DATAVENCIMENTO','ASC')
                ->orderBy( 'IMB_TBE_ID','ASC');
        else
            $lf->orderBy( 'IMB_LCF_DATAVENCIMENTO','DESC')
            ->orderBy( 'IMB_TBE_ID','ASC');

            
//        return $lf->toSql();
        if( $aberto == 'A' or $empresamaster == '0')
        {
            $lf = $lf->get();
            return $lf;
        }


        //$lf->get();
        return DataTables::of($lf)->make(true);
        //return [ $lf, $registros ];


        //
    }

    public function index( request $request)
    {
        $idcontratopesquisa = $request->IMB_CTR_ID;
        if( $idcontratopesquisa == '' ) $idcontratopesquisa = '0';
        return view( 'lancamento.indexlf', compact( 'idcontratopesquisa') );
        //
    }

    public function new()
    {
        return view( 'lancamento.newlf');
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
    public function store(Request $request)
    {

        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
        }


        

        $idevento = $request->IMB_TBE_ID;
        
        $tabelaevento = mdlEvento::find( $idevento );

        $gravarirrf = $request->IMB_LCF_INCIRRF;
        $gravarTA = $request->IMB_LCF_INCTAX;
        $gravarmulta = $request->IMB_LCF_INCMUL;
        $gravarjuros =  $request->IMB_LCF_INCJUROS;
        $gravarcorrecao = $request->IMB_LCF_INCCORRECAO ;
        $gravariss =  $request->IMB_LCF_INCISS ;
        
        if( $gravarirrf == '' )
            $gravarirrf = $tabelaevento->IMB_TBE_IRRF;

        if( $gravarTA == '' )
            $gravarTA = $tabelaevento->IMB_TBE_TAXAADM;

        if( $gravarmulta == '' )
            $gravarmulta = $tabelaevento->IMB_TBE_MULTA;

            if( $gravarjuros == '' )
            $gravarjuros = $tabelaevento->IMB_TBE_JUROS;

        if( $gravariss == '' )
            $gravariss = $tabelaevento->IMB_LCF_INCISS;


        $id = $request->input( 'IMB_IMB_ID');
        $idctr = $request->input( 'IMB_CTR_ID');
        $idlcf = $request->input( 'IMB_LCF_ID');
        $observacao = $request->IMB_LCF_OBSERVACAO   ;

        $replicar = $request->replicaralteracao;

        $parcelacontrato =  $this->pegarNumeroParcelaConformeVencimento(
                            $idctr,
                            $request->IMB_LCF_DATAVENCIMENTO);


        if ( $idlcf <> '' )
        {
            $lf = mdlLancamentoFuturo::find( $idlcf );
            $valorantigo = $lf->IMB_LCF_VALOR;
            $eventoantio = $lf->IMB_TBE_ID;
            $locadorcredebantigo = $lf->IMB_LCF_LOCADORCREDEB;
            $locatariocredebantigo = $lf->IMB_LCF_LOCATARIOCREDEB;
            $obsantigo = $lf->IMB_LCF_OBSERVACAO;
        }
        else
        {
            $lf = new mdlLancamentoFuturo();
        }

        $reajustar='';
        if( $request->IMB_LCF_REAJUSTAR == 'Reajustar')
            $reajustar = 'S';

        if(  $request->CONTRATONOVO == 'S' and $request->IMB_TBE_ID == 1)
            $observacao = app('App\Http\Controllers\ctrRotinas')
            ->gerarPeriodo( $idctr, formatarData($request->IMB_LCF_DATAVENCIMENTO));

        $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $lf->IMB_CTR_ID = $idctr;
        $lf->IMB_LCF_VALOR = $request->IMB_LCF_VALOR;
        $lf->IMB_LCF_LOCADORCREDEB = $request->IMB_LCF_LOCADORCREDEB;
        $lf->IMB_LCF_LOCATARIOCREDEB = $request->IMB_LCF_LOCATARIOCREDEB;
        $lf->IMB_LCF_DATAVENCIMENTO = formatarData($request->IMB_LCF_DATAVENCIMENTO);
        $lf->IMB_LCF_TIPO = $request->IMB_LCF_TIPO;
        $lf->IMB_IMV_ID = $request->IMB_IMV_ID;
        $lf->IMB_CLT_IDLOCADOR = $request->IMB_CLT_IDLOCADOR;
        $lf->IMB_TBE_ID = $request->IMB_TBE_ID;
        $lf->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $lf->IMB_LCF_INCMUL =$gravarmulta;
        $lf->IMB_LCF_INCIRRF =$gravarirrf;
        $lf->IMB_LCF_INCTAX = $gravarTA;
        $lf->IMB_LCF_INCJUROS = $gravarjuros;
        $lf->IMB_LCF_INCCORRECAO =  $gravarcorrecao;
        $lf->IMB_LCF_GARANTIDO = $request->input('IMB_LCF_GARANTIDO','N') =='on' ? 'S' : 'N' ;
        $lf->IMB_LCF_INCISS = $gravariss;
        $lf->IMB_LCF_OBSERVACAO = $observacao;;
        $lf->IMB_LCF_NUMEROCONTROLE = $request->IMB_LCF_NUMEROCONTROLE;
        $lf->IMB_LCF_NUMPARREAJUSTE = $request->IMB_LCF_NUMPARREAJUSTE;
        $lf->IMB_LCF_NUMPARCONTRATO = $parcelacontrato;
        $lf->IMB_LCF_CHAVE          = $request->IMB_LCF_CHAVE;
        $lf->IMB_LCF_REAJUSTAR          = $reajustar;
        $lf->IMB_LCF_DATALANCAMENTO = date( 'Y/m/d');
        $lf->IMB_LCF_COBRARTAXADMMES = $request->IMB_LCF_COBRARTAXADMMES;
        $lf->IMB_LCF_FIXO = $request->IMB_LCF_FIXO;

        $lf->save();
        if( $idlcf <> '' )
        {
            if( $eventoantio <> $idevento )
                app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
                    'Alterando um lançamento de EVENTO '.$eventoantio.' para '.$idevento.
                    ' para o vencimento '.$request->IMB_LCF_DATAVENCIMENTO);

            if( $valorantigo <>  $request->IMB_LCF_VALOR)
                app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
                    'Alterando um lançamento Valor Anterior: '.$valorantigo.' para '.$idevento.
                    ' para o novo valor '.$request->IMB_LCF_VALOR.
                    ' para o vencimento '.$request->IMB_LCF_DATAVENCIMENTO);

            if( $obsantigo <> $request->IMB_LCF_OBSERVACAO)
                app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
                    'Alterando um lançamento OBSERVAÇÃO Anterior: '.$obsantigo.' para '.$idevento.
                    ' para o novo valor '.$request->IMB_LCF_OBSERVACAO.
                    ' para o vencimento '.$request->IMB_LCF_DATAVENCIMENTO);

            if( $locadorcredebantigo <> $request->IMB_LCF_LOCADORCREDEB)
                app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
                        'Alterando um lançamento C/D Locador Anterior: '.$locadorcredebantigo.' para '.$idevento.
                        ' para o novo valor '.$request->IMB_LCF_LOCADORCREDEB.
                        ' para o vencimento '.$request->IMB_LCF_DATAVENCIMENTO);

            if( $locatariocredebantigo <> $request->IMB_LCF_LOCATARIOCREDEB)
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
            'Alterando um lançamento C/D Locatário Anterior: '.$locatariocredebantigo.' para '.$idevento.
            ' para  '.$request->IMB_LCF_LOCATARIOCREDEB.
            ' para o vencimento '.$request->IMB_LCF_DATAVENCIMENTO);


            $datainicio = $lf->IMB_LCF_DATAVENCIMENTO;

            if( $replicar == 'S')
            {
                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( $lf->IMB_IMV_ID, $lf->IMB_CTR_ID, 0, 0,0 , 'Alteraçao replicada para os próximos vencimentos ' );

                $atlf = mdlLancamentoFuturo::
                where('IMB_TBE_ID','=', $lf->IMB_TBE_ID )
                ->where('IMB_LCF_DATAVENCIMENTO','>', $datainicio )
                ->where('IMB_CTR_ID','=', $lf->IMB_CTR_ID )
                ->update([
                    'IMB_TBE_ID' => $request->IMB_TBE_ID,
                    'IMB_LCF_LOCADORCREDEB' => $lf->IMB_LCF_LOCADORCREDEB,
                    'IMB_LCF_LOCATARIOCREDEB' => $lf->IMB_LCF_LOCATARIOCREDEB,
                    'IMB_LCF_VALOR' => $lf->IMB_LCF_VALOR,
                    'IMB_LCF_INCMUL' => $lf->IMB_LCF_INCMUL,
                    'IMB_LCF_INCIRRF' => $lf->IMB_LCF_INCIRRF,
                    'IMB_LCF_INCTAX' => $lf->IMB_LCF_INCTAX,
                    'IMB_LCF_INCJUROS' => $lf->IMB_LCF_INCJUROS,
                    'IMB_LCF_INCCORRECAO' => $lf->IMB_LCF_INCCORRECAO,
                    'IMB_LCF_INCISS' => $lf->IMB_LCF_INCISS
                ]);
            }
        }
        else
            app('App\Http\Controllers\ctrRotinas')
                    ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
                    'Incluindo um lançamento de EVENTO '.app( 'App\Http\Controllers\ctrRotinas')->pegaNomeEvento( $idevento ). ' '.
                    ' para o vencimento '.app('App\Http\Controllers\ctrRotinas')->formatarData( $lf->IMB_LCF_DATAVENCIMENTO).' R$: '.$lf->IMB_LCF_VALOR );

        return response( 'OK', 200);

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
        $lf = mdlLancamentoFuturo::find( $id );
        $lf->delete();

        return response( 'ok', 200);

    }

    public function desativar($id)
    {

        $lf = mdlLancamentoFuturo::find( $id );

        /*
        $cg = mdlCobrancaGeradaItemPerm::where( 'IMB_LCF_ID','=', $id )
        ->whereNull( 'IMB_COBRANCAGERADAPERM.IMB_CGR_DTHINATIVO')
        ->leftJoin( 'IMB_COBRANCAGERADAPERM','IMB_COBRANCAGERADAPERM.IMB_CGR_ID','IMB_COBRANCAGERADAITEMPERM.IMB_GR_ID ')
        ->first();

        if( $cg <> '') 
           return response()->json( 'Há boletos ativos emitidos com este lançamento! Não permitido a exclusão!');

*/
        


        $lf->IMB_LCF_DTHINATIVADO = date( 'Y-m-d H:i"');
        $lf->IMB_ATD_IDDESATIVADO = Auth::user()->IMB_ATD_ID;
        $lf->save();

        app('App\Http\Controllers\ctrRotinas')
        ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
        'Desativando  lancamento  -> '.app('App\Http\Controllers\ctrRotinas')->evento( $lf->IMB_TBE_ID)->IMB_TBE_NOME.
        ' - Valor: '.$lf->IMB_LCF_VALOR.
        ' - Vencimento '.app('App\Http\Controllers\ctrRotinas')->formatarData( $lf->IMB_LCF_DATAVENCIMENTO ));
 

        return response()->json( 'ok',200);

    }

    public function desativarLote($array)
    {
        $array = explode (",", $array);
        foreach( $array as $a )
        {
            Log::info('lf: '.$a );
            $lf = mdlLancamentoFuturo::find( $a );
            $lf->IMB_LCF_DTHINATIVADO = date( 'Y-m-d H:i"');
            $lf->IMB_ATD_IDDESATIVADO = Auth::user()->IMB_ATD_ID;
            $lf->save();

        }

        return response()->json( 'ok', 200);

    }

    public function countRecords( $id, $empresamaster, $evento )
    {
        if($evento == 'null' or $evento == '0')
            $lf = mdlLancamentoFuturo::where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID', '=' , $id )
            ->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID)
            ->get()->count();
        else
            $lf = mdlLancamentoFuturo::where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID', '=' , $id )
            ->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID)
            ->where('IMB_LANCAMENTOFUTURO.IMB_TBE_ID', '=' , $evento )
            ->get()->count();

        return $lf;
    }

    public function edit( $id)
    {

        $lf = mdlLancamentoFuturo::select(
            [
                DB::raw('IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_NOME'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_LANCAMENTOFUTURO.IMB_CLT_IDLOCADOR)
                            AS IMB_CLT_NOMELOCADOR'),
                'IMB_LCF_ID',
                'IMB_LANCAMENTOFUTURO.IMB_IMV_ID',
                'IMB_LANCAMENTOFUTURO.IMB_CTR_ID',
                'IMB_LANCAMENTOFUTURO.IMB_TBE_ID',
                'IMB_LCF_LOCADORCREDEB',
                'IMB_LCF_LOCATARIOCREDEB',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_RECEBIDO',
                'IMB_LCF_DATALANCAMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR',
                'IMB_LCF_RESTITUIDO',
                'IMB_RLT_NUMERO',
                'IMB_RLD_NUMERO',
                'IMB_LCF_TIPO',
                'IMB_LCF_FORMARECEBIMENTO',
                'IMB_LCF_FORMAPAGAMENTO',
                'IMB_LCF_AUTOMATICO',
                'IMB_LCF_NOSSONUMERO',
                'IMB_LCF_PAGO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_DATAPAGAMENTO',
                'IMB_LANCAMENTOFUTURO.FIN_CFC_ID',
                'FIN_LCC_ID',
                'FIN_APD_ID',
                'IMB_LCF_BOLETOAVULSO',
                'IMB_LCF_EMACORDO',
                'IMB_ACD_ID',
                'IMB_ACD_IDDESTINO',
                'IMB_LANCAMENTOFUTURO.IMB_ATD_ID',
                'IMB_LCF_INCMUL',
                'IMB_LCF_INCIRRF',
                'IMB_LCF_INCTAX',
                'IMB_LCF_INCJUROS',
                'IMB_LCF_INCCORRECAO',
                'IMB_LCF_GARANTIDO',
                'IMB_LCF_INCISS',
                'IMB_LCF_SOMENTELOCADOR',
                'IMB_RLD_LOCALPAGAMENTO',
                'IMB_CLT_IDLOCADOR',
                'IMB_LCF_REPASSEPENDENTE',
                'IMB_LCF_TC_COM_TA',
                'PROXIMOREPASSE',
                'IMB_LCF_NUMEROCONTROLE',
                'IMB_LCF_NUMPARREAJUSTE',
                'IMB_LCF_NUMPARCONTRATO',
                'IMB_LCF_ANTECIPADO',
                'IMB_LCF_FIXO',
                'IMB_LCF_COBRARTAXADMMES',
                'IMB_CTR_ALUGUELGARANTIDO'
            ]
        )
        ->leftJoin('IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID')
        ->leftJoin('IMB_CONTRATO', 'IMB_CONTRATO.IMB_CTR_ID', 'IMB_LANCAMENTOFUTURO.IMB_CTR_ID')
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_ID', '=' , $id )
        ->get();

        return $lf;


        //
    }

    public function abertoLocatarioParcela( $chave, $idcontrato, $somentedomes, $array )
    {

        $lf = mdlLancamentoFuturo::select(
            [
                DB::raw('IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_NOME'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_LANCAMENTOFUTURO.IMB_CLT_IDLOCADOR)
                            AS IMB_CLT_NOMELOCADOR'),
                'IMB_LCF_ID',
                'IMB_IMV_ID',
                'IMB_CTR_ID',
                'IMB_LANCAMENTOFUTURO.IMB_TBE_ID',
                'IMB_LCF_LOCADORCREDEB',
                'IMB_LCF_LOCATARIOCREDEB',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_RECEBIDO',
                'IMB_LCF_DATALANCAMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR',
                'IMB_LCF_RESTITUIDO',
                'IMB_RLT_NUMERO',
                'IMB_RLD_NUMERO',
                'IMB_LCF_TIPO',
                'IMB_LCF_FORMARECEBIMENTO',
                'IMB_LCF_FORMAPAGAMENTO',
                'IMB_LCF_AUTOMATICO',
                'IMB_LCF_NOSSONUMERO',
                'IMB_LCF_PAGO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_DATAPAGAMENTO',
                'IMB_LANCAMENTOFUTURO.FIN_CFC_ID',
                'FIN_LCC_ID',
                'FIN_APD_ID',
                'IMB_LCF_BOLETOAVULSO',
                'IMB_LCF_EMACORDO',
                'IMB_ACD_ID',
                'IMB_ACD_IDDESTINO',
                'IMB_ATD_ID',
                'IMB_LCF_INCMUL',
                'IMB_LCF_INCIRRF',
                'IMB_LCF_INCTAX',
                'IMB_LCF_INCJUROS',
                'IMB_LCF_INCCORRECAO',
                'IMB_LCF_GARANTIDO',
                'IMB_LCF_INCISS',
                'IMB_LCF_SOMENTELOCADOR',
                'IMB_RLD_LOCALPAGAMENTO',
                'IMB_CLT_IDLOCADOR',
                'IMB_LCF_REPASSEPENDENTE',
                'IMB_LCF_TC_COM_TA',
                'PROXIMOREPASSE',
                'IMB_LCF_NUMEROCONTROLE',
                'IMB_LCF_NUMPARREAJUSTE',
                'IMB_LCF_NUMPARCONTRATO',
                'IMB_LCF_ANTECIPADO',
                'IMB_LCF_CHAVE',
                'IMB_LCF_FIXO'

            ]
        )
        ->leftJoin('IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID')
        ->where('IMB_TABELAEVENTOS.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_LOCATARIOCREDEB','<>','N' )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATARECEBIMENTO','=', null )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DTHINATIVADO','=', null )
        ->where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID','=', $idcontrato );

        if( $array <> '' and $array <> '[]' )
        {
            $lf->whereIn('IMB_LANCAMENTOFUTURO.IMB_LCF_ID', $array );

        }
        else
        {

            if( $somentedomes == 'S' )
                $lf->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO', '=' , $chave );
            else
                $lf->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO', '<=' , $chave );
        }

        return DataTables::of($lf)->make(true);


    }

    public function incideMulta( $idevento, $idlf )
    {

        if( $idlf <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $idlf );
            if( $lf )
                return  $lf->IMB_LCF_INCMUL;
            else
                return  'N';
        }
        else
        if( $idevento <> 0 )
        {
            $lf = mdlEvento::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_TBE_ID','=',$idevento)->first();
            if( $lf )
                return  $lf->IMB_TBE_MULTA;
            else
                return  'N';

        }
        return 'N';
    }

    public function incideJuros( $idevento, $idlf )
    {

        if( $idlf <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $idlf );
            if( $lf )
                return  $lf->IMB_LCF_INCJUROS;
            else
                return  'N';

        }
        else
        if( $idevento <> 0 )
        {
            $lf = mdlEvento::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_TBE_ID','=',$idevento)->first();
            return  $lf->IMB_TBE_JUROS;

        }
        return "N";
    }


    public function incideIRRF( $idevento, $idlf )
    {

        if( $idlf <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $idlf );
            if( $lf )
                return $lf->IMB_LCF_INCIRRF;
            else
                return  'N';
        }
        else
        if( $idevento <> 0 )
        {
            $lf = mdlEvento::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_TBE_ID','=',$idevento)->first();
            if( $lf )
                return  $lf->IMB_TBE_IRRF;

        }
        return "N";
    }


    public function incideTaxaAdm( $idevento, $idlf )
    {

        if( $idlf <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $idlf );
            if( $lf )
                return  $lf->IMB_LCF_INCTAX;
            else
                return  'N';

        }
        else
        if( $idevento <> 0 )
        {
            $lf = mdlEvento::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_TBE_ID','=',$idevento)->first();
            return  $lf->IMB_TBE_TAXAADM;

        }
        return "N";
    }

    public function incideISS( $idevento, $idlf )
    {

        if( $idlf <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $idlf );
            if( $lf )
                return  $lf->IMB_LCF_INCISS;
            else
                return 'N';

        }
        else
        if( $idevento <> 0 )
        {
            $lf = mdlEvento::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_TBE_ID','=',$idevento)->first();
            return  $lf->IMB_TBE_INCISS;

        }
        return "N";
    }

    public function incideCorrecao( $idevento, $idlf )
    {

        if( $idlf <> 0 )
        {
            $lf = mdlLancamentoFuturo::find( $idlf );
            if( $lf )
                return  $lf->IMB_LCF_INCCORRECAO;
            else
                return  'N';

        }
        else
        if( $idevento <> 0 )
        {
            $lf = mdlEvento::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_TBE_ID','=',$idevento)->first();
            return  $lf->IMB_TBE_CORRECAO;

        }
        return "N";
    }


    public function teste( $id )
    {
        return "pegou o ID ".$id;
    }


    public function lancamentomeslocatario( $chave, $idcontrato, $array )
    {

        $lf = mdlLancamentoFuturo::select(
            [
                DB::raw('IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_NOME'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_LANCAMENTOFUTURO.IMB_CLT_IDLOCADOR)
                            AS IMB_CLT_NOMELOCADOR'),
                'IMB_LCF_ID',
                'IMB_IMV_ID',
                'IMB_CTR_ID',
                'IMB_LANCAMENTOFUTURO.IMB_TBE_ID',
                'IMB_LCF_LOCADORCREDEB',
                'IMB_LCF_LOCATARIOCREDEB',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_RECEBIDO',
                'IMB_LCF_DATALANCAMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR',
                'IMB_LCF_RESTITUIDO',
                'IMB_RLT_NUMERO',
                'IMB_RLD_NUMERO',
                'IMB_LCF_TIPO',
                'IMB_LCF_FORMARECEBIMENTO',
                'IMB_LCF_FORMAPAGAMENTO',
                'IMB_LCF_AUTOMATICO',
                'IMB_LCF_NOSSONUMERO',
                'IMB_LCF_PAGO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_DATAPAGAMENTO',
                'IMB_LANCAMENTOFUTURO.FIN_CFC_ID',
                'FIN_LCC_ID',
                'FIN_APD_ID',
                'IMB_LCF_BOLETOAVULSO',
                'IMB_LCF_EMACORDO',
                'IMB_ACD_ID',
                'IMB_ACD_IDDESTINO',
                'IMB_ATD_ID',
                'IMB_LCF_INCMUL',
                'IMB_LCF_INCIRRF',
                'IMB_LCF_INCTAX',
                'IMB_LCF_INCJUROS',
                'IMB_LCF_INCCORRECAO',
                'IMB_LCF_GARANTIDO',
                'IMB_LCF_INCISS',
                'IMB_LCF_SOMENTELOCADOR',
                'IMB_RLD_LOCALPAGAMENTO',
                'IMB_CLT_IDLOCADOR',
                'IMB_LCF_REPASSEPENDENTE',
                'IMB_LCF_TC_COM_TA',
                'PROXIMOREPASSE',
                'IMB_LCF_NUMEROCONTROLE',
                'IMB_LCF_NUMPARREAJUSTE',
                'IMB_LCF_NUMPARCONTRATO',
                'IMB_LCF_ANTECIPADO',
                'IMB_LCF_CHAVE',
                'IMB_LCF_FIXO'

            ]
        )
        ->leftJoin('IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID')
        ->where('IMB_TABELAEVENTOS.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_LOCATARIOCREDEB','<>','N' )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATARECEBIMENTO','=', null )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DTHINATIVADO','=', null )
        ->where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID','=', $idcontrato )
        ->whereRaw( "COALESCE( IMB_LCF_FIXO, 'N') <> 'S' ")
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO', '=' , $chave );


        if( $array <> '0' )
        {
            $lf = $lf->whereIn('IMB_LANCAMENTOFUTURO.IMB_LCF_ID', $array );

        };

        $lf = $lf->get();

        return $lf;

    }


    public function lancamentoLocadorAberto( $chave, $idcontrato, $array, $somentemes )
    {

        $lf = mdlLancamentoFuturo::select(
            [
                DB::raw('IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_NOME'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_LANCAMENTOFUTURO.IMB_CLT_IDLOCADOR)
                            AS IMB_CLT_NOMELOCADOR'),
                'IMB_LCF_ID',
                'IMB_IMV_ID',
                'IMB_CTR_ID',
                'IMB_LANCAMENTOFUTURO.IMB_TBE_ID',
                'IMB_LCF_LOCADORCREDEB',
                'IMB_LCF_LOCATARIOCREDEB',
                'IMB_LCF_DATAVENCIMENTO',
                'IMB_LCF_RECEBIDO',
                'IMB_LCF_DATALANCAMENTO',
                'IMB_LCF_OBSERVACAO',
                'IMB_LCF_VALOR',
                'IMB_LCF_RESTITUIDO',
                'IMB_RLT_NUMERO',
                'IMB_RLD_NUMERO',
                'IMB_LCF_TIPO',
                'IMB_LCF_FORMARECEBIMENTO',
                'IMB_LCF_FORMAPAGAMENTO',
                'IMB_LCF_AUTOMATICO',
                'IMB_LCF_NOSSONUMERO',
                'IMB_LCF_PAGO',
                'IMB_LCF_DATARECEBIMENTO',
                'IMB_LCF_DATAPAGAMENTO',
                'IMB_LANCAMENTOFUTURO.FIN_CFC_ID',
                'FIN_LCC_ID',
                'FIN_APD_ID',
                'IMB_LCF_BOLETOAVULSO',
                'IMB_LCF_EMACORDO',
                'IMB_ACD_ID',
                'IMB_ACD_IDDESTINO',
                'IMB_ATD_ID',
                'IMB_LCF_INCMUL',
                'IMB_LCF_INCIRRF',
                'IMB_LCF_INCTAX',
                'IMB_LCF_INCJUROS',
                'IMB_LCF_INCCORRECAO',
                'IMB_LCF_GARANTIDO',
                'IMB_LCF_INCISS',
                'IMB_LCF_SOMENTELOCADOR',
                'IMB_RLD_LOCALPAGAMENTO',
                'IMB_CLT_IDLOCADOR',
                'IMB_LCF_REPASSEPENDENTE',
                'IMB_LCF_TC_COM_TA',
                'PROXIMOREPASSE',
                'IMB_LCF_NUMEROCONTROLE',
                'IMB_LCF_NUMPARREAJUSTE',
                'IMB_LCF_NUMPARCONTRATO',
                'IMB_LCF_ANTECIPADO',
                'IMB_LCF_CHAVE',
                'IMB_LCF_COBRARTAXADMMES',
                'IMB_LCF_FIXO'
            ]
        )
        ->leftJoin('IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID')
        ->where('IMB_TABELAEVENTOS.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
        ->where('IMB_LANCAMENTOFUTURO.IMB_LCF_LOCADORCREDEB','<>','N' )
        ->where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID','=', $idcontrato )
        ->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->whereNull('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAPAGAMENTO')
        ->whereNull('IMB_LANCAMENTOFUTURO.IMB_LCF_DTHINATIVADO')
        ->whereRaw( "COALESCE( IMB_LCF_FIXO, 'N') <> 'S' ");


        if( substr( $somentemes,0,3) == 'RLT' )
        {
            $lf = $lf->where('IMB_LANCAMENTOFUTURO.IMB_RLT_NUMERO','=', TRIM( substr( $somentemes,3,10)) );
            Log::info( 'recibo: '.TRIM( substr( $somentemes,3,10)) );
        }

        $parametro2 = mdlParametros2::where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->first();

   //     Log::info('tudo eberto: '.$parametro2->IMB_PRM_REPASSEPEGATUDOABERTO);
        
        if( $parametro2->IMB_PRM_REPASSEPEGATUDOABERTO == 'S' )
                $lf = $lf->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO', '<=' , $chave );
        else
                $lf = $lf->where('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO', '=' , $chave );


        if( $array <> '0' )
        {
            $lf = $lf->whereIn('IMB_LANCAMENTOFUTURO.IMB_LCF_ID', $array );

        };


        $lf = $lf->get();

        return $lf;

    }

    function parcelasVencimentoNumero( $contrato, $ldlt )
    {


        $lfa = DB::table('IMB_LANCAMENTOFUTURO')->distinct()->orderBy('IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO')
        ->where( 'IMB_LANCAMENTOFUTURO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_CTR_ID','=',$contrato);

        if( $ldlt == 'D' ) //A VENCER DO LOCADOR
        {
            $lfa = $lfa->where( 'IMB_LCF_LOCADORCREDEB','<>','N');
            $lfa = $lfa->whereNull( 'IMB_LCF_DATAPAGAMENTO');
        };

        if( $ldlt == 'T' ) //A VENCER DO LOCATARIO
        {
            $lfa = $lfa->where( 'IMB_LCF_LOCATARIOCREDEB','<>','N');
            $lfa = $lfa->whereNull( 'IMB_LCF_DATARECEBIMENTO');
        }

        $lfa = $lfa->get( ['IMB_LANCAMENTOFUTURO.IMB_LCF_DATAVENCIMENTO','IMB_LCF_NUMPARCONTRATO'] );

        return $lfa;
//        return 'Parc.: '.$lfa->IMB_LCF_NUMPARCONTRATO.'('.$lfa->IMB_LCF_DATAVENCIMENTO.')';




    }

    public function pegarNumeroParcelaConformeVencimento( $contrato, $datavencimento )
    {
        $lf = mdlLancamentoFuturo::select( [ 'IMB_LCF_NUMPARCONTRATO' ] )
        ->where( 'IMB_CTR_ID','=',$contrato )
        ->where( 'IMB_LCF_DATAVENCIMENTO','=',formatarData($datavencimento) )
        ->first();

        if( $lf )
            $parcelacontrato = $lf->IMB_LCF_NUMPARCONTRATO;
        else
        {
            $parcelacontrato = 0;
            $parcela = mdlLancamentoFuturo::
                    where('IMB_CTR_ID', $contrato)
                    ->where( 'IMB_TBE_ID','=',1)
                    ->max('IMB_LCF_NUMPARCONTRATO');
            $parcelacontrato = $parcela + 1;
        }

        return $parcelacontrato;
    }

    public function verificarAluguelJaLancado( $idcontrato )
    {
        $lf = mdlLancamentofuturo::where( 'IMB_CTR_ID','=', $idcontrato )
        ->where( 'IMB_TBE_ID','=', '1' )
        ->whereNull( 'IMB_LCF_DTHINATIVADO')
        ->first();

        if( $lf ) return response()->json( 'ok',200);

        return response()->json('NE', 404 );
    }

    public function listvencimentosselect( $id )
    {

    $lf = DB::table('IMB_LANCAMENTOFUTURO')
    ->select('IMB_LCF_DATAVENCIMENTO')
    ->distinct()
    ->where('IMB_LANCAMENTOFUTURO.IMB_CTR_ID', '=' , $id )
    ->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
    ->get();

    return $lf;


    //return [ $lf, $registros ];


    //
}


public function lancamentosRealizados( Request $request )
{

    $datini = $request->datainicio;
    $datfim = $request->datafim;
    $evento = $request->evento;

    if( $datini == null ) $datini = date('Y-m-d');
    if( $datfim == null ) $datfim = date('Y-m-d');

    $lf = mdlLancamentoFuturo::select(
        [
            DB::raw('IMB_TABELAEVENTOS.IMB_TBE_NOME AS IMB_TBE_NOME'),
        'IMB_LCF_ID',
        'IMB_LANCAMENTOFUTURO.IMB_IMV_ID',
        'IMB_LANCAMENTOFUTURO.IMB_CTR_ID',
        'IMB_LANCAMENTOFUTURO.IMB_TBE_ID',
        'IMB_LCF_LOCADORCREDEB',
        'IMB_LCF_LOCATARIOCREDEB',
        'IMB_LCF_DATAVENCIMENTO',
        'IMB_LCF_RECEBIDO',
        'IMB_LCF_DATALANCAMENTO',
        'IMB_LCF_OBSERVACAO',
        'IMB_LCF_VALOR',
        'IMB_LCF_RESTITUIDO',
        'IMB_RLT_NUMERO',
        'IMB_RLD_NUMERO',
        'IMB_LCF_TIPO',
        'IMB_LCF_FORMARECEBIMENTO',
        'IMB_LCF_FORMAPAGAMENTO',
        'IMB_LCF_AUTOMATICO',
        'IMB_LCF_NOSSONUMERO',
        'IMB_LCF_PAGO',
        'IMB_LCF_DATARECEBIMENTO',
        'IMB_LCF_DATAPAGAMENTO',
        'IMB_LANCAMENTOFUTURO.FIN_CFC_ID',
        'FIN_LCC_ID',
        'FIN_APD_ID',
        'IMB_LCF_BOLETOAVULSO',
        'IMB_LCF_EMACORDO',
        'IMB_ACD_ID',
        'IMB_ACD_IDDESTINO',
        'IMB_LANCAMENTOFUTURO.IMB_ATD_ID',
        'IMB_LCF_INCMUL',
        'IMB_LCF_INCIRRF',
        'IMB_LCF_INCTAX',
        'IMB_LCF_INCJUROS',
        'IMB_LCF_INCCORRECAO',
        'IMB_LCF_GARANTIDO',
        'IMB_LCF_INCISS',
        'IMB_LCF_SOMENTELOCADOR',
        'IMB_RLD_LOCALPAGAMENTO',
        'IMB_CLT_IDLOCADOR',
        'IMB_LCF_REPASSEPENDENTE',
        'IMB_LCF_TC_COM_TA',
        'PROXIMOREPASSE',
        'IMB_LCF_NUMEROCONTROLE',
        'IMB_LCF_NUMPARREAJUSTE',
        'IMB_LCF_NUMPARCONTRATO',
        'IMB_LCF_ANTECIPADO',
        'IMB_LCF_DTHINATIVADO',
        'IMB_LCF_CHAVE',
        'IMB_CGR_ID',
        'IMB_CTR_REFERENCIA',
        'IMB_LCF_FIXO',
        DB::raw('imovel( IMB_LANCAMENTOFUTURO.IMB_IMV_ID) ENDERECO' )

    ]
)
->leftJoin('IMB_TABELAEVENTOS', 'IMB_TABELAEVENTOS.IMB_TBE_ID', 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID')
->leftJoin('IMB_CONTRATO', 'IMB_CONTRATO.IMB_CTR_ID', 'IMB_LANCAMENTOFUTURO.IMB_CTR_ID')
->where('IMB_LANCAMENTOFUTURO.IMB_IMB_ID', '=' , Auth::user()->IMB_IMB_ID )
->where('IMB_LCF_DATAVENCIMENTO','>=', $datini )
->where('IMB_LCF_DATAVENCIMENTO','<=', $datfim )
->whereRaw( "COALESCE( IMB_LCF_FIXO, 'N') <> 'S' ");

if( $evento <> '' )
            $lf = $lf->where( 'IMB_LANCAMENTOFUTURO.IMB_TBE_ID','=', $evento );

$lf = $lf->get();


    return DataTables::of($lf)->make(true);


//
}

public function gerarFixos( $idContrato, $datavencimento, $cliente )
{
    //Log::info("CLIENTE $cliente");
    if( $cliente == 'LT')
    {
        $fixos = mdlLancamentoFuturo::whereNull('IMB_LCF_DTHINATIVADO')
        ->whereRaw( "coalesce( IMB_LCF_FIXO,'N')='S' ")
        ->whereRaw( "not exists( select IMB_LCF_IDFIXO FROM IMB_LANCAMENTOFUTURO F
                WHERE F.IMB_LCF_IDFIXO = IMB_LANCAMENTOFUTURO.IMB_LCF_ID 
                AND F.IMB_LCF_DATARECEBIMENTO IS NULL
                AND F.IMB_LCF_LOCATARIOCREDEB<> 'N'
                AND F.IMB_LCF_DATAVENCIMENTO = '$datavencimento' AND F.IMB_CTR_ID = $idContrato
                AND F.IMB_LCF_DTHINATIVADO IS NULL )")
        ->whereRaw( "IMB_CTR_ID = $idContrato" )
        ->where( 'IMB_LANCAMENTOFUTURO.IMB_LCF_LOCATARIOCREDEB', '<>','N')
        //dd( $fixos->toSql() );
        ->get();
        //Log::info( 'passou pelo LT');
    }
    else
    {
        $fixos = mdlLancamentoFuturo::whereNull('IMB_LCF_DTHINATIVADO')
        ->whereRaw( "coalesce( IMB_LCF_FIXO,'N')='S' ")
        ->whereRaw( "not exists( select IMB_LCF_IDFIXO FROM IMB_LANCAMENTOFUTURO F
                WHERE F.IMB_LCF_IDFIXO = IMB_LANCAMENTOFUTURO.IMB_LCF_ID 
                AND F.IMB_LCF_DATAPAGAMENTO IS NULL
                AND F.IMB_LCF_LOCADORCREDEB <> 'N'
                AND F.IMB_LCF_DATAVENCIMENTO = '$datavencimento' AND F.IMB_CTR_ID = $idContrato
                AND F.IMB_LCF_DTHINATIVADO IS NULL )")
        ->whereRaw( "IMB_CTR_ID = $idContrato" )
        ->where( 'IMB_LANCAMENTOFUTURO.IMB_LCF_LOCADORCREDEB', '<>','N')
        ->get();
        //Log::info( 'passou pelo LD');
    }

    foreach( $fixos as $fixo )
    {
        

       $lf = new mdlLancamentoFuturo;
       $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
       $lf->IMB_CTR_ID = $fixo->IMB_CTR_ID;
       $lf->IMB_LCF_VALOR = $fixo->IMB_LCF_VALOR;
        $lf->IMB_LCF_LOCATARIOCREDEB = $fixo->IMB_LCF_LOCATARIOCREDEB;
        $lf->IMB_LCF_LOCADORCREDEB =  $fixo->IMB_LCF_LOCADORCREDEB;

       //Log::info( 'LT: '. $lf->IMB_LCF_LOCATARIOCREDEB);
       //Log::info( 'ld: '. $lf->IMB_LCF_LOCADORCREDEB);

       $lf->IMB_LCF_DATAVENCIMENTO =$datavencimento;
       $lf->IMB_LCF_TIPO = 'M';
       $lf->IMB_IMV_ID = $fixo->IMB_IMV_ID;
       $lf->IMB_CLT_IDLOCADOR = $fixo->IMB_CLT_IDLOCADOR;
       $lf->IMB_TBE_ID = $fixo->IMB_TBE_ID;
       $lf->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
       $lf->IMB_LCF_INCMUL =$fixo->IMB_LCF_INCMUL;
       $lf->IMB_LCF_INCIRRF =$fixo->IMB_LCF_INCIRRF;
       $lf->IMB_LCF_INCTAX = $fixo->IMB_LCF_INCTAX ;
       $lf->IMB_LCF_INCJUROS = $fixo->IMB_LCF_INCJUROS ;
       $lf->IMB_LCF_INCCORRECAO =  $fixo->IMB_LCF_INCCORRECAO ;
       $lf->IMB_LCF_GARANTIDO = $fixo->IMB_LCF_GARANTIDO ;
       $lf->IMB_LCF_INCISS = $fixo->IMB_LCF_INCISS;
       $lf->IMB_LCF_OBSERVACAO = $fixo->IMB_LCF_OBSERVACAO ;
       $lf->IMB_LCF_DATALANCAMENTO = date( 'Y/m/d');
       $lf->IMB_LCF_IDFIXO = $fixo->IMB_LCF_ID;
       $lf->save();

       app('App\Http\Controllers\ctrRotinas')
       ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
       'Incluindo um lancamento recorrente(fixo) -> '.app('App\Http\Controllers\ctrRotinas')->evento( $lf->IMB_TBE_ID)->IMB_TBE_NOME.
       ' - Valor: '.$lf->IMB_LCF_VALOR.
       ' - Vencimento '.app('App\Http\Controllers\ctrRotinas')->formatarData( $datavencimento ));

       
       
    }

}

public function storeArray(Request $request)
{

    $lfs = $request->lfs;

    //dd( $lfs );
    Log::info('****************************************************************');
    Log::info('Contrato: '.$request->IMB_CTR_ID );
    
    foreach( $lfs as $lfreq )
    {

        $idevento = $lfreq["IMB_TBE_ID"];

        //Log::info( "ctrLancamentoFuturo - Contrato: '.$request->IMB_CTR_ID ).' - '.$idevento");
        $tabelaevento = mdlEvento::find( $idevento );

        $gravarirrf = $lfreq["IMB_LCF_INCIRRF"];
        $gravarTA = $lfreq["IMB_LCF_INCTAX"];
        $gravarmulta = $lfreq["IMB_LCF_INCMUL"];
        $gravarjuros =  $lfreq["IMB_LCF_INCJUROS"];
        $gravarcorrecao = $lfreq["IMB_LCF_INCCORRECAO"] ;
        $gravariss =  $lfreq["IMB_LCF_INCISS"] ;
        
        Log::info('antes: '.$gravariss);
        if( $gravarirrf == '' )
            $gravarirrf = $tabelaevento->IMB_TBE_IRRF;

        if( $gravarTA == '' )
            $gravarTA = $tabelaevento->IMB_TBE_TAXAADM;

        if( $gravarmulta == '' )
            $gravarmulta = $tabelaevento->IMB_TBE_MULTA;

        if( $gravarjuros == '' )
            $gravarjuros = $tabelaevento->IMB_TBE_JUROS;

        if( $gravariss == '' )
        $gravariss = $tabelaevento->IMB_TBE_INCISS;
    
            Log::info(  "tabelaevento->IMB_TBE_INCISS:  $tabelaevento->IMB_TBE_INCISS");
            Log::info(  "gravariss depois $gravariss");
        

        
        $id = Auth::user()->IMB_IMB_ID;
        $idctr = $lfreq["IMB_CTR_ID"];
        $observacao = $lfreq["IMB_LCF_OBSERVACAO"] ;
        if( $observacao == ''  and  $lfreq["IMB_TBE_ID"] == '1' )
           $observacao = app('App\Http\Controllers\ctrRotinas')->gerarPeriodo( $idctr, App('App\Http\Controllers\ctrRotinas')->formatarData($lfreq["IMB_LCF_DATAVENCIMENTO"]) );
        

        $lf = new mdlLancamentoFuturo();

        $lf->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $lf->IMB_CTR_ID = $idctr;
        $lf->IMB_LCF_VALOR = $lfreq["IMB_LCF_VALOR"];
        $lf->IMB_LCF_LOCADORCREDEB = $lfreq["IMB_LCF_LOCADORCREDEB"];
        $lf->IMB_LCF_LOCATARIOCREDEB = $lfreq["IMB_LCF_LOCATARIOCREDEB"];
        $lf->IMB_LCF_DATAVENCIMENTO = App('App\Http\Controllers\ctrRotinas')->formatarData($lfreq["IMB_LCF_DATAVENCIMENTO"]);
        $lf->IMB_LCF_TIPO = $lfreq["IMB_LCF_TIPO"];
        $lf->IMB_IMV_ID = $lfreq["IMB_IMV_ID"];
        $lf->IMB_CLT_IDLOCADOR = $lfreq["IMB_CLT_IDLOCADOR"];
        $lf->IMB_TBE_ID = $lfreq["IMB_TBE_ID"];
        $lf->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $lf->IMB_LCF_INCMUL =$gravarmulta;
        $lf->IMB_LCF_INCIRRF =$gravarirrf;
        $lf->IMB_LCF_INCTAX = $gravarTA;
        $lf->IMB_LCF_INCJUROS = $gravarjuros;
        $lf->IMB_LCF_INCCORRECAO =  $gravarcorrecao;
        $lf->IMB_LCF_GARANTIDO = $lfreq["IMB_LCF_GARANTIDO"];
        $lf->IMB_LCF_INCISS = $gravariss;
        $lf->IMB_LCF_OBSERVACAO = $observacao;;
        $lf->IMB_LCF_DATALANCAMENTO = date( 'Y/m/d');
        $lf->IMB_LCF_COBRARTAXADMMES =$lfreq["IMB_LCF_COBRARTAXADMMES"];
        $lf->IMB_LCF_FIXO = $lfreq["IMB_LCF_FIXO"];

        $lf->save();
        app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( 0, $lf->IMB_CTR_ID, 0, 0,0 ,
                'Incluindo um lançamento de EVENTO '.app( 'App\Http\Controllers\ctrRotinas')->pegaNomeEvento( $idevento ). ' '.
                ' para o vencimento '.app('App\Http\Controllers\ctrRotinas')->formatarData( $lf->IMB_LCF_DATAVENCIMENTO).' R$: '.$lf->IMB_LCF_VALOR );
    }

    return response( 'OK', 200);

}

public function fixosCount( $id )
{
    $lf = mdlLancamentoFuturo::where( 'IMB_CTR_ID','=', $id)
    ->where('IMB_LCF_FIXO','=', 'S' )
    ->whereNull( 'IMB_LCF_DTHINATIVADO')
    ->count();

    return $lf;
}



}
