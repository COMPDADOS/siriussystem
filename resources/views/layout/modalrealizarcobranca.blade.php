
<div class="modal fade" id="modalrealizarcobranca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Acionamento de Cobranças
            </div>
          </div>
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12 identificacao  div-1">
                  <input type="hidden" id="i-contrato" >
                  <input type="hidden" id="i-datavencimento">
                  <div class="col-md-5 identificacao  div-1">
                    <label class="control-label" id="i-endereco"></label>
                  </div>
                  <div class="col-md-4">
                  <label class="control-label identificacao  div-1" id="i-nomecliente"></label>
                  </div>
                  <div class="col-md-1">
                    <label class="control-label identificacao  div-1" id="i-tipocliente"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="col-md-12 back-azul-titulo div-center">Anotações</div>

                    <div class="col-md-10">
                      <textarea class="form-control" id="i-anotacoes" cols="30" rows="7"></textarea>
                    </div>
                    <div class="col-md-2">
                      <button class="form-control btn btn-primary" onClick="gravar()">Gravar</button>
                      <button class="form-control btn btn-danger" data-dismiss="modal">Cancelar</button>
                      <button class="form-control btn btn-success"  onClick="cobrancasRealizadas()">Cobrança Feitas</button>
                      <button class="form-control btn yellow">Histórico Cliente</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @include( 'layout.tabletelefones')
        </div>
        <div class="div-center div-2">
            <button class="btn blue"  data-dismiss="modal"> Sair
            </button>
        </div>
      </div>
    </div>
  </div>
</div>

@include( 'layout.modalcobrancarealizada')

@push('script')
<script>


  function indentificacao(idcontrato)
  {

    $("#i-contrato").val( idcontrato );
    $("#i-contrato-cobranca-realizada").val( idcontrato );

    var url = "{{route('contrato.findfull')}}/"+idcontrato;
    console.log( url );

    $.ajax(
      {
        url     : url,
        dataType:'json',
        type    :'get',
        success:function( data )
        {
          $("#i-endereco").html(data.ENDERECOCOMPLETO);
          $("#i-nomecliente").html(data.LOCATARIO);
          $("#i-datavencimento").val(data.IMB_CTR_VENCIMENTOLOCATARIO);

        }
      }
    );

  }

function gravar()
{
  url = "{{route('inadimplentes.gravarcobranca')}}";


  $.ajaxSetup({
    headers:
    {
    'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
});

  dados =
  {
    IMB_CTR_ID : $("#i-contrato").val(),
    IMB_CTR_VENCIMENTOLOCATARIO: $("#i-datavencimento").val(),
    IMB_CBR_OBSERVACAO : $("#i-anotacoes").val(),
    tipocliente :  $("#i-tipocliente-telefone").html(),
  }

  $.ajax
  (
    {
      url:url,
      dataType:'json',
      type:'POST',
      data:dados,
      success:function()
      {
       alert('Gravado!');
       $("#modalrealizarcobranca").modal('hide');
      }
    }
  );

}


</script>


@endpush
