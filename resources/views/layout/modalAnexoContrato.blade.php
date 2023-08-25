<div class="modal" tabindex="-1" role="dialog" id="modalanexocontrato">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Anexos
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>

                <div class="portlet-body form">
                    <div class="form-body" >
                        <form class="form-horizontal" id="formimagem">
                            <input type="hidden" id="IMB_CTA_ID_MODANE">
                            <input type="hidden" id="IMB_IMV_ID_MODANE">
                            <input type="hidden" id="IMB_CLT_ID_NODANE">
                            <input type="hidden" id="IMB_CTR_ID_NODANE">

                            <div class="row">
                                <div class="col-md-12">
                                    <table  id="tblanexos" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="10%" >Tipo</th>
                                                <th width="80%" style="text-align:center"> Descrição </th>
                                                <th width="10%" style="text-align:center"> Ações </th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row escondido">
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
                        </form>                            
                    </div>
                </div>
                
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