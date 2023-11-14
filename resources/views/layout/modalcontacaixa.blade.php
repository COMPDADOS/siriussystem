<div class="modal fade" id="modalconta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Conta de Caixa
            </div>
          </div>
          <div class="portlet-body form">
            <input type="hidden" id="conta-modal-selecionada">
            <input type="hidden" id="destinacao">
            <input type="hidden" id="idap">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-10">
                  <label class="control-label">Informe a Conta de Banco/Caixa</label>
                  <select  class="form-control" id="i-select-conta-modal-conta"></select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="processarAlgo()">ok</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@push('script')
<script>
  $(document).ready(function()
  {
      cargaContaModalConta()
  });

  function cargaContaModalConta()
    {
        var url = "{{ route('contacaixa.carga')}}/N";

        $.getJSON( url, function( data )
        {
            $("#i-select-conta-modal-conta").empty();
            $("#i-select-conta-modal-conta").empty();
            
            linha = '<option value="">Escolha a Conta</option>';
            $("#i-select-conta-modal-conta").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
              linha =
                  '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
                        $("#i-select-conta-modal-conta").append( linha );
            }
        });
    }

    function processarAlgo()
    {
      if( $("#idap").val() == '' )
      {
        alert('Informe a conta de saida');
        return false;
      }
      if( $("#destinacao").val() == 'reciboap' )
      {
          id = $("#idap").val();
          idconta = $("#i-select-conta-modal-conta").val();
          var url = "{{route('docsautomaticos.reciboap')}}/"+id+'/'+idconta;
          window.open( url, '_blank');

      }
    }



</script>


@endpush