<div class="modal" tabindex="-1" role="dialog" id="modalcorctr">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Corretor do Contrato
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                        <input type="hidden" id="i-idcorctr" name="IMB_CAPCTR_ID-CORCTR">
                        <input type="hidden" id="i-idcontrato-cor" name="IMB_CTR_ID-CORCTR">

                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Corretor</label>
                                            <select class="form-control" id="i-select-corretores-ctr" >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Percentual</label>
                                            <input class="form-control valor" id="i-percentual-cor-ctr">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary" onClick="adicionarTabCorCtr()">Salvar mudanças</button>
                        </div>
            </div>
        </div>
    </div>
</div>


@push('script')

<script>
function adicionarCorCtr()
{
    preencherCBCorretoresCtr(0);
    $("#modalcorctr").modal('show');

}

function salvarCorCtrBD( id )
{
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });

    corimo =
    {
        IMB_ATD_ID : $("#i-select-corretores-ctr").val(),
        IMB_CORCTR_PERCENTUAL : realToDola( $("#i-percentual-cor-ctr").val()),
        IMB_CORCTR_ID : id ,
        IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
        IMB_CTR_ID : id,
    };


        var url = "{{ route('corctr.salvar')}}";

        $.ajax(
        {
            url:url,
            type:'post',
            datatype:'json',
            async:false,
            data: corimo,
            success:function( data)
            {
            },
            error: function( erro)
            {
                alert('Erro na gravação do captador do contrato '+
                table.rows[r].cells[1].innerHTML+' - erro:'+erro);

            }
        });

}





    function preencherCBCorretoresCtr( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.carga')}}/"+empresa;
        console.log( url );
        debugger;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    linha = "";
                    $("#i-select-corretores-ctr").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<option value="'+data[nI].IMB_ATD_ID+'">'+
                            data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-corretores-ctr").append( linha );
                    }
                    $("#i-select-corretores-ctr").val( nidcorretor );
                },
                complete:function()
                {
                },
                error:function()
                {
                }
       
        });

    }

    function adicionarTabCorCtr()
    {
        var atdid = $("#i-select-corretores-ctr" ).val();
        linha =
            '<tr id="l-cor'+atdid+'">'+
            '   <td class="div-center">'+atdid+'</td>'+
            '   <td class="div-center">'+$("#i-select-corretores-ctr option:selected" ).text()+'</td>'+
            '   <td class="div-center">'+$("#i-percentual-cor-ctr").val()+'</td>'+
            '   <td style="text-align:center"> '+
            '<a  class="btn btn-sm btn-danger" href="javascript:apagarLinha( \'l-cor'+atdid+'\')">Apagar</a>'+
            '   </td>'+
            '</tr>';
        $("#tbcorctr").append( linha );

    }


</script>


@endpush
