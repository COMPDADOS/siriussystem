<div class="modal" style="overflow:hidden;" role="dialog" id="modalCondominiosimagens" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h2><b>Imagens do Condominio</b></h2>

                </div>
                <div class="col-md-2 div-right">
                    <button type="button" data-dismiss="modal" aria-label="Close">                
                        <i class="fa fa-close" style="font-size:24px;color:grey;"></i>
                    </button>
                </div>
                
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="col-md-12">
                        <h3 class="main-title div-center">Imagens Enviadas</h3>
                    </div>
                    <div id="galeria-img-condominio"></div>
                </div>                        

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="form-actions div-center">
            <button type="button" id="galeria-imagem-btn" onClick="upLoadImagemDrop()" class="btn btn-primary"><i class="fa fa-camera-retro"></i> Fazer Upload</button>
            <button type="button" id="galeria-update-btn" onClick="CarregarImagens()" class="btn btn-success escondido"><i class="fa fa-update"></i> Atualizar</button>
        </div>

    </div>
</div>


@push('script')

<script>

    
</script>


@endpush