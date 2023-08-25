<div class="modal fade" id="modalreceber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "style="width:85%;">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Recebimento
            </div>
          </div>
      
          <div class="portlet-body form">
            <div class="row">
              <input type="hidden" id="COB_PRP_ID-PROP">
              <input type="hidden" id="COB_CLT_ID_DEVEDOR-PROP">
              <input type="hidden" id="i-inconsistencias">

              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label">Valor Apurado</label>
                  <input class="form-control valor" type="text" id="i-valor-apurador-rec" readonly>
                </div>
                <div class="col-md-2">
                  <label class="control-label">Valor Informado</label>
                  <input class="form-control valor" type="text" id="i-valor-informado-rec">
                </div>  
                <div class="col-md-2">
                  <label class="control-label">% Diferença</label>
                  <input class="form-control valor" type="text" id="i-perc-diferenca-rec" readonly>
                </div>
                <div class="div col-md-6 fundo-cinza-fraco">
                  <div class="col-md-3">
                    <label class="control-label">$ Dinheiro</label>
                    <input class="form-control valor" type="text" id="i-total-dinheiro" >

                  </div>
                  <div class="col-md-3">
                    <label class="control-label">$ Cheque</label>
                    <input class="form-control valor" type="text" id="i-total-cheque" >
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">$ Pago</label>
                    <input class="form-control valor" type="text" id="i-total-pago" readonly>
                  </div>
                  <div class="col-md-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipobaixa" 
                            id="i-tipobaixa-normal" value ="normal" checked>
                      <label class="form-check-label" for="i-tipobaixa-normal">
                           Bx. Normal
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipobaixa" 
                              id="i-tipobaixa-tela" value ="tela" >
                      <label class="form-check-label" for="i-tipobaixa-tela">
                          Acerto Tela
                      </label>
                    </div>                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                <h6 id="i-advertencia"></h6>
              </div>
              <div class="col-md-3">
                <button type="button" class="form-control btn btn-primary" onClick="confirmarRecebimento()">Confirmar Recebimento</button>
              </div>
              <div class="col-md-3">
                <button type="button" class="form-control btn btn-danger" data-dismiss="modal">Cancelar</button>              
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

  function receber()
  {


    $("#i-total-dinheiro").val(0);
    $("#i-total-cheque").val(0);
    $("#i-total-pago").val(0);
        
        
    $("#modalreceber").modal('show');




  }


</script>


@endpush