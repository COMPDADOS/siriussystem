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
            .row-detail { margin-bottom:-5px;margin-top:-5px; }
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
                        <div class="col-xs-3">
                            <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                        </div>
                        <div class="col-xs-6 div-right">
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                                </p>
                                <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                                    Extrato de Recebimento de Aluguel
                                    </p>
                                <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                                                {{$nomecliente}}
                                </p>
                                <p id="i-titulo" style="margin: -2;" class="titulo-relatorio" >
                                    Período entre {{ $datainicial}} a {{$datafinal}}
                                </p>
                    </div>
                </div>
                <hr class="px1-white " width="100%" >

                <div class="row row-bottom-margin">

                    @php
                    $totalgeral = 0;
                    @endphp
                    @foreach( $recs as $recibo )
                        @php
                            $dadosrecibo = app('\App\Http\Controllers\ctrReciboLocador')->pegarRecibo( $recibo->IMB_RLD_NUMERO,'N' );
                            $idimovel = $dadosrecibo[0]->IMB_IMV_ID;
                        @endphp
                        <hr class="px1-black " width="100%" >
                        <div class="row">
                            <div class="col-xs-12 div-left sub-total">
                                Imóvel: {{$dadosrecibo[0]->IMB_CTR_REFERENCIA}} ({{$dadosrecibo[0]->IMB_IMV_ID}})-{{$dadosrecibo[0]->ENDERECOIMOVEL}} - {{$dadosrecibo[0]->BAIRROIMOVEL}}
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-6 div-left imovel-info">
                        Locatário: <b>{{$dadosrecibo[0]->NOMELOCATARIO}} - CPF/CNPJ: {{$dadosrecibo[0]->CPFLOCATARIO}}</b>
                            </div>
                            <div class="col-xs-1 div-center imovel-info">
                                Vencimento {{ app('App\Http\Controllers\ctrRotinas')->formatarData($dadosrecibo[0]->IMB_RLD_DATAVENCIMENTO)}}
                            </div>
                            <div class="col-xs-1 div-center imovel-info">
                                Pagamento {{ app('App\Http\Controllers\ctrRotinas')->formatarData($dadosrecibo[0]->IMB_RLD_DATAPAGAMENTO)}}
                            </div>
                            <div class="col-xs-2 div-left sub-total">
                                @php
                                    $totalrecibo = app('App\Http\Controllers\ctrReciboLocador')->totaldoRecibo( $recibo->IMB_RLD_NUMERO );
                                    $totalgeral = $totalgeral + $totalrecibo;
                                @endphp
                                <b>R$ {{number_format($totalrecibo,2,",",".")}}</b>
                            </div>
                        </div>

                        @php

                            $itens = app('App\Http\Controllers\ctrReciboLocador')->itensdoRecibo( $recibo->IMB_RLD_NUMERO );
                        @endphp
                        @foreach( $itens as $item)
                        <p></p>
                        <div class="row">
                                <div class="col-xs-1 div-left item row-detail">
                                    {{$item->IMB_TBE_ID}}
                                </div>
                                <div class="col-xs-2 div-left item row-detail">
                                    {{$item->IMB_TBE_NOME}}
                                </div>
                                <div class="col-xs-2 div-right item row-detail">
                                    {{number_format($item->IMB_RLD_VALOR,2,",",".")}}
                                <b>
                                    @if( $item->IMB_RLD_LOCADORCREDEB == 'D')
                                    -
                                    @endif
                                    @if( $item->IMB_RLD_LOCADORCREDEB == 'C')
                                        +
                                    @endif
                                </b>
                                </div>
            
                                <div class="col-xs-6 div-left item row-detail">
                                    {{$item->IMB_RLD_OBSERVACAO}}
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="row row-detail">.</div>
                                <div class="col-xs-2  imovel-info">
                                    <b><i>Dados para Pagamento</i></b>                                
                                </div>
                                <div class="col-xs-10 imovel-info">
                                    @php
                                        $ppi = app( 'App\Http\Controllers\ctrPropImo')->imoveisProprietarioIMV( $idimovel, $idcliente );
                                    @endphp
                                        Banco: {{ $ppi->GER_BNC_NOME}} - Ag: {{ $ppi->GER_BNC_AGENCIA }}
                                        - {{ $ppi->GER_BNC_AGENCIADV }} - C/C: {{$ppi->IMB_CLTCCR_NUMERO}}-{{$ppi->IMB_CLTCCR_NUMERODV }}
                                        - {{$ppi->IMB_CLTCCR_NOME }} - CPF: {{$ppi->IMB_CLTCCR_CPF }}
                                </div>
                        </div>
                        <p></p>
                        <p></p>
                    @endforeach
                    <hr class="px1-black " width="100%" >
                    <div class="row">
                        <div class="row col-xs-11 itulo-relatorio div-right">
                            Total Geral: </b> R$ {{number_format($totalgeral,2,",",".")}}</b>                            
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                    <div class="row">
                        <h4>** Extrato para simples conferência **</h4>
                    </div>


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

