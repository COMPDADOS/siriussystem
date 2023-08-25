<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Relatório Previsão de Recebimento Periodo</title>
    <script>
//        window.print();
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
                    Relatório de Previsão de Recebimento de Aluguéres
                </h1>
                <h3>
                    Periodo: {{$periodo}}
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
                <td class="div-center semborda"     style="height: 21px">Data Limite
                </td>
                <td class="div-center semborda"     style="height: 21px">$ Bruto
                </td>
                <td  class="div-center semborda"    style="height: 21px">$ Pontualidade
                </td>
                <td  class="div-center semborda"    style="height: 21px">$ A Pagar
                </td>

            </tr>
                @php
                    $valorlocatario            = 0;
                    $pontualidade           = 0;
                @endphp

            @foreach ( $cob as $recibo )
                @php
                    $locador = app( 'App\Http\Controllers\ctrRotinas')->proprietarioPrincipal($recibo->IMB_IMV_ID);
                @endphp

            <tr class="bg-1">
                <td   class="div-center " width="50px"   style="height: 21px">{{ $recibo->IMB_IMV_ID}}</td>
                <td   class="div-center "   style="height: 21px">{{$recibo->IMB_CTR_REFERENCIA}}</td>
                <td   class="div-center "   style="height: 21px">{{$recibo->IMB_CGR_ENDERECO}}</td>
                <td  class="div-center "    style="height: 21px">{{$recibo->IMB_CGR_DESTINATARIO}}</td>
                <td  class="div-center "    style="height: 21px">{{$locador}}</td>
                <td  class="div-center "    style="height: 21px">{{app('App\Http\Controllers\ctrRotinas')->formatarData($recibo->IMB_CGR_DATAVENCIMENTO)}}</td>
                <td class="div-center "     style="height: 21px">{{app('App\Http\Controllers\ctrRotinas')->formatarData($recibo->IMB_CGR_DATALIMITE)}}</td>   
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->IMB_CGR_VALOR, 2,',','.')}}</td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->IMB_CGR_VALORPONTUALIDADE,2,',','.')}}</td>
                <td  class="div-right "     style="height: 21px">{{number_format($recibo->IMB_CGR_VALOR-$recibo->IMB_CGR_VALORPONTUALIDADE, 2,',','.')}}</td>
            </tr>
            @php
                $valorlocatario           = $valorlocatario             + $recibo->IMB_CGR_VALOR;
                $pontualidade            = $pontualidade              + $recibo->IMB_CGR_VALORPONTUALIDADE;
            @endphp

        @endforeach
        <tr class="bg-1">
            <td   class="div-center " width="50px"   style="height: 21px"><b>TOTAIS =></b></td>
            <td   class="div-center "   style="height: 21px"></td>
            <td   class="div-center "   style="height: 21px"></td>
            <td  class="div-center "    style="height: 21px"></td>
            <td  class="div-center "    style="height: 21px"></td>
            <td  class="div-center "    style="height: 21px"> </td>
            <td  class="div-center "    style="height: 21px"> </td>
            <td  class="div-right "     style="height: 21px">{{number_format($valorlocatario,2,',','.')}}</td>   
            <td class="div-center "     style="height: 21px">{{number_format($pontualidade,2,',','.')}}</td>   
            <td  class="div-right "     style="height: 21px">{{number_format($valorlocatario-$pontualidade,2,',','.')}}</td>   
        </tr>

    </table>
    
    
</body>
</html>
