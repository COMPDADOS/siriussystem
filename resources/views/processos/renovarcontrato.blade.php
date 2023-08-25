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
                        <div class="caption">Contratos a Renovar
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
                                    <div class="col-md-3">
                                        <label class="control-label">Mês de Vencimento</label>
                                        <input type="hidden" name="i-mes" id="i-mes">
                                        <select class="form-control" id="i-select-mes" >
                                            <option value="">Selecione Mês</option>
                                            <option value="1">Janeiro</option>
                                            <option value="2">Fevereiro</option>
                                            <option value="3">Março</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Maio</option>
                                            <option value="6">Junho</option>
                                            <option value="7">Julho</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Setembro</option>
                                            <option value="10">Outubro</option>
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Ano</label>
                                        <input class="form-control" type="number" name="i-ano" id="i-ano" max="2040" >
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="form-control btn btn-primary" id='form-carga'>Iniciar</button>
                                    </div>

                                    <div class="col-md-1">
                                        <button class="form-control  btn btn-danger">Cancelar</button>
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
                                                <th width="5%" class="div-center"> #Imóvel </th>
                                                <th width="5%" class="div-center"> Pasta </th>
                                                <th width="19%" class="div-center"> Endereço </th>
                                                <th width="15%" class="div-center"> Locador </th>
                                                <th width="15%" class="div-center"> Locatário </th>
                                                <th width="10%" class="div-center"> Ínicio </th>
                                                <th width="10%" class="div-center"> Término </th>
                                                <th width="10%" class="div-center"> $ Aluguel </th>
                                                <th width="10%" class="div-center"> Ações </th>
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

@include('layout.modalrenovar')
          <!-- BEGIN QUICK SIDEBAR -->

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

    $("#i-select-mes").blur( function()
    {
        var cmes = $('#i-select-mes').val();
        $("#i-mes").val( cmes);

    })

    $('#clickmewow').click(function()
    {
        $('#radio1003').attr('checked', 'checked');
    });


});

    $("#i-mes").val( moment().format('MM'));
    $("#i-ano").val( moment().format('YYYY'));


    url = "{{ route('renovar.carga') }}";
    console.log( url+'?mes='+$('input[name=i-mes]').val()+'&ano= '+$('input[name=i-ano]').val());

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
            url: url,
            data: function (d)
            {
                d.mes = $('input[name=i-mes]').val();
                d.ano = $('input[name=i-ano]').val();
            }
        },
        columns:
        [
            {data: 'IMB_IMV_ID' },
            {data: 'IMB_CTR_REFERENCIA' },
            {data: 'ENDERECO' },
            {data: 'LOCADOR' },
            {data: 'LOCATARIO' },
            {data: 'IMB_CTR_INICIO',render:formatarData },
            {data: 'IMB_CTR_TERMINO',render:formatarData },
            {data: 'IMB_CTR_VALORALUGUEL', render:formatavaloraluguel },

        ],
        "columnDefs":
        [
                {
                "targets": 0,
                "orderable": false
                } ,
                {
                    "targets": 8,
                    "data": null,
                    "defaultContent": "<div style='text-align:center'>"+
                        "<button title='click aqui para realizar a renovação' class='btn green-meadow glyphicon glyphicon-saved pull-right btn-reajustar'></button>",
                },
        ]    ,

        searching: false
    });


    $('#form-carga').on('submit', function(e)
    {
        if( $("#i-ano").val() == '' )
        {
            alert('Informe o ano');
            return false;
        }

        table.clear();
        table.draw();
        e.preventDefault();
        $("#div-reajustartodos").show();

    });

    $('#tblcontratos tbody').on( 'click', '.btn-reajustar', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            $("#i-valordigitado").val(0);
            realizarRenovacao( data.IMB_CTR_ID );
        });




function  formatarData(data, type, full, meta)
{
    return moment(data).format('DD/MM/YYYY');
}

function   formatavaloraluguel(data, type, full, meta)
{

    var valoraluguel = dolarToReal(full.IMB_CTR_VALORALUGUEL);

    return '<div class="div-direita">'+formatarBRSemSimbolo( parseFloat(valoraluguel) )+'</div>';
}


</script>



@endpush
