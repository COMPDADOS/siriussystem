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

    .escondido
    {
        display:none;
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
    .vermelho
    {
        color:red;
    }

</style>
@endsection

@section('content')




<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Previsão de Repasse</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="col-md-3">

                <div class="form-group">
                    <label  class="control-label">Regra</label>
    	    		<select class="form-control" id="i-regra" >
                        <option value="T">Todos</option>
                        <option value="G">Garantido</option>
                        <option value="R">Recebidos</option>
			    	</select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="i-inicio">De:</label>
                    <input type="date" class="form-control " name="inicio" placeholder="Data Inicial" id="i-inicio" name="inicio">
                </div>
            </div>                
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="i-termino">Até:</label>
                    <input type="date" class="form-control" name="termino" placeholder="Data Final" id="i-termino" name="termino">
                </div>
            </div>                
            <div class="col-md-3">
                <label> Somente do Locador</label>
                    <select  class="select2" id="i-locadores" name="idcliente">
                </select>
            </div>
            <div class="col-md-1">
                <label class="control-label">Ordem</label>
                <select class="form-control" id="i-ordem-previsao">
                    <option value="data" selected>Data de Pagamento</option>
                    <option value="nome">Nome do Locador</option>

                </select>

            </div>

            <div class="form-actions noborder">
                <button class="btn dark pull-right" onClick="iniciarPrevisao()">Imprimir</button>
            </div>
            <div class="row escondido" id="i-div-resultado">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped" id="resultTable">
                        <thead>
                            <th></th>
                            <th>Forma</th>
                            <th>Locador</th>
                            <th>Locatário</th>
                            <th>Pasta</th>
                            <th>Créditos</th>
                            <th>Débitos</th>
                            <th>Líquido</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
            <div class="col-md-12 div-center" >
                <h3 class=" escondido" id="i-processamento">Em processamento....Aguarde o final!</h3>
            </div>
        </div>

@include('layout.modalcfc')
@include('layout.modalsubconta')

@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



$(document).ready(function() 
{

    $("#sirius-menu").click();
    $("#i-locadores").change( function()
    {
        var url = "{{route('cliente.find')}}/"+$("#i-locadores").val();
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
                    $("#i-email-modal-generico").val( data.IMB_CLT_EMAIL);
                }
            }
        )
        
    })

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
    cargaLocadores();

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
    $(".select2").select2(
        {
            placeholder: 'Selecione',
            width: null
    });    
    
           
    var regra = $("#i-regra").val();
    if( regra == 'R')
        url = "{{ route('repasse.previsao.recebidos') }}";

    if( regra == 'G')
        url = "{{ route('repasse.previsao.garantidos') }}";
    
    if( regra == 'T')
        url = "{{ route('repasse.previsao.todos') }}";
        
});
  
function iniciarPrevisao()
{
    $("#i-processamento").show();

    alert('Aguarde até que o relatório esteja visível em sua tela!');

    var regra = $("#i-regra").val();
    if( regra == 'R')
        previsaoRecebidos();

    if( regra == 'G')
        previsaoGarantidos();
    
    if( regra == 'T')
        previsaoTodos();
        $("#i-processamento").hide();        

    windows.close();
        
}

function previsaoRecebidos()
{
    var url = "{{route('repasse.previsao.recebidos')}}";

    titregra = 'Recebidos e Ainda Não Repassados';
       
    $("#preloader").show();
    var dados =
    {
        inicio  :$("#i-inicio").val(),
        termino  :$("#i-termino").val(),
        idcliente:$("#i-locadores").val(),        
        titulo1  : 'Relatório Para Previsão de Repasses',
        titulo2  : 'Periodo entre '+moment($("#i-inicio").val()).format('DD/MM/YYYY')+' a '+moment($("#i-termino").val()).format('DD/MM/YYYY'),
        titulo3  : titregra,
        ordem    : $("#i-ordem-previsao").val(),
    }



    console.log( url );
    console.log( dados );
    $.ajax(
        {
            url     : url,
            dataType:'json',
            type    : 'get',
            data    : dados,
            success : function( data )
            {
                console.log( data );
                gerarRelatorio();
            },
            
            error   : function( data )
            {
                alert( 'Nenhum registro encontrado para processamento' );
                $("#preloader").hide();
            },
            complete:function()
            {
                $("#preloader").hide();

            }
        }
    )




}
function previsaoGarantidos()
{
    var url = "{{route('repasse.previsao.garantidos')}}";

    titregra = 'Somente Contratos Garantidos'
       
    debugger;
    $("#preloader").show();

    var dados =
    {
        inicio  :$("#i-inicio").val(),
        termino  :$("#i-termino").val(),
        idcliente:$("#i-locadores").val(),        
        titulo1  : 'Relatório Para Previsão de Repasses',
        titulo2  : 'Periodo entre '+moment($("#i-inicio").val()).format('DD/MM/YYYY')+' a '+moment($("#i-termino").val()).format('DD/MM/YYYY'),
        titulo3  : titregra,
        ordem    : $("#i-ordem-previsao").val(),


    }

    $.ajax(
        {
            url     : url,
            dataType:'json',
            type    : 'get',
            data    : dados,
            async   : false,
            success : function( data )
            {
                gerarRelatorio();
            }
            ,
            error   : function( data )
            {
                alert( 'Nenhum registro encontrado para processamento' );
                $("#preloader").hide();

            },
            complete:function()
            {
                $("#preloader").hide();

            }
        }
    )




}
function previsaoTodos()
{
    var url = "{{route('repasse.previsao.todos')}}";

    titregra = 'Todos os Contratos Ativos'
       
    $("#preloader").show();

    var dados =
    {
        inicio  :$("#i-inicio").val(),
        termino  :$("#i-termino").val(),
        idcliente:$("#i-locadores").val(),
        titulo1  : 'Relatório Para Previsão de Repasses',
        titulo2  : 'Periodo entre '+moment($("#i-inicio").val()).format('DD/MM/YYYY')+' a '+moment($("#i-termino").val()).format('DD/MM/YYYY'),
        titulo3  : titregra,
        ordem    : $("#i-ordem-previsao").val(),

    }

    $.ajax(
        {
            url     : url,
            dataType:'json',
            type    : 'get',
            data    : dados,
            async   : false,
            success : function( data )
            {
                gerarRelatorio();
            }
            ,
            error   : function( data )
            {
                alert( 'Nenhum registro encontrado para processamento' );
                $("#preloader").hide();

            },
            complete:function()
            {
                $("#preloader").hide();

            }
        }
    )




}
function cargaLocadores()
{

    $("#preloader").show();
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
                            data[nI].IMB_CLT_NOME+data[nI].TEMLOCACAO+
                            "</option>";
                    $("#i-locadores").append( linha );
                }
            }
        });
        $("#preloader").hide();

}


function gerarRelatorio()
{
    debugger;
    var idcliente = $("#i-locadores").val();
    if( idcliente == '' ) idcliente=0;
    var url = "{{route('repasse.previsao.relatorio')}}/"+idcliente;
    window.open( url,'_blank');
}

function limparCampos()
{
    $("#i-regra").val('T');
    $("#i-inicio").val('');
    $("#i-termino").val('');
    cargaLocadores();
        
}
    

    
</script>
@endpush


