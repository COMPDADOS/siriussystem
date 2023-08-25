<!DOCTYPE html>
<html>
	<head>
    <script>
        window.print();
    </script>

        <style>

td { 
    height: 10px;
}

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
        
        </style>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css";>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
		<title>Recibo Locatário</title>
		<body>
			
            <div class="container">
                <div class="row row-bottom-margin">
                    <div class="col-xs-2 div-left">
                        <img src="http://www.siriussystem.com.br/sys/storage/images/3/logos/logo_180_135_semimagem.jpg" alt="alt-logo">
                    </div>
                    <div class="col-xs-6 div-center">
                        <p style="margin: -2;" class="titulo-empresa-center " >
                            {{$imb->IMB_IMB_NOME}}
                        </p>
                        <p style="margin: -2;" class="titulo-10-black" >
                            {{$imb->ENDERECO }}-{{ $imb->CEP_BAI_NOME }}-{{ $imb->CEP_CID_NOME}}({{$imb->CEP_UF_SIGLA}})
                        </p>
                        <p style="margin: -2;" class="titulo-10-black" >{{ $imb->IMB_IMB_URL}}</p>
                        <p style="margin: -2;" class="titulo-10-black" >Fones:{{$imb->TELEFONE }}- Creci: {{$imb->IMB_IMB_CRECI}}</p>
                        <p style="margin: -2;" class="titulo-12" >
                            Cobranças Geradas 
                        </p>                    
                    </div>
                </div>
                <hr class="px2-blue " width="100%" >

                <table  id="tbleventos" class="table table-condensed table-hover table-bordered table-striped" >
                    <thead class="thead-dark">      
                        <tr >
                            <th >Pasta</th>
                            <th>Imóvel</th>
                            <th>Endereço</th>
                            <th>Locatário/Destinatário</th>
                            <th>Vencimento</th>
                            <th>Valor</th>
                            <th>Inconsistência</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $cob as $bol)
                        <tr class="topics">
                            <td>{{$bol->IMB_CTR_REFERENCIA}}</td>
                            <td>{{$bol->IMB_IMV_ID}}</td>
                            <td>{{$bol->IMB_CGR_ENDERECO}}</td>
                            <td>{{$bol->IMB_CGR_DESTINATARIO}}</td>
                            <td>{{date("d/m/Y", strtotime($bol->IMB_CGR_DATAVENCIMENTO))}}</td>
                            <td class="div-right">{{number_format($bol->IMB_CGR_VALOR,2,",",".")}}</td>
                            <td>{{$bol->IMB_CGR_INCONSISTENCIA}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
                <hr>

    		</div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js";></script>
    	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js";></script>
              <script type="text/php">
                window.print;
                    if ( isset($pdf) ) { 
                        $pdf->page_script('
                            if ($PAGE_COUNT > 1) {
                                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                                $size = 10;
                                $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
                                $y = 800;
                                $x = 400;
                                $pdf->text($x, $y, $pageText, $font, $size);
                            } 
                        ');
                    }
                </script>                
		</body>
	</head>
</html>

