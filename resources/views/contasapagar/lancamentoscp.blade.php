@extends('layout.app')
@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
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

.inativado
{
    color: gray;
}

.escondido
{
    display:none;
}
.div-center {
    text-align: center;
  }

  .div-right {
    text-align: right;
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
.font-blue
{
    color:blue;
}

.font-red-bold
{
    background-color: white;
    color:red;
    font-weight: bold;

}

.font-red-jabaixado
{
    color: red;
    font-weight: bold;
    font-size:14;

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
            <span class="caption-subject bold uppercase"> Contas a Pagar</span>
            <i class="fa fa-search font-blue"></i>
            <span id="i-totalizar"></span>
        </div>
        <div>
            <button class="btn btn-warning pull-right" type="button"
            onClick="totalizar()">Totalizar</button>
            <button class="btn btn-primary pull-right" type="button" id="i-btn-novo-lancamentocp"
            onClick="novoLancamentoCP()">Novo Lançamento</button>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
            <button class="btn btn-success pull-right" type="button" id="btn-fornecedor"
            onClick="fornecedorCP()">Fornecedores</button>

        </div>

    </div>
    <div class="portlet-body form">
        <form role="form" id="search-form">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label class="label-control empresa" for="IMB_IMB_IDCPINDEX">Empresa</label>
                    <select class="select2" id="IMB_IMB_IDCPINDEX">
                    </select>
                   
                </div>
                <div class="col-md-2">
                    <label class="label-control" for="IMB_EEP_ID">Fornecedor</label>
                    <select class="select2" id="IMB_EEP_ID">
                    </select>
                   
                </div>
                <div class="col-md-2">
                    <label class="label-control" for="i-data-inicio">Data Inicial
                    <input class="form-control" type="date" id="i-data-inicio" name="i-data-inicio">
                    </label>
                </div>
                <div class="col-md-2">
                    <label class="label-control" for="i-data-fim">Data Final
                        <input class="form-control" type="date" id="i-data-fim" name="i-data-fim">
                    </label>
                </div>
                <div class="col-md-1 div-center">
                    <input type="checkbox" class="form-control" id="i-quitados" name="quitados">Exibir Quitados
                </div>
                <div class="col-md-1 div-center">
                    <input type="checkbox" class="form-control" id="i-cancelados" name="cancelados">Exibir Cancelados
                </div>
                <div class="col-md-2 div-center">
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='btn-search-form'>Pesquisar / Atualizar Tela</button>
                    </div>
                </div>

            </div>
        </form>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTableCP">
                    <thead>
                        <th>Empresa</th>
                        <th>Vencimento</th>
                        <th>Fornecedor</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                        <th>Data Pagto</th>
                        <th>Valor Pago</th>
                        <th>Desativado em</th>
                        <th width="150" class="text-right">Ações</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layout.modalcpbaixa')
@include('layout.modalcplancamento')

@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();
        $(".select2").select2(
            {
                placeholder: 'Selecione ',
                width: null
        });

        cargaFornecedores();
        preencherUnidadesCpLan()
        preencherUnidadesModalCpLan()
    
        $('.valor').inputmask('decimal',
        {
          radixPoint:",",
          groupSeparator: ".",
          autoGroup: true,
          digits: 2,
          digitsOptional: false,
          placeholder: '0',
          rightAlign: false,
          onBeforeMask: function (value, opts)
          {
            return value;
          }
        });

        $( "#i-data-inicio").val( moment().format('YYYY-MM-DD'));
        $( "#i-data-fim").val( moment().format('YYYY-MM-DD'));





    });

    url = "{{ route('contaspagar.list') }}";
    console.log( url );
    var table = $('#resultTableCP').DataTable(
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
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax:
        {
            url: url,
            data: function (d) {
                d.IMB_EEP_ID = $("#IMB_EEP_ID").val();
                d.IMB_IMB_ID2 = $("#IMB_IMB_IDCPINDEX").val();
                d.datainicio = $('input[name=i-data-inicio]').val();
                d.datafim = $('input[name=i-data-fim]').val();
                d.quitados = $("#i-quitados").prop('checked') ? 'S' : 'N';
                d.cancelados = $("#i-cancelados").prop('checked') ? 'S' : 'N';


            }
        },
        "drawCallback":function()
        {
            //alert("La tabla se está recargando"); 
            var api = this.api();
            valordocumento = api.column(3, {page:'current'}).data().sum();
            valordocumento = valordocumento.toFixed(2);
            valordocumento = soFormatarValor( valordocumento );

            valorpago = api.column(6, {page:'current'}).data().sum();
            valorpago = valorpago.toFixed(2);
            valorpago = Math.abs(valorpago);
            valorpago = soFormatarValor( valorpago );

            $(api.column(3).footer()).html('<div class="div-right">'+dolarToReal(valordocumento)+'</div>'),
            $(api.column(6).footer()).html('<div class="div-right">'+dolarToReal(valorpago)+'</div>')
        },                 
        columns: [

            {data: 'IMB_IMB_NOME',  },
            {data: 'FIN_APD_DATAVENCIMENTO', render:formatarData  },
            {data: 'IMB_EEP_RAZAOSOCIAL', render:outrosCampos },
            {data: 'FIN_APD_VALORVENCIMENTO', render:formatarValor },
            {data: 'FIN_APD_OBSERVACAO'},
            {data: 'FIN_APD_DATAPAGAMENTO', render:formatarData },
            {data: 'FIN_APD_VALORPAGO', render:formatarValor},
            {data: 'FIN_APD_DTHINATIVADO', render:formatarData},
        ],

        "columnDefs": [
            {
                "targets": 8,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                    "<button title='Inativar' class='btn btn-danger glyphicon glyphicon-trash pull-right btn-inacp'></button>"+
                    "<button title='Alterar informações' class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-clt'></button>"+
                    "<button title='Baixar o Documento' class='btn btn-success	glyphicon glyphicon-ok pull-right alt-pay'></button>",

            },
       ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        totalizar();
        e.preventDefault();
    });

    $('#resultTableCP tbody').on( 'click', '.alt-clt', function ()
    {
        var data = table.row( $(this).parents('tr') ).data();
        alterarDocCP( data.FIN_APD_ID );
    });

    $('#resultTableCP tbody').on( 'click', '.btn-inacp', function ()
    {
        var data = table.row( $(this).parents('tr') ).data();
        desativarCP( data.FIN_APD_ID );
    });

    $('#resultTableCP tbody').on( 'click', '.alt-pay', function ()
    {
        var data = table.row( $(this).parents('tr') ).data();
        baixarCP( data.FIN_APD_ID );
    });



    function cargaFornecedores()
    {

        var url = "{{ route('fornecedores.list') }}";

        dados = { origem : 'carga'};

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            success:function(data)
            {
                $("#IMB_EEP_ID").empty();
                linha ='<option value="">Selecione o Fornecedor</option>';
                $("#IMB_EEP_ID").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_EEP_ID+'">'+
                    data[nI].IMB_EEP_RAZAOSOCIAL+'('+data[nI].IMB_EEP_NOMEFANTASIA+')'+
                        "</option>";
                    $("#IMB_EEP_ID").append( linha );
                }
            }
        });
    }


    function novoLancamentoCP()
    {
        $(".div-parcelamento").show();
        $("#sirius-menu").click();
        $(".select2").select2({
            placeholder: 'Selecione ',
            width: null
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
                {data: 'IMB_EEP_RAZAOSOCIAL'},
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

        cargaFornecedoresModalCpLan();
        preencherUnidadesCpLan();
        cargaTipoDocumento();
        cargaCfcLanCp();
        cargaSubContaLanCp();
        limparCampos();

        $("#FIN_APD_DATADOCUMENTO-LAN").val( moment().format('YYYY-MM-DD') );

        $("#modalcplancamento").modal('show');

    }

    function formatarData( data, type, full, meta)
    {
        var classe="";
        var datapagamento = full.FIN_APD_DATAPAGAMENTO;

        if( datapagamento != null )
            var classe="font-blue";

        var valor =moment(data).format('DD/MM/YYYY');

        if ( valor == 'Invalid date')
            valor = '-';

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
            classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">'+valor+'</div>';

    }

    function soFormatarValor( valor )
    {
        return formatarBRSemSimbolo(valor);

    }
    function formatarValor( data, type, full, meta)
    {
        var classe="";
        if( full.FIN_APD_DATAPAGAMENTO != null )
            var classe="font-blue";

        if( data !='' && data != null )
        {
            var valor = parseFloat( data );
            return '<div class="div-right '+classe+'">'+formatarBRSemSimbolo(valor)+'</div>';
        };

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
           classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">-</div>';

    }

    function outrosCampos( data, type, full, meta)
    {
        var classe="";
        if( full.FIN_APD_DATAPAGAMENTO != null )
            classe="font-blue";

        var str = full.FIN_APD_DATAVENCIMENTO;
        var date = new Date(str);
        var novaData = new Date();
        if(date < novaData && full.FIN_APD_DATAPAGAMENTO === null )
            classe="font-red-bold";

        if( full.FIN_APD_DTHINATIVADO != null )
            classe="inativado";

        return '<div class="div-center '+classe+'">'+data+'</div>';

    }

    function totalizar()
    {
        var url = "{{ route('contaspagar.totalizar') }}";

        var dados =
        {
            IMB_EEP_ID : $('input[name=IMB_EEP_ID]').val(),
            datainicio : $('input[name=i-data-inicio]').val(),
            datafim : $('input[name=i-data-fim]').val(),
            quitados : $("#i-quitados").prop('checked') ? 'S' : 'N',
            cancelados : $("#i-cancelados").prop('checked') ? 'S' : 'N'
        }

        $.ajax(
            {
                url : url,
                data:dados,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    var quitado = parseFloat(data.quitado);
                    var aberto = parseFloat(data.aberto);

                    $("#i-totalizar").html( 'Total em Aberto: <b>'+formatarBRSemSimbolo( aberto )+
                        '</b> - Total Quitado: <b>'+formatarBRSemSimbolo( quitado )+'</b>');
                }

            }
        )
    }

    function fornecedorCP()
    {
        window.open("{{ route('fornecedores.index')}}", '_blank');
    }

    function desativarCP( id )
    {
        if (confirm("Confirmar a Inativação Deste Registro?") == true)
        {
            var url = "{{ route('contaspagar.desativar')}}/"+id;

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
                    success:function(data)
                    {
                        alert('Registro Inativado!');
                        $( "#search-form" ).submit();
                    }
                }
            )

        }

    }

    function alterarDocCP( id )
    {


        cargaFornecedoresModalCpLan();
        preencherUnidadesCpLan();
        cargaTipoDocumento();
        cargaCfcLanCp();
        cargaSubContaLanCp();

        $("#FIN_APD_ID-LAN").val( id );

        var url = "{{ route('contaspagar.buscar') }}/"+id;
        console.log( url );

                
        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            async:false,
            success:function(data )
            {

                var idforn = data.FIN_EEP_ID;
                var cfc = data.FIN_CFC_ID;
                var sub = data.FIN_SBC_ID;
                var nomeempre = data.FIN_EEP_RAZAOSOCIAL;
                console.log('id: '+idforn+' - razao social: '+nomeempre);
                console.log('******************************');
                console.log(data);
                $("#FIN_EEP_ID_LANCP").val(idforn ).change();
                $("#FIN_APD_ID-LAN").val(data.FIN_APD_ID);
                $("#FIN_TPD_ID-LAN").val(data.FIN_TPD_ID);
                $("#FIN_APD_DATADOCUMENTO-LAN").val( moment(data.FIN_APD_DATAVENCIMENTO).format('YYYY-MM-DD') );
                $("#FIN_APD_NUMERODOCUMENTO-LAN").val( data.FIN_APD_NUMERODOCUMENTO);
                $("#FIN_APD_DATAVENCIMENTO-LAN").val(data.FIN_APD_DATAVENCIMENTO);
                $("#FIN_APD_VALORVENCIMENTO-LAN").val( dolarToReal(data.FIN_APD_VALORVENCIMENTO));
                $("#FIN_APD_VALORDESCONTO-LAN").val(dolarToReal(data.FIN_APD_VALORDESCONTO));
                $("#FIN_APD_PARCELAS").val(1);
                $("#i-primeiro-vencimento-LAN").val(data.FIN_APD_DATAVENCIMENTO);
                $("#FIN_APD_OBSERVACAO-LAN").val(data.FIN_APD_OBSERVACAO);
                $("#FIN_CFC_ID-LAN").val(cfc ).change();
                $("#FIN_SBC_ID-LAN").val(sub ).change();

                $(".div-parcelamento").hide();
                $("#modalcplancamento").modal('show');
            }
        })




    }

    function limparCampos()
    {

        $("#tblparcelaslancp>tbody").empty();
        $("#FIN_EEP_ID_LANCP").val('');
        $("#FIN_APD_ID-LAN").val('');
        $("#FIN_TPD_ID-LAN").val('');
        $("#IMB_IMB_IDCPINDEX").val('');
        $("#FIN_APD_DATADOCUMENTO-LAN").val( moment().format('YYYY-MM-DD') );
        $("#FIN_APD_NUMERODOCUMENTO-LAN").val('');
        $("#FIN_APD_DATAVENCIMENTO-LAN").val('');
        $("#FIN_APD_VALORVENCIMENTO-LAN").val('');
        $("#FIN_APD_VALORDESCONTO-LAN").val('');
        $("#FIN_APD_PARCELAS").val(1);
        $("#i-primeiro-vencimento-LAN").val('');
        $("#FIN_APD_OBSERVACAO-LAN").val('');
        $("#FIN_CFC_ID-LAN").val('');
        $("#FIN_SBC_ID-LAN").val('');
    }


    function preencherUnidadesCpLan()
    {
        debugger;
        var url = "{{ route('imobiliaria.carga')}}/"+"{{Auth::user()->IMB_IMB_ID}}";
        $("#IMB_IMB_IDCPINDEX").empty();
        linha = '<option value="">Selecione a empresa</option>"';
        $("#IMB_IMB_IDCPINDEX").append( linha );        
        $.getJSON( url, function( data )
        {
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_IMB_ID+'">'+
                    data[nI].IMB_IMB_NOME+"</option>";
                    $("#IMB_IMB_IDCPINDEX").append( linha );

            }
        
        });

    }

    


</script>
@endpush
