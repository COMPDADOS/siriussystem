<div class="modal fade" id="modalconciliar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-sm">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Conciliar Lançamento
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                        <hr>
                    </div>

                    <div class="row">
                        <input type="hidden" id="FIN_LCX_IDCONCIL">
                        <div class="col-md-12 div-center">
                            <label class="control-label div-center">Data da Efetivação</label>
                            <input class="form-control div-center" type="date" id="i-dataefetivacao">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                    <button type="button" class="btn btn-primary" onClick="conciliarLancamento()">Conciliar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
<script>

    function conciliacao( id)
    {
        $("#FIN_LCX_IDCONCIL").val( id );
        $("#i-dataefetivacao").val( moment().format( 'YYYY-MM-DD'));
        $("#modalconciliar").modal('show');
    }

    function conciliarLancamento()
    {

        var url = "{{route('caixa.conciliarlancamento')}}";

        dados = 
        {
            FIN_LCX_ID : $("#FIN_LCX_IDCONCIL").val(),
            FIN_LCX_DATAENTRADA : $("#i-dataefetivacao").val(),
        }

        $.ajaxSetup({
        headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
            {
                url     : url,
                dataType: 'json',
                type    : 'post',
                data:dados,
                async:false,
                success: function( data )
                {
                    alert("Lançamento Conciliado!");
                    $("#modalconciliar").modal('hide');

                },
                error:function()
                {
                    alert('erro na conciliacao do Registro');
                }
            }
        )




    }
    function desconciliacao( id )
    {

        var url = "{{route('caixa.desconciliarlancamento')}}";

        dados = 
        {
            FIN_LCX_ID : id,
        }

        $.ajaxSetup({
        headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
            {
                url     : url,
                dataType: 'json',
                type    : 'post',
                data:dados,
                async:false,
                success: function( data )
                {
                    alert("Lançamento desconciliado!");

                },
                error:function()
                {
                    alert('erro na conciliacao do Registro');
                }
            }
        )




    }

</script>


@endpush
