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

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Seguro Fiança - Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        <button class="btn green pull-right escondido" id="btnnovo" type="button" onClick="novoSeguro()">Novo Seguro</button>


    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
           <input type="hidden" id="inc-IMB_CTR_ID" name="idcontrato" value = "{{$idcontrato}}">
            <div class="form-body">
                <div class="col-md-3 fundo-grey">
                    <div class="form-group">
                        <input type="hidden" id="i-seguradora-go" name="seguradora-go" value ="">
                        <label  class="control-label">Seguradora</label>
    		    		<select class="select2" id="idseguradora" name="idseguradora" >
				    	</select>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Com Vencimento do Seguro Entre

                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control dpicker" name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>                
                    <div class="col-md-2 div-center font-20">
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control dpicker" name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>                
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
                        <th style="width: 25%">Seguradora</th>
                        <th style="width: 5%">Pasta</th>
                        <th style="width: 25%">Imóvel</th>
                        <th style="width: 20%">Locatário</th>
                        <th style="width: 10%">Inicio Contrato</th>
                        <th style="width: 10%">Inicio Seguro</th>
                        <th style="width: 5%">Vencto. Seguro</th>
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
                @include('layout.cabecalhocontrato')
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Seguro Fiança
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
          
                    <input type="hidden" id="inc-IMB_SCC_ID" value = "">
                    <div class="portlet-body form">
                        <div class="form-body" >
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_SCC_NUMERODOCUMENTO"> Nº Documento</label>
                                    <input type="text" class="form-control "  id="inc-IMB_SCC_NUMERODOCUMENTO">                        
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CTR_DATAAQUISICAO"> Data Aquisição</label>
                                    <input type="text" class="form-control dpicker"  id="inc-IMB_CTR_DATAAQUISICAO">                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CTR_VIGENCIAINICIO"> Início Vigência</label>
                                    <input type="text" class="form-control dpicker"  id="inc-IMB_CTR_VIGENCIAINICIO">                        
                                    
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_CTR_VIGENCIATERMINO"> Término Vigência</label>
                                    <input type="text" class="form-control dpicker"  id="inc-IMB_CTR_VIGENCIATERMINO">                        
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label" for="inc-IMB_SCC_MESES"> Parcelas</label>
                                    <input type="text" class="form-control "  id="inc-IMB_SCC_MESES"
                                    onkeypress="return isNumber(event)" onpaste="return false;">                        
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" for="inc-IMB_SCC_VALORPARCELA"> Valor Parcela</label>
                                    <input type="text" class="form-control  valor"  id="inc-IMB_SCC_VALORPARCELA">                        
                                </div>

                            </div>                                
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label" for="i-seguradora"> Seguradora</label>
                                    <select class="select2" id="inc-seguradora" name="inc-seguradora" >
            				    	</select>

                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="com-md-12">
                                    <label class="control-label" for="inc-IMB_SCC_OBSERVACAO"> Observação</label>
                                        <textarea  class="form-control" id="inc-IMB_SCC_OBSERVACAO" rows="3"></textarea>
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

        cargaSeguradora();

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
            url:"{{ route('segurofianca.carga') }}",
            data: function (d) 
            {
                d.idseguradora = $('input[name=seguradora-go]').val();
                d.inicio = $('input[name=inicio]').val();
                d.termino = $('input[name=termino]').val();
                d.idcontrato = $('input[name=idcontrato]').val();
            }

        },
        columns: 
        [
            {data: 'SEGURADORA'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECO'},
            {data: 'LOCATARIO'},
            {data: 'IMB_CTR_INICIO', render: formatarDataInicioContrato },
            {data: 'IMB_CTR_VIGENCIAINICIO', render: formatarDataVigInicio},
            {data: 'IMB_CTR_VIGENCIATERMINO', render: formatarDataVigTermino},
        ],


        "columnDefs": 
        [ 
            {
                "targets": 7,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-lcx'></button>"+
                "<button class='btn btn-danger glyphicon glyphicon-trash pull-right del-lcx'></button>",                
            },
        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

        
    $("#idseguradora").change( function()
    {
        var seg = $("#idseguradora").val();
        $("#i-seguradora-go").val( seg  );
        

    })

    $('#resultTable tbody').on( 'click', '.alt-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
            alterar( data.IMB_SCC_ID, data.IMB_CTR_ID );
            table.draw();
        });


        $('#resultTable tbody').on( 'click', '.show-lcx', function () 
        {
            var data = table.row( $(this).parents('tr') ).data();
  //          verLcx( data.FIN_LCX_ID );
        });


         
        function formatarDataInicioContrato(data, type, full, meta)
    {
        return moment(full.IMB_CTR_INICIO).format('DD/MM/YYYY');

    }
    function formatarDataVigInicio(data, type, full, meta)
    {
        return moment(full.IMB_CTR_VIGENCIAINICIO).format('DD/MM/YYYY');

    }
    
    function formatarDataVigTermino(data, type, full, meta)
    {
        return moment(full.IMB_CTR_VIGENCIATERMINO).format('DD/MM/YYYY');

    }

    
    function gravarRegistro()
    {

        if( ! validarData( $("#inc-IMB_CTR_VIGENCIAINICIO").val() ) ) 
        {
            alert( 'Data de INÍCIO DA VIGÊNCIA Inválida!');
            return false;
        }


        if( ! validarData( $("#inc-IMB_CTR_VIGENCIATERMINO").val() ) ) 
        {
            alert( 'Data de TERMINO DA VIGÊNCOA Inválida!');
            return false;
        }

        if( ! validarData( $("#inc-IMB_CTR_DATAAQUISICAO").val() ) ) 
        {
            alert( 'Data de AQUISIÇÃO Inválida!');
            return false;
        }

        
        if( $("#inc-seguradora").val() == '' )
        {
            alert('Informe a Seguradora!');
            return false;
        }

        url = "{{route('segurofianca.update')}}";


        dados = 
        {
            IMB_SCC_ID : $("#inc-IMB_SCC_ID").val(),
            IMB_CTR_DATAAQUISICAO :      $("#inc-IMB_CTR_DATAAQUISICAO").val() ,
            IMB_CTR_VIGENCIAINICIO :     $("#inc-IMB_CTR_VIGENCIAINICIO").val(),
            IMB_CTR_VIGENCIATERMINO :    $("#inc-IMB_CTR_VIGENCIATERMINO").val(),
            IMB_CLT_ID :  $('#inc-seguradora').val(),
            IMB_SCC_OBSERVACAO : $("#inc-IMB_SCC_OBSERVACAO").val(),
            IMB_CTR_ID:  $("#inc-IMB_CTR_ID").val(),
            IMB_SCC_NUMERODOCUMENTO:  $("#inc-IMB_SCC_NUMERODOCUMENTO").val(),
            IMB_SCC_MESES:  $("#inc-IMB_SCC_MESES").val(),
            IMB_SCC_VALORPARCELA: realToDolar( $("#inc-IMB_SCC_VALORPARCELA").val()),
                        
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
                    if( $("#inc-IMB_CTR_ID").val() != '0' ) //quando vier de uma tela de contrato
                       window.close();



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

    function cargaSeguradora()
    {
        var url = "{{ route('cliente.carga')}}";

//        console.log('url carga atendente: '+url );

        $.getJSON( url, { IMB_CLT_PESSOA: 'J'}, function( data )
        {
            linha = "";
            $("#idseguradora").empty();
            $("#inc-seguradora").empty();
            $("#idseguradora").append( '<option value="">Selecione a Seguradora</option>' );
            $("#inc-seguradora").append( '<option value="">Selecione a Seguradora</option>' );
            for( nI=0;nI < data.length;nI++)
            {

                linha = 
                        '<option value="'+data[nI].IMB_CLT_ID+'">'+
                        data[nI].IMB_CLT_NOME+"</option>";
                $("#idseguradora").append( linha );
                $("#inc-seguradora").append( linha );
            }       
        });
            
    }

    function alterar( id, idcontrato )
    {

        pegarContrato( idcontrato )

        var urlseg = "{{route('segurofianca.find')}}/"+id;

        $.ajax(
        {
            url:urlseg,
            dataType:'json',
            type:'get',
            success:function( data )
            {
                
                $("#inc-IMB_SCC_ID").val(data.IMB_SCC_ID);
                $("#inc-IMB_CTR_ID").val(data.IMB_CTR_ID);
                $("#inc-IMB_CTR_DATAAQUISICAO").val( moment(data.IMB_CTR_DATAAQUISICAO).format('DD/MM/YYYY'));
                $("#inc-IMB_CTR_VIGENCIAINICIO").val(  moment(data.IMB_CTR_VIGENCIAINICIO).format('DD/MM/YYYY'));
                $("#inc-IMB_CTR_VIGENCIATERMINO").val(  moment(data.IMB_CTR_VIGENCIATERMINO).format('DD/MM/YYYY'));
                $('#inc-seguradora').val(data.IMB_CLT_ID).select2();
                $("#inc-IMB_SCC_OBSERVACAO").val( data.IMB_SCC_OBSERVACAO);
                $("#inc-IMB_SCC_NUMERODOCUMENTO").val( data.IMB_SCC_NUMERODOCUMENTO);
                $("#inc-IMB_SCC_MESES").val( data.IMB_SCC_MESES);
                $("#inc-IMB_SCC_VALORPARCELA").val( dolarToReal(data.IMB_SCC_VALORPARCELA) );

            }
        });

        $("#modalnovoseguro").modal( 'show');

    }

    function limparCampos()
    {

    }

    function novoSeguro()
    {
        var idcontrato = $("#inc-IMB_CTR_ID").val();
            
        var diahoje=moment().format('DD');

        $("#inc-IMB_SCC_ID").val('');
        $("#inc-IMB_CTR_DATAAQUISICAO").val( moment().format('DD/MM/YYYY') );
        $("#inc-IMB_CTR_VIGENCIAINICIO").val( moment().format('DD/MM/YYYY') );
        $('#inc-seguradora').val('');
        $("#inc-IMB_SCC_OBSERVACAO").val( '');


        var ddata = moment().format('YYYY/MM/DD');
        for( nI=0;nI < 12;nI++ )
        {
            ddata = adicionarMes( diahoje, ddata );
	    }
        $("#inc-IMB_CTR_VIGENCIATERMINO").val( moment(ddata).format('DD/MM/YYYY') );
                
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
    
</script>
@endpush


