<!DOCTYPE html>
<html>
	<head>

    <style>

        @media print 
        {
            /* hide every others elements */
            body * {
                visibility  : hidden;
            }

                /* then displaying print container*/
            .print-container, .print-container * {
                visibility:visible;
            }




        }
        .div-box-grey
        {
            background-color: lightgrey;
            width: 100%;
            border: 1px solid black;
            padding: 4px;
            margin: -2px;
        }
        .div-box-grey-comercial
        {
            background-color: lightgrey;
            width: 100%;
            border: 1px solid black;
            padding: 18.5px;
            margin: -1.5px;
        }

        .div-box-comercial
        {
            background-color: white;
            width: 100%;
            border: 1px solid black;
            padding: 18.5px;
            margin: -1.5px;
        }

        .div-box-600
        {
            background-color: white;
            width: 100%;
            border: 1px solid black;
            padding: 3.2px;
            margin: -1.5px;
        }


        .profile img{
            width: 90%;
            height: 90%;                

        }
        .div-titulo
        {
            height: 100px;                
        }
        
        .escondido
        {
              display:none;
        }


        .div-linha-comercial
        {
            height: 60px;                
        }
        
        .div-linha
        {
            height: 30px;                
        }
        
        .div-dados-base-imovel
        {
            height: 200px;                
        }
        
        p { margin-bottom:-15px;margin-top:-10px; }
            .row-bottom-margin { margin-bottom:-15px;margin-top:-10px; }
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

            .quadro-border
            {
                border: 2px;
	            border-right: 2px;
	            border-style: solid;
            }

            .quadro-border-left
            {
                border: 2px;
	            border-left: 1px;
	            border-right: 0px;
	            border-style: solid;
            }

            .quadro-border-left-right-bottom
            {
                border: 2px;
	            border-left: 1px;
	            border-right: 1px;
	            border-bottom: 1px;
	            border-top: 0px;
	            border-style: solid;
            }

            .quadro-border-left-right
            {
                border: 2px;
	            border-left: 1px;
	            border-right: 1px;
	            border-bottom: 0px;
	            border-top: 0px;
	            border-style: solid;
            }

            .quadro-border-right
            {
                border: 2px;
	            border-left: 0px;
	            border-top: 0px;
	            border-bottom: 0px;
	            border-right: 1px;
	            border-style: solid;
            }


            .contrato-info
            {
                text-align:center;
                font-size: 14px;
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

            .titulo-empresa-left
            {
                text-align:left;
                font-size: 15px;
                color:#003366;
                font-weight: bold;

            }

            .titulo-empresa-left
            {
                text-align:left;
                font-size: 15px;
                color:#000000;
                font-weight: bold;

            }
            

            .titulo-imovel-left
            {
                text-align:left;
                font-size: 20px;
                color: #000000;
                font-weight: bold;

            }

            .imovel-valor
            {
                text-align:left;
                font-size: 18x;
                color: #000000;
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
                font-size: 25px;
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
        
        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		<title>Ficha de Imóvel - completa </title>
		<body>
            <div class="container print-container" id="print">
                <div class="row">
                    <div class="col-md-12 div-titulo">
                        <div class="col-md-3 quadro-border-left div-titulo div-center">
                            <img src="http://www.siriussystem.com.br/sys/storage/images/3/logos/logo_180_135_semimagem.jpg" alt="alt-logo">
                        </div>
                        <input type="hidden" id="IMB_IMV_ID" value="{{$imv->IMB_IMV_ID}}">
                        <div class="col-md-9 quadro-border div-titulo">
                            <div class="row" height="50%">
                                <div class="col-md-10">
                                    <label class="sub-titulo-nome-left">{{ $imb->IMB_IMB_NOME}}</label>
                                </div>                                    
                                <div class="col-md-2">
                                   <button type="button" class="btn btn-default btn-sm" onClick="imprimir()">
                                        <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button>                                
                                </div>
                            </div>                                    
                            <div class="row" height="50%">
                                {{$imb->IMB_IMB_ENDERECO}} {{$imb->IMB_IMB_ENDERECONUMERO}} - {{$imb->CEP_BAI_NOME}} - {{$imb->CEP_CID_NOME}}-{{$imb->CEP_UF_SIGLA}}
                            </div>                                    
                            <div class="row" height="50%">
                                {{$imb->IMB_IMB_TELEFONE1}} - Creci: {{$imb->IMB_IMB_CRECI}}
                            </div>
                            <div class="row" height="50%">
                                Impresso por {{$atd->IMB_ATD_NOME}} em {{date("d-m-Y H:i")}}
                            </div>
                        </div>
                    </div>       
                </div>
                    <div class="col-md-12 div-dados-base-imovel  quadro-border ">
                        <div class="col-md-3 div-dados-base-imovel profile">
                            <img src="{{url('')}}/storage/images/{{$imv->IMB_IMB_ID}}/imoveis/{{$imv->IMB_IMV_ID}}/{{$image}}">
                        </div>
                        <div class="col-md-9" >
                            <div class="row" height="50%">
                                <label class="titulo-imovel-left">Ficha do Imóvel {{$imv->IMB_IMV_REFERE}}({{$tim->IMB_TIM_DESCRICAO}})</label>
                            </div>
                            <div class="row" height="50%">
                                <label class="imovel-valor">Valor Venda: R$ {{number_format($imv->IMB_IMV_VALVEN, 2, ',', '.')}} / Valor Locação: R$ {{number_format($imv->IMB_IMV_VALLOC, 2, ',', '.')}}</label>
                            </div>
                            <div id="div-prop" style="{{$divprop}}">
                                <div class="row" height="50%">
                                    <label class="imovel-valor">Proprietário: {{$cli->IMB_CLT_NOME}}</label>
                                </div>
                                <div class="row" height="50%">
                                    <label class="imovel-valor">Telefone(s): {{$fone}}</label>
                                </div>
                                <div class="row" height="50%">
                                    <label class="imovel-valor">Email: {{$cli->IMB_CLT_EMAIL}}</label>
                                </div>
                                <div class="row" height="50%">
                                </div>
                            </div>
                            <div class="row" height="50%">
                                <label class="imovel-valor">{{$endereco}} - {{$imv->CEP_BAI_NOME}} -  {{$imv->IMB_IMV_CIDADE}}({{$imv->IMB_IMV_ESTADO}}) - Cep: {{$imv->IMB_IMV_ENDERECOCEP}}</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Comissões:</div>
                        <div class="col-md-5 div-box">Captador: {{$cap}}</div>
                        <div class="col-md-2 div-box-grey">Padrão:</div>
                        <div class="div-center" id="div-padrao"></div>
                        
                    </div>
                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Finalidade:</div>
                        <div class="col-md-2 div-box div-center" >{{$imv->IMB_IMV_FINALIDADE}}</div>
                        <div class="col-md-2 div-box-grey">Aceita Financ.:</div>
                        <div class="col-md-2 div-box div-center" id="div-aceitafinanc"></div>
                        <div class="col-md-2 div-box div-center">-</div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Empreendimento:</div>
                        <div class="col-md-6 div-box">{{$condominio}}</div>
                        <div class="col-md-1 div-box-grey">$ Cond.</div>
                        <div class="col-md-2 div-box">R$ {{number_format($imv->imb_imv_valorcondominio, 2, ',', '.')}}</div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Situação Imóvel:</div>
                        <div class="col-md-1 div-box"> {{$status}}</div>
                        <div class="col-md-2 div-box-grey">Ponto Referência:</div>
                        <div class="col-md-6 div-box">{{$imv->IMB_IMV_PROXIMIDADE}}</div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Autorização Negociação:</div>
                        <div class="col-md-1 div-box"> </div>
                        <div class="col-md-2 div-box-grey">Usou FGTS ult.3 anos?</div>
                        <div class="col-md-1 div-box"></div>
                        <div class="col-md-2 div-box-grey">Aceita Permuta?</div>
                        <div class="col-md-1 div-box" id="div-aceitapermuta"></div>
                        <div class="col-md-1 div-box-grey">-</div>
                        <div class="col-md-1 div-box">-</div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Medida do Terreno:</div>
                        <div class="col-md-2 div-box"> {{$imv->IMB_IMV_MEDTER}}</div>
                        <div class="col-md-1 div-box-grey">A.Const.</div>
                        <div class="col-md-2 div-box">{{$imv->IMB_IMV_ARECON}}</div>
                        <div class="col-md-1 div-box-grey">A.Total</div>
                        <div class="col-md-2 div-box">{{$imv->IMB_IMV_ARETOT}}</div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Posição:</div>
                        <div class="col-md-1 div-box" id="div-posicao"> </div>
                        <div class="col-md-1 div-box-grey">Pos.Solar</div>
                        <div class="col-md-1 div-box" id="div-posicaosolar"></div>
                        <div class="col-md-1 div-box-grey">Á Útil</div>
                        <div class="col-md-2 div-box">{{$imv->IMB_IMV_AREUTI}}</div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Piso:</div>
                        <div class="col-md-9 div-box" id="div-piso"> </div>
                    </div>

                    
                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Armários:</div>
                        <div class="col-md-9 div-box"> </div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Íntima:</div>
                        <div class="col-md-9 div-box"> </div>
                    </div>
                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Lazer:</div>
                        <div class="col-md-9 div-box"> </div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Serviços:</div>
                        <div class="col-md-9 div-box"> </div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Infraestrutura:</div>
                        <div class="col-md-9 div-box"> </div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Valor do IPTU:</div>
                        <div class="col-md-2 div-box"> R$0,00 </div>
                        <div class="col-md-1 div-box-grey">IPTU:</div>
                        <div class="col-md-2 div-box">  </div>
                        <div class="col-md-1 div-box-grey">Energia:</div>
                        <div class="col-md-2 div-box">  </div>
                    </div>


                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Local das Chaves:</div>
                        <div class="col-md-2 div-box"> </div>
                        <div class="col-md-2 div-box-grey">Ano Construção</div>
                        <div class="col-md-1 div-box"></div>
                        <div class="col-md-2 div-box-grey">Ano Reforma:</div>
                        <div class="col-md-1 div-box">  </div>
                    </div>

                    <div class="col-md-12 div-linha-comercial  quadro-border ">
                        <div class="col-md-3 div-box-grey-comercial">Condições Comerciais:</div>
                        <div class="col-md-9 ">  </div>
                    </div>

                    <div class="col-md-12 div-linha  quadro-border ">
                        <div class="col-md-3 div-box-grey">Número Matrícula:</div>
                        <div class="col-md-2 ">  </div>
                        <div class="col-md-2 div-box-grey">Inscr.Água:</div>
                        <div class="col-md-2 div-box">  </div>
                        <div class="col-md-2 div-box-grey">Tem Placa:</div>
                        <div class="col-md-1 div-box">  </div>
                    </div>


                    <div class="col-md-12 div-linha-comercial  quadro-border ">
                        <div class="col-md-3 div-box-grey-comercial">Observações Internas:</div>
                        <div class="col-md-9 ">  </div>
                    </div>



                <table  id="tbleventos" class="table table-striped table-bordered table-hover topics" >
                </table>                
                <div class="row row-bottom-margin">
                </div>
                <br>
                <div class="row row-bottom-margin">
                </div>
                <hr>
    		</div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>

            $(document).ready(function() 
            {
                cargaImovel()
            });

            function cargaImovel()
            {
                url=    "{{route('imovel.carga')}}/"+$("#IMB_IMV_ID").val();
  //              console.log('url');

                $.ajax(
                {
                    url:url,
                    type:'get',
                    async:false,
                    success:function( data )
                    {
//                        alert('data: '+data.IMB_IMV_PADRAO)
                        if( data.IMB_IMV_PADRAO == 'A')
                            $('#div-padrao').html( 'Alto')
                        else
                        if( data.IMB_IMV_PADRAO == 'M')
                            $('#div-padrao').html( 'Médio')
                        else
                        if( data.IMB_IMV_PADRAO == 'B')
                            $('#div-padrao').html( 'Baixo')
                        else
                            $('#div-padrao').html( 'Não Informado') ;

                        if( data.IMB_IMV_ACEITAFINANC =='S' ) 
                            $("#div-aceitafinanc").html('Sim')
                        else
                        if( data.IMB_IMV_ACEITAFINANC =='N' ) 
                            $("#div-aceitafinanc").html('Não');
                        else
                            $("#div-aceitafinanc").html('Não Informado');

                        if( data.IMB_IMV_PERMUTA =='S')
                            $("#div-aceitapermuta").html( 'Sim')
                            else
                        if( data.IMB_IMV_PERMUTA =='N')
                            $("#div-aceitapermuta").html( 'Não')
                        else
                            $("#div-aceitapermuta").html( 'Não Informado');


                        if( data.IMB_IMV_POSICAO =='F')
                            $("#div-posicao").html( 'Frente')
                        else
                        if( data.IMB_IMV_POSICAO =='U')
                            $("#div-posicao").html( 'Fundo')
                        else
                        if( data.IMB_IMV_POSICAO =='L')
                            $("#div-posicao").html( 'Lateral')
                        else
                            $("#div-posicao").html( 'Não Informado');

                        if( data.IMB_IMV_ORIENTACAOSOLAR =='0')
                            $("#div-posicaosolar").html( 'Não Informado')
                        else
                        if( data.IMB_IMV_ORIENTACAOSOLAR =='L')
                            $("#div-posicaosolar").html( 'Leste')
                        else
                        if( data.IMB_IMV_ORIENTACAOSOLAR =='M')
                            $("#div-posicaosolar").html( 'Manhã')
                        else
                        if( data.IMB_IMV_ORIENTACAOSOLAR =='N')
                            $("#div-posicaosolar").html( 'Norte')
                        else
                        if( data.IMB_IMV_ORIENTACAOSOLAR =='O')
                            $("#div-posicaosolar").html( 'Oeste')
                        else
                        if( data.IMB_IMV_ORIENTACAOSOLAR =='S')
                            $("#div-posicaosolar").html( 'Sul')
                        else
                        if( data.IMB_IMV_ORIENTACAOSOLAR =='T')
                            $("#div-posicaosolar").html( 'Tarde');
                        
                    }
                });
            
            }


            function imprimir()
            {
                var conteudo = document.getElementById('print').innerHTML,
                tela_impressao = window.open('about:blank');
                tela_impressao.document.write(conteudo);
                tela_impressao.window.print();
                tela_impressao.window.close();
            }
            </script>

		</body>
	</head>

    