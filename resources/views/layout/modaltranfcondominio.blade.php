<div class="modal fade" id="modaltranfcondominio" style="overflow:hidden;"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="vertical-alignment-helper">
  <div class="modal-dialog vertical-align-center" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Tranferência Condomínio Entre Cadastro de Imóveis
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <hr>
            </div>
          
            <div class="row">
              <div class="col-md-12">
                <h3 class="div-center">Passar os Imóveis que Estão no Condomínio:</h3>

                <input type="hidden" id="i-condominio-origem">
                <h3 class="div-center" id="i-nome-condominio-origem"></h3>
                
               
              </div>
            </div>
            <div class="row">
              <hr>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3 class="div-center">Para o Condomínio:</h3>
                <select  class="select2 form-control" id="i-condominio-destino">

                </select>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <button type="button" class="btn btn-primary form-control" onClick="confirmarTransfCondominio()">Confirmar Tranferência</button>
            </div>
            <div class="col-md-4">
            </div>
           
            <div class="col-md-4">
              <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Cancelar Procedimento</button>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>


@push('script')
<script>

  function abreModalTranfCondominio( id, nome)
  {
    $("#modaltranfcondominio").modal('show');
    $("#i-nome-condominio-origem").html( '<b><u>'+nome+'</u></b>' );
    $("#i-condominio-origem").val( id );
    
    preencherCondominioTransf();
  }


  function preencherCondominioTransf( )
    {
        url = "{{ route('condominio.carga')}}/2";

        $.getJSON( url, function( data )

        {
            $("#i-condominio-destino").empty();
            $("#i-condominio-destino").append( '<option value=""></option>' );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_CND_ID+'">'+
                        data[nI].IMB_CND_NOME;
                linha = linha + "</option>";
                $("#i-condominio-destino").append( linha );

            }

        });

    }
    
    function confirmarTransfCondominio()
    {
      if( $("#i-condominio-destino").val() ==  $("#i-condominio-origem").val() )
      {

        alert('Origem e destino são os mesmo! Informe pra onde serão tranferidos com um condomínio diferente!');
        return false;
      }
      if( $("#i-condominio-destino").val() == '' )
      {
        alert('É necessário informar pra qual condomínio você deseja transferir os imóveis!');
        return false;
      }
      if( confirm( 'Este é um procedimento irreversível. Tenha a certeza do que está fazendo! Confirma a transferência?') == true )
      {

        var dados = { 
                      origem :  $("#i-condominio-origem").val(),
                      destino : $("#i-condominio-destino").val()
                   }
        var url = "{{route('condominio.transfimoveis')}}";
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax({
          url:url,
          dataType:'json',
          type:'post',
          data:dados,
          success:function()
          {
            alert('Imoveis tranferidos!');
            $("#modaltranfcondominio").modal('hide');
          },
          error:function()
          {
            alert('erro ao tranferir imóveis entre condomínios');
            $("#modaltranfcondominio").modal('hide');

          }
        })

        
      }
    }
</script>


@endpush