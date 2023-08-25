<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\mdlMetas;
use App\mdlMetasAgencia;
use App\mdlMetasCorretor;

class ctrMetas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth');
    }
    
    
    public function index()
    {
        //
    }

    public function metaGeral( $id, $idagencia, $idatd )
    {


        $obj = new \stdClass();

        //return $met;
        $obj->geralimoveis      = 0;
        $obj->geralcontratos    = 0;
        $obj->geralatendimentos = 0;
        $obj->geralclientes     = 0;
        $obj->ageimoveis        = 0;
        $obj->agecontratos      = 0;
        $obj->gageatendimentos  = 0;
        $obj->ageclientes       = 0;
        $obj->corimoveis        = 0;
        $obj->corcontratos      = 0;
        $obj->coreatendimentos  = 0;
        $obj->corclientes       = 0;

        $metas = mdlMetas::where( 'IMB_IMB_ID','=', $id )->get();

        
        if( $metas )
        {
                $obj->geralimoveis      = $metas[0]->IMB_MET_NOVOSIMOVEIS;
                $obj->geralcontratos    = $metas[0]->IMB_MET_NOVOSCONTRATOS;
                $obj->geralatendimentos = $metas[0]->IMB_MET_NOVOSATENDIMENTOS;
                $obj->geralclientes     = $metas[0]->IMB_MET_NOVOSCLIENTES;
        };

        $metascor = mdlMetasCorretor::
            where( 'IMB_IMB_ID','=', $id )
            ->where( 'IMB_ATD_ID','=', $idatd )
            ->get();

        
            if( count($metascor) > 0 )
            {
            $obj->corimoveis       = $metascor[0]->IMB_MET_NOVOSIMOVEIS;
            $obj->corcontratos     = $metascor[0]->IMB_MET_NOVOSCONTRATOS;
            $obj->coratendimentos = $metascor[0]->IMB_MET_NOVOSATENDIMENTOS;
            $obj->corclientes      = $metascor[0]->IMB_MET_NOVOSCLIENTES;
            }
                
       
        $metasage = mdlMetasAgencia::
            where( 'IMB_IMB_ID','=', $id )
            ->where( 'IMB_IMB_ID2','=', $idagencia )
            ->get();
        if( count($metasage) > 0 )
        {
            $obj->ageimoveis       = $metasage[0]->IMB_MET_NOVOSIMOVEIS;
            $obj->agecontratos     = $metasage[0]->IMB_MET_NOVOSCONTRATOS;
            $obj->gagatendimentos = $metasage[0]->IMB_MET_NOVOSATENDIMENTOS;
            $obj->ageclientes      = $metasage[0]->IMB_MET_NOVOSCLIENTES;
        }

        $metas= json_encode( $obj );
        return view( 'comercial.dashboad.index', compact( 'metas') );

    }

    public function metaAgencia( $idimb, $idagencia )
    {
        $met = mdlMetas::
        where( 'IMB_IMB_ID','=', $idimb )
        ->where( 'IMB_IMB_ID2','=', $idagencia )
        ->get();
        return $met;

        
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
}
