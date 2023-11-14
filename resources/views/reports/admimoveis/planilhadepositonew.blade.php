@extends('layout.app')

@section('scripttop')
<style>

hr {
border-top:3px dotted black;
/*Rest of stuff here*/
}

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
        font-size:20px;
    }
    .font-15
    {
        font-size:15px;
    }

    .font-azul
    {
        color:blue;
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

    .font-10
    {
        font-size: 10px;
    }

    .font-bold
    {
        font-weight: bold;
    }

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Planilha Para Depósito / Emissão de Cheques</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <a class="btn info pull-right"  href="javascript:gerarRemessaPix();">Gerar Remessa(PIX)</a>
            <a class="btn dark pull-right"  href="javascript:gerarRemessaPagamentos();">Gerar Remessa(DOC/TED/Transf.)</a>
            <a class="btn green pull-right"  href="javascript:recibosEmLote();">Recibos em Lote</a>
                    <a class="btn yellow pull-right"  href="javascript:relatorioDetalhado();">Relatório Detalhado</a>
                    <a class="btn yellow pull-right"  href="javascript:impressaoCheques();">Impressao Cheques</a>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>



    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
            <div class="form-body">
                <div class="col-md-3 fundo-grey">
                    <div class="form-group">
                    <input type="hidden" id="i-unidade" name="IMB_IMB_ID">
                    <input type="hidden" id="i-limpar" name="i-limpar">
                        
                        <label for="js-select-unidade" class="control-label">Unidade</label>
                        <select class="form-control" id="js-select-unidade">
                        </select>
                    </div>
                </div>
                <div class="col-md-2 div-center fundo-grey">
                    <div class="row">
                        Conta
                        <input type="hidden" id="FIN_CCX_ID" name="FIN_CCX_ID">
                        <input type="hidden" id="GER_BNC_NUMERO">
                        <select  class="form-control" id="i-fin_ccx_id">
                        </select>
                    </div>
                </div>

                <div class="col-md-4 fundo-grey">
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
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='search-form' >Pesquisar</button>
                </div>
            </div>
        </form>
        <div class="row escondido">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable_old">
                    <thead>
                        <th style="width: 50px"></th>
                        <th >Pasta</th>

                    </thead>
                </table>
            </div>
        </div>
        <div class="row escondido">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th >Pasta</th>
                        <th># Imovel</th>
                        <th>Favorecido</th>
                        <th>Total Pago R$</th>
                        <th>Data Pagamento</th>
                        <th>Data Vencto</th>
                        <th>Banco</th>
                        <th>Agência</th>
                        <th>Conta Corrente</th>
                        <th>Forma Pagamento</th>
                    </thead>
                </table>
            </div>
        </div>        
    </div>
</div>

@include('layout.modaldownload')

<form style="display: none" action="{{route('recibolocador.repassadoperiodo')}}" method="POST" id="form-repassadoperiodo" target="_blank">
    @csrf
    <input type="hidden" id="fin_ccx_id-totrep" name="fin_ccx_id" />
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
        $(document).ready(function(){
           $("#baixar").click();
        });
        $( "#i-fin_ccx_id" ).change(function()
        {
            var nId = $('#i-fin_ccx_id').val();
            $("#FIN_CCX_ID").val( nId);

            url = "{{route('contacaixa.find')}}/"+nId;
            console.log( url ); 
            $.ajax( 
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    success:function( data )
                    {
                        
                        $("#GER_BNC_NUMERO").val( data.FIN_CCI_BANCONUMERO);

                    }
                }
            )
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


    });
    url = "{{ route('recibolocador.planilhadepositosgerar') }}";
        console.log( url );


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
        autoWidth: false,      
        searching: false,


        ajax:
        {
            url:url,
            data: function (d)
            {
                d.IMB_IMB_ID = $('input[name=IMB_IMB_ID]').val();
                d.FIN_CCX_ID = $('input[name=FIN_CCX_ID]').val();
                d.datainicio = $('input[name=inicio]').val();
                d.datafim = $('input[name=termino]').val();
                d.limpar =  $('input[name=i-limpar]').val();
            }
        },
        columns:
        [

//            {data: 'SELECIONADO', render:selecionar},
  //          {data: 'IMB_CTR_REFERENCIA', render:montarDados},
              { data: 'IMB_CTR_REFERENCIA'},
              { data: 'IMB_IMV_ID'},
              { data: 'IMB_CLTCCR_NOME'},
              { data: 'TOTALRECIBO'},
              { data: 'IMB_RLD_DATAPAGAMENTO'}, 
              { data: 'IMB_RLD_DATAVENCIMENTO'},
              { data: 'BANCO'},
              { data: 'GER_BNC_AGENCIA', render:agenciaComDigito},
              { data: 'IMB_CLTCCR_NUMERO', render:contaComDigito},
              { data: 'FORMAPAGAMENTO'},
              
        ],

    });

    $('#search-form').on('submit', function(e) 
    {
        if( $("#FIN_CCX_ID").val() == '' )
        {
            alert('A informação da conta é necessária!');
            return false;
        }
        $("#i-limpar").val( 'S');
        table.draw();
        e.preventDefault();
        totalizar();
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
        var valor = parseFloat( data );
        return formatarBRSemSimbolo(valor);
    }


    function totalizar()
    {
        var datainicio =$("#i-inicio").val();
        var datafim = $("#i-termino").val();

        var fin_ccx_id = $("#i-fin_ccx_id").val();

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";

        var url = "{{route('totalrepassadoperiodo')}}/"+datainicio+'/'+datafim+'/'+fin_ccx_id;

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
        $("#i-fin_ccx_id").empty();
        linha =  '<option value="">Selecione a Conta </option>';
        $("#i-fin_ccx_id").append( linha );
        for( nI=0;nI < data.length;nI++)
        {
          linha =
          '<option value="'+data[nI].FIN_CCX_ID+'">'+
                            data[nI].FIN_CCX_DESCRICAO+"</option>";
          $("#i-fin_ccx_id").append( linha );
        }
      });

    }


    function recibo( data )
    {
        var base = window.location.origin+'/sys/';
        return '<a href="'+base+'recibolocador/imprimir/'+data+'/S" target="_blank">'+data+'</a>';
    }


    function recibosEmLote()
    {
        var url = "{{route('repassadoperiodorecibos')}}?recperdatainicio="+$("#i-inicio").val()+"&recperdatafim="+$("#i-termino").val()

        window.open( url, "_blank");
        
        
    }

    function selecionarOnOff( id) 
    {

        var url = "{{route('selecionardepositoonoff')}}";

        $("#i-limpar").val('N');

        var dados = { id : id };

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
                data:dados,
                success:function()
                {
                    $('#resultTable').DataTable().ajax.reload();
                }
            })
    
    }


    function selecionar( data, type, full, meta) 
    {
        if( full.SELECIONADO == 'N')
            return '<dir class="row"><div><a href="javascript:selecionarOnOff('+full.IMB_PRP_ID+')" ><i class="fa fa-square-o fa-2x" aria-hidden="true"></i></a></div></div>';
        return '<dir class="row"><div><a href="javascript:selecionarOnOff('+full.IMB_PRP_ID+')" ><i class="fa fa-check-square-o fa-2x" aria-hidden="true"></i></a></div></div>';
    }

    function montarDados( data, type, full, meta) 
    {
        texto = 
            '<div class="row">'+
            '   <div class="col-md-12">'+
            '       <div class="col-md-3">Locador: <label class="font-bold font-15 font-azul">'+full.IMB_CLT_NOME+'</label></div>'+
            '       <div class="col-md-3">Favorecido: '+full.FAVORECIDO+'</div>'+
            '       <div class="col-md-6">Imóvel: <label class="font-bold font-15 font-azul">'+full.ENDERECOIMOVEL+'</label></div>'+
            '   </div>'+
            '</div>';
        texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12">'+

            '       <div class="col-md-2">Pasta: '+full.IMB_CTR_REFERENCIA+'</div>'+
            '       <div class="col-md-2"># Imóvel: '+full.IMB_IMV_ID+'</div>'+
            '       <div class="col-md-2">Data Pagto: '+moment(full.IMB_RLD_DATAPAGAMENTO).format('DD/MM/YYYY')+'</div>'+
            '       <div class="col-md-2">Data Vencto: '+moment(full.IMB_RLD_DATAVENCIMENTO).format('DD/MM/YYYY')+'</div>'+
            '       <div class="col-md-2 font-15 font-azul font-bold">Valor Pago: '+formatarBRSemSimbolo(dolarToReal(full.TOTALRECIBO))+'</div>'+
            '   </div>'+
            '</div>';


            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12">'+
            '       <div class="col-md-1">'+full.FORMAPAGAMENTO+'</div>'+
            '       <div class="col-md-11"><i><b>Dados Bancários</b></i>: Banco: '+full.BANCO+
            '           Agência: '+full.GER_BNC_AGENCIA+'-'+full.IMB_BNC_AGENCIADV+
                    ' - C/C: '+full.IMB_CLTCCR_NUMERO+'-'+full.IMB_CLTCCR_DV+' Correntista: '+
                    full.IMB_CLTCCR_NOME+' CPF: '+full.IMB_CLTCCR_CPF+
            '   </div>'+
            '</div>';

        if( full.IMB_IMV_CHEQUENOMINAL == '' && full.IMB_IMV_CHEQUENOMINAL!= null )
             texto = texto + 
            '<div class="row">'+
            '   <div class="col-md-12">'+
            'Cheque nomimal para: '+full.IMB_IMV_CHEQUENOMINAL+'</div>'+
            '   </div>'+
            '</div>';

        return texto;
    }

    function impressaoCheques()
    {
        $("#i-limpar").val('i');

        var url = "{{route('recibolocador.planilhadepositosgerar')}}?limpar=I";

        window.open( url, "_blank");
        

    }

    function gerarRemessaPagamentos()
    {
        debugger;


        var banco = $("#GER_BNC_NUMERO").val();

        var dados = { FIN_CCX_ID : $("#FIN_CCX_ID").val()};

        if( banco == 341 )
            var url = "{{route('pagamentos.itau.gerar')}}"
        else
        if( banco == 84 )
            var url = "{{route('pagamentos.084.gerar')}}"
        else
        {
            alert('Banco não cadastrado para geração de arquivo de pagamentos');
            return false;
        }
        
        $.ajax(
        {
            url     : url,
            dataType: 'json',
            type    : 'get',
            data    :  dados,
            success : function( data )
            {

                $("#i-div-resultado").hide();

                var linha = '';
                $("#div-download").empty();
                for( nI=0;nI < data.length;nI++)
                {
                     linha = '<div class="row"><a id="baixar" href="'+data[nI].file+'" download>Baixar '+data[nI].tipo+'</a></div>';
                     $("#div-download").append(linha);
                }
                $("#modaldownload").modal('show');
                $("#i-download").val( data );
            }

        });        

    }

    function gerarRemessaPix()
    {

        debugger;

        var banco = $("#GER_BNC_NUMERO").val();

        var dados = { FIN_CCX_ID : $("#FIN_CCX_ID").val()};

        banco = 341;
        if( banco == 341 )
            var url = "{{route('pagamentos.itau.gerar.pix')}}";
        
        $.ajax(
        {
            url     : url,
            dataType: 'json',
            type    : 'get',
            data    :  dados,
            success : function( data )
            {

                $("#i-div-resultado").hide();

                var linha = '';
                $("#div-download").empty();
                for( nI=0;nI < data.length;nI++)
                {
                     linha = '<div class="row"><a id="baixar" href="'+data[nI].file+'" download>Baixar '+data[nI].tipo+'</a></div>';
                     $("#div-download").append(linha);
                }
                $("#modaldownload").modal('show');
                $("#i-download").val( data );
            }

        });        

    }

    function agenciaComDigito(data, type, full, meta)
    {
        var dv = full.IMB_BNC_AGENCIADV;
        if( dv === null ) dv='';
        return full.GER_BNC_AGENCIA+'-'+dv;
    }

    function contaComDigito( data, type, full, meta)
    {
        var dv = full.IMB_CLTCCR_DV;
        if( dv === null ) dv='';
        return full.IMB_CLTCCR_NUMERO+'-'+dv;
    }


</script>
@endpush


