<div class="modal" style="overflow:hidden;" role="dialog" id="modalCondominios" data-keyboard="false" data-backdrop="static">

    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h2><b>Condomínio</b></h2>

                </div>
                <div class="col-md-2 div-right">
                    <button type="button" data-dismiss="modal" aria-label="Close">                
                        <i class="fa fa-close" style="font-size:24px;color:grey;"></i>
                    </button>
                </div>
                
              </div>
            <div class="modal-body">
                
                    <!-- BEGIN FORM-->
                @include('layout.condominiolocalizacao')
                @include('layout.condominiozelador')
                @include('layout.condominiosindico')
                @include('layout.condominioservicos')
                @include('layout.condominiocaracteristicas')
                
                <div class="form-actions div-center">
                    <button type="button" class="btn default" id="i-btn-cancelar">Cancelar</button>
                    <button type="button" class="btn blue" id="i-btn-gravar" onClick="criarStatus()">
                                    <i class="fa fa-check"></i> Gravar</button>                                            
                </div>
                    
            </div>
        </div>
    </div>
    <div class="modal-footer">
    </div>


</div>
@include('layout.modalcondominiosimagens')
