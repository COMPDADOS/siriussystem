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
    <link rel="stylesheet" href="{{asset('css/reports/style.css')}}">

    <title>Previsão de Repasse</title>

    <style>
        .div-center
        {
            text-align:center;
        }
        tr.demonstrativo 
        {
            padding:0px;
             height: 50%;
             font-size:12px;
        }      
        tr.imovel
        {
             height: 50%;
             font-size:12px;
             padding:0px;
        }                

        .itens{
            padding: 0px;
            text-align: center;
        }
        .alinhar-direita
        {
            text-align:right;
        }
        .font-12
        {
            font-size:12px;
        }
        table, tr, td{
            border:none;
        }        

        p
        {
            line-height: .8;
        }

        .altura-08
        {
            line-height: .85;            
        }
    </style>
</head>

<body>
    <div id="relatorio">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="" class="img-fluid">
                </div>
                <div class="top-left div-center">
                    <h5>Previsão de Repasse</h5>
                    <h6>{{$dados[0]->TMP_PVR_TITULO2}}</h6>
                    <h6>{{$dados[0]->TMP_PVR_TITULO3}}</h6>
                </div>
            </section>

            @php
                $locadores = app( 'App\Http\Controllers\ctrRepasse')->previsaoBaseGeradaLocadores($idcliente);

                $totalgeral = 0;                
            @endphp
            <section class="product-area mt-4">
                
                @foreach( $locadores as $locador )
                <p class="altura-08">
                    <hr>
                </p>
                    @php
                        $cliente = app( 'App\Http\Controllers\ctrCliente')->find($locador->IMB_CLT_IDLOCADOR);
                        if( $cliente->IMB_CLT_PESSOA = 'J')
                            $cpf = "CNPJ: ".$cliente->IMB_CLT_CPF;
                        else
                            $cpf = "CPF: ".$cliente->IMB_CLT_CPF;

                    @endphp
                <u><b>{{$locador->IMB_CLT_NOMELOCADOR}} - {{$cpf}}</b></u>
                <table style="width:100%">  
                    <tbody>

                        @php
                            $imoveis = app( 'App\Http\Controllers\ctrRepasse')->previsaoBaseGeradaImoveisLocador( $locador->IMB_CLT_IDLOCADOR);
                        @endphp
                        @php
                        $totaldolocador = 0;
                        @endphp
                        @foreach( $imoveis as $imovel )
                            <tr class="altura-08" >
                                <td   width="50%">
                                    <b><i>#ID: {{$imovel->IMB_IMV_ID}} - Pasta: {{$imovel->IMB_CTR_REFERENCIA}} {{$imovel->ENDERECOCOMPLETO}}</i></b>
                                    <p>Locatário: {{app( 'App\Http\Controllers\ctrRotinas')->nomeLocatarioPrincipal( $imovel->IMB_CTR_ID )}}</p>
                                </td>
                                <td   width="20%">Vencimento: {{ app( 'App\Http\Controllers\ctrRotinas')->formatarData($imovel->IMB_LCF_DATAVENCIMENTO)}}</td>
                                <td   width="20%">Pagar: {{ app( 'App\Http\Controllers\ctrRotinas')->formatarData($imovel->DATAPREVISAOPAGAMENTO) }}</td>
                            </tr>
                            @php
                                $itens = app( 'App\Http\Controllers\ctrRepasse')->previsaoBaseGeradaImovelLocadorVencto( $locador->IMB_CLT_IDLOCADOR, $imovel->IMB_CTR_ID, $imovel->IMB_LCF_DATAVENCIMENTO);
                            @endphp
                            <tr class="altura-08">
                                <td>
                                    <div class="font-12">
                                        <i>
                                        @if( $itens[0]->IMB_IMVCLT_PIX <> '' )
                                        <b>PIX - Chave: {{$itens[0]->IMB_IMVCLT_PIX}}</b>
                                        @elseif( $itens[0]->IMB_FORPAG_CONTACORRENTE == 'S')
                                            <b><u>{{$locador->IMB_FORPAG_NOME }}</u> </b> -
                                            {{$itens[0]->GER_BNC_NOME}}({{$itens[0]->GER_BNC_NUMERO}}) -
                                            Agência: {{$itens[0]->GER_BNC_AGENCIA}}-{{$itens[0]->IMB_BNC_AGENCIADV}} -
                                            {{$itens[0]->IMB_CLTCCR_NUMERO}}-{{$itens[0]->IMB_CLTCCR_DV}} -
                                            {{$itens[0]->IMB_CLTCCR_NOME}} - CPF/CNPJ: {{$itens[0]->IMB_CLTCCR_CPF}} -
                                            @if( $itens[0]->IMB_CLTCCR_POUPANCA =='S' )
                                                Poupança
                                            @endif

                                        @else
                                            <b><u> {{$locador->IMB_FORPAG_NOME }}</u></b> - Cheque Nominal: {{$itens[0]->IMB_IMV_CHEQUENOMINAL}}
                                        @endif
                                        </i>                                        
                                    </div>

                                </td>
                            </tr>
                            @php
                                $itens = app( 'App\Http\Controllers\ctrRepasse')->previsaoBaseGeradaImovelLocadorVencto( $locador->IMB_CLT_IDLOCADOR, $imovel->IMB_CTR_ID, $imovel->IMB_LCF_DATAVENCIMENTO);
                            @endphp
                            <table class="itens">
                                <thead>
                                    <tr class="altura-08">
                                        <td width="10%"></td>
                                        <td  width="20%">
                                        <u>Evento</u>
                                        </td>
                                        <td  width="10%">
                                            <u>Operação</u>
                                        </td>
                                        <td  width="10%" class="alinhar-direita">
                                            <u>Valor R$</u>                                            
                                        </td>
                                        <td  width="50%">
                                            
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>                            

                                    @php
                                        $ntotalimovel = 0;
                                    @endphp
                                    @foreach( $itens as $item )
                                        @php
                                            if( $item->IMB_LCF_LOCADORCREDEB == 'C') 
                                                $ntotalimovel = $ntotalimovel + $item->IMB_LCF_VALOR;
                                            if( $item->IMB_LCF_LOCADORCREDEB == 'D') 
                                                $ntotalimovel = $ntotalimovel - $item->IMB_LCF_VALOR;

                                        @endphp
                                        
                                          
                                        <tr class="demonstrativo altura-08">
                                            <td class="table-column" ></td>
                                            <td class="table-column">
                                                {{$item->IMB_TBE_NOME}}
                                            </td>
                                            <td class="table-column" width="10%">
                                                <b>
                                                    @if( $item->IMB_LCF_LOCADORCREDEB =='C' ) 
                                                        Crédito
                                                    @elseif ( $item->IMB_LCF_LOCADORCREDEB =='D' ) 
                                                        Débito
                                                    @endif
                                                </b>
                                            </td>
                                            <td class="table-column alinhar-direita" width="10%" >
                                                {{$item->IMB_LCF_VALOR}}                               
                                            </td>   
                                            <td  class="table-column" width="50%">
                                                {{$item->IMB_LCF_OBSERVACAO}}                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>        
                                <tfoot>
                                <tr class="demonstrativo">
                                    <td  width="10%"><b>Sub Total(Contrato)</b></td>
                                    <td  width="20%"></td>
                                    <td  width="10%"></td>
                                    <td  width="10%" class="alinhar-direita"><b>{{number_format($ntotalimovel,2,',','.')}}</b></td>
                                    <td  width="10%"></td>
                                    @php
                                        $totaldolocador = $totaldolocador + $ntotalimovel;
                                    @endphp
                                </tr>
                                </tfoot>
                            </table>
                        @endforeach
                        <tr>
                            <tr class="altura-08" >
                                <td   width="30%">
                                    <b><i>Total a Pagar para: {{$locador->IMB_CLT_NOMELOCADOR}}</i></b>
                                </td>
                                <td   width="20%">.</td>
                                <td   width="50%"><b><i>R$ {{ number_format($totaldolocador,2,',','.')}}</i></b></td>
                            </tr>
                        </tr>        
                        @php
                            $totalgeral = $totalgeral + $totaldolocador;
                        @endphp                    
                    </tbody>
                </table>
                <br>
                @endforeach
                <div class="row">
                    <h5>Total Geral para pagar no período: R$ {{number_format($totalgeral,2,',','.')}}</h5>
                </div>
            </section>

        </div>
    </div>
    <script>

       //     window.onafterprint = window.close;
         window.print();                
    </script>


</body>
</html>