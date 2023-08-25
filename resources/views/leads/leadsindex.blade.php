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
        font-size: 12px;
    }
</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Leads</span>
            <i class="fa fa-search font-blue"></i>
        </div>


    </div>
    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th class="td-center" >Data</th>
                        <th class="td-center" >Referência</th>
                        <th class="td-center" >Endereço</th>
                        <th class="td-center" ></th>
                        <th class="td-center" >Nome</th>
                        <th class="td-center" >Telefone</th>
                        <th class="td-center" >Email</th>
                        <th class="td-center" width="10%">Ações</th>                        
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaltransferirlead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog "style="width:60%;" >
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Direcionar Lead
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12 div-center">
                            <h5 id="novocliente">** Atenção. Este Telefone Já está Cadastrado na Imobiliária</h5>
                            </div>

                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <select class="form-control" id="i-direcionar">
                                    <option value="">Selecione</option>
                                    <option value="1">Direcionar para um Atendimento</option>
                                    <option value="2">Abrir um chamado</option>
                                </select>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-2">
                                <button class="form-control btn btn-primary" onClick="confirmarDirecionamentoLead()">Confirmar</button>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control btn btn-danger" data-dismiss="modal">Voltar</button>
                            </div>
                        </div>
                    </div>
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
        "language": 
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            'scrollX': true,
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
            url:"{{ route('leads.carga') }}",
            data: function (d) 
            {
            }

        },
        columns: 
        [
            {data: 'IMB_LED_DATAHORA', render:formatarData},
            {data: 'IMB_IMV_REFERE'},
            {data: 'endereco'},
            {data: 'EHCLIENTE', render:verificarCliente},
            {data: 'IMB_LED_NOME'},
            {data: 'IMB_LED_TELEFONE'},
            {data: 'IMB_LED_EMAIL'},
            {data: 'IMB_LED_ID', render:pegarId }
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


    
function formatarData( data )
{
    var d = moment( data ).format('YYYY');

    if( data === null || d < 2020  )
        return '<div>-</div>'
    else
        return '<div>'+moment(data).format( 'DD/MM/YYYY')+'</div>';
}

function pegarId(data, type, full, meta)
{
    return "<div>"+
    "<a title='Criar um atendimento ou um chamado' href='javascript:direcionarAtm("+full.IMB_LED_ID+','+full.EHCLIENTE+")' <b><strong><i class='fas fa-headset'></i></strong></b></a>"+
    "<a title='Não aparecer mais este lead como notificacao' href='javascript:leadCiente("+full.IMB_LED_ID+")' <b><strong><i class='fa fa-bell-slash-o'></i></strong></b></a>"+
    "</div>";
}


function direcionarAtm( id, cliente)
{


    var url = "{{route('cliente.corretores')}}/"+id;

    $("#novocliente").hide();
    if( cliente != null )
        $("#novocliente").show();
    $("#IMB_LED_ID").val( id );
    $("#modaltransferirlead").modal('show');
}

function confirmarDirecionamentoLead()
{
    if( $("#i-direcionar").val() == '' ) 
    {
        alert('Selecione o que deseja fazer com este lead!');
        return false;
    }

}
         
function leadCiente( id )
{

        var url = "{{route('atendimento.leadsciente')}}";

        var dados = { IMB_LED_ID : id}
        $.ajaxSetup(
            {
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
                data:dados,
                success:function(data)
                {
                    $("#linha"+data).hide();

                },
                error:function()
                {
                    alert('Erro ao dar ciência do atendimento');
                }
            }
        )


    
}

function  verificarCliente( data )
{
    var cliente=data;
    if( cliente === null ) 
        data = '-'
    else
        data = 'Já Cliente';
    return '<div>'+data+'</div>';
}



    
    
    
</script>
@endpush


