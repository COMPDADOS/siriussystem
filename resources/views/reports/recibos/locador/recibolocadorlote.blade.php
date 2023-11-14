<!DOCTYPE html>
<html>
	<head>

        <style>

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
            border:none;
        }

.footer-1 {
  position: absolute;
  bottom: 55%;
  left: 0;
  right: 0;
  font-size:8px;
}
.footer-2 {
  position: absolute;
  bottom: 0%;
  left: 0;
  right: 0;
  font-size:8px;

}

.borda-1
{
    border:1;
}
.divTable {
    display: table;
    width: 100%;
    padding: 0px;
    border:none;

}

.divTableRow {
    display: table-row;
    padding: 0px;
    width: 100%;
    height: 10px;
    border:0px;
    

}

.semmargem
{
    padding-bottom: 0px;
    padding-top: 0px;
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
    width : 70%;
    border:0;

}
.divTableCellNomes,
.divTableHead {
    border: 1px solid #999999;
    display: table-cell;
    padding: 5px;
    width : 50%;
    border:0;

}

.font-titulo-colunas
{
    font-size:24px;
    font-weight: bold;
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
.divTableCell10porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 10%;

}
.divTableCell3porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 3%;
    
}
.divTableCell15porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 15%;

}
.divTableCell80porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 80%;
}
.divTableCell85porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 85%;
}
.divTableCell100porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 100%;

}

.divTableCell90porc
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 90%;

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
    border:none;
    font-size:12px;
    text-align:left;


}
.divTableCellTBE_NOMETIT
{
    border: 0;
    display: table-cell;
    padding: 0px;
    width : 20%;
    border:none;
    font-size:14px;
    text-align:center;
}

.font-14
{
    font-size:14px;
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
    padding: 0px 5px;
    width : 10%;
    border:none;
    font-size:12px;
    text-align:right;

}.divTableCellLCF_VALORTIT
{
    border: 0;
    display: table-cell;
    padding: 0px 5px;
    width : 10%;
    border:none;
    font-size:14PX;
    text-align:center;

}
.divTableCellLCF_OBSERVACAOTIT
{
    border: 0;
    display: table-cell;
    padding: 0px;
    width : 51%;
    border:none;
    text-align:center;
    font-size:14x;

}.divTableCellLCF_OBSERVACAO
{
    border: 0;
    display: table-cell;
    padding: 0px;
    width : 51%;
    border:none;
    text-align:center;
    font-size:12px;

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
                        


.divTableCelldividor,
{
    border: 1px solid #999999;
    background-color: black;
    display: table-cell;
    padding: 0px 0px;
    width : 100%;
    border:2;
    font-weight: bold;

}.divTableCellEndereco,
{
    border: 1px solid #999999;
    display: table-cell;
    padding: 0px 0px;
    width : 100%;
    border:1;
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
    border: none;
    padding: 0;

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
        hr.sold-azul
        {
            border-top: 8px solid rgb(156, 158, 163);
            padding: 0px;
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

        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
        
        
		<title>Recibo Locador </title>
		<body>
            @php
             $qteve=0;
            @endphp

            @foreach( $recibos as $recibo )
                @for ($i = 1; $i <= 2; $i++)
                <div class="div-recibo">
                       <footer class="footer-2">
                        {{ app('App\Http\Controllers\ctrRotinas')->pegarUsuarioLogado() }}
                      </footer>
                    @php
                        $rec = app('App\Http\Controllers\ctrReciboLocador')->pegarReciboProcesso( $recibo->IMB_RLD_NUMERO );
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
                                    <h4 class="div-center">

                                        {{$imb->IMB_IMB_NOME}}
                                    </h4>                                    
                                    @php
                                        
                                        $endereco = app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $rec[0]->IMB_IMV_ID);
                                        $param2 = app( 'App\Http\Controllers\ctrRotinas')->parametros2( Auth::user()->IMB_IMB_ID );
                                        $pasta = "# Imóvel: ".$rec[0]->IMB_IMV_ID;
                                        if( $rec[0]->IMB_CTR_REFERENCIA <> '' )
                                            $pasta = $pasta . ' / '.$rec[0]->IMB_CTR_REFERENCIA;
                                        @endphp
                                    </p>
                                    <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_ENDERECO}} - {{ $imb->CEP_BAI_NOME}} - CEP: {{ $imb->IMB_IMB_CEP}} - {{ $imb->CEP_CID_NOME}}-{{ $imb->CEP_UF_SIGLA}}   </p>
                                    <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_URL}} - {{ $imb->IMB_IMB_EMAIL}} </p>
                                    <p style="margin: -2;" class="titulo-10-black" >Fones:{{$imb->IMB_IMB_TELEFONE1 }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                                    <p style="margin: -2;" class="titulo-12" >
                                        Recibo de Pagamento de Aluguel de Número {{$rec[0]->IMB_RLD_NUMERO}}
                                    </p>
                                </div>

                                <div class="divTableCell semborba div-center">
                                    <p style="margin: -2;">{{$pasta}}</p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class=" divTableCellEndereco ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTable semmargem">
                        <div class="divTableBody semmargem" >
                            <div class="divTableRow semmargem">
                                <div class="divTableCell85porc">
                                    Locador: <span class="nomes-locador-locatario " >{{strtoupper($rec[0]->NOMELOCADOR)}}</span>
                                </div>
                                <div class="divTableCell15porc div-center"">
                                    <span class="sub-titulo-nome ">
                                        Vencimento</span>
                                </div>
                            </div>
                            <div class="divTableRow semmargem">
                                <div class="divTableCell85porc">
                                    Locatário: <span class="nomes-locador-locatario" >{{strtoupper($rec[0]->NOMELOCATARIO)}}</span>
                                </div>
                                <div class="divTableCell15porc div-center"">
                                    <span class="sub-titulo-nome" >
                                        {{ date("d/m/Y", strtotime($rec[0]->IMB_RLD_DATAVENCIMENTO)) }}</span>
                                </div>
                            </div>
                            <div class="divTableRow semmargem">
                                <div class="divTableCell100porc">
                                    Imóvel: <span class="nomes-locador-locatario">{{$endereco}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class=" divTableCelldividor">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTable semborda">
                        <div class="divTableBody  semborda">
                            <div class="divTableRow  semborda ">
                                <div class="divTableCellTBE_NOMETIT "><u>Histórico</u></div>
                                <div class="divTableCellLCF_VALORTIT "><u>Valor</u></div>
                                <div class="divTableCell3porc "></div>
                                <div class="divTableCellLCF_OBSERVACAOTIT  "><u>Detalhes Sobre a Parcela</u></div>

                            </div>
                        </div>
                    </div>
                    @php
                        $totalrecibo = 0;
                        $tevealuguel = 'N';
                        $totalcredito  = 0;
                        $totaldebito = 0;
                        $totalrecibo = app( 'App\Http\Controllers\ctrReciboLocador')->totaldoRecibo( $recibo->IMB_RLD_NUMERO);
                    
                    @endphp
                    @foreach( $rec as $reg)

                        @php
                            $qteve  = $qteve + 1;
                            if( $reg->MAISMENOS == '-' ) 
                            {
                                $totaldebito = $totaldebito +  $reg->IMB_RLD_VALOR;
                            }
                            if( $reg->MAISMENOS == '+' ) 
                            {
                                $totalcredito = $totalcredito +  $reg->IMB_RLD_VALOR;
                            }
                            if( $reg->IMB_TBE_ID == 1 )
                            $tevealuguel = 'S';
                            $obs = $reg->IMB_RLD_OBSERVACAO;
                            if( $obs == "null") $obs='-';
                        @endphp
                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow ">
                                    <div class="divTableCellTBE_NOME">{{$reg->IMB_TBE_NOME}}</div>
                                    
                                    <div class="divTableCellLCF_VALOR div-right"><b>{{ number_format($reg->IMB_RLD_VALOR,2,",",".")}}</div>
                                    <div class="divTableCell3porc div-center"><b> {{$reg->MAISMENOS}}</b></div>
                                    <div class="divTableCellLCF_OBSERVACAO ">{{$obs}}</div>
                               
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class=" divTableCelldividor ">
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $valrep = app( 'App\Http\Controllers\ctrReciboLocador')->totaldoRecibo($reg->IMB_RLD_NUMERO );
                    @endphp

                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCell100porc font-14"> Total de Créditos: <b>R$ {{ number_format($totalcredito,2,",",".")}}</b> - Total de Débitos: <b>R$ {{ number_format($totaldebito ,2,",",".")}}</b> - Total Recibo: <b>R$ {{ number_format($totalrecibo,2,",",".")}}</b>  </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class=" divTableCelldividor ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow center">
                                <b><u>Dados para Pagamento</u></b>                            
                            </div>
                        </div>
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow center">
                                @php
                                    $ppi = app('App\Http\Controllers\ctrPropImo')->imoveisProprietarioIMV( $rec[0]->IMB_IMV_ID, $rec[0]->IMB_CLT_ID )
                                @endphp
                                @if( $ppi <> '' and $ppi->IMB_CLTCCR_NUMERO <> '' )
                                <b>Banco: {{ $ppi->GER_BNC_NOME}} - Ag: {{ $ppi->GER_BNC_AGENCIA }}
                                - {{ $ppi->IMB_BNC_AGENCIADV }} - C/C: {{$ppi->IMB_CLTCCR_NUMERO}}-{{$ppi->IMB_CLTCCR_DV}}
                                - {{$ppi->IMB_CLTCCR_NOME }} - CPF: {{$ppi->IMB_CLTCCR_CPF }}</b>
                            @endif
                                @if( $ppi <> '' and $ppi->IMB_IMVCLT_PIX <> '' )
                                    <b>PIX: {{ $ppi->IMB_IMVCLT_PIX}}</b>
                                @endif
                        </div>
                        </div>
                    </div>

                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCellASSINATURADATA"><h6>{{ $rec[0]->CEP_CID_NOME }}, {{date("d/m/Y", strtotime($rec[0]->IMB_RLD_DATAPAGAMENTO))}}</h6></div>
                                <div class="divTableCellASSINATURAIMOB"><h6>__________________________________________________</h6>
                                <h6>{{$rec[0]->NOMELOCADOR}}</h6></div>
                            </div>
                        </div>
                    </div>
                </div>
                @if( $i == 1 )
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                            <hr class="hr.dashed-vencimento">
                            </div>
                        </div>
                    </div>
                    @endif


                @endfor
                <div style="page-break-after: always"></div>
            @endforeach
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>
        window.onafterprint = window.close;
        window.print();       
            </script>

		</body>
	</head>

