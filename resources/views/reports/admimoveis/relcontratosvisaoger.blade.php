<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Contratos</title>
    <style>
    body {
  background: rgb(204, 204, 204);
}

       /* style sheet for "A4" printing */ 
       <style>
		    @media print {
			         @page rotated {
					 size: A4 portrait;
			         margin: 2cm;
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
    font-size:12px;
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
    <p><h4><u> {{$titulo}} </u></h4></p>
    
    </div>

  <table class="table"> 
    <thead>
      <tr>
        <th class="div-center" width="5%">#Pasta</th>
        <th class="div-center" width="30%%">Endereço</th>
        <th class="div-center" width="25%">Locatário</th>
        <th class="div-center" width="25%">Locador</th>
        <th class="div-center" width="7%">Prox. Recto.</th>
        <th class="div-center" width="7%">Rescisão</th>
      </tr>
    </thead>
    <tbody>
    
    @foreach( $contrato as $ctr )
    <tr>
      <td class="div-center">{{$ctr->IMB_CTR_REFERENCIA}}</td>
        <td class="div-center">{{$ctr->ENDERECOCOMPLETO}}</td>
        <td class="div-center">{{$ctr->IMB_CLT_NOMELOCATARIO}}</td>
        <td class="div-center">{{$ctr->PROPRIETARIO}}</td>
        <td class="div-center">{{app('App\Http\Controllers\ctrRotinas')->formatarData($ctr->IMB_CTR_VENCIMENTOLOCATARIO)}}</td>
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
    var css = '@page { size: landscape; }',

head = document.head || document.getElementsByTagName('head')[0],

style = document.createElement('style');

style.type = 'text/css';

style.media = 'print';



if (style.styleSheet){

style.styleSheet.cssText = css;

} else {

style.appendChild(document.createTextNode(css));

}



head.appendChild(style);
  $("#i-print").hide();
  window.print();  
}  
</script>
</body>
</html>

