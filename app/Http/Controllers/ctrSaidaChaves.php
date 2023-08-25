<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImovel;
use App\mdlTmpImoveisSelecionados;
use App\mdlControleChaves;
use DataTables;
use Auth;
use DB;

class ctrSaidaChaves extends Controller
{
    public function index()
    {

        return view( 'chaves.chavesindex');

    }

    public function saida()
    {

        $selec = app('App\Http\Controllers\ctrAtendimento')
        ->cargaSelecionados();

        return view( 'chaves.saida', compact('selec') );
    }



    public function registrar( Request $request )
    {

        function formatarData($data){
            $rData = implode("-", array_reverse(explode("/", trim($data))));
            return $rData;
         }

        $dataprevisao =$request->IMB_CCH_DTHDEVOLUCAOESPERADA;
        
        $dataprevista = formatardata( substr( $dataprevisao,0,10) );
        $horaprevista = substr( $dataprevisao,11,5);

        $IMB_CCH_ID = $request->IMB_CCH_ID;

        $IMB_IMV_ID = $request->IMB_IMV_ID;
        $IMB_IMS_ID = $request->IMB_IMS_ID;
        $IMB_IMV_REFERENCIA = $request->IMB_IMV_REFERENCIA;
        $IMB_CCH_POSSE = $request->IMB_CCH_POSSE;
        $IMB_CCH_CODIGOCHAVE = $request->IMB_CCH_CODIGOCHAVE;
        $IMB_CCH_STATUS = $request->IMB_CCH_STATUS;
        $IMB_CLT_ID = $request->IMB_CLT_ID;
        $IMB_CCH_TIPOSOLICITANTE = $request->IMB_CCH_TIPOSOLICITANTE;
        $IMB_ATD_IDSOLICITANTE = $request->IMB_ATD_IDSOLICITANTE;
        $IMB_ATD_IDCADASTRO = Auth::user()->IMB_ATD_ID;
        $IMB_ATD_IDDEVOLUCAO = $request->IMB_ATD_IDDEVOLUCAO;
        
        $IMB_CCH_MOTIVO = $request->IMB_CCH_MOTIVO;
        $IMB_CCH_DESCRICAO = $request->IMB_CCH_DESCRICAO;
        $IMB_CCH_DTHCADASTRO = date('Y-m-d H:i:s');

        if( $IMB_CCH_ID <> '' )
            $sc = mdlControleChaves::find( $IMB_CCH_ID );
        else

        $sc = new mdlControleChaves;
        $sc->IMB_IMV_ID                     = $IMB_IMV_ID;
        $sc->IMB_IMV_REFERENCIA             = $IMB_IMV_REFERENCIA;
        $sc->IMB_CCH_POSSE                  = $IMB_CCH_POSSE;
        $sc->IMB_CCH_CODIGOCHAVE            = $IMB_CCH_CODIGOCHAVE;
        $sc->IMB_CCH_STATUS                 = $IMB_CCH_STATUS;
        $sc->IMB_CLT_ID                     = $IMB_CLT_ID;
        $sc->IMB_CCH_TIPOSOLICITANTE        = $IMB_CCH_TIPOSOLICITANTE;
        $sc->IMB_ATD_IDSOLICITANTE          = $IMB_ATD_IDSOLICITANTE;
        $sc->IMB_ATD_IDCADASTRO             = Auth::user()->IMB_ATD_ID;
        $sc->IMB_CCH_DTHDEVOLUCAOESPERADA   = $dataprevista.' '.$horaprevista;
        $sc->IMB_CCH_MOTIVO                 = $IMB_CCH_MOTIVO;
        $sc->IMB_CCH_DESCRICAO              = $IMB_CCH_DESCRICAO;
        $sc->IMB_CCH_DTHCADASTRO            = date('Y-m-d H:i:s');
        $sc->save();

        app('App\Http\Controllers\ctrImovel')
        -> gravarHistorico( $sc->IMB_IMV_ID, 
                            'Saída Chaves', 
                            'Saída Chaves','Saída Chaves', 'Data de saida: '.$sc->IMB_CCH_DTHCADASTRO  );

        $im = mdlTmpImoveisSelecionados::find( $IMB_IMS_ID  );
        $im->delete();

        return response()->json( $sc->IMB_CCH_ID,200);
    
    }

    public function list( Request $request )
    {
        $IMB_IMV_ID = $request->IMB_IMV_ID;

        $cc = mdlControleChaves::select(
            [
                'IMB_CONTROLECHAVE.IMB_CCH_ID',
                'IMB_ATD_IDSOLICITANTE',
                'IMB_ATD_IDCADASTRO',
                'IMB_ATD_IDDEVOLUCAO',
                'IMB_CONTROLECHAVE.IMB_CLT_ID',
                'IMB_CONTROLECHAVE.IMB_IMV_ID',
                'IMB_CCH_DTHSAIDA',
                'IMB_CCH_DTHDEVOLUCAOEFETIVA',
                'IMB_CCH_DTHDEVOLUCAOESPERADA',
                'IMB_CCH_SELECIONADO',
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDSELECIONADO ) AS IMB_ATD_NOMESELECIONADO'),
                DB::raw('( SELECT imovel( IMB_CONTROLECHAVE.IMB_IMV_ID ) ) AS ENDERECO'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE 
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTROLECHAVE.IMB_CLT_ID) AS IMB_CLT_NOME'),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDSOLICITANTE ) AS IMB_ATD_NOMESOLICITANTE'),
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDDEVOLUCAO ) AS IMB_ATD_NOMEDEVOLUCAO'),
                
            ]
        )
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTROLECHAVE.IMB_IMV_ID');

        if( $IMB_IMV_ID <> '' )
            $cc->where('IMB_CONTROLECHAVE.IMB_IMV_ID','=',$IMB_IMV_ID );


        return DataTables::of($cc)->make(true);
        
    
    }

    public function todosEmVisitacao( Request $request )
    {
        $IMB_IMV_ID = $request->IMB_IMV_ID;

        $cc = mdlControleChaves::select(
            [
                'IMB_CONTROLECHAVE.IMB_CCH_ID',
                'IMB_ATD_IDSOLICITANTE',
                'IMB_ATD_IDCADASTRO',
                'IMB_ATD_IDDEVOLUCAO',
                'IMB_CONTROLECHAVE.IMB_CLT_ID',
                'IMB_CONTROLECHAVE.IMB_IMV_ID',
                'IMB_CCH_DTHSAIDA',
                'IMB_CCH_DTHDEVOLUCAOEFETIVA',
                'IMB_CCH_DTHDEVOLUCAOESPERADA',
                'IMB_CCH_SELECIONADO',
                DB::raw('( SELECT imovel( IMB_CONTROLECHAVE.IMB_IMV_ID ) ) AS ENDERECO'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE 
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTROLECHAVE.IMB_CLT_ID) AS IMB_CLT_NOME'),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDSOLICITANTE ) AS IMB_ATD_NOMESOLICITANTE'),
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDDEVOLUCAO ) AS IMB_ATD_NOMEDEVOLUCAO'),
                
            ]
        )
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTROLECHAVE.IMB_IMV_ID')
        ->whereNull( 'IMB_CCH_DTHDEVOLUCAOEFETIVA');

        if( $IMB_IMV_ID <> '' )
            $cc->where('IMB_CONTROLECHAVE.IMB_IMV_ID','=',$IMB_IMV_ID );


        return DataTables::of($cc)->make(true);
        
    
    }


    public function clienteComChave( $id )
    {
        $cc = mdlControleChaves::where( 'IMB_CLT_ID','=',$id )
        ->whereNull('IMB_CCH_DTHDEVOLUCAOEFETIVA')->first();
        if( $cc )
            return $cc->IMB_CCH_ID;
        else
            return "";
    }

    public function selecionar( Request $request )
    {
        $id = $request->id;

        $cc=mdlControleChaves::find( $id );
        
        if( $cc->IMB_CCH_SELECIONADO == 'S')
        {
            if( $cc->IMB_ATD_IDSELECIONADO==Auth::user()->IMB_ATD_ID )
            {
                $cc->IMB_CCH_SELECIONADO='N';
                $cc->IMB_ATD_IDSELECIONADO=null;
            }
            else
            {
                return response()->json( "Selecionado por outro corretor!",404 );
            }

        }
        else
        {
            $cc->IMB_CCH_SELECIONADO='S';        
            $cc->IMB_ATD_IDSELECIONADO= Auth::user()->IMB_ATD_ID;        }
        
        $cc->save();

        return response()->json( '',200 );
    
    }

    public function retorno()
    {
        return view( 'chaves.retornochaves');
    }

    public function selecionadasCorretor( $id )
    {
        $cc = mdlControleChaves::select(
            [
                'IMB_CONTROLECHAVE.IMB_CCH_ID',
                'IMB_ATD_IDSOLICITANTE',
                'IMB_ATD_IDCADASTRO',
                'IMB_ATD_IDDEVOLUCAO',
                'IMB_CONTROLECHAVE.IMB_CLT_ID',
                'IMB_CONTROLECHAVE.IMB_IMV_ID',
                'IMB_CCH_DTHSAIDA',
                'IMB_CCH_DTHDEVOLUCAOEFETIVA',
                'IMB_CCH_DTHDEVOLUCAOESPERADA',
                'IMB_CCH_SELECIONADO',
                DB::raw('( SELECT imovel( IMB_CONTROLECHAVE.IMB_IMV_ID ) ) AS ENDERECO'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE 
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTROLECHAVE.IMB_CLT_ID) AS IMB_CLT_NOME'),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDSOLICITANTE ) AS IMB_ATD_NOMESOLICITANTE'),
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDDEVOLUCAO ) AS IMB_ATD_NOMEDEVOLUCAO'),
                
            ]
        )
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTROLECHAVE.IMB_IMV_ID')
        ->where('IMB_ATD_IDSELECIONADO','=', Auth::user()->IMB_ATD_ID );
        
        return DataTables::of($cc)->make(true);
    }


    public function show( $id )
    {
        $cc = mdlControleChaves::select(
            [
                'IMB_CONTROLECHAVE.IMB_CCH_ID',
                'IMB_CONTROLECHAVE.IMB_ATD_IDSOLICITANTE',
                'IMB_CONTROLECHAVE.IMB_ATD_IDCADASTRO',
                'IMB_CONTROLECHAVE.IMB_ATD_IDDEVOLUCAO',
                'IMB_CONTROLECHAVE.IMB_CLT_ID',
                'IMB_IMOVEIS.IMB_IMV_ID',
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                'IMB_CONTROLECHAVE.IMB_CCH_DTHSAIDA',
                'IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOEFETIVA',
                'IMB_CONTROLECHAVE.IMB_CCH_DTHDEVOLUCAOESPERADA',
                'IMB_CONTROLECHAVE.IMB_CCH_SELECIONADO',
                'IMB_CONTROLECHAVE.IMB_IMV_REFERENCIA',
                'IMB_CONTROLECHAVE.IMB_CCH_POSSE' ,
                'IMB_CONTROLECHAVE.IMB_CCH_CODIGOCHAVE',
                'IMB_CONTROLECHAVE.IMB_CCH_STATUS',
                'IMB_CONTROLECHAVE.IMB_CCH_TIPOSOLICITANTE',
                'IMB_CONTROLECHAVE.IMB_CCH_MOTIVO',
                'IMB_CONTROLECHAVE.IMB_CCH_DESCRICAO',
                'IMB_CONTROLECHAVE.IMB_CCH_DTHCADASTRO',
                'CEP_BAI_NOME',
                DB::raw('( SELECT IMB_CND_NOME FROM IMB_CONDOMINIO
                            WHERE IMB_CONDOMINIO.IMB_CND_ID = IMB_IMOVEIS.IMB_CND_ID) AS IMB_CND_NOME'),
                
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDSELECIONADO ) AS IMB_ATD_NOMESELECIONADO'),
                DB::raw('( SELECT imovel( IMB_CONTROLECHAVE.IMB_IMV_ID ) ) AS ENDERECO'),
                DB::raw('( SELECT IMB_CLT_NOME FROM IMB_CLIENTE 
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTROLECHAVE.IMB_CLT_ID) AS IMB_CLT_NOME'),
                DB::raw('( SELECT IMB_CLT_RG FROM IMB_CLIENTE 
                            WHERE IMB_CLIENTE.IMB_CLT_ID = IMB_CONTROLECHAVE.IMB_CLT_ID) AS IMB_CLT_RG'),
                'IMB_IMOVEIS.IMB_IMV_REFERE',
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDSOLICITANTE ) AS IMB_ATD_NOMESOLICITANTE'),
                DB::raw('( SELECT IMB_ATD_NOME FROM IMB_ATENDENTE 
                            WHERE IMB_ATENDENTE.IMB_ATD_ID  = IMB_CONTROLECHAVE.IMB_ATD_IDDEVOLUCAO ) AS IMB_ATD_NOMEDEVOLUCAO'),
                
            ]
        )
        ->leftJoin('IMB_IMOVEIS','IMB_IMOVEIS.IMB_IMV_ID','IMB_CONTROLECHAVE.IMB_IMV_ID')
        ->where('IMB_CONTROLECHAVE.IMB_CCH_ID','=',$id )
        ->first();

        return $cc;
        
    
    }

    public function confirmarRetorno( Request $request )
    {
        if( $request->IMB_CCH_ID <> '' )
        {
            $cc = mdlControleChaves::find( $request->IMB_CCH_ID );
            $cc->IMB_CCH_DEVOLUCAODATE = $request->IMB_CCH_DEVOLUCAODATE;
            $cc->IMB_CCH_DEVOLUCAOHORA = $request->IMB_CCH_DEVOLUCAOHORA;
            $cc->IMB_CCH_OPINIAO = $request->IMB_CCH_OPINIAO;
            $cc->IMB_CCH_EXPECTATIVA = $request->IMB_CCH_EXPECTATIVA;
            $cc->IMB_CCH_OBSERVACAORETORNO = $request->IMB_CCH_OBSERVACAORETORNO;
            $cc->IMB_ATD_IDDEVOLUCAO = Auth::user()->IMB_ATD_ID;
            $cc->IMB_CCH_DTHDEVOLUCAOEFETIVA = $request->IMB_CCH_DEVOLUCAODATE.' '.
                                                $request->IMB_CCH_DEVOLUCAOHORA;
            $cc->IMB_CCH_SELECIONADO ='N';
            $cc->IMB_ATD_IDSELECIONADO = null;
            $cc->IMB_CCH_RESERVARDATALIMITE = $request->IMB_CCH_RESERVARDATALIMITE;
            $cc->IMB_CCH_RESERVAR = $request->IMB_CCH_RESERVAR;
            $cc->save();
            app('App\Http\Controllers\ctrImovel')
            -> gravarHistorico( $cc->IMB_IMV_ID, 
                                'Saída Chaves', 
                                'Retorno Chaves','Retorno Chaves', 'Data de retorno: '.$cc->IMB_CCH_DTHDEVOLUCAOEFETIVA  );
            
            if( $request->IMB_CCH_RESERVAR == 'S' ) 
            {
                $im = mdlImovel::find($cc->IMB_IMV_ID);
                $im->IMB_CCH_RESERVAR = 'S';
                $im->IMB_CCH_RESERVARDATALIMITE = $request->IMB_CCH_RESERVARDATALIMITE;                
                $im->IMB_CCH_ID = $cc->IMB_CCH_ID;
                $im->save();
            }

            return response()->json( 'ok',200);
        }

    }




}