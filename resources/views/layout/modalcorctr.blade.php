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
                        <input type="hidden" id="i-idcorctr" name="IMB_CAPCTR_ID-CORCTR" >

                        @if(isset($idcontratopesquisa))
                            <input type="hidden" id="i-idcontrato-cor" name="IMB_CTR_ID-CORCTR"value = "{{$idcontratopesquisa}}">
                        @endif

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
    debugger;
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
        IMB_CORCTR_PERCENTUAL : realToDolar( $("#i-percentual-cor-ctr").val()),
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
                $("#modalcorctr").modal('hide');
                CarregarCorCtr( id )
                                
            },
            error: function( erro)
            {
                alert('Erro na gravação do corretor no contrato');
                $("#modalcorctr").modal('hide');
            }
        });

}





    function preencherCBCorretoresCtr( nidcorretor )
    {
        var empresa = "{{Auth::user()->IMB_IMB_ID}}"
        var url = "{{ route('atendente.carga')}}/"+empresa;
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
        debugger;
        if( $("#i-idcontrato-cor").val() == '' ) 
        {
            var atdid = $("#i-select-corretores-ctr" ).val();
            linha =
            '<tr id="l-cor'+atdid+'">'+
            '   <td class="div-center escondido">'+atdid+'</td>'+
            '   <td class="div-center">'+$("#i-select-corretores-ctr option:selected" ).text()+'</td>'+
            '   <td class="div-center">'+$("#i-percentual-cor-ctr").val()+'</td>'+
            '   <td style="text-align:center"> '+
            '<a  class="btn btn-sm btn-danger" href="javascript:apagarLinha( \'l-cor'+atdid+'\')">Apagar</a>'+
            '   </td>'+
            '</tr>';
            $("#tbcorctr").append( linha );
        }
        else
        {
            salvarCorCtrBD( $("#i-idcontrato-cor").val() );
        }
        

    }


</script>


@endpush
