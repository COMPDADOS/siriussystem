@section( 'scripttop')
<style>
.div-cinza
{
    background-color: lightblue;
}

.div-center-table-clientes
{
  text-align:center;
}

.escondido {
  display: none;
}

</style>

@endsection
<div class="modal fade" id="propModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width:90%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Cliente
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" id="i-str"
                                placeholder="digite aqui um pedaço do nome"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary"
                                    onClick="buscaIncremental2()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="i-idpropimo" name="IMB_PPI_ID">
                    <input type="hidden" id="i-idimovel-prop" name="IMB_IMV_ID" >
                    <div class="row">
                        <div class="col-md-12" id="div-a-selecionar">
                            <div class="form-group">
                                Selecione o Cliente<select class="form-control " id="selclientelike" readonly>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 div-cinza div-center-table-clientes" id="div-listaclientes">
                            <table class="table  table-striped table-hover" id="tblclientes"  width=300 height=100>
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20%" >Nome</th>
                                        <th width="30%" >Fones</th>
                                        <th width="10%"
                                            style="text-align:center"> -
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">% Partic.</label>
                                    <input type="number" id="i-percentual-prop"  min="0.01"
                                    class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Principal
                                    <input type="checkbox"
                                        class="form-control" data-checkbox="icheckbox_flat-blue"
                                        id="i-principal-prop">

                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-6 center">
                            <label >O Cliente não está cadastrado?</label>
                            <button type="button" class="btn btn-success" onClick="novoCadastroCliente()">Cadastrar Novo Cliente</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="criarPropImo()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>

    function buscaIncremental2()
    {
        $("#div-listaclientes").show();
        $("#propModal").modal('show');
        str = $("#i-str").val();
        if( isNaN( str) )
        {
            var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

            $.getJSON( url, function( data)
            {
                linha = "";
                $("#tblclientes>tbody").empty();
                console.log( data );
                for( nI=0;nI < data.length;nI++)
                {
                    console.log('linha '+linha );
                    linha =
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_CLT_NOME+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FONES+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                            '<a href=javascript:selecionar('+data[nI].IMB_CLT_ID+') class="btn btn-sm btn-primary">Selecionar</a> '+
                        '</td> ';
                    linha = linha +
                        '</tr>';

                    $("#tblclientes").append( linha );

                }

            });
        }
        else
        {
            var url = "{{ route('cliente.localizar.telefone') }}"+"/"+str;

            $.getJSON( url, function( data)
            {
                if( data != ' ')
                {
                    linha = "";
                    $("#tblclientes>tbody").empty();
                    linha =
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+data.IMB_CLT_NOME+'</td>' +
                            '<td style="text-align:center valign="center">'+data.FONES+'</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:selecionar('+data.IMB_CLT_ID+') class="btn btn-sm btn-primary">Selecionar</a> '+
                            '</td> ';
                    linha = linha +
                            '</tr>';

                    $("#tblclientes").append( linha );
                }

            });
        }

    }


    /*$("#i-str").keyup( function()
    {
        if ( $("#i-str").val().length >= 30 )
        {
            $("#tblclientes").show();
            buscaIncremental();
        }

    });
    */


    function selecionar( id )
    {
        var url = "{{route('cliente.find')}}/"+id;

        $.ajax
        (
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                async       : false,
                success     : function( data )
                {
                    $("#selclientelike").empty();
                    $("#selclientelike").append( '<option value="'+id+'">'+data.IMB_CLT_NOME+'</option>');
                    $("#i-codigocliente").val( id );

                }

            }
        )




        $("#div-listaclientes").hide();



    }

</script>

@endpush
