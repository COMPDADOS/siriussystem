@extends('layout.app')
@section('scriptop')

<style>
body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
}

#calendar {
    max-width: 900px;
    margin: 0 auto;
}</style>
@endsection
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->

@section('content')

<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Sirius Agenda(EM DESENVOLVIMENTO)</span>

                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                                 <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                        <div id="external-events">
                            <label class="control-label">Colaboradores</label>
                            <select class="form-control" name="" id="select-atd">
                            </select>

                            <form class="inline-form">
                                <a href="javascript:inserir( {{''}});" id="event_add" class="btn green"> Adicionar Evento </a>
                            </form>
                            <hr/>
                            <div id="event_box" class="margin-bottom-10"></div>
                            <hr class="visible-xs" /> </div>
                            <!-- END DRAGGABLE EVENTS PORTLET-->
                         </div>
                        <div class="col-md-9 col-sm-12">
                            <div id="calendar" class="has-toolbar"> </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- END CONTENT BODY -->
 </div>

         
 <div class="modal fade" id="modalevento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-body">
        
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Detalhes do Evento
                        </div>
                    </div>

                    <input type="hidden" id="i-operacao">
      
                    <div class="portlet-body form">
            
                        <div class="row">
                            <hr>
                        </div>
          
                        <div class="row">
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="label-control" for="i-id">#ID</label>
                                        <input type="text" id="i-id"  
                                        class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                    <label class="label-control" >Título</label>
                                        <input type="text" id="i-title"  
                                        class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-10">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-control " >Início</label>
                                        <input type="text" id="i-start"  
                                            class="form-control dpicker">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-control " >Término</label>
                                        <input type="text" id="i-end"  
                                            class="form-control dpicker">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" onClick="editar()" id="i-btn-alterar">Alterar</button>
                                <button type="button" class="btn btn-primary" onClick="gravar()" id="i-btn-salvar">Salvar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
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
<script src="{{asset('/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/fullcalendar/lang/pt-br.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-sliderAccess.js')}}"></script>
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>

        <!-- END THEME LAYOUT SCRIPTS -->
<script>
$(document).ready(function()
{
    $('#clickmewow').click(function()
    {
        $('#radio1003').attr('checked', 'checked');
    });
    
    $("#sirius-menu").click();

    $("#i-btn-salvar").hide();
    
    preencherSelectUsuarios();
    
    $( "#select-atd" ).change(function() 
    {
        var niduser = $('#select-atd').val();
//        alert( niduser );
        cargaAgenda( niduser );
        
        $("#calendar").fullCalendar( 'refetchEvents' );

    }); 

    var iduser = "{{Auth::user()->IMB_ATD_ID}}";

    cargaAgenda( iduser );


    $.datepicker.regional['br'] = 
    {
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

    $('.dpicker').datetimepicker(
    {
        timeFormat: 'HH:mm',
        timeOnlyTitle: 'timeonly',
        timeText: 'Horário',
        hourText: 'Hora',
        minuteText: 'Minuto',
        secondText: 'Segundo',
        currentText: 'Agora',
        closeText: 'Sair',
        format: 'DD-MM-YYYY',
        minView: 2,
        showTimepicker: true
    });

       
    
});
            

            function visualizar( info, operacao )
            {
                alert('infor vis');
                
                $("#i-operacao").val( operacao );
                $("#i-id").val( info.id);
                $("#i-title").val( info.title);
                $("#i-description").val( info.description);
                $("#i-start").val( moment(info.start).format( 'DD/MM/YYYY HH:mm'));
                $("#i-end").val( moment(info.end).format( 'DD/MM/YYYY HH:mm'));
                $("#modalevento").modal('show');
                $("#i-btn-alterar").show();

                if( operacao == 'V')
                {
                    $('#i-title').attr('readonly', true);
                    $('#i-start').attr('readonly', true);
                    $('#i-end').attr('readonly', true);
                    $('#i-description').attr('readonly', true);
                };
                if( operacao != 'V')
                {
                    $('#i-title').attr('readonly', false);
                    $('#i-start').attr('readonly', false);
                    $('#i-description').attr('readonly', false);
                    $('#i-end').attr('readonly', false);
                };


            }

            function editar()
            {
                $("#i-operacao").val( 'A');
                $('#i-title').attr('readonly', false);
                $('#i-start').attr('readonly', false);
                $('#i-end').attr('readonly', false);
                $('#i-description').attr('readonly', false);
                $("#i-btn-salvar").show();
                $("#i-btn-alterar").hide();
            }

function inserir( dataevento )
{
    $("#i-operacao").val( 'I');
    $('#i-title').val('');
    $('#i-id').val('');
    $('#i-start').val( moment(dataevento).format( 'DD/MM/YYYY HH:mm') );
    $('#i-end').val( moment(dataevento).format( 'DD/MM/YYYY')+' 00:01');

    $('#i-title').attr('readonly', false);
    $('#i-title').attr('readonly', false);
    $('#i-start').attr('readonly', false);
    $('#i-end').attr('readonly', false);
    $("#i-btn-salvar").show();
    $("#i-btn-alterar").hide();
    $("#modalevento").modal('show');

}


function gravar()
{
    alert('Acessando a agenda!');
    var dstart = $("#i-start").val();
    var dend = $("#i-end").val();
    var dateTime = moment(dend).format("DD-MM-YYYY HH:mm:ss");
    dstart =    dstart.substr( 6,4 )+'-'+
                dstart.substr( 3,2 )+'-'+
                dstart.substr( 0,2 )+' '+
                dstart.substr( 11,8 );
    dend =      dend.substr( 6,4 )+'-'+
                dend.substr( 3,2 )+'-'+
                dend.substr( 0,2 )+' '+
                dend.substr( 11,8 );
    if( dstart == dend )
    {
        alert('Inconsistência nas datas');
        return false;
    } 
    console.log(' dstart '+dstart+' - dend '+dend );
    atm = {
        id : $("#i-id").val(),
        IMB_ATD_ID: $("#select-atd").val(),
        title : $("#i-title").val(),
        start: dstart,
        end: dend
    };
    url = "{{route('calendar.salvar')}}";
    $.ajaxSetup(
        {
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
            
    console.log(   'id : '+atm.id+ ' '+
                'i-title '+atm.title+' '+
                'i-start '+atm.start+' '+
                'i-end   '+atm.end ) ;
    $.post( url, atm, function(data)
    {
        console.log('retorno '+data);
        location.reload();
    });
}
      

function cargaAgenda( iduser )
{
    var url = "{{route('calendar.carga')}}";
    dados = { iduser : iduser };

    $.ajax({
        url : url,
        type: 'get',
        async:false,
        data:dados,
        success:function( response )
        {
            json_events = response;
            $("#calendar").fullCalendar(
            {
                theme: true,
                height: 650,
                lang: 'pt-br',
                draggable: false,
                selectable:true,
                editable:true,
                eventDidMount: function(info) 
                {
                    var tooltip = new Tooltip(info.el, {
                    title: info.event.extendedProps.description,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                    });
                },                
                dayClick: function(date, jsEvent, view) 
                {
                    inserir( date.format() );
                },
                eventClick: function(info) 
                {
                    $("#i-id").val( info.id);
                    $("#i-title").val( info.title);
                    $("#i-description").val( info.description);
                    $("#i-start").val( moment(info.start).format( 'DD/MM/YYYY HH:mm'));
                    $("#i-end").val( moment(info.end).format( 'DD/MM/YYYY HH:mm'));
                    $("#modalevento").modal('show');
                    $("#i-btn-alterar").show();
                },
                header:
                {
                    left:'prev,next today',
                    center: 'title',
                    right: 'month, agendaWeek,angendaDay'
                },
                buttonText:
                {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia'
                },                            
                events : json_events
            });
            $('#calendar').fullCalendar('removeEvents');
                 
                 //Getting new event json data
             $("#calendar").fullCalendar('addEventSource', response);
                 //Updating new events
             $('#calendar').fullCalendar('rerenderEvents');
                 //getting latest Events
                 //$('#fullCalendar').fullCalendar( 'refetchEvents' );
                 //getting latest Resources
             $('#calendar').fullCalendar( 'refetchResources' );
 
        },
        error:function()
        {
            alert('erro');
        },
        done: function()
        {
            
       }

    });
}

function preencherSelectUsuarios()
{
    id="{{Auth::user()->IMB_ATD_ID}}";
    var url = "{{ route('atendente.cargaativos')}}";
    $.getJSON( url, function( data )
    {
        $("#select-atd").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha = 
                '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
            $("#select-atd").append( linha );
        }
        $("#select-atd").val( id );
    });
}
    

</script>
        

@endpush