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
    padding: -3px;
    border:none;

}

.divTableRow {
    display: table-row;
    padding: -2px;
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
    padding: -3px;
    

}

.divTableHeading {
    background-color: #eee;
    display: table-header-group;
}

.divTableCell,
.divTableHead {
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px;
    border:0;

}

.divTableCellLogo,
.divTableHead {
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px;
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
    padding: -3px;
    width : 20%;
    border:0;
    font-size:9px;
    text-align:left;

}
.divTableCell10porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 10%;

}
.divTableCell3porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 3%;
    
}
.divTableCell15porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 15%;

}
.divTableCell80porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 80%;
}
.divTableCell85porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 85%;
}
.divTableCell100porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 100%;

}

.divTableCell90porc
{
    border: none;
    display: table-cell;
    padding: -3px;
    width : 90%;

}


.divTableCellASSINATURADATA
{
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px;
    width : 40%;
    border:0;
    font-size:9px;
    text-align:center;

}

.divTableCellASSINATURAIMOB
{
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px;
    width : 40%;
    border:0;
    font-size:9px;
    text-align:center;

}




.divTableCellTBE_ID
{
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px;
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
    padding: -3px;
    width : 20%;
    border:none;
    font-size:12px;
    text-align:left;


}
.divTableCellTBE_NOMETIT
{
    border: 0;
    display: table-cell;
    padding: -3px;
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
    padding: -3px;
    width : 3%;
    border:.5;
    font-size:9px;
    text-align:center;


}

.divTableCellLCF_VALOR
{
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px 5px;
    width : 10%;
    border:none;
    font-size:12px;
    text-align:right;

}.divTableCellLCF_VALORTIT
{
    border: 0;
    display: table-cell;
    padding: -3px 5px;
    width : 10%;
    border:none;
    font-size:14PX;
    text-align:center;

}
.divTableCellLCF_OBSERVACAOTIT
{
    border: 0;
    display: table-cell;
    padding: -3px;
    width : 51%;
    border:none;
    text-align:center;
    font-size:14x;

}.divTableCellLCF_OBSERVACAO
{
    border: 0;
    display: table-cell;
    padding: -3px;
    width : 51%;
    border:none;
    text-align:center;
    font-size:12px;

}
.divTableCellLCF_DATAVENCIMENTO
{
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px;
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
    padding: -3px 0px;
    width : 100%;
    border:2;
    font-weight: bold;

}.divTableCellEndereco,
{
    border: 1px solid #999999;
    display: table-cell;
    padding: -3px 0px;
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
            padding: -3px;
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
        
        
		<title>Recibo Locatário </title>
		<body>
            @php
             $qteve=0;
            @endphp

                @for ($i = 1; $i <= 2; $i++)
                <div class="div-recibo">

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
                                            $nossonumero = app('App\Http\Controllers\ctrCobrancaGerada')->pegaNossoNumeroBoletoVencimento( $rec[0]->IMB_CTR_ID, $rec[0]->IMB_RLT_DATACOMPETENCIA );
                                        if( $nossonumero <> '' )
                                            $nossonumero = "Nosso Nº: ".$nossonumero;

                                    @endphp
                                    </p>
                                    <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_ENDERECO}} - {{ $imb->CEP_BAI_NOME}} - CEP: {{ $imb->IMB_IMB_CEP}} - {{ $imb->CEP_CID_NOME}}-{{ $imb->CEP_UF_SIGLA}}   </p>
                                    <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_URL}} - {{ $imb->IMB_IMB_EMAIL}} </p>
                                    <p style="margin: -2;" class="titulo-10-black" >Fones:{{$imb->IMB_IMB_TELEFONE1 }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                                    <p style="margin: -2;" class="titulo-12" >
                                        Recibo de Pagamento de Aluguel de Nº {{$rec[0]->IMB_RLT_NUMERO}} - {{$nossonumero}}
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
                                        {{ date("d/m/Y", strtotime($rec[0]->IMB_RLT_DATACOMPETENCIA)) }}</span>
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
                    @endphp
                    @foreach( $rec as $reg)

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
                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow ">
                                    <div class="divTableCellTBE_NOME">{{$reg->IMB_TBE_NOME}}</div>
                                    
                                    <div class="divTableCellLCF_VALOR div-right"><b>{{ number_format($reg->IMB_RLT_VALOR,2,",",".")}}</div>
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
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                
                                <div class="divTableCellTBE_NOME">Alugado em <b>{{ date("d/m/Y", strtotime($reg->IMB_CTR_DATALOCACAO))}}</b></div>
                                    
                                <div class="divTableCellLCF_VALOR div-right"><b>R$ {{ number_format( $totalrecibo,2,",",".")}}</b></div>
                                <div class="divTableCell3porc div-center"><b></b></div>
                                <div class="divTableCellLCF_OBSERVACAO ">Reajustar em {{ date("d/m/Y", strtotime($reg->IMB_CTR_DATAREAJUSTE))}} - Forma Pagto: <b>{{app('App\Http\Controllers\ctrRotinas')->formaPagamento( $reg->IMB_FORPAG_ID)}}</b></div>
                            </div>
                        </div>
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCellLCF_OBSERVACAO ">
                                    Em Dinheiro: <b>{{number_format( $rec[0]->FIN_LCX_DINHEIRO,2,',','.')}}</b>
                                    - Em Cheque: <b>{{number_format( $rec[0]->FIN_LCX_CHEQUE,2,',','.')}}</b>
                                    - Em Pix: <b>{{number_format( $rec[0]->IMB_RLT_PIX,2,',','.')}}</b>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCellUSUARIO">{{ app('App\Http\Controllers\ctrRotinas')->pegarUsuarioLogado() }}</div>
                                <div class="divTableCellASSINATURADATA"><h6>{{ $rec[0]->CEP_CID_NOME }}, {{date("d/m/Y", strtotime($rec[0]->IMB_RLT_DATAPAGAMENTO))}}</h6></div>
                                <div class="divTableCellASSINATURAIMOB"><h6>__________________________________________________</h6><h6>{{$rec[0]->IMB_IMB_NOME}}</h6></div>
                            </div>
                        </div>
                    </div>
                    @if( $i <> 1 )
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
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <h6 class="div-center"><u>Dados para Repasse</u></h6>
                                    </div>
                                </div>
                            </div>
                            @foreach( $calc as $reg)
                                @php
                                    $sinal='';
                                    if( $reg->IMB_LCF_LOCADORCREDEB == 'D' ) 
                                    {
                                        $totalrep = $totalrep - $reg->IMB_LCF_VALOR;
                                        $sinal =  '-';
                                    }
                                    else
                                    if( $reg->IMB_LCF_LOCADORCREDEB == 'C' ) 
                                    {
                                        $totalrep = $totalrep + $reg->IMB_LCF_VALOR;
                                        $sinal =  '+';

                                    }
                                @endphp
                                <div class="divTable">
                                    <div class="divTableBody">
                                        <div class="divTableRow ">
                                                <div class="divTableCellTBE_ID ">{{$reg->IMB_TBE_ID}}</div>
                                            <div class="divTableCellTBE_NOME">{{$reg->IMB_TBE_NOME}}</div>
                                            <div class="divTableCellLCF_LOCADORCREDEB">{{$sinal}}</div>
                                            <div class="divTableCellLCF_VALOR ">{{ number_format($reg->IMB_LCF_VALOR,2,",",".")}}</div>
                                            <div class="divTableCellLCF_OBSERVACAO ">{{$reg->IMB_LCF_OBSERVACAO}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="divTable">
                                <div class="divTableBody">
                                    <div class="divTableRow ">
                                        <div class="divTableCellTBE_ID "></div>
                                        <div class="divTableCellTBE_NOME">Total Repassar</div>
                                        <div class="divTableCellLCF_LOCADORCREDEB"></div>
                                        <div class="divTableCellLCF_VALOR "><b>{{ number_format($totalrep,2,",",".")}}</div>
                                        <div class="divTableCellLCF_OBSERVACAO "></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>
                $("#i-column1").html('NOVA COLUNA');

            </script>

		</body>
	</head>

