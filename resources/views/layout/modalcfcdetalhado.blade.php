<div class="modal fade" id="modalcfcdetalhado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-target="#staticBackdrop">
    <div class="modal-dialog" style="width:70%;" >
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <input type="hidden" id="FIN_CFC_ID_DET">
                    <input type="hidden" id="FIN_SBC_ID_DET">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i> <label id="i-lbl-cfcdetalhe">Detalhamento por CFC</label> 
                        </div>
                        <div>
                        <button class="btn btn-danger pull-right" 
                            onClick="gerarRelatorioDetcfc()">Gerar Relatório</button>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table  id="tblcfcdetalhe" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr >
                                            <th width="100px" style="text-align:center"> Data Entrada</th>
                                            <th width="100px" style="text-align:center"> Data Competência </th>
                                            <th width="100px" style="text-align:center"> Valor </th>
                                            <th width="400px" style="text-align:center"> Histórico </th>
                                            <th width="200px" style="text-align:center"> Sub-Conta </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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

function explodirCfc( id, subid)
{
    $("#FIN_CFC_ID_DET").val( id );   
    $("#FIN_SBC_ID_DET").val( subid );    
    $("#modalcfcdetalhado").modal('show');
    $('#tblcfcdetalhe').dataTable().fnClearTable();
    $('#tblcfcdetalhe').dataTable().fnDestroy();    
    var table = $('#tblcfcdetalhe').DataTable(
    {
        "pageLength": 50,
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
        bSort : false ,
        responsive: false,
        processing: true,
 
        async: false,
        ajax:
        {
            url:"{{ route('caixa.consolidadodetalhado') }}",
            data: function (d)
            {
                d.datainicio = $("#i-data-inicio-CONS").val();
                d.datafim = $("#i-data-fim-CONS").val();
                d.tipocompetencia = $("#tipocompetencia").val();
                d.FIN_CFC_ID = id;
                d.sbcid = subid;
            }
        },
        columns:
        [
            {data: 'FIN_LCX_DATAENTRADA', render:formatarData },
            {data: 'FIN_LCX_COMPETENCIA', render:formatarData },
            {data: 'FIN_CAT_VALOR', render:formatarValor },
            {data: 'FIN_LCX_HISTORICO' },
            {data: 'FIN_SBC_DESCRICAO'}
            
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

function gerarRelatorioDetcfc()
{
    alert('Gerando o relatorio');
    var url = "{{route('caixa.consolidadodetalhado')}}?datainicio="+$("#i-data-inicio-CONS").val()+"&datafim="+$("#i-data-fim-CONS").val()+
                "&tipocompetencia="+$("#tipocompetencia").val()+"&sbcid="+$("#FIN_SBC_ID_DET").val()+
                "&FIN_CFC_ID="+$("#FIN_CFC_ID_DET").val()+"&tipo="+$("#tipocfc").val()+"&gerarrelatorio=S"+
                "&subcontanome="+$("#i-nomesubcontarel").val()+"&periodo="+$("#i-periodorelatorio").val();

    window.open( url, '_blank');
            

}
</script>


@endpush
