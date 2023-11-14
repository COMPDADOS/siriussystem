@extends('layout.app')

@section('scripttop')
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

    table.dataTable td 
    {
        font-size: 14px;
    }
</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Caução</span>
            <i class="fa fa-search font-blue"></i>
        </div>

        <button class="btn green pull-right escondido" id="btnnovo" type="button" onClick="novoRegistro()">Novo Registro</button>


    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
           <input type="hidden" id="inc-IMB_CTR_ID" name="idcontrato" value = "{{$idcontrato}}">
            <div class="form-body escondido" id="i-div-pesquisa">
                <div class="col-md-4 fundo-grey">
                    <div class="form-group">
                        <input type="hidden" id="i-conta-go" name="conta-go" value ="-1">
                        <label  class="control-label">Conta Corrente ou Conta Poupança</label>
    		    		<select class="select2 form-control" id="idconta" name="idconta" >
				    	</select>
                    </div>
                </div>
                
                <div class="col-md-4 fundo-grey  ">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Com depósito entre as datas

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control dpicker" name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>                
                    <div class="col-md-2 div-center font-20">
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control dpicker" name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>              
                </div>
                <div class="col-md-2 div-center">
                        <label class="control-label" for="chk-caucao">Somente Ativos</label>
                        <input class="form-control" type="checkbox" id="chk-caucao" checked>
                    </div>  
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
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
                        <th style="width: 25%">Banco</th>
                        <th style="width: 5%">Pasta</th>
                        <th style="width: 15%">Imóvel</th>
                        <th style="width: 15%">Locatário</th>
                        <th style="width: 7%">Valor Caucão</th>
                        <th style="width: 7%">Data Depósito</th>
                        <th style="width: 7%">Valor Atualizado</th>
                        <th style="width: 7%">Data Atual.</th>
                        <th style="width: 10%">Meses</th>
                        <th width="15%">Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal"  role="dialog" id="modalnovoseguro">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                @if( $idcontrato <> '0' )
                    @include('layout.cabecalhocontrato')
                @endif
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Caução
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
          
                    <input type="hidden" id="inc-IMB_CAU_ID" value = "">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CAU_DATADEPOSITO"> Data Deposito</label>
                                    <input type="text" class="form-control dpicker"  id="inc-IMB_CAU_DATADEPOSITO">                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CAU_VALOR"> Valor</label>
                                    <input type="text" class="form-control valor"  id="inc-IMB_CAU_VALOR" value='0'>                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CAU_MESES"> Meses</label>
                                    <input type="number" class="form-control"  id="inc-IMB_CAU_MESES" value='0'>                        
                                    
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="inc-conta"> Conta Corrente</label>
                                    <select class="select2 form-control" id="inc-conta" name="inc-conta" >
            				    	</select>
                                </div>
                            </div>
                            <hr>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Atualização de Valores
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body" >
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label" for="inc-IMB_CAU_DATAATUALIZACAO"> Data Atualização</label>
                                                <input type="text" class="form-control dpicker"  id="inc-IMB_CAU_DATAATUALIZACAO">                        
                                            </div>
                                           <div class="col-md-2">
                                                <label class="control-label" for="inc-IMB_CAU_VALORATUALIZADO"> Valor</label>
                                                <input type="text" class="form-control valor"  id="inc-IMB_CAU_VALORATUALIZADO" >                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <hr>
                            <div class="row">
                                <div class="com-md-12">
                                    <label class="control-label" for="inc-IMB_CAU_OBSERVACAO"> Observação</label>
                                        <textarea  class="form-control" id="inc-IMB_CAU_OBSERVACAO" rows="3"></textarea>
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



@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>



$(document).ready(function() 
    {

        $("#sirius-menu").click();

        
        if( $("#inc-IMB_CTR_ID").val() != '0' ) 
        {
            $("#btnnovo").show();
            $("#i-div-pesquisa").hide();
        }
        else
        {
            $("#btnnovo").hide();
            $("#i-div-pesquisa").show();
        }

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


        $("#i-inicio").val( moment().format('DD/MM/YYYY') );
        $("#i-termino").val( moment().format('DD/MM/YYYY') );

        $("#idseguradora").select2(
        {
            placeholder: 'Selecione',
            width: null,
        });

        $("#inc-seguradora").select2(
        {
            width: null,
            dropdownParent: $("#modalnovoseguro")
        });

        cargaConta();


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
        
        

    });

    
    var table = $('#resultTable').DataTable(
    {
        "pageLength": -1,
        dom: 'Blfrtip',
        buttons: [
            'excel'
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
            url:"{{ route('caucao.carga') }}",
            data: function (d) 
            {
                d.idconta = $('input[name=conta-go]').val();
                d.inicio = $("#i-inicio").val();
                d.termino = $("#i-termino").val();
                d.idcontrato = $('input[name=idcontrato]').val();
                d.somenteativos = $('#chk-caucao').prop('checked') ? 'S' : 'N';
                
            }

        },
        columns: 
        [
            {data: 'FIN_CCX_DESCRICAO', render:pegarConta},
            {data: 'IMB_CTR_REFERENCIA', render:pegarPasta},
            {data: 'ENDERECO'},
            {data: 'LOCATARIO'},
            {data: 'IMB_CAU_VALOR', render: formatarValorCaucao},
            {data: 'IMB_CAU_DATADEPOSITO', render: FormatarDataDeposito },
            {data: 'IMB_CAU_VALORATUALIZADO', render: formatarValorCaucaoAtu},
            {data: 'IMB_CAU_DATAATUALIZACAO', render: FormatarDataDepositoAtu },
            {data: 'IMB_CAU_MESES'},
        ],


        "columnDefs": 
        [ 
            {
                "targets": 9,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-lcx'></button>"+
                "<button title='Inativar Registro' class='btn btn-danger glyphicon glyphicon-trash pull-right del-lcx'></button>",                
            },
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        
    $("#idconta").change( function()
    {
        var seg = $("#idconta").val();
        $("#i-conta-go").val( seg  );
        

    })

    $('#resultTable tbody').on( 'click', '.alt-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            alterar( data.IMB_CAU_ID, data.IMB_CTR_ID );
            table.draw();
        });


        $('#resultTable tbody').on( 'click', '.show-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
  //          verLcx( data.FIN_LCX_ID );
        });


         
        
        function FormatarDataDepositoAtu(data, type, full, meta)
    {
        if( full.IMB_CAU_DATAATUALIZACAO != null )
            return moment(full.IMB_CAU_DATAATUALIZACAO).format('DD/MM/YYYY')
        else
            return '';

    }

    function FormatarDataDeposito(data, type, full, meta)
    {
        return moment(full.IMB_CAU_DATADEPOSITO).format('DD/MM/YYYY');

    }

    
    function formatarValorCaucaoAtu(data, type, full, meta)
    {
//        debugger;
        
        if( full.IMB_CAU_VALORATUALIZADO != null)
        {
            var valor = parseFloat(full.IMB_CAU_VALORATUALIZADO);
            return formatarBRSemSimbolo( valor );
        };
        return '';

    }
    
    function formatarValorCaucao(data, type, full, meta)
    {
        //debugger;
        var valor = parseFloat(full.IMB_CAU_VALOR);


        return formatarBRSemSimbolo( valor );

    }
    
    
    function gravarRegistro()
    {

        if( ! validarData( $("#inc-IMB_CAU_DATADEPOSITO").val() ) ) 
        {
            alert( 'Data de INÍCIO DA VIGÊNCIA Inválida!');
            return false;
        }


        
        
        if( $("#inc-conta").val() == '-1' )
        {
            alert('Informe a Conta!');
            return false;
        }

        if( parseFloat(realToDolar( $("#inc-IMB_CAU_VALOR").val() ) ) == 0 )
        {
            alert('Informe o Valor!');
            return false;
        }

        if( $("#inc-IMB_CAU_MESES").val() == 0 )
        {
            alert('Informe a Quantidade de Meses!');
            return false;
        }

        url = "{{route('caucao.update')}}";

    dados = 
        {
            IMB_CAU_ID : $("#inc-IMB_CAU_ID").val(),
            IMB_CAU_DATADEPOSITO :      $("#inc-IMB_CAU_DATADEPOSITO").val() ,
            IMB_CAU_VALOR :     realToDolar($("#inc-IMB_CAU_VALOR").val()),
            IMB_CAU_MESES :    $("#inc-IMB_CAU_MESES").val(),
            FIN_CCX_ID :  $('#inc-conta').val(),
            IMB_CAU_OBSERVACAO : $("#inc-IMB_CAU_OBSERVACAO").val(),
            IMB_CTR_ID:  $("#inc-IMB_CTR_ID").val(),
            IMB_CAU_VALORATUALIZADO:  realToDolar( $("#inc-IMB_CAU_VALORATUALIZADO").val()),
            IMB_CAU_DATAATUALIZACAO :      $("#inc-IMB_CAU_DATAATUALIZACAO").val() ,
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
                    redrawTable();
                    $("#modalnovoseguro").modal( 'hide');
//                    if( $("#inc-IMB_CTR_ID").val() != '0' ) //quando vier de uma tela de contrato
  //                     window.close();



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

    function cargaConta()
    {
        var url = "{{ route('contacaixa.carga')}}/S";

//        console.log('url carga atendente: '+url );

        $.getJSON( url, function( data )
        {
            linha = "";
            $("#idconta").empty();
            $("#idconta").append( '<option value="-1">Selecione a Conta</option>' );
            $("#inc-conta").empty();
            $("#inc-conta").append( '<option value="-1">Selecione a Conta</option>' );
            for( nI=0;nI < data.length;nI++)
            {

                linha = 
                        '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].conta+"</option>";
                $("#idconta").append( linha );
                $("#inc-conta").append( linha );
            }       
        });
            
    }

    function alterar( id, idcontrato )
    {

        pegarContrato( idcontrato )

        var urlseg = "{{route('caucao.edit')}}/"+id;

        console.log( urlseg );

        $.getJSON( urlseg, function(data)
        {       
            console.log( data );
            var dataatualizacao = data.IMB_CAU_DATAATUALIZACAO;
            if( dataatualizacao === null )
               dataatualizacao = ''
            else 
                dataatualizacao= moment(data.dataatualizacao).format('DD/MM/YYYY');

            $("#inc-IMB_CAU_ID").val(data.IMB_CAU_ID);
            $("#inc-IMB_CAU_DATADEPOSITO").val( moment(data.IMB_CAU_DATADEPOSITO).format('DD/MM/YYYY')  );
            $("#inc-IMB_CAU_VALOR").val( dolarToReal( data.IMB_CAU_VALOR) );
            $("#inc-IMB_CAU_MESES").val( data.IMB_CAU_MESES );
            $("#inc-IMB_CAU_OBSERVACAO").val( data.IMB_CAU_OBSERVACAO );
            $("#inc-IMB_CAU_VALORATUALIZADO").val( dolarToReal( data.IMB_CAU_VALORATUALIZADO ) );
            $("#inc-IMB_CAU_DATAATUALIZACAO").val( dataatualizacao);
            $('#inc-conta').val(data.FIN_CCX_ID).select2();
        });

        $("#modalnovoseguro").modal( 'show');

    }

    function limparCampos()
    {

        $('#idbanco').val('-1').select2();
        $('#i-banco-go').val('-1');
        
        cargaBanco();

    }

    function novoRegistro()
    {
        var idcontrato = $("#inc-IMB_CTR_ID").val();
            
        var diahoje=moment().format('DD');

        $("#inc-IMB_CAU_ID").val('');
        $("#inc-IMB_CAU_DATADEPOSITO").val( moment().format('DD/MM/YYYY') );
        $("#inc-IMB_CAU_VALOR").val( 0 );
        $("#inc-IMB_CAU_MESES").val( 3 );
        $('#inc-conta').val('-1').select2();;
        $("#inc-IMB_CAU_OBSERVACAO").val( '');

        pegarContrato( idcontrato )

        $("#modalnovoseguro").modal( 'show');


    }

    function  pegarContrato( idcontrato )
    {
        var url = "{{route('contrato.find')}}/"+idcontrato;

        $.ajax(
            {
                url : url,
                type:'get',
                dataType:'json',
                success:function(data)
                {
                    $("#i-locatario").val( data[0].IMB_CLT_NOME_LOCATARIO);
                    $("#i-locador").val( data[0].PROPRIETARIO);
                    if( data[0].IMB_CTR_REFERENCIA != '' )
                        $("#i-pasta").val( data[0].IMB_CTR_REFERENCIA )
                    else
                        $("#i-pasta").val( data[0].IMB_IMV_ID );

                    $("#i-iniciocontrato").val( moment(data[0].IMB_CTR_INICIO).format('DD/MM/YYYY'));
                    $("#i-proximoreajuste").val( moment(data[0].IMB_CTR_DATAREAJUSTE).format('DD/MM/YYYY'));
                }
            }
        );
    }

    function redrawTable()
    {
        $('#resultTable').DataTable().ajax.reload();
    }

    function pegarPasta(data, type, full, meta)
    {
        if( full.IMB_CTR_REFERENCIA == '' )
        {
            return '<b>'+full.IMB_IMV_ID+'</b>';
        }
        return '<b>'+full.IMB_CTR_REFERENCIA+'</b>';

    }
    function pegarConta(data, type, full, meta)
    {
        return 'Banco: '+full.GER_BNC_NUMERO+' ('+full.FIN_CCX_DESCRICAO+') - CC: <b>'+full.FIN_CCI_CONCORNUMERO+'</b>';

    }
    
        
    
    
</script>
@endpush


