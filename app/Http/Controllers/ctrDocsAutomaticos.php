<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlDocsAutomaticos;
use App\mdlCamposMesclagem;
use App\mdlImovel;
use App\mdlPropImovel;
use App\mdlEmpresa;
use App\mdlCliente;
use App\mdlContrato;
use App\mdlContaCaixa;
use App\mdlApDoc;
use App\mdlDocumentoGerado;
use App\mdlLocatarioContrato;
use App\mdlFiadorContrato;
use App\mdlContratoHistoricoReajuste;
use App\mdlEnderecoCobranca;
use App\mdlAvisoDesocupacao;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use App\mdlCobrancaRealizada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use PDF;
use Illuminate\Support\Facades\URL;
use App\mdlIndiceReajuste;
use App\mdlContratoSeguroIncendio;

use Auth;
use DB;
use Log;

class ctrDocsAutomaticos extends Controller
{
    public $idavisodesocupacao = 0;
    public $idcontasapagar = 0;

    public function carga()
    {
        $dca = mdlDocsAutomaticos::
                whereNull( 'GER_DTA_DTHINATIVO')
                ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
        return $dca;

    }

    public function index()
    {
        return view( 'docsautomaticos.docsautomaticosindex');
    }


    public function visualizar( $id )
    {
        $dca = mdlDocsAutomaticos::find( $id );
        return view( 'docsautomaticos.docautomaticovisualizar', compact('dca'));
    }

    public function novo()
    {
        $dca = new mdlDocsAutomaticos;
        $dca->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $dca->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $dca->GER_DTA_DTHATIVO = date( 'Y/m/d');
        $dca->GER_DCA_NOME = 'Novo documento';
        $dca->save();
        return view( 'docsautomaticos.docautomaticovisualizar', compact('dca'));
    }

    public function desativar( $id )
    {
        $dca = mdlDocsAutomaticos::find( $id );
        $dca->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $dca->IMB_ATD_IDINATIVO = Auth::user()->IMB_ATD_ID;
        $dca->GER_DTA_DTHINATIVO = date( 'Y/m/d H:m');
        $dca->save();
        return response()->json( 'ok',200);
    }

    public function buscar( $id )
    {
        $dca = mdlDocsAutomaticos::find( $id );
        return response()->json($dca,200);
    }

    public function salvar( Request $request)
    {
        $GER_DCA_ID = $request->GER_DCA_ID;
        $GER_DCA_NOME = $request->GER_DCA_NOME;
        $GER_DCA_TEXTO = $request->GER_DCA_TEXTO;
        $GER_DCA_TIPO = $request->GER_DCA_TIPO;
        $GER_DCA_UPLOAD = $request->GER_DCA_UPLOAD;
        $GER_DCA_DOWNLOAD = $request->GER_DCA_DOWNLOAD;
        $GER_DCA_WORD = $request->GER_DCA_WORD;

        if( $GER_DCA_ID )
            $dca = mdlDocsAutomaticos::find( $GER_DCA_ID );
        else
            $dca = new mdlDocsAutomaticos;

        $dca->GER_DCA_NOME = $GER_DCA_NOME;
        $dca->GER_DCA_TEXTO = $GER_DCA_TEXTO;
        $dca->GER_DCA_TIPO = $GER_DCA_TIPO;
        $dca->GER_DCA_UPLOAD = $GER_DCA_UPLOAD;
        $dca->GER_DCA_DOWNLOAD = $GER_DCA_DOWNLOAD;
        $dca->GER_DCA_WORD = $GER_DCA_WORD;

        $dca->save();

        return response()->json('Gravado!',200);

    }

    public function cargaCamposMesclagem()
    {
        $cmms= mdlCamposMesclagem::orderBy('GER_CMM_NOMECAMPO')->get();
        return response()->json($cmms,200);
    }

    public function mesclarCampo( $texto, $idimovel, $idcontrato )
    {
        $imv = mdlImovel::find( $idimovel );
        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=',$idimovel )
        ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();

        //Log::info( $texto);
        $cont = 0;
        foreach( $ppi as $pp)
        {
            //Log:info( "LOCADOR PP-IMB_CLT_ID $pp->IMB_CLT_ID - IMVEL_: $idimovel");
            $cont = $cont + 1;
            $trocar = "<<NOMELOCADOR_1>>";
            $texto = str_replace( $trocar,
                $this->pegarNomeCliente($pp->IMB_CLT_ID ), $texto);

        }

        return $texto;
    }

    public function pegarNomeCliente( $id )
    {
        $cl = mdlCliente::find( $id );

        if( $cl ) 
            return $cl->IMB_CLT_NOME;
        else
            '';
    }

    public function descritivoCliente($id )
    {
        $cl = mdlCliente::find( $id );
        if( $cl )
        {

            if( $cl->IMB_CLT_PESSOA =='J' )
                $texto = trim( $cl->IMB_CLT_NOME).', CNPJ '.
                            app('App\Http\Controllers\ctrRotinas')
                            ->formatCnpjCpf($cl->IMB_CLT_CPF).
                            ', Incrição Estadual '.
                                ', com sede '.
                                trim( $cl->IMB_CLT_RESENDTIPO).' '.
                                trim( $cl->IMB_CLT_RESEND).' '.
                                trim( $cl->IMB_CLT_RESENDNUM).' '.
                                trim( $cl->IMB_CLT_RESENDCOM).', '.
                                trim( $cl->CEP_BAI_NOMERES).' na cidade de '.
                                trim( $cl->CEP_CID_NOMERES).'/'.
                                trim( $cl->CEP_UF_SIGLARES);
            else
            {
                $texto = trim( $cl->IMB_CLT_NOME).', de nacionalidade '.$cl->IMB_CLT_NACIONALIDADE.
                        $this->estadoCivil($cl->IMB_CLT_ESTADOCIVIL, $cl->IMB_CLT_SEXO).', '.
                        $cl->IMB_CLT_PROFISSAO.', CPF(MF) '.
                            app('App\Http\Controllers\ctrRotinas')
                            ->formatCnpjCpf($cl->IMB_CLT_CPF).', RG '.
                        $cl->IMB_CLT_RG.'(SSP-)'.$cl->IMB_CLT_RGORGAO.', residente e domiciliado a '.
                        trim( $cl->IMB_CLT_RESENDTIPO).' '.
                        trim( $cl->IMB_CLT_RESEND).' '.
                        trim( $cl->IMB_CLT_RESENDNUM).' '.
                        trim( $cl->IMB_CLT_RESENDCOM).' '.
                        trim( $cl->CEP_BAI_NOMERES).' na cidade de '.
                        trim( $cl->CEP_CID_NOMERES).'/'.
                        trim( $cl->CEP_UF_SIGLARES);
                if( $cl->IMB_CLT_ESTADOCIVIL == 'C')
                {
                    $texto = $texto . ', '.$this->estadoCivil( $cl->IMB_CLT_ESTADOCIVIL, $cl->IMB_CLT_SEXO).
                    ' com '.
                    trim( $cl->IMB_CLTCJG_NOME).', '.
                    trim( $cl->IMB_CLTCJG_NACIONALIDADE).', '.
                    trim( $cl->IMB_CLTCJG_PROFISSAO).', CPF '.
                    app('App\Http\Controllers\ctrRotinas')
                    ->formatCnpjCpf(trim( $cl->IMB_CLTCJG_CPF)).', e RG '.
                    trim( $cl->IMB_CLTCJG_RG).'/'.$cl->IMB_CLTCJG_RGESTADO;


                }
            }
        }
        else
                $texto = 'Cliente não encontrado';
        return $texto;
    }

    public function gerarDocAutomatico( $iddoc, $idcliente, $idcontrato, $idimovel,$naogerar)
    {
        $dca = mdlDocsAutomaticos::find( $iddoc );

        $histrea = mdlContratoHistoricoReajuste::where( 'IMB_CTR_ID','=', $idcontrato )
        ->orderBy(  'IMB_CHR_ID','DESC' )
        ->limit(1)
        ->first();
        $nidavd = $this->idavisodesocupacao;

        if( $nidavd <> 0 )
        {
            $avd = mdlAvisoDesocupacao::find( $nidavd);
        }

        if( $idcliente <> 0 )
            $clt = mdlCliente::find( $idcliente );

        if( $idcontrato <> 0 )
            $ctr = mdlContrato::find( $idcontrato );


        if( $idimovel <> 0 )
            $imv = mdlImovel::find( $idimovel );
        else
        if( $ctr)
            $imv = mdlImovel::find( $ctr->IMB_IMV_ID );

        $idimovel = 0;
        if( $ctr <> '' ) $idimovel = $ctr->IMB_IMV_ID;
        if( $imv <> '' ) $idimovel = $imv->IMB_IMV_ID;

        $texto = $dca->GER_DCA_TEXTO;

        if( $nidavd <> 0 )
        {
            $texto = str_replace( "**DATAPREVISAODESOCUPACAO**", $this->formatarData( $avd->IMB_AVD_DATAPREVISAO), $texto);
            $texto = str_replace( "**MOTIVODESOCUPACAO**", $avd->IMB_AVD_RELATO, $texto);
            $texto = str_replace( "**DESOCUPACAONOME**", $avd->IMB_AVD_NOME, $texto);
            $texto = str_replace( "**DESOCUPACAOCPF**", $avd->IMB_AVD_CPF, $texto);
            $texto = str_replace( "**DESOCUPACAORG**", $avd->IMB_AVD_RG, $texto);
        }
        $imovelgarantia='';

        if( $idimovel<>0 )
        {
            $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=',$idimovel )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
            $cont = 0;
            foreach( $ppi as $pp)
            {
                //Log:info( "LOCADOR PP-IMB_CLT_ID $pp->IMB_CLT_ID IMOVEL $idimovel");
                $cont = $cont + 1;
                $trocar = "**NOMELOCADOR_$cont**";
                $texto = str_replace( $trocar,
                 $this->pegarNomeCliente($pp->IMB_CLT_ID ), $texto);

                $maisum='';
                if( $cont > 1 ) $maisum = ', e ';
                    $trocar = "**LOCADORDESCRITIVO_$cont**";
                $texto = str_replace( $trocar,
                $maisum.$this->descritivoCliente($pp->IMB_CLT_ID ), $texto);
            };

            $texto = $this->limparNaoUsados( '**LOCADORDESCRITIVO_', $texto);
            $texto = $this->limparNaoUsados( '**NOMELOCADOR_', $texto);

            if( $histrea <> '')
            {
                $indice = mdlIndiceReajuste::find( $histrea->IMB_IRJ_ID);

                $mesanoreajuste = app('App\Http\Controllers\ctrRotinas')->mesExtenso( $histrea->IMB_CHR_DATAREAJUSTE);
                $texto = str_replace( "**MESANOREAJUSTE**", $mesanoreajuste, $texto);

                $indicereajuste = $indice->IMB_IRJ_NOME;
                $texto = str_replace( "**INDICEREAJUSTE**", $indicereajuste, $texto);

            }
            $enderecimovel = app('App\Http\Controllers\ctrRotinas')
            ->imovelEndereco( $idimovel );
            $texto = str_replace( "**ENDERECOIMOVEL_1**",  $enderecimovel, $texto );
          

            $texto = str_replace( "**PROXVENCIMENTOLOCATARIO_1**",
                    $this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO ), $texto);

                    $texto = str_replace( "**TIPOCONTRATO**",  $ctr->IMB_CTR_FINALIDADE, $texto );
                                        
            $texto = str_replace( "**BAIRROIMOVEL_1**", $imv->CEP_BAI_NOME, $texto);
            $texto = str_replace( "**CIDADEIMOVEL_1**", $imv->IMB_IMV_CIDADE, $texto);
            $texto = str_replace( "**UFDOIMOVEL_1**", '('.$imv->IMB_IMV_ESTADO.')', $texto);
            $texto = str_replace( "**CEPIMOVEL_1**",$imv->IMB_IMV_ENDERECOCEP, $texto);
            $texto = str_replace( "**DURACAOCONTRATO_1**",$ctr->IMB_CTR_DURACAO, $texto);
            $texto = str_replace( "**DURACAOCONTRATOEXTENSO_1**",
            app('App\Http\Controllers\ctrRotinas')
                        ->numeroextenso( intval($ctr->IMB_CTR_DURACAO) ), $texto);
            $texto = str_replace( "**INICIOCONTRATO_1**",
                    $this->formatarData( $ctr->IMB_CTR_INICIO ), $texto);
            $texto = str_replace( "**TERMINOCONTRATO_1**",
                    $this->formatarData( $ctr->IMB_CTR_TERMINO ), $texto);

            $texto = str_replace( "**TERMINOCONTRATOEXTENSO_1**",
            app('App\Http\Controllers\ctrRotinas')
            ->dataExtenso( $ctr->IMB_CTR_TERMINO ), $texto);


            $texto = str_replace( "**INICIOCONTRATOEXTENSO_1**",
                    app('App\Http\Controllers\ctrRotinas')
                    ->dataExtenso( $ctr->IMB_CTR_INICIO), $texto);

            $texto = str_replace( "**VALORALUGUEL_1**",
                    app('App\Http\Controllers\ctrRotinas')
                    ->formatarReal(  $ctr->IMB_CTR_VALORALUGUEL ), $texto);

            $texto = str_replace( "**VALORALUGUELEXTENSO_1**",
                    app('App\Http\Controllers\ctrRotinas')
                    ->valorExtenso(  $ctr->IMB_CTR_VALORALUGUEL ), $texto);


            $texto = str_replace( "**DIAVENCIMENTO_1**",
                    str_pad( $ctr->IMB_CTR_DIAVENCIMENTO,2,'0' ), $texto);

            $texto = str_replace( "**DIAVENCIMENTOEXTENSO_1**",
                    app('App\Http\Controllers\ctrRotinas')
                    ->numeroextenso(  $ctr->IMB_CTR_DIAVENCIMENTO ), $texto);

                    $texto = str_replace( "**INDICEREAJUSTE_1**",
                    app('App\Http\Controllers\ctrRotinas')
                    ->buscarIndiceReajuste(  $ctr->IMB_IRJ_ID ), $texto);




        }

        if( $idcontrato <> 0 )
        {

            $lctctr = mdlLocatarioContrato::where( 'IMB_CTR_ID','=', $idcontrato )->get();

            $cont = 0;
            $locatarioprincipal='';
            foreach( $lctctr as $lt)
            {
                $cont = $cont + 1;
                

                $cliente = mdlCliente::find( $lt->IMB_CLT_ID);
               // dd( $cliente );

                if( $lt->IMB_LCTCTR_PRINCIPAL == 'S' )
                {

                   $locatarioprincipal = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                   
                   $trocar = "**NOMELOCATARIOPRINCIPAL**";                   
                   $texto = $texto = str_replace( $trocar,
                            $cliente->IMB_CLT_NOME, $texto );
                    
                    $trocar = "**ENDERECOLOCATARIOPRINCIPAL**";                   
                    $texto = $texto = str_replace( $trocar,
                            $cliente->IMB_CLT_RESEND.', '.$lt->IMB_CLT_RESENDNUM, $texto);
                    
                    $trocar = "**CPFLOCATARIOPRINCIPAL**";                   
                    $texto = $texto = str_replace( $trocar,
                            $cliente->IMB_CLT_CPF, $texto);
         
                                     
                             
                }
         
   
                $maisum='';
                if( $cont > 1 ) $maisum = ', e ';

                $trocar = "**NOMELOCATARIO_$cont**";
                $texto = str_replace( $trocar,
                 $this->pegarNomeCliente($lt->IMB_CLT_ID ), $texto);
                $trocar = "**LOCATARIODESCRITIVO_$cont**";
                $texto = str_replace( $trocar,
                $maisum.$this->descritivoCliente($lt->IMB_CLT_ID ), $texto);
                

            }
            $texto = $this->limparNaoUsados( '**LOCATARIODESCRITIVO_', $texto);
            $texto = $this->limparNaoUsados( '**NOMELOCATARIO_', $texto);

            $lctctr = mdlFiadorContrato::where( 'IMB_CTR_ID','=', $idcontrato )->get();

            $cont = 0;
            $fiadorprincipal='';
            foreach( $lctctr as $lt)
            {
                Log::info( "fiador ".$lt->IMB_CLT_ID );
                $cliente = mdlCliente::find( $lt->IMB_CLT_ID );
                Log::info( 'nome: '.$cliente->IMB_CLT_NOME );

                $cont = $cont + 1;

                $maisum='';
                if( $cont > 1 ) $maisum = ', e ';

                $trocar = "**ENDERECOFIADOR_$cont**";
                $texto = str_replace( $trocar, $cliente->IMB_CLT_RESEND.', '.$cliente->IMB_CLT_RESENDNUM.' '.$cliente->IMB_CLT_RESENDCOM.' - CEP: '.$cliente->IMB_CLT_RESENDCEP.' - '.$cliente->CEP_CID_NOME.'('.$cliente->CEP_UF_SIGLA.')', $texto);

                $trocar = "**CPFFIADOR_$cont**";
                $texto = str_replace( $trocar, $cliente->IMB_CLT_CPF, $texto);

                $trocar = "**NOMEFIADOR_$cont**";
                $texto = str_replace( $trocar,$cliente->IMB_CLT_NOME , $texto);


                $trocar = "**FIADORDESCRITIVO_$cont**";
                $texto = str_replace( $trocar,
                $maisum.$this->descritivoCliente($lt->IMB_CLT_ID ), $texto);

                $imovelgarantia ='';
                $fd = mdlCliente::find( $lt->IMB_CLT_ID);
                if( $fd )
                $imovelgarantia = $imovelgarantia.$fd->IMB_CLT_IMOVELGARANTIA.' ';

            }


            $texto = str_replace( "**IMOVEL_GARANTIA**", $imovelgarantia, $texto);
            $texto = $this->limparNaoUsados( '**FIADORDESCRITIVO_', $texto);
            $texto = $this->limparNaoUsados( '**NOMEFIADOR_', $texto);

            //pgando informacoes do ultimo reajuste
            if( $histrea )
            {
                $texto = str_replace( "**INDICE_REAJUSTE_PERCENTUAL**", number_format($histrea->IMB_CHR_FATOR,2,',','.').'%', $texto);
                $texto = str_replace( "**DATA_ULTIMO_REAJUSTE**", $this->formatarData( $histrea->IMB_CHR_DATAREAJUSTE), $texto);

            }

            //endereco cobranca
            $ec = mdlEnderecoCobranca::find( $idcontrato);
            if( $ec <>  '' )
            {
                $texto = str_replace( "**IMB_CTG_DESTINATARIO**", 
                        $ec->IMB_CCB_DESTINATARIO, $texto);

                $texto = str_replace( "**IMB_CTG_COBRANCAENDERECO**", 
                        $ec->IMB_CCB_ENDERECO.' '. 
                        $ec->IMB_CCB_ENDERECONUMERO.' '.
                        $ec->IMB_CCB_ENDERECOCOMPLEMENTO, $texto);
                $texto = str_replace( "**IMB_CTG_COBRANCABAIRRO**", 
                        $ec->IMB_CCB_BAIRRO, $texto);
                $texto = str_replace( "**IMB_CTG_COBRANCACEP**", 
                        $ec->IMB_CCB_CEP, $texto);

                $texto = str_replace( "**IMB_CTG_COBRANCACIDADE**", 
                        $ec->CEP_CID_NOME, $texto);
                $texto = str_replace( "**IMB_CTG_COBRANCAUF**", 
                        $ec->CEP_UF_SIGLA, $texto);



            }
            else
            {
                if( $idimovel <> 0 )
                {
                    $texto = str_replace( "**IMB_CTG_COBRANCAENDERECO**",
                    app('App\Http\Controllers\ctrRotinas')
                        ->imovelEndereco( $idimovel ), $texto);
                    $texto = str_replace( "**IMB_CTG_DESTINATARIO**", 
                        $locatarioprincipal, $texto);
            
                    $texto = str_replace( "**IMB_CTG_COBRANCABAIRRO**", 
                        $imv->CEP_BAI_NOME, $texto);
                    
                    $texto = str_replace( "**IMB_CTG_COBRANCACEP**", 
                        $imv->IMB_IMV_ENDERECOCEP, $texto);

                    $texto = str_replace( "**IMB_CTG_COBRANCACIDADE**", 
                        $imv->IMB_IMV_CIDADE, $texto);
                    $texto = str_replace( "**IMB_CTG_COBRANCAUF**", 
                        $imv->IMB_IMV_ESTADO, $texto);
                }
            }

            $texto = str_replace( "**DATAATUAL**", 
            date('d/m/Y'), $texto);

            
            


        }

        if( $naogerar == 'S') return $texto;
        
        $dg = new mdlDocumentoGerado;
        $dg->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $dg->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
        $dg->IMB_IMV_ID = $idimovel;
        $dg->IMB_CLT_ID = $idcliente;
        $dg->IMB_CTR_ID = $idcontrato;
        $dg->IMB_DCG_DTHATIVO = date( 'Y/m/d H:i:s');
        $dg->IMB_CGR_TITULO=   $dca->GER_DCA_NOME;
        $dg->IMB_CGR_CONTEUDO=   $texto;
        $dg->save();
        return response()->json($dg->IMB_DCG_ID,200);
    }

    public function criarRegistroNovoCampo( $grupo, $campo, $qtd, $titulo)
    {

        for ($x = 1; $x <= $qtd; $x++)
        {

            $cmm = new mdlCamposMesclagem;
            $cmm->GER_CMM_NOME = '**'.$campo.'_'.$x.'**';
            $cmm->GER_CMM_CONTEUDO = '';
            $cmm->GER_CMM_DESCRICAO = $titulo.' '.$x;
            $cmm->GER_CMM_NOMECAMPO = '**'.$campo.'_'.$x.'**';
            $cmm->save();
        }

    }

    public function estadoCivil( $estado, $sexo )
    {
        if( $sexo == 'M')
        {
            if( $estado == 'S') $estado = 'Solteiro';
            if( $estado == 'C') $estado = 'Casado';
            if( $estado == 'U') $estado = 'em União Estável';
            if( $estado == 'I') $estado = 'Divorciado';
            if( $estado == 'V') $estado = 'Viúvo';
        };
        if( $sexo == 'F')
        {
            if( $estado == 'S') $estado = 'Solteira';
            if( $estado == 'C') $estado = 'Casada';
            if( $estado == 'U') $estado = 'em União Estável';
            if( $estado == 'I') $estado = 'Divorciada';
            if( $estado == 'V') $estado = 'Viúva';
        };

    }

    public function limparNaoUsados( $campo, $texto )
    {
        for ($x = 1; $x <= 10; $x++)
        {
            $trocar = $campo.$x.'**';
            $texto = str_replace( $trocar,
                '', $texto);
        }
        return $texto;
    }

    public function documentoMesclado( $iddoc)
    {
        $dg = mdlDocumentoGerado::find( $iddoc );
        $titulo = $dg->IMB_CGR_TITULO;
        return view( 'docsautomaticos.docautomaticovisualizarmesclado', compact( 'iddoc', 'titulo') );
    }

    public function buscarDocumentoMesclado( $iddoc)
    {
        $dg = mdlDocumentoGerado::find( $iddoc );

        return response()->json($dg->IMB_CGR_CONTEUDO,200);

    }


    public function documentosGerados( Request $request)
    {
        $idimovel = $request->idimovel;
        $idcliente = $request->idcliente;
        $idcontrato = $request->idcontrato;

        $dg = mdlDocumentoGerado::select(
            [
                'IMB_DOCUMENTOSGERADOS.IMB_IMV_ID',
                'IMB_DOCUMENTOSGERADOS.IMB_CLT_ID',
                'IMB_DOCUMENTOSGERADOS.IMB_CTR_ID',
                'IMB_ATD_NOME',
                'IMB_DCG_ID',
                'IMB_DCG_DTHATIVO',
                'IMB_DCG_DTHINATIVO',
                'IMB_CGR_TITULO'
            ]
        )->leftJoin( 'IMB_ATENDENTE','IMB_ATENDENTE.IMB_ATD_ID',
                    'IMB_DOCUMENTOSGERADOS.IMB_ATD_ID');
        if( $idimovel> 0)
        $dg = $dg->where( 'IMB_DOCUMENTOSGERADOS.IMB_IMV_ID','=', $idimovel );

        if( $idcliente > 0)
           $dg = $dg->where( 'IMB_DOCUMENTOSGERADOS.IMB_CLT_ID','=', $idcliente );

        if( $idcontrato > 0 )
           $dg = $dg->where( 'IMB_DOCUMENTOSGERADOS.IMB_CTR_ID','=', $idcontrato );

        $dg = $dg->orderBy( 'IMB_DCG_DTHATIVO')->get();

        return response()->json( $dg,200);


    }

    public function salvarMesclado( Request $request )
    {

        $id = $request->GER_DCG_ID;
        $GER_DCA_NOME = $request->GER_DCA_NOME;
        $texto = $request->GER_DCA_TEXTO;

        $dg = mdlDocumentoGerado::find( $id );
        if( $dg )
        {
            $dg->IMB_CGR_TITULO=   $GER_DCA_NOME;
            $dg->IMB_CGR_CONTEUDO=   $texto;
            $dg->save();
        }
        return response()->json($dg->IMB_DCG_ID,200);
    }

    public function formatarData($data)
    {
       if( strpos( $data,'/' )  <> '' )
          $rData = implode("/", array_reverse(explode("/", trim($data))));
       else
          $rData = implode("/", array_reverse(explode("-", trim($data))));

       return $rData;
    }

    public function emailCobrancaLocatario( $idLocatario, $idContrato )
    {
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','emailcobrancalocatar')->first();

        if( $doc )
        {
            $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $idContrato, 0,'S');
            
            $ctr = mdlContrato::find( $idContrato);
            $lt = mdlCliente::find($idLocatario);
            $email = $lt->IMB_CLT_EMAIL;
            //$email = 'suporte@compdados.com.br';
            $array = explode(";",$email);
            foreach( $array as $a )
            {
                $a=str_replace( ';','',$a);

                if( $a <> '' )
                {

                    $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                    $a = trim( $a );
                    Log::info( "atrasado: ".$a );

                    $html = view('mail.avisoslocatario',compact('texto'));
                    Mail::send('mail.avisoslocatario', compact('texto'),
                    function( $message ) use ($a,$idContrato, $html)
                    {
                        $pdf=PDF::loadHtml( $html,'UTF-8');
                                    //$message->attachData($pdf->output(), $nossonumero_email.'.pdf');
                        $message->to( $a  );
                        $message->subject('Aviso de Aluguel Vencido');
                    });

                    $cbr = new mdlCobrancaRealizada;
                    $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $cbr->IMB_CTR_ID = $idContrato;;
                    $cbr->IMB_CBR_DATA = date('Y/m/d');
                    $cbr->IMB_CBR_HORA = date('H:i');
                    $cbr->IMB_CBR_OBSERVACAO = 'Email de cobrança enviado ao locatário - email: '.$a;
                    $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
                    $cbr->save();
              
        
                    app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( 0, $idContrato,0,0,0,'Aviso de Aluguel Vencido enviado para  '.$a);
                }
            }
            return response()->json('ok',200);
        }
        else
            return response()->json('naoencontrado',404);

        

    }

    public function emailCobrancaFiador( $idFiador, $idContrato )
    {
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','emailcobrancafiador')->first();

        $ctr = mdlContrato::find( $idContrato );

        if( $doc )
        {
            $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $idContrato, 0,'S');
            
            $lt = mdlCliente::find($idFiador);
            $email = $lt->IMB_CLT_EMAIL;
            //$email = 'suporte@compdados.com.br';
            $array = explode(";",$email);
            foreach( $array as $a )
            {
                $a=str_replace( ';','',$a);

                if( $a <> '' )
                {

                    $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                    $a = trim( $a );
                    Log::info( "atrasado: ".$a );

                    $html = view('mail.avisoslocatario',compact('texto'));
                    Mail::send('mail.avisoslocatario', compact('texto'),
                    function( $message ) use ($a,$idContrato, $html)
                    {
                        $pdf=PDF::loadHtml( $html,'UTF-8');
                                    //$message->attachData($pdf->output(), $nossonumero_email.'.pdf');
                        $message->to( $a  );
                        $message->subject('Aviso de Aluguel Vencido');
                    });
                    $cbr = new mdlCobrancaRealizada;
                    $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                    $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                    $cbr->IMB_CTR_ID = $idContrato;;
                    $cbr->IMB_CBR_DATA = date('Y/m/d');
                    $cbr->IMB_CBR_HORA = date('H:i');
                    $cbr->IMB_CBR_OBSERVACAO = 'Email de cobrança enviado ao fiador - email: '.$a;
                    $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
                    $cbr->save();

                    app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( 0, $idContrato,0,0,0,'Aviso de Aluguel Vencido enviado para Fiador '.$a);
                }
            }
            return response()->json('ok',200);
        }
        else
            return response()->json('naoencontrado',404);

        

    }

    public function emailAvisoReajusteLocatario( $idLocatario, $idContrato )
    {
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','emailreajustelocatar')->first();
        if( $doc )
        {
            $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $idContrato, 0,'S');
            
            $lt = mdlCliente::find($idLocatario);
            $email = $lt->IMB_CLT_EMAIL;
            $array = explode(";",$email);
            foreach( $array as $a )
            {
                $a=str_replace( ';','',$a);

                if( $a <> '' )
                {
                    $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                    Log::info('Enviando para '.$a );

                    $html = view('mail.avisoslocatario',compact('texto'));
                    Mail::send('mail.avisoslocatario', compact('texto'),
                    function( $message ) use ($a,$idContrato, $html)
                    {
                        $pdf=PDF::loadHtml( $html,'UTF-8');
                                    //$message->attachData($pdf->output(), $nossonumero_email.'.pdf');
                        $message->to( $a  );
                        $message->bcc( env('APP_MAILBOLETOCOPIA')  );
                        $message->subject('Aviso de Reajuste de Aluguém');
                    });
                    app('App\Http\Controllers\ctrRotinas')
                        ->gravarObs( 0, $idContrato,0,0,0,'Aviso de Reajuste de aluguel '.$a);
                }
            }
            return response()->json('ok',200);
        }
        else
            return response()->json('naoencontrado',404);

        

    }

    public function cartaCobrancaLocatario( $idLocatario, $idContrato )
    {
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','cartacobrancalocatar')->first();



        if( $doc )
        {
            Log::info( 'encontrou ');
            $ctr = mdlContrato::find( $idContrato );
            if( $doc->GER_DCA_WORD == 'S' )
            {
                $request = new Request;
                $request->entrada = $doc->GER_DCA_UPLOAD;
                $request->saida = $doc->GER_DCA_DOWNLOAD;
                $request->idcontrato = $idContrato;
                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( 0, $idContrato, 0, 0,0 ,
                'Carta de Cobrança enviado ao LOCATARIO de aluguel vencido desde '.$this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO));
                $cbr = new mdlCobrancaRealizada;
                $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $cbr->IMB_CTR_ID = $idContrato;;
                $cbr->IMB_CBR_DATA = date('Y/m/d');
                $cbr->IMB_CBR_HORA = date('H:i');
                $cbr->IMB_CBR_OBSERVACAO = 'Carta de Cobranca Enviada ao locatário';
                $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
                $cbr->save();
          
        
                return $this->gerarWord( $request );
                
            }
            else
            {
                Log::info('carta cobnranca normal');
                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( 0, $idContrato, 0, 0,0 ,
                'Carta de Cobrança enviado ao LOCATARIO de aluguel vencido desde '.$this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO));
                $cbr = new mdlCobrancaRealizada;
                $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $cbr->IMB_CTR_ID = $idContrato;;
                $cbr->IMB_CBR_DATA = date('Y/m/d');
                $cbr->IMB_CBR_HORA = date('H:i');
                $cbr->IMB_CBR_OBSERVACAO = 'Carta de Cobranca Enviada ao locatário';
                $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
                $cbr->save();
          
        
                $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $idContrato, 0,'S');
                Log::info($texto);

                return view('mail.avisosfiador',compact('texto'));
            }



        }


                

        

    }

    public function cartaCobrancaFiador( $idFiador, $idContrato )
    {
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','cartacobrancafiador')->first();


        if( $doc )
        {
            $ctr = mdlContrato::find( $idContrato );
            Log::info('id contrato '.$idContrato );
            Log::info('CTRR_id contrato '.$ctr->IMB_CTR_ID);


            if( $doc->GER_DCA_WORD == 'S' )
            {
                
                $request = new Request;
                $request->entrada = $doc->GER_DCA_UPLOAD;
                $request->saida = $doc->GER_DCA_DOWNLOAD;
                $request->idcontrato = $idContrato;
                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( 0, $idContrato, 0, 0,0 ,
                'Carta de Cobrança enviado ao LOCATARIO de aluguel vencido desde '.$this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO));
                $cbr = new mdlCobrancaRealizada;
                $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $cbr->IMB_CTR_ID = $idContrato;;
                $cbr->IMB_CBR_DATA = date('Y/m/d');
                $cbr->IMB_CBR_HORA = date('H:i');
                $cbr->IMB_CBR_OBSERVACAO = 'Carta de Cobranca Enviada ao Fiador';
                $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
                $cbr->save();
        
                return $this->gerarWord( $request );
                
            }
            else
            {
                $cbr = new mdlCobrancaRealizada;
                $cbr->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
                $cbr->IMB_ATD_ID = Auth::user()->IMB_ATD_ID;
                $cbr->IMB_CTR_ID = $idContrato;;
                $cbr->IMB_CBR_DATA = date('Y/m/d');
                $cbr->IMB_CBR_HORA = date('H:i');
                $cbr->IMB_CBR_OBSERVACAO = 'Carta de Cobranca Enviada ao Fiador';
                $cbr->IMB_CTR_VENCIMENTOLOCATARIO = $ctr->IMB_CTR_VENCIMENTOLOCATARIO;
                $cbr->save();
    
                app('App\Http\Controllers\ctrRotinas')
                ->gravarObs( 0, $idContrato, 0, 0,0 ,
                'Carta de Cobrança enviado ao LOCATARIO de aluguel vencido desde '.$this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO));
                    $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $idContrato, 0,'S');
                return view('mail.avisosfiador',compact('texto'));
            }
      
 
            app('App\Http\Controllers\ctrRotinas')
            ->gravarObs( 0, $idContrato, 0, 0,0 ,
            'Carta de Cobrança enviado ao FIADOR de aluguel vencido desde '.$this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO));
                 
        }


    }

    public function avisoDesocupacao( $id )
    {
        $this->idavisodesocupacao = $id;
        $avd = mdlAvisoDesocupacao::find( $id );

        $idContrato = $avd->IMB_CTR_ID;
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','avisodesocupacao')->first();

        if( $doc )
        {
            $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $idContrato, 0,'S');
            return view('reports.admimoveis.docavisodesocupacao',compact('texto'));
        }

        

    }

    

    public function emailLocatarioImportante( Request $request )
    {
        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','emaillocatarioimportante')->first();

        if( $doc )
        {
            
            $ctrs = mdlContrato::where( 'IMB_CTR_SITUACAO','=', 'ATIVO')
            ->leftJoin( 'IMB_LOCATARIOCONTRATO','IMB_LOCATARIOCONTRATO.IMB_CTR_ID', 'IMB_CONTRATO.IMB_CTR_ID')
            ->get();

            foreach( $ctrs as $ctr )
            {
                $texto = $this->gerarDocAutomatico( $doc->GER_DCA_ID, 0, $ctr->IMB_CTR_ID, 0,'S');


                sleep( 40000 );
                $lt = mdlCliente::find($ctr->IMB_CLT_ID);
                $email = $lt->IMB_CLT_EMAIL;
                $array = explode(";",$email);
                foreach( $array as $a )
                {
                    $a=str_replace( ';','',$a);

                    if( $a <> '' )
                    {
                        $idContrato = $ctr->IMB_CTR_ID;
                        $a = filter_var( $a, FILTER_SANITIZE_EMAIL );
                        Log::info('Enviando para '.$a );

                        $html = view('mail.emaillocatarioimportante',compact('texto'));
                        Mail::send('mail.emaillocatarioimportante', compact('texto'),
                        function( $message ) use ($a,$idContrato, $html)
                        {
                            $pdf=PDF::loadHtml( $html,'UTF-8');
                                        //$message->attachData($pdf->output(), $nossonumero_email.'.pdf');
                            $message->to( $a  );
                            $message->bcc( env('APP_MAILBOLETOCOPIA')  );
                            $message->subject('***AVISO EXTREMAMENTE IMPORTANTE****');
                        });
                        app('App\Http\Controllers\ctrRotinas')
                            ->gravarObs( 0, $idContrato,0,0,0,'Aviso Importante ao Locatário '.$a);
                    }
                }
                    
            }
            return response()->json('ok',200);
        }
        else
            return response()->json('naoencontrado',404);

        

    }


    public function gerarWord( Request $request )
    {
        
        $entrada = $request->entrada;
        $saida    = $request->saida; 
        $idcontrato = $request->idcontrato;

        $templateProcessor = new TemplateProcessor(Storage::path("public/automaticos/$entrada"));


        $locatariosnomes = '';
        $enderecocorresp= '';
        $destinatario= '';
        $bairrocorresp= '';
        $cepcorresp= '';
        $cidadecorresp= '';
        $estadocorresp= '';
        $cpfcliente= '';
        $nomefiador= '';
        $cpffiador= '';
        $enderecofiador= '';
        $bairrofiador= '';
        $cidadefiador     = '';   
        $estadofiador= '';
        $cepfiador= '';
        $nomelocatario= '';
        $emaillocatario= '';
        $emailfiador= '';
        $bairro= '';
        $nomelocador_1= '';
        $nomelocador_2= '';
        $nomelocador_3= '';
        $nomelocador_4= '';
        $nomelocador_5= '';
        $nomelocador_6= '';
        $nomelocador_7= '';
        $nomelocador_8= '';
        $locadordescrito_1= '';
        $locadordescrito_2= '';
        $locadordescrito_3= '';
        $locadordescrito_4= '';
        $locadordescrito_5= '';
        $locadordescrito_6= '';
        $locadordescrito_7= '';
        $locadordescrito_8= '';

        $nomelocatario_1= '';
        $nomelocatario_2= '';
        $nomelocatario_3= '';
        $nomelocatario_4= '';
        $nomelocatario_5= '';
        $nomelocatario_6= '';
        $nomelocatario_7= '';
        $nomelocatario_8= '';
        $locatariodescrito_1= '';
        $locatariodescrito_2= '';
        $locatariodescrito_3= '';
        $locatariodescrito_4= '';
        $locatariodescrito_5= '';
        $locatariodescrito_6= '';
        $locatariodescrito_7= '';
        $locatariodescrito_8= '';

        $nomefiador_1= '';
        $nomefiador_2= '';
        $nomefiador_3= '';
        $nomefiador_4= '';
        $nomefiador_5= '';
        $nomefiador_6= '';
        $nomefiador_7= '';
        $nomefiador_8= '';
        $fiadordescrito_1= '';
        $fiadordescrito_2= '';
        $fiadordescrito_3= '';
        $fiadordescrito_4= '';
        $fiadordescrito_5= '';
        $fiadordescrito_6= '';
        $fiadordescrito_7= '';
        $fiadordescrito_8= '';

        $fiadorconjuge_1='';
        $fiadorconjuge_2='';
        $fiadorconjuge_3='';
        $fiadorconjuge_4='';
        $fiadorconjuge_5='';
        $fiadorconjuge_6='';
        $fiadorconjuge_7='';
        $fiadorconjuge_8='';
        

        $ctr = mdlContrato::find( $idcontrato );

        $imv = mdlImovel::find( $ctr->IMB_IMV_ID );
        $idimovel = $imv->IMB_IMV_ID;
        $bairro = app('App\Http\Controllers\ctrRotinas')->pegarBairroImovel(  $idimovel );

        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=', $idimovel )->get();

        $seguro = mdlContratoSeguroIncendio::where( 'IMB_CTR_ID','=', $idcontrato )->first();
        $valorseguro = 0;
        $valorcoberturaseguro =0;
        if( $seguro <> '' )
        {
            $valorseguro = $seguro->IMB_SCT_VALORSEGURO;
            $valorcoberturaseguro = $seguro->IMB_SCT_VALORCOBERTURA;
            Log::info( '$valorseguro '.$valorseguro);
            Log::info( '$valorcoberturaseguro '.$valorcoberturaseguro);
            
        }

        $cont = 0;
        $nomelocador_1='';
        $nomelocador_2='';
        $nomelocador_3='';
        $nomelocador_4='';
        $nomelocador_5='';
        $nomelocador_6='';
        $nomelocador_7='';
        $nomelocador_8='';

        $locadordescrito_1='';
        $locadordescrito_2='';
        $locadordescrito_3='';
        $locadordescrito_4='';
        $locadordescrito_5='';
        $locadordescrito_6='';
        $locadordescrito_7='';
        $locadordescrito_8='';

        
        foreach( $ppi as $pp)
        {
            //Log:info( "LOCADOR PP-IMB_CLT_ID $pp->IMB_CLT_ID IMOVEL $idimovel");
            $cont = $cont + 1;
            $maisum='';
            if( $cont > 1 ) $maisum = ', e ';

            if( $cont == 1 )
            {
                $nomelocador_1 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_1 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 2 )
            {
                $nomelocador_2 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_2 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 3 )
            {
                $nomelocador_3 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_3= $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 4 )
            {
                $nomelocador_4 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_4 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 5 )
            {
                $nomelocador_5 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_5 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 6)
            {
                $nomelocador_6 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_6 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 7 )
            {
                $nomelocador_7 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_7 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 8 )
            {
                $nomelocador_8 = $this->pegarNomeCliente($pp->IMB_CLT_ID );
                $locadordescrito_8 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
        };

        $idcliente = app('App\Http\Controllers\ctrRotinas')->codigoLocatarioPrincipal( $idcontrato );
        $cpfcliente = '';
        $cliente = mdlCliente::find( $idcliente );
        if( $cliente )
        {
            if( $cliente->IMB_CLT_PESSOA == 'F' )
                $cpfcliente = 'Nº CPF: '.$cliente->IMB_CLT_CPF;
            else
            if( $cliente->IMB_CLT_PESSOA == 'J' )
                $cpfcliente = 'Nº CNPJ: '.$cliente->IMB_CLT_CPF;
            $nomelocatario = $cliente->IMB_CLT_NOME;
            $enderecolocatario = $cliente->IMB_CLT_RESEND.', '.$cliente->IMB_CLT_RESENDNUM.' '.$cliente->IMB_CLT_RESENDCOM;
            $bairrolocatario =  $cliente->CEP_BAI_NOMERES;
            $cidadelocatario =  $cliente->CEP_CID_NOMERES;
            $estadolocatario =  $cliente->CEP_UF_SIGLARES;
            $ceplocatario    =  $cliente->IMB_CLT_RESENDCEP;
            $emaillocatario = $cliente->IMB_CLT_EMAIL;
        }

        $fiadores = mdlFiadorContrato::where( 'IMB_CTR_ID','=', $idcontrato )->get();
        $nomefiador = '';
        $cpffiador ='';
        $enderecofiador = '';
        $bairrofiador ='';
        $cidadefiador ='';
        $estadofiador ='';
        $cepfiador    ='';
        $emailfiador = '';

        $cont=0;
        foreach( $fiadores as $fiador )
        {
            $cont = $cont + 1;
            $maisum='';
            if( $cont > 1 ) $maisum = ', e ';
            $objfiador = mdlCliente::where('IMB_CLT_ID','=', $fiador->IMB_CLT_ID)->first();

            if( $cont == 1 )
            {
                if( $objfiador<>'' )
                {
                    $nomefiador = $objfiador->IMB_CLT_NOME;
                    $cpffiador = $objfiador->IMB_CLT_CPF;
                    $enderecofiador = $objfiador->IMB_CLT_RESEND.', '.$objfiador->IMB_CLT_RESENDNUM.' '.$objfiador->IMB_CLT_RESENDCOM;
                    $bairrofiador =  $objfiador->CEP_BAI_NOMERES;
                    $cidadefiador =  $objfiador->CEP_CID_NOMERES;
                    $estadofiador =  $objfiador->CEP_UF_SIGLARES;
                    $cepfiador    =  $objfiador->IMB_CLT_RESENDCEP;
                    $emailfiador = $objfiador->IMB_CLT_EMAIL;
                }
            }
            if( $cont == 1 )
            {
                $nomefiador_1 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_1 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_1 = $objfiador->IMB_CLTCJG_NOME;
            }
        
            if( $cont == 2 )
            {
                $nomefiador_2 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_2 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_2 = $objfiador->IMB_CLTCJG_NOME;
            }
        
            if( $cont == 3 )
            {
                $nomefiador_3 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_3= $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_3 = $objfiador->IMB_CLTCJG_NOME;

            }
        
            if( $cont == 4 )
            {
                $nomefiador_4 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_4 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_4 = $objfiador->IMB_CLTCJG_NOME;

            }
        
            if( $cont == 5 )
            {
                $nomefiador_5 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_5 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_5 = $objfiador->IMB_CLTCJG_NOME;

            }
        
            if( $cont == 6)
            {
                $nomefiador_6 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_6 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_6 = $objfiador->IMB_CLTCJG_NOME;

            }
        
            if( $cont == 7 )
            {
                $nomefiador_7 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_7 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_7 = $objfiador->IMB_CLTCJG_NOME;

            }
        
            if( $cont == 8 )
            {
                $nomefiador_8 = $this->pegarNomeCliente($fiador->IMB_CLT_ID );
                $fiadordescrito_8 = $maisum.$this->descritivoCliente($fiador->IMB_CLT_ID );
                $fiadorconjuge_8 = $objfiador->IMB_CLTCJG_NOME;

            }

        }
        
        $lctctr = mdlLocatarioContrato::where( 'IMB_CTR_ID','=', $idcontrato )->get();

        $cont = 0;
        $locatarioprincipal='';
        $locatarios='';

        $nomelocatario_1='';
        $nomelocatario_2='';
        $nomelocatario_3='';
        $nomelocatario_4='';
        $nomelocatario_5='';
        $nomelocatario_6='';
        $nomelocatario_7='';
        $nomelocatario_8='';

        $locatariodescrito_1='';
        $locatariodescrito_2='';
        $locatariodescrito_3='';
        $locatariodescrito_4='';
        $locatariodescrito_5='';
        $locatariodescrito_6='';
        $locatariodescrito_7='';
        $locatariodescrito_8='';

        foreach( $lctctr as $lt)
        {
            $cont = $cont + 1;
            
            $cliente = mdlCliente::find( $lt->IMB_CLT_ID);

            $maisum='';
            if( $cont > 1 ) $maisum = ', e ';

            
            $locatariosnomes  = $locatarios.$maisum.$cliente->IMB_CLT_NOME;

            if( $cont == 1 )
            {
                $nomelocatario_1 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_1 = $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }
        
            if( $cont == 2 )
            {
                $nomelocatario_2 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_2 = $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }
        
            if( $cont == 3 )
            {
                $nomelocatario_3 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_3= $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }
        
            if( $cont == 4 )
            {
                $nomelocatario_4 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_4 = $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }
        
            if( $cont == 5 )
            {
                $nomelocatario_5 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_5 = $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }
        
            if( $cont == 6)
            {
                $nomelocatario_6 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_6 = $maisum.$this->descritivoCliente($pp->IMB_CLT_ID );
            }
        
            if( $cont == 7 )
            {
                $nomelocatario_7 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_7 = $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }
        
            if( $cont == 8 )
            {
                $nomelocatario_8 = $this->pegarNomeCliente($lt->IMB_CLT_ID );
                $locatariodescrito_8 = $maisum.$this->descritivoCliente($lt->IMB_CLT_ID );
            }

        }

        


        $ec = mdlEnderecoCobranca::find( $idcontrato);
        if( $ec <>  '' )
        {
            $destinatario = $ec->IMB_CCB_DESTINATARIO;

            $enderecocorresp = $ec->IMB_CCB_ENDERECO.' '. 
                    $ec->IMB_CCB_ENDERECONUMERO.' '.
                    $ec->IMB_CCB_ENDERECOCOMPLEMENTO;
            $bairrocorresp =  $ec->IMB_CCB_BAIRRO;
            $cepcorresp =  $ec->IMB_CCB_CEP;
            $cidadecorresp = $ec->CEP_CID_NOME;
            $estadocorresp = $ec->CEP_UF_SIGLA;



        }
        else
        {
            if( $idimovel <> 0 )
            {
                $enderecocorresp =  app('App\Http\Controllers\ctrRotinas')
                    ->imovelEndereco( $ctr->IMB_IMV_ID);
                $destinatario = app('App\Http\Controllers\ctrRotinas')->nomeLocatarioPrincipal( $idcontrato );
        
                $bairrocorresp = $imv->CEP_BAI_NOME;
                
                $cepcorresp = $imv->IMB_IMV_ENDERECOCEP;

                $cidadecorresp = $imv->IMB_IMV_CIDADE;
                $estadocorresp = $imv->IMB_IMV_ESTADO;
            }
        }

        $idimovel = 0;
        if( $ctr <> '' ) $idimovel = $ctr->IMB_IMV_ID;
        if( $imv <> '' ) $idimovel = $imv->IMB_IMV_ID;

        $imovelgarantia='';

        $templateProcessor->setValues(
            [
                '**PASTA**' => $ctr->IMB_CTR_REFERENCIA,
                '**CODIGOIMOVEL**' => $imv->IMB_IMV_ID,
                '**ENDERECOIMOVEL_1**' => app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $imv->IMB_IMV_ID ),
                '**ENDERECOIMOVEL_COMPLETO**' => app('App\Http\Controllers\ctrRotinas')->imovelEnderecoCompleto( $imv->IMB_IMV_ID ),
                '**PROPRIETARIOPRINCIPAL**' =>  app('App\Http\Controllers\ctrRotinas')->proprietarioPrincipal( $imv->IMB_IMV_ID ),
                '**PROPRIETARIOSDESCRITIVO**' => $this->getProprietariosDescritivo($imv->IMB_IMV_ID ),
                '**LOCATARIOSDESCRITIVO**' => $this->getLocatariosDescritivo($ctr->IMB_CTR_ID ),
                '**FIADORESDESCRITIVO**' => $this->getFiadoresDescritivo($ctr->IMB_CTR_ID ),
                '**TAXAADMINISTRATIVA**' =>app('App\Http\Controllers\ctrRotinas')->formatarReal(  $ctr->IMB_CTR_TAXAADMINISTRATIVA ),
                "**TAXAADMINISTRATIVAEXTENSO**" =>app('App\Http\Controllers\ctrRotinas')->numeroextenso(  $ctr->IMB_CTR_TAXAADMINISTRATIVA ),  
                "**VALORALUGUEL_1**" =>  app('App\Http\Controllers\ctrRotinas')->formatarReal(  $ctr->IMB_CTR_VALORALUGUEL ),
                "**VALORALUGUELEXTENSO_1**" =>app('App\Http\Controllers\ctrRotinas')->valorExtenso(  $ctr->IMB_CTR_VALORALUGUEL ),
                "**DURACAOCONTRATOEXTENSO_1**" => app('App\Http\Controllers\ctrRotinas')->numeroextenso(  $ctr->IMB_CTR_DURACAO ),  
                "**DURACAOCONTRATO_1**" => $ctr->IMB_CTR_DURACAO,
                "**INICIOCONTRATO_1**" => $this->formatarData( $ctr->IMB_CTR_INICIO),
                "**TERMINOCONTRATO_1**" => $this->formatarData( $ctr->IMB_CTR_TERMINO),
                "**INICIOCONTRATOEXTENSO_1**" => app('App\Http\Controllers\ctrRotinas')
                ->dataExtenso( $ctr->IMB_CTR_INICIO ),
                "**TERMINOCONTRATOEXTENSO_1**" => app('App\Http\Controllers\ctrRotinas')
                ->dataExtenso( $ctr->IMB_CTR_TERMINO ),
                "**FIADORESNOME_E_ESPOSA**" => $this->fiadoresNomesEEsposas($ctr->IMB_CTR_ID ),
                "**LOCATARIOSNOMES**" =>$locatariosnomes,
                "**IMB_CTG_COBRANCAENDERECO**" => $enderecocorresp,
                "**IMB_CTG_DESTINATARIO**" => $destinatario,
                "**IMB_CTG_COBRANCABAIRRO**" => $bairrocorresp,
                "**IMB_CTG_COBRANCACEP**" => $cepcorresp,
                "**IMB_CTG_COBRANCACIDADE**" => $cidadecorresp,
                "**IMB_CTG_COBRANCAUF**" => $estadocorresp,
                "**TIPOCONTRATO**" =>  $ctr->IMB_CTR_FINALIDADE,
                "**PROXVENCIMENTOLOCATARIO_1**" => $this->formatarData( $ctr->IMB_CTR_VENCIMENTOLOCATARIO ),
                "**LOCADORESNOMES**" => $this->locadoresNomes($ctr->IMB_IMV_ID),
                "**CPFLOCATARIOPRINCIPAL**" => $cpfcliente,
                "**NOMEFIADOR_1**"                      => $nomefiador,
                "**CPFFIADOR_1**"                      => $cpffiador,
                "**ENDERECOFIADOR_1**"                  => $enderecofiador,
                "**FIADOR_1_BAIRRO**"                  => $bairrofiador,
                "**FIADOR_1_CIDADE**"                  => $cidadefiador,
                "**FIADOR_1_ESTADO**"                  => $estadofiador,
                "**FIADOR_1_CEP**"                  => $cepfiador,
                "**DATAATUAL**"                         => date( 'd/m/Y'),
                "**NOMELOCATARIO_1**" => $nomelocatario,
                "**EMAILLOCATARIO_1**" => $emaillocatario,
                "**EMAILFIADOR_1**" => $emailfiador,
                "**DIAVENCIMENTO_1**" => str_pad( $ctr->IMB_CTR_DIAVENCIMENTO,2,'0' ),
                "**DIAVENCIMENTOEXTENSO_1**" => app('App\Http\Controllers\ctrRotinas')->numeroextenso(  $ctr->IMB_CTR_DIAVENCIMENTO ), 
                '**BAIRROIMOVEL**' =>$bairro,
                '**CIDADEIMOVEL**' =>$imv->IMB_IMV_CIDADE,
                '**UFIMOVEL**' =>$imv->IMB_IMV_ESTADO,
                '**NOMELOCADOR_1**' => $nomelocador_1,
                '**LOCADORDESCRITIVO_1**' => $locadordescrito_1,
                '**NOMELOCADOR_2**' => $nomelocador_2,
                '**LOCADORDESCRITIVO_2**' => $locadordescrito_2,
                '**NOMELOCADOR_3**' => $nomelocador_3,
                '**LOCADORDESCRITIVO_3**' => $locadordescrito_3,
                '**NOMELOCADOR_4**' => $nomelocador_4,
                '**LOCADORDESCRITIVO_4**' => $locadordescrito_4,
                '**NOMELOCADOR_5**' => $nomelocador_5,
                '**LOCADORDESCRITIVO_5**' => $locadordescrito_5,
                '**NOMELOCADOR_6**' => $nomelocador_6,
                '**LOCADORDESCRITIVO_6**' => $locadordescrito_6,
                '**NOMELOCADOR_7**' => $nomelocador_7,
                '**LOCADORDESCRITIVO_7**' => $locadordescrito_7,
                '**NOMELOCADOR_8**' => $nomelocador_8,
                '**LOCADORDESCRITIVO_8**' => $locadordescrito_8,
                '**NOMELOCATARIO_1**' => $nomelocatario_1,
                '**NOMELOCATARIO_2**' => $nomelocatario_2,
                '**NOMELOCATARIO_3**' => $nomelocatario_3,
                '**NOMELOCATARIO_4**' => $nomelocatario_4,
                '**NOMELOCATARIO_5**' => $nomelocatario_5,
                '**NOMELOCATARIO_6**' => $nomelocatario_6,
                '**NOMELOCATARIO_7**' => $nomelocatario_7,
                '**NOMELOCATARIO_8**' => $nomelocatario_8,
                '**LOCATARIODESCRITIVO_1**' => $locatariodescrito_1,
                '**LOCATARIODESCRITIVO_2**' => $locatariodescrito_2,
                '**LOCATARIODESCRITIVO_3**' => $locatariodescrito_3,
                '**LOCATARIODESCRITIVO_4**' => $locatariodescrito_4,
                '**LOCATARIODESCRITIVO_5**' => $locatariodescrito_5,
                '**LOCATARIODESCRITIVO_6**' => $locatariodescrito_6,
                '**LOCATARIODESCRITIVO_7**' => $locatariodescrito_7,
                '**LOCATARIODESCRITIVO_8**' => $locatariodescrito_8,
                '**NOMEFIADOR_1**' => $nomefiador_1,
                '**NOMEFIADOR_2**' => $nomefiador_2,
                '**NOMEFIADOR_3**' => $nomefiador_3,
                '**NOMEFIADOR_4**' => $nomefiador_4,
                '**NOMEFIADOR_5**' => $nomefiador_5,
                '**NOMEFIADOR_6**' => $nomefiador_6,
                '**NOMEFIADOR_7**' => $nomefiador_7,
                '**NOMEFIADOR_8**' => $nomefiador_8,
                '**FIADORDESCRITIVO_1**' => $fiadordescrito_1,
                '**FIADORDESCRITIVO_2**' => $fiadordescrito_2,
                '**FIADORDESCRITIVO_3**' => $fiadordescrito_3,
                '**FIADORDESCRITIVO_4**' => $fiadordescrito_4,
                '**FIADORDESCRITIVO_5**' => $fiadordescrito_5,
                '**FIADORDESCRITIVO_6**' => $fiadordescrito_6,
                '**FIADORDESCRITIVO_7**' => $fiadordescrito_7,
                '**FIADORDESCRITIVO_8**' => $fiadordescrito_8,
                '**FIADORCONJUGE_1**' => $fiadorconjuge_1,
                '**FIADORCONJUGE_2**' => $fiadorconjuge_2,
                '**FIADORCONJUGE_3**' => $fiadorconjuge_3,
                '**FIADORCONJUGE_4**' => $fiadorconjuge_4,
                '**FIADORCONJUGE_5**' => $fiadorconjuge_5,
                '**FIADORCONJUGE_6**' => $fiadorconjuge_6,
                '**FIADORCONJUGE_7**' => $fiadorconjuge_7,
                '**FIADORCONJUGE_8**' => $fiadorconjuge_8,
                "**VALORSEGURO**" =>  app('App\Http\Controllers\ctrRotinas')->formatarReal(  $valorseguro ),
                "**VALORSEGUROEXTENSO**" =>app('App\Http\Controllers\ctrRotinas')->valorExtenso(  $valorseguro ),
                "**VALORCOBERTURASEGURO**" =>  app('App\Http\Controllers\ctrRotinas')->formatarReal(  $valorcoberturaseguro ),
                "**VALORCOBERTURASEGUROEXTENSO**" =>app('App\Http\Controllers\ctrRotinas')->valorExtenso(  $valorcoberturaseguro )


                
            ]
        );
            
            Storage::disk('public')->makeDirectory( 'gerados' );


            $filename = storage_path() . '/app/public/gerados/'.'Documento_Gerado_'.$entrada;
            $templateProcessor->saveAs($filename);
            
            $url = env( 'APP_URL').'/storage/gerados/'.'Documento_Gerado_'.$entrada;

            return response()->json( $url, 200 );

    }


    public function getProprietariosDescritivo( $idimovel )
    {
        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=',$idimovel )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
        $cont = 0;
        $descritivo='';
        foreach( $ppi as $pp)
        {
            $descritivo = $descritivo .  $this->descritivoCliente($pp->IMB_CLT_ID );
        };

        return $descritivo;

        
    }

    public function getLocatariosDescritivo( $idContrato )
    {
        $ppi = mdlLocatarioContrato::where( 'IMB_CTR_ID','=',$idContrato )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
        $cont = 0;
        $descritivo='';
        foreach( $ppi as $pp)
        {
            $descritivo = $descritivo .  $this->descritivoCliente($pp->IMB_CLT_ID );
        };

        return $descritivo;

        
    }

    public function getFiadoresDescritivo( $idContrato )
    {
        $ppi = mdlFiadorContrato::where( 'IMB_CTR_ID','=',$idContrato )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
        $descritivo='';

        foreach( $ppi as $pp)
        {
            if( $descritivo == '' )
                $descritivo = $descritivo .  $this->descritivoCliente($pp->IMB_CLT_ID );
            else
                $descritivo = $descritivo .  ', '.$this->descritivoCliente($pp->IMB_CLT_ID );

        };

        return $descritivo;
        
    }

    public function fiadoresNomesEEsposas( $idcontrato )
    {
        $ppi = mdlFiadorContrato::where( 'IMB_CTR_ID','=',$idcontrato )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
        $descritivo='';
        foreach( $ppi as $pp)
        {
            $cliente = mdlCliente::find( $pp->IMB_CLT_ID );
            if( $descritivo <> '' ) $descritivo = $descritivo . ', e também ';
            
            $descritivo = $descritivo .  $cliente->IMB_CLT_NOME;
            if( $cliente->IMB_CLT_ESTADOCIVIL == 'C' )
                $descritivo = $descritivo . ' e esposo(a) '.$cliente->IMB_CLTCJG_NOME;
        };

        return $descritivo;

    }

    public function locadoresNomes( $idimovel )
    {
        $ppi = mdlPropImovel::where( 'IMB_IMV_ID','=',$idimovel )
            ->where( 'IMB_IMB_ID','=', Auth::user()->IMB_IMB_ID )->get();
        $descritivo='';
        foreach( $ppi as $pp)
        {
            $cliente = mdlCliente::find( $pp->IMB_CLT_ID );
            if( $descritivo <> '' ) $descritivo = $descritivo . ' / ';
            
            $descritivo = $descritivo .  $cliente->IMB_CLT_NOME;
        };

        return $descritivo;

    }

    public function storeDragDropDocumentosContratos(Request $request)
    {
        $entrada = $request->entrada;
        $saida    = $request->saida; 
        $image = $request->file('file');
       
        $idcontrato = $request->id;

        $empresa = Auth::user()->IMB_IMB_ID;

       $fileName = $request->file->getClientOriginalName();

       $pasta='/automaticos/'.$fileName;

       $path = Storage::disk('public')->put($pasta, file_get_contents($request->file));
       $path = Storage::disk('public')->url($path);

       $originalName = $request->file->getClientOriginalName();
       $extension = $request->file->getClientOriginalExtension();

       return response()->json(['success' => 'Uploaded!'], 200);

    }

    public function reciboContasPagar( $id, $idconta )
    {
        $this->idcontasapagar = $id;
        $apd = mdlApDoc::find( $id );

        $doc = mdlDocsAutomaticos::where( 'GER_DCA_TIPO','=','recibocontaspagar')->first();

        if( $doc )
        {
            $texto = $this->gerarReciboAP( $doc->GER_DCA_ID, $apd->FIN_APD_ID, $idconta );
            return view('reports.admimoveis.docrecibocaixa',compact('texto'));
        }

    }

    
    public function gerarReciboAP( $iddoc, $apdId, $idconta )
    {
        $dca = mdlDocsAutomaticos::find( $iddoc );
        $texto = $dca->GER_DCA_TEXTO;

        $apd = mdlApDoc::find( $apdId );

        $conta = mdlContaCaixa::find( $idconta );
        Log::info( 'CONTA '.$idconta );

        $forn = mdlEmpresa::find( $apd->FIN_EEP_ID);

        $texto = str_replace( "**DATAATUAL**", date('d/m/Y'), $texto);        
        
        $texto = str_replace( "**DATARECIBO**",  
                    app('App\Http\Controllers\ctrRotinas')
                        ->dataExtenso( date( 'Y/m/d')), $texto);

        $texto = str_replace( "**PAGADOR**", $conta->FIN_CCI_CONCORNOME, $texto);        
        $texto = str_replace( "**VALORECIBO**", $apd->FIN_APD_VALORVENCIMENTO, $texto);        
        $texto = str_replace( "**EXTENSOVALORRECIBO**", app('App\Http\Controllers\ctrRotinas')
        ->valorExtenso(  $apd->FIN_APD_VALORVENCIMENTO ), $texto);
        $texto = str_replace( "**RECEBEDOR**",  $forn->IMB_EEP_RAZAOSOCIAL, $texto);        
        $texto = str_replace( "**CPFRECEBEDOR**",  $forn->IMB_EEP_CGC, $texto);        
        $texto = str_replace( "**USUARIOLOGADO**",  Auth::user()->IMB_ATD_NOME, $texto);        
        $texto = str_replace( "**REFENTERECIBO**",  $apd->FIN_APD_OBSERVACAO, $texto);         
                
        return $texto;
    }

    public function upload(Request $request)
    {

        $file = $request->file('file');
        $id = $request->GER_DCA_ID_UPL;

  


        $fileName = $request->file->getClientOriginalName();
        $path = Storage::disk('public')->put($fileName, $file);

        $imagepathroot = Storage::disk('public')->path('');        
        $pasta=$imagepathroot.$fileName;
 
        $path = Storage::disk('public')->put('/automaticos/'.$fileName, file_get_contents($request->file));
        $path = Storage::disk('public')->url($path);
 
 
 
        $originalName = $request->file->getClientOriginalName();
        $extension = $request->file->getClientOriginalExtension();
                

        $dca = mdlDocsAutomaticos::find( $id);
        $dca->GER_DCA_UPLOAD = $fileName;
        $dca->GER_DCA_DOWNLOAD = $fileName;
        $dca->save();

        return view( 'docsautomaticos.docsautomaticosindex');


    }

}
