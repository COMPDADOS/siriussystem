<?php

namespace App\Http\Controllers;
use App\mdlTelefone;
use App\mdlContrato;
use App\mdlPropImovel;
use App\mdlImovel;
use App\mdlLocatarioContrato;
use App\mdlFiadorContrato;
use Auth;
use Illuminate\Http\Request;

class ctrTelefone extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }
        
    
    public function carga( $id )
    {
        $tel = mdlTelefone::Select( 
            [ 
                'IMB_TLF_ID',
                'IMB_TLF_DDD',
                'IMB_TLF_DDI',
                'IMB_TLF_NUMERO',
                'IMB_TLF_TIPOTELEFONE',
                'IMB_TLF_ID_CLIENTE',
                'IMB_CLT_NOME'
            ]
        )
        ->where( 'IMB_TLF_ID_CLIENTE', $id )
        ->leftJoin('IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_TELEFONES.IMB_TLF_ID_CLIENTE')
        ->get();

        return $tel;
    
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
    public function store( $id, $ddd, $numero, $tipo )
    {
           
        $ver = mdlTelefone::select( 'IMB_TLF_ID')
        ->where( 'IMB_TLF_ID_CLIENTE', $id)
        ->where( 'IMB_TLF_DDD', $ddd)
        ->where( 'IMB_TLF_NUMERO', $numero)
        ->delete();

            $t = new mdlTelefone();
            $t->IMB_TLF_ID_CLIENTE      = $id;
            $t->IMB_TLF_DDD             = $ddd;
            $t->IMB_TLF_NUMERO          = $numero;
            $t->IMB_TLF_TIPOTELEFONE    = $tipo;
            $t->IMB_TLF_TIPO='C'; 
            $t->IMB_IMB_ID=Auth::user()->IMB_IMB_ID;
            $t->IMB_ATD_ID=Auth::user()->IMB_ATD_ID;
            $t->save();

        return  response( 'gravado', 200);
  
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
        
        $tabela = mdlTelefone::find( $id );
        return  $tabela;
        
    }
    public function editSalvar( Request $request )
    {
        
        $id = $request->IMB_TLF_ID;

        if( $id <> '' )
            $tabela = mdlTelefone::find( $id );
        else
        {
            $tabela = new mdlTelefone;
            $tabela->IMB_TLF_ID_CLIENTE = $request->IMB_TLF_ID_CLIENTE;
            $tabela->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $tabela->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $tabela->IMB_TLF_TIPO = 'C';
            $tabela->IMB_TLF_DTHALTERACAO = date( 'Y/m/d');

        }
        $tabela->IMB_TLF_NUMERO = $request->IMB_TLF_NUMERO;
        $tabela->IMB_TLF_DDD = $request->IMB_TLF_DDD;
        $tabela->IMB_TLF_TIPOTELEFONE = $request->IMB_TLF_TIPOTELEFONE;
        $tabela->save();

        return response()->json( 'ok',200);
        
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
    public function destroy( $id)
    {
        $tabela = mdlTelefone::find( $id );
        $tabela->delete();
        return response()->json('Excluido', 200);
    }

    public function salvarLote( Request $request )
    {
//        $exis = mdlTelefone::where( 'IMB_TLF_ID_CLIENTE','=', $request->IMB_CLT_ID)
        //->delete();
        
        $telefones = $request->numeros;

        foreach( $telefones as $telefone )
        {

            $id=$telefone[4];

            if( $id=='' )
                $tel = new mdlTelefone;
            else
                $tel =  mdlTelefone::find( $id );

            $tel->IMB_TLF_ID_CLIENTE = $request->IMB_CLT_ID;
            $tel->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $tel->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
            $tel->IMB_TLF_ID_CLIENTE = $request->IMB_CLT_ID;
            $tel->IMB_TLF_TIPO = 'C';
            $tel->IMB_TLF_TIPOTELEFONE = $telefone[3];
            $tel->IMB_TLF_NUMERO = $telefone[2];
            $tel->IMB_TLF_DDI = $telefone[0];
            $tel->IMB_TLF_DDD = $telefone[1];
            $tel->IMB_TLF_DTHALTERACAO = date( 'Y/m/d');
            $tel->save();
        }
        
        return response()->json( 'ok',200);
           
  
    }

    public function telefoneEnvolvidosContrato( $id )
    {

        $contrato = mdlContrato::find( $id );

        $imovel = mdlImovel::find( $contrato->IMB_IMV_ID);

        $ppi = mdlPropImovel::where( "IMB_IMV_ID", "=", $imovel->IMB_IMV_ID)->get();

        $telefones = [];

        foreach( $ppi as $p)
        {
            $fones = mdlTelefone::where( 'IMB_TLF_ID_CLIENTE','=', $p->IMB_CLT_ID )
            ->where('IMB_TELEFONES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_TELEFONES.IMB_TLF_ID_CLIENTE')
            ->get();
        

            foreach( $fones as $fone)
            {
                array_push($telefones, 
                    ['tipo' => 'Proprietário',  
                    'nome'=>$fone->IMB_CLT_NOME,
                    'DDI' => $fone->IMB_TLF_DDI,
                    'DDD' => $fone->IMB_TLF_DDD,
                    'numero' => $fone->IMB_TLF_NUMERO,
                    'Tipofone' => $fone->IMB_TLF_TIPOTELEFONE,
                    'Email' =>$fone->IMB_CLT_EMAIL,
                    'IMB_CLT_ID' => $p->IMB_CLT_ID] );            
            }

            
        };

        $lcts = mdlLocatarioContrato::where('IMB_CTR_ID','=', $id )->get();
        foreach( $lcts as $lct)
        {
            $fones = mdlTelefone::where( 'IMB_TLF_ID_CLIENTE','=', $lct->IMB_CLT_ID )
            ->where('IMB_TELEFONES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_TELEFONES.IMB_TLF_ID_CLIENTE')
            ->get();

            foreach( $fones as $fone)
            {
                array_push($telefones, 
                    ['tipo' => 'Locatário',  
                    'nome'=>$fone->IMB_CLT_NOME,
                    'DDI' => $fone->IMB_TLF_DDI,
                    'DDD' => $fone->IMB_TLF_DDD,
                    'numero' => $fone->IMB_TLF_NUMERO,
                    'Tipofone' => $fone->IMB_TLF_TIPOTELEFONE ,
                    'Email' =>$fone->IMB_CLT_EMAIL,
                    'IMB_CLT_ID' => $lct->IMB_CLT_ID] );       
            }

            
        };

        $fds = mdlFiadorContrato::where('IMB_CTR_ID','=', $id )->get();
        foreach( $fds as $fd)
        {
            $fones = mdlTelefone::where( 'IMB_TLF_ID_CLIENTE','=', $fd->IMB_CLT_ID )
            ->where('IMB_TELEFONES.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_TELEFONES.IMB_TLF_ID_CLIENTE')
            ->get();

            foreach( $fones as $fone)
            {
                array_push($telefones, 
                    ['tipo' => 'Fiador',  
                    'nome'=>$fone->IMB_CLT_NOME,
                    'DDI' => $fone->IMB_TLF_DDI,
                    'DDD' => $fone->IMB_TLF_DDD,
                    'numero' => $fone->IMB_TLF_NUMERO,
                    'Tipofone' => $fone->IMB_TLF_TIPOTELEFONE,
                    'Email' =>$fone->IMB_CLT_EMAIL,
                    'IMB_CLT_ID' => $fd->IMB_CLT_ID] );                   
            }

            
        };
        


        return response()->json( $telefones,200);
        


    }
    public function gravarComDDI( $id, $ddi, $ddd, $numero, $tipo )
    {
           
        $t = new mdlTelefone();
        $t->IMB_TLF_ID_CLIENTE      = $id;
        $t->IMB_TLF_DDD             = $ddd;
        $t->IMB_TLF_NUMERO          = $numero;
        $t->IMB_TLF_TIPOTELEFONE    = $tipo;
        $t->IMB_TLF_TIPO='C'; 
        $t->IMB_IMB_ID=Auth::user()->IMB_IMB_ID;
        $t->IMB_ATD_ID=Auth::user()->IMB_ATD_ID;
        $t->save();

        return  response()->json( 'gravado', 200);
  
    }




}
