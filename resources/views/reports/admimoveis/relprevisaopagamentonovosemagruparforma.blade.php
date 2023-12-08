<!DOCTYPE html>
<html>
	<head>
        <style>

            hr.separadorcontrato {
                border-top: 1px dotted red;
            }

            hr.separadorcliente {
                border-top: 2px dotted red;
            }

            hr.separadorforma {
                 border-top: 1px dashed red;
            }            
            .div-recibo {
                height: 45%;
                width: 100%;
                }

            .no-space
            {
                padding: 0 0 0 0;
            }
            .semborda
                    {
                        border:0;
                    }

            .borda-1
            {
                border:1;
            }
            .divTable {
                display: table;
                width: 100%;
                padding: 0px;

            }

            .divTableRow {
                display: table-row;
                padding: 0px;
                

            }
            .divTableRowBorda {
                display: table-row;
                border:1;
                padding: 0px;
                

            }

            .divTableHeading {
                background-color: #eee;
                display: table-header-group;
            }

            .divTableCell,
            .divTableHead {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                border:0;

            }

            .divTableCellLogo,
            .divTableHead {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 20%;
                border:0;

            }

            .divTableCellDadosEmpresa,
            .divTableHead {
                border: 1px solid #999999;
                display: table-cell;
                padding: 3px 10px;
                width : 80%;
                border:0;

            }
            .divTableCellNomes,
            .divTableHead {
                border: 1px solid #999999;
                display: table-cell;
                padding: 5px;
                width : 50%;
                border:1;

            }

            .divTableCellUSUARIO
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 20%;
                border:0;
                font-size:9px;
                text-align:left;

            }
            .divTableCell80
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px 0px 0px ;
                width : 80%;
                border:0;
                font-size:11px;
                text-align:left;

            }

            .divTableCellDadosConta
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px 0px 0px;
                width : 100%;
                border:0;
                font-size:11px;
                text-align:center;

            }
            .divTableCell20
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px 0px 0px;
                width : 20%;
                border:0;
                font-size:11px;
                text-align:left;

            }
            .divTableCellImovel
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 100%;
                border:.5;
                font-size:12px;
                text-align:left;

            }




            .divTableCellASSINATURADATA
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 40%;
                border:0;
                font-size:9px;
                text-align:center;

            }
            .divTableImovel
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 100%;
                border:0;
                font-size:12px;
                text-align:center;

            }

            .divTableCellASSINATURAIMOB
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 40%;
                border:0;
                font-size:9px;
                text-align:center;

            }




            .divTableCell10Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 10%;
                font-size:9px;
            }
            .divTableCell20Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 20%;
                font-size:9px;
            }
            .divTableCell30Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 30%;
                font-size:9px;
            }
            .divTableCell40Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 40%;
                font-size:9px;
            }

            .divTableCell50Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 50%;
                font-size:9px;
            }


            .divTableCellTBE_ID
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 6%;
                border:.5;
                text-align:center;
                font-style:underline;    
                font-size:9px;

            }

            .divTableCellTBE_NOME
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 20%;
                border:.5;
                font-size:9px;
                text-align:center;


            }
            .divTableCellLCF_LOCADORCREDEB
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 3%;
                border:.5;
                font-size:9px;
                text-align:center;


            }

            .divTableCellLCF_VALOR
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 10%;
                border:.5;
                font-size:9px;
                text-align:center;

            }
            .divTableCellLCF_OBSERVACAO
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 51%;
                border:.5;
                text-align:center;
                font-size:9px;

            }
            .divTableCellLCF_DATAVENCIMENTO
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 10%;
                border:.5;
                font-size:9px;
                text-align:center;

            }
                                    


            .divTableCellEndereco
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px;
                width : 100%;
                border:1;
                font-weight: bold;

            }

            .divTableCellLocatario
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px;
                width : 25%;
                border: .5;
                font-weight: bold;

            }
            .divTableCellImovelPasta
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px;
                width : 45%;
                border:.5;
                font-weight: bold;

            }

            .divTableCellVencimento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px;
                width : 15%;
                border:.5;
                font-weight: bold;
            }
            .divTableCellValor
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px;
                width : 15%;
                border:.5;
                font-weight: bold;
            }

            .divTableCellDataVencimento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px 0px;
                width : 15%;
                border:.5;
                font-weight: bold;
            }

            .divTableHeading {
                background-color: #eee;
                display: table-header-group;
                font-weight: bold;
                border:0;

            }

            .divTableFoot {
                background-color: #eee;
                display: table-footer-group;
                font-weight: bold;
                border:0;

            }

            .divTableBody {
                display: table-row-group;
                border:0;

            }

            .divTableCellPagamento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 15%;
                border:0;
                font-size:10px;
                text-align:left;
            }


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
                font-size: 12px;
                color:#003366;
                
            }

            .titulo-movimento
            {
                font-size: 12px;
                font-style:underline;

                
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
            .font-11
            {
                font-size:11;
            }

        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
        
        
		<title>Previsao Repasse </title>
		<body>
            @php
             $qteve=0;
             
            @endphp
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow semborba">
                        <div class="divTableCellLogo">
                            <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                        </div>
                        @php
                            $imb = app('App\Http\Controllers\ctrImobiliaria')->pegarImobiliaria( Auth::user()->IMB_IMB_ID );
                        @endphp
                        <div class="divTableCellDadosEmpresa">
                        @php
                            $formas = app('App\Http\Controllers\ctrRepasse')->distinctBaseGeradaForma();
                            $titulo = $formas[0]->TMP_PVR_TITULO2;
                            $totalgeral = 0;
                            $entrou='';
                        @endphp                            
                            
                            <p style="margin: -2;" class="titulo-10-black" >{{$imb->IMB_IMB_NOME}}</p>
                            <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_URL}}</p>
                            <p style="margin: -2;" class="titulo-10-black" >Fones:{{$imb->TELEFONE }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                            <p style="margin: -2;" class="titulo-10-black" >{{$imb->IMB_IMB_URL}} </p>
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >Extrato de Previsão de Repasses</p>
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >{{$titulo}} - Sem Agrupamento na Forma</p>
                        </div>
                    </div>
                </div>                        
            </div>


                @php
                    $clientesgrupo = app('App\Http\Controllers\ctrRepasse')->distinctBaseGeradaFormaCliente(1 );
                    $totalforma = 0;
                @endphp
                @foreach( $clientesgrupo as $clientegrupo)
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow semborba">
                                Locador: <b>{{$clientegrupo->IMB_CLT_NOMELOCADOR}}
                            </div>
                        </div>
                    </div>

                    @php
                        $clientesforma = app('App\Http\Controllers\ctrRepasse')->distinctBaseGeradaRepassesClienteForma( 1, $clientegrupo->IMB_CLT_IDLOCADOR);
                        $totalcliente = 0;
                        $entrou='1';

                    @endphp
                    @foreach( $clientesforma as $clienteforma )
                        @php
                            $tipoconta = '';
                            $tipodocumento = '';
                            $correntista = $clientegrupo->IMB_CLT_NOMELOCADOR;
                            if( $clienteforma->IMB_CLTCCR_PESSOA == 'F' ) $tipodocumento = 'CPF: ';
                            if( $clienteforma->IMB_CLTCCR_PESSOA == 'J' ) $tipodocumento = 'CNPJ: ';
                            if( $clienteforma->IMB_CLTCCR_NOME <> '' )  $correntista = $clienteforma->IMB_CLTCCR_NOME;
                            if( $clienteforma->IMB_CLTCCR_POUPANCA == 'S') $tipoconta = 'Poupança';
                        @endphp
                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow ">
                                    <div class="divTableCellLocatario informacoes">
                                        Locatario: {{$clienteforma->IMB_CLT_NOMELOCATARIO}}
                                    </div>
                                    <div class="divTableCellImovelPasta informacoes">
                                        Imovel: {{$clienteforma->ENDERECOCOMPLETO}} - Cód.Imovel: <b>{{$clienteforma->IMB_IMV_ID}}</b>/Pasta: <b>{{$clienteforma->IMB_IMV_PASTAALFA}}</b>
                                    </div>
                                    <div class="divTableCellDataVencimento informacoes div-center">
                                        Vencimento <br> {{app('App\Http\Controllers\ctrRotinas')->formatarData($clienteforma->IMB_CTR_VENCIMENTOLOCADOR)}} 
                                    </div>
                                    <div class="divTableCellDataVencimento informacoes div-center">
                                        Repassar Até <br> {{app('App\Http\Controllers\ctrRotinas')->formatarData($clienteforma->DATAPREVISAOPAGAMENTO)}}                                    
                                    </div>
                                </div>
                            </div>
                        </div>    


                        @if( $clienteforma->IMB_FORPAG_CONTACORRENTE == 'S')
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <div class="divTableCell10Porcento">@if( $clienteforma->IMB_FORPAG_CONTACORRENTE == 'S' ) Dados da Conta -> <b><i>{{$tipoconta}}@endif</i></b></div>
                                        <div class="divTableCell20Porcento">@if( $clienteforma->IMB_FORPAG_CONTACORRENTE == 'S' ){{$clienteforma->GER_BNC_NOME}} - Agência: {{$clienteforma->GER_BNC_AGENCIA}}-{{$clienteforma->IMB_BNC_AGENCIADV}} - C/C Nº {{$clienteforma->IMB_CLTCCR_NUMERO}}-{{$clienteforma->IMB_CLTCCR_DV}}@endif</div>
                                        <div class="divTableCell20Porcento">@if( $clienteforma->IMB_FORPAG_CONTACORRENTE == 'S' ){{$correntista}} - Docto: {{ app('App\Http\Controllers\ctrRotinas')->formatCnpjCpf($clienteforma->IMB_CLTCCR_CPF)}}@endif</div>
                                        <div class="divTableCell10Porcento ">PIX: {{$clienteforma->IMB_IMVCLT_PIX}}</div>
                                    </div>
                                </div>
                            </div>                                
                        @endif
                        @php
                            $registros = app('App\Http\Controllers\ctrRepasse')->distinctBaseGeradaRepassesMovimentoContratoVen( $clienteforma->IMB_CLT_IDLOCADOR, $clienteforma->IMB_CTR_ID, $clienteforma->IMB_CTR_VENCIMENTOLOCADOR);
                            $totalvencimento = 0;
                        @endphp
                        @foreach( $registros as $reg)
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <div class="divTableCellTBE_ID ">{{$reg->IMB_TBE_ID}}</div>
                                        <div class="divTableCellTBE_NOME">{{$reg->IMB_TBE_NOME}}</div>
                                        <div class="divTableCellLCF_LOCADORCREDEB">{{$reg->IMB_LCF_LOCADORCREDEB}}</div>
                                        <div class="divTableCellLCF_VALOR ">{{ number_format($reg->IMB_LCF_VALOR,2,",",".")}}</div>
                                        <div class="divTableCellLCF_OBSERVACAO ">{{$reg->IMB_LCF_OBSERVACAO}}</div>
                                    </div>
                                </div>
                            </div>                                
                            @php
                                if( $reg->IMB_LCF_LOCADORCREDEB == 'C' )
                                {
                                    $totalforma = $totalforma + $reg->IMB_LCF_VALOR;
                                    $totalvencimento = $totalvencimento + $reg->IMB_LCF_VALOR;
                                    $totalcliente = $totalcliente + $reg->IMB_LCF_VALOR;
                                    $totalgeral = $totalgeral + $reg->IMB_LCF_VALOR;
                                }
                                else
                                {
                                    $totalvencimento = $totalvencimento - $reg->IMB_LCF_VALOR;
                                    $totalforma = $totalforma - $reg->IMB_LCF_VALOR;
                                    $totalcliente = $totalcliente - $reg->IMB_LCF_VALOR;
                                    $totalgeral = $totalgeral - $reg->IMB_LCF_VALOR;
                                }
                            @endphp
                        @endforeach                        
                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow ">
                                    <div class="divTableCellTBE_ID "></div>
                                    <div class="divTableCellTBE_NOME"><i>Total do Vencimento para este contrato</i></div>
                                    <div class="divTableCellLCF_LOCADORCREDEB"></div>
                                    <div class="divTableCellLCF_VALOR font-11"><b>{{number_format($totalvencimento,2,',','.')}}</b></div>
                                    <div class="divTableCellLCF_OBSERVACAO "></div>
                                </div>
                            </div>
                        </div>                                
                        @if( $loop->last)                     
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <div class="divTableCell100 div-center"><i>TOTAL PARA O CLIENTE ==> </i> <b>R$ {{number_format($totalcliente,2,',','.')}}</b></div>
                                    </div>
                                </div>
                            </div>
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <hr class="separadorcliente">
                                    </div>
                                </div>
                            </div>                                
                        @else
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <hr class="separadorcontrato">
                                    </div>
                                </div>  
                            </div>                                
                        @endif
                    @endforeach
                                                   
                @endforeach
            
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow ">
                        <hr>
                    </div>
                </div>  
            </div>                                
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow ">
                    <h3>Total gerar para o {{$titulo}} - R$ {{number_format($totalgeral,2,'.',',')}}</h3>            
                    </div>
                </div>  
            </div>                                

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>
                $("#i-column1").html('NOVA COLUNA');
                window.print();

            </script>

	    </body>
    </head>

