<div class="modal fade" id="modalpesquisasubconta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Sub-Conta(Centro de Custos)
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <hr>
            </div>
          
            <div class="row">
              <div class="col-md-8">
                  <div class="form-group">
                      <input type="text" id="i-str-sbc"  
                      placeholder="digite aqui um pedaço da Sub-Conta" 
                      class="form-control">
                  </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <button class="btn btn-primary" onClick="buscaIncrementalSbc()">Carregar Sugestões</button>
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-10">
                <table  id="tblsbcbusca" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> Código</th>
                      <th width="40%" style="text-align:center"> Sub-Conta(Centro de Custos) </th>
                      <th width="40%" style="text-align:center"> Grupo </th>
                      <th width="10%" style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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
</div>


@push('script')
<script>
  function buscaIncrementalSbc()
  {
    var url = "{{route( 'subconta.buscainc')}}/"+$("#i-str-sbc").val();

    $.ajax(
      {
        url     : url,
        dataType: 'json',
        type    : 'get',
        success : function( data )
        {
          linha = "";
          $("#tblsbcbusca>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            linha = 
              '<tr>'+
                    '<td >'+data[nI].FIN_SBC_ID+'</td>'+
                    '<td >'+data[nI].FIN_SBC_DESCRICAO+'</td>' +
                    '<td >'+data[nI].GRUPO+'</td>' +
                    '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:selecionarSubConta("'+data[nI].ID+'") class="btn btn-sm btn-primary">Selecionar</a> '+
                            '</td> '+
              '</tr>';
            $("#tblsbcbusca").append( linha );
          }



        }
      }
    )

  }

  function selecionarSubConta( id )
  {    
    $("#modalpesquisasubconta").modal( 'hide');

    url = "{{route('subconta.find')}}/"+id;
    console.log('sbc: '+url );
    $.ajax
    (
      {
        url:url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data)
        {
          
          $("#I-FIN_SBC_DESCRICAO").val( data.FIN_SBC_DESCRICAO);
          $("#I-FIN_SBC_ID").val(  data.FIN_SBC_ID );
          $("#i-subcontapesquisa").val( data.FIN_SBC_ID );

        }
      });

  }


</script>


@endpush