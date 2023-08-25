<div class="modal fade" id="modalsubcontadetalhado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-target="#staticBackdrop">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i> <label id="i-lbl-subcontadetalhe">Detalhamento por Sub-Conta(Centro de Custo)</label> 
                        </div>
                        <div>
                        <button class="btn btn-danger pull-right" 
                            onClick="gerarRelatorioDetSbc()">Gerar Relatório</button>
                        </div>

                    </div>

                    <div class="portlet-body form">
                        <div class="col-md-12">
                        <input type="hidden" id="i-idsubcontarel">
                        <input type="hidden" id="i-nomesubcontarel">
                        <input type="hidden" id="i-periodorelatorio">
                        <div class="row">
                            <div class="col-md-12">
                                <table  id="tblsubcontadetalhe" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr >
                                            <th width="100px" style="text-align:center"> Data Entrada</th>
                                            <th width="100px" style="text-align:center"> Data Competência </th>
                                            <th width="100px" style="text-align:center"> CFC </th>
                                            <th width="200px" style="text-align:center"> Grupo </th>
                                            <th width="100px" style="text-align:center"> Valor </th>
                                            <th width="600px" style="text-align:center"> Histórico </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="100px" style="text-align:center"> Total SubConta</th>
                                            <th width="100px" style="text-align:center"> </th>
                                            <th width="100px" style="text-align:center">  </th>
                                            <th width="200px" style="text-align:center">  </th>
                                            <th width="100px" class="div-right"><b><input class="div-right form-control" type="text" id="i-total-sub" readonly></b></th>                                            
                                            <th width="600px" style="text-align:center"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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

function explodirSubConta( id, desc, valor, tipo )
{
    $("#modalsubcontadetalhado").modal('show');
    $('#tblsubcontadetalhe').dataTable().fnClearTable();
    $('#tblsubcontadetalhe').dataTable().fnDestroy();    
    $("#i-total-sub").val( formatarBRSemSimbolo( parseFloat(valor)) );
    $("#i-lbl-subcontadetalhe").html('Detalhamento da subconta: '+desc);
    $("#i-idsubcontarel").val( id );
    tipocfc = tipo;

    $("#i-title-erp").html( 'Relatório Detalhado: '+desc+' - '+moment($("#i-data-inicio-CONS").val()).format('DD/MM/YYYY')+' a '+moment($("#i-data-fim-CONS").val()).format('DD/MM/YYYY'));

    $("#i-nomesubcontarel").val(desc);
    $("#i-periodorelatorio").val(moment($("#i-data-inicio-CONS").val()).format('DD/MM/YYYY')+' a '+moment($("#i-data-fim-CONS").val()).format('DD/MM/YYYY') );
    
    var table = $('#tblsubcontadetalhe').DataTable(
    {
      
        "pageLength": -1,
        "language":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "  Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "..Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
                sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate":
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },
        bLengthChange: false,
        responsive: false,
        processing: true,
        ajax:
        {
            url:"{{ route('caixa.consolidadodetalhadosubconta') }}",
            data: function (d)
            {
                d.datainicio = $("#i-data-inicio-CONS").val();
                d.datafim = $("#i-data-fim-CONS").val();
                d.tipocompetencia = $("#tipocompetencia").val();
                d.FIN_SBC_ID = id;
                d.tipo = tipocfc;
            }
        },
        columns:
        [
            {data: 'FIN_LCX_DATAENTRADA', render:formatarData },
            {data: 'FIN_LCX_COMPETENCIA', render:formatarData },
            {data: 'FIN_CFC_DESCRICAO'},
            {data: 'FIN_GCF_DESCRICAO'},
            {data: 'FIN_CAT_VALOR', render:formatarValor },

            {data: 'FIN_LCX_HISTORICO' },
            
        ],
        searching: false
    });

    $('#btn-search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });



        
        //return '<div><a href=""><i class="fa fa-eye"></i></a></div>';

}

function formatarData( data )
{
    return moment(data).format('DD/MM/YYYY');
}

function formatarValor( data )
{
    var valor = parseFloat(data );
    return formatarBRSemSimbolo( data );
}

function operacao( data )
{
    if( data = 'C') return '+';

    return '-';
}

function gerarRelatorioDetSbc()
{
    alert('Gerando o relatorio');
    var url = "{{route('caixa.consolidadodetalhadosubconta')}}?datainicio="+$("#i-data-inicio-CONS").val()+"&datafim="+$("#i-data-fim-CONS").val()+
                "&tipocompetencia="+$("#tipocompetencia").val()+"&FIN_SBC_ID="+$("#i-idsubcontarel").val()+"&tipo="+$("#tipocfc").val()+"&gerarrelatorio=S"+
                "&subcontanome="+$("#i-nomesubcontarel").val()+"&periodo="+$("#i-periodorelatorio").val();

    window.open( url, '_blank');
            

}
</script>


@endpush
