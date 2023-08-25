@extends('layout.app')

@section('scripttop')
<style>

td
{
    text-align:center;
}

.div-center
{
    text-align:center;

}
.bold
{
    font-weight: bold;

}

.span-email
{
    color:blue;
    font-size:10px;
    font-weight: bold;

}
</style>
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Atendimentos</a>
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
            <input type="hidden" id="VIS_ATS_ID" name="VIS_ATS_ID">
            <input type="hidden" name="ocultarclientecadastrado" value="S">
            <input type="hidden" id="i-filtroatendimento" name="filtroatendimento" value="{{session()->pull('filtroatendimento')}}">
            <input type="hidden" id="i-atendimentostatus" name="atendimentostatus" value="{{session()->pull('atendimentostatus')}}">
            
                        <div class="form-body">
                <div class="row">
                    <div class="col-md-2">
                        <label class="control-label">Prioridade 
                            <input type="hidden" id="i-prioridade" name="prioridade">
                            <select class="form-control" id="i-select-prioridade" name="prioridade" >
                            </select>                        
                        </label>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                        <label class="control-label" for="nome">Data Início:</label>
                            <input type="text" class="form-control dpicker" name="datainicio" placeholder="data inicial" id="i-inicio">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="nome">Data Fim Retorno:</label>
                            <input type="text" class="form-control dpicker"  
                                name="datafim" placeholder="data Final" id="i-termino">
                        </div>
                    </div>
                    <div class="col-md-3" id="div-corretor">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Corretor</label>
                            <input type="hidden" id="i-corretor" name="corretor">
    		    			<select class="form-control" id="i-select-corretor" >
							</select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-form">Abertos
                            <input type="hidden" id="emaberto" name="emaberto" >
                            <input class="form-control" type="checkbox" data-checkbox="icheckbox_flat-blue" 
                                    id="i-aberto" >
                            </label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-form">&nbsp;
                            <button class="form-control btn blue pull-right" id='search-form'>Pesquisar</button>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="resultTable">
                    <thead>
                        <th ></th>
                        <th ></th>
                        <th ></th>
                        <th >#ID</th>
                        <th >Data de Início</th>
                        <th >Data Atendimento</th>
                        <th >Corretor</th>
                        <th >Cliente</th>
                        <th >Telefones(s)</th>
                        <th >Prioridade</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layout.modalatendimento')



<form style="display: none" action="{{route('listaratendimentos')}}" method="POST" id="form-alt">            
@csrf
    <input type="hidden" id="id" name="id" />                
</form>

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt-cli" target="_blank">            
@csrf
    <input type="hidden" id="id-cli" name="id" />                
    <input type="hidden" id="readonly" name="readonly"/>                
</form>


@endsection
@push('script')

<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-sliderAccess.js')}}"></script>

<script type="text/javascript">

$(document).ready(function() {



    var usuariologado = "{{Auth::user()->IMB_ATD_ID}}";

    $("#sirius-menu").click();

    $( "#i-select-corretor" ).change(function() {
        var cCorretor = $('#i-select-corretor').val();
        $("#i-corretor").val( cCorretor );
    });    
    $( "#i-aberto" ).change(function() {
        $("#emaberto").val( simNao( $("#i-aberto").prop('checked') ) );
    });    


    $( "#i-select-prioridade" ).change(function() {
        var cprio = $('#i-select-prioridade').val();
        $("#i-prioridade").val( cprio );
    });    

    $( "#i-horaagenda" ).change(function() 
    {
        var horario = $( "#i-horaagenda" ).val();
        var hora =  horario.substr(0,2);
        var minuto =  horario.substr(2,2);
        if( hora < '00' || hora >23 )
        {
            alert('horario inválido! Hora aceita de 00 as 23');
            $( "#i-horaagenda" ).val('');
            return false;

        }
        
        if( minuto < '00' || minuto >59 )
        {
            alert('Minuto inválido! Minuto aceitode 00 as 59');
            $( "#i-horaagenda" ).val('');
            return false;

        }
        
        if( horario.substr(2,1) != ':' ) 
        {
            alert( 'Horário no formato inválido. Formato aceito: HH:MM');
            $( "#i-horaagenda" ).val('');
            return false;
        }
    });    

    prioridadeCarga();
    preencherCorretor();

    $( "#i-select-reagendar" ).change(function() 
    {
        if( $( "#i-select-reagendar" ).val() == 'S' )
            $("#i-div-reagendar").show()
        else
            $("#i-div-reagendar").hide();
        
    });    

    $('#resultTable tbody').on( 'click', '.btn-editar', function () 
    {
        var data = table.row( $(this).parents('tr') ).data();
        //alert(data.IMB_CLT_ID);
        $("#id-cli").val( data.IMB_CLT_ID );
        $("#readonly").val('N');
        $("#form-alt-cli").submit();
//            window.location = "{{ route('cliente.edit') }}/" + data.IMB_CLT_ID+'/N';            
    });

    $('#resultTable tbody').on( 'click', '.btn-transferir', function () 
    {
        var data = table.row( $(this).parents('tr') ).data();
        transferirAtendimento( data.IMB_CLA_ID );
    });

        $("#div-corretor").show();

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
            "sLengthMenu": "_MENU_ resultados por página",
            sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": 
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": 
            {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        processing: true,
        serverSide: true,
        ajax: 
        {
            url:"{{ route('listaratendimentos') }}",
            data: function (d) 
            {
                d.id = $('input[name=id]').val();
                d.datainicio= $('input[name=datainicio]').val();
                d.datafim = $('input[name=datafim]').val();
                d.emaberto = $('input[name=emaberto]').val();
                d.corretor=$('input[name=corretor]').val();
                d.prioridade=$('input[name=prioridade]').val();
                d.ocultarclientecadastrado=$('input[name=ocultarclientecadastrado]').val();
                d.filtroatendimento=$('input[name=filtroatendimento]').val();
                d.atendimentostatus=$('input[name=atendimentostatus]').val();
            }
        },
        columns: 
        [
       
            {
                "targets": 0,
                "data": null,
                'searchable': false,
                'orderable': false,

                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn glyphicon glyphicon-pencil btn btn-sm btn-primary pull-right btn-editar' title='editar'></button>"
            },
            {
                "targets": 1,
                "data": null,
                'searchable': false,
                'orderable': false,

                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn glyphicon glyphicon-ok btn btn-sm btn-success pull-right btn-finalizar' title='Finalizar'></button>"
            },
            {
                "targets": 2,
                "data": null,
                'searchable': false,
                'orderable': false,

                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn glyphicon glyphicon-retweet btn btn-sm btn-danger pull-right btn-transferir' title='Transferir'></button></div>"
            },
            {data: 'IMB_CLA_ID'         , name: 'IMB_CLA_ID'},
            {data : 'IMB_CLA_DATACADASTRO', render : formatardatacadastro},
            {data: 'IMB_CLA_DATAATENDIMENTO', render : formatardataatendimento},
            {data: 'IMB_ATD_NOME'         , name: 'IMB_ATD_NOME'},
            {data: 'IMB_CLT_NOME'         , name: 'IMB_CLT_NOME'},
            {data: 'IMB_CLT_NOME'           , render: pegarFones},
            {data: 'VIS_PRI_NOME'         , name: 'VIS_PRI_NOME'},
                
        ],
        searching: false
    });



        $.datepicker.regional['br'] = {
	closeText: 'ok',
	prevText: 'Anterior',
	nextText: 'Próximo',
	currentText: 'corrent',
	monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho',
	'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
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

	$('.dpicker').datetimepicker({
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

    $('#i-hora-agenda').timepicker(
        {
          timeFormat: 'HH:mm',
          timeOnlyTitle: 'Selecione',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          currentText: 'Agora',
          closeText: 'Sair',
          showDatePicker: false,
          showTimepicker: true,
          use24hours: true
        });

        $('#search-form').on('submit', function(e) 
        {
            $("#i-somenteaberto").val( 'N');

            if ($('#i-aberto').is(':checked') )
                $("#i-somenteaberto").val( 'S');
                
            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.show-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $("#id").val( data.VIS_ATM_ID );
            $("#form-alt").submit();
 //           window.location = "{{ route('atendimento.atendimento') }}/" + data.VIS_ATM_ID;            
        });
/*

        $('#resultTable tbody').on( 'click', '.alt-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('cliente.edit') }}/" + data.IMB_CLT_ID;            
        });
*/
        

function prioridadeCarga()
{
  $.getJSON( "{{ route('prioridadeatendimentolista')}}", function( data )
  {
    $("#i-select-prioridade").empty();
    linha = "<option value=''>Selecione</option>";
    $("#i-select-prioridade").append( linha )
    
    for( nI=0;nI < data.length;nI++)
    {
    linha = 
        '<option value="'+data[nI].VIS_PRI_ID+'">'+
            data[nI].VIS_PRI_NOME+"</option>";
            $("#i-select-prioridade").append( linha );
    }

  });
}

function formatardataatendimento(data, type, full, meta) 
        {
            var dataat = full.IMB_CLA_DATAATENDIMENTO;
            dataat = moment(dataat).format('DD/MM/YYYY HH:mm');
            if( dataat == 'Invalid date') dataat = '-';
            return dataat;

        }

        function formatardatacadastro(data, type, full, meta) 
        {
            var dataat = full.IMB_CLA_DATACADASTRO;
            dataat = moment(dataat).format('DD/MM/YYYY HH:mm');
            return dataat;

        }

        function preencherCorretor()
        {
            var empresa = "{{Auth::user()->IMB_IMB_ID}}";
            var url = "{{ route('atendente.carga')}}/0";

            $.ajax( 
                {
                    url     : url,
                    dataType:'json',
                    type:'get',
                    async:false,
                    success: function( data )
                    {
                        $("#i-select-corretor").empty();
                        $("#i-select-corretor-para").empty();
                        linha = '<option value="">Escolha o Corretor</option>';
                        $("#i-select-corretor").append( linha );
                        $("#i-select-corretor-para").append( linha );
                        for( nI=0;nI < data.length;nI++)
                        {
                            linha = 
                            '<option value="'+data[nI].IMB_ATD_ID+'">'+
                                data[nI].IMB_ATD_NOME+"</option>";
                            $("#i-select-corretor").append( linha );
                            $("#i-select-corretor-para").append( linha );
                        }
            
                    }
                });
            

        }

        
        function pegarFones(data, type, full, meta) 
        {
            url = "{{route('telefone.carga')}}/"+full.IMB_CLT_ID;

            linha = '<div>Não Informado</div>';
            $.ajax(
                {
                    url         : url,
                    datatype    : 'json',
                    type        : 'get',
                    async: false,
                    success     : function( data )
                    {

                        linha = '';
                        for( nI=0;nI < data.length;nI++)
                        {
                            if( nI != 0 ) linha  = linha + ' / ';
                            linha = linha + 
                            '<span>('+data[nI].IMB_TLF_DDD+')</span>'+
                            '<span title="'+data[nI].IMB_TLF_TIPOTELEFONE+'">'+data[nI].IMB_TLF_NUMERO+'</span>'
                            
                        };
                        
                        linha= '<div>'+linha + '</div>';
                    }
                });
            return linha;
        }

        function limparCampos()
        {
            $("#i-filtroatendimento").val('');
            $("#i-atendimentostatus").val('');
            $("#i-prioridade").val('');
            $("#i-inicio").val('');
            $("#i-termino").val('');
            $("#i-select-corretor").val('');
            
            
        }




    </script>
@endpush
