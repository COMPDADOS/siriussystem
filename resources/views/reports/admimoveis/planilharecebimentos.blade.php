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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Planilha Recebimento</span>
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
                        <select  class="form-control" name="FIN_CCX_ID" id="FIN_CCX_ID">
                        </select>
                    </div>
                </div>

                <div class="col-md-4 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Recebimento entre
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
                    <input type="checkbox" id="i-semformat">Sem formatar Real
                    <input type="checkbox" id="i-dimob">Somente DIMOB
                    <a class="btn yellow pull-right"  href="javascript:relatorioDetalhado();">Relatório Detalhado</a>
                    <a class="btn green pull-right"  href="javascript:relatorioSintetico();">Relatório Sintético</a>
                        <button class="btn blue pull-right" id='search-form' >Gerar</button>
                </div>
            </div>
        </form>
        
        <div class="row">
            <div>
                Colunas: <a class="toggle-vis" data-column="0">Imóvel</a> - 
                         <a class="toggle-vis" data-column="1">Pasta</a> - 
                         <a class="toggle-vis" data-column="2">Endereço</a> - 
                         <a class="toggle-vis" data-column="3">Locador</a> - 
                         <a class="toggle-vis" data-column="4">Locatário</a> - 
                         <a class="toggle-vis" data-column="5">Recibo</a> - 
                         <a class="toggle-vis" data-column="6">Dt.Vencto.</a> - 
                         <a class="toggle-vis" data-column="7">Dt.Recto.</a> - 
                         <a class="toggle-vis" data-column="8">Aluguel</a> - 
                         <a class="toggle-vis" data-column="9">Descontos</a> - 
                         <a class="toggle-vis" data-column="10">IPTU</a> - 
                         <a class="toggle-vis" data-column="11">IRRF</a> - 
                         <a class="toggle-vis" data-column="12">Multa</a> - 
                         <a class="toggle-vis" data-column="13">Juros</a> - 
                         <a class="toggle-vis" data-column="14">Correção</a> - 
                         <a class="toggle-vis" data-column="15">Tar.Boleto</a> - 
                         <a class="toggle-vis" data-column="16">Outros</a> - 
                         <a class="toggle-vis" data-column="17">Taxa Adm.</a> - 
                         <a class="toggle-vis" data-column="18">Taxa Contrato</a> - 
                         <a class="toggle-vis" data-column="19">Recebido</a>  
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <tr>
                        <th style="width: 5%"># Imóvel</th>
                        <th style="width: 5%">Pasta</th>
                        <th style="width: 20%">Endereço</th>
                        <th style="width: 20%">Locador</th>
                        <th style="width: 20%">Locatário</th>
                        <th class="clocador" style="width: 10%">Recibo</th>
                        <th style="width: 10%">Dt. Vencto.</th>
                        <th style="width: 10%">Dt. Recto.</th>
                        <th style="width: 10%">$ Aluguel</th>
                        <th style="width: 10%">$ Descontos</th>
                        <th style="width: 10%">$ IPTU</th>
                        <th style="width: 10%">$ IRRF</th>
                        <th style="width: 10%">$ Multa</th>
                        <th style="width: 10%">$ Juros</th>
                        <th style="width: 10%">$ Correção</th>
                        <th style="width: 10%">$ Tar.Boleto</th>
                        <th style="width: 10%">$ Outros</th>
                        <th style="width: 10%">$ Taxa Adm.</th>
                        <th style="width: 10%">$ Taxa Contrato</th>
                        <th style="width: 10%">$ Recebido</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                            <th class="td-direita"></th>
                        </tr>
                    </tfoot>


                </table>
            </div>
        </div>
    </div>
</div>
<form style="display: none" action="{{route('recibolocatario.recebidoperiodo')}}" method="POST" id="form-recebidoperiodo" target="_blank">
    @csrf
    <input type="hidden" id="recper-empresa" name="recperempresa" />
    <input type="hidden" id="recper-datainicio" name="recperdatainicio" />
    <input type="hidden" id="recper-datafim" name="recperdatafim" />
    <input type="hidden" id="recper-conta" name="recperconta" />
    
</form>

@endsection


@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



    $(document).ready(function()
    {

        $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();
 
        // Get the column API object
            var column = table.column($(this).attr('data-column'));
 
        // Toggle the visibility
            column.visible(!column.visible());
        });        
        $("#sirius-menu").click();

        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );

        $( "#js-select-unidade" ).change(function()
        {
            var nUnidade = $('#js-select-unidade').val();
            $("#i-unidade").val( nUnidade);
        });


        var dt = $('#resultTable').DataTable();
        $("#i-chk-locador").change( function() 
        {
            dt.column(3).visible( $("#i-chk-locador").prop("checked"));
        })

        $("#i-chk-locatario").change( function() 
        {
            dt.column(4).visible( $("#i-chk-locatario").prop("checked"));
        })
        $("#i-chk-recibo").change( function() 
        {
            dt.column(5).visible( $("#i-chk-recibo").prop("checked"));
        })

        $("#i-chk-aluguel").change( function() 
        {
            dt.column(8).visible( $("#i-chk-aluguel").prop("checked"));
        })
        $("#i-chk-desconto").change( function() 
        {
            dt.column(9).visible( $("#i-chk-desconto").prop("checked"));
        })
        $("#i-chk-iptu").change( function() 
        {
            dt.column(10).visible( $("#i-chk-iptu").prop("checked"));
        })
        $("#i-chk-irrf").change( function() 
        {
            dt.column(11).visible( $("#i-chk-irrf").prop("checked"));
        })
        $("#i-chk-multa").change( function() 
        {
            dt.column(12).visible( $("#i-chk-multa").prop("checked"));
        })
        $("#i-chk-juros").change( function() 
        {
            dt.column(13).visible( $("#i-chk-juros").prop("checked"));
        })
        $("#i-chk-correcao").change( function() 
        {
            dt.column(14).visible( $("#i-chk-correcao").prop("checked"));
        })

        $("#i-chk-tarifaboleto").change( function() 
        {
            dt.column(15).visible( $("#i-chk-tarifaboleto").prop("checked"));
        })

        $("#i-chk-outros").change( function() 
        {
            dt.column(16).visible( $("#i-chk-outros").prop("checked"));
        })
        $("#i-chk-taxaadm").change( function() 
        {
            dt.column(17).visible( $("#i-chk-taxaadm").prop("checked"));
        })
        $("#i-chk-taxacontrato").change( function() 
        {
            dt.column(18).visible( $("#i-chk-taxacontrato").prop("checked"));
        })
        $("#i-chk-recebido").change( function() 
        {
            dt.column(19).visible( $("#i-chk-recebido").prop("checked"));
        })


//hide the first column



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

        if( $("#inc-IMB_CTR_ID").val() != '0' )
        {
            $("#btnnovo").show();
        }

        //totalizar();


    });


    var table = $('#resultTable').DataTable(
    {
        "pageLength": -1,
        dom: 'Blfrtip',

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
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true,        
        ajax:
        {
            url:"{{ route('recibolocatario.planilharecebimento') }}",
            data: function (d)
            {
                d.IMB_IMB_ID = $('input[name=IMB_IMB_ID]').val();
                d.datainicio = $('input[name=inicio]').val();
                d.datafim = $('input[name=termino]').val();
                d.conta = $("#FIN_CCX_ID").val();
                d.dimob = $("#i-dimob").prop('checked') ? 'S':'N';
                
            }
        },
                "drawCallback":function()
                {
                      //alert("La tabla se está recargando"); 
                      var api = this.api();
                      aluguel = api.column(8, {page:'current'}).data().sum();
                      aluguel = aluguel.toFixed(2);
                      aluguel = formatarValor( aluguel );

                      //desconto
                      desconto = api.column(9, {page:'current'}).data().sum();
                      desconto = desconto.toFixed(2);
                      desconto = formatarValor( desconto );

                      iptu = api.column(10, {page:'current'}).data().sum();
                      iptu = iptu.toFixed(2);
                      iptu = formatarValor( iptu );

                      irrf = api.column(11, {page:'current'}).data().sum();
                      irrf = irrf.toFixed(2);
                      irrf = formatarValor( irrf );

                      multa = api.column(12, {page:'current'}).data().sum();
                      multa = multa.toFixed(2);
                      multa = formatarValor( multa );

                      juros = api.column(13, {page:'current'}).data().sum();
                      juros = juros.toFixed(2);
                      juros = formatarValor( juros );

                      correcao = api.column(14, {page:'current'}).data().sum();
                      correcao = correcao.toFixed(2);
                      correcao = formatarValor( correcao );

                      tarifabol = api.column(15, {page:'current'}).data().sum();
                      tarifabol = tarifabol.toFixed(2);
                      tarifabol = formatarValor( tarifabol );

                      outros = api.column(16, {page:'current'}).data().sum();
                      outros = outros.toFixed(2);
                      outros = formatarValor( outros );

                      taxaadm = api.column(17, {page:'current'}).data().sum();
                      taxaadm = taxaadm.toFixed(2);
                      taxaadm = formatarValor( taxaadm );

                      taxacon = api.column(18, {page:'current'}).data().sum();
                      taxacon = taxacon.toFixed(2);
                      taxacon = formatarValor( taxacon  );

                      totalrec = api.column(19, {page:'current'}).data().sum();
                      totalrec= totalrec.toFixed(2);
                      totalrec = formatarValor( totalrec );



                      $(api.column(8).footer()).html(
                          '<div class="td-direita">'+aluguel+'</div>'
                      ),
                      $(api.column(9).footer()).html(
                          '<div class="td-direita">'+desconto+'</div>'
                      ),
                      $(api.column(10).footer()).html(
                          '<div class="td-direita">'+iptu+'</div>'
                      ),
                      $(api.column(11).footer()).html(
                          '<div class="td-direita">'+irrf+'</div>'
                      ),
                      $(api.column(12).footer()).html(
                          '<div class="td-direita">'+multa+'</div>'
                      ) ,
                      $(api.column(13).footer()).html(
                          '<div class="td-direita">'+juros+'</div>'
                      ),
                      $(api.column(14).footer()).html(
                          '<div class="td-direita">'+correcao+'</div>'
                      ),
                      $(api.column(15).footer()).html(
                          '<div class="td-direita">'+tarifabol+'</div>'
                      ),
                      $(api.column(16).footer()).html(
                          '<div class="td-direita">'+outros+'</div>'
                      ),
                      $(api.column(17).footer()).html(
                          '<div class="td-direita">'+taxaadm+'</div>'
                      ),
                      $(api.column(18).footer()).html(
                          '<div class="td-direita">'+taxacon+'</div>'
                      ),
                      $(api.column(19).footer()).html(
                          '<div class="td-direita">'+totalrec+'</div>'
                      )
                      
                }        ,        
        columns:
        [
            {data: 'IMB_IMV_ID'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECOIMOVEL'},
            {data: 'NOMELOCADOR'},
            {data: 'NOMELOCATARIO'},
            {data: 'IMB_RLT_NUMERO', render:recibo},
            {data: 'IMB_RLT_DATACOMPETENCIA', render:formatarData },
            {data: 'IMB_RLT_DATAPAGAMENTO', render:formatarData },
            {data: 'VALORALUGUEL', render:formatarValor},
            {data: 'DESCONTOS', render:formatarValor},
            {data: 'IPTU', render:formatarValor},
            {data: 'IRRF', render:formatarValor},
            {data: 'MULTAATRASO', render:formatarValor},
            {data: 'JUROSATRASO', render:formatarValor},
            {data: 'CORRECAOMONETARIA', render:formatarValor},
            {data: 'TARIFABOLETO', render:formatarValor},
            {data: 'OUTROS', render:formatarValor},
            {data: 'TAXAADM', render:formatarValor},
            {data: 'TAXACONTRATO', render:formatarValor},
            {data: 'TOTALRECIBO', render:formatarValor},

        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) 
    {
        $("#i-title-erp").html( 'Recebimentos: Periodo de '+moment( $("#i-inicio").val()).format( 'DD/MM/YYYY')+' a '+moment( $("#i-termino").val()).format( 'DD/MM/YYYY')+
        ' - '+$( "#FIN_CCX_ID option:selected" ).text());
        table.draw();
        e.preventDefault();
        ///totalizar();
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

        function formatarValor( data, type, full, meta)
    {

        var valor = parseFloat( data );
        if( $("#i-semformat").prop('checked') == true )
        {  return valor;
        }

        return formatarBRSemSimbolo(valor);
    }

    function recibo( data )
    {
        var base = window.location.origin+'/sys/';
        return '<a href="'+base+'recibolocatario/imprimir/'+data+'/S" target="_blank">'+data+'</a>';
    }

    function totalizar()
    {
        var datainicio = moment($("#i-inicio").val()).format( 'MM-DD-YYYY');
        var datafim = moment($("#i-termino").val()).format( 'MM-DD-YYYY');

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";

        var url = "{{route('totalrecebidoperiodo')}}/"+datainicio+'/'+datafim+'/'+empresa;

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
        var conta = $("#i-termino").val();

        $("#recper-empresa").val( $('#i-unidade').val() );
        $("#recper-datainicio").val( datainicio );
        $("#recper-datafim").val( datafim );
        $("#form-recebidoperiodo").submit();

    }

    function cargaConta()
    {

      $.getJSON( "{{ route('contacaixa.carga')}}/N", function( data )
      {
        $("#FIN_CCX_ID").empty();
        linha =  '<option value="">Selecione a Conta </option>';
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
        return '<a href="'+base+'recibolocatario/imprimir/'+data+'/S" target="_blank">'+data+'</a>';
    }

    function totalizar()
    {
        var datainicio = $("#i-inicio").val();
        var datafim = $("#i-termino").val();

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";

        var url = "{{route('totalrecebidoperiodo')}}/"+datainicio+'/'+datafim+'/'+empresa;

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

        $("#form-recebidoperiodo").submit();

    }

    function relatorioSintetico()
    {
        var IMB_IMB_ID = $('input[name=IMB_IMB_ID]').val();
        var datainicio = $('input[name=inicio]').val();
        var datafim = $('input[name=termino]').val();
        var conta = $("#FIN_CCX_ID").val();
        var dimob = $("#i-dimob").prop('checked') ? 'S':'N';
        var destino = "SINTETICO";
        
        url = "{{ route('recibolocatario.planilharecebimento') }}/";

        window.location = url + '?IMB_IMB_ID='+IMB_IMB_ID+'&datainicio='+datainicio+'&datafim='+datafim+'&conta='+conta+'&dimob='+dimob+'&destino='+destino;
                
    }



</script>
@endpush


