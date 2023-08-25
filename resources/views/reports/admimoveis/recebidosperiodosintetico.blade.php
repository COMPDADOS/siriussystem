<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Relatório Recebimento Periodo</title>
    <script>
        window.print();
        function TABLE1_onclick() { }
    </script>
    <style type="text/css" media="all">
        * { font-family: Arial, Helvetica, sans-serif; margin: 0; }
        body {  margin: 5px; }
        h1{ font-size: 14px;}

        p{ line-height: 22px;}
        table { border: 1px solid #000; border-collapse: collapse;font-size: 11px; }
        table tr th { text-align: left; border: 1px solid #000; padding: 4px; font-size: 10px; }
        table tr td { padding: 2px; border: 1px solid #000; }
        .white{ color: #FFF;}
        .detalhes {padding:0px !important; line-height:2 !important; }
        .detalhes li { list-style:none !important; }
        .bg-1
        {
            background:#e0ebeb;
        }

        .div-center
        {
            text-align:center;
        }

        .div-left
        {
            text-align:left;
        }

        .div-right
        {
            text-align:right;
        }

        .semborda
        {
            border:0;
            font-size:8px;
        }

        .font-20
        {
            font-size:20px;
        }
        

    </style>
</head>
<body style="background-color: #ffffff">
    @php
    $imb = Auth::user()->imobiliaria( Auth::user()->IMB_IMB_ID);
    @endphp
    <table id="TABLE1" onclick="return TABLE1_onclick()">

        <tr>
            <td class="div-center">
                <img src="{{env('APP_URL')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/logos/logo.jpg"
                    alt='logo' width='120' height='60' />
            </td>
            <td colspan='100%'>
                <ul>
                    <li><strong>{{$imb->IMB_IMB_NOME}}</strong></li>
                    <li>{{$imb->IMB_IMB_ENDERECO}} {{$imb->IMB_IMB_ENDERECONUMERO}} - {{$imb->CEP_BAI_NOME}} - {{$imb->CEP_CID_NOME}}-{{$imb->CEP_UF_SIGLA}}</li>
                    <li>{{$imb->IMB_IMB_TELEFONE1}} &nbsp;-&nbsp; Creci: {{$imb->IMB_IMB_CRECI}}</li>
                    <li>Ficha impressa por: {{Auth::user()->IMB_ATD_NOME}}</li>
                    <li>Data: {{date("d-m-Y H:i")}}</li>
                </ul>
            </td>
        </tr>

        <tr>
            <td></td>
        </tr>
        <tr></tr>
            <tr>
            <td colspan="100%" align="center">
                <h1>
                    Relatório de Recebimento de Aluguéres
                </h1>
                <h3>
                    Periodo: {{ app('App\Http\Controllers\ctrRotinas')->formatarData($datainicio) }} a {{ app('App\Http\Controllers\ctrRotinas')->formatarData($datafim) }}
                </h3>
            </td>
        </tr>
        <tr class="bg-1">
                <td   class="div-center semborda" width="50px"  style="height: 21px"><u>Id Imóvel</u> 
                </td>
                <td   class="div-center semborda"   style="height: 21px"><u>Pasta</u> 
                </td>
                <td   class="div-center semborda"   style="height: 21px"><u> Endereço</u> 
                </td>
                <td  class="div-center semborda"    style="height: 21px">Locatário
                </td>
                <td  class="div-center semborda"    style="height: 21px">Locador
                </td>
                <td  class="div-center semborda"    style="height: 21px">Vencimento
                </td>
                <td class="div-center semborda"     style="height: 21px">Pagamento
                </td>
                <td  class="div-center semborda"    style="height: 21px">$ aluguel
                </td>
                <td  class="div-center semborda"    style="height: 21px">$ Multa
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ Juros
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ IPTU
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ IRRF
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ Boleto
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ Outros
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ Taxa Adm.
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ Taxa Contrato
                </td>   
                <td  class="div-center semborda"    style="height: 21px">$ Recebido
                </td>

            </tr>
                @php
                    $VALORALUGUEL           = 0;
                    $MULTAATRASO            = 0;
                    $JUROSATRASO            = 0;
                    $IPTU                   = 0;
                    $IRRF                   = 0;
                    $TARIFABOLETO           = 0;
                    $OUTROS                 = 0;
                    $TAXAADM                = 0;
                    $TAXACONTRATO           = 0;
                    $TOTALRECIBO            = 0;
                @endphp

            @foreach ( $rec as $recibo )

            <tr class="bg-1">
                <td   class="div-center " width="50px"   style="height: 21px">{{ $recibo->IMB_IMV_ID}}
                </td>
                <td   class="div-center "   style="height: 21px">{{$recibo->IMB_CTR_REFERENCIA}}
                </td>
                <td   class="div-center "   style="height: 21px">{{$recibo->ENDERECOIMOVEL}}
                </td>
                <td  class="div-center "    style="height: 21px">{{$recibo->NOMELOCATARIO}}
                </td>
                <td  class="div-center "    style="height: 21px">{{$recibo->NOMELOCADOR}}
                </td>
                <td  class="div-center "    style="height: 21px">{{app('App\Http\Controllers\ctrRotinas')->formatarData($recibo->IMB_RLT_DATACOMPETENCIA)}}
                </td>
                <td class="div-center "     style="height: 21px">{{app('App\Http\Controllers\ctrRotinas')->formatarData($recibo->IMB_RLT_DATAPAGAMENTO)}}
                </td>   
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->VALORALUGUEL,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->MULTAATRASO,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->JUROSATRASO,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->IPTU,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->IRRF,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->TARIFABOLETO,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->OUTROS,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->TAXAADM,2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format(abs($recibo->TAXACONTRATO),2,',','.')}}
                </td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->TOTALRECIBO,2,',','.')}}
                </td>
            </tr>
            @php
                $VALORALUGUEL           = $VALORALUGUEL             + $recibo->VALORALUGUEL;
                $MULTAATRASO            = $MULTAATRASO              + $recibo->MULTAATRASO;
                $JUROSATRASO            = $JUROSATRASO              + $recibo->JUROSATRASO;
                $IPTU                   = $IPTU                     + $recibo->IPTU;
                $IRRF                   = $IRRF                     + $recibo->IRRF;
                $TARIFABOLETO           = $TARIFABOLETO             + $recibo->TARIFABOLETO;
                $OUTROS                 = $OUTROS                   + $recibo->OUTROS;
                $TAXAADM                = $TAXAADM                  + $recibo->TAXAADM;
                $TAXACONTRATO           = $TAXACONTRATO             + abs($recibo->TAXACONTRATO);
                $TOTALRECIBO            = $TOTALRECIBO              + $recibo->TOTALRECIBO;
            @endphp

        @endforeach
        <tr class="bg-1">
            <td   class="div-center " width="50px"   style="height: 21px"><b>TOTAIS =></b>
            </td>
            <td   class="div-center "   style="height: 21px">
            </td>
            <td   class="div-center "   style="height: 21px">
            </td>
            <td  class="div-center "    style="height: 21px">
            </td>
            <td  class="div-center "    style="height: 21px">
            </td>
            <td  class="div-center "    style="height: 21px">
            </td>
            <td class="div-center "     style="height: 21px">
            </td>   
            <td  class="div-right "     style="height: 21px">{{number_format($VALORALUGUEL,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($MULTAATRASO,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($JUROSATRASO,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($IPTU,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($IRRF,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($TARIFABOLETO,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($OUTROS,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($TAXAADM,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($TAXACONTRATO,2,',','.')}}
            </td>
            <td  class="div-right "     style="height: 21px">{{number_format($TOTALRECIBO,2,',','.')}}
            </td>
        </tr>

    </table>
    
    
</body>
</html>
