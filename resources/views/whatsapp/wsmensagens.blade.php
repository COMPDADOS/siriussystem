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

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Mensagens WhastApp
            </span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>
    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
                <div class="col-md-4 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Período das Mensagens

                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>                
                    <div class="col-md-2 div-center font-20">
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control" name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>                
                </div>
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form' onClick="redrawTable()">Pesquisar</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 10%">Data</th>
                        <th style="width: 10%">Tipo</th>
                        <th style="width: 15%">Cliente</th>
                        <th style="width: 15%">Nome no Whatapp</th>
                        <th style="width: 50%">Mensagem</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
    <script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



    $(document).ready(function() 
    {

        $("#sirius-menu").click();

        $("#i-inicio").val( moment().format('DD/MM/YYYY') );
        $("#i-termino").val( moment().format('DD/MM/YYYY') );

    });

    
    url = "{{ route('whastapp.mensagenstrocadas') }}";
    console.log( url );
    var table = $('#resultTable').DataTable(
    {
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
        bLengthChange: false,
        bSort : true ,
        responsive: false,
        processing: true,
        serverSide: false,
        bFilter: true,        
        ajax: 
        {
            url: url,
            data: function (d) 
            {
                d.inicio = $('input[name=inicio]').val();
                d.termino = $('input[name=termino]').val();
                d.idcliente = $('input[name=idcontrato]').val();
            }

        },
        columns: 
        [
            {data: 'BODY_MESSAGETIMESTAMP', render:formatarData},
            {data: 'MTYPE'},
            {data: 'IMB_CLT_NOME'},
            {data: 'BODY_PUSHNAME'},
            {data: 'MODY_MESSAGE_CONVERSATION'}
        ]
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });


    function limparCampos()
    {

    }

    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }

    function formatarData(data)
    {
        return '<div class="div-center">'+moment( data ).format( 'DD/MM/YYYY HH:mm:ss')+'</div>';
    }
    
    
</script>
@endpush


