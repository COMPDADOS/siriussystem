<!DOCTYPE html>
<html>
	<head>

        <style>

.topics tr { 
    overflow: hidden;
    height: 10px;
    white-space: nowrap;
}

.profile
    {
        width: 45%;
        height: 45%;

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
		<title>Campanha 1</title>
        <body >
            <div class="container">

                <hr class="px1-white " width="100%" >
                <div class="row div-left">
                    <img src="https://www.compdados.com.br/sys/storage/images/1/logos/logo.jpg" alt="alt-logo">
                </div>

                <br><br>
                <div class="row row-bottom-margin">
                    <div class="row">
                        <p></p>
                    </div>
                    <div class="col-xs-6 div-center">
                        <div class="row">
                            <p id="i-titulo" style="margin: -2;" class="titulo-empresa-center " >
                            Olá amigos da {{$cl->IMB_CLT_NOME}}
                            </p>
                        </div>
                    </div>
                </div>

                <br><br>
                <div class="row cardtitulo-20-center">
                <p>
                    Temos o imenso prazer em poder lhes informar que já estamos atendendo Palmas e grande região.  
                    <br>
                    <br> Nossos produtos voltados para área imobiliária são de extrema necessidade e custos que vale a pena conferirem. 
                    <br>
                    <br><u><i> Aliás cobrimos qualquer oferta dentre os softwares e aplicativos do mercado voltado para área imobiliária.</i></u>
                    <br><br> E como gostaríamos de tê-los como clientes, temos ofertas imperdíveis para pequenas imobiliárias e imobiliárias que estão iniciando suas operações,
                    com carência que pode chegar até 5 meses para pagamento da primeira mensalidade, sem taxa de implantação, ou seja,
                    assim que você passar a ter nossos produtos, imediatamente iremos fazer todo o processo de instalação e treinamento sem qualquer custo.
                    <br><br>Isso sim é parceria de sucesso,  e parceria acreditando no crescimento de cada um de nós.
                    <br><br> Entre em contato conosco e se surpreenda, com nossos produtos e principalmente com nosso superte técnico atuante.
                    <br><br> Abraços a todos

                </p>
                </div>
                <div class="row"><p>&nbsp;</p></div>
                <div class="row"><p>&nbsp;</p></div>

                <div class="row"><p>&nbsp;</p></div>
                <div class="row"><p>&nbsp;</p></div>


                <div class="col-xs-12 div-center">
                        <img class="profile" src="https://www.compdados.com.br/sys/storage/images/{{Auth::user()->IMB_IMB_ID}}/banners/camp1_img1.jpg" alt="alt-logo">
                        <img class="profile" src="https://www.compdados.com.br/sys/storage/images/{{Auth::user()->IMB_IMB_ID}}/banners/camp1_img2.jpg" alt="alt-logo">
                </div>

            </div>
        </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
</body>
</head>





 

