<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\mailEnvioMail;
use Illuminate\Support\Facades\Mail;
use App\mdlAtd;
use App\mdlAtendimentoAgenda;
use DB;

class ctrEnvioEmailAtendimento extends Controller
{
    public function enviarEmail( $idatm )
    {

        function formatarData($data){
            $rData = substr( $data,8,2 ).'/'.
                     substr( $data,5,2 ).'/'.
                     substr( $data,0,4 ).
                     substr( $data,10,8 );
            return $rData;
        }

        {

            $atd = mdlAtd::select( [
                'IMB_ATM_DTHINICIO',
                DB::raw('IMB_CLIENTE.IMB_CLT_NOME AS IMB_CLT_NOME'),
                DB::raw('IMB_CLIENTE.IMB_CLT_EMAIL AS IMB_CLT_EMAIL'),
                DB::raw('IMB_ATENDENTE.IMB_ATD_NOME AS IMB_ATD_NOME'),
                DB::raw('IMB_ATENDENTE.IMB_ATD_EMAIL AS IMB_ATD_EMAIL'),
                DB::raw('IMB_IMOBILIARIA.IMB_IMB_NOME AS IMB_IMB_NOME'),
                DB::raw('IMB_IMOBILIARIA.IMB_IMB_TELEFONE1 AS IMB_IMB_TELEFONE1'),
                
            ])->leftJoin('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'VIS_ATENDIMENTO.IMB_IMB_ID')
              ->leftJoin('IMB_CLIENTE', 'IMB_CLIENTE.IMB_CLT_ID', 'VIS_ATENDIMENTO.IMB_CLT_ID')
              ->leftJoin('IMB_ATENDENTE', 'IMB_ATENDENTE.IMB_ATD_ID', 'VIS_ATENDIMENTO.IMB_ATD_ID')
              ->where( 'VIS_ATM_ID','=',$idatm)
              ->get();


              


            $user = new \StdClass();
            $user->clientenome=$atd[0]->IMB_CLT_NOME;
            $user->clienteemail=$atd[0]->IMB_CLT_EMAIL;
            $user->corretornome=$atd[0]->IMB_ATD_NOME;
            $user->corretoremail=$atd[0]->IMB_ATD_EMAIL;
            $user->imobiliarianome=$atd[0]->IMB_IMB_NOME;
            $user->imobiliariatelefone=$atd[0]->IMB_IMB_TELEFONE1;
            $user->atendimentoiniciado = formatarData($atd[0]->IMB_ATM_DTHINICIO);
            $user->atendimentomensagem1='Segue abaixo informações sobre atendimento iniciado em '.
            formatarData($atd[0]->IMB_ATM_DTHINICIO).' por nosso atendente '.$user->corretornome;
                        
            $ata = mdlAtendimentoAgenda::where( 'VIS_ATM_ID','=', $idatm )
            ->orderBy('VIS_ATA_ID', 'DESC')
            ->limit(5)->get();

            $user->relatodata = '';
            $user->relatohora = '';
            $user->relatoobservacao = '';
            $user->linhaobs1 = '';
            $user->linhaobs2 = '';
            $user->linhaobs3 = '';
            $user->linhaobs4 = '';
            $user->linhaobs5 = '';

            $cont = 0;
            foreach( $ata as $relato )
            {

                $cont++;
                if( $cont == 1 )
                    $user->linhaobs1 = formatarData($relato->VIS_ATA_DATA ).' - '.
                        $relato->VIS_ATA_HORA.' - '.
                        $relato->VIS_ATA_OBSERVACOES             ;
                else
                if( $cont == 2 )
                    $user->linhaobs2 = formatarData($relato->VIS_ATA_DATA ).' - '.
                        $relato->VIS_ATA_HORA.' - '.
                        $relato->VIS_ATA_OBSERVACOES             ;
                else
                if( $cont == 3 )
                    $user->linhaobs3 = formatarData($relato->VIS_ATA_DATA ).' - '.
                        $relato->VIS_ATA_HORA.' - '.
                        $relato->VIS_ATA_OBSERVACOES             ;
                else
                if( $cont == 4)
                    $user->linhaobs4 = formatarData($relato->VIS_ATA_DATA ).' - '.
                        $relato->VIS_ATA_HORA.' - '.
                        $relato->VIS_ATA_OBSERVACOES             ;

                else
                if( $cont == 5)
                    $user->linhaobs5 = formatarData($relato->VIS_ATA_DATA ).' - '.
                        $relato->VIS_ATA_HORA.' - '.
                        $relato->VIS_ATA_OBSERVACOES             ;
            
//               $user->relatodata = $user->relatodata .'\n'. 
               //$user->relatohora = ' - '.$user->relatohora . $relato->VIS_ATA_HORA;
               //$user->relatoobservacao = '\n'.$user->relatoobservacao  . $relato->VIS_ATA_OBSERVACOES;

            };
            
            \Illuminate\Support\Facades\Mail::send( new \App\Mail\mailEnvioMail( $user  ) );
            
        }
        
    }
}
