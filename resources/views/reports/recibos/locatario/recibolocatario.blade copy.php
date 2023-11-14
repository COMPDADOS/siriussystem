<!DOCTYPE html>
<html>
	<head>

        <style>

.topics tr {
    overflow: hidden;
    height: 7px;
    white-space: nowrap;
}
hr.dashed-vencimento
        {
            border-top: 1px dotted red;
        }

            p { margin-bottom:-15px;margin-top:-10px; }
            .row-bottom-margin { margin-bottom:-15px;margin-top:-10px; }
            .p-equilibrado { margin-bottom:-10px;margin-top:-10px; }
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


            .contrato-info
            {
                text-align:center;
                font-size: 14px;
                color:#003366;
                font-weight: bold;
            }

            .nomes-locador-locatario
            {
                text-align:left;
                font-size: 13px;
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
                text-align:center;
                font-size: 12px;
                color:#003366;
                font-weight: bold;

            }

            .informacoes
            {
                text-align:left;
                font-size: 10px;
                color:#003366;

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

            .font-8
            {
                font-size:8;
            }

        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
        
        
		<title>Recibo Locatário </title>
		<body>
            @php
             $qteve=0;
            @endphp

            <div class="container">
            @for ($i = 1; $i <= 2; $i++)


                <div class="row row-bottom-margin">
 
                    <div class="col-xs-2 div-left">
                    <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                    </div>
                    @php
                            $imb = app('App\Http\Controllers\ctrImobiliaria')->pegarImobiliaria( Auth::user()->IMB_IMB_ID );
                        @endphp

                    <div class="col-xs-6 div-center">
                        <p style="margin: -2;" class="titulo-empresa-center " >
                            {{$imb->IMB_IMB_NOME}}
                        </p>
                        <p style="margin: -2;" class="titulo-10-black" >
                        @php
                                $endereco = app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $rec[0]->IMB_IMV_ID);
                                $param2 = app( 'App\Http\Controllers\ctrRotinas')->parametros2( Auth::user()->IMB_IMB_ID );
                                $codigonorecibo = $param2->IMB_PRM_CODIGOIMOVELRECIBOS;
                                if( $codigonorecibo == 'S' )
                                    $pasta = $rec[0]->IMB_IMV_ID;
                                else
                                    $pasta = $rec[0]->IMB_CTR_REFERENCIA;
                            @endphp
                        </p>
                        <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_ENDERECO}} - {{ $imb->CEP_BAI_NOME}} - {{ $imb->CEP_CID_NOME}}-{{ $imb->CEP_UF_SIGLA}} </p>
                        <p style="margin: -2;" class="titulo-10-black" >Fones:{{$imb->TELEFONE }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                        <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_URL}} - Email: {{$imb->IMB_IMB_EMAIL}} </p>
                        <p style="margin: -2;" class="titulo-12" >
                            Recibo de Pagamento de Aluguel de Número {{$rec[0]->IMB_RLT_NUMERO}}
                        </p>
                        <p>
                        </p>
                    </div>
                    <div class="col-xs-3 div-center">
                        <p style="margin: -2;">Vencimento</p>
                        <p style="margin: -2;"><span class="sub-titulo-nome">
                        {{ date("d/m/Y", strtotime($rec[0]->IMB_RLT_DATACOMPETENCIA)) }}</span></p>
                        <p style="margin: -2;">Pasta</p>
                        <p style="margin: -2;"><span class="sub-titulo-nome">{{$pasta}} </span></p>

                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-5 div-left contrato-info" >
                        Locador: <span class="nomes-locador-locatario" >
                        {{$rec[0]->NOMELOCADOR}}</span>
			        </div>
                    <div class="col-xs-5 div-left contrato-info" >
                            Locatário: <span class="nomes-locador-locatario"  >
                                {{$rec[0]->NOMELOCATARIO}}</span>
        	        </div>

			    </div>
                <div class="row ">
                    <div class="col-xs-12">
                        <div class="col-xs-12 div-left contrato-info">
                                Imóvel: <span class="nomes-locador-locatario">{{$endereco}}</span>
			            </div>
                    </div>
                </div>

                <table  id="tbleventos" class="table table-condensed table-hover table-bordered table-striped" >
                    <thead class="thead-dark">
                        <tr>
                            <th width="6%" style="text-align:center"> Código </th>
                            <th width="20%" style="text-align:center"> Histórico </th>
                            <th width="3%" style="text-align:center"> </th>
                            <th width="10%" style="text-align:center"> Valor </th>
                            <th width="51%" style="text-align:center"> Observação </th>
                            <th width="10%"style="text-align:center"> Vencimento </th>
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
                            $obs = $reg->IMB_RLT_OBSERVACAO;
                            if( $obs == "null") $obs='-';
                            @endphp
                            <td style="text-align:center">{{$reg->IMB_TBE_ID}}</td>
                            <td style="text-align:center">{{$reg->IMB_TBE_NOME}}</td>
                            <td style="text-align:center">{{$reg->MAISMENOS}}</td>
                            <td style="text-align:right">{{ number_format($reg->IMB_RLT_VALOR,2,",",".")}}</td>
                            <td style="text-align:center">{{$obs}}</td>
                            <td style="text-align:center">{{ date("d/m/Y", strtotime($reg->IMB_RLT_DATACOMPETENCIA))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row row-bottom-margin">
                    <div class="col-xs-2 informacoes  " >
                        Alugado em {{ date("d/m/Y", strtotime($reg->IMB_CTR_DATALOCACAO))}}
                    </div>
                    <div class="col-xs-2 informacoes " >
                            Reajustar em {{ date("d/m/Y", strtotime($reg->IMB_CTR_DATAREAJUSTE))}}
                    </div>
                    <div class="col-xs-2 informacoes " >
                        @php
                            $formapagamento =  app('App\Http\Controllers\ctrRotinas')->formaPagamento( $reg->IMB_FORPAG_ID);
                        @endphp

                        Forma : {{$formapagamento}}
                    </div>
                    <div class="col-xs-4 contrato-info" >
                        $ Recebido: R${{ number_format( $totalrecibo,2,",",".")}}
                    </div>

                </div>
                <br>
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
                @if( $i == 1 )
                    <p>.</p>
                    <p><hr class="hr.dashed-vencimento"></p>
                @endif
                
                @endfor

    		</div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>
                $("#i-column1").html('NOVA COLUNA');

            </script>

		</body>
	</head>

