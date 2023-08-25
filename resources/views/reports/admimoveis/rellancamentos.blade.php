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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  

@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase">Lançamentos Realizadas</span>
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
                <div class="col-md-3 fundo-grey">
                    <div class="form-group">
                        <input type="hidden" id="i-unidade" name="IMB_IMB_ID">
                        <label for="js-select-unidade" class="control-label">Unidade</label>
                        <select class="form-control" id="js-select-unidade">
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="i-select-evento" class="control-label">Evento</label>
                        <select class="form-control" id="i-select-evento">
                        </select>
                    </div>
                </div>

                <div class="col-md-4 fundo-grey">
                    <div class="col-md-12 div-center fundo-black font-white">
                        Ínicio Entre
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" class="form-control" name="inicio" placeholder="Data Inicial" id="i-inicio">
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
                        <th >Pasta</th>
                        <th >Endereço</th>
                        <th ># Evento</th>
                        <th >Nome Evento</th>
                        <th> CD Locador</th>
                        <th> CD Locat.</th>
                        <th width="15%" class="td-direita" >Valor</th>
                        <th >Vencimento</th>
                        <th >Observacao</th>
                    </thead>
                    <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

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
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>

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

        cargaEmpresa();
        cargaEventos();

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
            url:"{{ route('lancamentosrealizados') }}",
            data: function (d)
            {
                d.unidade = $('input[name=IMB_IMB_ID]').val();
                d.datainicio = $('input[name=inicio]').val();
                d.datafim = $('input[name=termino]').val();
                d.evento = $("#i-select-evento").val();
            }
        },
                "drawCallback":function()
                {
                      //alert("La tabla se está recargando"); 
                      var api = this.api();
                      total = api.column(7, {page:'current'}).data().sum();
                      total = total.toFixed(2);
                      total = formatarValor( total );
                      $(api.column(7).footer()).html(
                          '<div class="td-direita">'+total+'</div>'
                      )
                }        ,
        columns:
        [

            {data: 'IMB_IMV_ID'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECO'},
            {data: 'IMB_TBE_ID'},
            {data: 'IMB_TBE_NOME'},
            {data: 'IMB_LCF_LOCADORCREDEB'},
            {data: 'IMB_LCF_LOCATARIOCREDEB'},
            
            {data: 'IMB_LCF_VALOR', render:formatarValor},
            {data: 'IMB_LCF_DATAVENCIMENTO', render:formatarData},
            {data: 'IMB_LCF_OBSERVACAO'},

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
//        var valor = formatarBRSemSimbolo( parseFloat(data));
        return '<div class="td-direita">'+data+'</div>';

      }
      function formatarTaxa( data, full )
    {
        var valor = formatarBRSemSimbolo( parseFloat(data));
        var forma = '%';
        if( full.IMB_CTR_TAXAADMINISTRATIVAFORMA == 'V' ) return "R$ "+valor
        return  valor+' '+forma;

      }

      function cargaEventos( evento )
  {

    var url = "{{ route('eventos.carga')}}";
    $.ajax(
    {
      url:url,
      datatype:'json',
      async:false,
      success: function( data )
      {
        $("#i-select-evento").empty();
        $("#i-select-evento-filtro").empty();
        linha =  '<option value="0">Selecione o evento</option>';
        $("#i-select-evento").append( linha );
        $("#i-select-evento-filtro").append( linha );
        for( nI=0;nI < data.length;nI++)
        {

          if ( data[nI].IMB_TBE_ID  == evento )
          {
            linha =
              '<option value="'+data[nI].IMB_TBE_ID+'" selected>'+
                  data[nI].IMB_TBE_NOME+"</option>";
                  $("#i-select-evento").append( linha );
          }
          else
          {
            linha =
              '<option value="'+data[nI].IMB_TBE_ID+'">'+
                data[nI].IMB_TBE_NOME+"</option>";
                $("#i-select-evento").append( linha );
          }
          linha =
              '<option value="'+data[nI].IMB_TBE_ID+'">'+
                data[nI].IMB_TBE_NOME+"</option>";
                $("#i-select-evento-filtro").append( linha );

        }
      }
    });
  }

</script>
@endpush


