<!DOCTYPE html>
<html>
	<head>

  <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />

  <style>
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
  /* ... the rest of the rules ... */
}    
  .topics tr { line-height: 14px; }
    .div-demonstrativo {
      height: 240;
      width: 100%;
    }
    td.demonstrativo {
      height: 10px;
    }

    .absolute {
 height: 240px;
 width: 100px;
 position: absolute;
 top: 400px;
 left: 10px;
}

td.BoletoCodigoBanco {font-size: 6mm; font-family: arial, verdana; font-weight : bold;
              FONT-STYLE: italic; text-align: center; vertical-align: bottom;
              border-bottom: 0.15mm solid #000000; border-right: 0.15mm solid #000000;
              padding-bottom : 1mm}
    td.BoletoLogo-sup {   text-align: center; height: 10mm}
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
    td.itens{font-size: 2.5mm; font-family: arial, verdana; text-align: right;padding-top: 0.5mm}
    td.itens-left{font-size: 2.5mm; font-family: arial, verdana; text-align: left;padding-top: 0.5mm}
    td.itens-left-3mm{font-size: 3mm; font-family: arial, verdana; text-align: left;padding-top: 0.5mm}
    
    
              td.BoletoValorDireito{font-size: 3mm; font-family: arial, verdana; text-align:right;
              padding-right: 3mm; padding-top: 0.8mm; border-bottom: 0.15mm solid #000000;
              font-weight: bold;}
    td.BoletoTituloSacado{font-size: 2mm; font-family: arial, verdana; padding-left : 0.15mm;
              vertical-align: top; padding-top : 0.15mm; text-align: left}
    td.BoletoValorSacado{font-size: 3mm; font-family: arial, verdana;  font-weight: bold;
            text-align : left}
    td.BoletoDadosSacado{font-size: 3mm; font-family: arial, verdana;  font-weight: bold;
            text-align : left; padding-left : 20mm;}

    td.demonstrativo-center{font-size: 3mm; font-family: arial, verdana;  font-weight: bold;
            text-align : center}

    td.BoletoTituloSacador{font-size: 2mm; font-family: arial, verdana; padding-left : 0.15mm;
              vertical-align: bottom; padding-bottom : 0.8mm;
              border-bottom: 0.15mm solid #000000}
    td.BoletoValorSacador{font-size: 3mm; font-family: arial, verdana; vertical-align: bottom;
            padding-bottom : 0.15mm; border-bottom: 0.15mm solid #000000;
            font-weight: bold; text-align: left}
    td.BoletoPontilhado{border-top: 0.3mm dashed #000000; font-size: 1mm}
    td.Boletorisco{border-top: 0.3mm solid #000000; font-size: 1.5mm}
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

    .div-left
    {
      text-align:left;
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
        font-size: 10px;
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

  </style>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
  <title>Boleto</title>
	<body>


  <TABLE class=Boleto id="TABLE1" onclick="return TABLE1_onclick()">
    <TR>
      <TD style='width: 0.9cm'></TD>
      <TD style='width: 1cm'></TD>
      <TD style='width: 1.9cm'></TD>

      <TD style='width: 0.5cm'></TD>
      <TD style='width: 1.3cm'></TD>
      <TD style='width: 0.8cm'></TD>
      <TD style='width: 1cm'></TD>

      <TD style='width: 1.9cm'></TD>
      <TD style='width: 1.9cm'></TD>

      <TD style='width: 3.8cm'></TD>

      <TD style='width: 3.8cm'></TD>
      <div class="container">
      </div>
      <TR>
        <TD colspan=3 class=BoletoLogo-sup><img src="{{asset('global/img/logoboleto.jpg')}}" alt="alt-logo"></TD>
        <TD colspan=6 class=BoletoLogo-sup>           
          <p class="titulo-empresa-center " >
               {{$im->IMB_IMB_NOME}}
           </p>
           <p class="titulo-10-black" >
               {{$im->IMB_IMB_ENDERECO }}-{{ $im->CEP_CID_NOME}}({{$im->CEP_UF_SIGLA}})
           </p>
           <p  class="titulo-10-black" >{{ $im->IMB_IMB_URL}}</p>
           <p  class="titulo-10-black" >Fones:{{$im->IMB_IMB_TELEFONE1 }}- Creci: {{$im->IMB_IMB_CRECI}}</p>
        </TD>
        <TD colspan=1 class=demonstrativo-center>Vencimento <p>{{$dadosboleto["data_vencimento"]}}</p>
              <p>Valor</p>
              <p> <b>{{$dadosboleto["valor_boleto_impresso"]}}</b></p>
            </TD>
        </TD>
      </TR>
      <TR>
        <TD colspan=10 class=Boletorisco>&nbsp;</TD>
      </TR>
      <TR>
        <TD colspan=10 class=demonstrativo-center><b><u>Demonstrativo</u></b></TD>
      </TR>
    </TR>
  </TABLE>
      



  <div class="div-demonstrativo ">
    <TABLE class=Boleto>
    <TR>
      <TD style='width: 0.9cm'></TD>
      <TD style='width: 1cm'></TD>
      <TD style='width: 1.9cm'></TD>

      <TD style='width: 0.5cm'></TD>
      <TD style='width: 1.3cm'></TD>
      <TD style='width: 0.8cm'></TD>
      <TD style='width: 1cm'></TD>

      <TD style='width: 1.9cm'></TD>
      <TD style='width: 1.9cm'></TD>

      <TD style='width: 3.8cm'></TD>

      <TD style='width: 3.8cm'></TD>
      <div class="container"></div>
      </TR>

      <TR>
        <TD colspan=4  class=itens-left><b><u> Ítem</u></b></TD>
        <TD colspan=2  class=itens-left></TD>
        <TD colspan=2  class=itens><b><u>Valor</u></b></TD>
        <TD colspan=5  class=itens-left><b><u>Obervacao</u></b></TD>
      </TR>

        @foreach( $cpi as $item)
          <TR>
            <TD colspan=4 class=itens-left>{{app( 'App\Http\Controllers\ctrRotinas')->pegaNomeEvento($item->IMB_TBE_ID)}}</TD>
            <TD colspan=2  class=itens-left-3mm></TD>
            <TD colspan=2  class=itens>{{ number_format($item->IMB_LCF_VALOR, 2, ',', '.')}}
            @if( $item->IMB_RLT_LOCATARIOCREDEB == 'D' ) +
              @elseif( $item->IMB_RLT_LOCATARIOCREDEB =='C') -
              @endif
            </TD>
            <TD colspan=5  class="itens-left" >{{$item->IMB_LCF_OBSERVACAO}}</TD>
          </TR>
        @endforeach
        @php
          $param = app('App\Http\Controllers\ctrRotinas')->parametros( 1 );
        @endphp
         <TR>
          <TD colspan=10  style='demonstrativo-center'>
            <hr>
          </TD>
         </TR><TR>
          <TD colspan=10  style='demonstrativo-center'>
            <b><strong>ATENÇÃO</strong></b>
          </TD>
         </TR>
         <TR>
          <TD colspan=10  style='demonstrativo-center'>
            <b>{{$param->IMB_PRM_MENSAGEMBOLETO}}</b>
          </TD>
        </TR>
      </TABLE>
      
  
      
    
  </div>


    <TABLE class="Boleto absolute">
    <TR>
      <TD style='width: 0.9cm'></TD>
      <TD style='width: 1cm'></TD>
      <TD style='width: 1.9cm'></TD>

      <TD style='width: 0.5cm'></TD>
      <TD style='width: 1.3cm'></TD>
      <TD style='width: 0.8cm'></TD>
      <TD style='width: 1cm'></TD>

      <TD style='width: 1.9cm'></TD>
      <TD style='width: 1.9cm'></TD>

      <TD style='width: 3.8cm'></TD>

      <TD style='width: 3.8cm'></TD>
      <div class="container">
      </div>
      <tr><td colspan=11 class=BoletoPontilhado>&nbsp;</td></tr>
      <TR>
        <TD colspan=4 class=BoletoLogo><img src="{{asset('/global/img/logobanco756.png')}}"></TD>
        <TD colspan=2 class=BoletoCodigoBanco>756-0</TD>
        <TD colspan=6 class=BoletoLinhaDigitavel>{{$dadosboleto["linha_digitavel"]}}</TD>
      </TR>
      <TR>
        <TD colspan=10 class=BoletoTituloEsquerdo>Local de Pagamento</TD>
        <TD class=BoletoTituloDireito>Vencimento</TD>
      </TR>
      <TR>
        <TD colspan=10 class=BoletoValorEsquerdo style='text-align: left; padding-left : 0.1cm'>Pagavel em qualquer banco até o vencimento</TD>
        <TD class=BoletoValorDireito>{{$dadosboleto["data_vencimento"]}}</TD>
      </TR>
      <TR>
        <TD colspan=10 class=BoletoTituloEsquerdo>Cedente</TD>
        <TD class=BoletoTituloDireito>Agência/Código do Cedente</TD>
      </TR>
      <TR>
        <TD colspan=10 class=BoletoValorEsquerdo style='text-align: left; padding-left : 0.1cm'>
            {{$im->IMB_IMB_NOME}}</TD>
        <TD class=BoletoValorDireito>{{$dadosboleto["agencia"]}}/
                                    {{$dadosboleto["codigo_cliente"]}}</TD>
      </TR>
      <TR>
        <TD colspan=3 class=BoletoTituloEsquerdo>Data do Documento</TD>
        <TD colspan=4 class=BoletoTituloEsquerdo>Número do Documento</TD>
        <TD class=BoletoTituloEsquerdo>Espécie</TD>
        <TD class=BoletoTituloEsquerdo>Aceite</TD>
        <TD class=BoletoTituloEsquerdo>Data do Processamento</TD>
        <TD class=BoletoTituloDireito>Nosso Número</TD>
      </TR>
      <TR>
        <TD colspan=3 class=BoletoValorEsquerdo>{{ date( 'd/m/Y' )}}</TD>
        <TD colspan=4 class=BoletoValorEsquerdo>{{ $dadosboleto["nosso_numero_somente"] }}</TD>
        <TD class=BoletoValorEsquerdo>DM</TD>
        <TD class=BoletoValorEsquerdo>N</TD>
        <TD class=BoletoValorEsquerdo>{{ date( 'd/m/Y' )}}</TD>
        <TD class=BoletoValorDireito>{{ $dadosboleto["nosso_numero_somente"] }}</TD>
      </TR>
      <TR>
        <TD colspan=3 class=BoletoTituloEsquerdo>Uso do Banco</TD>
        <TD colspan=2 class=BoletoTituloEsquerdo>Carteira</TD>
        <TD colspan=2 class=BoletoTituloEsquerdo>Moeda</TD>
        <TD colspan=2 class=BoletoTituloEsquerdo>Quantidade</TD>
        <TD class=BoletoTituloEsquerdo>(x) Valor</TD>
        <TD class=BoletoTituloDireito>(=) Valor do Documento</TD>
      </TR>
      <TR>
        <TD colspan=3 class=BoletoValorEsquerdo>&nbsp;</TD>
        <TD colspan=2 class=BoletoValorEsquerdo>{{$dadosboleto["carteira"]}}</TD>
        <TD colspan=2 class=BoletoValorEsquerdo>R$</TD>
        <TD colspan=2 class=BoletoValorEsquerdo>&nbsp;</TD>
        <TD class=BoletoValorEsquerdo>&nbsp;</TD>
        <TD class=BoletoValorDireito>{{$dadosboleto["valor_boleto_impresso"]}}</TD>
      </TR>
      <TR>
        <TD colspan=10 class=BoletoTituloEsquerdo>Instrucão</TD>
        <TD class=BoletoTituloDireito>(-) Desconto</TD>
      </TR>
      <TR>
        <TD colspan=10 rowspan=9 class=BoletoValorEsquerdo style='text-align: left; vertical-align:top; padding-left : 0.1cm'>
            {{$dadosboleto[ "instrucoes1" ]}}<br>
            {{$dadosboleto[ "instrucoes2" ]}}<br>
            {{$dadosboleto[ "instrucoes3" ]}}<br>
            {{$dadosboleto[ "instrucoes4" ]}}<br>
            
        </TD>
        <TD class=BoletoValorDireito>&nbsp;</TD>
      </TR>
      <TR>
        <TD class=BoletoTituloDireito>(-) Outras Deduções/Abatimento</TD>
      </TR>
      <TR>
        <TD class=BoletoValorDireito>&nbsp;</TD>
      </TR>
      <TR>
        <TD class=BoletoTituloDireito>(+) Mora/Multa/Juros</TD>
      </TR>
      <TR>
        <TD class=BoletoValorDireito>&nbsp;</TD>
      </TR>
      <TR>
        <TD class=BoletoTituloDireito>(+) Outros Acréscimos</TD>
      </TR>
      <TR>
        <TD class=BoletoValorDireito>&nbsp;</TD>
      </TR>
      <TR>
        <TD class=BoletoTituloDireito>(=) Valor Cobrado</TD>
      </TR>
      <TR>
        <TD class=BoletoValorDireito>&nbsp;</TD>
      </TR>
      <TR>
        <TD rowspan=3 Class=BoletoTituloSacado>Sacado:</TD>
        <TD colspan=8 Class=BoletoDadosSacado> {{$dadosboleto["sacado"]}}</TD>
        <TD colspan=2 Class=BoletoDadosSacado>{{$dadosboleto["sacadocpf"]}} </TD>
      </TR>
      <TR>
        <TD colspan=10 Class=BoletoDadosSacado>{{$dadosboleto["endereco1"]}}</TD>
      </TR>
      <TR>
        <TD colspan=10 Class=BoletoDadosSacado>{{$dadosboleto["endereco2"]}}</TD>
      </TR>
      <TR>
        <TD colspan=2 Class=BoletoTituloSacador>Sacador / Avalista:</TD>
        <TD colspan=9 Class=BoletoValorSacador></TD>
      </TR>
      <TR>
        <TD colspan=11 class=BoletoTituloDireito style='text-align: right; padding-right: 0.1cm'>Ficha de Compensação - Autenticação Mecânica</TD>
      </TR>
      <TR>
        <TD colspan=11 height=60 valign=top><img src="data:image/png;base64,{{base64_encode( $barcode )}}"></TD>
      </TR>
      <tr><td colspan=11 class=BoletoPontilhado>&nbsp;</td></tr>
      <TR>
        <TD colspan=11 Class=BoletoValorSacado><u>Recibo de Entrega do Documento/Protocolo</u></TD>
      </TR>      
      <TR>
        <TD colspan=9 Class=BoletoValorSacado>Imóvel: {{$dadosboleto["IMB_IMV_OBJETOLOCACAO"]}}</TD>
        <TD colspan=2 Class="BoletoValorSacado div-center" >Vencimento</TD>
      </TR>      
      <TR>
        <TD colspan=9 Class=BoletoValorSacado>{{$dadosboleto["sacado"]}}</TD>
        <TD colspan=2 Class="BoletoValorSacado div-center">{{$dadosboleto["data_vencimento"]}}</TD>
      </TR>      
      <TR>
        <TD >-</TD>
      </TR>      
      <TR>
        <TD colspan=9 Class=BoletoValorSacado>Recebido por: __________________________ Em: ___/___/______</TD>
        <TD colspan=2 Class=BoletoValorSacado>Nosso Número: {{ $dadosboleto["nosso_numero"] }}</TD>
      </TR>      

    </TABLE>

    <br>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		</body>
	</head>
  <script>
        window.print();
        function TABLE1_onclick() { }
    </script>
