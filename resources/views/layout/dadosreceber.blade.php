    <div class="portlet box green escondido"  id="i-div-dados-receber">
  <div class="portlet-title">
    <div class="caption">Dados para Efetivar o Recebimento
      <i class="fa fa-gift"></i>
    </div>
  </div>
  <div class="portlet-body form">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2 ">
          <label class="label-control">$ Apurado</label>
          <input type="text" class="form-control valor" id="i-total-apurado" readonly value="0">
        </div>
        <div class="col-md-2 ">
          <label class="label-control">$ em Dinheiro</label>
          <input type="text" class="form-control valor" id="i-total-dinheiro" value="0">
        </div>
        <div class="col-md-2 ">
          <label class="label-control">$ em Cheques</label>
          <input type="text" class="form-control valor" id="i-total-cheque" value="0">
        </div>
        <div class="col-md-2 ">
          <label class="label-control">$ Troco</label>
          <input type="text" class="form-control valor" id="i-troco" value="0" readonly>
        </div>
        <div class="col-md-2 escondido div-center" id="div-troco-futuro">
          <input type="checkbox" class="form-control" id="i-troco-futuro">Troco Futuro
        </div>
        <div class="col-md-2 escondido div-center" id="div-abater">
          <input type="checkbox" class="form-control" id="i-abater">Abater e manter em aberto
        </div>
       </div>
     </div>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-3">
          <label class="label-control">Conta Banco/Caixa</label>
          <select class="form-control" id="FIN_CCX_ID"></select>
        </div>
        <div class="col-md-3">
          <label class="label-control">Forma de Recebimento</label>
          <select select class="form-control" id="IMB_FORPAG-IDLOCATARIO"></select>
        </div>

        <div class="form-actions right" id="i-botoes-acao-conf-receber">
          <button type="button" class="btn btn-primary"  onClick="confirmarRecebimento()">Confirmar Recebimento
              <i class="fa fa-check"></i> 
          </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar
          </button>
        </div>

      </div>
     </div>
   </div>
 </div>        
</div>