<div class="modal" tabindex="-1" role="dialog" id="modamparamgeral">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização - Aba Geral
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3 div-center">
                                    <label class="control-label">Tipo Codificação Contrato</label>
                                    <select  class="form-control" id="IMB_PRM_CODIFICACONTRATO">
                                        <option value="S">Sequência Automática Numérica</option>
                                        <option value="L">Imóvel + Sequencia Letra</option>
                                        <option value="N">Sem Codificação Automática</option>
                                    </select>

                                </div>
                                <div class="col-md-3 div-center">
                                    <label class="control-label">R$ Tarifa DOC</label>
                                    <input class="form-control valor-2" type="text" id="IMB_PRM_VALORDOCELETRONICO" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 div-center dark-soft-plus">
                                    <label class="control-label">Aprovação Automática de Contrato</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_MODULOAPROVACAO">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus">
                                    <label class="control-label">Arredondamento para Cima em Reajustes de Aluguéres</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_ARREDONTARREAJSTE">
                                </div>

                                <div class="col-md-6 div-center dark-soft-plus">
                                    <label class="control-label">No repasse pegar tudo o que está em aberto até a data de vencimento</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_REPASSEPEGATUDOABERTO">
                                </div>

                                <div class="col-md-6 div-center dark-soft-plus">
                                    <label class="control-label">Desconto Pontualidade Sobre Liquido (Aluguel - Desconto)</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_PONTUAL_SOB_ACORDO">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus">
                                    <label class="control-label">Exibir Número da Parcela</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_USARPARCELAS">
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