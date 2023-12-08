<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImobiliaria;
use App\mdlParametros;
use App\mdlParametros2;
use Auth;

class ctrImobiliaria extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function carga( $id )
    {
        $imob = mdlImobiliaria::where( "IMB_IMB_IDMASTER",'=', Auth::user()->IMB_IMB_ID)->get();

        return $imob;
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

    public function store(Request $request)
    {
        if( $request->IMB_IMB_ID == '' )
            $imob =NEW  mdlImobiliaria;
        else
            $imob = mdlImobiliaria::find( $request->IMB_IMB_ID );

        $imob->IMB_IMB_RAZAOSOCIAL                 = $request->IMB_IMB_RAZAOSOCIAL;
        $imob->IMB_IMB_NOME                 = $request->IMB_IMB_NOME;
        $imob->IMB_IMB_PESSOA                 = $request->IMB_IMB_PESSOA;
        $imob->IMB_IMB_CRECI                 = $request->IMB_IMB_CRECI;
        $imob->IMB_IMB_IE                 = $request->IMB_IMB_IE;
        $imob->IMB_IMB_CGC                 = $request->IMB_IMB_CGC;
        $imob->IMB_IMB_REPRESENTANTE                 = $request->IMB_IMB_REPRESENTANTE;
        $imob->IMB_IMB_REPRESENTANTECPF                 = $request->IMB_IMB_REPRESENTANTECPF;
        $imob->IMB_IMB_PADRAO                 = $request->IMB_IMB_PADRAO;
        $imob->IMB_IMB_ENDERECO                 = $request->IMB_IMB_ENDERECO;
        $imob->IMB_IMB_CEP                 = $request->IMB_IMB_CEP;
        $imob->CEP_BAI_NOME                 = $request->CEP_BAI_NOME;
        $imob->CEP_CID_NOME                 = $request->CEP_CID_NOME;
        $imob->CEP_UF_SIGLA                 = $request->CEP_UF_SIGLA;
        $imob->IMB_IMB_DDD                 = $request->IMB_IMB_DDD;
        $imob->IMB_IMB_TELEFONE1                 = $request->IMB_IMB_TELEFONE1;
        $imob->IMB_IMB_TELEFONE2                 = $request->IMB_IMB_TELEFONE2;
        $imob->IMB_IMB_WHATSAPP                 = $request->IMB_IMB_WHATSAPP;
        $imob->IMB_IMB_EMAIL                 = $request->IMB_IMB_EMAIL;
        $imob->IMB_IMB_URL                 = $request->IMB_IMB_URL;
        $imob->IMB_IMB_URLIMOVELSITE                 = $request->IMB_IMB_URLIMOVELSITE;
        $imob->IMB_IMB_IDMASTER                 = Auth::user()->IMB_IMB_ID;
        $imob->save();


        if( $request->IMB_IMB_ID == '' )
        {
            $param = new mdlParametros;
            $param->IMB_IMB_ID = $imob->IMB_IMB_ID;

            $param2 = new mdlParametros2;
            $param2->IMB_IMB_ID = $imob->IMB_IMB_ID;
        }
        else
        {
            $param = mdlParametros::find( $request->IMB_IMB_ID );
            $param2 = mdlParametros2::find( $request->IMB_IMB_ID );
        }

        //aba encargos
        $param->IMB_PRM_JUROSAPOSUMMES                 = $request->IMB_PRM_JUROSAPOSUMMES;
        $param->IMB_PRM_COBBANJUROSDIA                 = $request->IMB_PRM_COBBANJUROSDIA;
        $param->IMB_PRM_COBBANCORRECAO                 = $request->IMB_PRM_COBBANCORRECAO;
        $param->IMB_PRM_MULTAREPASSEGAR                 = $request->IMB_PRM_MULTAREPASSEGAR;
        $param->IMB_PRM_JUROSREPASSEGAR                 = $request->IMB_PRM_JUROSREPASSEGAR;
        $param->IMB_PRM_CORRECAOREPASSEGAR                 = $request->IMB_PRM_CORRECAOREPASSEGAR;
        $param->IMB_PRM_MULTAREPASSENAOGAR                 = $request->IMB_PRM_MULTAREPASSENAOGAR;
        $param->IMB_PRM_JUROSREPASSENAOGAR                 = $request->IMB_PRM_JUROSREPASSENAOGAR;
        $param->IMB_PRM_CORRECAOREPASSENAOGAR                 = $request->IMB_PRM_CORRECAOREPASSENAOGAR;
        $param->FIN_CFC_IDDESCONTOS                 = $request->FIN_CFC_IDDESCONTOS;
        $param->FIN_CFC_IDMULTA                 = $request->FIN_CFC_IDMULTA;
        $param->FIN_CFC_IDJUROS                 = $request->FIN_CFC_IDJUROS;
        $param->IMB_PRM_USARPARCELAS                 = $request->IMB_PRM_USARPARCELAS;
        

        $param2->IMB_PRM_PERDEBONIFAPOSDIAS                 = $request->IMB_PRM_PERDEBONIFAPOSDIAS;

        //ABA COBRANCA BANCARIA
        $param->IMB_PRM_COBBANVALOR                 = $request->IMB_PRM_COBBANVALOR;
        $param->IMB_TBE_VALORTARALTVEM                 = $request->IMB_TBE_VALORTARALTVEM;
        $param->IMB_PRM_COBRARTARALTVEN                 = $request->IMB_PRM_COBRARTARALTVEN;
        $param->IMB_PRM_COBBANINSTRUCAO                 = $request->IMB_PRM_COBBANINSTRUCAO;
        $param->IMB_TBE_IDTARALTVEN                 = $request->IMB_TBE_IDTARALTVEN;
        $param->IMB_PRM_MENSAGEMBOLETO                 = $request->IMB_PRM_MENSAGEMBOLETO;
        $param->IMB_PRM_COBBANTOLERANCIA                 = $request->IMB_PRM_COBBANTOLERANCIA;
        $param2->IMB_PRM_BAIXARETBANDATAATUAL                 = $request->IMB_PRM_BAIXARETBANDATAATUAL;
        $param2->imb_prm_conciliarretornocob                 = $request->imb_prm_conciliarretornocob;
        $param2->IMB_PRM_BAIXAAUTOMTOTAL                 = $request->IMB_PRM_BAIXAAUTOMTOTAL;
        $param2->IMB_PRM_COBIMPRECRETORNO                 = $request->IMB_PRM_COBIMPRECRETORNO;
        $param2->IMB_PRM_DIADMAIS                 = $request->IMB_PRM_DIADMAIS;
        //$param2->IMB_PRM_TOLERANCIABOLETO                 = $request->IMB_PRM_TOLERANCIABOLETO;
        $param->IMB_PRM_COBMULTANDIASPER                 = $request->IMB_PRM_COBMULTANDIASPER;
        $param->IMB_PRM_COBMULTANDIAS                 = $request->IMB_PRM_COBMULTANDIAS;
        $param->IMB_PRM_MODRECLOCATARIO                 = $request->IMB_PRM_MODRECLOCATARIO;
        $param->IMB_PRM_COBBANTOLERANCIA                 = $request->IMB_PRM_COBBANTOLERANCIA;
        
        
        //IMPOSTOS
        $param->IMB_PRM_ISSALIQUOTA                 = $request->IMB_PRM_ISSALIQUOTA;
        $param->IMB_PRM_ISSALIQUOTA1005                 = $request->IMB_PRM_ISSALIQUOTA1005;
        $param2->IMB_PRM_TOTALIMPOSTOS                 = $request->IMB_PRM_TOTALIMPOSTOS;
        $param2->IMB_PRM_TOTALIMPOSTOS1005                 = $request->IMB_PRM_TOTALIMPOSTOS1005;
        $param2->IMB_PRM_INSCRICAOMUNICIPAL                 = $request->IMB_PRM_INSCRICAOMUNICIPAL;
        $param2->IMB_PRM_CODIGOIBGE                 = $request->IMB_PRM_CODIGOIBGE;
        $param2->IMB_PRM_NFESUARIO                 = $request->IMB_PRM_NFESUARIO;
        $param2->IMB_PRM_NFESENHA                 = $request->IMB_PRM_NFESENHA;
        $param2->IMB_PRM_NFELINKSISTEMA                 = $request->IMB_PRM_NFELINKSISTEMA;
        $param->IMB_PRM_IRRFMINIMO                 = $request->IMB_PRM_IRRFMINIMO;
        $param2->IMB_PRM_ISSLOCADORCREDEB                 = $request->IMB_PRM_ISSLOCADORCREDEB;
        $param->IMB_PRM_RETERISSTAXACONTRATO                 = $request->IMB_PRM_RETERISSTAXACONTRATO;
        $param2->IMB_PRM_ISSRESPEITARUSUARIO                 = $request->IMB_PRM_ISSRESPEITARUSUARIO;
        $param2->IMB_PRM_NUNCAIRRF                 = $request->IMB_PRM_NUNCAIRRF;
        $param2->IMB_PRM_IRRFRESPEITARCTR                 = $request->IMB_PRM_IRRFRESPEITARCTR;
        $param2->IMB_PRM_NFEAOBAIXAR                 = $request->IMB_PRM_NFEAOBAIXAR;
        $param2->IMB_PRM_NOTASERIE                 = $request->IMB_PRM_NOTASERIE;
        
        //geral
        $param->IMB_PRM_CODIFICACONTRATO  = $request->IMB_PRM_CODIFICACONTRATO;
        $param2->IMB_PRM_VALORDOCELETRONICO  = $request->IMB_PRM_VALORDOCELETRONICO;
        $param2->IMB_PRM_MODULOAPROVACAO  = $request->IMB_PRM_MODULOAPROVACAO;
        $param2->IMB_PRM_ARREDONTARREAJSTE  = $request->IMB_PRM_ARREDONTARREAJSTE;
        $param2->IMB_PRM_REPASSEPEGATUDOABERTO  = $request->IMB_PRM_REPASSEPEGATUDOABERTO;
        $param2->IMB_PRM_PONTUAL_SOB_ACORDO  = $request->IMB_PRM_PONTUAL_SOB_ACORDO;

        $param2->IMB_CODIGOATIVIDADE                 = $request->IMB_CODIGOATIVIDADE;
        $param2->IMB_FORPAG_IDLOCADOR                 = $request->IMB_FORPAG_IDLOCADOR;
        $param2->FIN_CCX_ID_PADRAO_REP                = $request->FIN_CCX_ID_PADRAO_REP;

        //recibos
        $param2->IMB_PRM_PER_DIAS_INICIO                 = $request->IMB_PRM_PER_DIAS_INICIO;
        $param2->IMB_PRM_PER_DIAS_FIM                 = $request->IMB_PRM_PER_DIAS_FIM;
        $param->IMB_PRM_RECIBO2FL_LD                 = $request->IMB_PRM_RECIBO2FL_LD;
        $param->IMB_PRM_RECIBO2FL_LT                 = $request->IMB_PRM_RECIBO2FL_LT;
        $param->IMB_PRM_REPASSENORECTO                 = $request->IMB_PRM_REPASSENORECTO;
        $param->IMB_PRM_USARPARCELAS                 = $request->IMB_PRM_USARPARCELAS;
        $param->IMB_PRM_REPASSEDIACERTO                 = $request->IMB_PRM_REPASSEDIACERTO;
        $param->IMB_PRM_RESUMOREPNORECTO                 = $request->IMB_PRM_RESUMOREPNORECTO;
        $param2->IMB_PRM_RECLDDESCPONT                 = $request->IMB_PRM_RECLDDESCPONT;
        $param2->IMB_PRM_RECLDENDLD                 = $request->IMB_PRM_RECLDENDLD;
        $param2->IMB_PRM_NAODESTACARTA_IPTU                 = $request->IMB_PRM_NAODESTACARTA_IPTU;
        $param2->IMB_PRM_CONTAPROPNORECIBO                 = $request->IMB_PRM_CONTAPROPNORECIBO;
        $param2->IMB_PRM_REPASSEEMAIL                 = $request->IMB_PRM_REPASSEEMAIL;
        $param2->IMB_PRM_RECLTDADOSLOCADOR                 = $request->IMB_PRM_RECLTDADOSLOCADOR;
        $param2->imb_prm_reclddatabranco                 = $request->imb_prm_reclddatabranco;

        $param2->IMB_FORPAG_ID_LOCATARIO               = $request->IMB_FORPAG_ID_LOCATARIO;
        $param2->FIN_CCR_ID_COBRANCA                 = $request->FIN_CCR_ID_COBRANCA;
        $param2->IMB_PRM_CODIGOIMOVELRECIBOS                 = $request->IMB_PRM_CODIGOIMOVELRECIBOS;

        //REPASSE
        $param2->IMB_PRM_TCPAR1COBRARTA                 = $request->IMB_PRM_TCPAR1COBRARTA;
        $param2->IMB_PRM_TCPAR1INCTA                 = $request->IMB_PRM_TCPAR1INCTA;
        $param2->IMB_PRM_TCPAR2COBRARTA                 = $request->IMB_PRM_TCPAR2COBRARTA;
        $param2->IMB_PRM_TCPAR2INCTA                 = $request->IMB_PRM_TCPAR2INCTA;
        $param2->IMB_PRM_TCPAR3COBRARTA                 = $request->IMB_PRM_TCPAR3COBRARTA;
        $param2->IMB_PRM_TCPAR3INCTA                 = $request->IMB_PRM_TCPAR3INCTA;
        $param2->IMB_PRM_TCPAR4COBRARTA                 = $request->IMB_PRM_TCPAR4COBRARTA;
        $param2->IMB_PRM_TCPAR4INCTA                 = $request->IMB_PRM_TCPAR4INCTA;
        $param2->IMB_PRM_WSAPELIDO                 = $request->IMB_PRM_WSAPELIDO;
        $param2->IMB_PRM_WSWEBHOOK                 = $request->IMB_PRM_WSWEBHOOK;
        $param2->IMB_PRM_TOKENNFS                 = $request->IMB_PRM_TOKENNFS;
        $param2->VIS_STA_IDALUGADO                 = $request->VIS_STA_IDALUGADO;
        $param2->IMB_PRM_DEMONSTRATIVOPDF                 = $request->IMB_PRM_DEMONSTRATIVOPDF;
        $param2->IMB_TBE_IDSEGINC                 = $request->IMB_TBE_IDSEGINC;
        $param2->IMB_PRM_ENVIARBOLETOENTRADACONFIRMADA                 = $request->IMB_PRM_ENVIARBOLETOENTRADACONFIRMADA;
        $param2->IMB_PRM_REAJUSTARMESSEGUINTE                 = $request->IMB_PRM_REAJUSTARMESSEGUINTE;
        $param2->IMB_PRM_RECIBOLTRETORNO                 = $request->IMB_PRM_RECIBOLTRETORNO;
        $param2->IMB_PRM_RELREPASSEAGRUFORMA                 = $request->IMB_PRM_RELREPASSEAGRUFORMA;
        
        $param->save();

        $param2->save();


        return response()->json( 'ok',200);

    }

    public function pegarImobiliaria( $id)
    {
        $imob = mdlImobiliaria::find( $id );

        return $imob;
    }

    public function pegarAgencia( $id)
    {
        $imob = mdlImobiliaria::where( 'IMB_IMB_ID2', $id)->first();

        return $imob;
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

    public function parametros( $id)
    {
        $imob = mdlParametros::find( $id );
        return $imob;
    }
}
