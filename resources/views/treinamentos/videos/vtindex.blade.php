@extends('layout.app')
@section('scriptop')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
@section('scripttop')
<style>
.gi-2x{font-size: 2em;}
.gi-3x{font-size: 3em;}
.gi-4x{font-size: 4em;}
.gi-5x{font-size: 5em;}

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
            <span class="caption-subject bold uppercase"> Pesquisar Videos de Treinamento</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        <form action="{{route( 'cliente.add' )}}" method="get" target="_blank">
            <button type="submit" class="btn green pull-right" type="button" id="i-btn-novo">Novo Video</button>
        </form>         

    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
        <!--<form acion="/cliente/list" method="get">-->
            <div class="form-body">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label" for="cnpj">Sua dúvida é sobre qual assunto</label>
                            <input type="text" class="form-control" name="tags" id="i-tag" placeholder="Digite uma palavra que represente sua dúvida">
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='btn-search-form'>Pesquisar</button>
                    </div>
            </div>

        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th width="90%">Titulo</th>
                        <th width="10%">Assistir</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function() 
    {
        $("#sirius-menu").click();

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
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: 
            {
                url:"{{ route('videostreinamentos.list') }}",
                data: function (d) 
                {
                    d.tags = $('input[name=tags]').val();
                }
            },
            columns: 
            [
                {data: 'IMB_VDT_TITULO' },
                {data: 'IMB_VDT_ID', render:assistir},

            ],

            "columnDefs": 
            [ 
                {
                "targets": 0,
                "orderable": false
                },


            ],
            searching: false
        });
        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });


    });


    function  assistir(data, type, full, meta) 
    {
        return '<div><a href="https://www.siriussystem.com.br/videos/treinamento/'+full.IMB_VDT_ARQUIVO+'"><i class="fas fa-eye fa-2x" style="color:green">'+
        '</i></a></div>';
    }




    </script>
@endpush
