<!DOCTYPE html>
<html>
	<head>

  <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
  <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />

  <style>
  .topics tr { line-height: 14px; }
    .div-demonstrativo {
      height: 250;
      width: 100%;
    }
    td.demonstrativo {
      height: 10px;
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

  <div class="row row-bottom-margin">
  <div class="col-xs-2 div-center">
           <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
       </div>
       <div class="col-xs-2 div-center">
           <h3>Olá {{$dadosboleto["sacado"]}}</h3>
       </div>
       <p>

    </p>
    <p>

    </p>
    <div class="col-xs-12 titulo-10-black-left">
           Segue link para acesso ao boleto para pagamento do aluguel do imóvel que alugou em nossa imobiliária.
           Abaixo estarão os dados do boleto e para acesso na íntegra, basta clicar botão abaixo e acessá-lo.
       </div>
       <p><hr></p>
        <a href="{{ env('APP_URL')}}/boleto/gerar/{{$banconumber }}/{{ $dadosboleto['IMB_CGR_ID'] }}/N/X">
            <i class="fa fa-barcode" style="font-size:30px;color:black"></i>
        </a>

        <h3>Para maior segurança contra falsificação de boletos em PDF, disponibilizamos o link abaixo para que você possa pegar seu boleto!</h3>
        <h3>Antes de concluir o pagamento, verifique se o RECEBEDOR tem o nome da imobiliária. Caso não tenha, por favor entre em contato com a imobiliária!</h3>

        Link:
        <a href="{{ env('APP_URL')}}/boleto/gerar/{{ $banconumber }}/{{ $dadosboleto['IMB_CGR_ID'] }}/N/X">
            <i class="fa fa-barcode fa-3x" aria-hidden="true" ></i>
            <u>Click aqui para visualizar seu boleto</u>
        </a>
        </p>
        <p>
        -
        </p>

    <div class="row row-bottom-margin">
       <div class="col-xs-12 titulo-10-black-left">
        <p>
           Locatário: <b>{{$dadosboleto["sacado"]}}</b>
        </p>           
       </div>
    </div>
    <p>
        <hr>
    </p>
    <div class="row row-bottom-margin">
       <div class="col-xs-12 titulo-10-black-left">
                   Imóvel:<b> {{$imv->IMB_IMV_ENDERECOTIPO}}
                   {{$imv->IMB_IMV_ENDERECO}}  {{$imv->IMB_IMV_ENDERECONUMERO}} {{$imv->IMB_IMV_NUMAPT}}
                   {{$imv->IMB_IMV_ENDERECOCOMPLEMENTO}} Bairro: {{$imv->CEP_BAI_NOME}}
                   - Cidade: {{$imv->IMB_IMV_CIDADE}}</b>
       </div>
    </div>
    <div class="row-top-margin">
      <div class="col-xs-2 titulo-10-black-left">
          Término Contrato: <b>{{date('d/m/Y',strtotime($ctr->IMB_CTR_TERMINO))}} </b>
      </div>
      <div class="col-xs-2 titulo-10-black-left">
          Próximo Reajuste: <b> {{date('d/m/Y',strtotime($ctr->IMB_CTR_DATAREAJUSTE))}} </b>
      </div>
      <div class="col-xs-2 titulo-10-black-left">
          Nosso Número: <b>{{$dadosboleto["nosso_numero"]}}</b>
      </div>
      <div class="col-xs-2 titulo-11-black">
        @php
           $valortotal = floatval($dadosboleto["valor_boleto"]);
           $valortotal = number_format( $valortotal, 2, ',', '.');
        @endphp
        Valor Documento   : <b>R$ {{$dadosboleto["valor_boleto"]}}</b>
        <br>
        Data do Vencimento: <b>{{$dadosboleto["data_vencimento"]}}</b>

      </div>
    </div>
    <p>

    </p>
    <p>

    </p>
    <p>
      <h3>Caso já tenha sido pago este boleto, por favor desconsidere este email </h3>
    </p>
    <p>
        <h2>Este é um email automático. Por favor não respondam nele. Entre em contato direto com a imobiliária. Obrigado</h2>
    </p>


    <hr class="px2-black">



    <br>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		</body>
	</head>

