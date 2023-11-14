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

.font-9
{
    font-size:9px;
}
.font-16
{
    font-size:16px;
}
.font-14
{
    font-size:24px;
}
.divTableRow {
    display: table-row;
    padding: 0px;
    border:0px;
    

}
.divTableRowBorda {
    display: table-row;
    border:.5;
    padding: 0px;
    

}

.divTableHeading {
    background-color: #eee;
    display: table-header-group;
}

.divTableCell,
.divTableHead {
    border:0px;
    display: table-cell;
    padding: 0px;

}

.divTableCellLogo,
.divTableHead {
    border: 0px;
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
    border:0px;
    display: table-cell;
    padding: 5px;
    width : 50%;

}

.divTableCellUSUARIO
{
    border:0px;
    display: table-cell;
    padding: 0px;
    width : 20%;
    font-size:14px;
    text-align:left;

}
.divTableCellStandard
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    font-size:14px;
    text-align:left;

}
.divTableCell80
{
    border:0px;
    display: table-cell;
    padding: 0px 0px 0px 0px ;
    width : 80%;
    font-size:11px;
    text-align:left;

}

.divTableCellDadosConta
{
    border: 0px;
    display: table-cell;
    padding: 0px 0px 0px 0px;
    width : 100%;
    font-size:11px;
    text-align:center;

}
.divTableCell20
{
    border: 0px;
    display: table-cell;
    padding: 0px 0px 0px 0px;
    width : 20%;
    font-size:11px;
    text-align:left;

}
.divTableCellImovel
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 100%;
    font-size:14px;
    text-align:left;

}




.divTableCellASSINATURADATA
{
    display: table-cell;
    padding: 0px;
    width : 40%;
    border:0;
    font-size:14px;
    text-align:center;

}
.divTableImovel
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 100%;
    font-size:14px;
    text-align:center;

}

.divTableCellASSINATURAIMOB
{
    display: table-cell;
    padding: 0px;
    width : 40%;
    border:0;
    font-size:14px;
    text-align:center;

}




.divTableCellTBE_ID
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 6%;
    text-align:center;
    font-style:underline;    
    font-size:14px;

}

.divTableCellTBE_NOME
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 20%;
    font-size:10px;
    text-align:left;


}
.divTableCellLCF_LOCADORCREDEB
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 3%;
    font-size:10px;
    text-align:center;


}

.divTableCellLCF_VALOR
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 10%;
    font-size:10px;
    text-align:center;

}
.divTableCellLCF_OBSERVACAO
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 51%;
    text-align:center;
    font-size:9px;

}
.divTableCellLCF_DATAVENCIMENTO
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 10%;
    font-size:14px;
    text-align:center;

}
                        


.divTableCellEndereco,
{
    border: 0px;
    display: table-cell;
    padding: 0px 0px;
    width : 100%;
    border:.5px;
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

.divTableCellLocatario
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 50%;
    font-size:14px;
    text-align:left;

}
.divTableCellVencimento
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 15%;
    font-size:14px;
    text-align:left;
}
.divTableCellPagamento
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 15%;
    font-size:14px;
    text-align:left;
}

.divTableCellValor
{
    border: 0px;
    display: table-cell;
    padding: 0px;
    width : 20%;
    font-size:16px;
    text-align:right;
    font-weight: bold;

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
                font-size: 14px;
                color:#003366;
                
            }

            .titulo-movimento
            {
                font-size: 14px;
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
                font-size: 14px;
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
        
        
		<title>Demonstrativo Locador</title>
		<body>
            @php
             $qteve=0;
            @endphp
            <div class="divTable semborda">
                <div class="divTableBody semborda">
                    <div class="divTableRow semborda">
                        <div class="divTableCellDadosEmpresa semborda div-center">
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
                                Extrato de Recebimento de Aluguel
                            </p>
                            <p>
                                <hr>
                            </p>
                            <p  >
                               <b> {{$nomecliente}}</b>
                            </p>
                            <p >
                                <b>Período entre {{ $datainicial}} a {{$datafinal}}</b>
                            </p>

                            <p>
                            </p>
                        </div>
                    </div>
                </div>                        
            </div>

            @php
            $totalgeral = 0;
            @endphp
            @foreach( $recs as $recibo )
                @php
                    $dadosrecibo = app('\App\Http\Controllers\ctrReciboLocador')->pegarRecibo( $recibo->IMB_RLD_NUMERO,'N' );
                    $idimovel = $dadosrecibo[0]->IMB_IMV_ID;
                @endphp
                <div class="divTable semborda">
                    <div class="divTableBody semborda">
                        <div class="divTableRow semborda">
                            <p></p>
                        </div>
                    </div>
                </div>                        
                <div class="divTable semborda">
                    <div class="divTableBody semborda">
                        <div class="divTableRow semborda">
                            <div class=" divTableCellImovel semborda font-16">
                                Imóvel: <b>{{$dadosrecibo[0]->IMB_CTR_REFERENCIA}} ({{$dadosrecibo[0]->IMB_IMV_ID}})-{{$dadosrecibo[0]->ENDERECOIMOVEL}} - {{$dadosrecibo[0]->BAIRROIMOVEL}} </b>                               
                            </div>
                        </div>
                    </div>
                </div>                        
                <div class="divTable">
                    <div class="divTableBody semborba">
                        <div class="divTableRow semborba">
                            <div class=" divTableCellLocatario font-16">
                                Locatário: <b> {{$dadosrecibo[0]->NOMELOCATARIO}}</b> <p>CPF/CNPJ: <b>{{$dadosrecibo[0]->CPFLOCATARIO}}</p> </b>
                            </div>
                            <div class=" divTableCellVencimento font-16">
                                Vencimento <p><b> {{ app('App\Http\Controllers\ctrRotinas')->formatarData($dadosrecibo[0]->IMB_RLD_DATAVENCIMENTO)}}</b></p> 
                            </div>
                            <div class=" divTableCellPagamento font-16">
                                Pagamento <p> <b>{{ app('App\Http\Controllers\ctrRotinas')->formatarData($dadosrecibo[0]->IMB_RLD_DATAPAGAMENTO)}}</b></p> 
                            </div>
                            <div class=" divTableCellValor ">

                                @php
                                    $totalrecibo = app('App\Http\Controllers\ctrReciboLocador')->totaldoRecibo( $recibo->IMB_RLD_NUMERO );
                                    $totalgeral = $totalgeral + $totalrecibo;
                                @endphp
                                <b>R$ {{number_format($totalrecibo,2,",",".")}}</b>
                            </div>

                        </div>
                    </div>
                </div>                        
                @php
                    $itens = app('App\Http\Controllers\ctrReciboLocador')->itensdoRecibo( $recibo->IMB_RLD_NUMERO );
                @endphp
                @foreach( $itens as $item)
                    @php
                        $sinal='';
                        if( $item->IMB_RLD_LOCADORCREDEB == 'D' ) 
                            $sinal =  '-';
                        
                        if( $item->IMB_RLD_LOCADORCREDEB == 'C' ) 
                            $sinal =  '+';

                        $observacao = $item->IMB_RLD_OBSERVACAO;
                        if( $observacao == null ) $observacao='-';
                    @endphp
                    <div class="divTable">
                        <div class="divTableBody">
                            <div class="divTableRow ">
                                <div class="divTableCellTBE_NOME font-14">{{$item->IMB_TBE_NOME}}</div>
                                <div class="divTableCellLCF_VALOR  font-14 div-right">{{ number_format($item->IMB_RLD_VALOR,2,",",".")}}({{$sinal}})</div>
                                <div class="divTableCellLCF_OBSERVACAO  ">{{$observacao}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow ">
                            @php
                                $ppi = app( 'App\Http\Controllers\ctrPropImo')->imoveisProprietarioIMV( $idimovel, $idcliente );
                            @endphp
                            <div class="divTableCellDadosConta">
                                <i>
                                @if( $ppi <> '' )
                                Banco: {{ $ppi->GER_BNC_NOME}} - Ag: {{ $ppi->GER_BNC_AGENCIA }}
                                    - {{ $ppi->GER_BNC_AGENCIADV }} - C/C: {{$ppi->IMB_CLTCCR_NUMERO}}-{{$ppi->IMB_CLTCCR_NUMERODV }}
                                    - {{$ppi->IMB_CLTCCR_NOME }} - CPF: {{$ppi->IMB_CLTCCR_CPF }}
                                @endif
                            </i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow ">
                            <hr class="hr.dashed-vencimento">
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
                        Total Geral: </b> R$ {{number_format($totalgeral,2,",",".")}}</b>                            
                    </div>
                </div>  
            </div>
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow ">
                    <h4>** Extrato para simples conferência **</h4>
                    </div>
                </div>  
            </div>
        


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


        <script>
                $("#i-column1").html('NOVA COLUNA');
                var imprimir = "{{$imprimir}}";
                if( imprimir == 'S') 
                    window.print();

        </script>

	</body>
</head>

