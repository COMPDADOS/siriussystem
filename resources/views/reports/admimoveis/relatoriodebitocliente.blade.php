<!DOCTYPE html>
<html>
	<head>

        <style>
            .conteudo-detalhe
            {
                font-size:18px;
            }

            .imovel-info
            {
                font-size: 10px;
                color:#003366;
                font-weight: bold;
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
		<title>Relatório de Débitos de Clientes</title>
		<body>


            <div class="container">
                <div class="row row-bottom-margin">
                    <div class="col-xs-6 div-center">
                        <div class="row">
                            <p id="titulo-empresa-center" style="margin: -2;" class="titulo-empresa-center " >
                                {{ $imb->IMB_IMB_NOME }}
                            </p>
                            <p>
                                &nbsp;
                            </p>
                            <p id="titulo-empresa-center" style="margin: -2;" class="titulo-empresa-center " >
                                Relatório de Débitos
                            </p>
                            <p id="titulo-empresa-center" style="margin: -2;" class="titulo-empresa-center " >
                                {{ $locatario }}
                            </p>
                            <p id="titulo-empresa-center" style="margin: -2;" class="titulo-empresa-center " >
                                {{ $enderecoimovel }}
                            </p>

                        </div>

                    </div>
                </div>
                <hr>
                <hr class="px1-white " width="100%" >

                    @php
                        $ctr = '';
                        $clt = '';
                        $total = 0;
                        $totalgeral = 0;
                        $dados = app('App\Http\Controllers\ctrRotinas')->pegarVencimentosDebitoTMPDetail($idcontrato);
                    @endphp
                    @foreach ($dados as $dado)
                        @php
                            $vencimento = $dado->DATAVENCIMENTO;
                            $details = app('App\Http\Controllers\ctrRotinas')->
                                pegarDetalheDebitoTMPDetail( $idcontrato, $vencimento);
                            $total = 0;
                        @endphp
                        <div class="row">
                            <div class="col-xs-10 div-center">
                                <table class="table-striped conteudo-detalhe">
                                    <thead>
                                        <th width="200px"><u>Evento</th>
                                        <th width="500px"><u>Observação</u></th>
                                        <th width="100px" class="div-right"><u>Valor</u></th>
                                        <th width="100px" class="div-right"><u>Multa</u></th>
                                        <th width="100px" class="div-right"><u>Juros</u></th>
                                        <th width="150px" class="div-right"><u>Total</u></th>

                                    </thead>
                                    <body>

                                    @foreach( $details as $detail)
                                        @if ($loop->last)
                                            <div class="row">
                                                <div class="col-xs-6 div-center">
                                                    <b><u>Vencimento {{date('d/m/Y',strtotime($dado->DATAVENCIMENTO))}}</u></b>
                                                </div>
                                            </div>
                                        @endif

                                        <tr>
                                            <td>{{$detail->IMB_TBE_NOME}}</td>
                                            <td>{{$detail->IMB_TBE_OBSERVACAO}}</td>
                                            <td class="div-right">{{number_format($detail->TMP_VALOR,2,",",".")}}</td>
                                            <td class="div-right">{{number_format($detail->MULTA,2,",",".")}}</td>
                                            <td class="div-right">{{number_format($detail->JUROS,2,",",".")}}</td>
                                            <td class="div-right">{{number_format($detail->TOTALREGISTRO,2,",",".")}}</td>
                                        </tr>
                                        @php
                                            if( $detail->MAISMENOS =='+')
                                            {
                                                $total = $total + $detail->TOTALREGISTRO;
                                                $totalgeral = $totalgeral + $detail->TOTALREGISTRO;
                                            }
                                            else
                                            if( $detail->MAISMENOS =='-')
                                            {
                                                $total =      $total + $detail->TOTALREGISTRO;
                                                $totalgeral = $totalgeral + $detail->TOTALREGISTRO;
                                            }
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td><b>Total do vencimento ---></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="div-right"><b>{{number_format($total,2,",",".")}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><hr></td>
                                        <td><hr></td>
                                        <td><hr></td>
                                        <td><hr></td>
                                        <td><hr></td>
                                        <td><hr></td>
                                    </tr>

                                </body>


                            </div>
                        </div>
                    @endforeach
                    <tr>
                        <td><b>TOTAL GERAL</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="div-right"><b>R$ {{number_format($totalgeral,2,",",".")}}</b></td>
                    </tr>
                </table>

                </div>

    		</div>


            <script>

                $( document ).ready(function()
                {

                });


            </script>

		</body>
	</head>

