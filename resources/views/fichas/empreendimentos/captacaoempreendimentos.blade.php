<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Impressão de Ficha</title>
    <script>
        window.print(); function TABLE1_onclick() { }
    </script>
    <style type="text/css" media="all">
        *
        {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }
        body
        {
            margin: 5px;
        }
        h1
        {
            font-size: 14px;
        }
        p
        {
            height: 70px;
        }
        table
        {
            border: 1px solid #000;
            border-collapse: collapse;
            font-size: 10px;
        }
        table tr th
        {
            text-align: left;
            border: 1px solid #000;
            padding: 2px;
            font-size: 10px;
        }
        table tr td
        {
            padding: 2px;
            border: 1px solid #000;
        }
        .white
        {
            color: #FFF;
        }
        
        .tableInterna
        {
            border: none;
            border-collapse: none;
            font-size: 10px;
        }
        .tableInterna tr th
        {
            text-align: left;
            border: none;
            padding: 1px;
            font-size: 10px;
        }
        .tableInterna tr td
        {
            padding: 1px;
            border: none;
        }
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
                    Ficha de Capta&ccedil;&atilde;o (Condomínio/Edifício) - Data:____/____/____</h1>
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 32px">
                Endereço:
            </td>
            <td width="35%" style="height: 32px">
                &nbsp;
            </td>
            <td width="5%" style="height: 32px">
                Nº:
            </td>
            <td width="10%" style="height: 32px">
                &nbsp;
            </td>
            <td width="10%" style="height: 32px">
                Bairro:
            </td>
            <td width="30%" style="height: 32px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 16px">
                Cidade:
            </td>
            <td width="35%" style="height: 16px">
                &nbsp;
            </td>
            <td width="5%" style="height: 16px">
                UF:
            </td>
            <td width="10%" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                CEP:
            </td>
            <td width="30%" style="height: 16px">
                &nbsp;
            </td>
        </tr>
        
        <tr><td width='10%' style='height: 16px'>Tipo do Condomínio:</td><td colspan='5' style='height: 16px'>(&nbsp;&nbsp;&nbsp;)Casas residenciais&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Prédios residenciais&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Prédios comerciais&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Terrenos ou lotes residenciais&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Terrenos ou lotes comerciais&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Chácaras&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Galpões Comerciais&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Industrial&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Hotel&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='10%' style='height: 16px'>ou Prédio:</td><td colspan='5' style='height: 16px'>(&nbsp;&nbsp;&nbsp;)Residencial&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Comercial&nbsp;&nbsp;&nbsp;</td></tr>
        <tr>
            <td width="10%" style="height: 16px">
                Nome do Condomínio:
            </td>
            <td colspan="5" style="height: 16px">
                &nbsp;
            </td>
        </tr>
        
        <tr><td width='10%' style='height: 16px'>Status Comercial:</td><td colspan='5' style='height: 16px'>(&nbsp;&nbsp;&nbsp;)Padrão&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Lançamento&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Pré-lançamento&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Futuro lançamento&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Últimas unidades&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Revenda&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Pronto para Morar&nbsp;&nbsp;&nbsp;</td></tr>
        <tr>
            <td width="10%" style="height: 16px">
                Sistemas de Vendas:
            </td>
            <td colspan="3" style="height: 16px">
                (&nbsp;&nbsp;&nbsp;)Não Informado (&nbsp;&nbsp;&nbsp;)Preço Fechado (&nbsp;&nbsp;&nbsp;)Preço
                de Custo
            </td>
            <td width="10%" style="height: 16px">
                Plantão Local:
            </td>
            <td style="height: 16px">
                (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)Não
            </td>
        </tr>
        
        <tr><td width='10%' style='height: 16px'>Fase de Construção:</td><td colspan='5' style='height: 16px'>(&nbsp;&nbsp;&nbsp;)Pronto&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Em construção&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Não iniciado&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)Pronto&nbsp;&nbsp;&nbsp;</td></tr>
        <tr>
            <td width="10%" style="height: 16px">
                Hotsite Empreendimento:
            </td>
            <td colspan="3" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                Administradora (empresa):
            </td>
            <td colspan="3" style="height: 16px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 16px">
                Arquitetura (empresa):
            </td>
            <td colspan="3" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                Paisagismo (empresa):
            </td>
            <td colspan="3" style="height: 16px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 16px">
                Fachada:
            </td>
            <td colspan="3" style="height: 16px">
                (&nbsp;&nbsp;&nbsp;)Não Informada (&nbsp;&nbsp;&nbsp;)Moderna (&nbsp;&nbsp;&nbsp;)Neoclássica
            </td>
            <td width="10%" style="height: 16px">
                Incorporadora:
            </td>
            <td colspan="3" style="height: 16px">
                &nbsp;
            </td>
        </tr>

        <tr>
            <td width="10%" style="height: 16px">
                Padrão:
            </td>
            <td colspan="5" style="height: 16px">
                (&nbsp;&nbsp;&nbsp;)Não Informada (&nbsp;&nbsp;&nbsp;)Alto (&nbsp;&nbsp;&nbsp;)Baixo (&nbsp;&nbsp;&nbsp;)Médio
            </td>
        </tr>

        <tr>
            <td width="10%" style="height: 16px">
                Construtora:
            </td>
            <td style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                Valor Mín.:
            </td>
            <td style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                Valor Máx.:
            </td>
            <td style="height: 16px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 32px">
                Descrição:
            </td>
            <td colspan="5" style="height: 32px">
                &nbsp;
            </td>
        </tr>
        
        <tr><td width='10%' style='height: 16px'>Comercial/Industrial</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Centro de convenções&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Docas&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Escritório&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Forro rebaixado&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Lava-rápido&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piso de alta resistência&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piso elevado&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Refeitório&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Shaft de telecomunicações&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Tensão (KVA)&nbsp;&nbsp;&nbsp;</td><td width='25%'>&nbsp</td></tr></table></td></tr><tr><td width='10%' style='height: 16px'>Infraestrutura</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Acessibilidade Universal&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Acesso p/ deficientes&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Água&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Aquecimento de água c/ energia solar&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Aquecimento Elétrico&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Aquecimento Gás&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Ar condicionado&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Área de lazer&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Área terreno&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Área total&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Central Telefônica&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Elevador&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Elevador privativo&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Em costeira/Pé na areia&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Empreendimento no litoral&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Entra de serv. independente&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Entrada de energia elétrica&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Entrada de linha telefônica&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Entrada lateral&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Entrada p/ caminhões&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Escada rolante&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Esgoto&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Esquina&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Esteira rolante&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Estrada asfaltada&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Frente para o mar&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Galeria de águas pluviais&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Gás encanado&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Gerador emergência&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Guias e sarjetas&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Heliponto&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Iluminação pública&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Instalações p/ internet&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Jardim&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Lan House&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Manobrista&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Medição de água individualizada&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Pé direito&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Pista pouso&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Poço artesiano&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Ponte rolante&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Reservatório água&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Rio&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Rua asfaltada&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sala de reunião&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Total de andares&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vaga coberta&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vaga descoberta&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vaga garagem&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vaga recuo&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vestiário&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vestiário para diaristas&nbsp;&nbsp;&nbsp;</td></tr></table></td></tr><tr><td width='10%' style='height: 16px'>Lazer</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Academia&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Área construida&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Auditório&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Bicicletário&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Bosque&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Bricolagem&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Brinquedoteca&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Campo de futebol&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Campo Golfe&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Churrasqueira&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Ciclovia&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Clube&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Espaço Gourmet&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Forno a lenha&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Forno de pizza/pão&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Hidromassagem&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Home theater&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Lago&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Lareira&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Ofurô&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piano-Bar&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piscina&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piscina adulto&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piscina aquecida&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piscina climatizada&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Piscina infantil&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Pista bicicross&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Pista de cooper&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Pista de Skate&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Playground&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Quadra de squash&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Quadra de tênis&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Quadra gramada&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Quadra poliesportiva&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sala fitness&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sala ginástica&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Salão de festas&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Salão de jogos&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Salão de video cinema&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sauna Seca&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sauna úmida&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Solarium&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Spa&nbsp;&nbsp;&nbsp;</td><td width='25%'>&nbsp</td></tr></table></td></tr><tr><td width='10%' style='height: 16px'>Plano/Governo</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Minha Casa Minha Vida&nbsp;&nbsp;&nbsp;</td><td width='25%'>&nbsp</td><td width='25%'>&nbsp</td></tr></table></td></tr><tr><td width='10%' style='height: 16px'>Segurança</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Cabine primária&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Catraca eletrônica&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Cerca elétrica&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Circuito interno de TV&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Guarita blindada&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Guarita de segurança&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Portão eletrônico&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Portaria 24h&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Segurança interna&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Segurança patrimonial&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sistema de incêndio&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sistema de segurança&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vigia externo&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vigilância 24 horas (automóvel)&nbsp;&nbsp;&nbsp;</td><td width='25%'>&nbsp</td></tr></table></td></tr><tr><td width='10%' style='height: 16px'>Serviços</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Central de limpeza e governança&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Escritório Virtual&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Massagista&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Personal Training&nbsp;&nbsp;&nbsp;</td></tr><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Restaurante&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Sala massagem&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)TV a cabo&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Wi-Fi&nbsp;&nbsp;&nbsp;</td></tr></table></td></tr><tr><td width='10%' style='height: 16px'>Social</td><td colspan='5' style='height: 16px'><table width='100%' class='tableInterna'><tr><td width='25%'>(&nbsp;&nbsp;&nbsp;)Estacionamento rotativo&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Lavanderia coletiva&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Praça convivência&nbsp;&nbsp;&nbsp;</td><td width='25%'>(&nbsp;&nbsp;&nbsp;)Vaga para visita&nbsp;&nbsp;&nbsp;</td>
    </table>
</body>
</html>
