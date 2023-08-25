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

}

input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    /*border: 1px solid #555;*/
    outline: none;
}


input[type=text]:focus {
    background-color: lightblue;
    color:black;
}
.row-top-margin-normal {
    margin-bottom:-1px;
    margin-top:-1px;
}

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

.row-top-margin {
    background-color:antiquewhite;
    margin-bottom:-1px;
    margin-top:-1px;
}

.Receita
{
    color:blue;
}

.orange
{
    color:orange;
}

.bold
{
    font-weight: bold;
}

.Despesa
{
    color:red;
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

.bg-direcionado
{
    background-color:beige;
}

.bg-white
{
    background-color: white;
}

.font-red-bold
{
    color: red;
    font-weight: bold;

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

.font-padrao
{
    font-size:12px;
}
.font-8
{
    font-size:8px;
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
            <span class="caption-subject bold uppercase"> Chamados</span>
            <i class="fa fa-search font-blue"></i>
            <span id="i-totalizar"></span>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
            <button class="btn btn-success pull-right" type="button" id="btn-DRE"
            onClick="incluirSolicitacao()">Novo Chamado</button>
        </div>

    </div>
    <div class="portlet-body form">
        <form role="form" id="search-form">
            <div class="col-md-12">
                <div class="col-md-1 row-top-margin-normal">
                    <label class="label-control">ID</label>
                    <input class="form-control" type="text" id="IMB_SOL_ID" name="IMB_SOL_ID">
                </div>
                <div class="col-md-2 row-top-margin-normal">
                    <label class="label-control" for="i-data-inicio">Data Inicial
                    <input class="form-control" type="date" id="i-data-inicio" name="i-data-inicio-CONS">
                    </label>
                </div>
                <div class="col-md-2 row-top-margin-normal">
                    <label class="label-control" for="i-data-fim">Data Final
                        <input class="form-control" type="date" id="i-data-fim" name="i-data-fim-CONS">
                    </label>
                </div>
                <div class="col-md-2 div-center row-top-margin-normal">
                    <label class="control-label">Prioridade
                    <select class="form-control" id="IMB_SOL_PRIORIDADE">
                        <option value="">Selecione</option>
                        <option value="B">Baixa</option>
                        <option value="M">Média</option>
                        <option value="A">Alta</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>
                    <input  type="checkbox" name="i-solicitacoes-abertas" id="i-solicitacoes-abertas" checked>Somente Abertas</label>
                    <label>
                        <input  type="checkbox" name="i-solicitacoes-encerradas">Somente Encerradas</label>
                    <label>
                        <input  type="checkbox" name="i-solicitacoes-atrasadas">Somente Em atraso</label>
                </div>
                <div class="col-md-2 div-center">
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='btn-search-form'>Pesquisar</button>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="col-md-1">

                </div>
                <div class="col-md-3">
                    <label class="control-label">Colaborador que Cadastro</label>
                    <select class="form-control" id="COLABORADORORIGEM" name="COLABORADORORIGEM"></select>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Colaborador Responsável</label>
                    <select class="form-control" id="COLABORADORRESPONSAVEL" name="COLABORADORRESPONSAVEL"></select>
                </div>
            </div>
        </form>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTablesol">
                    <thead>
                        <th></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@include('layout.modalsolicitacao');
@include('layout.pesquisarclientes');

@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();
        $(".select2").select2(
            {
                placeholder: 'Selecione ',
                width: null
        });

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
        cargaTipoSolicitacao();
        usuarioDestinoSol();

    });


    var table = $('#resultTablesol').DataTable(
    {
        dom: 'Blfrtip',
        "paging":   false,
        "ordering": false,
        "info":     false,
        buttons: [
            'excel',
            'print'
        ],
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
        processing: true,
        serverSide: true,
        pagingType: "full_numbers",

        ajax:
        {
            url:"{{ route('solicitacoes.list') }}",
            data: function (d) {
                d.IMB_SOL_ID = $('input[name=IMB_SOL_ID]').val();
                d.IMB_ATD_ID = $("#COLABORADORORIGEM").val();
                d.IMB_ATD_IDDESTINO = $("#COLABORADORRESPONSAVEL").val();
                d.IMB_SOL_PRIORIDADE = $("#IMB_SOL_PRIORIDADE").val();
                d.datfim = $('input[name=i-data-fim-CONS]').val();
                d.datini = $('input[name=i-data-inicio-CONS]').val();
                d.abertas = $("#i-solicitacoes-abertas").prop( "checked" )   ? 'S' : 'N';
            }
        },
        columns: [
            {data: 'IMB_SOL_ID', render:getInformações},
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });


    function getInformações( data, type, full, meta)
    {
        var datavisualizacao = full.IMB_SOL_DTHVISUALIZACAO;
        if( datavisualizacao === null )
            datavisualizacao = 'Não Visualizado'
        else
            datavisualizacao = moment( full.IMB_SOL_DTHVISUALIZACAO ).format('DD/MM/YYYY  HH:mm');

        var obs = full.IMB_SOL_OBSERVACAO;
        if( full.IMB_SOL_OBSERVACAO===null) obs='';

        var titulo = full.IMB_SOL_TITULO;
        if( full.IMB_SOL_TITULO===null) titulo='';

        abertopor = full.ATENDENTEABERTURA;
        if( full.IMB_CLT_IDABERTURA != null )
            var abertopor = '</i>**Aberto Pelo Cliente**</i>';

        var tiposolicitacao = full.TIPOSOLICITACAO;
        if( tiposolicitacao === null) tiposolicitacao = 'Não Informado';

        var dataprevisao = full.IMB_SOL_DATAPREVISAO;
        if( dataprevisao === null )
            dataprevisao = 'Sem Previsão    '
        else
        dataprevisao = moment(full.IMB_SOL_DATAPREVISAO).format('DD/MM/YYYY');

        var  imovel = '';
        if( full.ENDERECOCOMPLETO != '' )
            imovel = 'Imóvel: <b><span class="font-blue">'+full.ENDERECOCOMPLETO+'</span><b>';

        var cliente ='';
        if( full.IMB_CLT_IDLOCADOR != 0 )
        {
            cliente = 'Locador: <b><span class="font-blue">'+full.NOMELOCADOR+'</span><b>';
        }
        if( full.IMB_CLT_IDLOCATARIO != 0 )
        {
            cliente = 'Locatário: <b><span class="font-blue">'+full.NOMELOCATARIO+'</span><b>';
        }
        if( full.IMB_CLT_IDFIADOR != 0 )
        {
            cliente = 'Fiador: <b><span class="font-blue">'+full.NOMEFIADOR+'</span><b>';
        }


        var classeprioridade = '';
        var prioridade = '';
        if( full.IMB_SOL_PRIORIDADE == 'A' )
        {
            classeprioridade = 'Class="font-red bold"';
            prioridade = 'Prioridade: **** ALTA ***';
        }
        else
        if( full.IMB_SOL_PRIORIDADE == 'M' )
        {
            classeprioridade = 'Class="font-orange bold"';
            prioridade = 'Prioridade: ** MÉDIA **';
        }
        else
        if( full.IMB_SOL_PRIORIDADE == 'B' )
        {
                classeprioridade = 'Class="font-blue bold"';
                prioridade = 'Prioridade: * BAIXA *';
        }

        var situacao = '';
        if( full.IMB_SOL_DATAFECHAMENTO ===null  )
            situacao = 'ABERTA'
        else
            situacao = 'FECHADA EM '+moment( full.IMB_SOL_DATAFECHAMENTO  ).format( 'DD/MM/YYYY');


//        if(  dataprevisao = 'Invalid date') dataprevisao = 'Sem Previsão';

        var texto = '<div class="row receita bold font-padrao">'+
                '   <div class="col-md-1 row-top-margin bold font-padrao">Pasta: <b>('+full.IMB_CTR_REFERENCIA+')</b></div>'+
                '   <div class="col-md-2 row-top-margin bold font-padrao">'+
                '       Data Abertura: <b>'+moment(full.IMB_SOL_DTHATIVO).format('DD/MM/YYYY')+'</b>'+
                '   </div>'+
                '   <div class="col-md-2 row-top-margin bold font-padrao">'+
                '       Resolver até: <b>'+dataprevisao+'</b>'+
                '   </div>'+
                '   <div class="col-md-3 row-top-margin bold font-padrao">'+
                '       Tipo Solicitação: <b>'+tiposolicitacao+'</b>'+
                '   </div>'+
                '   <div class="col-md-4 row-top-margin bold font-padrao">'+
                '       Abertura: <b>'+abertopor+'</b>'+
                '   </div>';
                                            //final de linha
            texto = texto +'</div>';




            texto = texto +
                '<div class="row receita bold font-padrao">'+
                    '<div class="col-md-2 row-top-margin bg-direcionado font-padrao">Direcionado para: <b>'+full.ATENDENTEDESTINO+'</b>'+
                    '   <p>Visualizado em: '+datavisualizacao+'</p>'+
                    '</div>';
            texto = texto +
                    '<div class="col-md-8 row-top-margin bg-white font-padrao">'+
                    '   <div class="row receita bold font-padrao"> '+
                        '      <div class="col-md-4">'+cliente+'</div>'+
                        '      <div class="col-md-4">'+imovel+'</div>'+
                        '   </div>'+
                    '   <b>'+titulo+'</b>'+
                    '   <p>'+obs+'</p>'+
                    '   <p><span '+classeprioridade+'>'+prioridade+'</span>'+
                    '       <span>'+situacao+'</span> '+
                    '   </p>'+
                    '</div>';

            texto = texto +
                    '<div class="col-md-2 row-top-margin bg-white font-8">'+
                    '<p><div class="row">'+
                    '<div class="col-md-12">'+
                    '  <a title="inativar solicitacao"'+
                    '       href="inativarSolicitacao( '+full.IMB_SOL_ID+')"> '+
                    '       <i class="fa fa-trash" style="font-size:24px;color:red"></i>'+
                    '  </a> '+
                    '  <a title="Alterar Informações"'+
                    '       href="javascript:alterarSolicitacao( '+full.IMB_SOL_ID+');"> '+
                    '       <i class="fa fa-edit" style="font-size:24px;color:blue"></i>'+
                    '  </a> '+
                    '  <a title="Anexar Documentos"'+
                    '       href="alterarSolicitacao( '+full.IMB_SOL_ID+')"> '+
                    '       <i class="fa fa-paperclip" style="font-size:24px;color:black"></i>'+
                    '  </a> ';

            if( full.IMB_SOL_DATAFECHAMENTO ===null  )
                texto = texto +
                    '  <a title="Fechar essa solicitação"'+
                    '       href="javascript:encerrarSolicitacao('+full.IMB_SOL_ID+')"> '+
                    '       <i class="fa fa-check-square-o" style="font-size:24px;color:green"></i>'+
                    '  </a> '
            else
                texto = texto +
                '  <a title="Reabrir essa solicitação"'+
                '       href="javascript:reabrirSolicitacao('+full.IMB_SOL_ID+')"> '+
                '       <i class="far fa-clone" style="font-size:24px;color:green"></i>'+
                '  </a> ';

            texto = texto +
                    '</div> '+
                    '</div></p> '+
                    '</div>';


        //final de linha
        var texto = texto +
                    '</div>';



        return texto;
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

    function alterarSolicitacao( id )
    {

        var url = "{{ route('solicitacoes.find') }}/"+id;

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function(data)
                {
                    console.log( data);
                    $("#IMB_SOL_ID").val(data.IMB_SOL_ID);
                    $("#IMB_SOL_TIPOSOLICITANTE").val(data.IMB_SOL_TIPOSOLICITANTE);
                    $("#IMB_SOL_TITULO-SOL").val(data.IMB_SOL_TITULO);
                    $("#IMB_SOL_DTHATIVO-ALT").val( data.IMB_SOL_DTHATIVO);
                    $("#IMB_SOL_DATAPREVISAO-ALT").val(data.IMB_SOL_DATAPREVISAO);
                    $("#IMB_TPS_ID-ALT").val(data.IMB_TPS_ID);
                    $("#IMB_ATD_IDDESTINO-ALT").val(data.IMB_ATD_IDDESTINO);
                    $("#IMB_SOL_OBSERVACAO-alt").val(data.IMB_SOL_OBSERVACAO);
                    $("#IMB_SOL_PRIORIDADE-ALT").val(data.IMB_SOL_PRIORIDADE);
                    $("#IMB_ATD_IDNOTIFEXTRA-ALT").val(data.IMB_ATD_IDNOTIFEXTRA);                    
                    $("#IMB_CLT_NOME-SOL").val(data.NOMECLIENTE);
                    $("#IMB_CLT_IDLOCADOR-SOL").val(data.IMB_CLT_IDLOCADOR);
                    $("#IMB_CLT_IDLOCATARIO-SOL").val(data.IMB_CLT_IDLOCATARIO);
                    $("#IMB_CLT_IDFIADOR-SOL").val(data.IMB_CLT_IDFIADOR);
                    $("#enderecoimovel-SOL").val(data.ENDERECOIMOVEL);
                    $("#IMB_IMV_ID-LOCIMV").val(data.IMB_CLT_IDIMOVEL);
                    $("#IMB_CTR_ID-LOCIMV").val(data.IMB_CTR_ID);

                    $("#IMB_CTR_REFERENCIA-SOL").val(data.IMB_CTR_REFERENCIA);
                    $("#IMB_SOL_DATAFECHAMENTO-ALT").html( '');
                    $("#i-reabrir").hide();
                    if( data.IMB_SOL_DATAFECHAMENTO != null)
                    {
                        $("#IMB_SOL_DATAFECHAMENTO-ALT").html( 'Fechada em: '+moment(data.IMB_SOL_DATAFECHAMENTO).format( 'DD/MM/YYYY'));
                        $("#i-reabrir").show();
                    }

                    $('#modalsolicitacao').modal({backdrop:'static',keyboard:false, show:true});
                }
            }
        );


    }

    function incluirSolicitacao()
    {
        $("#IMB_SOL_ID").val('');
        $("#IMB_SOL_TIPOSOLICITANTE").val('');
        $("#IMB_SOL_TITULO-SOL").val('');
        $("#IMB_CLT_NOME-SOL").val('');
        $("#enderecoimovel-SOL").val('');
        $("#IMB_SOL_DTHATIVO-ALT").val( moment().format('YYYY-MM-DD'));
        $("#IMB_SOL_DATAPREVISAO-ALT").val('');
        $("#IMB_TPS_ID-ALT").val('');
        $("#IMB_ATD_IDDESTINO-ALT").val('');
        $("#IMB_SOL_OBSERVACAO-alt").val('');
        $("#IMB_CTR_REFERENCIA-SOL").val('');
      
        $('#modalsolicitacao').modal({backdrop:'static',keyboard:false, show:true});

    }



</script>
@endpush
