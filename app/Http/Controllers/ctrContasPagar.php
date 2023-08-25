<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlApDoc;
use App\mdlApTran;
use App\mdlLanctoCaixa;
use App\mdlCaTran;
use App\mdlParametros;
use Auth;
use DataTables;
use Log;
use DB;

class ctrContasPagar extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index( )
    {
    }

    public function list( Request $request )
    {

        $IMB_EEP_ID = $request->IMB_EEP_ID;
        $IMB_IMB_ID2 = $request->IMB_IMB_ID2;
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $quitados = $request->quitados;
        $cancelados = $request->cancelados;


        if( $datainicio == '')
            $datainicio = date('Y/m/d');
        if( $datafim == '')
            $datafim = date('Y/m/d');


        $contas = mdlApDoc::select(
            [
                'FIN_APDOC.IMB_IMB_ID',
                'FIN_APD_ID',
                'FIN_APD_DATAEMISSAO',
                'FIN_APD_DATAVENCIMENTO',
                'FIN_APDOC.FIN_EEP_ID',
                'IMB_EEP_RAZAOSOCIAL',
                'FIN_APD_NUMERODOCUMENTO',
                'FIN_APD_DATAPAGAMENTO',
                'FIN_APD_VALORVENCIMENTO',
                'FIN_APD_VALORPAGO',
                'FIN_APD_OBSERVACAO',
                'FIN_APDOC.FIN_TPD_ID',
                'FIN_TPD_DESCRICAO',
                'FIN_APD_DATADOCUMENTO',
                'FIN_APD_DTHCADASTRO',
                'FIN_APD_OBSERVACAO',
                'FIN_APD_NUMEROPARCELA',
                'FIN_APD_VALORDESCONTO',
                'FIN_APD_FORMAPAGAMENTO',
                'FIN_APD_VALORMULTA',
                'FIN_APD_VALORJUROS',
                'FIN_APD_VALORDESCPAG',
                'FIN_APD_MASTERDOC',
                'IMB_APD_DTHALTERACAO',
                'IMB_ATD_IDALTERACAO',
                'FIN_APD_NUMEROCHEQUE',
                'FIN_APDOC.IMB_IMB_ID2',
                'FIN_APD_DTHINATIVADO',
                'IMB_IMB_NOME'
            ]
        )
        ->leftJoin( 'IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID', 'FIN_APDOC.IMB_IMB_ID2' )
        ->leftJoin( 'IMB_EMPRESA','IMB_EMPRESA.IMB_EEP_ID', 'FIN_APDOC.FIN_EEP_ID' )
        ->leftJoin( 'FIN_TIPODOCUMENTO', 'FIN_TIPODOCUMENTO.FIN_TPD_ID','FIN_APDOC.FIN_TPD_ID')
        ->where( "FIN_APD_DATAVENCIMENTO",">=", $datainicio )
        ->where( "FIN_APD_DATAVENCIMENTO","<=", $datafim );

        if( $IMB_EEP_ID <> '' )
            $contas->where( 'FIN_APDOC.FIN_EEP_ID','=', $IMB_EEP_ID );

        if( $IMB_IMB_ID2 <> '' )
        $contas->where( 'FIN_APDOC.IMB_IMB_ID2','=', $IMB_IMB_ID2 );

        if( $quitados == 'N')
            $contas->whereNull( 'FIN_APDOC.FIN_APD_DATAPAGAMENTO');


        if( $cancelados == 'N')
            $contas->whereNull( 'FIN_APDOC.FIN_APD_DTHINATIVADO');


            return DataTables::of($contas)->make(true);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'tipoimovel/tipoimovelnew');
       //
    }

    public function baixar( Request $request )
    {
        $FIN_APD_ID = $request->FIN_APD_ID;
        $FIN_APD_FORMAPAGAMENTO = $request->FIN_APD_FORMAPAGAMENTO;
        $FIN_CCX_IDBAIXA = $request->FIN_CCX_IDBAIXA;
        $FIN_APD_DATAPAGAMENTO = $request->FIN_APD_DATAPAGAMENTO;
        $FIN_APD_VALORPAGO = $request->FIN_APD_VALORPAGO;
        $FIN_APD_VALORMULTA = $request->FIN_APD_VALORMULTA;
        $FIN_APD_VALORJUROS = $request->FIN_APD_VALORJUROS;
        $FIN_LCX_NUMEROCHEQUE = $request->FIN_LCX_NUMEROCHEQUE;
        $FIN_APD_VALORDESCONTO = $request->FIN_APD_VALORDESCONTO;
        

        $par = mdlParametros::where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)->first();

        if( $par->FIN_CFC_IDDESCONTOS == '' )
            return response()->json('Faltando parametrizar o CFC do desconto',404);
        
        if( $par->FIN_CFC_IDMULTA == '' )
            return response()->json('Faltando parametrizar o CFC da Multa',404);
        
        if( $par->FIN_CFC_IDJUROS == '' )
            return response()->json('Faltando parametrizar o CFC do Juros',404);
        
        $cp = mdlApDoc::find( $FIN_APD_ID );
        if( $cp <> '' )
        {
            $cp->IMB_ATD_IDBAIXA = Auth::user()->IMB_ATD_ID;
            $cp->FIN_APD_DTHBAIXA = date('Y-m-d H:i:s');

            $cp->FIN_APD_FORMAPAGAMENTO = $FIN_APD_FORMAPAGAMENTO;
            $cp->FIN_CCX_IDBAIXA = $FIN_CCX_IDBAIXA;
            $cp->FIN_APD_DATAPAGAMENTO = $FIN_APD_DATAPAGAMENTO;
            $cp->FIN_APD_VALORPAGO = $FIN_APD_VALORPAGO;
            $cp->FIN_APD_VALORMULTA = $FIN_APD_VALORMULTA;
            $cp->FIN_APD_VALORJUROS = $FIN_APD_VALORJUROS;
            $cp->save();


            $lcx = new mdlLanctoCaixa;
            $lcx->FIN_LCX_DATACADASTRO =date('Y/m/d');
            $lcx->FIN_LCX_DATAEMISSAO =date('Y/m/d');
            $lcx->FIN_LCX_DATAENTRADA = $FIN_APD_DATAPAGAMENTO;
            $lcx->FIN_LCX_OPERACAO = 'D';
            $lcx->FIN_LCX_VALOR = $FIN_APD_VALORPAGO;
            $lcx->FIN_LCX_ORIGEM = 'AP';
            $lcx->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $lcx->FIN_LCX_NUMEROCHEQUE = $FIN_LCX_NUMEROCHEQUE;
            $lcx->FIN_LCX_HISTORICO = $cp->FIN_APD_OBSERVACAO;
            $lcx->FIN_CCX_ID = $FIN_CCX_IDBAIXA;
            $lcx->FIN_APD_ID = $cp->FIN_APD_ID;
            $lcx->IMB_ATD_IDINCLUSAO = Auth::user()->IMB_ATD_ID;
            $lcx->save();

            $aptran = mdlApTran::where( 'FIN_APD_ID','=', $cp->FIN_APD_ID )->get();

            $seq = 0;
            foreach( $aptran as $reg )
            {
                $seq++;
                $cat = new mdlCaTran;
                $cat->FIN_LCX_ID = $lcx->FIN_LCX_ID;
                $cat->FIN_CAT_SEQUENCIA = $seq;
                $cat->FIN_CAT_OPERACAO = 'D';
                $cat->FIN_CAT_VALOR = $reg->FIN_APT_VALOR;
                $cat->FIN_CFC_ID = $reg->FIN_CFC_ID;
                $cat->FIN_SBC_ID = $reg->FIN_SBC_ID;
                $cat->FIN_CAT_CLIFOR = $cp->FIN_EEP_ID;
                $cat->save();
            }

            if( $FIN_APD_VALORMULTA <> 0 )
            {
                $seq++;
                $cat = new mdlCaTran;
                $cat->FIN_LCX_ID = $lcx->FIN_LCX_ID;
                $cat->FIN_CAT_SEQUENCIA = $seq;
                $cat->FIN_CAT_OPERACAO = 'D';
                $cat->FIN_CAT_VALOR = $FIN_APD_VALORMULTA;
                $cat->FIN_CFC_ID = $par->FIN_CFC_IDMULTA;
                $cat->FIN_SBC_ID = $reg->FIN_SBC_ID;
                $cat->FIN_CAT_CLIFOR = $cp->FIN_EEP_ID;
                $cat->save();                
            }
            if( $FIN_APD_VALORJUROS <> 0 )
            {
                $seq++;
                $cat = new mdlCaTran;
                $cat->FIN_LCX_ID = $lcx->FIN_LCX_ID;
                $cat->FIN_CAT_SEQUENCIA = $seq;
                $cat->FIN_CAT_OPERACAO = 'D';
                $cat->FIN_CAT_VALOR = $FIN_APD_VALORJUROS;
                $cat->FIN_CFC_ID = $par->FIN_CFC_IDJUROS;
                $cat->FIN_SBC_ID = $reg->FIN_SBC_ID;
                $cat->FIN_CAT_CLIFOR = $cp->FIN_EEP_ID;
                $cat->save();                
            }
            if( $FIN_APD_VALORDESCONTO <> 0 )
            {
                $seq++;
                $cat = new mdlCaTran;
                $cat->FIN_LCX_ID = $lcx->FIN_LCX_ID;
                $cat->FIN_CAT_SEQUENCIA = $seq;
                $cat->FIN_CAT_OPERACAO = 'C';
                $cat->FIN_CAT_VALOR = $FIN_APD_VALORDESCONTO;
                $cat->FIN_CFC_ID = $par->FIN_CFC_IDDESCONTOS;
                $cat->FIN_SBC_ID = $reg->FIN_SBC_ID;
                $cat->FIN_CAT_CLIFOR = $cp->FIN_EEP_ID;
                $cat->save();                
            }
            return response()->json( 'ok',200);
        }



        return response()->json( 'não encontrado',404 );

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request )
    {

    }

    public function store( Request $request )
    {

        
        $FIN_APD_ID                = $request->FIN_APD_ID;
        

        $FIN_EEP_ID                = $request->FIN_EEP_ID;
        $FIN_APD_DATAVENCIMENTO    = $request->FIN_APD_DATAVENCIMENTO;
        $FIN_APD_NUMERODOCUMENTO   = $request->FIN_APD_NUMERODOCUMENTO;
        $FIN_APD_VALORVENCIMENTO   = $request->FIN_APD_VALORVENCIMENTO;
        $FIN_APD_OBSERVACAO        = $request->FIN_APD_OBSERVACAO;
        $FIN_APD_DATADOCUMENTO     = $request->FIN_APD_DATADOCUMENTO;
        $FIN_APD_NUMEROPARCELA     = $request->FIN_APD_NUMEROPARCELA;
        $FIN_APD_NUMEROCHEQUE      = $request->FIN_APD_NUMEROCHEQUE;
        $IMB_IMB_ID2               = $request->IMB_IMB_ID2;
        $FIN_TPD_ID                = $request->FIN_TPD_ID;
        $FIN_CFC_ID                 =$request->FIN_CFC_ID;
        $FIN_SBC_ID                 =$request->FIN_SBC_ID;

        if( $FIN_APD_ID <> '' )
        {
            $apdoc =mdlApDoc::find( $FIN_APD_ID );
            $apdoc->FIN_APD_DTHCADASTRO        = date('Y/m/d H:i:s');
            $apdoc->FIN_APD_DATAEMISSAO        = $FIN_APD_DATADOCUMENTO;
            $apdoc->FIN_APD_DATAVENCIMENTO     = $FIN_APD_DATAVENCIMENTO  ;
            $apdoc->FIN_APD_NUMERODOCUMENTO     = $FIN_APD_NUMERODOCUMENTO;
            $apdoc->FIN_APD_VALORVENCIMENTO      =$FIN_APD_VALORVENCIMENTO;
            $apdoc->FIN_APD_OBSERVACAO        = $FIN_APD_OBSERVACAO;
            $apdoc->FIN_APD_DATADOCUMENTO        = $FIN_APD_DATADOCUMENTO;
            $apdoc->FIN_APD_NUMEROPARCELA        = $FIN_APD_NUMEROPARCELA ;
            $apdoc->FIN_APD_NUMEROCHEQUE        = $FIN_APD_NUMEROCHEQUE;
            $apdoc->FIN_TPD_ID        = $FIN_TPD_ID;
            $apdoc->FIN_EEP_ID        = $FIN_EEP_ID;
            $apdoc->IMB_IMB_ID2        = $IMB_IMB_ID2;
            $apdoc->IMB_IMB_ID         = Auth::user()->IMB_IMB_ID;
            $apdoc->save();

            //gravar aptran
            $aptran = mdlApTran::where( 'FIN_APD_ID', '=', $FIN_APD_ID )->delete();
            
            $aptran = new mdlApTran;
            $aptran->IMB_IMB_ID            = Auth::user()->IMB_IMB_ID;
            $aptran->FIN_APD_ID            = $apdoc->FIN_APD_ID;
            $aptran->FIN_APT_SEQUENCIA            = 1;
            $aptran->FIN_CFC_ID            = $FIN_CFC_ID;
            $aptran->FIN_APT_VALOR         = $FIN_APD_VALORVENCIMENTO;
            $aptran->FIN_SBC_ID            = $FIN_SBC_ID;
            $aptran->FIN_APT_CLIFOR            = $FIN_EEP_ID;
            $aptran->save();

            return response()->json( 'OK', 200);
            
        }


        $parcelamento  = $request->parcelas;
        //dd( $parcelamento );
        foreach( $parcelamento as $parc )
        {
            $apdoc = new mdlApDoc;
            $apdoc->FIN_APD_DTHCADASTRO        = date('Y/m/d H:i:s');
            $apdoc->FIN_APD_DATAEMISSAO        = $FIN_APD_DATADOCUMENTO;
            $apdoc->FIN_APD_DATAVENCIMENTO     =$parc[0];
            $apdoc->FIN_APD_NUMERODOCUMENTO        = $FIN_APD_NUMERODOCUMENTO;
            $apdoc->FIN_APD_VALORVENCIMENTO        =$parc[2];
            $apdoc->FIN_APD_OBSERVACAO        = $FIN_APD_OBSERVACAO.' '.$parc[1];
            $apdoc->FIN_APD_DATADOCUMENTO        = $FIN_APD_DATADOCUMENTO;
            $apdoc->FIN_APD_NUMEROPARCELA        = $parc[1];
            $apdoc->FIN_APD_NUMEROCHEQUE        = $FIN_APD_NUMEROCHEQUE;
            $apdoc->FIN_TPD_ID        = $FIN_TPD_ID;
            $apdoc->FIN_EEP_ID        = $FIN_EEP_ID;
            $apdoc->IMB_IMB_ID2        = $IMB_IMB_ID2;
            $apdoc->IMB_IMB_ID         = Auth::user()->IMB_IMB_ID;
            $apdoc->save();

            //gravar aptran
            $aptran = new mdlApTran;
            $aptran->IMB_IMB_ID            = Auth::user()->IMB_IMB_ID;
            $aptran->FIN_APD_ID            = $apdoc->FIN_APD_ID;
            $aptran->FIN_APT_SEQUENCIA            = 1;
            $aptran->FIN_CFC_ID            = $FIN_CFC_ID;
            $aptran->FIN_APT_VALOR            = $parc[2];
            $aptran->FIN_SBC_ID            = $FIN_SBC_ID;
            $aptran->FIN_APT_CLIFOR            = $FIN_EEP_ID;
            $aptran->save();

            $razaosocial = app( 'App\Http\Controllers\ctrRotinas')->fornecedor( $FIN_EEP_ID );
            $vencimento = app( 'App\Http\Controllers\ctrRotinas')->formatarData( $FIN_APD_DATAVENCIMENTO );
            app( 'App\Http\Controllers\ctrRotinas')->gravarLog( 'CONTAS A PAGAR', 'I', 'Inclusão de um novo compromisso '.
            'para o fornecedor '.$razaosocial.', vencimento: '.$vencimento.', valor: '.$FIN_APD_VALORVENCIMENTO.
                ', CFC '.$FIN_CFC_ID.', Sub-Conta: '.$FIN_SBC_ID);
        }

        return response()->json('ok',200);

    }


    public function update(Request $request)
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
            return response()->json( 'OK',200 );
    }


    public function vereapagar($id)
    {

        //
    }

    public function buscar( $id )
    {
        $conta = mdlApDoc::select(
            [
                'FIN_APDOC.IMB_IMB_ID',
                'FIN_APD_ID',
                'FIN_APD_DATAEMISSAO',
                'FIN_APD_DATAVENCIMENTO',
                'FIN_APDOC.FIN_EEP_ID',
                'IMB_EEP_RAZAOSOCIAL',
                'FIN_APD_NUMERODOCUMENTO',
                'FIN_APD_DATAPAGAMENTO',
                'FIN_APD_VALORVENCIMENTO',
                'FIN_APD_VALORPAGO',
                'FIN_APD_OBSERVACAO',
                'FIN_APDOC.FIN_TPD_ID',
                'FIN_TPD_DESCRICAO',
                'FIN_APD_DATADOCUMENTO',
                'FIN_APD_DTHCADASTRO',
                'FIN_APD_NUMEROPARCELA',
                'FIN_APD_VALORDESCONTO',
                'FIN_APD_FORMAPAGAMENTO',
                'FIN_APD_VALORMULTA',
                'FIN_APD_VALORJUROS',
                'FIN_APD_VALORDESCPAG',
                'FIN_APD_MASTERDOC',
                'IMB_APD_DTHALTERACAO',
                'IMB_ATD_IDALTERACAO',
                'FIN_APD_NUMEROCHEQUE',
                'FIN_APDOC.IMB_IMB_ID2',
                'FIN_APD_DTHINATIVADO',
                'IMB_IMB_NOME',
                'FIN_APDOC.FIN_EEP_ID',
                DB::raw( '(select FIN_CFC_ID FROM FIN_APTRAN WHERE FIN_APTRAN.FIN_APD_ID = FIN_APDOC.FIN_APD_ID) AS FIN_CFC_ID'),
                DB::raw( '(select FIN_SBC_ID FROM FIN_APTRAN WHERE FIN_APTRAN.FIN_APD_ID = FIN_APDOC.FIN_APD_ID) AS FIN_SBC_ID'),
            ]
        )
        ->where( "FIN_APD_ID","=", $id )
        ->leftJoin( 'IMB_EMPRESA','IMB_EMPRESA.IMB_EEP_ID', 'FIN_APDOC.FIN_EEP_ID' )
        ->leftJoin( 'IMB_IMOBILIARIA','IMB_IMOBILIARIA.IMB_IMB_ID', 'FIN_APDOC.IMB_IMB_ID2' )
        ->leftJoin( 'FIN_TIPODOCUMENTO', 'FIN_TIPODOCUMENTO.FIN_TPD_ID','FIN_APDOC.FIN_TPD_ID')
        ->first();

        return $conta;
    }




    public function totalizar( Request $request )
    {

        $IMB_EEP_ID = $request->IMB_EEP_ID;
        $IMB_IMB_ID2 = $request->IMB_IMB_ID2;
        $datainicio = $request->datainicio;
        $datafim = $request->datafim;
        $quitados = $request->quitados;
        $cancelados = $request->cancelados;


        if( $datainicio == '')
            $datainicio = date('Y/m/d');
        if( $datafim == '')
            $datafim = date('Y/m/d');

        $contas = mdlApDoc::
        where( "FIN_APD_DATAVENCIMENTO",">=", $datainicio )
        ->where( "FIN_APD_DATAVENCIMENTO","<=", $datafim )
        ->whereNull( 'FIN_APDOC.FIN_APD_DTHINATIVADO');

        if( $IMB_EEP_ID <> '' )
            $contas->where( 'FIN_APDOC.FIN_EEP_ID','=', $IMB_EEP_ID );

        if( $IMB_IMB_ID2 <> '' )
            $contas->where( 'FIN_APDOC.IMB_IMB_ID2','=', $IMB_IMB_ID2 );

        $contas->whereNull( 'FIN_APDOC.FIN_APD_DATAPAGAMENTO');

        $aberto = $contas->sum('FIN_APD_VALORVENCIMENTO');;

        $contas = mdlApDoc::
        where( "FIN_APD_DATAVENCIMENTO",">=", $datainicio )
        ->where( "FIN_APD_DATAVENCIMENTO","<=", $datafim )
        ->whereNull( 'FIN_APDOC.FIN_APD_DTHINATIVADO');

        if( $IMB_EEP_ID <> '' )
            $contas->where( 'FIN_APDOC.FIN_EEP_ID','=', $IMB_EEP_ID );

        if( $IMB_IMB_ID2 <> '' )
            $contas->where( 'FIN_APDOC.IMB_IMB_ID2','=', $IMB_IMB_ID2 );

        $contas->whereNotNull( 'FIN_APDOC.FIN_APD_DATAPAGAMENTO');
        $quitado = $contas->sum('FIN_APD_VALORVENCIMENTO');


        $array = array( "aberto" => $aberto, "quitado" => $quitado );

        return json_encode( $array );



    }

    public function desativar( $id )
    {
        $apd = mdlApDoc::find( $id );
        if( $apd )
        {
            $apd->FIN_APD_DTHINATIVADO = date(' y/m/d');
            $apd->save();
        }

        return response()->json( 'ok',200);

    }


}
