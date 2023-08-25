<div class="modal fade" id="modalnovosclientes" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="portlet box yellow" >
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Novos Clientes ou Clientes que Sofreram alterações
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tblnovosclientes">
                                            <thead>
                                                <th class="div-center"></th>
                                                <th class="div-center"></th>
                                                <th class="div-center">Data</th>
                                                <th class="div-center">Nome</th>
                                                <th class="div-center">Fones</th>
                                            </thead>
                                        </table>
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

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt-cliente"  target="_blank">            
@csrf
    <input type="hidden"  name="id" id="id-cliente"/>                
    <input type="hidden" name="readonly" id="i-readonly-cliente">                
</form>


@push('script')
<script>
function mostrarNovosClientes()
    {
        url = "{{route('novosclientesatd')}}";

        $.ajax(
        {
            url             : url,
            dataType        : 'json',
            type            : 'get',
            async           : false,
            success         : function( data )
            {

                linha = "";
                $("#tblnovosclientes").empty();

                for( nI=0;nI < data.length;nI++)
                {
                    var datacadastro = moment(data[nI].IMB_IMV_DATACADASTRO).format('DD/MM/YYYY');


                    linha = 
                        '<tr>'+
                            '<td style="text-align:center" valign="center"> '+
                              '<a href=javascript:visualizar('+data[nI].IMB_IMN_ID+','+data[nI].IMB_CLT_ID+') class="btn btn-sm btn-success">Ver</a> '+
                            '</td> '+
                            '<td>'+data[nI].IMB_IMN_TIPOENTRADA+'</td>'+
                            '<td>'+datacadastro+'</td>'+
                            '<td>'+data[nI].IMB_CLT_NOME+'</td>'+
                            '<td>'+data[nI].FONES+'</td>';                            

                        linha = linha +
                        '</tr>';
                    $("#tblnovosclientes").append( linha );
                    $("#modalnovosclientes").modal('show');

                }
            }

        })
    }

    function visualizar( id, idimovel )
    {

        url = "{{route('informarclientevisualizado')}}";

        dados = { 'id' : id};

        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        

        $.ajax(
            {
                url : url,
                data:dados,
                dataType:'json',
                type:'post',
                async:false,
                success: function()
                {
                    $("#id-cliente").val( idimovel );
                    $("#i-readonly-cliente").val( "readonly" );
                    $("#form-alt-cliente").submit();
                }
            }
        );



    }
</script>
@endpush
