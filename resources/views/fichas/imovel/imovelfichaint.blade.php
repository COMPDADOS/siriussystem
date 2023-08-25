

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Impressão de Ficha </title>

    <style type="text/css" media="all">
        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        .div-left
            {
                text-align:left;
            }

        ul {
            list-style: none;
            padding: 0px;
        }

        body {
            margin: 5px;
        }

        h1 {
            font-size: 14px;
        }

        p {
            margin-bottom: 5px;
        }

        table {
            border-collapse: collapse;
            font-size: 11px;
            border: solid #000 !important;
            border-width: 1px !important;
        }

            table tr {
                height: 21px;
            }

                table tr th {
                    text-align: left;
                    padding: 4px;
                    font-size: 11px;
                    border: solid #000 !important;
                    border-width: 1px !important;
                }

                table tr td {
                    padding: 3px;
                    border: 1px solid #000;
                    border: solid #000 !important;
                    border-width: 1px !important;
                    height:80%;
                }

                    table tr td table {
                        float: left;
                        margin: 2px;
                        font-size: 10px;
                        border: none;
                    }

        .style1 {
            font-size: 18px;
            font-weight: bold;
        }

        .style3 {
            font-size: 14px;
            font-weight: bold;
        }

        .classordem {
            width: 250px;
            float: left;
        }

        .detalhes {
            padding: 0px !important;
            line-height: 2 !important;
        }

            .detalhes li {
                list-style: none !important;
            }

    </style>
</head>
<body>
    <input type="hidden" id="IMB_IMV_ID" value="{{$imv->IMB_IMV_ID}}">
    <input type="hidden" id="completa" value="{{$divprop}}">
    <table width="100%">

        <tr>
            <td>
                <img src="{{url('')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/logos/logo.jpg" 
                    alt='logo' width='120' height='60' />
            </td>
            <td colspan='5'>
                <ul>
                    <li><strong>{{$imb->IMB_IMB_NOME}}</strong></li>
                    <li>{{$imb->IMB_IMB_ENDERECO}} {{$imb->IMB_IMB_ENDERECONUMERO}} - {{$imb->CEP_BAI_NOME}} - {{$imb->CEP_CID_NOME}}-{{$imb->CEP_UF_SIGLA}}</li>
                    <li>{{$imb->IMB_IMB_TELEFONE1}} &nbsp;-&nbsp; Creci: {{$imb->IMB_IMB_CRECI}}</li>
                    <li>Ficha impressa por: {{$atd->IMB_ATD_NOME}}</li>
                    <li>Data: {{date("d-m-Y H:i")}}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div class='classordem'>
                    <img src="{{url('')}}/storage/images/{{$imv->IMB_IMB_ID}}/imoveis/{{$imv->IMB_IMV_ID}}/{{$image}}" 
                            style="width: 220px; height:150px;float:left; border-right: 20px solid #FFF;" />
                </div>
                <p>
                    <label><span class='style3'>{{$imv->IMB_IMV_REFERE}} ({{$tim->IMB_TIM_DESCRICAO}})<span></label>
                </p>
                <p>
                    <span class='style3'>
                        Valor Venda: R$ {{number_format($imv->IMB_IMV_VALVEN, 2, ',', '.')}} / Valor Locação: R$ {{number_format($imv->IMB_IMV_VALLOC, 2, ',', '.')}}
                    </span>
                    <br />
                </p>
                <div id="div-prop" style="{{$divprop}}">
                    <p>Propriet&aacute;rio: {{$cli->IMB_CLT_NOME}}
                        <br />Data atualiza&ccedil;&atilde;o: 29/01/2021
                        <br />Telefone(s): {{$fone}}
                    </p>
                </div>
                <p>
                    <br/><span class='style3'>{{$endereco}} - {{$imv->CEP_BAI_NOME}} - {{$imv->IMB_IMV_CIDADE}}({{$imv->IMB_IMV_ESTADO}}) - Cep: {{$imv->IMB_IMV_ENDERECOCEP}}</label>
                </p>

            </td>
        </tr>
        <tr>
            <td>Comissões:</td>
            <td colspan="3">Captador: {{$cap}}</td>
            <td>Padr&atilde;o:</td>
            <td id="div-padrao"> &nbsp;</td>
        </tr>
        <tr>
            <td>Finalidade:</td>
            <td>{{$imv->IMB_IMV_FINALIDADE}}&nbsp;</td>
            <td>Aceita financiamento?</td>
            <td id="div-aceitafinanc"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Empreendimento:</td>
            <td colspan="3">{{$condominio}}</td>
            <td>R$ cond.</td>
            <td>{{number_format($imv->imb_imv_valorcondominio, 2, ',', '.')}}</td>
        </tr>
        <tr>
            <td>Ponto de Referência:</td>
            <td>{{$imv->IMB_IMV_PROXIMIDADE}}</td>
            <td>Precisa de reforma?</td>
            <td>Não informado</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Situação do Imóvel:</td>
            <td>{{$status}}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Autorizado p/ negociação?</td>
            <td></td>
            <td>Usou FGTS nos Últimos 3 anos?</td>
            <td></td>
            <td>Aceita permuta?</td>
            <td id="div-aceitapermuta"></td>
        </tr>
        <tr>
            <td>Área construídada:</td>
            <td>{{$imv->IMB_IMV_ARECON}}</td>
            <td>Área Total:</td>
            <td>{{$imv->IMB_IMV_ARETOT}}</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Dimensão do terreno:</td>
            <td>{{$imv->IMB_IMV_MEDTER}}</td>
            <td></td>
            <td></td>
            <td>Face:</td>
            <td id="div-posicaosolar"></td>
        </tr>
        <tr>
            <td>Posição:</td>
            <td id="div-posicao"></td>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>Garantia de locação aceita pelo proprietário:</td>
            <td colspan="2"></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="6">
                <ul class='detalhes'>
                    <li><strong>Piso:</li>
                    <li><strong>Armários:</strong></li>
                    <li><strong>Íntima:</strong></li>
                    <li><strong>Social:</strong></li>
                    <li><strong>Lazer:</strong></li>
                    <li><strong>Serviços:</strong></li>
                    <li><strong>Infraestrutra:</strong>Tipo de vaga:</li>
                </ul>
            </td>
            </tr>
                <tr>
                    <td>Valor do IPTU:</td>
                    <td>R$ {{number_format($imv->IMB_IMV_VALORIPTU, 2, ',', '.')}}&nbsp;</td>
                    <td>IPTU:</td>
                    <td>{{$imv->IMB_IMV_IPTU}}</td>
                    <td>Eletricidade:</td>
                    <td>{{$imv->IMB_IMV_CPFLINSCRICAO}}</td>
                </tr>
                <tr>
                    <td>Local da chave:</td>
                    <td>{{$imv->IMB_IMV_CHAVES}}</td>
                    <td>Ano da construção:</td>
                    <td>{{$imv->IMB_IMV_ANOCONSTRUCAO}}</td><td>Ano da reforma:</td>
                    <td></td>
                </tr>
                <tr><td>Condi&ccedil;&atilde;o comercial</td>
                    <td height="50" colspan="5"></td>
                </tr>
                <tr>
                    <td>Número Matrícula:</td>
                    <td>{{$imv->IMB_IMV_MATRIC}}</td>
                    <td>Cód. Rede de Água:</td>
                    <td>{{$imv->IMB_IMV_DAEINSCRICAO}}</td>
                    <td >Placa no local:</td>
                    <td id="div-placa"></td>
                </tr>
                <tr style="{{$divprop}}">
                        <td>Comentários internos:</td>
                        <td height="50" colspan="5">{{$imv->IMB_IMV_OBSERV}}</td>
                </tr>
            </table>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
        	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
            <script type="text/javascript">
                    window.print();
                    document.unload = function () { GUnload(); }

                    $(document).ready(function() 
            {
                if( $("#completa").val() != 'Display:none'  )
                    $("div-coment-int").hide();
                cargaImovel()
            });

            function cargaImovel()
            {
                url=    "{{route('imovel.carga')}}/"+$("#IMB_IMV_ID").val();

                $.ajax(
                {
                    url:url,
                    type:'get',
                    async:false,
                    success:function( data )
                    {
                        if( data.IMB_IMV_PLACA == 'S')
                            $('#div-placa').html( 'Sim')

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


    </script>
</body>

</html>
