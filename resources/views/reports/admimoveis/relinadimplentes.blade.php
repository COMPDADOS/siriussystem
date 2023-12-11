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
    padding: 3px 12px;
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
    border: none;
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

            .font-16
            {
                font-size:16px;
            }

        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
        
        
		<title>Inadimplentes</title>
		<body>
            @php
             $qteve=0;
            @endphp
            <div class="divTable semborda ">
                <div class="divTableBody semborda">
                    <div class="divTableRow semborda">
                        @php
                            $imb = app('App\Http\Controllers\ctrImobiliaria')->pegarImobiliaria( Auth::user()->IMB_IMB_ID );
                        @endphp
                        <div class="divTableCell100 semborda div-center font-size-16">
                            {{$imb->IMB_IMB_NOME}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="divTable semborda">
                <div class="divTableBody semborda">
                    <div class="divTableRow semborda">
                        <div class="divTableCell100 semborda div-center">
                            <p>
                                Relatório de Inadimplentes por Ordem de Data de Vencimento - Emitido em {{date( 'd/m/Y')}}
                            </p>
                        </div>
                    </div>
                </div>                        
            </div>

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
                        &nbsp;
                    </div>
                </div>  
            </div>


            @php
            $totalgeral = 0;
            $totalcre = 0;
            $totaldeb = 0;
            @endphp
            
            @foreach( $headers as $reg)
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow ">
                            <div class="divTableCell10">{{date( 'd/m/Y', strtotime($reg->IMB_CTR_VENCIMENTOLOCATARIO))}}</div>
                            <div class="divTableCell5">Pasta: {{$reg->IMB_CTR_REFERENCIA}}</div>
                            <div class="divTableCell30">{{$reg->ENDERECOCOMPLETO}}</div>
                            <div class="divTableCell10 ">{{number_format( $reg->IMB_CTR_VALORALUGUEL,2,',','.')}}</div>
                        </div>
                    </div>
                </div>
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow ">
                            <div class="divTableCell10"><b> #im: {{$reg->IMB_IMV_ID}}</b></div>
                            <div class="divTableCell5">Locatário:</div>
                            <div class="divTableCell30">{{$reg->IMB_CLT_NOMELOCATARIO}}</div>
                            <div class="divTableCell50 ">{{$reg->FONELOCATARIO}}</div>
                        </div>
                    </div>
                </div>
                @if( $reg->FIADOR1NOME <> '' )
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCell10"></div>
                                <div class="divTableCell5">Fiador:</div>
                                <div class="divTableCell30">{{$reg->FIADOR1NOME}}</div>
                                <div class="divTableCell50 ">{{$reg->FIADOR1FONE}}</div>
                            </div>
                        </div>
                    </div>
                @endif
                @if( $reg->FIADOR2NOME <> '' )
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCell10"></div>
                                <div class="divTableCell5">Fiador:</div>
                                <div class="divTableCell30">{{$reg->FIADOR2NOME}}</div>
                                <div class="divTableCell50 ">{{$reg->FIADOR2FONE}}</div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow ">
                            <hr class="px1-black " width="100%" >
                        </div>
                    </div>  
                </div>
            @endforeach

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

