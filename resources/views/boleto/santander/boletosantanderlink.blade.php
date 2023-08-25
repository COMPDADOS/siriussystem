<!DOCTYPE html>
<html>
	<head>

    <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />    

    <style>

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
	<title>Boleto</title>
	<body>
        <div class="container">

            <div class="row div-center">
            <label classe="control-label"><a href="{{route('boleto.santander')}}/{{$cp->IMB_CGR_ID}}/S'">Click aqui para exibir o boleto</a></label>
            </div>

           <div class="row row-bottom-margin">
               <div class="col-xs-2 div-left">
                   <img src="http://www.siriussystem.com.br/sys/storage/images/3/logos/logo_180_135_semimagem.jpg" alt="alt-logo">
               </div>
               <div class="col-xs-6 div-center">
                   <p style="margin: -2;" class="titulo-empresa-center " >
                       {{$im->IMB_IMB_NOME}}
                   </p>
                   <p style="margin: -2;" class="titulo-10-black" >
                       {{$im->ENDERECO }}-{{ $im->CEP_BAI_NOME }}-{{ $im->CEP_CID_NOME}}({{$im->CEP_UF_SIGLA}})
                   </p>
                   <p style="margin: -2;" class="titulo-10-black" >{{ $im->IMB_IMB_URL}}</p>
                   <p style="margin: -2;" class="titulo-10-black" >Fones:{{$im->TELEFONE }}- Creci: {{$im->IMB_IMB_CRECI}}</p>
               </div>
               <div class="col-xs-3 div-right">
                   <p style="margin: -2;">Vencimento</p>
                   <p style="margin: -2;"><span class="sub-titulo-nome">
                   {{$dadosboleto["data_vencimento"]}}</span></p>
                   <p style="margin: -2;">Pasta</p>
                   <p style="margin: -2;"><span class="sub-titulo-nome">{{$ctr->IMB_CTR_REFERENCIA}} </span></p>
                    
               </div>
           </div>
           <hr class="px2-blue " width="100%" >
           <div class="row row-bottom-margin">
               <div class="col-xs-12 sub-titulo-nome-left">
                   Locatário: <span class="titulo-11-black-italic">{{$dadosboleto["sacado"]}}</span>
               </div>
           </div>
           <div class="row row-bottom-margin">
               <div class="col-xs-12 sub-titulo-nome-left">
                           Imóvel: <span class="titulo-11-black-italic">{{$imv->IMB_IMV_ENDERECOTIPO}} 
                           {{$imv->IMB_IMV_ENDERECO}}  {{$imv->IMB_IMV_ENDERECONUMERO}} {{$imv->IMB_IMV_NUMAPT}}
                           {{$imv->IMB_IMV_ENDERECOCOMPLEMENTO}} Bairro: {{$imv->BAIRROIMOVEL}} 
                           - Cidade: {{$imv->IMB_IMV_CIDADE}}</span>
               </div>
           </div>
           <hr class="px2-black">

           <table  id="tbleventos" class="table table-striped table-bordered table-hover topics" >
               <thead class="thead-dark">      
                   <tr >
                       <th width="6%" style="text-align:center"> Código </th>
                       <th width="20%" style="text-align:center"> Histórico </th>
                       <th width="3%" style="text-align:center"> </th>
                       <th width="10%" style="text-align:center"> Valor </th>
                       <th width="61%" style="text-align:center"> Observação </th>
                   </tr>
               </thead>
               <tbody>
                
                  @foreach( $cpi as $item)
                    <tr>
                      <td>{{$item->IMB_TBE_ID}}</td>
                      <td>{{$item->IMB_TBE_DESCRICAO}}</td>
                      <td>{{$item->IMB_RLT_LOCATARIOCREDEB}}</td>
                      <td>R$ {{ number_format($item->IMB_LCF_VALOR, 2, ',', '')}}</td>
                      <td>{{$item->IMB_LCF_OBSERVACAO}}</td>
                    </tr>
                  @endforeach
               </tbody>
           </table>                
       </div>

       
          
	</body>
</head>

    