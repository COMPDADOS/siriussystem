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

    .borda-1
    {
        border: dashed;
        border-width: .5px;
        border-color: black;
    }

    .font-20
    {
        font-size:30px;
    }
    .font-10
    {
        font-size:10px;
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
        text-align:left;

    }

    .sub-total
    {
        font-size:12px;
        background-color:gray;
        color:black;
        font-weight: bold;

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
            <span class="caption-subject bold uppercase"> Repassar os Recebidos</span>
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
                        <input type="hidden" id="i-destino" name="destino" value = "PREREPASSSE">
                        
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
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='search-form' >Gerar</button>
                    </div>              
                </div>
            </div>
        </form>
        
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <tr>
                            <th style="width: 50%"></th>
                        </tr>
                    </thead>
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
<form style="display: none" action="{{route('repasse')}}" method="POST" id="form-repassar"target="_blank">
    @csrf
    <input type="hidden" id="i-idcontrato-repassar" name="IMB_CTR_ID" />
</form>

@endsection


@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

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
        cargaConta();

      


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
        ajax:
        {
            url:"{{ route('recibolocatario.planilharecebimento') }}",
            data: function (d)
            {
                d.IMB_IMB_ID = $("#IMB_IMB_ID").val();
                d.datainicio = $("#i-inicio").val();
                d.datafim = $("#i-termino").val();
                d.conta = $("#FIN_CCX_ID").val();
                d.destino = $("#i-destino").val();

                
            }
        },
        columns:
        [
            {data: 'TMP_RRD_ID',render: colunaRecebimento},

        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) 
    {
        table.draw();
        e.preventDefault();
        ///totalizar();
    });


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

    function colunaRecebimento(data, type, full, meta)
    {

        var valor = parseFloat(full.TOTALRECIBO);

        texto = 
        '<div class="col-md-12">';

        texto = texto +  
            '<div class="col-md-6  borda-1"><h4 class="azul">Recebimento -> Recibo: '+full.IMB_RLT_NUMERO+' - Pasta: '+full.IMB_CTR_REFERENCIA+' #ID Imóvel: '+full.IMB_IMV_ID+'</h4>';

        texto = texto +
            '   <div class="col-md-12">'+
                 '   <div class="col-md-4">Locatário: <p>'+full.TMP_RRD_NOMELOCATARIO+'</p></div>'+
                 '   <div class="col-md-2"><p>'+full.IMB_RLT_FORMAPAGAMENTO+'</p></div>'+
                 '   <div class="col-md-2">Vencimento: <p>'+moment(full.IMB_RLT_DATACOMPETENCIA).format( 'DD/MM/YYYY')+'</p></div>'+
                 '   <div class="col-md-2">Pagamento: <p>'+moment(full.IMB_RLT_DATAPAGAMENTO).format( 'DD/MM/YYYY')+'</p></div>'+
                 '   <div class="col-md-2 td-direita">$ Recibo: <p><b>'+formatarBRSemSimbolo(valor)+'</b></p></div>'+
            '   </div>';


        var url = "{{route('recibolocatario.itensrecibo')}}/"+full.IMB_RLT_NUMERO;

        $.ajax( {
            url:url,
            dataType:'json',
            type:'get',
            async:false,
            success:function( data )
            {
                for( nI=0;nI < data.length;nI++)
                {
                    var valor = parseFloat(data[nI].IMB_RLT_VALOR);
                    texto = texto + '<div class="col-md-12 font-10">'+
                                    '   <div class="col-md-3">'+data[nI].IMB_TBE_NOME+'</div>'+
                                    '   <div class="col-md-1">'+data[nI].IMB_RLT_LOCATARIOCREDEB+'</div>'+
                                    '   <div class="col-md-3 td-direita">'+formatarBRSemSimbolo(valor)+'</div>'+
                                    '   <div class="col-md-5">'+data[nI].IMB_RLT_OBSERVACAO+'</div>'+
                                    '</div>';
                }
            }
        })
            
        texto = texto +                
            '</div>';


        
        texto = texto +
            '<div class="col-md-6">'+
            '   <h5><u>Dados para Repasse</u></h5>';

            var url = "{{route('repasse.calcular')}}/"+full.IMB_CTR_ID+'/'+full.IMB_RLT_DATACOMPETENCIA+'/'+moment().format( 'YYYY-MM-DD')+'/S';
        
            $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                complete( data )
                {
                    console.log(data);
                    if( data.status == 200 )
                    {
                        if( data.responseText == '[]')
                            texto = texto + 'JÁ PAGO'
                        else
                        {

                        texto = texto + '<div class="col-md-12">'+
                                            '<table id="tablerep'+data.responseJSON[0].IMB_PAG_ID+'">';
                            var total = 0;
                            for( nI=0;nI < data.responseJSON.length;nI++)                            
                            {
                                debugger;
                                var number = parseFloat(data.responseJSON[nI].IMB_LCF_VALOR);
                                var formatter = new Intl.NumberFormat('pt-BR');
                                var valor  = formatter.format(number);

                                if( data.responseJSON[nI].IMB_LCF_LOCADORCREDEB == 'C' )
                                    total = total + number
                                else
                                if( data.responseJSON[nI].IMB_LCF_LOCADORCREDEB == 'D' )
                                    total = total - number;

                                texto = texto+
                                    '<tr>'+
                                    '   <td width="30%">'+data.responseJSON[nI].IMB_TBE_NOME+'</td>'+
                                    '   <td  width="5%">'+data.responseJSON[nI].IMB_LCF_LOCADORCREDEB+'</td>'+
                                    '   <td  width="15%"><input class="form-control td-direita valor" type="text" id="pag'+data.responseJSON[nI].IMB_PAG_ID+'" value="'+valor+'"></td>'+
                                    '   <td  width="50%">'+data.responseJSON[nI].IMB_LCF_OBSERVACAO+'</td>'+
                                    '</tr>';
                            }
                            texto = texto+
                                    '<tr>'+
                                    '   <td width="30%">Total Deste Repasse</td>'+
                                    '   <td  width="5%"></td>'+
                                    '   <td  width="15%" class="td-direita sub-total"><input class="form-control td-direita valor" type="text" id="sub'+data.responseJSON[0].IMB_PAG_ID+'" value="'+total+'" readonly></td>'+
                                    '   <td  width="50%"><a class="btn btn-primary"  href="javascript:repassar('+data.responseJSON[0].IMB_CTR_ID+')">Repassar</a></td>'+
                                    '</tr>';

                            texto = texto + '</table>';

                        }

                    }


                }
            });


        texto = texto +
            '</div>';
        
        
        texto = texto + 
        '</div>';


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
        return texto;

        

    }

    function colunaRepasse(data, type, full, meta)
    {
     
    }


    function repassar( id )
    {
        $("#i-idcontrato-repassar").val( id );
        $("#form-repassar").submit();
    }




</script>
@endpush


