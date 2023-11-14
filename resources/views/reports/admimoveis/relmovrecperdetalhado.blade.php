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
    border:0px;

}

.Row {
    display: table-row;
    width: 100%;
    padding: 0px;
    

}
.divTableRowBorda {
    display: table-row;
    border:.5;
    padding: 0px;
    

}
.divTableRow {
    display: table-row;
    border:none;
    padding: 0px;
    width:100%;
    

}

.divTableHeading {
    background-color: #eee;
    display: table-header-group;
}

.divTableCell,
.divTableHead {
    border: .5px solid #999999;
    display: table-cell;
    padding: 0px;

}

.divTableCellLogo,
.divTableHead {
    border: .5px solid #999999;
    display: table-cell;
    padding: 0px;
    width : 20%;
    border:0;

}

.divTableCellDadosEmpresa,
.divTableHead {
    border: 0px;
    display: table-cell;
    padding: 3px 10px;
    width : 100%;
}
.divTableCellNomes,
.divTableHead {
    border: .5px solid #999999;
    display: table-cell;
    padding: 5px;
    width : 50%;

}

.divTableCellUSUARIO
{
    border: .5px solid #999999;
    display: table-cell;
    padding: 0px;
    width : 20%;
    font-size:9px;
    text-align:left;

}
.divTableCellStandard
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    font-size:9px;
    text-align:left;

}

.divTableBody {
    display: table-row-group;
    border:0;

}

.divTableCell5
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 5%;
    font-size:12px;
}
.divTableCell10
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 10%;
    font-size:12px;
}
.divTableCell2
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 2%;
    font-size:12px;
}

.divTableCell20
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 20%;
    font-size:12px;
}

.divTableCell30
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 30%;
    font-size:12px;
}

.divTableCell35
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 35%;
    font-size:12px;
}

.divTableCell40
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 40%;
    font-size:12px;
}

.divTableCell50
{
    border: .5px solid #999999;
    display: table-cell;
    padding: 0px;
    width : 50%;
    font-size:10px;
}
.divTableCell100
{
    border: none;
    display: table-cell;
    padding: 0px;
    width : 100%;
    font-size:10px;
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


            .nome-empresa
            {
                text-align:center;
                font-size: 30px;
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
        
        
		<title>Recebido por Período - Detalhado</title>
		<body>
            @php
             $qteve=0;
            @endphp
            <div class="divTable semborda ">
                <div class="divTableBody semborda">
                    <div class="divTableRow semborda">
                        <div class="divTableCell100 semborda div-center">
                            <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="divTable semborda">
                <div class="divTableBody semborda">
                    <div class="divTableRow semborda">
                        @php
                            $imb = app('App\Http\Controllers\ctrImobiliaria')->pegarImobiliaria( Auth::user()->IMB_IMB_ID );
                        @endphp
                        <div class="divTableCellDadosEmpresa semborda div-center">
                            <p class="nome-empresa">
                                {{$imb->IMB_IMB_NOME}}
                            </p>
                            <p  >{{ $imb->IMB_IMB_URL}}</p>
                            <p >Fones:{{$imb->TELEFONE }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                            <p  >
                                Relatório Recebido Detalhado por Evento
                            </p>
                            <p  >
                                Período {{ app('App\Http\Controllers\ctrRotinas')->formatarData($datainicio)}} a {{app('App\Http\Controllers\ctrRotinas')->formatarData($datafim)}}
                            </p>
                            <p>
                                <hr class="px1-black " width="100%" >
                            </p>
                            <p  >
                               <b> <u>{{ app('App\Http\Controllers\ctrTabelaEventos')->find($eventos)->IMB_TBE_NOME}}</b></u>
                            </p>

                            <p>
                            </p>
                        </div>
                    </div>
                </div>                        
            </div>

            @php
            $totalgeral = 0;
            $totalcre = 0;
            $totaldeb = 0;
            @endphp
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow ">
                        <div class="divTableCell10"><u>Data Vencto.</u></div>
                        <div class="divTableCell10"><u>Data Pagto.</u></div>
                        <div class="divTableCell5"><u>Pasta</u></div>
                        <div class="divTableCell20"><u>Locatário</u></div>
                        <div class="divTableCell10 div-right"><u>Entrada</u></div>
                        <div class="divTableCell10 div-right"><u>Saída</u></div>
                        <div class="divTableCell2 div-right"></div>
                        <div class="divTableCell35"><u>Observação</u></div>
                    </div>
                </div>
            </div>
            
            @foreach( $mov as $reg)
                @php
                    $sinal='';
                    if( $reg->IMB_RLT_LOCATARIOCREDEB == 'D' ) 
                        $totalcre = $totalcre + $reg->IMB_RLT_VALOR;
                    
                    if( $reg->IMB_RLT_LOCATARIOCREDEB == 'C' ) 
                        $totaldeb = $totaldeb + $reg->IMB_RLT_VALOR;
                @endphp
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow ">
                            <div class="divTableCell10">{{$reg->IMB_RLT_DATACOMPETENCIA}}</div>
                            <div class="divTableCell10">{{$reg->IMB_RLT_DATAPAGAMENTO}}</div>
                            <div class="divTableCell5">{{$reg->IMB_CTR_REFERENCIA}}</div>
                            <div class="divTableCell20 ">{{$reg->LOCATARIO}}</div>
                            @if( $reg->IMB_RLT_LOCATARIOCREDEB =='D' )
                                <div class="divTableCell10 div-right" >{{number_format($reg->IMB_RLT_VALOR,2,',','.')}}</div>
                            @else
                                <div class="divTableCell10 div-right">0,00</div>
                            @endif
                            
                            @if( $reg->IMB_RLT_LOCATARIOCREDEB =='C' )
                                <div class="divTableCell10 div-right">{{number_format($reg->IMB_RLT_VALOR,2,',','.')}}</div>
                            @else
                                <div class="divTableCell10 div-right">0,00</div>
                            @endif

                            <div class="divTableCell2 div-right"></div>
                            <div class="divTableCell35">{{$reg->IMB_RLT_OBSERVACAO}}</div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow ">
                        <hr class="px1-black " width="100%" >
                    </div>
                </div>  
            </div>
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow ">
                        <div class="divTableCell10">{{$reg->IMB_RLT_DATACOMPETENCIA}}</div>
                        <div class="divTableCell10">{{$reg->IMB_RLT_DATAPAGAMENTO}}</div>
                        <div class="divTableCell5">{{$reg->IMB_CTR_REFERENCIA}}</div>
                        <div class="divTableCell20">{{$reg->LOCATARIO}}</div>
                        <div class="divTableCell10 div-right">{{number_format($totalcre,2,',','.')}}</div>
                        <div class="divTableCell10 div-right">{{number_format($totaldeb,2,',','.')}}</div>
                        <div class="divTableCell2 div-right"></div>
                        <div class="divTableCell35 div-right">Saldo: <b><strong> {{number_format($totalcre - $totaldeb,2,',','.')}}</strong></b></div>
                </div>
                </div>  
            </div>
        


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


        <script>
            window.onafterprint = () => 
            {
              window.close();
            };
            window.print();

        </script>

	</body>
</head>

