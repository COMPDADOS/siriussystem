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
<div class="modal fade" id="modallocalizarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="IMB_CLT_ID-SEL">
                    <input type="hidden" id="IMB_CLT_NOME-SEL">
                    <input type="hidden" id="i-tipo-cliente">
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
                                    onClick="buscaIncrementalLocCLi()">Carregar Sugestões
                                </button>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>

    function buscaIncrementalLocCLi()
    {
        $("#div-listaclientes").show();
//        $("#propModal").modal('show');
        str = $("#i-str").val();
        if( isNaN( str) )
        {
            var url = "{{ route('cliente.list') }}";
            var tp ='';
            if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'LT')
                tp = 'LT'
            else
            if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'PP')
                tp = 'P';
            else
            if( $("#IMB_SOL_TIPOSOLICITANTE").val() == 'FD')
                tp = 'FD';

            var dados =
             {
                pesquisagenerica : str,
                tipopesquisa:tp,
            };


            $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                data:dados,
                success:function( data )
                {
                    linha = "";
                    $("#tblclientes>tbody").empty();
                    for( nI=0;nI < data.data.length;nI++)
                    {
                        linha =
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+data.data[nI].IMB_CLT_NOME+'</td>' +
                            '<td style="text-align:center valign="center">'+data.data[nI].FONES+'</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:selecionarCliLoc('+data.data[nI].IMB_CLT_ID+') class="btn btn-sm btn-primary">Selecionar</a> '+
                            '</td> ';
                        linha = linha +
                        '</tr>';

                        $("#tblclientes").append( linha );
                    }

                }
            })
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



</script>

@endpush
