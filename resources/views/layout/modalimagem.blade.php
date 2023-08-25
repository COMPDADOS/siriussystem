<div class="modal" tabindex="-1" role="dialog" id="modalimagem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Imagens do Imóvel - Alteração
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" id="formimagem">
                    <input type="hidden" id="i-idimg">
                    <input type="hidden" id="i-idimovel-img" name="IMB_IMV_ID">
                    <input type="hidden" id="i-idempresa-img" name="IMB_IMB_IDIMAGEM"
                                               value="{{Auth::user()->IMB_IMB_ID}}">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome da Imagem</label>
                                        <input type="text" maxlength="100"
                                            class="form-control" id="i-nomeimagem"
                                            name="IMB_IMG_NOME">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="IMB_IMG_PRINCIPAL"
                                                    class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemprincipal">
                                                Imagem Principal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="IMB_IMG_CAPA"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemcapa">
                                                Mostrar na Capa do Site
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                        <input type="checkbox" name="IMB_IMG_NAOIRPROSITE"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemnaoirsite">
                                                NÃO Exibir no site
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="cabcel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" onClick="salvarImagem()">Salvar mudanças</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push( 'script')
<script>
        function salvarImagem()
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        var url = "{{ route('imagem.salvar') }}"+"/"+$("#i-idimg").val();


        imagem =
        {
            IMB_IMB_ID : $("#IMB_IMB_IDIMAGEM").val(),
            IMB_IMV_ID : $("#i-idimovel").val(),
            IMB_IMG_NOME: $("#i-nomeimagem").val(),
            IMB_IMG_PRINCIPAL: $( '#i-imagemprincipal' ).prop( "checked" )   ? 'S' : 'N',
            IMB_IMG_NAOIRPROSITE: $( '#i-imagemnaoirsite' ).prop( "checked" )   ? 'S' : 'N',
            IMB_IMG_CAPA: $( '#i-imagemcapa' ).prop( "checked" )  ? 'S' : 'N'
        };

        $.ajax(
        {
            url:url,
            data:imagem,
            type:'post',
            datatype:'json',
            async:false,
            success: function()
            {
                $("#modalimagem").modal("hide");
                CarregarImagens( $("#i-idimovel").val() );
            }

        });

        /*$.post( url, imagem, function(data)
        {
                $("#modalimagem").modal("hide");
                CarregarImagens();
        });
*/

    }

</script>
@endpush