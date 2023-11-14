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

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Planilha Repasses</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>



    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
            <div class="form-body">
                <div class="col-md-2 fundo-grey">
                    <div class="form-group">
                        <input type="hidden" id="i-unidade" name="IMB_IMB_ID">
                        <label for="js-select-unidade" class="control-label">Unidade</label>
                        <select class="form-control" id="js-select-unidade">
                        </select>
                    </div>
                </div>
                <div class="col-md-2 div-center fundo-grey">
                    <div class="row">
                        Conta
                        <select  class="form-control" id="FIN_CCX_ID">
                        </select>
                    </div>
                </div>

                <div class="col-md-3 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Repasses entre
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" class="form-control " name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" class="form-control" name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>
                    <div class="div-center" >
                        <label id="i-total"></label>
                    </div>

                </div>
                <div class="div col-md-2">
                    <label class="control-label">Tipo</label>
                    <select class="form-control"  id="i-tipo">
                        <option value="R" selected >Data do Pagamento</option>
                        <option value="P">Data da Emissão</option>
                    </select>

                </div>
                <div class="col-md-3">
                    <label> Locador</label>
                    <select  class="select2" id="i-locadores">
                    </select>
                 </div>

                <div class="form-actions noborder">
                    <a class="btn green pull-right"  href="javascript:recibosEmLote();">Recibos em Lote</a>
                    <a class="btn yellow pull-right"  href="javascript:relatorioDetalhado();">Relatório Detalhado</a>
                    <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th style="width: 6px"># Imóvel</th>
                        <th style="width: 6px">Pasta</th>
                        <th style="width: 100px">Endereço</th>
                        <th style="width: 100px">Locador</th>
                        <th style="width: 100px">Locatário</th>
                        <th style="width: 50px">Recibo</th>
                        <th style="width: 50px">Dt. Vencto.</th>
                        <th style="width: 50px">Dt. Repasse</th>
                        <th style="width: 50px">$ Aluguel</th>
                        <th style="width: 50px">$ Descontos</th>
                        <th style="width: 50px">$ Taxa Adm.</th>
                        <th style="width: 50px">$ Taxa Contrato</th>
                        <th style="width: 50px">$ IPTU</th>
                        <th style="width: 50px">$ IRRF</th>
                        <th style="width: 50px">$ Multa</th>
                        <th style="width: 50px">$ Juros</th>
                        <th style="width: 50px">$ Correção</th>
                        <th style="width: 50px">$ Outros</th>
                        <th style="width: 50px">$ Repassado</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<form style="display: none" action="{{route('recibolocador.repassadoperiodo')}}" method="POST" id="form-repassadoperiodo" target="_blank">
    @csrf
    <input type="hidden" id="recper-empresa" name="recperempresa" />
    <input type="hidden" id="recper-datainicio" name="recperdatainicio" />
    <input type="hidden" id="recper-datafim" name="recperdatafim" />
</form>

@endsection


@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



    $(document).ready(function()
    {

        $("#sirius-menu").click();

        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );

        $( "#js-select-unidade" ).change(function()
        {
            var nUnidade = $('#js-select-unidade').val();
            $("#i-unidade").val( nUnidade);
        });

        cargaEmpresa();
        cargaConta();

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

        if( $("#inc-IMB_CTR_ID").val() != '0' )
        {
            $("#btnnovo").show();
        }

        //totalizar();
        cargaLocadores();
        $(".select2").select2(
        {
            placeholder: 'Selecione',
            width: null
        });


    });


    var table = $('#resultTable').DataTable(
    {
        "pageLength": 50,
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
        bLengthChange: false,
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax:
        {
            url:"{{ route('recibolocador.planilharepasses') }}",
            data: function (d)
            {
                d.IMB_IMB_ID = $('input[name=IMB_IMB_ID]').val();
                d.datainicio = $('input[name=inicio]').val();
                d.datafim = $('input[name=termino]').val();
                d.IMB_CLT_ID = $('#i-locadores').val();
                d.tipo = $("#i-tipo").val();
            }
        },
        columns:
        [
            {data: 'IMB_IMV_ID'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECOIMOVEL'},
            {data: 'NOMELOCADOR'},
            {data: 'NOMELOCATARIO'},
            {data: 'IMB_RLD_NUMERO', render:recibo},
            {data: 'IMB_RLD_DATAVENCIMENTO', render:formatarData },
            {data: 'IMB_RLD_DATAPAGAMENTO', render:formatarData },
            {data: 'VALORALUGUEL', render:formatarValor},
            {data: 'DESCONTOS', render:formatarValor},
            {data: 'TAXAADM', render:formatarValor},
            {data: 'TAXCON', render:formatarValor},
            {data: 'IPTU', render:formatarValor},
            {data: 'IRRF', render:formatarValor},
            {data: 'MULTAATRASO', render:formatarValor},
            {data: 'JUROSATRASO', render:formatarValor},
            {data: 'CORRECAOMONETARIA', render:formatarValor},
            {data: 'OUTROS', render:formatarValor},
            {data: 'TOTALREPASSADO', render:formatarValor},

        ],


        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
        totalizar();
    });


    function limparCampos()
    {
        $("#i-locadores > option").removeAttr("selected");
        $("#i-locadores").trigger("change");
        $("#js-select-unidade").val('');
        $("#FIN_CCX_ID").val('');
        
    }
    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }

    function cargaEmpresa()
    {
        $.getJSON( "{{ route('imobiliaria.carga')}}/1", function( data )
        {
            $("#js-select-unidade").empty();
            linha =  '<option value="0">Todas Unidades</option>';
                $("#js-select-unidade").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_IMB_ID+'">'+
                        data[nI].IMB_IMB_NOME+"</option>";
                        $("#js-select-unidade").append( linha );

                }

                $("#js-select-unidade").val( $("#IMB_IMB_IDMASTER").val());

            });

    }

    function formatarData( data )
    {
        return moment(data).format('DD/MM/YYYY');

    }

    function formatarValor( data )
    {
        var valor = parseFloat( data );
        return formatarBRSemSimbolo(valor);
    }


    function totalizar()
    {
        var datainicio = moment($("#i-inicio").val()).format( 'MM-DD-YYYY');
        var datafim = moment($("#i-termino").val()).format( 'MM-DD-YYYY');

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";

        var url = "{{route('totalrepassadoperiodo')}}/"+datainicio+'/'+datafim+'/'+empresa;

        console.log( url );

        $.ajax(
            {
                url : url,
                dataType: 'json',
                type: 'get',
                success: function( data )
                {
                    $("#i-total").html( '<b>Total Recebido no Periodo -> R$ '+formatarBRSemSimbolo(data) );
                },
                error:function()
                {

                    $("#i-total").val( 'Falha ao Totalizar' );
                }
            }
            );

    }

    function relatorioDetalhado()
    {
        var datainicio = $("#i-inicio").val();
        var datafim = $("#i-termino").val();

        $("#recper-empresa").val( $('#i-unidade').val() );
        $("#recper-datainicio").val( datainicio );
        $("#recper-datafim").val( datafim );
        $("#form-repassadoperiodo").submit();

    }

    function cargaConta()
    {

      $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
      {
        $("#FIN_CCX_ID").empty();
        linha =  '<option value="-1">Selecione a Conta </option>';
        $("#FIN_CCX_ID").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
          linha =
          '<option value="'+data[nI].FIN_CCX_ID+'">'+
                            data[nI].FIN_CCX_DESCRICAO+"</option>";
          $("#FIN_CCX_ID").append( linha );
        }
      });

    }


    function recibo( data )
    {
        var base = window.location.origin+'/sys/';
        return '<a href="'+base+'recibolocador/imprimir/'+data+'/S" target="_blank">'+data+'</a>';
    }

    function totalizar()
    {
        var datainicio = $("#i-inicio").val();
        var datafim = $("#i-termino").val();

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";

        var url = "{{route('totalrepassadoperiodo')}}/"+datainicio+'/'+datafim+'/'+empresa;

        console.log('vamos lá');
        console.log( url );

        $.ajax(
            {
                url : url,
                dataType: 'json',
                type: 'get',
                success: function( data )
                {
                    $("#i-total").html( '<b>Total Repassado no Periodo -> R$ '+formatarBRSemSimbolo(data) );
                },
                error:function()
                {

                    $("#i-total").val( 'Falha ao Totalizar' );
                }
            }
            );

    }

    function cargaLocadores()
{

    $.ajax(
        {
            url : "{{ route('locadores.carga')}}",
            dataType:'json',
            type:'get',
            async:false,
            success:function( data )
            {
                $("#i-locadores").empty();
                linha ='<option value="">Selecione o Locador</option>';
                $("#i-locadores").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].IMB_CLT_ID+'">'+
                            data[nI].IMB_CLT_NOME+
                            "</option>";
                    $("#i-locadores").append( linha );
                }
            }
        });
}

    function recibosEmLote()
    {
        var url = "{{route('repassadoperiodorecibos')}}?recperdatainicio="+$("#i-inicio").val()+"&recperdatafim="+$("#i-termino").val()+"&IMB_CLT_ID="+$('#i-locadores').val()+"&tipo="+$("#i-tipo").val();

        window.open( url, "_blank");
        
        
    }




</script>
@endpush


