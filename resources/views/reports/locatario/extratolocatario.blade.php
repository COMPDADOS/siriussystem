<!DOCTYPE html>
<html>
	<head>

  <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />

  <style>

table#eventos 
{
    border-collapse:separate;
}    

table{
 border-collapse:collapse;
 border-spacing:0 5px;

}
td.table-column > div.item {
  height: 20px;
  overflow:hidden;
  background-color: lightpink;
}
.div-demonstrativo {
      height: 200;
      width: 100%;
    }
    tr.demonstrativo {
      height: 50%;
    }

    tr.spaceUnder>td {
       padding-bottom: .5em;
  }
    td.BoletoCodigoBanco {font-size: 6mm; font-family: arial, verdana; font-weight : bold;
              FONT-STYLE: italic; text-align: center; vertical-align: bottom;
              border-bottom: 0.15mm solid #000000; border-right: 0.15mm solid #000000;
              padding-bottom : 1mm}
    td.BoletoLogo { border-bottom: 0.15mm solid #000000;  border-right: 0.15mm solid #000000;
          text-align: center; height: 10mm}
    td.BoletoLinhaDigitavel {font-size: 4 mm; font-family: arial, verdana; font-weight : bold;
                text-align: center; vertical-align: bottom;
                  border-bottom: 0.15mm solid #000000; padding-bottom : 1mm; }
    td.BoletoTituloEsquerdo{font-size: 0.2cm; font-family: arial, verdana; padding-left : 0.15mm;
              border-right: 0.15mm solid #000000; text-align: left}
    td.BoletoTituloDireito{font-size: 2mm; font-family: arial, verdana; padding-left : 0.15mm;
              text-align: left}
    td.BoletoValorEsquerdo{font-size: 3mm; font-family: arial, verdana; text-align: center;
              border-right: 0.15mm solid #000000; font-weight: bold;
              border-bottom: 0.15mm solid #000000; padding-top: 0.5mm}
    td.BoletoValorDireito{font-size: 3mm; font-family: arial, verdana; text-align:right;
              padding-right: 3mm; padding-top: 0.8mm; border-bottom: 0.15mm solid #000000;
              font-weight: bold;}
    td.BoletoTituloSacado{font-size: 2mm; font-family: arial, verdana; padding-left : 0.15mm;
              vertical-align: top; padding-top : 0.15mm; text-align: left}
    td.BoletoValorSacado{font-size: 3mm; font-family: arial, verdana;  font-weight: bold;
            text-align : left}
    td.BoletoTituloSacador{font-size: 2mm; font-family: arial, verdana; padding-left : 0.15mm;
              vertical-align: bottom; padding-bottom : 0.8mm;
              border-bottom: 0.15mm solid #000000}
    td.BoletoValorSacador{font-size: 3mm; font-family: arial, verdana; vertical-align: bottom;
            padding-bottom : 0.15mm; border-bottom: 0.15mm solid #000000;
            font-weight: bold; text-align: left}
    td.BoletoPontilhado{border-top: 0.3mm dashed #000000; font-size: 1mm}
    ul.BoletoInstrucoes{font-size : 3mm; font-family : verdana, arial}

    .p-normal { margin-bottom:0px;margin-top:0px; }
    p { margin-bottom:-15px;margin-top:-10px; }
    .row-bottom-margin { margin-bottom:-10px;margin-top:-10px; }
    .row-top-margin { margin-bottom:30px;margin-top:10px; }
    td
    {
      text-align:center;
      font-size: 10px;
      color:black;
    }
    th
    {
      text-align:center;
      font-size: 10px;
      color:black;
      font-weight: bold;
      font-style:underline;
    }

    .contrato-info
    {
      text-align:center;
      font-size: 14px;
      color:#003366;
      font-weight: bold;
    }

    .contrato-info-italic
    {
      text-align:center;
      font-size: 14px;
      color:#003366;
      font-weight: bold;
      font-style: italic ;
    }

    .titulo-empresa-center
    {
        text-align:center;
        font-size: 15px;
        color:#003366;
        font-weight: bold;

    }

    .titulo-11-black
    {
        text-align:center;
        font-size: 11px;
        color:black;

    }
    hr.px2-blue {
              border: 1px solid blue;
    }

    hr.px2-black{
              border: 1px solid black;
    }


    .titulo-11-black-italic
    {
        text-align:center;
        font-size: 11px;
        color:black;
        font-style: italic ;

    }

    .titulo-11-black-italic-left
    {
        text-align:left;
        font-size: 13px;
        color:black;
        font-style: italic ;

    }

    .titulo-12
    {
        text-align:center;
        font-size: 12px;
        color:#003366;
        font-weight: bold;

    }

    .cardtitulo-20-center
    {
        text-align:center;
        font-size: 20px;
        color:#003366;
        font-weight: bold;
    }

    .titulo-10-black-left
    {
        text-align:center;
        font-size: 8px;
        color:black;
        background-color: #e0ebeb;
    }
    .titulo-11-black
    {
        text-align:center;
        font-size: 11px;
        color:black;

    }

    .sub-titulo
    {
        text-align:center;
        font-size: 10px;
        color:#003366;
        font-weight: bold;
    }

    .sub-titulo-nome-italic-locatario
    {
        text-align:center;
        font-size: 30px;
        color:#003366;
        font-weight: bold;
        font-style: italic ;

    }

    .sub-titulo-nome-italic
    {
        text-align:center;
        font-size: 22px;
        color:#003366;
        font-weight: bold;
        font-style: italic ;

    }

    .sub-titulo-nome
    {
        text-align:center;
        font-size: 14px;
        color: black;
        font-weight: bold;

    }

    .sub-titulo-nome-italic-left
    {
        text-align:left;
        font-size: 22px;
        color:#003366;
        font-weight: bold;
        font-style: italic ;

    }

    .sub-titulo-nome-left
    {
        text-align:left;
        font-size: 14px;
        color: #003366;
        font-weight: bold;

    }

    .titulo-relatorio
    {
        text-align:center;
        font-size: 18px;
        font-weight: bold;

    }    

    .sub-titulo-imovel-left
    {
        text-align:left;
        font-size: 14px;
        color: black;
        font-weight: bold;

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

    p {
        margin: 0;
    }

    .font-10-left
    {
        font-size:10px;
        color:black;
        text-align:left;
    }

  </style>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
  <title>Extrato de Pagamento de Aluguel</title>
<body>
<div class="row row-bottom-margin">
    <div class="col-xs-2 div-left">
        <img src="{{env('APP_URL')}}/storage/images/1/logos/logoboleto.jpg" alt="alt-logo">
    </div>
    <div class="col-xs-10 div-center">
        <p style="margin: -2;" class="titulo-relatorio" >
            Extrato de Pagamento de Aluguel
        </p>
        <p style="margin: -2;">
            Locatário: {{$recibos[0]->Locatario}}
        </p>
        <p style="margin: -2;">
            Imóvel: {{$recibos[0]->endereco}}
        </p>
        <p style="margin: -2;">
            Periodo: {{app( 'App\Http\Controllers\ctrRotinas')->formatarData( $datainicio)}} a {{app( 'App\Http\Controllers\ctrRotinas')->formatarData($datafim)}}
        </p>
    </div>
</div>
<hr class="px2-blue " width="100%" >

<div class="div-demonstrativo ">


    <div class="row row-bottom-margin">
        @foreach( $recibos as $recibo )
            @php
                $dadosrecibo = app('App\Http\Controllers\ctrReciboLocatario')->pegarRecibo( $recibo->IMB_RLT_NUMERO, 'N' );
                $totalrecibo = app('App\Http\Controllers\ctrReciboLocatario')->totaldoRecibo( $recibo->IMB_RLT_NUMERO);
            @endphp
            <div class="row ">
                <div class="col-xs-6 div-left">
                    <table >
                        <thead class="thead-dark">
                            <tr >
                                <th width="50px" style="text-align:left"></th>
                                <th width="150px" class="titulo-12" style="text-align:left"> Data Vencto: <b>{{ app( 'App\Http\Controllers\ctrRotinas')->formatarData( $dadosrecibo[0]->IMB_RLT_DATACOMPETENCIA)}}</b></th>
                                <th width="150px" class="titulo-12" style="text-align:left"> Data Pagto: <b>{{ app( 'App\Http\Controllers\ctrRotinas')->formatarData( $dadosrecibo[0]->IMB_RLT_DATAPAGAMENTO)}}</b></th></th>
                                <th width="150px" class="titulo-12" style="text-align:left"> Valor Pago: <b>{{$totalrecibo}}</b> </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row ">
                <div class="col-xs-6 div-left">
                    <table >
                        <thead class="thead-dark">
                            <tr >
                                <th width="200px" style="text-align:center"> Item </th>
                                <th width="50px" style="text-align:center"> </th>
                                <th width="100px" style="text-align:right"> Valor R$</th>
                                <th width="400px" style="text-align:center"> Observação </th>
                            </tr>
                        </thead>
                        @php
                            $itens = app('App\Http\Controllers\ctrReciboLocatario')->itensdoRecibo( $recibo->IMB_RLT_NUMERO );
                        @endphp
                        @foreach( $itens as $item)

                            @php
                                $obs = $item->IMB_RLT_OBSERVACAO;
                                if( $obs == 'null' ) $obs='';
                            @endphp
                            <tr >
                                <td class="div-center">  {{$item->IMB_TBE_NOME}}</td>
                                <td class="div-center">  {{$item->MAISMENOS}}</td>
                                <td class="div-right">  {{$item->IMB_RLT_VALOR}} </td>
                                <td class="div-center">  {{$obs}} </td>
                            </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        @endforeach
    </div>

</div>

<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
</body>
</head>

