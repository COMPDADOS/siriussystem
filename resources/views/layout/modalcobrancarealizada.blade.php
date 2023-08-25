<div class="modal fade" id="modaltelefonescliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:90%;" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
            <i class="fa fa-gift"></i><label id="i-contrato-cobranca-realizada"></label>
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <table  id="tblcobrealizada" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="15%" style="text-align:center"> Data</th>
                      <th width="10%" style="text-align:center"> Hora </th>
                      <th width="15%" style="text-align:center"> Vencimento </th>
                      <th width="15%" style="text-align:center"> Funcionário </th>
                      <th width="45%" style="text-align:center"> Observação </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  function cobrancasRealizadas()
  {
    var id = $("#i-contrato-cobranca-realizada").val();
    var url = "{{route( 'inadimplentes.cobrancasrealizadas')}}/"+id;

    $.ajax(
      {
        url     : url,
        dataType: 'json',
        type    : 'get',
        success : function( data )
        {
          linha = "";
          $("#tblcobrealizada>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            $("#i-nomecliente-telefone").html( data[nI].IMB_CLT_NOME) ;
            linha = 
              '<tr>'+
                    '<td class="div-center" >'+moment(data[nI].IMB_CBR_DATA).format('DD/MM/YYYY')+'</td>'+
                    '<td class="div-center">'+data[nI].IMB_CBR_HORA+'</td>' +
                    '<td class="div-center">'+moment(data[nI].IMB_CTR_VENCIMENTOLOCATARIO).format('DD/MM/YYYY')+'</td>' +
                    '<td class="div-center">'+data[nI].IMB_ATD_NOME+'</td>' +
                    '<td class="div-center fomt-10">'+data[nI].IMB_CBR_OBSERVACAO+'</td>' +
              '</tr>';
            $("#tblcobrealizada").append( linha );
          }

        }
      }
    )
    
    $("#modaltelefonescliente").modal('show');

  }

</script>


@endpush