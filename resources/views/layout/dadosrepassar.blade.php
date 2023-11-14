<div class="portlet box green escondido"  id="i-div-dados-repassar">
  <div class="portlet-title">
    <div class="caption">Dados para Efetivar o Repasse
      <i class="fa fa-gift"></i>
    </div>
  </div>
  <div class="portlet-body form">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2 ">
          <label class="label-control"><b>Total Apurado</b></label>
          <input type="text" class="form-control valor" id="i-total-apurado-locador" readonly value="0">
        </div>
        <div class="col-md-2 ">
          <label class="label-control"><b>Total em Dinheiro</b></label>
          <input type="text" class="form-control valor" id="i-total-dinheiro-locador" value="0">
        </div>
        <div class="col-md-2 ">
          <label class="label-control"><b>Total em Cheques</b></label>
          <input type="text" class="form-control valor" id="i-total-cheque-locador" value="0">
        </div>
        <div class="col-md-2 ">
          <label class="label-control"><b>$ Troco</b></label>
          <input type="text" class="form-control valor" id="i-troco-locador" value="0">
        </div>
        <div class="col-md-2 escondido div-center" id="div-debito-futuro-locador">
          <input type="checkbox" class="form-control" id="i-debito-futuro"><b>Diferença como Débito Futuro
        </div>
        <div class="col-md-2 escondido div-center" id="div-credito-futuro-locador">
          <input type="checkbox" class="form-control" id="i-credito-futuro"><b>Diferença como Crédito Futuro
        </div>
        <div class="col-md-2 escondido div-center" id="div-abater-locador">
          <input type="checkbox" class="form-control" id="i-abater"><b>Abater e manter em aberto
        </div>
      </div>
     <div class="row">
      <div class="col-md-12">
        <div class="col-md-3">
          <label class="label-control">Conta Banco/Caixa</b></label>
          <select class="form-control" id="FIN_CCX_ID_LOCADOR"></select>
        </div>
        <div class="col-md-3">
          <label class="label-control">Forma de Repasse</b></label>
          <select select class="form-control" id="IMB_FORPAG-IDLOCADOR-repasse"></select>
        </div>

        <div class="form-actions right"  id="i-botoes-acao-conf-repassar">
          <button type="button" class="btn btn-primary"  onClick="confirmarRepasse()" id="btn-confirmar">Confirmar Repasse</b>
              <i class="fa fa-check"></i> 
          </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</b>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>        

