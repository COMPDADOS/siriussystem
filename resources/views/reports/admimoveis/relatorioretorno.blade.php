<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Retorno - Total</title>
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
  background-color: #4caf50;
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

    $request = new \Illuminate\Http\Request();
    $request->replace(['somentebaixados' => '', 'codigoocorrencia' => '']);    
    $cargatmp = app('App\Http\Controllers\ctrCobrancaGerada')->cargaTmpRetornoRelatorio( $request );
    
    if( $cargatmp == '' )
        echo "<script>window.close();</script>"
  @endphp

  <p><h3>{{$imob->IMB_IMB_NOME}}</p>
  <p><h4><u> Relatório de Retorno Bancário Geral</u></h4></p>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th class="div-center" width="100px">Ocorrência</th>
        <th class="div-center" width="50px">#ID</th>
        <th class="div-center" width="50px">Pasta</th>
        <th class="div-center" width="50px">Pago em Banco</th>
        <th class="div-center" width="50px">Valor do Titulo</th>
        <th class="div-center" width="300px">Endereço</th>
        <th class="div-center" width="300px">Locatário</th>
        <th class="div-center" width="100px">Vencimento</th>
        <th class="div-center" width="100px">Data Pagto</th>
      </tr>
    </thead>
    <tbody>
        @php
            $totalpago = 0;
            $totalbanco = 0;

        @endphp
    @foreach( $cargatmp as $registro )
      <tr>
        <td class="div-center">{{$registro->nomeocorrencia}}</td>
        <td class="div-center">{{$registro->imb_imv_id}}</td>
        <td class="div-center">{{$registro->imb_ctr_referencia}}</td>
        <td class="div-right">{{number_format( $registro->valorpago,2,',','.')}}</td>
        <td class="div-right">{{number_format( $registro->valorcobranca,2,',','.')}}</td>
        <td class="div-center">{{$registro->endereco}}</td>
        <td class="div-center">{{$registro->locatario}}</td>
        <td class="div-center">{{date('d/m/Y', strtotime($registro->datavencimento))}}</td>
        <td class="div-center">{{date('d/m/Y', strtotime($registro->datapagamento))}}</td>
      </tr>
        @php
            $totalbanco+= $registro->valorcobranca;
            $totalpago+= $registro->valorpago;
        @endphp
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

