@extends('layout.app')
@section('scripttop')
<style>

    .div-direita
    {
        text-align:right;
    }

    .font-red
    {
        color:red;
    }

</style>

 <script>
  </script>

@endsection

@push('script')

@section('content')


<!-- BEGIN CONTENT -->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">Reajustes de Aluguéres
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <form id="form-carga">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <label class="label-control" for="i-data-inicio">Data Inicial</label>
                                            <input class="form-control" type="date" name="i-inicio" id="i-data-inicio">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="label-control" for="i-data-fim">Data Final</label>
                                            <input class="form-control" type="date" name="i-fim" id="i-data-fim">
                                        </div>
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="form-control btn btn-primary" id='form-carga'>Carregar</button>
                                        </div>
    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">Contratos a Reajustar
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table  id="tblcontratos" class="table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="10%" class="div-center"> #Data Hora </th>
                                                <th width="10%" class="div-center"> Pasta </th>
                                                <th width="30%" class="div-center"> Locatário </th>
                                                <th width="50%"> Informação </th>
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
        </div>
    </div>
</div> <!--<div class="col-md-12">-->


<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>


@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script>


$( document ).ready(function()
{

    $("#sirius-menu").click();


});
$("#i-mes").val( moment().format('MM'));
$("#i-ano").val( moment().format('YYYY'));



    var table = $('#tblcontratos').DataTable(
    {
        dom: 'Bfrtip',
        buttons: [
            'print',
        'excel'],
        "language":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate":
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria":
            {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        processing: true,
        serverSide: true,
        ajax:
        {
            url:"{{ route('boleto.painelenviadoscarga') }}",
            data: function (d)
            {
                d.datainicio = $('input[name=i-inicio]').val();
                d.datafim = $('input[name=i-fim]').val();
                         
            }
        },
        columns:
        [
            {data: 'IMB_OBS_DTHATIVO',render:formatarDataHora },
            {data: 'IMB_CTR_REFERENCIA' },
            {data: 'IMB_CLT_NOME' },
            {data: 'IMB_OBS_OBSERVACAO' },

        ],
        "columnDefs":
        [
                {
                "targets": 0,
                "orderable": false
                } ,
        ]    ,

        searching: false
    });


    $('#form-carga').on('submit', function(e)
    {

        table.clear();
        table.draw();
        e.preventDefault();

    });



function  formatarDataHora(data, type, full, meta)
{
    return moment( full.IMB_OBS_DTHATIVO).format('DD/MM/YYYY HH:MM:SS');
}

</script>



@endpush
