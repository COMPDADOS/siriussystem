<div class="modal" tabindex="-1" role="dialog" id="modalparamrecibos">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização - Recibos
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-5 div-center ">
                                    <div class="row">
                                        <div class="col-md-12 back-dark">Período de Vencimento(descrição)</div>
                                        <div class="col-md-6">
                                            <label class="control-label">Período Inicial</label>
                                            <input class="form-control" type="number" id="IMB_PRM_PER_DIAS_INICIO">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Período Final</label>
                                            <input class="form-control" type="number" id="IMB_PRM_PER_DIAS_FIM">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-6 div-center ">
                                    <div class="row">
                                        <div class="col-md-12 back-dark">Vias de Recibos</div>
                                        <div class="col-md-6">
                                            <label class="control-label">Locador: Duas por recibo</label>
                                            <input type="checkbox" class="form-control" id="IMB_PRM_RECIBO2FL_LD">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Locatário: Duas por recibo</label>
                                            <input type="checkbox" class="form-control" id="IMB_PRM_RECIBO2FL_LT">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Receber e já realizar o repasse</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_REPASSENORECTO">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Visualizar Número da Parcela</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_USARPARCELAS">
                                </div>

                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">No repasse aparecer data de previsão de pagamento</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_REPASSEDIACERTO">
                                </div>

                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Resumo repasse recibo locatário(2a. via)</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_RESUMOREPNORECTO">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Desconto de Pontualidade Destacado</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_RECLDDESCPONT">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Endereço do Locador no Recibo de Repasse</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_RECLDENDLD">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Não Descatar Taxa Adm. do IPTU</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_NAODESTACARTA_IPTU">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">                                    <label class="control-label">Dados Conta Corrente no Recibo de Repasse</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_CONTAPROPNORECIBO">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Enviar email ao gerar o recibo repasse</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_REPASSEEMAIL">
                                </div>
                                                                
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Nome do Locador na Via do Locatário</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_RECLTDADOSLOCADOR">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Dt  Pagto em Branco na Assinatura Repasse</label>
                                    <input type="checkbox" class="form-control" id="imb_prm_reclddatabranco">
                                </div>
                                <div class="col-md-6 div-center dark-soft-plus-dotted-1">
                                    <label class="control-label">Código Imóvel Recibos</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_CODIGOIMOVELRECIBOS">
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