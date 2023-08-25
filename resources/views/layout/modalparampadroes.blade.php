<div class="modal" tabindex="-1" role="dialog" id="modalparampadroes">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização - Padrões
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                
                                <h6 class="col-md-12 back-dark">Padrões no Recebimento de Aluguel</h6>   
                                <div class="col-md-6">
                                    <label class="label-control">Forma de Recebimento</label>
                                    <select select class="form-control" id="IMB_FORPAG-IDLOCATARIO"></select>
                                </div>
                                    
                                <div class="col-md-6">
                                    <label class="label-control">Conta Banco/Caixa</label>
                                    <select class="form-control" id="FIN_CCX_ID_PADRAO_REC"></select>
                                </div>
                            </div>
                            <div class="row">
                                
                                <h6 class="col-md-12 back-dark">Padrões no Apoio ao Financeiro Pagto. de Compromissos</h6>   
                                <div class="col-md-4">
                                    <label class="label-control">CFC Multa</label>
                                    <select select class="form-control" id="FIN_CFC_IDMULTA"></select>
                                </div>
                                <div class="col-md-4">
                                    <label class="label-control">CFC Juros</label>
                                    <select select class="form-control" id="FIN_CFC_IDJUROS"></select>
                                </div>
                                <div class="col-md-4">
                                    <label class="label-control">CFC Desconto</label>
                                    <select select class="form-control" id="FIN_CFC_IDDESCONTO"></select>
                                </div>
                                    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="onGravar('nohide')" data-dismiss="modal">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>