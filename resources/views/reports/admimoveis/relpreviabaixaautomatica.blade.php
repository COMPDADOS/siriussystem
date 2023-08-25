<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Impressao Prévia Baixa Automtica</title>
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
                    <li>impressa por: {{Auth::user()->IMB_ATD_NOME}}</li>
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
                    Retorno Bancário
                </h1>
            </td>
        </tr>
        @php
            $retornos = app( 'App\Http\Controllers\ctrCobrancaGerada')->RetornoBancarioCarga();
        @endphp

        @foreach ( $retornos as $reg )

            <tr class="bg-1">
                <td   class="div-center semborda"  width="15%" style="height: 21px">
                    Locatário: <p><b>{{ $reg->locatario }}</b></p>
                </td>
                <td   class="div-center semborda" width="20%" style="height: 21px">
                    Endereço: <p><b>{{ $reg->endereco }}</b></p>
                </td>
                <td  class="div-center semborda" width="10%" style="height: 21px">
                    Pasta: <p><b>{{ $reg->imb_ctr_referencia}}</b></p>
                </td>
                <td  class="div-center semborda" width="10%" style="height: 21px">
                    ID Imóvel: <p><b>{{ $reg->imb_imv_id}}</b></p>
                </td>
                <td  class="div-center semborda"width="15%" style="height: 21px">
                    Vencimento: <p><b>{{ app('App\Http\Controllers\ctrRotinas')->formatarData( $reg->datavencimento)}}</b></p>
                </td>
                <td class="div-center semborda"width="15%" style="height: 21px">
                    Pagamento: <p><b>{{ app('App\Http\Controllers\ctrRotinas')->formatarData( $reg->datapagamento)}}</b></p>
                </td>
                <td  class="div-center semborda" width="15%" style="height: 21px">
                    $ Pago: <p>{{$reg->valorpago}}</p>
                </td>
            </tr>
                @php
                    $itens = app('App\Http\Controllers\ctrCobrancaGerada')->cargaItensPermanenteSemJson( $reg->id );
                @endphp
                <tr class="semborda">
                    <td class="div-left semborda" width="50%">
                        <u><b>Ítems do Boleto</b></u>  
                    </td>
                    <td class="div-left semborda" width="50%">
                        <u><b>Calculados</b></u>  
                    </td>

                </tr>
                <tr class="semborda">
                    <td class="div-left semborda" width="50%">
                        @foreach ( $itens as $item)
                            <p>{{$item->IMB_TBE_NOME}} -> R$ {{$item->IMB_LCF_VALOR}}</p>
                        @endforeach

                    </td>
    
                    <td class="div-left semborda" width="50%">
                        Ítems Calculado
                    </td>
                </tr>

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
</body>
</html>
