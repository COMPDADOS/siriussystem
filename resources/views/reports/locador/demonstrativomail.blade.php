<!DOCTYPE html>
<html>
	<head>

        <style>
hr {
border-top:3px dotted #000;
/*Rest of stuff here*/
}

.hr-contrato {
    border-top: 3px  dashed black;
}
.topics tr { 
    overflow: hidden;
    height: 10px;
    white-space: nowrap;
}
            p { margin-bottom:-15px;margin-top:-10px; }
            .row-bottom-margin { margin-bottom:-15px;margin-top:-10px; }
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


            .imovel-info
            {
                font-size: 10px;
                color:#003366;
                font-weight: bold;
            }
            .locador-info
            {
                font-size: 10px;
                color:#003366;
                font-weight: italic;
            }
            .sub-total
            {
                text-align:center;
                font-size: 12px;
                color:#003366;
                font-weight: bold;
                font-style: italic ;
            }
            .dados-bancarios
            {
                font-size: 10px;
                color:#003366;
            }
            .total-geral
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

            .titulo-relatorio
            {
                text-align:center;
                font-size: 12px;
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

            hr.px1-white{
                      border: 1px solid white;
            }

            hr.px1-black{
                      border: .5px solid black;
                      margin-bottom:-15px;margin-top:-10px;
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


            .item
            {
                text-align:center;
                font-size: 10px;
                color:black;
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
		<title>Extrato de Recebimento</title>
		<body>
			
            <div class="container">
                <div class="row row-bottom-margin">
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="col-xs-2 div-center">
                        <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                    </div>
                    <p></p>
                    <p></p>
                    <p></p>

                    <div class="col-xs-6 div-center">
                        <div class="row">
                        <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                            </p>
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                            {{$dados->TMP_PVR_TITULO1}}
                            </p>
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                            </p>
                            <p id="i-titulo" style="margin: -2;" class="titulo-relatorio" >
                            {{$dados->TMP_PVR_TITULO2}}
                            </p>
                        </div>                            
                    </div>
                </div>
                <hr class="px1-white " width="100%" >

                <p>
                    
                </p>
                <p>
                    Olá {{$nomecliente}}
                </p>
                <p>

                </p>
                <p>
                Segue  o link para você pegar seu extrato de recebimento de aluguéres para vossa conferência.
                </p>
                <p>
                    .
                </p>
                <p>
                    .
                <p><h2><a href="{{$linkdocto}}">Click aqui para ter acesso ao seu extrato</a></h2></p>
                <p>.</p>
                <p>.</p>
                <p>.</p>

                <div class="col-xs-2 div-left">
                        <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                    </div>                    
                </p>
                <p>
                    Departamento Administrativo
                </p>

                <p>
                </p>
                <p></p>
                <p>
                    Este é um email automático, por favor não responda neste email.
                </p>
    		</div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>

                $( document ).ready(function() 
                {

//                    $("#i-titulo").html('sdasddd');
  //                  console.log('passou');

                });

            
            </script>

		</body>
	</head>

