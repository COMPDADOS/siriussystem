<!DOCTYPE html>
<html>
	<head>

  <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />

        <style>

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


         p { margin-bottom:-15px;margin-top:-10px; }
            .row-bottom-margin { margin-bottom:-10px;margin-top:-10px; }
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

            .titulo-10-black
            {
                text-align:center;
                font-size: 10px;
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
      <div class="container">


       </div>


  <tr><td colspan=11 class=BoletoPontilhado>&nbsp;</td></tr>
  <TR>
    <TD colspan=4 class=BoletoLogo><img src="{{asset('/global/img/logosantander.png')}}"></TD>
    <TD colspan=2 class=BoletoCodigoBanco>033-7</TD>
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
                                 {{$dadosboleto["conta"]}}-
                                 {{$dadosboleto["conta_dv"]}}</TD>
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
    <TD colspan=4 class=BoletoValorEsquerdo>{{ $dadosboleto["numero_documento"] }}</TD>
    <TD class=BoletoValorEsquerdo>RC</TD>
    <TD class=BoletoValorEsquerdo>N</TD>
    <TD class=BoletoValorEsquerdo>{{ date( 'd/m/Y' )}}</TD>
    <TD class=BoletoValorDireito>{{ $dadosboleto["nosso_numero"] }}</TD>
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
    <TD class=BoletoValorDireito>{{$dadosboleto["valor_boleto"]}}</TD>
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
    <TD class=BoletoTituloDireito>(-) Outras Dedu��es/Abatimento</TD>
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
    <TD class=BoletoTituloDireito>(+) Outros Acr�scimos</TD>
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
    <TD colspan=8 Class=BoletoValorSacado> {{$dadosboleto["sacado"]}}</TD>
    <TD colspan=2 Class=BoletoValorSacado>{{$dadosboleto["sacadocpf"]}} </TD>
  </TR>
  <TR>
    <TD colspan=10 Class=BoletoValorSacado>{{$dadosboleto["endereco1"]}}</TD>
  </TR>
  <TR>
    <TD colspan=10 Class=BoletoValorSacado>{{$dadosboleto["endereco2"]}}</TD>
  </TR>
  <TR>
    <TD colspan=2 Class=BoletoTituloSacador>Sacador / Avalista:</TD>
    <TD colspan=9 Class=BoletoValorSacador></TD>
  </TR>
  <TR>
    <TD colspan=11 class=BoletoTituloDireito style='text-align: right; padding-right: 0.1cm'>Ficha de Compensa��o - Autentica��o Mec�nica</TD>
  </TR>
  <TR>
    <TD colspan=11 height=60 valign=top><img src="data:image/png;base64,{{base64_encode( $barcode )}}"></TD>
  </TR>
  <tr><td colspan=11 class=BoletoPontilhado>&nbsp;</td></tr>
  </TABLE>

  <br>
  <div class="row row-bottom-margin">
               <div class="col-xs-2 div-left">
                   <img src="{{ env('APP_URL') }}/storage/images/1/logos/logoboleto.jpg" alt="alt-logo">
               </div>
               <div class="col-xs-6 div-center">
                   <p style="margin: -2;" class="titulo-empresa-center " >
                       {{$im->IMB_IMB_NOME}}
                   </p>
                   <p style="margin: -2;" class="titulo-10-black" >
                       {{$im->IMB_IMB_ENDERECO }}-{{ $im->CEP_BAI_NOME }}-{{ $im->CEP_CID_NOME}}({{$im->CEP_UF_SIGLA}})
                   </p>
                   <p style="margin: -2;" class="titulo-10-black" >{{ $im->IMB_IMB_URL}}</p>
               </div>
               <div class="col-xs-3 div-center">
                   <p style="margin: -2;">Vencimento</p>
                   <p style="margin: -2;"><span class="sub-titulo-nome">
                   {{$dadosboleto["data_vencimento"]}}</span></p>
                   <p style="margin: -2;">Contrato</p>
                   <p style="margin: -2;"><span class="sub-titulo-nome">{{$ctr->IMB_CTR_REFERENCIA}} </span></p>

               </div>
           </div>
           <hr class="px2-blue " width="100%" >
           <div class="row row-bottom-margin">
               <div class="col-xs-12 sub-titulo-nome-left">
                   Cliente: <span class="titulo-11-black-italic">{{$dadosboleto["sacado"]}}</span>
               </div>
           </div>
           <hr>
           <div class="row row-bottom-margin">
               <div class="col-xs-12 sub-titulo-nome-left">
                           Produto: <span class="titulo-11-black-italic">Software Apoio Administração de Imóveis</span>
               </div>
           </div>
           <hr class="px2-black">

           <table  id="tbleventos" class="table table-striped table-bordered table-hover topics" >
               <thead class="thead-dark">
                   <tr >
                       <th width="6%" style="text-align:center"> Código </th>
                       <th width="20%" style="text-align:center"> Histórico </th>
                       <th width="3%" style="text-align:center"> </th>
                       <th width="10%" style="text-align:center"> Valor </th>
                       <th width="61%" style="text-align:center"> Observação </th>
                   </tr>
               </thead>
               <tbody>

                  @foreach( $cpi as $item)
                    <tr>
                      <td>{{$item->IMB_TBE_ID}}</td>
                      <td>{{$item->IMB_TBE_DESCRICAO}}</td>
                      <td>{{$item->IMB_RLT_LOCATARIOCREDEB}}</td>
                      <td>R$ {{ number_format($item->IMB_LCF_VALOR, 2, ',', '')}}</td>
                      <td>{{$item->IMB_LCF_OBSERVACAO}}</td>
                    </tr>
                  @endforeach
               </tbody>
           </table>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		</body>
	</head>

