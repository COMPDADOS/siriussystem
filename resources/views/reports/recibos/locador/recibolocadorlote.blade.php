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
                color:black;
            }
    </style>
</head>

<body>
    
        @foreach( $recibos as $recibo)
                @php
                    $rec = app( 'App\Http\Controllers\ctrReciboLocador')->pegarRecibo( $recibo->IMB_RLD_NUMERO, 'N' );
                @endphp
        <div class="my-5 page" size="A4">
            @for ($i = 1; $i <= 2; $i++)
                @if( $i == 2 )    
                    <hr class="px2-blue " width="100%" >
                @endif

                <div >
                    <section class="top-content bb d-flex justify-content-between">
                        <div class="logo" >
                            <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="top-center div-center " >
                            <h4 class="margem-zero">{{$rec[0]->IMB_IMB_NOME}}</h4>
                            <h6 class="margem-zero">{{$rec[0]->ENDERECO }}-{{ $rec[0]->CEP_BAI_NOME }}-{{ $rec[0]->CEP_CID_NOME}}({{$rec[0]->CEP_UF_SIGLA}})</h6>
                            <h6 class="margem-zero">{{ $rec[0]->IMB_IMB_URL}}</h6>
                            <h6 class="margem-zero">Fones:{{$rec[0]->TELEFONE }}- Creci: {{$rec[0]->IMB_IMB_CRECI}}</h6>
                            <h6 class="margem-zero">Recibo de Pagamento de Aluguel de Número {{$rec[0]->IMB_RLD_NUMERO}}</h6>
                        </div>
                        <div class="top-left div-center" >
                            <h6 altura-50>Vencimento</h6>
                            <h6 altura-50><b>{{ date("d/m/Y", strtotime($rec[0]->IMB_RLD_DATAVENCIMENTO)) }}</b></h6>
                            <h6 altura-50>Pasta</h6>
                            <h6 altura-50><b> {{$rec[0]->IMB_CTR_REFERENCIA}}</b> </h6>
                        </div>
                    </section>
                    <section class="store-user mt-5">
                            <div class="row">
                                <div class="col-md-7 ">
                                    Locador
                                    <h5 ><b>{{$rec[0]->NOMELOCADOR}}</b></h5>
                                    <h6 >
                                    Imóvel: <b> {{$rec[0]->ENDERECOIMOVEL}} - Bairro:
                                        {{$rec[0]->BAIRROIMOVEL}} - Cidade: {{$rec[0]->IMB_IMV_CIDADE}}</b></h6>

                                </div>
                                <div class="col--md5 ">
                                    Locatário
                                    <h5 ><b>{{$rec[0]->NOMELOCATARIO}}</b></h5>                            
                                </div>
                            </div>

                    </section>

                    <section class=" mt-4">
                        <table class="table ">
                            <thead>
                                <tr class="titulo-eventos">
                                    <td width="6%" style="text-align:center"> <b><i>Código</i></b>  </td>
                                    <td width="20%" style="text-align:center"> <b><i>Histórico</i></b> </td>
                                    <td width="3%" style="text-align:center"> </td>
                                    <td width="10%" style="text-align:center"> <b><i>Valor</i></b> </td>
                                    <td width="51%" style="text-align:center"> <b><i>Observação</i></b> </td>
                                    <td width="10%"style="text-align:center"> <b><i>Vencimento</i></b> </td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $itens = app( 'App\Http\Controllers\ctrReciboLocador')->itensdoRecibo( $recibo->IMB_RLD_NUMERO);
                                @endphp
                                @foreach( $itens as $item )
                                <tr  class="altura-08" >
                                    @php
                                        $obs = $item->IMB_RLD_OBSERVACAO;
                                        if( $obs == "null") $obs='-';
                                    @endphp
                                    <td style="text-align:center">{{$item->IMB_TBE_ID}}</td>
                                    <td style="text-align:center">{{$item->IMB_TBE_NOME}}</td>
                                    <td style="text-align:center">{{$item->IMB_RLD_LOCADORCREDEB}}</td>
                                    <td style="text-align:right">{{ number_format($item->IMB_RLD_VALOR,2,",",".")}}</td>
                                    <td style="text-align:center">{{$obs}}</td>
                                    <td style="text-align:center">{{ date("d/m/Y", strtotime($item->IMB_RLD_DATAVENCIMENTO))}}</td>
                                </tr>
                                @endforeach                        
                            </tbody>
                        </table>
                    </section>

                    <section class="balance-info">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="row bb pb-3">
                                    <div class="col-3">
                                        @php
                                            $totalrecibo = app( 'App\Http\Controllers\ctrReciboLocador')->totaldoRecibo( $recibo->IMB_RLD_NUMERO);
                                        @endphp
                                        <h6>Alugado em</h6>
                                        <h6><b>{{ date("d/m/Y", strtotime($rec[0]->IMB_CTR_DATALOCACAO))}}</b></h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>Reajustar em </h6>
                                        <h6><b>{{ date("d/m/Y", strtotime($rec[0]->IMB_CTR_DATAREAJUSTE))}}</b></h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>$ Pago</h6>
                                        <h6><b>R${{ number_format($totalrecibo,2,",",".")}}</b></h6>
                                    </div>
                                    <div class="col-3">
                                    @php
                                        $ppi =  app('App\Http\Controllers\ctrPropImo')
                                        ->imoveisProprietarioIMV( $rec[0]->IMB_IMV_ID, $rec[0]->IMB_CLT_ID,  );
                                        if( $ppi <> '' )
                                        {
                                        @endphp
                                        <h6><b><u>Dados para Pagamento</u></b></h6>
                                        <h6>
                                            Banco: {{ $ppi->GER_BNC_NOME}} - Ag: {{ $ppi->GER_BNC_AGENCIA }}
                                            - {{ $ppi->IMB_BNC_AGENCIADV }} - C/C: {{$ppi->IMB_CLTCCR_NUMERO}}-{{$ppi->IMB_CLTCCR_DV }}
                                            - {{$ppi->IMB_CLTCCR_NOME }} - CPF: {{$ppi->IMB_CLTCCR_CPF }}
                                        </h6>
                                    @php
                                    }
                                    @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row div-center">
                            <div class="col-12">
                                <h5>{{ $rec[0]->CEP_CID_NOME }}, {{date("d/m/Y", strtotime($rec[0]->IMB_RLD_DATAPAGAMENTO))}}</h5>
                                <h5>__________________________________________________</h5>
                            </div>
                        </div>                    
                    </section>
                </div>
            @endfor
            <div style="page-break-after: always"></div>
        </div>
    </div>
    @endforeach


    <script>
        window.onafterprint = window.close;
        window.print();                
    </script>








</body></html>