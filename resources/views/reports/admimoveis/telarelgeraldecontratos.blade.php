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
            <span class="caption-subject bold uppercase">Geral de Contratos</span>
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
                        <label for="js-select-unidade" class="control-label">Unidade</label>
                        <select class="form-control" id="js-select-unidade">
                        </select>
                    </div>
                </div>
                <div class="col-md-3 escondido">
                    <label> Locador</label>
                    <select  class="select2" id="i-locadores" >
                    </select>
                </div>
                <div class="col-md-2 ">
                    <label class="control-label">Situação</label>
                    <select  id="i-situacao" class="form-control">
                        <option value="T" selected>Todos</option>
                        <option value="A">Ativos</option>
                        <option value="E">Encerrados</option>
                    </select>
                </div>
                <div class="col-md-2 ">
                    <label class="control-label">Classificação</label>
                    <select  id="i-ordem" class="form-control">
                        <option value="IMB_CTR_DIAVENCIMENTO" selected>Dia Vencimento</option>
                        <option value="PROPRIETARIO">Nome Locador</option>
                        <option value="IMB_CLT_NOMELOCATARIO">Nome Locatário</option>
                        <option value="ENDERECOCOMPLETO">Endereço</option>
                    </select>
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
            
                    <th>Situação</th>
                    <th>Dia Vencto.</th>
                    <th># Imóvel</th>
                    <th>Pasta</th>
                    <th>Endereço</th>
                    <th>Início</th>
                    <th>Reajustar</th>
                    <th>Forma Pagto</th>
                    <th>Taxa Adm.</th>
                    <th>Garantido</th>
                    <th>Condomínio</th>
                    <th>Bairro</th>
                    <th>Locatário</th>
                    <th>Vencto Locatário</th>
                    <th>Locador</th>
                    <th>Vencto Locador</th>
                    <th>Nome Fiador</th>
                    <th>R$ IPTU</th>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

@include('layout.modallocacaocomissao_pre')
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

        $("#sirius-menu").click();

        $("#i-inicio").val( moment().format('YYYY-MM-DD') );
        $("#i-termino").val( moment().format('YYYY-MM-DD') );

        $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });

        cargaLocadores();

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




        if( $("#inc-IMB_CTR_ID").val() != '0' )
        {
            $("#btnnovo").show();
        }

        //totalizar();


    });

    url = "{{ route('contrato.relatoriogeral.carga') }}";
    console.log( url );

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
        scrollX: true,
        processing: true,
        serverSide: true,
        ajax:
        {
            url: url,
            data: function (d)
            {
                d.unidade = $('input[name=IMB_IMB_ID]').val();
                d.ordem = $("#i-ordem").val();
                d.situacao = $("#i-situacao").val();
            }
        },
        columns:
        [

            {data: 'IMB_CTR_SITUACAO'},
            {data: 'IMB_CTR_DIAVENCIMENTO'},
            {data: 'IMB_IMV_ID'},
            {data: 'IMB_CTR_REFERENCIA'},
            {data: 'ENDERECOCOMPLETO'},
            {data: 'IMB_CTR_INICIO', formatarData},
            {data: 'IMB_CTR_DATAREAJUSTE',formatarData},
            {data: 'IMB_FORPAG_NOME'},
            {data: 'IMB_CTR_TAXAADMINISTRATIVA'},
            {data: 'GARANTIDO'},
            {data: 'IMB_CND_NOME'},
            {data: 'CEP_BAI_NOME'},
            {data: 'IMB_CLT_NOMELOCATARIO'},
            {data: 'PROXIMORECEBIMENTO',formatarData},
            {data: 'PROPRIETARIO'},
            {data: 'PROXIMOREPASSE',formatarData},
            {data: 'IMB_CLT_NOMEFIADOR'},
            {data: 'IMB_LCF_VALOR'},

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
        return  '<div class="div-right">'+valor+'</div>';

      }
      function formatarTaxa( data, full )
    {
        var valor = formatarBRSemSimbolo( parseFloat(data));
        var forma = '%';
        if( full.IMB_CTR_TAXAADMINISTRATIVAFORMA == 'V' ) return "R$ "+valor
        return  valor+' '+forma;

    }

    function acao( data)
    {

        var texto = '<div class="div-center"><a href="javascript:taxaContratoSituacao( '+data+' )";><i class="fa fa-money" aria-hidden="true"></i></a>';
        return texto;
    }

    function taxaContratoSituacao( id )
    {
        var url = "{{route('txcontratodocontratototais')}}/"+id;
        $("#modalloccomissao_pre").modal('show');
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    dados = JSON.parse( data );
                    console.log( dados );
                    console.log( dados[0].total );
                    $("#i-val-tal").html( dolarToReal(dados[0].total)+' em '+dados[0].parcelas+' parcela(s). Já paga pelo Locatário: R$ '+
                            dolarToReal(dados[0].recebida)+' e em aberto: '+dolarToReal(dados[0].aberta) );
                    
                }
            }
        )

        var url = "{{route('txcontratodocontrato')}}/"+id;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    linha = "";
                    $("#tabparcelas-tc>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        datarec = data[nI].IMB_LCF_DATARECEBIMENTO;
                        if( datarec === null ) 
                            datarec = 'Aberta'
                        else
                            datarec = moment(data[nI].IMB_LCF_DATARECEBIMENTO);
                        
                        linha =
                            '<tr>'+
                                '   <td style="text-align:center">'+moment(data[nI].IMB_LCF_DATAVENCIMENTO).format( 'DD/MM/YYYY')+'</td>'+
                                '   <td style="text-align:center">'+datarec+'</td>'+
                                '   <td style="text-align:center">'+dolarToReal(data[nI].IMB_LCF_VALOR)+'</td>'+
                            '</tr>';

                        $("#tabparcelas-tc").append( linha );

                    }
                }
            }
        )

        var url = "{{route('capctr.carga')}}/"+id;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    linha = "";
                    $("#tacaptadores-tc>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<tr>'+
                                '   <td style="text-align:center">'+data[nI].IMB_ATD_NOME+'</td>'+
                                '   <td style="text-align:center">'+data[nI].IMB_CAPIMO_PERCENTUAL+'</td>'+
                                '   <td style="text-align:center">0,00</td>'+
                            '</tr>';

                        $("#tacaptadores-tc").append( linha );

                    }
                }
            }
        )

        


    }
    function cargaLocadores()
{

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
}

</script>
@endpush


