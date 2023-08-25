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
            <span class="caption-subject bold uppercase">Reajustes Realizados no Período</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>
        <div>
            <button class="btn btn-success pull-right" type="button" id="btn-limpar"
            onClick="enviarEmailsReajusteAluguelPeriodo()">Enviar Emails</button>
        </div>
        <div>
            <button class="btn btn-success pull-right" type="button" id="btn-limpar"
            onClick="gerarCartas()">Gerar Cartas</button>
        </div>



    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
            <div class="form-body">
                <div class="col-md-3 fundo-grey">
                    <div class="form-group">
                        <input type="hidden" id="i-unidade" name="IMB_IMB_ID">
                        <label for="js-select-unidade" class="control-label">Unidade</label>
                        <select class="form-control" id="js-select-unidade">
                        </select>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Termino Entre
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control " name="inicio" placeholder="Data Inicial" id="i-inicio">
                        </div>
                    </div>
                    <div class="col-md-2 div-center font-20">
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control" name="termino" placeholder="Data Final" id="i-termino">
                        </div>
                    </div>
                    <div class="div-center" >
                        <label id="i-total"></label>
                    </div>

                </div>
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
                </div>
                <div class="col-md-3 fundo-grey">
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 fundo-grey div-center">

                </div>
                <div class="form-actions noborder">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th ># Imóvel</th>
                        <th >ID Imóvel</th>
                        <th >Pasta</th>
                        <th width="200px">Endereço</th>
                        <th >$ Anterior</th>
                        <th >$ reajustado</th>
                        <th >Fator %</th>
                        <th >Data Reajuste</th>
                        <th >Próximo Reajuste</th>
                        <th >Feito por</th>
                    </thead>
                </table>
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

        $("#i-inicio").val( moment());
        $("#i-termino").val( moment());


        $( "#js-select-unidade" ).change(function()
        {
            var nUnidade = $('#js-select-unidade').val();
            $("#i-unidade").val( nUnidade);
        });

        cargaEmpresa();

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


    });


    var table = $('#resultTable').DataTable(
    {
        "pageLength": -1,
        dom: 'Bfrtip',
        buttons: [
            'print',
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
            url:"{{ route('reajustes.realizados.carga') }}",
            data: function (d)
            {
                d.unidade =$('input[name=IMB_IMB_ID]').val();
                d.datainicio = moment( $('input[name=inicio]').val()).format( 'DD-MM-YYYY');
                d.datafim =  moment( $('input[name=termino]').val()).format( 'DD-MM-YYYY');
            }
        },
        columns:
        [

            {data: 'IMB_CHR_ID', render:botaoGrid},
            {data: 'IMB_IMV_ID'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECO'},
            {data: 'IMB_CTR_VALORANTERIOR', render:formatarValor},
            {data: 'IMB_CTR_VALOR', render:formatarValor},
            {data: 'IMB_CHR_FATOR', render:formatarValor},
            {data: 'IMB_CHR_DATAREAJUSTE',render:formatarData},
            {data: 'IMB_CHR_DATAPROXIMOREAJUSTE',render:formatarData},
            {data: 'IMB_ATD_NOME'},

        ],


        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });


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
        var valor = formatarBRSemSimbolo( parseFloat(data));
        return  valor;

      }
      function formatarTaxa( data, full )
    {
        var valor = formatarBRSemSimbolo( parseFloat(data));
        var forma = '%';
        if( full.IMB_CTR_TAXAADMINISTRATIVAFORMA == 'V' ) return "R$ "+valor
        return  valor+' '+forma;

      }

      function botaoGrid( data )
      {
          var linha = '<div><button class="btn btn-danger form-control" onClick="estornar('+data+')">Estornar</button></div>';
          return linha;
      }

      function gerarCartas()
      {

        unidade=  $('input[name=IMB_IMB_ID]').val(),
        datainicio = moment( $('input[name=inicio]').val()).format( 'DD-MM-YYYY');
        datafim =moment( $('input[name=termino]').val()).format( 'DD-MM-YYYY');
        origem ='CARTAS';
        
        url = "{{ route('reajustes.realizados.carga') }}?unidade"+unidade+"&datainicio="+datainicio+"&datafim="+datafim+"&origem="+origem;

        window.location = url;

      }

      function enviarEmailsReajusteAluguelPeriodo()
        {
            var dados =
            {
                unidade :  $('input[name=IMB_IMB_ID]').val(),
                datainicio : moment( $('input[name=inicio]').val()).format( 'DD-MM-YYYY'),
                datafim :moment( $('input[name=termino]').val()).format( 'DD-MM-YYYY'),
                origem :'EMAIL'
            }

            var url = "{{ route('reajustes.realizados.carga')}}";

        $.ajax(
            {
            url:url,
            dataType:'json',  
            type:'get',
            data:dados,
            success:function()
            {
                alert('Emails enviados e registro nos logs');

            },
            error:function()
            {
                alert('Falha ao gerar o email de reajuste para o locatario')
            }
            }
        )
}

 function estornar( id )
{

    var url = "{{route('reajuste.estornar')}}/"+id;

    console.log( url );
    $.ajaxSetup(
        {
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

    $.ajax(
        {
            url:url,
            dataType:'json',  
            type:'post',
            success:function()
            {
                alert('Estornado!');
                redrawTable();

            },
            error:function()
            {
                alert('Não foi possivel estornar');
            }
        })



}



</script>
@endpush


