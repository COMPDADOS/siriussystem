<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlCondominio;
use DB;
use Auth;
class ctrCondominio extends Controller
{
    public function carga( $empresa )
    {
        $empresa = Auth::user()->IMB_IMB_ID;
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();
        
        return $condominio->toJson();

    }
    public function cargaSemJson( $empresa )
    {
        $empresa = Auth::user()->IMB_IMB_ID;
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();
        
        return $condominio;

    }


    public function index()
    {
        return view( '/condominio/condominioindex');
    }

    public function destroy( $id )
    {
        $con = mdlCondominio::find( $id );
        if( $con->IMB_CND_DTHINATIVO == '')
            $con->IMB_CND_DTHINATIVO = date( 'Y/m/d');
        else
            $con->IMB_CND_DTHINATIVO = null;
        $con->save();
        return response()->json( 'ok', 200);

    }

    public function buscar( $id )
    {
        $con = mdlCondominio::select(
            [
                '*',
                DB::raw( "(select concat( COALESCE(IMB_EEP_CONTATO1,''),' ', COALESCE(IMB_EEP_CONTATO2,''),' ',COALESCE(IMB_EEP_CONTATO3,''))from IMB_EMPRESA GAS WHERE GAS.IMB_EEP_ID = IMB_ADMCON_IDGAS) as telefonegas"),
                DB::raw( "(select  IMB_EEP_EMAIL from IMB_EMPRESA GAS WHERE GAS.IMB_EEP_ID = IMB_ADMCON_IDGAS) as emailgas"),
                DB::raw( "(select concat( COALESCE(IMB_EEP_CONTATO1,''),' ', COALESCE(IMB_EEP_CONTATO2,''),' ',COALESCE(IMB_EEP_CONTATO3,'')) from IMB_EMPRESA ADMCON WHERE ADMCON.IMB_EEP_ID = IMB_ADMCON_ID) as telefoneadmcon"),
                DB::raw( "(select  IMB_EEP_EMAIL from IMB_EMPRESA ADMCON WHERE ADMCON.IMB_EEP_ID = IMB_ADMCON_ID) as emailadmcon"),
                DB::raw( "(select concat( COALESCE(IMB_EEP_CONTATO1,''),' ', COALESCE(IMB_EEP_CONTATO2,''),' ',COALESCE(IMB_EEP_CONTATO3,'')) from IMB_EMPRESA port WHERE port.IMB_EEP_ID = IMB_ADMCON_IDPORTARIA) as telefoneempport"),
                DB::raw( "(select  IMB_EEP_EMAIL from IMB_EMPRESA EMPPOR WHERE EMPPOR.IMB_EEP_ID = IMB_ADMCON_IDPORTARIA) as emailempport")
            ]
        )->where( 'IMB_CND_ID','=', $id)->first();
        return $con;
    }

    public function salvar( Request $request )
    {
        
        if( $request->input('IMB_CND_ID') == '' )
            $con = new mdlCondominio;
        else
            $con =  mdlCondominio::find( $request->input('IMB_CND_ID') );

        $con->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $con->IMB_CND_NOME = $request->input('IMB_CND_NOME');
        if( $request->IMB_ADMCON_ID <> '' )
            $con->IMB_ADMCON_ID = $request->input('IMB_ADMCON_ID');
        
        $con->IMB_CND_VALCON = $request->IMB_CND_VALCON;
        $con->IMB_CND_ENDERECO = $request->IMB_CND_ENDERECO;
        $con->IMB_CND_ENDERECONUMERO = $request->IMB_CND_ENDERECONUMERO;
        $con->IMB_CND_ENDERECOCOMPLEMENTO = $request->IMB_CND_ENDERECOCOMPLEMENTO;
        $con->IMB_CND_CEP = $request->IMB_CND_CEP;
        $con->CEP_BAI_NOME = $request->CEP_BAI_NOME;
        $con->IMB_CND_ZELADORNOME = $request->IMB_CND_ZELADORNOME;
        $con->IMB_CND_ZELADORCELULAR = $request->IMB_CND_ZELADORCELULAR;
        $con->IMB_CND_SINDICONOME = $request->IMB_CND_SINDICONOME;
        $con->IMB_CND_SINDICOCELULAR = $request->IMB_CND_SINDICOCELULAR;
        $con->IMB_CND_HORARIOVISITA = $request->IMB_CND_HORARIOVISITA;
        $con->IMB_CND_HORARIOSERVICOS = $request->IMB_CND_HORARIOSERVICOS;
        $con->IMB_CND_OBSERVACAO = $request->IMB_CND_OBSERVACAO;
        $con->CEP_UF_SIGLA = $request->CEP_UF_SIGLA;
        $con->CEP_CID_NOME = $request->CEP_CID_NOME;
        $con->IMB_CND_TIPO = $request->IMB_CND_TIPO;
        $con->IMB_CND_VALCON = $request->IMB_CND_VALCON;
        $con->IMB_CND_VALORIPTU = $request->IMB_CND_VALORIPTU;
        $con->IMB_CND_FINALIDADE = $request->IMB_CND_FINALIDADE;
        $con->IMB_CND_FACESOL = $request->IMB_CND_FACESOL;
        $con->IMB_CND_URLSITE = $request->IMB_CND_URLSITE;
        $con->IMB_CND_EMAILADMINISTRACAO = $request->IMB_CND_EMAILADMINISTRACAO;
        $con->IMB_CND_EMAILPORTARIA = $request->IMB_CND_EMAILPORTARIA;
        $con->IMB_CND_SINDICONOME =    $request->IMB_CND_SINDICONOME;
        $con->IMB_CND_SINDICOTEL1 =    $request->IMB_CND_SINDICOTEL1;
        $con->IMB_CND_SINDICOTEL1OBS = $request->IMB_CND_SINDICOTEL1OBS;
        $con->IMB_CND_SINDICOTEL2 =    $request->IMB_CND_SINDICOTEL21;
        $con->IMB_CND_SINDICOTEL2OBS = $request->IMB_CND_SINDICOTEL2OBS;
        $con->IMB_CND_SINDICOTEL3 =    $request->IMB_CND_SINDICOTEL3;
        $con->IMB_CND_SINDICOTEL3OBS = $request->IMB_CND_SINDICOTEL3OBS;
        $con->IMB_CND_EMAILSINDICO   = $request->IMB_CND_EMAILSINDICO;
        $con->IMB_CND_ZELADORNOME =    $request->IMB_CND_ZELADORNOME;
        $con->IMB_CND_ZELADORTEL1 =    $request->IMB_CND_ZELADORTEL1;
        $con->IMB_CND_ZELADORTEL1OBS = $request->IMB_CND_ZELADORTEL1OBS;
        $con->IMB_CND_ZELADORTEL2 =    $request->IMB_CND_ZELADORTEL21;
        $con->IMB_CND_ZELADORTEL2OBS = $request->IMB_CND_ZELADORTEL2OBS;
        $con->IMB_CND_ZELADORTEL3 =    $request->IMB_CND_ZELADORTEL3;
        $con->IMB_CND_ZELADORTEL3OBS = $request->IMB_CND_ZELADORTEL3OBS;
        $con->IMB_CND_EMAILZELADOR   = $request->IMB_CND_EMAILZELADOR;
        $con->IMB_CND_PORTARIATIPO = $request->IMB_CND_PORTARIATIPO;
        $con->IMB_ADMCON_IDGAS = $request->IMB_ADMCON_IDGAS;
        $con->IMB_ADMCON_IDPORTARIA = $request->IMB_ADMCON_IDPORTARIA;
        $con->IMB_CND_GASFORMA = $request->IMB_CND_GASFORMA;
        $con->IMB_CND_AGUAFORMA = $request->IMB_CND_AGUAFORMA;
        $con->IMB_CND_SALAOFESTAS = $request->IMB_CND_SALAOFESTAS;
        $con->IMB_CND_PORTARIA24 = $request->IMB_CND_PORTARIA24;
        $con->IMB_CND_PISCINAINFANTIL = $request->IMB_CND_PISCINAINFANTIL;
        $con->IMB_CND_CHURRASQUEIRA = $request->IMB_CND_CHURRASQUEIRA;
        $con->IMB_CND_FORNOALENHA = $request->IMB_CND_FORNOALENHA;
        $con->IMB_CND_PLAYGROUND = $request->IMB_CND_PLAYGROUND;
        $con->imb_cnd_academia = $request->imb_cnd_academia;
        $con->IMB_CND_QUADRA = $request->IMB_CND_QUADRA;
        $con->imb_cnd_quadratenis = $request->imb_cnd_quadratenis;
        $con->IMB_CND_CAMPOFUTEBOL = $request->IMB_CND_CAMPOFUTEBOL;
        $con->IMB_CND_SALAOJOGOS = $request->IMB_CND_SALAOJOGOS;
        $con->IMB_CND_TRILHA = $request->IMB_CND_TRILHA;
        $con->IMB_CND_QUIOSQUE = $request->IMB_CND_QUIOSQUE;
        $con->imb_cnd_brinquedoteca = $request->imb_cnd_brinquedoteca;
        $con->IMB_CND_CERCAELETRICA = $request->IMB_CND_CERCAELETRICA;
        $con->IMB_CND_SAUNACOL = $request->IMB_CND_SAUNACOL;
        $con->IMB_CND_CIRCUITOTV = $request->IMB_CND_CIRCUITOTV;
        $con->IMB_CND_GAS = $request->IMB_CND_GAS;
        $con->IMB_CND_PISCINAADULTO = $request->IMB_CND_PISCINAADULTO;

        $con->IMB_CND_DORQUA = $request->IMB_CND_DORQUA;
        $con->IMB_CND_GARCOB = $request->IMB_CND_GARCOB;
        $con->IMB_CND_GARDES = $request->IMB_CND_GARDES;
        $con->IMB_CND_AREUTI = $request->IMB_CND_AREUTI;
        $con->IMB_CND_AREPRI = $request->IMB_CND_AREPRI;
        $con->IMB_CND_DEPOSITO = $request->IMB_CND_DEPOSITO;


        $con->save();
        return response()->json( 'ok', 200);

    }

    public function pesquisar( $texto, $empresa )
    {
        if( $texto == 'TODOS' or $texto == 'todos' )
        {
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw( '( SELect count(*) from IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID ) as qtd'),

                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME', '<>','')
            ->where('IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();            
        }
        else
        {
            $condominio = mdlCondominio::select( 
                [
                    'IMB_CND_ID',
                    'IMB_CND_NOME',
                    'IMB_CND_TIPO',
                    DB::raw( '( SELect count(*) from IMB_IMOVEIS WHERE IMB_IMOVEIS.IMB_CND_ID = IMB_CONDOMINIO.IMB_CND_ID ) as qtd'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_NOME,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_NOME'),
                    DB::raw('( SELECT  coalesce( IMB_ADMCON_FONE1,"") FROM IMB_ADMCON
                            WHERE IMB_CONDOMINIO.IMB_ADMCON_ID = 
                    IMB_ADMCON.IMB_ADMCON_ID ) AS IMB_ADMCON_FONE1'),
                    'IMB_CND_DTHINATIVO'
                ]
            )->where( 'IMB_CND_NOME','like', "%".$texto."%")
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->where('IMB_IMB_ID','=', $empresa)
            ->whereNull( 'IMB_CND_DTHINATIVO')
            ->orderBy('IMB_CND_NOME')
            ->get();
        }
        
        return $condominio;
    }

    public function tranferirImoveisCondominios( Request $request )
    {
        $origem = $request->origem;
        $destino = $request->destino;

        
        $tb = "update IMB_IMOVEIS SET IMB_CND_ID = $destino where IMB_CND_ID = $origem";        
        DB::statement("$tb");

        return response()->json( 'ok', 200 );



    }



}
