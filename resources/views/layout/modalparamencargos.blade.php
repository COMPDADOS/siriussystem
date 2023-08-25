<div class="modal" tabindex="-1" role="dialog" id="modalParamEncargos">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização na Cobrança de Multa e Juros
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3 div-center">
                                    <label>Multa por Atraso</label>
                                    <p>
                                        <a href="{{route('tabelamulta')}}">Usar tabela de multa</a>
                                    </p>
                                </div>
                                <div class="col-md-3 div-center dark-soft-plus-1">
                                    <label class="control-label">Juros Diário %</label>
                                    <input class="form-control valor-4" type="text" id="IMB_PRM_COBBANJUROSDIA" class="form-control">
                                    <input type="checkbox" class="form-control" id="IMB_PRM_JUROSAPOSUMMES">Cobrar após um mês
                                </div>
                                <div class="col-md-3 div-center">
                                    <label class="control-label">Correçao Mensal %</label>
                                    <input class="form-control valor-4" type="text" id="IMB_PRM_COBBANCORRECAO" class="form-control">
                                </div>
                                
                                <div class="col-md-3 div-center">
                                    <label class="control-label">Perda da Bonificação</label>
                                    <input class="form-control" type="text" id="IMB_PRM_PERDEBONIFAPOSDIAS" class="form-control"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                    <span>Após dias de atraso</span>
                                </div>
                                

                                    
                            </div>


                        </div>
                    </div>
                </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Regras para Repasses de Encargos
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 div-center backencargogarantido">Para Aluguéres Garantidos</div>
                                <div class="col-md-6 div-center backencargonaogarantido">Para Aluguéres Não Garantidos</div>
                                <div class="col-md-6">
                                    <div class="col-md-4 center backencargogarantido">
                                        <label class="label-control div-center">Multa</label>
                                        <select  class="form-control" id="IMB_PRM_MULTAREPASSEGAR">
                                            <option value="S">Repassar</option>
                                            <option value="N">Não Repassar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 center backencargogarantido">
                                        <label class="label-control div-center">Juros</label>
                                        <select class="form-control" id="IMB_PRM_JUROSREPASSEGAR">
                                            <option value="S">Repassar</option>
                                            <option value="N">Não Repassar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 center backencargogarantido">
                                        <label class="label-control div-center">Correção</label>
                                        <select  class="form-control" id="IMB_PRM_CORRECAOREPASSEGAR">
                                            <option value="S">Repassar</option>
                                            <option value="N">Não Repassar</option>
                                        </select>
                                    </div>

                                </div>
                                    
                                <div class="col-md-6">
                                    <div class="col-md-4 center backencargonaogarantido">
                                        <label class="label-control">Multa</label>
                                        <select  class="form-control" id="IMB_PRM_MULTAREPASSENAOGAR">
                                            <option value="S">Repassar</option>
                                            <option value="N">Não Repassar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 center backencargonaogarantido">
                                        <label class="label-control">Juros</label>
                                        <select class="form-control" id="IMB_PRM_JUROSREPASSENAOGAR">
                                            <option value="S">Repassar</option>
                                            <option value="N">Não Repassar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 center backencargonaogarantido">
                                        <label class="label-control">Correção</label>
                                        <select  class="form-control" id="IMB_PRM_CORRECAOREPASSENAOGAR">
                                            <option value="S">Repassar</option>
                                            <option value="N">Não Repassar</option>
                                        </select>
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