<div class="modal" tabindex="-1" role="dialog" id="modalcapctr">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Captador do Contrato
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                        <input type="hidden" id="i-idcapctr" name="IMB_CAPCTR_ID">
                        <input type="hidden" id="i-idcontrato-cap">
                        <input type="hidden" id="i-tela-origem">

                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Captador</label>
                                            <select class="form-control" id="i-select-captador-ctr" name="IMB_ATD_ID-CTR">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Percentual</label>
                                            <input class="form-control valor" id="i-percentual-cap-ctr">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary" onClick="adicionarTabCapCtr()">Salvar</button>

                        </div>
            </div>
        </div>
    </div>
</div>


@push('script')

<script>
function adicionarCapCtr()
{
    cargaCaptadores();
    $("#modalcapctr").modal('show');

}

function salvarCapCtrBD()
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
            IMB_ATD_ID : $("#i-select-captador-ctr").val(),
            IMB_CAPIMO_PERCENTUAL : realToDolar( $("#i-percentual-cap-ctr").val()),
            IMB_CAPIMO_ID : '',
            IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
            IMB_CTR_ID : $("#i-idcontrato-cap").val(),
        };

        var url = "{{ route('capctr.salvar')}}";

        $.ajax(
        {
            url:url,
            type:'post',
            datatype:'json',
            async:false,
            data: corimo,
            success:function( data)
            {
                $("#modalcapctr").modal('hide');
                CarregarCapCtr( $("#i-idcontrato-cap").val());
                alert('gravado!');
            },
            error: function( erro)
            {
                alert('Erro na gravação do captador do contrato ');
                

            }
        });
    
}

function cargaCaptadores()
{


    var url = "{{ route('atendente.cargaativos')}}";

    $.getJSON( url, function( data )
    {
        linha = "";
        $("#i-select-captador-ctr").empty();
        for( nI=0;nI < data.length;nI++)
        {

            linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                    data[nI].IMB_ATD_NOME+"</option>";
                $("#i-select-captador-ctr").append( linha );
            }
    });
}

function adicionarTabCapCtr()
    {
        alert( $("#i-tela-origem").val());
        if( $("#i-tela-origem").val() == 'contratoedit' )
        {
            salvarCapCtrBD();
        }
        else
        {
            var atdid = $("#i-select-captador-ctr" ).val();
            linha =
                '<tr id="l-cap'+atdid+'">'+
                    '   <td class="div-center">'+atdid+'</td>'+
                '   <td class="div-center">'+$("#i-select-captador-ctr option:selected" ).text()+'</td>'+
                '   <td class="div-center">'+$("#i-percentual-cap-ctr").val()+'</td>'+
                '   <td style="text-align:center"> '+
                '<a  class="btn btn-sm btn-danger" href="javascript:apagarLinha( \'l-cap'+atdid+'\')">Apagar</a>'+
                '   </td>'+
                '</tr>';
            $("#tbcapimo-contrato").append( linha );
            console.log(linha);
        }

    }




</script>


@endpush
