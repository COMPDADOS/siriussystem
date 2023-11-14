<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mdlPropImovel;
use App\mdlImovel;
use Auth;
use Log;
class ctrPropImo extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
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
    public function store(Request $request)
    {
        if( $request->input( 'IMB_PPI_ID') == '' )
            $propimo = new mdlPropImovel();
        else
            $propimo = mdlPropImovel::find( $request->input( 'IMB_PPI_ID') );

        $propimo->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $propimo->IMB_IMV_ID = $request->input( 'IMB_IMV_ID');
        $propimo->IMB_CLT_ID = $request->input( 'IMB_CLT_ID');
        $propimo->IMB_IMVCLT_PRINCIPAL = $request->input( 'IMB_IMVCLT_PRINCIPAL');
        $propimo->IMB_IMVCLT_PERCENTUAL4 = $request->input( 'IMB_IMVCLT_PERCENTUAL4');
        $propimo->IMB_FORPAG_ID = $request->input( 'IMB_FORPAG_ID',0);
        $propimo->IMB_IMV_CHEQUENOMINAL = $request->input( 'IMB_IMV_CHEQUENOMINAL');
        $propimo->IMB_CLTCCR_NOME = $request->input( 'IMB_CLTCCR_NOME');
        
        $propimo->GER_BNC_NUMERO = $request->input( 'GER_BNC_NUMERO' );
        $propimo->GER_BNC_AGENCIA = $request->input( 'GER_BNC_AGENCIA');
        $propimo->IMB_BNC_AGENCIADV = $request->input( 'IMB_BNC_AGENCIADV');
        $propimo->IMB_CLTCCR_NUMERO = $request->input( 'IMB_CLTCCR_NUMERO');
        $propimo->IMB_CLTCCR_DV = $request->input( 'IMB_CLTCCR_DV');
        $propimo->IMB_CLTCCR_PESSOA = $request->input( 'IMB_CLTCCR_PESSOA');
        $propimo->IMB_CLTCCR_CPF = $request->input( 'IMB_CLTCCR_CPF',0);
        $propimo->IMB_IMVCLT_PIX = $request->input( 'IMB_IMVCLT_PIX');
        $propimo->IMB_IMVCLT_TAXAADMINISTRAT = $request->input( 'IMB_IMVCLT_TAXAADMINISTRAT',0);
        $propimo->IMB_IMVCLT_TAXAADMINISTRATFORMA = $request->input( 'IMB_IMVCLT_TAXAADMINISTRATFORMA');
        $propimo->IMB_CLTCCR_DOC = $request->input( 'IMB_CLTCCR_DOC');
        $propimo->IMB_CLTCCR_POUPANCA = $request->input( 'IMB_CLTCCR_POUPANCA');
        $propimo->save();

        if ( $request->input( 'IMB_IMVCLT_PRINCIPAL') == "S" )
        {
            $imv = mdlImovel::find( $request->input( 'IMB_IMV_ID') );
            if( isset( $imv ))
            {
                $imv->IMB_CLT_ID = $request->input( 'IMB_CLT_ID');
                $imv->save();
            }
        }




        return response()->json($propimo,200);
//
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
        $prop = mdlPropImovel::select(
            [
            	'IMB_PROPRIETARIOIMOVEL.*',
                'IMB_CLIENTE.IMB_CLT_NOME',
                DB::raw('( CASE  WHEN IMB_IMVCLT_PRINCIPAL = "S" THEN "Principal" else " " end ) as principal ')
            ])
            ->leftjoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID')
            ->where( 'IMB_PPI_ID', $id)
            ->first();

        return $prop->toJson();
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
        $propimo = mdlPropImovel::find( $id );
        if( isset( $propimo ))
        {
            $propimo->delete();
            return response('ok',200);

        }
        return response('Já Excluido',404);
    }

    public function carga( $id )
    {
        $prop = mdlPropImovel::select(
            [
            	'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID',
                'IMB_IMVCLT_PRINCIPAL',
                'IMB_IMVCLT_PERCENTUAL4',
                'IMB_PPI_ID',
            	'IMB_IMV_ID',
                'IMB_CLIENTE.IMB_CLT_NOME',
                'IMB_CLIENTE.IMB_CLT_EMAIL',
                'IMB_CLIENTE.CEP_CID_NOMERES',
                'IMB_PROPRIETARIOIMOVEL.GER_BNC_NUMERO',
                'IMB_PROPRIETARIOIMOVEL.GER_BNC_AGENCIA',
                'IMB_PROPRIETARIOIMOVEL.IMB_CLTCCR_NUMERO',
                'IMB_PROPRIETARIOIMOVEL.IMB_CLTCCR_DV',
                'IMB_PROPRIETARIOIMOVEL.IMB_CLTCCR_NOME',
                'IMB_PROPRIETARIOIMOVEL.IMB_CLTCCR_CPF',
                'IMB_PROPRIETARIOIMOVEL.IMB_IMVCLT_PIX',
                'IMB_PROPRIETARIOIMOVEL.IMB_BNC_AGENCIADV',
                DB::raw( '( SELECT IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_PROPRIETARIOIMOVEL.IMB_FORPAG_ID) AS FORMAPAGAMENTO'),
                DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES '),
                DB::raw('( CASE  WHEN IMB_IMVCLT_PRINCIPAL = "S" THEN "Principal" else " " end ) as principal ')
            ])
            ->leftjoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID')
            ->where( 'IMB_IMV_ID', $id)
            ->get();

        return $prop->toJson();

        //
    }

    public function participacaoTotal($id)
    {


        $prop = DB::table('IMB_PROPRIETARIOIMOVEL')
                ->where('IMB_IMV_ID', $id)
                ->sum('IMB_IMVCLT_PERCENTUAL4');

        /*        $prop = DB::table('IMB_PROPRIETARIOIMOVEL')
        ->where('IMB_IMV_ID', '=', $id)
        ->sum('IMB_IMVCLT_PERCENTUAL4');
        */
        return $prop;
    }


    public function temPrincipal($id)
    {


        $prop = DB::table('IMB_PROPRIETARIOIMOVEL')
            ->where('IMB_IMV_ID', $id)
            ->where('IMB_IMVCLT_PRINCIPAL', 'S')
            ->count('*');

        /*        $prop = DB::table('IMB_PROPRIETARIOIMOVEL')
        ->where('IMB_IMV_ID', '=', $id)
        ->sum('IMB_IMVCLT_PERCENTUAL4');
        */
        return $prop;
    }

    function limparSelecionados( Request $request )
    {

        $id = $request->input( 'IMB_ATD_ID');

        DB::table('TMP_IMOVEISSELECIONADOS')
        ->whereIn('IMB_ATD_ID', $id)
        ->delete();

        return response('ok',200);

    }

    function imoveisProprietario( $id )
    {

        $imoveis = mdlImovel::select('*')
        ->leftJoin('IMB_PROPRIETARIOIMOVEL', 'IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID', 'IMB_IMOVEIS.IMB_IMV_ID')
        ->where( 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID','=', $id )
        ->get();

        return $imoveis;



    }

    function imoveisProprietarioIMV( $id, $idcliente )
    {

        $ppi = mdlPropImovel::select(
            [
                'GER_BNC_NUMERO',
                'IMB_IMV_ID',
                DB::raw('( select A.GER_BNC_NOME FROM GER_BANCOS A
                        WHERE A.GER_BNC_NUMERO=IMB_PROPRIETARIOIMOVEL.GER_BNC_NUMERO LIMIT 1) AS GER_BNC_NOME '),
                        'GER_BNC_AGENCIA',
                        'IMB_BNC_AGENCIADV',
                        'IMB_CLTCCR_NUMERO',
                        'IMB_CLTCCR_DV',
                        'IMB_CLTCCR_NOME',
                        'IMB_CLTCCR_CPF',
                        'IMB_IMVCLT_PIX'
            ]
        )
        ->where( 'IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID','=', $id )
        ->where( 'IMB_CLT_ID','=', $idcliente )
        ->first();


        return $ppi;



    }


    function find( $id )
    {
        $propimo = mdlPropImovel::find( $id );
        return $propimo;
    }

    public function cargaSemJson( $id )
    {
        $prop = mdlPropImovel::select(
            [
            	'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID',
                'IMB_IMVCLT_PRINCIPAL',
                'IMB_IMVCLT_PERCENTUAL4',
                'IMB_PPI_ID',
            	'IMB_IMV_ID',
                'IMB_CLIENTE.IMB_CLT_NOME',
                'IMB_CLIENTE.IMB_CLT_EMAIL',
                'IMB_CLIENTE.CEP_CID_NOMERES',
                DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES '),
                DB::raw('( CASE  WHEN IMB_IMVCLT_PRINCIPAL = "S" THEN "Principal" else " " end ) as principal ')
            ])
            ->leftjoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID')
            ->where( 'IMB_IMV_ID', $id)
            ->get();

        return $prop;

        //
    }

    public function locadoresContrato( $pasta )
    {
        $prop = mdlPropImovel::select(
            [
            	'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID',
                'IMB_IMVCLT_PRINCIPAL',
                'IMB_IMVCLT_PERCENTUAL4',
                'IMB_PPI_ID',
            	'IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID',
                'IMB_CLIENTE.IMB_CLT_NOME',
                'IMB_CLIENTE.IMB_CLT_EMAIL',
                'IMB_CLIENTE.CEP_CID_NOMERES',
                DB::raw( '( SELECT IMB_FORPAG_NOME FROM IMB_FORMAPAGAMENTO WHERE IMB_FORMAPAGAMENTO.IMB_FORPAG_ID = IMB_PROPRIETARIOIMOVEL.IMB_FORPAG_ID) AS FORMAPAGAMENTO'),
                DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES '),
                DB::raw('( CASE  WHEN IMB_IMVCLT_PRINCIPAL = "S" THEN "Principal" else " " end ) as principal ')
            ])
            ->leftjoin( 'IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID')
            ->leftJoin( 'IMB_CONTRATO', 'IMB_CONTRATO.IMB_IMV_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID')
            ->where( 'IMB_CONTRATO.IMB_CTR_REFERENCIA', $pasta)
            ->get();

        return response()->json( $prop, 200);

        //
    }

    public function imoveisdoProprietario( $idcliente )
    {
        $imoveis = mdlPropImovel::select( [
            'IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID',
            'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID',
            'IMB_IMV_DATACADASTRO',
            'IMB_CLT_NOME',
            DB::raw( '( SELECT imovel( IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID ) ) AS ENDERECO'),
            'IMB_IMVCLT_PERCENTUAL4',
            DB::raw( 'case when exists( select IMB_CTR_ID FROM IMB_CONTRATO 
            WHERE IMB_CONTRATO.IMB_IMV_ID = IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID AND IMB_CTR_SITUACAO="ATIVO" LIMIT 1) THEN "ALUGADO"
            ELSE "-" end as SITUACAO'),
            'VIS_STA_NOME',
            'VIS_STA_SITUACAO',
            'CEP_BAIRRO.CEP_BAI_NOME',
            DB::raw( '( select IMB_CND_NOME FROM IMB_CONDOMINIO WHERE IMB_CONDOMINIO.IMB_CND_ID = IMB_IMOVEIS.IMB_CND_ID) AS CONDOMINIO')
        ])
        ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID' )
        ->leftJoin( 'IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID', 'IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID' )
        ->leftJoin( 'CEP_BAIRRO', 'CEP_BAIRRO.CEP_BAI_ID', 'IMB_IMOVEIS.CEP_BAI_ID')
        ->leftJoin( 'VIS_STATUSIMOVEL','VIS_STATUSIMOVEL.VIS_STA_ID', 'IMB_IMOVEIS.VIS_STA_ID' )
        ->where( 'IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID', '=', $idcliente )->get();

        if (count($imoveis) < 1) return response()->json('NA',404);
        return response()->json( $imoveis, 200 );



    }
    

}
