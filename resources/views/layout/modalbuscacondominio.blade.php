<div class="modal fade" id="modalbuscacondominio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Condominio
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <hr>
            </div>
          
            <div class="row">
              <div class="col-md-8">
                  <div class="form-group">
                      <input type="text" id="i-str-cfc"  
                      placeholder="digite aqui um pedaço do CFC" 
                      class="form-control">
                  </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <button class="btn btn-primary" onClick="buscaIncrementalCfc()">Carregar Sugestões</button>
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-10">
                <table  id="tblcfc" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> Código</th>
                      <th width="40%" style="text-align:center"> C.F.C. </th>
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
  function buscaIncrementalCfc()
  {
    var url = "{{route( 'cfc.buscainc')}}/"+$("#i-str-cfc").val();
    console.log('cfc: '+url );

    $.ajax(
      {
        url     : url,
        dataType: 'json',
        type    : 'get',
        success : function( data )
        {
          linha = "";
          $("#tblcfc>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            linha = 
              '<tr>'+
                    '<td >'+data[nI].FIN_CFC_ID+'</td>'+
                    '<td >'+data[nI].FIN_CFC_DESCRICAO+'</td>' +
                    '<td >'+data[nI].FIN_GCF_DESCRICAO+'</td>' +
                    '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:selecionarCFC("'+data[nI].ID+'") class="btn btn-sm btn-primary">Selecionar</a> '+
                            '</td> '+
              '</tr>';
            $("#tblcfc").append( linha );
          }



        }
      }
    )


  }

  function selecionarCFC( id )
  {    
    $("#modalpesquisacfc").modal( 'hide');

    url = "{{route('cfc.find')}}/"+id;
    console.log('cfc: '+url );
    $.ajax
    (
      {
        url:url,
        dataType:'json',
        type:'get',
        async:false,
        success:function( data)
        {
          
          $("#I-FIN_CFC_DESCRICAO").val( data.FIN_CFC_DESCRICAO);
          $("#I-FIN_CFC_ID").val( data.FIN_CFC_ID );
          $("#i-cfcpesquisa").val( data.FIN_CFC_ID );
    
        }
      });

  }


</script>


@endpush