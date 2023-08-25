<div class="modal fade" id="modalhistltdet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:80%;" >
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Detalhamento de Recebimento
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <table  id="tbldetalherecibo" class="table table-striped table-bordered table-hover" >
                                <thead class="thead-dark">
                                        <th width="5%" style="text-align:center"> #ID</th>
                                        <th width="20%" style="text-align:center"> Evento </th>
                                        <th width="5%" style="text-align:center"> Tipo </th>
                                        <th width="10%" style="text-align:right"> Valor </th>
                                        <th width="60%" style="text-align:right"> Observação </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
<script>

    function cargaHistDet( idrecibo)
    {
        var url = "{{route('recibolocatario.itensrecibo')}}/"+idrecibo;

        $.getJSON( url, function( data )
        {        

            linha = "";
            $("#tbldetalherecibo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha = '<tr>'+
                    '<td class="td-center">'+data[nI].IMB_TBE_ID+'</td>' +
                    '<td class="td-center">'+data[nI].IMB_TBE_NOME+'</td>' +
                    '<td class="td-center">'+data[nI].IMB_RLT_LOCATARIOCREDEB+'</td>' +
                    '<td class="td-rigth">R$ '+formatarBRSemSimbolo( parseFloat(data[nI].IMB_RLT_VALOR))+' </td>' +
                    '<td class="td-center">'+data[nI].IMB_RLT_OBSERVACAO+'</td>' +
                  '</tr>';
            $("#tbldetalherecibo").append( linha );
            } 

        });   
        $("#modalhistltdet").modal('show');
    }

</script>


@endpush
