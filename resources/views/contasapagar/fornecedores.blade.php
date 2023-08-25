@extends('layout.app')
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>

.gi-2x{font-size: 2em;}
.gi-3x{font-size: 3em;}
.gi-4x{font-size: 4em;}
.gi-5x{font-size: 5em;}

.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-right: 8px;
    padding-left: 8px;
}
.pad-left-zero
{
    position: relative;
    min-height: 1px;
    padding-right: 0px;
    padding-left: 0px;
}

.escondido
{
    display:none;
}
.div-center {
    text-align: center;
  }

  .italic
{
    text-decoration: italic;
}
.font-10px
{
    font-size:10px;
}

.font-green
{
    color:green;
}
.font-und-14px
{
    font-size:14px;
    color: grey;
    text-decoration: underline;
}
.font-red-bold-10px
{
    font-size:12px;
    color: red;
    font-weight: bold;

}
.bg-red-foreg-white
{
    background-color: red;
    color:white;
    font-size:14px;
    font-weight: bold;

}
.bg-blue-foreg-white
{
    background-color: blue;
    color:white;
    font-size:14px;
    font-weight: bold;
}
.bg-orange-foreg-black
{
    background-color: orange;
    color: black;
    font-size:14px;
    font-weight: bold;
}



.bg-peru-foreg-white
{
    background-color:peru;
    color:white;
    font-size:14px;
    font-weight: bold;

}

.bg-peru-green-white
{
    background-color:green;
    color:white;
    font-size:14px;
    font-weight: bold;

}

.bg-gray-fore-black
{
    background-color:darkorange;
    color:black;
    font-size:14px;
    font-weight: bold;

}

.font-10px-bold
{
    font-size:12px;
    color: #000099;
    font-weight: bold;

}
.font-10px
{
    font-size:12px;
    color: #000099;
}

h5 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

h1 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

.lbl-cliente {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-cor-fonte-white{
    color:white;
}
.div-cor-red {
  border-style: solid;
  border-color: red;
  color: white;
}

.div-cor-green {
    border-style: solid;
  border-color: green;
}

.div-cor-blue {
    background-color: blue;
    color: white;
}

.div-cor-white{
    border-style: solid;
  border-color: white;
}

td{text-align:center;}
th{text-align:center;}

.td-center{text-align:left;}

</style>

@endsection

@section('content')


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('home')}}">home</a>
            <i class="fa fa-circle"></i>
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
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
        <!--<form acion="/cliente/list" method="get">-->
            <div class="form-body">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Nome(nome fantasia)</label>
                            <input type="text" class="form-control" id="i-nome" name="nome"
                            placeholder="por ser um pedaço do nome" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="cnpj">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cnpj" id="i-cnpj">
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button class="btn green pull-right" id='btn-novofornecedor' onClick="novoFornecedor()">Novo Fornecedor</button>
                        <button class="btn blue pull-right" id='btn-search-form'>Pesquisar</button>
                    </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th>Razão Social</th>
                        <th>Nome Fantasia</th>
                        <th>CNPJ</th>
                        <th width="100">Contato 1</th>
                        <th width="200">Contato 2</th>
                        <th width="100" class="text-right">Ações</th>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>

@include('layout.modalfornecedor');


@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();

        if( $("#IMB_EEP_ID").val()  == '' )
        {
            $("#IMB_EEP_CGC").change( function()
            {
                verificarCnpjCadastrado( $("#IMB_EEP_CGC").val() );
            })
        }



    });

    var table = $('#resultTable').DataTable({
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
    "oPaginate": {
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
            serverSide: true,
            ajax: {
                url:"{{ route('fornecedores.list') }}",
                data: function (d) {
                    d.fone = $('input[name=fone]').val();
                    d.nome = $('input[name=nome]').val();
                    d.cnpj = $('input[name=cnpj]').val();
                }
            },
            columns: [
                {data: 'IMB_EEP_RAZAOSOCIAL' },
                {data: 'IMB_EEP_NOMEFANTASIA' },
                {data: 'IMB_EEP_CGC' },
                {data: 'IMB_EEP_CONTATO1'},
                {data: 'IMB_EEP_CONTATO2'},

            ],

            "columnDefs": [
                {
                    "targets": 5,
                    "data": null,
                    "defaultContent": "<div style='text-align:center'>"+
                        "<button class='btn btn-danger glyphicon glyphicon-trash pull-right btn-inafor'></button>"+
                        "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-clt'></button>",
                },
           ],
            searching: false
        });

        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.alt-clt', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            alterarFornecedor( data.IMB_EEP_ID );
        });

        $('#resultTable tbody').on( 'click', '.btn-inafor', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            desativar( data.IMB_EEP_ID );
        });


        function limparCampos()
        {
            $("#i-id-cliente").val('');
            $("#i-nome").val('');
            $("#i-cnpj").val('');
        }

        function verificarCnpjCadastrado( id )
        {
            var url = "{{ route('fornecedores.cnpj') }}/"+id;
            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    async:false,
                    success:function( data )
                    {
                        alert( 'Já há cadastro com este documento '+data.IMB_EEP_RAZAOSOCIAL );
                    }
                }
            )
        }

        function desativarFornecedor(id)
        {

        }



    </script>
@endpush
