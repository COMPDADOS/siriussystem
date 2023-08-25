<div class="modal fade" id="modaltelefonescliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
            <i class="fa fa-gift"></i><label id="i-nomecliente-telefone"></label>
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-10">
                <table  id="tlbfone" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> DDD</th>
                      <th width="40%" style="text-align:center"> Número </th>
                      <th width="40%" style="text-align:center"> Tipo </th>
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
  function cargaTelefoneModal( id )
  {
    var url = "{{route( 'telefone.carga')}}/"+id;
    $("#i-nomecliente-telefone").html( '') ;

    $.ajax(
      {
        url     : url,
        dataType: 'json',
        type    : 'get',
        success : function( data )
        {
          linha = "";
          $("#tblfone>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            $("#i-nomecliente-telefone").html( data[nI].IMB_CLT_NOME) ;
            linha = 
              '<tr>'+
                    '<td >'+data[nI].IMB_TLF_DDD+'</td>'+
                    '<td >'+data[nI].IMB_TLF_NUMERO+'</td>' +
                    '<td >'+data[nI].IMB_TLF_TIPOTELEFONE+'</td>' +
              '</tr>';
            $("#tblfone").append( linha );
          }

        }
      }
    )

  }

</script>


@endpush