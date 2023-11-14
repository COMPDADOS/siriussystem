@extends('layout.app')

@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
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

    .font-20
    {
        font-size:30px;
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
        color:whi;
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
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Movimentações por Evento</span>
            <i class="fa fa-search font-blue"></i>
        </div>


    </div>
    <div class="portlet-body form">
        <form role="form" id="search-form">
            <div class="form-body">
                <div class="col-md-4">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control " name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>                
                    <div class="col-md-1 div-center font-20">
                        <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control " name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>                
                </div>              
                <div class="col-md-2">
                    <input class="form-control" type="text" id="i-pasta" placeholder="Pasta">
                </div>
                <div class="col-md-4">
                    @php
                        $eventos = app( 'App\Http\Controllers\ctrTabelaEventos')->carga();
                    @endphp
                    <select name="eventos[]" class="form-control multiple-select color-blue" id="IMB_TBE_ID" multiple>
                        @foreach( $eventos as $eve )
                            <option value="{{$eve->IMB_TBE_ID}}">{{$eve->IMB_TBE_NOME}}</option>
                        @endforeach
                    </select>
                </div>      
                <div class="col-md-2">
                    <label class="control-label">Pela Data de Competência</label>
                    <input type="checkbox" class="form-control" id="chkcompetencia">
                </div>
            </div>
            <div class="form-actions noborder">
                <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 6%">#ID</th>
                        <th class="div-center" style="width: 59%">Evento</th>
                        <th class="direita" style="width: 15%">$ em Recebidos(Entrada)</th>
                        <th class="direita" style="width: 15%">$ em Recebidos(Saída)</th>
                        <th class="direita" style="width: 15%">$ em Repassados</th>
                        <th class="direita" style="width: 15%">Saldo</th>
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
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



$(document).ready(function() 
    {

        $("#sirius-menu").click();


        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );
        $(".multiple-select").select2(
        {
                placeholder: 'Selecione ',
                width: null
        });



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
            "sSearch": "Pesquisar",
            "oPaginate": 
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url:"{{ route('movimentacaoporevento.carga') }}",
            data: function (d) 
            {
                d.inicio = $('input[name=inicio]').val();
                d.termino = $('input[name=termino]').val();
                d.eventos = $("#IMB_TBE_ID").val();
                d.porcompetencia = $("#chkcompetencia").prop( "checked" )   ? 'S' : 'N';
                d.pasta = $("#i-pasta").val();
            }

        },
        columns: 
        [
            {data: 'IMB_TBE_ID' },
            {data: 'IMB_TBE_NOME'},
            {data: 'Recebimento_Entrada', render:formatarValorRecebimentoEntrada},
            {data: 'Recebimento_Saida', render:formatarValorRecebimentoSaida},
            {data: 'Repassado', render:formatarValorRepassado},
            {data: 'Saldo', render:formatarValor}
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

    function formatarData(data)
    {
        if( data != null)
            return moment(data).format('DD/MM/YYYY')
        else    
            return '-';

    }

    function formatarValorRecebimentoEntrada(data, type, full, meta)
    {
//        debugger;
        var evento = full.IMB_TBE_ID;
        if( data ==  '' || data === null ) return '-';
        var valor = parseFloat(data);
        return '<div class="direita"><a href="javascript:explodirLancto('+evento+', \'RT\', \'D\')">'+formatarBRSemSimbolo( valor )+'</a></div>';
            

    }

    function formatarValorRecebimentoSaida(data, type, full, meta)
    {
//        debugger;
        var evento = full.IMB_TBE_ID;
        if( data ==  '' || data === null ) return '-';
        var valor = parseFloat(data);
        return '<div class="direita"><a href="javascript:explodirLancto('+evento+', \'RT\', \'C\')">'+formatarBRSemSimbolo( valor )+'</a></div>';
            

    }

    function formatarValorRepassado(data, type, full, meta)
    {
//        debugger;
        var evento = full.IMB_TBE_ID;
        if( data ==  '' || data === null ) return '-';
        var valor = parseFloat(data);
        return '<div class="direita"><a href="javascript:explodirLancto('+evento+', \'RD\', \'T\')">'+formatarBRSemSimbolo( valor )+'</a></div>';
            

    }

    
    function formatarValor(data,full)
    {
//        debugger;
        if( data ==  '' || data === null ) return '-';
        var valor = parseFloat(data);
        return '<div class="direita">'+formatarBRSemSimbolo( valor )+'</div>';
    }

    function explodirLancto( evento, tipo, debcre )
    {
        var inicio = $("#i-inicio").val();
        var fim = $("#i-termino").val();
        var porcompetencia = $("#chkcompetencia").prop( "checked" )   ? 'S' : 'N';
        var eventos = evento;

        if( tipo == 'RT' )
            var url = "{{route('movimentacaoporeventodetalherecebido.view')}}?inicio="+
                        inicio+"&termino="+fim+"&porcompetencia="+porcompetencia+"&eventos="+eventos+'&pasta='+$("#i-pasta").val()+'&debcre='+debcre;

        if( tipo == 'RD' )
            var url = "{{route('movimentacaoporeventodetalherepassado.view')}}?inicio="+
                        inicio+"&termino="+fim+"&porcompetencia="+porcompetencia+"&eventos="+eventos+'&pasta='+$("#i-pasta").val();
        
        window.open( url, '_blank' );


    }

    
    
</script>
@endpush


