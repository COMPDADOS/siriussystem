<div class="modal" tabindex="-1" role="dialog" id="modalcobbancaria">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização na Cobrança Bancária
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2 div-center">
                                    <label>Valor Boleto</label>
                                    <input class="form-control valor-2" type="text" id="IMB_PRM_COBBANVALOR" class="form-control">
                                </div>
                                <div class="col-md-2 div-center">
                                    <label class="control-label">D+</label>
                                    <input class="form-control" type="text" class="form-control" 
                                    id="IMB_PRM_DIADMAIS"                                        
                                    onkeypress="return isNumber(event)" onpaste="return false;" >
                                </div>
                                <div class="col-md-2 div-center">
                                    <input type="checkbox" class="form-control" id="IMB_PRM_TOLERANCIABOLETO">Vencto sair com a data limite
                                </div>
                                <div class="col-md-2 div-center">
                                    <input type="checkbox" class="form-control" id="IMB_PRM_BAIXARETBANDATAATUAL">Data atual como data baixa
                                </div>
                                <div class="col-md-2 div-center">
                                    <input type="checkbox" class="form-control" id="imb_prm_conciliarretornocob">Conciliação autom. nas baixas
                                </div>
                                <div class="col-md-2 div-center">
                                    <input type="checkbox" class="form-control" id="IMB_PRM_BAIXAAUTOMTOTAL">Baixa 100% automática
                                </div>
                            </div>
                            <div class="col-md-2 backencargogarantido">
                                <label class="control-label">Não Receber Após</label>
                                    <input class="form-control" type="text" class="form-control" 
                                    id="IMB_PRM_COBBANTOLERANCIA"                                        
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                    <span>Dias de Vencido</span>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-8">Instrução Padrão no Boleto</div>
                                <textarea class="form-control" id="IMB_PRM_COBBANINSTRUCAO" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-2 div-center backencargogarantido">
                                <label class="control-label">Imprimir Recibo</label>
                                <input type="checkbox" class="form-control" id="IMB_PRM_COBIMPRECRETORNO">
                                <span>Na baixa automárica</span>
                            </div>

                            <div class="col-md-12">Mensagem no Boleto(Demonstrativo do Locatário)</div>
                            <textarea class="form-control" id="IMB_PRM_MENSAGEMBOLETO" cols="30" rows="2"></textarea>
                            <div class="row">
                                <div class="col-md-12  backencargogarantido">
                                    <div class="col-md-12 backencargogarantido div-center">Tarifa de Alteração de Data de Vencimento</div>
                                    <div class="col-md-2 div-center">
                                        <input type="checkbox" class="form-control" id="IMB_PRM_COBRARTARALTVEN">Cobrar Tarifa
                                    </div>
                                    <div class="col-md-3 div-center">
                                        <label>Valor Valor Tarifa</label>
                                        <input class="form-control valor-2" type="text" id="IMB_TBE_VALORTARALTVEM" class="form-control">
                                    </div>
                                    <div class="col-md-7 div-center">
                                        <label>Evento de Alteração de Vencimento</label>
                                        <select class="form-control" id="IMB_TBE_IDTARALTVEN"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12  backencargonaogarantido">
                                    <div class="col-md-3 div-center">
                                        <label class="control-label">(%)Multa de </label>
                                        <input class="form-control valor-2" type="text" id="IMB_PRM_COBMULTANDIAS">
                                    </div>
                                    <div class="col-md-3 div-center">
                                        <label class="control-label">A partir de </label>
                                        <input class="form-control" type="text" id="IMB_PRM_COBMULTANDIASPER"
                                        onkeypress="return isNumber(event)" onpaste="return false;">Dias
                                    </div>
                                    <div class="col-md-3">
                                        <label class="label-control">Enviar Boleto Somente c/ Entrada Confirmada</label>
                                        <input type="checkbox" class="form-control" id="IMB_PRM_ENVIARBOLETOENTRADACONFIRMADA">
                                    </div>
                                        
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