<div class="modal fade" id="modaldata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:20%;">
        <div class="modal-content ">
            <input type="hidden" id="i-tipo-alteracao-data">
            <input type="hidden" id="i-numero-recibo">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Informe Nova Data
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <input type="date" id="i-alteracao-data"
                                    placeholder="Informe a nova data"
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
                            <button class="btn btn-primary" onClick="confirmarAlteracaoData()">Confirmar</button>
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

@push('script')
<script>
    function confirmarAlteracaoData()
    {
        if( $("#i-alteracao-data").val() == '' ) 
        {
            alert('Informe uma data válida!');
            return false;
        }

        if( $("#i-tipo-alteracao-data").val() == 'recibolocador' )
            var url="{{route('recibolocador.alterardatapag')}}";

        if( $("#i-tipo-alteracao-data").val() == 'recibolocatario' )
            var url="{{route('recibolocatario.alterardatapag')}}";

            var dados = 
                {   
                    novadata : $("#i-alteracao-data").val(),
                    recibo : $("#i-numero-recibo").val(),
                }
            $.ajaxSetup(
                {
                    headers:
                    {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });

            $.ajax
            (
                {
                    url:url, 
                    dataType:'json',
                    type:'post',
                    data:dados,
                    success:function()
                    {
                        alert('Registro Alterado!');
                    },
                    error: function()
                    {
                        alert('erro na alteração da data de pagamento');
                    }
                }
            )
    }

</script>


@endpush
