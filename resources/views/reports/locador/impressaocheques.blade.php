<!DOCTYPE html>
<html>
	<head>

  <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />

  <style>

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
        font-size: 12px;

    }
    .titulo-8
    {
        font-size: 8px;

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
    @php
        $cheque=0;
      @endphp

    @foreach( $tmp as $reg )
     
      @php
        $cheque = $cheque + 1;
        $ext = app('App\Http\Controllers\ctrRotinas')->valorExtenso( $reg->TOTALRECIBO, True );
      @endphp
    

      <table>
        <tr>
          <td width="80%"></td>
          <td>R$ {{number_format($reg->TOTALRECIBO, 2, ',', '.')}}</td>
        </tr>
''
      </table>
      <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-9 div-left titulo-8">
          {{ $ext}}
        </div>
      </div>
      <div class="row">.</div>
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10 div-left titulo-8">
            {{$reg->FAVORECIDO}}
        </div>
      </div>
      
        @if( $cheque <> 4 ) 
      @endif

    @if( $cheque == 4 ) 

        <div style="page-break-after: always"></div>
        @php
          $cheque = 0;
        @endphp
        
    @endif

    @endforeach
   
    <br>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		</body>
	</head>

