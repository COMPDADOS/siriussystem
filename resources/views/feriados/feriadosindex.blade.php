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
</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Feriados</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <button class="btn green pull-right " id="btnnovo" type="button" onClick="novoRegistro()">Novo Feriado</button>


    </div>
    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th class="td-center" style="width: 10%">Dia</th>
                        <th class="td-center" style="width: 10%">Mês</th>
                        <th class="td-center" style="width: 10%">Ano</th>
                        <th class="td-center" style="width: 30%">Motivo</th>
                        <th class="td-center" style="width: 20%">Todos os Anos</th>
                        <th class="td-center" width="10%">Ações</th>                        

                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal"  role="dialog" id="modalnovoferiado">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Feriado
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
          
                    <input type="hidden" id="GER_FRD_ID">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-1">
                                    <label class="control-label" for="GER_FRD_DIA"> Dia</label>
                                    <input type="number" class="form-control" max="31" min="1" id="GER_FRD_DIA">                        
                                    
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label" for="GER_FRD_MES"> Mês</label>
                                    <input type="number" class="form-control valor"  id="GER_FRD_MES"
                                    max="12" min="1">                        
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label" for="GER_FRD_ANO"> Ano</label>
                                    <input type="number" class="form-control"  id="GER_FRD_ANO" 
                                    max="2063" min="2023">                        
                                    
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label" for="GER_FRD_TODOSANOS"> Todos Anos</label>
                                    <input type="checkbox" class="form-control"  id="GER_FRD_TODOSANOS" >                        
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="com-md-12">
                                    <label class="control-label" for="GER_FRD_MOTIVO"> Observação</label>
                                    <input type="text" class="form-control" id="GER_FRD_MOTIVO">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
      
            <div class="modal-footer">
                <div class="form-actions right">
                                <button type="cancel" class="btn red"data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn blue " id="i-btn-gravar" onClick="gravarRegistro()">
                                    <i class="fa fa-check"></i> Gravar
                                </button>
                            </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>



    $(document).ready(function() 
    {

        $("#sirius-menu").click();


    });

    
    var table = $('#resultTable').DataTable(
    {
        "pageLength": 20,
        "bLengthChange": false,
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
        responsive: false,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url:"{{ route('feriados.carga') }}",
            data: function (d) 
            {
            }

        },
        columns: 
        [
            
            {data: 'GER_FRD_DIA'},
            {data: 'GER_FRD_MES'},
            {data: 'GER_FRD_ANO'},
            {data: 'GER_FRD_MOTIVO'},
            {data: 'GER_FRD_TODOSANOS', render:todosAnos},
        ],


        "columnDefs": 
        [ 
            {
                "targets": 5,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-lcx'></button>"+
                "<button title='Inativar Registro' class='btn btn-danger glyphicon glyphicon-trash pull-right del-lcx'></button>",                
            },
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        
    $('#resultTable tbody').on( 'click', '.alt-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            alterar( data.GER_FRD_ID);
            table.draw();
        });


        $('#resultTable tbody').on( 'click', '.del-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            excluir( data.GER_FRD_ID );
        });


         
    
    function gravarRegistro()
    {

      
        
      
        url = "{{route('feriados.gravar')}}";

        dados = 
        {
            GER_FRD_ID : $("#GER_FRD_ID").val(),
            GER_FRD_DIA : $("#GER_FRD_DIA").val(),
            GER_FRD_MES : $("#GER_FRD_MES").val(),
            GER_FRD_ANO : $("#GER_FRD_ANO").val(),
            GER_FRD_TODOSANOS : $( '#GER_FRD_TODOSANOS' ).prop( "checked" )   ? 'S' : 'N',
            GER_FRD_MOTIVO : $("#GER_FRD_MOTIVO").val(),
        }

        $.ajaxSetup({
        headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
            {
                url     : url,
                dataType: 'json',
                type    : 'post',
                data:dados,
                async:false,
                success: function( data )
                {
                    alert("Registro gravado!");
                    redrawTable();
                    $("#modalnovoferiado").modal( 'hide');

                },
                error:function()
                {
                    alert('erro na gravacao do Registro');
                }
            }
        )


    }

    function excluir( id )
    {

        if (  confirm( 'Confirma a Exclusão?') == true )
        {
            var url = "{{route('feriados.excluir')}}/"+id;
            $.ajaxSetup({
            headers:    
                {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'post',
                    async:false,
                    success:function()
                    {
                        alert('Excluído!');
                        $("#modalnovoferiado").modal( 'hide');
                        redrawTable();

                    }
                }
            )
        }

    }
    
    function alterar( id )
    {

        var urlseg = "{{route('feriados.edit')}}/"+id;

        $.getJSON( urlseg, function(data)
        {       

            $("#GER_FRD_ID").val(data.GER_FRD_ID),
            $("#GER_FRD_DIA").val(data.GER_FRD_DIA),
            $("#GER_FRD_MES").val(data.GER_FRD_MES),
            $("#GER_FRD_ANO").val(data.GER_FRD_ANO),
            $( "#GER_FRD_TODOSANOS" ).prop( "checked", (data.GER_FRD_TODOSANOS =='S') ),
            $("#GER_FRD_MOTIVO").val(data.GER_FRD_MOTIVO)

        });

        $("#modalnovoferiado").modal( 'show');

    }

    function limparCampos()
    {

   
    }

    function novoRegistro()
    {
        $("#GER_FRD_ID").val(''),
            $("#GER_FRD_DIA").val(moment().format('DD')),
            $("#GER_FRD_MES").val(moment().format('MM')),
            $("#GER_FRD_ANO").val( moment().format('YYYY')),
            $( "#GER_FRD_TODOSANOS" ).prop( "checked",false ),
            $("#GER_FRD_MOTIVO").val('')

        $("#modalnovoferiado").modal( 'show');


    }

    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }

    function todosAnos( data )
    {
        var texto='<div></div>';
        if( data == 'S') 
            texto = '<div><i class="fa fa-check" aria-hidden="true"></i><div>';

        return texto;
    }
    
    
</script>
@endpush


