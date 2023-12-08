<?php

 namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\mdlCliente;
    use App\mdlClientePerfil;
    use App\mdlClienteRepresentante;
    use App\mdlTelefone;
    use App\mdlAtd;
    use App\mdlClienteUsuario;
    use App\mdlClienteAtendimento;
    use App\mdlLocatarioContrato;
    use App\mdlPropImovel;
    use DataTables;
    use App\User;
    use DB;
    use Auth;
    use Log;

    class ctrCliente extends Controller
    {

        public function __construct()
        {

            $this->middleware('auth');
        }


        public function index()
        {
            return view( 'cliente.index');
            //
        }

        public function editAjax($id, $readonly)
        {

            return view( 'cliente.edit_ajax', compact('id', 'readonly'));

        }


        public function paginacao()
        {
            return view('cliente.paginacao');
        }


        public function todos( )
        {
            $clientes = mdlCliente::paginate( 12);

            return view( 'cliente.paginacao', compact( 'clientes') );

        }




        public function list(Request $request)
        {

            $usuariologado = Auth::user()->IMB_ATD_ID;

  /*          $vertudo= app('App\Http\Controllers\ctrDireitos')
            ->checarDireitoPHP( $usuariologado,'205', '1' );
            //205 ver clientes de outros corretores
*/
            $clientes = mdlCliente::select(
                [
                    'IMB_CLT_ID',
                    'IMB_CLT_NOME',
                    'IMB_CLTCJG_NOME',
                    'IMB_CLT_DATACADASTRO',
                    'IMB_CLT_CPF',
                    'IMB_CLT_DTHALTERACAO',
                    'IMB_CLT_PRECADASTRO',
                    DB::raw( '( SELECT IMB_CLT_ID FROM IMB_CONTRATOSEGUROINCENDIO
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTRATOSEGUROINCENDIO.IMB_CLT_ID LIMIT 1) SEGUROFIANCA'),
                    DB::raw( '(SELECT IMB_CLA_ID FROM IMB_CLIENTEATENDIMENTO
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CLIENTEATENDIMENTO.IMB_CLT_ID limit 1 ) INTERESSADO '),
                    DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES '),
                    DB::raw('( SELECT IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID
                    FROM IMB_PROPRIETARIOIMOVEL
                    WHERE IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID =
                    IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS LOCADOR'),
                    DB::raw('( SELECT IMB_LOCATARIOCONTRATO.IMB_CTR_ID
                    FROM IMB_LOCATARIOCONTRATO
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID =
                    IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS LOCATARIO'),
                    DB::raw('( SELECT IMB_FIADORCONTRATO.IMB_CTR_ID
                    FROM IMB_FIADORCONTRATO
                    WHERE IMB_FIADORCONTRATO.IMB_CLT_ID =
                    IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS FIADOR'),
                    DB::raw( 'CorretoresCliente( IMB_CLIENTE.IMB_CLT_ID ) as CORRETOR'),
                    DB::raw( '( SELECT  COALESCE(IMB_CCH_ID,0) FROM IMB_CONTROLECHAVE
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTROLECHAVE.IMB_CLT_ID limit 1) AS IMB_CCH_ID'),
                ]);

            $clientes->where( 'IMB_CLIENTE.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID);



            $cFiltrou = 'N';

/*
            if( $vertudo <> 'S')
            {
                $clientes->whereRaw( DB::raw( "exists( select IMB_ATD_ID FROM
                IMB_CLIENTEUSUARIO WHERE IMB_CLIENTEUSUARIO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                AND IMB_CLIENTEUSUARIO.IMB_ATD_ID = $usuariologado)
                or exists( select IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID FROM IMB_CAPIMO,IMB_PROPRIETARIOIMOVEL
                WHERE IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID AND
                IMB_CAPIMO.IMB_IMV_ID = IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID
                AND IMB_CAPIMO.IMB_ATD_ID = $usuariologado)"));

            }
*/



            if( $request->pesquisagenerica <> '' )
            {
                $ddd=substr( $request->pesquisagenerica,0,2);
                $numero=substr( $request->pesquisagenerica,2);

                if( $request->tipopesquisa == 'P')
                {
                    $cFiltrou = 'S';
                    $clientes->whereRaw( DB::raw("IMB_CLT_NOME LIKE '%{$request->pesquisagenerica}%' AND exists( SELECT IMB_PPI_ID FROM IMB_PROPRIETARIOIMOVEL
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID) or
                    exists( select IMB_TLF_ID FROM IMB_TELEFONES
                    WHERE IMB_TLF_ID_CLIENTE = IMB_CLIENTE.IMB_CLT_ID AND IMB_TLF_DDD='$ddd' AND IMB_TLF_NUMERO='$numero')"));
                }

                if( $request->tipopesquisa == 'LT')
                {
                    $cFiltrou = 'S';
                    $clientes->whereRaw( DB::raw("IMB_CLT_NOME LIKE '%{$request->pesquisagenerica}%' AND exists( SELECT IMB_CLT_ID FROM IMB_LOCATARIOCONTRATO
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_LOCATARIOCONTRATO.IMB_CLT_ID)" ));
                }

                if( $request->tipopesquisa == 'FD' )
                {
                    $cFiltrou = 'S';
                    $clientes->whereRaw( DB::raw("IMB_CLT_NOME LIKE '%{$request->pesquisagenerica}%' AND exists( SELECT IMB_CLT_ID FROM IMB_FIADORCONTRATO
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_FIADORCONTRATO.IMB_CLT_ID)" ));
                }



                if( $request->tipopesquisa == 'I')
                {
                    $cFiltrou = 'S';
                    $clientes->whereRaw( DB::raw("IMB_CLT_NOME LIKE '%{$request->pesquisagenerica}%' AND  exists( SELECT IMB_CLA_ID FROM IMB_CLIENTEATENDIMENTO
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CLIENTEATENDIMENTO.IMB_CLT_ID) or
                    exists( select IMB_TLF_ID FROM IMB_TELEFONES
                    WHERE IMB_TLF_ID_CLIENTE = IMB_CLIENTE.IMB_CLT_ID AND IMB_TLF_DDD='$ddd' AND IMB_TLF_NUMERO='$numero')"));
                }

            }


            if ($request->has('id') && strlen(trim($request->id)) > 0){
                $cFiltrou = 'S';
                $clientes->where('IMB_CLT_ID', $request->id);
            }

            if ($request->has('fone') && strlen(trim($request->fone)) > 0)
            {
                $fone=trim($request->fone);
                $cFiltrou = 'S';
                $fone=str_replace( '(','',$fone);
                $fone=str_replace( ')','',$fone);
                $fone=str_replace( '-','',$fone);
                $fone=str_replace( ' ','',$fone);

                $ddd=substr( $fone,0,2);
                $numero=substr( $fone,2);
                $clientes->where( 'IMB_TLF_NUMERO','=', $numero)
                ->where('IMB_TLF_DDD','=',$ddd)
                ->leftJoin('IMB_TELEFONES', 'IMB_TELEFONES.IMB_TLF_ID_CLIENTE',
                 'IMB_CLIENTE.IMB_CLT_ID');
            }

            if ($request->has('nome') && strlen(trim($request->nome)) > 0){
                $cFiltrou = 'S';
                $clientes->whereRaw("IMB_CLT_NOME LIKE '%{$request->nome}%'");
            }

            if ($request->has('corretor') && strlen(trim($request->corretor)) > 0)
            {
                $cFiltrou = 'N';  //Vou Deixar como 'N' para deixar em order de ultimos cadastros por corretor
                $clientes->whereRaw("exists( SELECT IMB_CLU_ID FROM IMB_CLIENTEUSUARIO
                    WHERE IMB_CLIENTEUSUARIO.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID
                    AND IMB_CLIENTEUSUARIO.IMB_ATD_ID = $request->corretor)" );
            }



            if ($request->has('cnpj') && strlen(trim($request->cnpj)) > 0){
                $cFiltrou = 'S';
                $clientes->whereRaw("IMB_CLT_CPF LIKE '%{$request->cnpj}%'");
            }

            if ($request->has('conjuge') && strlen(trim($request->conjuge)) > 0){
                $cFiltrou = 'S';
                $clientes->whereRaw("IMB_CLTCJG_NOME LIKE '%{$request->conjuge}%'");
            }



            if ( $cFiltrou == 'N' )
                $clientes->orderBy('IMB_CLT_DTHALTERACAO','DESC')->limit(200);
            else
                $clientes->orderBy('IMB_CLT_NOME','ASC')->limit(200);


            return DataTables::of($clientes)->make(true);
        }        



        public function form()
        {
            return 'ok';
            
        }

        public function store(Request $request)
        {
            function formatarData($data){
                $rData = implode("-", array_reverse(explode("/", trim($data))));
                return $rData;
            }

                $cep = $request->IMB_CLT_RESENDCEP;
                $cep = str_replace( $cep,'-','');
                $cep = trim( $cep);
    //           dd( $request );
                $cliente = new mdlCliente;


                $cliente->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cliente->IMB_IMB_ID2 = Auth::user()->IMB_IMB_ID2;
                $cliente->IMB_CLT_NOME = $request->input( 'IMB_CLT_NOME');
                $cliente->IMB_CLT_NOME = $request->input( 'IMB_CLT_NOME');
                $cliente->IMB_CLT_PESSOA = $request->input( 'IMB_CLT_PESSOA');
                $cliente->IMB_CLT_ESTADOCIVIL = $request->input( 'IMB_CLT_ESTADOCIVIL');
                $cliente->IMB_CLT_SEXO = $request->input( 'IMB_CLT_SEXO');
                $cliente->IMB_CLT_CPF = $request->input( 'IMB_CLT_CPF');
                $cliente->IMB_CLT_RG = $request->input( 'IMB_CLT_RG');
                $cliente->IMB_CLT_RGORGAO = $request->input( 'IMB_CLT_RGORGAO');
                if ( $request->input( 'IMB_CLT_DATNAS') <> '' )
                    $cliente->IMB_CLT_DATNAS = formatarData( $request->input( 'IMB_CLT_DATNAS') );

                $cliente->IMB_CLT_NACIONALIDADE = $request->input( 'IMB_CLT_NACIONALIDADE');
                $cliente->IMB_CLT_LOCADOR = $request->input( 'IMB_CLT_LOCADOR');
                $cliente->IMB_CLT_LOCATARIO = $request->input( 'IMB_CLT_LOCATARIO');
                $cliente->IMB_CLT_FIADOR = $request->input( 'IMB_CLT_FIADOR');
                $cliente->IMB_CLT_RESEND = $request->input( 'IMB_CLT_RESEND');
                $cliente->IMB_CLT_RESENDNUM = $request->input( 'IMB_CLT_RESENDNUM');
                $cliente->IMB_CLT_RESENDCOM = $request->input( 'IMB_CLT_RESENDCOM');
                $cliente->IMB_CLT_RESENDCEP = $cep;
                $cliente->CEP_BAI_NOMERES = $request->input( 'CEP_BAI_NOMERES');
                $cliente->CEP_CID_NOMERES = $request->input( 'CEP_CID_NOMERES');
                $cliente->CEP_UF_SIGLARES = $request->input( 'CEP_UF_SIGLARES');
                $cliente->IMB_CLT_EMAIL = $request->input( 'IMB_CLT_EMAIL');
                $cliente->IMB_CLT_COMCOM = $request->input( 'IMB_CLT_COMCOM');
                $cliente->IMB_CLT_PROFISSAO = $request->input( 'IMB_CLT_PROFISSAO');
                $cliente->IMB_CLTCJG_NOME = $request->input( 'IMB_CLTCJG_NOME');
                $cliente->IMB_CLTCJG_CPF = $request->input( 'IMB_CLTCJG_CPF');
                $cliente->IMB_CLTCJG_RG = $request->input( 'IMB_CLTCJG_RG');
                $cliente->IMB_CLTCJG_RGORGAO = $request->input( 'IMB_CLTCJG_RGORGAO');
                $cliente->IMB_CLTCJG_RGESTADO = $request->input( 'IMB_CLTCJG_RGESTADO');
                $cliente->IMB_CLTCJG_NACIONALIDADE = $request->input( 'IMB_CLTCJG_NACIONALIDADE');
                if ( $request->input( 'IMB_CLTCJG_DATANASCIMENTO') <> '' )
                    $cliente->IMB_CLTCJG_DATANASCIMENTO =formatarData($request->input( 'IMB_CLTCJG_DATANASCIMENTO'));
                $cliente->IMB_CLTCJG_SEXO = $request->input( 'IMB_CLTCJG_SEXO  ');
                $cliente->IMB_CLTCJG_PROFISSAO = $request->input( 'IMB_CLTCJG_PROFISSAO');
                $cliente->IMB_CLT_OBSERVACAO = $request->input( 'IMB_CLT_OBSERVACAO');
                $cliente->IMB_CLT_DATACADASTRO = date('Y-m-d H:i:s');
                $cliente->IMB_CLT_DTHALTERACAO = date('Y-m-d H:i:s');
                $cliente->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $cliente->IMB_CLT_PRECADASTRO = $request->IMB_CLT_PRECADASTRO;
                $cliente->IMB_CLT_ATIVO = 'S';
                $cliente->IMB_CLT_IMOVELGARANTIA = $request->IMB_CLT_IMOVELGARANTIA;
                $cliente->IMB_CLT_CIDADEIBGE = $request->IMB_CLT_CIDADEIBGE;
                $cliente->IMB_CLT_MEI = $request->IMB_CLT_MEI;

                $cliente->save();

                //return dd( $cliente );

//                if ( $request->input( 'IMB_CLT_PRECADASTRO') =='S' )
                //{
                    //return response()->json( 'ok',200);
                //};

                return response( $cliente->IMB_CLT_ID,200 );


        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function localizar($id)
        {

            $cliente = mdlCliente::find( $id );
            return $cliente->toJson();

        }
        public function find($id)
        {

            $cliente = mdlCliente::find( $id );
            
            return $cliente;

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit( Request $request)
        {
            $id = $request->input('id');
            $readonly = $request->input('readonly');
/*            $clienterepresentante = mdlClienteRepresentante::select( '*')
            ->where( 'IMB_CLT_ID', $id )->get();

            $telefones = mdlTelefone::select( '*')
            ->where( 'IMB_TLF_ID_CLIENTE', $id )
            ->get();

            $cliente = mdlCliente::find( $id );

            return view( 'cliente.edit', compact('cliente', 'clienterepresentante', 'telefones') );
  */

              return view( 'cliente.edit', compact('id', 'readonly') );


        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        /*public function update(Request $request)
        {
            function formatarData($data){
                $rData = implode("-", array_reverse(explode("/", trim($data))));
                return $rData;
            }


               //dd( $request->input( 'IMB_CLT_OBSERVACAO') );
            $codigo =  $request->input('IMB_CLT_ID') ;


            $cliente = mdlCliente::find($codigo );
            if( isset( $cliente ))
            {


                $cliente->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cliente->IMB_IMB_ID2 = Auth::user()->IMB_IMB_ID2;

                dd( "id: $cliente->IMB_IMB_ID id2: $cliente->IMB_IMB_ID2" );
                $cliente->IMB_CLT_NOME = $request->input( 'CIMB_CLT_NOME');
                $cliente->IMB_CLT_PESSOA = $request->input( 'CIMB_CLT_PESSOA');
                $cliente->IMB_CLT_ESTADOCIVIL = $request->input( 'CIMB_CLT_ESTADOCIVIL');
                $cliente->IMB_CLT_SEXO = $request->input( 'CIMB_CLT_SEXO');
                $cliente->IMB_CLT_CPF = $request->input( 'CIMB_CLT_CPF');
                $cliente->IMB_CLT_RG = $request->input( 'CIMB_CLT_RG');
                $cliente->IMB_CLT_RGORGAO = $request->input( 'CIMB_CLT_RGORGAO');
                $cliente->IMB_CLT_DATNAS = formatarData( $request->input( 'CIMB_CLT_DATNAS') );
                if ( $request->input( 'CIMB_CLT_DATNAS') <> '' )
                    $cliente->IMB_CLT_DATNAS = formatarData( $request->input( 'CIMB_CLT_DATNAS') );
                //else
                    //$cliente->IMB_CLT_DATNAS =date('Y/m/d');

                $cliente->IMB_CLT_NACIONALIDADE = $request->input( 'CIMB_CLT_NACIONALIDADE');
                $cliente->IMB_CLT_LOCADOR = $request->input( 'CIMB_CLT_LOCADOR');
                $cliente->IMB_CLT_LOCATARIO = $request->input( 'CIMB_CLT_LOCATARIO');
                $cliente->IMB_CLT_FIADOR = $request->input( 'CIMB_CLT_FIADOR');
                $cliente->IMB_CLT_RESEND = $request->input( 'CIMB_CLT_RESEND');
                $cliente->IMB_CLT_RESENDNUM = $request->input( 'CIMB_CLT_RESENDNUM');
                $cliente->IMB_CLT_RESENDCOM = $request->input( 'CIMB_CLT_RESENDCOM');
                $cliente->IMB_CLT_RESENDCEP = $request->input( 'CIMB_CLT_RESENDCEP');
                $cliente->CEP_BAI_NOMERES = $request->input( 'CCEP_BAI_NOMERES');
                $cliente->CEP_CID_NOMERES = $request->input( 'CCEP_CID_NOMERES');
                $cliente->CEP_UF_SIGLARES = $request->input( 'CCEP_UF_SIGLARES');
                $cliente->IMB_CLT_EMAIL = $request->input( 'CIMB_CLT_EMAIL');
                $cliente->IMB_CLT_COMCOM = $request->input( 'CIMB_CLT_COMCOM');
                $cliente->IMB_CLT_PROFISSAO = $request->input( 'CIMB_CLT_PROFISSAO');
                $cliente->IMB_CLTCJG_NOME = $request->input( 'CIMB_CLTCJG_NOME');
                $cliente->IMB_CLTCJG_CPF = $request->input( 'CIMB_CLTCJG_CPF');
                $cliente->IMB_CLTCJG_RG = $request->input( 'CIMB_CLTCJG_RG');
                $cliente->IMB_CLTCJG_RGORGAO = $request->input( 'CIMB_CLTCJG_RGORGAO');
                $cliente->IMB_CLTCJG_RGESTADO = $request->input( 'CIMB_CLTCJG_RGESTADO');
                $cliente->IMB_CLTCJG_NACIONALIDADE = $request->input( 'CIMB_CLTCJG_NACIONALIDADE');
                if ( $request->input( 'CIMB_CLTCJG_DATANASCIMENTO') <> '' )
                    $cliente->IMB_CLTCJG_DATANASCIMENTO = formatarData($request->input( 'CIMB_CLTCJG_DATANASCIMENTO'));
                $cliente->IMB_CLTCJG_SEXO = $request->input( 'CIMB_CLTCJG_SEXO');
                $cliente->IMB_CLTCJG_PROFISSAO = $request->input( 'CIMB_CLTCJG_PROFISSAO');
                $cliente->IMB_CLT_OBSERVACAO = $request->input( 'IMB_CLT_OBSERVACAO');
                $cliente->IMB_ATD_ID =Auth::user()->IMB_ATD_ID;
                $cliente->IMB_CLT_IMOVELGARANTIA = $request->IMB_CLT_IMOVELGARANTIA;
                $cliente->IMB_CLT_CIDADEIBGE = $request->IMB_CLT_CIDADEIBGE;
                $cliente->IMB_CLT_MEI = $request->IMB_CLT_MEI;

                $cliente->save();

            };
            return redirect('/cliente');
        }
*/
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

        public function BuscaIncremental( $str )
        {
            if( isset( $str ) )
            {
                $cliente = mdlCliente::select(
                [   'IMB_CLT_ID',
                    'IMB_CLT_NOME',
                    'IMB_CLT_CPF',
                    'IMB_CLT_RG',
                    'IMB_CLT_EMAIL',
                    DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES '),
                    ])
                ->where( 'IMB_CLT_NOME', 'like', '%'.$str.'%')
                ->where( 'IMB_IMB_ID', '=',Auth::user()->IMB_IMB_ID)
                ->orderBy('IMB_CLT_NOME')
                ->get();
                return $cliente;
            }

        }

        public function carga( Request $request )
        {

            $pessoa=$request->IMB_CLT_PESSOA;

            $tabela= mdlCliente::select( [
                'IMB_CLT_ID',
                'IMB_CLT_NOME',
                'IMB_CLT_CPF'
            ])
            ->where( 'IMB_CLT_NOME', '<>','')
            ->where( 'IMB_IMB_ID', '=',Auth::user()->IMB_IMB_ID);

            if( $pessoa )
                $tabela = $tabela->where( 'IMB_CLT_PESSOA','=', $pessoa );

            //return $tabela->toSql();
            $tabela = $tabela->orderBy('IMB_CLT_NOME')->get();



            return $tabela->toJson();
        //
        }


        public function salvar( Request $request )
        {
            //dd( $request );

            $cliente = mdlCliente::find($id);
            if( isset( $cliente )){
            };
    //          return $IMB_IMV_WEBIMOVEL;
            return redirect('imovel');

        }

        public function add()
        {

            return view( 'cliente.new');

            //
        }

        public function checarjacadastrado( $cpf )
        {

            $cpf =  str_replace( '.','', $cpf);
            $cpf =  str_replace( '-','', $cpf);
            $cpf =  str_replace( '/','', $cpf);

            $tabela= mdlCliente::select( [
                'IMB_CLT_ID',
                'IMB_CLT_NOME'
            ])
            ->where( 'IMB_CLT_CPF','=', $cpf )
    //        ->limit(100)
            ->first();

            if( $tabela == "" )
                return '';

            return $tabela->toJson();
        }

        public function  preCadastro( Request $request  )
        {

            $id = $request->input( 'IMB_CLT_ID');

            if ( $id == '' )
            {
                $cliente = new mdlCliente;
                $cliente->IMB_CLT_DATACADASTRO= date('Y/m/d');
            }
            else
            {
               $cliente = mdlCliente::find( $id );
            }
            $cliente->IMB_IMB_ID =Auth::user()->IMB_IMB_ID;
            $cliente->IMB_ATD_ID =Auth::user()->IMB_ATD_ID;
            $cliente->IMB_CLT_NOME   =  $request->input( 'IMB_CLT_NOME');
            $cliente->IMB_CLT_EMAIL  = $request->input( 'IMB_CLT_EMAIL');
            if( $request->input( 'IMB_CLT_RG') <> '' )
                $cliente->IMB_CLT_RG  = $request->input( 'IMB_CLT_RG');
            $cliente->IMB_CLT_PRECADASTRO  = 'S';
            $cliente->IMB_CLT_DTHALTERACAO= date('Y-m-d H:i:s');
            $cliente->IMB_CLT_DATACADASTRO= date('Y-m-d H:i:s');

            $cliente->save();


            return response()->json($cliente->IMB_CLT_ID,200);      //$cliente->save();

//            return $cliente->IMB_CLT_ID;

        }

        public function tipoCliente( $id )
        {
            $clientes = mdlCliente::select(
            [
                'IMB_CLT_ID',
                'IMB_CLT_PRECADASTRO',
                DB::raw('( SELECT IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID
                FROM IMB_PROPRIETARIOIMOVEL
                WHERE IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID =
                IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS LOCADOR'),
                DB::raw('( SELECT IMB_LOCATARIOCONTRATO.IMB_CTR_ID
                FROM IMB_LOCATARIOCONTRATO
                WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID =
                IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS LOCATARIO'),
                DB::raw('( SELECT IMB_FIADORCONTRATO.IMB_CTR_ID
                FROM IMB_FIADORCONTRATO
                WHERE IMB_FIADORCONTRATO.IMB_CLT_ID =
                IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS FIADOR')
            ]
            )->where('IMB_CLT_ID', $id )
            ->get();

            return $clientes;

        }

        public function updateAjax(Request $request)
        {
            function formatarData($data){
                $rData = implode("-", array_reverse(explode("/", trim($data))));
            }

            

               //dd( $request->input( 'IMB_CLT_OBSERVACAO') );
            $codigo =  $request->input('IMB_CLT_ID') ;

            $cep = $request->IMB_CLT_RESENDCEP;
            $cep = str_replace( '-','',$cep);
            $cep = trim( $cep);



            Log::info(  'CEP_UF_SIGLARES'.$request->CEP_UF_SIGLARES);
//            return $request->input( 'IMB_CLT_RESENDCEP');

            $cliente = mdlCliente::find($codigo );
            if( isset( $cliente ))
            {

                if( $cliente->IMB_CLT_ATIVO <> $request->IMB_CLT_ATIVO )
                {
                    $status = 'INATIVO';
                    if( $request->IMB_CLT_ATIVO == 'S') $status = 'ATIVO';

                          //dd( $request->all() );
                    $cliatm = new mdlClienteAtendimento;
                    $cliatm->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $cliatm->IMB_ATD_IDCADASTRO = Auth::user()->IMB_ATD_ID;
                    $cliatm->IMB_CLT_ID = $codigo;
                    $cliatm->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $cliatm->IMB_CLA_PRIORIDADE = $request->IMB_CLA_PRIORIDADE;
                    $cliatm->IMB_CLA_STATUS = 'Finalizado';
                    $cliatm->IMB_CLA_DATACADASTRO = date('Y-m-d H:i:s');
                    $cliatm->IMB_CLA_DATAATUALIZACAO = date('Y-m-d H:i:s');
                    $cliatm->IMB_CLA_DATAATENDIMENTO = date('Y-m-d H:i:s');
                    $cliatm->IMB_CLA_COMENTARIO = 'Mudou status para '.$status;
                    $cliatm->IMB_CLA_PRETENSAO = '';
                    $cliatm->IMB_CLA_FINALIDADE = '';
                    $cliatm->save();
                }


                $cliente->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cliente->IMB_IMB_ID2 = Auth::user()->IMB_IMB_ID2;
                $cliente->IMB_CLT_NOME = $request->input( 'IMB_CLT_NOME');
                $cliente->IMB_CLT_PESSOA = $request->input( 'IMB_CLT_PESSOA');
                $cliente->IMB_CLT_ESTADOCIVIL = $request->input( 'IMB_CLT_ESTADOCIVIL');
                $cliente->IMB_CLT_SEXO = $request->input( 'IMB_CLT_SEXO');
                $cliente->IMB_CLT_CPF = $request->input( 'IMB_CLT_CPF');
                $cliente->IMB_CLT_RG = $request->input( 'IMB_CLT_RG');
                $cliente->IMB_CLT_RGORGAO = $request->input( 'IMB_CLT_RGORGAO');
                $cliente->IMB_CLT_DATNAS = formatarData( $request->input( 'IMB_CLT_DATNAS') );
                if ( $request->input( 'IMB_CLT_DATNAS') <> '' )
                    $cliente->IMB_CLT_DATNAS =  $request->input( 'IMB_CLT_DATNAS');

                $cliente->IMB_CLT_NACIONALIDADE = $request->input( 'IMB_CLT_NACIONALIDADE');
                $cliente->IMB_CLT_LOCADOR = $request->input( 'IMB_CLT_LOCADOR');
                $cliente->IMB_CLT_LOCATARIO = $request->input( 'IMB_CLT_LOCATARIO');
                $cliente->IMB_CLT_FIADOR = $request->input( 'IMB_CLT_FIADOR');
                $cliente->IMB_CLT_RESEND = $request->input( 'IMB_CLT_RESEND');
                $cliente->IMB_CLT_RESENDNUM = $request->input( 'IMB_CLT_RESENDNUM');
                $cliente->IMB_CLT_RESENDCOM = $request->input( 'IMB_CLT_RESENDCOM');
                $cliente->IMB_CLT_RESENDCEP = $cep;
                $cliente->CEP_BAI_NOMERES = $request->input( 'CEP_BAI_NOMERES');
                $cliente->CEP_CID_NOMERES = $request->input( 'CEP_CID_NOMERES');
                $cliente->CEP_UF_SIGLARES = $request->CEP_UF_SIGLARES;
                $cliente->IMB_CLT_EMAIL = $request->input( 'IMB_CLT_EMAIL');
                $cliente->IMB_CLT_COMCOM = $request->input( 'IMB_CLT_COMCOM');
                $cliente->IMB_CLT_PROFISSAO = $request->input( 'IMB_CLT_PROFISSAO');
                $cliente->IMB_CLTCJG_NOME = $request->input( 'IMB_CLTCJG_NOME');
                $cliente->IMB_CLTCJG_CPF = $request->input( 'IMB_CLTCJG_CPF');
                $cliente->IMB_CLTCJG_RG = $request->input( 'IMB_CLTCJG_RG');
                $cliente->IMB_CLTCJG_RGORGAO = $request->input( 'IMB_CLTCJG_RGORGAO');
                $cliente->IMB_CLTCJG_RGESTADO = $request->input( 'IMB_CLTCJG_RGESTADO');
                $cliente->IMB_CLTCJG_NACIONALIDADE = $request->input( 'IMB_CLTCJG_NACIONALIDADE');
                if ( $request->input( 'IMB_CLTCJG_DATANASCIMENTO') <> '' )
                    $cliente->IMB_CLTCJG_DATANASCIMENTO =$request->input( 'IMB_CLTCJG_DATANASCIMENTO');
                $cliente->IMB_CLTCJG_SEXO = $request->input( 'IMB_CLTCJG_SEXO');
                $cliente->IMB_CLTCJG_PROFISSAO = $request->input( 'IMB_CLTCJG_PROFISSAO');
                $cliente->IMB_CLT_OBSERVACAO = $request->input( 'IMB_CLT_OBSERVACAO');
                $cliente->IMB_CLT_DTHALTERACAO = date('Y-m-d H:i:s');
                $cliente->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $cliente->IMB_CLT_ATIVO =  $request->input( 'IMB_CLT_ATIVO');
                $cliente->IMB_CLT_IMOVELGARANTIA = $request->IMB_CLT_IMOVELGARANTIA;
                $cliente->IMB_CLT_CIDADEIBGE = $request->IMB_CLT_CIDADEIBGE;
                $cliente->IMB_CLT_MEI = $request->IMB_CLT_MEI;
                $cliente->IMB_CLT_SENHA = $request->IMB_CLT_SENHA;
                $cliente->IMB_CLT_DEMONSTRATIVOSOMENTEMANUAL = $request->IMB_CLT_DEMONSTRATIVOSOMENTEMANUAL;
                

                $cliente->save();


            };


            return redirect('/cliente');
        }

        public function localizarTelefone( $fone )
        {

            $ddd=substr( $fone,0,2);
            $numero=substr( $fone,2);

            //dd( $ddd.' - '.$numero)            ;
            $cliente = mdlCliente::select(
                [
                    '*',
                    DB::raw( 'PEGAFONES( IMB_CLIENTE.IMB_CLT_ID ) as FONES '),
                    DB::raw('CorretoresCliente( IMB_CLIENTE.IMB_CLT_ID ) as CORRETOR'),
                ]
            )->where( 'IMB_TLF_NUMERO','=', $numero)
            ->where('IMB_TLF_DDD','=',$ddd)
            ->leftJoin('IMB_TELEFONES', 'IMB_TELEFONES.IMB_TLF_ID_CLIENTE',
             'IMB_CLIENTE.IMB_CLT_ID')
             ->first();
             //dd( "ddd ".$ddd." fone: ".$numero);


            if( $cliente == '') return response()->json('nada',404);
            return response()->json( $cliente,200);

        }

        public function pegarTipoCliente( $id)
        {

            $cliente = mdlCliente::select(
                [
                    DB::raw( '(SELECT COALESCE(IMB_CLA_ID,"0") FROM IMB_CLIENTEATENDIMENTO
                    WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CLIENTEATENDIMENTO.IMB_CLT_ID limit 1 ) INTERESSADO '),
                    DB::raw('( SELECT COALESCE(IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID,"0")
                    FROM IMB_PROPRIETARIOIMOVEL
                    WHERE IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID =
                    IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS LOCADOR'),
                    DB::raw('( SELECT COALESCE(IMB_LOCATARIOCONTRATO.IMB_CTR_ID,"0")
                    FROM IMB_LOCATARIOCONTRATO
                    WHERE IMB_LOCATARIOCONTRATO.IMB_CLT_ID =
                    IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS LOCATARIO'),
                    DB::raw('( SELECT COALESCE(IMB_FIADORCONTRATO.IMB_CTR_ID,"0")
                    FROM IMB_FIADORCONTRATO
                    WHERE IMB_FIADORCONTRATO.IMB_CLT_ID =
                    IMB_CLIENTE.IMB_CLT_ID LIMIT 1) AS FIADOR')
                ])
                ->where( 'IMB_CLT_ID','=', $id)
                ->first();

            return $cliente;
        }

        public function verificarTemPerfil( $id )
        {
            $perfil = mdlClientePerfil::where( "IMB_CLT_ID",'=',$id)->first();
            if ( $perfil )
                return response()->json( 'ok',200);
            else
                return response()->json( 'nada encontrado',200);
        }

        public function pegarNomeCliente($id)
        {

            $cliente = mdlCliente::find( $id );
            if( $cliente )
                return $cliente->IMB_CLT_NOME;
            else
                return "Não Encontrato(codigo$id)";

        }

        public function locatarios()
        {
            $locatarios = mdlCliente::select(
                [
                    'IMB_CLIENTE.IMB_CLT_NOME',
                    'IMB_CLIENTE.IMB_CLT_ID',
                    'IMB_CTR_SITUACAO',
                    'IMB_LOCATARIOCONTRATO.IMB_CTR_ID'
                ]
            )
            ->leftJoin( 'IMB_LOCATARIOCONTRATO','IMB_LOCATARIOCONTRATO.IMB_CLT_ID', 'IMB_CLIENTE.IMB_CLT_ID')
            ->leftJoin( 'IMB_CONTRATO','IMB_LOCATARIOCONTRATO.IMB_CTR_ID', 'IMB_CONTRATO.IMB_CTR_ID')
            ->where( 'IMB_LCTCTR_PRINCIPAL','=', 'S' )
            ->where( 'IMB_CLIENTE.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->where( 'IMB_CONTRATO.IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->orderBy( 'IMB_CLIENTE.IMB_CLT_NOME')
            ->get();

            return $locatarios;

        }

        public function locadores()
        {
            $locadores = mdlCliente::select(
                [
                    'IMB_CLIENTE.IMB_CLT_NOME',
                    'IMB_CLIENTE.IMB_CLT_ID',
                    
                DB::raw( "CASE WHEN EXISTS( SELECT IMB_CTR_ID FROM IMB_CONTRATO,  IMB_PROPRIETARIOIMOVEL 
                     WHERE IMB_CONTRATO.IMB_IMV_ID = IMB_PROPRIETARIOIMOVEL.IMB_IMV_ID 
                     AND IMB_PROPRIETARIOIMOVEL.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID ) THEN ' (tem locação)' else '' end as TEMLOCACAO")
                ]
            )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )
            ->whereRaw(' exists( SELECT IMB_CLT_ID FROM IMB_RECIBOLOCADOR WHERE IMB_RECIBOLOCADOR.IMB_CLT_ID = IMB_CLIENTE.IMB_CLT_ID)')
            ->where( 'IMB_CLT_NOME', '<>', '')
            ->orderBy( 'IMB_CLIENTE.IMB_CLT_NOME')
            ->get();

            return $locadores;

        }

        public function locatarioPrincipal( $id)
        {
            $locatario = mdlLocatarioContrato::select(
                    [
                    'IMB_LOCATARIOCONTRATO.IMB_CLT_ID',
                    'IMB_CLT_CPF',
                    'IMB_CLT_RG',
                    'IMB_CLT_NOME',
                    'IMB_CLT_EMAIL'
                    ]
            )
            ->where( 'IMB_LOCATARIOCONTRATO.IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID)
            ->where( 'IMB_CTR_ID','=',$id)
            ->where( 'IMB_LCTCTR_PRINCIPAL','=','S')
            ->leftJoin( 'IMB_CLIENTE','IMB_CLIENTE.IMB_CLT_ID','IMB_LOCATARIOCONTRATO.IMB_CLT_ID')
            ->first();




            return response()->json( $locatario,200);
        }

        public function atualizarEmailCliente( Request $request )
        {
            $id = $request->IMB_CLT_ID;
            $email = $request->email;

            $clt = mdlCliente::find( $id );
            $clt->IMB_CLT_EMAIL = $email;
            $clt->save();

            return response()->json( 'ok',200);

        }


        public function ehLocatario( $id )
        {
            $lt = mdlLocatarioContrato::where( 'IMB_CLT_ID','=', $id )->count();
            return $lt;
        }
        public function ehLocador( $id )
        {
            $ld = mdlPropImovel::where( 'IMB_CLT_ID','=', $id )->count();
            return $ld;
        }

        public function cargaEmailTelefone( Request $request)        
        {

            $clts = mdlCliente::select( 
                [
                    'IMB_CLT_NOME',
                    'IMB_CLT_EMAIL',
                    DB::raw( '( SELECT PEGAFONES( IMB_CLT_ID ) ) As TELEFONES'),
                    DB::raw( '(SELECT PEGATIPOCLIENTE( IMB_CLT_ID) )AS tipocliente')
                ]
            )
            ->whereRaw( "coalesce(IMB_CLT_EMAIL,'') <> ''  ");
            $tipo = $request->tipocliente;

            

            if( $tipo <> '' )
            {
                if( $tipo == 'P')
                    $clts->whereRaw("(SELECT PEGATIPOCLIENTE( IMB_CLT_ID) ) = 'Locador'");
                if( $tipo == 'I')
                    $clts->whereRaw("(SELECT PEGATIPOCLIENTE( IMB_CLT_ID) ) = 'Locatário'");

                if( $tipo == 'F')
                    $clts->whereRaw("(SELECT PEGATIPOCLIENTE( IMB_CLT_ID) ) = 'Fiador'");
            }
            $clts->orderBy( 'IMB_CLT_NOME');
            

            return DataTables::of($clts)->make(true);

        }

        public function relEmailTelefone()
        {
            return view( 'reports.admimoveis.relclientesemail');

        }
        
        public function show($id)
        {

            $cliente = mdlCliente::find( $id );
            return response()->json( $cliente);

        }



    }
