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
                $label = "Por Data Recto.";
                if( $porcompetencia == 'S') $label = 'Por Data Vencto';
                $nomeeve = app('App\Http\Controllers\ctrRotinas')->evento( $eventos);
            @endphp
            <div class="col-md-7">
                <span class="caption-subject "><b>RECEBIDOS: </b>Movimentações por Evento - Detalhado - Período: <b>
                    {{app('App\Http\Controllers\ctrRotinas')->formatarData($datainicio)}} a {{app('App\Http\Controllers\ctrRotinas')->formatarData($datafim)}}</b> - <b>{{$label}}</b></span>
            </div>
            <div class="col-md-4 div-center font-white fundo-black">
                <span class="caption-subject "><b>*** EVENTO: <b><u><i>{{$nomeeve->IMB_TBE_NOME}} ***</i></u></b></b><span>
            </div>
            <div class="col-md-1">
                <button class="form-control btn btn-primary" onClick="ImprimirMovEveDet()">Imprimir</button>
            </div>
        </div>


    </div>
    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 10%">Data Vencimento</th>
                        <th style="width: 10%">Data Recebimento</th>
                        <th class="div-center" style="width: 10%">Pasta</th>
                        <th class="div-center" style="width: 20%">Locatário</th>
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
    {   
        "paging": true,
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pagingType": "full_numbers",
        "pageLength": -1,
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
            "sSearch": "Pesquisar"
        },
        "oPaginate": 
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        ordering: false,
        bSort : false,
        responsive: false,
        processing: true,
        
        ajax: 
        {
            url:"{{ route('movimentacaoporeventodetalherecebido.carga') }}",
            data: function (d) 
            {
                d.inicio = "{{$datainicio}}";
                d.termino = "{{$datafim}}";
                d.eventos = "{{$eventos}}";
                d.porcompetencia = "{{$porcompetencia}}";
                d.pasta = "{{$pasta}}";
                d.debcre = "{{$debcre}}";
            }
            

        },
        columns: 
        [

            {data: 'IMB_RLT_DATACOMPETENCIA'},
            {data: 'IMB_RLT_DATAPAGAMENTO' },
            {data: 'IMB_CTR_REFERENCIA' },
            {data: 'LOCATARIO'},
            {data: 'IMB_RLT_VALOR', render:formatarValor},
            {data: 'IMB_RLT_LOCATARIOCREDEB', render:debCre},
            {data: 'IMB_RLT_OBSERVACAO'}
        ],

        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        

    $('#resultTable tbody').on( 'click', '.del-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            cancelarNFS( data.IMB_NFE_CHAVE );
            table.draw();
        });

        $('#resultTable tbody').on( 'click', '.btn-gerar', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            gerarNFS( data.IMB_RLD_NUMERO );
            table.draw();
        });

        $('#resultTable tbody').on( 'click', '.btn-pdf', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            gerarPDF( data.IMB_NFE_CHAVE );
        });


        $('#resultTable tbody').on( 'click', '.show-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
  //          verLcx( data.FIN_LCX_ID );
        });


         
        


    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }



    
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

    function ImprimirMovEveDet()
    {

        inicio = "{{$datainicio}}";
        termino = "{{$datafim}}";
        eventos = "{{$eventos}}";
        porcompetencia = "{{$porcompetencia}}";
        pasta = "{{$pasta}}";
        relatorio='S';

        url = "{{ route('movimentacaoporeventodetalherecebido.carga') }}?inicio={{$datainicio}}&termino={{$datafim}}"+
                "&eventos={{$eventos}}&porcompetencia={{$porcompetencia}}&pasta={{$pasta}}&relatorio=S";

        window.open( url, '_blank');


    }
    
</script>
@endpush


