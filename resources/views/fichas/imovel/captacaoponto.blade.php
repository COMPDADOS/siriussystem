<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Impressão de Ficha</title>
    <script>
        window.print();
        function TABLE1_onclick() { }
    </script>
    <style type="text/css" media="all">
        * { font-family: Arial, Helvetica, sans-serif; margin: 0; }
        body {  margin: 5px; }
        h1{ font-size: 14px;}

        p{ line-height: 22px;}
        table { border: 1px solid #000; border-collapse: collapse;font-size: 11px; }
        table tr th { text-align: left; border: 1px solid #000; padding: 4px; font-size: 10px; }
        table tr td { padding: 2px; border: 1px solid #000; }
        .white{ color: #FFF;}
        .detalhes {padding:0px !important; line-height:2 !important; }
        .detalhes li { list-style:none !important; }
    </style>
</head>
<body style="background-color: #ffffff">
    <table id="TABLE1" onclick="return TABLE1_onclick()">
    <tr>
            <td>
                <img src="{{env('APP_URL')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/logos/logo.jpg" 
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
            <td colspan="6" align="center">
                <h1>
                    Ficha de Capta&ccedil;&atilde;o de Im&oacute;vel (Ponto) - Data:____/____/____</h1>
            </td>
        </tr>
        <tr>
            <td style="height: 21px">
                Nome do propriet&aacute;rio:
            </td>
            <td colspan="3" style="height: 21px">
                &nbsp;
            </td>
            <td colspan="2" style="height: 21px">
                E-mail:
            </td>
            <!-- <td >&nbsp;</td>-->
        </tr>
        <tr>
            <td>
                Telefones:
            </td>
            <td colspan="5">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 16px">
                Valor de venda:
            </td>
            <td width="20%" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                Valor de loca&ccedil;&atilde;o:
            </td>
            <td width="20%" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                 Padr&atilde;o: 
            </td>
            <td style="height: 16px; width: 238px;">
                (&nbsp;&nbsp;&nbsp;)Alto (&nbsp;&nbsp;&nbsp;)Baixo (&nbsp;&nbsp;&nbsp;)M&eacute;dio (&nbsp;&nbsp;&nbsp;)Regular 
            </td>
        </tr>
        <tr>
            <td style="height: 21px">
                Finalidade:
            </td>
            <td style="height: 21px">
                (<span class='white'>__</span>)Com&nbsp;
                <td style="height: 21px">
                    Financiado?
                </td>
                <td style="height: 21px">
                    (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)N&atilde;o
                </td>
                <td style="height: 21px">
                    Localização:
                </td>
                <td style="height: 21px; width: 238px;">
                    (<span class='white'>__</span>)Privilegiada&nbsp; (<span class='white'>__</span>)Ótima&nbsp;
                    (<span class='white'>__</span>)Média&nbsp; (<span class='white'>__</span>)Regular
                </td>
        </tr>
        <!--Edificio/ Condominio/ Valor Cond.-->
        <tr>
            <td style="height: 28px">Nome do Condomínio:</td><td style="height: 28px">&nbsp;</td><td style="height: 28px">R$ Condomínio:</td><td style="height: 28px">&nbsp;</td><td style="height: 28px"></td><td style="height: 28px">&nbsp;</td>
        </tr>
        <!--Situação/ Ocupado até/ Pelo-->
        <tr>
            <td>Situa&ccedil;&atilde;o do im&oacute;vel:</td><td>(&nbsp;&nbsp;&nbsp;)Des (&nbsp;&nbsp;&nbsp; )Ocu (&nbsp;&nbsp;&nbsp;)Res (&nbsp;&nbsp;&nbsp;)Con(&nbsp;&nbsp;&nbsp;)Lan</td><td>Ocupado at&eacute;:</td><td>____/____/____</td><td>Pelo:</td><td style="width: 238px">(&nbsp;&nbsp;&nbsp;)Prop (&nbsp;&nbsp;&nbsp;)Inq</td>
        </tr>
        <!--autorizado/ Exclusividade/ Inicio Contrato-->
        <tr>
            <td>
                Autorizado p/ negocia&ccedil;&atilde;o?
            </td>
            <td>
                (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)N&atilde;o
            </td>
            <td>
                Exclusividade:
            </td>
            <td>
                (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)N&atilde;o
            </td>
            <td>
                In&iacute;cio do contrato:
            </td>
            <td style="width: 238px">
                ____/____/____
            </td>
        </tr>
        <!--Validade/ FGTS-->
        <tr>
            <td>
                Validade:
            </td>
            <td>
                _____dias
            </td>
            <td>Usou FGTS nos &uacute;ltimos 3 anos?</td><td>(&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)N&atilde;o</td>
            <td>
            </td>
            <td style="width: 238px">
            </td>
        </tr>
        <tr>
            <td style="width: 238px">
                &Aacute;rea total:
            </td>
            <td style="width: 11px">&nbsp;</td>

            <td>
                &Aacute;rea &uacute;til:
            </td>
            <td>&nbsp;</td>
            <td style="width: 35px" colspan="" rowspan="">Face:</td><td>(&nbsp;&nbsp;&nbsp;)L (&nbsp;&nbsp;&nbsp;)O (&nbsp;&nbsp;&nbsp;)N (&nbsp;&nbsp;&nbsp;)S</td>
        </tr>
        <tr>
            
        </tr>
        </tr>
        <tr>
            <td colspan="6">
                <ul class='detalhes'><li><strong>Piso:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Aquecido&nbsp;&nbsp;(&nbsp;&nbsp;)Ardósia&nbsp;&nbsp;(&nbsp;&nbsp;)Bloquete&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete de acrílico&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete de madeira&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete de nylon&nbsp;&nbsp;(&nbsp;&nbsp;)Cerâmica&nbsp;&nbsp;(&nbsp;&nbsp;)Cimento queimado&nbsp;&nbsp;(&nbsp;&nbsp;)Contrapiso&nbsp;&nbsp;(&nbsp;&nbsp;)Emborrachado&nbsp;&nbsp;(&nbsp;&nbsp;)Granito&nbsp;&nbsp;(&nbsp;&nbsp;)Laminado&nbsp;&nbsp;(&nbsp;&nbsp;)Mármore&nbsp;&nbsp;(&nbsp;&nbsp;)Piso elevado&nbsp;&nbsp;(&nbsp;&nbsp;)Piso frio&nbsp;&nbsp;(&nbsp;&nbsp;)Porcelanato&nbsp;&nbsp;(&nbsp;&nbsp;)Tábua&nbsp;&nbsp;(&nbsp;&nbsp;)Taco de madeira&nbsp;&nbsp;(&nbsp;&nbsp;)Vinílico</li><li><strong>Armários:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Cozinha&nbsp;&nbsp;(&nbsp;&nbsp;)Escritório</li><li><strong>Íntima:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Nº de banheiros&nbsp;&nbsp;(&nbsp;&nbsp;)Lavabo</li><li><strong>Social:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Escritório&nbsp;&nbsp;(&nbsp;&nbsp;)Nº de salas&nbsp;&nbsp;(&nbsp;&nbsp;)Sacada</li><li><strong>Serviços:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Copa&nbsp;&nbsp;(&nbsp;&nbsp;)Cozinha&nbsp;&nbsp;(&nbsp;&nbsp;)Recepção&nbsp;&nbsp;(&nbsp;&nbsp;)Zelador</li><li><strong>Infraestrutra:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Alarme&nbsp;&nbsp;(&nbsp;&nbsp;)Altura do pé direito&nbsp;&nbsp;(&nbsp;&nbsp;)Ar condicionado&nbsp;&nbsp;(&nbsp;&nbsp;)Área do mezanino&nbsp;&nbsp;(&nbsp;&nbsp;)Depósito&nbsp;&nbsp;(&nbsp;&nbsp;)Divisória&nbsp;&nbsp;(&nbsp;&nbsp;)Número de divisórias&nbsp;&nbsp;(&nbsp;&nbsp;)Elevador&nbsp;&nbsp;(&nbsp;&nbsp;)Gerador&nbsp;&nbsp;(&nbsp;&nbsp;)Imóvel no litoral&nbsp;&nbsp;(&nbsp;&nbsp;)Em costeira/Pé na areia&nbsp;&nbsp;(&nbsp;&nbsp;)Vista para o mar&nbsp;&nbsp;(&nbsp;&nbsp;)Beira Mar&nbsp;&nbsp;(&nbsp;&nbsp;)Metros da praia&nbsp;&nbsp;(&nbsp;&nbsp;)Interfone&nbsp;&nbsp;(&nbsp;&nbsp;)Internet&nbsp;&nbsp;(&nbsp;&nbsp;)Mezanino&nbsp;&nbsp;(&nbsp;&nbsp;)Mobiliado&nbsp;&nbsp;(&nbsp;&nbsp;)Nº de andares&nbsp;&nbsp;(&nbsp;&nbsp;)Nº do andar&nbsp;&nbsp;(&nbsp;&nbsp;)Pé direito duplo&nbsp;&nbsp;(&nbsp;&nbsp;)Portão eletrônico&nbsp;&nbsp;(&nbsp;&nbsp;)Semi-Mobiliado&nbsp;&nbsp;(&nbsp;&nbsp;)TV a cabo&nbsp;&nbsp;(&nbsp;&nbsp;)Vagas cobertas&nbsp;&nbsp;(&nbsp;&nbsp;)Vagas descobertas&nbsp;&nbsp;(&nbsp;&nbsp;)Vagas&nbsp;&nbsp; Tipo de vaga: <u>Não informado</u>&nbsp;&nbsp; Característica da vaga: <u>Não informado</u></li></ul>
            </td>
        </tr>
        <tr>
            <td style="height: 21px">
                Endereço:
            </td>
            <td colspan="3" style="height: 21px">
                &nbsp;
            </td>
            <td style="height: 21px">
                Bairro:
            </td>
            <td style="height: 21px; width: 238px;">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 3px">
                Cidade:
            </td>
            <td style="height: 3px">
                &nbsp;
            </td>
            <td style="height: 3px">
                CEP:
            </td>
            <td style="height: 3px">
                &nbsp;
            </td>
            <td style="height: 3px">
                R$ IPTU:
            </td>
            <td style="height: 3px; width: 238px;">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                Local da chave:
            </td>
            <td>&nbsp;</td><td>Ano da constru&ccedil;&atilde;o:</td><td>&nbsp;</td><td>Ano da reforma:</td><td style="width: 238px">&nbsp;</td>
        </tr>
        <tr>
            <td>
                Condi&ccedil;&atilde;o comercial:
            </td>
            <td height="50" colspan="5">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                IPTU:
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                Eletricidade:
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                Matrícula:
            </td>
            <td style="width: 238px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                 &Aacute;gua: 
            </td>
            <td>
                 &nbsp; 
            </td>
            <td>
                Placa no local:
            </td>
            <td>
                (&nbsp;&nbsp;&nbsp;) Sim (&nbsp;&nbsp;&nbsp;) N&atilde;o
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 48px">
                Descri&ccedil;&atilde;o de an&uacute;ncios (site e jornal):
            </td>
            <td colspan="5" style="height: 48px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 57px">
                Coment&aacute;rio Interno:
            </td>
            <td colspan="10" style="height: 57px">
                &nbsp;
            </td>
        </tr>
    </table>
    <br />
    <center><h1>Autorização de comercialização do imóvel</h1></center><br/>    
    <div>
    <span class="Apple-style-span" style="word-spacing: 0px; font: medium 'Times New Roman';
            text-transform: none; color: rgb(0,0,0); text-indent: 0px; white-space: normal;
            letter-spacing: normal; border-collapse: separate; orphans: 2; widows: 2; webkit-border-horizontal-spacing: 0px;
            webkit-border-vertical-spacing: 0px; webkit-text-decorations-in-effect: none;
            webkit-text-size-adjust: auto; webkit-text-stroke-width: 0px">
    <span class="Apple-style-span" style="word-spacing: 0px; font: medium 'Times New Roman';
            text-transform: none; color: rgb(0,0,0); text-indent: 0px; white-space: normal;
            letter-spacing: normal; border-collapse: separate; orphans: 2; widows: 2; webkit-border-horizontal-spacing: 0px;
            webkit-border-vertical-spacing: 0px; webkit-text-decorations-in-effect: none;
            webkit-text-size-adjust: auto; webkit-text-stroke-width: 0px">
            <span class="Apple-style-span"
                style="font-size: 11px; color: rgb(51,51,51); font-family: arial, verdana, helvetica, sans-serif;
                webkit-border-horizontal-spacing: 1px; webkit-border-vertical-spacing: 1px">
                Fica a <strong>{{$imb->IMB_IMB_NOME}}</strong> autorizada a colocação de placas, anunciar, promover e 
                intermediar a venda e/ou locação do imóvel acima descrito, reservando-nos o direito de intermediação 
                em caso de venda, comissão de ___________ sobre o valor das transações, ou comissão igual ao valor de 1 (um) 
                aluguel no caso de locação a qual será paga no ato da assinatura do contrato. 
                Os proprietários reservam o direito de promover, também, a venda do imóvel sem que 
                haja obrigação em pagar a <strong>{{$imb->IMB_IMB_NOME}}</strong> comissões, desde que o cliente não tenha 
                sido por ela apresentado.
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br /><br /><br />
                </span>
                Nome por extenso:________________________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br /><br />
                </span>
                CPF ou CNPJ:_________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br /><br />
                </span>
                RG:_________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br /><br />
                </span>_________________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br />
                </span>
                Assinatura
            </span>
        </span>    
        </span>
    </div>
</body>
</html>
