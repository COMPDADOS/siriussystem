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
            }
            .divTableCell20Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 20%;
            }
            .divTableCell30Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 30%;
            }
            .divTableCell40Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 40%;
            }

            .divTableCell50Porcento
            {
                border: 1px solid #999999;
                display: table-cell;
                padding: 0px;
                width : 50%;
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
                            <p style="margin: -2;" class="titulo-10-black" >{{$imb->IMB_IMB_NOME}}</p>
                            <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_URL}}</p>
                            <p style="margin: -2;" class="titulo-10-black" >Fones:{{$imb->TELEFONE }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                            <p style="margin: -2;" class="titulo-10-black" >{{$imb->IMB_IMB_URL}} </p>
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >Relatório de Cobrancas Geradas para Conferência</p>
                        </div>
                    </div>
                </div>                        
            </div>

            @php
                $cobrancas = app('App\Http\Controllers\ctrCobrancaGerada')->cargaHeader( 'IMB_CGR_DATAVENCIMENTO');
            @endphp

            @foreach( $cobrancas as $cobranca )
                @php
                    $nomecondominio = app('App\Http\Controllers\ctrRotinas')->pegarCondominioImovel($cobranca->IMB_IMV_ID);
                @endphp
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow semborba">
                            <div class="divTableCell10Porcento titulo-10-black">                            
                                # Imóvel: <b>{{$cobranca->IMB_IMV_ID}} / Pasta:{{$cobranca->IMB_CTR_REFERENCIA}}</b>
                            </div>
                            <div class="divTableCell50Porcento titulo-10-black div-left">                            
                            <b>{{$cobranca->IMB_CGR_IMOVEL}}</b>
                            </div>
                            <div class="divTableCell20Porcento titulo-10-black div-left">                            
                                {{$nomecondominio}}
                            </div>
                            <div class="divTableCell20Porcento titulo-12 ">                            
                                <p>
                                    <b>{{date('d/m/Y', strtotime($cobranca->IMB_CGR_DATAVENCIMENTO))}}</b>
                                </p>                                    
                                <p>                                
                                    <b> R$ {{number_format( $cobranca->IMB_CGR_VALOR,2,',','.')}} </b>
                                </p>                                    

                            </div>
                        </div>
                    </div>
                </div>
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow semborba">
                        <div class="divTableCell50Porcento titulo-10-black div-left">                            
                                Locatário: <b>{{$cobranca->IMB_CGR_DESTINATARIO}}</b>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $detalhes = app('App\Http\Controllers\ctrCobrancaGerada')->cargaDetail( $cobranca->IMB_CGR_ID );
                @endphp
                @foreach( $detalhes as $det)
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow semborba">
                            <div class="divTableCellTBE_ID titulo-10-black div-left">                            
                                    {{$det->IMB_TBE_ID}}
                                </div>
                                <div class="divTableCellTBE_NOME titulo-10-black div-left">                            
                                    {{$det->IMB_TBE_DESCRICAO}}
                                </div>
                                <div class="divTableCellLCF_LOCADORCREDEB titulo-10-black div-left">                            
                                    {{$det->IMB_RLT_LOCATARIOCREDEB}}
                                </div>
                                <div class="divTableCellLCF_VALOR titulo-10-black div-right">                            
                                    {{number_format($det->IMB_LCF_VALOR,2,',','.')}}
                                </div>
                                <div class="divTableCellLCF_OBSERVACAO titulo-10-black div-left">                            
                                    {{$det->IMB_LCF_OBSERVACAO}}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow semborba">
                            <hr class="separadorcontrato">
                        </div>
                    </div>
                </div>
    

            @endforeach

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>

                $("#i-column1").html('NOVA COLUNA');
                window.onafterprint = window.close;
                window.print();

            </script>

	    </body>
    </head>

