<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlContaCaixa;
use DB;
use Auth;

class ctrContaCaixa extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'financeiro.contacaixa');
    }


    public function find( $id )
    {
        $gc = mdlContaCaixa::find( $id );
        return $gc;
    }

    public function salvar( Request $request )
    {
        $FIN_CCX_ID = $request->FIN_CCX_ID;
        $FIN_CCX_DESCRICAO = $request->FIN_CCX_DESCRICAO;
        $FIN_CCX_BANCO = $request->FIN_CCX_BANCO;

        if( $FIN_CCX_ID == '' )
            $gc = new mdlContaCaixa;
        else
            $gc = mdlContaCaixa::Find( $FIN_CCX_ID  );

        $gc->FIN_CCX_DESCRICAO = $FIN_CCX_DESCRICAO;
        $gc->FIN_CCX_BANCO = $FIN_CCX_BANCO;
        $gc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $gc->FIN_CCX_DATAHORA = date('Y-m-d H:i:s');
        $gc->FIN_CCI_BANCONUMERO = $request->FIN_CCI_BANCONUMERO;
        $gc->FIN_CCI_BANCONOME = $request->FIN_CCI_BANCONOME;
        $gc->FIN_CCI_AGENCIANUMERO = $request->FIN_CCI_AGENCIANUMERO;
        $gc->FIN_CCI_AGENCIADV = $request->FIN_CCI_AGENCIADV;
        $gc->FIN_CCI_AGENCIANOME = $request->FIN_CCI_AGENCIANOME;
        $gc->FIN_CCI_COOPNUMERO = $request->FIN_CCI_COOPNUMERO;
        $gc->FIN_CCI_COOPDV = $request->FIN_CCI_COOPDV;
        $gc->FIN_CCI_CONCORNUMERO = $request->FIN_CCI_CONCORNUMERO;
        $gc->FIN_CCI_CONCORDIGITO = $request->FIN_CCI_CONCORDIGITO;
        $gc->FIN_CCI_CONCORNOME = $request->FIN_CCI_CONCORNOME;
        $gc->FIN_CCI_PESSOA = $request->FIN_CCI_PESSOA;
        $gc->FIN_CCI_CGCCPF = $request->FIN_CCI_CGCCPF;
        $gc->FIN_CCI_ENDERECO = $request->FIN_CCI_ENDERECO;
        $gc->FIN_CCI_CEP = $request->FIN_CCI_CEP;
        $gc->CEP_BAI_NOME = $request->CEP_BAI_NOME;
        $gc->CEP_CID_NOME = $request->CEP_CID_NOME;
        $gc->CEP_UF_SIGLA = $request->CEP_UF_SIGLA;
        $gc->FIN_CCI_IDENTEMPRESA = $request->FIN_CCI_IDENTEMPRESA;
        $gc->IMB_CCI_IDCLIENTEARQREM = $request->IMB_CCI_IDCLIENTEARQREM;
        $gc->FIN_CCI_COBRANCAVALOR = $request->FIN_CCI_COBRANCAVALOR;
        $gc->FIN_CCI_COBRANCACARTEIRA = $request->FIN_CCI_COBRANCACARTEIRA;
        $gc->FIN_CCI_COBRANCAVARIACAO = $request->FIN_CCI_COBRANCAVARIACAO;
        $gc->fin_cci_codigotransmissao = $request->fin_cci_codigotransmissao;
        $gc->FIN_CCI_COBRANCAARQSEQ = $request->FIN_CCI_COBRANCAARQSEQ;
        $gc->FIN_CCI_CONVENIO = $request->FIN_CCI_CONVENIO;
        $gc->FIN_CCI_COMPSANTANDERREMESSA = $request->FIN_CCI_COMPSANTANDERREMESSA;
        $gc->FIN_CCO_COBRANCALAYOUT = $request->FIN_CCO_COBRANCALAYOUT;
        $gc->FIN_CCI_TIPOEMISSAO = $request->FIN_CCI_TIPOEMISSAO;
        $gc->FIN_CCI_COBRANCAREGISTRADA = $request->FIN_CCI_COBRANCAREGISTRADA;
        $gc->FIN_CCI_RAPIDAREGISTRO = $request->FIN_CCI_RAPIDAREGISTRO;
        $gc->FIN_CCX_ARQCOBRANCANOVOPADRAO = $request->FIN_CCX_ARQCOBRANCANOVOPADRAO;
        $gc->FIN_CCI_TIPOEMISSAO = $request->FIN_CCI_TIPOEMISSAO;
        $gc->FIN_CCI_PREFIXONOSSONUMERO = $request->FIN_CCI_PREFIXONOSSONUMERO;
        $gc->FIN_CCI_NOSSONUMERO = $request->FIN_CCI_NOSSONUMERO;
        $gc->FIN_CCI_NOSSONUMEROCASAS = $request->FIN_CCI_NOSSONUMEROCASAS;
        $gc->fin_cci_conveniodocnovo = $request->fin_cci_conveniodocnovo;
        $gc->FIN_CCX_DOCPATH = $request->FIN_CCX_DOCPATH;
        $gc->fin_cci_LAYOUTCOBRANCA = $request->fin_cci_LAYOUTCOBRANCA;
        $gc->FIN_CCI_CODIGOFLASH = $request->FIN_CCI_CODIGOFLASH;
        $gc->FIN_CCI_COBRANCAARQREMLOC = $request->FIN_CCI_COBRANCAARQREMLOC;
        $gc->FIN_CCX_COBPIX = $request->FIN_CCX_COBPIX;
        $gc->FIN_CCX_TIPOCONTA = $request->FIN_CCX_TIPOCONTA;
        
        $gc->save();

        return response()->json( 'ok',200);

    }


    public function carga( $somenteconta )
    {

        if( $somenteconta == 'S')
            $conta = mdlContaCaixa::select(
                [
                    'FIN_CCX_ID',
                    'FIN_CCX_TIPOCONTA',
                    'FIN_CCX_DESCRICAO',
                    'FIN_CCI_AGENCIANUMERO',
                    'FIN_CCI_AGENCIADIGITO',
                    'FIN_CCI_BANCONUMERO',
                    'FIN_CCX_BANCO',
                    'FIN_CCI_CONCORNUMERO',
                    'FIN_CCI_CONCORDIGITO',
                    'FIN_CCX_DTHINATIVO',
                    DB::raw( "concat(FIN_CCX_DESCRICAO,' Ag.:',FIN_CCI_AGENCIANUMERO,' - C/C: ', FIN_CCI_CONCORNUMERO) as conta")

                ]
            )->where('FIN_CCX_BANCO','=','S')
            ->where( 'IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID)
            ->orderBy("FIN_CCX_DESCRICAO")
            ->get();
        else
        $conta = mdlContaCaixa::select(
            [
                'FIN_CCX_ID',
                'FIN_CCX_TIPOCONTA',
                'FIN_CCX_DESCRICAO',
                'FIN_CCI_AGENCIANUMERO',
                'FIN_CCX_BANCO',
                'FIN_CCI_AGENCIADIGITO',
                'FIN_CCI_BANCONUMERO',
                'FIN_CCI_CONCORNUMERO',
                'FIN_CCI_CONCORDIGITO',
                'FIN_CCX_DTHINATIVO',
                DB::raw( "concat(FIN_CCX_DESCRICAO,' Ag.:',FIN_CCI_AGENCIANUMERO,' - C/C: ', FIN_CCI_CONCORNUMERO) as conta")

            ]
            )
            ->where( 'IMB_IMB_ID', '=', Auth::user()->IMB_IMB_ID)
            ->orderBy("FIN_CCX_DESCRICAO")->get();
        return $conta;
    }

    public function inativar( $id )
    {
        $gc = mdlContaCaixa::Find( $id  );

        $gc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;

        if ( $gc->FIN_CCX_DTHINATIVO=='')
            $gc->FIN_CCX_DTHINATIVO = date('Y-m-d H:i:s');
        else
        $gc->FIN_CCX_DTHINATIVO = null;

        $gc->save();

        return response()->json( 'ok',200);

    }

    public function nomeConta( $id )
    {
        $gc = mdlContaCaixa::find( $id );
        return $gc->FIN_CCX_DESCRICAO;
    }





}
