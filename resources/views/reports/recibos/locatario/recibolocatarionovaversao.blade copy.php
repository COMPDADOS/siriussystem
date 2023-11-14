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
    width : 70%;
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
                        


.divTableCellEndereco,
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
    border:0;

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

            .titulo-11-blue
            {
                text-align:center;
                font-size: 11px;
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
                                <div class="divTableCellDadosEmpresa">
                                    <h4 class="div-center">
                                        {{$rec[0]->IMB_IMB_NOME}}
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
                                    <p style="margin: -2;" class="titulo-10-black" >{{ $rec[0]->IMB_IMB_URL}}</p>
                                    <p style="margin: -2;" class="titulo-10-black" >Fones:{{$rec[0]->TELEFONE }}- Creci: {{$rec[0]->IMB_IMB_CRECI}}</p>
                                    <p style="margin: -2;" class="titulo-10-black" >{{$rec[0]->IMB_IMB_URL}} 
                                    <p style="margin: -2;" class="titulo-11-blue" >
                                        Recibo de Pagamento de Aluguel de Nº {{$rec[0]->IMB_RLT_NUMERO}} - {{$nossonumero}}
                                    </p>
                                    <p>
                                    </p>
                                </div>

                                <div class="divTableCell semborba div-center">
                                    <p style="margin: -2;">Vencimento</p>
                                    <p style="margin: -2;"><span class="sub-titulo-nome">
                                    {{ date("d/m/Y", strtotime($rec[0]->IMB_RLT_DATACOMPETENCIA)) }}</span></p>
                                    <p style="margin: -2;">{{$pasta}}</p>

                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow">
                                <div class=" divTableCellNomes ">
                                    <p style="margin: -2;"  >Locador: <span class="nomes-locador-locatario" >{{$rec[0]->NOMELOCADOR}}</span></p>
                                </div>
                                <div class=" divTableCellNomes ">
                                    <p style="margin: -2;"  >Locatário: <span class="nomes-locador-locatario" >{{$rec[0]->NOMELOCATARIO}}</span></p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class=" divTableCellEndereco ">
                                    Imóvel: <span class="nomes-locador-locatario">{{$endereco}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCellTBE_ID "><u>Código</u></div>
                                <div class="divTableCellTBE_NOME"><u>Histórico</u></div>
                                <div class="divTableCellLCF_LOCADORCREDEB"></div>
                                <div class="divTableCellLCF_VALOR "><u>Valor</u></div>
                                <div class="divTableCellLCF_OBSERVACAO "><u>Observação</u></div>
                                <div class="divTableCellLCF_DATAVENCIMENTO"><u>Vencimento</u></div>
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
                                    <div class="divTableCellTBE_ID ">{{$reg->IMB_TBE_ID}}</div>
                                    <div class="divTableCellTBE_NOME">{{$reg->IMB_TBE_NOME}}</div>
                                    <div class="divTableCellLCF_LOCADORCREDEB">{{$reg->MAISMENOS}}</div>
                                    <div class="divTableCellLCF_VALOR ">{{ number_format($reg->IMB_RLT_VALOR,2,",",".")}}</div>
                                    <div class="divTableCellLCF_OBSERVACAO ">{{$obs}}</div>
                                    <div class="divTableCellLCF_DATAVENCIMENTO">{{ date("d/m/Y", strtotime($reg->IMB_RLT_DATACOMPETENCIA))}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCellTBE_ID "></div>
                                <div class="divTableCellTBE_NOME">Alugado em <b>{{ date("d/m/Y", strtotime($reg->IMB_CTR_DATALOCACAO))}}</b></div>
                                <div class="divTableCellLCF_LOCADORCREDEB"></div>
                                <div class="divTableCellLCF_VALOR ">$ Recebido: <b>R${{ number_format( $totalrecibo,2,",",".")}}</b></div>
                                <div class="divTableCellLCF_OBSERVACAO ">Reajustar em <b>{{ date("d/m/Y", strtotime($reg->IMB_CTR_DATAREAJUSTE))}} - Reajustar em {{ date("d/m/Y", strtotime($reg->IMB_CTR_DATAREAJUSTE))}} - Forma Pagto: <b>{{app('App\Http\Controllers\ctrRotinas')->formaPagamento( $reg->IMB_FORPAG_ID)}}</b></div>
                                <div class="divTableCellLCF_DATAVENCIMENTO"></div>
                            </div>
                        </div>
                    </div>

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

