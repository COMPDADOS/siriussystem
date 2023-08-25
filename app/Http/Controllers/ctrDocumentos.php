<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlDocumentos;
use App\mdlTmpPar;
use App\mdlCliente;
use App\mdlTmpDoc;
use App\mdlTipoDocumento;
use App\mdlParcelas;
use App\mdlProposta;
use App\mdlParcelasTMP;
use DB;

use PDF;
use Log;

use Auth;

class ctrDocumentos extends Controller
{
    public function entrada( Request $request )
    {

        return view( 'documentos.entrada');

    }

    public function store( Request $request )
    {
        $credor = $request->COB_DCT_ID_CREDOR;
        $devedor = $request->COB_DCT_ID_DEVEDOR;
        $parcelas = $request->parcelas;
        $dataemissao = $request->COB_DCT_DATAEMISSAO;
        $dataentrada = $request->COB_DCT_DATAENTRADA;
        $numerodocumento=$request->COB_DCT_NUMERODOCUMENTO;
        $valordocumento = $request->COB_DCT_VALOR;
        $tipodocumento = $request->COB_TPD_ID;

        $dct = new mdlDocumentos;

        $dct->IMB_IMB_ID                = Auth::user()->IMB_IMB_ID;
        $dct->IMB_ATD_ID                = Auth::user()->IMB_ATD_ID;
        $dct->COB_ATD_ID                = Auth::user()->IMB_ATD_ID;
        $dct->COB_DCT_NUMERODOCUMENTO   = $numerodocumento;
        $dct->COB_CLT_ID_CREDOR         = $credor;
        $dct->COB_CLT_ID_DEVEDOR        = $devedor;
        $dct->COB_DCT_DATAENTRADA       = $dataentrada;
        $dct->COB_DCT_DATAEMISSAO       = $dataemissao;
        $dct->COB_DCT_VALOR             = $valordocumento;
        $dct->COB_TPD_ID                = $tipodocumento;
        $dct->COB_DCT_DTHINCLUSAO       = date('Y-m-d H:i:s');
        $dct->COB_DCT_DATA              = date('Y-m-d H:i:s');
        $dct->save();

        //dd( $parcelas);

        $cont = 0;
        $totalparcelas = sizeof($parcelas);
        foreach( $parcelas as $parcela)
        {
            $cont++;
            $par = new mdlParcelas;
            $par->IMB_IMB_ID                = Auth::user()->IMB_IMB_ID;
            $par->IMB_ATD_ID                = Auth::user()->IMB_ATD_ID;
            $par->COB_ATD_ID                = Auth::user()->IMB_ATD_ID;
            $par->COB_DCT_ID                = $dct->COB_DCT_ID;
            $par->COB_STC_ID                = 1;
            $par->COB_PRL_VALOR             = $parcela[1];
            $par->COB_PRL_DATA              =  date( 'Y/m/d');
            $par->COB_PRL_DATAVENCIMENTO    =  
                    app('App\Http\Controllers\ctrRotinas')
                ->formatarData( $parcela[0]);
            $par->COB_PRL_PARCELA    =  str_pad($cont,3,"0", false).'/'.
                                        str_pad($totalparcelas,3,"0", false);
            $par->save();
        }
        return response()->json('OK',200);

    }

    public function documentosCredor( $id )
    {

        $docs = mdlDocumentos::where( 'COB_CLT_ID_CREDOR','=', $id )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
        ->orderBy('COB_CLT_ID_DEVEDOR')
        ->get();

        return $docs;


    }

    public function documentos( Request $request )
    {

        $devedor = '';
        $credor = '';
        $dataentrada = '';
        $somenteaberto="N";

        if ($request->has('SOMENTEABERTOS') ) $somenteaberto = $request->SOMENTEABERTOS;
        if ($request->has('COB_CLT_ID_DEVEDOR') ) $devedor = $request->COB_CLT_ID_DEVEDOR;
        if ($request->has('COB_CLT_ID_CREDOR') ) $credor = $request->COB_CLT_ID_CREDOR;
        if ($request->has('COB_DCT_DATAENTRADA_INI') ) $dataentini = $request->COB_DCT_DATAENTRADA_INI;
        if ($request->has('COB_DCT_DATAENTRADA_FIM') ) $dataentfim = $request->COB_DCT_DATAENTRADA_FIM;
        if ($request->has('COB_PRL_DATAVENCIMENTO_INI') ) $datavenini = $request->COB_PRL_DATAVENCIMENTO_INI;
        if ($request->has('COB_PRL_DATAVENCIMENTO_FIM') ) $datavenfim = $request->COB_PRL_DATAVENCIMENTO_FIM;
        if ($request->has('COB_PRL_DATAVENCIMENTO_FIM') ) $datavenfim = $request->COB_PRL_DATAVENCIMENTO_FIM;
        if ($request->has('COB_STC_ID') )  $datavenfim = $request->COB_STC_ID;

        $docs = mdlDocumentos::
            select(
                [
                    'COB_DCT_ID',
                    'COB_CLT_ID_DEVEDOR',
                    'COB_CLT_ID_CREDOR',
                    DB::raw( '( select COB_TPD_DESCRICAO FROM 
                                cob_tipodocumento where cob_tipodocumento.COB_TPD_ID = cob_documento.COB_TPD_ID) as COB_TPD_DESCRICAO'),
                    'cob_cliente.COB_CLT_NOME',
                    'COB_DCT_DATAENTRADA',
                    'COB_DCT_DATABAIXA',
                    'COB_DCT_NUMERODOCUMENTO',
                    'COB_DCT_NUMEROCONTRATO',
                    'COB_DCT_DATAEMISSAO',
                    'cob_documento.COB_TPD_ID',
                    'COB_BNC_NUMERO',
                    'COB_BNC_AGENCIA',
                    'COB_DCT_NUMERODOCUMENTO',
                    'COB_ATD_ID',
                    'COB_DCT_DATA',
                    'COB_DCT_IDREL',
                    'COB_ACD_ID',
                    'COB_ACD_IDRESULTADO',
                    'COB_MTV_ID',
                    'COB_DCT_VALOR'
                    
                    
                ]
            )

        ->leftJoin( 'cob_cliente', 'cob_cliente.COB_CLT_ID','cob_documento.COB_CLT_ID_CREDOR' )
        ->where( 'cob_cliente.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID );

        if( $devedor <> '' )
           $docs = $docs->where('COB_CLT_ID_DEVEDOR','=', $devedor );

        $docs = $docs->orderBy('COB_CLT_ID_CREDOR')->get();

        
        $del = mdlTmpPar::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->delete();
        $del = mdlTmpDoc::where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID)->delete();
                
        foreach( $docs as $doc)
        {
            
            $credor = mdlCliente::find( $doc->COB_CLT_ID_CREDOR);

            if( $credor )
            {

                $valtotal = mdlParcelas::where('COB_DCT_ID',$doc->COB_DCT_ID)->sum('COB_PRL_VALOR');

                $tipodocumento = '';
                $tpd = mdlTipoDocumento::find( $doc->COB_TPD_ID );

                $situacao = $this->situacaoDocumento( $doc->COB_DCT_ID );

                $continue = 'S';
                if( $situacao <> 'ABERTO' and $situacao <> 'PARCIAL' and $somenteaberto == 'S' ) $continue = 'N'; 

                if( $continue == 'S' )
                {
                    $tmpdoc = new mdlTmpDoc;
                    $tmpdoc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $tmpdoc->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $tmpdoc->COB_DCT_ID = $doc->COB_DCT_ID;
                    $tmpdoc->COB_CLT_ID_CREDOR = $doc->COB_CLT_ID_CREDOR;
                    $tmpdoc->COB_CLT_ID_DEVEDOR = $doc->COB_CLT_ID_DEVEDOR;
                    $tmpdoc->COB_DCT_DATAEMISSAO = $doc->COB_DCT_DATAEMISSAO;
                    $tmpdoc->COB_TPD_DESCRICAO = $doc->COB_TPD_DESCRICAO;
                    $tmpdoc->COB_TPD_ID = $doc->COB_TPD_ID;
                    $tmpdoc->COB_BNC_NUMERO = $doc->COB_BNC_NUMERO;
                    $tmpdoc->COB_BNC_AGENCIA = $doc->COB_BNC_AGENCIA;
                    $tmpdoc->COB_DCT_NUMERODOCUMENTO = $doc->COB_DCT_NUMERODOCUMENTO;
                    $tmpdoc->COB_ATD_ID = $doc->COB_ATD_ID;
                    $tmpdoc->COB_DCT_DATA = $doc->COB_DCT_DATA;
                    $tmpdoc->COB_DCT_DATAENTRADA = $doc->COB_DCT_DATAENTRADA;
                    $tmpdoc->COB_DCT_IDREL = $doc->COB_DCT_IDREL;
                    $tmpdoc->COB_ACD_ID = $doc->COB_ACD_ID;
                    $tmpdoc->COB_ACD_IDRESULTADO = $doc->COB_ACD_IDRESULTADO;
                    $tmpdoc->COB_MTV_ID = $doc->COB_MTV_ID;
                    $tmpdoc->COB_DCT_DATABAIXA = $doc->COB_DCT_DATABAIXA;
                    $tmpdoc->COB_DCT_VALOR = $valtotal;
                    $tmpdoc->COB_DCT_NUMEROCONTRATO = $doc->COB_DCT_NUMEROCONTRATO;
                    $tmpdoc->situacao = $situacao;
                    $tmpdoc->COB_CLT_NOME_CREDOR = app('App\Http\Controllers\ctrCliente')
                                            ->pegarNomeCliente( $doc->COB_CLT_ID_CREDOR);
                    $tmpdoc->save();
                }
            }
        }
        
        $tmpdoc =  mdlTmpDoc::where('IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )
        ->where('IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )
        ->orderBy('COB_DCT_DATAENTRADA')
        ->get();
        
        return $tmpdoc;


    }

    public function recebimento()
    {
        return view( 'documentos.consultardebitosdev');
    }

    public function situacaoDocumento( $iddoc )
    {
        $aberto="N";
        $devolvido="N";
        $acordo="N";
        $quitado="S";
        $emacordo="N";
        $temparcelapaga = 'N';


        $par = mdlParcelas::where( 'COB_DCT_ID','=', $iddoc )->get();
        $totalpago = 0;

        foreach ($par as $p) 
        {
            if( $p->COB_STC_ID == 1 )  
            {
                $aberto = 'S';
                $quitado='N';
            }
            if( $p->COB_STC_ID == 3 )  $devolvido = 'S';

            if( $p->COB_STC_ID == 5 )  $emacordo = 'S';

            if ($p->COB_PRL_DATAPAGAMENTO <> null  and
                $p->cob_stc_id <> '3' ) 
                $totalpago+= $p->COB_PRL_VALOR;

            if( $p->COB_ACD_ID <> null ) 
                $acordo='S';                
        }

        $retorno='';

        if( $totalpago <> 0 and $aberto == 'S')
            $retorno = 'PARCIAL';

        if( $totalpago == 0 and $aberto == 'S')
            $retorno = "ABERTO";

        if( $acordo =='S') 
            $retorno = "ACORDO";

        if( $quitado=='S')
            $retorno = 'QUITADO';

        if( $emacordo =='S')
            $retorno = "EM ACORDO";

        return $retorno;

    }

    function documentosRelatórioDebitos( Request $request)
    {
        $idcliente = $request->idcliente;
        $html = view( 'reports.relatoriodebitocliente', compact('idcliente') );
        $pdf=PDF::loadHtml( $html,'UTF-8');
        return $pdf->stream('relatoriodebitos'.$idcliente.'.pdf');
    }

    public function apenasDocumentos( $devedor, $credor, $somenteaberto, $retorno )
    {



        $docs = mdlDocumentos::
            select(
                [
                    'COB_DCT_ID'
                ]
                );


        if( $somenteaberto == 'S' )
                $docs = $docs->whereRaw( ' exists( select cob_prl_id from cob_parcelas where cob_parcelas.COB_DCT_ID =
                 cob_documento.COB_DCT_ID AND COB_PRL_DATAPAGAMENTO IS NULL
                 AND COB_PRL_DATADEVOLUCAO IS NULL
                 AND COALESCE(COB_DCT_EXCLUIDO,"N") <> "S")');
                 
        if( $devedor <> '' )
           $docs = $docs->where('COB_CLT_ID_DEVEDOR','=', $devedor );

        $docs = $docs->orderBy('COB_CLT_ID_CREDOR')
            ->distinct( 'COB_DCT_ID')
            ->get();

        if( $retorno == 'json')
               return response()->json( $docs,200);

        return $docs;

    }

    public function parcelasAbertasDocumento( $id )
    {

        $parcelas = mdlParcelas::        
        where( 'COB_DCT_ID','=', $id )
        ->orderBy( 'COB_PRL_DATAVENCIMENTO')
        ->get();

        return $parcelas;

    }

    public function dadosDocumento( $id )
    {
        $doc = mdlDocumentos::where( 'COB_DCT_ID','=', $id )
        ->leftJoin( 'cob_cliente','cob_cliente.COB_CLT_ID','cob_documento.COB_CLT_ID_CREDOR')
        ->leftJoin( 'cob_tipodocumento','cob_tipodocumento.COB_TPD_ID','cob_documento.COB_TPD_ID')
        ->first();

        return $doc;
    }

    public function gravarProposta( Request $request)
    {
        $prop = new mdlProposta;
        $prop->COB_CLT_ID_DEVEDOR           = $request->COB_CLT_ID_DEVEDOR;
                                                        
        $prop->COB_PRP_DATAPROPOSTA           = $request->COB_PRP_DATAPROPOSTA;
        $prop->COB_PRP_VALORSECIONADO           = $request->COB_PRP_VALORSECIONADO;
        $prop->COB_PRP_PROPOSTA           = $request->COB_PRP_PROPOSTA;
        $prop->COB_PRP_DATAVALIDADE           = $request->COB_PRP_DATAVALIDADE;
        $prop->IMB_ATD_ID           = Auth::user()->IMB_ATD_ID;;
        $prop->COB_PRP_DTHATIVO = date( 'Y/m/d');
        $prop->save();

        return response()->json('ok',200);


    }

    public function propostasCliente( $id )
    {
        $prop = mdlProposta::where( 'COB_CLT_ID_DEVEDOR','=', $id )->get();

        return response()->json( $prop, 200 );

    }

    public function minimoPossivel()
    {

        $sels = mdlParcelasTMP::where( 'IMB_ATD_ID','=', Auth::user()->IMB_ATD_ID )->get();

        $valorminimo = 0;
        foreach( $sels as $sel )
        {

            $credor = mdlCliente::where( 'COB_CLT_ID','=',$sel->COB_CLT_ID_CREDOR)->first();

            if( $credor->COB_CPM_PERCENTUALREPASSE == 0 )
            {
                if ( $credor->COB_CPM_REPASSEPRINCIPAL == 'S' )
                    $valorminimo = $valorminimo + $sel->COB_PRL_VALOR;

                if ( $credor->COB_CPM_REPASSEJUROS == 'S' )
                    $valorminimo = $valorminimo + $sel->COB_TMP_JUROS;

                if ( $credor->COB_CPM_REPASSEMULTA == 'S' )
                    $valorminimo = $valorminimo + $sel->COB_TMP_MULTA;
            }
            else
            {
                if( $credor->COB_CPM_REPASSESOBRE == 'P' )
                    $valorminimo = $valorminimo +
                     ( $sel->COB_PRL_VALOR *
                        $credor->COB_CPM_PERCENTUALREPASSE / 100 );
                else
                if( $credor->COB_CPM_REPASSESOBRE == 'R' )
                    $valorminimo = $valorminimo +
                     ( $sel->COB_TMP_APAGAR *
                       $credor->COB_CPM_PERCENTUALREPASSE / 100 );

            }

        }
        return response()->json($valorminimo,200);
    }

        




}
