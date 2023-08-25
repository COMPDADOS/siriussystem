<!DOCTYPE html>
<html>
	<head>

        <style>

.topics tr { 
    overflow: hidden;
    height: 10px;
    white-space: nowrap;
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

            .fundo
            {
                background-color:#f5f5f0;
            }
        
        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		<title>Boas Vidas ao Locatário</title>
        <body >
            <div class="container">
                <div class="row row-bottom-margin">
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="col-xs-6 div-center">
                        <div class="row">
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                            PARABÉNS POR ALUGAR O SEU NOVO IMÓVEL COM A {{$objDados->IMB_IMB_NOME}}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="px1-white " width="100%" >
                <div class="row"><p>&nbsp;</p></div>

                <div class="row">
                    <p style="margin: -2;" class="contrato-info" >Olá {{$objDados->IMB_CLT_NOME}}</p>
                </div>                    
                
                <div class="row"><p>&nbsp;</p></div>
                <div class="row">
                <p>
                    Vimos parabenizá-lo por esta locação e informar que estamos à disposição para auxiliá-lo em todas as dúvidas e reclamações que possa vir a ter sobre o referido imóvel.
                    Queremos informa-lo sobre o presente contrato e outros detalhes importantes para efetuar uma ótima locação.
                </p>
                </div>
                <div class="row"><p>&nbsp;</p></div>
                <div class="row"><p>&nbsp;</p></div>

                <p> <b><u>Informações sobre o contrato:</u></b> </p>
                <p> Objeto da locação: <b>{{$objDados->enderecoimovel}}</b></p>
                <p> Prazo da locação: <b>{{$objDados->IMB_CTR_DURACAO}} meses.</b></p>
                <p> Início e término do contrato: <b>{{$objDados->IMB_CTR_INICIO}} a {{$objDados->IMB_CTR_TERMINO}}</b></p>
                <p> Valor da locação: <b>{{$objDados->IMB_CTR_VALORALUGUEL}}</b></p>
                <p> Data para reajuste: <b>{{$objDados->IMB_CTR_DATAREAJUSTE}}</b></p>
                <p> Data para pagamento:<b>{{$objDados->IMB_CTR_DIAVENCIMENTO}} de cada mês</b></p>
                <p></p>
                <p ><b><i>(o atraso no pagamento do aluguel acarretará multa de 10% + juros diário)</i></b></p>
                </p>
                <div class="row"><p>&nbsp;</p></div>
                <div class="row"><p>&nbsp;</p></div>

                <p><b><u>Informações para uma boa locação:</u> </b></p>
                <p>  1)       Trocar o segredo das fechaduras das portas de entrada;</p>
                <p>  2)       Não furar cerâmicas ou azulejos;</p>
                <p>  3)       Pagar o aluguel em dia para não gerar cobranças judiciais</p>
                <p>  4)       Entregar na imobiliária, em duas vias, contestação do laudo de vistoria inicial em no máximo 07 dias após pegar as chaves do imóvel;</p>
                <p>  5)       Caso necessário, fazer em duas vias a reclamação e protocolar na imobiliária.</p>
                <p>  6)       Antes de entregar seu imóvel, envie o AVISO DE NOTIFICAÇÃO PARA DESOCUPAÇÃO EM 30 DIAS, ou venha até nosso escritório e peça um modelo;</p>
                <p>  7)       Fiadores e locatários são responsáveis solidários na locação, portanto, quaisquer cobranças executadas ou pela imobiliária ou pelo escritório de advocacia sempre será direcionado a ambas as partes;</p>
                <p>  8)       Sempre leia seu contrato de locação e o laudo de vistoria. Todo e qualquer problema sempre serão resolvidos embasados neles.</p>

                <div class="row"><p>&nbsp;</p></div>
                <div class="row"><p>&nbsp;</p></div>

                <div class="col-xs-6 div-center">
                    <p class="div-center">
                        <img src="{{env('APP_URL')}}/storage/images/1/logos/logo.jpg" alt="alt-logo">
                        </div>
                    </p>                    

                <p class="titulo-empresa-center">{{$objDados->IMB_IMB_NOME}}</p>
                <p  class="titulo-empresa-center">{{$objDados->IMB_IMB_TELEFONE}}</p>
                <p  class="titulo-empresa-center">{{$objDados->IMB_IMB_ENDERECO}}</p>
                <p  class="titulo-empresa-center">{{$objDados->IMB_IMB_URL}} - {{$objDados->IMB_IMB_EMAIL}}</p>
                
            </div>
        </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>


            <script>
                $("#i-column1").html('NOVA COLUNA');
            
            </script>
</body>
</head>





 

