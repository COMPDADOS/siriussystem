<div class="modal" tabindex="-1" role="dialog" id="modalParamWhatsApp">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Parametrização Integraçao com Sirius WhatsApp
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 div-center dark-soft">
                                    <h5>Indentificação do Nome e Número do Celular de Apoio</h5>
                                    <div class="col-md-6">
                                            Nome(Apelido) do Celular
                                            <input class="form-control" type="text" id="IMB_PRM_WSAPELIDO"  placeholder="Ex.: 5511986690669">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 div-center dark-soft-plus">
                                    <h5>Configuração do Aparelho</h5>
                                    <div class="col-md-6">
                                            <h4><u>Primeiro Passo - Inicializar o Aparelho</u></h4>
                                            <button class="btn btn-primary form-control" onClick="iniciarAparelho()">Click aqui para inicializar o uso do aparelho</button>
                                    </div>
                                    <div class="col-md-6">
                                        <h4><u>Segundo Passo - Scanear o QRCode</u></h4>
                                            <button class="btn btn-primary  form-control" onClick="scanearQrCode()">Click aqui para gerar o QRCODE</button>
                                    </div>
                                </div>                                        
                                <div class="col-md-12 div-center dark-soft-plus">
                                    <h4><u>Fazer Logout do Sirius no Whatsapp</u></h4>
                                    <button class="btn btn-primary form-control" onClick="logoutAparelho()">Click aqui para Logout</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 div-center dark-soft-plus">
                                    <h5>Webhook de Integração</h5>
                                    <input class="form-control" type="text" id="IMB_PRM_WSWEBHOOK" >
                                </div>                                        
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12 escondido div-center" id="div-qrcode">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="onGravar('nohide')" data-dismiss="modal">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

