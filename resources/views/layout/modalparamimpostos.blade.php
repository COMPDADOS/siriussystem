<div class="modal" tabindex="-1" role="dialog" id="modalParamImpostos">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização em Impostos
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4 div-center dark-soft">% ISS
                                    <div class="row">
                                        <div class="col-md-6">
                                            Código 17.11
                                            <input class="form-control valor-2" type="text" id="IMB_PRM_ISSALIQUOTA">
                                        </div>
                                        <div class="col-md-6">
                                            Código 10.05
                                            <input class="form-control valor-2" type="text" id="IMB_PRM_ISSALIQUOTA1005">
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="col-md-4 div-center dark-soft-plus">% Na Descrição da NFE
                                    <div class="row">
                                        <div class="col-md-6">
                                            Código 17.11
                                            <input class="form-control valor-2" type="text" id="IMB_PRM_TOTALIMPOSTOS">
                                        </div>
                                        <div class="col-md-6">
                                            Código 10.05
                                            <input class="form-control valor-2" type="text" id="IMB_PRM_TOTALIMPOSTOS1005">
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="col-md-4 div-center dark-soft">Incrições
                                    <div class="row">
                                        <div class="col-md-6">
                                            Municipal
                                            <input class="form-control" type="text" id="IMB_PRM_INSCRICAOMUNICIPAL">
                                        </div>
                                        <div class="col-md-6">
                                            Cód.Atividade
                                            <input class="form-control" type="text" id="IMB_CODIGOATIVIDADE">
                                        </div>
                                    </div>                                        
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Token para emissão de nota fiscal</label>
                                    <input type="text" class="form-control" id="IMB_PRM_TOKENNFS">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 div-center dark-soft-plus-1">Nota Fiscal Eletrônica
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label">Usuário</label>
                                            <input type="text" class="form-control" id="IMB_PRM_NFESUARIO">
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">Senha</label>
                                            <input type="text" class="form-control" id="IMB_PRM_NFESENHA"   >
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">NF Série</label>
                                            <input type="text" class="form-control" id="IMB_PRM_NOTASERIE"   >
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <label class="control-label">Link NFE</label>
                                            <input type="text" class="form-control" id="IMB_PRM_NFELINKSISTEMA">
                                        </div>
                                    </div>                                        
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Efeito ao Locador</label>
                                    <select class="form-control" id="IMB_PRM_ISSLOCADORCREDEB">
                                        <option value="C">Crédito</option>
                                        <option value="D">Débito</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="form-control" id="IMB_PRM_RETERISSTAXACONTRATO">Incluir Taxa de Contrato na Base de Cálculo
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Valor Mínimo p/ retenç. IRRF</label>
                                    <input class="form-control valor-2" type="text" id="IMB_PRM_IRRFMINIMO">
                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Gerar NFE no momento do repasse</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_NFEAOBAIXAR">

                                </div>


                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Reter ISS conforme informado no contrato</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_ISSRESPEITARUSUARIO">

                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Nunca Reter ISS em Recebimentos/Repasses</label>
                                    <input type="checkbox" class="form-control"id="IMB_PRM_NUNCAIRRF">

                                </div>
                                <div class="col-md-4 div-center">
                                    <label class="control-label">Retenção IRRF: Respeitar o campo "CALCULAR IRRF [ ]" no contrato</label>
                                    <input type="checkbox" class="form-control" id="IMB_PRM_IRRFRESPEITARCTR">
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