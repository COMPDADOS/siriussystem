]<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Relatório Repassado Periodo</title>
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
            <td colspan='8'>
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
            <td colspan="8" align="center">
                <h1>
                    Relatório de Repasses de Aluguéres
                </h1>
                <h3>
                    Periodo: {{ $datainicio }} a {{ $datafim }}
                </h3>
            </td>
        </tr>
        @foreach ( $rec as $recibo )

            <tr class="bg-1">
                <td   class="div-center semborda"  width="15%" style="height: 21px">
                    Locador: <p><b>{{ $recibo->NOMELOCADOR }}</b></p>
                </td>
                <td   class="div-center semborda" width="20%" style="height: 21px">
                    Endereço: <p><b>{{ $recibo->ENDERECOIMOVEL }}</b></p>
                </td>
                <td  class="div-center semborda" width="10%" style="height: 21px">
                    Pasta: <p><b>{{ $recibo->IMB_CTR_REFERENCIA}}</b></p>
                </td>
                <td  class="div-center semborda" width="10%" style="height: 21px">
                    ID Imóvel: <p><b>{{ $recibo->IMB_IMV_ID}}</b></p>
                </td>
                <td  class="div-center semborda"width="10%" style="height: 21px">
                    Vencimento: <p><b>{{ app('App\Http\Controllers\ctrRotinas')->formatarData( $recibo->IMB_RLD_DATAVENCIMENTO)}}</b></p>
                </td>
                <td class="div-center semborda"width="10%" style="height: 21px">
                    Pagamento: <p><b>{{ app('App\Http\Controllers\ctrRotinas')->formatarData( $recibo->IMB_RLD_DATAPAGAMENTO)}}</b></p>
                </td>
                <td  class="div-center semborda" width="30%" style="height: 21px">
                    $ Pago: <b><p>{{number_format(app('App\Http\Controllers\ctrRecibolocador')->totaldoRecibo( $recibo->IMB_RLD_NUMERO ),2,",",".")}}</b></p>
                </td>
            </tr>
            @php
                $itens = app('App\Http\Controllers\ctrRecibolocador')->itensdoRecibo( $recibo->IMB_RLD_NUMERO )
            @endphp
            @foreach ( $itens as $item)
                <tr class="semborda">
                    <td class="div-left semborda" width="20%">
                        {{ $item->IMB_TBE_NOME }}
                    </td>
                    <td class="div-right semborda" width="10%">
                        {{ number_format( $item->IMB_RLD_VALOR,2,",","." ) }}
                    </td>
                    <td class="div-center semborda" width="3%">
                        {{$item->IMB_RLD_LOCADORCREDEB}}
                    </td>
                    <td class="div-left semborda" width="20%">
                        {{$item->IMB_RLD_OBSERVACAO}}
                    </td>
                </tr>
            @endforeach

            <tr  class="semborda">
                <td class="semborda" width="15%"><hr></td>
                <td class="semborda" width="20%"><hr></td>
                <td class="semborda" width="10%"><hr></td>
                <td class="semborda" width="10%"><hr></td>
                <td class="semborda" width="15%"><hr></td>
                <td class="semborda" width="15%"><hr></td>
                <td class="semborda" width="15%"><hr></td>
            </tr>

        @endforeach



    </table>
    <center><h1>Resumo dos Repasses por Evento</h1></center><br/>
    <div class="div-center font-20">
        <table>
            <thead>
                <th>Valor Aluguel</th>
                <th>Descontos</th>
                <th>Taxa Adm.</th>
                <th>Taxa Contrato</th>
                <th>IPTU</th>
                <th>IRRF</th>
                <th>Multa Atraso</th>
                <th>Juros Atraso</th>
                <th>Correção</th>
                <th>outros</th>
                <th>Total</th>
            </thead>
            <tbody>

                @php
                    $resumoitem = app('App\Http\Controllers\ctrRecibolocador')->
                    resumoRepassadoPeriodo( $datainicio, $datafim, '','' );
                @endphp
                    <tr >
                        <td class="div-right" width="9%">{{ $resumoitem[0] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[1] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[2] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[3] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[4] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[5] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[6] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[7] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[8] }}</td>
                        <td class="div-right" width="9%">{{ $resumoitem[9] }}</td>
                        <td class="div-right" width="10%"><b>{{ $resumoitem[10] }}</b></td>
                    </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
