@extends('layout.app')

@section('scripttop')
<style>

.riscado
{
    text-decoration: line-through;
}
td
{
    text-align:center;
}

.div-center
{
    text-align:center;

}
.bold
{
    font-weight: bold;

}

.span-email
{
    color:blue;
    font-size:10px;
    font-weight: bold;

}

.vermelho
{
    color:red;
}
.azul
{
    color:blue;
}
.escondido
{
    display:none;
}
.preto
{
    color:black;
}
</style>
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-circle">Avisos de Desocupação</i>
        </li>
    </ul>
</div>


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-primary pull-right" type="button" id="btn-limpar"
            onClick="novoAvisoDesocupacao()">Novo Aviso</button>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>
    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
        <!--<form acion="/cliente/list" method="get">-->

            <div class="form-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                        <label class="control-label" for="nome">Data Início:</label>
                            <input type="date" class="form-control " name="datainicio" placeholder="data inicial" id="i-inicio">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="nome">Data Fim:</label>
                            <input type="date" class="form-control "
                                name="datafim" placeholder="data Final" id="i-termino">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-form">&nbsp;
                            <button class="form-control btn blue pull-right" id='search-form'>Pesquisar</button>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="resultTable">
                    <thead>
                        <th width="5%"></th>
                        <th width="10%">ID Imóvel</th>
                        <th width="10%">Pasta</th>
                        <th width="35%">Imóvel</th>
                        <th width="10%">Data do Aviso</th>
                        <th width="10%">Data de Previsão</th>
                        <th width="10%">Liberado</th>
                        <th width="10%">Cancelado</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layout.modalavisodesocupacao')


@endsection
@push('script')

<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-sliderAccess.js')}}"></script>

<script type="text/javascript">

$(document).ready(function()
{
    //$("#i-inicio").val( moment().format( 'YYYY-MM-DD'));
    //$("#i-termino").val( moment().format( 'YYYY-MM-DD'));

    $("#sirius-menu").click();


});

    var table = $('#resultTable').DataTable(
    {
        "language":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
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
            url:"{{ route('avisodesocupacao.list') }}",
            data: function (d)
            {
                d.datainicio  = $('input[name=datainicio]').val();
                d.datafim  = $('input[name=datafim]').val();
            }
        },
        columns:
        [

            {
                "targets": 0,
                "data": null,
                'searchable': false,
                'orderable': false,

                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn glyphicon glyphicon-pencil btn btn-sm btn-primary pull-right btn-editar' title='editar'></button>"
            },
            {data: 'IMB_IMV_ID'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'Endereco'},
            {data :'IMB_AVD_DATAAVISO',         render:formatarDataAviso},
            {data: 'IMB_AVD_DATAPREVISAO',      render:formatarDataPrevisao},
            {data: 'IMB_AVD_LIBERADOPROP'},
            {data: 'IMB_AVD_DTHINATIVO', render:formatarDataCancelado},

        ],
        searching: false
    });

        $('#search-form').on('submit', function(e)
        {
            table.draw();
            e.preventDefault();
        });


        function limparCampos()
        {
            $("#i-filtroatendimento").val('');
            $("#i-atendimentostatus").val('');
            $("#i-prioridade").val('');
            $("#i-inicio").val('');
            $("#i-termino").val('');
            $("#i-select-corretor").val('');


        }

        function formatarDataAviso(data, type, full, meta)
        {
            return '<b>'+moment( full.IMB_AVD_DATAAVISO).format('DD/MM/YYYY')+'</b>';
        }

        function formatarDataPrevisao(data, type, full, meta)
        {

            var previsao = moment(full.IMB_AVD_DATAPREVISAO, "YYYY-MM-DD");
            var current = moment().startOf('day');

            var dias = moment.duration(previsao.diff(current)).asDays();

            var cancelado='';
            if( full.IMB_AVD_DTHINATIVO != null)
               cancelado = 'riscado'

            var cor = 'preto';
            if( dias > 0 )
               cor = "azul";

            if(dias < 0)
               cor = "vermelho";

            return '<span class="'+cor+' '+cancelado+'"><b>'+moment( full.IMB_AVD_DATAPREVISAO ).format( 'DD/MM/YYYY')+'</b></span>';

        }

        function formatarDataCancelado(data, type, full, meta)
        {
            var data = moment( full.IMB_AVD_DTHINATIVO).format('DD/MM/YYYY');
            if( data == 'Invalid date')
               data = '-';
            return '<b>'+data+'</b>';
        }





    </script>
@endpush
