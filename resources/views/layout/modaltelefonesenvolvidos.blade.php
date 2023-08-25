<div class="modal fade" id="modaltelefonesenvolvidos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;" >    
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
            <i class="fa fa-gift"></i><label>Telefones dos Envolvidos no Contrato</label>
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-10">
                <table  id="tblfone" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> </th>
                      <th width="30%" style="text-align:center"> Nome</th>
                      <th width="5%" style="text-align:center"> DDI</th>
                      <th width="5%" style="text-align:center"> DDD</th>
                      <th width="10%" style="text-align:center"> Número </th>
                      <th width="10%" style="text-align:center"> Tipo </th>
                      <th width="30%" style="text-align:center"> Email </th>                      

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

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-cliente-env"  target="_blank">
@csrf
    <input type="hidden" id="id-cliente-env" name="id" />
    <input type="hidden" id="readonly" name="readonly" value="readonly"/>
</form>


@push('script')
<script>
  function cargaTelefoneEnvolvidos( id )
  {
    debugger;
    var url = "{{route( 'telefone.envolvidos')}}/"+id;
    $("#i-nomecliente-telefone").html( '') ;

    $.ajax(
      {
        url     : url,
        dataType: 'json',
        type    : 'get',
        async:false,
        success : function( data )
        {
          linha = "";
          $("#tblfone>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            classe="";
            if( data[nI].tipo == 'Proprietário') classe="Aberto";
            if( data[nI].tipo == 'Locatário') classe="Quitado";
            $("#i-nomecliente-telefone").html( data[nI].IMB_CLT_NOME) ;
            linha = 
              '<tr >'+
              '<td class="'+classe+'">'+data[nI].tipo+'</td>'+
              '<td ><a href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].nome+'</a></td>'+
              '<td >'+data[nI].DDI+'</td>' +
              '<td >'+data[nI].DDD+'</td>' +
              '<td ><b>'+data[nI].numero+'<b></td>' +
              '<td >'+data[nI].Tipofone+'</td>' +
              '<td >'+data[nI].Email+'</td>' +
              '</tr>';
            $("#tblfone").append( linha );
          }

        },
        error:function()
        {
          alert('error')
        },
        complete:function(data)
        {
          

        }
      }
    )

    $("#modaltelefonesenvolvidos").modal( 'show');


  }

  function ClienteCargaEnvolvido( id )
  {
    $("#id-cliente-env").val( id );
    $("#form-cliente-env").submit();
  }
  
</script>


@endpush