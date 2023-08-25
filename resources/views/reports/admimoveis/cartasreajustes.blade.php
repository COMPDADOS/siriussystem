<!DOCTYPE html>
<html>
	<head>

        <style>

.no-page-break {
    display: inline-block;
    width: 100%;
    page-break-inside: avoid;
 }

.hr-contrato {
    border-top: 3px  dashed black;
}
.topics tr {
    overflow: hidden;
    height: 10px;
    white-space: nowrap;
}
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
                font-size: 20px;
                color:#003366;
                font-weight: bold;

            }

            .titulo-relatorio
            {
                text-align:center;
                font-size: 20px;
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
                font-size: 14px;
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
		<title>Carta de Reajuste</title>
		<body>

            <div class="container">
                <hr class="px1-white " width="100%" >



                <div class="row row-bottom-margin">
                    @php
                        $ctr = '';
                        $clt = '';
                    @endphp

                    @foreach( $reajustados as $reajustado)
                        @php
                            $desconto='';
                            if( $reajustado->IMB_CHR_DESCONTO <> 0 )
                               $desconto = 'Conforme acordado com o locador, será concedido desconto no aluguel no valor de R$ '.number_format( $reajustado->IMB_CHR_DESCONTO,2,',','.' );
                        @endphp
                        <div class="row">
                            <div class="col-xs-12 div-center">
                                <div class="col-xs-2 div-left">
                                    <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                        <div class="row">
                                Aviso de Reajuste de Valor de Aluguel
                            <p>
                            &nbsp;
                            </p>
                            <p>
                                &nbsp;
                            </p>
                            <p>
                        
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
                                A/C: {{ $reajustado->locatario }}</b>
                            </p>
                            <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ $reajustado->ENDERECO }}
                            </p>
                            <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ $reajustado->CEP_BAI_NOMEIMOVEL }}
                            </p>
                            <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ $reajustado->IMB_IMV_ENDERECOCEP }} - {{ $reajustado->IMB_IMV_CIDADE }} - {{ $reajustado->IMB_IMV_ESTADO }}
                            </p>
                            <p>
                                &nbsp;
                            </p>
                            <p>
                                Prezado(a) Senhor(a)
                            </p>
                            <p>
                                A presente tem a finalidade de informar a V.Sa. que o aluguel do imóvel sito à <b> 
                                {{ $reajustado->ENDERECO }}</b>
                                foi reajustado para R$ {{ number_format($reajustado->IMB_CTR_VALOR,2,",",".") }} a pártir de
                                {{ date( 'd/m/Y',  strtotime("+1  days",strtotime($reajustado->IMB_CHR_DATAREAJUSTE))) }}, 
                                em conformidade com a respectiva cláusula do contrato de locação.
                            </p>
                            <p>
                                <b><i>{{$desconto}}</i></b>
                            </p>
                            <p>
                                Informamos ainda o índice utilizado foi o {{$reajustado->IMB_IRJ_NOME}}, e o percentual aplicado foi de <b>{{ number_format($reajustado->IMB_CHR_FATOR,2,",",".") }}%</b>.
                            </p>

                            <p>
                                Certos de vossa compreensão.
                            </p>

                            <p>
                                <i>Entendemos que o momento é complexo para todos, porém temos que seguir o que consta em contrato.</i>
                            </p>

                            <p>
                                Estamos a disposição em ajudar e orientar da melhor forma possível para continuarmos essa parceria.
                            </p>
                            <p>
                                Atenciosamente
                            </p>
                        </div>
                        <div class="row titulo-empresa-center">
                            <p>{{ $reajustado->IMB_IMB_NOME }}</p>
                        </div>

                        <p style="page-break-after: always;">&nbsp;</p>
                    @endforeach



                </div>



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

