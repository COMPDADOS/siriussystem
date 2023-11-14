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

@include('layout.modaldetalheeventocalendar')         
         
         
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
            


</script>
        

@endpush