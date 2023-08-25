@extends('layout.app')

@section('scripttop')
<style>

    .escondido
    {
        display:none;
    }
    .new-input{width:500px}    
    .new-input-200{width:200px}    
    .td-50
    {   
        height:50%;
    }

    .font-18
    {
        font-size:18px;
    }

    .td-center
    {   
        text-align:center;
    }
    
    .excluido {
      text-decoration: line-through;
    }
    .td-direita
    {   
        text-align:right;
    }

    table.dataTable tbody th, table.dataTable tbody td 
    {
        padding: 1px 10px; 
        text-align:center;

    }


    .div-center
    {
        text-align:center;
    }

    .fundo-grey
    {
        background-color: #eff5f5;
    }

    .azul
    {
        color:blue;
    }
    .font-white
    {
        color:white;
    }
    .vermelho
    {
        color:red;
    }

    .fundo-azul
    {
        background-color:blue;
    }
    .fundo-black
    {
        background-color:black;
    }

    table.dataTable td 
    {
        font-size: 14px;
    }

    .direita
    {
        text-align: right;
    }
</style>
@endsection

@section('content')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="col-md-12 font-18">
            @php
                $label = "Por Data Repasse";
                if( $porcompetencia == 'S') $label = 'Por Data Vencto';
                $nomeeve = app('App\Http\Controllers\ctrRotinas')->evento( $eventos);
            @endphp
            <div class="col-md-7">
                <span class="caption-subject "><b>REPASSADOS: </b>Movimentações por Evento - Detalhado - Período: <b>
                    {{app('App\Http\Controllers\ctrRotinas')->formatarData($datainicio)}} a {{app('App\Http\Controllers\ctrRotinas')->formatarData($datafim)}}</b> - <b>{{$label}}</b></span>
            </div>
            <div class="col-md-5 div-center font-white fundo-black">
                <span class="caption-subject "><b>*** EVENTO: <b><u><i>{{$nomeeve->IMB_TBE_NOME}} ***</i></u></b></b><span>
            </div>
        </div>


    </div>
    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 10%">Data Vencimento</th>
                        <th style="width: 10%">Data Repasse</th>
                        <th class="div-center" style="width: 10%">Pasta</th>
                        <th class="div-center" style="width: 20%">Locador</th>
                        <th class="direita" style="width: 10%">Valor R$</th>
                        <th class="direita" style="width: 5%">+/-</th>
                        <th style="width: 55%">Observação</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>

<script>



$(document).ready(function() 
    {

        $("#sirius-menu").click();


    });



    var table = $('#resultTable').DataTable(
    {   "pageLength": 40,
        "lengthChange": true,
        "language": 
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
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
        bSort : true ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url:"{{ route('movimentacaoporeventodetalherepassado.carga') }}",
            data: function (d) 
            {
                d.inicio = "{{$datainicio}}";
                d.termino = "{{$datafim}}";
                d.eventos = "{{$eventos}}";
                d.porcompetencia = "{{$porcompetencia}}";
            }
            

        },
        columns: 
        [

            {data: 'IMB_RLD_DATAVENCIMENTO'},
            {data: 'IMB_RLD_DATAPAGAMENTO' },
            {data: 'IMB_CTR_REFERENCIA' },
            {data: 'LOCADOR'},
            {data: 'IMB_RLD_VALOR', render:formatarValor},
            {data: 'IMB_RLD_LOCADORCREDEB', render:debCre},
            {data: 'IMB_RLD_OBSERVACAO'}
        ],

        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        

             
    function formatarValor(data,full)
    {
//        debugger;
        if( data ==  '' || data === null ) return '-';
        var valor = parseFloat(data);
        return '<div class="direita">'+formatarBRSemSimbolo( valor )+'</div>';
    }

    function debCre(data)
    {
        if( data == 'C' ) return '<b>-</b>';
        if( data == 'D' ) return '<b>+</b>';
        return '';
    }
    
</script>
@endpush


