<div class="modal fade" id="modaldetalhedebitos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Valores em Aberto
            </div>
          </div>
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <table  id="tbldetalhedebitos" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> Data</th>
                      <th width="20%" style="text-align:center"> Evento </th>
                      <th width="10%" style="text-align:center"> Valor </th>
                      <th width="10%" style="text-align:center"> $ Multa </th>
                      <th width="10%" style="text-align:center"> $ Juros </th>
                      <th width="10%" style="text-align:center"> $ Total Ítem </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th width="10%" style="text-align:center"><button onClick="totalizar()">Totalizar</button></th>
                      <th width="20%" style="text-align:center"></th>
                      <th width="10%" style="text-align:right" id="i-sumitem">0,00</th>
                      <th width="10%" style="text-align:right" id="i-summulta" >0,00 </th>
                      <th width="10%" style="text-align:right" id="i-sumjuros">0,00 </th>
                      <th width="10%" style="text-align:right" id="i-sumtotalitem">0,00 </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="div-center div-2">
            <button class="btn blue"  data-dismiss="modal"> Sair
            </button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>


function cargaDebitos( id )
{

  var url = "{{route('inadimplentes.detalhe')}}/"+id+'/s';

  var table = $('#tbldetalhedebitos').DataTable(
  {
    "pageLength": 25,
    "lengthChange": true,
    "language":
    {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
      sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
      "sZeroRecords": "Nenhum registro encontrado",
      "scrollY": "300px",
      "oPaginate":
      {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      }
    },
    bSort : false ,
    processing: true,
    serverSide: true,
    ajax:
    {
      url: url,
      data: function (d)
      {
//        totalizar(id);
      }
    },
    columns:
    [
      { "data": 'DATAVENCIMENTO', render:formatarDataDetalhe},
      { "data": 'IMB_TBE_NOME', render:formatarEvento },
      { "data": 'TMP_VALOR', render:formatarValorDetalhe },
//      { "data": 'MAISMENOS'},
      { "data": 'MULTA', render:formatarMultaDetalhe},
      { "data": 'JUROS', render:formatarJurosDetalhe},
      { "data": 'TOTALREGISTRO', render:formatarTotalRegistroDetalhe},
    ],
    searching: false,
    bSort : false ,
    'bDestroy': true,
    });
//  table.draw();
  table.clear();
  $("#modaldetalhedebitos").modal( 'show');
  $("#i-sumitem").html( formatarBRSemSimbolo( parseFloat(0) ));
  $("#i-summulta").html( formatarBRSemSimbolo( parseFloat( 0 )));
  $("#i-sumjuros").html( formatarBRSemSimbolo( parseFloat(0)));
  $("#i-sumtotalitem").html( formatarBRSemSimbolo( parseFloat(0)));



}
/*
    $.ajax(
    {
      url : url,
      dataType:'json',
      type:'get',
      success:function( data )
      {
          linha = "";
          $("#tbldetalhedebitos>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            valor = formatarBRSemSimbolo(parseFloat(data[nI].TMP_VALOR));
            dataven = moment(data[nI].DATAVENCIMENTO).format('DD/MM/YYYY');
            classe="";
            if( dataven == 'Invalid date')
            {
              classe="subtotal";
              dataven='';
            }
            linha =

              '<tr class="'+classe+'">'+
                    '<td class="div-center">'+dataven+'</td>'+
                    '<td class="div-center">'+data[nI].IMB_TBE_NOME+'</td>' +
                    '<td class="div-right">'+valor+'</td>' +
                    '<td  class="div-center">'+data[nI].MAISMENOS+'</td>' +
                    '<td class="div-right">'+formatarBRSemSimbolo(parseFloat(data[nI].MULTA))+'</td>' +
                    '<td class="div-right">'+formatarBRSemSimbolo(parseFloat(data[nI].JUROS))+'</td>' +
                    '<td class="div-right">'+formatarBRSemSimbolo(parseFloat(data[nI].TOTALREGISTRO))+'</td>' +
              '</tr>';
            $("#tbldetalhedebitos").append( linha );
          }


        }
      }
    )

  }
*/

function formatarValorDetalhe(data, type, full, meta)
{
  var dado = formatarBRSemSimbolo( parseFloat( full.TMP_VALOR ) );

  if( full.IMB_TBE_NOME == 'Total do Vencimento')
      return '<div class="div-right subtotal">'+dado+"</div>";

  if( full.MAISMENOS == '-')
    return '<div class="div-right font-red">'+dado+"</div>";

  return '<div class="div-right font-blue">'+dado+"</div>";



}
function formatarMultaDetalhe(data, type, full, meta)
{
  var dado = formatarBRSemSimbolo( parseFloat( full.MULTA ) );
  if( full.IMB_TBE_NOME == 'Total do Vencimento')
      return '<div class="div-right subtotal">'+dado+"</div>";

  if( full.MAISMENOS == '-')
    return '<div class="div-right font-red">'+dado+"</div>";

  return '<div class="div-right font-blue">'+dado+"</div>";

}
function formatarJurosDetalhe(data, type, full, meta)
{

  var dado = formatarBRSemSimbolo( parseFloat( full.JUROS ) );
  if( full.IMB_TBE_NOME == 'Total do Vencimento')
      return '<div class="div-right subtotal">'+dado+"</div>";

      if( full.MAISMENOS == '-')
    return '<div class="div-right font-red">'+dado+"</div>";

  return '<div class="div-right font-blue">'+dado+"</div>";



}
function formatarDataDetalhe(data, type, full, meta)
{
  var dado = moment( full.DATAVENCIMENTO ).format('DD/MM/YYYY');
  if( dado == 'Invalid date')
      dado='';
      return '<div class="div-center">'+dado+"</div>";
}


function formatarEvento(data, type, full, meta)
{

  var dado = full.IMB_TBE_NOME;
  var obs = full.IMB_TBE_OBSERVACAO;
  if( obs === null ) obs='';
  if( dado == 'Total do Vencimento')
    return '<div class="subtotal">'+dado+"</div>"
  else
    return dado+'<span class="font-11">('+obs+')</span>';

}

function formatarTotalRegistroDetalhe(data, type, full, meta)
{

  var dado = formatarBRSemSimbolo( parseFloat( full.TOTALREGISTRO ) );

  if( full.IMB_TBE_NOME == 'Total do Vencimento')
      return '<div class="div-right subtotal">'+dado+"</div>";


  if( full.MAISMENOS == '-')
    return '<div class="div-right font-red">'+dado+"</div>";

  return '<div class="div-right font-blue">'+dado+"</div>";

}

function totalizar( idcontrato)
{
  var url = "{{route('inadimplentes.totalizar')}}";

  var dados = { idcontrato:idcontrato};

  $.ajax(
    {
      url : url,
      dataType:'json',
      type:'get',
      data:dados,
      success:function( data )
      {
        $("#i-sumitem").html( formatarBRSemSimbolo( parseFloat(data[0].TOTALVALOR) ));
        $("#i-summulta").html( formatarBRSemSimbolo( parseFloat(data[0].TOTALMULTA )));
        $("#i-sumjuros").html( formatarBRSemSimbolo( parseFloat(data[0].TOTALJUROS)));
        $("#i-sumtotalitem").html( formatarBRSemSimbolo( parseFloat(data[0].TOTALTOTAL)));
      }
    }
  )


}


</script>


@endpush
