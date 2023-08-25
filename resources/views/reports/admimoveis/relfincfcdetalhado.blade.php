<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Financeiro Detalhado por CFC</title>
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
    <p><h4><u> Relatório Financeiro Detalhado por CFC </u></h4></p>
    <p><h4> Período: {{$datainicio}} a {{$datafim}}</u></p>
    <p><h4> CFC: {{$nomecfc}}</u></p>
    </div>

  <table class="table">
    <thead>
      <tr>
        <th class="div-center" width="100px">#Data</th>
        <th class="div-center" width="200px">CFC</th>
        <th class="div-center" width="200px">Grupo</th>
        <th class="div-center" width="100px">Valor</th>
        <th class="div-center" width="600px">Descrição</th>
      </tr>
    </thead>
    <tbody>
    @php
      $total= 0;
    @endphp
    @foreach( $lctos as $lcto )
    <tr>
        <td class="div-center">{{app('App\Http\Controllers\ctrRotinas')->formatarData($lcto->FIN_LCX_DATAENTRADA)}}</td>
        <td class="div-center">{{$lcto->FIN_CFC_DESCRICAO}}</td>
        <td class="div-center">{{$lcto->FIN_GCF_DESCRICAO}}</td>
        <td class="div-right">{{number_format($lcto->FIN_CAT_VALOR,2,',','.')}}</td>
        <td class="div-center">{{$lcto->FIN_LCX_HISTORICO}}</td>
      </tr>
        @php
            $total = $total + $lcto->FIN_CAT_VALOR;
        @endphp
    @endforeach
    <tr>
        <td class="div-center">Total</td>
        <td class="div-center"></td>
        <td class="div-center"></td>
        <td class="div-right"><b>{{number_format($total,2,',','.')}}</b></td>
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

