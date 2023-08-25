<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geral de Imóveis</title>
    <style>
    body {
  background: rgb(204, 204, 204);
}

       /* style sheet for "A4" printing */ 
       <style>
		    @media print {
			         @page rotated {
					 size: A4 landscape;
			         margin: 3cm;
		      	     }
		  }
	     
.header {
  padding-top: 10px;
  text-align: center;
  border: 2px solid #ddd;
}
table {
  border-collapse: collapse;
  width: 100%;
  font-size: 80%;
}
table th {
  background-color: blue;
  color: white;
  text-align: center;
}
th,
td {
  border: 1px solid #ddd;
  text-align: left;
}
tr:nth-child(even) {
  background-color: #f2f2f2
}

.div-center
{
    text-align:center;
}


.div-right
{
    text-align:right;
}


</style>
</head>
<body onLoad="javascript: printPage();">
<page size="A4">

  <div class="header">
    <div class="div-right" id="i-print">
      <button class="btn btn-secondary" onClick="imprimir()">Imprimir</button>

    </div>

  @php
    $imob = app( 'App\Http\Controllers\ctrImobiliaria')->pegarImobiliaria( Auth::user()->IMB_IMB_ID);
  @endphp

  <p><h3>{{$imob->IMB_IMB_NOME}}</p>
  <p><h4><u> Relatório Geral de Imóveis</u></h4></p>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th class="div-center" width="50px">#ID</th>
        <th class="div-center" width="50px">Refêrencia</th>
        <th class="div-center" width="400px">Endereço</th>
        <th class="div-center" width="100px">Tipo</th>
        <th class="div-center" width="50px">Internet</th>
        <th class="div-center" width="50px">Destaque</th>
      </tr>
    </thead>
    <tbody>
    @php
            $quantidade= 0;
        @endphp
    @foreach( $imv as $registro )
    <tr>
        @php
            $internet='';
            $destaque='';
            if( $registro->IMB_IMV_WEBIMOVEL == 'S' ) $internet = "Web";
            if( $registro->IMB_IMV_DESTAQUE == 'S' ) $destaque = "Destaque";
        @endphp

        <td class="div-center">{{$registro->IMB_IMV_ID}}</td>
        <td class="div-center">{{$registro->IMB_IMV_REFERE}}</td>
        <td class="div-center">{{$registro->endereco}}</td>
        <td class="div-center">{{$registro->IMB_TIM_DESCRICAO}}</td>
        <td class="div-center">{{$internet}}</td>
        <td class="div-center">{{$destaque}}</td>
      </tr>
        @php
            $quantidade = $quantidade + 1;
        @endphp
    @endforeach
    <tr>
        <td class="div-center">Imóveis</td>
        <td class="div-center">{{$quantidade}}</td>
        <td class="div-center"></td>
        <td class="div-right"></td>
        <td class="div-right"></td>
      </tr>

    </tbody>
  </table>
  <p></p>
  <p class="div-right">
  <i>emitido por: {{Auth::user()->IMB_ATD_NOME}} em {{date( 'd/m/Y')}} às {{date( 'H:m')}}</i>
  </p>
</page>

<page size="A4"></page>    

<script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script>
function imprimir()
{
  $("#i-print").hide();
  window.print();  
}  
</script>
</body>
</html>

