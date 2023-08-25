@extends('layout.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Cadastro</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Imóveis</span>
        </li>
    </ul>
</div>

<h1 class="page-title"> Cadastro de Clientes
    <small>Gerenciamento de Clientes</small>
    <button class="btn green pull-right" type="button">Novo Cliente</button>
</h1>


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
        <!--<form acion="/cliente/list" method="get">-->
            <div class="form-body">
                <div class="row">
                <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="id">Código</label>
                            <input type="text" class="form-control" name="id">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Nome(nome fantasia)</label>
                            <input type="text" class="form-control" name="nome" placeholder="por ser um pedaço do nome">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Conjuge</label>
                            <input type="text" class="form-control" name="conjuge"placeholder="por ser um pedaço">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label" for="cnpj">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cnpj">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Conjuge</label>
                            <input type="text" class="form-control" name="conjuge"placeholder="por ser um pedaço">
                        </div>
                    </div>
                </div>
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form'>Pesquisar</button>
                </div>
            </div>

        </form>
        <hr style="margin-top: 40px;" />
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="resultTable">
                    <thead>
                        <th width="50">#ID</th>
                        <th>Nome</th>
                        <th width="100">CPF/CNPJ</th>
                        <th>conjuge</th>
                        <th width="150" class="text-right">Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script type="text/javascript">
        var table = $('#resultTable').DataTable({
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
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
},
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('cliente.list') }}",
                data: function (d) {
                    d.id = $('input[name=id]').val();
                    d.nome = $('input[name=nome]').val();
                    d.cnpj = $('input[name=cnpj]').val();
                    d.razao = $('input[name=conjuge]').val();
                }
            },
            columns: [
                {data: 'IMB_CLT_ID', name: 'IMB_CLT_ID'},
                {data: 'IMB_CLT_NOME', name: 'IMB_CLT_NOME'},
                {data: 'IMB_CLT_CPF', name: 'IMB_CLT_CPF'},
                {data: 'IMB_CLTCJG_NOME', name: 'IMB_CLTCJG_NOME'}
            ],
            "columnDefs": [ 
                {
                    "targets": 4,
                    "data": null,
                    "defaultContent": "<div style='text-align:center'><button class='glyphicon glyphicon-trash btn btn-danger pull-right del-imv'></button><button class='glyphicon glyphicon-pencil btn btn-primary pull-right alt-imv'></button><button class='btn green-meadow glyphicon glyphicon-search pull-right show-imv'></button>",
                } 
            ],
            searching: false
        });

        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.show-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('cliente.form') }}/" + data.IMB_CLT_ID;            
        });

        $('#resultTable tbody').on( 'click', '.alt-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('cliente.edit') }}/" + data.IMB_CLT_ID;            
        });

        
    </script>
@endpush
