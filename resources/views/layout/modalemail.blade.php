<div class="modal fade" id="modalemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Email
                        </div>
                    </div>
                    <input type="hidden" id="i-tipo-busca">
                    <input type="hidden" id="i-imb_cgr_id_modalemail">
                    <input type="hidden" id="i-banco_modalemail">
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <input type="text" id="i-email-modal"
                                    placeholder="ponto-e-vírgula para separar mais de um email"
                                    class="form-control email-center">
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
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" onClick="enviarBoletoPorEmail()">Enviar</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
