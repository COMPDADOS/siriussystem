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
                    <div class="col-xs-2 div-left">
                        <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                    </div>
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

                <div class="row row-bottom-margin">
                        @php
                        $ctr = '';
                            $clt = '';
                            $total = 0;
                            $totalimovel = 0;
                            $totalgeral = 0;
                            $datavencimento='';
                        @endphp
                        @foreach( $recs as $rec)
                            @if( $ctr <> $rec->IMB_CTR_ID)
                                @if( $ctr <> '')
                                    <div class="row">
                                        <div class="col-xs-6 div-left sub-total">
                                            ---> Total Imóvel
                                        </div>
                                        <div class="col-xs-4 div-right sub-total">
                                            <b>R$ {{number_format($totalimovel,2,",",".")}}</b>
                                        </div>
                                    </div>
                                    <hr style="margin: -1;" >
                                    @php
                                        $totalimovel = 0;
                                        $clt = $rec->IMB_CLT_ID;
                                        $datavencimento = $rec->IMB_RLD_DATAVENCIMENTO;

                                    @endphp
                                @endif
                                <hr class="px1-black " width="100%" >
                                <div class="row">
                                    <p>.</p>
                                    <p></p>
                                    <div class="col-xs-6 div-left sub-total">
                                            Locador: {{$rec->NOMELOCADOR}}
                                    </div>
                                    <div class="col-xs-2 sub-total">
                                        Vencto: {{ date('d/m/Y', strtotime($rec->IMB_RLD_DATAVENCIMENTO))}}
                                    </div>
                                    <div class="col-xs-3 sub-total">
                                        Data Pagto: {{date('d/m/Y', strtotime($rec->IMB_RLD_DATAPAGAMENTO))}}
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-6 imovel-info">
                                        Locatário: <b>{{$rec->NOMELOCATARIO}} - CPF/CNPJ: {{$rec->CPFLOCATARIO}}</b>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-6 imovel-info">
                                        {{$rec->IMB_CTR_REFERENCIA}} ({{$rec->IMB_IMV_ID}})-{{$rec->ENDERECOIMOVEL}} - {{$rec->BAIRROIMOVEL}}

                                    </div>

                                </div>
                                @php
                                    $ctr = $rec->IMB_CTR_ID;
                                @endphp
                            @endif


                            @if( $clt <> $rec->IMB_CLT_ID or $datavencimento <> $rec->IMB_RLD_DATAVENCIMENTO)
                                    <div class="row">
                                        <div class="col-xs-10 div-left dados-bancarios">
                                            @if( strtoupper($rec->IMB_FORPAG_NOME) == 'PIX' )
                                            <b>PIX - Chave: {{$rec->IMB_IMVCLT_PIX}}</b>
                                            @elseif( $rec->IMB_FORPAG_CONTACORRENTE == 'S')
                                                <b>{{$rec->IMB_FORPAG_NOME }}</b> -
                                                {{$rec->GER_BNC_NOME}}({{$rec->GER_BNC_NUMERO}}) -
                                                Agência: {{$rec->GER_BNC_AGENCIA}}-{{$rec->GER_BNC_AGENCIADV}} -
                                                {{$rec->IMB_CLTCCR_NUMERO}}-{{$rec->IMB_CLTCCR_DV}} -
                                                {{$rec->IMB_CLTCCR_NOME}} - CPF/CNPJ: {{$rec->IMB_CLTCCR_CPF}} -
                                                @if( $rec->IMB_CLTCCR_POUPANCA =='S' )
                                                    Poupança
                                                @endif

                                            @else
                                                <b>{{$rec->IMB_FORPAG_NOME }}</b> - Cheque Nominal: {{$rec->IMB_IMV_CHEQUENOMINAL}}
                                            @endif


                                        </div>
                                    </div>

                                    @php
                                        $total = 0;
                                        $clt = $rec->IMB_CLT_ID;
                                        $datavencimento = $rec->IMB_RLD_DATAVENCIMENTO;
                                    @endphp
                            @endif
                            @php
                                if( $rec->IMB_RLD_LOCADORCREDEB == 'C' )
                                {
                                    $total = $total + $rec->IMB_RLD_VALOR ;
                                    $totalimovel = $totalimovel + $rec->IMB_RLD_VALOR ;
                                    $totalgeral = $totalgeral + $rec->IMB_RLD_VALOR ;
                                }
                                else
                                if( $rec->IMB_RLD_LOCADORCREDEB == 'D' )
                                {
                                    $total = $total - $rec->IMB_RLD_VALOR ;
                                    $totalgeral = $totalgeral - $rec->IMB_RLD_VALOR ;
                                    $totalimovel = $totalimovel - $rec->IMB_RLD_VALOR ;
                                }


                            @endphp

                            <div class="row">
                                <div class="col-xs-1 div-left item">
                                    {{$rec->IMB_TBE_ID}}
                                </div>
                                <div class="col-xs-2 div-left item">
                                    {{$rec->IMB_TBE_NOME}}
                                </div>
                                <div class="col-xs-1 div-right item">
                                    {{number_format($rec->IMB_RLD_VALOR,2,",",".")}}
                                    {{$rec->MAISMENOS}}
                                </div>
                                <div class="col-xs-6 div-left item">
                                    {{$rec->IMB_RLD_OBSERVACAO}}
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-xs-6 div-left sub-total">
                                Total Locador
                            </div>
                            <div class="col-xs-4 div-right sub-total">
                                <b>R$ {{number_format($total,2,",",".")}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 div-left sub-total">
                                ---> Total Imóvel
                            </div>
                            <div class="col-xs-4 div-right sub-total">
                                <b>R$ {{number_format($totalimovel,2,",",".")}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>

                                <hr class="px1-black " width="100%" >
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 div-left sub-total">
                                -------------------> Total Geral
                            </div>
                            <div class="col-xs-4 div-right total-geral">
                                <b>R$ {{number_format($totalgeral,2,",",".")}}</b>
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

