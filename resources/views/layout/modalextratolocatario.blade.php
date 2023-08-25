<div class="modal fade" id="modalemvialextratolocatario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Extrato de Pagamentos do Locatário
                        </div>
                    </div>

                    <input type="hidden" id="IMB_CTR_ID-extratolocatario">
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <label class="control-label">Data Inicial</label>
                                    <input type="date" id="i-datainicial-extratolocatario" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Data Final</label>
                                    <input type="date" id="i-datafinal-extratolocatario" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label">Email</label>
                                    <input type="text" id="i-email-modal-extratolocatario"
                                        placeholder="ponto-e-vírgula para separar mais de um email"
                                        class="form-control email-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12"></div>
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="form-control btn btn-primary" onClick="enviarExtratoLocatario('S')">Enviar</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="form-control btn btn-primary" onClick="enviarExtratoLocatario('N')">Imprimir</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="form-control  btn btn-danger" data-dismiss="modal">sair</button>
                                    </div>
                                        
                                </div>

                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>
function enviarExtratoLocatario( poremail)
{
    var id = $("#IMB_CTR_ID-extratolocatario").val();

    var datainicial =  $("#i-datainicial-extratolocatario").val();
    var datafinal = $("#i-datafinal-extratolocatario").val();
    var email = $("#i-email-modal-extratolocatario").val();
    var email = email.replace(/ /g, "");
    if( poremail != 'S' ) email = 'X';
                                    
    var url = "{{route('extratopagamentolocatario')}}/"+id+'/'+datainicial+'/'+datafinal+'/'+poremail+'/'+email;
    if( poremail == 'N' )
        window.open( url, '_blank');
    else
    {
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    alert('Email enviado!');
                    $("#modalemvialextratolocatario").modal('hide');
                }
            }
        )
    }
}
</script>
@endpush
