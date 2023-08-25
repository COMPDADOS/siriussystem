@extends("layout.app")
@section('scripttop')
<style>

    .escondido
    {
        display: none;
    }

    .footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 40px;
  background:#a3c2c2;
}

.riscado {
   -webkit-text-decoration-line: line-through; /* Safari */
   text-decoration-line: line-through;
}
.div-center {
    text-align: center;
  }

.atrasado
{
    color:red;

}


.titulo
{
    background-color:#004d80;
    color:white;
}

.background-soft-blue
{
    background-color:#e6f5ff;
}



</style>
@endsection

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Controle de Chaves</span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="" class="btn btn-secondary"><i class="fa fa-print font-blue" style="font-size:20px"> Clientes c/ Chaves</i></a>
                <a href="" class="btn btn-secondary"><i class="fa fa-print font-blue" style="font-size:20px"> Clientes c/ Reserva</i></a>
                <a href="" class="btn btn-secondary"><i class="fa fa-print font-blue" style="font-size:20px"> Clientes Alta Espectativa</i></a>
                <a href="" class="btn btn-secondary"><i class="fa fa-print font-blue" style="font-size:20px"> Clientes Aguardando Retono</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 titulo div-center">Filtros</div>
            <div class="col-md-12 background-soft-blue">
                <div class="col-md-2">
                    <label class="control-label">Referência</label>
                    <input class="form-control" type="text" id="IMB_IMV_REFERE" name="IMB_IMV_REFERE">
                </div>
                <div class="col-md-3">
                    <label class="control-label">Cliente</label>
                    <input class="form-control" type="text" id="IMB_CLT_ID" name="IMB_CLT_ID">
                </div>
                <div class="col-md-3">
                    <label class="control-label">Corretor</label>
                    <select class="form-control" id="i-select-corretor" ></select>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tab-emvisita" id="h-emvisita"><span>Imóveis em Visita</span></a></li>
                            <li><a href="#tab-todas" id="h-todas"><span>Todas as Visitas</span></a></li>
                        </ul>
                        <div id="tab-emvisita">
                            <div class="row">
                                <table  class="table table-striped table-hover" id="tblimoveisabertos" >
                                    <thead>
                                        <tr>
                                        <td></td>
                                        <td></td>
                                            <td width="10%">Data Saida</td>
                                            <td width="10%">Previsão Retorno</td>
                                            <td width="10%">Referência</td>
                                            <td width="30%">Endereco</td>
                                            <td width="20%">Corretor</td>
                                            <td width="20%">Cliente</td>

                                        </tr>

                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">

                                        <button class="form-control btn btn-danger">Cancelar Seleções</button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{route('saidachaves.retorno')}}">
                                        <button class="form-control btn btn-success">Retorno de Chaves </button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="tab-todas">
                            <div class="row">
                                <table  class="table table-striped table-hover" id="tblimoveisatodos" >
                                    <thead>
                                        <tr>
                                            <td width="10%">Data Saida</td>
                                            <td width="10%">Previsão Retorno</td>
                                            <td width="10%">Data Retorno</td>
                                            <td width="10%">Referência</td>
                                            <td width="30%">Endereco</td>
                                            <td width="20%">Corretor</td>
                                            <td width="20%">Cliente</td>

                                        </tr>

                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>




@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>


$(document).ready(function()
{
    $( "#tabs" ).tabs();

    $('[data-toggle="tooltip"]').tooltip();

    $("#sirius-menu").click();
    preencherCorretores();
    cargaImoveisAberto();

    $("#h-emvisita").click( function()
    {
        cargaImoveisAberto();

    });
    $("#h-todas").click( function()
    {
        cargaTodos();

    });



});



function cargaImoveisAberto()
{
    $("#tblimoveisabertos").DataTable().destroy()
    var table = $('#tblimoveisabertos').DataTable(
        {
            "pageLength": 10,
            "lengthChange": true,
            "language":
            {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                "sZeroRecords": "Nenhum registro encontrado",
                "scrollY": "300px",
                "oPaginate":
                {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                }
            },
            bSort : true ,
            processing: true,
            serverSide: true,
            ajax:
            {
                url:"{{ route('saidachaves.emvisitacao') }}",
                data: function (d)
                {
                    d.id_completus  = '';
                }
            },
            columns:
                [
                    {data: 'IMB_CCH_ID' ,render:branco },
                    {data: 'IMB_CCH_ID' ,render:botaoSelecao },
                    {data: 'IMB_CCH_DTHSAIDA', render: getDataSaida  },
                    {data: 'IMB_CCH_DTHDEVOLUCAOESPERADA', render: getDataPrevista  },
                    {data: 'IMB_IMV_REFERE' },
                    {data: 'ENDERECO'},
                    {data: 'IMB_ATD_NOMESOLICITANTE'},
                    {data: 'IMB_CLT_NOME'},
                ],
            searching: false
        }
    );


}
function cargaTodos()
{



      $("#tblimoveisatodos").DataTable().destroy();
      var table = $('#tblimoveisatodos').DataTable(
        {
            "pageLength": 50,
            "lengthChange": true,
            "language":
            {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                "sZeroRecords": "Nenhum registro encontrado",
                "scrollY": "300px",
                "oPaginate":
                {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                }
            },
            bSort : true ,
            processing: true,
            serverSide: true,
            ajax:
            {
                url:"{{ route('saidachaves.listar') }}",
                data: function (d)
                {
                    d.id_completus  = '';
                }
            },
            columns:
                [
                    {data: 'IMB_CCH_DTHSAIDA', render: getDataSaida  },
                    {data: 'IMB_CCH_DTHDEVOLUCAOESPERADA', render: getDataPrevista  },
                    {data: 'IMB_CCH_DTHDEVOLUCAOEFETIVA', render: getDataEfetiva  },
                    {data: 'IMB_IMV_REFERE' },
                    {data: 'ENDERECO'},
                    {data: 'IMB_ATD_NOMESOLICITANTE'},
                    {data: 'IMB_CLT_NOME'},
                ],
            searching: false

        }
    );

    table.clear();
    table.draw();

}

function getDataSaida(data, type, full, meta)
{
    return moment( full.IMB_CCH_DTHSAIDA).format('DD/MM/YYYY HH:mm');
}

function getDataPrevista(data, type, full, meta)
{
    return moment( full.IMB_CCH_DTHDEVOLUCAOESPERADA).format('DD/MM/YYYY HH:mm');

}
function getDataEfetiva(data, type, full, meta)
{
    var dataretorno = moment( full.IMB_CCH_DTHDEVOLUCAOEFETIVA).format('DD/MM/YYYY HH:mm');
    if( dataretorno == 'Invalid date')
        return ''
    else
        return dataretorno;

}
function branco(data, type, full, meta)
{
//        alert( full.IMB_CCH_SELECIONADO );
    //var texto = '<div title="ddddd">'
    if( full.IMB_CCH_SELECIONADO == 'S')
        return '<div title="Selecionado por '+full.IMB_ATD_NOMESELECIONADO+'"><i class="fa fa-check" aria-hidden="true"></i></div>'
    else
        return '';

}
function botaoSelecao(data, type, full, meta)
{
    return '<button title="Selecionar Registro" class="btn green" onClick="selecionar('+full.IMB_CCH_ID+')" imb_title="selecionar"><i class="fa fa-check" aria-hidden="true"></i></button>';
}

function selecionar( id )
{
    var url = "{{route('saidachaves.selecionar')}}";
    var dados = { id : id };

    $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });



    $.ajax(
    {
        url : url,
        dataType: 'json',
        type:'post',
        data:dados,
        success:function( data )
        {
            cargaImoveisAberto();


        },
        error:function( data )
        {
            alert( "Registro não pode ser tirado da seleção! Outro corretor que selecionou!" );
        }


    });



}
function preencherCorretores()
{
    var url = "{{ route('atendente.carga')}}/{{Auth::user()->IMB_ATD_ID}}";

    $.getJSON( url, function( data )
    {
        $("#i-select-corretor").empty();
        linha = '<option value="">Escolha o Corretor</option>';
        $("#i-select-corretor").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
            linha =
                '<option value="'+data[nI].IMB_ATD_ID+'">'+
                    data[nI].IMB_ATD_NOME+"</option>";
            $("#i-select-corretor").append( linha );
        }
    });

}
</script>

@endpush
