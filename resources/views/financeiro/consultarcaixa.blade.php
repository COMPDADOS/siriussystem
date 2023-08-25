@extends('layout.app')

@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>

    .new-input{width:500px}
    .new-input-200{width:200px}
    .td-50
    {
        height:50%;
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
    .conciliado
    {
        background-color:green;
        color:white;
    }
    .vermelho
    {
        color:red;
    }
    .escondido
    {
        display:none;
    }

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
@endsection

@section('content')




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

        <button class="btn green pull-right" type="button" onClick="relatorioCaixa()">Relatório Caixa</button>
        <button class="btn blue  pull-right" type="button" onClick="consolidadoCFC()">Visão por C.F.C.</button>
        <button class="btn green  pull-right" type="button" onClick="consolidadoSubConta()">Visão por Sub-Conta(CC)</button>
        <button class="btn yeloow pull-right" type="button" onClick="conciliacaoArquivo()">Conciliação Via Arquivo</button>

    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
           <input type="hidden" id="I-FIN_CCX_ID" name="conta" >
            <div class="form-body">
                <input type="hidden" id="i-conta" name="conta">
                <div class="col-md-3">
                    <div class="form-group">
                        <label  class="control-label">conta</label>
    		    		<select class="form-control" id="FIN_CCX_ID" >
				    	</select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="i-inicio">De:</label>
                        <input type="date" class="form-control " name="inicio" placeholder="Data Inicial" id="i-inicio">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="i-termino">Até:</label>
                        <input type="date" class="form-control " name="termino" placeholder="Data Final" id="i-termino">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="i-conciliado">Conciliado/Desconciliado</label>
                        <select  class="form-control" id="i-conciliado">
                            <option value="">Todos</option>
                            <option value="C">Somente Conciliados</option>
                            <option value="D">Somente Sem Conciliar</option>

                        </select>

                        
                    </div>
                </div>
                <div class="form-actions noborder">
                    <button class="btn dark pull-right" type="button" onClick="incluir()">Novo Lançamento</button>
                    <button class="btn blue pull-right" id='search-form'>Pesquisar</button>

                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3"  id="i-saldo-inicial">
                        </div>
                        <div class="col-md-9 td-direita"  id="i-saldo-final">
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 5%"></th>
                        <th style="width: 5%"></th>
                        <th style="width: 10%">Dt Efetivação</th>
                        <th style="width: 10%">Dt Cadastro</th>
                        <th style="width: 10%">Entrada</th>
                        <th style="width: 10%">Saída</th>
                        <th style="width: 40%">Histórico</th>
                        <th style="width: 5%">Nº Docto.</th>
                        <th style="width: 5%">Nº Cheque</th>
                        <th width="15%"></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modallcx">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Lançamento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <input type="hidden" id="FIN_LCX_ID">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-12">
                                        <label class="control-label" for="FIN_LCX_DATACADASTRO"> Data Cadastro
                                            <input type="date" class="form-control "  id="FIN_LCX_DATACADASTRO">

                                        </label>
                                        <label class="control-label" for="FIN_LCX_DATAENTRADA"> Data Efetivaçao
                                            <input type="date" class="form-control "  id="FIN_LCX_DATAENTRADA">
                                        </label>
                                        <label class="control-label" for="FIN_LCX_OPERACAO"> Operação
                                            <select class="form-control" id="FIN_LCX_OPERACAO">
                                                <option value="C">Crédito</option>
                                                <option value="D">Débito</option>
                                            </select>
                                        </label>
                                        <label class="control-label" for="FIN_LCX_VALOR"> Valor R$
                                            <input class="form-control valor" type="text" id="FIN_LCX_VALOR">
                                        </label>
                                        <label class="control-label" for="FIN_CCX_IDORIGEM">Conta
                                            <select class="form-control" id="FIN_CCX_IDORIGEM">
                                            </select>
                                        </label>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" > Forma
                                                <select class="form-control" id="FIN_LCX_FORMA">
                                                    <option value="">Não Informado</option>
                                                    <option value="C">Cheque</option>
                                                    <option value="D">Dinheiro</option>
                                                    <option value="T">Transf. C/C</option>
                                                    <option value="P">PIX</option>
                                                </select>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" > Histórico
                                        <input type="text" class="form-control new-input " id="FIN_LCX_HISTORICO" >
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label" > Lançado por
                                        <input type="text" class="form-control new-input-200 " id="IMB_ATD_NOME" readonly >
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Detalhe do Lançamento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover"  id="i-table-tbldetalhe">
                                        <thead>
                                            <th style="width: 5%">ID#</th>
                                            <th style="width: 10%">CFC ID</th>
                                            <th style="width: 27%">CFC Descrição</th>
                                            <th style="width: 10%">Sub-Conta ID</th>
                                            <th style="width: 20%">Sub-Conta Descrição</th>
                                            <th style="width: 5%">C/D</th>
                                            <th style="width: 13%">Valor</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onClick="">OK</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modalnovolancamento">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Lançamento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <input type="hidden" id="FIN_LCX_ID" value = "">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-FIN_LCX_DATACADASTRO"> Data Cadastro
                                        <input type="date" class="form-control"  id="inc-FIN_LCX_DATACADASTRO">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-FIN_LCX_DATAENTRADA"> Data Efetivaçao
                                        <input type="date" class="form-control"  id="inc-FIN_LCX_DATAENTRADA">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-FIN_LCX_OPERACAO"> Operação
                                        <select class="form-control" id="inc-FIN_LCX_OPERACAO">
                                            <option value="C">Crédito</option>
                                            <option value="D">Débito</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-FIN_LCX_VALOR"> Valor R$
                                        <input class="form-control valor" type="text" id="inc-FIN_LCX_VALOR">
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label" for="inc-FIN_CCX_IDORIGEM">Conta
                                        <select class="form-control" id="inc-FIN_CCX_IDORIGEM">
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" > Forma
                                            <select class="form-control" id="inc-FIN_LCX_FORMA">
                                                <option value="">Não Informado</option>
                                                <option value="C">Cheque</option>
                                                <option value="D">Dinheiro</option>
                                                <option value="T">Transf. Entre C/C</option>
                                                <option value="P">PIX</option>
                                            </select>
                                    </label>
                                </div>
                                <div class="col-md-6 detalhamento">
                                    <label class="control-label" > Histórico
                                        <input type="text" class="form-control new-input " id="inc-FIN_LCX_HISTORICO" >
                                    </label>
                                </div>
                                <div class="col-md-4 escondido" id="div-transferencia">
                                    <label class="control-label" for="inc-FIN_CCX_IDDESTINO">Conta Destino
                                        <select class="form-control" id="inc-FIN_CCX_IDDESTINO">
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet box dark detalhamento">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Informação do Registro de Detalhamento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="hidden" id="FIN_CAT_ID">
                                        <span class="input-group-btn">
                                            <button class="btn red" type="button" onClick="cfcPesquisa()" title="Localizar o CFC">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                        <input type="text" class="form-control" id="I-FIN_CFC_DESCRICAO" placeholder="C.F.C." title="C.F.C.">
                                        <input type="hidden" class="form-control" id="I-FIN_CFC_ID">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn red" type="button" onClick="subContaPesquisa()" title="Localizar a Sub-Conta">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                        <input type="text" class="form-control" id="I-FIN_SBC_DESCRICAO" title="Sub-Conta(Centro de Custos)"
                                            placeholder="Sub-Conta(centro de custo)">
                                        <input type="hidden" class="form-control" id="I-FIN_SBC_ID">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                        <select class="form-control" id="I-FIN_CAT_OPERACAO">
                                            <option value="C">Crédito</option>
                                            <option value="D">Débito</option>
                                        </select>
                                        <span>Operação</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input class="form-control valor" type="text" id="I-FIN_CAT_VALOR">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm blue" type="button" onClick="novoDetalhe()" title="Iniciar um Novo Detalhe">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <span>Valor R$</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-actions right">
                                    <button type="cancel" class="btn btn dark ">Desfazer</button>
                                    <button class="btn green" onClick="GravarDetalhe();">
                                        <i class="fa fa-check"></i> Gravar Detalhe
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="portlet box green detalhamento">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Detalhe do Lançamento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover"  id="inc-i-table-tbldetalhe">
                                        <thead>
                                             
                                            <th style="width: 10%">CFC ID</th>
                                            <th style="width: 27%">CFC Descrição</th>
                                            <th style="width: 10%">Sub-Conta ID</th>
                                            <th style="width: 20%">Sub-Conta Descrição</th>
                                            <th style="width: 5%">C/D</th>
                                            <th style="width: 13%">Valor</th>
                                            <th</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total</td>
                                                <td><div class="td-direita" id="i-total-detalhamento"></div></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
<!--                                        <input type="text" class="valor" id="i-total-detalhamento">-->


                                    </table>
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




<div class="modal" tabindex="-1" role="dialog" id="inc-modaldetalhe">
    <div class="modal-dialog" style="width:50%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Detalhamento do Lançamento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onClick="">OK</button>
            </div>
        </div>
    </div>
</div>

@include('layout.modalcfc')
@include('layout.modalsubconta')
@include('layout.modalconciliar')

@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>

<script>



    $(document).ready(function()
    {
        $( "#FIN_CCX_ID" ).change(function() {
            var cConta = $('#FIN_CCX_ID').val();
            $("#I-FIN_CCX_ID").val( cConta );
        });

        $("#sirius-menu").click();

        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );

        $("#inc-FIN_LCX_FORMA").change( function()
        {

            if( $("#inc-FIN_LCX_FORMA").val() == 'T' )
            {
                $("#div-transferencia").show();
                $(".detalhamento").hide();
            }
            else
            {
                $("#div-transferencia").hide();
                $(".detalhamento").show();
            }

        });

        $("#inc-FIN_LCX_VALOR").change( function()
        {

            $("#I-FIN_CAT_VALOR").val( $("#inc-FIN_LCX_VALOR").val() );

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

        $.datepicker.regional['br'] =
        {
	        closeText: 'ok',
	        prevText: 'Anterior',
	        nextText: 'Próximo',
	        currentText: 'corrent',
	        monthNames: [   'Janeiro','Fevereiro','Março','Abril','Maio','Junho',
	                        'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: [  'Jan','Fev','Mar','Abr','Mai','Jun',
	                            'Jul','Ago','Set','Out','Nov','Dez'],
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
	        dayNamesShort: ['D','S','T','Q','Q','S', 'S'],
	        dayNamesMin:  ['D','S','T','Q','Q','S', 'S'],
	        weekHeader: 'wh',
	        dateFormat: 'dd/mm/yy',
	        firstDay: 1,
	        isRTL: false,
	        showMonthAfterYear: false,
	        yearSuffix: ''
	    };

	    $.datepicker.setDefaults($.datepicker.regional['br']);

	    $('.dpicker').datetimepicker(
        {
	        timeFormat: 'hh:mm',
	        timeOnlyTitle: 'timeonly',
	        timeText: 'Horário',
	        hourText: 'Hora',
	        minuteText: 'Minuto',
	        secondText: 'Segundo',
	        currentText: 'Agora',
            closeText: 'Sair',
            format: 'DD-MM-YYYY',
            minView: 2,
            showTimepicker: false
        });

        cargaConta();

    });


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
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax:
        {
            url:"{{ route('caixa.carga') }}",
            data: function (d)
            {
                d.conta = $('input[name=conta]').val();
                d.inicio = $('input[name=inicio]').val();
                d.termino = $('input[name=termino]').val();
                d.situacao = $('input[name=situacao]').val();
                d.conciliado = $("#i-conciliado").val();
            }
        },
        columns:
        [
            {data: 'FIN_LCX_SITUACAO', render: excluido },
            {data: 'FIN_LCX_ORIGEM', render:origem},
            {data: 'FIN_LCX_DATAENTRADA', render: formatarDataEntrada },
            {data: 'FIN_LCX_DATACADASTRO', render: formatarDataCadastro},
            {data: 'FIN_LCX_ID', render: pegarEntrada },
            {data: 'FIN_LCX_ID', render: pegarSaida },
            {data: 'FIN_LCX_HISTORICO'},
            {data: 'FIN_LCX_RECIBO', render: pegarRecibo},
            {data: 'FIN_LCX_NUMEROCHEQUE'},
        ],

        "columnDefs":
        [
            {
                "targets": 9,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button title='Conciliar este documento' class='btn btn-success	glyphicon glyphicon-ok pull-right btn-conciliar'></button>"+
                "<button class='btn green-meadow glyphicon glyphicon-search pull-right show-lcx'></button>"+
                "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-lcx'></button>"+
                "<button class='btn btn-danger glyphicon glyphicon-trash pull-right del-lcx'></button>",
            },
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
        calcularSaldos();
        
    });



    $('#resultTable tbody').on( 'click', '.del-lcx', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            desativarLancamento( data.FIN_LCX_ID );
            calcularSaldos();
            table.draw();
        });


        $('#resultTable tbody').on( 'click', '.show-lcx', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            verLcx( data.FIN_LCX_ID, false);
        });

        $('#resultTable tbody').on( 'click', '.alt-lcx', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            verLcx( data.FIN_LCX_ID, true );
        });

        $('#resultTable tbody').on( 'click', '.btn-conciliar', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();

    
            if( data.FIN_LCX_CONCILIADO == 'S' )
            {
                if (confirm("Já conciliado! Deseja desfazer a conciliação?") == true) 
                {
                    desconciliacao( data.FIN_LCX_ID );
                } 
            }
            else
            {
                conciliacao( data.FIN_LCX_ID );
            }

            alert('Pressione ok para recarregar a tela');
            $( "#search-form" ).submit();
            
        });

                

    function cargaConta()
    {
        var url = "{{ route('contacaixa.carga')}}/N";

        $.getJSON( url, function( data )
        {
            $("#FIN_CCX_ID").empty();
            $("#inc-FIN_CCX_IDORIGEM").empty();
            $("#inc-FIN_CCX_IDDESTINO").empty();


                linha = '<option value="">Escolha a Conta</option>';
                $("#FIN_CCX_ID").append( linha );
                $("#inc-FIN_CCX_IDORIGEM").append( linha );
                $("#inc-FIN_CCX_IDDESTINO").append( linha );

                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
                    $("#inc-FIN_CCX_IDORIGEM").append( linha );
                    $("#FIN_CCX_ID").append( linha );
                    $("#inc-FIN_CCX_IDDESTINO").append( linha );
                }
        });
    }

    function excluido(data, type, full, meta)
    {
        if( full.FIN_LCX_CONCILIADO == 'S' )
            return '<div class="conciliado td-center"><b>CONCILIADO</b></div>';
        else
        if( full.FIN_LCX_DTHEXCLUSAO != null )
            return '<div class="vermelho td-center"><b>EXCLUÍDO</b></div>';
        else
        return '<div></div>';

    }


    function pegarEntrada(data, type, full, meta)
    {
        var valor = parseFloat(full.FIN_LCX_VALOR);
        var excluido='';

        if( full.FIN_LCX_DTHEXCLUSAO != null )
           excluido=' excluido';

        if( full.FIN_LCX_OPERACAO == 'C')
            return '<div class="azul td-direita '+excluido+'"><b>'+formatarBRSemSimbolo(valor)+'</b></div>';
        else
        return '<div class="td-direita'+excluido+'">0,00</div>';

    }

    function pegarRecibo(data, type, full, meta)
    {
        if( full.FIN_LCX_ORIGEM == 'RT')
            return '<div><a href="/sys/recibolocatario/imprimir/'+full.FIN_LCX_RECIBO+'/S" target="_blank">'+full.FIN_LCX_RECIBO+'</a></div>'
        else
        if( full.FIN_LCX_ORIGEM == 'RD')
            return '<div><a href="/sys/recibolocador/imprimir/'+full.FIN_LCX_RECIBO+'/S" target="_blank">'+full.FIN_LCX_RECIBO+'</a></div>'
        else
            return '<div><a href=""></a></div>';


    }

    function pegarSaida(data, type, full, meta)
    {

        var excluido='';
        if( full.FIN_LCX_DTHEXCLUSAO != null )
           excluido=' excluido';

        var valor = parseFloat(full.FIN_LCX_VALOR);
        if( full.FIN_LCX_OPERACAO == 'D')
            return '<div class="vermelho td-direita '+excluido+'"><b>'+formatarBRSemSimbolo(valor)+'</b></div>';
        else
            return '<div class="td-direita '+excluido+'">0,00</div>';
    }

    function formatarDataEntrada(data, type, full, meta)
    {
        return moment(full.FIN_LCX_DATAENTRADA).format('DD/MM/YYYY');

    }

    function formatarDataCadastro(data, type, full, meta)
    {
        return moment(full.FIN_LCX_DATACADASTRO).format('DD/MM/YYYY');

    }

    function verLcx( id , alterar)
    {
        $("#FIN_LCX_ID").val( id );
        $("#modalnovolancamento").modal('show');
        url = "{{route('caixa.lanc.find')}}/"+id;

        $.ajax(
            {
                url         : url,
                dataType    : 'json',
                type        : 'get',
                async       : false,
                success     : function( data )
                {
                    var valor = parseFloat(data.FIN_LCX_VALOR );
                    valor = formatarBRSemSimbolo(valor);
                    $("#inc-FIN_LCX_OPERACAO").val( data.FIN_LCX_OPERACAO);
                    $("#inc-FIN_LCX_FORMA").val( data.FIN_LCX_FORMA);
                    $("#inc-FIN_LCX_DATACADASTRO").val( data.FIN_LCX_DATACADASTRO );
                    $("#inc-FIN_LCX_DATAENTRADA").val( data.FIN_LCX_DATAENTRADA) ;
                    $("#inc-FIN_LCX_HISTORICO").val( data.FIN_LCX_HISTORICO);
                    $("#inc-IMB_ATD_NOME").val( data.IMB_ATD_NOME);
                    $("#inc-FIN_LCX_VALOR").val( valor );
                    $("#inc-FIN_CCX_IDORIGEM").val(data.FIN_CCX_ID);
                    $("#FIN_LCX_ID").val(data.FIN_LCX_ID);                    
                    debugger;
                    cargaContaOrigem( data.FIN_CCX_ID ) 
                    
                    cargaDetalhamento(data.FIN_LCX_ID, alterar )                    ;
                }

            }
        );



    }

    function cargaContaOrigem( id )
    {

        var url = "{{ route('contacaixa.carga')}}/N";


        $.ajax(
            {
                url : url,
                dataType:'Json',
                type:'get',
                async:false,
                success: function(data)
                {
                    $("#FIN_CCX_IDORIGEM").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<option value="'+data[nI].FIN_CCX_ID+'">'+
                            data[nI].FIN_CCX_DESCRICAO+"</option>";
                            $("#FIN_CCX_IDORIGEM").append( linha );
                    }
                    $("#FIN_CCX_IDORIGEM").val( id );
                }
            }
        );

    }

    function cargaDetalhamento( id, alterar )
    {
        url = "{{route('caixa.catranlanc')}}/"+id;

        console.log( url);
        $.ajax(
            {
                url     : url,
                dataType:'json',
                type    : 'get',
                success : function( data )
                {
                    linha = "";
                    $("#inc-i-table-tbldetalhe>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {

  
                        
                        var valor = parseFloat(data[nI].FIN_CAT_VALOR );
                        valor = formatarBRSemSimbolo(valor);

 
                        if( nI == 0)
                        {
                            $("#FIN_CAT_ID").val(  data[nI].FIN_CAT_ID);
                            $("#I-FIN_CFC_DESCRICAO").val( data[nI].FIN_CFC_DESCRICAO);
                            $("#I-FIN_CFC_ID").val( data[nI].FIN_CFC_ID);
                            $("#I-FIN_SBC_ID").val( data[nI].FIN_SBC_ID);
                            $("#I-FIN_SBC_DESCRICAO").val( data[nI].FIN_SBC_DESCRICAO);
                            $("#I-FIN_CAT_OPERACAO").val( data[nI].FIN_CAT_OPERACAO);
                            $("#I-FIN_CAT_VALOR").val( valor );
                        }

                        if( ! alterar )
                        {
                            linha =
                                '<tr>'+
                                '<td style="text-align:center valign="center">'+data[nI].FIN_CFC_ID+'</td>' +
                                '<td style="text-align:center valign="center">'+data[nI].FIN_CFC_DESCRICAO+'</td>' +
                                '<td style="text-align:center valign="center">'+data[nI].FIN_SBC_ID+'</td>' +
                                '<td style="text-align:center valign="center">'+data[nI].FIN_SBC_DESCRICAO+'</td>' +
                                '<td style="text-align:center valign="center">'+data[nI].FIN_CAT_OPERACAO+'</td>' +
                                '<td class="td-direita">'+valor+'</td>' ;
                            linha = linha +
                                '</tr>';
                                $("#inc-i-table-tbldetalhe").append( linha );
                        }

                    }
                }
            });
    }

    function incluir()
    {
        $("#inc-FIN_LCX_DATACADASTRO").val( moment().format( 'YYYY-MM-DD'));
        $("#inc-FIN_LCX_DATAENTRADA").val( moment().format( 'YYYY-MM-DD'));
        $("#inc-FIN_LCX_VALOR").val(0);
        $("#inc-FIN_LCX_HISTORICO").val('');
        $("#inc-FIN_CCX_ID").val("");
        $("#inc-FIN_CCX_IDDESTINO").val("");
        $("#inc-FIN_LCX_OPERACAO").val("D");
        $("#i-total-detalhamento").html( '' );
        $("#FIN_LCX_ID").val('');
        
        novoDetalhe();

        $("#modalnovolancamento").modal({backdrop: 'static', keyboard: false})


        $("#inc-i-table-tbldetalhe>tbody").empty();

    }

    function cfcPesquisa()
    {
        $("#modalpesquisacfc").modal('show');
    }

    function subContaPesquisa()
    {
        $("#modalpesquisasubconta").modal('show');
    }

    function GravarDetalhe()
    {

        debugger;
        if( $("#I-FIN_CFC_DESCRICAO").val() == '' )
        {
            alert('É obrigatório pelo menos o CFC');
            return false;
        }


        if( $("#I-FIN_CAT_VALOR").val() == '' )
        {
            alert('Informe o valor do detalhe!');
            return false;
        }

        var qtlinhas = $('#inc-i-table-tbldetalhe >tbody >tr').length;
        qtlinhas++;
        linha =
            '<tr id="det'+qtlinhas+'">'+
            '<td>'+$("#I-FIN_CFC_ID").val()+'</td>' +
            '<td>'+$("#I-FIN_CFC_DESCRICAO").val()+'</td>' +
            '<td>'+$("#I-FIN_SBC_ID").val()+'</td>' +
            '<td>'+$("#I-FIN_SBC_DESCRICAO").val()+'</td>' +
            '<td class="td-center">'+$("#I-FIN_CAT_OPERACAO").val()+'</td>' +
            '<td class="td-direita">'+$("#I-FIN_CAT_VALOR").val()+'</td>' +
            '<td style="text-align:center" valign="center"> '+
                '<a href=javascript:excluirDetalhe("det'+qtlinhas+'") class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a> '+
            '</td> '+
            '</tr>';
        $("#inc-i-table-tbldetalhe").append( linha );
        totalizarDetalhamento();
    }

    function totalizarDetalhamento()
    {
        var table = document.getElementById('inc-i-table-tbldetalhe');
        var total = 0;
        for (var r = 1, n = table.rows.length-1; r < n; r++)
        {
            var valor = realToDolar(table.rows[r].cells[5].innerHTML );
            valor = parseFloat( valor );
            if( table.rows[r].cells[4].innerHTML == 'D')
                total = total - valor
            else
                total = total + valor;
        }

        total = total.toFixed( 2 );
        total = parseFloat( total );
        $("#i-total-detalhamento").html( formatarBRSemSimbolo(total) )

        return total;

    }

    function novoDetalhe()
    {
        $("#I-FIN_CFC_ID").val('');
        $("#I-FIN_CFC_DESCRICAO").val('');
        $("#I-FIN_SBC_DESCRICAO").val('');
        $("#I-FIN_SBC_ID").val('');
        $("#I-FIN_CAT_OPERACAO").val('D');
        $("#I-FIN_CAT_VALOR").val(0);
        $("#i-total-detalhamento").val(0);


    }

    function gravarRegistro()
    {

        if( ! validarData( $("#inc-FIN_LCX_DATACADASTRO").val() ) )
        {
            alert( 'Data de Cadastro Inválida!');
            return false;
        }


        if( ! validarData( $("#inc-FIN_LCX_DATAENTRADA").val() ) )
        {
            alert( 'Data de Entrada Inválida!');
            return false;
        }

        if( $("#inc-FIN_LCX_VALOR").val() == '' )
        {
            alert('Não foi informado o valor total do lançamento');
            return false;
        }


        if( $("#inc-FIN_CCX_IDORIGEM").val() == '' )
        {
            alert('Informe a conta!');
            return false;
        }

        if( $("#inc-FIN_LCX_HISTORICO").val() == '' && $("#inc-FIN_LCX_FORMA").val() != 'T')
        {
            alert('É importante ter um histórico registrado!');
            return false;
        }


        if( $("#inc-FIN_LCX_FORMA").val() == 'T' && $("#inc-FIN_CCX_IDDESTINO").val() == '' )
        {
            alert('Para forma transferência, é necessário informar a conta destino!');
            return false;
        }

        if(  $("#inc-FIN_LCX_FORMA").val() != 'T' )
        {
            if(  $('#inc-i-table-tbldetalhe >tbody >tr').length < 1 )
            {
                alert('Falta informar o detalhamento do lançamento');
                return false;
            }

            debugger;
            var valorlancamento = realToDolar( $("#inc-FIN_LCX_VALOR").val() );
            valorlancamento = parseFloat( valorlancamento );
            if( $('#inc-FIN_LCX_OPERACAO').val() == 'D' )
            valorlancamento = valorlancamento * -1;

            if(  formatarBRSemSimbolo(valorlancamento) != $("#i-total-detalhamento").html()  )
            {
                alert('O valor total informado, não está batendo com o total no detalhamento');
                return false;
            }

        }

        url = "{{route('caixa.lanc.salvar')}}";

        var acatran = [];
        var table = document.getElementById('inc-i-table-tbldetalhe');

        for (var r = 1, n = table.rows.length-1; r < n; r++)
        {
            acatran.push( [ r,
                            realToDolar(table.rows[r].cells[5].innerHTML),
                            table.rows[r].cells[0].innerHTML,
                            table.rows[r].cells[2].innerHTML,
                            table.rows[r].cells[4].innerHTML,
                            $("#FIN_CAT_ID").val(),

                        ]);
        }


        console.log( acatran );
        dados =
        {
            FIN_LCX_DATACADASTRO : $("#inc-FIN_LCX_DATACADASTRO").val(),
            FIN_LCX_DATAENTRADA : $("#inc-FIN_LCX_DATAENTRADA").val(),
            FIN_LCX_OPERACAO : $("#inc-FIN_LCX_OPERACAO").val(),
            FIN_LCX_VALOR : realToDolar( $("#inc-FIN_LCX_VALOR").val()),
            FIN_LCX_ORIGEM : 'CX',
            FIN_LCX_HISTORICO : $("#inc-FIN_LCX_HISTORICO").val(),
            FIN_CCX_ID : $("#inc-FIN_CCX_IDORIGEM").val(),
            FIN_LCX_FORMA : $("#inc-FIN_LCX_FORMA").val(),
            FIN_LCX_ID :  $("#FIN_LCX_ID").val(),
            FIN_CCX_IDDESTINO : $("#inc-FIN_CCX_IDDESTINO").val(),

            CATRAN  : acatran,

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
                    $("#modalnovolancamento").modal( 'hide');

                },
                error:function()
                {
                    alert('erro na gravacao do Registro');
                }
            }
        )


    }

    function validarData(data)
    {
        var ret = true;
        if( data.length != 10 ) ret = false
        else
		    ret = moment( data, 'DD-MM-YYYY').isValid() ;
        return ret;
	}

    function gravarDetalheDB( id )
    {

        var urltran = "{{route('caixa.catran.store')}}";

        var table = document.getElementById('inc-i-table-tbldetalhe');
        var total = 0;
        $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
        });

        for (var r = 1, n = table.rows.length-1; r < n; r++)
        {
            var dados =
            {
                FIN_LCX_ID      : id,
                FIN_CAT_SEQUENCIA: r,
                FIN_CAT_VALOR : realToDolar(table.rows[r].cells[5].innerHTML),
                FIN_CFC_ID:table.rows[r].cells[0].innerHTML,
                FIN_SBC_ID:table.rows[r].cells[2].innerHTML,
                FIN_CAT_OPERACAO:table.rows[r].cells[4].innerHTML
            }

            $.ajax(
                {
                    url             : urltran,
                    dataType        : 'json',
                    type            : 'post',
                    data            : dados,
                    async           : false,
                    success         : function( data )
                    {

                    },
                    error           : function(data)
                    {

                        alert('Erro na gravação do Detalhe');
                    }
                }
            );

        }

        total = total.toFixed( 2 );
        $("#i-total-detalhamento").html( formatarBRSemSimbolo(total) )

        return total;

    }

    function excluirDetalhe( id )
    {
        if (confirm("Tem certeza que deseja excluir este Ítem?") )
        {
            var textoid = '#'+id;
            $( textoid ).remove();
            totalizarDetalhamento();
        }
    }

    function calcularSaldos()
    {
        var conta = $("#FIN_CCX_ID").val();
        var datainicio =  $("#i-inicio").val();
        var url = "{{route('caixa.saldoinicial')}}";

        var dados =
        {
            conta : conta,
            data : datainicio,
        }

        $.ajax(
            {
                url     : url,
                dataType:'json',
                type:'get',
                data: dados,
                success:function( data )
                {
                    valor = parseFloat( data );
                    valor = formatarBRSemSimbolo(valor);
                    $("#i-saldo-inicial").html( 'Saldo Inicial: <b>R$ '+valor+'</b>' );

                }
            }
        )


        var datatermino =  $("#i-termino").val();
        var url = "{{route('caixa.saldofinal')}}";

        var dados =
        {
            conta : conta,
            data : datatermino,
        }

        $.ajax(
            {
                url     : url,
                dataType:'json',
                type:'get',
                data: dados,
                success:function( data )
                {
                    valor = parseFloat( data );
                    valor = formatarBRSemSimbolo(valor);
                    $("#i-saldo-final").html( 'Saldo Final: <b>R$ '+valor+'</b>' );

                }
            }
        )


    }

    function desativarLancamento( id )
    {
        var url = "{{route('caixa.desativarlancto')}}/"+id;
        console.log( url );

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
                async:false,
                success: function( data )
                {
                    alert("Registro Desativado!");
                },
                error:function(data)
                {
                    alert('Não foi possivel desativar! Verifique se não é um repasse ou recebimento de aluguel');
                }
            }
        )


    }

    function consolidadoCFC()
    {


        window.location = "{{ route('caixa.consolidadocfc') }}";

    }

    function consolidadoSubConta()
    {


        window.location = "{{ route('caixa.consolidadosubconta') }}";

    }

    function origem( data )
    {
        var origem="";
        if( data == 'RD') origem="REPASSE";
        if( data == 'RT') origem="RECEBIMENTO";
        if( data == 'CX') origem="LCTO. CAIXA";
        if( data == 'AP') origem="CONTAS PAGAR";

        return '<div class="div-center">'+origem+'</div>';
    }

    function formatarValor( data)
    {
        
  //      alert( data );
        var valor = parseFloat( data );
        return '<div class="div-right">'+formatarBRSemSimbolo(valor)+'</div>';

    }

    function relatorioCaixa()
    {
        if( $("#FIN_CCX_ID").val() == '' )
        {
            alert('Para impressão do relatório é necessário informar a conta');
            return false;
        }
        conta = $('input[name=conta]').val();
        inicio = $('input[name=inicio]').val();
        termino = $('input[name=termino]').val();
        situacao = $('input[name=situacao]').val();
        conciliado = $("#i-conciliado").val();
    
        url = "{{ route('caixa.carga') }}?conta="+conta+"&inicio="+inicio+"&termino="+termino+"&situacao="+conciliado+"&conciliado="+conciliado+"&destino=RELATORIO";
        window.open( url, '_blank');
    }



</script>
@endpush


