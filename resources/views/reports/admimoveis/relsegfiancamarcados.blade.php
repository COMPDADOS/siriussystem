<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Imóveis Marcados com Seguro Fiança</title>
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
    <p><h4><u> Relatório de Contratos Marcados com Seguro Fiança </u></h4></p>
    
    </div>

  <table class="table">
    <thead>
      <tr>
        <th class="div-center" width="10%">#Pasta</th>
        <th class="div-center" width="40%%">Endereço</th>
        <th class="div-center" width="30%">Locatário</th>
        <th class="div-center" width="10%">Data Locação</th>
        <th class="div-center" width="10%">Data Rescisão</th>
      </tr>
    </thead>
    <tbody>
    
    @foreach( $ctrs as $ctr )
    <tr>
      <td class="div-center">{{$ctr->IMB_CTR_REFERENCIA}}</td>
        <td class="div-center">{{$ctr->ENDERECO}}</td>
        <td class="div-center">{{$ctr->LOCATARIO}}</td>
        
        <td class="div-center">{{app('App\Http\Controllers\ctrRotinas')->formatarData($ctr->IMB_CTR_INICIO)}}</td>
        <td class="div-center">{{app('App\Http\Controllers\ctrRotinas')->formatarData($ctr->IMB_CTR_DATARESCISAO)}}</td>
     
      </tr>
    @endforeach
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

