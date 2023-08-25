
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{asset('/css/styleinvoice.css')}}">

    <title>Invoice..!</title>
    <style>
            hr.px2-blue 
            {
                border: 1px dashed blue;
            }

            .div-center
            {
                text-align:center;
            }

            div
            {
                line-height: .55;            
            }                        

            .altura-08
            {
                line-height: .55;            
            }            
            .altura-50
            {
              height: 20%;
            }          
            
            div
            {
                padding: 0px 0px 0px 0px;
            }

            .margem-zero
            {
                padding: 0px 0px 0px 0;
            }
            tr
            {
                border: 1px solid black;
                border-collapse: collapse;  
            }

            .titulo-eventos
            {
                background-color: #d3d3d3;
            }
    </style>
</head>

<body>
    <div class="my-5 page" size="A4">
        @php

            $movsbc = app( 'App\Http\Controllers\ctrLanctoCaixa')->movimentoPorSubcontas( $datini, $datfim,'D');
            $datainiformatada = app('App\Http\Controllers\ctrRotinas')->formatarData( $datini );
            $datafimformatada = app('App\Http\Controllers\ctrRotinas')->formatarData( $datfim );


        @endphp


            @foreach( $movsbc as $registro )
            <div >
                <section class="top-content bb d-flex justify-content-between">
                    <div class="logo" >
                        <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="top-center div-center " >
                        <h6 class="margem-zero"><u> Relatório de Movimentação por sub-Conta - Detalhado</u></h6>
                        <h6 class="margem-zero">Período: {{$datainiformatada}} a {{$datafimformatada}}</h6>
                        <h6>Centro de Custo: <b>{{$registro->FIN_SBC_DESCRICAO}}</b></h6>                        
                    </div>
                    <div class="top-left div-center" >
                    </div>
                </section>
            </div>
                

                @php
                    $itens = app( 'App\Http\Controllers\ctrLanctoCaixa')->movimentoDetalhadoPorSubcontas( $registro->FIN_SBC_ID, $datini, $datfim);
                @endphp
                <table class="table" >
                    <thead class="titulo-eventos">      
                        <tr >
                            <th width="20%" style="text-align:center"> <u> Data</u> </th>
                            <th width="30%" style="text-align:center"> <u>Classificação Financeira</u> </th>
                            <th width="40%" style="text-align:center"> <u>Descrição</u></th>
                            <th width="10%" style="text-align:center"> <u>Valor</u> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach( $itens as $item)
                            @php
                                $total = $total + $item->FIN_CAT_VALOR;

                            @endphp

                            <tr class="altura-08">
                                <td style="text-align:center">{{app('App\Http\Controllers\ctrRotinas')->formatarData( $item->FIN_LCX_DATAENTRADA )}}</td>
                                <td style="text-align:center">{{$item->FIN_CFC_DESCRICAO}}</td>
                                <td style="text-align:center">{{$item->FIN_LCX_HISTORICO}}</td>
                                <td style="text-align:right">{{ number_format($item->FIN_CAT_VALOR,2,",",".")}}</td>
                            </tr>
                        @endforeach
                        <tr class="altura-08">
                            <td style="text-align:center"></td>
                            <td style="text-align:center"></td>
                            <td style="text-align:center"><b>Total</b></td>
                            <td style="text-align:right">{{ number_format($total,2,",",".")}}</td>
                        </tr>
                    </tbody>
                </table>                
                <div style="page-break-after: always"></div>


            @endforeach


    </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


    <script>
         window.onafterprint = window.close;
        window.print();                                
                $("#i-column1").html('NOVA COLUNA');

            
            </script>

		</body>
	</head>

    