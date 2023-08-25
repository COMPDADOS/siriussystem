
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

    <title>Recibo Locatário {{$rec[0]->NOMELOCATARIO}}</title>
    <style>
        @page {
                margin:: 0.5cm;
        }
                
        .img-album
            {
                max-width:100%;
                width:150px;
				height:150px;            
            }

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
            .font-14
            {
                font-size:14px;
            }

            table th{
                font-size:12px;
                padding-bottom:10px;
                padding-top:10px;
                color:black;
                border: 0px;
            }            
            .table-border td
            {
                font-size:12px;
                padding-bottom:10px;
                padding-top:10px;
                color:black;
                border: 0px;
                
            }

            .table-noborder td
            {
                font-size:12px;
                padding-bottom:5px;
                padding-top:5px;
                color:black;
                border-style: none;                
            }

    </style>

</head>

<body>
			
        @php
         $qteve=0;
        @endphp
            <div class="my-5 page" size="A4" >
            @for ($i = 1; $i <= 2; $i++)
        



                @php
                    $nossonumero = $rec[0]->FIN_PCT_NOSSONUMERO;
                    $param = app( 'App\Http\Controllers\ctrRotinas')->parametros( Auth::user()->IMB_IMB_ID );
                    if(  $nossonumero )
                        $nossonumero = '- Nosso Nº: '.$nossonumero;
                    $param2 = app( 'App\Http\Controllers\ctrRotinas')->parametros2( Auth::user()->IMB_IMB_ID );
                    $codigonorecibo = $param2->IMB_PRM_CODIGOIMOVELRECIBOS;
                    if( $codigonorecibo == 'S' )
                        $pasta = $rec[0]->IMB_IMV_ID;
                    else
                        $pasta = $rec[0]->IMB_CTR_REFERENCIA;
                @endphp
                    
                @if( $param->IMB_PRM_RESUMOREPNORECTO == 'S'  and $i == 2 and $qteve > 6 )
                    <br>
                    <br>
                    <br>
                    <h6>Segunda via deste recibo na proxima folha junto com os dados para repasse</h6>
                    <div style="page-break-after: always"></div>
                @endif

                @if ($i == 2 and $param->IMB_PRM_RESUMOREPNORECTO <> 'S')
                <p>.</p>
                <p>.</p>
                <p>.</p>
                <p>.</p>
                <p>.</p>
                <p>.</p>
                @endif

                <div >
                    <section class="top-content bb d-flex justify-content-between">
                        <div class="col-xs-2 div-center">
                            <img class="img-album" src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                        </div>
                        @php
                        $creci = '';
                        if($rec[0]->IMB_IMB_CRECI <> '' ) $creci = 'Creci: '.$rec[0]->IMB_IMB_CRECI;
                        @endphp
                        <div class="top-center div-center " >
                            <h4 class="margem-zero">{{$rec[0]->IMB_IMB_NOME}}<span class="font-14"></span></h4>
                            <h5>{{ $rec[0]->CEP_BAI_NOME }}-{{ $rec[0]->CEP_CID_NOME}}({{$rec[0]->CEP_UF_SIGLA}}) - Fones:{{$rec[0]->TELEFONE }} {{$creci}}<h5>

                            <h6 class="margem-zero"><u> Recibo de Pagamento de Aluguel de Número {{$rec[0]->IMB_RLT_NUMERO}} <b>{{$nossonumero}}</b> </u></h6>
                        </div>
                        <div class="top-left div-center" >
                            <h6 altura-50>Vencimento</h6>
                            <h6 altura-50><b>{{ date("d/m/Y", strtotime($rec[0]->IMB_RLT_DATACOMPETENCIA)) }}</b></h6>
                            <h6 altura-50>Pasta: {{$pasta}}</b> </h6>
                        </div>
                    </section>
                    <section class="store-user mt-5 margem-zero">
                            <div class="row margem-zero">
                                <div class="col-md-7 ">
                                    Locatário
                                    <h5 ><b>{{$rec[0]->NOMELOCATARIO}}</b></h5>                            
                                    <h6 >
                                    Imóvel: <b> {{$rec[0]->ENDERECOIMOVEL}} - Bairro:
                                        {{$rec[0]->BAIRROIMOVEL}} - Cidade: {{$rec[0]->IMB_IMV_CIDADE}}</b></h6>

                                </div>
                                <div class="col--md5 ">
                                    Locador
                                    <h5 ><b>{{$rec[0]->NOMELOCADOR}}</b></h5>
                                    <h6>{{app('App\Http\Controllers\ctrRotinas')->pegarCondominioImovel( $rec[0]->IMB_IMV_ID )}}</h6>
                                </div>
                            </div>

                    </section>
                </div>


                <table class="detail table-border" style="width : 100%;">
                    <thead >      
                        <tr >
                            <th width="6%" style="text-align:center"> <u> Código</u> </th>
                            <th width="20%" style="text-align:center"> <u>Histórico</u> </th>
                            <th width="3%" style="text-align:center"> </th>
                            <th width="10%" style="text-align:center"> <u>Valor</u> </th>
                            <th width="51%" style="text-align:center"> <u>Observação</u> </th>
                            <th width="10%"style="text-align:center"> <u>Vencimento</u> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalrecibo = 0;
                            $tevealuguel = 'N';
                        @endphp
                        @foreach( $rec as $reg)
                        
                        <tr>
                            @php
                                $qteve  = $qteve + 1;
                                if( $reg->MAISMENOS == '-' ) 
                                    $totalrecibo = $totalrecibo - $reg->IMB_RLT_VALOR;
                                if( $reg->MAISMENOS == '+' ) 
                                    $totalrecibo = $totalrecibo + $reg->IMB_RLT_VALOR;
                                if( $reg->IMB_TBE_ID == 1 )
                                    $tevealuguel = 'S';
                            @endphp
                            <td class="altura-08" style="text-align:center">{{$reg->IMB_TBE_ID}}</td>
                            <td class="altura-08"  style="text-align:center">{{$reg->IMB_TBE_NOME}}</td>
                            <td class="altura-08" style="text-align:center">{{$reg->MAISMENOS}}</td>
                            <td class="altura-08" style="text-align:right">{{ number_format($reg->IMB_RLT_VALOR,2,",",".")}}</td>
                            <td class="altura-08" style="text-align:center"><div class="font-8">{{$reg->IMB_RLT_OBSERVACAO}}</div></td>
                            <td class="altura-08"  style="text-align:center">{{ date("d/m/Y", strtotime($reg->IMB_RLT_DATACOMPETENCIA))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
                <div class="col-md-12" >
                    <div class="row bb pb-3">
                        <div class="col-3">
                            Alugado em {{ date("d/m/Y", strtotime($reg->IMB_CTR_DATALOCACAO))}}
                        </div>
                        <div class="col-3">
                            Reajustar em {{ date("d/m/Y", strtotime($reg->IMB_CTR_DATAREAJUSTE))}}
                        </div>
                        <div class="col-3">
                            @php
                                $formapagamento =  app('App\Http\Controllers\ctrRotinas')->formaPagamento( $reg->IMB_FORPAG_ID);
                            @endphp

                            Forma Pagamento: {{$formapagamento}};

                        </div>

                        <div class="col-3">
                             <b> Recebido  R${{ number_format($totalrecibo,2,",",".")}} </b>
                        </div> 
                    </div>               
                </div>
                
                <div class="row div-center">
                    <div class="col-md-2">
                        {{ app('App\Http\Controllers\ctrRotinas')->pegarUsuarioLogado() }}
                    </div>
                    <div class="col-5">
                        <h5>{{ $rec[0]->CEP_CID_NOME }}, {{date("d/m/Y", strtotime($rec[0]->IMB_RLT_DATAPAGAMENTO))}}</h5>
                    </div>
                        
                    <div class="col-5">
                        <h5>__________________________________________________</h5>
                        <h5>{{$rec[0]->IMB_IMB_NOME}}</h5>
                    </div>
                </div>                    

                
                @if( $i == 1)
                        <br>
                    <hr>
                    <br>
                @endif
                @endfor
                @php
                    $param = app( 'App\Http\Controllers\ctrRotinas')->parametros( Auth::user()->IMB_IMB_ID );
                    $dadosrepasse='N';
                    if( $param->IMB_PRM_RESUMOREPNORECTO == 'S' )
                    {
                        $dadosrepasse='S';
                        if( $tevealuguel = 'S' )
                            $calc = app( 'App\Http\Controllers\ctrRepasse')->calcularRepasse( $rec[0]->IMB_CTR_ID, $rec[0]->IMB_RLT_DATACOMPETENCIA,  $rec[0]->IMB_RLT_DATAPAGAMENTO, 'S') ;
                        else
                            $calc = app( 'App\Http\Controllers\ctrRepasse')->calcularRepasse( $rec[0]->IMB_CTR_ID, $rec[0]->IMB_RLT_DATACOMPETENCIA,  $rec[0]->IMB_RLT_DATAPAGAMENTO, 'RLT'.$rec[0]->IMB_RLT_NUMERO ) ;
                        
                        $totalrep = 0;

                    }
                @endphp


                @if( $dadosrepasse== 'S')
                    <p><u>Dados Para Repasse</u></p>
                    <table  id="tbleventos" class="detail table-noborder" style="width : 100%;" >
                        <tbody>                
                        @foreach( $calc as $reg)
                        @php
                            if( $reg->IMB_LCF_LOCADORCREDEB == 'D' ) 
                                $totalrep = $totalrep - $reg->IMB_LCF_VALOR;
                            else
                            if( $reg->IMB_LCF_LOCADORCREDEB == 'C' ) 
                                $totalrep = $totalrep + $reg->IMB_LCF_VALOR;
                        @endphp
                        <tr class="altura-08">
                            <td  width="10%" style=" text-align:center"><div class="font-8">{{$reg->IMB_TBE_ID}}</div></td>
                            <td  width="35%" style=" text-align:center"><div class="font-8">{{$reg->IMB_TBE_NOME}}</div></td>
                            <td  width="5%"  style=" text-align:center"><div class="font-8">@if( $reg->IMB_LCF_LOCADORCREDEB == 'C') <b>+</b> @else <b>-@endif</b> </div></td>
                            <td  width="10%" style=" text-align:right">{{ number_format($reg->IMB_LCF_VALOR,2,",",".")}}</div></td>
                            <td  width="40%" style=" text-align:center"><div class="font-8">{{$reg->IMB_LCF_OBSERVACAO}}</div></td>
                        </tr>
                        <tr>
                        @endforeach
                        <td  width="10%" style=" text-align:center"><div class="font-8"></div></td>
                            <td  width="35%" style=" text-align:center"><div class="font-8">Total Repassar</div></td>
                            <td  width="5%"  style=" text-align:center"><div class="font-8"></div></td>
                            <td  width="10%" style=" text-align:right"><div><b>{{ number_format($totalrep,2,",",".")}}</b></div></td></td>
                            <td  width="40%" style=" text-align:center"></td>
                        </tr>

                        </tbody>
                @endif
            

    		</div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>
            window.print();                                
                $("#i-column1").html('NOVA COLUNA');

            
            </script>

		</body>
	</head>

    