@extends("layout.app")
@section('scripttop')
<style>

    .escondido 
    {
        display: none;
    }
    .titulo
{
    background-color:#004d80;
    color:white;
    width:100%;
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



</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Retorno de Chaves</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet box yellow">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>Imóveis Selecionados
        </div>                        
        <div class="tools">
          <a href="javascript:;" class="collapse"> </a>
        </div>
      </div>

        <div class="portlet-body form">
            <div class="form-body">

                <div class="row">
                    <div class="col-md-12">
                        <table  class="table table-striped table-hover" id="tblimoveisabertos" >
                            <thead>
                                <tr>
                                    <td ></td>
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
                </div>
            </div>
        </div>
    </div>


    
</div>


<div class="modal" tabindex="-1" role="dialog" id="modaldados">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-header">
            </div>        
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-blue">
                            <span class="caption-subject bold uppercase"> Saída de Chaves</span>
                            <i class="fa fa-search font-blue"></i>
                        </div>
                    </div>

                    <input type="hidden" id="IMB_CCH_ID">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="label-control">Motivo da Saída</label>
                                <select class="form-control" id="i-modivo" readonly>
                                    <option value="V">Visita de Cliente</option>
                                    <option value="M">Manutenção</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="label-control">Previsão de Devolução</label>
                                <input type="text" class="form-control" id="i-previsao" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="label-control">Endereço</label>
                                <input type="text" class="form-control" id="i-endereco" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="label-control">Referência</label>
                                <input type="text" class="form-control" id="i-referencia" readonly>
                                
                            </div>
                            <div class="col-md-2">
                                <label class="label-control">ID Imóvel</label>
                                <input type="text" class="form-control" id="i-codigoimovel" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                            <label class="label-control">Bairro</label>
                                <input type="text" class="form-control" id="i-bairro" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="label-control">Condôminio</label>
                                <input type="text" class="form-control" id="i-condominio" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="label-control">Tipo do Solicitante
                                    <select class="form-control" id="i-tiposolicitante" readonly>
                                        <option value="F">Funcionário/Corretor</option>
                                        <option value="C">Cliente</option>
                                        <option value="T">Terceiro/Parceiro</option>
                                    </select>
                                </label>
                            </div>
                            <div class="col-md-3" id="i-div-corretor">
                                <label for="tipo" class="control-label">Corretor</label>
                                <input type="text" class="form-control" id="i-select-corretor" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">Nome do Cliente</label>
                                <input type="text" class="form-control input-8" id="IMB_CLT_NOME" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Identidade do Cliente</label>
                                <input type="text" class="form-control input-8" id="IMB_CLT_RG" readonly>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3 div-center">
                                <label class="control-label">Data Retorno</label>
                                <input class="form-control div-center" 
                                    size="16" type="date" id="IMB_CCH_DEVOLUCAODATE">
                            </div>
                            <div class="col-md-2 div-center">
                                <label class="control-label">Hora Retorno</label>
                                <input class="form-control div-center" id="IMB_CCH_DEVOLUCAOHORA" type="time"
                                        min="08:00" max="18:00">
                            </div>
                            <div class="col-md-3 div-center">
                                <label class="control-label">Opinião</label>
                                <select class="form-control div-center" id="IMB_CCH_OPINIAO">
                                        <option value=" ">Não Opinou</option>
                                        <option value="G">Gostou</option>
                                        <option value="N">Não Gostou</option>
                                </select>
                            </div>
                            <div class="col-md-2 div-center">
                                <label class="control-label">Expectativa</label>
                                <select class="form-control div-center" id="IMB_CCH_EXPECTATIVA">
                                        <option value=" "></option>
                                        <option value="B">Baixa</option>
                                        <option value="M">Média</option>
                                        <option value="A">Alta</option>
                                </select>
                            </div>
                            <div class="col-md-2 div-center">
                                <label class="label-control">Reservar
                                    <input type="checkbox" id="IMB_CCH_RESERVAR" class="form-control" >
                                    <span><input type="date" id="IMB_CCH_RESERVARDATALIMITE"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-md-12 titulo">Observações para esta devoluçao</div>
                                <textarea class="form-control" id="IMB_CCH_OBSERVACAORETORNO" cols="100%" rows="5"></textarea>
                            </div>
                        </div>                            
                    </div>
                    <hr>
                    <div class="form-actions div-center">
                        <button type="button" class="btn btn-danger botao-confirmacao " id="i-btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn blue botao-confirmacao" id="i-btn-gravar-agenda" onClick="confirmarRetorno()">
                            <i class="fa fa-check"></i> Confirmar Retorno das Chaves do Imóvel
                        </button>
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

    cargaImoveisAberto();
    $( "#IMB_CCH_DEVOLUCAODATE" ).val(moment().format( 'YYYY-MM-DD'));
    $( "#IMB_CCH_DEVOLUCAOHORA" ).val(moment().format( 'HH:mm'));
  

    $.datepicker.regional['br'] = 
    {
        closeText: 'ok',
        prevText: 'Anterior',
        nextText: 'Próximo',
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
        yearSuffix: '',
        timeFormat: 'hh:mm',
        showTimepicker: false
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
            showTimepicker: false

        });

      	$('.timerpicker').timepicker({
            timeFormat: 'hh:mm',
          timeOnlyTitle: 'timeonly',
          timeText: 'Horário',
          hourText: 'Hora',
          minuteText: 'Minuto',
          secondText: 'Segundo',
          currentText: 'Agora',
            closeText: 'Sair',
            showDatePicker: false,
            showTimepicker: true

        });

        $('#i-horasaida').timepicker(
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
                url:"{{ route('saidachaves.selecionadascorretor')}}/{{Auth::user()->IMB_ATD_ID}}"
                
            },
            columns: 
                [
                    {data: 'IMB_CCH_ID', render:botaoDevolver},
                    {data: 'IMB_CCH_DTHSAIDA', render: getDataSaida  },
                    {data: 'IMB_CCH_DTHDEVOLUCAOESPERADA', render: getDataPrevista  },
                    {data: 'IMB_IMV_REFERE' },
                    {data: 'ENDERECO'},
                    {data: 'IMB_ATD_NOMESOLICITANTE'},
                    {data: 'IMB_CLT_NOME'},
                ],         
            "columnDefs": 
            [ 
                {
                "targets": 0,
                "orderable": false
                } 
            ],
            searching: false
        }
    );


}

function getDataSaida(data, type, full, meta) 
{
    return moment( full.IMB_CCH_DTHSAIDA).format('DD/MM/YYYY HH:mm');
}

function getDataPrevista(data, type, full, meta) 
{
    return moment( full.IMB_CCH_DTHDEVOLUCAOESPERADA).format('DD/MM/YYYY HH:mm');

}

function botaoDevolver(data, type, full, meta) 
{
    return '<div style="text-align:center"><button class="btn green-meadow glyphicon '+
            'glyphicon-search pull-right" ontitle="Fazer o retorno das chaves" onClick="devolver('+full.IMB_CCH_ID+')"></button></div>';

}

function devolver( id )
{


    var url = "{{route('saidachaves.show')}}/"+id;

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                $("#IMB_CCH_ID").val( data.IMB_CCH_ID );
                $("#i-modivo").val( data.IMB_CCH_MOTIVO );
                $("#i-previsao").val( moment(data.IMB_CCH_DTHDEVOLUCAOESPERADA).format('DD/MM/YYYY HH:MM:SS') );
                $("#i-referencia").val( data.IMB_IMV_REFERE);
                $("#i-codigoimovel").val( data.IMB_IMV_ID);
                $("#i-endereco").val( data.ENDERECO);
                $("#i-condominio").val( data.IMB_CND_NOME);
                $("#i-bairro").val( data.CEP_BAI_NOME);
                $("#i-tiposolicitante").val( data.IMB_CCH_TIPOSOLICITANTE ),
                $("#i-select-corretor").val( data.IMB_ATD_NOMESOLICITANTE ),
                $("#IMB_CLT_NOME").val( data.IMB_CLT_NOME ),
                $("#IMB_CLT_RG").val( data.IMB_CLT_RG ),
                $("#modaldados").modal('show');

            }
        }
    )
    
}

function confirmarRetorno()
{
    if( $("#IMB_CCH_OBSERVACAORETORNO").val()  == '' )
    {
        alert('Descreva algo sobre este registro!');
        return false;
    }
    var dados = 
    {

        IMB_CCH_ID : $("#IMB_CCH_ID").val(),
        IMB_CCH_DEVOLUCAODATE : $("#IMB_CCH_DEVOLUCAODATE").val(),
        IMB_CCH_DEVOLUCAOHORA : $("#IMB_CCH_DEVOLUCAOHORA").val(),
        IMB_CCH_OPINIAO : $("#IMB_CCH_OPINIAO").val(),
        IMB_CCH_EXPECTATIVA : $("#IMB_CCH_EXPECTATIVA").val(),
        IMB_CCH_OBSERVACAORETORNO : $("#IMB_CCH_OBSERVACAORETORNO").val(),
        IMB_CCH_RESERVARDATALIMITE: $("#IMB_CCH_RESERVARDATALIMITE").val(),
        IMB_CCH_RESERVAR: simNao( $("#IMB_CCH_RESERVAR").prop('checked')),
        
    }

    var url = "{{route('saidachaves.confirmaretorno')}}";
    $.ajaxSetup(
    {
        headers:
		{'X-CSRF-TOKEN': "{{csrf_token()}}"}
	});

    $.ajax(
        {
            url : url,
            dataType:'json',
            type:'post',
            data:dados,
            success:function()
            {
                alert('Devolução de Chave Registrada!');
                cargaImoveisAberto();
                $("#modaldados").modal('hide');
            }
        }
    );




}
</script>

@endpush
